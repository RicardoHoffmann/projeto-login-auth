<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __d('Accounts/authz','Actions') ?></li>
        <li><?= $this->Html->link(__d('Accounts/authz','New Menu'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="menus index large-9 medium-8 columns content">
    <h3><?= __d('Accounts/authz','Main Menu') ?></h3>
    <?php
        foreach ($menus as $key => $value) {
            echo "<p style=\"margin-bottom: 0.5px\"><a href=\"menus/edit/$key\">$value</a></p>";
        }
     ?>
</div>
