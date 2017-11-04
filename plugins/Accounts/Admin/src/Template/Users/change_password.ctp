<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __d('Accounts/admin', 'Actions') ?></li>
        <li><?= $this->Html->link(__d('Accounts/admin', 'List Users'), ['action' => 'index']) ?> </li>
    </ul>
</nav>
<div class="users form large-9 medium-8 columns content">
    <h3><?= $user->name ?></h3>
    <?= $this->Flash->render('auth') ?>
    <?= $this->Form->create($user) ?>
    <fieldset>
        <legend><?= __d('Accounts/admin', 'Please enter the new password for \'' . $user->username . '\'') ?></legend>
        <?php if ($validatePassword) : ?>
            <?= $this->Form->input('current_password', [
                    'type' => 'password',
                    'required' => true,
                    'label' => __d('Accounts/admin', 'Current password')]);
            ?>
        <?php endif; ?>
        <?= $this->Form->input('password', ['label' => __d('Accounts/admin', 'Password')]); ?>
        <?= $this->Form->input('password_confirm', ['type' => 'password', 'required' => true, 'label' => __d('Accounts/admin', 'Password Confirm')]); ?>

    </fieldset>
    <?= $this->Form->button(__d('Accounts/admin', 'Submit')); ?>
    <?= $this->Form->end() ?>
</div>