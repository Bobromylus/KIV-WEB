<?php
//include sidebaru administrace
include 'view/admin/sidebar.inc.php';
global $purifier;
//pokud je uživatel přihlášen
if (isset($_SESSION['user'])) {
    global $template_params;
    $template_params["user"]    = $_SESSION['user']['login'];
    $template_params["Nadpis3"] = "Články";
    $template_params["addbutton"] = "<div class='text-center'><a href='?p=addpost' class='btn btn-sm btn-primary'>Přidat článek</a></div>";
    //pokud je uzivatel admin vypise vsechny
    if ($_SESSION['user']['role'] == "2") {
        $template_params["popis"] = "Výpis všech článků";
    } else {
        $template_params["popis"] = "Výpis vašich článků";
    }
    
    //pripojeni do db
    $postdb                       = new post();
    $postdb->Connect();
    
    $userdb = new users();
    $userdb->Connect();
    $role = $_SESSION['user']['role'];
    //ziskaní příspěvku podle role
    $postdb_data = $postdb->LoadAllPostsAdmin($_SESSION['user']['id'], $role);
    if ($postdb_data != null) {
        //vypis všech
        foreach ($postdb_data as $post) {
            $id = $post['id_post'];
            $clean_cont = $purifier->purify($post['postTitle']);
            $date = date("d.m. Y v H:i", strtotime($post['postDate']));
            $userdb_data = $userdb->get($post['id_user']);
            $login = $userdb_data['login'];
            
            $ob = "<tr><td>$id</td><td><a>$clean_cont</a><br /><small>Vytvořeno $date</small></td><td><a href='#'>$login</a></td><td>";

           //pokud je uzamčeno a neni admin
            if ($post['published'] == "1") {
                if ($role == "2") {
                    $ob .= "<a href='?p=publish$id' class='btn btn-success btn-xs'>Publikováno</a>";
                } else {
                    $ob .= "<a href='#' class='btn btn-success btn-xs'>Publikováno</a>";
                }
            } else if ($post['published'] == "-1") {
                if ($role == "2") {
                    $ob .= "<a href='?p=publish$id' class='btn btn-danger btn-xs'>Nepublikováno</a>";
                } else {
                    $ob .= "<a href='#' class='btn btn-danger btn-xs'>Nepublikováno</a>";
                }
            } else {
                if ($role == "2") {
                    $ob .= "<a href='?p=publish$id' class='btn btn-warning btn-xs'>V recenzním řízení</a>";
                } else {
                    $ob .= "<a href='#' class='btn btn-warning btn-xs'>V recenzním řízení</a>";
                }
            }
            
            $ob .= " </td><td><a href='?p=post$id' class='btn btn-primary btn-xs'><i class='fa fa-folder'></i> Zobrazit </a>";
            
            //pokud je post otevreny a nebo uživatel není admin
            if ($role == "2" or $post['published'] != "1") {
                $ob .= " <a href='?p=editpost$id' class='btn btn-info btn-xs'><i class='fa fa-pencil'></i> Upravit </a>";
            }
            
            $ob .= "<a href='?p=rmpost$id' class='btn btn-danger btn-xs'><i class='fa fa-trash-o'></i> Vymazat </a></td></tr>";
            //vypis řádku
            echo $ob;
        }
        //nejsou články
    } else {
        echo "Nejsou žádné články";
    }
    $postdb->Disconnect();
    $userdb->Disconnect();
    //přesměrování
} else {
    header("Location: index.php");
}