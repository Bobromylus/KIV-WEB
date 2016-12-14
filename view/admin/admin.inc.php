<?php
//pridani sidebaru administrace a kontrola přihlášení
include 'view/admin/sidebar.inc.php';
if(isset($_SESSION['user'])) {
    global $template_params;
    $template_params["user"] = $_SESSION['user']['login'];
    $template_params["Nadpis1"] = "Vítejte v Administraci";
    $template_params["Nadpis3"] = "Info";
    $template_params["popis"] =   "Zde můžete podle své role pracovat s Články, Recenzemi a uživateli. ";
}else{
    header("Location: index.php");
}