<?php
//pridani sidebaru administrace
include 'view/admin/sidebar.inc.php';
//globalni promenne
global $template_params;
global $p;
global $purifier;
//odstraneni prefixu
$iduser = str_replace("role", "", $p);
if (is_numeric($iduser)) {
    //pokud je uzivatel prihlasen
    if (isset($_SESSION['user'])) {
        $role = $_SESSION['user']['role'];
        //pokud je admin
        if ($role == "2") {
            //nastaveni parametru a db
            $userdb = new users();
            $userdb->Connect();
            $roledb = new role();
            $roledb->Connect();
            $roledb_data             = $roledb->loadallrole();
            $userdb_data             = $userdb->loadUserid($iduser);
            $template_params["user"] = $_SESSION['user']['login'];
            //pomocná na všechny option v selectu
            $role_pom = "";
            
            foreach ($roledb_data as $r) {
                $t = $r['role'];
                $v = $r['id_role'];
                $role_pom .= "<option value='$v'>$t</option>";
            }
            //pridani do templaty
            $template_params['userroleedit'] = $userdb_data['login'];
            $template_params['roleopt']      = $role_pom;
            //pokud neni action nastavi se
            if (isset($_POST['action'])) {
                $action = $_POST['action'];
                //pokud prisla upraveni role byl formular odeslan
                if ($action == "editrole") {
                    $iduprole = $_POST['role'];
                    //provedeni prikazu do db
                    $post_data = $userdb->uprole($iduser, $iduprole);
                    //kontrola zda proběhl v pořádku
                    if (isset($post_data)) {
                        header("Location: index.php?p=ausers");
                    } else {
                        $errormsg = "Nepovedlo se upravit roli";
                    }
                }
                $roledb->Disconnect();
                
            }
            //vypis erroru
            if (isset($errormsg)) {
                echo "<div class='text-center'><span class='text-danger'>";
                echo $errormsg;
                echo "</span></div>";
            }
            
        }
    } else {
        header("Location: index.php?p=404");
    }
    
} else {
    header("Location: index.php?p=404");
}