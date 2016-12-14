<?php
global $template_params;
$template_params["nadpis1"]        = "ERROR 404: Stránka nenalezena.";
$template_params["nadpis1atribut"] = "class ='text-center'";
echo "<h3 style='text-align: center;'>Wooops posíláme opičky na opravu</h3><p style='text-align: center;'>Můžete se vrátit tam, odkud jste přišli nebo jít na hlavní stránku.</p><p style='text-align: center;'>
<button type='button' class='btn btn-primary' onclick='javascript:history.back()'>Jít zpět</button>
<a class='btn btn-primary' href='index.php'>Hlavní stránka</a></p>";