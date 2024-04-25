<?php
function renderTableFromQuery($tableClass = '', $dbHandle, $query)
{

    $result = $dbHandle->query($query);


    if (!$result) {
        echo "<p>Não foi possível executar a consulta</p>";
        return;
    }

    $data = array();


    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        $data[] = $row;
    }


    if (empty($data)) {
        echo "<p>Não há dados para exibir</p>";
        return;
    }


    $classAttribute = ($tableClass !== '') ? "class='$tableClass'" : '';


    echo "<table $classAttribute><tr>";


    foreach ($data[0] as $key => $value) {
        echo "<th>$key</th>";
    }
    echo "</tr>";


    foreach ($data as $row) {
        echo "<tr>";
        foreach ($row as $value) {
            echo "<td>$value</td>";
        }
        echo "</tr>";
    }
    echo "</table>";
}
?>