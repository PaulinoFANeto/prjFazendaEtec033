<?php
//Fiz mudanças nos links dos arquivos devido a configuração das pastas - Leandro
$titulo_pagina = "Bem vindo à tela de Partos";
include(__DIR__ . "/../../../auth/auth.php");
//Adicionei um include para o arquivo de coberturas - Vinicius
include 'coberturas_add.php';

$sql = "SELECT * FROM partos";
$result = $conn->query($sql);
if ($result === false) {
    die("Erro na consulta: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Partos</title>
    <link rel="stylesheet" href="../../../assets/css/estilo.css">
</head>

<body>
    <div class="container">
        <?php include '../../../include/header.php'; ?>

        <div class="btn-group">
            <?php if (in_array('inclusao', $usuario_permissoes)): ?>
            <button class="btn" onclick="window.location.href='partos_add.php'">Adicionar novo
                Parto</button>
            <?php endif; ?>
        </div>

        <table>
            <tr>
                <th>ID</th>
                <th>ID Matriz</th>
                <th>Data do Parto</th>
                <th>Data do Desmame</th>
                <th>Ações</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['matriz_id']; ?></td>
                <!--Alterei a variavel de data de parto, pois a anterior nao existia. É necessário testar - Vinicius  -->
                <td><?php echo date('d/m/Y', strtotime($row['$dataPrevistaParto'])); ?></td>
                <td><?php echo date('d/m/Y', strtotime($row['data_desmame'])); ?></td>
                <td>
                    <?php if (in_array('alteracao', $usuario_permissoes)): ?>
                    <button class="btn"
                        onclick="window.location.href='partos_edit.php?id=<?php echo $row['id']; ?>'">Editar</button>
                    <?php endif; ?>
                    <?php if (in_array('exclusao', $usuario_permissoes)): ?>
                    <!-- O arquivo abaixo não foi criado - Letícia -->
                    <button class="btn"
                        onclick="if(confirm('Deseja realmente excluir este parto?')) window.location.href='../../admin/delete/delete_partos.php?id=<?php echo $row['id']; ?>'">Excluir</button>
                    <?php endif; ?>
                </td>
            </tr>
            <?php endwhile; ?>
        </table>

        <!-- Modal de Ajuda -->
        <?php
        $titulo_ajuda = "Ajuda - Tela de Partos";
        $descricao_ajuda = "Esta tela exibe uma lista de todas os partos cadastrados no sistema.";
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
</body>

</html>