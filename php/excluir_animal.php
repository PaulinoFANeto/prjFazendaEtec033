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

    $sql = "DELETE FROM animals WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Animal excluído com sucesso";
    } else {
        echo "Erro ao excluir animal: " . $conn->error;
    }
}

$conn->close();
header("Location: controle_animais.php");
?>