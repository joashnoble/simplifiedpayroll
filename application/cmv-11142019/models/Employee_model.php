<?php

class Employee_model extends CORE_Model {
    protected  $table="employee_list";
    protected  $pk_id="employee_id";

    function __construct() {
        parent::__construct();
    }

    function get_employee_list($company_id,$employee_id=null){
        $query = $this->db->query("SELECT 
                        elist.*,
                        CONCAT(elist.first_name,
                                ' ',
                                elist.middle_name,
                                ' ',
                                elist.last_name) AS full_name,
                        (CASE
                            WHEN elist.birthdate != ''
                                THEN DATE_FORMAT(elist.birthdate,'%m/%d/%Y')
                            ELSE ''
                        END) AS birthdate,
                        (CASE
                            WHEN elist.employment_date != ''
                                THEN DATE_FORMAT(elist.employment_date,'%m/%d/%Y')
                            ELSE ''
                        END) AS employment_date,
                        (CASE
                            WHEN elist.date_retired != ''
                                THEN DATE_FORMAT(elist.date_retired,'%m/%d/%Y')
                            ELSE ''
                        END) AS date_retired,
                        (CASE
                            WHEN elist.date_end != ''
                                THEN DATE_FORMAT(elist.date_end,'%m/%d/%Y')
                            ELSE ''
                        END) AS date_end,
                        (CASE
                            WHEN elist.ref_employment_type_id != 0 THEN etype.employment_type
                            ELSE 'N/A'
                        END) AS employment_type,
                        (CASE
                            WHEN elist.ref_branch_id != 0 THEN ebranch.branch
                            ELSE 'N/A'
                        END) AS branch,
                        (CASE
                            WHEN elist.ref_department_id != 0 THEN edept.department
                            ELSE 'N/A'
                        END) AS department,
                        (CASE
                            WHEN elist.ref_position_id != 0 THEN epos.position
                            ELSE 'N/A'
                        END) AS position,
                        (CASE
                            WHEN elist.ref_section_id != 0 THEN esec.section
                            ELSE 'N/A'
                        END) AS section,
                        pft.pay_frequency_type
                    FROM
                        employee_list elist
                            LEFT JOIN
                        ref_employment_type etype ON etype.ref_employment_type_id = elist.ref_employment_type_id
                            LEFT JOIN
                        ref_department edept ON edept.ref_department_id = elist.ref_department_id
                            LEFT JOIN
                        ref_branch ebranch ON ebranch.ref_branch_id = elist.ref_branch_id
                            LEFT JOIN
                        ref_position epos ON epos.ref_position_id = elist.ref_position_id
                            LEFT JOIN
                        ref_section esec ON esec.ref_section_id = elist.ref_section_id
                            LEFT JOIN
                        ref_payfrequency_type pft ON pft.ref_payfrequency_type_id = elist.ref_payfrequency_type_id
                    WHERE
                        elist.is_deleted = 0
                        AND elist.company_id = $company_id
                    ".($employee_id==null?"":" AND elist.employee_id=".$employee_id."")."");
        return $query->result();
    }

    function count_active_employees($company_id,$employee_id=null){
        $query = $this->db->query("SELECT * FROM employee_list WHERE company_id = $company_id AND  is_active = 1 AND is_deleted = 0 
                        ".($employee_id==null?"":" AND employee_id!=".$employee_id."")."");
        return $query->result();
    }

    function chck_emp_status($employee_id){
        $query = $this->db->query("SELECT is_active FROM employee_list WHERE employee_id = $employee_id");
        return $query->result();
    }

    function getEmplist_forResignation(){
        $query = $this->db->query("SELECT 
                        employee_list.*,
                        CONCAT(employee_list.first_name,
                                ' ',
                                employee_list.middle_name,
                                ' ',
                                employee_list.last_name) AS full_name,
                        ref_branch.branch,
                        ref_department.department,
                        emp_rates_duties.*,
                        ref_position.position,
                        (CASE 
                            WHEN employee_list.employment_date = '' 
                                THEN 'N/A'
                            ELSE DATE_FORMAT(employee_list.employment_date, '%m/%d/%Y')
                        END) AS employment_date
                    FROM
                        employee_list
                            LEFT JOIN
                        emp_rates_duties ON emp_rates_duties.emp_rates_duties_id = employee_list.emp_rates_duties_id
                            LEFT JOIN
                        ref_branch ON ref_branch.ref_branch_id = emp_rates_duties.ref_branch_id
                            LEFT JOIN
                        ref_department ON ref_department.ref_department_id = emp_rates_duties.ref_department_id
                            LEFT JOIN
                        ref_position ON ref_position.ref_position_id = emp_rates_duties.ref_position_id
                    WHERE
                        employee_list.is_deleted = 0
                            AND employee_list.employee_id NOT IN (SELECT 
                                employee_id
                            FROM
                                emp_resignation_form
                            WHERE
                                emp_resignation_form.is_deleted = 0)
                    ORDER BY full_name ASC");
                        $query->result();

                          return $query->result();
    }

    function getAttrition($from_date,$to_date,$position_id){
        $query = $this->db->query("SET @beginning:= (SELECT 
                    COUNT(*) 
                    FROM 
                        employee_list 
                        LEFT JOIN emp_rates_duties 
                            ON emp_rates_duties.emp_rates_duties_id = employee_list.emp_rates_duties_id 
                        WHERE (employee_list.employment_date <= '".$from_date."' AND employee_list.employment_date >= '".$to_date."') 
                            AND employee_list.status = 'Active'
                            AND employee_list.is_deleted = 0
                            ".($position_id=='all'?"":" AND emp_rates_duties.ref_position_id=".$position_id."").")");
        $query = $this->db->query("SET @empjoin:=0;");
        $query = $this->db->query("SET @empleft:=0;");
        $query = $this->db->query("SET @ending:=0;");
        $query = $this->db->query("
                SELECT 
                    b.*,
                    ((b.employee_left / b.attrition_rate) * 100) AS attrition_percentage
                FROM
                    (SELECT 
                        a.*,
                            ((a.opening_balance + a.closing_balance) / 2) AS attrition_rate
                    FROM
                        (SELECT 
                        ref_month.month_name,
                            (@beginning:=@beginning) AS opening_balance,
                            (@empjoin:=(SELECT 
                                    COUNT(*)
                                FROM
                                    employee_list
                                LEFT JOIN emp_rates_duties ON emp_rates_duties.emp_rates_duties_id = employee_list.emp_rates_duties_id
                                WHERE
                                    MONTH(employee_list.employment_date) = ref_month.ref_month_id
                                        AND (employee_list.employment_date >= '".$from_date."' AND 
                                            employee_list.employment_date <= '".$to_date."')
                                        AND employee_list.is_deleted = 0
                                        ".($position_id=='all'?"":" AND emp_rates_duties.ref_position_id=".$position_id."")."
                                        )) AS employee_joined,
                            (@empleft:=(SELECT 
                                    COUNT(*)
                                FROM
                                    employee_list
                                LEFT JOIN emp_rates_duties ON emp_rates_duties.emp_rates_duties_id = employee_list.emp_rates_duties_id
                                WHERE
                                    MONTH(employee_list.date_end) = ref_month.ref_month_id
                                        AND (employee_list.date_end >= '".$from_date."' AND 
                                            employee_list.date_end <= '".$to_date."')
                                        AND employee_list.is_deleted = 0
                                        AND employee_list.status = 'Inactive'
                                        ".($position_id=='all'?"":" AND emp_rates_duties.ref_position_id=".$position_id."")."
                                        )) AS employee_left,
                            (@ending:=@beginning + @empjoin - @empleft) AS closing_balance,
                            (@beginning:=@beginning:=@ending) AS total_closing_balance
                    FROM
                        ref_month
                    WHERE
                        (ref_month_id >= MONTH('".$from_date."') AND ref_month_id <= MONTH('".$to_date."'))) AS a) AS b");
                        $query->result();
                        return $query->result();
    }

    function getcountemployee($company_id) {
        $query = $this->db->query("SELECT 
                        COUNT(emp.employee_id) AS total_employee
                    FROM
                        employee_list emp
                    WHERE
                        is_deleted = 0
                            AND company_id = $company_id");
                    $query->result();
                    return $query->result();
    }

    function get_retired_list($company_id){
        $query = $this->db->query("SELECT 
                    COUNT(emp.employee_id) AS retired_employees
                FROM
                    employee_list emp
                WHERE
                    emp.is_deleted = 0
                        AND emp.is_active = 0
                        AND emp.company_id = $company_id");
        $query->result();
        return $query->result();
    }


    function get_email_info($eid){
        $query = $this->db->query('SELECT ecode, pin_number, email_address, CONCAT(first_name," ",middle_name," ",last_name) as fullname FROM employee_list
                                 WHERE employee_list.employee_id='.$eid);
            $query->result();
            return $query->result();
    }

    function check_code($ecode) {
        $query = $this->db->query('SELECT COUNT(employee_list.employee_id) as cecode,employee_list.employee_id,employee_list.ecode,employee_list.image_name,CONCAT(employee_list.first_name," ",middle_name," ",employee_list.last_name) as full_name, ref_department.department,ref_position.position,ref_branch.branch,emp_rates_duties.ref_payment_type_id FROM employee_list
                                LEFT JOIN emp_rates_duties ON
                                employee_list.employee_id=emp_rates_duties.employee_id
                                LEFT JOIN ref_department ON 
                                ref_department.ref_department_id=emp_rates_duties.ref_department_id
                                LEFT JOIN ref_position ON 
                                ref_position.ref_position_id=emp_rates_duties.ref_position_id
                                LEFT JOIN ref_branch ON 
                                ref_branch.ref_branch_id=emp_rates_duties.ref_branch_id

                                 WHERE employee_list.is_deleted=0 AND active_rates_duties=TRUE AND employee_list.ecode='.$ecode.' AND employee_list.status = "Active" AND employee_list.is_retired=0');
                            $query->result();
                          return $query->result();
    }

    function get_emp_list($company_id,$count,$frequency,$ref_branch_id,$ref_department_id,$sequence){
        $query = $this->db->query("SELECT 
                        emp.*,
                        emp.per_day_pay,
                        emp.per_hour_pay,
                        ROUND(emp.salary_reg_rates, 2) AS salary_reg_rates,
                        CONCAT(emp.first_name,
                                ' ',
                                emp.middle_name,
                                ' ',
                                emp.last_name) AS full_name,
                        'null' AS no_of_hrs,
                        (CASE
                            WHEN
                                 emp.ref_payfrequency_type_id = 5
                            THEN
                                (CASE
                                    WHEN $sequence = 1 || 2 || 3 || 4 || 5
                                        THEN ROUND((emp.monthly_based_salary / $count),2)
                                    WHEN $sequence = 6 || 7
                                        THEN ROUND((emp.monthly_based_salary / 2),2)
                                    WHEN $sequence = 8
                                        THEN ROUND((emp.monthly_based_salary),2)
                                    ELSE ROUND((emp.monthly_based_salary),2)
                                END)
                            ELSE 'null'
                        END) AS basic_pay_total,
                        'null' AS overtime,
                        'null' AS holiday_pay,
                        'null' AS allowance_pay,
                        'null' AS commission,
                        'null' AS adjustment_additional,
                        'null' AS adjustment_deduction,
                        'null' AS gross_total,
                        'null' AS reg_ot,
                        'null' AS sun_ot,
                        'null' AS reg_hol_ot,
                        'null' AS sun_reg_hol_ot,
                        'null' AS spe_hol_ot,
                        'null' AS sun_spe_hol_ot,
                        'null' AS overtime_total,
                        'null' AS reg_hol,
                        'null' AS sun_reg_hol,
                        'null' AS spe_hol,
                        'null' AS sun_spe_hol,
                        'null' AS holiday_total,
                        'null' AS late,
                        'null' AS late_amt,
                        'null' AS undertime,
                        'null' AS undertime_amt,
                        'emp_process' AS process_type,
                        ((CASE
                            WHEN
                                emp.exmpt_sss = 0
                            THEN
                                (CASE
                                    WHEN
                                        emp.ref_payfrequency_type_id = 2 
                                    THEN
                                        COALESCE((SELECT 
                                                        ROUND(employee, 4)
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
                                                        ROUND((employee / 2), 4)
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
                                                        ROUND((employee / $count), 4)
                                                    FROM
                                                        ref_sss_contribution
                                                    WHERE
                                                        emp.monthly_based_salary BETWEEN salary_range_from AND salary_range_to
                                                        AND ref_sss_contribution.is_deleted = 0),
                                                0.00)
                                    WHEN
                                        emp.ref_payfrequency_type_id = 5
                                    THEN
                                        (CASE
                                            WHEN
                                                $sequence = 1 || 2 || 3 || 4 || 5
                                                THEN 
                                                    COALESCE((SELECT 
                                                                    ROUND((employee / $count), 4)
                                                                FROM
                                                                    ref_sss_contribution
                                                                WHERE
                                                                    emp.monthly_based_salary BETWEEN salary_range_from AND salary_range_to
                                                                    AND ref_sss_contribution.is_deleted = 0),
                                                            0.00)
                                            WHEN 
                                                $sequence = 6 || 7
                                                THEN 
                                                    COALESCE((SELECT 
                                                                    ROUND(employee / 2, 4)
                                                                FROM
                                                                    ref_sss_contribution
                                                                WHERE
                                                                    emp.monthly_based_salary BETWEEN salary_range_from AND salary_range_to
                                                                    AND ref_sss_contribution.is_deleted = 0),
                                                            0.00)
                                            WHEN 
                                                $sequence = 8
                                                THEN 
                                                    COALESCE((SELECT 
                                                                    ROUND(employee, 4)
                                                                FROM
                                                                    ref_sss_contribution
                                                                WHERE
                                                                    emp.monthly_based_salary BETWEEN salary_range_from AND salary_range_to
                                                                    AND ref_sss_contribution.is_deleted = 0),
                                                            0.00)

                                            ELSE
                                                COALESCE((SELECT 
                                                                ROUND(employee, 4)
                                                            FROM
                                                                ref_sss_contribution
                                                            WHERE
                                                                emp.monthly_based_salary BETWEEN salary_range_from AND salary_range_to
                                                                AND ref_sss_contribution.is_deleted = 0),
                                                        0.00)
                                        END)
                                    ELSE COALESCE((SELECT 
                                                    ROUND(employee, 4)
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
                                                        ROUND(employer, 4)
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
                                                        ROUND((employer / 2), 4)
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
                                                        ROUND((employer / $count), 4)
                                                    FROM
                                                        ref_sss_contribution
                                                    WHERE
                                                        emp.monthly_based_salary BETWEEN salary_range_from AND salary_range_to
                                                        AND ref_sss_contribution.is_deleted = 0),
                                                0.00)
                                    WHEN
                                        emp.ref_payfrequency_type_id = 5
                                    THEN
                                        (CASE
                                            WHEN
                                                $sequence = 1 || 2 || 3 || 4 || 5
                                                THEN 
                                                    COALESCE((SELECT 
                                                                    ROUND((employer / $count), 4)
                                                                FROM
                                                                    ref_sss_contribution
                                                                WHERE
                                                                    emp.monthly_based_salary BETWEEN salary_range_from AND salary_range_to
                                                                    AND ref_sss_contribution.is_deleted = 0),
                                                            0.00)
                                            WHEN 
                                                $sequence = 6 || 7
                                                THEN 
                                                    COALESCE((SELECT 
                                                                    ROUND(employer / 2, 4)
                                                                FROM
                                                                    ref_sss_contribution
                                                                WHERE
                                                                    emp.monthly_based_salary BETWEEN salary_range_from AND salary_range_to
                                                                    AND ref_sss_contribution.is_deleted = 0),
                                                            0.00)
                                            WHEN 
                                                $sequence = 8
                                                THEN 
                                                    COALESCE((SELECT 
                                                                    ROUND(employer, 4)
                                                                FROM
                                                                    ref_sss_contribution
                                                                WHERE
                                                                    emp.monthly_based_salary BETWEEN salary_range_from AND salary_range_to
                                                                    AND ref_sss_contribution.is_deleted = 0),
                                                            0.00)

                                            ELSE
                                                COALESCE((SELECT 
                                                                ROUND(employer, 4)
                                                            FROM
                                                                ref_sss_contribution
                                                            WHERE
                                                                emp.monthly_based_salary BETWEEN salary_range_from AND salary_range_to
                                                                AND ref_sss_contribution.is_deleted = 0),
                                                        0.00)
                                        END)
                                    ELSE COALESCE((SELECT 
                                                    ROUND(employer, 4)
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
                                                        ROUND(employer_contribution, 4)
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
                                                        ROUND((employer_contribution / 2), 4)
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
                                                        ROUND((employer_contribution / $count), 4)
                                                    FROM
                                                        ref_sss_contribution
                                                    WHERE
                                                        emp.monthly_based_salary BETWEEN salary_range_from AND salary_range_to
                                                        AND ref_sss_contribution.is_deleted = 0),
                                                0.00)
                                    WHEN
                                        emp.ref_payfrequency_type_id = 5
                                    THEN
                                        (CASE
                                            WHEN
                                                $sequence = 1 || 2 || 3 || 4 || 5
                                                THEN 
                                                    COALESCE((SELECT 
                                                                    ROUND((employer_contribution / $count), 4)
                                                                FROM
                                                                    ref_sss_contribution
                                                                WHERE
                                                                    emp.monthly_based_salary BETWEEN salary_range_from AND salary_range_to
                                                                    AND ref_sss_contribution.is_deleted = 0),
                                                            0.00)
                                            WHEN 
                                                $sequence = 6 || 7
                                                THEN 
                                                    COALESCE((SELECT 
                                                                    ROUND(employer_contribution / 2, 4)
                                                                FROM
                                                                    ref_sss_contribution
                                                                WHERE
                                                                    emp.monthly_based_salary BETWEEN salary_range_from AND salary_range_to
                                                                    AND ref_sss_contribution.is_deleted = 0),
                                                            0.00)
                                            WHEN 
                                                $sequence = 8
                                                THEN 
                                                    COALESCE((SELECT 
                                                                    ROUND(employer_contribution, 4)
                                                                FROM
                                                                    ref_sss_contribution
                                                                WHERE
                                                                    emp.monthly_based_salary BETWEEN salary_range_from AND salary_range_to
                                                                    AND ref_sss_contribution.is_deleted = 0),
                                                            0.00)

                                            ELSE
                                                COALESCE((SELECT 
                                                                ROUND(employer_contribution, 4)
                                                            FROM
                                                                ref_sss_contribution
                                                            WHERE
                                                                emp.monthly_based_salary BETWEEN salary_range_from AND salary_range_to
                                                                AND ref_sss_contribution.is_deleted = 0),
                                                        0.00)
                                        END)
                                    ELSE COALESCE((SELECT 
                                                    ROUND(employer_contribution, 4)
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


                                    WHEN
                                        emp.ref_payfrequency_type_id = 5
                                    THEN
                                        (CASE
                                            WHEN
                                                $sequence = 1 || 2 || 3 || 4 || 5
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
                                            WHEN 
                                                $sequence = 6 || 7
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
                                                $sequence = 8
                                                THEN 
                                                    COALESCE((SELECT 
                                                            (CASE
                                                                    WHEN emp.monthly_based_salary <= 10000 THEN ROUND((employee), 4)
                                                                    WHEN emp.monthly_based_salary > 40000 THEN ROUND((employee), 4)
                                                                    ELSE ROUND((((emp.monthly_based_salary * percentage) / 2)),
                                                                            4)
                                                                END) AS employee
                                                        FROM
                                                            ref_philhealth_contribution
                                                        WHERE
                                                            emp.monthly_based_salary BETWEEN salary_range_from AND salary_range_to),
                                                    0.00)

                                            ELSE
                                                COALESCE((SELECT 
                                                                ROUND(employer_contribution, 4)
                                                            FROM
                                                                ref_sss_contribution
                                                            WHERE
                                                                emp.monthly_based_salary BETWEEN salary_range_from AND salary_range_to
                                                                AND ref_sss_contribution.is_deleted = 0),
                                                        0.00)
                                        END)

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
                                    WHEN emp.ref_payfrequency_type_id = 2 THEN ROUND((COALESCE(SELECT pagibig1 FROM reffactorfile),0), 2)
                                    WHEN emp.ref_payfrequency_type_id = 1 THEN ROUND(((COALESCE(SELECT pagibig1 FROM reffactorfile),0) / 2), 2)
                                    WHEN emp.ref_payfrequency_type_id = 4 THEN ROUND(((COALESCE(SELECT pagibig1 FROM reffactorfile),0) / $count), 2)
                                    WHEN
                                        emp.ref_payfrequency_type_id = 5
                                    THEN
                                        (CASE
                                            WHEN
                                                $sequence = 1 || 2 || 3 || 4 || 5
                                                THEN 
                                                    ROUND(((COALESCE(SELECT pagibig1 FROM reffactorfile),0) / $count), 2)
                                            WHEN 
                                                $sequence = 6 || 7
                                                THEN 
                                                    ROUND(((COALESCE(SELECT pagibig1 FROM reffactorfile),0) / 2), 2)
                                            WHEN 
                                                $sequence = 8
                                                THEN ROUND((COALESCE(SELECT pagibig1 FROM reffactorfile),0), 2)

                                            ELSE
                                                ROUND((COALESCE(SELECT pagibig1 FROM reffactorfile),0), 2)
                                        END)
                                    ELSE (COALESCE(SELECT pagibig1 FROM reffactorfile),0)
                                END)
                            ELSE 0.00
                        END) AS pagibig_deduction,
                        'null' AS wtax_deduction,
                        (SELECT 
                                (CASE
                                    WHEN loan.balance > 0
                                        THEN
                                            (CASE
                                                WHEN loan.deduction_amt > 0 THEN ROUND(SUM(loan.deduction_amt), 2)
                                                ELSE ''
                                            END)
                                        ELSE 0.00
                                    END) AS deduction_amt
                            FROM
                                loan_list loan
                            WHERE
                                loan.ref_loan_id = 1
                                    AND loan.is_deleted = 0
                                    AND loan.employee_id = emp.employee_id
                                    AND loan.$frequency = 1) AS sss_loan,
                        (SELECT 
                                (CASE 
                                    WHEN loan.balance > 0
                                        THEN
                                            (CASE
                                                WHEN loan.deduction_amt > 0 THEN loan.loan_id
                                                ELSE 0
                                            END)
                                        ELSE 0
                                    END) AS sss_loan_id
                            FROM
                                loan_list loan
                            WHERE
                                loan.ref_loan_id = 1
                                    AND loan.is_deleted = 0
                                    AND loan.employee_id = emp.employee_id
                                    AND loan.$frequency = 1) AS sss_loan_id,
                        (SELECT 
                                (CASE 
                                    WHEN loan.balance > 0
                                        THEN 
                                            (CASE
                                                WHEN loan.deduction_amt > 0 THEN ROUND(SUM(loan.deduction_amt), 2)
                                                ELSE ''
                                            END)
                                        ELSE 0.00
                                    END) AS deduction_amt
                            FROM
                                loan_list loan
                            WHERE
                                loan.ref_loan_id = 2
                                    AND loan.balance > 0
                                    AND loan.is_deleted = 0
                                    AND loan.employee_id = emp.employee_id
                                    AND loan.$frequency = 1) AS pagibig_loan,
                        (SELECT 
                                (CASE 
                                    WHEN loan.balance > 0
                                        THEN 
                                            (CASE
                                                WHEN loan.deduction_amt > 0 THEN loan.loan_id
                                                ELSE 0
                                            END)
                                        ELSE 0
                                    END) AS pagibig_loan_id
                            FROM
                                loan_list loan
                            WHERE
                                loan.ref_loan_id = 2
                                    AND loan.balance > 0
                                    AND loan.is_deleted = 0
                                    AND loan.employee_id = emp.employee_id
                                    AND loan.$frequency = 1) AS pagibig_loan_id,
                        (SELECT 
                                (CASE
                                    WHEN loan.balance > 0
                                        THEN
                                            (CASE
                                                WHEN loan.deduction_amt > 0 THEN ROUND(SUM(loan.deduction_amt), 2)
                                                ELSE ''
                                            END)
                                        ELSE 0.00
                                    END) AS deduction_amt
                            FROM
                                loan_list loan
                            WHERE
                                loan.ref_loan_id = 3
                                    AND loan.balance > 0
                                    AND loan.is_deleted = 0
                                    AND loan.employee_id = emp.employee_id
                                    AND loan.$frequency = 1) AS cash_advance,
                            (SELECT 
                                (CASE
                                    WHEN loan.balance > 0
                                        THEN
                                            (CASE
                                                WHEN loan.deduction_amt > 0 THEN loan.loan_id
                                                ELSE 0
                                            END)
                                        ELSE 0
                                    END) AS cash_advance_id
                            FROM
                                loan_list loan
                            WHERE
                                loan.ref_loan_id = 3
                                    AND loan.balance > 0
                                    AND loan.is_deleted = 0
                                    AND loan.employee_id = emp.employee_id
                                    AND loan.$frequency = 1) AS cash_advance_id,
                        'null' AS net_total
                    FROM
                        employee_list emp
                    WHERE
                        emp.is_deleted = 0
                        AND emp.is_active = 1
                        AND emp.company_id = $company_id
                        ".($ref_branch_id=='all'?"":" AND emp.ref_branch_id=".$ref_branch_id."")."
                        ".($ref_department_id=='all'?"":" AND emp.ref_department_id=".$ref_department_id."")."");
        $query->result();
        return $query->result();
    }

    function get_emp_loan_list($company_id){
        $query = $this->db->query("SELECT 
                        emp.*,
                        CONCAT(emp.first_name,
                                ' ',
                                emp.middle_name,
                                ' ',
                                emp.last_name) AS full_name,
                        pftype.pay_frequency_type
                    FROM
                        employee_list emp
                            LEFT JOIN
                        ref_payfrequency_type pftype ON pftype.ref_payfrequency_type_id = emp.ref_payfrequency_type_id
                    WHERE
                        emp.is_deleted = 0
                        AND emp.company_id = $company_id");
        $query->result();
        return $query->result();
    }

    function check_pin($eid){
        $query = $this->db->query('SELECT pin_number,attempt,ecode FROM employee_list WHERE employee_id ='.$eid);
        $query->result();
        return $query->result();
    }

    function check_pin_number($pin_number){
        $query = $this->db->query('SELECT pin_number FROM employee_list WHERE pin_number ='.$pin_number);
        $query->result();
        return $query->result();
    }

    function getExpiringPersonnel($type,$type2,$month,$year){
        $query = $this->db->query("SELECT 
                CONCAT(emp_list.first_name,
                        ' ',
                        emp_list.middle_name,
                        '',
                        emp_list.last_name) AS fullname,
                DATE_FORMAT(emp_rates.date_start, '%m/%d/%Y') AS date_hired,
                DATE_FORMAT(emp_rates.date_end, '%m/%d/%Y') AS date_expire,
                dept.department
            FROM
                employee_list AS emp_list
                    LEFT JOIN
                emp_rates_duties AS emp_rates ON emp_rates.employee_id = emp_list.employee_id
                    LEFT JOIN
                ref_department AS dept ON dept.ref_department_id = emp_rates.ref_department_id
            WHERE
                emp_list.is_deleted = 0
                    AND emp_list.is_retired = 0
                    AND emp_rates.active_rates_duties = 1
                    AND emp_rates.is_deleted = 0
                    
                 ".($type=='week'?" 
                    AND emp_rates.date_end BETWEEN 
                        DATE(NOW() + INTERVAL (1 - DAYOFWEEK(NOW())) DAY) AND 
                        DATE(NOW() + INTERVAL (7 - DAYOFWEEK(NOW())) DAY)
                 ":" 
                    ".($type2 == 1 ? " 
                        AND 
                            MONTH(emp_rates.date_end) = MONTH(CURRENT_DATE())
                        AND
                            YEAR(emp_rates.date_end) = YEAR(CURRENT_DATE())
                    ":"
                        AND 
                            MONTH(emp_rates.date_end) = $month
                        AND 
                            YEAR(emp_rates.date_end) = $year
                    ")."
                 ")."

            ORDER BY emp_rates.date_end ASC
                ");

        $query->result();
        return $query->result();
    }

    function empcountperdept($company_id) {
        $query = $this->db->query("SELECT 
                    COUNT(rd.ref_department_id) AS totalperdept,
                    rd.department
                FROM
                    employee_list emp
                        LEFT JOIN
                    ref_department rd ON rd.ref_department_id = emp.ref_department_id
                WHERE
                    emp.is_deleted = 0
                        AND emp.is_active = 1
                        AND emp.company_id = $company_id
                        AND rd.company_id = $company_id
                GROUP BY rd.ref_department_id");

        $query->result();
        return $query->result();
    }

    function get_bday($month){
        $query = $this->db->query('SELECT 
                CONCAT(emplist.first_name," ",emplist.middle_name," ",emplist.last_name) as fullname,
                emplist.birthdate,dept.department 
                FROM employee_list as emplist 
                LEFT JOIN emp_rates_duties as emp_rd ON
                emp_rd.emp_rates_duties_id = emplist.emp_rates_duties_id
                LEFT JOIN ref_department as dept ON
                dept.ref_department_id = emp_rd.ref_department_id
                WHERE EXTRACT(MONTH FROM emplist.birthdate) = '.$month.' 
                AND emplist.is_deleted = 0 AND emplist.is_retired = 0
                ORDER BY emplist.birthdate');
        $query->result();
        return $query->result();
    }

    function empcountperbranch() {
        $query = $this->db->query('SELECT COUNT(ref_branch.ref_branch_id) as totalperbranch,ref_branch.branch FROM employee_list
        LEFT JOIN ref_branch ON
        ref_branch.ref_branch_id=employee_list.ref_branch_id
        WHERE employee_list.is_active=1 AND employee_list.is_deleted=0
        GROUP BY ref_branch.ref_branch_id');
        $query->result();
        return $query->result();
    }

    function dashmonthlygross($company_id) {
        $query = $this->db->query("SELECT 
                m.*
            FROM
                (SELECT 
                    (CASE
                            WHEN EXTRACT(MONTH FROM rp.pay_period_start) = '1' THEN '00'
                            WHEN EXTRACT(MONTH FROM rp.pay_period_start) = '2' THEN '01'
                            WHEN EXTRACT(MONTH FROM rp.pay_period_start) = '3' THEN '02'
                            WHEN EXTRACT(MONTH FROM rp.pay_period_start) = '4' THEN '03'
                            WHEN EXTRACT(MONTH FROM rp.pay_period_start) = '5' THEN '04'
                            WHEN EXTRACT(MONTH FROM rp.pay_period_start) = '6' THEN '05'
                            WHEN EXTRACT(MONTH FROM rp.pay_period_start) = '7' THEN '06'
                            WHEN EXTRACT(MONTH FROM rp.pay_period_start) = '8' THEN '07'
                            WHEN EXTRACT(MONTH FROM rp.pay_period_start) = '9' THEN '08'
                            WHEN EXTRACT(MONTH FROM rp.pay_period_start) = '10' THEN '09'
                            WHEN EXTRACT(MONTH FROM rp.pay_period_start) = '11' THEN '10'
                            WHEN EXTRACT(MONTH FROM rp.pay_period_start) = '12' THEN '11'
                        END) AS Month,
                        ROUND(SUM(basic_pay_total), 2) AS reg_pay,
                        ROUND(SUM(net_total), 2) AS net_pay
                FROM
                    pay_slip ps
                LEFT JOIN daily_time_record dtr ON dtr.dtr_id = ps.dtr_id
                LEFT JOIN refpayperiod rp ON rp.pay_period_id = dtr.pay_period_id
                WHERE dtr.company_id = $company_id
                GROUP BY Month) AS m");
        $query->result();
        return $query->result();
    }

    function dashcompensationdept($company_id) {
        $year = date('Y');
        $query = $this->db->query("SELECT 
                        m.*
                    FROM
                        (SELECT 
                            rd.department,
                                ROUND(SUM(dtr.basic_pay_total), 2) AS reg_pay,
                                ROUND(SUM(dtr.net_total), 2) AS net_pay
                        FROM
                            pay_slip ps
                        LEFT JOIN daily_time_record dtr ON dtr.dtr_id = ps.dtr_id
                        LEFT JOIN refpayperiod rpp ON rpp.pay_period_id = dtr.pay_period_id
                        LEFT JOIN employee_list emp ON emp.employee_id = dtr.employee_id
                        LEFT JOIN ref_department rd ON rd.ref_department_id = emp.ref_department_id
                        WHERE
                            EXTRACT(YEAR FROM rpp.pay_period_start) = 2018
                                AND emp.is_active = 1
                                AND emp.company_id = $company_id
                                AND rd.is_deleted = 0
                        GROUP BY rd.ref_department_id) AS m");
        $query->result();
        return $query->result();
    }

      function send_mail($email,$message,$subject,$company_email,$email_password,$company_name)
      {     
        $emailConfig = array('protocol' => 'smtp', 
        'smtp_host' => 'ssl://smtp.googlemail.com', 
        'smtp_port' => 465, 
        'smtp_user' => $company_email, 
        'smtp_pass' => $email_password, 
        'mailtype' => 'html', 
        'charset' => 'iso-8859-1');

        $this->load->library('email', $emailConfig);
        $this->email->set_newline("\r\n");
        $this->email->from($company_email, $company_name);
        $this->email->to($email);
        $this->email->subject($subject);
        $this->email->message($message);
        $this->email->set_mailtype("html");
        $this->email->send();
      }
}
?>
