<?php
// Período de teste - Lays
include(__DIR__ . "/../../../auth/auth.php");

$id = $_GET['id'];
$sql = "SELECT * FROM coberturas WHERE id = $id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

// Verifica se o formulário foi enviado (método POST)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recupera os dados enviados pelo formulário
    $matriz_id = $_POST['matriz_id'];
    $data_cobertura = $_POST['data_cobertura'];
    $tipo_cobertura = $_POST['tipo_cobertura'];
    $usuario_id = $_SESSION['usuario_id']; // ID do usuário logado

    // Atualiza o registro da cobertura no banco de dados
    $sql = "UPDATE coberturas SET 
                matriz_id = '$matriz_id', 
                data_cobertura = '$data_cobertura', 
                tipo_cobertura = '$tipo_cobertura', 
                usuario_id = '$usuario_id', 
                data_acao = NOW()
            WHERE id = $id";

    // Se a atualização for bem-sucedida, redireciona para a página principal
    if ($conn->query($sql) === TRUE) {
        header("Location: coberturas.php");
        exit();
    } else {
        echo "Erro ao atualizar: " . $conn->error;
    }
}

?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Editar Cobertura</title>
    <link rel="stylesheet" href="../../../assets/css/styles.css">
</head>

<body>
    <h1>Editar Cobertura</h1>
    <form method="post">
        <label for="matriz_id">ID da Matriz:</label>
        <input type="number" id="matriz_id" name="matriz_id" value="<?php echo $row['matriz_id']; ?>" required>

        <label for="data_cobertura">Data da Cobertura:</label>
        <input type="date" id="data_cobertura" name="data_cobertura" value="<?php echo $row['data_cobertura']; ?>" required>

        <label for="tipo_cobertura">Tipo de Cobertura:</label>
        <input type="text" id="tipo_cobertura" name="tipo_cobertura" value="<?php echo $row['tipo_cobertura']; ?>" maxlength="25" required>

        <button type="submit">Salvar Alterações</button>
    </form>
</body>

</html>
