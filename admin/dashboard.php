<?php
include("../database/conexao.php");

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: ../index.php");
    exit;
}

// // Exemplo de restrição por nível
// if ($_SESSION['nivel_acesso'] !== 'Administrador') {
//     echo "Acesso negado. Esta área é restrita a administradores.";
//     exit;
// }
?>

<?php
$titulo_pagina = "Bem-vindo à tela de Menu Principal";
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Fazenda Etec</title>
    <link rel="stylesheet" href="../assets/css/menu.css">
</head>

<body>
    <?php include '../include/header.php'; ?>

    <nav>
        <div class="container-nav">
            <div class="grupo">
                <h3>Manejos</h3>
                <ul>
                    <li><a href="manejos/matrizes/matrizes.php">Matrizes</a></li>
                    <li><a href="manejos/crias/crias.php">Crias</a></li>
                    <li><a href="manejos/vacinas/vacinas.php">Vacinas</a></li>
                    <li><a href="manejos/procedimentos/procedimentos.php">Procedimentos</a></li>
                    <li><a href="manejos/alimentos/alimentos.php">Nutrições</a></li>
                </ul>
            </div>

            <div class="grupo">
                <h3>Vacinação</h3>
                <ul>
                    <li><a href="vacinacao/vacinas_matrizes.php">De Matrizes</a></li>
                    <li><a href="vacinacao/vacinas_crias.php">De Crias</a></li>
                </ul>
            </div>

            <div class="grupo">
                <h3>Manejos Especiais</h3>
                <ul>
                    <li><a href="manejos_especiais/partos/partos.php">Partos</a></li>
                    <li><a href="manejos_especiais/coberturas/coberturas.php">Coberturas</a></li>
                </ul>
            </div>

            <div class="grupo">
                <h3>Procedimentos</h3>
                <ul>
                    <li><a href="procedimentos/procedimentos_matrizes.php">Em Matrizes</a></li>
                    <li><a href="procedimentos/procedimentos_crias.php">Em Crias</a></li>
                </ul>
            </div>

            <div class="grupo">
                <h3>Nutrição</h3>
                <ul>
                    <li><a href="nutricao/alimentacao_matrizes.php">De Matrizes</a></li>
                    <li><a href="nutricao/alimentacao_crias.php">De Crias</a></li>
                </ul>
            </div>

            <div class="grupo">
                <h3>Pesagem</h3>
                <ul>
                    <li><a href="pesagem/pesagem_matrizes.php">De Matrizes</a></li>
                    <li><a href="pesagem/pesagem_crias.php">De Crias</a></li>
                </ul>
            </div>

            <!-- Exibir opção de configuração do sistema apenas para administradores -->
            <?php
            if (isset($_SESSION['nivel_acesso']) && $_SESSION['nivel_acesso'] === 'Administrador') {
                echo '
                        <div class="grupo">
                            <h3>Configurações</h3>
                            <ul>
                                <ul><li><a href="../admin/configuracoes.php">Configurações do Sistema</a></li></ul>
                            </ul>
                        </div>
                    ';
            }
            ?>
        </div>
    </nav>

    <!-- Modal de Ajuda -->
    <?php
    $titulo_ajuda = "Ajuda - Tela de Menu Principal";
    $descricao_ajuda = "Esta tela exibe uma lista de opções de acesso ao sistema.";
    $itens_ajuda = [
        ['titulo' => 'Manejos', 'descricao' => 'Usado para fazer os registros básicos do sistema.'],
        ['titulo' => 'Vacinação', 'descricao' => 'Permite aplicar as vacinas cadastradas em matrizes ou crias.'],
        ['titulo' => 'Manejos Especiais', 'descricao' => 'Registra partos e coberturas de uma matriz.'],
        ['titulo' => 'Procedimentos', 'descricao' => 'Registra outros tipos de procedimentos feitos em matrizes ou crias.'],
        ['titulo' => 'Nutrição', 'descricao' => 'Mantem o registro de tratos feitos em matrizes ou crias.'],
        ['titulo' => 'Pesagem', 'descricao' => 'Mantem o registro de pesagem realizados em matrizes ou crias.'],
        ['titulo' => 'Configurações', 'descricao' => 'Permite alterar as configurações do sistema.'],
        ['titulo' => 'Voltar', 'descricao' => 'Retorna para a tela anterior.'],
        ['titulo' => 'Sair', 'descricao' => 'Encerra a sessão atual.']
    ];
    $observacao_ajuda = "OBSERVAÇÃO: As opções de acesso aparecem de acordo com o nível de permissão do usuário.";
    // Incluir o arquivo de ajuda
    include '../include/modal_ajuda.php';
    ?>

    <?php include '../include/footer.php'; ?>
</body>

</html>