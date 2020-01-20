<?php
class RefBranch_model extends CORE_Model {
    protected  $table="ref_branch";
    protected  $pk_id="ref_branch_id";

    function __construct() {
        parent::__construct();
    }

    function checkifused($ref_branch_id) {
    	$query = $this->db->query("SELECT 
                    rb.*
                FROM
                    ref_branch rb
                        INNER JOIN
                    employee_list emp ON rb.ref_branch_id = emp.ref_branch_id
                WHERE
                    rb.ref_branch_id = $ref_branch_id
                LIMIT 1");
                return $query->result();
    }

    function get_branch_list($company_id){
        $query = $this->db->query("SELECT * FROM ref_branch WHERE is_deleted = 0 AND company_id = $company_id");
        return $query->result();  
    }
}
?>