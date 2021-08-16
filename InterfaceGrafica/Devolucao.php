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
        <title>Listar Devoluções</title>
    </head>
    <body>
        <?php
        require_once ".." . DIRECTORY_SEPARATOR . "autoload.php";
        $conta = new ContaDeAcesso;
        $idconta = $conta->buscaIDpeloNome($logado);
        $locacao = new Locacao();
        $cliente = new Cliente();
        $cli = $cliente->retornaClientePeloLogin($idconta);


        $sql = "select * from locacao where Cliente_idCliente = " . $cli;
        $listalocacoesdocliente = $locacao->PesquisarTodos($sql);
        // temos lista de alocacoes..


        $livro_locacao = new locacao_livros();
        $vetresultante = array();


        for ($index = 0; $index < count($listalocacoesdocliente); $index++) {
            $idloc = $listalocacoesdocliente[$index]->getId();

            $sql = "select * from livro_has_locacao where locacao_idlocacao = " . $idloc;
            $lista = $livro_locacao->PesquisarTodos($sql);

            for ($index1 = 0; $index1 < count($lista); $index1++) {
                if ($lista[$index1]->getStatus() == TRUE) {
                    $vetresultante[] = $lista[$index1];
                }
            }
        }

        $count = count($vetresultante);
        $autor_livro = new livro_autor();

        // na ideia agora teriamos a lista de livros daquele cliente que ele esta devendo pra devolucao
        ?>

        <table class="table table-striped table-hover" border="1px" bgcolor="#9dff8c">
            <thead>
                <tr> 
                    <th scope="col" bgcolor="#78ad6f">Código</th>
                    <th scope="col" bgcolor="#78ad6f">Nome</th>
                    <th scope="col" bgcolor="#78ad6f">Subtitulo</th>
                    <th scope="col" bgcolor="#78ad6f">ISBN</th>
                    <th scope="col" bgcolor="#78ad6f">Local de Publicação</th>
                    <th scope="col" bgcolor="#78ad6f">Editora</th>
                    <th scope="col" bgcolor="#78ad6f">Edição</th>
                    <th scope="col" bgcolor="#78ad6f">Ano Publicação</th>
                    <th scope="col" bgcolor="#78ad6f">Tipo De Livro</th>
                    <th scope="col" bgcolor="#78ad6f">Autor</th>
                    <th scope="col" bgcolor="#78ad6f">Devolver</th>

                </tr>
            </thead>
            <tbody>
                <?php
                for ($index = 0; $index < $count; $index++) {
                    ?>
                    <?php
                    $livro = new Livro();
                    $codlivro = $vetresultante[$index]->getIdlivro();
                    $sql = "select * from livro where idLivro = " . $codlivro;
                    $base = $livro->PesquisarTodos($sql);
                    ?>
                    <tr>
                        <td class="table-danger"><?php echo $base[$index]->getId(); ?></td>
                        <td class="table-danger"><?php echo $base[$index]->getNome(); ?></td>
                        <td class="table-danger"><?php echo $base[$index]->getSubtitulo(); ?></td>
                        <td class="table-danger"><?php echo $base[$index]->getIsbn(); ?></td>
                        <td class="table-danger"><?php echo $base[$index]->getIdlocalpublicacao(); ?></td>
                        <td class="table-danger"><?php echo $base[$index]->getIdeditora(); ?></td>
                        <td class="table-danger"><?php echo $base[$index]->getIdedicao(); ?></td>
                        <td class="table-danger"><?php echo $base[$index]->getIdanopublicacao(); ?></td>
                        <td class="table-danger"><?php echo $base[$index]->getIdtipolivro() ?></td>


                        <?php $idlivro = $base[$index]->getId(); ?>

                        <?php $sqlautor = "select * from livro_has_autor where Livro_idLivro = $idlivro" ?>
                        <?php $listaautores = $autor_livro->PesquisarTodos($sqlautor); ?>

                        <?php
                        for ($index1 = 0; $index1 < count($listaautores); $index1++) {
                            ?>
                            <td class="table-danger"><?php echo $listaautores[$index1]->getIdautor() ?></td>
                        <?php } ?>
                        <?php $number = $base[$index]->getId(); ?>
                        <?php $linkimgdev = ".." . DIRECTORY_SEPARATOR . "IMG" . DIRECTORY_SEPARATOR . "dev.gif"; ?>
                        <?php $linkdevolucao = ".." . DIRECTORY_SEPARATOR . "arquivosPHP" . DIRECTORY_SEPARATOR . "devolucaolivro.php?id=" . $number; ?>


                        <td class="table-danger"><a href=<?php echo $linkdevolucao ?>><img src=<?php echo $linkimgdev ?> width="30%"> </a></td>
                    </tr>

                <?php } ?>
            </tbody>
        </table>
    </body>
</html>
