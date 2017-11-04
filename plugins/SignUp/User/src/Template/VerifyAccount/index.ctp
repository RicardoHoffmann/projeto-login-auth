<?php
    use Cake\Routing\Router;
?>
<style type="text/css">
    .fi-check {
        margin-right: 5px;
        cursor: pointer;
    }

    .fi-check:hover {
        color: #00aa00;
    }
</style>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __d('SignUp/employee', 'Actions') ?></li>
        <li><?= $this->Html->link(__d('SignUp/employee', 'Home'), ['plugin' => null, 'controller' => 'pages','action' => 'home']) ?></li>
        <li><?= $this->Html->link(__d('SignUp/employee', 'Category of Employees'), ['controller' => 'EmployeesCategories','action' => 'index']) ?></li>
    </ul>
</nav>
<div class="users index large-9 medium-8 columns content">
    <h3><?= __d('SignUp/employee', 'Validations') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('username', array('label' =>__d('SignUp/employee', 'Username'))) ?></th>
                <th><?= $this->Paginator->sort('first_name', array('label' =>__d('SignUp/employee', 'First Name'))) ?></th>
                <th><?= $this->Paginator->sort('last_name', array('label' =>__d('SignUp/employee', 'Last Name'))) ?></th>
                <th><?= $this->Paginator->sort('role', array('label' =>__d('SignUp/employee', 'Role'))) ?></th>
                <th><?= $this->Paginator->sort('created', array('label' =>__d('SignUp/employee', 'Created'))) ?></th>
                <th><?= $this->Paginator->sort('specialization', array('label' =>__d('SignUp/employee', 'Specialization'))) ?></th>
                <th class="actions"><?= __d('SignUp/employee', 'Validation') ?></th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($users as $user): ?>
            <tr>
                <td id="<?= $user->id?>" style="display: none"><?= h($user->id) ?></td>
                <td><?= h($user->username) ?></td>
                <td><?= h($user->first_name) ?></td>
                <td><?= h($user->last_name) ?></td>
                <td><?= h($user->role) ?></td>
                <td><?= h($user->created) ?></td>
                <td><?= $this->Form->control('categories', ['label' => false, 'id' => 'category', 'type' => 'select', 'options' => $employeeCategories, 'empty' => true]) ?></td>
                <td class="actions">
                    <?php $id = $user->id; ?>
                    <i class="fi-check" onclick="acceptEmployee('<?= $id ?>');" title="' . __d('SignUp/employee', 'Accept') . '"></i>
                    <?= $this->Form->postLink('<i class="fi-x" style="margin-right: 5px;" title="' . __d('SignUp/employee', 'Reject') . '"></i>', ['action' => 'reject', $user->id], ['confirm' => __d('SignUp/employee', 'Reject request?'), 'escape' => false]) ?>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <div id="loading"></div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __d('SignUp/employee', 'previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__d('SignUp/employee', 'next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>

<script type="application/javascript">

    function acceptEmployee(user_id) {

        var category_id = $("#category").val();

        if (category_id == '') {
            alert('<?= __d("SignUp/employee", "Please select a Category for Employee") ?>');
        } else {
            var resp = confirm("<?= __d('SignUp/employee', 'Accept request?') ?>");

            if (resp == true) {
                $.ajax({
                        url: '<?= Router::url(['plugin' => 'SignUp/Employee', 'controller' => 'VerifyAccount', 'action' => 'accept']) ?>' +
                '/' + encodeURIComponent(user_id) + '/' + encodeURIComponent(category_id),
                    beforeSend: function() {
                    $("#loading").html('<?= $this->Html->image('ajax-loader.gif', ['alt' => 'loading...']) ?>');
                }
            })
            .done(function () {
                    window.location.reload();
                });
            }
        }


    }
</script>