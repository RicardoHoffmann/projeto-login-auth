<p>Olá, informamos que há um novo usuário aguardando sua aprovação de acesso ao Projeto CadeRace.</p>
<?=
    $this->Url->build(
        ['plugin' => 'SignUp/User', 'controller' => 'VerifyAccount', 'action' => 'index'],
        true
    );
?>
