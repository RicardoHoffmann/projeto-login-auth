<?php
namespace Audit\Model\Table;

use Audit\Model\Entity\UserAccessLog;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\I18n\Time;

/**
 * UserAccessLogs Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Users
 */
class UserAccessLogsTable extends Table
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

        $this->table('user_access_logs');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');
        $this->addBehavior('Search.Search');

        $this->searchManager()
            ->add('user', 'Search.Callback', [
                'callback' => function ($query, $args, $manager) {
                    $keyword = $args['user'];
                    return $query->where(
                        function ($exp, $q) use($keyword){
                            $conc = $q->func()->concat([
                                'Users.first_name' => 'literal',
                                '\' \'' => 'literal',
                                'Users.last_name' => 'literal']);
                            return $exp
                                ->or_([
                                    'Users.first_name LIKE' => "%$keyword%",
                                    'Users.last_name LIKE' => "%$keyword%",
                                    'Users.username LIKE' => "%$keyword%",
                                ])
                                ->like($conc, "%$keyword%");
                        }
                    );
                }
            ])
            ->add('timestamp', 'Search.Callback', [
                'callback' => function ($query, $args, $manager) {
                    $brDateTime = Time::createFromFormat(
                        'd/m/Y H:i',
                        $args['timestamp'],
                        'America/New_York'
                    );
                    return $query->andWhere(["UserAccessLogs.created >=" => $brDateTime->i18nFormat('yyyy-MM-dd HH:mm:ss')]);
                }
            ])
            ->add('q', 'Search.Callback', [
                'callback' => function ($query, $args, $manager) {
                    $pieces = explode(' ', trim($args['q']));
                    foreach ($pieces as $value) {
                        $query->where([
                                'and' => ['or' => [
                                    "UserAccessLogs.ipv4_address LIKE" => "%$value%",
                                    "UserAccessLogs.browser LIKE" => "%$value%",
                                ]]
                            ]
                        );
                    }
                }
            ]);

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
            'className' => 'Audit.Users'
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
            ->requirePresence('user_name', 'create')
            ->notEmpty('user_name');

        $validator
            ->requirePresence('ipv4_address', 'create')
            ->notEmpty('ipv4_address');

        $validator
            ->requirePresence('browser', 'create')
            ->notEmpty('browser');

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
