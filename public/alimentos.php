<?php
include '../auth/db.php';
$sql = "SELECT * FROM alimentos";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Alimentos</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>
    <h1>Alimentos</h1>
    <a href="../admin/add/add_alimento.php">Adicionar Alimento</a>
    <table>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Descrição</th>
            <th>Tipo de Alimento</th>
            <th>Ações</th>
        </tr>
        <?php while($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['nome']; ?></td>
            <td><?php echo $row['descricao']; ?></td>
            <td><?php echo $row['tipo_alimento']; ?></td>
            <td>
                <!-- Os arquivos abaixo não foram criados - Letícia -->
                <a href="../admin/edit/edit_procedimento.php?id=<?php echo $row['id']; ?>">Editar</a>
                <a href="../admin/delete/delete_procedimento.php?id=<?php echo $row['id']; ?>">Excluir</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>