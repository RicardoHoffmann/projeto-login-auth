<?php
namespace Shopping\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Products Model
 *
 * @method \Shopping\Model\Entity\Product get($primaryKey, $options = [])
 * @method \Shopping\Model\Entity\Product newEntity($data = null, array $options = [])
 * @method \Shopping\Model\Entity\Product[] newEntities(array $data, array $options = [])
 * @method \Shopping\Model\Entity\Product|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Shopping\Model\Entity\Product patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \Shopping\Model\Entity\Product[] patchEntities($entities, array $data, array $options = [])
 * @method \Shopping\Model\Entity\Product findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ProductsTable extends Table
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

        $this->setTable('products');
        $this->setDisplayField('name');

        $this->addBehavior('Timestamp');
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
            ->requirePresence('id', 'create')
            ->notEmpty('id');

        $validator
            ->scalar('name')
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        $validator
            ->decimal('price')
            ->requirePresence('price', 'create')
            ->notEmpty('price');

        $validator
            ->scalar('description')
            ->requirePresence('description', 'create')
            ->allowEmpty('description');

        $validator
            ->scalar('image')
            ->requirePresence('image', 'create')
            ->notEmpty('image');

        return $validator;
    }
}
