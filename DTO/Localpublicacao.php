<?php

require_once ".." . DIRECTORY_SEPARATOR . "autoload.php";

class Localpublicacao implements ICrud {

    private $id;
    private $idEstado;
    private $idCidade;

    function getId() {
        return $this->id;
    }

    function getIdEstado() {
        return $this->idEstado;
    }

    function getIdCidade() {
        return $this->idCidade;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setIdEstado($idEstado) {
        $this->idEstado = $idEstado;
    }

    function setIdCidade($idCidade) {
        $this->idCidade = $idCidade;
    }

    public function __toString() {
        return "ID: " . $this->id . "<br/>idEstado: " . $this->idEstado . "<br/> idCidade: " . $this->idCidade . "<br/>";
    }

    public function Editar($vetDados) {
        
    }

    public function Excluir($vetDados) {
        
    }

    public function Existe($vetDados) {
        $pdo = Conexao::getInstance();
        $sql = "select * from LocalDePublicacao where Estado_idEstado= '$vetDados[0]' and Cidade_idCidade = '$vetDados[1]'";
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
        $stmt = $pdo->prepare('INSERT INTO LocalDePublicacao (Estado_idEstado,Cidade_idCidade) VALUES(:Estado,:Cidade)');
        $stmt2 = $pdo->prepare('commit;');
        $stmt->bindParam(':Estado', $idEst, PDO::PARAM_INT);
        $stmt->bindParam(':Cidade', $idCid, PDO::PARAM_INT);

        $idEst = $vetDados[0];
        $idCid = $vetDados[1];


        if (!$this->Existe($vetDados)) {

            $stmt->execute();
            $stmt2->execute();
            //mensagem de inserido com sucesso!
            //$url = "listarcidades.php";
            //  $idestado = $this->pegarIDEstado($vetDados[1]);
            //   $idcidade = $this->pegarIDCidade();
            //$this->vincularEstado_Cidade($idcidade, $idestado);

            $this->alert2();
            //$this->redirect($url);
        } else {
            $this->alert();
            $doc = "<script type='text/javascript'>document.write(a)</script>";
            if ($doc == TRUE) {
                $url = "CadastroCidade.php";
                //        $this->redirect($url);
            } else if ($doc == FALSE) {
                $url = "JanelaPrincipal.php";
                //    $this->redirect($url);
            }
        }
    }

    public function PesquisarTodos($sql) {
        $pdo = Conexao::getInstance();
        $consulta = $pdo->query($sql);
        $vetDados = array();

        while ($linha = $consulta->fetch(PDO::FETCH_BOTH)) {
            $LocalPublicacao = new Localpublicacao();
            $LocalPublicacao->setId($linha['idLocalDePublicacao']);
            $LocalPublicacao->setIdEstado($linha['Estado_idEstado']);
            $LocalPublicacao->setIdCidade($linha['Cidade_idCidade']);


            $vetDados[] = $LocalPublicacao;
        }
        return $vetDados;
    }

    function buscaLocal($codcidade, $codestado) {

        $pdo = Conexao::getInstance();
        $stmt = $pdo->prepare('SELECT idLocalDePublicacao FROM localdepublicacao WHERE Cidade_idCidade=' . $codcidade . ' and Estado_idEstado=' . $codestado.';');
        $stmt->execute();
        foreach ($stmt as $row) {
            return $row['idLocalDePublicacao'];
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

}
