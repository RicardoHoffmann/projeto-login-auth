<?php
namespace Accounts\Authz\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * SimpleRbacGroups Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Groups
 *
 * @method \Accounts\Authz\Model\Entity\SimpleRbacGroup get($primaryKey, $options = [])
 * @method \Accounts\Authz\Model\Entity\SimpleRbacGroup newEntity($data = null, array $options = [])
 * @method \Accounts\Authz\Model\Entity\SimpleRbacGroup[] newEntities(array $data, array $options = [])
 * @method \Accounts\Authz\Model\Entity\SimpleRbacGroup|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Accounts\Authz\Model\Entity\SimpleRbacGroup patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \Accounts\Authz\Model\Entity\SimpleRbacGroup[] patchEntities($entities, array $data, array $options = [])
 * @method \Accounts\Authz\Model\Entity\SimpleRbacGroup findOrCreate($search, callable $callback = null)
 */
class SimpleRbacGroupsTable extends Table
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

        $this->table('simple_rbac_groups');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('AuditStash.AuditLog');

        $this->belongsTo('Groups', [
            'foreignKey' => 'group_id',
            'joinType' => 'INNER',
            'className' => 'Accounts/Authz.Groups'
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
            ->allowEmpty('prefix');

        $validator
            ->allowEmpty('plugin');

        $validator
            ->requirePresence('controller', 'create')
            ->notEmpty('controller');

        $validator
            ->requirePresence('action', 'create')
            ->notEmpty('action');

        $validator
            ->boolean('allowed')
            ->requirePresence('allowed', 'create')
            ->notEmpty('allowed');

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
        $rules->add($rules->existsIn(['group_id'], 'Groups'));

        return $rules;
    }
}
