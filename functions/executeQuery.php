<?php
function executeQuery($dbHandle, $query)
{
    $result = $dbHandle->query($query);

    if ($result) {
        $data = array();

        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }

        return $data;
    } else {
        return null;
    }
}
?>