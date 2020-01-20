<?php

class Emp_holiday_pay_list_model extends CORE_Model {
    protected  $table="emp_holiday_pay_list";
    protected  $pk_id="emp_holiday_pay_id";

    function __construct() {
        parent::__construct();
    }

	function get_hol_status($company_id,$pay_period_id,$ref_branch_id,$ref_department_id){
	        $query = $this->db->query("SELECT 
					    hollist.*,
                    	emp.per_hour_pay					    	
					FROM
					    emp_holiday_pay_list hollist
					        LEFT JOIN
					    employee_list emp ON emp.employee_id = hollist.employee_id
					    WHERE hollist.pay_period_id = ".$pay_period_id."
					    	AND hollist.company_id = ".$company_id."
					    	AND emp.company_id = ".$company_id."
					    	AND hollist.is_deleted = 0
						    ".($ref_branch_id=='all'?"":" AND emp.ref_branch_id=".$ref_branch_id."")."
						    ".($ref_department_id=='all'?"":" AND emp.ref_department_id=".$ref_department_id."")."
	    		");
	        $query->result();
	        return $query->result();
	    }    

    function get_hol_list($company_id,$pay_period_id,$ref_branch_id,$ref_department_id){
        $query = $this->db->query("SELECT 
			    hollist.*,
			    emp.*,
			    CONCAT(emp.first_name,
			            ' ',
			            emp.middle_name,
			            ' ',
			            emp.last_name) AS full_name,
				emp.per_hour_pay
			FROM
			    emp_holiday_pay_list hollist
			        LEFT JOIN
			    employee_list emp ON emp.employee_id = hollist.employee_id
				WHERE hollist.pay_period_id = ".$pay_period_id."
					AND hollist.company_id = ".$company_id."
					AND emp.company_id = ".$company_id."
					AND hollist.is_deleted = 0
					".($ref_branch_id=='all'?"":" AND emp.ref_branch_id=".$ref_branch_id."")."
					".($ref_department_id=='all'?"":" AND emp.ref_department_id=".$ref_department_id."")."
    		");
        $query->result();
        return $query->result();
    }  

    function getHolidayID($company_id,$pay_period_id,$employee_id){
        $query = $this->db->query("SELECT 
					    emp_holiday_pay_id
					FROM
					    emp_holiday_pay_list ehpl
					WHERE
					    ehpl.employee_id = $employee_id AND ehpl.pay_period_id = $pay_period_id
					        AND ehpl.company_id = $company_id");
			        $query->result();
			        return $query->result();
    }

    function chck_hol_emp($company_id,$employee_id,$pay_period_id){
        $query = $this->db->query("SELECT 
					    ehpl.*
					FROM
					    emp_holiday_pay_list ehpl
					WHERE
					    ehpl.employee_id = $employee_id
					        AND ehpl.pay_period_id = $pay_period_id
					        AND ehpl.company_id = $company_id");
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