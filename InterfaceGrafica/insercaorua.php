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
$stmt = $pdo->prepare('INSERT INTO rua (nome) VALUES(:nome)');
$stmt2 = $pdo->prepare('commit;');
$stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
$nome = $_POST['nome'];


if (strpos($nome, " ") === TRUE) {
    $nome = ucwords($nome);
} else {
    $nome = ucfirst($nome);
}

$verifica = $pdo->prepare('SELECT * FROM rua WHERE nome = :nome2');
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
    $url = "listarruas.php";
   
    alert2();
    redirect($url);
    //header("location:listarestados.php");
} else {
    //mensagem de confirmação
    alert();
    $doc = "<script type='text/javascript'>document.write(a)</script>";
    if ($doc == TRUE) {
        $url = "CadastroRua.php";
        redirect($url);
    } else if ($doc == FALSE) {
        $url = "JanelaPrincipal.php";
        redirect($url);
    }
}


?>