<?php

spl_autoload_register(function ($nomeClasse) {
    if (file_exists(".." . DIRECTORY_SEPARATOR . "DTO" . DIRECTORY_SEPARATOR . $nomeClasse . ".class.php"))
        require_once(".." . DIRECTORY_SEPARATOR . "DTO" . DIRECTORY_SEPARATOR . $nomeClasse . ".class.php");
});
?>