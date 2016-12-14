<?php
//sidebar administrace
include 'view/admin/sidebar.inc.php';
//cistič html
global $purifier;
//pokud je přihlášený uživatel
if (isset($_SESSION['user'])) {
    //nastavení parametrů
    global $template_params;
    $template_params["user"]    = $_SESSION['user']['login'];
    $template_params["Nadpis3"] = "Uživatelé";
    $role                       = $_SESSION['user']['role'];
    $iduser                     = $_SESSION['user']['id'];
    //poked je uživatel admin
    if ($role == "2") {
        $template_params["popis"] = "Výpis všech uživatelů";
        //připojení do db
        $roledb = new role();
        $roledb->Connect();
        $userdb = new users();
        $userdb->Connect();
        
        //získání všech uživatelů
        $userdb_data = $userdb->LoadAllusersAdmin($iduser, $role);
        
        if ($userdb_data != null) {
            //vypsání všech uživatelů
            foreach ($userdb_data as $user) {
                $id          = $user['id_user'];
                $login       = $user['login'];
                $date        = date("d.m. Y v H:i", strtotime($user['creationDate']));
                $email       = $user['email'];
                $roledb_data = $roledb->loadrole($user['id_role']);
                $role        = $roledb_data['role'];
                $banned      = $user['banned'];
                
                $ob = "<tr><td>$id</td><td><a>$login</a><br /><small>Registrován dne: $date</small></td><td>$email</td><td>$role</td><td>";
                //pokud nejsou banovaní tak aktivní jinak neaktivní
                if ($banned == "1") {
                    $ob .= "<a href='?p=ban$id' class='btn btn-danger btn-xs'>Neaktivní</a>";
                } else {
                    $ob .= "<a href='?p=ban$id' class='btn btn-success btn-xs'>Aktivní</a>";
                }
                
                $ob .= " </td><td><a href='?p=rmuser$id' class='btn btn-danger btn-xs'><i class='fa fa-trash-o'></i> Vymazat uživatele </a><a href='?p=role$id' class='btn btn-info btn-xs'><i class='fa fa-arrows-v'></i> Změnit roli uživatele</a></td></tr>";
                //výpis uživatele
                echo $ob;
            }
        } else {
            //pokud nejsou uživatelé
            echo "Nejsou žádní uživatelé";
        }
        $userdb->Disconnect();
        $roledb->Disconnect();
        
        
    } else {
        header("Location: index.php");
    }
} else {
    header("Location: index.php");
}