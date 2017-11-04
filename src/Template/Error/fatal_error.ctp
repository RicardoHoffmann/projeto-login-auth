<?php
use Cake\Core\Configure;
use Cake\Error\Debugger;

$this->layout = 'error';
$this->assign('title', __('Fatal error'));

if (Configure::read('debug')):
    $this->layout = 'dev_error';
//    $this->layout = 'error';

    $this->assign('title', $message);
    $this->assign('templateName', 'fatal_error.ctp');

    $this->start('file');
?>
<?php if (!empty($error->queryString)) : ?>
    <p class="notice">
        <strong>SQL Query: </strong>
        <?= h($error->queryString) ?>
    </p>
<?php endif; ?>
<?php if (!empty($error->params)) : ?>
        <strong>SQL Query Params: </strong>
        <?php Debugger::dump($error->params) ?>
<?php endif; ?>
<?= $this->element('auto_table_warning') ?>
<?php
    if (extension_loaded('xdebug')):
        xdebug_print_function_stack();
    endif;

    $this->end();
endif;
?>

<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __d('Accounts/auth', 'Actions') ?></li>
        <li><?= $this->Html->link(__d('Accounts/auth', 'Home'), ['plugin' => 'Accounts/Auth', 'controller' => 'Users', 'action' => 'login']) ?> </li>
    </ul>
</nav>

<div class="users form large-9 medium-8 columns content">
    <h2><?= __("Fatal Error") ?></h2>
    <p class="error">
        <?= __('Concact Sysadmin') ?>
    </p>
</div>