<?php
//globalni proměnna stránky a odstranen prefixu
global $p;
$user = str_replace("ban", "", $p);
if (is_numeric($user)) {
    if (isset($_SESSION['user'])) {
        //pripojeni do db
        $userdb = new users();
        $userdb->Connect();
        $userdb_data = $userdb->loadUserid($user);
        $role        = $_SESSION['user']['role'];
        //zjisteni zda je uzivatel admin
        if ($role == "2") {
            //pokud neni banovany tak zabanuje pokud je tak odbanuje
            if ($userdb_data['banned'] == "0") {
                $userdb = $userdb->upbanned($user, 1);
            } else {
                $userdb = $userdb->upbanned($user, 0);
            }
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
