<?php

class RefPayFrequencyFactor_model extends CORE_Model {
    protected  $table="ref_payfrequency_factor";
    protected  $pk_id="ref_payfrequency_factor_id";

    function __construct() {
        parent::__construct();
    }

    function chck_ref_payfrequency_factor($company_id){
      $query = $this->db->query("SELECT * FROM ref_payfrequency_factor WHERE company_id =".$company_id);
      return $query->result();
    }

    function create_default_pay_frequency_factor_monthly($company_id){
        $sql_monthly ="INSERT INTO ref_payfrequency_factor (ref_payfrequency_id,company_id,pay_type_factor) values ('2',$company_id,26.00)";
        $this->db->query($sql_monthly);
    }

    function create_default_pay_frequency_factor_semimonthly($company_id){
        $sql_semimonthly ="INSERT INTO ref_payfrequency_factor (ref_payfrequency_id,company_id,pay_type_factor) values ('1',$company_id,13.00)";
        $this->db->query($sql_semimonthly);
    }

    function create_default_pay_frequency_factor_weekly($company_id){
        $sql_weekly ="INSERT INTO ref_payfrequency_factor (ref_payfrequency_id,company_id,pay_type_factor) values ('4',$company_id,1.00)";
        $this->db->query($sql_weekly);
    }

    function create_default_pay_frequency_factor_salaried($company_id){
        $sql_salaried ="INSERT INTO ref_payfrequency_factor (ref_payfrequency_id,company_id,pay_type_factor) values ('5',$company_id,13.00)";
        $this->db->query($sql_salaried);
    }

}
?>