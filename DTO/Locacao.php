<?php

require_once ".." . DIRECTORY_SEPARATOR . "autoload.php";

class Locacao implements ICrud {

    private $id;
    private $data;
    private $hora;
    private $dataentrega;
    private $idcliente;

    function getId() {
        return $this->id;
    }

    function getData() {
        return $this->data;
    }

    function getHora() {
        return $this->hora;
    }

    function getIdcliente() {
        return $this->idcliente;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setData($data) {
        $this->data = $data;
    }

    function setHora($hora) {
        $this->hora = $hora;
    }

    function setIdcliente($idcliente) {
        $this->idcliente = $idcliente;
    }

    function getDataentrega() {
        return $this->dataentrega;
    }

    function setDataentrega($dataentrega) {
        $this->dataentrega = $dataentrega;
    }

    public function __toString() {
        return "ID: " . $this->id . "<br/>ID Cliente: " . $this->idcliente . "<br/> Data: " . $this->data . "<br/> Hora: " . $this->hora . "<br/>";
    }

    public function Editar($vetDados) {
        
    }

    public function Excluir($vetDados) {
        
    }

    public function Existe($vetDados) {
        return false;
    }

    public function Inserir($vetDados) {
        $pdo = Conexao::getInstance();
        $stmt = $pdo->prepare('INSERT INTO locacao (data,hora,dataentrega,Cliente_idCliente) VALUES(:data,:hora,:dataentrega,:idcliente)');
        $stmt2 = $pdo->prepare('commit;');
        $stmt->bindParam(':data', $data, PDO::PARAM_STR);
        $stmt->bindParam(':hora', $hora, PDO::PARAM_STR);
        $stmt->bindParam(':dataentrega', $dataentr, PDO::PARAM_STR);
        $stmt->bindParam(':idcliente', $idcliente, PDO::PARAM_INT);

        $data = $vetDados[0];
        $hora = $vetDados[1];
        $dataentr = $vetDados[2];
        $idcliente = $vetDados[3];

        $stmt->execute();
        $stmt2->execute();
        //mensagem de inserido com sucesso!
        //$url = "listarcidades.php";
        //  $idestado = $this->pegarIDEstado($vetDados[1]);
        //   $idcidade = $this->pegarIDCidade();
        //$this->vincularEstado_Cidade($idcidade, $idestado);
        //$this->alert2();
        //$this->redirect($url);
    }

    public function PesquisarTodos($sql) {
        $pdo = Conexao::getInstance();
        $consulta = $pdo->query($sql);
        $vetDados = array();

        while ($linha = $consulta->fetch(PDO::FETCH_BOTH)) {
            $Locacao = new Locacao();
            $Locacao->setId($linha['idlocacao']);
            $Locacao->setData($linha['data']);
            $Locacao->setHora($linha['hora']);
            $Locacao->setdataentrega($linha['dataentrega']);
            $Locacao->setIdcliente($linha['Cliente_idCliente']);

            $vetDados[] = $Locacao;
        }
        return $vetDados;
    }

    function retornaLocacao($vet) {

        $pdo = Conexao::getInstance();
        $sql = "select * from locacao where data= '$vet[0]'and Cliente_idCliente = '$vet[3]' ";
        $consulta = $pdo->query($sql);
        while ($linha = $consulta->fetch(PDO::FETCH_BOTH)) {
            return $linha['idlocacao'];
        }
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

    function redirectPHP($url) {
        header('Location: ' . $url);
    }

    public function retornodata($idlocacao) {
        $pdo = Conexao::getInstance();
        $sql = "select * from locacao where idlocacao = " . $idlocacao;
        $consulta = $pdo->query($sql);
        while ($linha = $consulta->fetch(PDO::FETCH_BOTH)) {
            return $linha['dataentrega'];
        }
    }

    public function retornaClienteLocacao($locacaoid) {
        $pdo = Conexao::getInstance();
        $sql = "select Cliente_idCliente from locacao where idlocacao =" . $locacaoid;
        $consulta = $pdo->query($sql);
        while ($linha = $consulta->fetch(PDO::FETCH_BOTH)) {
            return $linha['Cliente_idCliente'];
        }
    }

}
