<?php

class Emp_overtime_list_model extends CORE_Model {
    protected  $table="emp_overtime_list";
    protected  $pk_id="emp_overtime_id";

    function __construct() {
        parent::__construct();
    }

    function get_ot_status($company_id,$pay_period_id,$ref_branch_id,$ref_department_id){
        $query = $this->db->query("SELECT 
				    otlist.*,
                    emp.per_hour_pay AS per_hour_pay
				FROM
				    emp_overtime_list otlist
				    LEFT JOIN employee_list emp ON
				        emp.employee_id = otlist.employee_id
				    WHERE otlist.pay_period_id = ".$pay_period_id."
                        AND otlist.company_id = ".$company_id."
                        AND emp.company_id = ".$company_id."
                        AND otlist.is_deleted = 0
                        ".($ref_branch_id=='all'?"":" AND emp.ref_branch_id=".$ref_branch_id."")."
    				    ".($ref_department_id=='all'?"":" AND emp.ref_department_id=".$ref_department_id."")."
    		");
        $query->result();
        return $query->result();
    }    

    function get_ot_list($company_id,$pay_period_id,$ref_branch_id,$ref_department_id){
        $query = $this->db->query("SELECT 
				    otlist.*,
				    emp.*,
                    emp.per_hour_pay AS per_hour_pay,
				    CONCAT(emp.first_name,' ',emp.middle_name,' ',emp.last_name) AS full_name
				FROM
				    emp_overtime_list otlist    
				    LEFT JOIN employee_list emp ON
				        emp.employee_id = otlist.employee_id
				WHERE otlist.pay_period_id = ".$pay_period_id."
                    AND otlist.company_id = ".$company_id."
                    AND emp.company_id = ".$company_id."
                    AND otlist.is_deleted = 0
                    ".($ref_branch_id=='all'?"":" AND emp.ref_branch_id=".$ref_branch_id."")."
    				".($ref_department_id=='all'?"":" AND emp.ref_department_id=".$ref_department_id."")."
    		");
        $query->result();
        return $query->result();
    }       

    function getOtID($company_id,$pay_period_id,$employee_id){
        $query = $this->db->query("SELECT 
                            eol.emp_overtime_id
                        FROM
                            emp_overtime_list eol
                        WHERE
                            eol.employee_id = $employee_id 
                                AND eol.pay_period_id = $pay_period_id
                                AND eol.company_id = $company_id");
                        $query->result();
                        return $query->result();
    }

    function chck_ot_emp($company_id,$employee_id,$pay_period_id){
        $query = $this->db->query("SELECT 
                            eol.*
                        FROM
                            emp_overtime_list eol
                        WHERE
                            eol.employee_id = $employee_id
                                AND eol.pay_period_id = $pay_period_id
                                AND eol.company_id = $company_id");
                        $query->result();
                        return $query->result();
    } 

    function get_dtr_id($company_id,$employee_id,$pay_period_id){
        $query = $this->db->query("SELECT 
                            dtr.*
                        FROM
                            daily_time_record dtr
                        WHERE
                            dtr.employee_id = $employee_id
                                AND dtr.pay_period_id = $pay_period_id
                                AND dtr.company_id = $company_id");
                        $query->result();
                        return $query->result();
    }  
}
?>
