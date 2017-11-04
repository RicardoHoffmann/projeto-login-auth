<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __d('Accounts/admin', 'Actions') ?></li>
        <li><?= $this->Html->link(__d('Accounts/admin', 'List Groups'), ['action' => 'index']) ?> </li>
        </ul>
</nav>
<div class="groups view large-9 medium-8 columns content">
    <h3><?= h($group->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __d('Accounts/admin', 'Id') ?></th>
            <td><?= h($group->id) ?></td>
        </tr>
        <tr>
            <th><?= __d('Accounts/admin', 'Name') ?></th>
            <td><?= h($group->name) ?></td>
        </tr>
        <tr>
            <th><?= __d('Accounts/admin', 'Created') ?></th>
            <td><?= h($group->created) ?></td>
        </tr>
        <tr>
            <th><?= __d('Accounts/admin', 'Modified') ?></th>
            <td><?= h($group->modified) ?></td>
        </tr>
        <tr>
            <th><?= __d('Accounts/admin', 'List Users') ?></th>
            <td>
                <?php if (empty($users->toArray())): ?>
                <i>
                    <small>
                        <?= __d('Accounts/authz', "None User")?>
                    </small>
                </i>
                <?php else: ?>
                <?php foreach ($users as $user): ?>
                <?= h($user->first_name) ?>
                <?= h($user->last_name) ?>
                <br>
                <?php endforeach; ?>
                <?php endif; ?>
            </td>
        </tr>
    </table>
</div>