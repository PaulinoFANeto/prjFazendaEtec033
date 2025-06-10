<?php
//Fiz mudanças nos links dos arquivos devido a configuração das pastas - Leandro
include("../../database/conexao.php");
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
    <link rel="stylesheet" href="../../assets/css/estilos.css">
</head>

<body>
    <h1>Procedimentos de Crias</h1>
    <a href="procedimentos_crias_add.php">Adicionar Procedimento para Cria</a>
    <table>
        <tr>
            <th>ID</th>
            <th>Cria</th>
            <th>Procedimento</th>
            <th>Data do Procedimento</th>
            <th>Descrição</th>
            <th>Ações</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['cria_nome']; ?></td>
                <td><?php echo $row['procedimento_nome']; ?></td>
                <td><?php echo $row['data_procedimento']; ?></td>
                <td><?php echo $row['descricao']; ?></td>
                <td>
                    <!-- Os arquivos abaixo não foram criados - Letícia -->
                    <a href="procedimentos_crias_edit.php?id=<?php echo $row['id']; ?>">Editar</a>
                    <a href="delete_procedimentos_crias.php?id=<?php echo $row['id']; ?>">Excluir</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
</body>

</html>