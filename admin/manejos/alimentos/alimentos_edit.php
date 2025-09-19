<?php
include(__DIR__ . "/../../../auth/auth.php");
$id = $_GET['id'];
$sql = "SELECT * FROM alimentos WHERE id=$id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];

    $sql = "UPDATE alimentos SET nome='$nome', descricao='$descricao' WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        header('Location: alimentos.php');
    } else {
        echo "Erro: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Editar Alimento</title>
</head>
<body>
    <button class="voltar-btn" onclick="window.history.back();">← Voltar</button>

    <h1>Editar Alimento</h1>
    <form method="post">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($row['id']); ?>">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" value="<?php echo $row['nome']; ?>" required>
        <label for="descricao">Descrição:</label>
        <input type="text" id="descricao" name="descricao" value="<?php echo $row['descricao']; ?>" required>
        <button type="submit">Salvar</button>
    </form>
</body>
</html>