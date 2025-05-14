<?php
session_start();

// Definir classe CSS com base na escolha do usuário
$classe_acessibilidade = "";
if (isset($_SESSION['acessibilidade'])) {
    if ($_SESSION['acessibilidade'] === 'alto-contraste') {
        $classe_acessibilidade = "alto-contraste";
    } elseif ($_SESSION['acessibilidade'] === 'fonte-grande') {
        $classe_acessibilidade = "fonte-grande";
    }
}
?>
