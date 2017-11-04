<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __d('Audit','Actions') ?></li>
        <li><?= $this->Html->link(__d('Audit','New User'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__d('Audit','List Audit Logs'), ['controller' => 'AuditLogs', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__d('Audit','New Audit Log'), ['controller' => 'AuditLogs', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__d('Audit','List Persons'), ['controller' => 'Persons', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__d('Audit','New Person'), ['controller' => 'Persons', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__d('Audit','List Social Accounts'), ['controller' => 'SocialAccounts', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__d('Audit','New Social Account'), ['controller' => 'SocialAccounts', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__d('Audit','List User Access Logs'), ['controller' => 'UserAccessLogs', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__d('Audit','New User Access Log'), ['controller' => 'UserAccessLogs', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="users index large-9 medium-8 columns content">
    <h3><?= __('Users') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id', ['label' => __d('Audit', 'IP')]) ?></th>
                <th><?= $this->Paginator->sort('username', ['label' => __d('Audit', 'username')]) ?></th>
                <th><?= $this->Paginator->sort('email', ['label' => __d('Audit', 'email')]) ?></th>
                <th><?= $this->Paginator->sort('password', ['label' => __d('Audit', 'password')]) ?></th>
                <th><?= $this->Paginator->sort('first_name', ['label' => __d('Audit', 'first_name')]) ?></th>
                <th><?= $this->Paginator->sort('last_name', ['label' => __d('Audit', 'last_name')]) ?></th>
                <th><?= $this->Paginator->sort('token', ['label' => __d('Audit', 'token')]) ?></th>
                <th><?= $this->Paginator->sort('token_expires', ['label' => __d('Audit', 'token_expires')]) ?></th>
                <th><?= $this->Paginator->sort('api_token', ['label' => __d('Audit', 'api_token')]) ?></th>
                <th><?= $this->Paginator->sort('activation_date', ['label' => __d('Audit', 'activation_date')]) ?></th>
                <th><?= $this->Paginator->sort('tos_date', ['label' => __d('Audit', 'tos_date')]) ?></th>
                <th><?= $this->Paginator->sort('active', ['label' => __d('Audit', 'active')]) ?></th>
                <th><?= $this->Paginator->sort('is_superuser', ['label' => __d('Audit', 'is_superuser')]) ?></th>
                <th><?= $this->Paginator->sort('role', ['label' => __d('Audit', 'role')]) ?></th>
                <th><?= $this->Paginator->sort('created', ['label' => __d('Audit', 'created')]) ?></th>
                <th><?= $this->Paginator->sort('modified', ['label' => __d('Audit', 'modified')]) ?></th>
                <th class="actions"><?= __d('Audit','Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
            <tr>
                <td><?= h($user->id) ?></td>
                <td><?= h($user->username) ?></td>
                <td><?= h($user->email) ?></td>
                <td><?= h($user->password) ?></td>
                <td><?= h($user->first_name) ?></td>
                <td><?= h($user->last_name) ?></td>
                <td><?= h($user->token) ?></td>
                <td><?= h($user->token_expires) ?></td>
                <td><?= h($user->api_token) ?></td>
                <td><?= h($user->activation_date) ?></td>
                <td><?= h($user->tos_date) ?></td>
                <td><?= h($user->active) ?></td>
                <td><?= h($user->is_superuser) ?></td>
                <td><?= h($user->role) ?></td>
                <td><?= h($user->created) ?></td>
                <td><?= h($user->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__d('Audit','View'), ['action' => 'view', $user->id]) ?>
                    <?= $this->Html->link(__d('Audit','Edit'), ['action' => 'edit', $user->id]) ?>
                    <?= $this->Form->postLink(__d('Audit','Delete'), ['action' => 'delete', $user->id], ['confirm' => 'Are you sure you want to delete # {0}?', $user->id]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __d('Audit','previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__d('Audit','next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
