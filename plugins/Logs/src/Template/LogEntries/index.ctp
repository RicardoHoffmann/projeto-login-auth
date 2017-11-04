<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __d('logs', 'Actions') ?></li>
        <li><?= $this->Html->link(__d('logs', 'Home'), ['plugin' => null, 'controller' => 'pages','action' => 'home']) ?></li>
    </ul>
</nav>
<div class="logs index large-9 medium-8 columns content">
    <h3><?= __('Logs') ?></h3>
    <h3 style="font-size: 14pt"><?=__d('logs', 'Filter by level') ?></h3>
    <?php
        echo $this->Form->create();
        echo $this->Form->select('level', [
            '' => __d('logs', 'All Levels'),
            'alert' => 'Alert',
            'critical' => 'Critical',
            'debug' => 'Debug',
            'emergency' => 'Emergency',
            'error' => 'Error',
            'info' => 'Info',
            'notice' => 'Notice',
            'warning' => 'Warning',
        ]);
        echo $this->Form->button(__d('Accounts/admin', 'Filter'), ['type' => 'submit']);
        echo $this->Form->end();
    ?>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('level', ['label' => __d('logs', 'Level')]) ?></th>
                <th scope="col"><?= $this->Paginator->sort('created', ['label' => __d('logs', 'Created')]) ?></th>
                <th scope="col" class="actions"><?= __d('logs', 'Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($logs as $log): ?>
            <tr>
                <td><?= h($log->level) ?></td>
                <td><?= h($log->created) ?></td>
                <td class="actions">
                    <?= $this->Html->link('<i class="fi-zoom-in" title="' . __d('logs', 'View More') . '"></i>', ['action' => 'view', $log->id], ['escape' => false]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __d('logs', 'previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__d('logs', 'next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
