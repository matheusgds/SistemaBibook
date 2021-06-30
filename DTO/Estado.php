<?php

require_once "../autoload.php";

class Estado implements ICrud {

    private $id;
    private $nome;
    private $sigla;

    function getId() {
        return $this->id;
    }

    function getNome() {
        return $this->nome;
    }

    function getSigla() {
        return $this->sigla;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setSigla($sigla) {
        $this->sigla = $sigla;
    }

    public function __toString() {
        return "ID: " . $this->id . "<br/>Nome: " . $this->nome . "<br/>Sigla: " . $this->sigla;
    }

    public function Editar($vetDados) {
        
        $id = $vetDados[0];
        $nome = $vetDados[1];
        $sigla = $vetDados[2];
        
        $nome2 = $this->retornaNome($id);
        $sigla2 = $this->retornaSigla($id);


        if (!comparacao($nome, $nome2)) {
            $pdo = Conexao::getInstance();
            $stmt = $pdo->prepare('update estado set nome =:novonome where idEstado = :id');
            $stmt2 = $pdo->prepare('commit;');
            $stmt->bindParam(':novonome', $nome, PDO::PARAM_STR);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $stmt2->execute();
        }

        if (!comparacao($sigla, $sigla2)) {
            $pdo = Conexao::getInstance();
            $stmt = $pdo->prepare('update estado set sigla =:novosigla where idEstado = :id');
            $stmt2 = $pdo->prepare('commit;');
            $stmt->bindParam(':novosigla', $sigla, PDO::PARAM_STR);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $stmt2->execute();
        }

        $url = "listarestados.php";
        redirect($url);
    }

    public function Excluir() {
        
    }

    public function Inserir($vetDados) {
        $pdo = Conexao::getInstance();
        $stmt = $pdo->prepare('INSERT INTO estado (nome,sigla) VALUES(:nome,:sigla)');
        $stmt2 = $pdo->prepare('commit;');
        $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
        $stmt->bindParam(':sigla', $sigla, PDO::PARAM_STR);

        $nome = $vetDados[0];
        $sigla = $vetDados[1];

        //verificar se já nao existe.
        $verifica = $pdo->prepare('SELECT * FROM Estado WHERE nome = :nome2');
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
            $url = "listarestados.php";
            $this->alert2();
            $this->redirect($url);
        } else {
            //mensagem de confirmação
            $this->alert();
            $doc = "<script type='text/javascript'>document.write(a)</script>";
            if ($doc == TRUE) {
                $url = "CadastroEstado.php";
                $this->redirect($url);
            } else if ($doc == FALSE) {
                $url = "JanelaPrincipal.php";
                $this->redirect($url);
            }
        }
    }

    public function PesquisarTodos() {
        
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

    function comparacao($valor1, $valor2) {
        if ($valor1 == $valor2) {
            return true;
        } else {
            return false;
        }
    }

    function retornaNome($valor) {
   
        $pdo = Conexao::getInstance();
        $sql = "select nome from estado where idEstado= '$valor' ";
        $consulta = $pdo->query($sql);
        while ($linha = $consulta->fetch(PDO::FETCH_BOTH)) {
            return $linha['nome'];
        }
    }

    function retornaSigla($valor) {
   
        $pdo = Conexao::getInstance();
        $sql = "select sigla from estado where idEstado= '$valor' ";
        $consulta = $pdo->query($sql);
        while ($linha = $consulta->fetch(PDO::FETCH_BOTH)) {
            return $linha['sigla'];
        }
    }

}
