<?php

class RefFactorFile_model extends CORE_Model {
    protected  $table="reffactorfile";
    protected  $pk_id="factor_id";

    function __construct() {
        parent::__construct();
    }

    function chck_ref_factor_file($company_id){
      $query = $this->db->query("SELECT * FROM reffactorfile WHERE company_id =".$company_id);
      return $query->result();
    }

    function create_default_ref_factor_file($company_id){
        $reffactorfile ="INSERT INTO reffactorfile (company_id,
        						regular_ot,
        						sunday,
        						day_off,
        						sunday_ot,
        						regular_holiday,
        						regular_holiday_ot,
        						sun_regular_holiday,
        						sun_regular_holiday_ot,
        						spe_holiday,
        						spe_holiday_ot,
        						sun_spe_holiday,
        						sun_spe_holiday_ot,
        						pagibig1,
        						pagibig2,
        						night_shift,
        						sun_night_shift,
        						night_shift_reg_holiday,
        						sun_night_shift_reg_holiday,
        						night_shift_spe_holiday,
        						sun_night_shift_spe_holiday) 
        						values (
        						$company_id,
        						1.25000,
        						1.30000,
        						1.25000,
        						1.69000,
        						2.00000,
        						2.30000,
        						2.60000,
        						2.90000,
        						1.30000,
        						1.69000,
        						1.50000,
        						1.69000,
        						100.00000,
        						0.00000,
        						0.10000,
        						0.10000,
        						0.10000,
        						0.10000,
        						0.10000,
        						0.10000
        						)";
        $this->db->query($reffactorfile);
    }
    
    function get_reffactorfile_list($company_id,$factor_id=null){
      $query = $this->db->query("SELECT * FROM reffactorfile WHERE 
      			company_id =".$company_id."
      			".($factor_id==null?"":" AND factor_id=".$factor_id."")."
      			");
      return $query->result();
    }
}
?>