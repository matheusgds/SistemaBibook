  <?php
  
  header('Content-Type: text/html; charset=UTF-8');
  $arquivo = 'relatorio.xls';

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

  $html = '';
  $html .= '<table border="1">';
  $html .= '<tr>';
  $html .= utf8_decode('<td>Código da Venda</td>');
  $html .= "<td>$codigo</td>";
  $html .= '</tr>';
  $html .= '<tr>';
  $html .= '<td>Data de Vencimento</td>';
  $html .= "<td>$dataVencimento</td>";
  $html .= '</tr>';
  $html .= '<tr>';
  $html .= '<td>Data de Pagamento</td>';
  $html .= "<td>$dataPagamento</td>";
  $html .= '</tr>';

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

  $html .= '<tr>';
  $html .= '<td colspan="6">Itens da Venda</tr>';
  $html .= '</tr>';
  $html .= utf8_decode('<td>Código</td>');
  $html .= utf8_decode('<td>Descrição</td>');
  $html .= '<td>Marca</td>';
  $html .= '<td>Unidades</td>';
  $html .= utf8_decode('<td>Valor Unitário</td>');
  $html .= '<td>Total do Item</td>';
  $html .= '</tr>';

  while ($row = mysqli_fetch_array($result))  {     
    $totalVenda = $totalVenda + $row['totalItem']; 
    $html .= '<tr>';
    $html .= "<td>".$row[0]."</td>";
    $html .= utf8_decode("<td>".$row[1]."</td>");
    $html .= utf8_decode("<td>".$row[2]."</td>");
    $html .= utf8_decode("<td>".$row[3]."</td>");
    $html .= "<td>".number_format($row[4],2,',','.')."</td>";
    $html .= "<td>".number_format($row[5],2,',','.')."</td>";
    $html .= '</tr>';
  }

  $html .= '<tr>';
  $html .= "<td></td>";
  $html .= "<td></td>";
  $html .= "<td></td>";
  $html .= "<td></td>";
  $html .= "<td>TOTAL DA VENDA</td>";
  $tv = number_format($totalVenda,2,',','.');
  $html .= "<td>$tv</td>";
  $html .= '</tr>';

####   FIM DO CONTEÚDO ####

// Configurações header para forçar o download
header ("Expires: Sat, 31 Dec 2011 05:00:00 GMT");
header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
header ("Cache-Control: no-cache, must-revalidate");
header ("Pragma: no-cache");
header ("Content-type: application/x-msexcel");
header ("Content-Disposition: attachment; filename=\"{$arquivo}\"" );
header ("Content-Description: PHP Generated Data" );

// Envia o conteúdo do arquivo
echo $html;
exit;

?>