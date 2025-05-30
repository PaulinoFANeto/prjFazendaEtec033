<?php
include '../auth/db.php';
$sql = "SELECT pm.id, m.nome AS matriz_nome, pm.peso, pm.data_pesagem 
        FROM pesagem_matrizes pm
        JOIN matrizes m ON pm.matriz_id = m.id";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Pesagem de Matrizes</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>
    <h1>Pesagem de Matrizes</h1>
    <a href="../admin/add/add_pesagem_matriz.php">Adicionar Pesagem para Matriz</a>
    <table>
        <tr>
            <th>ID</th>
            <th>Matriz</th>
            <th>Peso</th>
            <th>Data</th>
            <th>Ações</th>
        </tr>
        <?php while($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['matriz_nome']; ?></td>
            <td><?php echo $row['peso']; ?></td>
            <td><?php echo $row['data_pesagem']; ?></td>
            <td>
                <a href="../admin/edit/edit_pesagem_matriz.php?id=<?php echo $row['id']; ?>">Editar</a>
                <a href="../admin/delete/delete_pesagem_matriz.php?id=<?php echo $row['id']; ?>">Excluir</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>