<?php
namespace Accounts\Authz\Model\Entity;

use Cake\ORM\Entity;

/**
 * Menu Entity.
 *
 * @property string $id
 * @property string $parent_id
 * @property \Menu\Model\Entity\ParentMenu $parent_menu
 * @property int $lft
 * @property int $rght
 * @property string $name
 * @property string $action_id
 * @property \Menu\Model\Entity\Action $action
 * @property string $external_url
 * @property \Menu\Model\Entity\ChildMenu[] $child_menus
 */
class Menu extends Entity
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
