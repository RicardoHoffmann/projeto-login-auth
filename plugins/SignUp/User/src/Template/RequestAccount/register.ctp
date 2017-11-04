<?php
/**
 * Copyright 2010 - 2015, Cake Development Corporation (http://cakedc.com)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright 2010 - 2015, Cake Development Corporation (http://cakedc.com)
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
use Cake\Core\Configure;
$this->layout = 'sign_up';
?>
<nav class="show-for-large large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __d('SignUp/user', 'Actions') ?></li>
        <li><?= $this->Html->link(__d('SignUp/user', 'Login'), [
                'plugin' => 'Accounts/Auth', 'controller' => 'Users', 'action' => 'login'])
            ?></li>
    </ul>
</nav>
<div class="validates form large-9 medium-8 columns content">
    <h3><?= __d('SignUp/user', 'Sign Up for User') ?></h3>
    <?= $this->Form->create($user); ?>
    <fieldset>
        <legend><?= __d('SignUp/user', 'Register Account') ?></legend>
        <?php
        echo $this->Form->input('first_name', ['label' => __d('SignUp/user', 'First Name')]);
        echo $this->Form->input('last_name', ['label' => __d('SignUp/user', 'Last Name')]);
        echo $this->Form->input('username', ['label' => __d('SignUp/user', 'Username')]);
        echo $this->Form->input('email', array('label' => __d('SignUp/user', 'E-mail')));
        echo $this->Form->input('password', array('label' => __d('SignUp/user', 'Password')));
        echo $this->Form->input('password_confirm', ['type' => 'password', 'label' => __d('SignUp/user', 'Password Confirm')]);

        if (Configure::read('Users.Tos.required')) {
            echo $this->Form->input('tos', ['type' => 'checkbox', 'label' => __d('SignUp/user', 'Accept TOS conditions?'), 'required' => true]);
        }
        if (Configure::read('Users.reCaptcha.registration')) {
            echo $this->User->addReCaptcha();
        }
        ?>
    </fieldset>
    <?= $this->Form->button(__d('SignUp/user', 'Submit')) ?>
    <?= $this->Form->end() ?>
</div>
