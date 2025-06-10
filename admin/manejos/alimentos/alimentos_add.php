<?php
include(__DIR__ . "/../../../auth/auth.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $tipo_alimento = $_POST['tipo_alimento'];

    $sql = "INSERT INTO alimentos (nome, descricao, tipo_alimento) VALUES ('$nome', '$descricao', '$tipo_alimento')";
    if ($conn->query($sql) === TRUE) {
        header('Location: alimentos.php');
    } else {
        echo "Erro: " . $error;
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Adicionar Alimento</title>
    <link rel="stylesheet" href="../../assets/css/styles.css">
</head>
<body>
    <h1>Adicionar Alimento</h1>
    <form method="post">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required>
        <label for="descricao">Descrição:</label>
        <textarea id="descricao" name="descricao" required></textarea>
        <label for="tipo_alimento">Tipo Alimento:</label>
        <input type="text" id="tipo_alimento" name="tipo_alimento" required>
        <button type="submit">Adicionar</button>
    </form>
</body>
</html>