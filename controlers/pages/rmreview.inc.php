<?php
//globalni proměnna stránky a odstranen prefixu
global $p;
$review = str_replace("rmreview", "", $p);
//pokud je číslo
if (is_numeric($review)) {
    //pokud je přihlášen
    if (isset($_SESSION['user'])) {
        //nastavení parametrů a databáze
        $reviewdb = new review();
        $reviewdb->Connect();
        $reviewdb_data = $reviewdb->loadreview($review);
        $iddb          = $reviewdb_data['id_user'];
        $role          = $_SESSION['user']['role'];
        //pokud je to admin anebo je to jeho článek
        if ($role == "2" or $iddb == $_SESSION['user']['id']) {
            //mazaní
            $reviewdb_data = $reviewdb->removereview($review);
            $reviewdb->Disconnect();
            header("Location: index.php?p=areviews");
            //presměrování
        }else{
            header("Location: index.php?p=404");
        }
    }else{
        header("Location: index.php?p=404");
    }
}else{
  header("Location: index.php?p=404");  
}