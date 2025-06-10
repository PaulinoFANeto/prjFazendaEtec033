<?php
//Fiz mudanças nos links dos arquivos devido a configuração das pastas - Leandro
include(__DIR__ . "/../../../auth/auth.php");
$sql = "SELECT * FROM vacinas";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Vacinas</title>
    <link rel="stylesheet" href="../../../assets/css/estilo.css">
</head>

<body>
    <h1>Vacinas</h1>
    <a href="vacinas_add.php">Adicionar Vacina</a>
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
                    <a href="vacinas_edit.php?echo $row['id']; ?>">Editar</a>
                    <a href="delete_vacina.php?id=<?php echo $row['id']; ?>">Excluir</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
</body>

</html>