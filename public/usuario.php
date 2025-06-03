<?php
include '../auth/db.php';


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $usuario = trim($_POST['usuario']);
    $senha = $_POST['senha'];
    $email = trim($_POST['email']);
    $nivel_acesso = $_POST['nivel_acesso'];
    $data_cadastro = date('Y-m-d H:i:s');

    // Validações
    if (!preg_match('/^[a-zA-Z0-9]{3,20}$/', $usuario)) {
        die("Erro: Nome de usuário inválido.");
    }

    if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{6,20}$/', $senha)) {
        die("Erro: Senha inválida.");
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Erro: Email inválido.");
    }

    $niveis_validos = ['administrador', 'docente', 'auxiliar', 'aluno'];
    if (!in_array($nivel_acesso, $niveis_validos)) {
        die("Erro: Nível de acesso inválido.");
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
    

    // Verifica se nome ou email já existem
    $stmt = $conn->prepare("SELECT id FROM usuarios WHERE nome = ? OR email = ?");
    $stmt->bind_param("ss", $usuario, $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        die("Erro: Nome de usuário ou email já cadastrados.");
    }
    $stmt->close();

    // Hash da senha
    $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

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
?>
