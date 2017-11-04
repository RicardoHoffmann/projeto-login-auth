<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __d('Accounts/authz','Actions') ?></li>
        <li><?= $this->Html->link(__d('Accounts/authz','Edit Menu'), ['action' => 'edit', $menu->id]) ?> </li>
        <li><?= $this->Form->postLink(__d('Accounts/authz','Delete Menu'), ['action' => 'delete', $menu->id], ['confirm' => __d('Accounts/authz','Are you sure you want to delete # {0}?', $menu->id)]) ?> </li>
        <li><?= $this->Html->link(__d('Accounts/authz','List Menus'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__d('Accounts/authz','New Menu'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__d('Accounts/authz','List Parent Menus'), ['controller' => 'Menus', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__d('Accounts/authz','New Parent Menu'), ['controller' => 'Menus', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__d('Accounts/authz','List Actions'), ['controller' => 'Actions', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__d('Accounts/authz','New Action'), ['controller' => 'Actions', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="menus view large-9 medium-8 columns content">
    <h3><?= h($menu->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __d('Accounts/authz','Id') ?></th>
            <td><?= h($menu->id) ?></td>
        </tr>
        <tr>
            <th><?= __d('Accounts/authz','Parent Menu') ?></th>
            <td><?= $menu->has('parent_menu') ? $this->Html->link($menu->parent_menu->name, ['controller' => 'Menus', 'action' => 'view', $menu->parent_menu->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __d('Accounts/authz','Name') ?></th>
            <td><?= h($menu->name) ?></td>
        </tr>
        <tr>
            <th><?= __d('Accounts/authz','Action') ?></th>
            <td><?= $menu->has('action') ? $this->Html->link($menu->action->name, ['controller' => 'Actions', 'action' => 'view', $menu->action->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __d('Accounts/authz','External Url') ?></th>
            <td><?= h($menu->external_url) ?></td>
        </tr>
        <tr>
            <th><?= __d('Accounts/authz','Lft') ?></th>
            <td><?= $this->Number->format($menu->lft) ?></td>
        </tr>
        <tr>
            <th><?= __d('Accounts/authz','Rght') ?></th>
            <td><?= $this->Number->format($menu->rght) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __d('Accounts/authz','Related Menus') ?></h4>
        <?php if (!empty($menu->child_menus)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __d('Accounts/authz','Id') ?></th>
                <th><?= __d('Accounts/authz','Parent Id') ?></th>
                <th><?= __d('Accounts/authz','Lft') ?></th>
                <th><?= __d('Accounts/authz','Rght') ?></th>
                <th><?= __d('Accounts/authz','Name') ?></th>
                <th><?= __d('Accounts/authz','Action Id') ?></th>
                <th><?= __d('Accounts/authz','External Url') ?></th>
                <th class="actions"><?= __d('Accounts/authz','Actions') ?></th>
            </tr>
            <?php foreach ($menu->child_menus as $childMenus): ?>
            <tr>
                <td><?= h($childMenus->id) ?></td>
                <td><?= h($childMenus->parent_id) ?></td>
                <td><?= h($childMenus->lft) ?></td>
                <td><?= h($childMenus->rght) ?></td>
                <td><?= h($childMenus->name) ?></td>
                <td><?= h($childMenus->action_id) ?></td>
                <td><?= h($childMenus->external_url) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__d('Accounts/authz','View'), ['controller' => 'Menus', 'action' => 'view', $childMenus->id]) ?>
                    <?= $this->Html->link(__d('Accounts/authz','Edit'), ['controller' => 'Menus', 'action' => 'edit', $childMenus->id]) ?>
                    <?= $this->Form->postLink(__d('Accounts/authz','Delete'), ['controller' => 'Menus', 'action' => 'delete', $childMenus->id], ['confirm' => __d('Accounts/authz','Are you sure you want to delete # {0}?', $childMenus->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
