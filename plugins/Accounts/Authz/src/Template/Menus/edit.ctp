<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __d('Accounts/authz','Actions') ?></li>
        <li><?= $this->Form->postLink(
                __d('Accounts/authz','Delete'),
                ['action' => 'delete', $menu->id],
                ['confirm' => __d('Accounts/authz','Are you sure you want to delete # {0}?', $menu->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__d('Accounts/authz','List Menus'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="menus form large-9 medium-8 columns content">
    <?= $this->Form->create($menu) ?>
    <fieldset>
        <legend><?= __d('Accounts/authz','Edit Menu') ?></legend>
        <?php
            echo $this->Form->input('parent_id', ['options' => $parentMenus, 'empty' => true], ['label' => __d('Accounts/authz', 'parent_id')]);
            echo $this->Form->input('name', ['label' => __d('Accounts/authz', 'name')]);
            echo $this->Form->input('plugin', ['options' => $plugins, 'empty' => true], ['label' => __d('Accounts/authz', 'plugin')]);
            echo $this->Form->input('controller', ['options' => [], 'empty' => true], ['label' => __d('Accounts/authz', 'controller')]);
            echo $this->Form->input('action', ['options' => [], 'empty' => false], ['label' => __d('Accounts/authz', 'action')]);
            echo $this->Form->input('external_url', ['label' => __d('Accounts/authz', 'external_url')]);
        ?>
    </fieldset>
    <?= $this->Form->button(__d('Accounts/authz','Submit')) ?>
    <?= $this->Form->end() ?>
</div>

<script>
    $('#plugin').val('<?= Cake\Utility\Inflector::slug($menu->plugin) ?>');

    loadControllers = (function() {
        $.ajax({
            url: '../listCtls/' + encodeURIComponent($('#plugin').val()) + '.json',
            beforeSend: function( ) {
                $('#controller').empty();
                $('#controller').append('<option value=""></option>');
                $('#div-load').html('<?= $this->Html->image('ajax-loader.gif', ['alt' => 'loading...']) ?>');
            }
        })
        .done(function(data) {
            $.each(data.controllers, function(i, item) {
                if (i == '<?=$menu->controller?>'){
                    $('#controller').append('<option value=' + i + ' selected>' + item + '</option>');
                } else {
                    $('#controller').append('<option value=' + i + '>' + item + '</option>');
                }
            })
            $('#div-load').html('');
            if ($('#controller').val()) {
                loadActions();
            }
        })
    });

    loadActions = (function() {
        $.ajax({
            url: '../listActs/'
                + encodeURIComponent($('#plugin').val())
                + '--'
                + encodeURIComponent($('#controller').val())
                + '.json',
            beforeSend: function( ) {
                $('#action').empty();
                $('#div-load').html('<?= $this->Html->image('ajax-loader.gif', ['alt' => 'loading...']) ?>');
            }
        })
        .done(function(data) {
            $.each(data.actions, function(i, item) {
                if (i == '<?=$menu->action?>'){
                    $('#action').append('<option value=' + i + ' selected>' + item + '</option>');
                } else {
                    $('#action').append('<option value=' + i + '>' + item + '</option>');
                }
            })
            $('#div-load').html('');
        })
    });

    if ($('#plugin').val()) {
        loadControllers();
    }

    $('#plugin').change(function() {
        loadControllers();
    });

    $('#controller').change(function() {
        loadActions();
    })

</script>