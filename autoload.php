<?php

spl_autoload_register(function ($nomeClasse) {
    if (file_exists("SistemaBibook" . DIRECTORY_SEPARATOR . "DTO" . DIRECTORY_SEPARATOR . $nomeClasse . ".class.php"))
        require_once("SistemaBibook" . DIRECTORY_SEPARATOR . "DTO" . DIRECTORY_SEPARATOR . $nomeClasse . ".class.php");
});
?>