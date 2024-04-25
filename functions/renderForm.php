<?php 
function render_form(array $param, $id, $class, $method, $labelClass, $inputClass, $buttonClass)
{
    echo "<form class='" . $class . "' method='" . $method . "' id='" . $id . "'>";
    foreach ($param as $p => $t) {
        echo '<div class="' . $class . '">';
        echo "<label for='" . $p . "' class='" . $labelClass . "' >" . $p . "</label>";
        if (is_array($t) && !empty($t)) {
            echo "<select id='" . str_replace(' ', '_', trim($p)) . "' class='" . $inputClass . "' name='" . $p . "'>";
            foreach ($t as $option) {
                echo "<option value='" . $option . "'>" . $option . "</option>";
            }
            echo "</select>";
        } else {
            echo "<input type='" . $t . "' id='" . str_replace(' ', '_', trim($p)) . "'class='" . $inputClass . "' name='" . $p . "' placeholder='" . $p . "'>";
        }
        echo "</div>";
    }
    echo '<button  type="submit" class="' . $buttonClass . '">Submit</button>';
    echo "</form>";
}
?>