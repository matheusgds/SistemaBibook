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
        <link rel="stylesheet" type="text/css" href="css/estilo.css"/>
        <link rel="shortcut icon" href="IMG/livro32x32i.ico" >
        <title>Cadastro De Estado</title>
    </head>
    <body>
        <div class="divform"id="divform">
            <form action="" id="form" method="post">

                <fieldset>
                    <legend>
                        Cadastro De Estado
                    </legend>
                    <label for="nome">Nome:</label>
                    <input type="text" name="nome" id="nome" placeholder="Nome" required="true">
                    <br><br>
                    <label for="Sigla">Sigla:</label>
                    <input type="text" name="sigla" id="sigla" placeholder="Sigla" MAXLENGTH=2 required="true">
                    <br><br>
                    <button name="acao" value="Salvar" id="acao" type="submit">Salvar</button>
                    <button name="acao" value="Limpar" id="acao" type="reset">Limpar Campos</button>
                </fieldset> 
            </form>
        </div>
        <?php
        // put your code here
        ?>
    </body>
</html>
