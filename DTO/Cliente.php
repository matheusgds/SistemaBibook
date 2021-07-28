<?php

require_once ".." . DIRECTORY_SEPARATOR . "autoload.php";

class Cliente implements ICrud {

    private $id;
    private $nome;
    private $cpf;
    private $rg;
    private $datanasc;
    private $sexo;
    private $situacao;
    private $estado;
    private $cidade;
    private $bairro;
    private $rua;
    private $numeroCasa;
    private $contato;
    private $contaacesso;

    function getId() {
        return $this->id;
    }

    function getNome() {
        return $this->nome;
    }

    function getCpf() {
        return $this->cpf;
    }

    function getRg() {
        return $this->rg;
    }

    function getDatanasc() {
        return $this->datanasc;
    }

    function getSexo() {
        return $this->sexo;
    }

    function getSituacao() {
        return $this->situacao;
    }

    function getEstado() {
        return $this->estado;
    }

    function getCidade() {
        return $this->cidade;
    }

    function getBairro() {
        return $this->bairro;
    }

    function getRua() {
        return $this->rua;
    }

    function getNumeroCasa() {
        return $this->numeroCasa;
    }

    function getContato() {
        return $this->contato;
    }

    function getContaacesso() {
        return $this->contaacesso;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setCpf($cpf) {
        $this->cpf = $cpf;
    }

    function setRg($rg) {
        $this->rg = $rg;
    }

    function setDatanasc($datanasc) {
        $this->datanasc = $datanasc;
    }

    function setSexo($sexo) {
        $this->sexo = $sexo;
    }

    function setSituacao($situacao) {
        $this->situacao = $situacao;
    }

    function setEstado($estado) {
        $this->estado = $estado;
    }

    function setCidade($cidade) {
        $this->cidade = $cidade;
    }

    function setBairro($bairro) {
        $this->bairro = $bairro;
    }

    function setRua($rua) {
        $this->rua = $rua;
    }

    function setNumeroCasa($numeroCasa) {
        $this->numeroCasa = $numeroCasa;
    }

    function setContato($contato) {
        $this->contato = $contato;
    }

    function setContaacesso($contaacesso) {
        $this->contaacesso = $contaacesso;
    }

    public function __toString() {
        return "ID: " . $this->id . "<br/>Nome: " . $this->nome . "<br/>";
    }

    public function Editar($vetDados) {
        
    }

    public function Excluir($vetDados) {
        $pdo = Conexao::getInstance();
        $stmt = $pdo->prepare('delete from cliente where idCliente = :id ');
        $stmt2 = $pdo->prepare('commit;');
        $stmt->bindParam(':id', $ide, PDO::PARAM_INT);
        $ide = $vetDados[0];
        $stmt->execute();
        $stmt2->execute();

        $url = "listarclientes.php";
        $this->redirect($url);
    }

    public function Existe($vetDados) {
        $pdo = Conexao::getInstance();
        $sql = "select idCliente from cliente where cpf= '$valor' ";
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
        $stmt = $pdo->prepare('INSERT INTO cliente (nome,cpf,rg,datanasc,sexo,situacao,Estado_idEstado,Cidade_idCidade,Bairro_idBairro,Rua_idRua,NumeroCasa_idNumeroCasa,Contato_idContato,ContaDeAcesso_idContaDeAcesso) VALUES(:nome,:cpf,:rg,:datanasc,:sexo,:situacao,:estado,:cidade,:bairro,:rua,:numerocasa,:contato,:contadeacesso)');
        $stmt2 = $pdo->prepare('commit;');

        $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
        $stmt->bindParam(':cpf', $cpf, PDO::PARAM_STR);
        $stmt->bindParam(':rg', $rg, PDO::PARAM_STR);
        $stmt->bindParam(':datanasc', $datanasc, PDO::PARAM_STR);
        $stmt->bindParam(':sexo', $sexo, PDO::PARAM_STR);
        $stmt->bindParam(':situacao', $situacao, PDO::PARAM_INT);
        $stmt->bindParam(':estado', $idEstado, PDO::PARAM_INT);
        $stmt->bindParam(':cidade', $idCidade, PDO::PARAM_INT);
        $stmt->bindParam(':bairro', $idBairro, PDO::PARAM_INT);
        $stmt->bindParam(':rua', $idRua, PDO::PARAM_INT);
        $stmt->bindParam(':numerocasa', $idNumeroCasa, PDO::PARAM_INT);
        $stmt->bindParam(':contato', $idContato, PDO::PARAM_INT);
        $stmt->bindParam(':contadeacesso', $idContaAcesso, PDO::PARAM_INT);

        $nome = $vetDados[0];
        $cpf = $vetDados[1];
        $rg = $vetDados[2];
        $datanasc = $vetDados[3];
        $sexo = $vetDados[4];
        $situacao = $vetDados[5];
        $idEstado = $vetDados[6];
        $idCidade = $vetDados[7];
        $idBairro = $vetDados[8];
        $idRua = $vetDados[9];
        $idNumeroCasa = $vetDados[10];
        $idContato = $vetDados[11];
        $idContaAcesso = $vetDados[12];


        $verifica = $pdo->prepare('SELECT * FROM cliente WHERE cpf = :cpf2');
        $verifica->bindParam(':cpf2', $cpf, PDO::PARAM_STR);
        $verifica->execute();
        $exists = FALSE;
        foreach ($verifica as $row) {
            if ($row['cpf'] == $nome) {
                $exists = TRUE;
            }
        }


        if ($exists == FALSE) {
            $stmt->execute();
            $stmt2->execute();
            //mensagem de inserido com sucesso!
            //$url = "listarcidades.php";




            $this->alert2();
            //  $this->redirect($url);
        } else {
            $this->alert();
            $doc = "<script type='text/javascript'>document.write(a)</script>";
            if ($doc == TRUE) {
                $url = "CadastroBiblioteca.php";
                // $this->redirect($url);
            } else if ($doc == FALSE) {
                $url = "JanelaPrincipal.php";
                //   $this->redirect($url);
            }
        }
    }

    public function PesquisarTodos($sql) {
        $pdo = Conexao::getInstance();
        $consulta = $pdo->query($sql);
        $vetDados = array();

        while ($linha = $consulta->fetch(PDO::FETCH_BOTH)) {
            $cli = new Cliente();
            $cli->setId($linha['idCliente']);
            $cli->setNome($linha['nome']);
            $cli->setCpf($linha['cpf']);
            $cli->setRg($linha['rg']);
            $cli->setDatanasc($linha['datanasc']);
            $cli->setSexo($linha['sexo']);
            $cli->setSituacao($linha['situacao']);
            $cli->setEstado($linha['Estado_idEstado']);
            $cli->setCidade($linha['Cidade_idCidade']);
            $cli->setBairro($linha['Bairro_idBairro']);
            $cli->setNumeroCasa($linha['NumeroCasa_idNumeroCasa']);
            $cli->setContato($linha['Contato_idContato']);
            $cli->setContaacesso($linha['ContaDeAcesso_idContaDeAcesso']);

            $vetDados[] = $cli;
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

    function retornaObjeto($valor) {

        $pdo = Conexao::getInstance();
        $sql = "select * from Cliente where idCliente= '$valor' ";
        $consulta = $pdo->query($sql);
        $linha = $consulta->fetch(PDO::FETCH_BOTH);
        return $linha;
    }

}
