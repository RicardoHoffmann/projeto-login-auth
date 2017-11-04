# Projeto Login + Auth

Projeto que enfatiza Login, autentificação e permissões por usuários e grupos usando CakePHP 3

## 1º Passo
```
git clone https://github.com/jeffersonbehling/projeto-login-auth.git
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
- Acesse ```/projeto-login-auth/login``` e faça login.