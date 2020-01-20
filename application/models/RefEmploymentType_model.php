<?php

class RefEmploymentType_model extends CORE_Model {
    protected  $table="ref_employment_type";
    protected  $pk_id="ref_employment_type_id";

    function __construct() {
        parent::__construct();
    }

    function get_employmenttype_list($company_id){
        $query = $this->db->query("SELECT * FROM ref_employment_type WHERE is_deleted = 0 AND company_id = $company_id");
        return $query->result();  
    }

    function checkifused($ref_employment_type_id) {
    	$query = $this->db->query("SELECT 
                    ret.*
                FROM
                    ref_employment_type ret
                        INNER JOIN
                    employee_list emp ON emp.ref_employment_type_id = ret.ref_employment_type_id
                WHERE
                    ret.ref_employment_type_id = $ref_employment_type_id
                LIMIT 1");
                return $query->result();
    }


}
?>