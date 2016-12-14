<?php
//globální proměnné
global $p;
global $template_params;

//DOMU - STRANKY

$sidedomupages          = array();
$sidedomupages['admin'] = "Hlavní stránka";


//DOMU
$sidedomumenu = "";

if ($sidedomupages != null) {
    foreach ($sidedomupages as $key => $title) {
        if ($p == $key) {
            //pomůcky k vykreslení správného menu
            $active_pom                          = "class='current-page'";
            $template_params["sidedomuactive"]   = "class='active'";
            $template_params["sidedomuactiveul"] = "style='display: block'";
        } else {
            $active_pom = "";
        }
        
        $sidedomumenu .= "<li $active_pom><a href='index.php?p=$key'>$title</a></li>";
    }
}

//Clanky - STRANKY

$sideclankypages            = array();
$sideclankypages['aposts']  = "Přehled článků";
$sideclankypages['addpost'] = "Přidat článek";

//Clanky
$sideclankymenu = "";

if ($sideclankypages != null) {
    foreach ($sideclankypages as $key => $title) {
        if ($p == $key) {
            //pomůcky k vykreslení správného menu
            $active_pom                            = "class='current-page'";
            $template_params["sideclankyactive"]   = "class='active'";
            $template_params["sideclankyactiveul"] = "style='display: block'";
        } else {
            $active_pom = "";
        }
        
        $sideclankymenu .= "<li $active_pom><a href='index.php?p=$key'>$title</a></li>";
    }
}

//Recenze - STRANKY

$siderecenzepages             = array();
$siderecenzepages['areviews'] = "Přehled recenzí";
//pouze pokud je admin
if ($_SESSION['user']['role'] == "2") {
    $siderecenzepages['addreview'] = "Přidat recenzi";
}

//Recenze
$siderecenzemenu = "";

if ($siderecenzepages != null) {
    foreach ($siderecenzepages as $key => $title) {
        if ($p == $key) {
            //pomůcky k vykreslení správného menu
            $active_pom                             = "class='current-page'";
            $template_params["siderecenzeactive"]   = "class='active'";
            $template_params["siderecenzeactiveul"] = "style='display: block'";
        } else {
            $active_pom = "";
        }
        
        $siderecenzemenu .= "<li $active_pom><a href='index.php?p=$key'>$title</a></li>";
    }
}

//Uzivatele - STRANKY

$sideuzivatelpages = array();
//pouze pokud je admin
if ($_SESSION['user']['role'] == "2") {
    $sideuzivatelpages['ausers'] = "Přehled uživatelů";
} else {
    $template_params["sideuzivatelactive"] = "class='hidden'";
}

//Uzivatele
$sideuzivatelmenu = "";

if ($sideuzivatelpages != null) {
    foreach ($sideuzivatelpages as $key => $title) {
        if ($p == $key) {
            //pomůcky k vykreslení správného menu
            $active_pom                              = "class='current-page'";
            $template_params["sideuzivatelactive"]   = "class='active'";
            $template_params["sideuzivatelactiveul"] = "style='display: block'";
        } else {
            $active_pom = "";
        }
        
        $sideuzivatelmenu .= "<li $active_pom><a href='index.php?p=$key'>$title</a></li>";
    }
}

// pridani to templaty
$template_params["sidedomu"]     = $sidedomumenu;
$template_params["sideclanky"]   = $sideclankymenu;
$template_params["siderecenze"]  = $siderecenzemenu;
$template_params["sideuzivatel"] = $sideuzivatelmenu;