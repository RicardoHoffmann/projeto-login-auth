# Accounts/Authz

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


    bin/cake migrations migrate --plugin Accounts/Authz

Ao Executar o comando acima, irá ser criadas as Tabelas do Plugin e mais uma tabela chamada **phinxlog** que irá armazenar os logs da execução das migrations. Para saber mais sobre o funcionamento do Phinx, clique [aqui](http://docs.phinx.org/en/latest/).

Você pode também verificar o Status das Migrations, usando o comando abaixo:

    bin/cake migrations status


Irá aparecer algo semelhante a isso:

    Status  Migration ID    Migration Name 
    -----------------------------------------
       up  20160908121424  CreateUsers                   
       up  20160908121605  CreateGroups                  
       up  20160908121635  CreateMenus                   
       up  20160908121803  CreateSimpleRbac              
       up  20160908121850  CreateSimpleRbacGroups        
       up  20160908121926  CreateSimpleRbacUsers         
       up  20160908122328  AddForeignKeySimpleRbacGroups 
       up  20160908122544  AddForeignKeySimpleRbacUsers  

_**Status**_

___
**Up** quer dizer que a Migrations foi executada. E **Down** que não foi executada. Caso houver uma Migration com Status **down**, execute o comando para gerar as Migrations novamente. Até todas estarem com Status **up**.

## Documentação

A documentação completa sobre Migrations pode ser encontrado em [CakePHP Cookbook](http://book.cakephp.org/3.0/en/migrations.html).