<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __d('Accounts/admin', 'Actions') ?></li>
        <li><?= $this->Html->link(__d('Accounts/admin', 'List Users'), ['action' => 'index']) ?></li>
    </ul>
</nav>

<div class="users form large-9 medium-8 columns content">
    <?= $this->Form->create($Users) ?>
    <fieldset>
        <legend><?= __d('Accounts/admin', 'Edit User') ?></legend>
        <?php
            echo $this->Form->input('username', ['label' => __d('Accounts/admin', 'Username')]);
            echo $this->Form->input('email', ['label' => __d('Accounts/admin', 'Email')]);
            echo $this->Form->input('first_name', ['label' => __d('Accounts/admin', 'First Name')]);
            echo $this->Form->input('last_name', ['label' => __d('Accounts/admin', 'Last Name')]);
            echo $this->Form->input('token', ['label' => __d('Accounts/admin', 'Token')]);
            echo $this->Form->input('token_expires', ['empty' => true, 'type' => 'text', 'id' => 'tokenexpires', 'label' => __d('Accounts/admin', 'Token Expires')]);
            echo $this->Form->input('api_token');
            echo $this->Form->input('activation_date', ['empty' => true, 'type' => 'text', 'id' => 'activationdate', 'label' => __d('Accounts/admin', 'Activation Date')]);
            echo $this->Form->input('tos_date', ['empty' => true, 'type' => 'text', 'id' => 'tosdate']);
            echo $this->Form->input('active', ['label' => __d('Accounts/admin', 'Active')]);
            echo $this->Form->input('is_superuser', ['label' => __d('Accounts/admin', 'Is Superuser')]);
            echo $this->Form->hidden('role', ['label' => __d('Accounts/admin', 'Role')]);
        ?>
    </fieldset>
    <?= $this->Form->button(__d('Accounts/admin', 'Submit')) ?>
    <?= $this->Form->end() ?>
</div>

<script>
    $(function(){
        $('#tokenexpires').fdatepicker({
            format: 'dd/mm/yyyy hh:ii',
            disableDblClickSelection: true,
            language: 'pt-br',
            pickTime: true
        });
    });
    $(function(){
        $('#activationdate').fdatepicker({
            format: 'dd/mm/yyyy hh:ii',
            disableDblClickSelection: true,
            language: 'pt-br',
            pickTime: true
        });
    });
    $(function(){
        $('#tosdate').fdatepicker({
            format: 'dd/mm/yyyy hh:ii',
            disableDblClickSelection: true,
            language: 'pt-br',
            pickTime: true
        });
    });
</script>