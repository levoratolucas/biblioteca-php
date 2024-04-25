<?php
function renderTable($data, $tableClass = '')
{
    if (empty($data)) {
        echo "<p>Não há dados para exibir</p>";
        return;
    }


    $classAttribute = ($tableClass !== '') ? "class='$tableClass'" : '';

    echo "<table  $classAttribute><tr>";
    // Cabeçalho da tabela
    foreach ($data[0] as $key => $value) {
        echo "<th>".mb_convert_case($key, MB_CASE_TITLE)."</th>";
    }
    echo "</tr>";

    // Linhas da tabela
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