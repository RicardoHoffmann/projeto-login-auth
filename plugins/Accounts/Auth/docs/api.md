# Accounts/Auth

## Migrations

Para executar os Migrations de uma única vez, você pode executar o comando abaixo:

```
bin/cake migrations migrate --plugin Accounts/Admin
```
Ao Executar o comando acima, irá ser criadas as Tabelas do Plugin e mais uma tabela chamada **phinxlog** que irá armazenar os logs da execução das migrations. Para saber mais sobre o funcionamento do Phinx, clique [aqui](http://docs.phinx.org/en/latest/).

Você pode também verificar o Status das Migrations, usando o comando abaixo:

```
 bin/cake migrations status
```

Irá aparecer algo semelhante a isso:

```
Status  Migration ID    Migration Name 
-----------------------------------------
   up  20160908115357  CreateUsers 
   up  20160908115509  CreateGroups 
   up  20160908115618  CreateUserGroups 
   down  20160908120114  AddForeignKeyUserGroups
```

**Up** quer dizer que a Migrations foi executada. E **Down** que não foi executada.

## Documentação

A documentação completa sobre Migrations pode ser encontrado em [CakePHP Cookbook](http://book.cakephp.org/3.0/en/migrations.html).