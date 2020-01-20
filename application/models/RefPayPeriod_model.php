<?php

class RefPayPeriod_model extends CORE_Model {
    protected  $table="refpayperiod";
    protected  $pk_id="pay_period_id";

    function __construct() {
        parent::__construct();
    }

    function get_payperiod_list($company_id){
        $query = $this->db->query("SELECT rpp.*, m.month_name FROM refpayperiod rpp
                            LEFT JOIN months m ON m.month_id = rpp.month_id
                            WHERE rpp.is_deleted = 0 AND rpp.company_id = $company_id");
        return $query->result();  
    }
    
    function get_pay_period($company_id,$year=null) {
      $query = $this->db->query("SELECT 
                                  *
                              FROM
                                  refpayperiod
                              WHERE
                                    is_deleted = 0
                                    AND company_id = ".$company_id."
                                    ".($year==null?"":" AND EXTRACT(YEAR FROM pay_period_start) = ".$year."")."
                              ORDER BY pay_period_start DESC");
                              return $query->result();
                          
    }

    function get_weekly_payperiod($company_id,$year,$month_id) {
      $query = $this->db->query("SELECT 
                        COUNT(*) as count
                      FROM
                          refpayperiod
                      WHERE
                          EXTRACT(YEAR FROM pay_period_start) = $year
                              AND company_id = $company_id
                              AND month_id = $month_id
                              AND is_deleted = 0");
                      return $query->result();
                          
    }

    function getpayperioddesc($pay_period_id){
      $query = $this->db->query('SELECT CONCAT(pay_period_start," ~ ",pay_period_end) as pay_period FROM refpayperiod 
      	WHERE pay_period_id='.$pay_period_id.' AND is_deleted=0');
		return $query->result();
    }

    function getpayperiod($company_id){
      $query = $this->db->query("SELECT CONCAT(pay_period_start,' ~ ',pay_period_end) as period, pay_period_id FROM refpayperiod WHERE is_deleted = 0 AND company_id = $company_id ORDER BY pay_period_start DESC");
    return $query->result();
    }

    function getperiod($getperiod){
      $query = $this->db->query("SELECT CONCAT(date_format(pay_period_start,'%m/%d/%Y'),' ~ ',date_format(pay_period_end,'%m/%d/%Y')) as period, pay_period_id FROM refpayperiod WHERE is_deleted = 0 AND pay_period_id=".$getperiod);
    return $query->result();
    }

    function get_dtr_transaction($getperiod,$ref_department_id="all"){
      $query = $this->db->query("SELECT 
            COUNT(dtr.employee_id) as count,
            el.bank_account_isprocess as type,
            (CASE WHEN el.bank_account_isprocess = 1 THEN 'ATM' ELSE 'CASH' END) as transaction_type,
            el.ref_department_id
        FROM
            daily_time_record dtr 
            LEFT JOIN employee_list el ON el.employee_id = dtr.employee_id
            WHERE dtr.pay_period_id = $getperiod
            ".($ref_department_id=='all'?"":" AND el.ref_department_id = $ref_department_id")."
            GROUP BY el.bank_account_isprocess
            ORDER BY transaction_type ASC");
      return $query->result();
    }    

    function checkifused($pay_period_id) {
      $query = $this->db->query("SELECT 
                    rpp.*
                FROM
                    refpayperiod rpp
                        INNER JOIN
                    daily_time_record dtr ON dtr.pay_period_id = rpp.pay_period_id
                WHERE
                    rpp.pay_period_id = $pay_period_id
                LIMIT 1");
                return $query->result();
    }  
}
?>