<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <?= $this->element('audit-menu') ?>
    </ul>
</nav>
<div class="users view large-9 medium-8 columns content">
    <h3><?= h($user->username) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __d('Audit','Id') ?></th>
            <td><?= h($user->id) ?></td>
        </tr>
        <tr>
            <th><?= __d('Audit','Username') ?></th>
            <td><?= h($user->username) ?></td>
        </tr>
        <tr>
            <th><?= __d('Audit','Email') ?></th>
            <td><?= h($user->email) ?></td>
        </tr>
        <tr>
            <th><?= __d('Audit','First Name') ?></th>
            <td><?= h($user->first_name) ?></td>
        </tr>
        <tr>
            <th><?= __d('Audit','Last Name') ?></th>
            <td><?= h($user->last_name) ?></td>
        </tr>
        <tr>
            <th><?= __d('Audit','Role') ?></th>
            <td><?= h($user->role) ?></td>
        </tr>
        <tr>
            <th><?= __d('Audit','Activation Date') ?></th>
            <td><?= h($user->activation_date) ?></td>
        </tr>
        <tr>
            <th><?= __d('Audit','Created') ?></th>
            <td><?= h($user->created) ?></td>
        </tr>
        <tr>
            <th><?= __d('Audit','Modified') ?></th>
            <td><?= h($user->modified) ?></td>
        </tr>
        <tr>
            <th><?= __d('Audit','Active') ?></th>
            <td><?= $user->active ? __d('Audit','Yes') : __d('Audit','No'); ?></td>
        </tr>
        <tr>
            <th><?= __d('Audit','Is Superuser') ?></th>
            <td><?= $user->is_superuser ? __d('Audit','Yes') : __d('Audit','No'); ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __d('Audit','Related Profile') ?></h4>
        <?php if (!empty($user->persons)): ?>
            <table cellpadding="0" cellspacing="0">
                <tr>
                    <th><?= __d('Audit','Category') ?></th>
                    <th><?= __d('Audit','CPF') ?></th>
                </tr>
                <?php foreach ($user->persons as $persons): ?>
                    <?php foreach ($persons->employees as $employee): ?>
                        <tr>
                            <td><?= __d('Audit','Employee') ?></td>
                            <td><?= h($persons->cpf) ?></td>
                        </tr>
                    <?php endforeach; ?>
                    <?php foreach ($persons->outsourceds as $outsourced): ?>
                        <tr>
                            <td><?= __d('Audit','Outsourced') ?></td>
                            <td><?= h($persons->cpf) ?></td>
                        </tr>
                    <?php endforeach; ?>
                    <?php foreach ($persons->students as $student): ?>
                        <tr>
                            <td><?= __d('Audit','Student') ?></td>
                            <td><?= h($persons->cpf) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endforeach; ?>
            </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __d('Audit','Related Audit Logs') ?></h4>
        <?php if (!empty($user->audit_logs)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th style="width: 10%"><?= __d('Audit','Timestamp') ?></th>
                <th style="width: 10%"><?= __d('Audit','Type') ?></th>
                <th style="width: 10%"><?= __d('Audit','IP') ?></th>
                <th style="width: 50%"><?= __d('Audit','URL') ?></th>
                <th style="width: 10%"><?= __d('Audit','Browser') ?></th>
                <th class="actions" style="width: 10%"><?= __d('Audit','Actions') ?></th>
            </tr>
            <?php foreach ($user->audit_logs as $auditLogs): ?>
            <tr>
                <td><?= h($auditLogs->timestamp) ?></td>
                <td><?= h($auditLogs->type) ?></td>
                <td><?= h($auditLogs->ip) ?></td>
                <td><?= h($auditLogs->url) ?></td>
                <td><?= h(substr(strrchr($auditLogs->browser, " "), 1)) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__d('Audit','View'), ['controller' => 'AuditLogs', 'action' => 'view', $auditLogs->id]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __d('Audit','Related User Access Logs') ?></h4>
        <?php if (!empty($user->user_access_logs)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th style="width: 15%"><?= __d('Audit','Created') ?></th>
                <th style="width: 15%"><?= __d('Audit','IP') ?></th>
                <th style="width: 70%"><?= __d('Audit','Browser') ?></th>
            </tr>
            <?php foreach ($user->user_access_logs as $userAccessLogs): ?>
            <tr>
                <td><?= h($userAccessLogs->created) ?></td>
                <td><?= h($userAccessLogs->ipv4_address) ?></td>
                <td><?= h(substr(strrchr($userAccessLogs->browser, " "), 1)) ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
