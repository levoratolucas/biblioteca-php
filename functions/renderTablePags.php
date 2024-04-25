<?php
function renderTablePags($table, $query,$user, $mes='', $busca, $page = 1, $perPage = 25)
{
    global $conn;

    $offset = ($page - 1) * $perPage;
    $query .= " LIMIT ?, ?";

    $stmt = $conn->prepare($query);
    $stmt->bind_param("ii", $offset, $perPage);
    $stmt->execute();

    $result = $stmt->get_result();
    echo "<table class='" . $table . "'>";
    $headersPrinted = false;

    while ($row = $result->fetch_assoc()) {
        if (!$headersPrinted) {
            echo "<tr>";
            foreach ($row as $key => $value) {
                echo "<th>" . htmlspecialchars($key) . "</th>";
            }
            echo "</tr>";
            $headersPrinted = true;
        }
        echo "<tr>";
        foreach ($row as $value) {
            echo "<td>" . htmlspecialchars($value) . "</td>";
        }
        echo "</tr>";
    }
    echo "</table>";
    echo "<div class='paginas'>";
    if ($page > 1) {
        $prevPage = $page - 1;
        echo "<a href='?page=$prevPage&mes=$mes&busca=$busca&loja=$user'>Anterior</a>";
    }
    echo " $page ";
    if ($result->num_rows == $perPage) {
        $nextPage = $page + 1;
        echo "<a href='?page=$nextPage&mes=$mes&busca=$busca&loja=$user'>Próxima</a>";
    }
    echo "</div>";
}
