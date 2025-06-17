<?php
include(__DIR__ . "/../../../auth/auth.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $matriz_id = $_POST['matriz_id'];
    $data_cobertura = $_POST['data_cobertura'];

    $sql = "INSERT INTO coberturas (matriz_id, data_cobertura) VALUES ('$matriz_id', '$data_cobertura')";
    if ($conn->query($sql) === TRUE) {
        // aqui vai entrar os testes necessários para efetuar o cadastro de partos


        // Guarda o ID gerado automaticamente para essa nova cobertura
        //Será usado para ligar essa cobertura a um parto
        $cobertura_id = $conn->insert_id;

        // Buscar na tabela de configuração (dia_previsto_gestacao e dia_preparacao_parto)
        $configSql = "SELECT dia_previsto_gestacao, dia_preparacao_parto FROM configuracoes LIMIT 1";
        $resultConfig = $conn->query($configSql);
        if ($resultConfig && $resultConfig->num_rows > 0) {
            $config = $resultConfig->fetch_assoc();

            // Calcula a data_prevista_parto
            $dataPrevistaParto = date('Y-m-d', strtotime($data_cobertura . " +{$config['dia_previsto_gestacao']} days"));

            // Calcula a data_prevista_transferencia_maternidade
            $dataPrevistaTransferencia = date('Y-m-d', strtotime($dataPrevistaParto . " -{$config['dia_preparacao_parto']} days"));

            // Insere em partos
            $sqlParto = "INSERT INTO partos (cobertura_id, data_prevista_parto, data_prevista_transferencia_maternidade)
                         VALUES ('$cobertura_id', '$dataPrevistaParto', '$dataPrevistaTransferencia')";

            if ($conn->query($sqlParto) === TRUE) {
                // Redirecionar após sucesso
                header('Location: coberturas.php');
                exit();
            } else {
                echo "Erro ao inserir em partos: " . $conn->error;
            }
        } else {
            echo "Configurações não encontradas no banco.";
        }

    } else {
        echo "Erro ao inserir em coberturas: " . $conn->error;
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
