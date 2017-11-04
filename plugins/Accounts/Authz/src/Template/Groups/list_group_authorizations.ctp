<table cellpadding="0" cellspacing="0">
    <thead>
    <tr>
        <th><?= __d('Accounts/authz','Plugin') ?></th>
        <th><?= __d('Accounts/authz','Controller') ?></th>
        <th><?= __d('Accounts/authz','Action') ?></th>
        <th><?= __d('Accounts/authz','Authorized') ?></th>
        <th><?= __d('Accounts/authz','Actions') ?></th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($authorizations as $authorization): ?>
    <tr>
        <td><?= h($authorization->plugin) ?></td>
        <td><?= h($authorization->controller) ?></td>
        <td><?= h($authorization->action) ?></td>
        <td><?php
                if ($authorization->allowed) {
            echo '<i style="color:green" class="fi-check" title="' . __d('Accounts/authz','Access Granted') . '"></i>';
            } else {
            echo '<i style="color:red" class="fi-x" title="' . __d('Accounts/authz','Access Denied') . '"></i>';
            }
            ?></td>
        <td><?= $this->Form->postLink(__d('Accounts/authz','Delete'), ['action' => 'delete', $authorization->id], ['confirm' => __d('Accounts/authz','Are you sure you want to delete # {0}?', $authorization->id)]) ?></td>
    </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<!--<ul style="list-style-type: none;">-->
<!--    <li>-->
<!--        <i style="color:#2913ff" class="fi-check">-->
<!--            --><?//= _('Access Granted') ?>
<!--        </i>-->
<!--    </li>-->
<!--    <li>-->
<!--        <i style="color:#d92e2e" class="fi-x">-->
<!--            --><?//= _('Access Denied') ?>
<!--        </i>-->
<!--    </li>-->
<!--</ul>-->