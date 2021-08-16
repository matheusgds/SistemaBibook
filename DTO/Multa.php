<?php

require_once ".." . DIRECTORY_SEPARATOR . "autoload.php";

class Multa implements ICrud {

    private $id;
    private $valor;
    private $status;
    private $idlocacao;

    function getId() {
        return $this->id;
    }

    function getValor() {
        return $this->valor;
    }

    function getStatus() {
        return $this->status;
    }

    function getIdlocacao() {
        return $this->idlocacao;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setValor($valor) {
        $this->valor = $valor;
    }

    function setStatus($status) {
        $this->status = $status;
    }

    function setIdlocacao($idlocacao) {
        $this->idlocacao = $idlocacao;
    }

    public function __toString() {
        return "ID: " . $this->id . "<br/>Nome: " . $this->nome . "<br/>";
    }

    public function Editar($vetDados) {
        $id = $vetDados[0];
        $status = $vetDados[1];
        
        $pdo = Conexao::getInstance();
        $stmt = $pdo->prepare('update Multa set status =:novostatus where idMulta = :id');
        $stmt2 = $pdo->prepare('commit;');
        $stmt->bindParam(':novostatus', $status, PDO::PARAM_INT);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $stmt2->execute();


        $url = ".." . DIRECTORY_SEPARATOR . "InterfaceGrafica" . DIRECTORY_SEPARATOR . "listarmultas.php";
        $this->redirectPHP($url);
    }

    public function Excluir($vetDados) {
        
    }

    public function Existe($vetDados) {
        return false;
    }

    public function Inserir($vetDados) {
        $pdo = Conexao::getInstance();
        $stmt = $pdo->prepare('INSERT INTO Multa (valor,status,locacao_idlocacao) VALUES(:valor,:status,:idlocacao)');
        $stmt2 = $pdo->prepare('commit;');
        $stmt->bindParam(':valor', $valor, PDO::PARAM_STR);
        $stmt->bindParam(':status', $status, PDO::PARAM_INT);
        $stmt->bindParam(':idlocacao', $idlocacao, PDO::PARAM_INT);

        $valor = $vetDados[0];
        $status = 1; // tem multa,  e 0 pra nao tem multa
        $idlocacao = $vetDados[1];


        $exists = FALSE;


        if ($exists == FALSE) {
            $stmt->execute();
            $stmt2->execute();
            //mensagem de inserido com sucesso!
            $url = "listarcidades.php";


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
            $multa = new Multa();
            $multa->setId($linha['idMulta']);
            $multa->setValor($linha['valor']);
            $multa->setStatus($linha['status']);
            $multa->setIdlocacao($linha['locacao_idlocacao']);

            $vetDados[] = $multa;
        }
        return $vetDados;
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
}
