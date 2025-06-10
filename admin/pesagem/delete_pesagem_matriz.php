<?php
include '../../../database/conexao.php';

$id = $_GET['id'];
$sql = "DELETE FROM pesagem_matrizes WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    header('Location: ../../public/pesagem_matrizes.php');
} else {
    echo "Erro ao excluir: " . $conn->error;
}
?>