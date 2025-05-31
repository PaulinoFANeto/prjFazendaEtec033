<?php
include '../../auth/db.php';

$id = $_GET['id'];
$sql = "DELETE FROM vacinas WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    header('Location: ../../public/vacinas.php');
} else {
    echo "Erro ao excluir: " . $conn->error;
}
?>