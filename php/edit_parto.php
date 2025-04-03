<?php
include 'db.php';

$id = $_GET['id'];
$sql = "SELECT * FROM partos WHERE id=$id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $matriz_id = $_POST['matriz_id'];
    $data_parto = $_POST['data_parto'];
    $data_desmame = $_POST['data_desmame'];

    $sql = "UPDATE partos SET matriz_id='$matriz_id', data_parto='$data_parto', data_desmame='$data_desmame' WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        header('Location: partos.php');
    } else {
        echo "Erro: " . $sql . "<br>" . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Editar Parto</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Editar Parto</h1>
    <form method="post">
        <label for="matriz_id">ID Matriz:</label>
        <input type="number" id="matriz_id" name="matriz_id" value="<?php echo $row['matriz_id']; ?>" required>
        <label for="data_parto">Data do Parto:</label>
        <input type="date" id="data_parto" name="data_parto" value="<?php echo $row['data_parto']; ?>" required>
        <label for="data_desmame">Data do Desmame:</label>
        <input type="date" id="data_desmame" name="data_desmame" value="<?php echo $row['data_desmame']; ?>" required>
        <button type="submit">Salvar</button>
    </form>
</body>
</html>