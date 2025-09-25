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
    <link rel="stylesheet" href="../../assets/css/estilo.css">
</head>

<body>
    <div class="container">
        <div class="top-bar">
            <h1>Coberturas</h1>
        </div>
        <div class="btn-group">
            <button class="btn" onclick="window.location.href='coberturas_add.php'">Adicionar nova Cobertura</button>
        </div>

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
                    <td><?php echo htmlspecialchars($row['matriz_nome']); ?></td>
                    <td><?php echo $row['data_cobertura']; ?></td>
                    <td>
                        <button class="btn" onclick="window.location.href='coberturas_edit.php?id=<?= $row['id'] ?>'">Editar</button>
                        <button class="btn" onclick="if(confirm('Deseja realmente excluir esta cobertura?')) window.location.href='coberturas_delete.php?id=<?= $row['id'] ?>'">Excluir</button>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
    </div>
</body>

</html>