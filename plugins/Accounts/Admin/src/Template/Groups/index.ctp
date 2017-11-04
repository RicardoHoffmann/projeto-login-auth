<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __d('Accounts/admin', 'Actions') ?></li>
        <li><?= $this->Html->link(__d('Accounts/admin', 'New Group'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="groups index large-9 medium-8 columns content">
    <h3><i class="fi-torsos-all"></i>&nbsp;<?= __d('Accounts/admin', 'Groups') ?></h3>
    <?php

        echo $this->Form->create();
        echo $this->Form->input('name', ['label' => '', 'placeholder' => __d('Accounts/admin', 'Query by Name')]);
        echo $this->Form->button(__d('Accounts/admin', 'Filter'), ['type' => 'submit']);
        echo $this->Form->end();
    ?>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('name', ['label' => __d('Accounts/admin', 'Name')]) ?></th>
                <th><?= $this->Paginator->sort('created', ['label' => __d('Accounts/admin', 'Created')]) ?></th>
                <th class="actions"><?= __d('Accounts/admin', 'Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($groups as $group): ?>
            <tr>
                <td><?= h($group->name) ?></td>
                <td><?= h($group->created) ?></td>
                <td class="actions">
                    <?= $this->Html->link('<i class="fi-plus" title="' . __d('Accounts/admin','Add Users in the Group') . '"></i>', ['action' => 'viewAddUsers', $group->id], ['escape' => false]) ?>
                    <?= $this->Html->link('<i class="fi-zoom-in" title="' . __d('Accounts/admin', 'View') . '"></i>', ['action' => 'view', $group->id], ['escape' => false]) ?>
                    <?= $this->Html->link('<i class="fi-pencil" title="' . __d('Accounts/admin', 'Edit') . '"></i>', ['action' => 'edit', $group->id], ['escape' => false]) ?>
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
</div>
