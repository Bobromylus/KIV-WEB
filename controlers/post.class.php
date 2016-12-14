<?php

class post extends db_pdo
{
    //načtení postu podle id_post
    public function loadpost($postid)
    {
        $table_name = "posts";
        $columns    = "*";
        $where[]    = array(
            "column" => "id_post",
            "value" => $postid,
            "symbol" => "="
        );
        
        $postd = $this->DBSelectOne($table_name, $columns, $where);
        
        return $postd;
    }
    //odstranění postu podle id_post
    public function removepost($postid)
    {
        $table_name = "posts";
        $columns    = "*";
        $where[]    = array(
            "column" => "id_post",
            "value" => $postid,
            "symbol" => "="
        );
        
        $postd = $this->DBDelete($table_name, $where);
        return $postd;
    }
    //načtení všech postů, které jsou publikované
    public function LoadAllPosts()
    {
        $table_name = "posts";
        $columns    = "*";
        $where[]    = array(
            "column" => "published",
            "value" => "1",
            "symbol" => "="
        );
        
        $post = $this->DBSelectAll($table_name, $columns, $where);
        return $post;
    }
    //update published
    public function uppublished($id, $value)
    {
        $table_name = "posts";
        $column[]   = array(
            "column" => "published",
            "value" => $value
        );
        $where[]    = array(
            "column" => "id_post",
            "value" => $id,
            "symbol" => "="
        );
        
        $post = $this->DBUpdate($table_name, $column, $where);
        return $post;
    }
    //update title podle id_post
    public function uptitle($id, $value)
    {
        $table_name = "posts";
        $column[]   = array(
            "column" => "postTitle",
            "value" => $value
        );
        $where[]    = array(
            "column" => "id_post",
            "value" => $id,
            "symbol" => "="
        );
        
        $post = $this->DBUpdate($table_name, $column, $where);
        return $post;
    }
    //update text podle id_postu
    public function uptext($id, $value)
    {
        $table_name = "posts";
        $column[]   = array(
            "column" => "postContent",
            "value" => $value
        );
        $where[]    = array(
            "column" => "id_post",
            "value" => $id,
            "symbol" => "="
        );
        
        $post = $this->DBUpdate($table_name, $column, $where);
        return $post;
    }
    //načtení všech článku pokud je admin pokud ne jen autorovo články
    public function LoadAllPostsAdmin($id, $role)
    {
        $table_name = "posts";
        $columns    = "*";
        if ($role == "2") {
            $where[] = array(
                "column" => "id_user",
                "value" => "null",
                "symbol" => "!="
            );
        } else {
            $where[] = array(
                "column" => "id_user",
                "value" => $id,
                "symbol" => "="
            );
        }
        
        $post = $this->DBSelectAll($table_name, $columns, $where);
        return $post;
    }
    //přidání článku
    public function addPost($id, $title, $content, $pdf)
    {
        $table_name          = "posts";
        $item                = array();
        $item['id_user']     = $id;
        $item['postTitle']   = $title;
        $item['postContent'] = $content;
        $item['file']        = $pdf;
        
        $post = $this->DBInsert($table_name, $item);
        return $post;
    }
    
}