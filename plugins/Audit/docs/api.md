# Audit

# Habilitar auditoria

## Habilitar plugin AuditStash - https://github.com/lorenzo/audit-stash/

```
composer require lorenzo/audit-stash
bin/cake plugin load AuditStash
```
```
composer require cakephp/elastic-search
bin/cake plugin load Cake/ElasticSearch
```
```
composer require friendsofcake/crud
```

## Configuração

app.php:
```
'Datasources' => [
    'auditlog_elastic' => [
        'className' => 'Cake\ElasticSearch\Datasource\Connection',
        'driver' => 'Cake\ElasticSearch\Datasource\Connection',
        'host' => '127.0.0.1', // server where elasticsearch is running
        'port' => 9200,
       'index' => 'audit-logs%s', // Just add a %s at the end
    ],
    ...
]
```




bootstrap.php:

```
Plugin::load('Audit', ['bootstrap' => true, 'routes' => true]);
```

src/AppController.php::initialize():

```
$this->loadComponent('Audit.Audit');
$this->Audit->auditStashCallback();
```

## Configurando Migrations

Você pode instalar este plugin em sua aplicação CakePHP usando [composer](https://getcomposer.org/).

Execute o seguinte comando

    composer require cakephp/migrations

Você pode carregar o plugin usando o comando shell:

    bin/cake plugin load Migrations
   
Ou você pode adicionar manualmente a instrução de carregamento no **config/boostrap.php** arquivo do seu aplicativo:

    Plugin::load('Migrations');

## Executar Migrations
Para executar os Migrations de uma única vez, você pode executar o comando abaixo:

> Certifique-se que a Base de Dados já esteja criada.


    bin/cake migrations migrate --plugin Audit

Ao Executar o comando acima, irá ser criadas as Tabelas do Plugin e mais uma tabela chamada **phinxlog** que irá armazenar os logs da execução das migrations. Para saber mais sobre o funcionamento do Phinx, clique [aqui](http://docs.phinx.org/en/latest/).



Você pode também verificar o Status das Migrations, usando o comando abaixo:

    bin/cake migrations status


Irá aparecer algo semelhante a isso:

       Status  Migration ID    Migration Name 
    -----------------------------------------
         up  20160909123248  CreateAuditLogs             
         up  20160909123330  CreatePersons               
         up  20160909123416  CreateUserAccessLogs        
         up  20160909123448  CreateUsers                 
         up  20160909123546  AddForeignKeyAuditLogs      
         up  20160909123747  AddForeignKeyPersons        
         up  20160909123858  AddForeignKeyUserAccessLogs 
_**Status**_

___
**Up** quer dizer que a Migrations foi executada. E **Down** que não foi executada. Caso houver uma Migration com Status **down**, execute o comando para gerar as Migrations novamente. Até todas estarem com Status **up**.

## Documentação

A documentação completa sobre Migrations pode ser encontrado em [CakePHP Cookbook](http://book.cakephp.org/3.0/en/migrations.html).