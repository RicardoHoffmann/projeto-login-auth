<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __d('Accounts/authz','Actions') ?></li>
        <li><?= $this->Html->link(__d('Accounts/authz','List Menus'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="menus form large-9 medium-8 columns content">
    <?= $this->Form->create($menu) ?>
    <fieldset>
        <legend><?= __d('Accounts/authz','Add Menu') ?></legend>
        <?php
            echo $this->Form->input('parent_id', ['options' => $parentMenus, 'empty' => true], ['label' => __d('Accounts/authz', 'parent_id')]);
            echo $this->Form->input('name', ['label' => __d('Accounts/authz', 'name')]);
            echo $this->Form->input('plugin', ['options' => $plugins, 'id'=>'plugin', 'empty' => true], ['label' => __d('Accounts/authz', 'plugin')]);
            echo $this->Form->input('controller', ['options' => [], 'id'=>'controller', 'empty' => true], ['label' => __d('Accounts/authz', 'controller')]);
            echo $this->Form->input('action', ['options' => [], 'id'=>'action', 'empty' => false], ['label' => __d('Accounts/authz', 'action')]);
            echo $this->Form->input('external_url', ['label' => __d('Accounts/authz', 'external_url')]);
        ?>
    </fieldset>
    <div id="div-load"></div>
    <?= $this->Form->button(__d('Accounts/authz','Submit')) ?>
    <?= $this->Form->end() ?>
</div>

<script>
    $(function(){
        $('#plugin').change(function() {
            $.ajax({
                url: 'listCtls/' + encodeURIComponent($('#plugin').val()) + '.json',
                beforeSend: function( ) {
                    $('#controller').empty();
                    $('#controller').append('<option value=""></option>');
                    $('#div-load').html('<?= $this->Html->image('ajax-loader.gif', ['alt' => 'loading...']) ?>');
                }
            })
            .done(function(data) {
                $.each(data.controllers, function(i, item) {
                    $('#controller').append('<option value=' + i + '>' + item + '</option>');
                })
                $('#div-load').html('');
            })
        })
        $('#controller').change(function() {
            $.ajax({
                url: 'listActs/'
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
                    $('#action').append('<option value=' + i + '>' + item + '</option>');
                })
                $('#div-load').html('');
            })
        })
    });
</script>