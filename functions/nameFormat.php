<?php 
function name_Format($p)
{
    return mb_convert_case($p, MB_CASE_TITLE);
}
?>