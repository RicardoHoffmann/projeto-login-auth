<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __d('logs', 'Actions') ?></li>
        <li><?= $this->Html->link(__d('logs', 'List Logs'), ['action' => 'index']) ?> </li>
    </ul>
</nav>
<div class="logs view large-9 medium-8 columns content">
    <h3><?= h($log->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __d('logs', 'Id') ?></th>
            <td><?= h($log->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __d('logs', 'Level') ?></th>
            <td><?= h($log->level) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __d('logs', 'Created') ?></th>
            <td><?= h($log->created) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __d('logs', 'Message') ?></h4>
        <small>
            <?= $this->Text->autoParagraph(h($log->message)); ?>
        </small>
    </div>
</div>
