<?php
namespace Accounts\Admin\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Groups Model
 *
 * @property \Cake\ORM\Association\HasMany $Users
 *
 * @method \Accounts\Admin\Model\Entity\Group get($primaryKey, $options = [])
 * @method \Accounts\Admin\Model\Entity\Group newEntity($data = null, array $options = [])
 * @method \Accounts\Admin\Model\Entity\Group[] newEntities(array $data, array $options = [])
 * @method \Accounts\Admin\Model\Entity\Group|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Accounts\Admin\Model\Entity\Group patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \Accounts\Admin\Model\Entity\Group[] patchEntities($entities, array $data, array $options = [])
 * @method \Accounts\Admin\Model\Entity\Group findOrCreate($search, callable $callback = null)
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class GroupsTable extends Table
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

        $this->table('groups');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');
        $this->addBehavior('AuditStash.AuditLog');
        $this->addBehavior('Search.Search');

        $this->hasMany('Users', [
            'foreignKey' => 'group_id',
            'className' => 'Accounts/Admin.Users'
        ]);

        $this->searchManager()
            ->add('name', 'Search.Callback', [
                'callback' => function ($query, $args, $manager) {
                    $pieces = explode(' ', trim($args['name']));
                    foreach ($pieces as $value) {
                        $query->where(["Groups.name LIKE" => "%$value%"]);
                    }
                }
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
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        return $validator;
    }
}
