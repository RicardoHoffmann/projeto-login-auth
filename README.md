# Projeto Login + Auth

Projeto que enfatiza Login, autentificação e permissões por usuários e grupos usando CakePHP 3

## 1º Passo
```
git clone https://github.com/jeffersonbehling/projeto-login-auth.git
```
Depois de clonar o projeto, execute no terminal:
```
cd projeto-login-auth
```
Depois disso, execute: 
```
composer update
```
E por fim, crie duas pastas:
```
mkdir tmp
```
Verifique se a extensão ```php-gd``` está habilitado no arquivo ```php.ini```

E dê permissões para ambas
```
sudo chmod 777 -R tmp/
```
```
sudo chmod 777 -R logs/
```

## 2º Passo
- Crie a base de dados ```projeto_coderace```
- Verifique as configurações em ```config/datasources/config.php```
- Dentro de ```projeto-login-auth```
- Execute a criação das tabelas
```
bin/cake migrations migrate --plugin Accounts/Admin
```
```
bin/cake migrations migrate --plugin Accounts/Auth
```
```
bin/cake migrations migrate --plugin Accounts/Authz
```
```
bin/cake migrations migrate --plugin Accounts/Profile
```
```
bin/cake migrations migrate --plugin Audit
```
```
bin/cake migrations migrate --plugin LoggingPack
```

## 3º Passo
- Popule as tabelas com alguns dados pré-definidos

```
bin/cake migrations seed --plugin Accounts/Admin
```

###### Obs: O comando acima irá inserir dois usuários no banco de dados, na tabela ```users```
`Usuário e Senha: superadmin`

`Usuário e Senha: user` 

- Criação de menus
```
bin/cake migrations seed --plugin Accounts/Authz
```

## 4º Passo
Configure um e-mail para que seja possível enviar e-mails para os Administradores do Sistema quando tem um novo usuário, para que ele possa autorizá-lo. Lembre-se de ir no gmail, e autorizar acesso para Aplicativos menos seguros em sua conta.
```
'EmailTransport' => [
        'default' => [
            'className' => 'Smtp',
            // The following keys are used in SMTP transports
            'host' => 'ssl://smtp.gmail.com',
            'port' => 465,
            'timeout' => 30,
            'username' => 'YOUR_EMAIL@GMAIL.COM',
            'password' => 'YOUR_PASS',
            'client' => null,
            'tls' => null,
            'url' => env('EMAIL_TRANSPORT_DEFAULT_URL', null),
        ],
    ],
```

## 5º Passo
- Acesse ```/projeto-login-auth/login``` e faça login.

## Tela de Login

[Login](https://github.com/jeffersonbehling/projeto-login-auth/blob/master/webroot/img/screenshots/login.png)
![alt text](https://github.com/jeffersonbehling/projeto-login-auth/blob/master/webroot/img/screenshots/login.png)
