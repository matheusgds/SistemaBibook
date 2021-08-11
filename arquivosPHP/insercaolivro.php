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


//autores
require_once(".." . DIRECTORY_SEPARATOR . "json" . DIRECTORY_SEPARATOR . "metodosJson" . ".php");
$metodos = new metodosJson();

$qt = $metodos->JsonParaObj1();

if ($qt == 1) {
    $autor1 = $_POST['nomeaut'];
} else if ($qt == 2) {
    $autor1 = $_POST['nomeaut'];
    $autor2 = $_POST['nomeaut2'];
} else if ($qt == 3) {
    $autor1 = $_POST['nomeaut'];
    $autor2 = $_POST['nomeaut2'];
    $autor2 = $_POST['nomeaut3'];
} else {
    $autor1 = $_POST['nomeaut'];
}



$teste = FALSE;

$livro = new Livro();
$estado = new Estado();
$cidade = new Cidade();
$localpub = new Localpublicacao();
$ano = new Anopublicacao();
$editora = new Editora();
$edicao = new Edicao();
$tipolivro = new TipoDeLivro();


if ($qtd > 0) {
    if ($estado->Existe($dadoest)) {
        if ($cidade->Existe($dadocid)) {
            if ($ano->Existe($dadoano)) {
                if ($editora->Existe($nomeed)) {
                    if ($edicao->Existe($ned)) {
                        if ($tipolivro->Existe($tipo)) {
                            // eh pq existe todos esses.....
                            $teste = TRUE;

                            $estadocod = $estado->buscaSigla($dadoest);
                            $cidadecod = $cidade->buscaIDpeloNome($dadocid);
                            $anocod = $ano->buscaAno($dadoano);
                            $editoracod = $editora->buscaEditora($nomeed);
                            $edicaocod = $edicao->buscaEdicao($ned);
                            $tipocod = $tipolivro->buscaTipoDeLivro($tipo);

                            //local de publicacao 
                            $vetlocal = array(
                                $estadocod, $cidadecod
                            );

                            $local;
                            if ($localpub->Existe($vetlocal)) {
                                $local = $localpub->buscaLocal($cidadecod, $estadocod);
                            } else {
                                $localpub->Inserir($vetlocal);
                                $local = $localpub->buscaLocal($cidadecod, $estadocod);
                            }

                            $vetDados = array(
                                $nomel, $subtitulol, $isbn, $qtd, $local, $editoracod, $edicaocod, $anocod, $tipocod
                            );

                            $livro->Inserir($vetDados);
                        } else { //tipo do livro
                            $vetDados = array(
                                $tipo, $codigotipo
                            );
                            $tipolivro->Inserir($vetDados);
                        }
                    } else {     //edicao
                        $vetDados = array(
                            $ned
                        );
                        $edicao->Inserir($vetDados);
                    }
                } else {//editora
                    $vetDados = array(
                        $nomeed
                    );

                    $editora->Inserir($vetDados);
                }
            } else {//ano publ
                $vetDados = array(
                    $dadoano
                );
                $ano->Inserir($vetDados);
            }
        } else {//cidade
            $vetDados = array(
                $dadocid
            );
            $cidade->Inserir($vetDados);
        }
    }
}

if ($teste == FALSE) {

    // verificar possibilidades de insercao quando nao houver.. obs: utilizar existe
    $estadocod = $estado->buscaSigla($dadoest);
    if ($cidade->Existe($dadocid)) {
        $cidadecod = $cidade->buscaIDpeloNome($dadocid);
    } else {
        $vetDados = array(
            $dadocid
        );
        $cidade->Inserir($vetDados);
        $cidadecod = $cidade->buscaIDpeloNome($dadocid);
    }

    if ($ano->Existe($dadoano)) {
        $anocod = $ano->buscaAno($dadoano);
    } else {
        $vetDados = array(
            $dadoano
        );
        $ano->Inserir($vetDados);
        $anocod = $ano->buscaAno($dadoano);
    }
    if ($editora->Existe($nomeed)) {
        $editoracod = $editora->buscaEditora($nomeed);
    } else {
        $vetDados = array(
            $nomeed
        );

        $editora->Inserir($vetDados);
        $editoracod = $editora->buscaEditora($nomeed);
    }
    if ($edicao->Existe($ned)) {
        $edicaocod = $edicao->buscaEdicao($ned);
    } else {
        $vetDados = array(
            $ned
        );
        $edicao->Inserir($vetDados);
        $edicaocod = $edicao->buscaEdicao($ned);
    }
    if ($tipolivro->Existe($tipo)) {
        $tipocod = $tipolivro->buscaTipoDeLivro($tipo);
    } else {
        $vetDados = array(
            $tipo, $codigotipo
        );
        $tipolivro->Inserir($vetDados);
        $tipocod = $tipolivro->buscaTipoDeLivro($tipo);
    }

    //local de publicacao 
    $vetlocal = array(
        $estadocod, $cidadecod
    );

    $local;
    if ($localpub->Existe($vetlocal)) {
        $city = new Cidade();
        $city->vincularEstado_Cidade($cidadecod, $estadocod);
        $local = $localpub->buscaLocal($cidadecod, $estadocod);
    } else {
        $localpub->Inserir($vetlocal);
        $local = $localpub->buscaLocal($cidadecod, $estadocod);
    }

    $vetDados = array(
        $nomel, $subtitulol, $isbn, $qtd, $local, $editoracod, $edicaocod, $anocod, $tipocod
    );

    $livro->Inserir($vetDados);
    $codlivro = $livro->buscanome($nomel);

    $autor = new Autor();

    ///insercao de autor com o livro   

    if ($qt == 1) {
        if ($autor->Existe($autor1)) {
            $codautor = $autor->buscanome($autor1);
            $livro_autor = new livro_autor();
            $vetDados = array(
                $codlivro, $codautor
            );

            $livro_autor->Inserir($vetDados);
        } else {
            $vetDados = array(
                $autor1
            );
            $autor->Inserir($vetDados);
            $codautor = $autor->buscanome($autor1);
            $livro_autor = new livro_autor();
            $vetDados = array(
                $codlivro, $codautor
            );

            $livro_autor->Inserir($vetDados);
        }
    } else if ($qt == 2) {
        if ($autor->Existe($autor1)) {
            $codautor = $autor->buscanome($autor1);
            $livro_autor = new livro_autor();
            $vetDados = array(
                $codlivro, $codautor
            );

            $livro_autor->Inserir($vetDados);
        } else {
            $vetDados = array(
                $autor1
            );
            $autor->Inserir($vetDados);
            $codautor = $autor->buscanome($autor1);
            $livro_autor = new livro_autor();
            $vetDados = array(
                $codlivro, $codautor
            );

            $livro_autor->Inserir($vetDados);
        }

        if (($autor2 != "")and ( $autor2 != NULL)) {
            if ($autor->Existe($autor2)) {
                $codautor = $autor->buscanome($autor2);
                $livro_autor = new livro_autor();
                $vetDados = array(
                    $codlivro, $codautor
                );

                $livro_autor->Inserir($vetDados);
            } else {
                $vetDados = array(
                    $autor2
                );
                $autor->Inserir($vetDados);
                $codautor = $autor->buscanome($autor2);
                $livro_autor = new livro_autor();
                $vetDados = array(
                    $codlivro, $codautor
                );

                $livro_autor->Inserir($vetDados);
            }
        }
    } else if ($qt == 3) {
        if ($autor->Existe($autor1)) {
            $codautor = $autor->buscanome($autor1);
            $livro_autor = new livro_autor();
            $vetDados = array(
                $codlivro, $codautor
            );

            $livro_autor->Inserir($vetDados);
        } else {
            $vetDados = array(
                $autor1
            );
            $autor->Inserir($vetDados);
            $codautor = $autor->buscanome($autor1);
            $livro_autor = new livro_autor();
            $vetDados = array(
                $codlivro, $codautor
            );

            $livro_autor->Inserir($vetDados);
        }

        if (($autor2 != "")and ( $autor2 != NULL)) {
            if ($autor->Existe($autor2)) {
                $codautor = $autor->buscanome($autor2);
                $livro_autor = new livro_autor();
                $vetDados = array(
                    $codlivro, $codautor
                );

                $livro_autor->Inserir($vetDados);
            } else {
                $vetDados = array(
                    $autor2
                );
                $autor->Inserir($vetDados);
                $codautor = $autor->buscanome($autor2);
                $livro_autor = new livro_autor();
                $vetDados = array(
                    $codlivro, $codautor
                );

                $livro_autor->Inserir($vetDados);
            }
        }

        if (($autor3 != "")and ( $autor3 != NULL)) {
            if ($autor->Existe($autor3)) {
                $codautor = $autor->buscanome($autor3);
                $livro_autor = new livro_autor();
                $vetDados = array(
                    $codlivro, $codautor
                );

                $livro_autor->Inserir($vetDados);
            } else {
                $vetDados = array(
                    $autor3
                );
                $autor->Inserir($vetDados);
                $codautor = $autor->buscanome($autor3);
                $livro_autor = new livro_autor();
                $vetDados = array(
                    $codlivro, $codautor
                );

                $livro_autor->Inserir($vetDados);
            }
        }
    }
}







    