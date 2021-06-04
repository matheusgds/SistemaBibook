<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width-device-width,initial-scale=1.0"/>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="css/estilo.css"/>
        <link rel="shortcut icon" href="IMG/livro32x32i.ico" >
        <title>SISTEMA BIBOOK</title>
    </head>
    <body>

        <div class="container-fluid">
            <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 col-xl-2" >
                <figure>
                    <br>
                    <img alt="Sistema Bibook" src="IMG\livro96x96p.png" id="img1">
                    <br><br>
                    <h1> BIBOOK </h1>
                    <br>
                </figure>
            </div>
            <div>
                <form method="POST" action="./arquivosPHP/Entrar2.php" name="formContato">
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
                        <!--<img src="GIFIcon/icon-refresh.gif"/> -->
                    </div>
                    <br>

                </form>
            </div>

        </div>

        <?php
        // put your code here
        ?>
    </body>
</html>
