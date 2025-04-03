<?php
include 'db.php';
$sql = "SELECT * FROM matrizes";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Matrizes</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Matrizes</h1>
    <a href="add_matriz.php">Adicionar Matriz</a>
    <table>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Raça</th>
            <th>Peso</th>
            <th>Data de Nascimento</th>
            <th>Data de Entrada</th>
            <th>Ações</th>
        </tr>
        <?php while($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['nome']; ?></td>
            <td><?php echo $row['raça']; ?></td>
            <td><?php echo $row['peso']; ?></td>
            <td><?php echo $row['data_nascimento']; ?></td>
            <td><?php echo $row['data_entrada']; ?></td>
            <td>
                <a href="edit_matriz.php?id=<?php echo $row['id']; ?>">Editar</a>
                <a href="delete_matriz.php?id=<?php echo $row['id']; ?>">Excluir</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>