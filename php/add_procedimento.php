<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];

    $sql = "INSERT INTO procedimentos (nome, descricao) VALUES ('$nome', '$descricao')";
    if ($conn->query($sql) === TRUE) {
        header('Location: procedimentos.php');
    } else {
        echo "Erro: " . $error;
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Adicionar Procedimento</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Adicionar Procedimento</h1>
    <form method="post">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required>
        <label for="descricao">Descrição:</label>
        <textarea id="descricao" name="descricao" required></textarea>
        <button type="submit">Adicionar</button>
    </form>
</body>
</html>