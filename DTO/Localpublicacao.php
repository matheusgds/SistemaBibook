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
        $sql = "select * from LocalDePublicacao where idEstado= '$vetDados[0]' and idCidade = '$vetDados[1]'";
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


        $verifica = $pdo->prepare('SELECT * FROM LocalDePublicacao WHERE idEstado = :estado2 and idCidade = :cidade2');
        $verifica->bindParam(':estado2', $idEst, PDO::PARAM_INT);
        $verifica->bindParam(':cidade2', $idCid, PDO::PARAM_INT);
        $verifica->execute();
        $exists = FALSE;
        foreach ($verifica as $row) {
            if (($row['idEstado'] == $idEst) && ($row['idCidade'] == $idCid)) {
                $exists = TRUE;
            }
        }


        if ($exists == FALSE) {
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

}
