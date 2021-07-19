<?php

require_once ".." . DIRECTORY_SEPARATOR . "autoload.php";

class livro_autor implements ICrud {

    private $idautor;
    private $idlivro;

    function getIdautor() {
        return $this->idautor;
    }

    function getIdlivro() {
        return $this->idlivro;
    }

    function setIdautor($idautor) {
        $this->idautor = $idautor;
    }

    function setIdlivro($idlivro) {
        $this->idlivro = $idlivro;
    }

    public function Editar($vetDados) {
        
    }

    public function Excluir($vetDados) {
        
    }

    public function Existe($vetDados) {
        return false;
    }

    public function Inserir($vetDados) {
        $pdo = Conexao::getInstance();
        $stmt = $pdo->prepare('INSERT INTO Livro_has_Autor (Livro_idLivro,Autor_idAutor) VALUES(:livro,:autor)');
        $stmt2 = $pdo->prepare('commit;');
        $stmt->bindParam(':livro', $idlivro, PDO::PARAM_INT);
        $stmt->bindParam(':autor', $idautor, PDO::PARAM_INT);

        $idlivro = $vetDados[0];
        $idautor = $vetDados[1];

        $stmt->execute();
        $stmt2->execute();
    }

    public function PesquisarTodos($sql) {
        $pdo = Conexao::getInstance();
        $consulta = $pdo->query($sql);
        $vetDados = array();

        while ($linha = $consulta->fetch(PDO::FETCH_BOTH)) {
            $Livro_has_autor = new livro_autor();
            $Livro_has_autor->setIdautor($linha['Autor_idAutor']);
            $Livro_has_autor->setIdlivro($linha['Livro_idLivro']);

            $vetDados[] = $Livro_has_autor;
        }
        return $vetDados;
    }

}
