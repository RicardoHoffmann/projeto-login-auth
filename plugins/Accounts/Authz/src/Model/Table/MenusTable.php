<?php
namespace Accounts\Authz\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Accounts\Authz\Model\Entity\Menu;
use Cake\Utility\Inflector;

/**
 * Menus Model
 *
 * @property \Cake\ORM\Association\BelongsTo $ParentMenus
 * @property \Cake\ORM\Association\BelongsTo $Actions
 * @property \Cake\ORM\Association\HasMany $ChildMenus
 */
class MenusTable extends Table
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

        $this->table('menus');
        $this->displayField('name');
        $this->primaryKey('id');
        
        $this->addBehavior('AuditStash.AuditLog');
        $this->addBehavior('Tree', [
            'recoverOrder' => ['name' => 'ASC'],
        ]);

        $this->belongsTo('ParentMenus', [
            'className' => 'Menu.Menus',
            'foreignKey' => 'parent_id'
        ]);
        $this->hasMany('ChildMenus', [
            'className' => 'Menu.Menus',
            'foreignKey' => 'parent_id'
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
            ->allowEmpty('id', 'create');

        $validator
            ->integer('lft')
            ->allowEmpty('lft');

        $validator
            ->integer('rght')
            ->allowEmpty('rght');

        $validator
            ->allowEmpty('name');

        $validator
            ->allowEmpty('external_url');

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
        $rules->add($rules->existsIn(['parent_id'], 'ParentMenus'));
        return $rules;
    }

    public function beforeSave($event, $entity, $options)
    {
        $entity->plugin = str_replace('-', '/', $entity->plugin);
        $entity->controller = str_replace('-', '/', $entity->controller);
        $entity->action = str_replace('-', '/', $entity->action);
    }
}
