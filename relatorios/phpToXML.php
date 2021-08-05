  <?php
 header('Content-Type: text/xml; charset=UTF-8');

  /*
  * Criando e exportando planilhas do Excel
  * http://blog.thiagobelem.net/
  */

  // Definimos o nome do arquivo que ser� exportado
  $arquivo = 'relatorio.xml';

  //incluindo o arquivo do fpdf
  include 'connect/connect.php';
  include 'utilSys.php';

  #### TABELA COM OS DADOS GERAIS DA VENDA ####
  $codigo = 0;
  if (isset($_GET["codigo"]))
  	$codigo = $_GET["codigo"];

  $sql = "select * from venda ".
  "where codigo = $codigo";

  $result = mysqli_query($conexao,$sql);
  $codigo = "";
  $dataVencimento = "";
  $dataPagamento = "";

  while ($row = mysqli_fetch_array($result)){
  	$codigo = $row['codigo'];
  	$dataVencimento = dataTracoToPadrao($row['dataVencimento']);
  	$dataPagamento = dataTracoToPadrao($row['dataPagamento']);
  }
  $html = "";

  $html .= '<venda>';
  $html .= '<codigo>';
  $html .= $codigo;
  $html .= '</codigo>';
  $html .= '<dataVencimento>';
  $html .= $dataVencimento;
  $html .= '</dataVencimento>';
  $html .= '<dataPagamento>';
  $html .= $dataPagamento;
  $html .= '</dataPagamento>';

  #### TABELA COM OS ITENS(PRODUTOS) DA VENDA ####
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

  #### TABELA COM OS ITENS(PRODUTOS) DA VENDA ####

  while ($row = mysqli_fetch_array($result))  {     
    $totalVenda = $totalVenda + $row['totalItem'];
    $html .= '<item>'; 
    $html .= "<codigo>".$row[0]."</codigo>";
    $html .= "<descricao>".$row[1]."</descricao>";
    $html .= "<marca>".$row[2]."</marca>";
    $html .= "<quantidade>".$row[3]."</quantidade>";
    $html .= "<valorunitario>".number_format($row[4],2,',','.')."</valorunitario>";
    $html .= "<totalitem>".number_format($row[5],2,',','.')."</totalitem>";
    $html .= '</item>';
  }

  $html .= "<totalvenda>".number_format($totalVenda,2,',','.')."</totalvenda>";
  
  $html .= '</venda>';

  ####   FIM DO CONTEÚDO ####

  // Configurações header para forçar o download
  header ("Expires: Sat, 31 Dec 2011 05:00:00 GMT");
  header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
  header ("Cache-Control: no-cache, must-revalidate");
  header ("Pragma: no-cache");
  header ("Content-Disposition: attachment; filename=\"{$arquivo}\"" );
  header ("Content-Description: PHP Generated Data" );

  // Envia o conteúdo do arquivo
  echo $html;
  exit;


  ?>