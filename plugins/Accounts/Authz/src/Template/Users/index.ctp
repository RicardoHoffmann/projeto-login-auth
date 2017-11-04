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
        <li class="heading"><?= __d('Accounts/authz', 'Actions') ?></li>
        <li><?= $this->Html->link(__d('Accounts/authz', 'Home'), ['plugin' => false, 'controller' => 'pages', 'action' => 'display']) ?></li>

    </ul>
</nav>
<div class="auditLogs index large-9 medium-8 columns content">
    <h3><i class="fi-torsos-female-male"></i>&nbsp;<?= __d('Accounts/authz','Permissions') ?></h3>
    <?php
        echo $this->Form->create();
        echo $this->Form->input('username', ['label' => '', 'placeholder' => __d('Accounts/authz','Query by Username, First or Last name')]);
        echo $this->Form->button(__d('Accounts/authz', 'Filter'), ['type' => 'submit']);
        echo $this->Form->end();
    ?>
    <table cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('first_name', ['label' => __d('Accounts/authz','Full Name')]) ?></th>
            <th><?= $this->Paginator->sort('username', ['label' => __d('Accounts/authz','Username')]) ?></th>
            <th><?= $this->Paginator->sort('email', ['label' => __d('Accounts/authz','Email')]) ?></th>
            <th class="actions"><?= __d('Accounts/authz','Users', 'Actions') ?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($Users as $user):
            $status = '';
            if ($user->active == false) {
                $status = '&nbsp;<i class="fi-prohibited" title="' . __d('Accounts/authz','Disable') . '"></i>';
            }
        ?>
        <tr>
            <td><?= h($user->first_name . ' ' . $user->last_name) ?></td>
            <td><?= h($user->username) . $status ?></td>
            <td><?= h($user->email) ?></td>
            <td class="actions">
                <?= $this->Html->link('<i class="fi-check" title="' . __d('Accounts/authz','Authorization') . '"></i>', ['action' => 'authorization', $user->id], ['escape' => false]) ?>
                <?= $this->Html->link('<i class="fi-zoom-in" title="' . __d('Accounts/authz','View') . '"></i>', ['action' => 'view', $user->id], ['escape' => false]) ?>
            </td>
        </tr>

    <?php endforeach; ?>
    </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __d('Accounts/authz', 'previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__d('Accounts/authz', 'next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
