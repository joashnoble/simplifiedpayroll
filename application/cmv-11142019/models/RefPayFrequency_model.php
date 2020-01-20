<?php

class RefPayFrequency_model extends CORE_Model {
    protected  $table="ref_payfrequency_type";
    protected  $pk_id="ref_payfrequency_type_id";

    function __construct() {
        parent::__construct();
    }

    function create_default_payfrequency_type(){
        $sql="INSERT INTO ref_payfrequency_type
                  (ref_payfrequency_type_id,pay_frequency_type,description,col1_percent,col1_amount,col1_cl,col2_percent,col2_amount,col2_cl,col3_percent,col3_amount,col3_cl,col4_percent,col4_amount,col4_cl,col5_percent,col5_amount,col5_cl,col6_percent,col6_amount,col6_cl)
              VALUES
                  (1,'Semi Monthly','Semi Monthly',0.00,0.00,10417.00,0.20,0.00,10417.00,0.25,1250.00,16667.00,0.30,5416.67,33333.00,0.32,20416.67,83333.00,0.35,100416.67,333333.00),
                  (2,'Monthly','Monthly',0.00,0.00,20833.00,0.20,0.00,20833.00,0.25,2500.00,33333.00,0.30,10833.33,66667.00,0.32,40833.33,166667.00,0.35,200833.33,666667.00),
                  (4,'Weekly','Weekly',0.00,0.00,4808.00,0.20,0.00,4808.00,0.25,576.92,7692.00,0.30,2500.00,15385.00,0.32,9423.08,38462.00,0.35,46346.15,153846.00),
                  (5,'Salaried','Salaried',0.00,0.00,10417.00,0.20,0.00,10417.00,0.25,1250.00,16667.00,0.30,5416.67,33333.00,0.32,20416.67,83333.00,0.35,100416.67,333333.00)
                  ON DUPLICATE KEY UPDATE
                  ref_payfrequency_type.pay_frequency_type=VALUES(ref_payfrequency_type.pay_frequency_type),
                  ref_payfrequency_type.description=VALUES(ref_payfrequency_type.description)
        ";
        $this->db->query($sql);
    }
    // (3,'Daily','Daily',0.00,0.00,685.00,0.20,0.00,685.00,0.25,82.19,1096.00,0.30,356.16,2192.00,0.32,1342.47,5479.00, 0.35,6602.74,21918.00,1.00),

    function get_payfrequency_list($company_id,$ref_payfrequency_factor_id=null){
        $query = $this->db->query("SELECT 
                    rpf.*, rpff.pay_type_factor, rpff.ref_payfrequency_factor_id
                FROM
                    ref_payfrequency_type rpf
                        LEFT JOIN
                    ref_payfrequency_factor rpff ON rpff.ref_payfrequency_id = rpf.ref_payfrequency_type_id
                WHERE
                    rpff.company_id = $company_id
                    ".($ref_payfrequency_factor_id==null?"":" AND rpff.ref_payfrequency_factor_id='".$ref_payfrequency_factor_id."'")."");
                return $query->result();  
    }

}
?>