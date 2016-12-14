<?php
//globalni proměnna stránky a odstranen prefixu
global $p;
$user = str_replace("rmuser", "", $p);
//pokud je číslo
if (is_numeric($user)) {
    //pokud je přihlášen
    if (isset($_SESSION['user'])) {
        //pripojeni do db
        $userdb = new users();
        $userdb->Connect();
        $userdb_data = $userdb->loadUserid($user);
        $role        = $_SESSION['user']['role'];
        //zjisteni zda je uzivatel admin
        if ($role == "2") {
            //mazaní
                $userdb = $userdb->removeuser($user);
            //presmetrování
            header("Location: index.php?p=ausers");
        }else{
            header("Location: index.php?p=404");
        }
    }else{
        header("Location: index.php?p=404");
    }
}else{
  header("Location: index.php?p=404");  
}
