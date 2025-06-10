<?php
// Arquivo criado para iniciar sessão - ele verifica se existe e se não existir ele inicia a sessão - Leandro
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
// Configuração do banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "fazendaEtec";

// Criar conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Tornar a conexão acessível globalmente
$GLOBALS['conn'] = $conn;
