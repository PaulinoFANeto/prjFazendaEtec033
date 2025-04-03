<?php
include 'db.php';

$id = $_GET['id'];
$sql = "DELETE FROM crias WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    header('Location: crias.php');
} else {
    echo "Erro ao excluir: " . $conn->error;
}
?>