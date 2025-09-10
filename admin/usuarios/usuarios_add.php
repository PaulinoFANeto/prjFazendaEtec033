<?php
session_start();
include("../../database/funcoes.php");
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="form.css">
    <title>Adicionar usuário</title>
</head>

<body>
    <div class="container-form">
        <form action="../../database/usuarios/usuarios_add.php" method="post">
            <h1>Cadastrar Usuário</h1>
            <input type="hidden" name="csrf" value="<?= gerarCSRF() ?>">
            <div class="container-input">
                <label for="usuario">Usuário</label>
                <input type="text" name="usuario" id="usuario" placeholder="Digite seu usuário" required
                    pattern="^[a-zA-Z0-9_]{4,20}$"
                    title="Usuário deve ter de 4 a 20 caracteres, letras, números ou underline.">
            </div>
            <div class="container-input">
                <label for="email">E-mail</label>
                <input type="email" name="email" id="email" placeholder="Digite seu e-mail" required
                    pattern="^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$" title="Digite um e-mail válido.">
            </div>
            <div class="container-input">
                <label for="nivel_acesso">Nível Acesso</label>
                <select name="nivel_acesso" id="nivel_acesso" required>
                    <option value="0">Adiministrador</option>
                    <option value="1">Auxiliar Docente</option>
                    <option value="2">Professor</option>
                    <option value="3" selected>Aluno</option>
                </select>
            </div>
            <div class="container-input">
                <label for="senha">Senha</label>
                <input type="password" name="senha" id="senha" placeholder="Digite sua senha" required
                    pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^a-zA-Z0-9]).{8,}$"
                    title="A senha deve ter no mínimo 8 caracteres, incluindo letra maiúscula, minúscula, número e símbolo.">
            </div>
            <button type="submit">Adicionar usuário</button>
            <a href="usuarios.php">Cancelar</a>
        </form>
    </div>
</body>

</html>