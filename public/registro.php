<!-- Regras de Negócio para o cadastro de usuários:
    O campo usuário:
        - Deve ser único e não pode conter caracteres especiais.
        - Deve ter entre 3 e 20 caracteres.
        - Não pode ser igual ao nome do usuário logado.
    O campo senha:
        - Deve ter entre 6 e 20 caracteres.
        - Deve conter letras maiúsculas, minúsculas, números e simbolos.
        - Não pode ser igual ao nome do usuário logado.
    O campo email:
        - Deve ser único e não pode conter caracteres especiais.
        - Deve ser um email válido.
        - Não pode ser igual ao email do usuário logado.
    O campo nível de acesso:
        - Deve ser um dos seguintes: administrador, docente, auxiliar docente ou aluno.
        - Não pode ser igual ao nível de acesso do usuário logado.
    - O usuário logado não pode cadastrar outro usuário com o mesmo nível de acesso.
    - O usuário logado não pode cadastrar outro usuário com o mesmo nome de usuário ou email.
-->
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro - Sistema Fazenda ETEC</title>
    <!-- <link rel="stylesheet" href="./css/estilo_registro.css"> -->
</head>
<body>

    <div class="register-container">
        <h2>Cadastrar Usuário</h2>
        <form action="usuario.php" method="POST">
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
            <!-- O pattern abaixo utilizado no input email faz o seguinte:
                Deve ser único e não pode conter caracteres especiais: ^[a-zA-Z0-9._%+-]+ - Garante que apenas caracteres alfanuméricos e alguns caracteres permitidos (ponto, sublinhado, porcentagem, mais e hífen) sejam usados antes do símbolo @.
                Deve ser um email válido: @[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$ - Garante que o formato do email seja válido, incluindo o domínio e a extensão.
            -->
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required pattern="^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$"><br>
            <label for="nivel_acesso">Nível de Acesso:</label>
            <select id="nivel_acesso" name="nivel_acesso" required>
                <option value="administrador">Administrador</option>
                <option value="docente">Docente</option>
                <option value="auxiliar">Auxiliar docente</option>
                <option value="aluno">Aluno</option>
            </select><br>
            <input type="submit" value="Cadastrar">
            <div>
                <button type="button"><a href="../index.php">Voltar</a></button>
            </div>
        </form>
    </div>
</body>
</html>