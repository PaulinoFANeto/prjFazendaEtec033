<?php
include(__DIR__ . "/../../auth/auth.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $cria_id = $_POST['cria_id'];
    $vacina_id = $_POST['vacina_id'];
    $data_aplicacao = $_POST['data_aplicacao'];

    $sql = "INSERT INTO vacinas_crias (cria_id, vacina_id, data_aplicacao) 
    VALUES ('$cria_id', '$vacina_id', '$data_aplicacao')";
    if ($conn->query($sql) === TRUE) {
        header('Location: vacinas_crias.php');
    } else {
        echo "Erro: " . $sql . "<br>" . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Adicionar Vacina para Cria</title>
    <link rel="stylesheet" href="../../assets/css/styles.css">
</head>
<body>
    <h1>Adicionar Vacina para Cria</h1>
    <form method="post">
        <label for="cria_id">ID Cria:</label>
        <input type="number" id="cria_id" name="cria_id" required>
        <label for="vacina_id">ID Vacina:</label>
        <input type="number" id="vacina_id" name="vacina_id" required>
        <label for="data_aplicacao">Data de Aplicação:</label>
        <input type="date" id="data_aplicacao" name="data_aplicacao" required>
        <button type="submit">Adicionar</button>
    </form>
</body>
</html>