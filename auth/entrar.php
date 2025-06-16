<?php
include("../database/conexao.php");
include("../database/funcoes.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (!isset($_POST['usuario'], $_POST['senha'])) {
        die("Erro: Campos obrigatórios não enviados.");
    }

    $nome = trim($_POST['usuario']);
    $senha = $_POST['senha'];

    // Validação backend do nome de usuário
    if (validarUsuario($nome)) {
        die("Erro: Nome de usuário inválido.");
    }

    // Validação backend da senha do usuário
    if (validarSenha($senha)) {
        die("Erro: Senha inválida.");
    }

    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE nome = ?");
    if (!$stmt) {
        die("Erro na preparação da consulta: " . $conn->error);
    }

    $stmt->bind_param("s", $nome);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && password_verify($senha, $user['senha'])) {
        $_SESSION['usuario_id'] = $user['id'];
        $_SESSION['nome'] = $user['nome'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['nivel_acesso'] = $user['nivel_acesso'];
        $_SESSION['loggedin'] = true;

        // Redireciona com base no nível de acesso
        switch ($user['nivel_acesso']) {
            case 'administrador':
                header("Location: admin_dashboard.php");
                break;
            case 'docente':
                header("Location: docente_dashboard.php");
                break;
            case 'auxiliar':
                header("Location: auxiliar_dashboard.php");
                break;
            case 'aluno':
                header("Location: aluno_dashboard.php");
                break;
            default:
                header("Location: ../admin/dashboard.php");
        }
        exit;
    } else {
        echo "Usuário ou senha incorretos.";
    }

    $stmt->close();
} else {
    die("Erro: Requisição inválida.");
}

$conn->close();
