<?php
include("conexao.php");
//Função que vai validar o input nome dos formulários
function validarUsuario($usuario)
{
    // Se não passar pelos parêmetros, ele retorna true
    if (!preg_match('/^[a-zA-Z0-9]{3,20}$/', $usuario)) {
        return false;
    } else {
        return true;
    }
}

//Função que vai validar o input senha dos formulários
function validarSenha($senha)
{
    // Se não passar pelos parêmetros, ele retorna true
    if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{6,20}$/', $senha)) {
        return false;
    } else {
        return true;
    }
}

//Validar email
function validarEmail($email)
{
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return false;
    }
    return true;
}

//Gerar token CSRF
function gerarCSRF()
{
    $_SESSION["csrf"] = (isset($_SESSION["csrf"])) ? $_SESSION["csrf"] : hash('sha256', random_bytes(32));

    return ($_SESSION["csrf"]);
}

//Validar token CSRF
function validarCSRF($csrf)
{
    if (!isset($_SESSION["csrf"])) {
        return (false);
    }
    if ($_SESSION["csrf"] !== $csrf) {
        return (false);
    }
    if (!hash_equals($_SESSION["csrf"], $csrf)) {
        return (false);
    }

    return (true);
}
