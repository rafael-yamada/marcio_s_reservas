<?php
include "init.php";

if (isset($_POST['total_pagar'])) {
    $_SESSION['total_pagar'] = $_POST['total_pagar'];
    if (isset($_SESSION['usuario'])) {
        header("Location: cartao_credito.php");
        exit();
    }
}

include "cabecalho.php";

$title = "Login";
?>

<div class="d-flex justify-content-center">
    <div class="login-card card col-sm-12 col-md-6 col-lg-4 shadow">
        <div class="card-body">
            <h5 class="card-title text-center text-muted">Faça seu login aqui</h5>
            <form method="post" action="verifica_login.php">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">CPF</span>
                    </div>
                    <input  type="text" class="form-control" id="titular" name="cpf">
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">senha</span>
                    </div>
                    <input  type="password" class="form-control" id="titular" name="senha">
                </div>
                <button class="btn btn-primary btn-block" id="login">Login</button>
            </form>
            
        </div>
    </div>    
</div>
<p class="text-center text-muted">Acessando pela primeira vez, cadastre-se <a href="cadastro.php">aqui</a></p>





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
        amount: <?= $_POST['total_pagar'] ?>,
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
                    data.append('total_pagar', <?= $_POST['total_pagar'] ?>);
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