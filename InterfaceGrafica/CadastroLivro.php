<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
session_start();

if ((!isset($_SESSION['loginextra']) == true) and ( !isset($_SESSION['senhaextra']) == true)) {
    unset($_SESSION['loginextra']);
    unset($_SESSION['senhaextra']);

    $linkprincipal = ".." . DIRECTORY_SEPARATOR . "index.php";
    header('location:' . $linkprincipal);
}
$logado = $_SESSION['loginextra'];

require_once ".." . DIRECTORY_SEPARATOR . "autoload.php";


//require_once 'DTO/ContaDeAcesso.php';

$class = new ContaDeAcesso();

$tipoacesso = $class->retornaTipoAcesso($logado);
?>
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
                                <?php $url1 = "CadastroCliente.php"; ?>
                                <?php if (($tipoacesso == 1) || ($tipoacesso == 2)) { ?>
                                    <a class="dropdown-item  bg-light" href=<?php echo $url1 ?>>Cadastrar Cliente</a>
                                    <?php
                                } else {
                                    $url1 = "JanelaPrincipal.php";
                                }
                                ?>

                                <?php $url2 = "qtdautor.php"; ?>
                                <div class="dropdown-divider"></div>
                                <?php if (($tipoacesso == 1) || ($tipoacesso == 2)) { ?>
                                    <a class="dropdown-item" href=<?php echo $url2 ?>>Cadastrar Livro</a>
                                    <?php
                                } else {
                                    $url2 = "JanelaPrincipal.php";
                                }
                                ?>

                            </div>
                        </li> 
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Pesquisar
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <?php $url3 = "listarestados.php"; ?>
                                <?php if (($tipoacesso == 1) || ($tipoacesso == 2) || ($tipoacesso == 3)) { ?>
                                    <a class="dropdown-item" href= <?php echo $url3; ?>>Pesquisar Estados</a>
                                    <?php
                                } else {
                                    $url3 = "JanelaPrincipal.php";
                                }
                                ?>
                                <div class="dropdown-divider"></div>
                                <?php $url4 = "listarcidades.php"; ?>
                                <?php if (($tipoacesso == 1) || ($tipoacesso == 2) || ($tipoacesso == 3)) { ?>
                                    <a class="dropdown-item" href=<?php echo $url4; ?>>Pesquisar Cidades</a>
                                    <?php
                                } else {
                                    $url4 = "JanelaPrincipal.php";
                                }
                                ?>
                                <div class="dropdown-divider"></div>
                                <?php $url5 = "listarbairros.php"; ?>
                                <?php if (($tipoacesso == 1) || ($tipoacesso == 2) || ($tipoacesso == 3)) { ?>
                                    <a class="dropdown-item" href=<?php echo $url5; ?>>Pesquisar Bairros</a>
                                    <?php
                                } else {
                                    $url5 = "JanelaPrincipal.php";
                                }
                                ?>
                                <div class="dropdown-divider"></div>
                                <?php $url6 = "listarlivros.php"; ?>
                                <?php if (($tipoacesso == 1) || ($tipoacesso == 2) || ($tipoacesso == 3)) { ?>
                                    <a class="dropdown-item" href=<?php echo $url6; ?>>Pesquisar Livros</a>
                                    <?php
                                } else {
                                    $url6 = "JanelaPrincipal.php";
                                }
                                ?>
                                <div class="dropdown-divider"></div>
                                <?php $url7 = "listarclientes.php"; ?>
                                <?php if (($tipoacesso == 1) || ($tipoacesso == 2)) { ?>
                                    <a class="dropdown-item" href=<?php echo $url7; ?>>Pesquisar Clientes</a>
                                    <?php
                                } else {
                                    $url7 = "JanelaPrincipal.php";
                                }
                                ?>

                                <div class="dropdown-divider"></div>
                                <?php $url8 = "listarmultas.php"; ?>
                                <?php if (($tipoacesso == 1) || ($tipoacesso == 2)) { ?>
                                    <a class="dropdown-item" href=<?php echo $url8; ?>>Pesquisar Multas</a>
                                    <?php
                                } else {
                                    $url8 = "JanelaPrincipal.php";
                                }
                                ?>

                                <div class="dropdown-divider"></div>
                                <?php $url9 = "listarfornecedores.php"; ?>
                                <?php if (($tipoacesso == 1) || ($tipoacesso == 2)) { ?>
                                    <a class="dropdown-item" href=<?php echo $url9; ?>>Pesquisar Fornecedores</a>
                                    <?php
                                } else {
                                    $url9 = "JanelaPrincipal.php";
                                }
                                ?>
                                <div class="dropdown-divider"></div>
                                <?php $url10 = "listarcontasacesso.php"; ?>
                                <?php if (($tipoacesso == 1) || ($tipoacesso == 2)) { ?>
                                    <a class="dropdown-item" href=<?php echo $url10; ?>>Pesquisar Contas de Acesso</a>
                                    <?php
                                } else {
                                    $url10 = "JanelaPrincipal.php";
                                }
                                ?>
                            </div>
                        </li> 
                         <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Graficos
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                              
                                <?php $url11 = ".." . DIRECTORY_SEPARATOR . "Graficos" . DIRECTORY_SEPARATOR . "ClientesPorEstado.php"; ?>
                                <?php if (($tipoacesso == 1)) { ?>
                                    <a class="dropdown-item" href=<?php echo $url11; ?> target="_blank">Pesquisar Numero Clientes por Estado</a>
                                    <?php
                                } else {
                                    $url11 = "JanelaPrincipal.php";
                                }
                                ?>
                            </div>
                        </li>

                    </ul>
                    <nav class="navbar navbar-light bg-light">
                        <span>
                            <?php $linkimg = ".." . DIRECTORY_SEPARATOR . "IMG" . DIRECTORY_SEPARATOR . "livro32x32p.png"; ?>
                            <img src=<?php echo $linkimg ?> width="30" height="30" class="d-inline-block align-top" alt="">
                            BEM VINDO <?php echo $logado; ?> 
                            <?php $linkdeslog = ".." . DIRECTORY_SEPARATOR . "arquivosPHP" . DIRECTORY_SEPARATOR . "Deslogar.php" ?>
                            <form action=<?php echo $linkdeslog ?> method="post">
                                <input type="submit" value="Deslogar" name="botao">
                            </form>
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
                            <input type="text" name="isbn" id="isbn" placeholder="ISBN" >
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
