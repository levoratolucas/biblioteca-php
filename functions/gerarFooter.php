<?php
function gerarFooter($nomeEmpresa)
{
?>
    <footer style="    background-color: black;
 color: white; padding: 5px; text-align: center;">
        <p>&copy; <?php echo date("Y"); ?> <?php echo $nomeEmpresa; ?>. Todos os direitos reservados.</p>
    </footer>
<?php
}
?>