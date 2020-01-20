<?php

class RefLoan_model extends CORE_Model {
    protected  $table="ref_loan";
    protected  $pk_id="ref_loan_id";

    function __construct() {
        parent::__construct();
    }

    function get_ref_loan_list($ref_loan_id=null) {
        $query = $this->db->query("SELECT 
                    rl.*
                FROM
                    ref_loan rl
                WHERE
                     rl.is_deleted = 0
                ".($ref_loan_id==null?"":" AND rl.ref_loan_id='".$ref_loan_id."'")."
                ");
        $query->result();
        return $query->result();
    }
}
?>