<?php
include "init.php";

$nome_completo = trim($_POST['nome']);

$nome_completo = preg_replace('/\s+/', ' ', $nome_completo);

$_SESSION['usuario'] = explode(' ', $nome_completo)[0];

if (isset($_SESSION['total_pagar'])) {
    header("Location: cartao_credito.php");
    exit();
}
else {
    header("Location: index.php");
    exit();

}
?>