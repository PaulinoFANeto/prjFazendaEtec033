# prjFazendaEtec033
Projeto de controle de fazenda

Como configurar o Git Hub
    Primeiro:
        crie uma pasta do projeto ou 
        clone o projetoFazendaEtec => git clone <<url do repositório>>
    Segundo:
        iniciar o git na pasta criada ==> git init
    Terceiro:
        configure a conta de usuario ==> git config --global user.name "PaulinoFANeto"
        configure o email de usuario ==> git config --global user.email "paulino646@hotmail.com"
    Quarto:
        configure o repositório onde ficará as mudanças do projeto ==> git remote add origin https://github.com/PaulinoFANeto/prjFazendaEtec033

Como atualizar o diretório antes de começar a trabalhar no projeto
    git pull origin main ==> Deixa o diretório igual ao repositório para todos os participantes do projeto

Como usar o Git Hub sempre que fazer uma alteração nos arquivos do repositório
    git add . ==> prepara os arquivos que foram manipulados para serem salvos efetivados no projeto através do commit
    git commit -m "<<digite o que foi alterado aqui>>" ==> efetua as alteraçoes devidas
    git push origin main ==> Envia sobreescrevendo o arquivo que já está no repositório

Para aceitar as modificações de um branch no main no Git, você pode seguir os seguintes passos:

1. **Troque para o branch main**:           git checkout main
2. **Atualize o branch main**:              git pull origin main
3. **Faça o merge do branch desejado**:     git merge nome-do-branch
4. **Resolva conflitos (se houver)**:       git add arquivos-afetados
   Caso haja conflitos, o Git irá notificá-lo. 
   Você precisará resolver os conflitos manualmente nos arquivos afetados e depois adicionar as mudanças resolvidas:
5. **Finalize o merge**:                    git commit -m "Merge do branch nome-do-branch no main"
6. **Envie as mudanças para o repositório remoto**:   git push origin main
