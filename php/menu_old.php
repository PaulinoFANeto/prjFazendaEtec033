<?php
$titulo_pagina = "Bem-vindo à tela de Menu Principal";
session_start();
?> 

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Fazenda Etec</title>
    <link rel="stylesheet" href="../css/menu.css">
</head>
<body>
    <?php include 'header.php'; ?>

    <nav>
        <div class="container-nav">
            <div class="grupo">
                <h3>Cadastros</h3>
                <ul>
                    <li><a href="matrizes.php?from=menu.php">Matrizes</a></li>
                    <li><a href="crias.php?from=menu.php">Crias</a></li>
                    <li><a href="vacinas.php?from=menu.php">Vacinas</a></li>
                    <li><a href="procedimentos.php?from=menu.php">Procedimentos</a></li>
                    <li><a href="alimentos.php?from=menu.php">Alimentos</a></li>
                </ul>
            </div>

            <div class="grupo">
                <h3>Vacinação</h3>
                <ul>
                    <li><a href="vacinas_matrizes.php?from=menu.php">De Matrizes</a></li>
                    <li><a href="vacinas_crias.php?from=menu.php">De Crias</a></li>
                </ul>
                <h3>Ações Especiais</h3>
                <ul>
                    <li><a href="partos.php?from=menu.php">Partos</a></li>
                    <li><a href="coberturas.php?from=menu.php">Coberturas</a></li>
                </ul>
            </div>

            <div class="grupo">
                <h3>Procedimentos</h3>
                <ul>
                    <li><a href="procedimentos_matrizes.php?from=menu.php">Em Matrizes</a></li>
                    <li><a href="procedimentos_crias.php?from=menu.php">Em Crias</a></li>
                </ul>
            </div>

            <div class="grupo">
                <h3>Alimentação</h3>
                <ul>
                    <li><a href="alimentacao_matrizes.php?from=menu.php">De Matrizes</a></li>
                    <li><a href="alimentacao_crias.php?from=menu.php">De Crias</a></li>
                </ul>
            </div>

            <div class="grupo">
                <h3>Pesagem</h3>
                <ul>
                    <li><a href="pesagem_matrizes.php?from=menu.php">De Matrizes</a></li>
                    <li><a href="pesagem_crias.php?from=menu.php">De Crias</a></li>
                </ul>
            </div>

            <div class="grupo">
                <h3>Configurações</h3>
                <ul>
                    <!-- Exibir opção de configuração do sistema apenas para administradores -->
                    <?php
                    if (isset($_SESSION['nivel_acesso']) && $_SESSION['nivel_acesso'] === 'Administrador') {
                        echo '<ul><li><a href="configuracoes.php?from=menu.php">Configurações do Sistema</a></li></ul>';
                    }
                    ?>
                </ul>
            </div>

        </div>
    </nav>

    <!-- Modal de Ajuda -->
    <?php
        $titulo_ajuda = "Ajuda - Tela de Menu Principal";
        $descricao_ajuda = "Esta tela exibe uma lista de opções de acesso ao sistema.";
        $itens_ajuda = [
            ['titulo' => 'Cadastros', 'descricao' => 'Usado para fazer os registros básicos.'],
            ['titulo' => 'Vacinação', 'descricao' => 'Permite aplicar as vacinas cadastradas em matrizes ou crias.'],
            ['titulo' => 'Ações Especiais', 'descricao' => 'Registra partos e coberturas de uma matriz.'],
            ['titulo' => 'Procedimentos', 'descricao' => 'Registra outros tipos de procedimentos feitos em matrizes ou crias.'],
            ['titulo' => 'Alimentação', 'descricao' => 'Mantem o registro de tratos feitos em matrizes ou crias.'],
            ['titulo' => 'Pesagem', 'descricao' => 'Mantem o registro de pesagem realizados em matrizes ou crias.'],
            ['titulo' => 'Configurações', 'descricao' => 'Permite alterar as configurações do sistema.'],
            ['titulo' => 'Voltar', 'descricao' => 'Retorna para a tela anterior.'],
            ['titulo' => 'Sair', 'descricao' => 'Encerra a sessão atual.']
        ];
        $observacao_ajuda = "OBSERVAÇÃO: As opções de acesso aparecem de acordo com o nível de permissão do usuário.";
        // Incluir o arquivo de ajuda
        include 'modal_ajuda.php';
    ?>

    <?php include 'footer.php'; ?>
</body>
</html>
