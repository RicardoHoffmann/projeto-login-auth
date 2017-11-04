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

$cakeDescription = 'Projeto CodeRace';
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
        <span data-hide-for="medium">
          <button class="menu-icon" type="button" data-toggle="my-panel-left"></button>
        </span>
        <span class="show-for-large separator"><?= $this->Html->link('Projeto CodeRace', ['plugin' => null, 'controller' => 'pages']) ?></span>
        <span class="hide-for-large"><?= $this->Html->link('Projeto CodeRace', ['plugin' => null, 'controller' => 'pages']) ?></span>
    </div>
    <div id="responsive-menu" class="show-for-large">
        <div class="top-bar-left">
            <?= $this->element('Accounts/Authz.menu'); ?>
        </div>
        <div class="top-bar-right">
            <ul class="menu-condensed">
                <li class="rounded-toolbar-img">
                    <a href="#" data-toggle="my-panel-right">
                        <?php
                        $email_hash = md5(strtolower(trim($profile_user_email)));
                        echo $this->Html->image(
                            'https://www.gravatar.com/avatar/' . $email_hash . "?s=48",
                            ['alt' => 'Sua conta', 'title' => 'Sua conta']
                        );
                        ?>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
<div class="simple-panel left" id="my-panel-left" data-toggler=".is-active">
    <p style="padding: 0px; ">
        <p class="rounded-toolbar-img">
            <a href="#" data-toggle="my-panel-right">
                <?php
                $email_hash = md5(strtolower(trim($profile_user_email)));
                echo $this->Html->image(
                    'https://www.gravatar.com/avatar/' . $email_hash . "?s=48",
                    ['alt' => 'Sua conta', 'title' => 'Sua conta', 'style' => 'display: block; margin-left: auto; margin-right: auto']
                );
                ?>
            </a>
        </p>
        <?= $this->Html->link('Home', ['plugin' => null, 'controller' => 'pages'], ['style' => 'padding: 1em;']) ?>
        <?= $this->element('Accounts/Authz.menu-mobile'); ?>
    </p>
    <button class="button expanded" data-toggle="my-panel-left"><?= __('Close') ?></button>
</div>

<div class="simple-panel right" id="my-panel-right" data-toggler=".is-active">
    <h4 class='text-center'><?= __('Hello') ?>, <?= $profile_first_name ?></h4>
    <p align="center" style="padding: 0px; ">
        <?= $this->Html->link(__('Profile'), ['plugin' => 'Accounts/Profile', 'controller' => 'Users', 'action' => 'index']) ?>
        <br>
        <?= $this->Html->link(__('Change Password'), ['plugin' => 'Accounts/Profile', 'controller' => 'Users', 'action' => 'change-password']) ?>
        <br>
        <?= $this->Html->link(__('Sign out'), ['plugin' => null, 'plugin' => 'Accounts/Auth', 'controller' => 'Users', 'action' => 'logout']) ?>
    </p>
    <button class="button expanded" data-toggle="my-panel-right"><?= __('Close') ?></button>
</div>

<?= $this->Flash->render() ?>
<div class="container clearfix">
    <?= $this->fetch('content') ?>
</div>

<footer class="footer">
    <div class="row">
        <div class="small-12 columns">
            <p class="slogan">Projeto CodeRace</p>
            <p class="links">
                <a href="#">Home</a>
                <a href="#">WikiFarroupilha</a>
                <a href="#">Serviços</a>
                <a href="#">Contatos</a>
            </p>
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
