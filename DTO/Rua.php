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
        
    }

    public function Excluir($vetDados) {
        
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

asdasdas
            $idestado = $this->pegarIDEstado($vetDados[1]);

            $idcidade = $this->pegarIDCidade();

            $this->vincularEstado_Cidade($idcidade, $idestado);

            alert2();
            redirect($url);
            //header("location:listarestados.php");
        } else {
            //mensagem de confirmação
            alert();
            $doc = "<script type='text/javascript'>document.write(a)</script>";
            if ($doc == TRUE) {
                $url = "CadastroRua.php";
                redirect($url);
            } else if ($doc == FALSE) {
                $url = "JanelaPrincipal.php";
                redirect($url);
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
    
     function pegarIDBairro($sig) {

        $pdo = Conexao::getInstance();
        $sig = substr_replace($sig, '"', 0, 0);
        $sig = $sig . '"';

        $stmt = $pdo->prepare('SELECT idBairro FROM bairro WHERE nome=' . $sig);
        $stmt->execute();
        foreach ($stmt as $row) {
            return $row['idEstado'];
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

    function vincularEstado_Cidade($idcidade, $idestado) {
        $idcidade = intval($idcidade);
        $idestado = intval($idestado);


        $pdo = Conexao::getInstance();
        $stmt = $pdo->prepare('INSERT INTO estado_has_cidade (Estado_idEstado,Cidade_idCidade) VALUES(:ide,:idc)');
        $stmt->bindParam(':ide', $idestado, PDO::PARAM_INT);
        $stmt->bindParam(':idc', $idcidade, PDO::PARAM_INT);
        $stmt->execute();
    }

}
