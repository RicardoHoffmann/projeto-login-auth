<?php
    use Cake\Routing\Router;
    use Cake\Core\Configure;
    $this->layout = 'login';
?>
<style>
    body {
        background: url(<?=  $this->Url->image('landpage_backgroundd.jpg') ?>)
    }
    .box {
        background: rgba(0, 0, 0, 0.3);;
        padding: 40px;
        border-radius: 5px;
        box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12);
    }
</style>

<div class="row">
    <?= $this->Flash->render('auth') ?>
    <?= $this->Form->create() ?>
    <fieldset>
        <div class="medium-6 medium-centered large-4 large-centered columns box">
            <div class="row column log-in-form">
                <center><?= $this->Html->image('logo-coderace.jpg', ['alt' => 'CodeRace']) ?></center>
                <br>
                <legend></legend>
                <?= $this->Form->input('username', ['required' => true, 'label' => __d('Accounts/auth', 'Username')]) ?>
                <?= $this->Form->input('password', ['required' => true, 'label' => __d('Accounts/auth', 'Password')]) ?>

                <div id="div-captcha"></div>

                <legend><?= __d('Users', '') ?></legend>
                <br>
                <?php
        if (Configure::check('Users.RememberMe.active')) {
            echo $this->Form->input(Configure::read('Users.Key.Data.rememberMe'), [
                        'type' => 'checkbox',
                        'label' => __d('Accounts/auth', 'Remember me'),
                        'checked' => 'checked'
                    ]);
                }
                ?>
                <div class="row" align="center">
                    <p>
                        <?php
                            $registrationActive = Configure::read('Users.Registration.active');
                            if ($registrationActive) {
                                echo $this->Html->link(__d('Accounts/auth', 'Sign Up'), ['plugin' => 'SignUp/User', 'controller' => 'RequestAccount', 'action' => 'register']);
                            }
                            if (Configure::read('Users.Email.required')) {
                                if ($registrationActive) {
                                    echo ' | ';
                            }
                        ?>
                        <?= $this->Html->link(__d('Accounts/auth', 'Forgot password'), ['action' => 'requestResetPassword']) ?>
                        <?php
                            }
                        ?>
                    </p>

                    <?php if (Configure::read('Users.Social.login')) : ?>
                    <?php $providers = Configure::read('OAuth.providers'); ?>
                    <?php foreach ($providers as $provider => $options) : ?>
                    <?php if (!empty($options['options']['redirectUri'])) : ?>
                    <?= $this->User->socialLogin($provider); ?>
                    <?php endif; ?>
                    <?php endforeach; ?>
                    <?php endif; ?>
                    <?= $this->Form->button(__d('Accounts/auth', 'Login')); ?>
                    <?= $this->Form->end() ?>

                </div>
    </fieldset>

    <div class="row" align="center">

    </div>

    <div class="reveal" id="modal" style="alignment: center" data-reveal data-overlay="true"></div>
</div>

<script>

    $( "#modal" ).load( "sign-up/choose/modules/index", function() {} );
    document.getElementById("username").focus();

    $('input[name=username]').change(function() {
        $.ajax({
                url: '<?= Router::url(['plugin' => 'Accounts/Auth', 'controller' => 'Users', 'action' => 'render-captcha']) ?>' +
        '/' + encodeURIComponent($('input[name=username]').val()),
            beforeSend: function () {
                $('#div-captcha').html('<?= $this->Html->image('ajax-loader.gif', ['alt' => 'loading...']) ?>');
            }
        })
        .done(function (data) {
            $('#div-captcha').html(data);
        });
    });

    $( window ).load(function() {
        if ($('input[name=username]').val() != '') {
            $.ajax({
                    url: '<?= Router::url(['plugin' => 'Accounts/Auth', 'controller' => 'Users', 'action' => 'render-captcha']) ?>' +
            '/' + encodeURIComponent($('input[name=username]').val()),
                beforeSend: function () {
                $('#div-captcha').html('<?= $this->Html->image('ajax-loader.gif', ['alt' => 'loading...']) ?>');
            }
        })
        .done(function (data) {
                $('#div-captcha').html(data);
            });
        }
    });

</script>