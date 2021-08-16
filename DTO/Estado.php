<?php

//require_once ".." . DIRECTORY_SEPARATOR . "confs" . DIRECTORY_SEPARATOR . "Conexao.php";
//include_once(".." . DIRECTORY_SEPARATOR . "confs" . DIRECTORY_SEPARATOR . "inc.php");
//require_once ".." . DIRECTORY_SEPARATOR . "Interface" . DIRECTORY_SEPARATOR . "ICrud.php";

require_once ".." . DIRECTORY_SEPARATOR . "autoload.php";

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


        if (!$this->comparacao($nome, $nome2)) {
            $pdo = Conexao::getInstance();
            $stmt = $pdo->prepare('update estado set nome =:novonome where idEstado = :id');
            $stmt2 = $pdo->prepare('commit;');
            $stmt->bindParam(':novonome', $nome, PDO::PARAM_STR);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $stmt2->execute();
        }

        if (!$this->comparacao($sigla, $sigla2)) {
            $pdo = Conexao::getInstance();
            $stmt = $pdo->prepare('update estado set sigla =:novosigla where idEstado = :id');
            $stmt2 = $pdo->prepare('commit;');
            $stmt->bindParam(':novosigla', $sigla, PDO::PARAM_STR);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $stmt2->execute();
        }

        $url = ".." . DIRECTORY_SEPARATOR . "InterfaceGrafica" . DIRECTORY_SEPARATOR . "listarestados.php";
        $this->redirectPHP($url);
    }

    public function Excluir($vetDados) {
        $pdo = Conexao::getInstance();
        $stmt = $pdo->prepare('delete from estado where idEstado = :id ');
        $stmt2 = $pdo->prepare('commit;');
        $stmt->bindParam(':id', $ide, PDO::PARAM_INT);
        $ide = $vetDados[0];
        $stmt->execute();
        $stmt2->execute();

        $url = ".." . DIRECTORY_SEPARATOR . "InterfaceGrafica" . DIRECTORY_SEPARATOR . "listarestados.php";
        $this->redirectPHP($url);
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
            //  $this->redirect($url);
        } else {
            //mensagem de confirmação
            $this->alert();
            $doc = "<script type='text/javascript'>document.write(a)</script>";
            if ($doc == TRUE) {
              
                $url = "..".DIRECTORY_SEPARATOR."InterfaceGrafica".DIRECTORY_SEPARATOR."CadastroEstado.php";
                //    $this->redirect($url);
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
            $est = new Estado();
            $est->setId($linha['idEstado']);
            $est->setNome($linha['nome']);
            $est->setSigla($linha['sigla']);
            $vetDados[] = $est;
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

    function redirectExtra($url) {
        echo "<HTML>\n";
        echo "<HEAD>\n";
        echo "<TITLE></TITLE>\n";
        echo "<?php header('location:$url'); ?>";
        echo "</HEAD>\n";
        echo "<BODY>\n";
        echo "</BODY>\n";
        echo "</HTML>\n";
    }

    function redirectTest($url) {
        echo '<meta http-equiv="refresh" content="0;url=$url">';
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

    function buscaSigla($valor) {

        $pdo = Conexao::getInstance();
        $sql = "select idEstado from estado where sigla= '$valor' ";
        $consulta = $pdo->query($sql);
        while ($linha = $consulta->fetch(PDO::FETCH_BOTH)) {
            return $linha['idEstado'];
        }
    }

    public function Existe($valor) {
        $pdo = Conexao::getInstance();
        $sql = "select idEstado from estado where sigla= '$valor' ";
        $consulta = $pdo->query($sql);

        while ($linha = $consulta->fetch(PDO::FETCH_BOTH)) {
            if (empty($linha)) {
                return FALSE;
            } else {
                return TRUE;
            }
        }
    }

    public function RelatEstadosPDF() {

//Ligar o buffer de sa�da evitando erros de espa�os e print
        ob_start();

//incluindo o arquivo do fpdf
        require_once("../relatorios/fpdf.php");
        include '../confs/Conexao.php';


//include 'utilSys.php';
#####  DEFINI��ES GERAIS #####
//defininfo a fonte !
        define('FPDF_FONTPATH', '../relatorios/font/');
//instancia a classe.. P=Retrato, mm =tipo de medida utilizada no casso milimetros, tipo de folha =A4
        $pdf = new FPDF("P", "mm", "A4");
//define a fonte a ser usada

        $pdf->SetFont('arial', '', 10);
//define o titulo
        $pdf->SetTitle("Sistema de Locação Bibook", true);
//assunto
        $pdf->SetSubject("Sistema de Locação Bibook - Relatório Todos os Estados", true);
###### FIM DAS DEFINI��ES GERAIS #######
####            CABE�ALHO                        ####
// posicao vertical no caso -1.. e o limite da margem
        $pdf->SetY("-1");
        $titulo = "Sistema de Locação Bibook - Relatório Todos os Estados";

//escreve no pdf largura,altura,conteudo,borda,quebra de linha,alinhamento
        $pdf->Cell(0, 5, $titulo, 0, 0, 'L');
        $pdf->Cell(0, 0, '', 1, 1, 'L');
        $pdf->Ln(8);
####            FIM DO CABE�ALHO                  ####
### T�TULO DA P�GINA DENTRO DO PDF ###
//hora do conteudo do artigo
        $pdf->SetFont('arial', '', 22);
        $novo = "                   Relatório de Todos Os Estados             ";
//posiciona verticalmente 21mm
        $pdf->SetY("27");
//posiciona horizontalmente 30mm
        $pdf->SetX("30");
//escreve o conteudo de novo.. parametros posicao inicial,altura,conteudo(*texto),borda,quebra de linha,alinhamento
        $pdf->Write(5, $novo);
//posiciona verticalmente 41mm
        $pdf->SetY("41");
//posiciona horizontalmente 10mm
        $pdf->SetX("10");
//endereco da imagem,posicao X(horizontal),posicao Y(vertical), tamanho altura, tamanho largura
        $pdf->Image("../IMG/livro32x32j.jpg", 11, 20, 20, 20);
#### FIM T�TULO DA P�GINA DENTRO DO PDF ####
#### CONTE�DO ####
#### TABELA COM OS DADOS GERAIS DO ESTADO ####
        $metodos = new metodosJson();

        $sql = $metodos->JsonParaObj();
        $vetorpdf = $this->PesquisarTodos($sql);


        $altura = 4;
        $pdf->SetFont('arial', '', 11);
// largura,altura,conteudo,borda,quebra de linha,alinhamento
        //var_dump($vetorpdf);

        for ($index = 0; $index < count($vetorpdf); $index++) {

            $pdf->SetTextColor(0, 0, 0);
            $pdf->Cell(25, $altura, "Código", 1, 0, 'L');
            $pdf->SetFont('arial', 'i', 10);
            $pdf->SetTextColor(18, 10, 143);
            $pdf->Cell(15, $altura, $vetorpdf[$index]->getId(), 1, 0, 'L');

            $pdf->SetTextColor(0, 0, 0);
            $pdf->Cell(35, $altura, "Nome Do Estado", 1, 0, 'L');
            $pdf->SetFont('arial', 'i', 10);
            $pdf->SetTextColor(18, 10, 143);
            $pdf->Cell(35, $altura, $vetorpdf[$index]->getNome(), 1, 0, 'L');

            $pdf->SetTextColor(0, 0, 0);
            $pdf->Cell(35, $altura, "Sigla Do Estado", 1, 0, 'L');
            $pdf->SetFont('arial', 'i', 10);
            $pdf->SetTextColor(18, 10, 143);
            $pdf->Cell(29, $altura, $vetorpdf[$index]->getSigla(), 1, 1, 'L');
        }
#### FIM DA TABELA COM OS DADOS GERAIS DA VENDA ####
####            RODAP�                        ####
        $pdf->SetFont('arial', '', 10);
        $pdf->SetTextColor(0, 0, 0);
//posiciona verticalmente 270mm
        $pdf->SetY("270");
//data atual

        date_default_timezone_set('America/Sao_Paulo');

        $data = date("d/m/Y");
        $dtEx = EXPLODE("/", $data);
        $dia = $dtEx[0];
        $mes = $dtEx[1];
        $ano = $dtEx[2];

        $hora = date("H:i:s");


        $conteudo = "Relatório gerado em: " . $data . " - " . $hora;
        $texto = "Matheus Giacomelli Dos Santos";
//imprime uma celula... largura,altura, texto,borda,quebra de linha, alinhamento
        $pdf->Cell(0, 0, '', 1, 1, 'L');
//imprime uma celula... largura,altura, texto,borda,quebra de linha, alinhamento
        $pdf->Cell(0, 5, $texto, 0, 0, 'L');
//imprime uma celula... largura,altura, texto,borda,quebra de linha, alinhamento
        $pdf->Cell(0, 5, $conteudo, 0, 1, 'R');
####            FIM DO RODAP�                  ####

        $nomeArq = date("Ymd-H-i-s");
        $nomeArq = $nomeArq . "relatorioDeEstados.pdf";
//imprime a saida do arquivo..
        $pdf->Output($nomeArq, "I");
    }

    public function RelatEstadosJson() {
        $metodos = new metodosJson();


        $nomeArq = date("Ymd-H-i-s");
        $nomeArq = $nomeArq . "relatorioDeEstados";
        $nomeArq = $nomeArq . ".json";

        $sql = $metodos->JsonParaObj();
        $vetorpdf = $this->PesquisarTodos($sql);

        $id;
        $nome;
        $sigla;
        $estado;

        for ($index = 0; $index < count($vetorpdf); $index++) {

            $estados[] = array(
                $id = $vetorpdf[$index]->getId(),
                $nome = $vetorpdf[$index]->getNome(),
                $sigla = $vetorpdf[$index]->getSigla()
            );
        }

        $dados_json = json_encode($estados, JSON_UNESCAPED_UNICODE);
        // Configurações header para forçar o download
        // header('Content-Type: text/html; charset=UTF-8');

        header("Expires: Sat, 31 Dec 2011 05:00:00 GMT");
        header("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
        header("Cache-Control: no-cache, must-revalidate");
        header("Pragma: no-cache");
        header("Content-Disposition: attachment; filename=\"{$nomeArq}\"");
        header("Content-Description: PHP Generated Data");

        echo $dados_json;
        exit;
    }

    public function RelatEstadosDoc() {
        $metodos = new metodosJson();
        header('Content-Type: text/html; charset=utf-8');


        $nomeArq = date("Ymd-H-i-s");
        $nomeArq = $nomeArq . "relatorioDeEstados";
        $nomeArq = $nomeArq . ".doc";


        $sql = $metodos->JsonParaObj();
        $vetorpdf = $this->PesquisarTodos($sql);

        $id;
        $nome;
        $sigla;
        $estado;



        $html = '<meta charset="utf-8" />';
        $html = $html . '<table border="1">';
        for ($index = 0; $index < count($vetorpdf); $index++) {

            $id = $vetorpdf[$index]->getId();
            $nome = $vetorpdf[$index]->getNome();
            $sigla = $vetorpdf[$index]->getSigla();

            $html = $html . '<tr>';
            $html = $html . '<td>Código do Estado</td>';
            $html = $html . "<td> $id </td>";
            $html = $html . '</tr>';
            $html = $html . '<tr>';
            $html = $html . '<td> Nome do Estado </td>';
            $html = $html . "<td> $nome </td>";
            $html = $html . '</tr>';
            $html = $html . '<tr>';
            $html = $html . '<td> Sigla do Estado</td>';
            $html = $html . "<td> $sigla </td>";
            $html = $html . '</tr>';
        }

        header('Content-Type: text/html; charset=UTF-8');
        header("Expires: Sat, 31 Dec 2011 05:00:00 GMT");
        header("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
        header("Cache-Control: no-cache, must-revalidate");
        header("Pragma: no-cache");
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment; filename=\"{$nomeArq}\"");
        header("Content-Description: PHP Generated Data");

        echo $html;
        exit;
    }

    public function RelatEstadosXLS() {
        $metodos = new metodosJson();
        header('Content-Type: text/html; charset=utf-8');


        $nomeArq = date("Ymd-H-i-s");
        $nomeArq = $nomeArq . "relatorioDeEstados";
        $nomeArq = $nomeArq . ".xls";


        $sql = $metodos->JsonParaObj();
        $vetorpdf = $this->PesquisarTodos($sql);

        $id;
        $nome;
        $sigla;
        $estado;



        $html = '<meta charset="utf-8" />';
        $html = $html . '<table border="1">';
        for ($index = 0; $index < count($vetorpdf); $index++) {

            $id = $vetorpdf[$index]->getId();
            $nome = $vetorpdf[$index]->getNome();
            $sigla = $vetorpdf[$index]->getSigla();

            $html = $html . '<tr>';
            $html = $html . '<td>Código do Estado</td>';
            $html = $html . "<td> $id </td>";
            $html = $html . '</tr>';
            $html = $html . '<tr>';
            $html = $html . '<td> Nome do Estado </td>';
            $html = $html . "<td> $nome </td>";
            $html = $html . '</tr>';
            $html = $html . '<tr>';
            $html = $html . '<td> Sigla do Estado</td>';
            $html = $html . "<td> $sigla </td>";
            $html = $html . '</tr>';
        }

        header('Content-Type: text/html; charset=UTF-8');
        header("Expires: Sat, 31 Dec 2011 05:00:00 GMT");
        header("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
        header("Cache-Control: no-cache, must-revalidate");
        header("Pragma: no-cache");
        header("Content-type: application/x-msexcel");
        header("Content-Disposition: attachment; filename=\"{$nomeArq}\"");
        header("Content-Description: PHP Generated Data");


        echo $html;
        exit;
    }

    public function RelatEstadosXML() {
        $metodos = new metodosJson();
        header('Content-Type: text/html; charset=utf-8');


        $nomeArq = date("Ymd-H-i-s");
        $nomeArq = $nomeArq . "relatorioDeEstados";
        $nomeArq = $nomeArq . ".xml";


        $sql = $metodos->JsonParaObj();
        $vetorpdf = $this->PesquisarTodos($sql);

        $id;
        $nome;
        $sigla;
        $estado;




        $html = '<estados>';

        for ($index = 0; $index < count($vetorpdf); $index++) {

            $id = $vetorpdf[$index]->getId();
            $nome = $vetorpdf[$index]->getNome();
            $sigla = $vetorpdf[$index]->getSigla();

            $html = $html . ' <Código>';
            $html = $html . $id;
            $html = $html . ' </Código>';
            $html = $html . ' <Nome>';
            $html = $html . $nome;
            $html = $html . ' </Nome>';
            $html = $html . ' <Sigla>';
            $html = $html . $sigla;
            $html = $html . ' </Sigla>';
        }

        // header('Content-Type: text/html; charset=UTF-8');
        header("Expires: Sat, 31 Dec 2011 05:00:00 GMT");
        header("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
        header("Cache-Control: no-cache, must-revalidate");
        header("Pragma: no-cache");
        header("Content-Disposition: attachment; filename=\"{$nomeArq}\"");
        header("Content-Description: PHP Generated Data");

        echo $html;
        exit;
    }

}
