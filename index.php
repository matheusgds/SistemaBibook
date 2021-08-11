<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <?php $dir = "IMG" . DIRECTORY_SEPARATOR . "livro32x32p.png"; ?>
        <?php $dircss = "css" . DIRECTORY_SEPARATOR . "estilo.css"; ?>
        <?php $dirshort = "IMG" . DIRECTORY_SEPARATOR . "livro32x32i.ico"; ?>
        <link rel="stylesheet" type="text/css" href=<?php echo $dircss ?>/>
        <link rel="shortcut icon" href=<?php echo $dirshort ?> >



        <title>SISTEMA BIBOOK</title>
    </head>
    <body>

        <div class="container-fluid">
            <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 col-xl-2" >
                <figure>
                    <br>
                    <?php $novolink ="IMG".DIRECTORY_SEPARATOR."livro96x96p.png"; ?> 
                    <img alt="Sistema Bibook" src=<?php echo $novolink?> id="img1">
                    <br><br>
                    <h1> BIBOOK </h1>
                    <br>
                </figure>
            </div>
            <div>
                <?php
                $linkacesso =  "arquivosPHP" . DIRECTORY_SEPARATOR . "Entrar.php";
                ?>


                <form method="POST" action=<?php echo $linkacesso ?> name="formContato">
                    <br>

                    <label class="ml-2">Informe seu Login: </label>
                    <br>
                    <input type="text" name="txtLog" placeholder="Digite Aqui Seu Login" class="form-control ml-2" required>
                    <br>
                    <label class="ml-2">Informe sua Senha: </label>
                    <br>
                    <input type="password" name="txtPass" placeholder="Digite Aqui Sua Senha" class="form-control ml-2" required>

                    <br><br>
                    <div style="text-align:center">
                        <input class="btn btn-primary" type="reset" value="Limpar">
                        <input class="btn btn-primary" type="submit" value="Entrar">
                    </div>
                    <br>

                </form>
            </div>

            <div class="row">
                <div class="col-12">
                    <p><strong>Matheus Giacomelli Dos Santos</strong></p>
                    <p> ► Copyright © 2021 - Direitos Autorais </p>
                </div>
            </div>

        </div>

        <?php
        // put your code here
        ?>
    </body>
</html>
