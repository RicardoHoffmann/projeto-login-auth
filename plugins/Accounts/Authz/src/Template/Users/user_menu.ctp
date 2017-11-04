<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __d('Accounts/authz', 'Actions') ?></li>
        <li><?= $this->Html->link(__d('Accounts/authz', 'Authorization'), ['action' => 'authorization', $user_id]) ?></li>
    </ul>
</nav>
<div class="auditLogs index large-9 medium-8 columns content">
    <h1><?= __d('Accounts/authz','Menu Access') ?></h1>
    <?php
        if ($user_menu != null) {
            foreach ($user_menu as $key => $value) {
                echo "<p style=\"margin-bottom: 0.5px\">$value</p>";
            }
        } else {
            echo __d('Accounts/authz','There is no menu authorized');
        }
    ?>
</div>