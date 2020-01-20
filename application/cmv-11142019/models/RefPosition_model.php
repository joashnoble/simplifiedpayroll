<?php

class RefPosition_model extends CORE_Model {
    protected  $table="ref_position";
    protected  $pk_id="ref_position_id";
    protected  $tabletocheck="emp_rates_duties";

    function __construct() {
        parent::__construct();
    }

    function checkifused($ref_position_id) {
    	$query = $this->db->query("SELECT 
                    rp.*
                FROM
                    ref_position rp
                        INNER JOIN
                    employee_list emp ON rp.ref_position_id = emp.ref_position_id
                WHERE
                    rp.ref_position_id = $ref_position_id
                LIMIT 1");
                return $query->result();
    }

    function get_position_list($company_id){
        $query = $this->db->query("SELECT * FROM ref_position WHERE is_deleted = 0 AND company_id = $company_id");
        return $query->result();  
    }
}
?>