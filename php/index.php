<!-- Regras de Negócio para fazer login:
    O campo usuário:
        - Deve ser único e não pode conter caracteres especiais.
        - Deve ter entre 3 e 20 caracteres.
    O campo senha:
        - Deve ter entre 6 e 20 caracteres.
        - Deve conter letras maiúsculas, minúsculas, números e simbolos.
-->

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistema Fazenda Etec</title>
    <!-- <link rel="stylesheet" href="css/estilo_login.css"> -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/cookieconsent@3/build/cookieconsent.min.css">

</head>
<body>
    <div class="login-container">
        <h2>Login</h2>
        <form action="login.php" method="POST">
            <!-- Este pattern abaixo no input text faz o seguinte:
                Deve ser único e não pode conter caracteres especiais: ^[a-zA-Z0-9] - Garante que apenas caracteres alfanuméricos sejam permitidos.
                Deve ter entre 3 e 20 caracteres: {3,20}$ - Limita o comprimento do campo entre 3 e 20 caracteres.
            -->
            <label for="usuario">Usuário:</label>
            <input type="text" id="usuario" name="usuario" required pattern="^[a-zA-Z0-9]{3,20}$" ><br>
            <!-- O pattern abaixo utilizado no input password faz o seguinte:
                Deve ter entre 6 e 20 caracteres: [A-Za-z\d@$!%*?&]{6,20}$ - Limita o comprimento do campo entre 6 e 20 caracteres.
                Deve conter letras maiúsculas: (?=.*[A-Z]) - Garante que haja pelo menos uma letra maiúscula.
                Deve conter letras minúsculas: (?=.*[a-z]) - Garante que haja pelo menos uma letra minúscula.
                Deve conter números: (?=.*\d) - Garante que haja pelo menos um número.
                Deve conter símbolos: (?=.*[@$!%*?&]) - Garante que haja pelo menos um símbolo especial.
            -->
            <label for="senha">Senha:</label>
            <input type="password" id="senha" name="senha" required pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{6,20}$"><br>
            <button type="submit" value="Submit">Entrar</button> <br>
            <button type="reset" value="Limpar">Limpar</button>
        </form>
        <a href="registro.php">Cadastrar novo usuário</a>
    </div>
    <!-- <script src="js/scripts.js"></script> -->

    <script 
        src="https://cdn.jsdelivr.net/npm/cookieconsent@3/build/cookieconsent.min.js" data-cfasync="false">
    </script>
    
    <script>
        window.cookieconsent.initialise({
        "palette": {
            "popup": {
            "background": "#f5f5f5",
            "text": "#000000"
            },
            "button": {
            "background": "#009900",
            "text": "#ffffff"
            }
        },
        "content": {
            "message": "Este site usa cookies para garantir que você obtenha a melhor experiência de navegação. Desativar os cookies do site pode prejudicar a funcionalidade de alguns recursos.",
            "dismiss": "Concordar e fechar",
            "link": "Ler mais",
            // a referência abaixo precisa ser desenvolvida por isto está como um exemplo
            // "href": "https://seu-dominio-de-site.com.br/pagina-da-politica"
        }
        });
    </script>
</body>
</html>