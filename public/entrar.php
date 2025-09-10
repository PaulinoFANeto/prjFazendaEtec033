<!-- Veja orientações de funcionamento deste arquivo, no arquivo "regras_negocio.txt" -->
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistema Fazenda Etec</title>

    <!-- Link para o CSS do arquivo "estilo_index.css".
        observações:
        1. Certifique-se que o arquivo CSS esteja na pasta "css" do projeto.
        2. Se não tiver o arquivo CSS, deixe comentada a linha abaixo.
        3. Se tiver o arquivo CSS, descomente a linha abaixo.
    -->
    <link rel="stylesheet" href="../assets/css/form.css">
    <link rel="stylesheet" href="../assets/css/style.css">

    <!-- Link de importação da biblioteca css de autorização de cookies -->
    <!-- <link rel="stylesheet" type="text/css"
        href="https://cdn.jsdelivr.net/npm/cookieconsent@3/build/cookieconsent.min.css"> -->

</head>

<body>
    <div class="container">
        <h2>Login</h2>

        <form action="../auth/entrar.php" method="POST">
            <label for="usuario">Usuário:</label>
            <input type="text" id="usuario" name="usuario" required pattern="^[a-zA-Z0-9]{3,20}$">

            <label for="senha">Senha:</label>
            <input type="password" id="senha" name="senha" required
                pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{6,20}$">

            <div class="options">
                <label><input type="checkbox"> Lembrar pra mim</label>
                <a href="#">Esqueci minha senha</a>
            </div>

            <button type="submit" class="btn" value="Submit">Entrar</button>

            <div class="create-account">
                <a href="registro.php">Não tem usuário? Cadastre-se</a>
            </div>
        </form>
        <button onclick="history.back()">Voltar para index</button>

    </div>
    <!--
    <footer>
        <p>&copy; 2025 Fazenda Etec-033. Todos os direitos reservados.</p>
    </footer>
-->

    <!-- Link de importação da biblioteca js de autorização de cookies
    <script src="https://cdn.jsdelivr.net/npm/cookieconsent@3/build/cookieconsent.min.js" data-cfasync="false">
    </script> -->

    <!-- Script de autorização de cookies
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
    </script> -->
</body>

</html>