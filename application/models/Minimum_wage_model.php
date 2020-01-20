<?php
class Minimum_wage_model extends CORE_Model {
    protected  $table="minimum_wage";
    protected  $pk_id="wage_id";

    function __construct() {
        parent::__construct();
    }

}
?>