<?php

require_once ".." . DIRECTORY_SEPARATOR . "autoload.php";


class ContaDeAcesso implements ICrud {

    private $id;
    private $login;
    private $pass;
    private $tipoacesso;

    function getId() {
        return $this->id;
    }

    function getLogin() {
        return $this->login;
    }

    function getPass() {
        return $this->pass;
    }

    function getTipoacesso() {
        return $this->tipoacesso;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setLogin($login) {
        $this->login = $login;
    }

    function setPass($pass) {
        $this->pass = $pass;
    }

    function setTipoacesso($tipoacesso) {
        $this->tipoacesso = $tipoacesso;
    }

    public function __toString() {
        return "ID: " . $this->id . "<br/>Login: " . $this->login . "<br/> Pass: " . $this->pass . "<br/> Tipo De Acesso: " . $this->tipoacesso . "<br/>";
    }

    public function Editar($vetDados) {
        /* $id = $vetDados[0];
          $login = $vetDados[1];

          $nome2 = $this->retornaLogin($id);

          if (!$this->comparacao($login, $nome2)) {
          $pdo = Conexao::getInstance();
          $stmt = $pdo->prepare('update contadeacesso set tipodeacesso =:novovalor where idContaDeAcesso = :id');
          $stmt2 = $pdo->prepare('commit;');
          $stmt->bindParam(':novovalor', 0, PDO::PARAM_INT);
          $stmt->bindParam(':id', $id, PDO::PARAM_INT);
          $stmt->execute();
          $stmt2->execute();
          }

          $url = "listarcontasacesso.php";
          $this->redirect($url); */
    }

    public function Excluir($vetDados) {
        $id = $vetDados[0];
        $pdo = Conexao::getInstance();
        $stmt = $pdo->prepare('update contadeacesso set tipodeacesso =:novovalor where idContaDeAcesso = :id');
        $stmt2 = $pdo->prepare('commit;');
        $stmt->bindParam(':novovalor', 0, PDO::PARAM_INT);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $stmt2->execute();

        $url = "listarcontasacesso.php";
        $this->redirect($url);
    }

    public function Inserir($vetDados) {
        $pdo = Conexao::getInstance();
        $stmt = $pdo->prepare('INSERT INTO contadeacesso (login,pass,tipodeacesso) VALUES(:login,:pass,:idacesso)');
        $stmt2 = $pdo->prepare('commit;');
        $stmt->bindParam(':login', $vetDados[0], PDO::PARAM_STR);
        $stmt->bindParam(':pass', $vetDados[1], PDO::PARAM_STR);
        $stmt->bindParam(':idacesso', $vetDados[2], PDO::PARAM_INT);


        $verifica = $pdo->prepare('SELECT * FROM contadeacesso WHERE login = :log2');
        $verifica->bindParam(':log2', $login, PDO::PARAM_STR);
        $verifica->execute();
        $exists = FALSE;
        foreach ($verifica as $row) {
            if ($row['login'] == $login) {
                $exists = TRUE;
            }
        }

        if ($exists == FALSE) {
            $stmt->execute();
            $stmt2->execute();
            //mensagem de inserido com sucesso!
            $url = "listarcontasacesso.php";

            $this->alert2();
            //redirect($url);
            //header("location:listarestados.php");
        } else {
            //mensagem de confirmação
            $this->alert();
            $doc = "<script type='text/javascript'>document.write(a)</script>";
            if ($doc == TRUE) {
                $url = "CadastroContaDeAcesso.php";
                //   redirect($url);
            } else if ($doc == FALSE) {
                $url = "JanelaPrincipal.php";
                //     redirect($url);
            }
        }
    }

    public function PesquisarTodos($sql) {
        $pdo = Conexao::getInstance();
        $consulta = $pdo->query($sql);
        $vetDados = array();

        while ($linha = $consulta->fetch(PDO::FETCH_BOTH)) {
            $ContaDeAcesso = new ContaDeAcesso();
            $ContaDeAcesso->setId($linha['idContaDeAcesso']);
            $ContaDeAcesso->setLogin($linha['login']);
            $ContaDeAcesso->setPass($linha['pass']);
            $ContaDeAcesso->setTipoacesso($linha['tipodeacesso']);

            $vetDados[] = $ContaDeAcesso;
        }
        return $vetDados;
    }

    function alert() {
        echo "<script type='text/javascript'>var a=confirm('O Objeto Já Existe!');</script>";
    }

    function alert2() {
        echo "<script type='text/javascript'>alert('Inserido Com Sucesso!');</script>";
    }

    function redirect($url) {
        echo "<HTML>\n";
        echo "<HEAD>\n";
        echo "<TITLE></TITLE>\n";
        echo "<script language=\"JavaScript\">window.location='" . $url . "';</script>\n";
        echo "</HEAD>\n";
        echo "<BODY>\n";
        echo "</BODY>\n";
        echo "</HTML>\n";
    }

    function retornaLogin($valor) {

        $pdo = Conexao::getInstance();
        $sql = "select login from contadeacesso where idContaDeAcesso= '$valor' ";
        $consulta = $pdo->query($sql);
        while ($linha = $consulta->fetch(PDO::FETCH_BOTH)) {
            return $linha['login'];
        }
    }

    function retornaObj($valor) {

        $pdo = Conexao::getInstance();
        $sql = "select * from contadeacesso where idContaDeAcesso= '$valor' ";
        $consulta = $pdo->query($sql);
        $linha = $consulta->fetch(PDO::FETCH_BOTH);
        return $linha;
    }

    function retornaTipoAcesso($log) {

        $pdo = Conexao::getInstance();
        $sql = "select tipodeacesso from contadeacesso where login= '$log' ";
        $consulta = $pdo->query($sql);
        while ($linha = $consulta->fetch(PDO::FETCH_BOTH)) {
            return $linha['tipodeacesso'];
        }
    }

    function comparacao($valor1, $valor2) {
        if ($valor1 == $valor2) {
            return true;
        } else {
            return false;
        }
    }

    public function Existe($valor) {
        $pdo = Conexao::getInstance();
        $sql = "select login from ContaDeAcesso where login= '$valor' ";
        $consulta = $pdo->query($sql);

        while ($linha = $consulta->fetch(PDO::FETCH_BOTH)) {
            if (empty($linha)) {
                return FALSE;
            } else {
                return TRUE;
            }
        }
    }

    function buscaIDpeloNome($valor) {

        $pdo = Conexao::getInstance();
        $sql = "select idContaDeAcesso from ContaDeAcesso where login= '$valor' ";
        $consulta = $pdo->query($sql);
        while ($linha = $consulta->fetch(PDO::FETCH_BOTH)) {
            return $linha['idContaDeAcesso'];
        }
    }

    public function retornaMaxID() {
        $pdo = Conexao::getInstance(); //select max(idCidade) from cidade;
        $stmt = $pdo->prepare('select max(idContaDeAcesso) from ContaDeAcesso');
        $stmt->execute();

        foreach ($stmt as $row) {
            return $row['max(idContaDeAcesso)'];
        }
    }

}
