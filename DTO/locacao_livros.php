<?php

require_once ".." . DIRECTORY_SEPARATOR . "autoload.php";

class locacao_livros implements ICrud {

    private $idlocacao;
    private $idlivro;

    function getIdlocacao() {
        return $this->idlocacao;
    }

    function getIdlivro() {
        return $this->idlivro;
    }

    function setIdlocacao($idlocacao) {
        $this->idlocacao = $idlocacao;
    }

    function setIdlivro($idlivro) {
        $this->idlivro = $idlivro;
    }

    public function Editar($vetDados) {
        
    }

    public function Excluir($vetDados) {
        $pdo = Conexao::getInstance();
        $stmt = $pdo->prepare('delete from livro_has_locacao where Livro_idLivro = :idlivro and locacao_idlocacao = :idlocacao ');
        $stmt2 = $pdo->prepare('commit;');
        $stmt->bindParam(':idlivro', $idlivro, PDO::PARAM_INT);
        $stmt->bindParam(':idlocacao', $idlocacao, PDO::PARAM_INT);
        $idlivro = $vetDados[0];
        $idlocacao = $vetDados[1];
        $stmt->execute();
        $stmt2->execute();

        $url = "listarlocacoes.php";
        $this->redirect($url);
    }

    public function Existe($vetDados) {
        return false;
    }

    public function Inserir($vetDados) {
        $pdo = Conexao::getInstance();
        $stmt = $pdo->prepare('INSERT INTO livro_has_locacao (Livro_idLivro,locacao_idlocacao) VALUES(:livro,:locacao)');
        $stmt2 = $pdo->prepare('commit;');
        $stmt->bindParam(':livro', $idlivro, PDO::PARAM_INT);
        $stmt->bindParam(':locacao', $idloc, PDO::PARAM_INT);

        $idlivro = $vetDados[0];
        $idloc = $vetDados[1];

        $stmt->execute();
        $stmt2->execute();
    }

    public function PesquisarTodos($sql) {
        $pdo = Conexao::getInstance();
        $consulta = $pdo->query($sql);
        $vetDados = array();

        while ($linha = $consulta->fetch(PDO::FETCH_BOTH)) {
            $Locacao_has_livro = new locacao_livros();
            $Locacao_has_livro->setIdlocacao($linha['locacao_idlocacao']);
            $Locacao_has_livro->setIdlivro($linha['Livro_idLivro']);

            $vetDados[] = $Locacao_has_livro;
        }
        return $vetDados;
    }

}
