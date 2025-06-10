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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $animal_name = $_POST['animal_name'];
    $animal_type = $_POST['animal_type'];

    $sql = "UPDATE animals SET animal_name='$animal_name', animal_type='$animal_type' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Animal atualizado com sucesso";
    } else {
        echo "Erro ao atualizar animal: " . $conn->error;
    }
}

$conn->close();
header("Location: controle_animais.php");
?>