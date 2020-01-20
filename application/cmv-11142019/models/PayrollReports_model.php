<?php

class PayrollReports_model extends CORE_Model {
    protected  $table="";
    protected  $pk_id="";

    function __construct() {
        parent::__construct();
    }

    function filter_function_adjustment($filter_value,$filter_value2,$filter_value3) {
                        if($filter_value2=="all" AND $filter_value3=="all"){
                        $filter_salary_adjustment=array('pay_slip_other_earnings.earnings_id'=>2,'daily_time_record.pay_period_id'=>$filter_value,'emp_rates_duties.active_rates_duties'=>TRUE);
                        }
                        if($filter_value2=="all" AND $filter_value3!="all"){
                        $filter_salary_adjustment=array('pay_slip_other_earnings.earnings_id'=>2,'daily_time_record.pay_period_id'=>$filter_value,'ref_branch.ref_branch_id'=>$filter_value3,'emp_rates_duties.active_rates_duties'=>TRUE);
                        }
                        if($filter_value2!="all" AND $filter_value3=="all"){
                        $filter_salary_adjustment=array('pay_slip_other_earnings.earnings_id'=>2,'daily_time_record.pay_period_id'=>$filter_value,'ref_department.ref_department_id'=>$filter_value2,'emp_rates_duties.active_rates_duties'=>TRUE);
                        }
                        if($filter_value2!="all" AND $filter_value3!="all"){
                        $filter_salary_adjustment=array('pay_slip_other_earnings.earnings_id'=>2,'daily_time_record.pay_period_id'=>$filter_value,'ref_department.ref_department_id'=>$filter_value2,'ref_branch.ref_branch_id'=>$filter_value3,'emp_rates_duties.active_rates_duties'=>TRUE);
                        }

                          return $filter_salary_adjustment;
    }

    function filter_function_otherearnings($filter_value,$filter_value2,$filter_value3) {
                        if($filter_value2=="all" AND $filter_value3=="all"){
                        $filter_other_earnings=array('pay_slip_other_earnings.earnings_id!=2','daily_time_record.pay_period_id'=>$filter_value,'emp_rates_duties.active_rates_duties'=>TRUE);
                        }
                        if($filter_value2=="all" AND $filter_value3!="all"){
                        $filter_other_earnings=array('pay_slip_other_earnings.earnings_id!=2','daily_time_record.pay_period_id'=>$filter_value,'ref_branch.ref_branch_id'=>$filter_value3,'emp_rates_duties.active_rates_duties'=>TRUE);
                        }
                        if($filter_value2!="all" AND $filter_value3=="all"){
                        $filter_other_earnings=array('pay_slip_other_earnings.earnings_id!=2','daily_time_record.pay_period_id'=>$filter_value,'ref_department.ref_department_id'=>$filter_value2,'emp_rates_duties.active_rates_duties'=>TRUE);
                        }
                        if($filter_value2!="all" AND $filter_value3!="all"){
                        $filter_other_earnings=array('pay_slip_other_earnings.earnings_id!=2','daily_time_record.pay_period_id'=>$filter_value,'ref_department.ref_department_id'=>$filter_value2,'ref_branch.ref_branch_id'=>$filter_value3,'emp_rates_duties.active_rates_duties'=>TRUE);
                        }

                          return $filter_other_earnings;
    }

    function filter_function_deduction($deduction_id_filter,$filter_value,$filter_value2,$filter_value3) {
                        if($filter_value2=="all" AND $filter_value3=="all"){
                        $filter_sss=array('pay_slip_deductions.deduction_id'=>$deduction_id_filter,'daily_time_record.pay_period_id'=>$filter_value,'emp_rates_duties.active_rates_duties'=>TRUE,'active_deduct'=>TRUE);
                        }
                        if($filter_value2=="all" AND $filter_value3!="all"){
                        $filter_sss=array('pay_slip_deductions.deduction_id'=>$deduction_id_filter,'daily_time_record.pay_period_id'=>$filter_value,'ref_branch.ref_branch_id'=>$filter_value3,'emp_rates_duties.active_rates_duties'=>TRUE,'active_deduct'=>TRUE);
                        }
                        if($filter_value2!="all" AND $filter_value3=="all"){
                        $filter_sss=array('pay_slip_deductions.deduction_id'=>$deduction_id_filter,'daily_time_record.pay_period_id'=>$filter_value,'ref_department.ref_department_id'=>$filter_value2,'emp_rates_duties.active_rates_duties'=>TRUE,'active_deduct'=>TRUE);
                        }
                        if($filter_value2!="all" AND $filter_value3!="all"){
                        $filter_sss=array('pay_slip_deductions.deduction_id'=>$deduction_id_filter,'daily_time_record.pay_period_id'=>$filter_value,'ref_department.ref_department_id'=>$filter_value2,'ref_branch.ref_branch_id'=>$filter_value3,'emp_rates_duties.active_rates_duties'=>TRUE,'active_deduct'=>TRUE);
                        }

                          return $filter_sss;
    }

    function filter_function_other_deduction($filter_value,$filter_value2,$filter_value3) {
                        if($filter_value2=="all" AND $filter_value3=="all"){
                        $filter_sss=array('pay_slip_deductions.deduction_id!=1','pay_slip_deductions.deduction_id!=2',
                                          'pay_slip_deductions.deduction_id!=3','pay_slip_deductions.deduction_id!=4',
                                          'pay_slip_deductions.deduction_id!=5','pay_slip_deductions.deduction_id!=6',
                                          'pay_slip_deductions.deduction_id!=7','pay_slip_deductions.deduction_id!=8',
                                          'pay_slip_deductions.deduction_id!=9',
                                          'daily_time_record.pay_period_id'=>$filter_value,'emp_rates_duties.active_rates_duties'=>TRUE,'active_deduct'=>TRUE);
                        }
                        if($filter_value2=="all" AND $filter_value3!="all"){
                        $filter_sss=array('pay_slip_deductions.deduction_id'=>$deduction_id_filter,'daily_time_record.pay_period_id'=>$filter_value,'ref_branch.ref_branch_id'=>$filter_value3,'emp_rates_duties.active_rates_duties'=>TRUE,'active_deduct'=>TRUE);
                        }
                        if($filter_value2!="all" AND $filter_value3=="all"){
                        $filter_sss=array('pay_slip_deductions.deduction_id'=>$deduction_id_filter,'daily_time_record.pay_period_id'=>$filter_value,'ref_department.ref_department_id'=>$filter_value2,'emp_rates_duties.active_rates_duties'=>TRUE,'active_deduct'=>TRUE);
                        }
                        if($filter_value2!="all" AND $filter_value3!="all"){
                        $filter_sss=array('pay_slip_deductions.deduction_id'=>$deduction_id_filter,'daily_time_record.pay_period_id'=>$filter_value,'ref_department.ref_department_id'=>$filter_value2,'ref_branch.ref_branch_id'=>$filter_value3,'emp_rates_duties.active_rates_duties'=>TRUE,'active_deduct'=>TRUE);
                        }

                          return $filter_sss;
    }

    function get_payroll_register($pay_period,$branch,$department,$register_type,$is_active){
        $query = $this->db->query("SELECT 
                        dtr.*,
                        CONCAT(emp.first_name,
                                ' ',
                                emp.middle_name,
                                ' ',
                                emp.last_name) AS full_name,
                        emp.ecode,
                        emp.bank_account
                    FROM
                        pay_slip ps
                            LEFT JOIN
                        daily_time_record dtr ON dtr.dtr_id = ps.dtr_id
                            LEFT JOIN
                        employee_list emp ON emp.employee_id = dtr.employee_id
                    WHERE
                        dtr.is_processed = 1
                            AND dtr.is_deleted = 0
                            AND dtr.pay_period_id = $pay_period
                            AND emp.is_deleted = 0
                            ".($branch=='all'?"":" AND emp.ref_branch_id=".$branch."")."
                            ".($department=='all'?"":" AND emp.ref_department_id=".$department."")."
                            ".($register_type==1?" AND emp.bank_account_isprocess = 0":" AND emp.bank_account != '' AND emp.bank_account_isprocess = 1")."
                            ".($is_active=='all'?"":" AND emp.is_active=".$is_active."")."
                    ORDER BY emp.last_name");
               return $query->result();
    }

    function get_employee_history($filter_value,$filter_value2,$filter_value3) {
            //1=allowance 2=salary adjustments 3=meal allowance 4=other allowance 5=commision edited na d na standard
            $query = $this->db->query('SELECT ps.*,CONCAT(el.first_name," ",el.middle_name," ",el.last_name) as fullname,rpp.pay_period_start,rpp.pay_period_end,
                                                    psdsss.sss_deduction,psdphil.philhealth_deduction,
                                                    psdpagibig.pagibig_deduction,psdwtax.wtax_deduction,psdsssloan.sssloan_deduction,
                                                    psdpagibigloan.pagibigloan_deduction,psdcooploan.cooploan_deduction,psdcoopcontrib.coopcontribution_deduction,
                                                    psdcashadvance.cashadvance_deduction,COALESCE(ROUND(psoeall.allowance,2),0) as allowance,COALESCE(ROUND(psoea.adjustment,2),0) as adjustment
                                                    ,COALESCE(ROUND(psoec.other_earnings,2),0) as other_earnings,psdcalamityloan.calamityloan_deduction,psod.other_deductions
                                         FROM pay_slip as ps
                                        LEFT JOIN daily_time_record as dtr
                                            ON ps.dtr_id=dtr.dtr_id
                                        LEFT JOIN employee_list as el
                                        ON dtr.employee_id=el.employee_id
                                        LEFT JOIN emp_rates_duties as erd
                                        ON el.employee_id=erd.employee_id
                                        LEFT JOIN refpayperiod as rpp
                                            ON dtr.pay_period_id=rpp.pay_period_id
                                        LEFT JOIN (SELECT pay_slip_id,SUM(earnings_amount) as allowance FROM pay_slip_other_earnings WHERE earnings_id=1
                                            GROUP BY pay_slip_id) as psoeall
                                                ON ps.pay_slip_id=psoeall.pay_slip_id
                                        LEFT JOIN (SELECT pay_slip_id,SUM(earnings_amount) as adjustment FROM pay_slip_other_earnings WHERE earnings_id=2
                                            GROUP BY pay_slip_id) as psoea
                                                ON ps.pay_slip_id=psoea.pay_slip_id
                                        LEFT JOIN (SELECT pay_slip_id,SUM(earnings_amount) as other_earnings FROM pay_slip_other_earnings WHERE earnings_id!=1 AND earnings_id!=2
                                            GROUP BY pay_slip_id) as psoec
                                                ON ps.pay_slip_id=psoec.pay_slip_id
                                        LEFT JOIN (SELECT pay_slip_id,(deduction_amount) as sss_deduction FROM pay_slip_deductions WHERE deduction_id=1) as psdsss
                                            ON ps.pay_slip_id=psdsss.pay_slip_id
                                        LEFT JOIN (SELECT pay_slip_id,(deduction_amount) as philhealth_deduction FROM pay_slip_deductions WHERE deduction_id=2) as psdphil
                                            ON ps.pay_slip_id=psdphil.pay_slip_id
                                        LEFT JOIN (SELECT pay_slip_id,(deduction_amount) as pagibig_deduction FROM pay_slip_deductions WHERE deduction_id=3) as psdpagibig
                                            ON ps.pay_slip_id=psdpagibig.pay_slip_id
                                        LEFT JOIN (SELECT pay_slip_id,(deduction_amount) as wtax_deduction FROM pay_slip_deductions WHERE deduction_id=4) as psdwtax
                                            ON ps.pay_slip_id=psdwtax.pay_slip_id
                                        LEFT JOIN (SELECT pay_slip_id,(deduction_amount) as sssloan_deduction FROM pay_slip_deductions WHERE deduction_id=5) as psdsssloan
                                            ON ps.pay_slip_id=psdsssloan.pay_slip_id
                                        LEFT JOIN (SELECT pay_slip_id,(deduction_amount) as pagibigloan_deduction FROM pay_slip_deductions WHERE deduction_id=6) as psdpagibigloan
                                            ON ps.pay_slip_id=psdpagibigloan.pay_slip_id
                                        LEFT JOIN (SELECT pay_slip_id,(deduction_amount) as cashadvance_deduction FROM pay_slip_deductions WHERE deduction_id=7) as psdcashadvance
                                            ON ps.pay_slip_id=psdcashadvance.pay_slip_id
                                        LEFT JOIN (SELECT pay_slip_id,(deduction_amount) as cooploan_deduction FROM pay_slip_deductions WHERE deduction_id=8) as psdcooploan
                                            ON ps.pay_slip_id=psdcooploan.pay_slip_id
                                        LEFT JOIN (SELECT pay_slip_id,(deduction_amount) as calamityloan_deduction FROM pay_slip_deductions WHERE deduction_id=12) as psdcalamityloan
                                            ON ps.pay_slip_id=psdcalamityloan.pay_slip_id
                                        LEFT JOIN (SELECT pay_slip_id,SUM(deduction_amount) as other_deductions FROM pay_slip_deductions
                                            LEFT JOIN refdeduction
                                            ON refdeduction.deduction_id=pay_slip_deductions.deduction_id
                                            WHERE refdeduction.deduction_type_id!=1 AND refdeduction.deduction_type_id!=2 AND refdeduction.deduction_type_id!=4 AND active_deduct=TRUE
                                            GROUP BY pay_slip_id) as psod
                                                ON ps.pay_slip_id=psod.pay_slip_id
                                        LEFT JOIN (SELECT pay_slip_id,(deduction_amount) as coopcontribution_deduction FROM pay_slip_deductions WHERE deduction_id=9) as psdcoopcontrib
                                            ON ps.pay_slip_id=psdcoopcontrib.pay_slip_id WHERE 

                                                rpp.pay_period_id='.$filter_value2.' 
                                                '.($filter_value == "all"?"":" AND dtr.employee_id='".$filter_value."'").'
                                                AND erd.active_rates_duties=1 AND erd.ref_branch_id='.$filter_value3.' 
                                                ORDER BY el.last_name');

            return $query->result();
    }

    function get_employee_history_filter_year($filter_value2,$filter_value3) {
            //1=allowance 2=salary adjustments 3=meal allowance 4=other allowance 5=commision
            $query = $this->db->query('SELECT ps.*,CONCAT(el.first_name," ",el.middle_name," ",el.last_name) as fullname,rpp.pay_period_start,rpp.pay_period_end,
                                                    psdsss.sss_deduction,psdphil.philhealth_deduction,
                                                    psdpagibig.pagibig_deduction,psdwtax.wtax_deduction,psdsssloan.sssloan_deduction,
                                                    psdpagibigloan.pagibigloan_deduction,psdcooploan.cooploan_deduction,psdcoopcontrib.coopcontribution_deduction,
                                                    psdcashadvance.cashadvance_deduction,COALESCE(ROUND(psoeall.allowance,2),0) as allowance,COALESCE(ROUND(psoea.adjustment,2),0) as adjustment
                                                    ,COALESCE(ROUND(psoec.other_earnings,2),0) as other_earnings,psdcalamityloan.calamityloan_deduction,psod.other_deductions
                                         FROM pay_slip as ps
                                        LEFT JOIN daily_time_record as dtr
                                            ON ps.dtr_id=dtr.dtr_id
                                        LEFT JOIN employee_list as el
                                        ON dtr.employee_id=el.employee_id
                                        LEFT JOIN emp_rates_duties as erd
                                        ON el.employee_id=erd.employee_id
                                        LEFT JOIN refpayperiod as rpp
                                            ON dtr.pay_period_id=rpp.pay_period_id
                                        LEFT JOIN (SELECT pay_slip_id,SUM(earnings_amount) as allowance FROM pay_slip_other_earnings WHERE earnings_id=1
                                            GROUP BY pay_slip_id) as psoeall
                                                ON ps.pay_slip_id=psoeall.pay_slip_id
                                        LEFT JOIN (SELECT pay_slip_id,SUM(earnings_amount) as adjustment FROM pay_slip_other_earnings WHERE earnings_id=2
                                            GROUP BY pay_slip_id) as psoea
                                                ON ps.pay_slip_id=psoea.pay_slip_id
                                        LEFT JOIN (SELECT pay_slip_id,SUM(earnings_amount) as other_earnings FROM pay_slip_other_earnings WHERE earnings_id!=1 AND earnings_id!=2
                                            GROUP BY pay_slip_id) as psoec
                                                ON ps.pay_slip_id=psoec.pay_slip_id
                                        LEFT JOIN (SELECT pay_slip_id,(deduction_amount) as sss_deduction FROM pay_slip_deductions WHERE deduction_id=1) as psdsss
                                            ON ps.pay_slip_id=psdsss.pay_slip_id
                                        LEFT JOIN (SELECT pay_slip_id,(deduction_amount) as philhealth_deduction FROM pay_slip_deductions WHERE deduction_id=2) as psdphil
                                            ON ps.pay_slip_id=psdphil.pay_slip_id
                                        LEFT JOIN (SELECT pay_slip_id,(deduction_amount) as pagibig_deduction FROM pay_slip_deductions WHERE deduction_id=3) as psdpagibig
                                            ON ps.pay_slip_id=psdpagibig.pay_slip_id
                                        LEFT JOIN (SELECT pay_slip_id,(deduction_amount) as wtax_deduction FROM pay_slip_deductions WHERE deduction_id=4) as psdwtax
                                            ON ps.pay_slip_id=psdwtax.pay_slip_id
                                        LEFT JOIN (SELECT pay_slip_id,(deduction_amount) as sssloan_deduction FROM pay_slip_deductions WHERE deduction_id=5) as psdsssloan
                                            ON ps.pay_slip_id=psdsssloan.pay_slip_id
                                        LEFT JOIN (SELECT pay_slip_id,(deduction_amount) as pagibigloan_deduction FROM pay_slip_deductions WHERE deduction_id=6) as psdpagibigloan
                                            ON ps.pay_slip_id=psdpagibigloan.pay_slip_id
                                        LEFT JOIN (SELECT pay_slip_id,(deduction_amount) as cashadvance_deduction FROM pay_slip_deductions WHERE deduction_id=7) as psdcashadvance
                                            ON ps.pay_slip_id=psdcashadvance.pay_slip_id
                                        LEFT JOIN (SELECT pay_slip_id,(deduction_amount) as cooploan_deduction FROM pay_slip_deductions WHERE deduction_id=8) as psdcooploan
                                            ON ps.pay_slip_id=psdcooploan.pay_slip_id
                                        LEFT JOIN (SELECT pay_slip_id,(deduction_amount) as calamityloan_deduction FROM pay_slip_deductions WHERE deduction_id=12) as psdcalamityloan
                                            ON ps.pay_slip_id=psdcalamityloan.pay_slip_id
                                        LEFT JOIN (SELECT pay_slip_id,SUM(deduction_amount) as other_deductions FROM pay_slip_deductions
                                            LEFT JOIN refdeduction
                                            ON refdeduction.deduction_id=pay_slip_deductions.deduction_id
                                            WHERE refdeduction.deduction_type_id!=1 AND refdeduction.deduction_type_id!=2 AND refdeduction.deduction_type_id!=4 AND active_deduct=TRUE
                                            GROUP BY pay_slip_id) as psod
                                                ON ps.pay_slip_id=psod.pay_slip_id
                                        LEFT JOIN (SELECT pay_slip_id,(deduction_amount) as coopcontribution_deduction FROM pay_slip_deductions WHERE deduction_id=9) as psdcoopcontrib
                                            ON ps.pay_slip_id=psdcoopcontrib.pay_slip_id WHERE rpp.pay_period_id='.$filter_value2.' AND erd.active_rates_duties=1 AND erd.ref_branch_id='.$filter_value3.' 
                                            ORDER BY el.last_name');

            return $query->result();
    }

    // function get_employee_history_filter_employee($filter_value,$filter_value3) {
    //         //1=allowance 2=salary adjustments 3=meal allowance 4=other allowance 5=commision
    //         $query = $this->db->query('SELECT ps.*,CONCAT(el.first_name," ",el.middle_name," ",el.last_name) as fullname,rpp.pay_period_start,rpp.pay_period_end,
    //                                                 psdsss.sss_deduction,psdphil.philhealth_deduction,
    //                                                 psdpagibig.pagibig_deduction,psdwtax.wtax_deduction,psdsssloan.sssloan_deduction,
    //                                                 psdpagibigloan.pagibigloan_deduction,psdcooploan.cooploan_deduction,psdcoopcontrib.coopcontribution_deduction,
    //                                                 psdcashadvance.cashadvance_deduction/*,psdcalamityloan.calamityloan_deduction*/
    //                                      FROM pay_slip as ps
    //                                     LEFT JOIN daily_time_record as dtr
    //                                         ON ps.dtr_id=dtr.dtr_id
    //                                     LEFT JOIN employee_list as el
    //                                     ON dtr.employee_id=el.employee_id
    //                                     LEFT JOIN emp_rates_duties as erd
    //                                     ON el.employee_id=erd.employee_id
    //                                     LEFT JOIN refpayperiod as rpp
    //                                         ON dtr.pay_period_id=rpp.pay_period_id
    //                                    /* LEFT JOIN (SELECT pay_slip_id,SUM(earnings_amount) as allowance FROM pay_slip_other_earnings WHERE earnings_id=1) as psoe
    //                                             ON ps.pay_slip_id=psoe.pay_slip_id
    //                                     LEFT JOIN (SELECT pay_slip_id,SUM(earnings_amount) as adjustment FROM pay_slip_other_earnings WHERE earnings_id=6
    //                                         GROUP BY earnings_id) as psoea
    //                                             ON ps.pay_slip_id=psoea.pay_slip_id
    //                                     LEFT JOIN (SELECT pay_slip_id,SUM(earnings_amount) as other_earnings FROM pay_slip_other_earnings WHERE earnings_id!=1 AND earnings_id!=6
    //                                         GROUP BY earnings_id) as psoec
    //                                             ON ps.pay_slip_id=psoec.pay_slip_id*/
    //                                     LEFT JOIN (SELECT pay_slip_id,(deduction_amount) as sss_deduction FROM pay_slip_deductions WHERE deduction_id=1) as psdsss
    //                                         ON ps.pay_slip_id=psdsss.pay_slip_id
    //                                     LEFT JOIN (SELECT pay_slip_id,(deduction_amount) as philhealth_deduction FROM pay_slip_deductions WHERE deduction_id=2) as psdphil
    //                                         ON ps.pay_slip_id=psdphil.pay_slip_id
    //                                     LEFT JOIN (SELECT pay_slip_id,(deduction_amount) as pagibig_deduction FROM pay_slip_deductions WHERE deduction_id=3) as psdpagibig
    //                                         ON ps.pay_slip_id=psdpagibig.pay_slip_id
    //                                     LEFT JOIN (SELECT pay_slip_id,(deduction_amount) as wtax_deduction FROM pay_slip_deductions WHERE deduction_id=4) as psdwtax
    //                                         ON ps.pay_slip_id=psdwtax.pay_slip_id
    //                                     LEFT JOIN (SELECT pay_slip_id,deduction_amount as sssloan_deduction FROM pay_slip_deductions WHERE deduction_id=5) as psdsssloan
    //                                         ON ps.pay_slip_id=psdsssloan.pay_slip_id
    //                                     LEFT JOIN (SELECT pay_slip_id,(deduction_amount) as pagibigloan_deduction FROM pay_slip_deductions WHERE deduction_id=6) as psdpagibigloan
    //                                         ON ps.pay_slip_id=psdpagibigloan.pay_slip_id
    //                                     LEFT JOIN (SELECT pay_slip_id,(deduction_amount) as cashadvance_deduction FROM pay_slip_deductions WHERE deduction_id=7) as psdcashadvance
    //                                         ON ps.pay_slip_id=psdcashadvance.pay_slip_id
    //                                     LEFT JOIN (SELECT pay_slip_id,(deduction_amount) as cooploan_deduction FROM pay_slip_deductions WHERE deduction_id=8) as psdcooploan
    //                                         ON ps.pay_slip_id=psdcooploan.pay_slip_id
    //                                     /*LEFT JOIN (SELECT pay_slip_id,(deduction_amount) as calamityloan_deduction FROM pay_slip_deductions WHERE deduction_id=12) as psdcalamityloan
    //                                         ON ps.pay_slip_id=psdcalamityloan.pay_slip_id*/
    //                                     LEFT JOIN (SELECT pay_slip_id,(deduction_amount) as coopcontribution_deduction FROM pay_slip_deductions WHERE deduction_id=9) as psdcoopcontrib
    //                                         ON ps.pay_slip_id=psdcoopcontrib.pay_slip_id WHERE dtr.employee_id='.$filter_value.' AND erd.active_rates_duties=1 AND erd.ref_branch_id='.$filter_value3.' ORDER BY fullname');
    //
    //         return $query->result();
    // }
    //
    // function get_employee_history_wofilter($filter_value3) {
    //         //1=allowance 2=salary adjustments 3=meal allowance 4=other allowance 5=commision
    //         $query = $this->db->query('SELECT ps.*,CONCAT(el.first_name," ",el.middle_name," ",el.last_name) as fullname,rpp.pay_period_start,rpp.pay_period_end,
    //                                                 psdsss.sss_deduction,psdphil.philhealth_deduction,
    //                                                 psdpagibig.pagibig_deduction,psdwtax.wtax_deduction,psdsssloan.sssloan_deduction,
    //                                                 psdpagibigloan.pagibigloan_deduction,psdcooploan.cooploan_deduction,psdcoopcontrib.coopcontribution_deduction,
    //                                                 psdcashadvance.cashadvance_deduction/*,psdcalamityloan.calamityloan_deduction*/
    //                                      FROM pay_slip as ps
    //                                     LEFT JOIN daily_time_record as dtr
    //                                         ON ps.dtr_id=dtr.dtr_id
    //                                     LEFT JOIN employee_list as el
    //                                     ON dtr.employee_id=el.employee_id
    //                                     LEFT JOIN emp_rates_duties as erd
    //                                     ON el.employee_id=erd.employee_id
    //                                     LEFT JOIN refpayperiod as rpp
    //                                         ON dtr.pay_period_id=rpp.pay_period_id
    //                                    /* LEFT JOIN (SELECT pay_slip_id,SUM(earnings_amount) as allowance FROM pay_slip_other_earnings WHERE earnings_id=1
    //                                         GROUP BY earnings_id) as psoe
    //                                             ON ps.pay_slip_id=psoe.pay_slip_id
    //                                     LEFT JOIN (SELECT pay_slip_id,SUM(earnings_amount) as adjustment FROM pay_slip_other_earnings WHERE earnings_id=6
    //                                         GROUP BY earnings_id) as psoea
    //                                             ON ps.pay_slip_id=psoea.pay_slip_id
    //                                     LEFT JOIN (SELECT pay_slip_id,SUM(earnings_amount) as other_earnings FROM pay_slip_other_earnings WHERE earnings_id!=1 AND earnings_id!=6
    //                                         GROUP BY earnings_id) as psoec
    //                                             ON ps.pay_slip_id=psoec.pay_slip_id*/
    //                                     LEFT JOIN (SELECT pay_slip_id,(deduction_amount) as sss_deduction FROM pay_slip_deductions WHERE deduction_id=1) as psdsss
    //                                         ON ps.pay_slip_id=psdsss.pay_slip_id
    //                                     LEFT JOIN (SELECT pay_slip_id,(deduction_amount) as philhealth_deduction FROM pay_slip_deductions WHERE deduction_id=2) as psdphil
    //                                         ON ps.pay_slip_id=psdphil.pay_slip_id
    //                                     LEFT JOIN (SELECT pay_slip_id,(deduction_amount) as pagibig_deduction FROM pay_slip_deductions WHERE deduction_id=3) as psdpagibig
    //                                         ON ps.pay_slip_id=psdpagibig.pay_slip_id
    //                                     LEFT JOIN (SELECT pay_slip_id,(deduction_amount) as wtax_deduction FROM pay_slip_deductions WHERE deduction_id=4) as psdwtax
    //                                         ON ps.pay_slip_id=psdwtax.pay_slip_id
    //                                     LEFT JOIN (SELECT pay_slip_id,(deduction_amount) as sssloan_deduction FROM pay_slip_deductions WHERE deduction_id=5) as psdsssloan
    //                                         ON ps.pay_slip_id=psdsssloan.pay_slip_id
    //                                     LEFT JOIN (SELECT pay_slip_id,(deduction_amount) as pagibigloan_deduction FROM pay_slip_deductions WHERE deduction_id=6) as psdpagibigloan
    //                                         ON ps.pay_slip_id=psdpagibigloan.pay_slip_id
    //                                     LEFT JOIN (SELECT pay_slip_id,(deduction_amount) as cashadvance_deduction FROM pay_slip_deductions WHERE deduction_id=7) as psdcashadvance
    //                                         ON ps.pay_slip_id=psdcashadvance.pay_slip_id
    //                                     LEFT JOIN (SELECT pay_slip_id,(deduction_amount) as cooploan_deduction FROM pay_slip_deductions WHERE deduction_id=8) as psdcooploan
    //                                         ON ps.pay_slip_id=psdcooploan.pay_slip_id
    //                                         /*LEFT JOIN (SELECT pay_slip_id,(deduction_amount) as calamityloan_deduction FROM pay_slip_deductions WHERE deduction_id=12) as psdcalamityloan
    //                                         ON ps.pay_slip_id=psdcalamityloan.pay_slip_id*/
    //                                     LEFT JOIN (SELECT pay_slip_id,(deduction_amount) as coopcontribution_deduction FROM pay_slip_deductions WHERE deduction_id=9) as psdcoopcontrib
    //                                         ON ps.pay_slip_id=psdcoopcontrib.pay_slip_id  WHERE erd.active_rates_duties=1 AND erd.ref_branch_id='.$filter_value3);
    //
    //         return $query->result();
    // }

    function get_1601C_list($company_id,$year,$month,$ref_branch_id,$ref_department_id,$is_active){
         $query = $this->db->query("SELECT 
                            c.*,
                            (SELECT 
                                    (CASE
                                            WHEN col1_cl > c.compensation THEN (((c.compensation - col1_cl) * (col1_percent)) + (col1_amount))
                                            WHEN c.compensation BETWEEN col2_cl AND col3_cl THEN (((c.compensation - col2_cl) * (col2_percent)) + (col2_amount))
                                            WHEN c.compensation BETWEEN col3_cl AND col4_cl THEN (((c.compensation - col3_cl) * (col3_percent)) + (col3_amount))
                                            WHEN c.compensation BETWEEN col4_cl AND col5_cl THEN (((c.compensation - col4_cl) * (col4_percent)) + (col4_amount))
                                            WHEN c.compensation BETWEEN col5_cl AND col6_cl THEN (((c.compensation - col5_cl) * (col5_percent)) + (col5_amount))
                                            ELSE (((c.compensation - col6_cl) * (col6_percent)) + (col6_amount))
                                        END) AS wtax
                                FROM
                                    ref_payfrequency_type
                                WHERE
                                    ref_payfrequency_type_id = 2) AS wtax
                        FROM
                            (SELECT 
                                b.*,
                                    (b.gross_pay - (b.SSSeE + b.HDMFee + b.PHICeE)) AS compensation
                            FROM
                                (SELECT 
                                emp.ecode,
                                    emp.last_name,
                                    emp.first_name,
                                    emp.middle_name,
                                    emp.tin,
                                    dtr.holiday_pay,
                                    emp.per_day_pay,
                                    SUM(dtr.basic_pay_total) AS reg_pay,
                                    SUM(dtr.gross_total) AS gross_pay,
                                    SUM(dtr.sss_deduction) AS SSSeE,
                                    SUM(dtr.sss_employer) AS SSSeR,
                                    SUM(dtr.sss_employer_contribution) AS SSSeC,
                                    SUM(dtr.philhealth_deduction) AS PHICeE,
                                    SUM(dtr.philhealth_employer) AS PHICeR,
                                    SUM(dtr.pagibig_deduction) AS HDMFee,
                                    SUM(dtr.pagibig_deduction) AS HDMFeR
                            FROM
                                pay_slip ps
                            LEFT JOIN daily_time_record dtr ON dtr.dtr_id = ps.dtr_id
                            LEFT JOIN employee_list emp ON emp.employee_id = dtr.employee_id
                            LEFT JOIN refpayperiod rpp ON rpp.pay_period_id = dtr.pay_period_id
                            WHERE
                                rpp.month_id = $month
                                    AND EXTRACT(YEAR FROM rpp.pay_period_end) = $year
                                    AND emp.company_id = $company_id
                                    AND emp.is_deleted = 0
                                    ".($is_active=='all'?"":" AND emp.is_active=".$is_active."")."
                                    ".($ref_branch_id=='all'?"":" AND emp.ref_branch_id=".$ref_branch_id."")."
                                    ".($ref_department_id=='all'?"":" AND emp.ref_department_id=".$ref_department_id."")."
                            GROUP BY dtr.employee_id) AS b) AS c");
         return $query->result();
    }

    function get_monthly_salary_history($filter_value,$filter_value2,$filter_value3,$filter_year) {
            //1=allowance 2=salary adjustments 3=meal allowance 4=other allowance 5=commision edited na d na standard
            $query = $this->db->query('SELECT ps.*,CONCAT(el.first_name," ",el.middle_name," ",el.last_name) as fullname,rpp.pay_period_start,rpp.pay_period_end,
                                                    psdsss.sss_deduction,psdphil.philhealth_deduction,
                                                    psdpagibig.pagibig_deduction,psdwtax.wtax_deduction,psdsssloan.sssloan_deduction,
                                                    psdpagibigloan.pagibigloan_deduction,psdcooploan.cooploan_deduction,psdcoopcontrib.coopcontribution_deduction,
                                                    psdcashadvance.cashadvance_deduction,COALESCE(ROUND(psoeall.allowance,2),0) as allowance,COALESCE(ROUND(psoea.adjustment,2),0) as adjustment
                                                    ,COALESCE(ROUND(psoec.other_earnings,2),0) as other_earnings,psdcalamityloan.calamityloan_deduction,psod.other_deductions
                                         FROM pay_slip as ps
                                        LEFT JOIN daily_time_record as dtr
                                            ON ps.dtr_id=dtr.dtr_id
                                        LEFT JOIN employee_list as el
                                        ON dtr.employee_id=el.employee_id
                                        LEFT JOIN emp_rates_duties as erd
                                        ON el.employee_id=erd.employee_id
                                        LEFT JOIN refpayperiod as rpp
                                            ON dtr.pay_period_id=rpp.pay_period_id
                                        /*LEFT JOIN (SELECT pay_slip_id,SUM(earnings_amount) as allowance FROM pay_slip_other_earnings WHERE earnings_id=1) as psoe
                                                ON ps.pay_slip_id=psoe.pay_slip_id
                                        LEFT JOIN (SELECT pay_slip_id,SUM(earnings_amount) as adjustment FROM pay_slip_other_earnings WHERE earnings_id=6
                                            GROUP BY earnings_id) as psoea
                                                ON ps.pay_slip_id=psoea.pay_slip_id
                                        LEFT JOIN (SELECT pay_slip_id,SUM(earnings_amount) as other_earnings FROM pay_slip_other_earnings WHERE earnings_id!=1 AND earnings_id!=6
                                            GROUP BY earnings_id) as psoec
                                                ON ps.pay_slip_id=psoec.pay_slip_id*/
                                        LEFT JOIN (SELECT pay_slip_id,SUM(earnings_amount) as allowance FROM pay_slip_other_earnings WHERE earnings_id=1
                                            GROUP BY pay_slip_id) as psoeall
                                                ON ps.pay_slip_id=psoeall.pay_slip_id
                                        LEFT JOIN (SELECT pay_slip_id,SUM(earnings_amount) as adjustment FROM pay_slip_other_earnings WHERE earnings_id=2
                                            GROUP BY pay_slip_id) as psoea
                                                ON ps.pay_slip_id=psoea.pay_slip_id
                                        LEFT JOIN (SELECT pay_slip_id,SUM(earnings_amount) as other_earnings FROM pay_slip_other_earnings WHERE earnings_id!=1 AND earnings_id!=2
                                            GROUP BY pay_slip_id) as psoec
                                                ON ps.pay_slip_id=psoec.pay_slip_id
                                        LEFT JOIN (SELECT pay_slip_id,(deduction_amount) as sss_deduction FROM pay_slip_deductions WHERE deduction_id=1) as psdsss
                                            ON ps.pay_slip_id=psdsss.pay_slip_id
                                        LEFT JOIN (SELECT pay_slip_id,(deduction_amount) as philhealth_deduction FROM pay_slip_deductions WHERE deduction_id=2) as psdphil
                                            ON ps.pay_slip_id=psdphil.pay_slip_id
                                        LEFT JOIN (SELECT pay_slip_id,(deduction_amount) as pagibig_deduction FROM pay_slip_deductions WHERE deduction_id=3) as psdpagibig
                                            ON ps.pay_slip_id=psdpagibig.pay_slip_id
                                        LEFT JOIN (SELECT pay_slip_id,(deduction_amount) as wtax_deduction FROM pay_slip_deductions WHERE deduction_id=4) as psdwtax
                                            ON ps.pay_slip_id=psdwtax.pay_slip_id
                                        LEFT JOIN (SELECT pay_slip_id,(deduction_amount) as sssloan_deduction FROM pay_slip_deductions WHERE deduction_id=5) as psdsssloan
                                            ON ps.pay_slip_id=psdsssloan.pay_slip_id
                                        LEFT JOIN (SELECT pay_slip_id,(deduction_amount) as pagibigloan_deduction FROM pay_slip_deductions WHERE deduction_id=6) as psdpagibigloan
                                            ON ps.pay_slip_id=psdpagibigloan.pay_slip_id
                                        LEFT JOIN (SELECT pay_slip_id,(deduction_amount) as cashadvance_deduction FROM pay_slip_deductions WHERE deduction_id=7) as psdcashadvance
                                            ON ps.pay_slip_id=psdcashadvance.pay_slip_id
                                        LEFT JOIN (SELECT pay_slip_id,(deduction_amount) as cooploan_deduction FROM pay_slip_deductions WHERE deduction_id=8) as psdcooploan
                                            ON ps.pay_slip_id=psdcooploan.pay_slip_id
                                        LEFT JOIN (SELECT pay_slip_id,(deduction_amount) as calamityloan_deduction FROM pay_slip_deductions WHERE deduction_id=12) as psdcalamityloan
                                            ON ps.pay_slip_id=psdcalamityloan.pay_slip_id
                                        LEFT JOIN (SELECT pay_slip_id,SUM(deduction_amount) as other_deductions FROM pay_slip_deductions
                                            LEFT JOIN refdeduction
                                            ON refdeduction.deduction_id=pay_slip_deductions.deduction_id
                                            WHERE refdeduction.deduction_type_id!=1 AND refdeduction.deduction_type_id!=2 AND refdeduction.deduction_type_id!=4 AND active_deduct=TRUE
                                            GROUP BY pay_slip_id) as psod
                                                ON ps.pay_slip_id=psod.pay_slip_id
                                        LEFT JOIN (SELECT pay_slip_id,(deduction_amount) as coopcontribution_deduction FROM pay_slip_deductions WHERE deduction_id=9) as psdcoopcontrib
                                            ON ps.pay_slip_id=psdcoopcontrib.pay_slip_id WHERE rpp.month_id='.$filter_value2.' AND extract(YEAR from rpp.pay_period_start)='.$filter_year.' 
                                                '.($filter_value == "all"?"":" AND dtr.employee_id='".$filter_value."'").'
                                                AND erd.active_rates_duties=1 AND erd.ref_branch_id='.$filter_value3.' 
                                                ORDER BY el.last_name');

            return $query->result();
    }

        function get_payroll_summary($pay_period_id,$ref_branch_id="all",$ref_department_id="all",$is_active,$greater_than_zero=null) {
            $query = $this->db->query("SELECT 
                    dtr.*,
                    CONCAT(emp.first_name,
                            ' ',
                            emp.middle_name,
                            ' ',
                            emp.last_name) AS full_name,
                    emp.bank_account_isprocess,
                    (SELECT reg_hol FROM emp_holiday_pay_list WHERE dtr_id = dtr.dtr_id) as reg_hol,
                    (SELECT reg_hol_amt FROM emp_holiday_pay_list WHERE dtr_id = dtr.dtr_id) as reg_hol_amt,
                    (SELECT sun_reg_hol FROM emp_holiday_pay_list WHERE dtr_id = dtr.dtr_id) as sun_reg_hol,
                    (SELECT sun_reg_hol_amt FROM emp_holiday_pay_list WHERE dtr_id = dtr.dtr_id) as sun_reg_hol_amt,
                    (SELECT spe_hol FROM emp_holiday_pay_list WHERE dtr_id = dtr.dtr_id) as spe_hol,
                    (SELECT spe_hol_amt FROM emp_holiday_pay_list WHERE dtr_id = dtr.dtr_id) as spe_hol_amt,
                    (SELECT sun_spe_hol FROM emp_holiday_pay_list WHERE dtr_id = dtr.dtr_id) as sun_spe_hol,
                    (SELECT sun_spe_hol_amt FROM emp_holiday_pay_list WHERE dtr_id = dtr.dtr_id) as sun_spe_hol_amt,
                    (SELECT reg_ot FROM emp_overtime_list WHERE dtr_id = dtr.dtr_id) as reg_ot,
                    (SELECT reg_ot_amt FROM emp_overtime_list WHERE dtr_id = dtr.dtr_id) as reg_ot_amt,
                    (SELECT sun_ot FROM emp_overtime_list WHERE dtr_id = dtr.dtr_id) as sun_ot,
                    (SELECT sun_ot_amt FROM emp_overtime_list WHERE dtr_id = dtr.dtr_id) as sun_ot_amt,
                    (SELECT reg_hol_ot FROM emp_overtime_list WHERE dtr_id = dtr.dtr_id) as reg_hol_ot,
                    (SELECT reg_hol_ot_amt FROM emp_overtime_list WHERE dtr_id = dtr.dtr_id) as reg_hol_ot_amt,
                    (SELECT sun_reg_hol_ot FROM emp_overtime_list WHERE dtr_id = dtr.dtr_id) as sun_reg_hol_ot,
                    (SELECT sun_reg_hol_ot_amt FROM emp_overtime_list WHERE dtr_id = dtr.dtr_id) as sun_reg_hol_ot_amt,
                    (SELECT spe_hol_ot FROM emp_overtime_list WHERE dtr_id = dtr.dtr_id) as spe_hol_ot,
                    (SELECT spe_hol_ot_amt FROM emp_overtime_list WHERE dtr_id = dtr.dtr_id) as spe_hol_ot_amt,
                    (SELECT sun_spe_hol_ot FROM emp_overtime_list WHERE dtr_id = dtr.dtr_id) as sun_spe_hol_ot,
                    (SELECT sun_spe_hol_ot_amt FROM emp_overtime_list WHERE dtr_id = dtr.dtr_id) as sun_spe_hol_ot_amt,
                    (dtr.sss_deduction + dtr.philhealth_deduction + dtr.pagibig_deduction + dtr.wtax_deduction + dtr.sss_loan + dtr.pagibig_loan + dtr.cash_advance) AS total_deduction,
                    (CASE
                        WHEN rl.ref_loan_id != null || rl.ref_loan_id != 0
                          THEN 
                            (CASE 
                              WHEN rl.ref_loan_id = 1
                                THEN psd.deduction_amount 
                                ELSE 0.00
                            END)
                        ELSE 0.00
                      END) AS sss_loan,
                      (CASE
                        WHEN rl.ref_loan_id != null || rl.ref_loan_id != 0
                          THEN 
                            (CASE 
                              WHEN rl.ref_loan_id = 2
                                THEN psd.deduction_amount 
                                ELSE 0.00
                            END)
                        ELSE 0.00
                      END) AS pagibig_loan,
                      (CASE
                        WHEN rl.ref_loan_id != null || rl.ref_loan_id != 0
                          THEN 
                            (CASE 
                              WHEN rl.ref_loan_id = 3
                                THEN psd.deduction_amount 
                                ELSE 0.00
                            END)
                        ELSE 0.00
                      END) AS cash_advance
                FROM
                    pay_slip ps
                        LEFT JOIN
                    daily_time_record dtr ON dtr.dtr_id = ps.dtr_id
                        LEFT JOIN
                    employee_list emp ON emp.employee_id = dtr.employee_id
                        LEFT JOIN
                    pay_slip_deduction psd ON psd.pay_slip_id = ps.pay_slip_id
                        LEFT JOIN
                    loan_list ll ON ll.loan_id = psd.deduction_id
                        LEFT JOIN
                    ref_loan rl ON rl.ref_loan_id = ll.ref_loan_id
                WHERE
                    dtr.is_deleted = 0
                        AND dtr.is_processed = 1
                        AND dtr.pay_period_id = $pay_period_id
                        AND emp.is_deleted = 0
                        ".($is_active=='all'?"":" AND emp.is_active=".$is_active."")."
                        ".($ref_branch_id=='all'?"":" AND emp.ref_branch_id=".$ref_branch_id."")."
                        ".($ref_department_id=='all'?"":" AND emp.ref_department_id=".$ref_department_id."")."
                        ".($greater_than_zero==null?"":" AND dtr.net_total > 0")."");
            return $query->result();
    }

    function get_monthly_salary_filter_year($filter_value2,$filter_value3,$filter_year) {
            //1=allowance 2=salary adjustments 3=meal allowance 4=other allowance 5=commision
            $query = $this->db->query('SELECT ps.*,CONCAT(el.first_name," ",el.middle_name," ",el.last_name) as fullname,rpp.pay_period_start,rpp.pay_period_end,
                                                    psdsss.sss_deduction,psdphil.philhealth_deduction,
                                                    psdpagibig.pagibig_deduction,psdwtax.wtax_deduction,psdsssloan.sssloan_deduction,
                                                    psdpagibigloan.pagibigloan_deduction,psdcooploan.cooploan_deduction,psdcoopcontrib.coopcontribution_deduction,
                                                    psdcashadvance.cashadvance_deduction,COALESCE(ROUND(psoeall.allowance,2),0) as allowance,COALESCE(ROUND(psoea.adjustment,2),0) as adjustment
                                                    ,COALESCE(ROUND(psoec.other_earnings,2),0) as other_earnings,psdcalamityloan.calamityloan_deduction,psod.other_deductions
                                         FROM pay_slip as ps
                                        LEFT JOIN daily_time_record as dtr
                                            ON ps.dtr_id=dtr.dtr_id
                                        LEFT JOIN employee_list as el
                                        ON dtr.employee_id=el.employee_id
                                        LEFT JOIN emp_rates_duties as erd
                                        ON el.employee_id=erd.employee_id
                                        LEFT JOIN refpayperiod as rpp
                                            ON dtr.pay_period_id=rpp.pay_period_id
                                        LEFT JOIN (SELECT pay_slip_id,SUM(earnings_amount) as allowance FROM pay_slip_other_earnings WHERE earnings_id=1
                                            GROUP BY pay_slip_id) as psoeall
                                                ON ps.pay_slip_id=psoeall.pay_slip_id
                                        LEFT JOIN (SELECT pay_slip_id,SUM(earnings_amount) as adjustment FROM pay_slip_other_earnings WHERE earnings_id=2
                                            GROUP BY pay_slip_id) as psoea
                                                ON ps.pay_slip_id=psoea.pay_slip_id
                                        LEFT JOIN (SELECT pay_slip_id,SUM(earnings_amount) as other_earnings FROM pay_slip_other_earnings WHERE earnings_id!=1 AND earnings_id!=2
                                            GROUP BY pay_slip_id) as psoec
                                                ON ps.pay_slip_id=psoec.pay_slip_id
                                        LEFT JOIN (SELECT pay_slip_id,(deduction_amount) as sss_deduction FROM pay_slip_deductions WHERE deduction_id=1) as psdsss
                                            ON ps.pay_slip_id=psdsss.pay_slip_id
                                        LEFT JOIN (SELECT pay_slip_id,(deduction_amount) as philhealth_deduction FROM pay_slip_deductions WHERE deduction_id=2) as psdphil
                                            ON ps.pay_slip_id=psdphil.pay_slip_id
                                        LEFT JOIN (SELECT pay_slip_id,(deduction_amount) as pagibig_deduction FROM pay_slip_deductions WHERE deduction_id=3) as psdpagibig
                                            ON ps.pay_slip_id=psdpagibig.pay_slip_id
                                        LEFT JOIN (SELECT pay_slip_id,(deduction_amount) as wtax_deduction FROM pay_slip_deductions WHERE deduction_id=4) as psdwtax
                                            ON ps.pay_slip_id=psdwtax.pay_slip_id
                                        LEFT JOIN (SELECT pay_slip_id,(deduction_amount) as sssloan_deduction FROM pay_slip_deductions WHERE deduction_id=5) as psdsssloan
                                            ON ps.pay_slip_id=psdsssloan.pay_slip_id
                                        LEFT JOIN (SELECT pay_slip_id,(deduction_amount) as pagibigloan_deduction FROM pay_slip_deductions WHERE deduction_id=6) as psdpagibigloan
                                            ON ps.pay_slip_id=psdpagibigloan.pay_slip_id
                                        LEFT JOIN (SELECT pay_slip_id,(deduction_amount) as cashadvance_deduction FROM pay_slip_deductions WHERE deduction_id=7) as psdcashadvance
                                            ON ps.pay_slip_id=psdcashadvance.pay_slip_id
                                        LEFT JOIN (SELECT pay_slip_id,(deduction_amount) as cooploan_deduction FROM pay_slip_deductions WHERE deduction_id=8) as psdcooploan
                                            ON ps.pay_slip_id=psdcooploan.pay_slip_id
                                        LEFT JOIN (SELECT pay_slip_id,(deduction_amount) as calamityloan_deduction FROM pay_slip_deductions WHERE deduction_id=12) as psdcalamityloan
                                            ON ps.pay_slip_id=psdcalamityloan.pay_slip_id
                                        LEFT JOIN (SELECT pay_slip_id,SUM(deduction_amount) as other_deductions FROM pay_slip_deductions
                                            LEFT JOIN refdeduction
                                            ON refdeduction.deduction_id=pay_slip_deductions.deduction_id
                                            WHERE refdeduction.deduction_type_id!=1 AND refdeduction.deduction_type_id!=2 AND refdeduction.deduction_type_id!=4 AND active_deduct=TRUE
                                            GROUP BY pay_slip_id) as psod
                                                ON ps.pay_slip_id=psod.pay_slip_id
                                        LEFT JOIN (SELECT pay_slip_id,(deduction_amount) as coopcontribution_deduction FROM pay_slip_deductions WHERE deduction_id=9) as psdcoopcontrib
                                            ON ps.pay_slip_id=psdcoopcontrib.pay_slip_id WHERE extract(MONTH from rpp.pay_period_start)='.$filter_value2.' AND extract(YEAR from rpp.pay_period_start)='.$filter_year.' AND erd.active_rates_duties=1 AND erd.ref_branch_id='.$filter_value3.'
                                            ORDER BY el.last_name');

            return $query->result();
    }

    // function get_monthly_salary_filter_employee($filter_value,$filter_value3) {
    //         //1=allowance 2=salary adjustments 3=meal allowance 4=other allowance 5=commision
    //         $query = $this->db->query('SELECT ps.*,CONCAT(el.first_name," ",el.middle_name," ",el.last_name) as fullname,rpp.pay_period_start,rpp.pay_period_end,
    //                                                 psdsss.sss_deduction,psdphil.philhealth_deduction,
    //                                                 psdpagibig.pagibig_deduction,psdwtax.wtax_deduction,psdsssloan.sssloan_deduction,
    //                                                 psdpagibigloan.pagibigloan_deduction,psdcooploan.cooploan_deduction,psdcoopcontrib.coopcontribution_deduction,
    //                                                 psdcashadvance.cashadvance_deduction/*,psdcalamityloan.calamityloan_deduction*/
    //                                      FROM pay_slip as ps
    //                                     LEFT JOIN daily_time_record as dtr
    //                                         ON ps.dtr_id=dtr.dtr_id
    //                                     LEFT JOIN employee_list as el
    //                                     ON dtr.employee_id=el.employee_id
    //                                     LEFT JOIN emp_rates_duties as erd
    //                                     ON el.employee_id=erd.employee_id
    //                                     LEFT JOIN refpayperiod as rpp
    //                                         ON dtr.pay_period_id=rpp.pay_period_id
    //                                    /* LEFT JOIN (SELECT pay_slip_id,SUM(earnings_amount) as allowance FROM pay_slip_other_earnings WHERE earnings_id=1) as psoe
    //                                             ON ps.pay_slip_id=psoe.pay_slip_id
    //                                     LEFT JOIN (SELECT pay_slip_id,SUM(earnings_amount) as adjustment FROM pay_slip_other_earnings WHERE earnings_id=6
    //                                         GROUP BY earnings_id) as psoea
    //                                             ON ps.pay_slip_id=psoea.pay_slip_id
    //                                     LEFT JOIN (SELECT pay_slip_id,SUM(earnings_amount) as other_earnings FROM pay_slip_other_earnings WHERE earnings_id!=1 AND earnings_id!=6
    //                                         GROUP BY earnings_id) as psoec
    //                                             ON ps.pay_slip_id=psoec.pay_slip_id*/
    //                                     LEFT JOIN (SELECT pay_slip_id,(deduction_amount) as sss_deduction FROM pay_slip_deductions WHERE deduction_id=1) as psdsss
    //                                         ON ps.pay_slip_id=psdsss.pay_slip_id
    //                                     LEFT JOIN (SELECT pay_slip_id,(deduction_amount) as philhealth_deduction FROM pay_slip_deductions WHERE deduction_id=2) as psdphil
    //                                         ON ps.pay_slip_id=psdphil.pay_slip_id
    //                                     LEFT JOIN (SELECT pay_slip_id,(deduction_amount) as pagibig_deduction FROM pay_slip_deductions WHERE deduction_id=3) as psdpagibig
    //                                         ON ps.pay_slip_id=psdpagibig.pay_slip_id
    //                                     LEFT JOIN (SELECT pay_slip_id,(deduction_amount) as wtax_deduction FROM pay_slip_deductions WHERE deduction_id=4) as psdwtax
    //                                         ON ps.pay_slip_id=psdwtax.pay_slip_id
    //                                     LEFT JOIN (SELECT pay_slip_id,deduction_amount as sssloan_deduction FROM pay_slip_deductions WHERE deduction_id=5) as psdsssloan
    //                                         ON ps.pay_slip_id=psdsssloan.pay_slip_id
    //                                     LEFT JOIN (SELECT pay_slip_id,(deduction_amount) as pagibigloan_deduction FROM pay_slip_deductions WHERE deduction_id=6) as psdpagibigloan
    //                                         ON ps.pay_slip_id=psdpagibigloan.pay_slip_id
    //                                     LEFT JOIN (SELECT pay_slip_id,(deduction_amount) as cashadvance_deduction FROM pay_slip_deductions WHERE deduction_id=7) as psdcashadvance
    //                                         ON ps.pay_slip_id=psdcashadvance.pay_slip_id
    //                                     LEFT JOIN (SELECT pay_slip_id,(deduction_amount) as cooploan_deduction FROM pay_slip_deductions WHERE deduction_id=8) as psdcooploan
    //                                         ON ps.pay_slip_id=psdcooploan.pay_slip_id
    //                                     /*LEFT JOIN (SELECT pay_slip_id,(deduction_amount) as calamityloan_deduction FROM pay_slip_deductions WHERE deduction_id=12) as psdcalamityloan
    //                                         ON ps.pay_slip_id=psdcalamityloan.pay_slip_id*/
    //                                     LEFT JOIN (SELECT pay_slip_id,(deduction_amount) as coopcontribution_deduction FROM pay_slip_deductions WHERE deduction_id=9) as psdcoopcontrib
    //                                         ON ps.pay_slip_id=psdcoopcontrib.pay_slip_id WHERE dtr.employee_id='.$filter_value.' AND erd.active_rates_duties=1 AND erd.ref_branch_id='.$filter_value3.'ORDER BY fullname');
    //
    //         return $query->result();
    // }
    //
    // function get_monthly_salary_wofilter($filter_value3) {
    //         //1=allowance 2=salary adjustments 3=meal allowance 4=other allowance 5=commision
    //         $query = $this->db->query('SELECT ps.*,CONCAT(el.first_name," ",el.middle_name," ",el.last_name) as fullname,rpp.pay_period_start,rpp.pay_period_end,
    //                                                 psdsss.sss_deduction,psdphil.philhealth_deduction,
    //                                                 psdpagibig.pagibig_deduction,psdwtax.wtax_deduction,psdsssloan.sssloan_deduction,
    //                                                 psdpagibigloan.pagibigloan_deduction,psdcooploan.cooploan_deduction,psdcoopcontrib.coopcontribution_deduction,
    //                                                 psdcashadvance.cashadvance_deduction/*,psdcalamityloan.calamityloan_deduction*/
    //                                      FROM pay_slip as ps
    //                                     LEFT JOIN daily_time_record as dtr
    //                                         ON ps.dtr_id=dtr.dtr_id
    //                                     LEFT JOIN employee_list as el
    //                                     ON dtr.employee_id=el.employee_id
    //                                     LEFT JOIN emp_rates_duties as erd
    //                                     ON el.employee_id=erd.employee_id
    //                                     LEFT JOIN refpayperiod as rpp
    //                                         ON dtr.pay_period_id=rpp.pay_period_id
    //                                    /* LEFT JOIN (SELECT pay_slip_id,SUM(earnings_amount) as allowance FROM pay_slip_other_earnings WHERE earnings_id=1
    //                                         GROUP BY earnings_id) as psoe
    //                                             ON ps.pay_slip_id=psoe.pay_slip_id
    //                                     LEFT JOIN (SELECT pay_slip_id,SUM(earnings_amount) as adjustment FROM pay_slip_other_earnings WHERE earnings_id=6
    //                                         GROUP BY earnings_id) as psoea
    //                                             ON ps.pay_slip_id=psoea.pay_slip_id
    //                                     LEFT JOIN (SELECT pay_slip_id,SUM(earnings_amount) as other_earnings FROM pay_slip_other_earnings WHERE earnings_id!=1 AND earnings_id!=6
    //                                         GROUP BY earnings_id) as psoec
    //                                             ON ps.pay_slip_id=psoec.pay_slip_id*/
    //                                     LEFT JOIN (SELECT pay_slip_id,(deduction_amount) as sss_deduction FROM pay_slip_deductions WHERE deduction_id=1) as psdsss
    //                                         ON ps.pay_slip_id=psdsss.pay_slip_id
    //                                     LEFT JOIN (SELECT pay_slip_id,(deduction_amount) as philhealth_deduction FROM pay_slip_deductions WHERE deduction_id=2) as psdphil
    //                                         ON ps.pay_slip_id=psdphil.pay_slip_id
    //                                     LEFT JOIN (SELECT pay_slip_id,(deduction_amount) as pagibig_deduction FROM pay_slip_deductions WHERE deduction_id=3) as psdpagibig
    //                                         ON ps.pay_slip_id=psdpagibig.pay_slip_id
    //                                     LEFT JOIN (SELECT pay_slip_id,(deduction_amount) as wtax_deduction FROM pay_slip_deductions WHERE deduction_id=4) as psdwtax
    //                                         ON ps.pay_slip_id=psdwtax.pay_slip_id
    //                                     LEFT JOIN (SELECT pay_slip_id,(deduction_amount) as sssloan_deduction FROM pay_slip_deductions WHERE deduction_id=5) as psdsssloan
    //                                         ON ps.pay_slip_id=psdsssloan.pay_slip_id
    //                                     LEFT JOIN (SELECT pay_slip_id,(deduction_amount) as pagibigloan_deduction FROM pay_slip_deductions WHERE deduction_id=6) as psdpagibigloan
    //                                         ON ps.pay_slip_id=psdpagibigloan.pay_slip_id
    //                                     LEFT JOIN (SELECT pay_slip_id,(deduction_amount) as cashadvance_deduction FROM pay_slip_deductions WHERE deduction_id=7) as psdcashadvance
    //                                         ON ps.pay_slip_id=psdcashadvance.pay_slip_id
    //                                     LEFT JOIN (SELECT pay_slip_id,(deduction_amount) as cooploan_deduction FROM pay_slip_deductions WHERE deduction_id=8) as psdcooploan
    //                                         ON ps.pay_slip_id=psdcooploan.pay_slip_id
    //                                         /*LEFT JOIN (SELECT pay_slip_id,(deduction_amount) as calamityloan_deduction FROM pay_slip_deductions WHERE deduction_id=12) as psdcalamityloan
    //                                         ON ps.pay_slip_id=psdcalamityloan.pay_slip_id*/
    //                                     LEFT JOIN (SELECT pay_slip_id,(deduction_amount) as coopcontribution_deduction FROM pay_slip_deductions WHERE deduction_id=9) as psdcoopcontrib
    //                                         ON ps.pay_slip_id=psdcoopcontrib.pay_slip_id  WHERE erd.active_rates_duties=1 AND erd.ref_branch_id='.$filter_value3);
    //
    //         return $query->result();
    // }

    function get_yearly_salary_history($filter_value,$filter_value2,$filter_value3) {

            //1=allowance 2=salary adjustments 3=meal allowance 4=other allowance 5=commision edited na d na standard
            $query = $this->db->query('SELECT ps.*,CONCAT(el.first_name," ",el.middle_name," ",el.last_name) as fullname,rpp.pay_period_start,rpp.pay_period_end,
                                                    psdsss.sss_deduction,psdphil.philhealth_deduction,
                                                    psdpagibig.pagibig_deduction,psdwtax.wtax_deduction,psdsssloan.sssloan_deduction,
                                                    psdpagibigloan.pagibigloan_deduction,psdcooploan.cooploan_deduction,psdcoopcontrib.coopcontribution_deduction,
                                                    psdcashadvance.cashadvance_deduction,COALESCE(ROUND(psoeall.allowance,2),0) as allowance,COALESCE(ROUND(psoea.adjustment,2),0) as adjustment
                                                    ,COALESCE(ROUND(psoec.other_earnings,2),0) as other_earnings,psdcalamityloan.calamityloan_deduction,psod.other_deductions
                                         FROM pay_slip as ps
                                        LEFT JOIN daily_time_record as dtr
                                            ON ps.dtr_id=dtr.dtr_id
                                        LEFT JOIN employee_list as el
                                        ON dtr.employee_id=el.employee_id
                                        LEFT JOIN emp_rates_duties as erd
                                        ON el.employee_id=erd.employee_id
                                        LEFT JOIN refpayperiod as rpp
                                            ON dtr.pay_period_id=rpp.pay_period_id
                                        LEFT JOIN (SELECT pay_slip_id,SUM(earnings_amount) as allowance FROM pay_slip_other_earnings WHERE earnings_id=1
                                            GROUP BY pay_slip_id) as psoeall
                                                ON ps.pay_slip_id=psoeall.pay_slip_id
                                        LEFT JOIN (SELECT pay_slip_id,SUM(earnings_amount) as adjustment FROM pay_slip_other_earnings WHERE earnings_id=2
                                            GROUP BY pay_slip_id) as psoea
                                                ON ps.pay_slip_id=psoea.pay_slip_id
                                        LEFT JOIN (SELECT pay_slip_id,SUM(earnings_amount) as other_earnings FROM pay_slip_other_earnings WHERE earnings_id!=1 AND earnings_id!=2
                                            GROUP BY pay_slip_id) as psoec
                                                ON ps.pay_slip_id=psoec.pay_slip_id
                                        LEFT JOIN (SELECT pay_slip_id,(deduction_amount) as sss_deduction FROM pay_slip_deductions WHERE deduction_id=1) as psdsss
                                            ON ps.pay_slip_id=psdsss.pay_slip_id
                                        LEFT JOIN (SELECT pay_slip_id,(deduction_amount) as philhealth_deduction FROM pay_slip_deductions WHERE deduction_id=2) as psdphil
                                            ON ps.pay_slip_id=psdphil.pay_slip_id
                                        LEFT JOIN (SELECT pay_slip_id,(deduction_amount) as pagibig_deduction FROM pay_slip_deductions WHERE deduction_id=3) as psdpagibig
                                            ON ps.pay_slip_id=psdpagibig.pay_slip_id
                                        LEFT JOIN (SELECT pay_slip_id,(deduction_amount) as wtax_deduction FROM pay_slip_deductions WHERE deduction_id=4) as psdwtax
                                            ON ps.pay_slip_id=psdwtax.pay_slip_id
                                        LEFT JOIN (SELECT pay_slip_id,(deduction_amount) as sssloan_deduction FROM pay_slip_deductions WHERE deduction_id=5) as psdsssloan
                                            ON ps.pay_slip_id=psdsssloan.pay_slip_id
                                        LEFT JOIN (SELECT pay_slip_id,(deduction_amount) as pagibigloan_deduction FROM pay_slip_deductions WHERE deduction_id=6) as psdpagibigloan
                                            ON ps.pay_slip_id=psdpagibigloan.pay_slip_id
                                        LEFT JOIN (SELECT pay_slip_id,(deduction_amount) as cashadvance_deduction FROM pay_slip_deductions WHERE deduction_id=7) as psdcashadvance
                                            ON ps.pay_slip_id=psdcashadvance.pay_slip_id
                                        LEFT JOIN (SELECT pay_slip_id,(deduction_amount) as cooploan_deduction FROM pay_slip_deductions WHERE deduction_id=8) as psdcooploan
                                            ON ps.pay_slip_id=psdcooploan.pay_slip_id
                                        LEFT JOIN (SELECT pay_slip_id,(deduction_amount) as calamityloan_deduction FROM pay_slip_deductions WHERE deduction_id=12) as psdcalamityloan
                                            ON ps.pay_slip_id=psdcalamityloan.pay_slip_id
                                        LEFT JOIN (SELECT pay_slip_id,SUM(deduction_amount) as other_deductions FROM pay_slip_deductions
                                            LEFT JOIN refdeduction
                                            ON refdeduction.deduction_id=pay_slip_deductions.deduction_id
                                            WHERE refdeduction.deduction_type_id!=1 AND refdeduction.deduction_type_id!=2 AND refdeduction.deduction_type_id!=4 AND active_deduct=TRUE
                                            GROUP BY pay_slip_id) as psod
                                                ON ps.pay_slip_id=psod.pay_slip_id
                                        LEFT JOIN (SELECT pay_slip_id,(deduction_amount) as coopcontribution_deduction FROM pay_slip_deductions WHERE deduction_id=9) as psdcoopcontrib
                                            ON ps.pay_slip_id=psdcoopcontrib.pay_slip_id WHERE extract(YEAR from rpp.pay_period_start)='.$filter_value2.' 
                                                '.($filter_value == "all"?"":" AND dtr.employee_id='".$filter_value."'").'
                                                AND erd.active_rates_duties=1 AND erd.ref_branch_id='.$filter_value3.'
                                                ORDER BY el.last_name');

            return $query->result();
    }

    function get_yearly_salary_filter_year($filter_value2,$filter_value3) {
            //1=allowance 2=salary adjustments 3=meal allowance 4=other allowance 5=commision
            $query = $this->db->query('SELECT ps.*,CONCAT(el.first_name," ",el.middle_name," ",el.last_name) as fullname,rpp.pay_period_start,rpp.pay_period_end,
                                                    psdsss.sss_deduction,psdphil.philhealth_deduction,
                                                    psdpagibig.pagibig_deduction,psdwtax.wtax_deduction,psdsssloan.sssloan_deduction,
                                                    psdpagibigloan.pagibigloan_deduction,psdcooploan.cooploan_deduction,psdcoopcontrib.coopcontribution_deduction,
                                                    psdcashadvance.cashadvance_deduction,COALESCE(ROUND(psoeall.allowance,2),0) as allowance,COALESCE(ROUND(psoea.adjustment,2),0) as adjustment
                                                    ,COALESCE(ROUND(psoec.other_earnings,2),0) as other_earnings,psdcalamityloan.calamityloan_deduction,psod.other_deductions
                                         FROM pay_slip as ps
                                        LEFT JOIN daily_time_record as dtr
                                            ON ps.dtr_id=dtr.dtr_id
                                        LEFT JOIN employee_list as el
                                        ON dtr.employee_id=el.employee_id
                                        LEFT JOIN emp_rates_duties as erd
                                        ON el.employee_id=erd.employee_id
                                        LEFT JOIN refpayperiod as rpp
                                            ON dtr.pay_period_id=rpp.pay_period_id
                                        LEFT JOIN (SELECT pay_slip_id,SUM(earnings_amount) as allowance FROM pay_slip_other_earnings WHERE earnings_id=1
                                            GROUP BY pay_slip_id) as psoeall
                                                ON ps.pay_slip_id=psoeall.pay_slip_id
                                        LEFT JOIN (SELECT pay_slip_id,SUM(earnings_amount) as adjustment FROM pay_slip_other_earnings WHERE earnings_id=2
                                            GROUP BY pay_slip_id) as psoea
                                                ON ps.pay_slip_id=psoea.pay_slip_id
                                        LEFT JOIN (SELECT pay_slip_id,SUM(earnings_amount) as other_earnings FROM pay_slip_other_earnings WHERE earnings_id!=1 AND earnings_id!=2
                                            GROUP BY pay_slip_id) as psoec
                                                ON ps.pay_slip_id=psoec.pay_slip_id
                                        LEFT JOIN (SELECT pay_slip_id,(deduction_amount) as sss_deduction FROM pay_slip_deductions WHERE deduction_id=1) as psdsss
                                            ON ps.pay_slip_id=psdsss.pay_slip_id
                                        LEFT JOIN (SELECT pay_slip_id,(deduction_amount) as philhealth_deduction FROM pay_slip_deductions WHERE deduction_id=2) as psdphil
                                            ON ps.pay_slip_id=psdphil.pay_slip_id
                                        LEFT JOIN (SELECT pay_slip_id,(deduction_amount) as pagibig_deduction FROM pay_slip_deductions WHERE deduction_id=3) as psdpagibig
                                            ON ps.pay_slip_id=psdpagibig.pay_slip_id
                                        LEFT JOIN (SELECT pay_slip_id,(deduction_amount) as wtax_deduction FROM pay_slip_deductions WHERE deduction_id=4) as psdwtax
                                            ON ps.pay_slip_id=psdwtax.pay_slip_id
                                        LEFT JOIN (SELECT pay_slip_id,(deduction_amount) as sssloan_deduction FROM pay_slip_deductions WHERE deduction_id=5) as psdsssloan
                                            ON ps.pay_slip_id=psdsssloan.pay_slip_id
                                        LEFT JOIN (SELECT pay_slip_id,(deduction_amount) as pagibigloan_deduction FROM pay_slip_deductions WHERE deduction_id=6) as psdpagibigloan
                                            ON ps.pay_slip_id=psdpagibigloan.pay_slip_id
                                        LEFT JOIN (SELECT pay_slip_id,(deduction_amount) as cashadvance_deduction FROM pay_slip_deductions WHERE deduction_id=7) as psdcashadvance
                                            ON ps.pay_slip_id=psdcashadvance.pay_slip_id
                                        LEFT JOIN (SELECT pay_slip_id,(deduction_amount) as cooploan_deduction FROM pay_slip_deductions WHERE deduction_id=8) as psdcooploan
                                            ON ps.pay_slip_id=psdcooploan.pay_slip_id
                                        LEFT JOIN (SELECT pay_slip_id,(deduction_amount) as calamityloan_deduction FROM pay_slip_deductions WHERE deduction_id=12) as psdcalamityloan
                                            ON ps.pay_slip_id=psdcalamityloan.pay_slip_id
                                        LEFT JOIN (SELECT pay_slip_id,SUM(deduction_amount) as other_deductions FROM pay_slip_deductions
                                            LEFT JOIN refdeduction
                                            ON refdeduction.deduction_id=pay_slip_deductions.deduction_id
                                            WHERE refdeduction.deduction_type_id!=1 AND refdeduction.deduction_type_id!=2 AND refdeduction.deduction_type_id!=4 AND active_deduct=TRUE
                                            GROUP BY pay_slip_id) as psod
                                                ON ps.pay_slip_id=psod.pay_slip_id
                                        LEFT JOIN (SELECT pay_slip_id,(deduction_amount) as coopcontribution_deduction FROM pay_slip_deductions WHERE deduction_id=9) as psdcoopcontrib
                                            ON ps.pay_slip_id=psdcoopcontrib.pay_slip_id WHERE extract(YEAR from rpp.pay_period_start)='.$filter_value2.' AND erd.active_rates_duties=1 AND erd.ref_branch_id='.$filter_value3.'
                                            ORDER BY el.last_name');

            return $query->result();
    }

    // function get_yearly_salary_filter_employee($filter_value,$filter_value3) {
    //         //1=allowance 2=salary adjustments 3=meal allowance 4=other allowance 5=commision
    //         $query = $this->db->query('SELECT ps.*,CONCAT(el.first_name," ",el.middle_name," ",el.last_name) as fullname,rpp.pay_period_start,rpp.pay_period_end,
    //                                                 psdsss.sss_deduction,psdphil.philhealth_deduction,
    //                                                 psdpagibig.pagibig_deduction,psdwtax.wtax_deduction,psdsssloan.sssloan_deduction,
    //                                                 psdpagibigloan.pagibigloan_deduction,psdcooploan.cooploan_deduction,psdcoopcontrib.coopcontribution_deduction,
    //                                                 psdcashadvance.cashadvance_deduction/*,psdcalamityloan.calamityloan_deduction*/
    //                                      FROM pay_slip as ps
    //                                     LEFT JOIN daily_time_record as dtr
    //                                         ON ps.dtr_id=dtr.dtr_id
    //                                     LEFT JOIN employee_list as el
    //                                     ON dtr.employee_id=el.employee_id
    //                                     LEFT JOIN emp_rates_duties as erd
    //                                     ON el.employee_id=erd.employee_id
    //                                     LEFT JOIN refpayperiod as rpp
    //                                         ON dtr.pay_period_id=rpp.pay_period_id
    //                                    /* LEFT JOIN (SELECT pay_slip_id,SUM(earnings_amount) as allowance FROM pay_slip_other_earnings WHERE earnings_id=1) as psoe
    //                                             ON ps.pay_slip_id=psoe.pay_slip_id
    //                                     LEFT JOIN (SELECT pay_slip_id,SUM(earnings_amount) as adjustment FROM pay_slip_other_earnings WHERE earnings_id=6
    //                                         GROUP BY earnings_id) as psoea
    //                                             ON ps.pay_slip_id=psoea.pay_slip_id
    //                                     LEFT JOIN (SELECT pay_slip_id,SUM(earnings_amount) as other_earnings FROM pay_slip_other_earnings WHERE earnings_id!=1 AND earnings_id!=6
    //                                         GROUP BY earnings_id) as psoec
    //                                             ON ps.pay_slip_id=psoec.pay_slip_id*/
    //                                     LEFT JOIN (SELECT pay_slip_id,(deduction_amount) as sss_deduction FROM pay_slip_deductions WHERE deduction_id=1) as psdsss
    //                                         ON ps.pay_slip_id=psdsss.pay_slip_id
    //                                     LEFT JOIN (SELECT pay_slip_id,(deduction_amount) as philhealth_deduction FROM pay_slip_deductions WHERE deduction_id=2) as psdphil
    //                                         ON ps.pay_slip_id=psdphil.pay_slip_id
    //                                     LEFT JOIN (SELECT pay_slip_id,(deduction_amount) as pagibig_deduction FROM pay_slip_deductions WHERE deduction_id=3) as psdpagibig
    //                                         ON ps.pay_slip_id=psdpagibig.pay_slip_id
    //                                     LEFT JOIN (SELECT pay_slip_id,(deduction_amount) as wtax_deduction FROM pay_slip_deductions WHERE deduction_id=4) as psdwtax
    //                                         ON ps.pay_slip_id=psdwtax.pay_slip_id
    //                                     LEFT JOIN (SELECT pay_slip_id,deduction_amount as sssloan_deduction FROM pay_slip_deductions WHERE deduction_id=5) as psdsssloan
    //                                         ON ps.pay_slip_id=psdsssloan.pay_slip_id
    //                                     LEFT JOIN (SELECT pay_slip_id,(deduction_amount) as pagibigloan_deduction FROM pay_slip_deductions WHERE deduction_id=6) as psdpagibigloan
    //                                         ON ps.pay_slip_id=psdpagibigloan.pay_slip_id
    //                                     LEFT JOIN (SELECT pay_slip_id,(deduction_amount) as cashadvance_deduction FROM pay_slip_deductions WHERE deduction_id=7) as psdcashadvance
    //                                         ON ps.pay_slip_id=psdcashadvance.pay_slip_id
    //                                     LEFT JOIN (SELECT pay_slip_id,(deduction_amount) as cooploan_deduction FROM pay_slip_deductions WHERE deduction_id=8) as psdcooploan
    //                                         ON ps.pay_slip_id=psdcooploan.pay_slip_id
    //                                     /*LEFT JOIN (SELECT pay_slip_id,(deduction_amount) as calamityloan_deduction FROM pay_slip_deductions WHERE deduction_id=12) as psdcalamityloan
    //                                         ON ps.pay_slip_id=psdcalamityloan.pay_slip_id*/
    //                                     LEFT JOIN (SELECT pay_slip_id,(deduction_amount) as coopcontribution_deduction FROM pay_slip_deductions WHERE deduction_id=9) as psdcoopcontrib
    //                                         ON ps.pay_slip_id=psdcoopcontrib.pay_slip_id WHERE dtr.employee_id='.$filter_value.' AND erd.active_rates_duties=1 AND erd.ref_branch_id='.$filter_value3);
    //
    //         return $query->result();
    // }
    //
    // function get_yearly_salary_wofilter($filter_value3) {
    //         //1=allowance 2=salary adjustments 3=meal allowance 4=other allowance 5=commision
    //         $query = $this->db->query('SELECT ps.*,CONCAT(el.first_name," ",el.middle_name," ",el.last_name) as fullname,rpp.pay_period_start,rpp.pay_period_end,
    //                                                 psdsss.sss_deduction,psdphil.philhealth_deduction,
    //                                                 psdpagibig.pagibig_deduction,psdwtax.wtax_deduction,psdsssloan.sssloan_deduction,
    //                                                 psdpagibigloan.pagibigloan_deduction,psdcooploan.cooploan_deduction,psdcoopcontrib.coopcontribution_deduction,
    //                                                 psdcashadvance.cashadvance_deduction/*,psdcalamityloan.calamityloan_deduction*/
    //                                      FROM pay_slip as ps
    //                                     LEFT JOIN daily_time_record as dtr
    //                                         ON ps.dtr_id=dtr.dtr_id
    //                                     LEFT JOIN employee_list as el
    //                                     ON dtr.employee_id=el.employee_id
    //                                     LEFT JOIN emp_rates_duties as erd
    //                                     ON el.employee_id=erd.employee_id
    //                                     LEFT JOIN refpayperiod as rpp
    //                                         ON dtr.pay_period_id=rpp.pay_period_id
    //                                    /* LEFT JOIN (SELECT pay_slip_id,SUM(earnings_amount) as allowance FROM pay_slip_other_earnings WHERE earnings_id=1
    //                                         GROUP BY earnings_id) as psoe
    //                                             ON ps.pay_slip_id=psoe.pay_slip_id
    //                                     LEFT JOIN (SELECT pay_slip_id,SUM(earnings_amount) as adjustment FROM pay_slip_other_earnings WHERE earnings_id=6
    //                                         GROUP BY earnings_id) as psoea
    //                                             ON ps.pay_slip_id=psoea.pay_slip_id
    //                                     LEFT JOIN (SELECT pay_slip_id,SUM(earnings_amount) as other_earnings FROM pay_slip_other_earnings WHERE earnings_id!=1 AND earnings_id!=6
    //                                         GROUP BY earnings_id) as psoec
    //                                             ON ps.pay_slip_id=psoec.pay_slip_id*/
    //                                     LEFT JOIN (SELECT pay_slip_id,(deduction_amount) as sss_deduction FROM pay_slip_deductions WHERE deduction_id=1) as psdsss
    //                                         ON ps.pay_slip_id=psdsss.pay_slip_id
    //                                     LEFT JOIN (SELECT pay_slip_id,(deduction_amount) as philhealth_deduction FROM pay_slip_deductions WHERE deduction_id=2) as psdphil
    //                                         ON ps.pay_slip_id=psdphil.pay_slip_id
    //                                     LEFT JOIN (SELECT pay_slip_id,(deduction_amount) as pagibig_deduction FROM pay_slip_deductions WHERE deduction_id=3) as psdpagibig
    //                                         ON ps.pay_slip_id=psdpagibig.pay_slip_id
    //                                     LEFT JOIN (SELECT pay_slip_id,(deduction_amount) as wtax_deduction FROM pay_slip_deductions WHERE deduction_id=4) as psdwtax
    //                                         ON ps.pay_slip_id=psdwtax.pay_slip_id
    //                                     LEFT JOIN (SELECT pay_slip_id,(deduction_amount) as sssloan_deduction FROM pay_slip_deductions WHERE deduction_id=5) as psdsssloan
    //                                         ON ps.pay_slip_id=psdsssloan.pay_slip_id
    //                                     LEFT JOIN (SELECT pay_slip_id,(deduction_amount) as pagibigloan_deduction FROM pay_slip_deductions WHERE deduction_id=6) as psdpagibigloan
    //                                         ON ps.pay_slip_id=psdpagibigloan.pay_slip_id
    //                                     LEFT JOIN (SELECT pay_slip_id,(deduction_amount) as cashadvance_deduction FROM pay_slip_deductions WHERE deduction_id=7) as psdcashadvance
    //                                         ON ps.pay_slip_id=psdcashadvance.pay_slip_id
    //                                     LEFT JOIN (SELECT pay_slip_id,(deduction_amount) as cooploan_deduction FROM pay_slip_deductions WHERE deduction_id=8) as psdcooploan
    //                                         ON ps.pay_slip_id=psdcooploan.pay_slip_id
    //                                         /*LEFT JOIN (SELECT pay_slip_id,(deduction_amount) as calamityloan_deduction FROM pay_slip_deductions WHERE deduction_id=12) as psdcalamityloan
    //                                         ON ps.pay_slip_id=psdcalamityloan.pay_slip_id*/
    //                                     LEFT JOIN (SELECT pay_slip_id,(deduction_amount) as coopcontribution_deduction FROM pay_slip_deductions WHERE deduction_id=9) as psdcoopcontrib
    //                                         ON ps.pay_slip_id=psdcoopcontrib.pay_slip_id  WHERE erd.active_rates_duties=1 AND erd.ref_branch_id='.$filter_value3);
    //
    //         return $query->result();
    // }

    function getloan($company_id,$employee,$ref_loan_id){
        $loan = $this->db->query('SELECT psd.deduction_regular_id,psd.deduction_amount,pay_period_end,CONCAT(emplist.first_name," ",emplist.middle_name," ",emplist.last_name) as fullname FROM employee_list as emplist
                                    LEFT JOIN daily_time_record as dtr
                                    ON emplist.employee_id=dtr.employee_id
                                    LEFT JOIN refpayperiod as rpp
                                    ON dtr.pay_period_id=rpp.pay_period_id
                                    LEFT JOIN pay_slip as ps
                                    ON dtr.dtr_id=ps.dtr_id
                                    LEFT JOIN pay_slip_deductions as psd
                                    ON ps.pay_slip_id=psd.pay_slip_id
                                    WHERE emplist.employee_id='.$filter_value.' AND deduction_id='.$filter_value2);
                                    return $loan->result();
    }

    function getloanadjustments($deduction_regular_id){
        $loanadjustments = $this->db->query('SELECT CONCAT(emp.first_name," ",emp.middle_name," ",emp.last_name) as fullname,particular,pay_slip_loans_adjustments.date_created,debit_amount,credit_amount,pay_slip_loans_adjustments.deduction_regular_id FROM pay_slip_loans_adjustments
                                LEFT JOIN new_deductions_regular
                                ON new_deductions_regular.deduction_regular_id=pay_slip_loans_adjustments.deduction_regular_id
                                LEFT JOIN employee_list as emp
                                ON emp.employee_id=new_deductions_regular.employee_id
                                WHERE new_deductions_regular.is_deleted=0 AND pay_slip_loans_adjustments.deduction_regular_id='.$deduction_regular_id);
                                    return $loanadjustments->result();
    }

    function getloanamount($filter_value,$filter_value2){
        $loan_temp = $this->db->query('SELECT new_deductions_regular.deduction_regular_id,new_deductions_regular.loan_total_amount,new_deductions_regular.deduction_total_amount,COALESCE((psd.deduction_amount),0) as psdamount,new_deductions_regular.deduction_per_pay_amount,COUNT(new_deductions_regular.deduction_regular_id) as count FROM new_deductions_regular
                                    LEFT JOIN pay_slip_deductions as psd
                                    ON new_deductions_regular.deduction_regular_id=psd.deduction_regular_id
                                    WHERE new_deductions_regular.employee_id='.$filter_value.' AND is_deleted=0 AND new_deductions_regular.deduction_id='.$filter_value2);
                                    return $loan_temp->result();
    }

     function get_13thmonthpay_wofilter($filter_value3) {
            //1=allowance 2=salary adjustments 3=meal allowance 4=other allowance 5=commision
            $query = $this->db->query('SELECT ps.*,CONCAT(el.first_name," ",el.middle_name," ",el.last_name) as fullname, SUM(ps.reg_pay) as total_reg,erd.salary_reg_rates,SUM(erd.salary_reg_rates) as total_basic_pay,dtr.for_13th_month,SUM(dtr.for_13th_month) as total_13thmonth,
                                         SUM(ps.days_wout_pay_amt) as total_days_wout_pay_amt,  SUM(ps.minutes_late_amt) as total_minutes_late_amt,COALESCE(SUM(salary_retro.earnings_amount),0) as retro
                                         FROM pay_slip as ps
                                        LEFT JOIN daily_time_record as dtr
                                            ON ps.dtr_id=dtr.dtr_id
                                        LEFT JOIN employee_list as el
                                        ON dtr.employee_id=el.employee_id
                                        LEFT JOIN emp_rates_duties as erd
                                        ON el.employee_id=erd.employee_id
                                        LEFT JOIN refpayperiod as rpp
                                            ON dtr.pay_period_id=rpp.pay_period_id
                                        LEFT JOIN (SELECT pay_slip_id,(earnings_amount) as earnings_amount FROM pay_slip_other_earnings WHERE earnings_id=7) as salary_retro
                                            ON ps.pay_slip_id=salary_retro.pay_slip_id
                                        WHERE erd.active_rates_duties=1 AND erd.ref_branch_id='.$filter_value3.'
                                        GROUP BY el.last_name');

            return $query->result();
    }

    function get_13thmonthpay_year_filter($filter_value2,$filter_value3) {
            //1=allowance 2=salary adjustments 3=meal allowance 4=other allowance 5=commision
            $query = $this->db->query('SELECT ps.*,CONCAT(el.first_name," ",el.middle_name," ",el.last_name) as fullname, SUM(ps.reg_pay) as total_reg,erd.salary_reg_rates,SUM(erd.salary_reg_rates) as total_basic_pay,dtr.for_13th_month,SUM(dtr.for_13th_month) as total_13thmonth,
                                         SUM(ps.days_wout_pay_amt) as total_days_wout_pay_amt,  SUM(ps.minutes_late_amt) as total_minutes_late_amt,COALESCE(SUM(salary_retro.earnings_amount),0) as retro
                                         FROM pay_slip as ps
                                        LEFT JOIN daily_time_record as dtr
                                            ON ps.dtr_id=dtr.dtr_id
                                        LEFT JOIN employee_list as el
                                        ON dtr.employee_id=el.employee_id
                                        LEFT JOIN emp_rates_duties as erd
                                        ON el.employee_id=erd.employee_id
                                        LEFT JOIN refpayperiod as rpp
                                            ON dtr.pay_period_id=rpp.pay_period_id
                                        LEFT JOIN (SELECT pay_slip_id,(earnings_amount) as earnings_amount FROM pay_slip_other_earnings WHERE earnings_id=7) as salary_retro
                                            ON ps.pay_slip_id=salary_retro.pay_slip_id
                                        WHERE extract(YEAR from rpp.pay_period_start)='.$filter_value2.' AND erd.active_rates_duties=1 AND erd.ref_branch_id='.$filter_value3.'
                                        GROUP BY el.last_name');

            return $query->result();
    }

    function get_13thmonthpay_employee_filter($filter_value,$filter_value3) {
            //1=allowance 2=salary adjustments 3=meal allowance 4=other allowance 5=commision
            $query = $this->db->query('SELECT ps.*,CONCAT(el.first_name," ",el.middle_name," ",el.last_name) as fullname, SUM(ps.reg_pay) as total_reg,erd.salary_reg_rates,SUM(erd.salary_reg_rates) as total_basic_pay,dtr.for_13th_month,SUM(dtr.for_13th_month) as total_13thmonth,
                                         SUM(ps.days_wout_pay_amt) as total_days_wout_pay_amt,  SUM(ps.minutes_late_amt) as total_minutes_late_amt,COALESCE(SUM(salary_retro.earnings_amount),0) as retro
                                         FROM pay_slip as ps
                                        LEFT JOIN daily_time_record as dtr
                                            ON ps.dtr_id=dtr.dtr_id
                                        LEFT JOIN employee_list as el
                                        ON dtr.employee_id=el.employee_id
                                        LEFT JOIN emp_rates_duties as erd
                                        ON el.employee_id=erd.employee_id
                                        LEFT JOIN refpayperiod as rpp
                                            ON dtr.pay_period_id=rpp.pay_period_id
                                        LEFT JOIN (SELECT pay_slip_id,(earnings_amount) as earnings_amount FROM pay_slip_other_earnings WHERE earnings_id=7) as salary_retro
                                            ON ps.pay_slip_id=salary_retro.pay_slip_id

                                        WHERE dtr.employee_id='.$filter_value.' AND erd.active_rates_duties=1 AND erd.ref_branch_id='.$filter_value3);

            return $query->result();
    }

    function get_accumulated_13thmonthpay($employee_id) {
            $query = $this->db->query('SELECT ps.*,CONCAT(el.first_name," ",el.middle_name," ",el.last_name) as fullname, SUM(ps.reg_pay) as total_reg,erd.salary_reg_rates,SUM(erd.salary_reg_rates) as total_basic_pay,dtr.for_13th_month,SUM(dtr.for_13th_month) as total_13thmonth, ROUND((SUM(dtr.for_13th_month)-(SUM(ps.days_wout_pay_amt)+SUM(ps.minutes_late_amt)))/12) as acc_13thmonth_pay,
                                         SUM(ps.days_wout_pay_amt) as total_days_wout_pay_amt,  SUM(ps.minutes_late_amt) as total_minutes_late_amt,COALESCE(SUM(salary_retro.earnings_amount),0) as retro
                                         FROM pay_slip as ps
                                        LEFT JOIN daily_time_record as dtr
                                            ON ps.dtr_id=dtr.dtr_id
                                        LEFT JOIN employee_list as el
                                        ON dtr.employee_id=el.employee_id
                                        LEFT JOIN emp_rates_duties as erd
                                        ON el.employee_id=erd.employee_id
                                        LEFT JOIN refpayperiod as rpp
                                            ON dtr.pay_period_id=rpp.pay_period_id
                                        LEFT JOIN (SELECT pay_slip_id,(earnings_amount) as earnings_amount FROM pay_slip_other_earnings WHERE earnings_id=7) as salary_retro
                                            ON ps.pay_slip_id=salary_retro.pay_slip_id

                                        WHERE dtr.employee_id='.$employee_id.' AND erd.active_rates_duties=1');

            return $query->result();
    }

    function get_13thmonthpay($year,$branch_id='all',$department_id='all',$employee_id='all',$is_active,$company_id) {
            $query = $this->db->query("SELECT 
                            ps.*,
                            CONCAT(el.first_name,
                                    ' ',
                                    el.middle_name,
                                    ' ',
                                    el.last_name) AS fullname,
                            SUM(dtr.basic_pay_total) AS total_reg,
                            (SUM(dtr.for_13thmonth) / 12) AS total_13thmonth
                        FROM
                            pay_slip AS ps
                                LEFT JOIN
                            daily_time_record AS dtr ON ps.dtr_id = dtr.dtr_id
                                LEFT JOIN
                            employee_list AS el ON dtr.employee_id = el.employee_id
                                LEFT JOIN
                            refpayperiod AS rpp ON dtr.pay_period_id = rpp.pay_period_id
                                LEFT JOIN
                            ref_department dept ON dept.ref_department_id = el.ref_department_id
                                LEFT JOIN
                            ref_branch branch ON branch.ref_branch_id = el.ref_branch_id
                        WHERE
                             EXTRACT(YEAR FROM rpp.pay_period_start) = $year
                                AND el.company_id = $company_id
                                AND el.is_deleted = 0
                                ".($is_active=='all'?"":" AND el.is_active = $is_active")."
                                ".($branch_id=='all'?"":" AND branch.ref_branch_id = $branch_id")."
                                ".($department_id=='all'?"":" AND dept.ref_department_id = $department_id")."
                                ".($employee_id=='all'?"":" AND dtr.employee_id = $employee_id")."        
                        GROUP BY el.employee_id");
                        return $query->result();
    }

    function get_employee_compensation($year,$employee_id) {

            $query = $this->db->query("SELECT 
                        m.*,
                        SUM(m.reg_pay) AS sum_regpay,
                        SUM(m.net_pay) AS sum_netpay,
                        SUM(m.for_13thmonth) AS sum_for_13thmonth,
                        SUM(m.total_deduction) AS sum_total_deduction
                    FROM
                        (SELECT 
                            (CASE
                                    WHEN EXTRACT(MONTH FROM rpp.pay_period_start) = '1' THEN 'January'
                                    WHEN EXTRACT(MONTH FROM rpp.pay_period_start) = '2' THEN 'February'
                                    WHEN EXTRACT(MONTH FROM rpp.pay_period_start) = '3' THEN 'March'
                                    WHEN EXTRACT(MONTH FROM rpp.pay_period_start) = '4' THEN 'April'
                                    WHEN EXTRACT(MONTH FROM rpp.pay_period_start) = '5' THEN 'May'
                                    WHEN EXTRACT(MONTH FROM rpp.pay_period_start) = '6' THEN 'June'
                                    WHEN EXTRACT(MONTH FROM rpp.pay_period_start) = '7' THEN 'July'
                                    WHEN EXTRACT(MONTH FROM rpp.pay_period_start) = '8' THEN 'August'
                                    WHEN EXTRACT(MONTH FROM rpp.pay_period_start) = '9' THEN 'September'
                                    WHEN EXTRACT(MONTH FROM rpp.pay_period_start) = '10' THEN 'October'
                                    WHEN EXTRACT(MONTH FROM rpp.pay_period_start) = '11' THEN 'November'
                                    WHEN EXTRACT(MONTH FROM rpp.pay_period_start) = '12' THEN 'December'
                                END) AS month,
                                ROUND(SUM(dtr.basic_pay_total), 2) AS reg_pay,
                                ROUND(SUM(dtr.net_total), 2) AS net_pay,
                                ROUND(SUM(dtr.for_13thmonth) / 12, 2) AS for_13thmonth,
                                ROUND(SUM(dtr.total_deduction), 2) AS total_deduction
                        FROM
                            pay_slip ps
                        LEFT JOIN daily_time_record dtr ON dtr.dtr_id = ps.dtr_id
                        LEFT JOIN refpayperiod rpp ON rpp.pay_period_id = dtr.pay_period_id
                        WHERE
                            employee_id = ".$employee_id."
                                AND EXTRACT(YEAR FROM pay_period_start) = ".$year."
                        GROUP BY month) AS m
                    GROUP BY m.month");

            return $query->result();
    }

    function get_employee_deduction_history($year,$employee_id) {
            $query = $this->db->query("SELECT 
                                        (CASE
                                            WHEN rpp.month_id = '1' THEN 'January'
                                            WHEN rpp.month_id = '2' THEN 'February'
                                            WHEN rpp.month_id = '3' THEN 'March'
                                            WHEN rpp.month_id = '4' THEN 'April'
                                            WHEN rpp.month_id = '5' THEN 'May'
                                            WHEN rpp.month_id = '6' THEN 'June'
                                            WHEN rpp.month_id = '7' THEN 'July'
                                            WHEN rpp.month_id = '8' THEN 'August'
                                            WHEN rpp.month_id = '9' THEN 'September'
                                            WHEN rpp.month_id = '10' THEN 'October'
                                            WHEN rpp.month_id = '11' THEN 'November'
                                            WHEN rpp.month_id = '12' THEN 'December'
                                        END) AS month,
                                        SUM(dtr.sss_deduction) AS sss,
                                        SUM(dtr.philhealth_deduction) AS philhealth,
                                        SUM(dtr.pagibig_deduction) AS pagibig,
                                        SUM(dtr.wtax_deduction) as wtax
                                    FROM
                                        pay_slip ps
                                            LEFT JOIN
                                        daily_time_record dtr ON dtr.dtr_id = ps.dtr_id
                                            LEFT JOIN
                                        refpayperiod rpp ON rpp.pay_period_id = dtr.pay_period_id
                                    WHERE
                                        dtr.employee_id = $employee_id
                                            AND EXTRACT(YEAR FROM rpp.pay_period_start) = $year
                                    GROUP BY month");

            return $query->result();
    }

    function get_alpha_list($company_id,$year,$branch_id,$department_id,$is_active) {
            $query = $this->db->query("SELECT 
                                emp.last_name,
                                emp.first_name,
                                emp.middle_name,
                                emp.tin,
                                getwtax.wtax,
                                getwtax.acc_13thmonth_pay,
                                yearly_gross,
                                yearly_sss,
                                yearly_phil,
                                yearly_pagibig,
                                ROUND(yearly_gross - (yearly_sss + yearly_phil + yearly_pagibig),
                                        2) AS taxable_income
                            FROM
                                employee_list AS emp
                                    LEFT JOIN
                                (SELECT 
                                    ROUND(SUM(dtr.for_13thmonth) / 12) AS acc_13thmonth_pay,
                                        dtr.employee_id,
                                        ROUND(SUM(dtr.wtax_deduction), 2) AS wtax
                                FROM
                                    daily_time_record AS dtr
                                LEFT JOIN refpayperiod rpp ON rpp.pay_period_id = dtr.pay_period_id
                                LEFT JOIN pay_slip ps ON ps.dtr_id = dtr.dtr_id
                                WHERE
                                    EXTRACT(YEAR FROM rpp.pay_period_start) = $year
                                GROUP BY employee_id) AS getwtax ON getwtax.employee_id = emp.employee_id
                                    LEFT JOIN
                                (SELECT 
                                    dtr.employee_id,
                                        ROUND(SUM(dtr.basic_pay_total), 2) AS yearly_gross
                                FROM
                                    daily_time_record dtr
                                LEFT JOIN refpayperiod rpp ON rpp.pay_period_id = dtr.pay_period_id
                                LEFT JOIN pay_slip ps ON ps.dtr_id = dtr.dtr_id
                                WHERE
                                    EXTRACT(YEAR FROM rpp.pay_period_start) = $year
                                GROUP BY employee_id) AS gross ON gross.employee_id = emp.employee_id
                                    LEFT JOIN
                                (SELECT 
                                    dtr.employee_id,
                                        ROUND(SUM(dtr.sss_deduction), 2) AS yearly_sss
                                FROM
                                    daily_time_record dtr
                                LEFT JOIN refpayperiod rpp ON rpp.pay_period_id = dtr.pay_period_id
                                LEFT JOIN pay_slip ps ON ps.dtr_id = dtr.dtr_id
                                WHERE
                                    EXTRACT(YEAR FROM rpp.pay_period_start) = $year
                                GROUP BY employee_id) AS getsss ON getsss.employee_id = emp.employee_id
                                    LEFT JOIN
                                (SELECT 
                                    dtr.employee_id,
                                        ROUND(SUM(dtr.philhealth_deduction), 2) AS yearly_phil
                                FROM
                                    daily_time_record dtr
                                LEFT JOIN refpayperiod rpp ON rpp.pay_period_id = dtr.pay_period_id
                                LEFT JOIN pay_slip ps ON ps.dtr_id = dtr.dtr_id
                                WHERE
                                    EXTRACT(YEAR FROM rpp.pay_period_start) = $year
                                GROUP BY employee_id) AS getphil ON getphil.employee_id = emp.employee_id
                                    LEFT JOIN
                                (SELECT 
                                    dtr.employee_id,
                                        ROUND(SUM(dtr.pagibig_deduction), 2) AS yearly_pagibig
                                FROM
                                    daily_time_record dtr
                                LEFT JOIN refpayperiod rpp ON rpp.pay_period_id = dtr.pay_period_id
                                LEFT JOIN pay_slip ps ON ps.dtr_id = dtr.dtr_id
                                WHERE
                                    EXTRACT(YEAR FROM rpp.pay_period_start) = $year
                                GROUP BY employee_id) AS getpagibig ON getpagibig.employee_id = emp.employee_id
                            WHERE
                                emp.is_deleted = 0
                                AND emp.company_id = $company_id
                                ".($is_active=='all'?"":" AND emp.is_active = $is_active")."
                                ".($branch_id=='all'?"":" AND emp.ref_branch_id = $branch_id")."
                                ".($department_id=='all'?"":" AND emp.ref_department_id = $department_id")."
                            ORDER BY emp.last_name ASC");

            return $query->result();
    }


}
?>
