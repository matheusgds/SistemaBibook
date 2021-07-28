<?php

require_once ".." . DIRECTORY_SEPARATOR . "autoload.php";

class Contato implements ICrud {

    private $id;
    private $email;
    private $telefone1;
    private $telefone2;
    private $celular;

    function getId() {
        return $this->id;
    }

    function getEmail() {
        return $this->email;
    }

    function getTelefone1() {
        return $this->telefone1;
    }

    function getTelefone2() {
        return $this->telefone2;
    }

    function getCelular() {
        return $this->celular;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setTelefone1($telefone1) {
        $this->telefone1 = $telefone1;
    }

    function setTelefone2($telefone2) {
        $this->telefone2 = $telefone2;
    }

    function setCelular($celular) {
        $this->celular = $celular;
    }

    public function __toString() {
        $string = "ID: " . $this->id . "<br/>";
        if (($this->email != null) || ($this->email != "")) {
            $string = $string . ($this->email) . "<br/>";
        } else if (($this->telefone1 != null) || ($this->telefone1 != "")) {
            $string = $string . ($this->telefone1) . "<br/>";
        } else if (($this->telefone2 != null) || ($this->telefone2 != "")) {
            $string = $string . ($this->telefone2) . "<br/>";
        } else if (($this->celular != null) || ($this->celular != "")) {
            $string = $string . ($this->celular) . "<br/>";
        }

        return $string;
    }

    public function Editar($vetDados) {
        
    }

    public function Excluir($vetDados) {
        
    }

    public function Inserir($vetDados) {

        $pdo = Conexao::getInstance();
        $stmt = $pdo->prepare('INSERT INTO contato (email,telefone1,telefone2,celular) VALUES(:email,:telefone1,:telefone2,:celular)');
        $stmt2 = $pdo->prepare('commit;');

        $stmt->bindParam(':email', $vetDados[0], PDO::PARAM_STR);
        $stmt->bindParam(':telefone1', $vetDados[1], PDO::PARAM_STR);
        $stmt->bindParam(':telefone2', $vetDados[2], PDO::PARAM_STR);
        $stmt->bindParam(':celular', $vetDados[3], PDO::PARAM_STR);


        $verifica = $pdo->prepare('SELECT * FROM contato WHERE email = :email2');
        $verifica->bindParam(':email2', $vetDados[0], PDO::PARAM_STR);
        $verifica->execute();
        $exists = FALSE;
        foreach ($verifica as $row) {
            if ($row['email'] == $vetDados[0]) {
                $exists = TRUE;
            }
        }

        if ($exists == FALSE) {
            $stmt->execute();
            $stmt2->execute();
            //mensagem de inserido com sucesso!
            $this->alert2();
        } else {
            //mensagem de confirmação
            $this->alert();
        }
    }

    public function PesquisarTodos($sql) {
        
    }

    public function Existe($valor) {
        $pdo = Conexao::getInstance();
        $sql = "select idContato from contato where celular= '$valor' ";
        $consulta = $pdo->query($sql);

        while ($linha = $consulta->fetch(PDO::FETCH_BOTH)) {
            if (empty($linha)) {
                return FALSE;
            } else {
                return TRUE;
            }
        }
    }

    public function retornaMaxID() {
        $pdo = Conexao::getInstance(); //select max(idCidade) from cidade;
        $stmt = $pdo->prepare('SELECT max(idContato) FROM contato');
        $stmt->execute();

        foreach ($stmt as $row) {
            return $row['max(idContato)'];
        }
    }

    function buscaIDpeloNome($valor) {

        $pdo = Conexao::getInstance();
        $sql = "select idContato from contato where celular= '$valor' ";
        $consulta = $pdo->query($sql);
        while ($linha = $consulta->fetch(PDO::FETCH_BOTH)) {
            return $linha['idContato'];
        }
    }

    function retornaObj($valor) {

        $pdo = Conexao::getInstance();
        $sql = "select * from contato where idContato= '$valor' ";
        $consulta = $pdo->query($sql);
        $linha = $consulta->fetch(PDO::FETCH_BOTH);
        return $linha;
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

}
