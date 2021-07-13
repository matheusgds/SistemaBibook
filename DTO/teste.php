<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        require_once ".." . DIRECTORY_SEPARATOR . "autoload.php";
        $estado = new Estado();
        $vet = "1";
        $retorno = $estado->Existe($vet);
        if ($retorno) {
            echo "deu boa";
            echo $retorno;
        } else {
            echo $retorno;
            echo "nao deu";
        }

        //var_dump($retorno);
        ?>
    </body>
</html>
