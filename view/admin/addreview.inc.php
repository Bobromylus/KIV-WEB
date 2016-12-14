   <?php
//include sidebaru administrace
include 'view/admin/sidebar.inc.php';
global $template_params;
global $purifier;

//zjištění zda je uživatel přihlášen
if (isset($_SESSION['user'])) {
    $role                    = $_SESSION['user']['role'];
    //pokud je admin
    if ($role == "2") {
        //nastavení proměnných a databaze
        $login                   = $_SESSION['user']['login'];
        $template_params["user"] = $login;
        $postdb                  = new post();
        $postdb->Connect();
        $postdb_data = $postdb->LoadAllPostsAdmin($login, $role);
        $userdb      = new users();
        $userdb->Connect();
        $userdb_data = $userdb->LoadAllUsersnotban();
        $reviewdb    = new review();
        $reviewdb->Connect();
        
        //nastavení optionu do selectu 
        $revpost_pom = "";
        $revuser_pom = "";
        
        foreach ($postdb_data as $post) {
            $title = $post['postTitle'];
            $value = $post['id_post'];
            $revpost_pom .= "<option value='$value'>$title</option>";
        }
        foreach ($userdb_data as $user) {
            $title = $user['login'];
            $value = $user['id_user'];
            $revuser_pom .= "<option value='$value'>$title</option>";
        }
        //pridani optionu
        $template_params["revpostopt"] = $revpost_pom;
        $template_params["revuseropt"] = $revuser_pom;
        //nastavení akce
        if (isset($_POST['action'])) {
            $action = $_POST['action'];
            //pokud přišlo addreview
            if ($action == "addreview") {
                //ziskej proměnné z formuláře
                $posttorev = $_POST['postrev'];
                $users     = $_POST['usersrev'];
                //pro každého vybraného uživatele 
                foreach ($users as $user) {
                    $rev_data = $reviewdb->addreview($user, $posttorev);
                    //nastavení erroru
                    if (!isset($rev_data)) {
                        $errormsg = "Nepovedlo se přidat recenzi";
                    }
                }
                //pokud není error přesměruj
                if (!isset($errormsg)) {
                    header("Location: index.php?p=areviews");
                }
            }
            $postdb->Disconnect();
            
        }
        //vypiš error
        if (isset($errormsg)) {
            echo "<div class='text-center'><span class='text-danger'>";
            echo $errormsg;
            echo "</span></div>";
        }
        
    }
    //přesměruj
} else {
    header("Location: index.php?p=404");
}
