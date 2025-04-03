<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $cria_id = $_POST['cria_id'];
    $procedimento_id = $_POST['procedimento_id'];
    $data_procedimento = $_POST['data_procedimento'];
    $descricao = $_POST['descricao'];

    $sql = "INSERT INTO procedimentos_crias (cria_id, procedimento_id, data_procedimento, descricao) VALUES ('$cria_id', '$procedimento_id', '$data_procedimento', '$descricao')";
    if ($conn->query($sql) === TRUE) {
        header('Location: procedimentos_crias.php');
    } else {
        echo "Erro: " . $sql . "<br>" . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Adicionar Procedimento para Cria</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Adicionar Procedimento para Cria</h1>
    <form method="post">
        <label for="cria_id">ID Cria:</label>
        <input type="number" id="cria_id" name="cria_id" required>
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