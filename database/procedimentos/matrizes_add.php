<?php
include("../../database/conexao.php");
include("../../database/conexao.php");

//LEMBRAR DE FAZER A VALIDAÇÃO DEPOIS - AMANDA

if (!empty($usuario) && !empty($senha) && !empty($email) && !empty($nivel_acesso)) {
try {
//INSERÇÃO NO BANCO DE DADOS
$insert = "INSERT INTO procedimentos_matrizes (data_procedimento, tipo_procedimento, descricao) VALUES (?, ?, ?)";
$stm = $conn->prepare($insert);
} catch(Exception $erro){

}
}
?>
