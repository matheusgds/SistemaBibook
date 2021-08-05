<?php

require_once ".." . DIRECTORY_SEPARATOR . "autoload.php";

//dados basicos 

$nomel = $_POST['nome'];
$subtitulol = $_POST['subtitulo'];
$isbn = $_POST['isbn'];
$qtd = $_POST['qtdlivros'];

//dados publicacao
$dadoest = $_POST['select'];
$dadocid = $_POST['cidade'];
$dadoano = $_POST['anopublicacao'];

//editora/edicao
$nomeed = $_POST['nomeed'];
$ned = $_POST['nedicao'];

//tipo de livro

$tipo = $_POST['tipo'];
$codigotipo = $_POST['codigotipo'];


$teste = FALSE;

$livro = new Livro();
$estado = new Estado();
$cidade = new Cidade();
$ano = new Anopublicacao();
$editora = new Editora();
$edicao = new Edicao();
$tipolivro = new TipoDeLivro();


if ($qtd > 0) {
    if ($livro->Existe($isbn)) {
        if ($estado->Existe($dadoest)) {
            if ($cidade->Existe($dadocid)) {
                if($ano->Existe($dadoano)){
                    if($editora->Existe($nomeed)){
                        if($edicao->Existe($vetDados)){
                            
                        }
                    }
                }
            }
        }
    }
}

