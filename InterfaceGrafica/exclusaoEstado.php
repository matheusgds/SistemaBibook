<?php

include_once "../confs/inc.php";
require_once "../confs/Conexao.php";
include("./listarestados.php");


$id = $_GET['id'];

echo $id;
/*$pdo = Conexao::getInstance();
$stmt = $pdo->prepare('delete * from estado where nome = ');
$stmt2 = $pdo->prepare('commit;');
$verifica->bindParam(':nome', $nome, PDO::PARAM_STR);
$nome = $_POST['nome'];
$verifica->execute();

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
 
 */