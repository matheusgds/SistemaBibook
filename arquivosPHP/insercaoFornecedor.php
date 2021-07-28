<?php

require_once ".." . DIRECTORY_SEPARATOR . "autoload.php";


$nomecli = $_POST['nome'];

$dadoest = $_POST['select'];
$dadocid = $_POST['cidade'];
$dadob = $_POST['bairro'];
$dador = $_POST['rua'];
$numero = $_POST['numerocasa'];


$dadoemail = $_POST['email'];
$dadotelefone1 = $_POST['telefone1'];
$dadotelefone2 = $_POST['telefone2'];
$dadocelular = $_POST['celular'];


$vetDadosCont = array(
    $dadoemail, $dadotelefone1, $dadotelefone2, $dadocelular
);

$estado = new Estado();
$cidade = new Cidade();
$bairro = new Bairro();
$rua = new Rua();
$NumeroCasa = new NumeroCasa();
$contato = new Contato();

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

                        $Fornecedor = new Fornecedor();

                        $vetDados2 = array(
                            $nomecli, $estado, $cidade, $bairro, $rua, $NumeroCasa, $contatonovo
                        );

                        $Fornecedor->Inserir($vetDados2);
                   
                } else { // se nao existe numero de casa
                    $NumeroCasa = new NumeroCasa();

                    $vetDados = array(
                        $numero
                    );

                    $NumeroCasa->Inserir($vetDados);
                }
            } else {// se nao existe rua
                $ruanova = new Rua();


                if (strpos($dador, " ") === TRUE) {
                    $dador = ucwords($dador);
                } else {
                    $dador = ucfirst($dador);
                }


                $vetDados = array(
                    $dador
                );

                $ruanova->Inserir($vetDados);
            }
        } else { // se nao existe bairro
            $bairronovo = new Bairro();

            if (strpos($dadob, " ") === TRUE) {
                $dadob = ucwords($dadob);
            } else {
                $dadob = ucfirst($dadob);
            }

            $vetDados = array(
                $dadob
            );

            $bairronovo->Inserir($vetDados);
        }
    } else {  // se nao existe a cidade.
        $cidadenova = new Cidade();

        if (strpos($dadocid, " ") === TRUE) {
            $dadocid = ucwords($dadocid);
        } else {
            $dadocid = ucfirst($dadocid);
        }

        $vetDados = array(
            $dadocid
        );

        $cidadenova->Inserir($vetDados);
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

        $Fornecedor = new Fornecedor();

        if (strpos($nomecli, " ") === TRUE) {
            $nomecli = ucwords($nomecli);
        } else {
            $nomecli = ucfirst($nomecli);
        }

        $vetDados2 = array(
            $nomecli, $estado, $cidade, $bairro, $rua, $NumeroCasa, $contatonovo
        );

        $city = new Cidade();
        $city->vincularEstado_Cidade($cidade, $estado);
        $bai = new Bairro();
        $bai->vincularCidade_Bairro($cidade, $bairro);
        $ru = new Rua();
        $ru->vincularRua_Bairro($rua, $bairro);

        $Fornecedor->Inserir($vetDados2);
    }    
}