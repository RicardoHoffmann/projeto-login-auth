# Accounts/Admin

## O Sistema

_**1. Users**_
 
___
É responsável por listar todos os usuários cadastrado mostrando os dados mais importantes, o Nome Completo, Nome de Usuário e E-mail por exemplo.

Para cada usuário listado há 3 (três) ações, **Visualização**, **Alteração de Senha** e **Edição**.

Quando o Usuário clicar em **Visualização**, ele será redimensionado para um tela onde será listada todas as informações do mesmo, bem como o(s) grupo(s) que ele participa, se houver.

Para auxiliar a busca por um usuário, foi feita a ordenação da listagem em ordem crescente pelo Nome Completo do Usuário e também foi criado um mecanismo de buscas para facilitar a procura por um usuário específico através do Primeiro Nome, Nome de Usuário ou Sobrenome.

Para uma maior segurança, o Sistema permite que apenas Administradores tenham acesso a essa página.

_**2. Groups**_
 
___
O Sistema tem como principal funcionalidade a criação de Grupos e Adição de Novos Usuários ao Grupo. Para isso, o Sistema faz uma listagem de todos os Grupos cadastrados juntamente com os dados, Nome e Data Criaçao por exemplo. A listagem é feita em ordem crescente pelo Nome do Grupo.

Cada grupo listado possui 3 (três) ações possiveis, são elas: **Adição de Novos Usuários ao Grupo**, **Visualização Geral do Grupo** e **Edição do Grupo**.

Para auxiliar o usuário na procura de um grupo específico, foi desenvolvido um mecanismo de buscas através do Nome do Grupo.

Na tela principal quando o Usuário clica na ação **Adicionar Usuário no Grupo**, ele e redimensionado para uma tela onde e feita uma listagem de todos os usuários que ainda não estão no Grupo. E para cada usuário há 2 (duas) ações, **Adicionar** e **Visualizar**. Abaixo dessa listagem, há outra listagem de todos os pertencentes do respectivo Grupo.

Quando o usuário clica em **Visualizar**, ele é redimensionado para uma tela onde é mostrado todas as informações do Grupo. Essa tela também mostra uma lista de todos os usuários pertencentes ao respectivo Grupo.

Para uma maior segurança, o Sistema permite que apenas Administradores tenham acesso a essa página.