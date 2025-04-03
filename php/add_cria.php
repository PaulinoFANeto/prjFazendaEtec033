<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $parto_id = $_POST['parto_id'];
    $nome = $_POST['nome'];
    $peso_nascimento = $_POST['peso_nascimento'];
    $data_nascimento = $_POST['data_nascimento'];

    $sql = "INSERT INTO crias (parto_id, nome, peso_nascimento, data_nascimento) VALUES ('$parto_id', '$nome', '$peso_nascimento', '$data_nascimento')";
    if ($conn->query($sql) === TRUE) {
        header('Location: crias.php');
    } else {
        echo "Erro: " . $sql . "<br>" . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Adicionar Cria</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Adicionar Cria</h1>
    <form method="post">
        <label for="parto_id">ID Parto:</label>
        <input type="number" id="parto_id" name="parto_id" required>
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required>
        <label for="peso_nascimento">Peso ao Nascimento:</label>
        <input type="number" step="0.01" id="peso_nascimento" name="peso_nascimento" required>
        <label for="data_nascimento">Data de Nascimento:</label>
        <input type="date" id="data_nascimento" name="data_nascimento" required>
        <button type="submit">Adicionar</button>
    </form>
</body>
</html>