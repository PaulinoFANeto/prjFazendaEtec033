<?php
session_start();
include 'db.php';

// Verificar se o usuário está logado
if (!isset($_SESSION['usuario_id']) || !isset($_SESSION['nivel_acesso'])) {
    header("Location: login.php");
    exit();
}

// Recuperar conexão global
if (!isset($GLOBALS['conn'])) {
    die("Erro: Conexão com o banco de dados não está definida.");
}
$conn = $GLOBALS['conn'];

// Obter informações do usuário logado
$usuario_id = $_SESSION['usuario_id'];
$sql_usuario = "SELECT nivel_acesso FROM usuarios WHERE id = ?";
$stmt_usuario = $conn->prepare($sql_usuario);
$stmt_usuario->bind_param("i", $usuario_id);
$stmt_usuario->execute();
$result_usuario = $stmt_usuario->get_result();
$usuario = $result_usuario->fetch_assoc();
$nivel_acesso = $_SESSION['nivel_acesso'];

// Definir permissões
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

// Consulta à tabela partos
$sql = "SELECT * FROM partos";
$result = $conn->query($sql);
if ($result === false) {
    die("Erro na consulta: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Partos</title>
    <link rel="stylesheet" href="../css/estilo.css">
</head>
<body>
<div class="container">
    <div class="top-bar">
        <button class="btn" onclick="window.history.back();">Voltar</button>
        <h1>Bem vindo à tela de Partos</h1>
        <button class="btn" onclick="document.getElementById('modalAjuda').style.display='block'">Ajudar</button>
    </div>

    <div class="btn-group">
        <?php if (in_array('inclusao', $usuario_permissoes)): ?>
            <button class="btn" onclick="window.location.href='add_parto.php'">Adicionar novo Parto</button>
        <?php endif; ?>
    </div>

    <table>
        <tr>
            <th>ID</th>
            <th>ID Matriz</th>
            <th>Data do Parto</th>
            <th>Data do Desmame</th>
            <th>Ações</th>
        </tr>
        <?php while($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['matriz_id']; ?></td>
            <td><?php echo date('d/m/Y', strtotime($row['data_parto'])); ?></td>
            <td><?php echo date('d/m/Y', strtotime($row['data_desmame'])); ?></td>
            <td>
                <?php if (in_array('alteracao', $usuario_permissoes)): ?>
                    <button class="btn" onclick="window.location.href='edit_parto.php?id=<?php echo $row['id']; ?>'">Editar</button>
                <?php endif; ?>
                <?php if (in_array('exclusao', $usuario_permissoes)): ?>
                    <button class="btn" onclick="if(confirm('Deseja realmente excluir este parto?')) window.location.href='delete_parto.php?id=<?php echo $row['id']; ?>'">Excluir</button>
                <?php endif; ?>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>

    <div id="modalAjuda" class="modal">
        <div class="modal-content">
            <span class="close" onclick="document.getElementById('modalAjuda').style.display='none'">×</span>
            <h2>Ajuda - Tela de Partos</h2>
            <p>Esta tela exibe uma lista de todos os partos registrados no sistema.</p>
            <ul>
                <li><strong>Adicionar</strong>: Permite registrar um novo parto.</li>
                <li><strong>Editar</strong>: Permite alterar os dados de um parto existente.</li>
                <li><strong>Excluir</strong>: Remove o registro de um parto.</li>
                <li><strong>Voltar</strong>: Retorna à tela anterior.</li>
            </ul>
            <p>OBSERVAÇÃO: As ações só aparecem se o usuário tiver permissão para executá-las.</p>
        </div>
    </div>
</div>

<div class="footer">
    <div class="footer-left">
        Usuário: <?php echo htmlspecialchars($_SESSION['usuario']); ?>
    </div>
    <div class="footer-right">
        Nível de acesso: <?php echo htmlspecialchars($_SESSION['nivel_acesso']); ?>
    </div>
</div>

<script>
window.onclick = function(event) {
    const modal = document.getElementById('modalAjuda');
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>
</body>
</html>
