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


if ($estado->Existe($dadoest)) {
    $estado = $estado->buscaSigla($dadoest);
}

if ($cidade->Existe($dadocid)) {
    $cidade = $cidade->buscaIDpeloNome($dadocid);
} else {
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
    $cidade = $cidade->buscaIDpeloNome($dadocid);
}

if ($bairro->Existe($dadob)) {
    $bairro = $bairro->buscaIDpeloNome($dadob);
} else {
    $bairronovo = new Bairro();
    if (strpos($dadob, " ") === TRUE) {
        $dadob = ucwords($dadob);
    } else {
        $dadob = ucfirst($dadob);
    }

    $vetDados = array(
        $dadob
    );

    $bairronovo->inserir2Semvinculo($vetDados);
    $bairro = $bairro->buscaIDpeloNome($dadob);
}

if ($rua->Existe($dador)) {
    $rua = $rua->buscaIDpeloNome($dador);
} else {
    $ruanova = new Rua();
    $vetDados = array(
        $dador
    );

    $ruanova->inserir2Semvinculo($vetDados);
    $rua = $rua->buscaIDpeloNome($dador);
}

if ($NumeroCasa->Existe($numero)) {
    $NumeroCasa = $NumeroCasa->buscaIDpeloNome($numero);
} else {
    $NumeroCasa = new NumeroCasa();

    $vetDados = array(
        $numero
    );

    $NumeroCasa->Inserir($vetDados);
    $NumeroCasa = $NumeroCasa->buscaIDpeloNome($numero);
}

if ($contaacess->Existe($login)) {
    $contaacess = $contaacess->buscaIDpeloNome($login);
} else {
    $contaacesso = new ContaDeAcesso();
    $vetDadosConta = array(
        $login, $pass, $idacesso
    );

    $contaacesso->Inserir($vetDadosConta);
    $contaacess = $contaacess->buscaIDpeloNome($login);
}

//dados do contato
$dadoemail = $_POST['email'];
$dadotelefone1 = $_POST['telefone1'];
$dadotelefone2 = $_POST['telefone2'];
$dadocelular = $_POST['celular'];
$contatonovo = new Contato();

$vetDados = array(
    $dadoemail, $dadotelefone1, $dadotelefone2, $dadocelular
);

$contato = new Contato();
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

