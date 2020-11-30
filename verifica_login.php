<?php
include "init.php";

if (DEBUG) {
    if ( $_POST['cpf'] == "33307302850" && $_POST['senha'] == "1234" ) {
        //$_SESSION['usuario'] = $cpf;
        $_SESSION['usuario'] = "Rafael";
        header('Location: cartao_credito.php');
        exit();
    }
    else {
        header('Location: login.php');
        exit();
    }
}

include "conexao.php";

if(empty($_POST['cpf']) || empty($_POST['senha'])) {
    header('Location: index.php');
    exit();
}

$cpf = mysqli_real_escape_string($conexao, $_POST['cpf']);
$senha = mysqli_real_escape_string($conexao, $_POST['senha']);

$query = "select usuario_id, usuario from usuario where usuario = '{$cpf}' and senha = md5('{$senha}')";

$result = mysqli_query($conexao, $query);

$row = mysqli_num_rows($result);

if ($row == 1) {
    $_SESSION['usuario'] = $cpf;
    header('Location: cartao_credito.php');
    exit();
} else {
    header('Location: login.php');
    exit();
}