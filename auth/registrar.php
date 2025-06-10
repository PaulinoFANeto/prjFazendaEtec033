<?php
include("../database/conexao.php");
include("../database/funcoes.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $usuario = strip_tags(trim($_POST['usuario']));
    $senha = strip_tags(trim($_POST['senha']));
    $confirma_senha = strip_tags(trim($_POST["confirma_senha"]));
    $email = strip_tags(trim($_POST['email']));
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

    // Continuar daqui - Leandro

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


    // Verifica se nome ou email já existem
    $stmt = $conn->prepare("SELECT id FROM usuarios WHERE nome = ? OR email = ?");
    $stmt->bind_param("ss", $usuario, $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        die("Erro: Nome de usuário ou email já cadastrados.");
    }
    $stmt->close();

    // Inserção no banco
    $stmt = $conn->prepare("INSERT INTO usuarios (nome, senha, email, nivel_acesso, data_cadastro) VALUES (?, ?, ?, ?, ?)");
    if (!$stmt) {
        die("Erro na preparação da inserção: " . $conn->error);
    }

    $stmt->bind_param("sssss", $usuario, $senha_hash, $email, $nivel_acesso, $data_cadastro);

    if ($stmt->execute()) {
        header("Location: ../index.php");
        exit;
    } else {
        echo "Erro ao cadastrar: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
