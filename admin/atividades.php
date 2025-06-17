<?php
session_start();

include("../database/conexao.php");

date_default_timezone_set('America/Sao_Paulo');
$dataHoje = date('Y-m-d');
$dataLimite = date('Y-m-d', strtotime('+5 days'));

$atividades = [];

// Função auxiliar para adicionar atividade
function adicionarAtividade(&$atividades, $descricao, $dataPrevista, $dataEfetiva) {
    global $dataHoje;

    // Se não houver data prevista, não há como gerar atividade
    if (!$dataPrevista) return;

    $dataPrevistaObj = new DateTime($dataPrevista);
    $dataHojeObj = new DateTime($dataHoje);

    if (!empty($dataEfetiva)) {
        $status = 'REALIZADA';
        $corBase = 'verde';
        $dataAcao = $dataEfetiva;
    } else {
        if ($dataPrevistaObj < $dataHojeObj) {
            $status = 'ATRASADA';
            $corBase = 'vermelha';
        } else {
            $status = 'PREVISTA';
            $corBase = 'amarela';
        }
        $dataAcao = $dataPrevista;
    }

    // Define classe CSS com base no tipo de atividade
    $classe = $corBase;

    $atividades[] = [
        'descricao' => $descricao,
        'status' => $status,
        'classe' => $classe,
        'data_acao' => $dataAcao
    ];
}

// Exemplo com a tabela de partos
$sql = "SELECT 
            p.id, 
            p.matriz_id, 
            m.nome AS nome_matriz,
            p.data_prevista_parto, 
            p.data_efetiva_parto, 
            p.data_prevista_desmame, 
            p.data_efetiva_desmame, 
            p.data_prevista_maternidade, 
            p.data_efetiva_maternidade 
        FROM partos p
        JOIN matrizes m ON p.matriz_id = m.id";

$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
    $id = $row['id'];
    $matriz = $row['nome_matriz'];

    adicionarAtividade($atividades, "Verificar parto da matriz ($matriz)", $row['data_prevista_parto'], $row['data_efetiva_parto']);
    adicionarAtividade($atividades, "Verificar desmame da matriz ($matriz)", $row['data_prevista_desmame'], $row['data_efetiva_desmame']);
    adicionarAtividade($atividades, "Transferir matriz ($matriz) para maternidade", $row['data_prevista_maternidade'], $row['data_efetiva_maternidade']);
}

// Outras tabelas podem ser adicionadas aqui com lógica semelhante...

?>

<!-- HTML da tabela -->
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Atividades Pendentes</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ccc;
        }
        .vermelha { background-color: #f8d7da; }
        .amarela { background-color: #fff3cd; }
        .verde { background-color: #d4edda; }
        .paginacao {
            margin-top: 15px;
            text-align: center;
        }
        .paginacao button {
            margin: 0 5px;
            padding: 5px 10px;
            cursor: pointer;
        }

        th.sortable {
            cursor: pointer;
            user-select: none;
        }
        th.sortable::after {
            content: ' ⇅';
            font-size: 0.8em;
            color: #888;
        }

    </style>

</head>
<body>
    <h2>Atividades do Sistema</h2>

    <div style="margin-bottom: 15px;">
        <label for="filtroStatus">Status:</label>
        <select id="filtroStatus">
            <option value="">Todos</option>
            <option value="ATRASADA">ATRASADA</option>
            <option value="PREVISTA">PREVISTA</option>
            <option value="REALIZADA">REALIZADA</option>
        </select>

        <label for="filtroDescricao" style="margin-left: 15px;">Descrição:</label>
        <input type="text" id="filtroDescricao" placeholder="Buscar...">

        <label for="filtroData" style="margin-left: 15px;">Data Ação:</label>
        <input type="date" id="filtroData">
    </div>

    <table id="tabelaAtividades">
        <thead>
            <tr>
                <th class="sortable">Nro Atividade</th>
                <th class="sortable">Descrição</th>
                <th class="sortable">Status</th>
                <th class="sortable">Data Ação</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($atividades as $index => $atividade): ?>
                <tr class="<?= $atividade['classe'] ?>">
                    <td><?= str_pad($index + 1, 3, '0', STR_PAD_LEFT) ?></td>
                    <td><?= $atividade['descricao'] ?></td>
                    <td><?= $atividade['status'] ?></td>
                    <td><?= date('Y-m-d', strtotime($atividade['data_acao'])) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="paginacao" id="paginacao"></div>

    <div style="margin-top: 20px; text-align: center;">
        <form action="dashboard.php" method="get">
            <button type="submit">Ir para o Dashboard</button>
        </form>
    </div>


    <script>
        const filtroStatus = document.getElementById('filtroStatus');
        const filtroDescricao = document.getElementById('filtroDescricao');
        const filtroData = document.getElementById('filtroData');
        const tabela = document.getElementById('tabelaAtividades').getElementsByTagName('tbody')[0];
        const paginacao = document.getElementById('paginacao');

        let linhasPorPagina = 10;
        let paginaAtual = 1;

        function filtrarTabela() {
            const status = filtroStatus.value.toUpperCase();
            const descricao = filtroDescricao.value.toLowerCase();
            const data = filtroData.value;

            const linhas = Array.from(tabela.rows);
            linhas.forEach(row => {
                const cellDescricao = row.cells[1].textContent.toLowerCase();
                const cellStatus = row.cells[2].textContent.toUpperCase();
                const cellData = row.cells[3].textContent;

                const matchStatus = !status || cellStatus === status;
                const matchDescricao = !descricao || cellDescricao.includes(descricao);
                const matchData = !data || cellData === data;

                row.style.display = (matchStatus && matchDescricao && matchData) ? '' : 'none';
            });

            paginaAtual = 1;
            aplicarPaginacao();
        }

        function aplicarPaginacao() {
            const linhas = Array.from(tabela.rows).filter(row => row.style.display !== 'none');
            const totalPaginas = Math.ceil(linhas.length / linhasPorPagina);

            linhas.forEach((row, index) => {
                row.style.display = (index >= (paginaAtual - 1) * linhasPorPagina && index < paginaAtual * linhasPorPagina) ? '' : 'none';
            });

            paginacao.innerHTML = '';
            for (let i = 1; i <= totalPaginas; i++) {
                const btn = document.createElement('button');
                btn.textContent = i;
                if (i === paginaAtual) btn.disabled = true;
                btn.addEventListener('click', () => {
                    paginaAtual = i;
                    aplicarPaginacao();
                });
                paginacao.appendChild(btn);
            }
        }

        filtroStatus.addEventListener('change', filtrarTabela);
        filtroDescricao.addEventListener('input', filtrarTabela);
        filtroData.addEventListener('change', filtrarTabela);

        window.onload = () => {
            aplicarPaginacao();
        };


        document.querySelectorAll("th.sortable").forEach((header, columnIndex) => {
            let asc = true;
            header.addEventListener("click", () => {
                const tbody = document.querySelector("#tabelaAtividades tbody");
                const rows = Array.from(tbody.querySelectorAll("tr")).filter(row => row.style.display !== "none");

                rows.sort((a, b) => {
                    const cellA = a.cells[columnIndex].textContent.trim();
                    const cellB = b.cells[columnIndex].textContent.trim();

                    // Tenta converter para data
                    const dateA = Date.parse(cellA);
                    const dateB = Date.parse(cellB);

                    if (!isNaN(dateA) && !isNaN(dateB)) {
                        return asc ? dateA - dateB : dateB - dateA;
                    }

                    // Tenta converter para número
                    const numA = parseFloat(cellA);
                    const numB = parseFloat(cellB);
                    if (!isNaN(numA) && !isNaN(numB)) {
                        return asc ? numA - numB : numB - numA;
                    }

                    // Ordenação alfabética
                    return asc ? cellA.localeCompare(cellB) : cellB.localeCompare(cellA);
                });

                rows.forEach(row => tbody.appendChild(row));
                asc = !asc;
            });
        });

    </script>
</body>
</html>
