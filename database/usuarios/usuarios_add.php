<?php
include("../../database/conexao.php");
include("../../database/funcoes.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Verificar se tem todos os dados obrigatórios
    if (!isset($_POST["usuario"], $_POST["senha"], $_POST["email"], $_POST["csrf"], $_POST["nivel_acesso"])) {
        $_SESSION["erro"] = true;
        $_SESSION["resposta"] = "Erro: Algo deu errado.";
        header("Location: ../../admin/usuarios/usuarios.php");
        exit;
    }

    //Sanitizar os dados recebidos por POST
    $usuario = strip_tags(trim($_POST['usuario']));
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $senha = strip_tags(trim($_POST['senha']));
    $csrf = strip_tags(trim($_POST["csrf"]));
    $nivel_acesso = strip_tags(trim($_POST["nivel_acesso"]));

    // Validar token CSRF que vem do formulário
    if (!validarCSRF($csrf) == true) {
        $_SESSION["erro"] = true;
        $_SESSION["resposta"] = "Erro: Algo deu errado.";
        header("Location: ../../admin/usuarios/usuarios.php");
        exit;
    }

    // Validar usuário que vem do formulário
    if (!validarUsuario($usuario) == true) {
        $_SESSION["erro"] = true;
        $_SESSION["resposta"] = "Erro: Nome de usuário inválido.";
        header("Location: ../../admin/usuarios/usuarios.php");
        exit;
    }

    //Validar senha que vem do formulário
    if (validarSenha($senha) == true) {
        // Hash da senha
        $senha_hash = password_hash($senha, PASSWORD_DEFAULT);
    } else {
        $_SESSION["erro"] = true;
        $_SESSION["resposta"] = "Erro: Senha inválida.";
        header("Location: ../../admin/usuarios/usuarios.php");
        exit;
    }


    if (!validarEmail($email) == true) {
        $_SESSION["erro"] = true;
        $_SESSION["resposta"] = "Erro: Email inválido.";
        header("Location: ../../admin/usuarios/usuarios.php");
        exit;
    }

    // Verificações contra o usuário logado
    if (isset($_SESSION['nome'], $_SESSION['email'], $_SESSION['nivel_acesso'])) {
        if (
            $usuario === $_SESSION['nome'] ||
            $email === $_SESSION['email'] ||
            $nivel_acesso === $_SESSION['nivel_acesso']
        ) {
            $_SESSION["erro"] = true;
            $_SESSION["resposta"] = "Erro: Não é permitido cadastrar um usuário com os mesmos dados do usuário logado.";
            header("Location: ../../admin/usuarios/usuarios.php");
            exit;
        }
    }

    // Verifica se usuário existe
    if (verificarContaExiste($email, $usuario) == true) {
        $_SESSION["erro"] = true;
        $_SESSION["resposta"] = "Erro: Nome de usuário ou email já cadastrados.";
        header("Location: ../../admin/usuarios/usuarios.php");
        exit;
    }

    // Validar para saber se os dados chegaram corretamente depois das validações
    if (!empty($usuario) && !empty($senha) && !empty($email) && !empty($nivel_acesso)) {
        try {
            // Inserção no banco
            $insert = "INSERT INTO usuarios (nome, senha, email, nivel_acesso) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($insert);
            $stmt->bind_param("ssss", $usuario, $senha_hash, $email, $nivel_acesso);

            // Se executar manda para a index, se não dá uma mensagem de erro.
            if ($stmt->execute()) {
                $_SESSION["erro"] = false;
                $_SESSION["resposta"] = "Usuário cadastrado com sucesso!";
                header("Location: ../../admin/usuarios/usuarios.php");
                exit;
            } else {
                $_SESSION["erro"] = true;
                $_SESSION["resposta"] = "Erro ao adicionar usuário: " . $stmt->error;
                header("Location: ../../admin/usuarios/usuarios.php");
                exit;
            }
            $stmt->close();
        } catch (Exception $erro) {
            $_SESSION["erro"] = true;
            $_SESSION["resposta"] = "Erro ao adicionar usuário: " . $stmt->error;
            header("Location: ../../admin/usuarios/usuarios.php");
            exit;
        }
    } else {
        $_SESSION["erro"] = true;
        $_SESSION["resposta"] = "Erro: Algo deu errado.";
        header("Location: ../../admin/usuarios/usuarios.php");
        exit;
    }
} else {
    $_SESSION["erro"] = true;
    $_SESSION["resposta"] = "Erro: Algo deu errado.";
    header("Location: ../../admin/usuarios/usuarios.php");
    exit;
}

$conn->close();
