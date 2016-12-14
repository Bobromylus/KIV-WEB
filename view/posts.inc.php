<?php
global $p;
global $template_params;
global $purifier;
//pripojeni do db
$postdb = new post();
$postdb->Connect();
$userdb = new users();
$userdb->Connect();
$postdb_data = $postdb->LoadAllPosts();
$postdb->Disconnect();
//osetření že nejsou články
if ($postdb_data == null) {
    $template_params["nadpis1"]        = "Nejsou prozatím žádné články";
    $template_params["nadpis1atribut"] = "class ='text-center'";
    echo "<p style='text-align: center;'>Omlouváme se, ale ještě zde nejsou žádné články, vraťte se prosím později.</br>Můžete se vrátit tam, odkud jste přišli nebo jít na hlavní stránku.</p><p style='text-align: center;'>
<button type='button' class='btn btn-primary' onclick='javascript:history.back()'>Jít zpět</button>
<a class='btn btn-primary' href='index.php'>Hlavní stránka</a></p>";
    //výpis článků a stránky
} else {
    $template_params["nadpis1"] = "Příspěvky";
    echo "<hr>";
    //loop pro výpis článků
    foreach ($postdb_data as $postitem) {
        //nastavení parametrů pro výpis
        $title       = $purifier->purify($postitem['postTitle']);
        $clean_post  = $purifier->purify($postitem['postContent']);
        $time        = date("d.m. Y v H:i", strtotime($postitem['postDate']));
        $postid      = $postitem['id_post'];
        $userdb_data = $userdb->get($postitem['id_user']);
        $autor       = $userdb_data['login'];
        //uriznuti na 500 znaku        
        // odstranit html
        $clean_post  = strip_tags($clean_post);
        if (strlen($clean_post) > 500) {
            // zkrácení
            $postCut    = substr($clean_post, 0, 500);
            // uříznutí na slova a přidání read more....
            $clean_post = substr($postCut, 0, strrpos($postCut, ' ')) . " <a href='?p=post$postid'>Přečíst více <i class='fa fa-arrow-circle-o-right' aria-hidden='true'></i></a>";
        }
        //vypis článku
        echo "<article><header><h3><a href='?p=post$postid'>$title</a></h3><div class='entry-meta'>
			             <span class='posted-on'>Publikováno dne: $time,</span><span class='author'>Autor: $autor</span>		                       </div><!-- .entry-meta --></header><!-- .entry-header --><div class='entry-summary'><p>$clean_post</p></div><!-- .entry-summary --></article><hr>";
    }
    
    $userdb->Disconnect();
}
