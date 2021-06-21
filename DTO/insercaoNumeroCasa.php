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
$stmt = $pdo->prepare('INSERT INTO numerocasa (numero) VALUES(:numero)');
$stmt2 = $pdo->prepare('commit;');
$stmt->bindParam(':numero', $Numero, PDO::PARAM_STR);
$Numero = $_POST['numero'];


$verifica = $pdo->prepare('SELECT * FROM numerocasa WHERE numero = :numero2');
$verifica->bindParam(':numero2', $Numero, PDO::PARAM_STR);
$verifica->execute();
$exists = FALSE;
foreach ($verifica as $row) {
    if ($row['numero'] == $nome) {
        $exists = TRUE;
    }
}

if ($exists == FALSE) {
    $stmt->execute();
    $stmt2->execute();
    //mensagem de inserido com sucesso!
    $url = "listarnumeroscasas.php";
   
    alert2();
    redirect($url);
    //header("location:listarestados.php");
} else {
    //mensagem de confirmação
    alert();
    $doc = "<script type='text/javascript'>document.write(a)</script>";
    if ($doc == TRUE) {
        $url = "CadastroNumeroCasa.php";
        redirect($url);
    } else if ($doc == FALSE) {
        $url = "JanelaPrincipal.php";
        redirect($url);
    }
}


?>