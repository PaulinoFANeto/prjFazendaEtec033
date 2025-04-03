<?php
include 'db.php';
$sql = "SELECT * FROM partos";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Partos</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Partos</h1>
    <a href="add_parto.php">Adicionar Parto</a>
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
            <td><?php echo $row['data_parto']; ?></td>
            <td><?php echo $row['data_desmame']; ?></td>
            <td>
                <a href="edit_parto.php?id=<?php echo $row['id']; ?>">Editar</a>
                <a href="delete_parto.php?id=<?php echo $row['id']; ?>">Excluir</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>