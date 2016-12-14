<?php
//globalni proměnna stránky a odstranen prefixu
global $p;
$post = str_replace("rmpost", "", $p);
//pokud je číslo
if (is_numeric($post)) {
    //pokud je přihlášen
    if (isset($_SESSION['user'])) {
        //pripojeni do db
        $postdb = new post();
        $postdb->Connect();
        $postdb_data = $postdb->loadPost($post);
        $iddb        = $postdb_data['id_user'];
        
        $role = $_SESSION['user']['role'];
        
        if ($role == "2" or $iddb == $_SESSION['user']['id']) {
            //mazaní
            $postdb_data = $postdb->removePost($post);
            $postdb->Disconnect();
            //presmetrování
            header("Location: index.php?p=aposts");
        } else {
            header("Location: index.php?p=404");
        }
    } else {
        header("Location: index.php?p=404");
    }
} else {
    header("Location: index.php?p=404");
}