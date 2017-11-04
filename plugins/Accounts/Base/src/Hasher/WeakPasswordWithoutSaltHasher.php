<?php
/**
 * Created by PhpStorm.
 * User: maicon
 * Date: 24/05/16
 * Time: 11:04
 */

namespace Accounts\Base\Hasher;

use Cake\Core\Configure;
use Cake\Error\Debugger;
use Cake\Utility\Security;
use Cake\Auth\WeakPasswordHasher;

class WeakPasswordWithoutSaltHasher extends WeakPasswordHasher
{
    /**
     * Generates password hash.
     *
     * @param string $password Plain text password to hash.
     * @return string Password hash
     */
    public function hash($password)
    {
        return Security::hash($password, $this->_config['hashType'], false);
    }
}