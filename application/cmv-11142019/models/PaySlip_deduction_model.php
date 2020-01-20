<?php

class PaySlip_deduction_model extends CORE_Model {
    protected  $table="pay_slip_deduction";
    protected  $pk_id="pay_slip_deduction_id";
    protected  $fk_id="pay_slip_id";

    function __construct() {
        parent::__construct();
    }
}
?>