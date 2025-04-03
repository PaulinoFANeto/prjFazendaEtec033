<?php
include 'db.php';
$sql = "SELECT vm.id, m.nome AS matriz_nome, v.nome AS vacina_nome, vm.data_aplicacao 
        FROM vacinas_matrizes vm
        JOIN matrizes m ON vm.matriz_id = m.id
        JOIN vacinas v ON vm.vacina_id = v.id";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Vacinas de Matrizes</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Vacinas de Matrizes</h1>
    <a href="add_vacina_matriz.php">Adicionar Vacina para Matriz</a>
    <table>
        <tr>
            <th>ID</th>
            <th>Matriz</th>
            <th>Vacina</th>
            <th>Data de Aplicação</th>
            <th>Ações</th>
        </tr>
        <?php while($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['matriz_nome']; ?></td>
            <td><?php echo $row['vacina_nome']; ?></td>
            <td><?php echo $row['data_aplicacao']; ?></td>
            <td>
                <a href="edit_vacina_matriz.php?id=<?php echo $row['id']; ?>">Editar</a>
                <a href="delete_vacina_matriz.php?id=<?php echo $row['id']; ?>">Excluir</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>