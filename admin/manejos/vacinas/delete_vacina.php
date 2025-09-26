<?php
session_start();
include(__DIR__ . "/../../../auth/auth.php");


if (isset($_GET['id'])) {
    $usuario_id = $_SESSION['usuario_id'];
    $id = $_GET['id'];

    $stmt = $conn->prepare("DELETE FROM vacinas WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();

    // Registro no log
    $tabela = 'vacinas';
    $acao = 'exclusao';
    $stmt_log = $conn->prepare("INSERT INTO logs (usuario_id, tabela, acao, data_acao) VALUES (?, ?, ?, NOW())");
    $stmt_log->bind_param("iss", $usuario_id, $tabela, $acao);
    $stmt_log->execute();

    $stmt->close();
    $stmt_log->close();
    $conn->close();

    header("Location: vacinas.php");
}
?>