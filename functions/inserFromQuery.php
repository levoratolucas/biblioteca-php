<?php
function inserFromQuery($sql1,$sql2, $query, $colunas, $tabela)
{    
    $result = $sql1->query($query);
    
    if (!$result) {
        echo "<p>Não foi possível executar a consulta</p>";
        return;
    }
    
    $data = $result->fetchAll(PDO::FETCH_ASSOC);
    
    if (empty($data)) {
        echo "<p>Não há dados para inserir</p>";
        return;
    }
    
    $placeholders = rtrim(str_repeat('?,', count($colunas)), ',');
    $sql = "INSERT INTO $tabela (" . implode(',', $colunas) . ") VALUES ($placeholders)";
    $stmt = $sql2->prepare($sql);
    
    foreach ($data as $row) {
        $values = array_values($row);
        $stmt->execute($values);
        echo "Registros inseridos com sucesso na tabela $tabela.";
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

    $query = 'select code,id from spree_stores';
    $colunas =['code','store_id'];

    inserFromQuery($db_pg,$db_apisup, $query, $colunas, 'spree_stores_on')
    ?>
</body>
</html>
