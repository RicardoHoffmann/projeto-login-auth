<?= $this->Form->create('categories') ?>
<fieldset>
    <legend><?= __d('Accounts/admin', 'Select Specialization') ?></legend>
    <?php foreach ($categories as $category): ?>
    <?php echo $this->Form->input($category['id'], ['type' => 'checkbox', 'label' => __($category['description']), 'value' => $category['id'], 'checked' => $category['checked']]); ?>
    <?php endforeach; ?>
    <?= $this->Html->link(__d('Accounts/admin', 'New Category'), ['plugin' => 'SignUp/Employee', 'controller' => 'EmployeesCategories', 'action' => 'add']) ?>

</fieldset>
<?= $this->Form->button(__d('Accounts/admin', 'Save')) ?>
<?= $this->Form->end() ?>
