<?php

require_once ".." . DIRECTORY_SEPARATOR . "autoload.php";

class Livro implements ICrud {

    private $id;
    private $nome;
    private $subtitulo;
    private $isbn;
    private $quantidade;
    private $idlocalpublicacao;
    private $ideditora;
    private $idedicao;
    private $idanopublicacao;
    private $idtipolivro;

    function getId() {
        return $this->id;
    }

    function getNome() {
        return $this->nome;
    }

    function getSubtitulo() {
        return $this->subtitulo;
    }

    function getIsbn() {
        return $this->isbn;
    }

    function getIdlocalpublicacao() {
        return $this->idlocalpublicacao;
    }

    function getIdeditora() {
        return $this->ideditora;
    }

    function getIdedicao() {
        return $this->idedicao;
    }

    function getIdanopublicacao() {
        return $this->idanopublicacao;
    }

    function getIdtipolivro() {
        return $this->idtipolivro;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setSubtitulo($subtitulo) {
        $this->subtitulo = $subtitulo;
    }

    function setIsbn($isbn) {
        $this->isbn = $isbn;
    }

    function setIdlocalpublicacao($idlocalpublicacao) {
        $this->idlocalpublicacao = $idlocalpublicacao;
    }

    function setIdeditora($ideditora) {
        $this->ideditora = $ideditora;
    }

    function setIdedicao($idedicao) {
        $this->idedicao = $idedicao;
    }

    function setIdanopublicacao($idanopublicacao) {
        $this->idanopublicacao = $idanopublicacao;
    }

    function setIdtipolivro($idtipolivro) {
        $this->idtipolivro = $idtipolivro;
    }
    
    function getQuantidade() {
        return $this->quantidade;
    }

    function setQuantidade($quantidade) {
        $this->quantidade = $quantidade;
    }

    
    public function __toString() {
        return "ID: " . $this->id . "<br/>Nome: " . $this->nome . "<br/>";
    }

    public function Editar($vetDados) {
        
    }

    public function Excluir($vetDados) {
        
    }

    public function Existe($valor) {
        $pdo = Conexao::getInstance();
        $sql = "select idLivro from Livro where isbn= '$valor' ";
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
        $stmt = $pdo->prepare('INSERT INTO Livro (nome,subtitulo,isbn,quantidade,LocalDePublicacao_idLocalDePublicacao,Editora_idEditora,Edicao_idEdicao,AnoDePublicacao_idAnoDePublicacao,TipoDeLivro_idTipoDeLivro) VALUES(:nome,:subtitulo,:isbn,:qtnd,:idlocal,:ideditora,:idedicao,:idanopublicacao,:idtipodelivro)');
        $stmt2 = $pdo->prepare('commit;');
        $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
        $stmt->bindParam(':subtitulo', $subtitulo, PDO::PARAM_STR);
        $stmt->bindParam(':isbn', $isbn, PDO::PARAM_STR);
        $stmt->bindParam(':qtnd', $qtnd, PDO::PARAM_INT);
        $stmt->bindParam(':idlocal', $idlocal, PDO::PARAM_INT);
        $stmt->bindParam(':ideditora', $ideditora, PDO::PARAM_INT);
        $stmt->bindParam(':idedicao', $idedicao, PDO::PARAM_INT);
        $stmt->bindParam(':idanopublicacao', $idano, PDO::PARAM_INT);
        $stmt->bindParam(':idtipodelivro', $idtipo, PDO::PARAM_INT);

        $nome = $vetDados[0];
        $subtitulo = $vetDados[1];
        $isbn = $vetDados[2];
        $qtnd=$vetDados[3];
        $idlocal = $vetDados[4];
        $ideditora = $vetDados[5];
        $idedicao = $vetDados[6];
        $idano = $vetDados[7];
        $idtipo = $vetDados[8];


        $verifica = $pdo->prepare('SELECT * FROM Livro WHERE nome = :nome2');
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
            $Livro = new Livro();
            $Livro->setId($linha['idLivro']);
            $Livro->setNome($linha['nome']);
            $Livro->setSubtitulo($linha['subtitulo']);
            $Livro->setIsbn($linha['isbn']);
            $Livro->setQuantidade($linha['quantidade']);
            $Livro->setIdlocalpublicacao($linha['LocalDePublicacao_idLocalDePublicacao']);
            $Livro->setIdeditora($linha['Editora_idEditora']);
            $Livro->setIdedicao($linha['Edicao_idEdicao']);
            $Livro->setIdanopublicacao($linha['AnoDePublicacao_idAnoDePublicacao']);
            $Livro->setIdtipolivro($linha['TipoDeLivro_idTipoDeLivro']);
            

            $vetDados[] = $Livro;
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
    
     function buscanome($nome) {

        $nomebusca = "'".$nome."'";
        $pdo = Conexao::getInstance();
       
        $stmt = $pdo->prepare('SELECT idLivro FROM Livro WHERE nome=' . $nomebusca);
        $stmt->execute();
        foreach ($stmt as $row) {
            return $row['idLivro'];
        }
    }

}
