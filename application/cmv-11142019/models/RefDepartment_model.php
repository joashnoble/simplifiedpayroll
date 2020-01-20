<?php

class RefDepartment_model extends CORE_Model {
    protected  $table="ref_department";
    protected  $pk_id="ref_department_id";

    function __construct() {
        parent::__construct();
    }

    function checkifused($ref_department_id) {
    	$query = $this->db->query("SELECT 
                    rd.*
                FROM
                    ref_department rd
                        INNER JOIN
                    employee_list emp ON rd.ref_department_id = emp.ref_department_id
                WHERE
                    rd.ref_department_id = $ref_department_id
                LIMIT 1");
                return $query->result();
    }

    function get_department_list($company_id){
        $query = $this->db->query("SELECT * FROM ref_department WHERE is_deleted = 0 AND company_id = $company_id");
        return $query->result();  
    }
    
    function get_department_dtr($pay_period_id,$ref_department_id='all'){
        $query = $this->db->query("SELECT
                main.*
            FROM
            (SELECT DISTINCT
                COALESCE((rd.ref_department_id),0) AS ref_department_id,
                COALESCE(rd.department,'') as department,
                el.bank_account_isprocess AS type
            FROM
                daily_time_record dtr
                    LEFT JOIN
                employee_list el ON el.employee_id = dtr.employee_id
                    LEFT JOIN
                ref_department rd ON rd.ref_department_id = el.ref_department_id
            WHERE
                dtr.pay_period_id = $pay_period_id
                ".($ref_department_id=='all'?"":" AND el.ref_department_id=$ref_department_id")."
            GROUP BY el.bank_account_isprocess , rd.ref_department_id
            ORDER BY rd.department ASC) as main
            WHERE main.ref_department_id != 0");
        return $query->result();

    }


}
?>