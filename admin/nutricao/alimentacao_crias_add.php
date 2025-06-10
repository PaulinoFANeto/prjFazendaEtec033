<?php
include(__DIR__ . "/../../auth/auth.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $cria_id = $_POST['cria_id'];
    $alimento_id = $_POST['alimento_id'];
    $quantidade = $_POST['quantidade'];
    $data = $_POST['data'];

    $sql = "INSERT INTO alimentacao_crias (cria_id, alimento_id, quantidade, data_alimentacao) VALUES ('$cria_id', '$alimento_id', '$quantidade', '$data')";
    if ($conn->query($sql) === TRUE) {
        header('Location: alimentacao_crias.php');
    } else {
        echo "Erro: " . $sql . "<br>" . $conn->error;
    }
}

?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Adicionar Alimentação para Cria</title>
    <link rel="stylesheet" href="../../assets/css/styles.css">
</head>

<body>
    <h1>Adicionar Alimentação para Cria</h1>
    <form method="post">
        <label for="cria_id">ID Cria:</label>
        <input type="number" id="cria_id" name="cria_id" required>
        <label for="alimento_id">ID Alimento:</label>
        <input type="number" id="alimento_id" name="alimento_id" required>
        <label for="quantidade">Quantidade:</label>
        <input type="number" step="0.01" id="quantidade" name="quantidade" required>
        <label for="data">Data:</label>
        <input type="date" id="data" name="data" required>
        <button type="submit">Adicionar</button>
    </form>
</body>

</html>