<?php
session_start();
include("../../database/conexao.php");
include("../../database/funcoes.php");

if (isset($_GET["search"])) {
    $search = $_GET["search"];
    $sql = "SELECT id, nome, email, nivel_acesso FROM usuarios WHERE nome  LIKE '%" . htmlspecialchars($search) . "%'
   OR email LIKE '%" . htmlspecialchars($search) . "%' OR id LIKE '%" . htmlspecialchars($search) . "%'";
} else {
    $sql = "SELECT id, nome, email, nivel_acesso FROM usuarios";
}

$stmt = $conn->prepare($sql);
$stmt->execute();
$stmt->bind_result($id, $nome, $email, $nivel_acesso);

if ($_SESSION["nivel_acesso"] != 0) {
    header("Location: ../dashboard.php");
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="usuarios.css">
    <title>Usuários</title>
</head>

<body>
    <div class="interface">
        <div class="titulo">
            <h1>Gerenciamento de Usuários</h1>
            <a href="usuarios_add.php" id="btn-add"><i class="bi bi-plus"></i>Adicionar Usuário</a>
        </div>
        <div class="pesquisa">
            <form method="get">
                <i class="bi bi-search"></i>
                <input type="search" name="search" id="search" placeholder="Buscar por nome ou email...">
                <?php if (!empty($_GET["search"])): ?>
                <button type="submit">Limpar<i class="bi bi-funnel"></i></button>
                <?php else: ?>
                <button type="submit">Filtrar<i class="bi bi-funnel"></i></button>
                <?php endif; ?>
            </form>
        </div>
        <?= include("container-resposta.php") ?>
        <div class="container-tabela">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>Nível Acesso</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <?php while ($stmt->fetch()): ?>
                <tbody>
                    <tr>
                        <td><?= $id ?></td>
                        <td><?= $nome ?></td>
                        <td><?= $email ?></td>
                        <td>
                            <?php switch ($nivel_acesso) {
                                    case 0:
                                        echo "Adiministrador";
                                        break;
                                    case 1:
                                        echo "Auxiliar Docente";
                                        break;
                                    case 2:
                                        echo "Professor";
                                        break;
                                    case 3:
                                        echo "Aluno";
                                        break;
                                    default:
                                        echo "N/a";
                                        break;
                                }
                                ?>
                        </td>
                        <td class="acoes">
                            <form action="usuarios_edit.php" method="post">
                                <input type="hidden" name="csrf" value="<?= gerarCSRF() ?>">
                                <input type="hidden" name="id_usuario" value="<?= $id ?>">
                                <button type="submit" class="btn-edit"><i class="bi bi-pencil-square"></i></button>
                            </form>
                            <form action="../../database/usuarios/usuarios_del.php"
                                onsubmit="confirm('Tem certeza que quer deletar esse usuário?')" method="post">
                                <input type="hidden" name="csrf" value="<?= gerarCSRF() ?>">
                                <input type="hidden" name="id_usuario" value="<?= $id ?>">
                                <button type="submit" class="btn-del"><i class="bi bi-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                </tbody>
                <?php endwhile; ?>
            </table>
        </div>
    </div>
</body>

</html>