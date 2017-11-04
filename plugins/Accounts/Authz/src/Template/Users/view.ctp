<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __d('Accounts/authz','Actions') ?></li>
        <li><?= $this->Html->link(__d('Accounts/authz','List Users'), ['action' => 'index']) ?> </li>
    </ul>
</nav>
<div class="users view large-9 medium-8 columns content">
    <h3><?= h($Users->username) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __d('Accounts/authz','Id') ?></th>
            <td><?= h($Users->id) ?></td>
        </tr>
        <tr>
            <th><?= __d('Accounts/authz','Username') ?></th>
            <td><?= h($Users->username) ?></td>
        </tr>
        <tr>
            <th><?= __d('Accounts/authz','Email') ?></th>
            <td><?= h($Users->email) ?></td>
        </tr>
        <tr>
            <th><?= __d('Accounts/authz','First Name') ?></th>
            <td><?= h($Users->first_name) ?></td>
        </tr>
        <tr>
            <th><?= __d('Accounts/authz','Last Name') ?></th>
            <td><?= h($Users->last_name) ?></td>
        </tr>
        <tr>
            <th><?= __d('Accounts/authz','Token') ?></th>
            <td><?= h($Users->token) ?></td>
        </tr>
        <tr>
            <th><?= __d('Accounts/authz','Api Token') ?></th>
            <td><?= h($Users->api_token) ?></td>
        </tr>
        <tr>
            <th><?= __d('Accounts/authz','Role') ?></th>
            <td><?= h($Users->role) ?></td>
        </tr>
        <tr>
            <th><?= __d('Accounts/authz','Token Expires') ?></th>
            <td><?= h($Users->token_expires) ?></td>
        </tr>
        <tr>
            <th><?= __d('Accounts/authz','Activation Date') ?></th>
            <td><?= h($Users->activation_date) ?></td>
        </tr>
        <tr>
            <th><?= __d('Accounts/authz','Tos Date') ?></th>
            <td><?= h($Users->tos_date) ?></td>
        </tr>
        <tr>
            <th><?= __d('Accounts/authz','Created') ?></th>
            <td><?= h($Users->created) ?></td>
        </tr>
        <tr>
            <th><?= __d('Accounts/authz','Modified') ?></th>
            <td><?= h($Users->modified) ?></td>
        </tr>
        <tr>
            <th><?= __d('Accounts/authz','Active') ?></th>
            <td><?= $Users->active ? __d('Accounts/authz','Yes') : __d('Accounts/authz','No'); ?></td>
        </tr>
        <tr>
            <th><?= __d('Accounts/authz','Is Superuser') ?></th>
            <td><?= $Users->is_superuser ? __d('Accounts/authz','Yes') : __d('Accounts/authz','No'); ?></td>
        </tr>
    </table>
</div>
