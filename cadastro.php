<?php
include "init.php";

$title = "Cadastro";
include "cabecalho.php";
?>

<div class="d-flex justify-content-center mb-4">
    <div class="card col-md-12 col-lg-6">
        <div class="card-body">
            <h5 class="card-title text-center text-muted">Preencha o formulário abaixo para se cadastrar</h5>
                <form method="post" action="efetuar_cadastro.php">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Nome Completo</span>
                        </div>
                        <input required type="text" class="form-control" name="nome">
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Email</span>
                        </div>
                        <input required type="text" class="form-control" name="email">
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">País</span>
                        </div>
                        <input required type="text" class="form-control" name="pais">
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Telefone</span>
                        </div>
                        <input required type="text" class="form-control" name="telefone">
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">CPF ou CNPJ</span>
                        </div>
                        <input required type="text" class="form-control" name="cpf_cnpj">
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Senha</span>
                        </div>
                        <input required type="password" class="form-control" name="senha">
                    </div>

                    <button class="btn btn-success btn-block" id="pagar">CRIAR CONTA</button>
                </form>
            </div>
        </div>    
    </div>

<?php
include "rodape.php";
?>