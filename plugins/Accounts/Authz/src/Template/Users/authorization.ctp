<?php 
    use Cake\Routing\Router; 
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __d('Accounts/authz', 'Actions') ?></li>
        <li><?= $this->Html->link(__d('Accounts/authz', 'User Menu'), ['action' => 'user_menu', $user_id]) ?></li>
        <li><?= $this->Html->link(__d('Accounts/authz', 'Authorization'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="auditLogs index large-9 medium-8 columns content">
    <fieldset>
        <legend><?= __d('Accounts/authz','Authorization User') ?>&nbsp;::&nbsp;<?= $fullname ?></legend>
        <label for="select-plugin">Plugin</label>
        <?= $this->Form->select('select-plugin', $plugins, ['id'=>'select-plugin']); ?>
        <div id="div-controller">
            <label for="select-controller"><?= __d('Accounts/authz','Controller') ?></label>
            <?= $this->Form->select('select-controller', null, ['id'=>'select-controller', 'empty' => true]); ?>
        </div>
        <div id="div-action">
            <label for="select-action"><?= __d('Accounts/authz','Action') ?></label>
            <?= $this->Form->select('select-action', null, ['id'=>'select-action', 'multiple' => true]); ?>
        </div>
        <label for="select-prefix"><?= __d('Accounts/authz','Prefix') ?></label>
        <?= $this->Form->select('prefix', $prefix, ['id'=>'prefix']); ?>
        <label for="select-extension"><?= __d('Accounts/authz','Extension') ?></label>
        <?= $this->Form->select('extension', $extension, ['id'=>'extension']); ?>
        <label for="select-action"><?= __d('Accounts/authz','Access Type') ?></label>
        <?= $this->Form->select('select-access-type', ['Granted' => 'Granted','Denied' => 'Denied'], ['id'=>'select-access-type']); ?>
        <?= $this->Form->button(__d('Accounts/authz','Add'), ['id' => 'add-button']) ?>
        <div id="div-load"></div>
    </fieldset>
    <div id="div-authorizations"></div>
</div>

<script>
    $(function() {
        $('#div-controller').hide();
        $('#div-action').hide();
        
        $.ajax({
            url: '<?= Router::url(['plugin' => 'Accounts/Authz', 'controller' => 'Users', 'action' => 'list-user-authorizations', $user_id]) ?>',
            beforeSend: function () {
                $('#div-authorizations').html('<?= $this->Html->image('ajax-loader.gif', ['alt' => 'loading...']) ?>');
            }
        })
            .done(function (data) {
                $('#div-authorizations').html(data);
            });

        $('#add-button').click(function () {
            var user_id = '<?= $user_id ?>';
            var plugin = $('#select-plugin').val();

            if (!plugin) {
                alert('Plugin required');
                return false;
            }

            var controller = $('#select-controller').val();
            var action = $('#select-action').val();
            var prefix = $('#prefix').val();
            var extension = $('#extension').val();
            var access_type = $('#select-access-type').val();
            var dataString = 'user_id=' + user_id + '&plugin=' + plugin + '&controller=' + controller + '&action=' + action + '&prefix=' + prefix + '&extension=' + extension + '&access_type=' + access_type;
            $.ajax({
                type: 'GET',
                data: dataString,
                url: '<?= Router::url(['plugin' => 'Accounts/Authz', 'controller' => 'Users', 'action' => 'addAuthorization', $user_id]) ?>',
                success: function (data) {
                    $.ajax({
                        url: '<?= Router::url(['plugin' => 'Accounts/Authz', 'controller' => 'Users', 'action' => 'list-user-authorizations', $user_id]) ?>',
                        beforeSend: function () {
                            $('#div-authorizations').html('<?= $this->Html->image('ajax-loader.gif', ['alt' => 'loading...']) ?>');
                        }
                    })
                        .done(function (data) {
                            $('#div-authorizations').html(data);
                        });
                }
            });
        });

        $('#select-plugin').change(function() {
            loadController();
        });

        loadController = (function() {
            $.ajax({
                url: '<?= Router::url(['plugin' => 'Accounts/Authz', 'controller' => 'Users', 'action' => 'listCtls']) ?>' +
                    '/' + encodeURIComponent($('#select-plugin').val()) + '.json',
                beforeSend: function () {
                    $('#div-controller').show();
                    $('#select-controller').empty();
                    $('#div-action').hide();
                    $('#select-action').empty();
                    $('#div-load').html('<?= $this->Html->image('ajax-loader.gif', ['alt' => 'loading...']) ?>');
                }
            })
            .done(function (data) {
                $('#select-controller').append('<option value="*">*</option>');
                $.each(data.controllers, function (i, item) {
                    $('#select-controller').append('<option value=' + i + '>' + item + '</option>');
                })
                $('#div-load').html('');
            })
        });

        loadController();

        $('#select-controller').change(function() {
            if ($('#select-controller').val() == '*') {
                $('#div-action').hide();
                $('#div-load').html('');
                return;
            }
            $.ajax({
                url: '<?= Router::url(['plugin' => 'Accounts/Authz', 'controller' => 'Users', 'action' => 'listActs']) ?>' +
                    '/' + encodeURIComponent($('#select-plugin').val()) + '/' +
                    encodeURIComponent($('#select-controller').val()) + '.json',
                beforeSend: function( ) {
                    $('#div-action').show();
                    $('#select-action').empty();
                    $('#div-load').html('<?= $this->Html->image('ajax-loader.gif', ['alt' => 'loading...']) ?>');
                }
            })
            .done(function(data) {
                $.each(data.actions, function(i, item) {
                    $('#select-action').append('<option value=' + i + '>' + item + '</option>');
                })
                $('#div-load').html('');
            })
        });
    });
</script>