<?php

$_PAGSEGURO_SRC = "https://stc.pagseguro.uol.com.br";

function fazer_pagamento_cartao_credito($valor, $token_cartao, $sender_hash) {
    $email = "comunidadededoverde@gmail.com";
    $token = "9ec2d05e-7d85-40f3-8afd-28a67225412b124b93ea4ed19d25968a4b092e98da4c4a8e-a2e5-422b-b251-2e244d69ed54";

    $url = "https://ws.pagseguro.uol.com.br/v2/transactions/?email=" . $email . "&token=" . $token;

    $cents = $valor * 100;
    $cents = $cents % 100;
    $cents = $cents < 10 ? ('0' . strval($cents)) : strval($cents);

    $valor = $valor - $cents / 100.0;

    $params = "" .
        "paymentMode=default" .
        "&paymentMethod=creditCard" .
        "&currency=BRL" .
        "&extraAmount=0.00" .
        "&itemId1=0001" .
        "&itemDescription1=Hospedagem" .
        "&itemAmount1=" . strval($valor) . "." . $cents .
        "&itemQuantity1=1" .
        //"&notificationURL=https://sualoja.com.br/notificacao.html" .
        "&reference=REF1234" .
        "&senderName=Jose Comprador" .
        "&senderCPF=22111944785" .
        "&senderAreaCode=11" .
        "&senderPhone=56273440" .
        "&senderEmail=testando@sandbox.pagseguro.com.br" .
        "&senderHash=" . $sender_hash .
        "&shippingAddressRequired=False" .
        "&creditCardToken=" . $token_cartao .
        "&installmentQuantity=1" .
        "&installmentValue=" . strval($valor) . "." . $cents .
        "&noInterestInstallmentQuantity=5" .
        "&creditCardHolderName=Jose Comprador" .
        "&creditCardHolderCPF=22111944785" .
        "&creditCardHolderBirthDate=27/10/1987" .
        "&creditCardHolderAreaCode=11" .
        "&creditCardHolderPhone=56273440" .
        "&billingAddressStreet=Av. Brig. Faria Lima" .
        "&billingAddressNumber=1384" .
        "&billingAddressComplement=5o andar" .
        "&billingAddressDistrict=Jardim Paulistano" .
        "&billingAddressPostalCode=01452002" .
        "&billingAddressCity=Sao Paulo" .
        "&billingAddressState=SP" .
        "&billingAddressCountry=BRA";

    // create curl resource
    $ch = curl_init();

    // set method to Post
    curl_setopt($ch, CURLOPT_POST, 1);

    // set url
    curl_setopt($ch, CURLOPT_URL, $url);

    // set post parameters
    curl_setopt($ch, CURLOPT_POSTFIELDS, $params);

    //return the transfer as a string
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    // $output contains the output string
    $output = curl_exec($ch);

    // close curl resource to free up system resources
    curl_close($ch);

    echo($output);

    $xml = simplexml_load_string($output);

    echo($xml);
}

function gerar_sessao() {
    $email = "comunidadededoverde@gmail.com";
    $token = "9ec2d05e-7d85-40f3-8afd-28a67225412b124b93ea4ed19d25968a4b092e98da4c4a8e-a2e5-422b-b251-2e244d69ed54";

    $url = "https://ws.pagseguro.uol.com.br/v2/sessions?email=" . $email . "&token=" . $token;

    // create curl resource
    $ch = curl_init();

    // set method to Post
    curl_setopt($ch, CURLOPT_POST, 1);

    // set url
    curl_setopt($ch, CURLOPT_URL, $url);

    //return the transfer as a string
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    // $output contains the output string
    $output = curl_exec($ch);

    // close curl resource to free up system resources
    curl_close($ch);

    $xml = simplexml_load_string($output);

    return $xml->id;
}