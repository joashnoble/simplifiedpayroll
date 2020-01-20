<?php

class Payslip_model extends CORE_Model {
    protected  $table="pay_slip";
    protected  $pk_id="pay_slip_id";

    function __construct() {
        parent::__construct();
    }

    function get_dtr_id($dtr_id){
      $query = $this->db->query("SELECT pay_slip_id FROM pay_slip WHERE dtr_id =".$dtr_id);
      return $query->result();
    }

    function get_min_max_period($company_id,$employee_id){
      $query = $this->db->query("SELECT 
                main.employee_id,
                (SELECT DATE_FORMAT(pay_period_start, '%m%d') FROM refpayperiod WHERE pay_period_id = main.pay_period_id_1) AS period_1,
                (SELECT DATE_FORMAT(pay_period_end, '%m%d') FROM refpayperiod WHERE pay_period_id = main.pay_period_id_2) AS period_2
            FROM
                (SELECT 
                    dtr.employee_id,
                        el.company_id,
                        CONCAT(el.first_name, ' ', el.middle_name, ' ', el.last_name) AS employee_name,
                        (SELECT 
                                MIN(dtr1.pay_period_id)
                            FROM
                                pay_slip ps1
                            LEFT JOIN daily_time_record dtr1 ON dtr1.dtr_id = ps1.dtr_id
                            WHERE
                                dtr1.employee_id = dtr.employee_id) AS pay_period_id_1,
                        (SELECT 
                                MAX(dtr1.pay_period_id)
                            FROM
                                pay_slip ps1
                            LEFT JOIN daily_time_record dtr1 ON dtr1.dtr_id = ps1.dtr_id
                            WHERE
                                dtr1.employee_id = dtr.employee_id) AS pay_period_id_2
                FROM
                    pay_slip p
                LEFT JOIN daily_time_record dtr ON dtr.dtr_id = p.dtr_id
                LEFT JOIN employee_list el ON el.employee_id = dtr.employee_id
                GROUP BY dtr.employee_id) main
            WHERE
                main.company_id = $company_id
                AND main.employee_id = $employee_id");
      return $query->result();
    }

    function get_bir_2316($company_id=null,$pay_period_year,$emp_status,$ref_branch_id,$ref_department_id,$employee_id=null){
      $query = $this->db->query("SELECT 
              main2.*,
              (CASE
                  WHEN (main2.per_day_pay BETWEEN main2.from_wage_amount AND main2.to_wage_amount) THEN 1
                  ELSE 0
              END) AS is_minimum_wage
          FROM
              (SELECT 
                  main.*,
                      (SELECT from_wage_amount FROM minimum_wage WHERE wage_id = main.wage_id) AS from_wage_amount,
                      (SELECT to_wage_amount FROM minimum_wage WHERE wage_id = main.wage_id) AS to_wage_amount
              FROM
                  (SELECT 
                  el.rdo_no,
                  el.zip_code,
                  el.employee_id,
                      el.ecode,
                      el.per_day_pay,
                      el.monthly_based_salary,
                      (SELECT wage_id FROM company_management WHERE company_id = 6) AS wage_id,
                      CONCAT(el.last_name, ', ', el.first_name, ' ', el.middle_name) AS employee_name,
                      el.tin,
                      CONCAT(el.address_one, ' ', el.address_two) AS address,
                      DATE_FORMAT(el.birthdate, '%m%d%Y') AS birthdate,
                      el.cell_number,
                      el.civil_status,
                      SUM(dtr.holiday_pay) as holiday_pay,
                      SUM(dtr.overtime) as overtime,
                      (SUM(dtr.for_13thmonth) / 12) AS total_13thmonth,
                      SUM(dtr.allowance_pay) as allowance_pay,
                      SUM(dtr.commission) as commission,
                      SUM(dtr.sss_deduction) as sss_deduction,
                      SUM(dtr.philhealth_deduction) as philhealth_deduction,
                      SUM(dtr.pagibig_deduction) as pagibig_deduction,
                      SUM(dtr.wtax_deduction) as wtax_deduction,
                      (SUM(dtr.sss_deduction) + SUM(dtr.philhealth_deduction) + SUM(dtr.pagibig_deduction)) as total_contributions,
                      SUM(dtr.basic_pay_total) AS gross_pay,
                      SUM(dtr.total_deduction) AS deduction_pay,
                      SUM(dtr.net_total) AS net_pay
              FROM
                  pay_slip ps
              LEFT JOIN daily_time_record dtr ON dtr.dtr_id = ps.dtr_id
              LEFT JOIN employee_list el ON el.employee_id = dtr.employee_id
              LEFT JOIN refpayperiod rpp ON rpp.pay_period_id = dtr.pay_period_id
              WHERE
                  rpp.pay_period_year = '$pay_period_year'
                ".($company_id==""?"":" AND el.company_id=".$company_id."")."
                ".($emp_status=="all"?"":" AND el.is_active=".$emp_status."")."
                ".($ref_branch_id=="all"?"":" AND el.ref_branch_id=".$ref_branch_id."")."
                ".($ref_department_id=="all"?"":" AND el.ref_department_id=".$ref_department_id."")."
                ".($employee_id==""?"":" AND dtr.employee_id=".$employee_id."")."
              GROUP BY el.employee_id) main) main2");
          return $query->result();
    }

    function get_payslip_list($company_id,$pay_period_id=null,$ref_branch_id='all',$ref_department_id='all',$payslip_id=null,$is_active='all'){
      $query = $this->db->query("SELECT 
                  dtr.*,
                  payslip.*,
                  CONCAT(emp.first_name,
                          ' ',
                          emp.middle_name,
                          ' ',
                          emp.last_name) AS full_name,
                  emp.ecode,
                  dept.department,
                  CONCAT(DATE_FORMAT(payperiod.pay_period_start, '%m-%d-%Y'),
                          ' ~ ',
                          DATE_FORMAT(payperiod.pay_period_end, '%m-%d-%Y')) AS payperiod,
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
                  pay_slip payslip
                      LEFT JOIN
                  daily_time_record dtr ON dtr.dtr_id = payslip.dtr_id
                      LEFT JOIN
                  employee_list emp ON emp.employee_id = dtr.employee_id
                      LEFT JOIN
                  ref_department dept ON dept.ref_department_id = emp.ref_department_id
                      LEFT JOIN
                  refpayperiod payperiod ON payperiod.pay_period_id = dtr.pay_period_id
                      LEFT JOIN
                  pay_slip_deduction psd ON psd.pay_slip_id = payslip.pay_slip_id
                      LEFT JOIN
                  loan_list ll ON ll.loan_id = psd.deduction_id
                      LEFT JOIN
                  ref_loan rl ON rl.ref_loan_id = ll.ref_loan_id
              WHERE
                  dtr.is_processed = 1
                      AND dtr.is_deleted = 0
                      AND dtr.company_id = $company_id
                      AND emp.is_deleted = 0
                      ".($pay_period_id==null?"":" AND dtr.pay_period_id=".$pay_period_id."")."
                      ".($ref_branch_id=='all'?"":" AND emp.ref_branch_id=".$ref_branch_id."")."
                      ".($ref_department_id=='all'?"":" AND emp.ref_department_id=".$ref_department_id."")."
                      ".($payslip_id==null?"":" AND payslip.pay_slip_id=".$payslip_id."")."
                      ".($is_active=='all'?"":" AND emp.is_active=".$is_active."")."");
              return $query->result();
    }

    function get_last_payroll($employee_id){
      $query = $this->db->query("SELECT 
                      (CASE
                      WHEN
                        a.pay_slip_id != ''
                      THEN MAX(a.pay_slip_id)
                      ELSE 0
                    END) AS pay_slip_id
                  FROM
                      (SELECT 
                          pay_slip.*
                      FROM
                          pay_slip
                      LEFT JOIN daily_time_record ON daily_time_record.dtr_id = pay_slip.dtr_id
                      WHERE
                          daily_time_record.employee_id = ".$employee_id.") AS a");
      return $query->result();
    }

    function get_payslip($filter_payperiod, $filter_dept, $filter_branch){

        $dept = ($filter_dept != "all") ? "AND dptmt.ref_department_id=$filter_dept" : "";
        $branch = ($filter_branch != "all") ? "AND erd.ref_branch_id=$filter_branch" : "";

        $query = $this->db->query('SELECT
                              CONCAT(el.first_name," ",el.middle_name," ",el.last_name) AS fullname,
                              rpp.pay_period_start,
                              rpp.pay_period_end,
                              ps.*,
                              rpp.pay_period_start,
                              rpp.pay_period_end,
                              psdsss.sss_deduction,
                              psdphil.philhealth_deduction,
                              psdpagibig.pagibig_deduction,
                              psdwtax.wtax_deduction,
                              psdsssloan.sssloan_deduction,
                              psdpagibigloan.pagibigloan_deduction,
                              psdcooploan.cooploan_deduction,
                              psdcoopcontrib.coopcontribution_deduction,
                              psdcashadvance.cashadvance_deduction,
                              COALESCE(ROUND(psoeall.allowance, 2), 0) AS allowance,
                              COALESCE(ROUND(psoea.adjustment, 2), 0) AS adjustment,
                              COALESCE(ROUND(psoec.other_earnings, 2), 0) AS other_earnings,
                              psdcalamityloan.calamityloan_deduction,
                              psod.other_deductions,
                              dptmt.department,
                              pymt.payment_type,
                              brnch.branch,
                              brnch.description,
                              dtr.*,
                              (COALESCE(psdsss.sss_deduction, 0) + COALESCE(psdphil.philhealth_deduction,0) + COALESCE(psdpagibig.pagibig_deduction,0) + COALESCE(psdwtax.wtax_deduction,0) + COALESCE(psdsssloan.sssloan_deduction,0) + COALESCE(psdpagibigloan.pagibigloan_deduction,0) + COALESCE(psdcashadvance.cashadvance_deduction,0) + COALESCE(ps.minutes_late_amt,0) + COALESCE(psdcooploan.cooploan_deduction,0) + COALESCE(psdcoopcontrib.coopcontribution_deduction,0) + COALESCE(psdcalamityloan.calamityloan_deduction,0) + COALESCE(psod.other_deductions,0) + COALESCE(ps.days_wout_pay_amt,0) ) AS total_deduct

                          FROM
                              pay_slip AS ps
                                  LEFT JOIN
                              daily_time_record AS dtr ON ps.dtr_id = dtr.dtr_id
                                  LEFT JOIN
                              employee_list AS el ON dtr.employee_id = el.employee_id
                                  LEFT JOIN
                              emp_rates_duties AS erd ON el.employee_id = erd.employee_id
                                  LEFT JOIN
                              ref_department AS dptmt ON dptmt.ref_department_id = erd.ref_department_id
                                  LEFT JOIN
                              ref_branch AS brnch ON brnch.ref_branch_id = erd.ref_branch_id
                                  LEFT JOIN
                              ref_payment_type AS pymt ON pymt.ref_payment_type_id = erd.ref_payment_type_id
                                  LEFT JOIN
                              refpayperiod AS rpp ON dtr.pay_period_id = rpp.pay_period_id
                                  LEFT JOIN
                              (SELECT
                                  pay_slip_id, SUM(earnings_amount) AS allowance
                              FROM
                                  pay_slip_other_earnings
                              WHERE
                                  earnings_id = 1
                              GROUP BY pay_slip_id) AS psoeall ON ps.pay_slip_id = psoeall.pay_slip_id
                                  LEFT JOIN
                              (SELECT
                                  pay_slip_id, SUM(earnings_amount) AS adjustment
                              FROM
                                  pay_slip_other_earnings
                              WHERE
                                  earnings_id = 2
                              GROUP BY pay_slip_id) AS psoea ON ps.pay_slip_id = psoea.pay_slip_id
                                  LEFT JOIN
                              (SELECT
                                  pay_slip_id, SUM(earnings_amount) AS other_earnings
                              FROM
                                  pay_slip_other_earnings
                              WHERE
                                  earnings_id != 1 AND earnings_id != 2
                              GROUP BY pay_slip_id) AS psoec ON ps.pay_slip_id = psoec.pay_slip_id
                                  LEFT JOIN
                              (SELECT
                                  pay_slip_id, (deduction_amount) AS sss_deduction
                              FROM
                                  pay_slip_deductions
                              WHERE
                                  deduction_id = 1) AS psdsss ON ps.pay_slip_id = psdsss.pay_slip_id
                                  LEFT JOIN
                              (SELECT
                                  pay_slip_id, (deduction_amount) AS philhealth_deduction
                              FROM
                                  pay_slip_deductions
                              WHERE
                                  deduction_id = 2) AS psdphil ON ps.pay_slip_id = psdphil.pay_slip_id
                                  LEFT JOIN
                              (SELECT
                                  pay_slip_id, (deduction_amount) AS pagibig_deduction
                              FROM
                                  pay_slip_deductions
                              WHERE
                                  deduction_id = 3) AS psdpagibig ON ps.pay_slip_id = psdpagibig.pay_slip_id
                                  LEFT JOIN
                              (SELECT
                                  pay_slip_id, (deduction_amount) AS wtax_deduction
                              FROM
                                  pay_slip_deductions
                              WHERE
                                  deduction_id = 4) AS psdwtax ON ps.pay_slip_id = psdwtax.pay_slip_id
                                  LEFT JOIN
                              (SELECT
                                  pay_slip_id, (deduction_amount) AS sssloan_deduction
                              FROM
                                  pay_slip_deductions
                              WHERE
                                  deduction_id = 5) AS psdsssloan ON ps.pay_slip_id = psdsssloan.pay_slip_id
                                  LEFT JOIN
                              (SELECT
                                  pay_slip_id, (deduction_amount) AS pagibigloan_deduction
                              FROM
                                  pay_slip_deductions
                              WHERE
                                  deduction_id = 6) AS psdpagibigloan ON ps.pay_slip_id = psdpagibigloan.pay_slip_id
                                  LEFT JOIN
                              (SELECT
                                  pay_slip_id, (deduction_amount) AS cashadvance_deduction
                              FROM
                                  pay_slip_deductions
                              WHERE
                                  deduction_id = 7) AS psdcashadvance ON ps.pay_slip_id = psdcashadvance.pay_slip_id
                                  LEFT JOIN
                              (SELECT
                                  pay_slip_id, (deduction_amount) AS cooploan_deduction
                              FROM
                                  pay_slip_deductions
                              WHERE
                                  deduction_id = 8) AS psdcooploan ON ps.pay_slip_id = psdcooploan.pay_slip_id
                                  LEFT JOIN
                              (SELECT
                                  pay_slip_id, (deduction_amount) AS calamityloan_deduction
                              FROM
                                  pay_slip_deductions
                              WHERE
                                  deduction_id = 12) AS psdcalamityloan ON ps.pay_slip_id = psdcalamityloan.pay_slip_id
                                  LEFT JOIN
                              (SELECT
                                  pay_slip_id, SUM(deduction_amount) AS other_deductions
                              FROM
                                  pay_slip_deductions
                              LEFT JOIN refdeduction ON refdeduction.deduction_id = pay_slip_deductions.deduction_id
                              WHERE
                                  refdeduction.deduction_type_id != 1
                                      AND refdeduction.deduction_type_id != 2
                                      AND refdeduction.deduction_type_id != 4
                                      AND active_deduct = TRUE
                              GROUP BY pay_slip_id) AS psod ON ps.pay_slip_id = psod.pay_slip_id
                                  LEFT JOIN
                              (SELECT
                                  pay_slip_id,
                                      (deduction_amount) AS coopcontribution_deduction
                              FROM
                                  pay_slip_deductions
                              WHERE
                                  deduction_id = 9) AS psdcoopcontrib ON ps.pay_slip_id = psdcoopcontrib.pay_slip_id
                          WHERE
                              erd.active_rates_duties = 1
                          AND
                              rpp.pay_period_id='.$filter_payperiod.' '.$dept.' '.$branch.'
                          ORDER BY fullname');
    return $query->result();
    }
}
?>
