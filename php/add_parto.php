<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $matriz_id = $_POST['matriz_id'];
    $data_parto = $_POST['data_parto'];
    $data_desmame = $_POST['data_desmame'];

    $sql = "INSERT INTO partos (matriz_id, data_parto, data_desmame) VALUES ('$matriz_id', '$data_parto', '$data_desmame')";
    if ($conn->query($sql) === TRUE) {
        header('Location: partos.php');
    } else {
        echo "Erro: " . $sql . "<br>" . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Adicionar Parto</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Adicionar Parto</h1>
    <form method="post">
        <label for="matriz_id">ID Matriz:</label>
        <input type="number" id="matriz_id" name="matriz_id" required>
        <label for="data_parto">Data do Parto:</label>
        <input type="date" id="data_parto" name="data_parto" required>
        <label for="data_desmame">Data do Desmame:</label>
        <input type="date" id="data_desmame" name="data_desmame" required>
        <button type="submit">Adicionar</button>
    </form>
</body>
</html>