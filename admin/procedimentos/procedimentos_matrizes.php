<?php
//Fiz mudanças nos links dos arquivos devido a configuração das pastas - Leandro
include("../../database/conexao.php");
$sql = "SELECT pm.id, m.nome AS matriz_nome, p.nome AS procedimento_nome, pm.data_procedimento, pm.descricao 
        FROM procedimentos_matrizes pm
        JOIN matrizes m ON pm.matriz_id = m.id
        JOIN procedimentos p ON pm.procedimento_id = p.id";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Procedimentos de Matrizes</title>
    <link rel="stylesheet" href="../../assets/css/estilos.css">
</head>

<body>
    <h1>Procedimentos de Matrizes</h1>
    <a href="procedimentos_matrizes_add.php">Adicionar Procedimento para Matriz</a>
    <table>
        <tr>
            <th>ID</th>
            <th>Matriz</th>
            <th>Procedimento</th>
            <th>Data do Procedimento</th>
            <th>Descrição</th>
            <th>Ações</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['matriz_nome']; ?></td>
                <td><?php echo $row['procedimento_nome']; ?></td>
                <td><?php echo $row['data_procedimento']; ?></td>
                <td><?php echo $row['descricao']; ?></td>
                <td>
                    <!-- Os arquivos abaixo não foram criados - Letícia -->
                    <a href="procedimentos_matrizes_edit.php?id=<?php echo $row['id']; ?>">Editar</a>
                    <a href="delete_procedimentos_matrizes.php?id=<?php echo $row['id']; ?>">Excluir</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
</body>

</html>