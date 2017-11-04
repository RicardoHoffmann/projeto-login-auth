<?php

namespace Accounts\Admin\Controller;

use Accounts\Admin\Controller\AppController;
use Accounts\Base\Model\Table\UsersTable;
use Cake\Database\Query;
use Cake\Event\Event;
use Accounts\Base\Controller\Component\UsersAuthComponent;
use Accounts\Base\Controller\Traits\SimpleCrudTrait;
use Cake\ORM\Table;
use Cake\ORM\TableRegistry;
use CakeDC\Users\Controller\Traits\LoginTrait;
use CakeDC\Users\Controller\Traits\RegisterTrait;
use CakeDC\Users\Controller\Traits\PasswordManagementTrait;
use CakeDC\Users\Controller\Traits\CustomUsersTableTrait;
use Cake\Core\Configure;
use Cake\Utility\Inflector;

class UsersController extends AppController
{
    use CustomUsersTableTrait;
    use SimpleCrudTrait;
    use PasswordManagementTrait;

    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Search.Prg', [
            'actions' => ['index']
        ]);
    }

    public function view($id = null)
    {
        $table = $this->loadModel(Configure::read('Users.table'));
        $tableAlias = $table->alias();
        $entity = $table->get($id, [
            'contain' => []
        ]);
        $this->verifyUserIsStudent($id);
        $this->verifyUserIsEmployee($id);
        $this->verifyUserIsOutsourced($id);
        $this->verifyUserIsScholarship($id);
        $this->participatingGroups($id);
        $this->set($tableAlias, $entity);
        $this->set('tableAlias', $tableAlias);
        $this->set('_serialize', [$tableAlias, 'tableAlias']);
    }
    /**
     * Mostra os grupos que o usuario participa
     */
    public function participatingGroups($id = null)
    {
        $userGroupsTable = TableRegistry::get('user_groups');
        $groupsTable = TableRegistry::get('Groups');

        $groups = $groupsTable->find('all')
                                ->where(['Groups.id IN' =>
                                        $userGroupsTable->find('all')
                                            ->select('group_id')
                                            ->where(['user_groups.user_id' => $id])
                                ])
                                ->orderAsc('Groups.name');
        $this->set(compact('groups'));
        $this->set('_serialize', ['groups']);
    }
    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $table = $this->loadModel(Configure::read('Users.table'));

        $query = $table->find('all')
            ->find('search', $table->filterParams($this->request->query))
            ->order(['Users.first_name' => 'ASC', 'Users.last_name' => 'ASC', 'Users.username' => 'ASC']);;

        $tableAlias = $table->alias();
        $this->set($tableAlias, $this->paginate($query));
        $this->set('tableAlias', $tableAlias);
        $this->set('_serialize', [$tableAlias, 'tableAlias']);
    }

    /**
     * Change password
     *
     * @return void|\Cake\Network\Response
     */
    public function changePassword($user_id=null)
    {
        $id = null;

        if ($user_id) {
            $query = $this->getUsersTable()->findById($user_id);
            if ($query->count()) {
                $id = $user_id;
            }
            $user = $this->getUsersTable()->newEntity();
        }
        if (!empty($id)) {
            $user->id = $id;
            $user->name = $query->first()->first_name . ' ' . $query->first()->last_name;
            $user->username = $query->first()->username;
            $validatePassword = false;
            //@todo add to the documentation: list of routes used
            $redirect = ['plugin' => 'Accounts/Admin', 'controller' => 'Users', 'action' => 'index'];
        } else {
            return $this->redirect(['plugin' => 'Accounts', 'controller' => 'Users', 'action' => 'index']);
        }
        $this->set('validatePassword', $validatePassword);
        if ($this->request->is('post')) {
            try {
                $user = $this->getUsersTable()->patchEntity($user, $this->request->data(), ['validate' => 'passwordConfirm']);
                if ($user->errors()) {
                    $this->Flash->error(__d('Accounts/admin', 'Password could not be changed'));
                } else {
                    $user = $this->getUsersTable()->changePassword($user);
                    if ($user) {
                        $this->dispatchEvent(UsersAuthComponent::EVENT_AFTER_CHANGE_PASSWORD, [
                            'plain_text_password' => $this->request->data(),
                            'userEntity' => $user,
                        ]);                        
                        $this->Flash->success(__d('Accounts/admin', 'Password has been changed successfully'));
                        return $this->redirect($redirect);
                    } else {
                        $this->Flash->error(__d('Accounts/admin', 'Password could not be changed'));
                    }
                }
            } catch (UserNotFoundException $exception) {
                $this->Flash->error(__d('Accounts/admin', 'User was not found'));
            } catch (WrongPasswordException $wpe) {
                $this->Flash->error(__d('Accounts/admin', 'The current password does not match'));
            } catch (Exception $exception) {
                $this->Flash->error(__d('Accounts/admin', 'Password could not be changed'));
            }
        }
        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $table = $this->loadModel(Configure::read('Users.table'));
        $tableAlias = $table->alias();
        $entity = $table->get($id, [
            'contain' => []
        ]);
        $this->set($tableAlias, $entity);
        $this->set('tableAlias', $tableAlias);
        $this->set('_serialize', [$tableAlias, 'tableAlias']);
        if (!$this->request->is(['patch', 'post', 'put'])) {
            return;
        }

        $entity = $table->patchEntity($entity, $this->request->data);
        $singular = Inflector::singularize(Inflector::humanize($tableAlias));
        if ($table->save($entity)) {
            $this->fireEventEnabledAccount($entity);
            $this->Flash->success(__d('Accounts/admin', 'The {0} has been saved', $singular));
            return $this->redirect(['action' => 'index']);
        }
        $this->Flash->error(__d('Accounts/admin', 'The {0} could not be saved', $singular));
    }

    private function fireEventEnabledAccount($user=null)
    {
        if ($this->request->data['active'] == true) {
            $this->dispatchEvent(UsersAuthComponent::EVENT_AFTER_ENABLE_ACCOUNT, [
                'user' => $user,
            ]);
        } else {
            $this->dispatchEvent(UsersAuthComponent::EVENT_AFTER_DISABLE_ACCOUNT, [
                'user' => $user,
            ]);
        }
    }

    public function delete()
    {
        $this->Flash->error(__d('Users', 'Forbidden'));
        return $this->redirect(['action' => 'index']);
    }

    public function specializeUser($user_id = null)
    {
        $this->verifyUserIsStudent($user_id);
        $this->verifyUserIsOutsourced($user_id);
        $this->verifyUserIsScholarship($user_id);
        $user = $this->Users->get($user_id);
        $this->set(compact('user'));
        $this->set('_serialize', ['user']);

        if ($this->request->is('post')) {
            $this->addStudentSpecialization($user_id, $this->request->data());
        }
    }

    public function addStudentSpecialization($user_id, $data)
    {
        $personsTable = TableRegistry::get('persons');
        $queryPerson = $personsTable->findByUserId($user_id)
            ->select('id');

        if ($queryPerson->count() != 0) {
            $student_register = [
                'person_id' => $queryPerson->toArray()[0]['id'],
                'rg' => $data['rg'],
                'birthday' => $data['birthday']
            ];
            $studentsTable = TableRegistry::get('students');
            $student = $studentsTable->newEntity($student_register);
            if ($studentsTable->save($student)) {
                $this->Flash->success(__d('Accounts/admin', 'The user has specialized in Student'));
            } else {
                $this->Flash->success(__d('Accounts/admin', 'It was not possible to specialize the user in Student'));
            }
            return $this->redirect(['action' => 'specialize-user', $user_id]);
        } else {
            $this->Flash->error(__d('Accounts/admin', 'The User is not associated with Person table'));
        }
        return $this->redirect(['action' => 'specialize-user', $user_id]);
    }

    public function addOutsourcedSpecialization($user_id)
    {
        $personsTable = TableRegistry::get('persons');
        $queryPerson = $personsTable->findByUserId($user_id)
            ->select('id');

        if ($queryPerson->count() != 0) {
            $outsourced_register = [
                'person_id' => $queryPerson->toArray()[0]['id']
            ];
            $outsourcedsTable = TableRegistry::get('outsourceds');
            $outsourced = $outsourcedsTable->newEntity($outsourced_register);
            if ($outsourcedsTable->save($outsourced)) {
                $this->Flash->success(__d('Accounts/admin', 'The user has specialized in Outsourced'));
            } else {
                $this->Flash->success(__d('Accounts/admin', 'It was not possible to specialize the user in Outsourced'));
            }
        } else {
            $this->Flash->error(__d('Accounts/admin', 'The User is not associated with Person table'));
        }
        return $this->redirect(['action' => 'specialize-user', $user_id]);
    }

    public function addScholarshipSpecialization($user_id)
    {
        $personsTable = TableRegistry::get('persons');
        $queryPerson = $personsTable->findByUserId($user_id)
            ->select('id');

        if ($queryPerson->count() != 0) {
            $scholarship_register = [
                'person_id' => $queryPerson->toArray()[0]['id']
            ];
            $scholarshipsTable = TableRegistry::get('scholarships');
            $scholarship = $scholarshipsTable->newEntity($scholarship_register);
            if ($scholarshipsTable->save($scholarship)) {
                $this->Flash->success(__d('Accounts/admin', 'The user has specialized in Scholarship'));
            } else {
                $this->Flash->success(__d('Accounts/admin', 'It was not possible to specialize the user in Scholarship'));
            }
        } else {
            $this->Flash->error(__d('Accounts/admin', 'The User is not associated with Person table'));
        }
        return $this->redirect(['action' => 'specialize-user', $user_id]);
    }

    public function verifyUserIsStudent($user_id)
    {
        $personsTable = TableRegistry::get('persons');
        $studentsTable = TableRegistry::get('students');

        $student = $studentsTable->find()
            ->where(['person_id' => $personsTable->find()
                                        ->select('id')
                                        ->where(['user_id' => $user_id])
            ]);

        if ($student->count() != 0) {
            $isStudent = true;
        } else {
            $isStudent = false;
        }
        $this->set(compact('isStudent'));
    }

    public function verifyUserIsEmployee($user_id)
    {
        $personsTable = TableRegistry::get('persons');
        $employeesTable = TableRegistry::get('employees');
        $categoriesTable = TableRegistry::get('employees_categories');
        $specializationsTable = TableRegistry::get('employees_specializations');

        $employee_id = $employeesTable->find()
            ->select('id')
            ->where(['person_id' => $personsTable->find()
                ->select('id')
                ->where(['user_id' => $user_id])
            ]);

        $categories = $categoriesTable->find()
            ->where(['id IN ' => $specializationsTable->find()
                ->select('category_id')
                ->where(['employee_id' => $employee_id])
            ])
            ->orderAsc('description');

        if ($employee_id->count() != 0) {
            $isEmployee = true;
        } else {
            $isEmployee = false;
        }
        $this->set(compact('isEmployee', 'categories'));
    }

    public function verifyUserIsOutsourced($user_id)
    {
        $personsTable = TableRegistry::get('persons');
        $outsourcedsTable = TableRegistry::get('outsourceds');

        $outsourced = $outsourcedsTable->find()
            ->where(['person_id' => $personsTable->find()
                ->select('id')
                ->where(['user_id' => $user_id])
            ]);

        if ($outsourced->count() != 0) {
            $isOutsourced = true;
        } else {
            $isOutsourced = false;
        }
        $this->set(compact('isOutsourced'));
    }

    public function verifyUserIsScholarship($user_id)
    {
        $personsTable = TableRegistry::get('persons');
        $scholarshipsTable = TableRegistry::get('scholarships');

        $scholarship = $scholarshipsTable->find()
            ->where(['person_id' => $personsTable->find()
                ->select('id')
                ->where(['user_id' => $user_id])
            ]);

        if ($scholarship->count() != 0) {
            $isScholarship = true;
        } else {
            $isScholarship = false;
        }
        $this->set(compact('isScholarship'));
    }

    public function removeStudentSpecialization($user_id)
    {
        $personsTable = TableRegistry::get('persons');
        $person_id = $personsTable->findByUserId($user_id)
            ->select('id');

        $studentsTable = TableRegistry::get('students');
        $student = $studentsTable->findByPersonId($person_id->toArray()[0]['id']);
        $student = $studentsTable->get($student->toArray()[0]['id']);
        if ($studentsTable->delete($student)) {
            $this->Flash->success(__d('Accounts/admin', 'Specialization has been removed'));
        } else {
            $this->Flash->error(__d('Accounts/admin', 'Specialization could not be removed. Please try again'));
        }
        return $this->redirect(['action' => 'specialize-user', $user_id]);
    }

    public function removeOutsourcedSpecialization($user_id)
    {
        $personsTable = TableRegistry::get('persons');
        $person_id = $personsTable->findByUserId($user_id)
            ->select('id');

        $outsourcedsTable = TableRegistry::get('outsourceds');
        $outsourced = $outsourcedsTable->findByPersonId($person_id->toArray()[0]['id']);
        $outsourced = $outsourcedsTable->get($outsourced->toArray()[0]['id']);
        if ($outsourcedsTable->delete($outsourced)) {
            $this->Flash->success(__d('Accounts/admin', 'Specialization has been removed'));
        } else {
            $this->Flash->error(__d('Accounts/admin', 'Specialization could not be removed. Please try again'));
        }
        return $this->redirect(['action' => 'specialize-user', $user_id]);
    }

    public function removeScholarshipSpecialization($user_id)
    {
        $personsTable = TableRegistry::get('persons');
        $person_id = $personsTable->findByUserId($user_id)
            ->select('id');

        $scholarshipsTable = TableRegistry::get('scholarships');
        $scholarship = $scholarshipsTable->findByPersonId($person_id->toArray()[0]['id']);
        $scholarship = $scholarshipsTable->get($scholarship->toArray()[0]['id']);
        if ($scholarshipsTable->delete($scholarship)) {
            $this->Flash->success(__d('Accounts/admin', 'Specialization has been removed'));
        } else {
            $this->Flash->error(__d('Accounts/admin', 'Specialization could not be removed. Please try again'));
        }
        return $this->redirect(['action' => 'specialize-user', $user_id]);
    }

    public function employeesCategories($user_id) {
        $categoriesTable = TableRegistry::get('employees_categories');
        $specializationsTable = TableRegistry::get('employees_specializations');

        $employee_id = $this->getEmployeeId($user_id);

        $employeeSpecialization = $specializationsTable->find()
            ->select('category_id')
            ->where(['employee_id' => $employee_id]);

        $categories = $categoriesTable->find('all')
            ->orderAsc('description');

        $SuccessfullyAdded = true;
        $SuccessfullyRemoved = true;

        if ($this->request->is('post')) {
            foreach ($this->request->data() as $key => $check) {
                if ($key == $check) {
                    if (!$this->addEmployeeSpecialization($employee_id, $check)) {
                        $SuccessfullyAdded = false;
                    }
                } else {
                    if (!$this->removeEmployeeSpecialization($employee_id, $key)) {
                        $SuccessfullyRemoved = false;
                    }
                }
            }

            if ($SuccessfullyAdded && $SuccessfullyRemoved) {
                $this->Flash->success(__d('Accounts/admin', 'All changes have been saved.'));
                return $this->redirect(['action' => 'specialize-user', $user_id]);
            } else {
                if (!$SuccessfullyAdded) {
                    $this->Flash->error(__d('Accounts/admin', 'There was an error adding some specialization.'));
                    return $this->redirect(['action' => 'specialize-user', $user_id]);
                }

                if (!$SuccessfullyRemoved) {
                    $this->Flash->error(__d('Accounts/admin', 'There was an error removing some expertise.'));
                    return $this->redirect(['action' => 'specialize-user', $user_id]);
                }
            }
        }

        foreach ($categories as $category) {
            foreach ($employeeSpecialization as $specialization) {
                if ($category['id'] == $specialization['category_id']) {
                    $category['checked'] = true;
                    break;
                } else {
                    $category['checked'] = false;
                }
            }

        }
        $this->set(compact('categories'));
    }

    public function addEmployeeSpecialization($employee_id, $category_id)
    {
        $employeesSpecializationTable = TableRegistry::get('employees_specializations');

        $specialization_id = $employeesSpecializationTable->find()
            ->select('id')
            ->where(['employee_id' => $employee_id])
            ->andWhere(['category_id' => $category_id]);

        if ($specialization_id->count() == 0) {
            $employeesSpecialization = $employeesSpecializationTable->newEntity();
            $employeesSpecialization->employee_id = $employee_id;
            $employeesSpecialization->category_id = $category_id;
            if ($employeesSpecializationTable->save($employeesSpecialization)) {
                return true;
            }
            return false;
        }
        return true;
    }

    public function removeEmployeeSpecialization($employee_id, $category_id) {
        $employeesSpecializationTable = TableRegistry::get('employees_specializations');

        $specialization_id = $employeesSpecializationTable->find()
            ->select('id')
            ->where(['employee_id' => $employee_id])
            ->andWhere(['category_id' => $category_id]);

        if ($specialization_id->count() != 0) {
            $specializationEntity = $employeesSpecializationTable->get($specialization_id->toArray()[0]['id']);
            if ($employeesSpecializationTable->delete($specializationEntity)) {
                return true;
            }
            return false;
        }
        return true;
    }

    public function getEmployeeId($user_id)
    {
        $personsTable = TableRegistry::get('persons');
        $person_id = $personsTable->find()
            ->select('id')
            ->where(['user_id' => $user_id]);

        $employeesTable = TableRegistry::get('employees');
        $employee = $employeesTable->find()
            ->select('id')
            ->where(['person_id' => $person_id]);

        if ($employee->count() == 0) {
            return $this->registerEmployee($person_id, $user_id);
        }
        return $employee->toArray()[0]['id'];
    }

    public function registerEmployee($person_id, $user_id)
    {
        $employeesTable = TableRegistry::get('employees');
        $employee = $employeesTable->newEntity();
        $employee->person_id = $person_id;
        if (!$employeesTable->save($employee)) {
            $this->Flash->error(__d('Accounts/admin', 'Failed to register Employee. Please try again.'));
            return $this->redirect(['plugin' => 'Accounts/Admin', 'controller' => 'Users', 'action' => 'specialize-user', $user_id]);
        }
        return $employee->id;
    }
}