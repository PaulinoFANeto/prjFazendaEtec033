<?php
//Fiz mudanças nos links dos arquivos devido a configuração das pastas - Leandro
include("../../database/conexao.php");
$sql = "SELECT vc.id, c.nome AS cria_nome, v.nome AS vacina_nome, vc.data_aplicacao 
        FROM vacinas_crias vc
        JOIN crias c ON vc.cria_id = c.id
        JOIN vacinas v ON vc.vacina_id = v.id";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Vacinas de Crias</title>
    <link rel="stylesheet" href="../../../assets/css/estilo.css">
</head>

<body>
    <h1>Vacinas de Crias</h1>
    <a href="vacinas_crias_add.php">Adicionar Vacina para Cria</a>
    <table>
        <tr>
            <th>ID</th>
            <th>Cria</th>
            <th>Vacina</th>
            <th>Data de Aplicação</th>
            <th>Ações</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['cria_nome']; ?></td>
                <td><?php echo $row['vacina_nome']; ?></td>
                <td><?php echo $row['data_aplicacao']; ?></td>
                <td>
                    <!-- Os arquivos abaixo não foram criados - Letícia -->
                    <a href="delete_vacinas_crias.php?id=<?php echo $row['id']; ?>">Excluir</a>
                    <a href="vacinas_crias_edit.php?id=<?php echo $row['id']; ?>">Editar</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
</body>

</html>