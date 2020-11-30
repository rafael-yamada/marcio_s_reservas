<?php
include "init.php";
include "verifica_sessao.php";

if (!isset($_SESSION['total_pagar'])) {
    header("Location: index.php");
    exit();
}

include "cabecalho.php";

include "pagseguro.php";

$session_id = gerar_sessao();

$title = "Complete o pagamento";
?>

<div id="bandeiras" style="display: none;">
</div>

<div class="input-group mb-3">
    <div class="input-group-prepend">
        <span class="input-group-text">Total a pagar</span>
    </div>
    <div class="input-group-append">
        <span id="total_pagar" class="input-group-text"><?= $_SESSION['total_pagar'] ?></span>
    </div>
</div>
<div class="input-group mb-3">
    <div class="input-group-prepend">
        <span class="input-group-text">Nome do Titular</span>
    </div>
    <input  id="nome_comprador" type="text" class="form-control" id="titular" name="titular">
</div>
<div class="input-group mb-3">
    <div class="input-group-prepend">
        <span class="input-group-text" id="basic-addon3">Número do Cartão</span>
    </div>
    <input type="number" class="form-control" id="numero_cartao_credito" name="numero_cartao_credito">
    <div class="input-group-prepend">
        <span class="input-group-text" id="bandeira"></span>
        <span class="input-group-text" id="basic-addon3">CVV</span>
    </div>
    <input type="number" class="form-control" id="cvv" name="cvv">
</div>
<div class="input-group mb-3">
    <div class="input-group-prepend">
        <span class="input-group-text" id="basic-addon3">Vencimento</span>
    </div>
    <input type="number" class="form-control" id="mes_vencimento" name="mes_vencimento">
    <div class="input-group-prepend">
        <span class="input-group-text" id="basic-addon3">/</span>
    </div>
    <input type="number" class="form-control" id="ano_vencimento" name="ano_vencimento">
</div>
<input type="hidden" id="brand" name="brand">

<div class="input-group mb-3">
    <div class="input-group-prepend">
        <span class="input-group-text" id="basic-addon3">CEP</span>
    </div>
    <input type="text" class="form-control" id="cep" name="cep">
</div>

<div class="input-group mb-3">
    <div class="input-group-prepend">
        <span class="input-group-text" id="basic-addon3">Endereço</span>
    </div>
    <input type="text" class="form-control" id="endereco" name="endereco">
</div>

<div class="input-group mb-3">
    <div class="input-group-prepend">
        <span class="input-group-text" id="basic-addon3">Número</span>
    </div>
    <input type="text" class="form-control" id="numero" name="numero">
    <div class="input-group-prepend">
        <span class="input-group-text" id="basic-addon3">Complemento</span>
    </div>
    <input type="text" class="form-control" id="complemento" name="complemento">
</div>

<div class="input-group mb-3">
    <div class="input-group-prepend">
        <span class="input-group-text" id="basic-addon3">Bairro</span>
    </div>
    <input type="text" class="form-control" id="bairro" name="bairro">
</div>

<div class="input-group mb-3">
    <div class="input-group-prepend">
        <span class="input-group-text" id="basic-addon3">Cidade</span>
    </div>
    <input type="text" class="form-control" id="cidade" name="cidade">
</div>

<div class="input-group mb-3">
    <div class="input-group-prepend">
        <span class="input-group-text" id="basic-addon3">Estado</span>
    </div>
    <input type="text" class="form-control" id="uf" name="uf">
</div>

<button class="btn btn-primary" id="pagar">Pagar</button>

<?php
include "rodape.php";
?>

<script>
    PagSeguroDirectPayment.setSessionId('<?= $session_id ?>');

    var sender_hash;

    $("#nome_comprador").focus(
        function() {
            if (sender_hash) {
                return;
            }

            PagSeguroDirectPayment.onSenderHashReady(function(response){
                if(response.status == 'error') {
                    console.log(response.message);
                    return false;
                }
                sender_hash = response.senderHash; //Hash estará disponível nesta variável.

                console.log(sender_hash);
            });
        }
    )

    PagSeguroDirectPayment.getPaymentMethods({
        amount: <?= $_SESSION['total_pagar'] ?>,
        success: function(response) {
            // Retorna os meios de pagamento disponíveis.
            var opcoes = response['paymentMethods']['CREDIT_CARD']['options'];            

            for (var i in opcoes) {
                var cartao = 
                {
                    'code': opcoes[i]['code'],
                    'image_small': "<?= $_PAGSEGURO_SRC ?>" + opcoes[i]['images']['SMALL']['path'],
                    'image_medium': "<?= $_PAGSEGURO_SRC ?>" + opcoes[i]['images']['MEDIUM']['path'],
                    'name': opcoes[i]['name'],
                    'status': opcoes[i]['status']
                };
                console.log(cartao);
                
                var el = $("<span id ='" + cartao.name.toLowerCase() + "'><img src='" + cartao.image_small + "'></span>")
                $("#bandeiras").append(el);
            }
        },
        error: function(response) {
            // Callback para chamadas que falharam.
        },
        complete: function(response) {
            // Callback para todas chamadas.
        }
    });



    $("#numero_cartao_credito").keypress(
        function() {
            if (this.value.length >= 6) {
                PagSeguroDirectPayment.getBrand({
                    cardBin: this.value,
                    success: function(response) {
                        //bandeira encontrada
                        console.log(response);
                        var brand_name = response.brand.name;
                        $("#brand").val(brand_name);

                        child_el = $("#bandeira").children();

                        if (child_el.length > 0) {
                            $("#bandeiras").append(child_el);
                        }
                        $("#bandeira").append($("#" + brand_name));
                    },
                    error: function(response) {
                        //tratamento do erro
                        console.log(response);
                        //alert("Bandeira indisponível");
                    },
                    complete: function(response) {
                        //tratamento comum para todas chamadas
                    }
                })
            }
            else {
                child_el = $("#bandeira").children();

                if (child_el.length > 0) {
                    $("#bandeiras").append(child_el);
                }
            }
        }
    );


    $("#pagar").click(
        function() {
            PagSeguroDirectPayment.createCardToken({
                cardNumber: $("#numero_cartao_credito").val(), // Número do cartão de crédito
                brand: $("#brand").val(), // Bandeira do cartão
                cvv: $("#cvv").val(), // CVV do cartão
                expirationMonth: $("#mes_vencimento").val(), // Mês da expiração do cartão
                expirationYear: $("#ano_vencimento").val(), // Ano da expiração do cartão, é necessário os 4 dígitos.
                success: function(response) {
                    // Retorna o cartão tokenizado.
                    console.log(response.card.token);

                    var xhr = new XMLHttpRequest();
                    xhr.open("POST", "pagar.php", true);

                    xhr.onreadystatechange = function() { // Chama a função quando o estado mudar.
                        if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
                            console.log(this.responseText);
                        }
                    }

                    //xhr.setRequestHeader('Content-Type', 'application/json');

                    var data = new FormData();
                    data.append('total_pagar', <?= $_SESSION['total_pagar'] ?>);
                    data.append('token_cartao', response.card.token);
                    data.append('sender_hash', sender_hash);                    

                    xhr.send(data);
                },
                error: function(response) {
                    // Callback para chamadas que falharam.
                    console.log(response);
                },
                complete: function(response) {
                    // Callback para todas chamadas.
                }
            });
        }
    );

    $("#cep").change(
        function() {
            pesquisacep(this.value);
        }
    );
</script>