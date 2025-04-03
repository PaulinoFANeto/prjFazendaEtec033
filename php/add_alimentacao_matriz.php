<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $matriz_id = $_POST['matriz_id'];
    $tipo_alimento = $_POST['tipo_alimento'];
    $quantidade = $_POST['quantidade'];
    $data = $_POST['data'];

    $sql = "INSERT INTO alimentacao_matrizes (matriz_id, tipo_alimento, quantidade, data) VALUES ('$matriz_id', '$tipo_alimento', '$quantidade', '$data')";
    if ($conn->query($sql) === TRUE) {
        header('Location: alimentacao_matrizes.php');
    } else {
        echo "Erro: " . $sql . "<br>" . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Adicionar Alimentação para Matriz</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Adicionar Alimentação para Matriz</h1>
    <form method="post">
        <label for="matriz_id">ID Matriz:</label>
        <input type="number" id="matriz_id" name="matriz_id" required>
        <label for="tipo_alimento">Tipo de Alimento:</label>
        <input type="text" id="tipo_alimento" name="tipo_alimento" required>
        <label for="quantidade">Quantidade:</label>
        <input type="number" step="0.01" id="quantidade" name="quantidade" required>
        <label for="data">Data:</label>
        <input type="date" id="data" name="data" required>
        <button type="submit">Adicionar</button>
    </form>
</body>
</html>