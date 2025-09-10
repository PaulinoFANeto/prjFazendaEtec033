<?php
include("../../database/conexao.php");
include("../../database/funcoes.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Verificar se tem todos os dados obrigatórios
    if (!isset($_POST["usuario_id"], $_POST["usuario"], $_POST["senha"], $_POST["email"], $_POST["csrf"], $_POST["nivel_acesso"])) {
        $_SESSION["erro"] = true;
        $_SESSION["resposta"] = "Erro: Algo deu errado.";
        header("Location: ../../admin/usuarios/usuarios.php");
        exit;
    }

    //Sanitizar os dados recebidos por POST
    $usuario_id = strip_tags(trim($_POST['usuario_id']));
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

    // Validar para saber se os dados chegaram corretamente depois das validações
    if (!empty($usuario_id) && !empty($usuario) && !empty($senha) && !empty($email) && !empty($nivel_acesso)) {
        try {
            // Inserção no banco
            $update = "UPDATE usuarios SET nome = ?, senha = ?, email = ?, nivel_acesso = ? WHERE id = ?";
            $stmt = $conn->prepare($update);
            $stmt->bind_param("ssssi", $usuario, $senha_hash, $email, $nivel_acesso, $usuario_id);

            // Se executar manda para a index, se não dá uma mensagem de erro.
            if ($stmt->execute()) {
                $_SESSION["erro"] = false;
                $_SESSION["resposta"] = "Usuário editado com sucesso!";
                header("Location: ../../admin/usuarios/usuarios.php");
                exit;
            } else {
                $_SESSION["erro"] = true;
                $_SESSION["resposta"] = "Erro ao editar usuário: " . $stmt->error;
                header("Location: ../../admin/usuarios/usuarios.php");
                exit;
            }
            $stmt->close();
        } catch (Exception $erro) {
            $_SESSION["erro"] = true;
            $_SESSION["resposta"] = "Erro ao editar usuário: " . $stmt->error;
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
