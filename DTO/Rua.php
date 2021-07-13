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

        $url = "listarruas.php";
        $this->redirect($url);
    }

    public function Excluir($vetDados) {
        $pdo = Conexao::getInstance();
        $stmt = $pdo->prepare('delete from rua where idRua = :id ');
        $stmt2 = $pdo->prepare('commit;');
        $stmt->bindParam(':id', $ide, PDO::PARAM_INT);
        $ide = $vetDados[0];
        $stmt->execute();
        $stmt2->execute();

        $url = "listarruas.php";
        $this->redirect($url);
    }

    public function Inserir($vetDados) {

        $pdo = Conexao::getInstance();
        $stmt = $pdo->prepare('INSERT INTO rua (nome) VALUES(:nome)');
        $stmt2 = $pdo->prepare('commit;');
        $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);

        $nome = $vetDados[0];

        $verifica = $pdo->prepare('SELECT * FROM rua WHERE nome = :nome2');
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
            $url = "listarruas.php";

            //$idBairro = $this->pegarIDBairro($vetDados[1]);
            //$idRua = $this->pegarIDRua();
            // $this->vincularRua_Bairro($idRua, $idBairro);

            $this->alert2();
            // $this->redirect($url);
            //header("location:listarestados.php");
        } else {
            //mensagem de confirmação
            $this->alert();
            $doc = "<script type='text/javascript'>document.write(a)</script>";
            if ($doc == TRUE) {
                $url = "CadastroRua.php";
                //  redirect($url);
            } else if ($doc == FALSE) {
                $url = "JanelaPrincipal.php";
                //   redirect($url);
            }
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

    function pegarIDBairro($sig) {

        $pdo = Conexao::getInstance();
        $sig = substr_replace($sig, '"', 0, 0);
        $sig = $sig . '"';

        $stmt = $pdo->prepare('SELECT idBairro FROM bairro WHERE nome=' . $sig);
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
