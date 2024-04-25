<?php

function searchTable($dbHandle_pg, $busca2)
{
    $result = $dbHandle_pg->query("SELECT spree_users.name AS nome, spree_addresses.phone AS telefone, spree_users.email AS e_mail,
            spree_users.document_value AS documento, spree_orders.number AS pedido, TO_CHAR(spree_orders.created_at, 'DD/MM/YY') AS data_pedido,
            spree_stores.code AS loja
            FROM spree_orders
            JOIN spree_users ON spree_users.id = spree_orders.user_id
            JOIN spree_addresses ON spree_users.id = spree_addresses.user_id
            JOIN spree_stores ON spree_orders.store_id = spree_stores.id
            WHERE spree_stores.id <>414 and (
            spree_users.email LIKE '%$busca2%' OR
            spree_users.LOGIN LIKE '%$busca2%' OR
            spree_users.document_value LIKE '%$busca2%' OR
            spree_users.contact_phone LIKE '%$busca2%' OR
            spree_users.name LIKE '%$busca2%' OR
            spree_orders.number LIKE '%$busca2%')
            ORDER BY spree_orders.created_at DESC");

    echo "<div class='historico'>";
    echo "<table border='1'>";
    echo "<tr>
            <th>NOME</th>
            <th>CPF/CNPJ</th>
            <th>TELEFONE</th>
            <th>E-MAIL</th>
            <th>LOJA</th>
            <th>PEDIDO</th>
            <th>DATA DO PEDIDO</th>
          </tr>";

    if ($result && $result->rowCount() > 0) {
        $current_user = null;

        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            if ($current_user !== $row['nome']) {
                echo "<tr>";
                echo "<td>" . $row['nome'] . "</td>";
                echo "<td>" . $row['documento'] . "</td>";
                echo "<td><a style='margin:0; text-align: left;' target='_blank' href='https://api.whatsapp.com/send?phone=" . $row['telefone'] . "&text=Saudações'>" . $row['telefone'] . "</a></td>";
                echo "<td>" . $row['e_mail'] . "</td>";
                echo "<td>" . $row['loja'] . "</td>";
                echo "<td>" . $row['pedido'] . "</td>";
                echo "<td>" . $row['data_pedido'] . "</td>";
                echo "</tr>";

                $current_user = $row['nome'];
            } else {
                echo "<tr>";
                echo "<td></td>";
                echo "<td></td>";
                echo "<td></td>";
                echo "<td></td>";
                echo "<td></td>";
                echo "<td>" . $row['pedido'] . "</td>";
                echo "<td>" . $row['data_pedido'] . "</td>";
                echo "</tr>";
            }
        }
    } else {
        echo "<tr><td colspan='7'>Nenhum resultado encontrado.</td></tr>";
    }

    echo "</table>";
    echo '</div>';
}
?>
