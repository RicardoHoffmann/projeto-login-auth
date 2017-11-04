<p>Olá, <?= $first_name ?>, </p>
    <p>Informamos que sua conta foi bloqueada após <?= $login_attempts ?> tentativas de login consecutivas.</p>
<p>Se está ciente que foi você, aguarde <?= $time_wait ?> minutos para tentar acessar sua conta novamente. Se você não lembra sua senha poderá redefini-la em
    <?=
        $this->Url->build(
            ['plugin' => 'Accounts/Auth', 'controller' => 'Users', 'action' => 'requestResetPassword'],
            true
        );
    ?>
</p>
    <p>Se precisar, entre em contato com um administrador do Sistema pelo e-mail ctisistemas.svs@iffarroupilha.edu.br ou pelo telefone (55) 3257-4106 ou ramal 4106.</p>