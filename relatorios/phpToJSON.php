  <?php

  include 'connect/connect.php';
  include 'utilSys.php';

  header('Content-Type: text/html; charset=UTF-8');
  /*
  * Criando e exportando planilhas do Excel
  * http://blog.thiagobelem.net/
  */

  // Definimos o nome do arquivo que ser� exportado
  $arquivo = 'venda.json';

  // Definimos o nome do arquivo que ser� exportado
  //$arquivo = 'relatorio.json';

  #### DADOS GERAIS DA VENDA ####
  if (isset($_GET["codigo"]))
  	$codigo = $_GET["codigo"];

  $sql = "SELECT $tb_venda.codigo, $tb_venda.dataVencimento, $tb_venda.dataPagamento, 
             sum($tb_produto.preco * $tb_venda_has_produto.quantidade) as totalVenda,".
           " sum($tb_venda_has_produto.quantidade) as totalQuantidade".
           " FROM $tb_venda, $tb_produto, $tb_venda_has_produto". 
           " where $tb_venda.codigo = $tb_venda_has_produto.venda_codigo".
           " and $tb_produto.codigo = $tb_venda_has_produto.produto_codigo".
           " and $tb_venda.codigo =".$codigo. 
           " group by $tb_venda.codigo";

  $result = mysqli_query($conexao,$sql);
  
  $codigo = "";
  $dataVencimento = "";
  $dataPagamento = "";
  $quantidadeItens = "";
  $totalVenda = "";

  while ($row = mysqli_fetch_array($result)){
  	$codigo = $row['codigo'];
  	$dataVencimento = $row['dataVencimento'];
  	$dataPagamento = $row['dataPagamento'];
    $quantidadeItens = $row['totalQuantidade'];
    $totalVenda = $row['totalVenda'];
  }

  $venda = array(
    'codigo' => $codigo,
    'dataVencimento' => $dataVencimento,
    'dataPagamento' => $dataPagamento,
    'quantidadeItens' => $quantidadeItens,
    'totalVenda' => $totalVenda
  );

  $venda = array('venda' => $venda);

  #### ITENS(PRODUTOS) DA VENDA ####

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

  while ($row = mysqli_fetch_array($result))  {   
    $produtos[] = array(
    'codigo' => $row[0],
    'descricao' => $row[1],
    'marca' => $row[2],
    'quantidade' => $row[3],
    'preco' => $row[4],
    'totalItem' => $row[5]
  );
  }

  $produtos = array('produtos' => $produtos);

  $venda = array($venda, $produtos);

  // Tranforma o array $dados_identificador em JSON
  $dados_json = json_encode($venda);

  ####   FIM DO CONTEÚDO ####

  // Configurações header para forçar o download
  header ("Expires: Sat, 31 Dec 2011 05:00:00 GMT");
  header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
  header ("Cache-Control: no-cache, must-revalidate");
  header ("Pragma: no-cache");
  header ("Content-Disposition: attachment; filename=\"{$arquivo}\"" );
  header ("Content-Description: PHP Generated Data" );

  // Envia o conteúdo do arquivo
  echo $dados_json;
  exit;

  ?>