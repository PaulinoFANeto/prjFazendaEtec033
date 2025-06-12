<?php
include("../database/conexao.php");
include("../database/funcoes.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Verificar se tem todos os dados obrigatórios
    if (!isset($_POST["usuario"], $_POST["senha"])) {
        die("Erro: Campos obrigatórios não enviados.");
    }

    //Sanitizar os dados recebidos por POST
    $usuario = strip_tags(trim($_POST['usuario']));
    $senha = strip_tags(trim($_POST['senha']));

    // Validar usuário que vem do formulário
    if (!validarUsuario($usuario) == true) {
        die("Erro: Nome de usuário inválido.");
    }

    //Validar senha que vem do formulário
    if (!validarSenha($senha) == true) {
        die("Erro: Senha inválida.");
    }

    // Validar para saber se os dados chegaram corretamente depois das validações
    if (!empty($usuario) && !empty($senha)) {
        try {
            $select = "SELECT id, nome, email, nivel_acesso, senha FROM usuarios WHERE nome = ?";
            $stmt = $conn->prepare($select);
            $stmt->bind_param("s", $usuario);
            $stmt->execute();
            $stmt->bind_result($id, $usuario_db, $email, $nivel_acesso, $senha_db);

            if ($stmt->fetch()) {

                if (!empty($usuario_db) && password_verify($senha, $senha_db)) {
                    $_SESSION['usuario_id'] = $id;
                    $_SESSION['nome'] = $usuario_db;
                    $_SESSION['email'] = $email;
                    $_SESSION['nivel_acesso'] = $nivel_acesso;
                    $_SESSION['loggedin'] = true;
                    header("Location: ../admin/notifica_tarefa.php");
                    exit;
                } else {
                    echo "Usuário ou senha incorretos.";
                }
            } else {
                die("Erro: Os parâmetros não chegaram corretamente!");
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
