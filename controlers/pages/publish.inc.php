<?php
//globalni proměnna stránky a odstranen prefixu
global $p;
$post = str_replace("publish", "", $p);
//pokud je číslo
if (is_numeric($post)) {
    //pokud je přihlášen
    if (isset($_SESSION['user'])) {
        //pripojeni do db
        $postdb = new post();
        $postdb->Connect();
        $reviewdb = new review();
        $reviewdb->Connect();
        $postdb_data = $postdb->loadPost($post);
        
        $role = $_SESSION['user']['role'];
        //zjisteni zda je uzivatel admin    
        if ($role == "2") {
            //zjištení v jakém stavu článek je
            if ($postdb_data['published'] == "0") {
                $postdb_d   = $postdb->uppublished($post, 1);
                $reviewdb_d = $reviewdb->uplockedbypost($post, 1);
            } else if ($postdb_data['published'] == "1") {
                $postdb_d = $postdb->uppublished($post, -1);
            } else {
                $reviewdb_d = $reviewdb->uplockedbypost($post, 1);
                $postdb_d   = $postdb->uppublished($post, 1);
            }
            $postdb->Disconnect();
            $reviewdb->Disconnect();
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