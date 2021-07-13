<?php

require_once ".." . DIRECTORY_SEPARATOR . "autoload.php";

class Biblioteca implements ICrud {

    private $id;
    private $nome;
    private $idEstado;
    private $idCidade;
    private $idBairro;
    private $idRua;
    private $idNumeroCasa;
    private $idContato;

    function getId() {
        return $this->id;
    }

    function getNome() {
        return $this->nome;
    }

    function getIdEstado() {
        return $this->idEstado;
    }

    function getIdCidade() {
        return $this->idCidade;
    }

    function getIdBairro() {
        return $this->idBairro;
    }

    function getIdRua() {
        return $this->idRua;
    }

    function getIdNumeroCasa() {
        return $this->idNumeroCasa;
    }

    function getIdContato() {
        return $this->idContato;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setIdEstado($idEstado) {
        $this->idEstado = $idEstado;
    }

    function setIdCidade($idCidade) {
        $this->idCidade = $idCidade;
    }

    function setIdBairro($idBairro) {
        $this->idBairro = $idBairro;
    }

    function setIdRua($idRua) {
        $this->idRua = $idRua;
    }

    function setIdNumeroCasa($idNumeroCasa) {
        $this->idNumeroCasa = $idNumeroCasa;
    }

    function setIdContato($idContato) {
        $this->idContato = $idContato;
    }

    public function __toString() {
        return "ID: " . $this->id . "<br/>Nome: " . $this->nome . "<br/>";
    }

    public function Editar($vetDados) {
        
    }

    public function Excluir($vetDados) {
        
    }

    public function Inserir($vetDados) {
        $pdo = Conexao::getInstance();
        $stmt = $pdo->prepare('INSERT INTO biblioteca (nome,Estado_idEstado,Cidade_idCidade,Bairro_idBairro,Rua_idRua,NumeroCasa_idNumeroCasa,Contato_idContato) VALUES(:nome,:ide,:idc,:idb,:idr,:idnc,:idcont)');
        $stmt2 = $pdo->prepare('commit;');
        $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
        $stmt->bindParam(':ide', $idEstado, PDO::PARAM_INT);
        $stmt->bindParam(':idc', $idCidade, PDO::PARAM_INT);
        $stmt->bindParam(':idb', $idBairro, PDO::PARAM_INT);
        $stmt->bindParam(':idr', $idRua, PDO::PARAM_INT);
        $stmt->bindParam(':idnc', $idNumeroCasa, PDO::PARAM_INT);
        $stmt->bindParam(':idcont', $idContato, PDO::PARAM_INT);


        $nome = $vetDados[0];
        $idEstado = $vetDados[1];
        $idCidade = $vetDados[2];
        $idBairro = $vetDados[3];
        $idRua = $vetDados[4];
        $idNumeroCasa = $vetDados[5];
        $idContato = $vetDados[6];


        $verifica = $pdo->prepare('SELECT * FROM biblioteca WHERE nome = :nome2');
        $verifica->bindParam(':nome2', $nome, PDO::PARAM_STR);
        $verifica->execute();
        $exists = FALSE;
        foreach ($verifica as $row) {
            if ($row['nome'] == $nome) {
                $exists = TRUE;
            }
        }


        if ($exists == FALSE) {
            $stmt->execute();
            $stmt2->execute();
            //mensagem de inserido com sucesso!
            //$url = "listarcidades.php";

            $this->vincularEstado_Cidade($idCidade, $idEstado);
            $this->vincularCidade_Bairro($idCidade, $idBairro);
            $this->vincularCidade_Bairro($idBairro, $idRua);
            
            
            $this->alert2();
            //  $this->redirect($url);
        } else {
            $this->alert();
            $doc = "<script type='text/javascript'>document.write(a)</script>";
            if ($doc == TRUE) {
                $url = "CadastroBiblioteca.php";
                $this->redirect($url);
            } else if ($doc == FALSE) {
                $url = "JanelaPrincipal.php";
                $this->redirect($url);
            }
        }
    }

    public function PesquisarTodos($sql) {
        
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

    function vincularEstado_Cidade($idcidade, $idestado) {
        $idcidade = intval($idcidade);
        $idestado = intval($idestado);


        $pdo = Conexao::getInstance();
        $stmt = $pdo->prepare('INSERT INTO estado_has_cidade (Estado_idEstado,Cidade_idCidade) VALUES(:ide,:idc)');
        $stmt->bindParam(':ide', $idestado, PDO::PARAM_INT);
        $stmt->bindParam(':idc', $idcidade, PDO::PARAM_INT);
        $stmt->execute();
    }
    
    function vincularCidade_Bairro($idCidade, $idBairro) {
        $idCidade = intval($idCidade);
        $idBairro = intval($idBairro);


        $pdo = Conexao::getInstance();
        $stmt = $pdo->prepare('INSERT INTO cidade_has_bairro (Cidade_idCidade,Bairro_idBairro) VALUES(:idc,:idb)');
        $stmt->bindParam(':idb', $idBairro, PDO::PARAM_INT);
        $stmt->bindParam(':idc', $idCidade, PDO::PARAM_INT);
        $stmt->execute();
    }
    
    function vincularRua_Bairro($idRua, $idBairro) {
        $idRua = intval($idRua);
        $idBairro = intval($idBairro);


        $pdo = Conexao::getInstance();
        $stmt = $pdo->prepare('INSERT INTO rua_has_bairro (Rua_idRua,Bairro_idBairro) VALUES(:idr,:idb)');
        $stmt->bindParam(':idr', $idRua, PDO::PARAM_INT);
        $stmt->bindParam(':idb', $idBairro, PDO::PARAM_INT);
        $stmt->execute();
    }
    
    

}
