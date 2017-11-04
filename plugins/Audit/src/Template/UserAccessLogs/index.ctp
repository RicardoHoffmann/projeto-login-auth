<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <?= $this->element('audit-menu') ?>
    </ul>
</nav>
<div class="userAccessLogs index large-9 medium-8 columns content">
    <h3><?= __d('Audit','User Access Log') ?></h3>

    <?php
        echo $this->Form->create();
        // You'll need to populate $authors in the template from your controller
        echo $this->Form->input('timestamp', ['label' => __d('Audit','From')]);
        echo $this->Form->input('user', ['label' => __d('Audit','User')]);
        // Match the search param in your table configuration
        echo $this->Form->input('q', ['label' => __d('Audit','IP / Browser')]);
        echo $this->Form->button(__d('Audit','Filter'), ['type' => __d('Audit','submit')]);
        echo $this->Form->end();
    ?>

    <script>
        $(function(){
            $('#timestamp').fdatepicker({
                format: 'dd/mm/yyyy hh:ii',
                disableDblClickSelection: true,
                language: 'pt-br',
                pickTime: true
            });
            $(function() {
                $( "#user" ).autocomplete({
                    source: "/audit/users/find.json"
                });
            });
        });
    </script>

    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('created', ['label' => __d('Audit', 'Created')]) ?></th>
                <th><?= $this->Paginator->sort('user', ['label' => __d('Audit', 'User')]) ?></th>
                <th><?= $this->Paginator->sort('IP', ['label' => __d('Audit', 'IP')]) ?></th>
                <th><?= $this->Paginator->sort('browser', ['label' => __d('Audit', 'Browser')]) ?></th>
                <th class="actions"><?= __d('Audit','Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($userAccessLogs as $userAccessLog): ?>
            <tr>
                <td><?= h($userAccessLog->created) ?></td>
                <td><?= $userAccessLog->has('user') ? $this->Html->link($userAccessLog->user->username, ['controller' => 'Users', 'action' =>'view', $userAccessLog->user->id]) : '' ?></td>
                <td><?= h($userAccessLog->ipv4_address) ?></td>
                <td><?= h(substr(strrchr($userAccessLog->browser, " "), 1)) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__d('Audit','Detail'), ['action' => 'view', $userAccessLog->id]) ?>
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
