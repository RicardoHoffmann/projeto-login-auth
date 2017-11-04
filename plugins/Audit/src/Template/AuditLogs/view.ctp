<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <?= $this->element('audit-menu') ?>
    </ul>
</nav>
<div class="auditLogs view large-9 medium-8 columns content">
    <h3><?= h($auditLog->timestamp) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __d('Audit','Id') ?></th>
            <td><?= h($auditLog->id) ?></td>
        </tr>
        <tr>
            <th><?= __d('Audit','Transaction') ?></th>
            <td><?= h($auditLog->transaction) ?></td>
        </tr>
        <tr>
            <th><?= __d('Audit','Type') ?></th>
            <td><?= h($auditLog->type) ?></td>
        </tr>
        <tr>
            <th><?= __d('Audit','Primary Key') ?></th>
            <td><?= h($auditLog->primary_key) ?></td>
        </tr>
        <tr>
            <th><?= __d('Audit','Source') ?></th>
            <td><?= h($auditLog->source) ?></td>
        </tr>
        <tr>
            <th><?= __d('Audit','Parent Source') ?></th>
            <td><?= h($auditLog->parent_source) ?></td>
        </tr>
        <tr>
            <th><?= __d('Audit','IP') ?></th>
            <td><?= h($auditLog->ip) ?></td>
        </tr>
        <tr>
            <th><?= __d('Audit','URL') ?></th>
            <td><?= h($auditLog->url) ?></td>
        </tr>
        <tr>
            <th><?= __d('Audit','User') ?></th>
            <td><?= $auditLog->has('user') ? $this->Html->link($auditLog->user->username, ['controller' => 'Users', 'action' => 'view', $auditLog->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __d('Audit','Browser') ?></th>
            <td><?= h($auditLog->browser) ?></td>
        </tr>
        <tr>
            <th><?= __d('Audit','Timestamp') ?></th>
            <td><?= h($auditLog->timestamp) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __d('Audit','Changed') ?></h4>
        <pre><?php print_r(json_decode($auditLog->changed, true)); ?></pre>
    </div>
</div>
