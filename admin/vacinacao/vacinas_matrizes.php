<?php
//Fiz mudanças nos links dos arquivos devido a configuração das pastas - Leandro
include("../../database/conexao.php");
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
    <link rel="stylesheet" href="../../../assets/css/estilo.css">
</head>

<body>
    <h1>Vacinas de Matrizes</h1>
    <a href="vacinas_matrizes_add.php">Adicionar Vacina para Matriz</a>
    <table>
        <tr>
            <th>ID</th>
            <th>Matriz</th>
            <th>Vacina</th>
            <th>Data de Aplicação</th>
            <th>Ações</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['matriz_nome']; ?></td>
                <td><?php echo $row['vacina_nome']; ?></td>
                <td><?php echo $row['data_aplicacao']; ?></td>
                <td>
                    <!-- Os arquivos edit_vacina_matriz.php e o delete_vacina_matriz.php não foram criados - Letícia -->
                    <a href="vacinas_matrizes_edit.php?id=<?php echo $row['id']; ?>">Editar</a>
                    <a href="delete_vacinas_matrizes.php?id=<?php echo $row['id']; ?>">Excluir</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
</body>

</html>