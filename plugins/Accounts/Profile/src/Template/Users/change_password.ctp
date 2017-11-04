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
        <legend><?= __d('Accounts/profile', 'Please enter the new password') ?></legend>
        <?php if ($validatePassword) : ?>
            <?= $this->Form->input('current_password', [
                    'type' => 'password',
                    'required' => true,
                    'label' => __d('Accounts/profile', 'Current password')]);
            ?>
        <?php endif; ?>
        <?= $this->Form->input('password', ['label' => __d('Accounts/profile', 'Password')]); ?>
        <?= $this->Form->input('password_confirm', ['type' => 'password', 'required' => true, 'label' => __d('Accounts/profile', 'Password Confirm')]); ?>

    </fieldset>
    <?= $this->Form->button(__d('Accounts/profile', 'Submit')); ?>
    <?= $this->Form->end() ?>
</div>