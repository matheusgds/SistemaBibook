<?php

require_once ".." . DIRECTORY_SEPARATOR . "autoload.php";

class Rua implements ICrud {

    private $id;
    private $nome;

    function getId() {
        return $this->id;
    }

    function getNome() {
        return $this->nome;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    public function __toString() {
        return "ID: " . $this->id . "<br/>Nome: " . $this->nome . "<br/>";
    }

    public function Editar($vetDados) {
        $id = $vetDados[0];
        $nome = $vetDados[1];

        $nome2 = $this->retornaNome($id);

        if (!$this->comparacao($nome, $nome2)) {
            $pdo = Conexao::getInstance();
            $stmt = $pdo->prepare('update rua set nome =:novonome where idRua = :id');
            $stmt2 = $pdo->prepare('commit;');
            $stmt->bindParam(':novonome', $nome, PDO::PARAM_STR);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $stmt2->execute();
        }

        $url = ".." . DIRECTORY_SEPARATOR . "InterfaceGrafica" . DIRECTORY_SEPARATOR . "listarruas.php";
        $this->redirectPHP($url);
    }

    public function Excluir($vetDados) {
        $pdo = Conexao::getInstance();
        $stmt = $pdo->prepare('delete from rua where idRua = :id ');
        $stmt2 = $pdo->prepare('commit;');
        $stmt->bindParam(':id', $ide, PDO::PARAM_INT);
        $ide = $vetDados[0];
        $stmt->execute();
        $stmt2->execute();

       $url = ".." . DIRECTORY_SEPARATOR . "InterfaceGrafica" . DIRECTORY_SEPARATOR . "listarruas.php";
        $this->redirectPHP($url);
    }

    public function Inserir($vetDados) {

        $pdo = Conexao::getInstance();
        $stmt = $pdo->prepare('INSERT INTO rua (nome) VALUES(:nome)');
        $stmt2 = $pdo->prepare('commit;');
        $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);

        $nome = $vetDados[0];
        $nomebairro = $vetDados[1];

        if ($this->Existe($nome)) {
            $idRua = $this->pegarIDRuaCentro($nome);
            $idBairro = $this->pegarIDBairro($nomebairro);
            $this->vincularRua_Bairro($idRua, $idBairro);
            $this->alert3();
        } else {
            $stmt->execute();
            $stmt2->execute();

            $idRua = $this->pegarIDRua();
            $idBairro = $this->pegarIDBairro($nomebairro);
            $this->vincularRua_Bairro($idRua, $idBairro);

            $this->alert2();
        }
    }

    function inserir2Semvinculo($vetDados) {
        $pdo = Conexao::getInstance();
        $stmt = $pdo->prepare('INSERT INTO rua (nome) VALUES(:nome)');
        $stmt2 = $pdo->prepare('commit;');
        $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);

        $nome = $vetDados[0];
        
        // retorna falso pois aquela rua nao existe

        if (!$this->Existe($nome)) { // verdadeiro se existe,
            $stmt->execute();
            $stmt2->execute();
        }
    }

    public function PesquisarTodos($sql) {
        $pdo = Conexao::getInstance();
        $consulta = $pdo->query($sql);
        $vetDados = array();

        while ($linha = $consulta->fetch(PDO::FETCH_BOTH)) {
            $Bairro = new Bairro();
            $Bairro->setId($linha['idRua']);
            $Bairro->setNome($linha['nome']);

            $vetDados[] = $Bairro;
        }
        return $vetDados;
    }

    function alert() {
        echo "<script type='text/javascript'>var a=confirm('O Objeto Já Existe!');</script>";
    }

    function alert2() {
        echo "<script type='text/javascript'>alert('Inserido Com Sucesso!');</script>";
    }

    function alert3() {
        echo "<script type='text/javascript'>alert('Objeto Existente Porém, Vinculação Inserida!');</script>";
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
    
    function redirectPHP($url) {
        header('Location: ' . $url);
    }

    function pegarIDBairro($sig) {

        $pdo = Conexao::getInstance();
        $stmt = $pdo->prepare("SELECT idBairro FROM bairro WHERE nome='$sig'");
        $stmt->execute();
        foreach ($stmt as $row) {
            return $row['idBairro'];
        }
    }

    function pegarIDRua() {

        $pdo = Conexao::getInstance(); //select max(idCidade) from cidade;
        $stmt = $pdo->prepare('SELECT max(idRua) FROM rua');
        $stmt->execute();

        foreach ($stmt as $row) {
            return $row['max(idRua)'];
        }
    }

    function pegarIDRuaCentro($sig) {

        $pdo = Conexao::getInstance();
        $stmt = $pdo->prepare("SELECT idRua FROM rua WHERE nome='$sig'");
        $stmt->execute();
        foreach ($stmt as $row) {
            return $row['idRua'];
        }
    }

    function vincularRua_Bairro($idRua, $idBairro) {
        $idRua = intval($idRua);
        $idBairro = intval($idBairro);
        $pdo = Conexao::getInstance();

        if (!$this->ExisteEsp($idRua, $idBairro)) {
            $stmt = $pdo->prepare('INSERT INTO rua_has_bairro (Rua_idRua,Bairro_idBairro) VALUES(:idr,:idb)');
            $stmt->bindParam(':idr', $idRua, PDO::PARAM_INT);
            $stmt->bindParam(':idb', $idBairro, PDO::PARAM_INT);
            $stmt->execute();
        }
    }

    function retornaNome($valor) {

        $pdo = Conexao::getInstance();
        $sql = "select nome from Rua where idRua= '$valor' ";
        $consulta = $pdo->query($sql);
        while ($linha = $consulta->fetch(PDO::FETCH_BOTH)) {
            return $linha['nome'];
        }
    }

    function buscaIDpeloNome($valor) {

        $pdo = Conexao::getInstance();
        $sql = "select idRua from rua where nome= '$valor' ";
        $consulta = $pdo->query($sql);
        while ($linha = $consulta->fetch(PDO::FETCH_BOTH)) {
            return $linha['idRua'];
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
        $sql = "select idRua from rua where nome= '$valor' ";
        $consulta = $pdo->query($sql);

        while ($linha = $consulta->fetch(PDO::FETCH_BOTH)) {
            if (empty($linha)) {
                return FALSE;
            } else {
                return TRUE;
            }
        }
    }

    public function ExisteEsp($valor, $valor2) {
        $pdo = Conexao::getInstance();
        $sql = "select * from Rua_has_Bairro where Rua_idRua= '$valor' and Bairro_idBairro= '$valor2'";
        $consulta = $pdo->query($sql);

        while ($linha = $consulta->fetch(PDO::FETCH_BOTH)) {
            if (empty($linha)) {
                return FALSE;
            } else {
                return TRUE;
            }
        }
    }

}
