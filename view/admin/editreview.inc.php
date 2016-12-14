   <?php
//include sidebaru administrace
include 'view/admin/sidebar.inc.php';
global $template_params;
global $p;
global $purifier;
//uriznuti prefixu
$review = str_replace("editreview", "", $p);
//zjištění zda je suffix číslo
if (is_numeric($review)) {
    //zjištění zda je uživatel přihlášen
    if (isset($_SESSION['user'])) {
        //nastaveni proměnných a databaze
            $postdb = new post();
    $postdb->Connect();
    $reviewdb = new review();
    $reviewdb->Connect();
    $reviewdb_data = $reviewdb->loadreview($review);
    $postdb_data   = $postdb->loadpost($reviewdb_data['id_post']);
        
        $template_params["user"] = $_SESSION['user']['login'];
        $role                    = $_SESSION['user']['role'];
        $id                      = $_SESSION['user']['id'];
        //(zobrazí se pokud není published a uživatel je autor) nebo je admin
        if (($reviewdb_data['locked'] != "1" and $reviewdb_data['id_user'] == $id) or $role == "2") {
            
            $template_params['revposttitle'] = $purifier->purify($postdb_data['postTitle']);
            $template_params['reviewvalue']  = $purifier->purify($reviewdb_data['reviewContent']);
            $template_params['karmavalue']   = $reviewdb_data['reviewKarma'];
            //nastavení akce
            if (isset($_POST['action'])) {
                $action = $_POST['action'];
                //pokud je akce editview provede upravu
                if ($action == "editreview") {
                    //ziskani z formuláře
                    $review  = $reviewdb_data['id_review'];
                    $content = $_POST['reviewtext'];
                    $karma   = $_POST['knobkarma'];
                    //provedení
                    $post_data1 = $reviewdb->upcontent($review, $content);
                    $post_data2 = $reviewdb->upkarma($review, $karma);
                    //ošetření erroru
                    if (isset($post_data1) and isset($post_data2)) {
                        header("Location: index.php?p=areviews");
                    } else {
                        $errormsg = "Nepovedlo se upravit recenzi";
                    }
                }
                $reviewdb->Disconnect();
                
            }
            //vypsání erroru
            if (isset($errormsg)) {
                echo "<div class='text-center'><span class='text-danger'>";
                echo $errormsg;
                echo "</span></div>";
            }
            
        }
        //presměrování
    } else {
        header("Location: index.php?p=404");
    }
    
} else {
    header("Location: index.php?p=404");
}