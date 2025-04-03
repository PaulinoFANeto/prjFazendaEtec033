<?php
include 'db.php';

$id = $_GET['id'];
$sql = "DELETE FROM vacinas WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    header('Location: vacinas.php');
} else {
    echo "Erro ao excluir: " . $conn->error;
}
?>