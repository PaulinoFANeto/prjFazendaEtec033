<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "fazenda";

// Cria conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

$sql = "SELECT * FROM animals";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row["id"] . "</td>
                <td>" . $row["animal_name"] . "</td>
                <td>" . $row["animal_type"] . "</td>
                <td>
                    <a href='php/editar_animal.php?id=" . $row["id"] . "'>Editar</a>
                    <a href='php/excluir_animal.php?id=" . $row["id"] . "'>Excluir</a>
                </td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='4'>Nenhum animal encontrado</td></tr>";
}

$conn->close();
?>