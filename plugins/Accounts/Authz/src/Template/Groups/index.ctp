<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__d('Accounts/authz', 'Home'), ['plugin' => false, 'controller' => 'pages', 'action' => 'display']) ?></li>
    </ul>
</nav>
<div class="groups index large-9 medium-8 columns content">
    <h3><i class="fi-torsos-all"></i>&nbsp;<?= __d('Accounts/authz','Permissions') ?></h3>
    <?php
        echo $this->Form->create();
    echo $this->Form->input('name', ['label' => '', 'placeholder' => __d('Accounts/authz','Query by Name')]);
    echo $this->Form->button(__d('Accounts/authz', 'Filter'), ['type' => 'submit']);
    echo $this->Form->end();
    ?>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('name', ['label' => __d('Accounts/authz', 'Name')]) ?></th>
                <th><?= $this->Paginator->sort('created', ['label' => __d('Accounts/authz', 'Created')]) ?></th>
                <th class="actions"><?= __d('Accounts/authz', 'Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($Groups as $group): ?>
            <tr>
                <td><?= h($group->name) ?></td>
                <td><?= h($group->created) ?></td>
                <td class="actions">
                    <?= $this->Html->link('<i class="fi-check" title="' . __d('Accounts/authz','Authorization') . '"></i>', ['action' => 'authorization', $group->id], ['escape' => false]) ?>
                    <?= $this->Html->link('<i class="fi-zoom-in" title="' . __d('Accounts/authz','View') . '"></i>', ['action' => 'view', $group->id], ['escape' => false]) ?>
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
