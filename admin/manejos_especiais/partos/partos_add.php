<?php
// O código abaixo necessita ser revisado pois não está funcionando corretamente - Letícia
session_start();
include(__DIR__ . "/../../../auth/auth.php");

// Fiz isto para buscar as matrizes do banco de dados facilitando a seleção por nome no formulário - Paulino
$sqlMatrizes = "SELECT id, nome FROM matrizes ORDER BY nome";
$resultMatrizes = $conn->query($sqlMatrizes);
if (!$resultMatrizes) {
    die("Erro ao buscar matrizes: " . $conn->error);
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $matriz_id = $_POST['matriz_id'];
    $data_prevista_parto = $_POST['data_prevista_parto'];
    $data_efetiva_parto = $_POST['data_efetiva_parto'];
    $data_prevista_desmame = $_POST['data_prevista_desmame'];
    $data_efetiva_desmame = $_POST['data_efetiva_desmame'];
    $data_prevista_maternidade = $_POST['data_prevista_maternidade'];
    $data_efetiva_maternidade = $_POST['data_efetiva_maternidade'];
    $qtd_crias = $_POST['qtd_crias'];
    $usuario_id = $_SESSION['usuario_id'];
    $data_acao = date('Y-m-d H:i:s');

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
    <link rel="stylesheet" href="../../../assets/css/estilo.css">
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