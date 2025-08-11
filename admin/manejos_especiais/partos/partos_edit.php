<?php
include(__DIR__ . "/../../../auth/auth.php");

$id = intval($_GET['id']);

// Buscar dados do parto
$stmt = $conn->prepare("SELECT p.*, m.nome AS nome_matriz FROM partos p JOIN matrizes m ON p.matriz_id = m.id WHERE p.id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data_parto = $_POST['data_efetiva_parto'];
    $data_desmame = isset($_POST['data_efetiva_desmame']) ? $_POST['data_efetiva_desmame'] : null;
    $qtd_crias = $_POST['qtd_crias'];

    // Buscar quantidade de dias para o desmame na tabela configuracoes
    $diasDesmame = 0;
    $sqlConfig = "SELECT dia_previsto_desmame FROM configuracoes LIMIT 1";
    $resultConfig = $conn->query($sqlConfig);
    if ($resultConfig && $resultConfig->num_rows > 0) {
        $config = $resultConfig->fetch_assoc();
        $diasDesmame = intval($config['dia_previsto_desmame']);
    }

    // Calcular data prevista do desmame se a data efetiva do parto foi informada
    $data_prevista_desmame = null;
    if ($data_parto && $diasDesmame > 0) {
        $data_prevista_desmame = date('Y-m-d', strtotime($data_parto . " +{$diasDesmame} days"));
    }

    $stmt = $conn->prepare("UPDATE partos SET data_efetiva_parto = ?, data_efetiva_desmame = ?, qtd_crias = ?, data_prevista_desmame = ? WHERE id = ?");
    $stmt->bind_param("ssisi", $data_parto, $data_desmame, $qtd_crias, $data_prevista_desmame, $id);

    if ($stmt->execute()) {
        header('Location: partos.php');
        exit;
    } else {
        echo "Erro: " . $stmt->error;
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Editar Parto</title>
    <link rel="stylesheet" href="../../../assets/css/styles.css">
</head>
<body>
    <h1>Editar Parto</h1>
    <form method="post">
        <label for="nome_matriz">Matriz:</label>
        <input type="text" id="nome_matriz" value="<?= htmlspecialchars($row['nome_matriz']) ?>" disabled>

        <label for="data_efetiva_parto">Data Efetiva do Parto:</label>
        <input type="date" id="data_efetiva_parto" name="data_efetiva_parto" value="<?= $row['data_efetiva_parto'] ?>" required>

        <?php
        // Exibe a data prevista do desmame calculada ou já existente
        $dataPrevistaDesmame = $row['data_prevista_desmame'];
        if ($row['data_efetiva_parto']) {
            // Se já existe data efetiva do parto, calcula novamente para exibir
            $diasDesmame = 0;
            $sqlConfig = "SELECT dia_previsto_desmame FROM configuracoes LIMIT 1";
            $resultConfig = $conn->query($sqlConfig);
            if ($resultConfig && $resultConfig->num_rows > 0) {
                $config = $resultConfig->fetch_assoc();
                $diasDesmame = intval($config['dia_previsto_desmame']);
            }
            if ($diasDesmame > 0) {
                $dataPrevistaDesmame = date('Y-m-d', strtotime($row['data_efetiva_parto'] . " +{$diasDesmame} days"));
            }
        }
        ?>
        <label for="data_prevista_desmame">Data Prevista do Desmame:</label>
        <input type="date" id="data_prevista_desmame" value="<?= $dataPrevistaDesmame ?>" disabled>

        <?php if (!empty($dataPrevistaDesmame)) : ?>
            <label for="data_efetiva_desmame">Data Efetiva do Desmame:</label>
            <input type="date" id="data_efetiva_desmame" name="data_efetiva_desmame" value="<?= $row['data_efetiva_desmame'] ?>">
        <?php endif; ?>
        <!-- Falta ligar este input ao de partos.php - Vinicius -->
        <label for="data_efetiva_maternidade">Data Efetiva da Maternidade:</label>
        <input type="date" id="data_efetiva_maternidade" name="data_efetiva_maternidade" value="<?= $row['data_efetiva_maternidade'] ?>" required>

        <label for="qtd_crias">Quantidade de Crias:</label>
        <input type="number" id="qtd_crias" name="qtd_crias" value="<?= $row['qtd_crias'] ?>" required>
             
        <button type="submit">Salvar</button>
    </form>
</body>
</html>
