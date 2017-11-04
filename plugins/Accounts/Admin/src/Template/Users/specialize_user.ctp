<?php
/**
  * @var \App\View\AppView $this
  */
  use Cake\Routing\Router;
?>
<style type="text/css">
    #arrow-right {
        font-weight: bold;
        font-size: 20px;
    }

    #arrow-right:hover {
        color: #0A5517;
        cursor: pointer;
    }

    #seta-direita:before {
        content: "";
        display: inline-block;
        vertical-align: middle;
        margin-right: 3px;
        width: 0;
        height: 0;

        border-top: 7px solid transparent;
        border-bottom: 7px solid transparent;
        border-left: 7px solid black;
    }

    #seta-direita:hover{
        border-left: #0A5517;
        cursor: pointer;
    }

    #seta-baixo:before {
        content: "";
        display: inline-block;
        vertical-align: middle;
        margin-right: 2px;
        width: 0;
        height: 0;

        border-left: 7px solid transparent;
        border-right: 7px solid transparent;
        border-top: 7px solid #0a0a0a;
    }

    #seta-baixo:hover {
        border-left: #0A5517;
        cursor: pointer;
    }

    #seta-direita-emp:before {
        content: "";
        display: inline-block;
        vertical-align: middle;
        margin-right: 3px;
        width: 0;
        height: 0;

        border-top: 7px solid transparent;
        border-bottom: 7px solid transparent;
        border-left: 7px solid black;
    }

    #seta-direita-emp:hover{
        border-left: #0A5517;
        cursor: pointer;
    }

    #seta-baixo-emp:before {
        content: "";
        display: inline-block;
        vertical-align: middle;
        margin-right: 2px;
        width: 0;
        height: 0;

        border-left: 7px solid transparent;
        border-right: 7px solid transparent;
        border-top: 7px solid #0a0a0a;
    }

    #seta-baixo-emp:hover {
        border-left: #0A5517;
        cursor: pointer;
    }

</style>

<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __d('Accounts/admin', 'Actions') ?></li>
        <li><?= $this->Html->link(__d('Accounts/admin', 'Home'), ['plugin' => false, 'controller' => 'pages', 'action' => 'display']) ?></li>
    </ul>
</nav>
<div class="auditLogs index large-9 medium-8 columns content">
        <legend><?= h($user->first_name . " " . $user->last_name . ' @ ' .$user->username) ?></legend>
        <h4>
            <div class="fi-torsos-all">
                <?= __d('Accounts/admin', 'Specializations') ?>
            </div>
        </h4>
        <table class="vertical-table">
            <tr>
                <th><?= __d('Accounts/admin', 'Student') ?></th>
                    <?php if (!$isStudent) { ?>
                        <td>
                            <div id="seta-direita">
                            </div>
                            <div id="seta-baixo" style="display: none">
                            </div>
                        </td>

                    <?php } else { ?>
                        <td>
                            <?= $this->Html->link('<i class="fi-check" title="' . __d('Accounts/admin','Remove Specilization') . '"></i>', ['action' => 'removeStudentSpecialization', $user->id], ['escape' => false]) ?>
                        </td>
                    <?php } ?>
            </tr>
        </table>
            <div id="form-student" style="display: none">
                <fieldset>
                    <legend><?= __d('Accounts/admin', 'Add Student') ?></legend>
                    <?= $this->Form->create() ?>
                    <?= $this->Form->input('rg', ['label' => __d('Accounts/admin', 'RG'), 'required' => true]) ?>
                    <?= $this->Form->input('birthday', ['label' => __d('Accounts/admin', 'Birthday'), 'required' => true]) ?>
                </fieldset>
                <?= $this->Form->button(__d('Accounts/admin', 'Submit')) ?>
            </div>

    <table class="vertical-table">
        <tr>
            <th><?= __d('Accounts/admin', 'Employee') ?></th>
            <td>
                <div id="seta-direita-emp">
                </div>
                <div id="seta-baixo-emp" style="display: none">
                </div>
            </td>
        </tr>
    </table>
    <div id="employees-categories">

    </div>
    <table class="vertical-table">
            <tr>
                <th><?= __d('Accounts/admin', 'Outsourced') ?></th>
                <?php if (!$isOutsourced) { ?>
                    <td>
                        <?= $this->Html->link('<i class="fi-x" title="' . __d('Accounts/admin','Add Specilization') . '"></i>', ['action' => 'addOutsourcedSpecialization', $user->id], ['escape' => false]) ?>
                    </td>
                <?php } else { ?>
                    <td>
                        <?= $this->Html->link('<i class="fi-check" title="' . __d('Accounts/admin','Remove Specilization') . '"></i>', ['action' => 'removeOutsourcedSpecialization', $user->id], ['escape' => false]) ?>
                    </td>
                <?php } ?>
            </tr>
    </table>
    <table class="vertical-table">
            <tr>
                <th><?= __d('Accounts/admin', 'Scholarship') ?></th>
                <?php if (!$isScholarship) { ?>
                    <td>
                        <?= $this->Html->link('<i class="fi-x" title="' . __d('Accounts/admin','Add Specilization') . '"></i>', ['action' => 'addScholarshipSpecialization', $user->id], ['escape' => false]) ?>
                    </td>
                <?php } else { ?>
                    <td>
                        <?= $this->Html->link('<i class="fi-check" title="' . __d('Accounts/admin','Remove Specilization') . '"></i>', ['action' => 'removeScholarshipSpecialization', $user->id], ['escape' => false]) ?>
                    </td>
                <?php } ?>
            </tr>
        </table>
        <div id="div-loading"></div>
</div>

<?php $user_id = $user->id; ?>

<script type="application/javascript">
       $('#seta-direita').click(function () {
           $(this).hide();
           document.getElementById('seta-baixo').style.display = 'inline';
           document.getElementById('form-student').style.display = 'inline';
       });

        $('#seta-baixo').click(function () {
            $(this).hide();
            $('#seta-direita').show();
            document.getElementById('form-student').style.display = 'none';
        });

       $(function(){
           $('#birthday').fdatepicker({
               format: 'dd/mm/yyyy',
               disableDblClickSelection: true,
               language: 'pt-br',
               pickTime: false
           });
       });

       $('#seta-direita-emp').click(function () {
           $(this).hide();
           $('#employees-categories').show();
           document.getElementById('seta-baixo-emp').style.display = 'inline';
       });

       $('#seta-baixo-emp').click(function () {
           $(this).hide();
           $('#employees-categories').hide();
           $('#seta-direita-emp').show();
       });

       $('#seta-direita-emp').click(function () {
           var id = '<?= $user->id ?>';
           $.ajax({
               url: '<?= Router::url(['plugin' => 'Accounts/Admin', 'controller' => 'Users', 'action' => 'employees-categories']) ?>' +
           '/' + encodeURIComponent(id),
               beforeSend: function () {
                   $('#employees-categories').html('<?= $this->Html->image('ajax-loader.gif', ['alt' => 'loading...']) ?>');
               }
           })
               .done(function (data) {
                   document.getElementById('employees-categories').innerHTML = data;
               });
       });
</script>