<?php

require_once ".." . DIRECTORY_SEPARATOR . "autoload.php";

//dados cliente
$nomecli = $_POST['nome'];
$cpf = $_POST['cpf'];
$rg = $_POST['rg'];
$datanascimento = $_POST['datanasc']; // ja vem no formato de banco de dados AAAA-MM-DD
$sexo = $_POST['sexo']; // m ou f
//dados localização
$dadoest = $_POST['select'];
$dadocid = $_POST['cidade'];
$dadob = $_POST['bairro'];
$dador = $_POST['rua'];
$numero = $_POST['numerocasa'];

//dados contato
$dadoemail = $_POST['email'];
$dadotelefone1 = $_POST['telefone1'];
$dadotelefone2 = $_POST['telefone2'];
$dadocelular = $_POST['celular'];

$vetDadosCont = array(
    $dadoemail, $dadotelefone1, $dadotelefone2, $dadocelular
);

//dados conta de acesso
$estado = new Estado();
$cidade = new Cidade();
$bairro = new Bairro();
$rua = new Rua();
$NumeroCasa = new NumeroCasa();
$contato = new Contato();
$contaacess = new ContaDeAcesso();

$login = $_POST['login'];
$password = new Criptografia();
$pass = $password->Encriptografar($_POST['senha']);
$idacesso = $_POST['acesso'];




$teste = FALSE;



if ($estado->Existe($dadoest)) {
    if ($cidade->Existe($dadocid)) {
        if ($bairro->Existe($dadob)) {
            if ($rua->Existe($dador)) {
                if ($NumeroCasa->Existe($numero)) {
                    if ($contaacess->Existe($login)) {
                        // é pq existem todos os dados
                        $teste = TRUE;
                        echo "ENTRO NO GERAL";
                        $estado = $estado->buscaSigla($dadoest);
                        $cidade = $cidade->buscaIDpeloNome($dadocid);
                        $bairro = $bairro->buscaIDpeloNome($dadob);
                        $rua = $rua->buscaIDpeloNome($dador);
                        $NumeroCasa = $NumeroCasa->buscaIDpeloNome($numero);

                        $contaacess = $contaacess->buscaIDpeloNome($login);

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

                        $cli = new Cliente();

                        $vetDados2 = array(
                            $nomecli, $cpf, $rg, $datanascimento, $sexo, 1, $estado, $cidade, $bairro, $rua, $NumeroCasa, $contatonovo, $contaacess
                        );

                        $cli->Inserir($vetDados2);
                    } else { // se nao existir conta
                        echo "1";
                        $contaacesso = new ContaDeAcesso();

                        $vetDadosConta = array(
                            $login, $pass, $idacesso
                        );

                        $contaacesso->Inserir($vetDadosConta);
                    }
                } else { // se nao existe numero de casa
                     echo "2";
                    $NumeroCasa = new NumeroCasa();

                    $vetDados = array(
                        $numero
                    );

                    $NumeroCasa->Inserir($vetDados);
                }
            } else {// se nao existe rua
                 echo "3";
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
             echo "4";
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
         echo "5";
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
        echo "entro no falso";
        $estado = $estado->buscaSigla($dadoest);
        $cidade = $cidade->buscaIDpeloNome($dadocid);
        $bairro = $bairro->buscaIDpeloNome($dadob);
        $rua = $rua->buscaIDpeloNome($dador);
        echo "RUA:".$rua;
        $NumeroCasa = $NumeroCasa->buscaIDpeloNome($numero);
        $contaacess = $contaacesso->buscaIDpeloNome($login);


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

        $cliente = new Cliente();

        if (strpos($nomecli, " ") === TRUE) {
            $nomecli = ucwords($nomecli);
        } else {
            $nomecli = ucfirst($nomecli);
        }

        $vetDados2 = array(
            $nomecli, $cpf, $rg, $datanascimento, $sexo, 1, $estado, $cidade, $bairro, $rua, $NumeroCasa, $contatonovo, $contaacess
        );

        $city = new Cidade();
        $city->vincularEstado_Cidade($cidade, $estado);
        $bai = new Bairro();
        $bai->vincularCidade_Bairro($cidade, $bairro);
        $ru = new Rua();
        $ru->vincularRua_Bairro($rua, $bairro);

        $cliente->Inserir($vetDados2);
    }
}