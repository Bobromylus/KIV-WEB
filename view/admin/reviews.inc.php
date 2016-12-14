<?php
//include sidebaru administrace
include 'view/admin/sidebar.inc.php';
    global $purifier;
//pokud je uzivatel prihlasen
if(isset($_SESSION['user'])) {
    //nastaveni parametru
    global $template_params;
    $template_params["user"] = $_SESSION['user']['login'];
    $template_params["Nadpis3"] = "Recenze";
    //pokud je uzivatel admin vypise vsechny a tlacitko na přidání recenze
    if($_SESSION['user']['role'] == "2"){
         $template_params["popis"] =   "Výpis všech recenzí";
        $template_params["addbutton"] ="<div class='text-center'>
                                <a href='?p=addreview' class='btn btn-sm btn-primary'>Přidat recenzi uživateli</a>
                            </div>"; 
    // vypis jen vašich   
    }else{
         $template_params["popis"] =   "Výpis vašich recenzí";
    }                
    //pripojeni do db
    $reviewdb = new review();
    $reviewdb->Connect();
    $postdb = new post();
    $postdb->Connect();
    
    $userdb = new users();
    $userdb->Connect();
    $role = $_SESSION['user']['role'];
    //ziskani jen prislušných recenzi k roly
    $reviewdb_data = $reviewdb->LoadAllreviewsAdmin($_SESSION['user']['id'], $role);
    //pokud není prazdný
	if ($reviewdb_data != null){
        //vypis všech
         foreach ($reviewdb_data as $review){ 
            $id = $review['id_review'];
            $clean_cont = $purifier->purify($review['reviewContent']); 
            $post =  $review['id_post'];
            $postdb_data = $postdb->loadPost($post);
            $cleantit = $purifier->purify($postdb_data['postTitle']);
            $karma = $review['reviewKarma'];
            $userdb_data = $userdb->get($review['id_user']);
            $log = $userdb_data['login'];
            
             
            $ob ="<tr><td>$id</td><td><a>$clean_cont</a><br /><small>Recenze k $cleantit</small></td><td>$karma</td><td><a href='#'>$log</a></td><td>";

             //pokud je uzamčeno a neni admin
            if($review['locked']== "1"){
                if($role =="2"){
                   $ob .= "<a href='?p=locked$id' class='btn btn-danger btn-xs'>Uzamčena</a>";
                }else{
                   $ob .= "<a href='#' class='btn btn-danger btn-xs'>Uzamčena</a>";
                }
            }else{
                if($role =="2"){
                   $ob .= "<a href='?p=locked$id' class='btn btn-success btn-xs'>Odemčena</a>";
                }else{
                   $ob .= "<a href='#' class='btn btn-success btn-xs'>Odemčena</a>";
                }     
            }
             
            $ob .= " </td><td><a href='?p=post$id' class='btn btn-primary btn-xs'><i class='fa fa-folder'></i> Zobrazit Článek</a>";
             //pokud je review otevřené a nebo neni uzivatel admin
            if($review['locked']== "0" or $role =="2"){
$ob .= " <a href='?p=editreview$id' class='btn btn-info btn-xs'><i class='fa fa-pencil'></i> Upravit </a>";
            }
            $ob .= "<a href='?p=rmreview$id' class='btn btn-danger btn-xs'><i class='fa fa-trash-o'></i> Vymazat </a></td></tr>";
         //ypis řádku
            echo  $ob;
        }
        //nejsou recenze
    }else{
        echo"Nejsou žádné recenze";
    }
    $reviewdb->Disconnect();
    $postdb->Disconnect();
    $userdb->Disconnect();
    //presměrování
}else{
    header("Location: index.php");
}