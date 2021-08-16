<?php

require_once ".." . DIRECTORY_SEPARATOR . "autoload.php";

class Cidade implements ICrud {

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

    //put your code here
    public function Editar($vetDados) {
        $id = $vetDados[0];
        $nome = $vetDados[1];

        $nome2 = $this->retornaNome($id);

        if (!$this->comparacao($nome, $nome2)) {
            $pdo = Conexao::getInstance();
            $stmt = $pdo->prepare('update cidade set nome =:novonome where idCidade = :id');
            $stmt2 = $pdo->prepare('commit;');
            $stmt->bindParam(':novonome', $nome, PDO::PARAM_STR);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $stmt2->execute();
        }

        $url = ".." . DIRECTORY_SEPARATOR . "InterfaceGrafica" . DIRECTORY_SEPARATOR . "listarcidades.php";
        $this->redirectPHP($url);
    }

    public function Excluir($vetDados) {
        $pdo = Conexao::getInstance();
        $stmt = $pdo->prepare('delete from cidade where idCidade = :id ');
        $stmt2 = $pdo->prepare('commit;');
        $stmt->bindParam(':id', $ide, PDO::PARAM_INT);
        $ide = $vetDados[0];
        $stmt->execute();
        $stmt2->execute();

        $url = ".." . DIRECTORY_SEPARATOR . "InterfaceGrafica" . DIRECTORY_SEPARATOR . "listarcidades.php";
        $this->redirectPHP($url);
    }

    public function Inserir($vetDados) {
        $pdo = Conexao::getInstance();
        $stmt = $pdo->prepare('INSERT INTO cidade (nome) VALUES(:nome)');
        $stmt2 = $pdo->prepare('commit;');
        $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);

        $nome = $vetDados[0];

        //se ainda nao existe o vinculo agente adiciona


        $verifica = $pdo->prepare('SELECT * FROM cidade WHERE nome = :nome2');
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

            //passar nome e busca id
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
            $cit = new Cidade();
            $cit->setId($linha['idCidade']);
            $cit->setNome($linha['nome']);

            $vetDados[] = $cit;
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

    function retornarEstados() {
        $pdo = Conexao::getInstance();
        $stmt = $pdo->prepare('SELECT sigla FROM estado');
        $stmt->execute();

        return $stmt;
    }

    function pegarIDEstado($sig) {

        $pdo = Conexao::getInstance();
        $sig = substr_replace($sig, '"', 0, 0);
        $sig = $sig . '"';

        $stmt = $pdo->prepare('SELECT idEstado FROM estado WHERE sigla=' . $sig);
        $stmt->execute();
        foreach ($stmt as $row) {
            return $row['idEstado'];
        }
    }

    function pegarIDCidade() {

        $pdo = Conexao::getInstance(); //select max(idCidade) from cidade;
        $stmt = $pdo->prepare('SELECT max(idCidade) FROM cidade');
        $stmt->execute();

        foreach ($stmt as $row) {
            return $row['max(idCidade)'];
        }
    }

    function vincularEstado_Cidade($idcidade, $idestado) {
        $idcidade = intval($idcidade);
        $idestado = intval($idestado);
        $pdo = Conexao::getInstance();


        // nome?
        if (!$this->ExisteEsp($idestado, $idcidade)) {
            $stmt = $pdo->prepare('INSERT INTO estado_has_cidade (Estado_idEstado,Cidade_idCidade) VALUES(:ide,:idc)');
            $stmt->bindParam(':ide', $idestado, PDO::PARAM_INT);
            $stmt->bindParam(':idc', $idcidade, PDO::PARAM_INT);
            $stmt->execute();
        }
    }

    function retornaNome($valor) {

        $pdo = Conexao::getInstance();
        $sql = "select nome from cidade where idCidade= '$valor' ";
        $consulta = $pdo->query($sql);
        while ($linha = $consulta->fetch(PDO::FETCH_BOTH)) {
            return $linha['nome'];
        }
    }

    function buscaIDpeloNome($valor) {

        $pdo = Conexao::getInstance();
        $sql = "select idCidade from cidade where nome= '$valor' ";
        $consulta = $pdo->query($sql);
        while ($linha = $consulta->fetch(PDO::FETCH_BOTH)) {
            return $linha['idCidade'];
        }
    }

    function comparacao($valor1, $valor2) {
        if ($valor1 == $valor2) {
            return true;
        } else {
            return false;
        }
    }

    public function retornaMaxID() {
        $pdo = Conexao::getInstance(); //select max(idCidade) from cidade;
        $stmt = $pdo->prepare('select max(idCidade) from cidade');
        $stmt->execute();

        foreach ($stmt as $row) {
            return $row['max(idCidade)'];
        }
    }

    public function ExisteEsp($valor, $valor2) {
        $pdo = Conexao::getInstance();
        $sql = "select * from Estado_has_Cidade where Estado_idEstado= '$valor' and Cidade_idCidade= '$valor2'";
        $consulta = $pdo->query($sql);

        while ($linha = $consulta->fetch(PDO::FETCH_BOTH)) {
            if (empty($linha)) {
                return FALSE;
            } else {
                return TRUE;
            }
        }
    }

    public function Existe($valor) {
        $pdo = Conexao::getInstance();
        $sql = "select idCidade from cidade where nome= '$valor' ";
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
