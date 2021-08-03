<?php

spl_autoload_register(function ($nomeClasse) {
//echo "DTO" . DIRECTORY_SEPARATOR . $nomeClasse . ".php";
    // require_once("arquivosPHP" . DIRECTORY_SEPARATOR . $nomeClasse . ".php");InterfaceGrafica/listarclientes.php
    //require_once ("InterfaceGrafica". DIRECTORY_SEPARATOR ."listarclientes.php");
    require_once("Datas" . DIRECTORY_SEPARATOR . "FuncoesData.php");
    if ((substr($nomeClasse, 0, 1)) == "I") {
        require_once ("Interface" . DIRECTORY_SEPARATOR . "ICrud.php");
    } else if ($nomeClasse == "Conexao") {
        require_once ("confs" . DIRECTORY_SEPARATOR . "Conexao.php");
        include_once("confs" . DIRECTORY_SEPARATOR . "inc.php");
    } else if ($nomeClasse == "padrao") {
        require_once("Graficos" . DIRECTORY_SEPARATOR . $nomeClasse . ".php");
    } else {
        require_once("DTO" . DIRECTORY_SEPARATOR . $nomeClasse . ".php");
    }
});
?>

