<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __d('Accounts/profile', 'Actions') ?></li>
        <li><?= $this->Html->link(__d('Accounts/profile', 'My Profile'), ['plugin' => 'Accounts/Profile', 'controller' => 'Users', 'action' => 'index']) ?> </li>
    </ul>
</nav>
<div class="users form large-9 medium-8 columns content">
    <?= $this->Flash->render('auth') ?>
    <?= $this->Form->create($user) ?>
    <fieldset>
        <legend><?= __d('Accounts/profile', 'Please enter the new E-mail') ?></legend>
        <?= $this->Form->input('email', ['label' => __d('Accounts/profile', 'E-mail'), 'required' => true]); ?>
    </fieldset>
    <?= $this->Form->button(__d('Accounts/profile', 'Save')); ?>
    <?= $this->Form->end() ?>
</div>