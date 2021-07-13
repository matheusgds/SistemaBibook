<?php

spl_autoload_register(function ($nomeClasse) {
//echo "DTO" . DIRECTORY_SEPARATOR . $nomeClasse . ".php";
    if ((substr($nomeClasse, 0, 1)) == "I") {
        require_once ("Interface" . DIRECTORY_SEPARATOR . "ICrud.php");
    } else if ($nomeClasse == "Conexao") {
        require_once ("confs" . DIRECTORY_SEPARATOR . "Conexao.php");
        include_once("confs" . DIRECTORY_SEPARATOR . "inc.php");
    } else {
        require_once("DTO" . DIRECTORY_SEPARATOR . $nomeClasse . ".php");
    }
});
?>
