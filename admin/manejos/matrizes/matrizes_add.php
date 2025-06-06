<?php
session_start();
include(__DIR__ . "/../../../auth/auth.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Captura os dados do formulário
    $nome = $_POST['nome'];
    $raca = $_POST['raca'];
    $peso = floatval($_POST['peso']);
    $data_nascimento = $_POST['data_nascimento'];
    $data_entrada = $_POST['data_entrada'];
    $usuario_id = intval($_SESSION['usuario_id']);

    // Prepara a declaração SQL para evitar SQL Injection
    $stmt = $conn->prepare("INSERT INTO matrizes (nome, raca, peso, data_nascimento, data_entrada, usuario_id, data_acao)
     VALUES (?, ?, ?, ?, ?, ?, NOW())");
    // Verifica se a preparação foi bem-sucedida
    if ($stmt === false) {
        die("Erro na preparação da declaração: " . $conn->error);
    }

    // Vincula os parâmetros com o tipo correto
    $stmt->bind_param("ssdssi", $nome, $raca, $peso, $data_nascimento, $data_entrada, $usuario_id);
    // Executa a declaração
    $stmt->execute();

    // Registro no log
    $tabela = 'matrizes';
    $acao = 'inclusao';
    // Prepara a declaração SQL para o log e evita SQL Injection
    $stmt_log = $conn->prepare("INSERT INTO logs (usuario_id, tabela, acao, data_acao) VALUES (?, ?, ?, NOW())");
    // Verifica se a preparação foi bem-sucedida
    if ($stmt_log === false) {
        die("Erro na preparação da declaração de log: " . $conn->error);
    }
    // Vincula os parâmetros para o log
    $stmt_log->bind_param("iss", $usuario_id, $tabela, $acao);
    // Executa a declaração de log
    $stmt_log->execute();

    $stmt->close();
    $stmt_log->close();
    $conn->close();

    header("Location: matrizes.php");
}
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Adicionar Matriz</title>
    <link rel="stylesheet" href="../../assets/css/styles.css">
</head>

<body>
    <button class="voltar-btn" onclick="window.history.back();">← Voltar</button>

    <h1>Adicionar Matriz</h1>
    <form method="post">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required>
        <label for="raca">Raça:</label>
        <input type="text" id="raca" name="raca" required>
        <label for="peso">Peso:</label>
        <input type="number" step="0.01" id="peso" name="peso" required>
        <label for="data_nascimento">Data de Nascimento:</label>
        <input type="date" id="data_nascimento" name="data_nascimento" required>
        <label for="data_entrada">Data de Entrada:</label>
        <input type="date" id="data_entrada" name="data_entrada" required>
        <button type="submit">Adicionar</button>
    </form>
</body>

</html>