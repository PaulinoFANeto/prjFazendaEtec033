<?php
include(__DIR__ . "/../../auth/auth.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $matriz_id = $_POST['matriz_id'];
    $peso = $_POST['peso'];
    $data_pesagem = $_POST['data_pesagem'];

    $sql = "INSERT INTO pesagem_matrizes (matriz_id, peso, data_pesagem) VALUES ('$matriz_id', '$peso', '$data_pesagem')";
    if ($conn->query($sql) === TRUE) {
        header('Location: pesagem_matrizes.php');
    } else {
        echo "Erro: " . $sql . "<br>" . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Adicionar Pesagem para Matriz</title>
    <link rel="stylesheet" href="../../assets/css/styles.css">
</head>
<body>
    <h1>Adicionar Pesagem para Matriz</h1>
    <form method="post">
        <label for="matriz_id">ID Matriz:</label>
        <input type="number" id="matriz_id" name="matriz_id" required>
        <label for="peso">Peso:</label>
        <input type="number" step="0.01" id="peso" name="peso" required>
        <label for="data_pesagem">Data:</label>
        <input type="date" id="data_pesagem" name="data_pesagem" required>
        <button type="submit">Adicionar</button>
    </form>
</body>
</html>