<?php
//Fiz mudanças nos links dos arquivos devido a configuração das pastas - Leandro
include("../../database/conexao.php");
$sql = "SELECT am.id, m.nome AS matriz_nome, al.nome AS alimento_nome, am.quantidade, am.data_alimentacao 
        FROM alimentacao_matrizes am
        JOIN matrizes m ON am.matriz_id = m.id
        JOIN alimentos al ON am.alimento_id = al.id";
$result = $conn->query($sql);

if ($result === false) {
    die("Erro na consulta SQL: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Alimentação de Matrizes</title>
    <!-- <link rel="stylesheet" href="../assets/css/style.css"> -->
</head>

<body>
    <h1>Alimentação de Matrizes</h1>
    <a href="alimentacao_matrizes_add.php">Adicionar Alimentação para Matriz</a>
    <table>
        <tr>
            <th>ID</th>
            <th>Matriz</th>
            <th>Alimento</th>
            <th>Quantidade</th>
            <th>Data</th>
            <th>Ações</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['matriz_nome']; ?></td>
                <td><?php echo $row['alimento_nome']; ?></td>
                <td><?php echo $row['quantidade']; ?></td>
                <td><?php echo $row['data_alimentacao']; ?></td>
                <td>
                    <!-- Os arquivos abaixo não foram criados - Letícia -->
                    <a href="alimentacao_matriz_edit.php?id=<?php echo $row['id']; ?>">Editar</a>
                    <a href="delete_alimentacao_matriz.php?id=<?php echo $row['id']; ?>">Excluir</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
</body>

</html>