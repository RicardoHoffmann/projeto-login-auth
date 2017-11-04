<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = 'TIDigital';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->css('base.css') ?>
    <?= $this->Html->css('cake.css') ?>
    <?= $this->Html->css('jquery/jquery-ui.css') ?>
    <?= $this->Html->css('jquery/jquery-ui.icon-font.css') ?>
    <?= $this->Html->css('foundation/foundation-datepicker.css') ?>
    <?= $this->Html->css('foundation/icons/foundation-icons.css') ?>

    <?= $this->Html->script('jquery/jquery.js') ?>
    <?= $this->Html->script('jquery/jquery-ui.min.js') ?>
    <?= $this->Html->script('foundation/foundation.min.js') ?>
    <?= $this->Html->script('foundation/foundation-datepicker.js') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>

<div class="top-bar">
    <div class="top-bar-title">
        <?= $this->Html->link('TIDigital', ['plugin' => 'Accounts/Auth', 'controller' => 'Users', 'action' => 'login']) ?> - Autocadastro
    </div>
</div>

<?= $this->Flash->render() ?>
<div class="container clearfix">
    <?= $this->fetch('content') ?>
</div>

<footer class="footer">
    <div class="row">
        <div class="small-12 columns">
            <p class="slogan">TIDigital</p>
            <p class="copywrite">Instituto Federal Farroupilha - Campus São Vicente do Sul</p>
            <p class="copywrite">Coordenação de Tecnologia da Informação</p>
            <p class="copywrite">© CTI <?= date('Y') ?></p>
            <p class="copywrite">ctisistemas.svs@iffarroupilha.edu.br - (55) 3257-4106</p>
        </div>
    </div>
</footer>

<script>
    $(document).foundation();
</script>

</body>

</html>
