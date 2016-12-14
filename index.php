<?php
//spuštení sessiny
session_start();
//include všech potřebných kontrolerů
include_once("controlers/db_pdo.class.php");
include_once("controlers/users.class.php");
include_once("controlers/post.class.php");
include_once("controlers/role.class.php");
include_once("controlers/review.class.php");
include_once("controlers/settings.inc.php");
require_once 'htmlpurifier-4.8.0/library/HTMLPurifier.auto.php';

//funkce na získání výpisu souboru
function phpWrapperFromFile($filename)
{
    ob_start();
    
    if (file_exists($filename) && !is_dir($filename)) {
        include($filename);
    }
    // nacte to z outputu
    $view = ob_get_clean();
    return $view;
}
//funkce na zjištení zda ve stringu je prefix
function startswith($haystack, $needle)
{
    return substr($haystack, 0, strlen($needle)) === $needle;
}

// nacist twig - kopie z dokumentace
require_once 'twig-master/lib/Twig/Autoloader.php';
Twig_Autoloader::register();
// cesta k adresari se sablonama - od index.php
$loader          = new Twig_Loader_Filesystem('themes');
$twig            = new Twig_Environment($loader); // takhle je to bez cache
// nacist danou sablonu z adresare
$template_params = array();

//vytvoření purifieru kvůli XSS
$purifier = new HTMLPurifier();


// parametr stranky
$p = @$_REQUEST["p"];

//rozhodnuti co bude za stranky
switch ($p) {
    case "":
        $filename = "view/uvod.inc.php";
        $template = $twig->loadTemplate('page.htm');
        break;
    case "uvod":
        $filename = "view/uvod.inc.php";
        $template = $twig->loadTemplate('page.htm');
        break;
    case "admin":
        $filename = "view/admin/admin.inc.php";
        $template = $twig->loadTemplate('admin/page.htm');
        break;
    case "posts":
        $filename = "view/posts.inc.php";
        $template = $twig->loadTemplate('page.htm');
        break;
    case "aposts":
        $filename = "view/admin/posts.inc.php";
        $template = $twig->loadTemplate('admin/posts.htm');
        break;
    case "areviews":
        $filename = "view/admin/reviews.inc.php";
        $template = $twig->loadTemplate('admin/reviews.htm');
        break;
    case "ausers":
        $filename = "view/admin/users.inc.php";
        $template = $twig->loadTemplate('admin/users.htm');
        break;
    case "addpost":
        $filename = "view/admin/addpost.inc.php";
        $template = $twig->loadTemplate('admin/addpost.htm');
        break;
    case "addreview":
        $filename = "view/admin/addreview.inc.php";
        $template = $twig->loadTemplate('admin/addreview.htm');
        break;
    case "login":
        $filename = "view/login.inc.php";
        $template = $twig->loadTemplate('login.htm');
        break;
    case "logout":
        $filename = "controlers/pages/logout.inc.php";
        $template = $twig->loadTemplate('login.htm');
        break;
    default:                                            //rozhodovani co bude za stranku s kodem pro přidání
        if (startswith($p, "post")) {
            $filename = "view/post.inc.php";
            $template = $twig->loadTemplate('page.htm');
        } else if (startswith($p, "editpost")) {
            $filename = "view/admin/editpost.inc.php";
            $template = $twig->loadTemplate('admin/editpost.htm');
        } else if (startswith($p, "editreview")) {
            $filename = "view/admin/editreview.inc.php";
            $template = $twig->loadTemplate('admin/editreview.htm');
        } else if (startswith($p, "rmpost")) {
            $filename = "controlers/pages/rmpost.inc.php";
            $template = $twig->loadTemplate('clean.htm');
        } else if (startswith($p, "rmreview")) {
            $filename = "controlers/pages/rmreview.inc.php";
            $template = $twig->loadTemplate('clean.htm');
        } else if (startswith($p, "rmuser")) {
            $filename = "controlers/pages/rmuser.inc.php";
            $template = $twig->loadTemplate('clean.htm');
        } else if (startswith($p, "download")) {
            $filename = "controlers/pages/download.inc.php";
            $template = $twig->loadTemplate('clean.htm');
        } else if (startswith($p, "publish")) {
            $filename = "controlers/pages/publish.inc.php";
            $template = $twig->loadTemplate('clean.htm');
        } else if (startswith($p, "ban")) {
            $filename = "controlers/pages/ban.inc.php";
            $template = $twig->loadTemplate('clean.htm');
        } else if (startswith($p, "role")) {
            $filename = "view/admin/role.inc.php";
            $template = $twig->loadTemplate('admin/role.htm');
        } else if (startswith($p, "locked")) {
            $filename = "controlers/pages/locked.inc.php";
            $template = $twig->loadTemplate('clean.htm');
        } else {
            $filename = "view/404.inc.php";
            $template = $twig->loadTemplate('page.htm');
        }
        break;
}


// nastaveni viewu
$view = phpWrapperFromFile($filename);

//stranky v menu

$pages          = array();
$pages['uvod']  = "Úvod";
$pages['posts'] = "Příspěvky";


// menu
$menu = "";
$menu .= "<ul class='nav navbar-nav navbar-left'>";

if ($pages != null) {
    foreach ($pages as $key => $title) {
        if ($p == $key) {
            $active_pom = "class='active'";
        } else {
            $active_pom = "";
        }
        
        $menu .= "<li $active_pom><a href='index.php?p=$key'>$title</a></li>";
    }
}
$menu .= "</ul><ul class='nav navbar-nav navbar-right' id='usermenu'>";
// login/reg / uživatelské menu
if (isset($_SESSION['user'])) {
    $menu .= "<li><p class='navbar-text'>Přihlášen jako ";
    $menu .= $_SESSION['user']['login'];
    $menu .= "</p></li>";
    $menu .= "<li><a href='index.php?p=admin'>Administrace</a></li>";
    $menu .= "<li><a href='index.php?p=logout'>Odhlásit</a></li>";
} else {
    $menu .= "<li><a href='index.php?p=login'>Login/Registrace</a></li>";
}
$menu .= "</ul>";

// render vrati data pro vypis nebo display je vypise
// v poli jsou data pro vlozeni do sablony
$template_params["obsah"] = $view;
$template_params["menu"]  = $menu;
echo $template->render($template_params);

