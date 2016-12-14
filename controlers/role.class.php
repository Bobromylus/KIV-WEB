<?php

class role extends db_pdo
{
    // k načtení role podle id_role
    public function loadrole($id)
    {
        $table_name = "role";
        $columns    = "*";
        $where[]    = array(
            "column" => "id_role",
            "value" => $id,
            "symbol" => "="
        );
        
        $postd = $this->DBSelectOne($table_name, $columns, $where);
        
        return $postd;
    }
    //načtení všech rolí
    public function loadallrole()
    {
        $table_name = "role";
        $columns    = "*";
        $where[]    = array(
            "column" => "role",
            "value" => "null",
            "symbol" => "!="
        );
        
        $role = $this->DBSelectAll($table_name, $columns, $where);
        
        return $role;
    }
    
}