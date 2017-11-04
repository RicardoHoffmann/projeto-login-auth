<?php
namespace Audit\Model\Entity;

use Cake\ORM\Entity;

/**
 * AuditLog Entity.
 *
 * @property int $timestamp
 * @property string $transaction
 * @property string $type
 * @property string $primary_key
 * @property string $source
 * @property string $parent_source
 * @property string $changed
 * @property string $meta
 */
class AuditLog extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        '*' => true,
        'timestamp' => false,
    ];
}
