<?php
include 'db.php';
$sql = "SELECT * FROM alimentos";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Alimentos</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Alimentos</h1>
    <a href="add_alimento.php">Adicionar Alimento</a>
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
                <a href="edit_procedimento.php?id=<?php echo $row['id']; ?>">Editar</a>
                <a href="delete_procedimento.php?id=<?php echo $row['id']; ?>">Excluir</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>