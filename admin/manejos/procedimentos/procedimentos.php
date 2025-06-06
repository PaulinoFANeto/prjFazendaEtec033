<?php
//Fiz mudanças nos links dos arquivos devido a configuração das pastas - Leandro
include("../../../database/conexao.php");
$sql = "SELECT * FROM procedimentos";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Procedimentos</title>
    <link rel="stylesheet" href="../../assets/css/styles.css">
</head>

<body>
    <h1>Procedimentos</h1>
    <a href="../../admin/add/add_procedimento.php">Adicionar Procedimento</a>
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
                    <!-- Os arquivos edit_procedimento.php e delete_procedimento.php não foram criados - Letícia -->
                    <a href="../../admin/edit/edit_procedimento.php?id=<?php echo $row['id']; ?>">Editar</a>
                    <a href="../../admin/delete/delete_procedimento.php?id=<?php echo $row['id']; ?>">Excluir</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
</body>

</html>