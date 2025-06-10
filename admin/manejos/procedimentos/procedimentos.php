<?php
//Fiz mudanças nos links dos arquivos devido a configuração das pastas - Leandro
include("../../../database/conexao.php");
$sql = "SELECT * FROM procedimentos";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Procedimentos</title>
    <link rel="stylesheet" href="../../../assets/css/estilo.css">
</head>

<body>
    <h1>Procedimentos</h1>
    <a href="procedimentos_add.php">Adicionar Procedimento</a>
    <table>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Descrição</th>
            <th>Ações</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['nome']; ?></td>
                <td><?php echo $row['descricao']; ?></td>
                <td>
                    <!-- Criei os arquivos que faltavam, mas não testei nenhum ainda. E o edit de procedimentos não tem nada nele, 
                        é só o diretório que eu arrumei mesmo :P - Letícia -->
                    <a href="procedimentos_edit.php?id=<?php echo $row['id']; ?>">Editar</a>
                    <a href="delete_procedimentos.php?id=<?php echo $row['id']; ?>">Excluir</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
</body>

</html>