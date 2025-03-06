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

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM animals WHERE id=$id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $animal = $result->fetch_assoc();
    } else {
        echo "Animal não encontrado";
    }
}

$conn->close();
?>