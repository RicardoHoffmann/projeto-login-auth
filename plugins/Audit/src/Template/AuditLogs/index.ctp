<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <?= $this->element('audit-menu')?>
    </ul>
</nav>
<div class="auditLogs index large-9 medium-8 columns content">
    <h3><?= __d('Audit','Audit Logs') ?></h3>
    <?php
        echo $this->Form->create();
        // You'll need to populate $authors in the template from your controller
        echo $this->Form->input('timestamp', ['label' => __d('Audit','From')]);
        echo $this->Form->input('user', ['label' => __d('Audit','User')]);
        // Match the search param in your table configuration
        echo $this->Form->input('q', ['label' => __d('Audit','Type / IP / URL / Browser')]);
        echo $this->Form->button(__d('Audit','Filter'), ['type' => 'submit']);
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
        });
        $(function() {
            $( "#user" ).autocomplete({
                source: "/audit/users/find.json"
            });
        });
    </script>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th style="width: 10%"><?= $this->Paginator->sort('timestamp', ['label' => __d('Audit', 'Timestamp')])  ?></th>
                <th style="width: 10%"><?= $this->Paginator->sort('user_id', ['label' => __d('Audit', 'User_id')])  ?></th>
                <th style="width: 10%"><?= $this->Paginator->sort('type', ['label' => __d('Audit', 'Type')])  ?></th>
                <th style="width: 10%"><?= $this->Paginator->sort('IP', ['label' => __d('Audit', 'IP')])  ?></th>
                <th style="width: 40%"><?= $this->Paginator->sort('URL', ['label' => __d('Audit', 'URL')])  ?></th>
                <th style="width: 10%"><?= $this->Paginator->sort('browser', ['label' => __d('Audit', 'Browser')])  ?></th>
                <th class="actions" style="width: 10%"><?= __d('Audit','Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($auditLogs as $auditLog): ?>
            <tr>
                <td><?= h($auditLog->timestamp) ?></td>
                <td><?= $auditLog->has('user') ? $this->Html->link($auditLog->user->username, ['controller' => 'Users', 'action' => 'view', $auditLog->user->id]) : '' ?></td>
                <td><?= h($auditLog->type) ?></td>
                <td><?= h($auditLog->ip) ?></td>
                <td><?= h($auditLog->url) ?></td>
                <td><?= h(substr(strrchr($auditLog->browser, " "), 1)) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__d('Audit','Detail'), ['action' => 'view', $auditLog->id]) ?>
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
