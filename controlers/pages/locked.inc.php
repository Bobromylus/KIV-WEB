<?php
//globalni proměnna stránky a odstranen prefixu
global $p;
$review = str_replace("locked", "", $p);
if (is_numeric($review)) {
    //pokud je přihlášen
    if (isset($_SESSION['user'])) {
        //pripojeni do db
        $reviewdb = new review();
        $reviewdb->Connect();
        $reviewdb_data = $reviewdb->loadreview($review);
        
        $role = $_SESSION['user']['role'];
        //zjisteni zda je uzivatel admin    
        if ($role == "2") {
            //zjisteni v jakem stavu je recenze
            if ($reviewdb_data['locked'] == "1") {
                $reviewdb_d = $reviewdb->uplocked($review, 0);
            } else {
                $reviewdb_d = $reviewdb->uplocked($review, 1);
            }
            $reviewdb->Disconnect();
            //presmetrování
            header("Location: index.php?p=areviews");
        } else {
            header("Location: index.php?p=404");
        }
    } else {
        header("Location: index.php?p=404");
    }
} else {
    header("Location: index.php?p=404");
}