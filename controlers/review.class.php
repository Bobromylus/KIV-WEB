<?php

class review extends db_pdo
{
    //načtení review podle id_review
    public function loadreview($id)
    {
        $table_name = "reviews";
        $columns    = "*";
        $where[]    = array(
            "column" => "id_review",
            "value" => $id,
            "symbol" => "="
        );
        
        $reviewd = $this->DBSelectOne($table_name, $columns, $where);
        
        return $reviewd;
    }
    //odstranení review podle id_review
    public function removereview($reviewid)
    {
        $table_name = "reviews";
        $columns    = "*";
        $where[]    = array(
            "column" => "id_review",
            "value" => $reviewid,
            "symbol" => "="
        );
        
        $reviewd = $this->DBDelete($table_name, $where);
        return $reviewd;
    }
    //načtení všech review podle id_postu
    public function LoadAllReviews($idpost)
    {
        $table_name = "reviews";
        $columns    = "*";
        $where[]    = array(
            "column" => "id_post",
            "value" => $idpost,
            "symbol" => "="
        );
        
        $review = $this->DBSelectAll($table_name, $columns, $where);
        return $review;
    }
    //update locked
    public function uplocked($id, $value)
    {
        $table_name = "reviews";
        $column[]   = array(
            "column" => "locked",
            "value" => $value
        );
        $where[]    = array(
            "column" => "id_review",
            "value" => $id,
            "symbol" => "="
        );
        
        $review = $this->DBUpdate($table_name, $column, $where);
        return $review;
    }
    //update locked podle id_postu
    public function uplockedbypost($id, $value)
    {
        $table_name = "reviews";
        $column[]   = array(
            "column" => "locked",
            "value" => $value
        );
        $where[]    = array(
            "column" => "id_post",
            "value" => $id,
            "symbol" => "="
        );
        
        $review = $this->DBUpdate($table_name, $column, $where);
        return $review;
    }
    //update contentu podle id-review
    public function upcontent($id, $value)
    {
        $table_name = "reviews";
        $column[]   = array(
            "column" => "reviewContent",
            "value" => $value
        );
        $where[]    = array(
            "column" => "id_review",
            "value" => $id,
            "symbol" => "="
        );
        
        $review = $this->DBUpdate($table_name, $column, $where);
        return $review;
    }
    //update hodnocení podle id_review
    public function upkarma($id, $value)
    {
        $table_name = "reviews";
        $column[]   = array(
            "column" => "reviewKarma",
            "value" => $value
        );
        $where[]    = array(
            "column" => "id_review",
            "value" => $id,
            "symbol" => "="
        );
        
        $review = $this->DBUpdate($table_name, $column, $where);
        return $review;
    }
    //získání všech recenzí když je admin když ne jen jeho
    public function LoadAllReviewsAdmin($id, $role)
    {
        $table_name = "reviews";
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
        
        $review = $this->DBSelectAll($table_name, $columns, $where);
        return $review;
    }
    //přidání review
    public function addreview($id, $post)
    {
        $table_name            = "reviews";
        $item                  = array();
        $item['id_user']       = $id;
        $item['id_post']       = $post;
        $item['reviewContent'] = "Prosím vyplňte recenzi";
        
        $review = $this->DBInsert($table_name, $item);
        return $review;
    }
    
}