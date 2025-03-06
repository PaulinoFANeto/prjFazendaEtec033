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
    $nome = $_POST['username'];
    $senha = $_POST['password'];

    /* Prepara a declaração SQL
    Prepared Statements: Usar prepare e bind_param para evitar SQL Injection.
    $stmt: É o objeto da declaração preparada.
    */
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    
    // Verifica se a preparação foi bem-sucedida
    if ($stmt === false) {
        die("Erro na preparação da declaração: " . $conn->error);
    }

    /* 
        A linha $stmt->bind_param("ss", $nome, $senha); 
        faz parte do uso de prepared statements para evitar SQL Injection. 
        
        Vamos detalhar seu funcionamento:
        
        bind_param: Método que vincula variáveis aos parâmetros na declaração SQL.
        "s": Indica os tipo de dados do parâmetro. Neste caso, "s" significa string. 
        ATENÇÃO: Se tivessemos dois parâmetros exemplo: ($nome e $senha), usariamos "ss".

        $nome: É a variavel que será vinculadas ao parâmetro na declaração SQL.
        Isso significa que o valor de $nome será inserido na declaração SQL no lugar apropriado,
        de forma segura, evitando a inserção direta de dados na query, o que poderia causar SQL Injection.
    */
    $stmt->bind_param("s", $nome);

    // Executa a declaração
    $stmt->execute();

    // Obtém o resultado
    /*
    $result = $stmt->get_result();
    Essa linha obtém o resultado da execução da declaração preparada (`$stmt`). Ela funciona da seguinte forma:
    
    1. **Execução da Declaração**: Quando você chama `$stmt->execute()`, a consulta SQL é executada no banco de dados.
    2. **Obtenção do Resultado**: A chamada `$stmt->get_result()` retorna um objeto `mysqli_result` que contém
     o conjunto de resultados da consulta. Esse objeto permite que você acesse os dados retornados pela consulta.
    
    $user = $result->fetch_assoc();
    Essa linha extrai uma linha de resultado do objeto `mysqli_result` como um array associativo. Aqui está o que acontece:
    
    1. **Extração da Linha**: A chamada `$result->fetch_assoc()` obtém a próxima linha do conjunto de resultados 
    como um array associativo, onde as chaves são os nomes das colunas e os valores são os dados correspondentes.
    2. **Armazenamento em `$user`**: A linha extraída é armazenada na variável `$user`. 
    Se não houver mais linhas no conjunto de resultados, `fetch_assoc()` retorna `null`.
    
    Isso permite que você acesse os dados do usuário de forma fácil e segura, por exemplo: Utilize:
        `$user['username']` para obter o nome de usuário
        `$user['password']` para obter a senha criptografada. e assim por diante
    */
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    // Verifica se o usuário foi encontrado e se a senha está correta
    if ($user && password_verify($senha, $user['password'])) {
        // Redireciona para menu.html
        header("Location: ../menu.html");
        exit(); // Garante que o script pare de executar após o redirecionamento    
    } else {
        echo "Nome de usuário ou senha incorretos.";
    }

    // Fecha a declaração
    $stmt->close();
}

// Fecha a conexão
$conn->close();
?>
