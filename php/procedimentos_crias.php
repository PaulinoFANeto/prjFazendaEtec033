<?php
include 'db.php';
$sql = "SELECT pc.id, c.nome AS cria_nome, p.nome AS procedimento_nome, pc.data_procedimento, pc.descricao 
        FROM procedimentos_crias pc
        JOIN crias c ON pc.cria_id = c.id
        JOIN procedimentos p ON pc.procedimento_id = p.id";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Procedimentos de Crias</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Procedimentos de Crias</h1>
    <a href="add_procedimento_cria.php">Adicionar Procedimento para Cria</a>
    <table>
        <tr>
            <th>ID</th>
            <th>Cria</th>
            <th>Procedimento</th>
            <th>Data do Procedimento</th>
            <th>Descrição</th>
            <th>Ações</th>
        </tr>
        <?php while($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['cria_nome']; ?></td>
            <td><?php echo $row['procedimento_nome']; ?></td>
            <td><?php echo $row['data_procedimento']; ?></td>
            <td><?php echo $row['descricao']; ?></td>
            <td>
                <a href="edit_procedimento_cria.php?id=<?php echo $row['id']; ?>">Editar</a>
               row['id']; ?>">Excluir</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>