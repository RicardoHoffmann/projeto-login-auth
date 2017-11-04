<?php
    use Cake\Routing\Router;
?>
<style type="text/css">
    .fi-check {
        margin-right: 5px;
        cursor: pointer;
    }

    .fi-check:hover {
        color: #00aa00;
    }
</style>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __d('SignUp/user', 'Actions') ?></li>
        <li><?= $this->Html->link(__d('SignUp/user', 'Home'), ['plugin' => null, 'controller' => 'pages','action' => 'home']) ?></li>
    </ul>
</nav>
<div class="users index large-9 medium-8 columns content">
    <h3><?= __d('SignUp/user', 'Validations') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('username', array('label' =>__d('SignUp/user', 'Username'))) ?></th>
                <th><?= $this->Paginator->sort('first_name', array('label' =>__d('SignUp/user', 'First Name'))) ?></th>
                <th><?= $this->Paginator->sort('last_name', array('label' =>__d('SignUp/user', 'Last Name'))) ?></th>
                <th><?= $this->Paginator->sort('role', array('label' =>__d('SignUp/user', 'Role'))) ?></th>
                <th><?= $this->Paginator->sort('created', array('label' =>__d('SignUp/user', 'Created'))) ?></th>
                <th class="actions"><?= __d('SignUp/user', 'Validation') ?></th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($users as $user): ?>
            <tr>
                <td id="<?= $user->id?>" style="display: none"><?= h($user->id) ?></td>
                <td><?= h($user->username) ?></td>
                <td><?= h($user->first_name) ?></td>
                <td><?= h($user->last_name) ?></td>
                <td><?= h($user->role) ?></td>
                <td><?= h($user->created) ?></td>
                <td class="actions">
                    <?php $id = $user->id; ?>
                    <?= $this->Form->postLink('<i class="fi-check" style="margin-right: 5px;" title="' . __d('SignUp/user', 'Accept') . '"></i>', ['action' => 'accept', $user->id], ['confirm' => __d('SignUp/user', 'Accept request?'), 'escape' => false]) ?>
                    <?= $this->Form->postLink('<i class="fi-x" style="margin-right: 5px;" title="' . __d('SignUp/user', 'Reject') . '"></i>', ['action' => 'reject', $user->id], ['confirm' => __d('SignUp/user', 'Reject request?'), 'escape' => false]) ?>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <div id="loading"></div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __d('SignUp/user', 'previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__d('SignUp/user', 'next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>