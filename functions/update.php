<?php
function inserFromQuery($sql1, $coluna, $tabela, $conteudo, $lista)
{

    $sql = "UPDATE $tabela SET $coluna = $conteudo WHERE store_id IN ($lista);";

    if ($sql1->query($sql) === TRUE) {
        echo "Consulta executada com sucesso.";
    } else {
        echo "DEU";
    }
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
    include '../config.php';


    inserFromQuery($db_apisup, 'status',"spree_stores_on",true,'479, 442, 420, 527, 487, 530, 446, 509, 481, 529, 480, 489, 419, 471, 493, 469, 431, 484, 462, 521, 513, 461, 525, 511')
    ?>
</body>
</html>
