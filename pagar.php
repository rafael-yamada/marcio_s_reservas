<?php

include "pagseguro.php";

fazer_pagamento_cartao_credito($_POST['total_pagar'], $_POST['token_cartao'], $_POST['sender_hash']);