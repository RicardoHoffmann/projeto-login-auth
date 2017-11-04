<?php
namespace Logs\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Logs Model
 *
 * @method \Logs\Model\Entity\Recorder get($primaryKey, $options = [])
 * @method \Logs\Model\Entity\Recorder newEntity($data = null, array $options = [])
 * @method \Logs\Model\Entity\Recorder[] newEntities(array $data, array $options = [])
 * @method \Logs\Model\Entity\Recorder|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Logs\Model\Entity\Recorder patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \Logs\Model\Entity\Recorder[] patchEntities($entities, array $data, array $options = [])
 * @method \Logs\Model\Entity\Recorder findOrCreate($search, callable $callback = null)
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class LogsTable extends Table
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

        $this->table('logs');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');
        $this->addBehavior('Search.Search');


        $this->searchManager()
            ->add('level', 'Search.Callback', [
                'callback' => function ($query, $args, $manager) {
                    $pieces = explode(' ', trim($args['level']));
                    foreach ($pieces as $value) {
                        $query->where(["Logs.level LIKE" => "%$value%"]);
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
            ->allowEmpty('level');

        $validator
            ->allowEmpty('message');

        return $validator;
    }
}
