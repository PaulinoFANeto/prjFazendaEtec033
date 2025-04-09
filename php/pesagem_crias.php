<?php
include 'db.php';
$sql = "SELECT pc.id, c.nome AS cria_nome, pc.peso, pc.data_pesagem 
        FROM pesagem_crias pc
        JOIN crias c ON pc.cria_id = c.id";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Pesagem de Crias</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Pesagem de Crias</h1>
    <a href="add_pesagem_cria.php">Adicionar Pesagem para Cria</a>
    <table>
        <tr>
            <th>ID</th>
            <th>Cria</th>
            <th>Peso</th>
            <th>Data</th>
            <th>Ações</th>
        </tr>
        <?php while($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['cria_nome']; ?></td>
            <td><?php echo $row['peso']; ?></td>
            <td><?php echo $row['data_pesagem']; ?></td>
            <td>
                <a href="edit_pesagem_cria.php?id=<?php echo $row['id']; ?>">Editar</a>
                <a href="delete_pesagem_cria.php?id=<?php echo $row['id']; ?>">Excluir</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>