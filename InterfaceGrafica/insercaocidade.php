<?php

include_once "../confs/inc.php";
require_once "../confs/Conexao.php";

function alert() {
    echo "<script type='text/javascript'>var a=confirm('O Objeto Já Existe!');</script>";
}

function alert2() {
    echo "<script type='text/javascript'>alert('Inserido Com Sucesso!');</script>";
}

function redirect($url) {
    echo "<HTML>\n";
    echo "<HEAD>\n";
    echo "<TITLE></TITLE>\n";
    echo "<script language=\"JavaScript\">window.location='" . $url . "';</script>\n";
    echo "</HEAD>\n";
    echo "<BODY>\n";
    echo "</BODY>\n";
    echo "</HTML>\n";
}

$pdo = Conexao::getInstance();
$stmt = $pdo->prepare('INSERT INTO cidade (nome) VALUES(:nome)');
$stmt2 = $pdo->prepare('commit;');
$stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
$nome = $_POST['nome'];
$siglaestadovinc = $_POST['select']; //para fazer o vinculo

if (strpos($nome, " ") === TRUE) {
    $nome = ucwords($nome);
} else {
    $nome = ucfirst($nome);
}

$verifica = $pdo->prepare('SELECT * FROM cidade WHERE nome = :nome2');
$verifica->bindParam(':nome2', $nome, PDO::PARAM_STR);
$verifica->execute();
$exists = FALSE;
foreach ($verifica as $row) {
    if ($row['nome'] == $nome) {
        $exists = TRUE;
    }
}

if ($exists == FALSE) {
    $stmt->execute();
    $stmt2->execute();
    //mensagem de inserido com sucesso!
    $url = "listarcidades.php";

    // fazero vinculo da ultima cidade no banco com o id pego pelo metodo do estado

    $idestado = pegarIDEstado($siglaestadovinc);

    $idcidade = pegarIDCidade();

    vincularEstado_Cidade($idcidade, $idestado);


    alert2();
    redirect($url);
    //header("location:listarestados.php");
} else {
    //mensagem de confirmação
    alert();
    $doc = "<script type='text/javascript'>document.write(a)</script>";
    if ($doc == TRUE) {
        $url = "CadastroCidade.php";
        redirect($url);
    } else if ($doc == FALSE) {
        $url = "JanelaPrincipal.php";
        redirect($url);
    }
}

function pegarIDEstado($sig) {
    include_once "../confs/inc.php";
    require_once "../confs/Conexao.php";

    $pdo = Conexao::getInstance();
    $sig = substr_replace($sig, '"', 0, 0);
    $sig = $sig . '"';

    $stmt = $pdo->prepare('SELECT idEstado FROM estado WHERE sigla=' . $sig);
    $stmt->execute();
    foreach ($stmt as $row) {
        return $row['idEstado'];
    }
}

function pegarIDCidade() {
    include_once "../confs/inc.php";
    require_once "../confs/Conexao.php";

    $pdo = Conexao::getInstance(); //select max(idCidade) from cidade;
    $stmt = $pdo->prepare('SELECT max(idCidade) FROM cidade');
    $stmt->execute();

    foreach ($stmt as $row) {
        return $row['max(idCidade)'];
    }
}

function vincularEstado_Cidade($idcidade, $idestado) {
    $idcidade = intval($idcidade);
    $idestado = intval($idestado);
    include_once "../confs/inc.php";
    require_once "../confs/Conexao.php";

    $pdo = Conexao::getInstance();
    $stmt = $pdo->prepare('INSERT INTO estado_has_cidade (Estado_idEstado,Cidade_idCidade) VALUES(:ide,:idc)');
    $stmt->bindParam(':ide', $idestado, PDO::PARAM_INT);
    $stmt->bindParam(':idc', $idcidade, PDO::PARAM_INT);
    $stmt->execute();
    
}

?>