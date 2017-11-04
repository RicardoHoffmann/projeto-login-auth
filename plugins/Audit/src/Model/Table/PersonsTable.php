<?php
namespace Audit\Model\Table;

use Audit\Model\Entity\Person;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Persons Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Users
 * @property \Cake\ORM\Association\HasMany $Employees
 * @property \Cake\ORM\Association\HasMany $Outsourceds
 * @property \Cake\ORM\Association\HasMany $PersonEmails
 * @property \Cake\ORM\Association\HasMany $Students
 */
class PersonsTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->table('persons');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
            'className' => 'Audit.Users'
        ]);
        $this->hasMany('Employees', [
            'foreignKey' => 'person_id',
            'className' => 'Audit.Employees'
        ]);
        $this->hasMany('Outsourceds', [
            'foreignKey' => 'person_id',
            'className' => 'Audit.Outsourceds'
        ]);
        $this->hasMany('PersonEmails', [
            'foreignKey' => 'person_id',
            'className' => 'Audit.PersonEmails'
        ]);
        $this->hasMany('Students', [
            'foreignKey' => 'person_id',
            'className' => 'Audit.Students'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->uuid('id')
            ->allowEmpty('id', 'create');

        $validator
            ->requirePresence('cpf', 'create')
            ->notEmpty('cpf');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['user_id'], 'Users'));
        return $rules;
    }
}
