<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $raca = $_POST['raca'];
    $peso = $_POST['peso'];
    $data_nascimento = $_POST['data_nascimento'];
    $data_entrada = $_POST['data_entrada'];

    $sql = "INSERT INTO matrizes (nome, raça, peso, data_nascimento, data_entrada) VALUES ('$nome', '$raca', '$peso', '$data_nascimento', '$data_entrada')";
    if ($conn->query($sql) === TRUE) {
        header('Location: matrizes.php');
    } else {
        echo "Erro: " . $sql . "<br>" . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Adicionar Matriz</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Adicionar Matriz</h1>
    <form method="post">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required>
        <label for="raca">Raça:</label>
        <input type="text" id="raca" name="raca" required>
        <label for="peso">Peso:</label>
        <input type="number" step="0.01" id="peso" name="peso" required>
        <label for="data_nascimento">Data de Nascimento:</label>
        <input type="date" id="data_nascimento" name="data_nascimento" required>
        <label for="data_entrada">Data de Entrada:</label>
        <input type="date" id="data_entrada" name="data_entrada" required>
        <button type="submit">Adicionar</button>
    </form>
</body>
</html>