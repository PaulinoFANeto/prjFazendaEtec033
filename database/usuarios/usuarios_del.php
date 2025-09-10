<?php
session_start();
include("../../database/conexao.php");
include("../../database/funcoes.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    //Sanitizar os dados recebidos por POST
    $id = strip_tags(trim($_POST['id_usuario']));
    $csrf = strip_tags(trim($_POST["csrf"]));

    // Validar token CSRF que vem do formulário
    if (!validarCSRF($csrf) == true) {
        $_SESSION["erro"] = true;
        $_SESSION["resposta"] = "Erro: Algo deu errado.";
        header("Location: ../../admin/usuarios/usuarios.php");
        exit;
    }

    // Validar para saber se os dados chegaram corretamente depois das validações
    if (!empty($id)) {
        try {
            // Inserção no banco
            $delete = "DELETE FROM `usuarios` WHERE id = ?";
            $stmt = $conn->prepare($delete);
            $stmt->bind_param("i", $id);

            // Se executar manda para a index, se não dá uma mensagem de erro.
            if ($stmt->execute()) {
                $_SESSION["erro"] = false;
                $_SESSION["resposta"] = "Usuário deletado com sucesso!";
                header("Location: ../../admin/usuarios/usuarios.php");
                exit;
            } else {
                $_SESSION["erro"] = true;
                $_SESSION["resposta"] = "Erro ao deletar usuário: " . $stmt->error;
                header("Location: ../../admin/usuarios/usuarios.php");
                exit;
            }
            $stmt->close();
        } catch (Exception $erro) {
            $_SESSION["erro"] = true;
            $_SESSION["resposta"] = "Erro ao deletar usuário: " . $stmt->error;
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
