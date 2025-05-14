<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['usuario'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
    $email = $_POST['email'];
    $nivel_acesso = $_POST['nivel_acesso'];
    $data_cadastro = date('Y-m-d H:i:s');

    // Prepara a declaração SQL
    $stmt = $conn->prepare("INSERT INTO usuarios (nome, senha, email, nivel_acesso, data_cadastro) VALUES (?, ?, ?, ?, ?)");
    if ($stmt === false) {
        die("Erro na preparação da inserção: " . $conn->error);
    }

    // Vincula os parâmetros
    $stmt->bind_param("sssss", $usuario, $senha, $email, $nivel_acesso, $data_cadastro);

    // Executa a declaração
    if ($stmt->execute()) {
        // Redireciona para tela de login
        header("Location: index.php");
        exit(); // Garante que o script pare de executar após o redirecionamento    
    } else {
        echo "Erro: " . $stmt->error;
    }

    // Fecha a declaração
    $stmt->close();
}

// Fecha a conexão
$conn->close();
?>