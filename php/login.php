<?php
include 'db.php';

/*
Método de Requisição: Verificar se a requisição é do tipo POST com $_SERVER["REQUEST_METHOD"].

Os métodos de requisição são formas de um cliente (como um navegador web) interagir com um servidor. Os mais comuns são:

GET: Usado para solicitar dados de um servidor. Os dados são enviados na URL. Exemplo: acessar uma página web.
POST: Usado para enviar dados ao servidor. Os dados são incluídos no corpo da requisição. Exemplo: enviar um formulário.
PUT: Usado para atualizar dados existentes no servidor.
DELETE: Usado para deletar dados no servidor.
No código, usamos $_SERVER["REQUEST_METHOD"] para verificar se a requisição é do tipo POST, 
garantindo que estamos lidando com dados enviados por um formulário.
*/

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['usuario'];
    $senha = $_POST['senha'];

    // Prepara a declaração SQL
    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE nome = ?");
    
    // Verifica se a preparação foi bem-sucedida
    if ($stmt === false) {
        die("Erro na preparação da declaração: " . $conn->error);
    }

    // Vincula os parâmetros
    $stmt->bind_param("s", $nome);

    // Executa a declaração
    $stmt->execute();

    // Obtém o resultado
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

 
    if ($user) {
        echo "Nome: " . $user['nome'] . "<br>";
        echo "Minha Senha: " . $senha . "<br>";
        echo "Senha Criptografada: " . $user['senha'] . "<br>";
        if (password_verify($senha, $user['senha'])) {
            // Redireciona para menu principal do sistema
            header("Location: index.php");
        } else {
            echo "Senha incorreta.";
        }
    } else {
        echo "Usuário não encontrado.";
    }

    /*

    // Verifica se o usuário foi encontrado e se a senha está correta
//    if ($user && password_verify($senha, $user['senha'])) {
    if ($user && $senha) {
        // Redireciona para menu principal do sistema
        header("Location: index.php");
        exit(); // Garante que o script pare de executar após o redirecionamento    
    } else {
        echo "Nome de usuário ou senha incorretos.";
    }

    */  

    // Fecha a declaração
    $stmt->close();
}

// Fecha a conexão
$conn->close();
?>