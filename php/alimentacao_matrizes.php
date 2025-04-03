<?php
include 'db.php';
$sql = "SELECT am.id, m.nome AS matriz_nome, am.tipo_alimento, am.quantidade, am.data 
        FROM alimentacao_matrizes am
        JOIN matrizes m ON am.matriz_id = m.id";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Alimentação de Matrizes</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Alimentação de Matrizes</h1>
    <a href="add_alimentacao_matriz.php">Adicionar Alimentação para Matriz</a>
    <table>
        <tr>
            <th>ID</th>
            <th>Matriz</th>
            <th>Tipo de Alimento</th>
            <th>Quantidade</th>
            <th>Data</th>
            <th>Ações</th>
        </tr>
        <?php while($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['matriz_nome']; ?></td>
            <td><?php echo $row['tipo_alimento']; ?></td>
            <td><?php echo $row['quantidade']; ?></td>
            <td><?php echo $row['data']; ?></td>
            <td>
                <a href="edit_alimentacao_matriz.php?id=<?php echo $row['id']; ?>">Editar</a>
                <a href="delete_alimentacao_matriz.php?id=<?php echo $row['id']; ?>">Excluir</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>