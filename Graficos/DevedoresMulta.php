<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <?php $dir = ".." . DIRECTORY_SEPARATOR . "IMG" . DIRECTORY_SEPARATOR . "livro32x32p.png"; ?>
    <?php $dircss = ".." . DIRECTORY_SEPARATOR . "css" . DIRECTORY_SEPARATOR . "estilo.css"; ?>
    <?php $dirshort = ".." . DIRECTORY_SEPARATOR . "IMG" . DIRECTORY_SEPARATOR . "livro32x32i.ico"; ?>
    <link rel="stylesheet" type="text/css" href=<?php echo $dircss ?>/>
    <link rel="shortcut icon" href=<?php echo $dirshort ?> >
    <title>Listar Livros Mais Alocados</title>

    <?php
    require_once ".." . DIRECTORY_SEPARATOR . "autoload.php";
    $padrao = new padrao();
    $vetor = $padrao->returnDevedores();

    //print_r ($vetor);
    $ndados = count($vetor);
    ?>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {'packages': ['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Nome do Cliente', 'Quantidade Devendo'],
<?php
for ($valor = 0; $valor < $ndados; $valor++) {
    $i = 0;
    ?>
                    [<?php
    $varteste = "'" . $vetor[$valor][$i + 1] . "'";
    echo $varteste
    ?>, <?php echo ($vetor[$valor][$i]) ?>],
<?php } ?>
            ]);

            var options = {
                title: 'Clientes Devedores',
                is3D: true,
            };

            var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));

            chart.draw(data, options);
        }
    </script>
</head>
<body>
    <div  class="centraliza" id="piechart_3d" style="width: 900px; height: 700px;"></div> 
</body>
</html>
