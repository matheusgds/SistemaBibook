<?php
//Ligar o buffer de sa�da evitando erros de espa�os e print
ob_start();

//incluindo o arquivo do fpdf
require_once("fpdf.php");
include '../confs/Conexao.php';
//include 'utilSys.php';

#####  DEFINI��ES GERAIS #####
//defininfo a fonte !
define('FPDF_FONTPATH','font/');
//instancia a classe.. P=Retrato, mm =tipo de medida utilizada no casso milimetros, tipo de folha =A4
$pdf= new FPDF("P","mm","A4");
//define a fonte a ser usada
$pdf->SetFont('arial','',10);
//define o titulo
$pdf->SetTitle("Sistema de Locação Bibook");
//assunto
$pdf->SetSubject("Sistema de Locação Bibook");
###### FIM DAS DEFINI��ES GERAIS #######

####            CABE�ALHO                        ####
// posicao vertical no caso -1.. e o limite da margem
$pdf->SetY("-1");
$titulo = "Sistema de Locação Bibook";
$site = "http://www.curvello.com";
//escreve no pdf largura,altura,conteudo,borda,quebra de linha,alinhamento
$pdf->Cell(0,5,$titulo,0,0,'L');
$pdf->Cell(0,5,$site,0,1,'R');
$pdf->Cell(0,0,'',1,1,'L');
$pdf->Ln(8);
####            FIM DO CABE�ALHO                  ####

### T�TULO DA P�GINA DENTRO DO PDF ###
//hora do conteudo do artigo
$pdf->SetFont('arial','',22);
$novo="                   Relatório de Venda               ";
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
$pdf->Image("../IMG/livro32x32j.jpg", 11,20,20,20);
#### FIM T�TULO DA P�GINA DENTRO DO PDF ####

#### CONTE�DO ####

#### TABELA COM OS DADOS GERAIS DA VENDA ####
$codigo = 0;


if (isset($_GET["codigo"]))
	$codigo = $_GET["codigo"];

$sql = "select * from venda ".
       "where codigo =".$codigo;
       
$result = mysqli_query($conexao,$sql);
$codigo = "";
$dataVencimento = "";
$dataPagamento = "";
 while ($row = mysqli_fetch_array($result)){
	$codigo = $row[0];
	$dataVencimento = dataTracoToPadrao($row[1]);
	$dataPagamento = dataTracoToPadrao($row[2]);
}

$altura = 4;
$pdf->SetFont('arial','',11);
// largura,altura,conteudo,borda,quebra de linha,alinhamento

$pdf->SetTextColor(0,0,0);
$pdf->Cell(33,$altura,"C�digo",1,0,'L');
$pdf->SetFont('arial','i',10);
$pdf->SetTextColor(18,10,143);
$pdf->Cell(29,$altura,$codigo,1,0,'L');

$pdf->SetTextColor(0,0,0);
$pdf->Cell(35,$altura,"Data de Vencimento",1,0,'L');
$pdf->SetFont('arial','i',10);
$pdf->SetTextColor(18,10,143);
$pdf->Cell(29,$altura,$dataVencimento,1,0,'L');

$pdf->SetTextColor(0,0,0);
$pdf->Cell(35,$altura,"Data de Pagamento",1,0,'L');
$pdf->SetFont('arial','i',10);
$pdf->SetTextColor(18,10,143);
$pdf->Cell(29,$altura,$dataPagamento,1,1,'L');
#### FIM DA TABELA COM OS DADOS GERAIS DA VENDA ####

#### TABELA COM OS ITENS(PRODUTOS) DA VENDA ####
$pdf->Ln(4);
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('arial','B',11);
//posicao inicial,altura,conteudo(*texto),borda,quebra de linha,alinhamento
$pdf->Write(5,"Itens da Venda",0,0,"C");
$pdf->Ln(8);

$pdf->SetFont('arial','B',9);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(12,$altura,"C�digo",1,0,'L');
$pdf->Cell(64,$altura,"Descri��o",1,0,'L');
$pdf->Cell(47,$altura,"Marca",1,0,'L');
$pdf->Cell(17,$altura,"Unidades",1,0,'L');
$pdf->Cell(25,$altura,"Valor Unid.",1,0,'L');
$pdf->Cell(25,$altura,"Total do Item",1,1,'L');

$sql = "SELECT $tb_produto.codigo, $tb_produto.descricao, ".
  "$tb_marca.descricao,$tb_venda_has_produto.quantidade, ".
  "$tb_produto.preco, ".
  "($tb_venda_has_produto.quantidade * $tb_produto.preco) as totalItem ". 
  "FROM $tb_produto, $tb_marca, $tb_venda, $tb_venda_has_produto ".
  "WHERE $tb_venda.codigo = $codigo ".
  "AND $tb_venda_has_produto.venda_codigo = $tb_venda.codigo ".
  "AND $tb_produto.marca_codigo = $tb_marca.codigo ".
  "AND $tb_produto.codigo = $tb_venda_has_produto.produto_codigo ". 
  "ORDER BY $tb_produto.descricao";

  $result = mysqli_query($conexao,$sql);

  $totalVenda = 0;

$pdf->SetFont('arial','i',9);
$pdf->SetTextColor(18,10,143);

  while ($row = mysqli_fetch_array($result))  {     
    $totalVenda = $totalVenda + $row['totalItem']; 
   	$pdf->Cell(12,$altura,$row[0],1,0,'L');
	$pdf->Cell(64,$altura,$row[1],1,0,'L');
	$pdf->Cell(47,$altura,$row[2],1,0,'L');
	$pdf->Cell(17,$altura,$row[3],1,0,'L');
	$vu = number_format($row[4],2,',','.');
	$pdf->Cell(25,$altura,$vu,1,0,'L');
	$ti = number_format($row[5],2,',','.');
	$pdf->Cell(25,$altura,$ti,1,1,'L');     
 }
 
$pdf->SetFont('arial','B',14);
$pdf->SetTextColor(18,10,143);
$totalVenda = number_format($totalVenda,2,',','.');
$pdf->Cell(190,$altura * 2,"R$ ".$totalVenda,1,1,'R');
#### TABELA COM OS ITENS(PRODUTOS) DA VENDA ####

####   FIM DO CONTE�DO ####

####            RODAP�                        ####
$pdf->SetFont('arial','',10);
$pdf->SetTextColor(0,0,0);
//posiciona verticalmente 270mm
$pdf->SetY("270");
//data atual
$data = date("d/m/Y");
$dtEx = EXPLODE("/",$data);
$dia = $dtEx[0];
$mes = $dtEx[1];
$ano = $dtEx[2];
		
$hora=date("H:i:s");
$hrEx = EXPLODE(":",$hora);
$hr = $hrEx[0];
$minuto = $hrEx[1];
$segundo = $hrEx[2];

$cod = md5("2".$dia."3".$mes."5".$ano."7".$hr."11".$minuto."13".$segundo."17");
$cod = md5(substr($cod,0,10));
$cod = substr($cod,0,10);

$conteudo="C�digo de Valida��o: ".$cod." - Relat�rio gerado em: ".$data. " - ".$hora;
$texto="Rodrigo Curv�llo";
//imprime uma celula... largura,altura, texto,borda,quebra de linha, alinhamento
$pdf->Cell(0,0,'',1,1,'L');
//imprime uma celula... largura,altura, texto,borda,quebra de linha, alinhamento
$pdf->Cell(0,5,$texto,0,0,'L');
//imprime uma celula... largura,altura, texto,borda,quebra de linha, alinhamento
$pdf->Cell(0,5,$conteudo,0,1,'R');
####            FIM DO RODAP�                  ####

$nomeArq=date("Ymd-H-i-s");
$nomeArq = $nomeArq."relatorioDeVendas.pdf";
//imprime a saida do arquivo..
$pdf->Output($nomeArq,"I");
/*

REFERENCIAS :

FPDF - >Esta � o construtor da classe. Ele permite que seja definido o formato da p�gina, a orienta��o e a unidade de medida usada em todos os m�todos (exeto para tamanhos de fonte).

utilizacao : FPDF([string orientation [, string unit [, mixed format]]])

SetFont -> Define a fonte que ser� usada para imprimir os caracteres de texto. � obrigat�ria a chamada, ao menos uma vez, deste m�todo antes de imprimir o texto ou o documento resultante n�o ser� v�lido.

utilizacao : SetFont(string family [, string style [, float size]])

SetTitle - >Define o t�tulo do documento.

utilizacao : SetTitle(string title)

SetSubject -> Define o assunto do documento

utilizacao : SetSubject(string subject)

SetX - >Define a abscissa da posi��o corrente. Se o valor passado for negativo, ele ser� relativo � margem direita da p�gina.

utilizacao : SetX(float x)

SetY - > Move a abscissa atual de volta para margem esquerda e define a ordenada. Se o valor passado for negativo, ele ser� relativo a margem inferior da p�gina.

utilizacao : SetY(float y)

Cell - > Imprime uma c�lula (�rea retangular) com bordas opcionais, cor de fundo e texto. O canto superior-esquerdo da c�lula corresponde � posi��o atual. O texto pode ser alinhado ou centralizado. Depois de chamada, a posi��o atual se move para a direita ou para a linha seguinte. � poss�vel p�r um link no texto.

Se a quebra de p�gina autom�tica est� habilitada e a pilha for al�m do limite, uma quebra de p�gina � feita antes da impress�o.

utilizacao - >Cell(float w [, float h [, string txt [, mixed border [, int ln [, string align [, int fill [, mixed link]]]]]]])

Ln - > Faz uma quebra de linha. A abscissa corrente volta para a margem esquerda e a ordenada � somada ao valor passado como par�metro.

utilizacao ->Ln([float h])

MultiCell - > Este m�todo permite imprimir um texto com quebras de linha. Podem ser autom�tica (assim que o texto alcan�a a margem direita da c�lula) ou expl�cita (atrav�s do caracter n). Ser�o geradas tantas c�lulas quantas forem necess�rias, uma abaixo da outra.

O texto pode ser alinhado, centralizado ou justificado. O bloco de c�lulas podem ter borda e um fundo colorido.

utilizacao : MultiCell(float w, float h, string txt [, mixed border [, string align [, int fill]]])

Image ->Coloca uma imagem na p�gina - tipos suportados JPG PNG

utilizacao : Image(string file, float x, float y [, float w [, float h [, string type [, mixed link]]]])

Bom mais uma vez.. agrade�o se for �til..

qualquer d�vida: alexandre.etf@gmail.com !
*/
?>