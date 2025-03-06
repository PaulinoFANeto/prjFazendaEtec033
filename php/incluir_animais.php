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
    $animal_name = $_POST['animal_name'];
    $animal_type = $_POST['animal_type'];

    $sql = "INSERT INTO animals (animal_name, animal_type) VALUES ('$animal_name', '$animal_type')";

    if ($conn->query($sql) === TRUE) {
        echo "Novo animal adicionado com sucesso";
    } else {
        echo "Erro: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>