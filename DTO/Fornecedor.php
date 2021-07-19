<?php

require_once ".." . DIRECTORY_SEPARATOR . "autoload.php";

class Fornecedor implements ICrud {

    private $id;
    private $nome;
    private $estado;
    private $cidade;
    private $bairro;
    private $rua;
    private $numeroCasa;
    private $contato;

    function getId() {
        return $this->id;
    }

    function getNome() {
        return $this->nome;
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

    function setId($id) {
        $this->id = $id;
    }

    function setNome($nome) {
        $this->nome = $nome;
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

    public function Editar($vetDados) {
        
    }

    public function Excluir($vetDados) {
        
    }

    public function Existe($valor) {
        $pdo = Conexao::getInstance();
        $sql = "select idFornecedor from Fornecedor where nome= '$valor' ";
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
        $stmt = $pdo->prepare('INSERT INTO Fornecedor (nome,Estado_idEstado,Cidade_idCidade,Bairro_idBairro,Rua_idRua,NumeroCasa_idNumeroCasa,Contato_idContato) VALUES(:nome,:estado,:cidade,:bairro,:rua,:numerocasa,:contato)');
        $stmt2 = $pdo->prepare('commit;');
        $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
        $stmt->bindParam(':estado', $idEstado, PDO::PARAM_INT);
        $stmt->bindParam(':cidade', $idCidade, PDO::PARAM_INT);
        $stmt->bindParam(':bairro', $idBairro, PDO::PARAM_INT);
        $stmt->bindParam(':rua', $idRua, PDO::PARAM_INT);
        $stmt->bindParam(':numerocasa', $idNumeroCasa, PDO::PARAM_INT);
        $stmt->bindParam(':contato', $idContato, PDO::PARAM_INT);

        $nome = $vetDados[0];
        $idEstado = $vetDados[1];
        $idCidade = $vetDados[2];
        $idBairro = $vetDados[3];
        $idRua = $vetDados[4];
        $idNumeroCasa = $vetDados[5];
        $idContato = $vetDados[6];


        $verifica = $pdo->prepare('SELECT * FROM Fornecedor WHERE nome = :nome2');
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
            $Fornecedor = new Fornecedor();
            $Fornecedor->setId($linha['idFornecedor']);
            $Fornecedor->setNome($linha['nome']);
            $Fornecedor->setEstado($linha['Estado_idEstado']);
            $Fornecedor->setCidade($linha['Cidade_idCidade']);
            $Fornecedor->setBairro($linha['Bairro_idBairro']);
            $Fornecedor->setNumeroCasa($linha['NumeroCasa_idNumeroCasa']);
            $Fornecedor->setContato($linha['Contato_idContato']);

            $vetDados[] = $Fornecedor;
        }
        return $vetDados;
    }

}
