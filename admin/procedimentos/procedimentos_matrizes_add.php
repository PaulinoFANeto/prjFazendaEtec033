<?php
include(__DIR__ . "/../../auth/auth.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $matriz_id = $_POST['matriz_id'];
    $procedimento_id = $_POST['procedimento_id'];
    $data_procedimento = $_POST['data_procedimento'];
    $descricao = $_POST['descricao'];

    $sql = "INSERT INTO procedimentos_matrizes (matriz_id, procedimento_id, data_procedimento, descricao) VALUES ('$matriz_id', '$procedimento_id', '$data_procedimento', '$descricao')";
    if ($conn->query($sql) === TRUE) {
        header('Location: procedimentos_matrizes.php');
    } else {
        echo "Erro: " . $sql . "<br>" . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Adicionar Procedimento para Matriz</title>
    <link rel="stylesheet" href="../../assets/css/styles.css">
</head>
<body>
    <h1>Adicionar Procedimento para Matriz</h1>
    <form method="post">
        <label for="matriz_id">ID Matriz:</label>
        <input type="number" id="matriz_id" name="matriz_id" required>
        <label for="procedimento_id">ID Procedimento:</label>
        <input type="number" id="procedimento_id" name="procedimento_id" required>
        <label for="data_procedimento">Data do Procedimento:</label>
        <input type="date" id="data_procedimento" name="data_procedimento" required>
        <label for="descricao">Descrição:</label>
        <textarea id="descricao" name="descricao" required></textarea>
        <button type="submit">Adicionar</button>
    </form>
</body>
</html>