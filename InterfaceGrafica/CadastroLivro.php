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
        <?php $dir = ".." . DIRECTORY_SEPARATOR . "IMG" . DIRECTORY_SEPARATOR . "livro32x32p.png"; ?>
        <?php $dircss = ".." . DIRECTORY_SEPARATOR . "CSS" . DIRECTORY_SEPARATOR . "estilo.css"; ?>

        <?php $dirshort = ".." . DIRECTORY_SEPARATOR . "IMG" . DIRECTORY_SEPARATOR . "livro32x32i.ico"; ?>
        <link rel="stylesheet" type="text/css" href=<?php echo $dircss ?>/>
        <link rel="shortcut icon" href=<?php echo $dirshort ?> >
        <title>Cadastro De Livro</title>
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
                            <img src=<?php echo $dir ?> width="30" height="30" class="d-inline-block align-top" alt="">
                            BEM VINDO <?php /* $logado */ ?>
                        </span>
                    </nav> 

                </div>
            </nav>

            <div>
                <?php
                require_once ".." . DIRECTORY_SEPARATOR . "json".DIRECTORY_SEPARATOR."metodosJson.php";
                $qtndautor = $_POST['qtdnomeaut'];
                $metodos = new metodosJson();
                $metodos->ObjParaJson1($qtndautor);
                echo $qtndautor;
                /*

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

            <div class="form-row" id="divform">
                <?php $link = ".." . DIRECTORY_SEPARATOR . "arquivosPHP" . DIRECTORY_SEPARATOR . "insercaolivro.php"; ?>

                <form action=<?php echo $link ?> id="form" method="post">

                    <fieldset>
                        <legend>
                            Cadastro De Livro
                        </legend>
                        <br><br>
                        <div style="border-style:double; margin:20px;width: 320px;">
                            <legend>
                                Dados Básicos:
                            </legend>

                            <label for="nome">Nome:</label>
                            <input type="text" name="nome" id="nome" placeholder="Nome" required="true">
                            <br><br>

                            <label for="subtitulo">Subtitulo:</label>
                            <input type="text" name="subtitulo" id="subtitulo" placeholder="Subtitulo">
                            <br><br>

                            <label for="isbn">ISBN:</label>
                            <input type="text" name="isbn" id="isbn" placeholder="ISBN" required="true">
                            <br><br>

                            <label for="qtdlivros">Quantidade De Livros:</label>
                            <input type="text" name="qtdlivros" id="qtdlivros" required="true">
                            <br><br>

                        </div>

                        <div style="border-style:double; margin:20px;width: 320px" id="divloc" position:absolute>
                            <legend>
                                Local De Publicacao:
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


                            <br><br>
                            <label for="cidade">Cidade:</label>
                            <input type="text" name="cidade" id="cidade" placeholder="Nome Cidade" required="true">
                            <br><br>

                            <label for="anopublicacao">Ano De Publicação:</label>
                            <input type="text" name="anopublicacao" id="anopublicacao" required="true" maxlength="4">
                            <br><br>
                        </div>
                        <div style="border-style:double; margin:20px;width: 320px" id="divloc" position:absolute>
                            <legend>
                                Editora/Edicao:
                            </legend>

                            <label for="nomeed">Nome Da Editora:</label>
                            <input type="text" name="nomeed" id="nomeed" placeholder="Nome Editora" required="true">
                            <br><br>
                            <label for="nedicao">Numero Edição:</label>
                            <input type="text" name="nedicao" id="nedicao" placeholder="Numero Edição" required="true">
                            <br><br>

                        </div>

                        <div style="border-style:double; margin:20px;width: 320px" id="divloc" position:absolute>
                            <legend>
                                Tipo De Livro
                            </legend>
                            <label for="tipo">Tipo De Livro:</label>
                            <input type="text" name="tipo" id="tipo" placeholder="Tipo de livro" required="true">
                            <br><br>

                            <label for="codigotipo">Código Do Tipo:</label>
                            <input type="text" name="codigotipo" id="codigotipo" placeholder="Codigo do Tipo. Ex: 110.6" required="true">
                            <br><br>


                        </div>

                        <div style="border-style:double; margin:20px;width: 320px" id="divloc" position:absolute>
                            <legend>
                                Autor
                            </legend>

                            <?php if ($qtndautor == 1) { ?>

                                <label for="nomeaut">Nome Do Autor:</label>
                                <input type="text" name="nomeaut" id="nomeaut" placeholder="Nome Do Autor" required="true">
                                <br><br>
                            <?php } else if ($qtndautor == 2) { ?>
                                <label for="nomeaut">Nome Do Autor:</label>
                                <input type="text" name="nomeaut" id="nomeaut" placeholder="Nome Do Autor" required="true">
                                <br><br>
                                <label for="nomeaut2">Nome Do Autor2:</label>
                                <input type="text" name="nomeaut2" id="nomeaut2" placeholder="Nome Do Autor" >
                                <br><br>
                            <?php } else if ($qtndautor == 3) { ?>
                                <label for="nomeaut">Nome Do Autor:</label>
                                <input type="text" name="nomeaut" id="nomeaut" placeholder="Nome Do Autor" required="true">
                                <br><br>
                                <label for="nomeaut2">Nome Do Autor2:</label>
                                <input type="text" name="nomeaut2" id="nomeaut2" placeholder="Nome Do Autor" >
                                <br><br>
                                <label for="nomeaut3">Nome Do Autor3:</label>
                                <input type="text" name="nomeaut3" id="nomeaut3" placeholder="Nome Do Autor" >
                                <br><br>
                            <?php } else { ?>
                                <label for="nomeaut">Nome Do Autor:</label>
                                <input type="text" name="nomeaut" id="nomeaut" placeholder="Nome Do Autor" required="true">
                                <br><br>
                            <?php } ?>

                        </div>


                        <button name="acao" value="Salvar" id="acao" type="submit" class="btn btn-primary">Salvar</button>
                        <button name="acao" value="Limpar" id="acao" type="reset" class="btn btn-primary">Limpar Campos</button>
                        <br><br>
                    </fieldset> 
                </form>
            </div>

        </div>
        <?php

        function retornarEstados() {
            require_once ".." . DIRECTORY_SEPARATOR . "autoload.php";

            $pdo = Conexao::getInstance();
            $stmt = $pdo->prepare('SELECT sigla FROM estado');
            $stmt->execute();

            return $stmt;
        }
        ?>
    </body>
    <script type="text/javascript">
        /* Máscaras ER */
        function mascara(o, f) {
            v_obj = o
            v_fun = f
            setTimeout("execmascara()", 1)
        }
        function execmascara() {
            v_obj.value = v_fun(v_obj.value)
        }
        function mnum(v) {
            v = v.replace(/\D/g, ""); //Remove tudo o que não é dígito
            return v;
        }

        function id(el) {
            return document.getElementById(el);
        }

        window.onload = function () {
            id('anopublicacao').onkeyup = function () {
                mascara(this, mnum);
            }
        }




    </script>
</html>
