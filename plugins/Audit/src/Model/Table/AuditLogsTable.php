<?php
namespace Audit\Model\Table;

use Audit\Model\Entity\AuditLog;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use DateTime;
use DateTimeZone;
use Cake\I18n\FrozenTime;
use Cake\I18n\Time;
use Search\Manager;

/**
 * AuditLogs Model
 *
 */
class AuditLogsTable extends Table
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

        $this->table('audit_logs');
        $this->displayField('timestamp');
        $this->primaryKey('id');

        $this->belongsTo('Users');

        $this->addBehavior('Search.Search');

        $this->searchManager()
            ->add('author_id', 'Search.Value')
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
                    return $query->andWhere(["AuditLogs.timestamp >=" => $brDateTime->i18nFormat('yyyy-MM-dd HH:mm:ss')]);
                }
            ])
            ->add('q', 'Search.Callback', [
                'callback' => function ($query, $args, $manager) {
                    $pieces = explode(' ', trim($args['q']));
                    foreach ($pieces as $value) {
                        $query->where([
                                'and' => ['or' => [
                                    "AuditLogs.transaction LIKE" => "%$value%",
                                    "AuditLogs.type LIKE" => "%$value%",
                                    "AuditLogs.primary_key LIKE" => "%$value%",
                                    "AuditLogs.source LIKE" => "%$value%",
                                    "AuditLogs.parent_source LIKE" => "%$value%",
                                    "AuditLogs.changed LIKE" => "%$value%",
                                    "AuditLogs.ip LIKE" => "%$value%",
                                    "AuditLogs.url LIKE" => "%$value%",
                                    "AuditLogs.user_id LIKE" => "%$value%",
                                    "AuditLogs.browser LIKE" => "%$value%"
                                ]]
                            ]
                        );
                    }
                }
            ]);
    }

    public function beforeSave($event, $entity, $options)
    {
        $entity->timestamp = $this->databaseTimestamp($entity['@timestamp']);
        $entity->changed = json_encode($entity->changed);
        $entity->ip = (isset($entity->meta['ip']) ? $entity->meta['ip'] : null);
        $entity->url = (isset($entity->meta['url']) ? $entity->meta['url'] : null);
        $entity->user_id = (isset($entity->meta['user']) ? $entity->meta['user'] : null);
        $entity->browser = (isset($entity->meta['browser']) ? $entity->meta['browser'] : null);
    }

    private function databaseTimestamp($timestamp)
    {
        $raw = $timestamp;
        $fuso_gmt = new DateTimeZone('GMT');
        $fuso_sp  = new DateTimeZone('America/Sao_paulo');
        $d = new DateTime($raw, $fuso_gmt);
        $d->setTimeZone($fuso_sp);
        return $d->format('Y-m-d H:i:s');
    }
}