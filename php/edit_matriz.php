<?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario_id = $_SESSION['usuario_id'];
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $raca = $_POST['raca'];
    $peso = $_POST['peso'];
    $data_nascimento = $_POST['data_nascimento'];
    $data_entrada = $_POST['data_entrada'];

    $stmt = $conn->prepare("UPDATE matrizes SET nome = ?, raca = ?, peso = ?, data_nascimento = ?, data_entrada = ?, usuario_id = ?, data_acao = NOW() WHERE id = ?");
    $stmt->bind_param("ssdsiii", $nome, $raca, $peso, $data_nascimento, $data_entrada, $usuario_id, $id);
    $stmt->execute();

    // Registro no log
    $tabela = 'matrizes';
    $acao = 'alteracao';
    $stmt_log = $conn->prepare("INSERT INTO logs (usuario_id, tabela, acao, data_acao) VALUES (?, ?, ?, NOW())");
    $stmt_log->bind_param("iss", $usuario_id, $tabela, $acao);
    $stmt_log->execute();

    $stmt->close();
    $stmt_log->close();
    $conn->close();

    header("Location: matrizes.php");
}
?>


<?php
/*
include 'db.php';

$id = $_GET['id'];
$sql = "SELECT * FROM matrizes WHERE id=$id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $raca = $_POST['raca'];
    $peso = $_POST['peso'];
    $data_nascimento = $_POST['data_nascimento'];
    $data_entrada = $_POST['data_entrada'];

    $sql = "UPDATE matrizes SET nome='$nome', raça='$raca', peso='$peso', data_nascimento='$data_nascimento', data_entrada='$data_entrada' WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        header('Location: matrizes.php');
    } else {
        echo "Erro: " . $sql . "<br>" . $conn->error;
    }
}
    */
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Editar Matriz</title>
    <!-- <link rel="stylesheet" href="style.css"> -->
</head>
<body>
    <button class="voltar-btn" onclick="window.history.back();">← Voltar</button>

    <h1>Editar Matriz</h1>
    <form method="post">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" value="<?php echo $row['nome']; ?>" required>
        <label for="raca">Raça:</label>
        <input type="text" id="raca" name="raca" value="<?php echo $row['raça']; ?>" required>
        <label for="peso">Peso:</label>
        <input type="number" step="0.01" id="peso" name="peso" value="<?php echo $row['peso']; ?>" required>
        <label for="data_nascimento">Data de Nascimento:</label>
        <input type="date" id="data_nascimento" name="data_nascimento" value="<?php echo $row['data_nascimento']; ?>" required>
        <label for="data_entrada">Data de Entrada:</label>
        <input type="date" id="data_entrada" name="data_entrada" value="<?php echo $row['data_entrada']; ?>" required>
        <button type="submit">Salvar</button>
    </form>
</body>
</html>