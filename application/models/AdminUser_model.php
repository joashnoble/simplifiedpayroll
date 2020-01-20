<?php

class AdminUser_model extends CORE_Model {
    protected  $table="admin_user";
    protected  $pk_id="admin_id";

    function __construct() {
        parent::__construct();
    }

    function authenticate_admin_user($uname,$pword){
        $this->db->select('*');
        $this->db->from('admin_user');
        $this->db->where('username', $uname);
        $this->db->where('password', $pword);
        return $this->db->get();
    }

}
?>
