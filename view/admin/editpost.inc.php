   <?php
//include sidebaru administrace
include 'view/admin/sidebar.inc.php';
global $template_params;
global $p;
global $purifier;
//uriznuti prefixu
$post = str_replace("editpost", "", $p);
//zjištění zda je suffix číslo
if (is_numeric($post)) {
    
    //zjištění zda je uživatel přihlášen
    if (isset($_SESSION['user'])) {
        //nastaveni proměnných a databaze
        $postdb = new post();
        $postdb->Connect();
        $postdb_data = $postdb->loadPost($post);
        
        $template_params["user"] = $_SESSION['user']['login'];
        $role                    = $_SESSION['user']['role'];
        //pokud není publikován a nebo je to admin
        if ($postdb_data['published'] != "1" or $role == "2") {
            
            $template_params['titlevalue']   = $purifier->purify($postdb_data['postTitle']);
            $template_params['contentvalue'] = $purifier->purify($postdb_data['postContent']);
            //nastavení akce
            if (isset($_POST['action'])) {
                $action = $_POST['action'];
                //pokud je vstup formuláře editpost bude provedena editace
                if ($action == "editpost") {
                    //získání proměnných z formulaře
                    $id_user    = $_SESSION['user']['id'];
                    $title      = $_POST['title'];
                    $text       = $_POST['posttext'];
                    //provedení updatu
                    $post_data1 = $postdb->uptitle($post, $title);
                    $post_data2 = $postdb->uptext($post, $text);
                    //ošetření erroru
                    if (isset($post_data1) and isset($post_data2)) {
                        header("Location: index.php?p=aposts");
                    } else {
                        $errormsg = "Nepovedlo se upravit článek";
                    }
                }
                $postdb->Disconnect();
                
            }
            //vypis erroru
            if (isset($errormsg)) {
                echo "<div class='text-center'><span class='text-danger'>";
                echo $errormsg;
                echo "</span></div>";
            }
            
        }
        //přesměrování
    } else {
        header("Location: index.php?p=404");
    }
    
} else {
    header("Location: index.php?p=404");
}
