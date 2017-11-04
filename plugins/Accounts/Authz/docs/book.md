# Accounts/Authz

## O Sistema

Essa parte do Sistema é responsável por fazer a autorização de acesso dos Usuários e Grupos, ou seja, é nessa parte do sistema que será feita o que o usuário ou membros do Grupo poderão acessar. O página inicial das autorizações, apenas pode ser acessada por superusuários/administradores.
O Sistema tem 3 (três) tipos de autorizações, **Por Grupo**, **Por Usuário** e **Todos os Usuários**.

_**Por Usuário/Por Grupo**_

___
A tela inicial da autorização **Por Usuário/Por Grupo** faz a listagem de todos os usuários/grupos cadastrados no Sistema. E para cada usuário/grupo é atribuído duas ações, **Autorização** e **Visualização**.
Esta tela inicial também conta com o auxílio de uma ferramenta de busca para encontrar um usuário/grupo específico de forma mais fácil, para usuários pode-se informar o *Nome de Usuário*, *Primeiro Nome* ou *Sobrenome* e para o grupo pode-se informar o **Nome do Grupo** para retornar um usuário/grupo específico.
Ao clicar em **Visualizar** será mostrado todas as informações do respectivo usuário/grupo. E ao clicar em **Autorização**, o superusuário será redimensionado para uma tela onde ele poderá escolher o que o usuário/grupo poderá acessar no sistema.
Quando é feita uma autorização para um grupo, todos os usuários daquele grupo adquirem essa autorização/permissão.

_**Todos os Usuários**_

___
Quando o superusuário escolher a opção **Todos os Usuários** ele é automaticamente redimensionado para a tela de autorização, podendo escolher o que todos os usuários do sistema podem acessar.
Essa função de autorizar todos os usuários de acessar uma página específica de uma única vez, é para facilitar o uso do sistema, para que o superusuário não precise dar a mesma permissão para cada usuário separadamente.

_**Autorização/Permissão**_

___
Para dar a Autorização/Permissão, seja ela **Por Usuário**, **Por Grupo** ou **Todos os Usuários** o superusuário precisa seguir os passos abaixo:

1° Passo: Selecionar o Plugin;
2º Passo: Selecionar o Controlador;
3º Passo: Selecionar a Ação;
4° Passo: Selecionar o Tipo de Acesso (Permitido ou Negado);
5° Passo: Clicar em Adicionar;

Pronto! Está feita a Autorização e o(s) usuário(s) ou membros do grupo já terão acesso aquela página.

No final da página de Autorizações/Permissões está listada todas as permissões que o usuário/grupo já possui. Para cada autorização há uma ação de **Excluir**, que serve para remover uma autorização/permissão.