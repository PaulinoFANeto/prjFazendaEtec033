<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];

    $sql = "INSERT INTO vacinas (nome, descricao) VALUES ('$nome', '$descricao')";
    if ($conn->query($sql) === TRUE) {
        header('Location: vacinas.php');
    } else {
        echo "Erro: " . $sql . "<br>" . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html <meta charset="UTF-8">
    <title>Adicionar Vacina</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Adicionar Vacina</h1>
    <form method="post">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required>
        <label for="descricao">Descrição:</label>
        <textarea id="descricao" name="descricao" required></textarea>
        <button type="submit">Adicionar</button>
    </form>
</body>
</html>