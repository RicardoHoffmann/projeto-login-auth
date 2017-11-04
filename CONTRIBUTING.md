# Workflow

## Requisitos

* VirtualBox
* Vagrant
* Git
* PHPStorm (+ Instalar plugin Gitlab Projects)

## Configurar o projeto

Na tela de boas vindas do PHPStorm:

1. Check out from Version Control
2. Gitlab
3. tidigital -> tidigital -> https://gitlab.svs.iffarroupilha.edu.br/tidigital/tidigital.git

Com o projeto aberto:

1. Integre o Gitlab ao PHPStorm: Tools -> Task & Contexts do PHPStorm -> Configure Servers
2. Clique em "+" -> Gitlab
3. Server URL: https://gitlab.svs.iffarroupilha.edu.br
4. Copie seu Private token em https://gitlab.svs.iffarroupilha.edu.br/profile/account
5. Selecione o projeto TIDigital
6. Na aba Commit Message marque Add commit message, e cole o texto abaixo:

<pre>
{id} {summary}

<< message here >>

close {id}
</pre>
 
7. Incluir no arquivo hosts do seu sistema operacional:

<pre>
192.168.10.3 tidigital.local
</pre>

## Fluxo baseado no GitHub flow.

1. Abra a tarefa e crie uma branch: Tools -> Task & Contexts do PHPStorm -> Open Task
2. Faça seu(s) commit(s)
3. Tudo pronto? Faça o Merge Request: VCS -> Git -> GitLab -> Create Merge Request (fará o push automaticamente)
4. Volte a tarefa default
5. Carregue as alterações para branch master local:  VCS -> Git -> Pull -> selecione apenas 'origin/master' -> Pull


## Entrega contínua

Após sua branch ser integrada a master, o Gitlab encerrará sua tarefa e entregará as alterações em produção.

## Commandos

* Commit: Menu VCS -> Git -> Commit Directory
* Iniciar VM Vagrant: Tools -> Vagrant -> Up
* Testar aplicação: http://tidigital.local/
* Integrar as alterações da branch remota para sua branch local: Menu VCS -> Git -> Branchs -> Remote Branchs -> origin/branch-name -> merge
* Integrar as alterações da master remota para sua branch local: Menu VCS -> Git -> Branchs -> Remote Branchs -> origin/master -> merge