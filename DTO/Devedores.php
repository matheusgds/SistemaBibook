<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Devedores
 *
 * @author mathe
 */
class Devedores {

    public function RelatDevedoresPDF() {

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
        $pdf->SetSubject("Sistema de Locação Bibook - Relatório Todos os Devedores", true);
###### FIM DAS DEFINI��ES GERAIS #######
####            CABE�ALHO                        ####
// posicao vertical no caso -1.. e o limite da margem
        $pdf->SetY("-1");
        $titulo = "Sistema de Locação Bibook - Relatório Todos os Devedores";

//escreve no pdf largura,altura,conteudo,borda,quebra de linha,alinhamento
        $pdf->Cell(0, 5, $titulo, 0, 0, 'L');
        $pdf->Cell(0, 0, '', 1, 1, 'L');
        $pdf->Ln(8);
####            FIM DO CABE�ALHO                  ####
### T�TULO DA P�GINA DENTRO DO PDF ###
//hora do conteudo do artigo
        $pdf->SetFont('arial', '', 22);
        $novo = "                   Relatório de Todos Os Devedores             ";
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
        $cliente = new Cliente();
        $vetorpdf = $cliente->sqlEspecial($sql);
        //vetor pdf aqui gera outro pdf vetorpdf[0] vetorpdf[1]

        $altura = 4;
        $pdf->SetFont('arial', '', 11);
// largura,altura,conteudo,borda,quebra de linha,alinhamento
        //var_dump($vetorpdf);

        for ($index = 0; $index < count($vetorpdf); $index++) {


            $pdf->SetTextColor(0, 0, 0);
            $pdf->Cell(35, $altura, "Nome Do Devedor", 1, 0, 'L');
            $pdf->SetFont('arial', 'i', 10);
            $pdf->SetTextColor(18, 10, 143);
            $pdf->Cell(35, $altura, $vetorpdf[$index][0], 1, 0, 'L');

            $pdf->SetTextColor(0, 0, 0);
            $pdf->Cell(35, $altura, "Valor", 1, 0, 'L');
            $pdf->SetFont('arial', 'i', 10);
            $pdf->SetTextColor(18, 10, 143);
            $pdf->Cell(29, $altura, $vetorpdf[$index][1], 1, 1, 'L');
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
        $nomeArq = $nomeArq . "relatorioDeDevedores.pdf";
//imprime a saida do arquivo..
        $pdf->Output($nomeArq, "I");
    }

}
