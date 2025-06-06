<?php
session_start();
include(__DIR__ . "/../../../auth/auth.php");

// Verifica se o usuário está logado
if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../../../auth/entrar.php");
    exit();
}

$usuario_id = $_SESSION['usuario_id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $raca = $_POST['raca'];
    $peso = $_POST['peso'];
    $data_nascimento = $_POST['data_nascimento'];
    $data_entrada = $_POST['data_entrada'];

    $stmt = $conn->prepare("UPDATE matrizes SET nome = ?, raca = ?, peso = ?, data_nascimento = ?, data_entrada = ?, usuario_id = ?, data_acao = NOW() WHERE id = ?");
    $stmt->bind_param("ssdssii", $nome, $raca, $peso, $data_nascimento, $data_entrada, $usuario_id, $id);
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
    exit();
}

// Carrega os dados da matriz para edição
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $conn->prepare("SELECT * FROM matrizes WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $stmt->close();
} else {
    echo "ID da matriz não fornecido.";
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Editar Matriz</title>
</head>

<body>
    <button class="voltar-btn" onclick="window.history.back();">← Voltar</button>

    <h1>Editar Matriz</h1>
    <form method="post">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($row['id']); ?>">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" value="<?php echo htmlspecialchars($row['nome']); ?>" required>
        <label for="raca">Raça:</label>
        <input type="text" id="raca" name="raca" value="<?php echo htmlspecialchars($row['raca']); ?>" required>
        <label for="peso">Peso:</label>
        <input type="number" step="0.01" id="peso" name="peso" value="<?php echo htmlspecialchars($row['peso']); ?>"
            required>
        <label for="data_nascimento">Data de Nascimento:</label>
        <input type="date" id="data_nascimento" name="data_nascimento"
            value="<?php echo htmlspecialchars($row['data_nascimento']); ?>" required>
        <label for="data_entrada">Data de Entrada:</label>
        <input type="date" id="data_entrada" name="data_entrada"
            value="<?php echo htmlspecialchars($row['data_entrada']); ?>" required>
        <button type="submit">Salvar</button>
    </form>
</body>

</html>