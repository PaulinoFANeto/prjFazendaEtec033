<?php
//Fiz mudanças nos links dos arquivos devido a configuração das pastas - Leandro
$titulo_pagina = "Bem vindo à tela de Partos";
include(__DIR__ . "/../../../auth/auth.php");
//Adicionei um include para o arquivo de coberturas - Vinicius
include 'coberturas_add.php';

$sql = "SELECT p.*, m.nome AS nome_matriz 
        FROM partos p 
        JOIN matrizes m ON p.matriz_id = m.id";

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
                <th>Matriz</th>
                <th>Data Prevista Parto</th>
                <th>Data Efetiva Parto</th>
                <th>Data Prevista Desmame</th>
                <th>Data Efetiva Desmame</th>
                <th>Data Prevista Maternidade</th>
                <th>Data Efetiva Maternidade</th>
                <th>Qtd. Crias</th>
                <th>Ações</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
<<<<<<< HEAD
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['matriz_id']; ?></td>
                <!--Alterei a variavel de data de parto, pois a anterior nao existia. É necessário testar - Vinicius  -->
                <td><?php echo date('d/m/Y', strtotime($row['$dataPrevistaParto'])); ?></td>
                <td><?php echo date('d/m/Y', strtotime($row['data_desmame'])); ?></td>
=======
                <td><?= $row['id'] ?></td>
                <td><?= htmlspecialchars($row['nome_matriz']) ?></td>
                <td><?= $row['data_prevista_parto'] ? date('d/m/Y', strtotime($row['data_prevista_parto'])) : '—' ?></td>
                <td><?= $row['data_efetiva_parto'] ? date('d/m/Y', strtotime($row['data_efetiva_parto'])) : '—' ?></td>
                <td><?= $row['data_prevista_desmame'] ? date('d/m/Y', strtotime($row['data_prevista_desmame'])) : '—' ?></td>
                <td><?= $row['data_efetiva_desmame'] ? date('d/m/Y', strtotime($row['data_efetiva_desmame'])) : '—' ?></td>
                <td><?= $row['data_prevista_maternidade'] ? date('d/m/Y', strtotime($row['data_prevista_maternidade'])) : '—' ?></td>
                <td><?= $row['data_efetiva_maternidade'] ? date('d/m/Y', strtotime($row['data_efetiva_maternidade'])) : '—' ?></td>
                <td><?= $row['qtd_crias'] ?></td>
>>>>>>> 9dbd58a (Alterações nas chamadas de telas - Paulino)
                <td>
                    <?php if (in_array('alteracao', $usuario_permissoes)): ?>
                        <button class="btn" onclick="window.location.href='partos_edit.php?id=<?= $row['id'] ?>'">Editar</button>
                    <?php endif; ?>
                    <?php if (in_array('exclusao', $usuario_permissoes)): ?>
                        <button class="btn" onclick="if(confirm('Deseja realmente excluir este parto?')) window.location.href='delete_parto.php?id=<?= $row['id'] ?>'">Excluir</button>
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