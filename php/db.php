<?php
// Certifique-se de iniciar a sessão corretamente
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Configuração do banco de dados
$servername = "localhost";
$dbname = "fazendaEtec";

// Verifica se as variáveis de sessão estão definidas
if (isset($_SESSION['usuario']) && isset($_SESSION['senha'])) {
    $username = $_SESSION['usuario'];
    $password = $_SESSION['senha'];
} else {
    die("Erro: Usuário ou senha não definidos na sessão.");
}

// Criar conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}
?>