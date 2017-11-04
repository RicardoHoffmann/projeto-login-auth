<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__d('Accounts/admin', 'List Groups'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__d('Accounts/admin', 'List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__d('Accounts/admin', 'New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="groups form large-9 medium-8 columns content">
    <?= $this->Form->create($group) ?>
    <fieldset>
        <legend><?= __d('Accounts/admin', 'Add Group') ?></legend>
        <?php
         echo $this->Form->input('name', ['label' => __d('Accounts/admin', 'Name')]);
        ?>
    </fieldset>
    <?= $this->Form->button(__d('Accounts/admin', 'Submit')) ?>
    <?= $this->Form->end() ?>
</div>
