<?php
include(__DIR__ . "/../database/conexao.php");

if (!isset($_SESSION['usuario_id']) || !isset($_SESSION['nivel_acesso'])) {
    header("Location: ../public/entrar.php");
    exit();
}

$conn = $GLOBALS['conn'];

$usuario_id = $_SESSION['usuario_id'];
$sql_usuario = "SELECT nivel_acesso FROM usuarios WHERE id = ?";
$stmt_usuario = $conn->prepare($sql_usuario);
$stmt_usuario->bind_param("i", $usuario_id);
$stmt_usuario->execute();
$result_usuario = $stmt_usuario->get_result();
$usuario = $result_usuario->fetch_assoc();

$mapa_niveis = [
    0 => 'Administrador',
    1 => 'Docente',
    2 => 'Auxiliar',
    3 => 'Aluno'
];

$nivel_acesso = $mapa_niveis[$usuario['nivel_acesso']] ?? null;

$permissoes = [
    'Administrador' => ['consulta', 'inclusao', 'alteracao', 'exclusao'],
    'Docente' => ['consulta', 'inclusao', 'alteracao'],
    'Auxiliar' => ['consulta', 'inclusao'],
    'Aluno' => ['consulta']
];

if (isset($permissoes[$nivel_acesso])) {
    $usuario_permissoes = $permissoes[$nivel_acesso];
} else {
    die("Erro: Nível de acesso inválido.");
}
