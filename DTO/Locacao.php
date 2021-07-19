<?php

require_once ".." . DIRECTORY_SEPARATOR . "autoload.php";

class Locacao implements ICrud {

    private $id;
    private $data;
    private $hora;
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
    
    function getVetorLivros() {
        return $this->vetorLivros;
    }

    function setVetorLivros($vetorLivros) {
        $this->vetorLivros = $vetorLivros;
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
        $stmt = $pdo->prepare('INSERT INTO locacao (data,hora,Cliente_idCliente) VALUES(:data,:hora,:idcliente)');
        $stmt2 = $pdo->prepare('commit;');
        $stmt->bindParam(':data', $data, PDO::PARAM_STR);
        $stmt->bindParam(':hora', $hora, PDO::PARAM_STR);
        $stmt->bindParam(':idcliente', $idCliente, PDO::PARAM_INT);

        $data = $vetDados[0];
        $hora = $vetDados[1];
        $idcliente = $vetDados[2];

        $stmt->execute();
        $stmt2->execute();
        //mensagem de inserido com sucesso!
        //$url = "listarcidades.php";
        //  $idestado = $this->pegarIDEstado($vetDados[1]);
        //   $idcidade = $this->pegarIDCidade();
        //$this->vincularEstado_Cidade($idcidade, $idestado);

        $this->alert2();
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
            $Locacao->setIdcliente($linha['Cliente_idCliente']);

            $vetDados[] = $Locacao;
        }
        return $vetDados;
    }

}
