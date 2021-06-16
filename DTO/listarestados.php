<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="css/estilo.css"/>
        <link rel="shortcut icon" href="IMG/livro32x32i.ico" >
        <title>Listar Estados</title>
    </head>
    <body>
        <div class="container-fluid">
            <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
                <a class="navbar-brand" href="index.php">Sistema Bibook</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="JanelaPrincipal.php">Home <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Cadastrar
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item  bg-light" href="DTO/CadastroEstado.php">Cadastrar um Estado</a>
                                <a class="dropdown-item" href="#">Another action</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">Something else here</a>
                            </div>
                        </li> 
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Pesquisar
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="DTO/listarestados.php">Pesquisar Estados</a>
                                <a class="dropdown-item" href="#">Another action</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">Something else here</a>
                            </div>
                        </li>       

                    </ul>
                    <nav class="navbar navbar-light bg-light">
                        <span>
                            <img src="../IMG/livro32x32p.png" width="30" height="30" class="d-inline-block align-top" alt="">
                            BEM VINDO <?php /* $logado */ ?>
                        </span>
                    </nav> 

                </div>
            </nav>


            <div>
                <?php /*

                  session_start();

                  if ((!isset($_SESSION['loginextra']) == true) and ( !isset($_SESSION['senhaextra']) == true)) {
                  unset($_SESSION['loginextra']);
                  unset($_SESSION['senhaextra']);
                  header('location:index.php');
                  } else {
                  $logado = $_SESSION['loginextra'];
                  } */
                ?>
            </div>



            <?php
            include_once "confs/inc.php";
            require_once "confs/Conexao.php";
            $tipo = isset($_POST['tipo']) ? $_POST['tipo'] : "2";
            $procurar = isset($_POST['procurar']) ? $_POST['procurar'] : "";

            /* <?php echo $procurar; ?> */
            ?>


            <form method="post">
                <input type="radio" name="tipo" id="tipo" value="1" <?php
                if ($tipo == 1) {
                    echo "checked";
                }
                ?>>Código<br>  
                <input type="radio" name="tipo" id="tipo" value="2" <?php
                if ($tipo == 2) {
                    echo "checked";
                }
                ?>>Nome<br>
                <input type="radio" name="tipo" id="tipo" value="3" <?php
                if ($tipo == 3) {
                    echo "checked";
                }
                ?>>Sigla<br>
                <input type="text" name="procurar" id="procurar" value=""> 
                <input type="submit" value="Consultar">
            </form>
            <br>
            <?php
            $sql = "";
            if ($tipo == 1) {
                $sql = "SELECT * FROM estado WHERE idEstado = $procurar ORDER BY idEstado";
            } else if ($tipo == 2) {
                $sql = "SELECT * FROM estado WHERE nome LIKE '$procurar%' ORDER BY nome";
            } else {
                $sql = "SELECT * FROM estado WHERE sigla LIKE '$procurar%' ORDER BY sigla";
            }
            $pdo = Conexao::getInstance();
            $consulta = $pdo->query($sql);
            //Código: {$linha['codigo']} -
            while ($linha = $consulta->fetch(PDO::FETCH_BOTH)) {
                echo "Código: {$linha['idEstado']} - Nome: {$linha['nome']} - Sigla: {$linha['sigla']} <br />";
            }
            ?>
        </div>
    </body>
</html>
