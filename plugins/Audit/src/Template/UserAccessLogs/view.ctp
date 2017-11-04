<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <?= $this->element('audit-menu') ?>
    </ul>
</nav>
<div class="userAccessLogs view large-9 medium-8 columns content">
    <h3><?= h($userAccessLog->user->username . ' @ ' . $userAccessLog->created) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __d('Audit','Id') ?></th>
            <td><?= h($userAccessLog->id) ?></td>
        </tr>
        <tr>
            <th><?= __d('Audit','User') ?></th>
            <td><?= $userAccessLog->has('user') ? $this->Html->link($userAccessLog->user->username, ['controller' => 'Users', 'action' => 'view', $userAccessLog->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __d('Audit','IPv4 Address') ?></th>
            <td><?= h($userAccessLog->ipv4_address) ?></td>
        </tr>
        <tr>
            <th><?= __d('Audit','Browser') ?></th>
            <td><?= h($userAccessLog->browser) ?></td>
        </tr>
        <tr>
            <th><?= __d('Audit','Created') ?></th>
            <td><?= h($userAccessLog->created) ?></td>
        </tr>
    </table>
</div>
