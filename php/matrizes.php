<?php
$titulo_pagina = "Bem-vindo à tela de Matrizes";
include 'auth.php';

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
    <link rel="stylesheet" href="../css/estilo.css">
    <script>
        function sortTable(n) {
            const table = document.getElementById("matrizTable");
            let rows, switching, i, x, y, shouldSwitch, dir = "asc", switchcount = 0;
            switching = true;

            while (switching) {
                switching = false;
                rows = table.rows;

                for (i = 1; i < rows.length - 1; i++) {
                    shouldSwitch = false;
                    x = rows[i].getElementsByTagName("TD")[n];
                    y = rows[i + 1].getElementsByTagName("TD")[n];

                    if (dir == "asc" && x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                        shouldSwitch = true;
                        break;
                    } else if (dir == "desc" && x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                        shouldSwitch = true;
                        break;
                    }
                }

                if (shouldSwitch) {
                    rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                    switching = true;
                    switchcount++;
                } else {
                    if (switchcount === 0 && dir == "asc") {
                        dir = "desc";
                        switching = true;
                    }
                }
            }
        }
    </script>
</head>
<body>
<div class="container">
    <?php include 'header.php'; ?>

    <div class="btn-group">
        <div class="search-container">
            <input type="text" id="search" placeholder="Buscar matriz..." 
                onkeyup="window.location.href='?search=' + this.value">
        </div>
    
        <?php if (in_array('inclusao', $usuario_permissoes)): ?>
            <button class="btn" onclick="window.location.href='add_matriz.php'">Adicionar nova Matriz</button>
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
            <th>Ações</th>
        </tr>
        <?php while($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['nome']; ?></td>
            <td><?php echo $row['raca']; ?></td>
            <td><?php echo $row['peso']; ?></td>
            <td><?php echo date('d/m/Y', strtotime($row['data_nascimento'])); ?></td>
            <td><?php echo date('d/m/Y', strtotime($row['data_entrada'])); ?></td>
            <td>
                <?php if (in_array('alteracao', $usuario_permissoes)): ?>
                    <button class="btn" onclick="window.location.href='edit_matriz.php?id=<?php echo $row['id']; ?>'">Editar</button>
                <?php endif; ?>
                <?php if (in_array('exclusao', $usuario_permissoes)): ?>
                    <button class="btn" onclick="if(confirm('Deseja realmente excluir esta matriz?')) window.location.href='delete_matriz.php?id=<?php echo $row['id']; ?>'">Excluir</button>
                <?php endif; ?>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</div>

<?php include 'footer.php'; ?>
</body>
</html>

