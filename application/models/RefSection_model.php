<?php

class RefSection_model extends CORE_Model {
    protected  $table="ref_section";
    protected  $pk_id="ref_section_id";
    protected  $tabletocheck="emp_rates_duties";

    function __construct() {
        parent::__construct();
    }

    function checkifused($ref_section_id) {
    	$query = $this->db->query("SELECT 
                    rs.*
                FROM
                    ref_section rs
                        INNER JOIN
                    employee_list emp ON rs.ref_section_id = emp.ref_section_id
                WHERE
                    rs.ref_section_id = $ref_section_id
                LIMIT 1");
                return $query->result();
    }

    function get_section_list($company_id){
        $query = $this->db->query("SELECT * FROM ref_section WHERE is_deleted = 0 AND company_id = $company_id");
        return $query->result();  
    }
}
?>