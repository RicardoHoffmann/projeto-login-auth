<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __d('Accounts/admin', 'Actions') ?></li>
        <li><?= $this->Html->link(__d('Accounts/admin', 'List Users'), ['action' => 'index']) ?> </li>
    </ul>
</nav>
<div class="users view large-9 medium-8 columns content">
    <h3><?= h($Users->username) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __d('Accounts/admin', 'Id') ?></th>
            <td><?= h($Users->id) ?></td>
        </tr>
        <tr>
            <th><?= __d('Accounts/admin', 'Username') ?></th>
            <td><?= h($Users->username) ?></td>
        </tr>
        <tr>
            <th><?= __d('Accounts/admin', 'Email') ?></th>
            <td><?= h($Users->email) ?></td>
        </tr>
        <tr>
            <th><?= __d('Accounts/admin', 'First Name') ?></th>
            <td><?= h($Users->first_name) ?></td>
        </tr>
        <tr>
            <th><?= __d('Accounts/admin', 'Last Name') ?></th>
            <td><?= h($Users->last_name) ?></td>
        </tr>
        <tr>
            <th><?= __d('Accounts/admin', 'Groups') ?></th>
            <td>
                <?php
                if (empty($groups->toArray())): ?>
                <i>
                    <small>
                        <?= __d('Accounts/admin', 'None Group')?>
                    </small>
                </i>
                <?php else: ?>
                <?php foreach ($groups as $group): ?>
                <?= h($group->name) ?>
                <br>
                <?php endforeach; ?>
                <?php endif; ?>
            </td>
        </tr>
        <tr>
            <th><?= __d('Accounts/admin', 'Specialization (s)') ?></th>
            <td>
                <?php
                if (!$isStudent && !$isEmployee && !$isOutsourced && !$isScholarship): ?>
                <i>
                    <small>
                        <?= __d('Accounts/admin', 'None Specialization')?>
                    </small>
                </i>
                <?php else: ?>
                    <?php if ($isStudent): ?>
                        <?= __d('Accounts/admin', 'Student'); ?>
                    <br>
                    <?php endif; ?>
                    <?php foreach ($categories as $category): ?>
                        <?= __($category->description); ?>
                        <br>
                    <?php endforeach; ?>
                    <?php if ($isOutsourced): ?>
                        <?= __d('Accounts/admin', 'Outsourced'); ?>
                    <br>
                    <?php endif; ?>
                    <?php if ($isScholarship): ?>
                        <?= __d('Accounts/admin', 'Scholarship'); ?>
                    <?php endif; ?>
                <?php endif; ?>

            </td>
        </tr>
        <tr>
            <th><?= __d('Accounts/admin', 'Token') ?></th>
            <td><?= h($Users->token) ?></td>
        </tr>
        <tr>
            <th><?= __d('Accounts/admin', 'Api Token') ?></th>
            <td><?= h($Users->api_token) ?></td>
        </tr>
        <tr>
            <th><?= __d('Accounts/admin', 'Role') ?></th>
            <td><?= h($Users->role) ?></td>
        </tr>
        <tr>
            <th><?= __d('Accounts/admin', 'Token Expires') ?></th>
            <td><?= h($Users->token_expires) ?></td>
        </tr>
        <tr>
            <th><?= __d('Accounts/admin', 'Activation Date') ?></th>
            <td><?= h($Users->activation_date) ?></td>
        </tr>
        <tr>
            <th><?= __d('Accounts/admin', 'Tos Date') ?></th>
            <td><?= h($Users->tos_date) ?></td>
        </tr>
        <tr>
            <th><?= __d('Accounts/admin', 'Created') ?></th>
            <td><?= h($Users->created) ?></td>
        </tr>
        <tr>
            <th><?= __d('Accounts/admin', 'Modified') ?></th>
            <td><?= h($Users->modified) ?></td>
        </tr>
        <tr>
            <th><?= __d('Accounts/admin', 'Active') ?></th>
            <td><?= $Users->active ? __d('Accounts/admin', 'Yes') : __d('Accounts/admin', 'No'); ?></td>
        </tr>
        <tr>
            <th><?= __d('Accounts/admin', 'Is Superuser') ?></th>
            <td><?= $Users->is_superuser ? __d('Accounts/admin', 'Yes') : __d('Accounts/admin', 'No'); ?></td>
        </tr>
    </table>
</div>
