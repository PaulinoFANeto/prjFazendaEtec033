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
    $data_desmame = $_POST['data_efetiva_desmame'];
    $qtd_crias = $_POST['qtd_crias'];

    $stmt = $conn->prepare("UPDATE partos SET data_efetiva_parto = ?, data_efetiva_desmame = ?, qtd_crias = ? WHERE id = ?");
    $stmt->bind_param("ssii", $data_parto, $data_desmame, $qtd_crias, $id);

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


        <!-- tem que colocar essa data efetiva após a data prevista ser gerada - Vinicius
        <label for="data_efetiva_desmame">Data Efetiva do Desmame:</label>
        <input type="date" id="data_efetiva_desmame" name="data_efetiva_desmame" value="<?/*= $row['data_efetiva_desmame']*/ ?>" required>
-->

        <label for="qtd_crias">Quantidade de Crias:</label>
        <input type="number" id="qtd_crias" name="qtd_crias" value="<?= $row['qtd_crias'] ?>" required>

        <button type="submit">Salvar</button>
    </form>
</body>
</html>
