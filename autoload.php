<?php

spl_autoload_register(function ($nomeClasse) {
    echo ".." . DIRECTORY_SEPARATOR . "DTO" . DIRECTORY_SEPARATOR . $nomeClasse . ".class.php";
    if (file_exists(".." . DIRECTORY_SEPARATOR . "DTO" . DIRECTORY_SEPARATOR . $nomeClasse . ".php"))
        require_once(".." . DIRECTORY_SEPARATOR . "DTO" . DIRECTORY_SEPARATOR . $nomeClasse . ".php");
});
?>