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
    <a href="CadastroEstado.php"></a>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/estilo.css"/>
    <link rel="shortcut icon" href="IMG/livro32x32i.ico" >
    <title>Editar Estado</title>
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


        <div class="divform"id="divform">

            <form action="editarcidade.php" id="form" method="post">

                <fieldset>
                    <legend>
                        Editar Estado
                    </legend>
                    <label for="codigo">Codigo:</label>
                    <input  readonly="" type="text" name="codigo" id="codigo" value="<?php echo $_GET['cidade'] ?>">
                    <br><br>
                    <label for="nome">Nome:</label>
                    <input type="text" name="nome" id="nome"  required="true" value="<?php retornaNome($_GET['cidade']) ?>"> 
                    <button name="acao" value="Salvar" id="acao" type="submit">Salvar</button>
                    <button name="acao" value="Limpar" id="acao" type="reset">Limpar Campos</button>
                </fieldset> 
            </form>
        </div>
    </div>
    <?php
    require_once ".." . DIRECTORY_SEPARATOR . "autoload.php";

    $id = $_GET['cidade'];

    function retornaNome($valor) {
        include_once "../confs/inc.php";
        require_once "../confs/Conexao.php";

        $pdo = Conexao::getInstance();
        $sql = "select nome from estado where idEstado= '$valor' ";
        $consulta = $pdo->query($sql);
        while ($linha = $consulta->fetch(PDO::FETCH_BOTH)) {
            echo $linha['nome'];
        }
    }

    function retornaSigla($valor) {
        include_once "../confs/inc.php";
        require_once "../confs/Conexao.php";

        $pdo = Conexao::getInstance();
        $sql = "select sigla from estado where idEstado= '$valor' ";
        $consulta = $pdo->query($sql);
        while ($linha = $consulta->fetch(PDO::FETCH_BOTH)) {
            echo $linha['sigla'];
        }
    }
    ?>
</body>
</html>
