<?php
//Fiz mudanças nos links dos arquivos devido a configuração das pastas - Leandro
$titulo_pagina = "Bem-vindo à tela de Matrizes";
include(__DIR__ . "/../../../auth/auth.php");

$search = isset($_GET['search']) ? $_GET['search'] : '';

$sql = "SELECT * FROM matrizes WHERE nome LIKE '%$search%' OR raca LIKE '%$search%'";
$result = $conn->query($sql);
if ($result === false) {
    die("Erro na consulta: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Matrizes</title>
    <link rel="stylesheet" href="../../../assets/css/estilo.css">
</head>

<body>
    <div class="container">
        <?php include '../../../include/header.php'; ?>

        <div class="top-bar">
            <form class="search-form" method="GET" action="">
                <input type="text" name="search" placeholder="Buscar matriz..."
                    value="<?php echo htmlspecialchars($search); ?>">
            </form>

            <?php if (in_array('inclusao', $usuario_permissoes)): ?>
                <button class="btn" onclick="window.location.href='matrizes_add.php'">Adicionar nova
                    Matriz</button>
            <?php endif; ?>
        </div>

        <table id="matrizTable">
            <tr>
                <th onclick="sortTable(0)">ID</th>
                <th onclick="sortTable(1)">Nome</th>
                <th onclick="sortTable(2)">Raça</th>
                <th onclick="sortTable(3)">Peso (kg)</th>
                <th onclick="sortTable(4)">Data de Nascimento</th>
                <th onclick="sortTable(5)">Data de Entrada</th>
                <?php if (array_intersect(['alteracao', 'exclusao'], $usuario_permissoes)): ?>
                    <th>Ações</th>
                <?php endif; ?>
            </tr>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['nome']; ?></td>
                    <td><?php echo $row['raca']; ?></td>
                    <td><?php echo $row['peso']; ?></td>
                    <td><?php echo date('d/m/Y', strtotime($row['data_nascimento'])); ?></td>
                    <td><?php echo date('d/m/Y', strtotime($row['data_entrada'])); ?></td>
                    <td>
                        <?php if (in_array('alteracao', $usuario_permissoes)): ?>
                            <button class="btn"
                                onclick="window.location.href='matrizes_edit.php?id=<?php echo $row['id']; ?>'">Editar</button>
                        <?php endif; ?>
                        <?php if (in_array('exclusao', $usuario_permissoes)): ?>
                            <!-- <button class="btn" onclick="if(confirm('Deseja realmente excluir a matriz ' + $row['nome'] +' ?' )) window.location.href='delete_matriz.php?id=<?php echo $row['id']; ?>'">Excluir</button> -->
                            <button class="btn"
                                onclick="if(confirm('Deseja realmente excluir a matriz <?php echo $row['nome']; ?> ?' )) window.location.href='delete_matriz.php?id=<?php echo $row['id']; ?>'">Excluir</button>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>

        <!-- Modal de Ajuda -->
        <?php
        $titulo_ajuda = "Ajuda - Tela de Matrizes";
        $descricao_ajuda = "Esta tela exibe uma lista de todas as matrizes cadastradas no sistema.";
        $itens_ajuda = [
            ['titulo' => 'Voltar', 'descricao' => 'Retorna para a tela anterior.'],
            ['titulo' => 'Ajudar', 'descricao' => 'Abre esta tela de auxílio.'],
            ['titulo' => 'Buscar Matriz', 'descricao' => 'Exibe na tela dados específicos. Par mostrar tudo, apague o texto do campo de busca.'],
            ['titulo' => 'Adicionar', 'descricao' => 'Permite registrar um novo parto.'],
            ['titulo' => 'Editar', 'descricao' => 'Permite alterar os dados de um parto existente.'],
            ['titulo' => 'Excluir', 'descricao' => 'Remove o registro de um parto.']
        ];
        $observacao_ajuda = "OBSERVAÇÃO: As ações só aparecem se o usuário tiver permissão para executá-las.";
        // Incluir o arquivo de ajuda
        include '../../../include/modal_ajuda.php';
        ?>

    </div>

    <?php include '../../../include/footer.php'; ?>
    <script src="../../../assets/js/ordenaTabela.js"></script>

</body>

</html>