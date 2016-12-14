<?php
//nastavení globálu a uřiznutí prefixu
global $p;
global $template_params;
global $purifier;
$post = str_replace("post", "", $p);
//zjištění zda je suffix číslo
if (is_numeric($post)) {
    //pripojení do db a získání dat
    $postdb = new post();
    $postdb->Connect();
    $userdb = new users();
    $userdb->Connect();
    $reviewdb = new review();
    $reviewdb->Connect();
    $postdb_data = $postdb->loadPost($post);
    $reviewdb_data = $reviewdb->LoadAllReviews($postdb_data['id_post']);
    $postdb->Disconnect();
    
    //pokud neni v db přesměrování na 404
    if ($postdb_data == null) {
        header("Location: index.php?p=404");
    }
    //id autora
    $userdbid = $postdb_data['id_user'];
    //získání rola a id prohlížejícího uživatele
    if (isset($_SESSION['user'])) {
        $user = $_SESSION['user']['id'];
        $role = $_SESSION['user']['role'];
    } else {
        $user = "";
        $role = "";
    }
    //zobrazí se pokud je published nebo uživatel je autor nebo je admin / reviewer
    if ($postdb_data['published'] == "1" or $userdbid == $user or $role > "1") {
        //nastavení parametrů
        $clean_title                = $purifier->purify($postdb_data['postTitle']);
        $clean_post                 = $purifier->purify($postdb_data['postContent']);
        $template_params["nadpis1"] = $clean_title;
        $userdb_data                = $userdb->get($userdbid);
        $autor                      = $userdb_data['login'];
        $template_params["nadpis2"] = "Autor: $autor";
        echo $clean_post;
        echo "<hr>";
        //získání vypisu recenzí
        if ($reviewdb_data != null) {
            echo " <table class='table table-striped projects'><thead><tr><th style='width: 70%'>Recenze</th><th>Autor</th><th style='width: 10%'>Hodnocení</th></tr></thead><tbody>";
            //výpis jednotlivých recenzí
            foreach ($reviewdb_data as $review) {
                if ($review['locked'] == "1") {
                    $time        = date("d.m. Y v H:i", strtotime($review['reviewDate']));
                    $content     = $purifier->purify($review['reviewContent']);
                    $karma       = $review['reviewKarma'];
                    $userdb_data = $userdb->get($review['id_user']);
                    $userr       = $userdb_data['login'];
                    echo "<tr><td>$content<br /><small>Recenzováno $time</small></td><td>$userr</td><td>$karma</td></tr>";
                }
            }
            //ukončení tabulky
            echo "                                </tbody>
                            </table><hr>";
         //zádné recenze   
        } else {
            echo "<div class='text-center'>Zatím žádné recenze</div><hr>";
        }
        //ukončení db
        $reviewdb->Disconnect();
        $userdb->Disconnect();
        //když má článek pdf
        if ($postdb_data['file'] != null) {
            $pdf = $postdb_data['file'];
            echo "<div class='text-center'>
                                <a href='?p=download$post' class='btn btn-sm btn-primary'>Stáhnout PDF</a>
                            </div>";
        }
    //uživatel nemá právo příspěvek vidět    
    } else {
        $template_params["nadpis1"]        = "Neschválený článek";
        $template_params["nadpis1atribut"] = "class ='text-center'";
        echo "<h3 style='text-align: center;'>Wooops tento článek nebyl ještě schválen</h3><p style='text-align: center;'>Můžete se vrátit tam, odkud jste přišli nebo jít na hlavní stránku.</p><p style='text-align: center;'>
<button type='button' class='btn btn-primary' onclick='javascript:history.back()'>Jít zpět</button>
<a class='btn btn-primary' href='index.php'>Hlavní stránka</a></p>";
    }
    //přesměrování
} else {
    header("Location: index.php?p=404");
}