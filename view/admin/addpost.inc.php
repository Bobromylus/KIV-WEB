   <?php
//include sidebaru administrace
include 'view/admin/sidebar.inc.php';
global $template_params;
//zjištění zda je uživatel přihlášen
if (isset($_SESSION['user'])) {
    //nastaveni proměnných
    $template_params["user"] = $_SESSION['user']['login'];
    //nastavení akce
    if (isset($_POST['action'])) {
        $action = $_POST['action'];
        //zjištění souboru
        if (count($_FILES) > 0) {
            if (is_uploaded_file($_FILES['filePDF']['tmp_name'])) {
                //pokud přisla akce na přidání postu
                if ($action == "addpost") {
                    //nastaveni proměnných 
                    $id_user = $_SESSION['user']['id'];
                    $title   = $_POST['title'];
                    $text    = $_POST['posttext'];
                    
                    $file      = rand(1000, 100000) . "-" . $_FILES['filePDF']['title'];
                    $file_loc  = $_FILES['filePDF']['tmp_name'];
                    $file_size = $_FILES['filePDF']['size'];
                    $file_type = $_FILES['filePDF']['type'];
                    $folder    = "uploads/";
                    //přesun
                    move_uploaded_file($file_loc, $folder . $file);
                    
                    //nastaveni db
                    $post = new post();
                    $post->Connect();
                    $post_data = $post->addPost($id_user, $title, $text, $file);
                    //kontrola provedení
                    if (isset($post_data)) {
                        header("Location: index.php?p=aposts");
                    } else {
                        $errormsg = "Nepovedlo se přidat článek";
                    }
                }
                $post->Disconnect();
            }
        }
    }
    //zobrazení erroru
    if (isset($errormsg)) {
        echo "<div class='text-center'><span class='text-danger'>";
        echo $errormsg;
        echo "</span></div>";
    }
    //přesměrování
} else {
    header("Location: index.php");
}
