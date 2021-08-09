<?php

require_once ".." . DIRECTORY_SEPARATOR . "autoload.php";

class Anopublicacao implements ICrud {

    private $id;
    private $Ano;

    function getId() {
        return $this->id;
    }

    function getAno() {
        return $this->Ano;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setAno($Ano) {
        $this->Ano = $Ano;
    }

    public function __toString() {
        return "ID: " . $this->id . "<br/>Ano: " . $this->Ano . "<br/>";
    }

    public function Editar($vetDados) {
        
    }

    public function Excluir($vetDados) {
        
    }

    public function Existe($valor) {
        $pdo = Conexao::getInstance();
        $sql = "select idAnoDePublicacao from AnoDePublicacao where ano= '$valor' ";
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
        $stmt = $pdo->prepare('INSERT INTO AnoDePublicacao (ano) VALUES(:ano)');
        $stmt2 = $pdo->prepare('commit;');
        $stmt->bindParam(':ano', $ano, PDO::PARAM_INT);

        $ano = $vetDados[0];

        $verifica = $pdo->prepare('SELECT * FROM AnoDePublicacao WHERE ano = :ano2');
        $verifica->bindParam(':ano2', $ano, PDO::PARAM_INT);
        $verifica->execute();
        $exists = FALSE;
        foreach ($verifica as $row) {
            if ($row['ano'] == $ano) {
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
            $AnoDePublicacao = new Anopublicacao();
            $AnoDePublicacao->setId($linha['idAnoDePublicacao']);
            $AnoDePublicacao->setAno($linha['ano']);

            $vetDados[] = $Edicao;
        }
        return $vetDados;
    }
    
    
    public function buscaAno($ano){
        $pdo = Conexao::getInstance();
       
        $stmt = $pdo->prepare('SELECT idAnoDePublicacao FROM anodepublicacao WHERE ano=' . $ano);
        $stmt->execute();
        foreach ($stmt as $row) {
            return $row['idAnoDePublicacao'];
        }
    }

}
