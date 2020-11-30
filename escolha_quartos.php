<?php
include "init.php";

$title = "Bem Vindo";
include "cabecalho.php";
include "barra_procura.php";
?>

<div class="container d-lg-flex mb-5">



    <div class="col-md-12 col-lg-9" id="room-display">
        <h5>Escolha suas acomodações</h5>
        <div id="quarto-modelo" class="card shadow mb-5">
            <div class="card-body">
                

                <div class="d-lg-flex flex-wrap col-12">
                    <section class="first-line-show-room d-lg-flex flex-grow-1 mb-3">
                        <section class="image-show-room col-lg-5">
                            <img class="img-fluid" src="https://sbreserva.silbeck.com.br/imagens/apartamento_categoria/0097e1a51ad115472685570f677110f6.jpg">
                        </section>

                        <section class="col-lg-7 d-lg-flex flex-column">
                            
                            <div class="card-title">
                                <h5>Standard Casal</h5>
                            </div>

                            <section class="d-flex flex-column flex-wrap align-content-end" style="height: 130px;">
                                <div class="col-6 flex-fill flex-grow-0 ">
                                    Air-split
                                </div>
                                <div class="col-6 flex-fill flex-grow-0 ">
                                    Cama Box
                                </div>
                                <div class="col-6 flex-fill flex-grow-0 ">
                                    Air-split
                                </div>
                                <div class="col-6 flex-fill flex-grow-0 ">
                                    Cama Box
                                </div>
                                <div class="col-6 flex-fill flex-grow-0 ">
                                    Air-split
                                </div>
                                <div class="col-6 flex-fill flex-grow-0 ">
                                    Cama Box
                                </div>
                                <div class="col-6 flex-fill flex-grow-0 ">
                                    Air-split
                                </div>
                                <div class="col-6 flex-fill flex-grow-0 ">
                                    Cama Box
                                </div>
                            </section>
                            
                            <section class="show-room-capacity text-center mt-auto">
                                Capacidade: 2
                            </section>

                        </section>          
                        

                    </section>    

                    <section class="second-line-show-room d-lg-flex flex-grow-1">
                        <section class="show-room-people col-lg-5 d-flex">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Adultos pagante</label>
                                <select class="custom-select" id="inputGroupSelect01">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Crianças cortesia</label>
                                <select class="custom-select" id="inputGroupSelect01">
                                    <option value="0">0</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                </select>
                        </section>

                        <section class="show-room-number_rooms col-lg-7 d-flex">
                            <div class="form-group col-md-6 flex-grow-0 align-self-end">
                                Aproveite o melhor Preço!
                            </div>
                            <div class="form-group col-md-6 ml-auto">
                                <label for="inputEmail4">Nº QUARTOS</label>
                                <select class="custom-select" id="inputGroupSelect01">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                </select>
                        </section>

                    </section>

                    
                    <section class="third-line-show-room d-lg-flex flex-grow-1">
                        <table class="table">
                            <thead>
                                <tr>
                                <th scope="col">TARIFA</th>
                                <th scope="col">DIÁRIA</th>
                                <th scope="col">TOTAL(16 Diárias)</th>
                                <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Normal</td>
                                    <td>R$ 99,00</td>
                                    <td>R$ 1.584,00</td>
                                    <td><button type="submit" class="btn btn-sm btn-success">RESERVAR</button></td>
                                </tr>
                            </tbody>
                        </table>
                    </section>

                </div>

            </div>

            <div class="card-footer text-center">
                Parcele em até&nbsp;<b>2x</b>&nbsp;no cartão. Valor mínimo da parcela R$ 50,00
            </div>
        </div>    
    </div>




    <div id="menu_reserva" class="col-md-12 col-lg-3">
        <button type="button" class="botao-estilo btn btn-success btn-block">VER POLÍTICAS DO HOTEL</button>
        
        <div class="card shadow">
            
            <div class="card-header">
                Minha Reserva
            </div>
            <div class="card-body">
                

                
                <form method="post" action="login.php">
                    <input class="form-control" type="text" name="total_pagar">
                    <button type="submit" class="btn btn-success">CONFIRMAR RESERVA</button>
                </form>


            </div>   
        </div>
    </div>



</div>

<?php
include "rodape.php";
?>

<script>
    function criar_cartao_quarto() 
    {
        quarto_modelo = $("#quarto-modelo");
        novo_quarto = quarto_modelo.clone();
        quarto_modelo.parent().append(novo_quarto);
    }

    $(
        function() {
            criar_cartao_quarto();
            criar_cartao_quarto();
            criar_cartao_quarto();

            // When the user scrolls the page, execute myFunction
            window.onscroll = function() {update_menu()};

            // Get the navbar
            var navbar = document.getElementById("menu_reserva");

            // Get the offset position of the navbar
            var sticky = getOffsetTop(navbar);

            console.log(sticky);

            // Add the sticky class to the navbar when you reach its scroll position. Remove "sticky" when you leave the scroll position
            function update_menu() {
                if (window.pageYOffset >= sticky) {
                    console.log("fixar menu");
                    navbar.classList.add("sticky");
                    $(navbar).css("top", window.pageYOffset - sticky);
                } else {
                    console.log("desfixar menu");
                    navbar.classList.remove("sticky");
                    $(navbar).css("top", "0");
                }
            }
        }
    );
</script>