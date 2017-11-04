<?php
namespace Accounts\Authz\Model\Entity;

use Cake\ORM\Entity;

/**
 * SimpleRbacGroup Entity
 *
 * @property string $id
 * @property string $group_id
 * @property string $prefix
 * @property string $plugin
 * @property string $controller
 * @property string $action
 * @property bool $allowed
 *
 * @property \Accounts\Authz\Model\Entity\Group $group
 */
class SimpleRbacGroup extends Entity
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
        'id' => false
    ];
}
