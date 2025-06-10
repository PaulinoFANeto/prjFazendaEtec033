<?php
include(__DIR__ . "/../../auth/auth.php");

$id = $_GET['id'];
$sql = "SELECT * FROM pesagem_matrizes WHERE id=$id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $matriz_id = $_POST['matriz_id'];
    $peso = $_POST['peso'];
    $data = $_POST['data'];

    $sql = "UPDATE pesagem_matrizes SET matriz_id='$matriz_id', peso='$peso', data='$data' WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        header('Location: pesagem_matrizes.php');
    } else {
        echo "Erro: " . $sql . "<br>" . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Editar Pesagem para Matriz</title>
    <link rel="stylesheet" href="../../assets/css/styles.css">
</head>
<body>
    <h1>Editar Pesagem para Matriz</h1>
    <form method="post">
        <label for="matriz_id">ID Matriz:</label>
        <input type="number" id="matriz_id" name="matriz_id" value="<?php echo $row['matriz_id']; ?>" required>
        <label for="peso">Peso:</label>
        <input type="number" step="0.01" id="peso" name="peso" value="<?php echo $row['peso']; ?>" required>
        <label for="data">Data:</label>
        <input type="date" id="data" name="data" value="<?php echo $row['data']; ?>" required>
        <button type="submit">Salvar</button>
    </form>
</body>
</html>