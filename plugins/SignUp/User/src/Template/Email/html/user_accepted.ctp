<p>Olá, <?= $first_name ?>, informamos que sua solicitação de cadastro foi aprovada. Agora você já está liberado para acessar sua conta.</p>
<?=
    $this->Url->build(
        ['plugin' => 'Accounts/Auth', 'controller' => 'Users', 'action' => 'login'],
        true
    );
?>