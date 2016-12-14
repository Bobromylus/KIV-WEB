<?php

class users extends db_pdo
{
    //metoda na přihlášení uživatele
    public function loadUser($username, $password)
    {
        $table_name = "users";
        $columns    = "*";
        $where[]    = array(
            "column" => "login",
            "value" => $username,
            "symbol" => "="
        );
        
        $user = $this->DBSelectOne($table_name, $columns, $where);
        
        $passwordcrypt = md5($password);
        
        if (!empty($user) && $passwordcrypt == $user['password']) {
            return $user;
        }
    }
    // získání uživatele podle id_user
    public function loadUserid($id)
    {
        $table_name = "users";
        $columns    = "*";
        $where[]    = array(
            "column" => "id_user",
            "value" => $id,
            "symbol" => "="
        );
        
        $user = $this->DBSelectOne($table_name, $columns, $where);
        return $user;
    }
    //smazání uživatele podle id_user
    public function removeuser($id)
    {
        $table_name = "users";
        $columns    = "*";
        $where[]    = array(
            "column" => "id_user",
            "value" => $id,
            "symbol" => "="
        );
        
        $u = $this->DBDelete($table_name, $where);
        return $u;
    }
    //příkaz na prohledání db zda uživatel existuje
    public function check($username)
    {
        $table_name = "users";
        $columns    = "*";
        $where[]    = array(
            "column" => "login",
            "value" => $username,
            "symbol" => "="
        );
        
        $user = $this->DBSelectOne($table_name, $columns, $where);
        
        return $user;
    }
    // získání uživatele podle id_user
    public function get($id)
    {
        $table_name = "users";
        $columns    = "*";
        $where[]    = array(
            "column" => "id_user",
            "value" => $id,
            "symbol" => "="
        );
        
        $user = $this->DBSelectOne($table_name, $columns, $where);
        
        return $user;
    }
    //přidání uživatele
    public function addUser($username, $email, $password)
    {
        
        $passwordcrypt = md5($password);
        
        $table_name           = "users";
        $item                 = array();
        $item['login']        = $username;
        $item['email']        = $email;
        $item['password']     = $passwordcrypt;
        $item['id_role']      = "0";
        $item['creationDate'] = date("Y-m-d H:i:s");
        
        $user = $this->DBInsert($table_name, $item);
        return $user;
    }
    //načtení všech uživatelů bez banu
    public function LoadAllUsersnotban()
    {
        $table_name = "users";
        $columns    = "*";
        $where[]    = array(
            "column" => "banned",
            "value" => "1",
            "symbol" => "!="
        );
        
        
        $post = $this->DBSelectAll($table_name, $columns, $where);
        return $post;
    }
    //načtení všech uživatelů
    public function LoadAllUsersAdmin()
    {
        $table_name = "users";
        $columns    = "*";
        $where[]    = array(
            "column" => "id_user",
            "value" => "null",
            "symbol" => "!="
        );
        
        
        $post = $this->DBSelectAll($table_name, $columns, $where);
        return $post;
    }
    //update banned
    public function upbanned($user, $value)
    {
        $table_name = "users";
        $column[]   = array(
            "column" => "banned",
            "value" => $value
        );
        $where[]    = array(
            "column" => "id_user",
            "value" => $user,
            "symbol" => "="
        );
        
        $u = $this->DBUpdate($table_name, $column, $where);
        return $u;
    }
    //update role
    public function uprole($user, $value)
    {
        $table_name = "users";
        $column[]   = array(
            "column" => "id_role",
            "value" => $value
        );
        $where[]    = array(
            "column" => "id_user",
            "value" => $user,
            "symbol" => "="
        );
        
        $u = $this->DBUpdate($table_name, $column, $where);
        return $u;
    }
    
}