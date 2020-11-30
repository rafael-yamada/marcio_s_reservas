<div class="container-barra-procura">
    <div class="barra-procura shadow">
        <h5>Quando prentende hospedar-se?</h5>
        <form action="escolha_quartos.php" method="post">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="entrada">Entrada</label>
                </div>
                <input id="entrada" type="date" class="form-control" placeholder="Entrada" name="entrada">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="saida">Saída</label>
                </div>
                <input id="saida" type="date" class="form-control" placeholder="Saída" name="saida">
                <select class="custom-select" id="adultos">
                    <option selected>Adultos Pagantes...</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                </select>
                <select class="custom-select" id="criancas">
                    <option selected>Crianças Cortesia...</option>
                    <option value="0">0</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                </select>
                <input type="text" class="form-control" placeholder="Código Promocional">
                <div class="input-group-append">
                    <button class="btn btn-success text-center" type="submit">
                        &nbsp;&nbsp;&nbsp;&nbsp;
                        <img class="top-menu-icon" src="assets/icons/search.svg">
                        Buscar&nbsp;&nbsp;&nbsp;&nbsp;
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>