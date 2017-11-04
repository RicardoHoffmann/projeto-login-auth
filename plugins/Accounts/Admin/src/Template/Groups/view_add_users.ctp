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
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __d('Accounts/admin', 'Actions') ?></li>
        <li><?= $this->Html->link(__d('Accounts/admin', 'Home'), ['plugin' => false, 'controller' => 'pages', 'action' => 'display']) ?></li>

    </ul>
</nav>
<div class="auditLogs index large-9 medium-8 columns content">
    <h4><i class="fi-torsos-female-male"></i>&nbsp;<?= __d('Accounts/admin','List Users') ?></h4>
    <?php

        echo $this->Form->create();
        echo $this->Form->input('username', ['label' => '', 'placeholder' => __d('Accounts/admin', 'Query by Username, First or Last name')]);
        echo $this->Form->button(__d('Accounts/admin', 'Filter'), ['type' => 'submit']);
        echo $this->Form->end();
      ?>
    <table cellpadding="0" cellspacing="0">
        <thead>
        <tr>
            <th><?= $this->Paginator->sort('first_name', ['label' => __d('Accounts/admin','Full Name')]) ?></th>
            <th><?= $this->Paginator->sort('username', ['label' => __d('Accounts/admin','Username')]) ?></th>
            <th><?= $this->Paginator->sort('email', ['label' => __d('Accounts/admin','Email')]) ?></th>
            <th class="actions"><?= __d('Accounts/admin', 'Actions') ?></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($Users as $user):
            $status = '';
            if ($user->active == false) {
        $status = '&nbsp;<i class="fi-prohibited" title="' . __d('Accounts/admin','Disable') . '"></i>';
        }
        ?>
        <tr>
            <td><?= h($user->first_name . ' ' . $user->last_name) ?></td>
            <td><?= h($user->username) . $status ?></td>
            <td><?= h($user->email) ?></td>
            <td class="actions">
                <?= $this->Html->link('<i class="fi-check" title="' . __d('Accounts/admin','Add in the Group') . '"></i>', ['action' => 'includeUser', $user->id], ['escape' => false]) ?>
                <?= $this->Html->link('<i class="fi-zoom-in" title="' . __d('Accounts/admin','View') . '"></i>', ['controller' => 'users', 'action' => 'view', $user->id], ['escape' => false]) ?>
            </td>
        </tr>

        <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __d('Accounts/admin', 'previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__d('Accounts/admin', 'next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>

    <h4><i class="fi-torsos-female-male"></i>&nbsp;<?= __d('Accounts/admin','User List in the Group') ?></h4>
    <table cellpadding="0" cellspacing="0">
        <?php if($usersGroup->count() != 0){ ?>
        <thead>
        <tr>
            <th><?= $this->Paginator->sort('first_name', ['label' => __d('Accounts/admin','Full Name')]) ?></th>
            <th><?= $this->Paginator->sort('username', ['label' => __d('Accounts/admin','Username')]) ?></th>
            <th><?= $this->Paginator->sort('email', ['label' => __d('Accounts/admin','Email')]) ?></th>
            <th class="actions"><?= __d('Accounts/admin', 'Actions') ?></th>
        </tr>
        </thead>
        <tbody>
        <?php
            foreach ($usersGroup as $user):
                $status = '';
                if ($user->active == false) {
            $status = '&nbsp;<i class="fi-prohibited" title="' . __d('Accounts/admin','Disable') . '"></i>';
            }
            ?>
            <tr>
                <td><?= h($user->first_name . ' ' . $user->last_name) ?></td>
                <td><?= h($user->username) . $status ?></td>
                <td><?= h($user->email) ?></td>
                <td class="actions">
                    <?= $this->Html->link('<i class="fi-x" title="' . __d('Accounts/admin','Remove from Group') . '"></i>', ['controller' => 'Groups', 'action' => 'removeUser', $user->id], ['escape' => false]) ?>
                    <?= $this->Html->link('<i class="fi-zoom-in" title="' . __d('Accounts/admin','View') . '"></i>', ['controller' => 'users', 'action' => 'view', $user->id], ['escape' => false]) ?>
                </td>
            </tr>
            <?php endforeach;
        } else {
           echo __d('Accounts/admin', 'The Group is Empty');
        } ?>

        </tbody>
    </table>
</div>
