<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "fazendaEtec";

// Cria conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['usuario'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
    $email - $_POST['email'];
    $nivel_acesso = $_POST['nivel_acesso'];
    $data_cadastro = date('Y-m-d H:i:s');

    $sql = "INSERT INTO usuarios (nome, senha, email, nivel_acesso, data_cadastro) 
    VALUES ('$usuario', '$senha', '$email', '$nivel_acesso', '$data_cadastro')";

    if ($conn->query($sql) === TRUE) {
        echo "Novo usuário cadastrado com sucesso";
    } else {
        echo "Erro: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>