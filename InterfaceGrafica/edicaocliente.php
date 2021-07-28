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
        <?php $dir = ".." . DIRECTORY_SEPARATOR . "IMG" . DIRECTORY_SEPARATOR . "livro32x32p.png"; ?>
        <?php $dircss = ".." . DIRECTORY_SEPARATOR . "CSS" . DIRECTORY_SEPARATOR . "estilo.css"; ?>

        <?php $dirshort = ".." . DIRECTORY_SEPARATOR . "IMG" . DIRECTORY_SEPARATOR . "livro32x32i.ico"; ?>
        <link rel="stylesheet" type="text/css" href=<?php echo $dircss ?>/>
        <link rel="shortcut icon" href=<?php echo $dirshort ?> >
        <title>Edição De Cliente</title>
    </head>
    <body>

        <div class="container-fluid">
            <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
                <a class="navbar-brand" href="index.php">Sistema Bibook</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="JanelaPrincipal.php">Home <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Cadastrar
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item  bg-light" href="DTO/CadastroEstado.php">Cadastrar um Estado</a>
                                <a class="dropdown-item" href="#">Another action</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">Something else here</a>
                            </div>
                        </li> 
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Pesquisar
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="DTO/listarestados.php">Pesquisar Estados</a>
                                <a class="dropdown-item" href="#">Another action</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">Something else here</a>
                            </div>
                        </li>       

                    </ul>
                    <nav class="navbar navbar-light bg-light">
                        <span>
                            <img src=<?php echo $dir ?> width="30" height="30" class="d-inline-block align-top" alt="">
                            BEM VINDO <?php /* $logado */ ?>
                        </span>
                    </nav> 

                </div>
            </nav>


            <div>
                <?php
                /*

                  session_start();

                  if ((!isset($_SESSION['loginextra']) == true) and ( !isset($_SESSION['senhaextra']) == true)) {
                  unset($_SESSION['loginextra']);
                  unset($_SESSION['senhaextra']);
                  header('location:index.php');
                  } else {
                  $logado = $_SESSION['loginextra'];
                  } */
                ?>
            </div>


            <div class="form-row" id="divform">
                <?php $link = ".." . DIRECTORY_SEPARATOR . "arquivosPHP" . DIRECTORY_SEPARATOR . "editarcliente.php"; ?>

                <form action=<?php echo $link ?> id="form" method="post">

                    <fieldset>
                        <legend>
                            Edição De Cliente
                        </legend>
                        <br><br>
                        <div style="border-style:double; margin:20px;width: 320px;">
                            <legend>
                                Dados Pessoais:
                            </legend>
                            <?php $id = $_GET['cliente'] ?>
                            <?php
                            require_once ".." . DIRECTORY_SEPARATOR . "autoload.php";
                            $cli = new Cliente();

                            $obj = $cli->retornaObjeto($id);
                            ?>
                            <label for="codigo">Código:</label>
                            <input readonly="" type="text" name="codigo" id="codigo" placeholder="Codigo" value = "<?php echo $id ?>" required="true">
                            <br><br>

                            <label for="nome">Nome:</label>
                            <input type="text" name="nome" id="nome" placeholder="Nome" value = "<?php echo $obj[1] ?>" required="true">
                            <br><br>

                            <label for="cpf">CPF:</label>
                            <input type="text" name="cpf" id="cpf" placeholder="CPF" value = "<?php echo $obj[2] ?>" required="true">
                            <br><br>

                            <label for="rg">RG:</label>
                            <input type="text" name="rg" id="rg" placeholder="RG" value = "<?php echo $obj[3] ?>" required="true">
                            <br><br>

                            <label for="data">Data De Nascimento:</label>
                            <input type="date" name="datanasc" id="datanasc" value = "<?php echo $obj[4] ?>" required="true">
                            <br><br>

                            <label for="sexo">Selecione Seu Sexo: </label>
                            <br>
                            <?php if ($obj[5] == 'M') { ?>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="inlineCheckbox1" value="M" name="sexo" checked>
                                    <label class="form-check-label" for="inlineCheckbox1">Masculino</label>
                                    <input class="form-check-input" type="radio" id="inlineCheckbox1" value="F" name="sexo">
                                    <label class="form-check-label" for="inlineCheckbox1">Feminino</label>
                                </div>
                            <?php } else { ?>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="inlineCheckbox1" value="M" name="sexo" >
                                    <label class="form-check-label" for="inlineCheckbox1">Masculino</label>
                                    <input class="form-check-input" type="radio" id="inlineCheckbox1" value="F" name="sexo" checked>
                                    <label class="form-check-label" for="inlineCheckbox1">Feminino</label>

                                </div>
                            <?php } ?>
                            <br><br>

                            <label for="situacao">Situação: </label>
                            <br>
                            <?php if ($obj[6] == '1') { ?>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="inlineCheckbox1" value="Ativo" name="situacao" checked>
                                    <label class="form-check-label" for="inlineCheckbox1">Ativo</label>
                                    <input class="form-check-input" type="radio" id="inlineCheckbox1" value="Desativo" name="situacao">
                                    <label class="form-check-label" for="inlineCheckbox1">Desativo</label>
                                </div>
                            <?php } else { ?>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="inlineCheckbox1" value="Ativo" name="situacao">
                                    <label class="form-check-label" for="inlineCheckbox1">Ativo</label>
                                    <input class="form-check-input" type="radio" id="inlineCheckbox1" value="Desativo" name="situacao" checked>
                                    <label class="form-check-label" for="inlineCheckbox1">Desativo</label>
                                </div>
                            <?php } ?>
                            <br><br>


                        </div>

                        <div style="border-style:double; margin:20px;width: 320px" id="divloc" position:absolute>
                            <legend>
                                Localização:
                            </legend>

                            <label for="estado">Selecione O Estado:</label>
                            <select name="select" id="selectest">
                                <?php
                                $sql = "select * from estado;";

                                $estado = new Estado();

                                $lista = $estado->PesquisarTodos($sql); // array de estados

                                $opc = $obj[7];
                                $sql = "select * from estado where idEstado = " . $opc;
                                $opcao = $estado->PesquisarTodos($sql);

                                $opcaosigla = $opcao[0]->getSigla();

                                for ($index = 0; $index < count($lista); $index++) {
                                    ?>
                                    <option value=<?php echo $lista[$index]->getSigla() ?> <?php
                                    if ($opcaosigla == $lista[$index]->getSigla()) {
                                        echo "selected";
                                    } else {
                                        echo "";
                                    }
                                    ?> ><?php echo $lista[$index]->getSigla() ?></option>
                                            <?php
                                        }
                                        ?>

                            </select>


                            <br><br>
                            <label for="cidade">Cidade:</label>
                            <?php $city = new Cidade(); ?>
                            <?php $nomec = $city->retornaNome($obj[8]); ?>
                            <input type="text" name="cidade" id="cidade" placeholder="Nome Cidade" value="<?php echo $nomec ?>"required="true">
                            <br><br>
                            <label for="bairro">Bairro:</label>
                            <?php $bairro = new Bairro(); ?>
                            <?php $nomeb = $bairro->retornaNome($obj[9]); ?>

                            <input type="text" name="bairro" id="bairro" placeholder="Nome Bairro" value="<?php echo $nomeb ?>" required="true">
                            <br><br>
                            <label for="rua">Rua:</label>
                            <?php $rua = new Rua(); ?>
                            <?php $nomer = $rua->retornaNome($obj[10]); ?>

                            <input type="text" name="rua" id="rua" placeholder="Nome Rua" value="<?php echo $nomer ?>" required="true">
                            <br><br>
                            <label for="numeroCasa">Numero Da Residencia:</label>
                            <?php $nc = new NumeroCasa(); ?>
                            <?php $numero = $nc->buscaNomepeloID($obj[11]); ?>

                            <input type="text" name="numerocasa" id="numerocasa" placeholder="Numero Da Casa" value ="<?php echo $numero ?>" required="true">

                            <br><br>
                        </div>
                        <div style="border-style:double; margin:20px;width: 320px" id="divloc" position:absolute>
                            <legend>
                                Contato:
                            </legend>

                            <?php $cont = new Contato(); ?>
                            <?php $contato = $cont->retornaObj($obj[12]); ?>

                            <label for="Email">Email:</label>
                            <input type="text" namespace="email" id="email" class="form-control" value="<?php echo $contato[1] ?>" placeholder="Ex.: aaaaaa@aaaa.com">
                            <br><br>
                            <label for="Telefone1">Telefone 1:</label>
                            <input type="text" name="telefone1"id="telefone1" class="form-control" value="<?php echo $contato[2] ?>" placeholder="Ex.: (00) 0000-0000" >
                            <br><br>
                            <label for="Telefone2">Telefone 2:</label>
                            <input type="text" name="telefone2" id="telefone2" class="form-control" value="<?php echo $contato[3] ?>"placeholder="Ex.: (00) 0000-0000" >
                            <br><br>
                            <label for="Celular">Celular:</label>
                            <input type="text" name="celular" id="celular" class="form-control" value="<?php echo $contato[4] ?>" placeholder="Ex.: (00) 00000-0000" >
                            <br><br>


                        </div>

                        <div style="border-style:double; margin:20px;width: 320px" id="divloc" position:absolute>
                            <legend>
                                Cadastro De Conta De Acesso
                            </legend>
                            <?php $Contadeacesso = new ContaDeAcesso(); ?>
                            <?php $conta = $Contadeacesso->retornaObj($obj[13]); ?>


                            <label for="login">Login:</label>
                            <input type="text" name="login" id="login" placeholder="Login" value="<?php echo $conta[1] ?>" required="true">
                            <br><br>

                            <label for="senha">Senha:</label>
                            <input type="password" name="senha" id="senha" placeholder="Senha"  required="true">
                            <br><br>

                            <label for="acesso">Defina Tipo De Acesso:</label>
                            <?php if ($conta[3] == 1) { ?>
                                <br>
                                <INPUT TYPE="RADIO" NAME="acesso" VALUE="1"  checked> Administrador(a)
                                <br>
                                <INPUT TYPE="RADIO" NAME="acesso" VALUE="2"> Bibliotecario(a)
                                <br>
                                <INPUT TYPE="RADIO" NAME="acesso" VALUE="3"> Cliente
                                <br><br>
                            <?php } else if ($conta[3] == 2) { ?>
                                <br>
                                <INPUT TYPE="RADIO" NAME="acesso" VALUE="1"> Administrador(a)
                                <br>
                                <INPUT TYPE="RADIO" NAME="acesso" VALUE="2"  checked> Bibliotecario(a)
                                <br>
                                <INPUT TYPE="RADIO" NAME="acesso" VALUE="3"> Cliente
                                <br><br>
                            <?php } else if ($conta[3] == 3) { ?>
                                <br>
                                <INPUT TYPE="RADIO" NAME="acesso" VALUE="1"> Administrador(a)
                                <br>
                                <INPUT TYPE="RADIO" NAME="acesso" VALUE="2"> Bibliotecario(a)
                                <br>
                                <INPUT TYPE="RADIO" NAME="acesso" VALUE="3"  checked> Cliente
                                <br><br>
                            <?php } ?>

                        </div>
                        <button name="acao" value="Salvar" id="acao" type="submit" class="btn btn-primary">Salvar</button>
                        <button name="acao" value="Limpar" id="acao" type="reset" class="btn btn-primary">Limpar Campos</button>
                        <br><br>
                    </fieldset> 
                </form>
            </div>
        </div>
        <?php ?>
    </body>

    <script type="text/javascript">
        /* Máscaras ER */
        function mascara(o, f) {
            v_obj = o
            v_fun = f
            setTimeout("execmascara()", 1)
        }
        function execmascara() {
            v_obj.value = v_fun(v_obj.value)
        }
        function mtel(v) {
            v = v.replace(/\D/g, ""); //Remove tudo o que não é dígito
            v = v.replace(/^(\d{2})(\d)/g, "($1) $2"); //Coloca parênteses em volta dos dois primeiros dígitos
            v = v.replace(/(\d)(\d{4})$/, "$1-$2"); //Coloca hífen entre o quarto e o quinto dígitos
            return v;
        }

        function mcel(v) {
            v = v.replace(/\D/g, ""); //Remove tudo o que não é dígito
            v = v.replace(/^(\d{2})(\d)/g, "($1) $2"); //Coloca parênteses em volta dos dois primeiros dígitos
            v = v.replace(/(\d)(\d{4})$/, "$1-$2"); //Coloca hífen entre o quarto e o quinto dígitos
            return v;
        }


        function mcpf(v) {
            v = v.replace(/\D/g, ""); //Remove tudo o que não é dígito
            v = v.replace(/(\d)(\d{8})$/, "$1.$2");
            v = v.replace(/(\d)(\d{5})$/, "$1.$2");
            v = v.replace(/(\d)(\d{2})$/, "$1-$2"); //Coloca hífen entre o quarto e o quinto dígitos
            return v;
        }


        function id(el) {
            return document.getElementById(el);
        }

        window.onload = function () {
            id('telefone1').onkeyup = function () {
                mascara(this, mtel);
            }
        }

        window.onload = function () {
            id('telefone2').onkeyup = function () {
                mascara(this, mtel);
            }
        }

        window.onload = function () {
            id('celular').onkeyup = function () {
                mascara(this, mcel);
            }
        }

        window.onload = function () {
            id('cpf').onkeyup = function () {
                mascara(this, mcpf);
            }
        }


    </script>

</html>
