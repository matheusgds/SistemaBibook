<?php

require_once (".." . DIRECTORY_SEPARATOR . "autoload.php");


//dados cliente
$nomecli = $_POST['nome'];
$cpf = $_POST['cpf'];
$rg = $_POST['rg'];
$datanascimento = $_POST['datanasc']; // ja vem no formato de banco de dados AAAA-MM-DD
$sexo = $_POST['sexo']; // m ou f
$situacao = $_POST['situacao']; // vai retornar ativo ou desativo
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


$estado = new Estado();
$cidade = new Cidade();
$bairro = new Bairro();
$rua = new Rua();
$NumeroCasa = new NumeroCasa();
$contato = new Contato();
$contaacess = new ContaDeAcesso();

$login = $_POST['login'];
$password = new Criptografia();
$idacesso = $_POST['acesso'];

if ($_POST['senha'] == "") {
    $pass = $password->Encriptografar($_POST['senha']); // se a senha for vazia...
    if ($estado->Existe($dadoest)) {
        if ($cidade->Existe($dadocid)) {
            if ($bairro->Existe($dadob)) {
                if ($rua->Existe($dador)) {
                    if ($NumeroCasa->Existe($numero)) {
                        if ($contaacess->Existe($login)) {
                            // é pq existem todos os dados
                            $teste = TRUE;
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
                            $valor = 1;
                            if ($situacao == "Ativo") {
                                $valor = 1;
                            } else {
                                $valor = 0;
                            }

                            $vetDados2 = array(
                                $nomecli, $cpf, $rg, $datanascimento, $sexo, $valor, $estado, $cidade, $bairro, $rua, $NumeroCasa, $contatonovo, $contaacess
                            );

                            $cli->Editar($vetDados2);
                        } else { // se nao existir conta
                            $contaacesso = new ContaDeAcesso();

                            $vetDadosConta = array(
                                $login, $pass, $idacesso
                            );

                            $contaacesso->Inserir($vetDadosConta);
                        }
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

            $valor = 1;
            if ($situacao == "Ativo") {
                $valor = 1;
            } else {
                $valor = 0;
            }

            $vetDados2 = array(
                $nomecli, $cpf, $rg, $datanascimento, $sexo, $valor, $estado, $cidade, $bairro, $rua, $NumeroCasa, $contatonovo, $contaacess
            );

            $city = new Cidade();
            $city->vincularEstado_Cidade($cidade, $estado);
            $bai = new Bairro();
            $bai->vincularCidade_Bairro($cidade, $bairro);
            $ru = new Rua();
            $ru->vincularRua_Bairro($rua, $bairro);

            $cliente->Editar($vetDados2);
        }
    }
} else {
    $pass = $password->Encriptografar($_POST['senha']);

    if ($estado->Existe($dadoest)) {
        if ($cidade->Existe($dadocid)) {
            if ($bairro->Existe($dadob)) {
                if ($rua->Existe($dador)) {
                    if ($NumeroCasa->Existe($numero)) {
                        if ($contaacess->Existe($login)) {
                            // é pq existem todos os dados
                            $teste = TRUE;
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

                            $valor = 1;
                            if ($situacao == "Ativo") {
                                $valor = 1;
                            } else {
                                $valor = 0;
                            }

                            $vetDados2 = array(
                                $nomecli, $cpf, $rg, $datanascimento, $sexo, $valor, $estado, $cidade, $bairro, $rua, $NumeroCasa, $contatonovo, $contaacess
                            );

                            $cli->Editar($vetDados2);
                        } else { // se nao existir conta
                            $contaacesso = new ContaDeAcesso();

                            $vetDadosConta = array(
                                $login, $pass, $idacesso
                            );

                            $contaacesso->Inserir($vetDadosConta);
                        }
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

            $valor = 1;
            if ($situacao == "Ativo") {
                $valor = 1;
            } else {
                $valor = 0;
            }

            $vetDados2 = array(
                $nomecli, $cpf, $rg, $datanascimento, $sexo, $valor, $estado, $cidade, $bairro, $rua, $NumeroCasa, $contatonovo, $contaacess
            );

            $city = new Cidade();
            $city->vincularEstado_Cidade($cidade, $estado);
            $bai = new Bairro();
            $bai->vincularCidade_Bairro($cidade, $bairro);
            $ru = new Rua();
            $ru->vincularRua_Bairro($rua, $bairro);

            $cliente->Editar($vetDados2);
        }
    }
}


        