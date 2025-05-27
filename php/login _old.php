<?php
// Inclui o arquivo de conexão com o banco de dados
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica se os campos "usuario" e "senha" foram enviados
    if (isset($_POST['usuario']) && isset($_POST['senha'])) {
        $nome = $_POST['usuario'];
        $senha = $_POST['senha'];

        // Armazena o nome e senha na sessão
        $_SESSION['usuario'] = $nome;
        $_SESSION['senha'] = $senha;

        // Prepara a declaração SQL para validar o usuário
        $stmt = $conn->prepare("SELECT * FROM usuarios WHERE nome = ?");
        if ($stmt === false) {
            die("Erro na preparação da consulta: " . $conn->error);
        }

        // Vincula os parâmetros e executa a declaração
        $stmt->bind_param("s", $nome);
        $stmt->execute();

        // Obtém o resultado
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        // Verifica se o usuário foi encontrado e a senha está correta
        if ($user && password_verify($senha, $user['senha'])) {
            $_SESSION['usuario_id'] = $user['id'];
            $_SESSION['nome'] = $user['nome'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['nivel_acesso'] = $user['nivel_acesso'];
            $_SESSION['data_cadastro'] = $user['data_cadastro'];
            $_SESSION['loggedin'] = true; // Define a variável de sessão de login
            
            // Redireciona para a página de menu do sistemas
            header("Location: menu.php");
            exit;
        } else {
            echo "Nome de usuário ou senha incorretos.";
        }

        // Fecha a declaração
        $stmt->close();
    } else {
        die("Erro: Campos de usuário ou senha não foram enviados.");
    }
} else {
    die("Erro: Requisição inválida. Use o método POST.");
}

// Fecha a conexão
$conn->close();
?>