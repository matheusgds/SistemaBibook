<?php

spl_autoload_register(function ($nomeClasse) {
    if (file_exists(".." . DIRECTORY_SEPARATOR . "DTO" . DIRECTORY_SEPARATOR . $nomeClasse . ".php")) {
        require_once(".." . DIRECTORY_SEPARATOR . "DTO" . DIRECTORY_SEPARATOR . $nomeClasse . ".php");
        require_once ".." . DIRECTORY_SEPARATOR . "Interface" . DIRECTORY_SEPARATOR . "ICrud.php";
        require_once(".." . DIRECTORY_SEPARATOR . "confs" . DIRECTORY_SEPARATOR . "Conexao" . ".php");
        include_once (".." . DIRECTORY_SEPARATOR . "confs" . DIRECTORY_SEPARATOR . "inc.php");
    }
});
?>