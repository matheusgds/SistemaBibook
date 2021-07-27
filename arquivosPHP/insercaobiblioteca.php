<?php

require_once ".." . DIRECTORY_SEPARATOR . "autoload.php";


$nome = $_POST['nome'];

if (strpos($nome, " ") === TRUE) {
    $nome = ucwords($nome);
} else {
    $nome = ucfirst($nome);
}

//se todos os dados existirem segue esse processo

$estado = new Estado();
$cidade = new Cidade();
$bairro = new Bairro();
$rua = new Rua();
$NumeroCasa = new NumeroCasa();
$contato = new Contato();

$dadoest = $_POST['select'];
$dadocid = $_POST['cidade'];
$dadob = $_POST['bairro'];
$dador = $_POST['rua'];
$numero = $_POST['numerocasa'];

$teste = FALSE;

if ($estado->Existe($dadoest)) {
    if ($cidade->Existe($dadocid)) {
        if ($bairro->Existe($dadob)) {
            if ($rua->Existe($dador)) {
                if ($NumeroCasa->Existe($numero)) {
                    // é pq existem todos os dados
                    $teste = TRUE;

                    $estado = $estado->buscaSigla($dadoest);
                    $cidade = $cidade->buscaIDpeloNome($dadocid);
                    $bairro = $bairro->buscaIDpeloNome($dadob);
                    $rua = $rua->buscaIDpeloNome($dador);
                    $NumeroCasa = $NumeroCasa->buscaIDpeloNome($numero);


                    //dados do contato
                    $dadoemail = $_POST['email'];
                    $dadotelefone1 = $_POST['telefone1'];
                    $dadotelefone2 = $_POST['telefone2'];
                    $dadocelular = $_POST['celular'];

                    $vetDados = array(
                        $dadoemail, $dadotelefone1, $dadotelefone2, $dadocelular
                    );

                    $contato->Inserir($vetDados);
                    $contatonovo = $contato->retornaMaxID();

                    $bib = new Biblioteca();

                    $vetDados2 = array(
                        $nome, $estado, $cidade, $bairro, $rua, $NumeroCasa, $contatonovo
                    );

                    $bib->Inserir($vetDados2);
                } else { // se nao existe numero de casa
                    $NumeroCasa = new NumeroCasa();

                    $vetDados = array(
                        $numero
                    );

                    $NumeroCasa->Inserir($vetDados);

                    $numero = $NumeroCasa->buscaIDpeloNome($numero);
                }
            } else {// se nao existe rua
                $ruanova = new Rua();

                $vetDados = array(
                    $dador
                );

                $ruanova->Inserir($vetDados);

                $rua = $ruanova->buscaIDpeloNome($dador);
            }
        } else { // se nao existe bairro
            $bairronovo = new Bairro();

            $vetDados = array(
                $dadob
            );

            $bairronovo->Inserir($vetDados);

            $bairro = $bairronovo->buscaIDpeloNome($dadob);
        }
    } else {  // se nao existe a cidade.
        $cidadenova = new Cidade();
        $vetDados = array(
            $dadocid
        );

        $cidadenova->Inserir($vetDados);

        $cidade = $cidadenova->buscaIDpeloNome($dadocid);
    }

    if ($teste == FALSE) {
        $estado = $estado->buscaSigla($dadoest);
        $cidade = $cidade->buscaIDpeloNome($dadocid);
        $bairro = $bairro->buscaIDpeloNome($dadob);
        $rua = $rua->buscaIDpeloNome($dador);
        $NumeroCasa = $NumeroCasa->buscaIDpeloNome($numero);


        //dados do contato
        $dadoemail = $_POST['email'];
        $dadotelefone1 = $_POST['telefone1'];
        $dadotelefone2 = $_POST['telefone2'];
        $dadocelular = $_POST['celular'];

        $vetDados = array(
            $dadoemail, $dadotelefone1, $dadotelefone2, $dadocelular
        );

        $contato->Inserir($vetDados);
        $contatonovo = $contato->retornaMaxID();

        $bib = new Biblioteca();

        $vetDados2 = array(
            $nome, $estado, $cidade, $bairro, $rua, $NumeroCasa, $contatonovo
        );


        $city = new Cidade();
        $city->vincularEstado_Cidade($cidade, $estado);
        $bai = new Bairro();
        $bai->vincularCidade_Bairro($cidade, $bairro);
        $ru = new Rua();
        $ru->vincularRua_Bairro($rua, $bairro);

        $bib->Inserir($vetDados2);
    }
}
?>