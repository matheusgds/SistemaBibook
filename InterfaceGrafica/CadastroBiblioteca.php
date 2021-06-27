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
        <title>Cadastro De Biblioteca</title>
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
                <?php
                /*

                  session_start();

                  if ((!isset($_SESSION['loginextra']) == true) and ( !isset($_SESSION['senhaextra']) == true)) {
                  unset($_SESSION['loginextra']);
                  unset($_SESSION['senhaextra']);
                  header('location:index.php');
                  } else {
                  $logado = $_SESSION['loginextra'];
                  } */

                $nomeestado = "";
                ?>
            </div>


            <div class="divform"id="divform">

                <form action="insercaobiblioteca.php" id="form" method="post">

                    <fieldset>
                        <legend>
                            Cadastro De Biblioteca
                        </legend>
                        <br><br>
                        <div  style="border-style:double; margin:20px;width: 320px">
                            <legend>
                                Dados Pessoais:
                            </legend>
                            <label for="nome">Nome:</label>
                            <input type="text" name="nome" id="nome" placeholder="Nome" required="true">
                        </div>
                        <br><br>
                        <div style="border-style:double; margin:20px;width: 320px" id="divloc">
                            <legend>
                                Localização:
                            </legend>
                           
                                <label for="estado">Selecione O Estado:</label>
                                <select name="select" id="selectest">
                                    <?php
                                    $lista = retornarEstados();
                                    foreach ($lista as $row) {
                                        ?>
                                        <option value=<?php echo $row['sigla'] ?>><?php echo $row['sigla'] ?></option>
                                    <?php } ?>
                                </select>

                                <button  type="button" id="btn1" onclick="Mudarestado('div1')" >>>></button>
                            
                            
                            <br><br>
                             <?php $nomeestado = $_POST['select'] ?>

                            <div id="div1" style="display:none;">


                                <label for="cidade">Selecione A Cidade:</label>
                               
                                <?php echo "aqui" . $nomeestado . "FINAL"; ?>  
                                <select name="select">
                                    <?php
                                    if (strlen($nomeestado) == 0) {
                                        $nomeestado = "SC";
                                        $nomeestado = "'" . $nomeestado . "'";
                                        echo "teste1" . $nomeestado;
                                        $Estado = retornarEstadoPorNome($nomeestado); // lista
                                        foreach ($Estado as $row) {
                                            
                                        }

                                        $lista = retornarCidadesDoEstado($row['idEstado']); // tem q passar ID DO ESTADO
                                        foreach ($lista as $row) {
                                            ?>
                                            <option value=<?php echo $row['nome'] ?>><?php echo $row['nome'] ?></option>
                                            <?php
                                        }
                                    } else {
                                        echo 'NOMEEE1:' . $nomeestado;
                                        var_dump($nomeestado);
                                        if (strlen($nomeestado) == 0) { // se tem tamanho de string 0
                                            $nomeestado = "SC";
                                        }

                                        $nomeestado = "'" . $nomeestado . "'";

                                        $Estado = retornarEstadoPorNome($nomeestado); // lista
                                        foreach ($Estado as $row) {
                                            
                                        }

                                        $lista = retornarCidadesDoEstado($row['idEstado']); // tem q passar ID DO ESTADO
                                        foreach ($lista as $row) {
                                            ?>
                                            <option value=<?php echo $row['nome'] ?>><?php echo $row['nome'] ?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>

                            <br><br>
                            <label for="bairro">Selecione O Bairro:</label>

                            <select name="select">
                                <?php
                                $lista = retornarBairros();
                                foreach ($lista as $row) {
                                    ?>
                                    <option value=<?php echo $row['nome'] ?>><?php echo $row['nome'] ?></option>
                                <?php } ?>
                            </select>

                            <br><br>
                            <label for="rua">Selecione A Rua:</label>

                            <select name="select">
                                <?php
                                $lista = retornarRuas();
                                foreach ($lista as $row) {
                                    ?>
                                    <option value=<?php echo $row['nome'] ?>><?php echo $row['nome'] ?></option>
                                <?php } ?>
                            </select>
                            <br><br>
                            <label for="numero">Selecione o Numero Do Local:</label>

                            <select name="select">
                                <?php
                                $lista = retornarNumeros();
                                foreach ($lista as $row) {
                                    ?>
                                    <option value=<?php echo $row['numero'] ?>><?php echo $row['numero'] ?></option>
                                <?php } ?>
                            </select>

                        </div>
                        <br><br>
                        <div style="border-style:double; margin:20px;width: 320px">
                            <legend>
                                Contato:
                            </legend>

                        </div>
                        <br><br>
                        <button name="acao" value="Salvar" id="acao" type="submit">Salvar</button>
                        <button name="acao" value="Limpar" id="acao" type="reset">Limpar Campos</button>
                    </fieldset> 
                </form>
            </div>
        </div>
        <?php

        function retornarNumeros() {
            include_once "../confs/inc.php";
            require_once "../confs/Conexao.php";

            $pdo = Conexao::getInstance();
            $stmt = $pdo->prepare('SELECT numero FROM numerocasa');
            $stmt->execute();

            return $stmt;
        }

        function retornarRuas() {
            include_once "../confs/inc.php";
            require_once "../confs/Conexao.php";

            $pdo = Conexao::getInstance();
            $stmt = $pdo->prepare('SELECT nome FROM rua');
            $stmt->execute();

            return $stmt;
        }

        function retornarBairros() {
            include_once "../confs/inc.php";
            require_once "../confs/Conexao.php";

            $pdo = Conexao::getInstance();
            $stmt = $pdo->prepare('SELECT nome FROM bairro');
            $stmt->execute();

            return $stmt;
        }

        function retornarEstados() {
            include_once "../confs/inc.php";
            require_once "../confs/Conexao.php";

            $pdo = Conexao::getInstance();
            $stmt = $pdo->prepare('SELECT sigla FROM estado');
            $stmt->execute();

            return $stmt;
        }

        function retornarEstadoPorNome($nomeestado) {

            include_once "../confs/inc.php";
            require_once "../confs/Conexao.php";

            $pdo = Conexao::getInstance();
            $stmt = $pdo->prepare('select idEstado from estado where sigla = ' . $nomeestado . ';');
            $stmt->execute();
            // pegue pelo nome e retorne codigo

            return $stmt;
        }

        function retornarCidadesDoEstado($Estado) {

            include_once "../confs/inc.php";
            require_once "../confs/Conexao.php";

            $pdo = Conexao::getInstance();
            $stmt = $pdo->prepare('select nome from cidade c inner join estado_has_cidade ehc where ' . $Estado . '=ehc.Estado_idEstado');
            $stmt->execute();


            return $stmt;
        }
        ?>
    </body>

    <script>
        var vezes = 0;
        function Mudarestado(el) {
            vezes = vezes + 1;
            
            if (vezes <= 3) {
                var select = document.getElementById("selectest");
                var opcaoTexto = select.options[select.selectedIndex].text;
                // estava aqui

<?php $nomeestado = "<script>document.write(opcaoTexto)</script>" ?>
                var display = document.getElementById(el).style.display;

                if (display == "none")
                    document.getElementById(el).style.display = 'block';
                else
                    document.getElementById(el).style.display = 'none';
            } else {
                document.getElementById(el).style.display = 'none';
            }

        }

    </script>
    <script src="../js/script.js"></script>
</html>
