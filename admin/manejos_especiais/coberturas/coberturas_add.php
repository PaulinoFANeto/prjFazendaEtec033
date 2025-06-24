<?php
//Período de teste - Lays 
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
    $data_cobertura = $_POST['data_cobertura'];
    $tipo_cobertura = $_POST['tipo_cobertura'];
    $usuario_id = $_SESSION['usuario_id'];
    $data_acao = date('Y-m-d H:i:s');

    // Verifica se já existe uma cobertura para a mesma matriz na mesma data
    $checkSql = "SELECT id FROM coberturas WHERE matriz_id = '$matriz_id' AND data_cobertura = '$data_cobertura'";
    $checkResult = $conn->query($checkSql);

    // Este teste serve para não deixar duplicar coberturas
    if ($checkResult && $checkResult->num_rows > 0) {
        echo "Já existe uma cobertura registrada para essa matriz nesta data.";
    } else {
        // Inserção da cobertura
        $sql = "INSERT INTO coberturas (matriz_id, data_cobertura, tipo_cobertura) 
                VALUES ('$matriz_id', '$data_cobertura', '$tipo_cobertura')";

        if ($conn->query($sql) === TRUE) {
            $cobertura_id = $conn->insert_id;

            // insere um registro de Log da inclusão da cobertura
            $logCobertura = "INSERT INTO logs (usuario_id, tabela, acao, data_acao) 
                            VALUES ('$usuario_id', 'coberturas', 'inclusao', '$data_acao')";
            $conn->query($logCobertura);

            // Buscar configuração
            $configSql = "SELECT dia_previsto_gestacao, dia_preparacao_parto FROM configuracoes LIMIT 1";
            $resultConfig = $conn->query($configSql);

            if ($resultConfig && $resultConfig->num_rows > 0) {
                $config = $resultConfig->fetch_assoc();

                // Calcula as datas de parto e transferência
                $dataPrevistaParto = date('Y-m-d', strtotime($data_cobertura . " +{$config['dia_previsto_gestacao']} days"));
                $dataPrevistaTransferencia = date('Y-m-d', strtotime($dataPrevistaParto . " -{$config['dia_preparacao_parto']} days"));

                // Inserção do parto
                $sqlParto = "INSERT INTO partos (
                                matriz_id, 
                                data_prevista_parto, 
                                data_prevista_maternidade, 
                                usuario_id, 
                                data_acao
                            ) VALUES (
                                '$matriz_id', 
                                '$dataPrevistaParto', 
                                '$dataPrevistaTransferencia', 
                                '$usuario_id', 
                                '$data_acao'
                            )";

                if ($conn->query($sqlParto) === TRUE) {
                    // Insere um registro de Log da inclusão do parto
                    $logParto = "INSERT INTO logs (usuario_id, tabela, acao, data_acao) 
                                VALUES ('$usuario_id', 'partos', 'inclusao', '$data_acao')";
                    $conn->query($logParto);

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
        <label for="matriz_id">Matriz:</label>
        <select id="matriz_id" name="matriz_id" required>
            <option value="">Selecione uma matriz</option>
            <?php while ($matriz = $resultMatrizes->fetch_assoc()): ?>
                <option value="<?= $matriz['id'] ?>"><?= htmlspecialchars($matriz['nome']) ?></option>
            <?php endwhile; ?>
        </select>
        <label for="data_cobertura">Data de Cobertura:</label>
        <input type="date" id="data_cobertura" name="data_cobertura" required>
        <label for="tipo_cobertura">Tipo de Cobertura:</label>
        <select id="tipo_cobertura" name="tipo_cobertura" required>
            <option value="Monta Natural" selected>Monta Natural</option>
            <option value="Inseminação Artificial">Inseminação Artificial</option>
        </select>

        <button type="submit">Adicionar</button>
    </form>
</body>
<!-- adicionei um link para o javascript abaixo para pegar a data de cobertura - Vinicius -->
<!-- <script src=../../assets/js/data_prevista_parto.js></script> -->
</html>
