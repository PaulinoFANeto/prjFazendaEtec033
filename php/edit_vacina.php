<?php
include 'db.php';

$id = $_GET['id'];
$sql = "SELECT * FROM vacinas WHERE id=$id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];

    $sql = "UPDATE vacinas SET nome='$nome', descricao='$descricao' WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        header('Location: vacinas.php');
    } else {
        echo "Erro: " . $sql . "<br>" . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Editar Vacina</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Editar Vacina</h1>
    <form method="post">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" value="<?php echo $row['nome']; ?>" required>
        <label for="descricao">Descrição:</label>
        <textarea id="descricao" name="descricao" required><?php echo $row['descricao']; ?></textarea>
        <button type="submit">Salvar</button>
    </form>
</body>
</html>