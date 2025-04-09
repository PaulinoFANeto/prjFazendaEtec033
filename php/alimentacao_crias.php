<?php
include 'db.php';
$sql = "SELECT ac.id, c.nome AS cria_nome, al.nome AS alimento_nome, ac.quantidade, ac.data_alimentacao 
        FROM alimentacao_crias ac
        JOIN crias c ON ac.cria_id = c.id
        JOIN alimentos al ON ac.alimento_id = al.id";
$result = $conn->query($sql);

if ($result === false) {
    die("Erro na consulta SQL: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Alimentação de Crias</title>
    <!-- <link rel="stylesheet" href="style.css"> -->
</head>
<body>
    <h1>Alimentação de Cria</h1>
    <a href="add_alimentacao_cria.php">Adicionar Alimentação para Cria</a>
    <table>
        <tr>
            <th>ID</th>
            <th>Cria</th>
            <th>Alimento</th>
            <th>Quantidade</th>
            <th>Data</th>
            <th>Ações</th>
        </tr>
        <?php while($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['cria_nome']; ?></td>
            <td><?php echo $row['alimento_nome']; ?></td>
            <td><?php echo $row['quantidade']; ?></td>
            <td><?php echo $row['data_alimentacao']; ?></td>
            <td>
                <a href="edit_alimentacao_cria.php?id=<?php echo $row['id']; ?>">Editar</a>
                <a href="delete_alimentacao_cria.php?id=<?php echo $row['id']; ?>">Excluir</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>