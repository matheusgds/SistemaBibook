<?php

include_once "../confs/inc.php";
include_once "../confs/Conexao.php";
require_once "../DTO/Criptografia.php";

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
$stmt = $pdo->prepare('INSERT INTO contadeacesso (login,pass,tipodeacesso) VALUES(:login,:pass,:idacesso)');
$stmt2 = $pdo->prepare('commit;');
$stmt->bindParam(':login', $login, PDO::PARAM_STR);
$stmt->bindParam(':pass', $pass, PDO::PARAM_STR);
$stmt->bindParam(':idacesso', $idacesso, PDO::PARAM_INT);

$login = $_POST['login'];
$password = new Criptografia();
$pass = $password->Encriptografar($_POST['senha']);
$idacesso = $_POST['acesso'];


$verifica = $pdo->prepare('SELECT * FROM contadeacesso WHERE login = :log2');
$verifica->bindParam(':log2', $login, PDO::PARAM_STR);
$verifica->execute();
$exists = FALSE;
foreach ($verifica as $row) {
    if ($row['login'] == $login) {
        $exists = TRUE;
    }
}

if ($exists == FALSE) {
    $stmt->execute();
    $stmt2->execute();
    //mensagem de inserido com sucesso!
    $url = "listarcontasacesso.php";
   
    alert2();
    redirect($url);
    //header("location:listarestados.php");
} else {
    //mensagem de confirmação
    alert();
    $doc = "<script type='text/javascript'>document.write(a)</script>";
    if ($doc == TRUE) {
        $url = "CadastroContaDeAcesso.php";
        redirect($url);
    } else if ($doc == FALSE) {
        $url = "JanelaPrincipal.php";
        redirect($url);
    }
}


?>