<?php
//minha senha
$senha= '123!Amandi';

//criptografando senha
$senha_criptografada= password_hash($senha,PASSWORD_DEFAULT);

//mostrar a senha criptografada na tela
echo $senha_criptografada;
?>