<?php
include(__DIR__ . "/../../../auth/auth.php");
// Verifica se o usuário está autenticado

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $matriz_id = $_POST['matriz_id'];
    $data_cobertura = $_POST['data_cobertura'];

    $sql = "INSERT INTO coberturas (matriz_id, data_cobertura) VALUES ('$matriz_id', '$data_cobertura')";
    if ($conn->query($sql) === TRUE) {
        // Buscar o último valor de dia_previsto_gestacao
        $config_sql = "SELECT dia_previsto_gestacao FROM configuracoes ORDER BY data_acao DESC LIMIT 1";
        $config_result = $conn->query($config_sql);

        if ($config_result && $config_result->num_rows > 0) {
            $config = $config_result->fetch_assoc();
            $dias_gestacao = $config['dia_previsto_gestacao'];

            // Calcular data prevista de parto
            $data_prevista_parto = date('Y-m-d', strtotime($data_cobertura . " +$dias_gestacao days"));

            // Inserir na tabela partos
            $parto_sql = "INSERT INTO partos (matriz_id, data_prevista_parto, usuario_id, data_acao)
                          VALUES ('$matriz_id', '$data_prevista_parto', '$usuario_id', NOW())";
            $conn->query($parto_sql);
        }

        header('Location: ../../public/coberturas.php');
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
    <link rel="stylesheet" href="../../assets/css/styles.css">
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
<!-- adicionei um link para o javascript abaixo para pegar a data de cobertura - Vinicius -->
<script src=../../assets/js/data_prevista_parto.js></script>
</html>
