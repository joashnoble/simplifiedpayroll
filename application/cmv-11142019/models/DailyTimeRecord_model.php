<?php

class DailyTimeRecord_model extends CORE_Model {
    protected  $table="daily_time_record";
    protected  $pk_id="dtr_id";

    function __construct() {
        parent::__construct();
    }

    /*function replaceCharsInNumber($num, $chars) {
                     return substr((string) $num, 0, -strlen($chars)) . $chars;
                }*/

    /*function payslip_modify($pay_slip_id){ //if STRING or is ARRAY, just pass it
            $payslip_code_query = $this->db->query('UPDATE pay_slip set pay_slip_code = Payslipcode() WHERE
                                                    pay_slip_id='.$pay_slip_id);
    }

    function payslip_modifyifexist($pay_slip_id,$pay_slip_code){ //if STRING or is ARRAY, just pass it
            $payslip_code_query = $this->db->query('UPDATE pay_slip set pay_slip_code ="'.$pay_slip_code.'" WHERE
                                                    pay_slip_id='.$pay_slip_id);
    }*/

    function get_dtr_status($company_id,$pay_period_id,$ref_branch_id,$ref_department_id){
        $query = $this->db->query("SELECT 
                        dtr.*,
                        emp.per_hour_pay
                    FROM
                        daily_time_record dtr
                    LEFT JOIN employee_list emp ON
                    emp.employee_id = dtr.employee_id
                    WHERE
                        dtr.pay_period_id = ".$pay_period_id."
                        AND dtr.company_id = ".$company_id."
                        AND emp.company_id = $company_id
                        AND emp.is_deleted = 0
                        AND dtr.is_deleted = 0
                        ".($ref_branch_id=='all'?"":" AND emp.ref_branch_id=".$ref_branch_id."")."
                        ".($ref_department_id=='all'?"":" AND emp.ref_department_id=".$ref_department_id."")."
                    ");
            $query->result();
            return $query->result();
    }

    function get_dtr_list($company_id,$pay_period_id,$ref_branch_id,$ref_department_id){
        $query = $this->db->query("SELECT 
                        dtr.*,
                        emp.*,
                        emp.ecode,
                        emp.per_hour_pay,
                        dtr.per_day_pay,
                        emp.ref_payfrequency_type_id,
                        'dtr_process' AS process_type,
                        CONCAT(emp.first_name,' ',emp.middle_name,' ',emp.last_name) as full_name,
                        (CASE
                            WHEN loan.ref_loan_id = null THEN 0.00
                            WHEN loan.ref_loan_id = 0 THEN 0.00
                            WHEN loan.ref_loan_id = 1
                                THEN 
                                     (CASE
                                        WHEN psd.deduction_amount = null THEN 0.00
                                        WHEN psd.deduction_amount != 0 THEN psd.deduction_amount
                                        WHEN psd.deduction_amount != null THEN psd.deduction_amount
                                        ELSE 0.00
                                    END)
                            ELSE 0.00
                        END) AS sss_loan,
                        (CASE
                            WHEN loan.ref_loan_id = null THEN 0
                            WHEN loan.ref_loan_id = 0 THEN 0
                            WHEN loan.ref_loan_id = 1 THEN loan.loan_id
                            ELSE 0
                        END) AS sss_loan_id,
                        (CASE
                            WHEN loan.ref_loan_id = null THEN 0.00
                            WHEN loan.ref_loan_id = 0 THEN 0.00
                            WHEN loan.ref_loan_id = 2
                                THEN 
                                     (CASE
                                        WHEN psd.deduction_amount = null THEN 0.00
                                        WHEN psd.deduction_amount != 0 THEN psd.deduction_amount
                                        WHEN psd.deduction_amount != null THEN psd.deduction_amount
                                        ELSE 0.00
                                    END)
                            ELSE 0.00
                        END) AS pagibig_loan,
                        (CASE
                            WHEN loan.ref_loan_id = null THEN 0
                            WHEN loan.ref_loan_id = 0 THEN 0
                            WHEN loan.ref_loan_id = 2 THEN loan.loan_id
                            ELSE 0
                        END) AS pagibig_loan_id,
                        (CASE
                            WHEN loan.ref_loan_id = null THEN 0.00
                            WHEN loan.ref_loan_id = 0 THEN 0.00
                            WHEN loan.ref_loan_id = 3
                                THEN 
                                     (CASE
                                        WHEN psd.deduction_amount = null THEN 0.00
                                        WHEN psd.deduction_amount != 0 THEN psd.deduction_amount
                                        WHEN psd.deduction_amount != null THEN psd.deduction_amount
                                        ELSE 0.00
                                    END)
                            ELSE 0.00
                        END) AS cash_advance,
                        (CASE
                            WHEN loan.ref_loan_id = null THEN 0
                            WHEN loan.ref_loan_id = 0 THEN 0
                            WHEN loan.ref_loan_id = 3 THEN loan.loan_id
                            ELSE 0
                        END) AS cash_advance_id
                    FROM
                        daily_time_record dtr
                        LEFT JOIN employee_list emp ON
                            emp.employee_id = dtr.employee_id
                        LEFT JOIN pay_slip ps ON
                            ps.dtr_id = dtr.dtr_id
                        LEFT JOIN pay_slip_deduction psd ON
                            psd.pay_slip_id = ps.pay_slip_id
                        LEFT JOIN loan_list loan ON
                            loan.loan_id = psd.deduction_id
                    WHERE dtr.is_deleted = 0
                        AND dtr.pay_period_id = $pay_period_id
                        AND dtr.company_id = $company_id
                        AND emp.company_id = $company_id
                        AND emp.is_deleted = 0
                        ".($ref_branch_id=='all'?"":" AND emp.ref_branch_id=".$ref_branch_id."")."
                        ".($ref_department_id=='all'?"":" AND emp.ref_department_id=".$ref_department_id."")."
                    ");
            $query->result();
            return $query->result();        
    }

    function get_refresh_dtr_list($company_id,$count,$frequency,$pay_period_id,$ref_branch_id,$ref_department_id,$pagibig1){
        $query = $this->db->query("SELECT 
                        dtr.no_of_hrs,
                        dtr.overtime,
                        dtr.holiday_pay,
                        dtr.commission,
                        dtr.undertime,
                        dtr.late,
                        dtr.undertime_amt,
                        dtr.late_amt,
                        dtr.sss_loan,
                        dtr.pagibig_loan,
                        dtr.cash_advance,
                        dtr.is_processed,
                        dtr.adjustment_additional,
                        dtr.adjustment_deduction,
                        emp.ecode,
                        emp.per_day_pay,
                        emp.per_hour_pay,
                        emp.ref_payfrequency_type_id,
                        emp.allowance,
                        ROUND(emp.salary_reg_rates, 2) AS salary_reg_rates,
                        'dtr_process' AS process_type,
                        emp.employee_id,
                        CONCAT(emp.first_name,
                                ' ',
                                emp.middle_name,
                                ' ',
                                emp.last_name) AS full_name,
                        ((CASE
                            WHEN
                                emp.exmpt_sss = 0
                            THEN
                                (CASE
                                    WHEN
                                        emp.ref_payfrequency_type_id = 2
                                    THEN
                                        COALESCE((SELECT 
                                                        ROUND(employee, 2)
                                                    FROM
                                                        ref_sss_contribution
                                                    WHERE
                                                        emp.monthly_based_salary BETWEEN salary_range_from AND salary_range_to
                                                        AND ref_sss_contribution.is_deleted = 0),
                                                0.00)
                                    WHEN
                                        emp.ref_payfrequency_type_id = 1
                                    THEN
                                        COALESCE((SELECT 
                                                        ROUND((employee / 2), 2)
                                                    FROM
                                                        ref_sss_contribution
                                                    WHERE
                                                        emp.monthly_based_salary BETWEEN salary_range_from AND salary_range_to
                                                        AND ref_sss_contribution.is_deleted = 0),
                                                0.00)
                                    WHEN
                                        emp.ref_payfrequency_type_id = 4
                                    THEN
                                        COALESCE((SELECT 
                                                        ROUND((employee / $count), 2)
                                                    FROM
                                                        ref_sss_contribution
                                                    WHERE
                                                        emp.monthly_based_salary BETWEEN salary_range_from AND salary_range_to
                                                        AND ref_sss_contribution.is_deleted = 0),
                                                0.00)
                                    ELSE COALESCE((SELECT 
                                                    ROUND(employee, 2)
                                                FROM
                                                    ref_sss_contribution
                                                WHERE
                                                    emp.monthly_based_salary BETWEEN salary_range_from AND salary_range_to
                                                    AND ref_sss_contribution.is_deleted = 0),
                                            0.00)
                                END)
                            ELSE 0.00
                        END)) AS sss_deduction,
                        ((CASE
                            WHEN
                                emp.exmpt_sss = 0
                            THEN
                                (CASE
                                    WHEN
                                        emp.ref_payfrequency_type_id = 2
                                    THEN
                                        COALESCE((SELECT 
                                                        ROUND(employer, 2)
                                                    FROM
                                                        ref_sss_contribution
                                                    WHERE
                                                        emp.monthly_based_salary BETWEEN salary_range_from AND salary_range_to
                                                        AND ref_sss_contribution.is_deleted = 0),
                                                0.00)
                                    WHEN
                                        emp.ref_payfrequency_type_id = 1
                                    THEN
                                        COALESCE((SELECT 
                                                        ROUND((employer / 2), 2)
                                                    FROM
                                                        ref_sss_contribution
                                                    WHERE
                                                        emp.monthly_based_salary BETWEEN salary_range_from AND salary_range_to
                                                        AND ref_sss_contribution.is_deleted = 0),
                                                0.00)
                                    WHEN
                                        emp.ref_payfrequency_type_id = 4
                                    THEN
                                        COALESCE((SELECT 
                                                        ROUND((employer / $count), 2)
                                                    FROM
                                                        ref_sss_contribution
                                                    WHERE
                                                        emp.monthly_based_salary BETWEEN salary_range_from AND salary_range_to
                                                        AND ref_sss_contribution.is_deleted = 0),
                                                0.00)
                                    ELSE COALESCE((SELECT 
                                                    ROUND(employer, 2)
                                                FROM
                                                    ref_sss_contribution
                                                WHERE
                                                    emp.monthly_based_salary BETWEEN salary_range_from AND salary_range_to
                                                    AND ref_sss_contribution.is_deleted = 0),
                                            0.00)
                                END)
                            ELSE 0.00
                        END)) AS sss_employer,
                        ((CASE
                            WHEN
                                emp.exmpt_sss = 0
                            THEN
                                (CASE
                                    WHEN
                                        emp.ref_payfrequency_type_id = 2
                                    THEN
                                        COALESCE((SELECT 
                                                        ROUND(employer_contribution, 2)
                                                    FROM
                                                        ref_sss_contribution
                                                    WHERE
                                                        emp.monthly_based_salary BETWEEN salary_range_from AND salary_range_to
                                                        AND ref_sss_contribution.is_deleted = 0),
                                                0.00)
                                    WHEN
                                        emp.ref_payfrequency_type_id = 1
                                    THEN
                                        COALESCE((SELECT 
                                                        ROUND((employer_contribution / 2), 2)
                                                    FROM
                                                        ref_sss_contribution
                                                    WHERE
                                                        emp.monthly_based_salary BETWEEN salary_range_from AND salary_range_to
                                                        AND ref_sss_contribution.is_deleted = 0),
                                                0.00)
                                    WHEN
                                        emp.ref_payfrequency_type_id = 4
                                    THEN
                                        COALESCE((SELECT 
                                                        ROUND((employer_contribution / $count), 2)
                                                    FROM
                                                        ref_sss_contribution
                                                    WHERE
                                                        emp.monthly_based_salary BETWEEN salary_range_from AND salary_range_to
                                                        AND ref_sss_contribution.is_deleted = 0),
                                                0.00)
                                    ELSE COALESCE((SELECT 
                                                    ROUND(employer_contribution, 2)
                                                FROM
                                                    ref_sss_contribution
                                                WHERE
                                                    emp.monthly_based_salary BETWEEN salary_range_from AND salary_range_to
                                                    AND ref_sss_contribution.is_deleted = 0),
                                            0.00)
                                END)
                            ELSE 0.00
                        END)) AS sss_employer_contribution,
                        (CASE
                            WHEN
                                emp.exmpt_philhealth = 0
                            THEN
                                (CASE
                                    WHEN
                                        emp.ref_payfrequency_type_id = 2
                                    THEN
                                        COALESCE((SELECT 
                                                        (CASE
                                                                WHEN emp.monthly_based_salary <= 10000 THEN ROUND(employee, 4)
                                                                WHEN emp.monthly_based_salary > 40000 THEN ROUND(employee, 4)
                                                                ELSE ROUND(((emp.monthly_based_salary * percentage) / 2),
                                                                        4)
                                                            END) AS employee
                                                    FROM
                                                        ref_philhealth_contribution
                                                    WHERE
                                                        emp.monthly_based_salary BETWEEN salary_range_from AND salary_range_to),
                                                0.00)
                                    WHEN
                                        emp.ref_payfrequency_type_id = 1
                                    THEN
                                        COALESCE((SELECT 
                                                        (CASE
                                                                WHEN emp.monthly_based_salary <= 10000 THEN ROUND((employee / 2), 4)
                                                                WHEN emp.monthly_based_salary > 40000 THEN ROUND((employee / 2), 4)
                                                                ELSE ROUND((((emp.monthly_based_salary * percentage) / 2) / 2),
                                                                        4)
                                                            END) AS employee
                                                    FROM
                                                        ref_philhealth_contribution
                                                    WHERE
                                                        emp.monthly_based_salary BETWEEN salary_range_from AND salary_range_to),
                                                0.00)
                                    WHEN
                                        emp.ref_payfrequency_type_id = 4
                                    THEN
                                        COALESCE((SELECT 
                                                        (CASE
                                                                WHEN emp.monthly_based_salary <= 10000 THEN ROUND((employee / $count), 4)
                                                                WHEN emp.monthly_based_salary > 40000 THEN ROUND((employee / $count), 4)
                                                                ELSE ROUND((((emp.monthly_based_salary * percentage) / 2) / $count),
                                                                        4)
                                                            END) AS employee
                                                    FROM
                                                        ref_philhealth_contribution
                                                    WHERE
                                                        emp.monthly_based_salary BETWEEN salary_range_from AND salary_range_to),
                                                0.00)
                                    ELSE COALESCE((SELECT 
                                                    (CASE
                                                            WHEN emp.monthly_based_salary <= 10000 THEN ROUND(employee, 4)
                                                            WHEN emp.monthly_based_salary > 40000 THEN ROUND(employee, 4)
                                                            ELSE ROUND(((emp.monthly_based_salary * percentage) / 2),
                                                                    4)
                                                        END) AS employee
                                                FROM
                                                    ref_philhealth_contribution
                                                WHERE
                                                    emp.monthly_based_salary BETWEEN salary_range_from AND salary_range_to),
                                            0.00)
                                END)
                            ELSE 0.00
                        END) AS philhealth_deduction,
                        (CASE
                            WHEN
                                exmpt_pagibig = 0
                            THEN
                                (CASE
                                    WHEN emp.ref_payfrequency_type_id = 2 THEN ROUND($pagibig1, 2)
                                    WHEN emp.ref_payfrequency_type_id = 1 THEN ROUND(($pagibig1 / 2), 2)
                                    WHEN emp.ref_payfrequency_type_id = 4 THEN ROUND(($pagibig1 / $count), 2)
                                    ELSE $pagibig1
                                END)
                            ELSE 0.00
                        END) AS pagibig_deduction
                    FROM
                        daily_time_record dtr
                            LEFT JOIN
                        employee_list emp ON emp.employee_id = dtr.employee_id
                    WHERE
                        dtr.is_deleted = 0
                        AND dtr.pay_period_id = $pay_period_id
                        AND dtr.company_id = $company_id
                        AND emp.company_id = $company_id
                        AND emp.is_deleted = 0
                        ".($ref_branch_id=='all'?"":" AND emp.ref_branch_id=".$ref_branch_id."")."
                        ".($ref_department_id=='all'?"":" AND emp.ref_department_id=".$ref_department_id."")."
                    ");
            $query->result();
            return $query->result();        
    }

    function chck_dtr_emp($employee_id,$pay_period_id){
        $query = $this->db->query("SELECT * FROM daily_time_record WHERE employee_id = $employee_id AND pay_period_id = $pay_period_id");
        $query->result();
        return $query->result();
    }

    function ifexistdtr($employee_id,$pay_period_id) {
        $query = $this->db->query('SELECT dtr_id FROM daily_time_record WHERE employee_id='.$employee_id.' AND pay_period_id='.$pay_period_id.' ');
                            $query->result();

                          return $query->result();
    }

    function getperiodid($dtr_id){
        $query = $this->db->query('SELECT pay_period_id FROM daily_time_record WHERE dtr_id='.$dtr_id);
                            $query->result();
                          return $query->result();
    }

    function getwithoutdtr($pay_period_id) {
                        $query = $this->db->query("SELECT 
                    employee_list.*, ref_department.department
                FROM
                    employee_list
                        LEFT JOIN
                    emp_rates_duties ON employee_list.employee_id = emp_rates_duties.employee_id
                        LEFT JOIN
                    ref_department ON emp_rates_duties.ref_department_id = ref_department.ref_department_id
                WHERE
                    employee_list.emp_rates_duties_id != 0
                        AND emp_rates_duties.active_rates_duties = 1
                        AND employee_list.is_retired != 1
                        AND employee_list.employee_id NOT IN (SELECT 
                            employee_id
                        FROM
                            daily_time_record
                        WHERE
                            pay_period_id = $pay_period_id)
                ORDER BY first_name ASC");
                $query->result();

                return $query->result();
    }

    // function get_sss_report($filter){
    //     $query = $this->db->query("SELECT 
    //             employee_list.sss,
    //             employee_list.ecode,
    //             CONCAT(employee_list.first_name,
    //                     ' ',
    //                     employee_list.middle_name,
    //                     ' ',
    //                     employee_list.last_name) AS full_name,
    //             ROUND(pay_slip_deductions.sss_deduction_employee, 2) AS sss_deduction_employee,
    //             ROUND(pay_slip_deductions.sss_deduction_employer, 2) AS sss_deduction_employer,
    //             ROUND(pay_slip_deductions.sss_deduction_ec, 2) AS sss_deduction_ec,
    //             daily_time_record.employee_id,
    //             daily_time_record.pay_period_id,
    //             pay_slip.pay_slip_id,
    //             refpayperiod.month_id,
    //             pay_slip_deductions.deduction_amount,
    //             pay_slip_deductions.sss_id,
    //             ref_sss_contribution.employee,
    //             ref_sss_contribution.employer,
    //             ref_sss_contribution.employer_contribution,
    //             ref_sss_contribution.total,
    //             CONCAT(refpayperiod.pay_period_start,
    //                     '~',
    //                     refpayperiod.pay_period_end) AS period
    //         FROM
    //             daily_time_record
    //                 LEFT JOIN
    //             pay_slip ON pay_slip.dtr_id = daily_time_record.dtr_id
    //                 LEFT JOIN
    //             refpayperiod ON refpayperiod.pay_period_id = daily_time_record.pay_period_id
    //                 LEFT JOIN
    //             pay_slip_deductions ON pay_slip_deductions.pay_slip_id = pay_slip.pay_slip_id
    //                 LEFT JOIN
    //             emp_rates_duties ON emp_rates_duties.employee_id = daily_time_record.employee_id
    //                 LEFT JOIN
    //             employee_list ON employee_list.employee_id = daily_time_record.employee_id
    //                 LEFT JOIN
    //             ref_sss_contribution ON ref_sss_contribution.ref_sss_contribution_id = pay_slip_deductions.sss_id
    //         WHERE
    //             $filter
    //         ORDER BY employee_list.first_name ASC");
    //         $query->result();
    //         return $query->result();
    // }

    function get_pagibig_report($company_id,$year,$month='all',$ref_branch_id='all',$ref_department_id='all',$is_active){
        $query = $this->db->query("SELECT 
                    SUM(daily_time_record.pagibig_deduction) AS employee,
                    CONCAT(employee_list.last_name,
                            ', ',
                            employee_list.first_name,
                            ' ',
                            employee_list.middle_name) AS full_name,
                    employee_list.pag_ibig,
                    employee_list.ecode,
                    ref_department.department,
                    (CASE
                        WHEN refpayperiod.month_id = 1 THEN 'January'
                        WHEN refpayperiod.month_id = 2 THEN 'February'
                        WHEN refpayperiod.month_id = 3 THEN 'March'
                        WHEN refpayperiod.month_id = 4 THEN 'April'
                        WHEN refpayperiod.month_id = 5 THEN 'May'
                        WHEN refpayperiod.month_id = 6 THEN 'June'
                        WHEN refpayperiod.month_id = 7 THEN 'July'
                        WHEN refpayperiod.month_id = 8 THEN 'August'
                        WHEN refpayperiod.month_id = 9 THEN 'September'
                        WHEN refpayperiod.month_id = 10 THEN 'October'
                        WHEN refpayperiod.month_id = 11 THEN 'November'
                        WHEN refpayperiod.month_id = 12 THEN 'December'
                        ELSE 'All'
                    END) AS periodmonth
                FROM
                    pay_slip
                        LEFT JOIN
                    daily_time_record ON pay_slip.dtr_id = daily_time_record.dtr_id
                        LEFT JOIN
                    employee_list ON employee_list.employee_id = daily_time_record.employee_id
                        LEFT JOIN
                    refpayperiod ON refpayperiod.pay_period_id = daily_time_record.pay_period_id
                        LEFT JOIN
                    ref_department ON ref_department.ref_department_id = employee_list.ref_department_id
                    WHERE
                            EXTRACT(YEAR FROM refpayperiod.pay_period_end) = '".$year."'
                                AND daily_time_record.pagibig_deduction > 0
                                AND daily_time_record.company_id = $company_id
                                AND employee_list.is_deleted = 0 
                                ".($is_active=='all'?"":" AND employee_list.is_active=".$is_active."")."
                                ".($ref_branch_id=='all'?"":" AND employee_list.ref_branch_id=".$ref_branch_id."")."
                                ".($ref_department_id=='all'?"":" AND employee_list.ref_department_id=".$ref_department_id."")."
                                ".($month=='all'?"":" AND refpayperiod.month_id=".$month."")."
                        GROUP BY daily_time_record.employee_id, refpayperiod.month_id, EXTRACT(YEAR FROM refpayperiod.pay_period_end)
                        ORDER BY refpayperiod.month_id, employee_list.employee_id ASC");
        $query->result();
        return $query->result();
    }


    function get_philhealth_report($company_id,$year,$month='all',$ref_branch_id='all',$ref_department_id='all',$is_active){
        $query = $this->db->query("SELECT 
                    SUM(daily_time_record.philhealth_deduction) AS employee,
                    SUM(daily_time_record.philhealth_employer) AS employer,
                    (SUM(daily_time_record.philhealth_deduction) + SUM(daily_time_record.philhealth_employer)) AS total,
                    CONCAT(employee_list.last_name,
                            ', ',
                            employee_list.first_name,
                            ' ',
                            employee_list.middle_name) AS full_name,
                    employee_list.phil_health,
                    employee_list.ecode,
                    ref_department.department,
                    (CASE
                        WHEN refpayperiod.month_id = 1 THEN 'January'
                        WHEN refpayperiod.month_id = 2 THEN 'February'
                        WHEN refpayperiod.month_id = 3 THEN 'March'
                        WHEN refpayperiod.month_id = 4 THEN 'April'
                        WHEN refpayperiod.month_id = 5 THEN 'May'
                        WHEN refpayperiod.month_id = 6 THEN 'June'
                        WHEN refpayperiod.month_id = 7 THEN 'July'
                        WHEN refpayperiod.month_id = 8 THEN 'August'
                        WHEN refpayperiod.month_id = 9 THEN 'September'
                        WHEN refpayperiod.month_id = 10 THEN 'October'
                        WHEN refpayperiod.month_id = 11 THEN 'November'
                        WHEN refpayperiod.month_id = 12 THEN 'December'
                        ELSE 'All'
                    END) AS periodmonth
                FROM
                    pay_slip
                        LEFT JOIN
                    daily_time_record ON pay_slip.dtr_id = daily_time_record.dtr_id
                        LEFT JOIN
                    employee_list ON employee_list.employee_id = daily_time_record.employee_id
                        LEFT JOIN
                    refpayperiod ON refpayperiod.pay_period_id = daily_time_record.pay_period_id
                        LEFT JOIN
                    ref_department ON ref_department.ref_department_id = employee_list.ref_department_id
                WHERE
                EXTRACT(YEAR FROM refpayperiod.pay_period_end) = '".$year."'
                    AND daily_time_record.philhealth_deduction > 0
                    AND daily_time_record.company_id = $company_id
                    AND employee_list.is_deleted = 0
                    ".($is_active=='all'?"":" AND employee_list.is_active=".$is_active."")."
                    ".($ref_branch_id=='all'?"":" AND employee_list.ref_branch_id=".$ref_branch_id."")."
                    ".($ref_department_id=='all'?"":" AND employee_list.ref_department_id=".$ref_department_id."")."
                    ".($month=='all'?"":" AND refpayperiod.month_id=".$month."")."
                GROUP BY daily_time_record.employee_id , refpayperiod.month_id , EXTRACT(YEAR FROM refpayperiod.pay_period_end)
                ORDER BY refpayperiod.month_id , employee_list.employee_id ASC");
        $query->result();
        return $query->result();
    }


     function get_sss_report($company_id,$year,$month='all',$ref_branch_id='all',$ref_department_id='all',$is_active){
        $query = $this->db->query("SELECT 
                SUM(daily_time_record.sss_deduction) AS employee,
                SUM(daily_time_record.sss_employer) AS employer,
                SUM(daily_time_record.sss_employer_contribution) AS employer_contribution,
                (SUM(daily_time_record.sss_deduction) + SUM(daily_time_record.sss_employer) + SUM(daily_time_record.sss_employer_contribution)) AS total, 
                CONCAT(employee_list.last_name,
                        ', ',
                        employee_list.first_name,
                        ' ',
                        employee_list.middle_name) AS full_name,
                employee_list.sss,
                employee_list.ecode,
                ref_department.department,
                (CASE
                    WHEN refpayperiod.month_id = 1 THEN 'January'
                    WHEN refpayperiod.month_id = 2 THEN 'February'
                    WHEN refpayperiod.month_id = 3 THEN 'March'
                    WHEN refpayperiod.month_id = 4 THEN 'April'
                    WHEN refpayperiod.month_id = 5 THEN 'May'
                    WHEN refpayperiod.month_id = 6 THEN 'June'
                    WHEN refpayperiod.month_id = 7 THEN 'July'
                    WHEN refpayperiod.month_id = 8 THEN 'August'
                    WHEN refpayperiod.month_id = 9 THEN 'September'
                    WHEN refpayperiod.month_id = 10 THEN 'October'
                    WHEN refpayperiod.month_id = 11 THEN 'November'
                    WHEN refpayperiod.month_id = 12 THEN 'December'
                    ELSE 'All'
                END) AS periodmonth
            FROM
                pay_slip
                    LEFT JOIN
                daily_time_record ON pay_slip.dtr_id = daily_time_record.dtr_id
                    LEFT JOIN
                employee_list ON employee_list.employee_id = daily_time_record.employee_id
                    LEFT JOIN
                refpayperiod ON refpayperiod.pay_period_id = daily_time_record.pay_period_id
                    LEFT JOIN
                ref_department ON ref_department.ref_department_id = employee_list.ref_department_id
            WHERE
                EXTRACT(YEAR FROM refpayperiod.pay_period_end) = '".$year."'
                    AND daily_time_record.sss_deduction > 0
                    AND daily_time_record.company_id = $company_id
                    AND employee_list.is_deleted = 0
                    ".($is_active=='all'?"":" AND employee_list.is_active=".$is_active."")."
                    ".($ref_branch_id=='all'?"":" AND employee_list.ref_branch_id=".$ref_branch_id."")."
                    ".($ref_department_id=='all'?"":" AND employee_list.ref_department_id=".$ref_department_id."")."
                    ".($month=='all'?"":" AND refpayperiod.month_id=".$month."")."
            GROUP BY daily_time_record.employee_id, refpayperiod.month_id, EXTRACT(YEAR FROM refpayperiod.pay_period_end)
            ORDER BY refpayperiod.month_id, employee_list.employee_id ASC");
            $query->result();
            return $query->result();
    }
    
    function get_wtax_report($company_id,$year,$month='all',$ref_branch_id='all',$ref_department_id='all',$is_active){
        $query = $this->db->query("SELECT 
                        SUM(daily_time_record.wtax_deduction) AS wtax_employee,
                        SUM(daily_time_record.gross_total) AS taxable_amount,
                        CONCAT(employee_list.last_name,
                                ', ',
                                employee_list.first_name,
                                ' ',
                                employee_list.middle_name) AS full_name,
                        employee_list.tin,
                        employee_list.ecode,
                        ref_department.department,
                        (CASE
                            WHEN refpayperiod.month_id = 1 THEN 'January'
                            WHEN refpayperiod.month_id = 2 THEN 'February'
                            WHEN refpayperiod.month_id = 3 THEN 'March'
                            WHEN refpayperiod.month_id = 4 THEN 'April'
                            WHEN refpayperiod.month_id = 5 THEN 'May'
                            WHEN refpayperiod.month_id = 6 THEN 'June'
                            WHEN refpayperiod.month_id = 7 THEN 'July'
                            WHEN refpayperiod.month_id = 8 THEN 'August'
                            WHEN refpayperiod.month_id = 9 THEN 'September'
                            WHEN refpayperiod.month_id = 10 THEN 'October'
                            WHEN refpayperiod.month_id = 11 THEN 'November'
                            WHEN refpayperiod.month_id = 12 THEN 'December'
                            ELSE 'All'
                        END) AS periodmonth
                    FROM
                        pay_slip
                            LEFT JOIN
                        daily_time_record ON pay_slip.dtr_id = daily_time_record.dtr_id
                            LEFT JOIN
                        employee_list ON employee_list.employee_id = daily_time_record.employee_id
                            LEFT JOIN
                        refpayperiod ON refpayperiod.pay_period_id = daily_time_record.pay_period_id
                            LEFT JOIN
                        ref_department ON ref_department.ref_department_id = employee_list.ref_department_id
                    WHERE
                        EXTRACT(YEAR FROM refpayperiod.pay_period_end) = '".$year."'
                            AND daily_time_record.wtax_deduction > 0
                            AND daily_time_record.company_id = $company_id
                            AND employee_list.is_deleted = 0
                            ".($is_active=='all'?"":" AND employee_list.is_active=".$is_active."")."
                            ".($ref_branch_id=='all'?"":" AND employee_list.ref_branch_id=".$ref_branch_id."")."
                            ".($ref_department_id=='all'?"":" AND employee_list.ref_department_id=".$ref_department_id."")."
                            ".($month=='all'?"":" AND refpayperiod.month_id=".$month."")."
                    GROUP BY daily_time_record.employee_id , refpayperiod.month_id , EXTRACT(YEAR FROM refpayperiod.pay_period_end)
                    ORDER BY refpayperiod.month_id , employee_list.employee_id ASC");
        $query->result();
        return $query->result();
    }

     function getwithoutdtrBACKUP($pay_period_id) {
        $query = $this->db->query('SELECT employee_list.*,ref_department.ref_department_id,ref_department.department,
         emp_rates_duties.emp_rates_duties_id FROM employee_list LEFT JOIN emp_rates_duties ON employee_list.employee_id=emp_rates_duties.employee_id
         LEFT JOIN ref_department ON emp_rates_duties.ref_department_id=ref_department.ref_department_id
         WHERE employee_list.employee_id NOT IN(SELECT employee_id FROM daily_time_record WHERE pay_period_id ='.$pay_period_id.')');
                            $query->result();

                          return $query->result();
    }
    function applyisdeduct($m_dtr_id,$is_deduct){
        for($i=0;$i<count($is_deduct);$i++){
                        $sql = 'UPDATE dtr_deductions SET is_deduct=1 WHERE dtr_id='.$m_dtr_id.' AND deduction_id='.$is_deduct[$i];
                        $this->db->query($sql);
                    }
    }

    function get_per_hour_pay($employee_id) {
      $query = $this->db->query('SELECT * FROM emp_rates_duties
                                WHERE active_rates_duties=1 AND employee_id='.$employee_id);
                                foreach ($query->result() as $row)
                                  {
                                          $per_hour_pay = $row->per_hour_pay;
                                  }
                                  return $per_hour_pay;
    }

    function get_pay_type($employee_id) {
      $query = $this->db->query('SELECT ref_payment_type_id, salary_reg_rates FROM emp_rates_duties
                                WHERE active_rates_duties=1 AND employee_id='.$employee_id);
                                return $query->result();
    }

    function get_salary_pay($employee_id) {
      $query = $this->db->query('SELECT * FROM emp_rates_duties
                                WHERE active_rates_duties=1 AND employee_id='.$employee_id);
                                foreach ($query->result() as $row)
                                  {
                                          $salary_reg_rates = $row->salary_reg_rates;
                                  }
                                  return $salary_reg_rates;
    }

    function get_semi_monthly_pay($employee_id) {
      $query = $this->db->query('SELECT salary_reg_rates,ref_payment_type_id FROM emp_rates_duties
                                WHERE active_rates_duties=1 AND employee_id='.$employee_id);
                                  return $query->result();
    }

    function get_factorfile() {
      $query2 = $this->db->query('SELECT * FROM reffactorfile');

                                return $query2->result();

    }

    function SSS_lookup_default($salary_reg_rates) {
      $tempsss = $this->db->query('SELECT ref_sss_contribution_id, total, employer as sss_deduction_employer, employer_contribution as sss_deduction_ec, employee as sss_deduction_employee FROM ref_sss_contribution WHERE '.$salary_reg_rates.' BETWEEN salary_range_from AND salary_range_to AND ref_sss_contribution.is_deleted = 0');
                                    return $tempsss->result();
    }

    function verify_half_deduct($verify_amount_value,$ref_payment_type_id_lookup) {
                                    if($ref_payment_type_id_lookup==1){
                                        $sss_employee_deduct_value = $verify_amount_value/2;
                                    }
                                    else{
                                        $sss_employee_deduct_value= $verify_amount_value;
                                    }
                                        return $sss_employee_deduct_value;
    }

    function SSS_lookup_shield($ssslookuptaxshield) {
      $ssstemplookup=$this->db->query('SELECT ref_sss_contribution_id,employee FROM ref_sss_contribution WHERE '.$ssslookuptaxshield.' BETWEEN salary_range_from AND salary_range_to AND ref_sss_contribution.is_deleted = 0');
                                        return $ssstemplookup->result();
                                        /*$ssstempreflookup = $ssstemplookup->result();*/
                                        /*return $ssstempreflookup[0]->employee;*/

    }

    function Philhealth_lookup_default($salary_reg_rates) {
      $tempphilhealth = $this->db->query('SELECT 
                            ref_philhealth_contribution_id, 
                            (CASE
                                WHEN '.$salary_reg_rates.' <= 10000 THEN employee
                                WHEN '.$salary_reg_rates.' >= 40000 THEN employee
                                ELSE (('.$salary_reg_rates.'*percentage)/2)
                            END) as employee
                        FROM
                            ref_philhealth_contribution');
                                        return $tempphilhealth->result();
    }

    function Philhealth_lookup_shield($philhealthlookuptaxshield) {
      $philtempreflookup=$this->db->query('SELECT 
                            ref_philhealth_contribution_id, 
                            (CASE
                                WHEN '.$salary_reg_rates.' <= 10000 THEN employee
                                WHEN '.$salary_reg_rates.' >= 40000 THEN employee
                                ELSE (('.$salary_reg_rates.'*percentage)/2)
                            END) as employee
                        FROM
                            ref_philhealth_contribution');
                                        return $philtempreflookup->result();

    }

    function Wtax_lookup($total_dtr_amount,$ref_payfrequency_type_id) {

    $semimonthly = $this->db->query('SELECT (CASE
            WHEN col1_cl > '.$total_dtr_amount.' THEN ((('.$total_dtr_amount.'-col1_cl)*(col1_percent))+(col1_amount))
            WHEN '.$total_dtr_amount.' BETWEEN col2_cl AND col3_cl THEN ((('.$total_dtr_amount.' - col2_cl)*(col2_percent))+(col2_amount))
            WHEN '.$total_dtr_amount.' BETWEEN col3_cl AND col4_cl THEN ((('.$total_dtr_amount.' - col3_cl)*(col3_percent))+(col3_amount))
            WHEN '.$total_dtr_amount.' BETWEEN col4_cl AND col5_cl THEN ((('.$total_dtr_amount.' - col4_cl)*(col4_percent))+(col4_amount))
            WHEN '.$total_dtr_amount.' BETWEEN col5_cl AND col6_cl THEN ((('.$total_dtr_amount.' - col5_cl)*(col5_percent))+(col5_amount))
            ELSE ((('.$total_dtr_amount.'-col6_cl)*(col6_percent))+(col6_amount))

        END) as wtax_deduction
        FROM ref_payfrequency_type
        WHERE ref_payfrequency_type_id='.$ref_payfrequency_type_id.'');
        return $semimonthly->result();
    }

    function Wtax_lookup_shield($taxshielddeduct,$emp_tax_code) {

    $semimonthly = $this->db->query('SELECT (CASE
            WHEN col1_cl > '.$taxshielddeduct.' THEN ((('.$taxshielddeduct.'-col1_cl)*(col1_percent))+(col1_amount))
            WHEN '.$taxshielddeduct.' BETWEEN col2_cl AND col3_cl THEN ((('.$taxshielddeduct.'-col2_cl)*(col2_percent))+(col2_amount))
            WHEN '.$taxshielddeduct.' BETWEEN col3_cl AND col4_cl THEN ((('.$taxshielddeduct.'-col3_cl)*(col3_percent))+(col3_amount))
            WHEN '.$taxshielddeduct.' BETWEEN col4_cl AND col5_cl THEN ((('.$taxshielddeduct.'-col4_cl)*(col4_percent))+(col4_amount))
            WHEN '.$taxshielddeduct.' BETWEEN col5_cl AND col6_cl THEN ((('.$taxshielddeduct.'-col5_cl)*(col5_percent))+(col5_amount))
            ELSE ((('.$taxshielddeduct.'-col6_cl)*(col6_percent))+(col6_amount))

        END) as wtax
        FROM ref_payment_type
        WHERE ref_payment_type_id='.$emp_payment_type_id.'');

    foreach($semimonthly->result() as $row)
    {
        $wtax = $row->wtax;
    }
                                return $wtax;

    }

    function process_payroll($dtr_id) {
      $j=0;
          foreach($dtr_id as $dtr_process)
          {
            $updateArray[] = array(
            'dtr_id'=>$dtr_id[$j],
            'is_to_process' => 0,
            );
            $j++;
          }

        $processpayroll = $this->db->update_batch('daily_time_record',$updateArray, 'dtr_id');
        $i=0;
        //echo count($dtr_id);
                foreach($dtr_id as $dtr)
                              {
                                //echo $dtr_id[$i];
                                //SELECT DTR based on dtr_id
                                $checkifexists = $this->db->query('SELECT dtr_id,pay_slip_id FROM pay_slip WHERE dtr_id='.$dtr);
                                $deleteexist = $checkifexists->result();
                                $exist = 0;
                                //echo json_encode($checkifexists->result());
                                if ($checkifexists->num_rows() != 0) {
                                    $exist = 1;
                                    /*$pay_slip_code = $deleteexist[0]->pay_slip_code;*/
                                    $pay_slip_id_rm = $deleteexist[0]->pay_slip_id;
                                    //deleting current payslip based on last pay slip id
                                    $this->db->where('pay_slip_id', $pay_slip_id_rm);
                                    $this->db->delete('pay_slip');
                                    //deleting deductions based on foreign key
                                    $this->db->where('pay_slip_id', $pay_slip_id_rm);
                                    $this->db->delete('pay_slip_deductions');
                                    //deleting earnings based on foreign key
                                    $this->db->where('pay_slip_id', $pay_slip_id_rm);
                                    $this->db->delete('pay_slip_other_earnings');

                                }
                                  //echo json_encode($checkifexists->result());
                                $this->db->select('daily_time_record.employee_id,daily_time_record.dtr_id,
                                sss_phic_salary_credit,philhealth_salary_credit,pagibig_salary_credit,tax_shield,tax_code,
                                pay_period_sequence,daily_time_record.pay_period_id,emp_rates_duties.salary_reg_rates,monthly_based_salary,emp_rates_duties.ref_payment_type_id,emp_rates_duties.hour_per_day,
                                reg_amt,sun_amt,day_off_amt,reg_hol_amt,
                                sun_reg_hol_amt,sun_reg_hol_amt,
                                spe_hol_amt,sun_spe_hol_amt,
                                days_wout_pay_amt,days_with_pay_amt,minutes_late_amt,
                                ot_reg_amt,ot_reg_reg_hol_amt,ot_reg_spe_hol_amt,
                                ot_sun_amt,ot_sun_reg_hol_amt,ot_sun_spe_hol_amt,
                                nsd_reg_amt,nsd_reg_reg_hol_amt,nsd_reg_spe_hol_amt,
                                nsd_sun_amt,nsd_sun_reg_hol_amt,nsd_sun_spe_hol_amt
                                ');

                                $where = $dtr;
                                $this->db->where('dtr_id', $where);
                                $this->db->where('active_rates_duties', 1);
                                $this->db->join('emp_rates_duties', 'emp_rates_duties.employee_id = daily_time_record.employee_id', 'left');
                                $this->db->join('employee_list', 'employee_list.employee_id = emp_rates_duties.employee_id', 'left');
                                $this->db->join('refpayperiod', 'refpayperiod.pay_period_id = daily_time_record.pay_period_id', 'left');
                                $query = $this->db->get('daily_time_record');
                                $processtemp=$query->result();

                                $dtr_id = $processtemp[0]->dtr_id;
                                $payslip_no = date('Y').'00'.$dtr_id;

                                $pay_period_id = $processtemp[0]->pay_period_id;
                                $monthly_based_salary = $processtemp[0]->monthly_based_salary;
                                $get_details_period = $this->db->query('SELECT (TIMESTAMPDIFF(day, pay_period_start, pay_period_end)+1) as no_days, month_id FROM refpayperiod WHERE pay_period_id = '.$pay_period_id);

                                $perioddetails = $get_details_period->result();

                                $no_days = $perioddetails[0]->no_days;
                                $month_id = $perioddetails[0]->month_id;

                                $get_count_period = $this->db->query('SELECT COUNT(*) as period_count FROM refpayperiod WHERE month_id = '.$month_id.' AND (TIMESTAMPDIFF(day, pay_period_start, pay_period_end)+1) ='.$no_days);
                                
                                $period_count = $get_count_period->result();
                                
                                $pcount = $period_count[0]->period_count;
                                
                                //TAX CODE OF EMPLOYEE
                                $ref_payment_type_id = $processtemp[0]->ref_payment_type_id;
                                $emp_tax_code=$processtemp[0]->tax_code;
                                //SALARY REG RATES FOR WTAX LOOKUP

                                $salary_reg_rates = $processtemp[0]->salary_reg_rates;

                                //echo json_encode($processtemp);
                                
                                //PROCESS PAYROLL
                                $reg_pay = $processtemp[0]->reg_amt;
                                $sun_pay = $processtemp[0]->sun_amt;
                                $day_off_pay = $processtemp[0]->day_off_amt;
                                $reg_hol_pay = $processtemp[0]->reg_hol_amt + $processtemp[0]->sun_reg_hol_amt;
                                
                                $spe_hol_pay = $processtemp[0]->spe_hol_amt + $processtemp[0]->sun_spe_hol_amt;

                                $reg_ot_pay = $processtemp[0]->ot_reg_amt + $processtemp[0]->ot_reg_reg_hol_amt + $processtemp[0]->ot_reg_spe_hol_amt;
                                $sun_ot_pay = $processtemp[0]->ot_sun_amt + $processtemp[0]->ot_sun_reg_hol_amt + $processtemp[0]->ot_sun_spe_hol_amt;
                                $reg_nsd_pay = $processtemp[0]->nsd_reg_amt + $processtemp[0]->nsd_reg_reg_hol_amt + $processtemp[0]->nsd_reg_spe_hol_amt;
                                $sun_nsd_pay = $processtemp[0]->nsd_sun_amt + $processtemp[0]->nsd_sun_reg_hol_amt + $processtemp[0]->nsd_sun_spe_hol_amt;
                                //TOTAL DTR AMOUNT
                                $total_dtr_amount=$reg_pay+$sun_pay+$day_off_pay+$reg_hol_pay+$spe_hol_pay+$reg_ot_pay+$sun_ot_pay+$reg_nsd_pay+$sun_nsd_pay;
                                $total_deductions=0;
                                $sssdeduct=0;
                                $sss_deduction_employer = 0;
                                $sss_deduction_ec = 0;
                                $philhealthdeduct=0;
                                $sss_deduction_employee = 0;
                                $ref_payment_type_id_lookup=$processtemp[0]->ref_payment_type_id;
                                $reg_amt = $processtemp[0]->reg_amt;
                                //echo $total_dtr_amount;
                                //GET SETTINGS OF DEDUCTIONS
                                $deductsettingstemp = $this->db->query('SELECT * FROM system_settings_default_deductions
                                                                        LEFT JOIN dtr_deductions
                                                                        ON system_settings_default_deductions.deduction_id=dtr_deductions.deduction_id
                                                                        WHERE dtr_id='.$dtr);
                                $deductsettings = $deductsettingstemp->result();

                                $sss_check1=$deductsettings[0]->check1;
                                $sss_check2=$deductsettings[0]->check2;
                                $sss_check3=$deductsettings[0]->check3;
                                $sss_check4=$deductsettings[0]->check4;
                                $sss_check5=$deductsettings[0]->check5;

                                $sss_is_deduct=$deductsettings[0]->is_deduct;

                                $philhealth_check1=$deductsettings[1]->check1;
                                $philhealth_check2=$deductsettings[1]->check2;
                                $philhealth_check3=$deductsettings[1]->check3;
                                $philhealth_check4=$deductsettings[1]->check4;
                                $philhealth_check5=$deductsettings[1]->check5;

                                $philhealth_is_deduct=$deductsettings[1]->is_deduct;

                                $pagibig_check1=$deductsettings[2]->check1;
                                $pagibig_check2=$deductsettings[2]->check2;
                                $pagibig_check3=$deductsettings[2]->check3;
                                $pagibig_check4=$deductsettings[2]->check4;
                                $pagibig_check5=$deductsettings[2]->check5;

                                $pagibig_is_deduct=$deductsettings[2]->is_deduct;

                                $wtax_check1=$deductsettings[3]->check1;
                                $wtax_check2=$deductsettings[3]->check2;
                                $wtax_check3=$deductsettings[3]->check3;
                                $wtax_check4=$deductsettings[3]->check4;
                                $wtax_check5=$deductsettings[3]->check5;

                                $wtax_is_deduct=$deductsettings[3]->is_deduct;

                                //
                                //echo json_encode($deductsettings);
                                //SSS Setting Cycle 1 AND IS DEDUCT IS TRUE
                                /*echo $processtemp[0]->pay_period_sequence;*/

                                  if(($processtemp[0]->pay_period_sequence == $sss_check1 || $sss_check2 || $sss_check3 || $sss_check4 || $sss_check5 || 6 || 7 || 8) AND $sss_is_deduct == 1){
                                    //SSS SHIELD CHECK
                                    $sss_stat="true";
                                    if($processtemp[0]->sss_phic_salary_credit == 0.00 || null)
                                    {
                                        
                                        $refsss = 0;
                                        $sssdeduct = 0;
                                        $sss_deduction_employer = 0;
                                        $sss_deduction_ec = 0;
                                        $sss_deduction_employee = 0;

                                        if ($ref_payment_type_id == 1){
                                          $refsss = $this->SSS_lookup_default($salary_reg_rates*2);

                                          $count_ssscheck1 = 0;$count_ssscheck2=0;$count_checksss = 0;

                                          if ($sss_check1 == 1){
                                            $count_ssscheck1 = 1;
                                          }else{
                                            $count_ssscheck1 = 0;
                                          }

                                          if ($sss_check2 == 2){
                                            $count_ssscheck2 = 1;
                                          }else{
                                            $count_ssscheck2 = 0;
                                          }

                                          $count_checksss = $count_ssscheck1 + $count_ssscheck2;

                                          $sss_deduction_employee = $refsss[0]->sss_deduction_employee / $count_checksss;
                                          $sss_deduction_employer = $refsss[0]->sss_deduction_employer / $count_checksss;
                                          $sss_deduction_ec = $refsss[0]->sss_deduction_ec / $count_checksss;

                                        }
                                        else if ($ref_payment_type_id == 4){

                                          $count_ssscheck1=0;$count_ssscheck2=0;$count_ssscheck3=0;$count_ssscheck4=0;$count_ssscheck5=0;
                                          $count_checksss = 0;

                                          if ($pcount ==1 ){

                                              if ($sss_check1 == 1){
                                                $count_ssscheck1 = 1;
                                              }else{
                                                $count_ssscheck1 = 0;
                                              }

                                          }
                                          else if ($pcount == 2){

                                              if ($sss_check1 == 1){
                                                $count_ssscheck1 = 1;
                                              }else{
                                                $count_ssscheck1 = 0;
                                              }

                                              if ($sss_check2 == 2){
                                                $count_ssscheck2 = 1;
                                              }else{
                                                $count_ssscheck2 = 0;
                                              }
                                          }
                                          else if ($pcount ==3 ){

                                              if ($sss_check1 == 1){
                                                $count_ssscheck1 = 1;
                                              }else{
                                                $count_ssscheck1 = 0;
                                              }

                                              if ($sss_check2 == 2){
                                                $count_ssscheck2 = 1;
                                              }else{
                                                $count_ssscheck2 = 0;
                                              }

                                              if ($sss_check3 == 3){
                                                $count_ssscheck3 = 1;
                                              }else{
                                                $count_ssscheck3 = 0;
                                              }

                                          }
                                          else if ($pcount == 4){

                                              if ($sss_check1 == 1){
                                                $count_ssscheck1 = 1;
                                              }else{
                                                $count_ssscheck1 = 0;
                                              }

                                              if ($sss_check2 == 2){
                                                $count_ssscheck2 = 1;
                                              }else{
                                                $count_ssscheck2 = 0;
                                              }

                                              if ($sss_check3 == 3){
                                                $count_ssscheck3 = 1;
                                              }else{
                                                $count_ssscheck3 = 0;
                                              }

                                              if ($sss_check4 == 4){
                                                $count_ssscheck4 = 1;
                                              }else{
                                                $count_ssscheck4 = 0;
                                              }

                                          }
                                          else if ($pcount == 5){

                                              if ($sss_check1 == 1){
                                                $count_ssscheck1 = 1;
                                              }else{
                                                $count_ssscheck1 = 0;
                                              }

                                              if ($sss_check2 == 2){
                                                $count_ssscheck2 = 1;
                                              }else{
                                                $count_ssscheck2 = 0;
                                              }

                                              if ($sss_check3 == 3){
                                                $count_ssscheck3 = 1;
                                              }else{
                                                $count_ssscheck3 = 0;
                                              }

                                              if ($sss_check4 == 4){
                                                $count_ssscheck4 = 1;
                                              }else{
                                                $count_ssscheck4 = 0;
                                              }

                                              if ($sss_check5 == 5){
                                                $count_ssscheck5 = 1;
                                              }else{
                                                $count_ssscheck5 = 0;
                                              }

                                          }

                                          $count_checksss = $count_ssscheck1 + $count_ssscheck2 + $count_ssscheck3 + $count_ssscheck4 + $count_ssscheck5;

                                          $refsss = $this->SSS_lookup_default($monthly_based_salary);
                                          $sssdeduct = $refsss[0]->sss_deduction_employee / $count_checksss;
                                          $sss_deduction_employee = $refsss[0]->sss_deduction_employee / $count_checksss;
                                          $sss_deduction_employer = $refsss[0]->sss_deduction_employer / $count_checksss;
                                          $sss_deduction_ec = $refsss[0]->sss_deduction_ec / $count_checksss;
                                        }
                                        else{
                                          $refsss = $this->SSS_lookup_default($salary_reg_rates);
                                          $sssdeduct = $refsss[0]->sss_deduction_employee;
                                          $sss_deduction_employee = $refsss[0]->sss_deduction_employee;
                                          $sss_deduction_employer = $refsss[0]->sss_deduction_employer;
                                          $sss_deduction_ec = $refsss[0]->sss_deduction_ec;
                                        }

                                       /* $sssdeduct = $this->verify_half_deduct($verify_amount_value = $refsss[0]->employee,$ref_payment_type_id_lookup);*/
                                        $sss_id=$refsss[0]->ref_sss_contribution_id;
                                    }
                                    else{
                                        $ssslookuptaxshield=$processtemp[0]->sss_phic_salary_credit;
                                        $refsss = $this->SSS_lookup_shield($ssslookuptaxshield);
                                        $sssdeduct = $refsss[0]->employee;
                                        $sss_id=$refsss[0]->ref_sss_contribution_id;
                                    }
                                  }
                                  else{
                                    /*echo "false";*/
                                        $sssdeduct=0;
                                        $sss_stat="false";
                                  }

                                  //PHILHEALTH Setting Cycle AND IS DEDUCT IS TRUE

                                  if(($processtemp[0]->pay_period_sequence == $philhealth_check1|| $philhealth_check2 || $philhealth_check3 || $philhealth_check4 || $philhealth_check5 || 6 || 7 || 8) AND $philhealth_is_deduct==1){
                                    //PHILHEALTH SHIELD CHECK
                                    $philhealth_stat="true";
                                    if($processtemp[0]->philhealth_salary_credit == 0.00 || $processtemp[0]->philhealth_salary_credit == null)
                                    {
                                        $refphilhealth = 0;
                                        $philhealthdeduct = 0;
                                        if ($ref_payment_type_id == 1){

                                          $count_philcheck1 = 0;$count_philcheck2=0;$count_checkphil = 0;

                                          if ($philhealth_check1 == 1){
                                            $count_philcheck1 = 1;
                                          }else{
                                            $count_philcheck1 = 0;
                                          }

                                          if ($philhealth_check2 == 2){
                                            $count_philcheck2 = 1;
                                          }else{
                                            $count_philcheck2 = 0;
                                          }

                                          $count_checkphil = $count_philcheck1 + $count_philcheck2;


                                          $refphilhealth = $this->Philhealth_lookup_default($salary_reg_rates*2);
                                          $philhealthdeduct = ($refphilhealth[0]->employee) / $count_checkphil;

                                        }
                                        else if ($ref_payment_type_id == 4){

                                          $count_philcheck1=0;$count_philcheck2=0;$count_philcheck3=0;$count_philcheck4=0;$count_philcheck5=0;
                                          $count_checkphil = 0;

                                          if ($pcount ==1 ){

                                              if ($philhealth_check1 == 1){
                                                $count_philcheck1 = 1;
                                              }else{
                                                $count_philcheck1 = 0;
                                              }

                                          }
                                          else if ($pcount == 2){

                                              if ($philhealth_check1 == 1){
                                                $count_philcheck1 = 1;
                                              }else{
                                                $count_philcheck1 = 0;
                                              }

                                              if ($philhealth_check2 == 2){
                                                $count_philcheck2 = 1;
                                              }else{
                                                $count_philcheck2 = 0;
                                              }
                                          }
                                          else if ($pcount ==3 ){

                                              if ($philhealth_check1 == 1){
                                                $count_philcheck1 = 1;
                                              }else{
                                                $count_philcheck1 = 0;
                                              }

                                              if ($philhealth_check2 == 2){
                                                $count_philcheck2 = 1;
                                              }else{
                                                $count_philcheck2 = 0;
                                              }

                                              if ($philhealth_check3 == 3){
                                                $count_philcheck3 = 1;
                                              }else{
                                                $count_philcheck3 = 0;
                                              }

                                          }
                                          else if ($pcount == 4){

                                              if ($philhealth_check1 == 1){
                                                $count_philcheck1 = 1;
                                              }else{
                                                $count_philcheck1 = 0;
                                              }

                                              if ($philhealth_check2 == 2){
                                                $count_philcheck2 = 1;
                                              }else{
                                                $count_philcheck2 = 0;
                                              }

                                              if ($philhealth_check3 == 3){
                                                $count_philcheck3 = 1;
                                              }else{
                                                $count_philcheck3 = 0;
                                              }

                                              if ($philhealth_check4 == 4){
                                                $count_philcheck4 = 1;
                                              }else{
                                                $count_philcheck4 = 0;
                                              }

                                          }
                                          else if ($pcount == 5){

                                              if ($philhealth_check1 == 1){
                                                $count_philcheck1 = 1;
                                              }else{
                                                $count_philcheck1 = 0;
                                              }

                                              if ($philhealth_check2 == 2){
                                                $count_philcheck2 = 1;
                                              }else{
                                                $count_philcheck2 = 0;
                                              }

                                              if ($philhealth_check3 == 3){
                                                $count_philcheck3 = 1;
                                              }else{
                                                $count_philcheck3 = 0;
                                              }

                                              if ($philhealth_check4 == 4){
                                                $count_philcheck4 = 1;
                                              }else{
                                                $count_philcheck4 = 0;
                                              }

                                              if ($philhealth_check5 == 5){
                                                $count_philcheck5 = 1;
                                              }else{
                                                $count_philcheck5 = 0;
                                              }

                                          }

                                          $count_checkphil = $count_philcheck1 + $count_philcheck2 + $count_philcheck3 + $count_philcheck4 + $count_philcheck5;

                                          $refphilhealth = $this->Philhealth_lookup_default($monthly_based_salary);
                                          $philhealthdeduct = ($refphilhealth[0]->employee) / $count_checkphil;
                                        }
                                        else{
                                          $refphilhealth = $this->Philhealth_lookup_default($salary_reg_rates);
                                          $philhealthdeduct = ($refphilhealth[0]->employee);
                                        }

                                        /*$philhealthdeduct = $this->verify_half_deduct($verify_amount_value = $refphilhealth[0]->employee,$ref_payment_type_id_lookup);*/
                                        $philhealth_id=$refphilhealth[0]->ref_philhealth_contribution_id;
                                        //echo json_encode($refphilhealth);
                                    }
                                    else{
                                        $philhealthlookuptaxshield=$processtemp[0]->philhealth_salary_credit;
                                        $refphilhealth=$this->Philhealth_lookup_shield($philhealthlookuptaxshield);
                                        $philhealthdeduct = $refphilhealth[0]->employee;
                                        $philhealth_id=$refphilhealth[0]->ref_philhealth_contribution_id;
                                    }
                                  }
                                  else{
                                        $philhealthdeduct=0;
                                        $philhealth_stat="false";
                                  }

                                  //PAGIBIG Setting Cycle 1 AND IS DEDUCT IS TRUE

                                  if(($processtemp[0]->pay_period_sequence==$pagibig_check1 || $pagibig_check2 || $pagibig_check3 || $pagibig_check4 || $pagibig_check5 || 6 || 7 || 8) AND $pagibig_is_deduct==1){
                                    //PAG IBIG SHIELD CHECK
                                    $pagibig_stat="true";
                                    if($processtemp[0]->pagibig_salary_credit == 0.00 || null)
                                    {

                                    if ($ref_payment_type_id == 1){

                                        $count_pagibigcheck1 = 0;$count_pagibigcheck2 =0;$count_checkpagibig=0;

                                        if ($pagibig_check1 == 1){
                                            $count_pagibigcheck1 = 1;
                                        }
                                        else{
                                            $count_pagibigcheck1 = 0;
                                        }

                                        if ($pagibig_check2 == 2){
                                            $count_pagibigcheck2 = 1;
                                        }
                                        else{
                                            $count_pagibigcheck2 = 1;
                                        }

                                        $count_checkpagibig = $count_pagibigcheck1 + $count_pagibigcheck2;
                                        $pagibigdeduct = 100 / $count_checkpagibig;

                                    }
                                    else if ($ref_payment_type_id == 2){
                                        $pagibigdeduct=100;
                                    }
                                    else if ($ref_payment_type_id == 4){

                                        $count_pagibigcheck1 = 0;$count_pagibigcheck2 =0;$count_pagibigcheck3=0;$count_pagibigcheck4 = 0;$count_pagibigcheck5=0;$count_checkpagibig=0;

                                          if ($pcount ==1 ){

                                              if ($pagibig_check1 == 1){
                                                $count_pagibigcheck1 = 1;
                                              }else{
                                                $count_pagibigcheck1 = 0;
                                              }

                                          }
                                          else if ($pcount == 2){

                                              if ($pagibig_check1 == 1){
                                                $count_pagibigcheck1 = 1;
                                              }else{
                                                $count_pagibigcheck1 = 0;
                                              }

                                              if ($pagibig_check2 == 2){
                                                $count_pagibigcheck2 = 1;
                                              }else{
                                                $count_pagibigcheck2 = 0;
                                              }
                                          }
                                          else if ($pcount ==3 ){

                                              if ($pagibig_check1 == 1){
                                                $count_pagibigcheck1 = 1;
                                              }else{
                                                $count_pagibigcheck1 = 0;
                                              }

                                              if ($pagibig_check2 == 2){
                                                $count_pagibigcheck2 = 1;
                                              }else{
                                                $count_pagibigcheck2 = 0;
                                              }

                                              if ($pagibig_check3 == 3){
                                                $count_pagibigcheck3 = 1;
                                              }else{
                                                $count_pagibigcheck3 = 0;
                                              }

                                          }
                                          else if ($pcount == 4){

                                              if ($pagibig_check1 == 1){
                                                $count_pagibigcheck1 = 1;
                                              }else{
                                                $count_pagibigcheck1 = 0;
                                              }

                                              if ($pagibig_check2 == 2){
                                                $count_pagibigcheck2 = 1;
                                              }else{
                                                $count_pagibigcheck2 = 0;
                                              }

                                              if ($pagibig_check3 == 3){
                                                $count_pagibigcheck3 = 1;
                                              }else{
                                                $count_pagibigcheck3 = 0;
                                              }

                                              if ($pagibig_check4 == 4){
                                                $count_pagibigcheck4 = 1;
                                              }else{
                                                $count_pagibigcheck4 = 0;
                                              }

                                          }
                                          else if ($pcount == 5){

                                              if ($pagibig_check1 == 1){
                                                $count_pagibigcheck1 = 1;
                                              }else{
                                                $count_pagibigcheck1 = 0;
                                              }

                                              if ($pagibig_check2 == 2){
                                                $count_pagibigcheck2 = 1;
                                              }else{
                                                $count_pagibigcheck2 = 0;
                                              }

                                              if ($pagibig_check3 == 3){
                                                $count_pagibigcheck3 = 1;
                                              }else{
                                                $count_pagibigcheck3 = 0;
                                              }

                                              if ($pagibig_check4 == 4){
                                                $count_pagibigcheck4 = 1;
                                              }else{
                                                $count_pagibigcheck4 = 0;
                                              }

                                              if ($pagibig_check5 == 5){
                                                $count_pagibigcheck5 = 1;
                                              }else{
                                                $count_pagibigcheck5 = 0;
                                              }

                                          }

                                        $count_checkpagibig = $count_pagibigcheck1 + $count_pagibigcheck2 + $count_pagibigcheck3 + $count_pagibigcheck4 + $count_pagibigcheck5;

                                        $pagibigdeduct= 100 / $count_checkpagibig;

                                    }

                                    }
                                    else{
                                        $pagibigdeduct=$processtemp[0]->pagibig_salary_credit;
                                    }
                                  }
                                  else{
                                        $pagibigdeduct=0;
                                        $pagibig_stat="false";
                                  }

                                //GET REGULAR EARNINGS
                                $regular_earnings=0;
                                $re=0;
                                $regearningstemp = $this->db->query('SELECT oe_regular_id,earnings_id,oe_regular_amount FROM new_otherearnings_regular WHERE employee_id='.$processtemp[0]->employee_id.' AND oe_cycle='.$processtemp[0]->pay_period_sequence.' AND is_temporary=0 AND is_deleted=0');
                                
                                foreach ($regearningstemp->result() as $row)
                                {
                                        $regular_earnings+=$row->oe_regular_amount;
                                        $oe_regular_id[$re] = $row->oe_regular_id;
                                        $earnings_id[$re] = $row->earnings_id;
                                        $oe_regular_amount[$re] = $row->oe_regular_amount;
                                        $re++;
                                }

                                 //GET TEMPORARY EARNINGS
                                $temporary_earnings=0;
                                $rt=0;
                                $tempearnings = $this->db->query('SELECT oe_regular_id,earnings_id,oe_regular_amount FROM new_otherearnings_regular WHERE employee_id='.$processtemp[0]->employee_id.' AND pay_period_id='.$processtemp[0]->pay_period_id.' AND is_temporary=1 AND is_deleted=0');
                                foreach ($tempearnings->result() as $row)
                                {
                                        $temporary_earnings+=$row->oe_regular_amount;
                                        $oe_regular_id_T[$rt] = $row->oe_regular_id;
                                        $earnings_id_T[$rt] = $row->earnings_id;
                                        $oe_regular_amount_T[$rt] = $row->oe_regular_amount;
                                        $rt++;
                                }

                                 //GET REGULAR DEDUCTIONS
                                $regular_deductions=0;
                                $rd=0;
                                //for cash advance and loans
                                $regulardeductionloans = $this->db->query('SELECT deduction_cycle,new_deductions_regular.deduction_regular_id,deduction_per_pay_amount,daily_time_record.dtr_id,is_deduct,new_deductions_regular.deduction_id FROM daily_time_record
                                                                    LEFT JOIN dtr_deductions
                                                                    ON daily_time_record.dtr_id=dtr_deductions.dtr_id
                                                                    LEFT JOIN new_deductions_regular
                                                                    ON dtr_deductions.deduction_id=new_deductions_regular.deduction_id
                                                                    WHERE new_deductions_regular.employee_id='.$processtemp[0]->employee_id.' AND daily_time_record.dtr_id='.$dtr.' AND is_temporary=0
                                                                    AND new_deductions_regular.deduction_id!=1 AND new_deductions_regular.deduction_id!=2 AND new_deductions_regular.deduction_id!=3 AND new_deductions_regular.deduction_id!=4
                                                                    AND new_deductions_regular.is_deleted=0');
                                /*echo json_encode($regulardeductionloans->result());*/

                                foreach ($regulardeductionloans->result() as $row)
                                {
                                        $getifdeducttemp = $this->db->query('SELECT dtrd.is_deduct FROM dtr_deductions as dtrd
                                                                            WHERE dtr_id='.$dtr.' AND deduction_id='.$row->deduction_id);
                                        $getifdeduct = $getifdeducttemp->result();
                                        //update 2/5/2017 for dual pay period deduct for cash advance and loans

                                        //update 3/21/2017 for much better function all regular are like loans and advances it have beg balance after all :)"
                                        switch ($row->deduction_cycle) {
                                            case $processtemp[0]->pay_period_sequence:
                                                if($getifdeduct[0]->is_deduct!=0){
                                                    $regular_deductions+=$row->deduction_per_pay_amount;
                                                    $deduction_regular_id[$rd] = $row->deduction_regular_id;
                                                    $deduction_id[$rd] = $row->deduction_id;
                                                    $deduction_per_pay_amount[$rd] = $row->deduction_per_pay_amount;
                                                    $isdeduct[$rd] = $row->is_deduct;
                                                    $rd++;
                                                }
                                            break;
                                            case 9: /*for 1 and 2 period deduct*/
                                                    if($getifdeduct[0]->is_deduct!=0){
                                                        $regular_deductions+=$row->deduction_per_pay_amount;
                                                        $deduction_regular_id[$rd] = $row->deduction_regular_id;
                                                        $deduction_id[$rd] = $row->deduction_id;
                                                        $deduction_per_pay_amount[$rd] = $row->deduction_per_pay_amount;
                                                        $isdeduct[$rd] = $row->is_deduct;
                                                        $rd++;
                                                    }
                                            break;
                                            default:
                                                    $deduction_regular_id[$rd] = $row->deduction_regular_id;
                                                    $deduction_id[$rd] = $row->deduction_id;
                                                    $deduction_per_pay_amount[$rd] = 0;
                                                    $isdeduct[$rd] = $row->is_deduct;
                                                    $rd++;
                                        }


                                }


                                 //GET TEMPORARY DEDUCTIONS
                                $temporary_deductions=0;
                                $td=0;
                                $tempdeduction = $this->db->query('SELECT new_deductions_regular.deduction_regular_id,deduction_per_pay_amount,daily_time_record.dtr_id,is_deduct,new_deductions_regular.deduction_id FROM daily_time_record
                                                                    LEFT JOIN dtr_deductions
                                                                    ON daily_time_record.dtr_id=dtr_deductions.dtr_id
                                                                    LEFT JOIN new_deductions_regular
                                                                    ON dtr_deductions.deduction_id=new_deductions_regular.deduction_id
                                                                    WHERE new_deductions_regular.employee_id='.$processtemp[0]->employee_id.' AND daily_time_record.dtr_id='.$dtr.' AND new_deductions_regular.pay_period_id='.$processtemp[0]->pay_period_id.' AND is_temporary=1 AND new_deductions_regular.deduction_id!=1
                                                                    AND new_deductions_regular.deduction_id!=2 AND new_deductions_regular.deduction_id!=3 AND new_deductions_regular.deduction_id!=4 AND new_deductions_regular.is_deleted=0');
                                //echo json_encode($tempdeduction->result());
                                foreach ($tempdeduction->result() as $row)
                                {
                                        if($row->is_deduct!=0){
                                             $temporary_deductions+=$row->deduction_per_pay_amount;
                                        }
                                        else{

                                        }
                                        $deduction_regular_id_T[$td] = $row->deduction_regular_id;
                                        $deduction_id_T[$td] = $row->deduction_id;
                                        $deduction_per_pay_amount_T[$td] = $row->deduction_per_pay_amount;
                                        $isdeduct_T[$td] = $row->is_deduct;
                                        $td++;
                                }
                                //echo json_encode($regulardeduction->result());
                                //echo json_encode($tempdeduction->result());
                                //echo $regular_deductions;
                                //echo "<br>";
                                //echo $temporary_deductions;
                                ///echo $temporary_earnings;
                                //echo $regular_earnings;
                                //echo $sssdeduct;
                                //echo $pagibigdeduct;
                                //echo $taxshielddeduct;
                                $gross_pay=$total_dtr_amount+$regular_earnings+$temporary_earnings+$processtemp[0]->days_with_pay_amt;

                                //SALARY REG RATES MINUS DEDUCTIONS SSS/PHIL/PAGIBIG
                                  $sss_phil_pagibig_deductions=$sssdeduct+$pagibigdeduct+$philhealthdeduct;
                                  
                                  $wtax_lookup_amount = $gross_pay-$sss_phil_pagibig_deductions;

                                  /*echo $wtax_lookup_amount;*/
                                  //WITHHOLDING Setting Cycle 1 AND IS DEDUCT IS TRUE

                                  if(($processtemp[0]->pay_period_sequence == $wtax_check1 || $wtax_check2 || $wtax_check3 || $wtax_check4 || $wtax_check5 || 6 || 7 || 8) AND $wtax_is_deduct==1){
                                    //WITH HOLDING TAX SHIELD CHECK
                                    $withholdingtax_stat="true";
                                    if($processtemp[0]->tax_shield == 0.00 || null)
                                    {
                                          if ($ref_payment_type_id == 4){

                                            $count_whtax1=0;$count_whtax2=0;$count_whtax3=0;$count_whtax4=0;$count_whtax5=0;

                                              $whtax_count = 0;

                                              if ($pcount ==1 ){

                                                  if ($wtax_check1 == 1){
                                                    $count_whtax1 = 1;
                                                  }else{
                                                    $count_whtax1 = 0;
                                                  }

                                              }
                                              else if ($pcount == 2){

                                                  if ($wtax_check1 == 1){
                                                    $count_whtax1 = 1;
                                                  }else{
                                                    $count_whtax1 = 0;
                                                  }

                                                  if ($wtax_check2 == 2){
                                                    $count_whtax2 = 1;
                                                  }else{
                                                    $count_whtax2 = 0;
                                                  }
                                              }
                                              else if ($pcount ==3 ){

                                                  if ($wtax_check1 == 1){
                                                    $count_whtax1 = 1;
                                                  }else{
                                                    $count_whtax1 = 0;
                                                  }

                                                  if ($wtax_check2 == 2){
                                                    $count_whtax2 = 1;
                                                  }else{
                                                    $count_whtax2 = 0;
                                                  }

                                                  if ($wtax_check3 == 3){
                                                    $count_whtax3 = 1;
                                                  }else{
                                                    $count_whtax3 = 0;
                                                  }

                                              }
                                              else if ($pcount == 4){

                                                  if ($wtax_check1 == 1){
                                                    $count_whtax1 = 1;
                                                  }else{
                                                    $count_whtax1 = 0;
                                                  }

                                                  if ($wtax_check2 == 2){
                                                    $count_whtax2 = 1;
                                                  }else{
                                                    $count_whtax2 = 0;
                                                  }

                                                  if ($wtax_check3 == 3){
                                                    $count_whtax3 = 1;
                                                  }else{
                                                    $count_whtax3 = 0;
                                                  }

                                                  if ($wtax_check4 == 4){
                                                    $count_whtax4 = 1;
                                                  }else{
                                                    $count_whtax4 = 0;
                                                  }

                                              }
                                              else if ($pcount == 5){

                                                  if ($wtax_check1 == 1){
                                                    $count_whtax1 = 1;
                                                  }else{
                                                    $count_whtax1 = 0;
                                                  }

                                                  if ($wtax_check2 == 2){
                                                    $count_whtax2 = 1;
                                                  }else{
                                                    $count_whtax2 = 0;
                                                  }

                                                  if ($wtax_check3 == 3){
                                                    $count_whtax3 = 1;
                                                  }else{
                                                    $count_whtax3 = 0;
                                                  }

                                                  if ($wtax_check4 == 4){
                                                    $count_whtax4 = 1;
                                                  }else{
                                                    $count_whtax4 = 0;
                                                  }

                                                  if ($wtax_check5 == 5){
                                                    $count_whtax5 = 1;
                                                  }else{
                                                    $count_whtax5 = 0;
                                                  }

                                              }

                                              $whtax_count = $count_whtax1 + $count_whtax2 + $count_whtax3 + $count_whtax4 + $count_whtax5;
                                              
                                            /*$taxshielddeduct=0;*/
                                            $withholding_lookup = $this->Wtax_lookup($wtax_lookup_amount,$ref_payment_type_id);

                                          }else{
                                            $withholding_lookup = $this->Wtax_lookup($wtax_lookup_amount,$ref_payment_type_id);
                                          }
                                    }
                                    else{
                                        $taxshielddeduct=$processtemp[0]->tax_shield;
                                        $withholding_lookup = $this->Wtax_lookup_shield($taxshielddeduct,$ref_payment_type_id);
                                        $withholding_lookup = $withholding_lookup;
                                        /*$withholding_lookup = $taxshielddeduct;*/ /*for amount is shield*/
                                        /*echo $withholding_lookup;*/

                                    }
                                  }
                                  else{
                                        $withholding_lookup=0;
                                        $withholdingtax_stat="false";
                                  }



                                $total_deductions=$sssdeduct+$pagibigdeduct+$philhealthdeduct+$withholding_lookup+$regular_deductions+$temporary_deductions+$processtemp[0]->days_wout_pay_amt+$processtemp[0]->minutes_late_amt;
                                $net_pay=$gross_pay-$total_deductions;


                                //echo $processtemp[0]->reg_amt;
                                  $data[0] =
                                     array(
                                        'dtr_id' => $dtr,
                                        'payslip_no' => $payslip_no,
                                        'reg_pay' => $reg_pay,
                                        'sun_pay' => $sun_pay,
                                        'day_off_pay' => $day_off_pay,
                                        'reg_hol_pay' => $reg_hol_pay,
                                        'spe_hol_pay' => $spe_hol_pay,
                                        'reg_ot_pay' => $reg_ot_pay,
                                        'sun_ot_pay' => $sun_ot_pay,
                                        'reg_nsd_pay' => $reg_nsd_pay,
                                        'sun_nsd_pay' => $sun_nsd_pay,
                                        'days_wout_pay_amt' => $processtemp[0]->days_wout_pay_amt,
                                        'days_with_pay_amt' => $processtemp[0]->days_with_pay_amt,
                                        'minutes_late_amt' => $processtemp[0]->minutes_late_amt,
                                        'total_dtr_amount' => $total_dtr_amount,
                                        'gross_pay' => $gross_pay,
                                        'taxable_pay' => $total_dtr_amount,
                                        'total_deductions' => $total_deductions,
                                        'net_pay' => $net_pay,
                                        'date_processed' => date("Y-m-d"),
                                        'processed_by' => $this->session->user_id
                                     );

                                $this->db->insert_batch('pay_slip', $data);
                                //LAST INSERT ID OF PAY SLIP
                                $pay_slip_id=$this->db->insert_id();



                                //CODE TO INSERT TO PAY SLIP EARNINGS
                                /*$format = "000000";
                                $temp = $this->replaceCharsInNumber($format, $pay_slip_id); //5069xxx
                                $pay_slip_code = $temp .'-'. $today = date("Y");*/
                                /*if($exist==1){
                                    $pay_slip_code = $this->payslip_modifyifexist($pay_slip_id,$pay_slip_code);
                                }
                                else{
                                    $pay_slip_code = $this->payslip_modify($pay_slip_id);
                                }*/

                                /*echo $pay_slip_code;*/
                                $z=0;
                                $dataregearnings="";
                                for($z;$re>$z;$z++){
                                    $dataregearnings[] =
                                     array(
                                        'pay_slip_id' => $pay_slip_id,
                                        'earnings_id' => $earnings_id[$z],
                                        'earnings_amount' => $oe_regular_amount[$z],
                                        'oe_regular_id' => $oe_regular_id[$z]
                                     );
                                }
                                $x=0;
                                $datatempearnings="";
                                for($x;$rt>$x;$x++){
                                    $datatempearnings[] =
                                     array(
                                        'pay_slip_id' => $pay_slip_id,
                                        'earnings_id' => $earnings_id_T[$x],
                                        'earnings_amount' => $oe_regular_amount_T[$x],
                                        'oe_regular_id' => $oe_regular_id_T[$x]
                                     );
                                }
                                $z_deduct=0;
                                $dataregdeductions="";
                                for($z_deduct;$rd>$z_deduct;$z_deduct++){
                                    /*$query_reg_deduct = $this->db->query('SELECT (deduction_total_amount) as deduct_balance FROM new_deductions_regular
                                                                WHERE deduction_regular_id='.$deduction_regular_id[$z_deduct]);

                                    $deduct_balance_temp = $query_reg_deduct->row(0);
                                    $deduct_balance_amount[$z_deduct] = $deduct_balance_temp->deduct_balance;*/
                                    /*echo $deduct_balance_amount[$z_deduct];*/
                                    /*$dataregdeductions[] = array();*/
                                    //checking if there is enough balance in loans
                                    /*if($deduct_balance_amount>$deduction_per_pay_amount[$z_deduct]){*/
                                        $dataregdeductions[] =
                                         array(
                                            'pay_slip_id' => $pay_slip_id,
                                            'deduction_id' => $deduction_id[$z_deduct],
                                            'deduction_amount' => $deduction_per_pay_amount[$z_deduct],
                                            'deduction_regular_id' => $deduction_regular_id[$z_deduct],
                                            'active_deduct' => $isdeduct[$z_deduct],
                                         );
                                        /*$newval=$deduct_balance_amount-$deduction_per_pay_amount[$z_deduct];
                                        $updatebalance = array(
                                                'deduction_total_amount' => $newval,
                                                'deduction_total_amount_tempo' => $deduction_per_pay_amount[$z_deduct]
                                        );*/

                                        /*$this->db->where('deduction_regular_id', $deduction_regular_id[$z_deduct]);
                                        $this->db->update('new_deductions_regular', $updatebalance);*/
                                    /*}*/
                                    //if less than or equal do this
                                    /*else{*/
                                        /*$dataregdeductions[] =
                                         array(
                                            'pay_slip_id' => $pay_slip_id,
                                            'deduction_id' => $deduction_id[$z_deduct],
                                            'deduction_amount' => $deduct_balance_amount,
                                            'deduction_regular_id' => $deduction_regular_id[$z_deduct],
                                            'active_deduct' => $isdeduct[$z_deduct],
                                         );
*/
                                         /*$updatebalance = array(
                                                'deduction_total_amount' => 0,
                                                'deduction_total_amount_tempo' => $deduct_balance_amount
                                        );*/

                                        /*$this->db->where('deduction_regular_id', $deduction_regular_id[$z_deduct]);
                                        $this->db->update('new_deductions_regular', $updatebalance);*/
                                    /*}*/

                                }
                                $x_deduct=0;
                                $datatempdeductions="";
                                for($x_deduct;$td>$x_deduct;$x_deduct++){
                                    $datatempdeductions[] =
                                     array(
                                        'pay_slip_id' => $pay_slip_id,
                                        'deduction_id' => $deduction_id_T[$x_deduct],
                                        'deduction_amount' => $deduction_per_pay_amount_T[$x_deduct],
                                        'deduction_regular_id' => $deduction_regular_id_T[$x_deduct],
                                        'active_deduct' => $isdeduct_T[$x_deduct],
                                     );
                                }
                                if($re!=0){
                                  $this->db->insert_batch('pay_slip_other_earnings', $dataregearnings);
                                }
                                else{
                                  //do not insert
                                }
                                if($rt!=0){
                                  $this->db->insert_batch('pay_slip_other_earnings', $datatempearnings);
                                }
                                else{
                                  //do not insert
                                }
                                if($z_deduct!=0){
                                    /*echo "w";*/
                                  $this->db->insert_batch('pay_slip_deductions', $dataregdeductions);
                                 /* $m_products->set('quantity','quantity-'.$invalue);*/
                                    $z_deduct_2=0;
                                    for($z_deduct_2;$rd>$z_deduct_2;$z_deduct_2++){
                                            $pay_slip_deduct_temp = $this->db->query('SELECT ndr.loan_total_amount,deduction_total_amount,pay_slip_deductions.deduction_regular_id,SUM(deduction_amount) as total_loan_deductamount FROM pay_slip_deductions
                                                                        LEFT JOIN new_deductions_regular as ndr
                                                                        ON pay_slip_deductions.deduction_regular_id=ndr.deduction_regular_id
                                                                        WHERE  pay_slip_deductions.pay_slip_id='.$pay_slip_id.' AND pay_slip_deductions.deduction_regular_id='.$deduction_regular_id[$z_deduct_2]);

                                            // $pay_slip_adjustment_temp = $this->db->query('SELECT debit_amount,credit_amount FROM pay_slip_loans_adjustments
                                            //                             WHERE pay_slip_loans_adjustments.deduction_regular_id='.$deduction_regular_id[$z_deduct_2]);

                                            $pay_slip_deduct_filter = $pay_slip_deduct_temp->result();
                                            $loan_total_amount_temp = $pay_slip_deduct_filter[0]->deduction_total_amount;
                                            $total_loan_deductamount = $pay_slip_deduct_filter[0]->total_loan_deductamount;
                                            // $debit_amount = 0;
                                            // $credit_amount = 0;
                                            // foreach($pay_slip_adjustment_temp->result() as $psa){
                                            //     $credit_amount += $psa->credit_amount;
                                            //     $debit_amount += $psa->debit_amount;
                                            // }
                                            /*echo $credit_amount;
                                            echo "<br>";
                                            echo $debit_amount;*/


                                            $loan_total_amount= $loan_total_amount_temp;

                                            /*$deduct_balance_amount = $pay_slip_deduct_filter[0]->deduction_total_amount;*/
                                            /*$newval=$loan_total_amount-$total_loan_deductamount;*/
                                        if($exist==0){
                                          if($loan_total_amount>$total_loan_deductamount){
                                              $newval=$loan_total_amount-$total_loan_deductamount;
                                              /*echo $newval;*/
                                              /*echo "if";*/
                                              $updatebalance = array(
                                                      'deduction_total_amount' => $newval,
                                                      'deduction_total_amount_tempo' => $deduction_per_pay_amount[$z_deduct_2]
                                              );

                                              $this->db->where('deduction_regular_id', $deduction_regular_id[$z_deduct_2]);
                                              $this->db->update('new_deductions_regular', $updatebalance);
                                          }
                                          else{
                                              /*echo "else";*/
                                              $total_loan_balance_temp = $total_loan_deductamount-$loan_total_amount;
                                              $total_loan_balance = abs(($total_loan_balance_temp-$deduction_per_pay_amount[$z_deduct_2]));
                                              /*echo $deduct_balance_amount[$z_deduct_2];*/
                                              $updatebalance = array(
                                              'deduction_total_amount' => 0,
                                              'deduction_total_amount_tempo' => $total_loan_balance
                                              );

                                              $this->db->where('deduction_regular_id', $deduction_regular_id[$z_deduct_2]);
                                              $this->db->update('new_deductions_regular', $updatebalance);

                                              /*echo $total_loan_balance;*/
                                              $updatepayslipdeduct = array(
                                              'deduction_amount' => $total_loan_balance
                                              );

                                              $this->db->where('deduction_regular_id', $deduction_regular_id[$z_deduct_2]);
                                              $this->db->where('pay_slip_id', $pay_slip_id);
                                              $this->db->update('pay_slip_deductions', $updatepayslipdeduct);

                                          }
                                        }
                                        else{
                                          //do not update / do nothing
                                        }
                                    }
                                }
                                else{
                                  //do not insert
                                }
                                if($x_deduct!=0){
                                  $this->db->insert_batch('pay_slip_deductions', $datatempdeductions);
                                }
                                else{
                                  //do not insert
                                }

                                if($sss_stat=="true"){
                                  $data_deductions[0] =
                                     array(
                                        'pay_slip_id' => $pay_slip_id,
                                        'deduction_id' => 1,
                                        'deduction_amount' => $sssdeduct,
                                        'sss_deduction_employer' => $sss_deduction_employer,
                                        'sss_deduction_ec' => $sss_deduction_ec,
                                        'sss_deduction_employee' => $sss_deduction_employee,
                                        'sss_id' => $sss_id,
                                        'active_deduct' => TRUE,
                                     );
                                  $this->db->insert_batch('pay_slip_deductions', $data_deductions);
                                }
                                else{
                                  //insert with false deduct
                                    $data_deductions[0] =
                                     array(
                                        'pay_slip_id' => $pay_slip_id,
                                        'deduction_id' => 1,
                                        'deduction_amount' => $sssdeduct,
                                        'sss_deduction_employer' => $sss_deduction_employer,
                                        'sss_deduction_ec' => $sss_deduction_ec,    
                                        'sss_deduction_employee' => $sss_deduction_employee,
                                        'active_deduct' => FALSE,
                                     );
                                    $this->db->insert_batch('pay_slip_deductions', $data_deductions);
                                }
                                if($philhealth_stat=="true"){
                                  $data_deductions_phil[0] =
                                     array(
                                        'pay_slip_id' => $pay_slip_id,
                                        'deduction_id' => 2,
                                        'deduction_amount' => $philhealthdeduct,
                                        'philhealth_id' => $philhealth_id,
                                        'active_deduct' => TRUE,
                                     );
                                  $this->db->insert_batch('pay_slip_deductions', $data_deductions_phil);
                                }
                                else{
                                  //insert with false deduct
                                    $data_deductions_phil[0] =
                                     array(
                                        'pay_slip_id' => $pay_slip_id,
                                        'deduction_id' => 2,
                                        'deduction_amount' => $philhealthdeduct,
                                        'active_deduct' => FALSE,
                                     );
                                    $this->db->insert_batch('pay_slip_deductions', $data_deductions_phil);

                                }
                                if($pagibig_stat=="true"){
                                  $data_deductions_pagibig[0] =
                                     array(
                                        'pay_slip_id' => $pay_slip_id,
                                        'deduction_id' => 3,
                                        'deduction_amount' => $pagibigdeduct,
                                        'active_deduct' => TRUE,
                                     );
                                  $this->db->insert_batch('pay_slip_deductions', $data_deductions_pagibig);
                                }
                                else{
                                  //insert pagibig with flase deduct
                                    $data_deductions_pagibig[0] =
                                     array(
                                        'pay_slip_id' => $pay_slip_id,
                                        'deduction_id' => 3,
                                        'deduction_amount' => $pagibigdeduct,
                                        'active_deduct' => FALSE,
                                     );
                                    $this->db->insert_batch('pay_slip_deductions', $data_deductions_pagibig);
                                }
                                //WITHHOLDING TAX TRUE
                                if($withholdingtax_stat=="true"){
                                    /*$wtax = $this->Wtax_lookup($total_dtr_amount);*/
                                    /*echo $wtax;*/
                                    /*echo "true";*/
                                  $data_deductions_withholdingtax_e[0] =
                                     array(
                                        'pay_slip_id' => $pay_slip_id,
                                        'deduction_id' => 4,
                                        'deduction_amount' => $withholding_lookup,
                                        'active_deduct' => TRUE,
                                     );
                                    $this->db->insert_batch('pay_slip_deductions', $data_deductions_withholdingtax_e);
                                }
                                else{
                                  //insert WH TAX with false deduct
                                    /*$wtax = $this->Wtax_lookup($total_dtr_amount);*/
                                    /*echo $wtax;*/
                                    $data_deductions_withholdingtax_e[0] =
                                     array(
                                        'pay_slip_id' => $pay_slip_id,
                                        'deduction_id' => 4,
                                        'deduction_amount' => $withholding_lookup,
                                        'active_deduct' => FALSE,
                                     );
                                    $this->db->insert_batch('pay_slip_deductions', $data_deductions_withholdingtax_e);
                                }


                                //echo json_encode($regearningstemp->result());

                                //return true;

                        $i++;
                        }
                    return true;
    }

}
?>
