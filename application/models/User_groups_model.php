<?php

class User_groups_model extends CORE_Model
{
    protected  $table = "user_groups"; //table name
    protected  $pk_id = "user_group_id"; //primary key id


    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }


    function create_default_user_group($company_id){
        $sql="INSERT INTO user_groups
                  (company_id,user_group,user_group_desc)
              VALUES
                  ($company_id,'admin','Can access all features.')";
        $this->db->query($sql);
    }

    function get_usergroup_list($company_id,$user_account_id=null){
              $query = $this->db->query("SELECT * FROM user_groups WHERE company_id = $company_id AND is_active = 1 AND is_deleted = 0
                      ".($user_account_id==null?"":" AND user_account_id=".$user_account_id."")."");
              return $query->result();
    }

    function get_userrights_list($company_id=null,$user_group_id=null){
              $query = $this->db->query("SELECT 
                  ug.*, ur.*
              FROM
                  user_groups ug
                      LEFT JOIN
                  user_rights ur ON ur.user_group_id = ug.user_group_id
              WHERE
                  ug.is_deleted = 0 
                      ".($company_id==null?"":" AND ug.company_id=".$company_id."")."
                      ".($user_group_id==null?"":" AND ug.user_group_id=".$user_group_id."")."");
              return $query->result();
    }

    function count_user_group($company_id){
         $query = $this->db->query("SELECT * FROM user_groups WHERE company_id = $company_id AND is_deleted = 0");
         return $query->result();
    }


}




?>