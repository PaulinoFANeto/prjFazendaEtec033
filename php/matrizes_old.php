<?php
session_start();
include 'db.php';

// Verificar se o usuário está logado
if (!isset($_SESSION['usuario_id']) || !isset($_SESSION['nivel_acesso'])) {
    header("Location: login.php");
    exit();
}

// Certificar-se de que a variável $conn está definida corretamente
if (!isset($GLOBALS['conn'])) {
    die("Erro: Conexão com o banco de dados não está definida.");
}

$conn = $GLOBALS['conn']; // Recuperando a conexão global

// Obter informações do usuário logado
$usuario_id = $_SESSION['usuario_id'];
$sql_usuario = "SELECT nivel_acesso FROM usuarios WHERE id = ?";
$stmt_usuario = $conn->prepare($sql_usuario);
$stmt_usuario->bind_param("i", $usuario_id);
$stmt_usuario->execute();
$result_usuario = $stmt_usuario->get_result();
$usuario = $result_usuario->fetch_assoc();
$nivel_acesso = $_SESSION['nivel_acesso']; // Certificar-se de que o nível de acesso está definido

// Definir permissões com base no nível de acesso
$permissoes = [
    'Administrador' => ['consulta', 'inclusao', 'alteracao', 'exclusao'],
    'Docente' => ['consulta', 'inclusao', 'alteracao'],
    'Auxiliar' => ['consulta', 'inclusao'],
    'Aluno' => ['consulta']
];

// Verificar se o nível de acesso existe nas permissões antes de definir
if (isset($permissoes[$nivel_acesso])) {
    $usuario_permissoes = $permissoes[$nivel_acesso];
} else {
    die("Erro: Nível de acesso inválido.");
}

// Consulta à tabela matrizes
$sql = "SELECT * FROM matrizes";
$result = $conn->query($sql);
if ($result === false) {
    die("Erro na consulta: " . $conn->error);
}

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Matrizes</title>
    <link rel="stylesheet" href="../css/estilo.css">
</head>
<body>
    <div class="container">

        <!-- Topo com botão de voltar, título e ajuda -->
        <div class="top-bar">
            <button class="btn" onclick="window.history.back();">Voltar</button>
            <h1>Bem vindo a tela de Matrizes</h1>
            <button class="btn" onclick="document.getElementById('modalAjuda').style.display='block'">Ajudar</button>
        </div>

        <!-- Botão adicionar -->
        <div class="btn-group">
            <?php if (in_array('inclusao', $usuario_permissoes)): ?>
                <button class="btn" onclick="window.location.href='add_matriz.php'">Adicionar nova Matriz</button>
            <?php endif; ?>
        </div>

        <!-- Tabela que mostra os dados cadastrados -->
        <table>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Raça</th>
                <th>Peso (kg)</th>
                <th>Data de Nascimento</th>
                <th>Data de Entrada</th>
                <th>Ações</th>
            </tr>
            <?php while($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['nome']; ?></td>
                <td><?php echo $row['raca']; ?></td>
                <td><?php echo $row['peso']; ?></td>
                <td><?php echo date('d/m/Y', strtotime($row['data_nascimento'])); ?></td>
                <td><?php echo date('d/m/Y', strtotime($row['data_entrada'])); ?></td>
                <td>
                    <?php if (in_array('alteracao', $usuario_permissoes)): ?>
                        <button class="btn" onclick="window.location.href='edit_matriz.php?id=<?php echo $row['id']; ?>'">Editar</button>
                    <?php endif; ?>
                    <?php if (in_array('exclusao', $usuario_permissoes)): ?>
                        <button class="btn" onclick="if(confirm('Deseja realmente excluir esta matriz?')) window.location.href='delete_matriz.php?id=<?php echo $row['id']; ?>'">Excluir</button>
                    <?php endif; ?>
                </td>
            </tr>
            <?php endwhile; ?>
        </table>
        <!-- Modal de Ajuda -->
        <div id="modalAjuda" class="modal">
            <div class="modal-content">
                <span class="close" onclick="document.getElementById('modalAjuda').style.display='none'">&times;</span>
                <h2>Ajuda - Tela de Matrizes</h2>
                <p>Esta tela exibe uma lista de todas as matrizes cadastradas no sistema.</p>
                <p>As ações abaixo descritas, funcionam de acordo com o nível de acesso do usuário.</p>
                <ul>
                    <li><strong>Adicionar</strong>: Permite incluir uma nova matriz.</li>
                    <li><strong>Editar</strong>: Abre um formulário para editar os dados da matriz.</li>
                    <li><strong>Excluir</strong>: Remove a matriz do sistema.</li>
                    <li><strong>Voltar</strong>: Retorna para a tela anterior.</li>
                </ul>
                <p>OBSERVAÇÃO: As ações só aparecem se o usuário tiver permissão para executá-la.</p>
            </div>
        </div>
    </div>
    <!-- Rodapé exibindo usuário e nível de acesso -->
    <div class="footer">
        <div class="footer-left">
            Usuário: <?php echo htmlspecialchars($_SESSION['usuario']); ?>
        </div>
        <div class="footer-right">
            Nível de acesso: <?php echo htmlspecialchars($_SESSION['nivel_acesso']); ?>
        </div>
    </div>
    <!-- Script para fechar o modal ao clicar fora dele -->
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
