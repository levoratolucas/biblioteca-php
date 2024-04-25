<?php
function queryArray($dbHandle, $query, $colun)
{
    $result = $dbHandle->query($query);

    if ($result) {
        $data = array();
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row[$colun];
        }
        return $data;
    } else {
        return null;
    }
}
?>