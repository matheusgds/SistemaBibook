<?php

include_once "../confs/inc.php";
require_once "../confs/Conexao.php";

$doc = false;
$id = $_GET['estado'];


    $pdo = Conexao::getInstance();
    $stmt = $pdo->prepare('delete from estado where idEstado = :id ');
    $stmt2 = $pdo->prepare('commit;');
    $stmt->bindParam(':id', $ide, PDO::PARAM_INT);
    $ide = $id;
    $stmt->execute();
    $stmt2->execute();

     $url = "listarestados.php";
     redirect($url);



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


