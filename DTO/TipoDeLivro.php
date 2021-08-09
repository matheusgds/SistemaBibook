<?php

require_once ".." . DIRECTORY_SEPARATOR . "autoload.php";

class TipoDeLivro implements ICrud {

    private $id;
    private $tipo;
    private $codigotipo;

    function getId() {
        return $this->id;
    }

    function getTipo() {
        return $this->tipo;
    }

    function getCodigotipo() {
        return $this->codigotipo;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setTipo($tipo) {
        $this->tipo = $tipo;
    }

    function setCodigotipo($codigotipo) {
        $this->codigotipo = $codigotipo;
    }

    public function __toString() {
        return "ID: " . $this->id . "<br/>Tipo De Livro: " . $this->tipo . "<br/>Codigo do Tipo: " . $this->codigotipo . "<br/>";
    }

    public function Editar($vetDados) {
        $id = $vetDados[0];
        $tipo = $vetDados[1];
        $codigotipo = $vetDados[2];

        $nome2 = $this->retornaNome($id);

        if (!$this->comparacao($nome, $nome2)) {
            $pdo = Conexao::getInstance();
            $stmt = $pdo->prepare('update TipoDeLivro set tipo =:novotipo where idTipoDeLivro = :id');
            $stmt2 = $pdo->prepare('update TipoDeLivro set codigotipo =:novocodigo where idTipoDeLivro = :id');
            $stmt3 = $pdo->prepare('commit;');
            $stmt->bindParam(':novocodigo', $codigotipo, PDO::PARAM_STR);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $stmt2->execute();
            $stmt3->execute();
        }

        $url = "listartiposdelivro.php";
        $this->redirect($url);
    }

    public function Excluir($vetDados) {
        $pdo = Conexao::getInstance();
        $stmt = $pdo->prepare('delete from TipoDeLivro where idTipoDeLivro = :id ');
        $stmt2 = $pdo->prepare('commit;');
        $stmt->bindParam(':id', $ida, PDO::PARAM_INT);
        $ida = $vetDados[0];
        $stmt->execute();
        $stmt2->execute();

        $url = "listartiposdelivro.php";
        $this->redirect($url);
    }

    public function Existe($valor) {
        $pdo = Conexao::getInstance();
        $sql = "select idTipoDeLivro from TipoDeLivro where tipo= '$valor' ";
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
        $stmt = $pdo->prepare('INSERT INTO TipoDeLivro (tipo,codigo) VALUES(:tipo,:codigo)');
        $stmt2 = $pdo->prepare('commit;');
        $stmt->bindParam(':tipo', $tipo, PDO::PARAM_STR);
        $stmt->bindParam(':codigo', $codigo, PDO::PARAM_STR);

        $tipo = $vetDados[0];
        $codigo = $vetDados[1];

        $verifica = $pdo->prepare('SELECT * FROM TipoDeLivro WHERE tipo = :tipo2');
        $verifica->bindParam(':tipo2', $tipo, PDO::PARAM_STR);
        $verifica->execute();
        $exists = FALSE;
        foreach ($verifica as $row) {
            if ($row['tipo'] == $tipo) {
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
            $TipoDeLivro = new TipoDeLivro();
            $TipoDeLivro->setId($linha['idTipoDeLivro']);
            $TipoDeLivro->setTipo($linha['tipo']);
            $TipoDeLivro->setCodigotipo($linha['codigo']);

            $vetDados[] = $TipoDeLivro;
        }
        return $vetDados;
    }
    
    function buscaTipoDeLivro($tipagem) {
        $nomebusca = "'".$tipagem."'";
        $pdo = Conexao::getInstance();
      
        $stmt = $pdo->prepare('SELECT idTipoDeLivro FROM tipodelivro WHERE tipo=' . $nomebusca);
        $stmt->execute();
        foreach ($stmt as $row) {
            return $row['idTipoDeLivro'];
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
