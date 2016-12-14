<?php
//globalni proměnna stránky a odstranen prefixu
$directory = "uploads/";
global $p;
$post = str_replace("download", "", $p);
//pokud je číslo
if (is_numeric($post)) {
    $postdb = new post();
    $postdb->Connect();
    $postdb_data = $postdb->loadPost($post);
    $postdb->Disconnect();
    
    $userdb = $postdb_data['id_user'];
    //zjištění zda je uživatel přihlášen
    if (isset($_SESSION['user'])) {
        $user = $_SESSION['user']['id'];
        $role = $_SESSION['user']['role'];
    } else {
        $user = "";
        $role = "";
    }
    //pokud je článek publikován nebo je autor nebo admin/recenzet      
    if ($postdb_data['published'] == "1" or $userdb == $user or $role > "1") {
        $pdf   = $postdb_data['file'];
        $id    = $postdb_data['id_post'];
        $title = $postdb_data['postTitle'];
        //vytvoření fake cesty k souboru   
        header("Content-Transfer-Encoding: binary");
        header('Content-type: application/pdf');
        header("Content-Disposition: attachment; filename='{$title}-{$id}.pdf'");
        
        // The PDF source is in original.pdf
        readfile("uploads/{$pdf}");
        //presměrování
    } else {
        header("Location: index.php?p=404");
    }
      
} else {
    header("Location: index.php?p=404");
}