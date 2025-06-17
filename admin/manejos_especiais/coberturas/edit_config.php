<?php
include(__DIR__ . "/../../../auth/auth.php"); 

// Atualizar configurações se enviado via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $gestacao = $_POST['dia_previsto_gestacao'];
    $preparacao = $_POST['dia_preparacao_parto'];

    $sql = "UPDATE configuracoes SET dia_previsto_gestacao = ?, dia_preparacao_parto = ? WHERE id = 1";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $gestacao, $preparacao);
    if ($stmt->execute()) {
        $mensagem = "Configurações atualizadas com sucesso!";
    } else {
        $mensagem = "Erro ao atualizar: " . $conn->error;
    }
}

// Buscar configurações atuais
$sql = "SELECT dia_previsto_gestacao, dia_preparacao_parto FROM configuracoes WHERE id = 1";
$result = $conn->query($sql);
$config = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Editar Configurações de Parto</title>
    <link rel="stylesheet" href="../../assets/css/styles.css">
</head>
<body>
    <h1>Editar Configurações de Parto</h1>

    <?php if (isset($mensagem)) echo "<p><strong>$mensagem</strong></p>"; ?>

    <form method="post">
        <label for="dia_previsto_gestacao">Dias previstos de gestação:</label>
        <input type="number" id="dia_previsto_gestacao" name="dia_previsto_gestacao" required
               value="<?= htmlspecialchars($config['dia_previsto_gestacao']) ?>">

        <label for="dia_preparacao_parto">Dias para preparo antes do parto:</label>
        <input type="number" id="dia_preparacao_parto" name="dia_preparacao_parto" required
               value="<?= htmlspecialchars($config['dia_preparacao_parto']) ?>">

        <button type="submit">Salvar</button>
    </form>
</body>
</html>
