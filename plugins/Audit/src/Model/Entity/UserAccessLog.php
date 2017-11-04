<?php
namespace Audit\Model\Entity;

use Cake\ORM\Entity;

/**
 * UserAccessLog Entity.
 *
 * @property string $id
 * @property string $user_id
 * @property \Audit\Model\Entity\User $user
 * @property string $user_name
 * @property string $ipv4_address
 * @property string $browser
 * @property \Cake\I18n\Time $created
 */
class UserAccessLog extends Entity
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
        'id' => false,
    ];
}
