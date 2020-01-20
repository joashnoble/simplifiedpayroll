<?php

class Loan_list_model extends CORE_Model {
    protected  $table="loan_list";
    protected  $pk_id="loan_id";

    function __construct() {
        parent::__construct();
    }

    function get_loan_list($company_id,$loan_id=null) {
        $query = $this->db->query("SELECT 
                    loan.*,
                    rl.loan_type,
                    emp.ecode,
                    CONCAT(emp.first_name,
                            ' ',
                            emp.middle_name,
                            ' ',
                            emp.last_name) AS full_name
                FROM
                    loan_list loan
                        LEFT JOIN
                    employee_list emp ON emp.employee_id = loan.employee_id
                        LEFT JOIN
                    ref_loan rl ON rl.ref_loan_id = loan.ref_loan_id
                WHERE
                     loan.is_deleted = 0
                     AND loan.company_id = $company_id
                ".($loan_id==null?"":" AND loan.loan_id='".$loan_id."'")."
                ");
        $query->result();
        return $query->result();
    }

    function get_pay_slip_deduction($deduction_id){
        $query = $this->db->query("SELECT (IFNULL(SUM(deduction_amount),0)) AS deduction_amount FROM pay_slip_deduction WHERE deduction_id=".$deduction_id);
        return $query->result();
    }

    function chck_dtr_loan($company_id,$loan_id){
        $query = $this->db->query("SELECT 
                *
            FROM
                pay_slip_deduction psd
                    LEFT JOIN
                pay_slip ps ON ps.pay_slip_id = psd.pay_slip_id
                    LEFT JOIN
                daily_time_record dtr ON dtr.dtr_id = ps.dtr_id
            WHERE
                dtr.company_id = $company_id AND psd.deduction_id = $loan_id");
            return $query->result();
    }


    function chck_loan($company_id,$ref_loan_id,$employee_id){
        $query = $this->db->query("SELECT * FROM loan_list
                WHERE company_id = $company_id
                    AND ref_loan_id = $ref_loan_id
                    AND employee_id = $employee_id
                    AND balance > 0");
        return $query->result();
    }
}
?>