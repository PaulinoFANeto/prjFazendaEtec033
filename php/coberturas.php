<?php
include 'db.php';
$sql = "SELECT c.id, m.nome AS matriz_nome, c.data_cobertura 
        FROM coberturas c
        JOIN matrizes m ON c.matriz_id = m.id";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Coberturas</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Coberturas</h1>
    <a href="add_cobertura.php">Adicionar Cobertura</a>
    <table>
        <tr>
            <th>ID</th>
            <th>Matriz</th>
            <th>Data de Cobertura</th>
            <th>Ações</th>
        </tr>
        <?php while($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['matriz_nome']; ?></td>
            <td><?php echo $row['data_cobertura']; ?></td>
           ?id=<?php echo $row['id']; ?>">Excluir</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>