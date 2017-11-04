<?php
$this->layout = 'sign_up';
?>

<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __d('Accounts/auth','Actions') ?></li>
        <li><?= $this->Html->link(__d('Accounts/auth','Login'), [
                'plugin' => 'Accounts/Auth', 'controller' => 'Users', 'action' => 'login'])
            ?></li>
    </ul>
</nav>

<div class="validates form large-9 medium-8 columns content">
    <div class="users form">
        <?= $this->Flash->render('auth') ?>
        <?= $this->Form->create($user) ?>
        <fieldset>
            <legend><?= __d('Accounts/auth', 'Please enter the new password') ?></legend>
            <?php if ($validatePassword) : ?>
                <?= $this->Form->input('current_password', [
                        'type' => 'password',
                        'required' => true,
                        'label' => __d('Accounts/auth', 'Current password')]);
                ?>
            <?php endif; ?>
            <?= $this->Form->input('password'); ?>
            <?= $this->Form->input('password_confirm', ['type' => 'password', 'required' => true]); ?>

        </fieldset>
        <?= $this->Form->button(__d('Accounts/auth', 'Submit')); ?>
        <?= $this->Form->end() ?>
    </div>
</div>