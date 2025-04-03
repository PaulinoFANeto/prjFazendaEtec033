<?php
include 'db.php';
$sql = "SELECT * FROM crias";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Crias</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Crias</h1>
    <a href="add_cria.php">Adicionar Cria</a>
    <table>
        <tr>
            <th>ID</th>
            <th>ID Parto</th>
            <th>Nome</th>
            <th>Peso ao Nascimento</th>
            <th>Data de Nascimento</th>
            <th>Ações</th>
        </tr>
        <?php while($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['parto_id']; ?></td>
            <td><?php echo $row['nome']; ?></td>
            <td><?php echo $row['peso_nascimento']; ?></td>
            <td><?php echo $row['data_nascimento']; ?></td>
            <td>
                <a href="edit_cria.php?id=<?php echo $row['id']; ?>">Editar</a>
                <a>
        <?php endwhile; ?>
    </table>
</body>
</html>