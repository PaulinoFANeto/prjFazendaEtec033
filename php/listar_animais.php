<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "fazenda";

try {
    // Cria conexão
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verifica conexão
    if ($conn->connect_error) {
        throw new Exception("Conexão falhou: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM animals";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();

    echo "<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nome do Animal</th>
            <th>Tipo de Animal</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>";
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . htmlspecialchars($row["id"]) . "</td>
                    <td>" . htmlspecialchars($row["animal_name"]) . "</td>
                    <td>" . htmlspecialchars($row["animal_type"]) . "</td>
                    <td>
                        <a href='editar_animal.php?id=" . urlencode($row["id"]) . "'>Editar</a>
                        <a href='excluir_animal.php?id=" . urlencode($row["id"]) . "'>Excluir</a>
                    </td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='4'>Nenhum animal encontrado</td></tr>";
    }
    echo "</tbody></table>";
    $stmt->close();
    $conn->close();
} catch (Exception $e) {
    echo "Erro: " . $e->getMessage();
}
?>
