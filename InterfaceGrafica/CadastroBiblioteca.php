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
        <?php $dircss = ".." . DIRECTORY_SEPARATOR . "css" . DIRECTORY_SEPARATOR . "estilo.css"; ?>
        <?php $dirshort = ".." . DIRECTORY_SEPARATOR . "IMG" . DIRECTORY_SEPARATOR . "livro32x32i.ico"; ?>
        <link rel="stylesheet" type="text/css" href=<?php echo $dircss ?>/>
        <link rel="shortcut icon" href=<?php echo $dirshort ?> >
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

            <div class="divform"id="divform">
                <?php $link = ".." . DIRECTORY_SEPARATOR . "arquivosPHP" . DIRECTORY_SEPARATOR . "insercaobiblioteca.php"; ?>

                <form action=<?php echo $link ?> id="form" method="post">

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

                        <div style="border-style:double; margin:20px;width: 320px" id="divloc">
                            <legend>
                                Localiza????o:
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
                            <label for="bairro">Bairro:</label>
                            <input type="text" name="bairro" id="bairro" placeholder="Nome Bairro" required="true">
                            <br><br>
                            <label for="rua">Rua:</label>
                            <input type="text" name="rua" id="rua" placeholder="Nome Rua" required="true">
                            <br><br>
                            <label for="numeroCasa">Numero Da Residencia:</label>
                            <input type="text" name="numerocasa" id="numerocasa" placeholder="Numero Da Casa" required="true">

                            <br><br>
                        </div>
                        <div style="border-style:double; margin:20px;width: 320px" id="divloc">
                            <legend>
                                Contato:
                            </legend>

                            <label for="Email">Email:</label>
                            <input type="text" name="email" id="email" class="form-control" placeholder="Ex.: aaaaaa@aaaa.com">
                            <br><br>
                            <label for="Telefone1">Telefone 1:</label>
                            <input type="text" name="telefone1"id="telefone1" class="form-control"  maxlength="15" placeholder="Ex.: (00) 0000-0000" >
                            <br><br>

                            <label for="Telefone2">Telefone 2:</label>
                            <input type="text" name="telefone2" id="telefone2" class="form-control" placeholder="Ex.: (00) 0000-0000" >
                            <br><br>
                            <label for="Celular">Celular:</label>
                            <input type="text" name="celular" id="celular" class="form-control" placeholder="Ex.: (00) 00000-0000" >
                            <br><br>


                        </div>
                        <button name="acao" value="Salvar" id="acao" type="submit">Salvar</button>
                        <button name="acao" value="Limpar" id="acao" type="reset">Limpar Campos</button>
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
        /* M??scaras ER */
        function mascara(o, f) {
            v_obj = o
            v_fun = f
            setTimeout("execmascara()", 1)
        }
        function execmascara() {
            v_obj.value = v_fun(v_obj.value)
        }
        function mtel(v) {
            v = v.replace(/\D/g, ""); //Remove tudo o que n??o ?? d??gito
            v = v.replace(/^(\d{2})(\d)/g, "($1) $2"); //Coloca par??nteses em volta dos dois primeiros d??gitos
            v = v.replace(/(\d)(\d{4})$/, "$1-$2"); //Coloca h??fen entre o quarto e o quinto d??gitos
            return v;
        }

        function mcel(v) {
            v = v.replace(/\D/g, ""); //Remove tudo o que n??o ?? d??gito
            v = v.replace(/^(\d{2})(\d)/g, "($1) $2"); //Coloca par??nteses em volta dos dois primeiros d??gitos
            v = v.replace(/(\d)(\d{4})$/, "$1-$2"); //Coloca h??fen entre o quarto e o quinto d??gitos
            return v;
        }

        function id(el) {
            return document.getElementById(el);
        }
        window.onload = function () {
            id('telefone1').onkeyup = function () {
                mascara(this, mtel);
            }
        }

        window.onload = function () {
            id('telefone2').onkeyup = function () {
                mascara(this, mtel);
            }
        }

        window.onload = function () {
            id('celular').onkeyup = function () {
                mascara(this, mcel);
            }
        }
    </script>

</html>
