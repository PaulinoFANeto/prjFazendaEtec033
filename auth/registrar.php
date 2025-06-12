<?php
include("../database/conexao.php");
include("../database/funcoes.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Verificar se tem todos os dados obrigatórios
    if (!isset($_POST["usuario"], $_POST["senha"], $_POST["confirma_senha"], $_POST["email"], $_POST["csrf"])) {
        die("Erro: Campos obrigatórios não enviados.");
    }

    //Sanitizar os dados recebidos por POST
    $usuario = strip_tags(trim($_POST['usuario']));
    $senha = strip_tags(trim($_POST['senha']));
    $confirma_senha = strip_tags(trim($_POST["confirma_senha"]));
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $data_cadastro = date('Y-m-d H:i:s');
    $csrf = strip_tags(trim($_POST["csrf"]));

    // Validar token CSRF que vem do formulário
    if (!validarCSRF($csrf) == true) {
        die("Erro: Token CSRF inválido.");
    }

    // Validar usuário que vem do formulário
    if (!validarUsuario($usuario) == true) {
        die("Erro: Nome de usuário inválido.");
    }

    //Validar senha que vem do formulário
    if ($senha === $confirma_senha) {
        if ((validarSenha($senha) == true) && (validarSenha($confirma_senha) == true)) {
            // Hash da senha
            $senha_hash = password_hash($senha, PASSWORD_DEFAULT);
        } else {
            die("Erro: Senha inválida.");
        }
    } else {
        die("Erro: Senhas não conferem.");
    }


    if (!validarEmail($email) == true) {
        die("Erro: Email inválido.");
    }

    // Verificações contra o usuário logado
    if (isset($_SESSION['nome'], $_SESSION['email'], $_SESSION['nivel_acesso'])) {
        if (
            $usuario === $_SESSION['nome'] ||
            $email === $_SESSION['email'] ||
            $nivel_acesso === $_SESSION['nivel_acesso']
        ) {
            die("Erro: Não é permitido cadastrar um usuário com os mesmos dados do usuário logado.");
        }
    }

    // Verifica se usuário existe
    if (verificarContaExiste($email, $usuario) == true) {
        die("Erro: Nome de usuário ou email já cadastrados.");
    }

    // Validar para saber se os dados chegaram corretamente depois das validações
    if (!empty($usuario) && !empty($senha) && !empty($email) && !empty($data_cadastro)) {
        try {
            // Inserção no banco
            $insert = "INSERT INTO usuarios (nome, senha, email, data_cadastro) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($insert);
            $stmt->bind_param("ssss", $usuario, $senha_hash, $email, $data_cadastro);

            // Se executar manda para a index, se não dá uma mensagem de erro.
            if ($stmt->execute()) {
                header("Location: ../entrar.php");
                exit;
            } else {
                die("Erro ao cadastrar: " . $stmt->error);
            }
            $stmt->close();
        } catch (Exception $erro) {
            die("Erro: " . $erro->getCode());
        }
    } else {
        die("Erro: Os parâmetros não chegaram corretamente!");
    }
} else {
    die("Erro: método inválido!");
}

$conn->close();
