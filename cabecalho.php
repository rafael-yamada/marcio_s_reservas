<html>
    <head>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <script type="text/javascript" src="https://stc.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js"></script>

        <script src="js/utils.js"></script>
        <link rel="stylesheet" href="css/style.css">
    </head>

    <body class="bg-light d-flex flex-column">
        <nav class="top-menu navbar navbar-expand-lg navbar-dark">
            <div class="navbar-brand top-menu-title">
                <h3>Hotel X</h3>
            </div>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">

                    <li class="nav-item top-menu-item border-lg-left">
                        <a class="nav-link text-center" href="index.php" >
                            <img class="top-menu-icon" src="assets/icons/home.svg">
                            <br>Início
                        </a>
                    </li>

                    <li class="nav-item top-menu-item border-lg-left">
                        <a class="nav-link text-center" href="index.php" >
                            <img class="top-menu-icon" src="assets/icons/file.svg">
                            <br>Sobre
                        </a>
                    </li>
                
                    <li class="nav-item top-menu-item border-lg-left">
                    <a class="nav-link text-center" href="index.php" >
                            <img class="top-menu-icon" src="assets/icons/map.svg">
                            <br>Localização
                        </a>
                    </li>

                    <li class="nav-item top-menu-item text-center border-lg-left border-right-lg">
                        <?php if (isset($_SESSION['usuario']) && $_SESSION && $_SESSION['usuario']): ?>
                            <div class="top-menu-logged text-center">
                                <img class="top-menu-icon-user-logged" src="assets/icons/user.svg">
                                <br>
                                <?= $_SESSION['usuario'] ?>,<br>
                                <a href="logout.php">sair</a>
                            </div>
                        <?php else: ?>
                            <a class="nav-link text-center" href="login.php" >
                                <img class="top-menu-icon" src="assets/icons/user.svg">
                                <br>Entrar
                            </a>
                        <?php endif; ?>
                    </li>
                </ul>
            </div>
        </nav>
        <img class="img-fluid" src="https://sbreserva.silbeck.com.br/imagens/banner_topo/10a523c4c503bcef8920943b729d40e5.jpg?5b0e65c4f092317760ce0f22a59aec63">