<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __d('SignUp/employee', 'Actions') ?></li>
        <li><?= $this->Html->link(__d('SignUp/employee', 'New User'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__d('SignUp/employee', 'List Social Accounts'), ['controller' => 'SocialAccounts', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__d('SignUp/employee', 'New Social Account'), ['controller' => 'SocialAccounts', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="users index large-9 medium-8 columns content">
    <h3><?= __d('SignUp/employee', 'Validations') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('username', array('label'=>__d('SignUp/employee', 'Username'))) ?></th>
                <th><?= $this->Paginator->sort('first_name', array('label'=>__d('SignUp/employee', 'First Name'))) ?></th>
                <th><?= $this->Paginator->sort('last_name', array('label'=>__d('SignUp/employee', 'Last Name'))) ?></th>
                <th><?= $this->Paginator->sort('role', array('label'=>__d('SignUp/employee', 'Role'))) ?></th>
                <th><?= $this->Paginator->sort('created', array('label'=>__d('SignUp/employee', 'Created'))) ?></th>
                <th class="actions"><?= __d('SignUp/employee', 'Validation') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
            <tr>
                <td><?= h($user->username) ?></td>
                <td><?= h($user->first_name) ?></td>
                <td><?= h($user->last_name) ?></td>
                <td><?= h($user->role) ?></td>
                <td><?= h($user->created) ?></td>
                <td class="actions">
                    <?= $this->Form->postLink(__d('SignUp/employee', 'Accept'), ['action' => 'accept', $user->id], ['confirm' => __d('SignUp/employee', 'Accept request?')]) ?>

                    <?= $this->Form->postLink(__d('SignUp/employee', 'Reject'), ['action' => 'reject', $user->id], ['confirm' => __d('SignUp/employee', 'Reject request?')]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __d('SignUp/employee', 'previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__d('SignUp/employee', 'next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
