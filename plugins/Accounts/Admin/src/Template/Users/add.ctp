<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __d('Accounts/admin', 'Actions') ?></li>
        <li><?= $this->Html->link(__d('Accounts/admin', 'List Users'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__d('Accounts/admin', 'List Audit Logs'), ['controller' => 'AuditLogs', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__d('Accounts/admin', 'New Audit Log'), ['controller' => 'AuditLogs', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__d('Accounts/admin', 'List Persons'), ['controller' => 'Persons', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__d('Accounts/admin', 'New Person'), ['controller' => 'Persons', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__d('Accounts/admin', 'List Social Accounts'), ['controller' => 'SocialAccounts', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__d('Accounts/admin', 'New Social Account'), ['controller' => 'SocialAccounts', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__d('Accounts/admin', 'List User Access Logs'), ['controller' => 'UserAccessLogs', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__d('Accounts/admin', 'New User Access Log'), ['controller' => 'UserAccessLogs', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="users form large-9 medium-8 columns content">
    <?= $this->Form->create($user) ?>
    <fieldset>
        <legend><?= __d('Accounts/admin', 'Add User') ?></legend>
        <?php
            echo $this->Form->input('username', ['label' => __d('Accounts/admin', 'Username')]);
            echo $this->Form->input('email', ['label' => __d('Accounts/admin', 'Email')]);
            echo $this->Form->input('password', ['label' => __d('Accounts/admin', 'Password')]);
            echo $this->Form->input('first_name', ['label' => __d('Accounts/admin', 'First Name')]);
            echo $this->Form->input('last_name', ['label' => __d('Accounts/admin', 'Last Name')]);
            echo $this->Form->input('token', ['label' => __d('Accounts/admin', 'Token')]);
            echo $this->Form->input('token_expires', ['empty' => true, 'label' => __d('Accounts/admin', 'Token Expires')]);
            echo $this->Form->input('api_token');
            echo $this->Form->input('activation_date', ['empty' => true, 'label' => __d('Accounts/admin', 'Activation Date')]);
            echo $this->Form->input('tos_date', ['empty' => true]);
            echo $this->Form->input('active', ['label' => __d('Accounts/admin', 'Active')]);
            echo $this->Form->input('is_superuser', ['label' => __d('Accounts/admin', 'Is Superuser')]);
            echo $this->Form->input('role', ['label' => __d('Accounts/admin', 'Role')]);
        ?>
    </fieldset>
    <?= $this->Form->button(__d('Accounts/admin', 'Submit')) ?>
    <?= $this->Form->end() ?>
</div>
