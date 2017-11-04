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

$cakeDescription = 'CodeRace';
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

    <?= $this->Html->script('jquery/jquery.js') ?>
    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>

<div class="top-bar">
    <div class="top-bar-title">
        <?= $this->Html->link('Projeto CodeRace', ['plugin' => 'Accounts/Auth', 'controller' => 'Users', 'action' => 'login']) ?>
    </div>
</div>

<?= $this->Flash->render() ?>
<div class="container clearfix">
    <?= $this->fetch('content') ?>
</div>

<footer class="footer">
    <div class="row">
        <div class="small-12 columns">
            <p class="slogan">Projeto CodeRace</p>
            <p class="copywrite">Instituto Federal Farroupilha - Campus São Vicente do Sul</p>
            <p class="copywrite">Jefferson Vantuir © <?= date('Y') ?></p>
            <p class="copywrite">sup.aplicacao@gmail.com - (xx) 9999-999</p>
        </div>
    </div>
</footer>

<script>
    $(document).foundation();
</script>

</body>

</html>
