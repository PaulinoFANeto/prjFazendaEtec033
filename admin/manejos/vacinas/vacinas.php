<?php
//Fiz mudanças nos links dos arquivos devido a configuração das pastas - Leandro
$titulo_pagina = "Bem-vindo à tela de Vacinas";
include(__DIR__ . "/../../../auth/auth.php");

$search = isset($_GET['search']) ? $_GET['search'] : '';

$sql = "SELECT * FROM vacinas WHERE nome LIKE '%$search%'";
$result = $conn->query($sql);
if ($result === false) {
    die("Erro na consulta: " . $conn->error);
}
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Vacinas</title>
    <link rel="stylesheet" href="../../../assets/css/estilo.css">
</head>

<body>
    <?php include '../../../include/header.php'; ?>

    <div class="top-bar">
            <form class="search-form" method="GET" action="">
                <input type="text" name="search" placeholder="Buscar vacina..."
                    value="<?php echo htmlspecialchars($search); ?>">
            </form>

            <?php if (in_array('inclusao', $usuario_permissoes)): ?>
                <button class="btn" onclick="window.location.href='vacinas_add.php'">Adicionar nova
                    Vacina</button>
            <?php endif; ?>
    </div>

    <table>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Descrição</th>
            <th>Ações</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['nome']; ?></td>
                <td><?php echo $row['descricao']; ?></td>
                <td>
                    <a href="vacinas_edit.php?id=<?php echo $row['id']; ?>">Editar</a>
                    <a href="delete_vacina.php?id=<?php echo $row['id']; ?>">Excluir</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>

    <?php include '../../../include/footer.php'; ?>
</body>

</html>