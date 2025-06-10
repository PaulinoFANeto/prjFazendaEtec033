<?php
include(__DIR__ . "/../../../auth/auth.php");

$id = $_GET['id'];
$sql = "SELECT * FROM crias WHERE id=$id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $parto_id = $_POST['parto_id'];
    $nome = $_POST['nome'];
    $peso_nascimento = $_POST['peso_nascimento'];
    $data_nascimento = $_POST['data_nascimento'];

    $sql = "UPDATE crias SET parto_id='$parto_id', nome='$nome', peso_nascimento='$peso_nascimento', data_nascimento='$data_nascimento' WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        header('Location: crias.php');
    } else {
        echo "Erro: " . $sql . "<br>" . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Editar Cria</title>
    <link rel="stylesheet" href="../../assets/css/styles.css">
</head>
<body>
    <h1>Editar Cria</h1>
    <form method="post">
        <label for="parto_id">ID Parto:</label>
        <input type="number" id="parto_id" name="parto_id" value="<?php echo $row['parto_id']; ?>" required>
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" value="<?php echo $row['nome']; ?>" required>
        <label for="peso_nascimento">Peso ao Nascimento:</label>
        <input type="number" step="0.01" id="peso_nascimento" name="peso_nascimento" value="<?php echo $row['peso_nascimento']; ?>" required>
        <label for="data_nascimento">Data de Nascimento:</label>
        <input type="date" id="data_nascimento" name="data_nascimento" value="<?php echo $row['data_nascimento']; ?>" required>
        <button type="submit">Salvar</button>
    </form>
</body>
</html>