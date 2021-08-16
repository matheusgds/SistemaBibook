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
        <title>Listar Livros</title>
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

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Devolução De Livros
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">

                                <?php $url12 = ".." . DIRECTORY_SEPARATOR . "InterfaceGrafica" . DIRECTORY_SEPARATOR . "Devolucao.php"; ?>

                                <a class="dropdown-item" href=<?php echo $url12; ?> target="_blank">Devolver</a>
                                <?php
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
            include_once "../confs/inc.php";
            require_once "../confs/Conexao.php";
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
                ?>>ISBN<br>
                <input type="radio" name="tipo" id="tipo" value="4" <?php
                if ($tipo == 4) {
                    echo "checked";
                }
                ?>>Tipo De Livro (CDD)<br><br>
                <input type="text" name="procurar" id="procurar" value=""> 
                <input type="submit" value="Consultar">
            </form>
            <br>
            <?php
            $sql = "SELECT * FROM livro ORDER BY idLivro";
            if ($tipo == 1) {
                if ($procurar != "") {
                    $sql = "SELECT * FROM livro WHERE idLivro = $procurar ORDER BY idLivro";
                } else {
                    $sql = "SELECT * FROM livro ORDER BY idLivro";
                }
            } else if ($tipo == 2) {
                $sql = "SELECT * FROM livro WHERE nome LIKE '$procurar%' ORDER BY nome";
            } else if ($tipo == 3) {
                $sql = "SELECT * FROM livro WHERE isbn = '$procurar' ORDER BY nome";
            } else if ($tipo == 4) {
                require_once ".." . DIRECTORY_SEPARATOR . "autoload.php";
                $tipodeli = new TipoDeLivro();
                if (empty($procurar)) {
                    $sql = "SELECT * FROM livro";
                } else {
                    $codigoid = $tipodeli->buscaIDTipo($procurar);
                    $sql = "SELECT * FROM livro l WHERE l.TipoDeLivro_idTipoDeLivro = $codigoid ORDER BY nome";
                }
            }
            require_once ".." . DIRECTORY_SEPARATOR . "autoload.php";

            $livro = new Livro();
            $autor = new Autor();
            $autor_livro = new livro_autor();

            $vet = $livro->PesquisarTodos($sql);
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
                        <th scope="col" bgcolor="#78ad6f">Subtitulo</th>
                        <th scope="col" bgcolor="#78ad6f">ISBN</th>
                        <th scope="col" bgcolor="#78ad6f">Quantidade</th>
                        <th scope="col" bgcolor="#78ad6f">Local de Publicação</th>
                        <th scope="col" bgcolor="#78ad6f">Editora</th>
                        <th scope="col" bgcolor="#78ad6f">Edição</th>
                        <th scope="col" bgcolor="#78ad6f">Ano Publicação</th>
                        <th scope="col" bgcolor="#78ad6f">Tipo De Livro</th>
                        <th scope="col" bgcolor="#78ad6f">Autores</th>
                        <th scope="col" bgcolor="#78ad6f">Alocar</th>
                   
                    </tr>
                </thead>
                <tbody>
                    <?php for ($index = 0; $index < $count; $index++) {
                        ?>
                        <tr>
                            <?php if ($vet[$index]->getQuantidade() == 0) { ?>
                                <td class="table-danger"><?php echo $vet[$index]->getId(); ?></td>
                                <td class="table-danger"><?php echo $vet[$index]->getNome(); ?></td>
                                <td class="table-danger"><?php echo $vet[$index]->getSubtitulo(); ?></td>
                                <td class="table-danger"><?php echo $vet[$index]->getIsbn(); ?></td>
                                <td class="table-danger"><?php echo $vet[$index]->getQuantidade(); ?></td>
                                <td class="table-danger"><?php echo $vet[$index]->getIdlocalpublicacao(); ?></td>
                                <td class="table-danger"><?php echo $vet[$index]->getIdeditora(); ?></td>
                                <td class="table-danger"><?php echo $vet[$index]->getIdedicao(); ?></td>
                                <td class="table-danger"><?php echo $vet[$index]->getIdanopublicacao(); ?></td>
                                <td class="table-danger"><?php echo $vet[$index]->getIdtipolivro() ?></td>

                                <td class="table-danger">
                                    <?php $idlivro = $vet[$index]->getId(); ?>

                                    <?php $sqlautor = "select * from livro_has_autor where Livro_idLivro = $idlivro" ?>

                                    <?php $listaautores = $autor_livro->PesquisarTodos($sqlautor); ?>

                                    <?php
                                    for ($index1 = 0; $index1 < count($listaautores); $index1++) {
                                        if (count($listaautores) == 1) {
                                            echo $listaautores[$index1]->getIdautor();
                                        } else
                                        if (count($listaautores) > 1) {
                                            if ($index1 == (count($listaautores) - 1)) {
                                                echo $listaautores[$index1]->getIdautor();
                                            } else {
                                                echo $listaautores[$index1]->getIdautor() . ",";
                                            }
                                        }
                                    }
                                    ?>
                                </td>
                                <?php $number = $vet[$index]->getId(); ?>
                                <?php $linkimgeditar = ".." . DIRECTORY_SEPARATOR . "IMG" . DIRECTORY_SEPARATOR . "imgok.gif"; ?>
                                <?php $linklocacao = ".." . DIRECTORY_SEPARATOR . "arquivosPHP" . DIRECTORY_SEPARATOR . "locacaolivro.php?id=" . $number; ?>
                               

                                <td class="table-danger"><a href=<?php echo $linklocacao ?>><img src=<?php echo $linkimgeditar ?> width="30%"> </a></td>
                             
                            <?php } else { ?>
                                <td class="table-success"><?php echo $vet[$index]->getId(); ?></td>
                                <td class="table-success"><?php echo $vet[$index]->getNome(); ?></td>
                                <td class="table-success"><?php echo $vet[$index]->getSubtitulo(); ?></td>
                                <td class="table-success"><?php echo $vet[$index]->getIsbn(); ?></td>
                                <td class="table-success"><?php echo $vet[$index]->getQuantidade(); ?></td>
                                <td class="table-success"><?php echo $vet[$index]->getIdlocalpublicacao(); ?></td>
                                <td class="table-success"><?php echo $vet[$index]->getIdeditora(); ?></td>
                                <td class="table-success"><?php echo $vet[$index]->getIdedicao(); ?></td>
                                <td class="table-success"><?php echo $vet[$index]->getIdanopublicacao(); ?></td>
                                <td class="table-success"><?php echo $vet[$index]->getIdtipolivro() ?></td>

                                <td class="table-success">
                                    <?php $idlivro = $vet[$index]->getId(); ?>

                                    <?php $sqlautor = "select * from livro_has_autor where Livro_idLivro = $idlivro" ?>

                                    <?php $listaautores = $autor_livro->PesquisarTodos($sqlautor); ?>

                                    <?php
                                    for ($index1 = 0; $index1 < count($listaautores); $index1++) {
                                        if (count($listaautores) == 1) {
                                            echo $listaautores[$index1]->getIdautor();
                                        } else
                                        if (count($listaautores) > 1) {
                                            if ($index1 == (count($listaautores) - 1)) {
                                                echo $listaautores[$index1]->getIdautor();
                                            } else {
                                                echo $listaautores[$index1]->getIdautor() . ",";
                                            }
                                        }
                                    }
                                    ?>
                                </td>


                                <?php $number = $vet[$index]->getId(); ?>
                                <?php $linkimgeditar = ".." . DIRECTORY_SEPARATOR . "IMG" . DIRECTORY_SEPARATOR . "imgok.gif"; ?>
                                <?php $linklocacao = ".." . DIRECTORY_SEPARATOR . "arquivosPHP" . DIRECTORY_SEPARATOR . "locacaolivro.php?id=" . $number; ?>


                                <td class="table-success"><a href=<?php echo $linklocacao ?>><img src=<?php echo $linkimgeditar ?> width="30%"> </a></td>
                                    <?php } ?>
                        </tr>

                    <?php } ?>
                </tbody>
            </table> 

        </div>
    </body>

    <script type='text/javascript'>


    </script>
</html>
