<?php

require_once ".." . DIRECTORY_SEPARATOR . "autoload.php";

class NumeroCasa implements ICrud {

    private $id;
    private $num;

    function getId() {
        return $this->id;
    }

    function getNum() {
        return $this->num;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNum($num) {
        $this->num = $num;
    }

    public function __toString() {
        return "ID: " . $this->id . "<br/>Numero: " . $this->num . "<br/>";
    }

    public function Editar($vetDados) {
        
    }

    public function Excluir($vetDados) {
        
    }

    public function Existe($valor) {
        $pdo = Conexao::getInstance();
        $sql = "select idNumeroCasa from NumeroCasa where numero= '$valor' ";
        $consulta = $pdo->query($sql);

        while ($linha = $consulta->fetch(PDO::FETCH_BOTH)) {
            if (empty($linha)) {
                return FALSE;
            } else {
                return TRUE;
            }
        }
    }

    public function Inserir($vetDados) {
        $pdo = Conexao::getInstance();
        $stmt = $pdo->prepare('INSERT INTO NumeroCasa (numero) VALUES(:num)');
        $stmt2 = $pdo->prepare('commit;');
        $stmt->bindParam(':num', $vetDados[0], PDO::PARAM_STR);

        $verifica = $pdo->prepare('SELECT * FROM NumeroCasa WHERE numero = :num2');
        $verifica->bindParam(':num2', $vetDados[0], PDO::PARAM_STR);
        $verifica->execute();
        $exists = FALSE;
        foreach ($verifica as $row) {
            if ($row['numero'] == $nome) {
                $exists = TRUE;
            }
        }

        if ($exists == FALSE) {
            $stmt->execute();
            $stmt2->execute();

            $this->alert2();
        } else {
            //mensagem de confirmação
            $this->alert();
        }
    }

    function buscaNomepeloID($valor) {

        $pdo = Conexao::getInstance();
        $sql = "select numero from numerocasa where idNumeroCasa= '$valor' ";
        $consulta = $pdo->query($sql);
        while ($linha = $consulta->fetch(PDO::FETCH_BOTH)) {
            return $linha['numero'];
        }
    }
    
    function buscaIDpeloNome($valor) {

        $pdo = Conexao::getInstance();
        $sql = "select idNumeroCasa from numerocasa where numero= '$valor' ";
        $consulta = $pdo->query($sql);
        while ($linha = $consulta->fetch(PDO::FETCH_BOTH)) {
            return $linha['idNumeroCasa'];
        }
    }

    public function PesquisarTodos($sql) {
        $pdo = Conexao::getInstance();
        $consulta = $pdo->query($sql);
        $vetDados = array();

        while ($linha = $consulta->fetch(PDO::FETCH_BOTH)) {
            $Numero = new NumeroCasa();
            $Numero->setId($linha['idNumeroCasa']);
            $Numero->setNum($linha['numero']);
            $vetDados[] = $Numero;
        }
        return $vetDados;
    }

}
