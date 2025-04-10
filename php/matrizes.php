<?php
include 'db.php';
$sql = "SELECT * FROM matrizes";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Matrizes</title>
    <style>
        :root {
            --verde-base: #4e944f;
            --verde-hover: #3b7a3f;
            --fundo-claro: #f0f5ec;
            --texto-claro: #ffffff;
            --borda: #c7e1c4;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: var(--fundo-claro);
            margin: 0;
            padding: 20px;
        }

        /* Layout superior */
        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .top-bar h1 {
            margin: 0;
            text-align: center;
            flex-grow: 1;
        }

        /* Botões */
        .btn {
            background-color: var(--verde-base);
            color: var(--texto-claro);
            border: none;
            border-radius: 6px;
            padding: 8px 14px;
            font-size: 14px;
            cursor: pointer;
            transition: background-color 0.2s ease;
        }

        .btn:hover {
            background-color: var(--verde-hover);
        }

        .btn-group {
            display: flex;
            justify-content: flex-end;
            margin-bottom: 10px;
        }

        /* Tabela */
        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #fff;
            border-radius: 6px;
            overflow: hidden;
        }

        th {
            background-color: var(--verde-base);
            color: var(--texto-claro);
        }

        th, td {
            padding: 6px 10px;
            border: 1px solid var(--borda);
            text-align: left;
            font-size: 14px;
        }

        tr:nth-child(even) {
            background-color: #f8fbf6;
        }

        /* Modal */
        .modal {
            display: none;
            position: fixed;
            z-index: 999;
            padding-top: 100px;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
        }

        .modal-content {
            background-color: var(--fundo-claro);
            margin: auto;
            padding: 20px;
            border-radius: 8px;
            width: 60%;
            box-shadow: 0 0 10px rgba(0,0,0,0.2);
            color: #333;
        }

        .close {
            color: #666;
            float: right;
            font-size: 24px;
            font-weight: bold;
            cursor: pointer;
        }

        .close:hover {
            color: #000;
        }
    </style>
</head>
<body>

    <!-- Topo com botão de voltar, título e ajuda -->
    <div class="top-bar">
        <button class="btn" onclick="window.history.back();">Voltar</button>
        <h1>Bem vindo a tela de Matrizes</h1>
        <button class="btn" onclick="document.getElementById('modalAjuda').style.display='block'">Ajudar</button>
    </div>

    <!-- Botão adicionar -->
    <div class="btn-group">
        <button class="btn" onclick="window.location.href='add_matriz.php'">Adicionar nova Matriz</button>
    </div>

    <!-- Tabela -->
    <table>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Raça</th>
            <th>Peso (kg)</th>
            <th>Data de Nascimento</th>
            <th>Data de Entrada</th>
            <th>Ações</th>
        </tr>
        <?php while($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['nome']; ?></td>
            <td><?php echo $row['raça']; ?></td>
            <td><?php echo $row['peso']; ?></td>
            <td><?php echo date('d/m/Y', strtotime($row['data_nascimento'])); ?></td>
            <td><?php echo date('d/m/Y', strtotime($row['data_entrada'])); ?></td>
            <td>
                <button class="btn" onclick="window.location.href='edit_matriz.php?id=<?php echo $row['id']; ?>'">Editar</button>
                <button class="btn" onclick="if(confirm('Deseja realmente excluir esta matriz?')) window.location.href='delete_matriz.php?id=<?php echo $row['id']; ?>'">Excluir</button>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>

    <!-- Modal de Ajuda -->
    <div id="modalAjuda" class="modal">
        <div class="modal-content">
            <span class="close" onclick="document.getElementById('modalAjuda').style.display='none'">&times;</span>
            <h2>Ajuda - Tela de Matrizes</h2>
            <p>Esta tela exibe uma lista de todas as matrizes cadastradas no sistema.</p>
            <ul>
                <li><strong>Adicionar</strong>: Permite incluir uma nova matriz.</li>
                <li><strong>Editar</strong>: Abre um formulário para editar os dados da matriz.</li>
                <li><strong>Excluir</strong>: Remove a matriz do sistema.</li>
                <li><strong>Voltar</strong>: Retorna para a tela anterior.</li>
            </ul>
        </div>
    </div>

    <script>
        window.onclick = function(event) {
            const modal = document.getElementById('modalAjuda');
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>
</body>
</html>
