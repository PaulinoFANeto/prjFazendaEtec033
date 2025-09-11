<?php
session_start();

//Fiz mudanças nos links dos arquivos devido a configuração das pastas - Leandro
include("../../../database/conexao.php");
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
    <link rel="stylesheet" href="../../assets/css/estilos.css">
</head>

<body>
    <h1>Coberturas</h1>
    <!-- O arquivo abaixo não foi criado - Letícia -->
    <a href="coberturas_add.php">Adicionar Cobertura</a>
    <table>
        <tr>
            <th>ID</th>
            <th>Matriz</th>
            <th>Data de Cobertura</th>
            <th>Ações</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['matriz_nome']; ?></td>
                <td><?php echo $row['data_cobertura']; ?></td>
                <td>
                    <a href="coberturas_edit.php?id=<?php echo $row['id']; ?>">Editar</a>
                    <!-- O arquivo abaixo não foi criado - Letícia -->
                    <a href="coberturas_delete.php?id=<?php echo $row['id']; ?>">Excluir</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
</body>

</html>