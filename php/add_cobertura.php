<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $matriz_id = $_POST['matriz_id'];
    $data_cobertura = $_POST['data_cobertura'];

    $sql = "INSERT INTO coberturas (matriz_id, data_cobertura) VALUES ('$matriz_id', '$data_cobertura')";
    if ($conn->query($sql) === TRUE) {
        header('Location: coberturas.php');
    } else {
        echo "Erro: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Adicionar Cobertura</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Adicionar Cobertura</h1>
    <form method="post">
        <label for="matriz_id">ID Matriz:</label>
        <input type="number" id="matriz_id" name="matriz_id" required>
        <label for="data_cobertura">Data de Cobertura:</label>
        <input type="date" id="data_cobertura" name="data_cobertura" required>
        <button type="submit">Adicionar</button>
    </form>
</body>
</html>
