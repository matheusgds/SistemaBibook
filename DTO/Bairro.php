<?php

require_once ".." . DIRECTORY_SEPARATOR . "autoload.php";

class Bairro implements ICrud {

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
            $stmt = $pdo->prepare('update bairro set nome =:novonome where idBairro = :id');
            $stmt2 = $pdo->prepare('commit;');
            $stmt->bindParam(':novonome', $nome, PDO::PARAM_STR);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $stmt2->execute();
        }

        $url = "listarestados.php";
        $this->redirect($url);
    }

    public function Excluir($vetDados) {
        $pdo = Conexao::getInstance();
        $stmt = $pdo->prepare('delete from bairro where idBairro = :id ');
        $stmt2 = $pdo->prepare('commit;');
        $stmt->bindParam(':id', $ide, PDO::PARAM_INT);
        $ide = $vetDados[0];
        $stmt->execute();
        $stmt2->execute();

        $url = "listarbairros.php";
        $this->redirect($url);
    }

    public function Inserir($vetDados) {

        $pdo = Conexao::getInstance();
        $stmt = $pdo->prepare('INSERT INTO bairro (nome) VALUES(:nome)');
        $stmt2 = $pdo->prepare('commit;');
        $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);

        $nome = $vetDados[0];



        $nomeCidade = $vetDados[1];


        if ($this->Existe($nome)) {
            $idBairro = $this->pegarIDBairroCentro($nome);

            $idCidade = $this->pegarIDCidade($nomeCidade);
            $this->vincularCidade_Bairro($idCidade, $idBairro);

            $this->alert3();
        } else {
            $stmt->execute();
            $stmt2->execute();
            $idBairro = $this->pegarIDBairro();

            $idCidade = $this->pegarIDCidade($nomeCidade);
            $this->vincularCidade_Bairro($idCidade, $idBairro);

            $this->alert2();
        }
    }

    function inserir2Semvinculo($vetDados) {
        $pdo = Conexao::getInstance();
        $stmt = $pdo->prepare('INSERT INTO bairro (nome) VALUES(:nome)');
        $stmt2 = $pdo->prepare('commit;');
        $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);

        $nome = $vetDados[0];
        if (!$this->Existe($nome)) {
            $stmt->execute();
            $stmt2->execute();
        }
    }

    public function PesquisarTodos($sql) {
        $pdo = Conexao::getInstance();
        $consulta = $pdo->query($sql);
        $vetDados = array();

        while ($linha = $consulta->fetch(PDO::FETCH_BOTH)) {
            $Bairro = new Bairro();
            $Bairro->setId($linha['idBairro']);
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

    function alert3() {
        echo "<script type='text/javascript'>alert('Objeto Existente Porém, Vinculação Inserida!');</script>";
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

    function pegarIDCidade($sig) {

        $pdo = Conexao::getInstance();

        $stmt = $pdo->prepare("SELECT idCidade FROM cidade WHERE nome='$sig'");
        $stmt->execute();
        foreach ($stmt as $row) {
            return $row['idCidade'];
        }
    }

    function pegarIDBairro() {

        $pdo = Conexao::getInstance(); //select max(idCidade) from cidade;
        $stmt = $pdo->prepare('SELECT max(idBairro) FROM bairro');
        $stmt->execute();

        foreach ($stmt as $row) {
            return $row['max(idBairro)'];
        }
    }

    function pegarIDBairroCentro($nome) {

        $pdo = Conexao::getInstance(); //select max(idCidade) from cidade;
        $stmt = $pdo->prepare("SELECT idBairro FROM bairro where nome= '$nome'");
        $stmt->execute();

        foreach ($stmt as $row) {
            return $row['idBairro'];
        }
    }

    function vincularCidade_Bairro($idCidade, $idBairro) {
        $idCidade = intval($idCidade);
        $idBairro = intval($idBairro);
        $pdo = Conexao::getInstance();

        if (!$this->ExisteEsp($idCidade, $idBairro)) {
            $stmt = $pdo->prepare('INSERT INTO cidade_has_bairro (Cidade_idCidade,Bairro_idBairro) VALUES(:idc,:idb)');
            $stmt->bindParam(':idb', $idBairro, PDO::PARAM_INT);
            $stmt->bindParam(':idc', $idCidade, PDO::PARAM_INT);
            $stmt->execute();
        }
    }

    function retornaNome($valor) {

        $pdo = Conexao::getInstance();
        $sql = "select nome from bairro where idbairro= '$valor' ";
        $consulta = $pdo->query($sql);
        while ($linha = $consulta->fetch(PDO::FETCH_BOTH)) {
            return $linha['nome'];
        }
    }

    function buscaIDpeloNome($valor) {

        $pdo = Conexao::getInstance();
        $sql = "select idBairro from bairro where nome= '$valor' ";
        $consulta = $pdo->query($sql);
        while ($linha = $consulta->fetch(PDO::FETCH_BOTH)) {
            return $linha['idBairro'];
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
        $sql = "select idBairro from bairro where nome= '$valor' ";
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
        $sql = "select * from Cidade_has_Bairro where Cidade_idCidade= '$valor' and Bairro_idBairro= '$valor2'";
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
