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
        <title>Listar Editoras</title>
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


            <?php
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
                ?>>Nome<br><br>
                <input type="text" name="procurar" id="procurar" value=""> 
                <input type="submit" value="Consultar">
            </form>
            <br>
            <?php
            $sql = "";
            if ($tipo == 1) {
                if ($procurar != "") {
                    $sql = "SELECT * FROM Editora WHERE idEditora = $procurar ORDER BY idEditora";
                } else {
                    $sql = "SELECT * FROM Editora ORDER BY idEditora";
                }
            } else if ($tipo == 2) {
                $sql = "SELECT * FROM Editora WHERE nome LIKE '$procurar%' ORDER BY nome";
            }

            require_once ".." . DIRECTORY_SEPARATOR . "autoload.php";

            $Editora = new Editora();

            $vet = $Editora->PesquisarTodos($sql);
            $count = count($vet);
            ?>
            <br><br>
            <h1>Dados:</h1>
            <br><br>
            <table class="table table-striped table-hover" border="1px" bgcolor="#9dff8c">
                <thead>
                    <tr> 
                        <th scope="col" bgcolor="#78ad6f">Código</th>
                        <th scope="col" bgcolor="#78ad6f">Nome</th>
                        <th scope="col" bgcolor="#78ad6f">Alterar</th>
                        <th scope="col" bgcolor="#78ad6f">Excluir</th>

                    </tr>
                </thead>
                <tbody>
                    <?php for ($index = 0; $index < $count; $index++) {
                        ?>
                        <tr>
                            <td class="table-success"><?php echo $vet[$index]->getId(); ?></td>
                            <td class="table-success"><?php echo $vet[$index]->getNome(); ?></td>
                            <?php $number = $vet[$index]->getId(); ?>
                            <?php $linkimgapagar = ".." . DIRECTORY_SEPARATOR . "IMG" . DIRECTORY_SEPARATOR . "Erase.png"; ?>
                            <?php $linkimgeditar = ".." . DIRECTORY_SEPARATOR . "IMG" . DIRECTORY_SEPARATOR . "Edit.png"; ?>
                            <?php $linkscript = ".." . DIRECTORY_SEPARATOR . "arquivosPHP" . DIRECTORY_SEPARATOR . "exclusaoEditora.php?editora=" . $number ?>
                            <td class="table-success"><button  type="button" id="btn1" onclick="EditEditora(<?php echo $number ?>)" ><img src=<?php echo $linkimgeditar?>> </button></td>
                            <td class="table-success"><button  type="button" id="btn1" onclick="ExcludeEditora(<?php echo $linkscript ?>)" > <img src=<?php echo $linkimgapagar ?>></button></td>
                        </tr>

                    <?php } ?>
                </tbody>
            </table> 

        </div>
    </body>
    <script type='text/javascript'>

        function ExcludeEditora(link) {

            var a = confirm('Deseja Mesmo Excluir?');

            if (a === true) {
                window.location.href = link;
            } else {
                window.location.href = "listareditoras.php";
            }

        }

        function EditEditora(valor) {
            var link = "edicaoeditora.php?editora=";
            link = link + valor;
            window.location.href = link;
        }


    </script>
</html>
