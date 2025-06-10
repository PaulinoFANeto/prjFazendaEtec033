<?php
include(__DIR__ . "/../../auth/auth.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $cria_id = $_POST['cria_id'];
    $peso = $_POST['peso'];
    $data_pesagem = $_POST['data_pesagem'];

    $sql = "INSERT INTO pesagem_crias (cria_id, peso, data_pesagem) VALUES ('$cria_id', '$peso', '$data_pesagem')";
    if ($conn->query($sql) === TRUE) {
        header('Location: pesagem_crias.php');
    } else {
        echo "Erro: " . $sql . "<br>" . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Adicionar Pesagem para Cria</title>
    <link rel="stylesheet" href="../../assets/css/styles.css">
</head>
<body>
    <h1>Adicionar Pesagem para Cria</h1>
    <form method="post">
        <label for="cria_id">ID Cria:</label>
        <input type="number" id="cria_id" name="cria_id" required>
        <label for="peso">Peso:</label>
        <input type="number" step="0.01" id="peso" name="peso" required>
        <label for="data_pesagem">Data:</label>
        <input type="date" id="data_pesagem" name="data_pesagem" required>
        <button type="submit">Adicionar</button>
    </form>
</body>
</html>