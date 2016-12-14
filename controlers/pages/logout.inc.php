<?php
if(isset($_SESSION['user'])) {
    //zničení sessiny
	session_destroy();
    unset($_SESSION['user']);
    header("Location: index.php");
} else {
	header("Location: index.php");
}