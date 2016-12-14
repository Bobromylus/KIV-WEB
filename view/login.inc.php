   <?php
//uživatel je již přihlášen
if (isset($_SESSION['user']) != "") {
    header("Location: index.php");
}
//registrace akce z formuláře
if (isset($_POST['action'])) {
    $action = $_POST['action'];
    //pokud přijde login 
    if ($action == "login_go") {
        //získání z formuláře a připojení do db
        $username = $_POST['name'];
        $password = $_POST['passwordl'];
        $login    = new users();
        $login->Connect();
        $login_data = $login->loadUser($username, $password);
        //pokud se schoduje heslo s db
        if ($login_data != null) {
            //pokud není ban
            if ($login_data['banned']=="0") {
                //přihlášení
                $_SESSION['user']          = array();
                $_SESSION['user']['id']    = $login_data['id_user'];
                $_SESSION['user']['login'] = $login_data['login'];
                $_SESSION['user']['email'] = $login_data['email'];
                $_SESSION['user']['role']  = $login_data['id_role'];
                header("Location: index.php");
                //error při zabanování
            } else {
                $errormsg = "JSI ZABANOVÁN !!!";
            }
            //error při nesprávném hesle / uživateli
        } else {
            $errormsg = "Nesprávné uživatelské jméno, nebo heslo!!!";
        }
        $login->Disconnect();
    }
    //pokud přijde registrace
    if ($action == "reg_go") {
        //získání z formuláře a připojení do db
        $name      = $_POST['username'];
        $email     = $_POST['email'];
        $password  = $_POST['password'];
        $cpassword = $_POST['cpassword'];
        
        $login = new users();
        $login->Connect();
        $reg_check = $login->check($name);
        //kontrola zda již neexistuje
        if ($reg_check) {
            $errormsg = "Uzivatel již existuje";
            //registruj
        } else {
            $reg_data = $login->addUser($name, $email, $password);
            //provedení error/success
            if ($reg_data) {
                $successmsg = "Registrace proběhla v pořadku, prosím přihlašte se.";
            } else {
                $errormsg = "Nepovedlo se zaregistrovat";
            }
        }
        $login->Disconnect();
    }
    
}
//vypis hlášek
if (isset($errormsg)) {
    echo "<div class='text-center'><span class='text-danger'>";
    echo $errormsg;
    echo "</span></div>";
}

if (isset($successmsg)) {
    echo "<div class='text-center'><span class='text-success'>";
    echo $successmsg;
    echo "</span></div>";
}
