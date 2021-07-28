<?php

require_once ".." . DIRECTORY_SEPARATOR . "autoload.php";

class Edicao implements ICrud {

    private $id;
    private $nedicao;

    function getId() {
        return $this->id;
    }

    function getNedicao() {
        return $this->nedicao;
    }

        function setId($id) {
        $this->id = $id;
    }

    function setNedicao($nedicao) {
        $this->nedicao = $nedicao;
    }

    
    public function __toString() {
        return "ID: " . $this->id . "<br/>NEdição: " . $this->nedicao . "<br/>";
    }

    public function Editar($vetDados) {
        
    }

    public function Excluir($vetDados) {
        
    }

    public function Existe($vetDados) {
        $pdo = Conexao::getInstance();
        $sql = "select idEdicao from Edicao where nedicao= '$valor' ";
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
        $stmt = $pdo->prepare('INSERT INTO Edicao (nedicao) VALUES(:numero)');
        $stmt2 = $pdo->prepare('commit;');
        $stmt->bindParam(':numero', $numero, PDO::PARAM_INT);

        $numero = $vetDados[0];

        $verifica = $pdo->prepare('SELECT * FROM Edicao WHERE nedicao = :nedicao2');
        $verifica->bindParam(':nedicao2', $numero, PDO::PARAM_INT);
        $verifica->execute();
        $exists = FALSE;
        foreach ($verifica as $row) {
            if ($row['nedicao'] == $nome) {
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
            $Edicao = new Edicao();
            $Edicao->setId($linha['idEdicao']);
            $Edicao->setNedicao($linha['nedicao']);

            $vetDados[] = $Edicao;
        }
        return $vetDados;
    }

}
