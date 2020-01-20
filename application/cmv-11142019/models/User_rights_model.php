<?php

class User_rights_model extends CORE_Model
{
    protected  $table = "user_rights"; //table name
    protected  $pk_id = "user_rights_id"; //primary key id
    protected  $fk_id="user_group_id";


    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    function create_default_user_rights($company_id,$user_group_id){
        $sql="INSERT INTO user_rights
                  (user_group_id,
                  company_id,
                  right_employee_view,
                  right_employee_excel,
                  right_employee_create,
                  right_employee_edit,
                  right_employee_delete,
                  right_empreference_view,
                  right_emp_type_view,
                  right_emp_type_create,
                  right_emp_type_edit,
                  right_emp_type_delete,
                  right_branch_view,
                  right_branch_create,
                  right_branch_edit,
                  right_branch_delete,
                  right_department_view,
                  right_department_create,
                  right_department_edit,
                  right_department_delete,
                  right_position_view,
                  right_position_create,
                  right_position_edit,
                  right_position_delete,
                  right_section_view,
                  right_section_create,
                  right_section_edit,
                  right_section_delete,
                  right_pay_frequency_view,
                  right_pay_frequency_create,
                  right_pay_frequency_edit,
                  right_pay_frequency_delete,
                  right_payperiod_view,
                  right_payperiod_create,
                  right_payperiod_edit,
                  right_payperiod_delete,
                  right_contribution_view,
                  right_sss_view,
                  right_sss_create,
                  right_sss_edit,
                  right_sss_delete,
                  right_philhealth_view,
                  right_philhealth_create,
                  right_philhealth_edit,
                  right_philhealth_delete,
                  right_taxtable_view,
                  right_loandeduction_view,
                  right_loandeduction_create,
                  right_loandeduction_edit,
                  right_loandeduction_delete,
                  right_payrollparent_view,
                  right_dtr_view,
                  right_dtr_processpayroll,
                  right_dtr_updatepayroll,
                  right_payslip_view,
                  right_payroll_register_view,
                  right_payrollsummary_view,
                  right_13thmonthpay_view,
                  right_alphalist_view,
                  right_1601C_view,
                  right_employee_compensation_view,
                  right_employee_deduction_view,
                  right_payrollreports_view,
                  right_sssreport_view,
                  right_philhealthreport_view,
                  right_pagibigreport_view,
                  right_wtaxreport_view,
                  right_adminparent_view,
                  right_useraccount_view,
                  right_useraccount_create,
                  right_useraccount_edit,
                  right_useraccount_delete,
                  right_usergroup_view,
                  right_usergroup_create,
                  right_usergroup_edit,
                  right_usergroup_delete,
                  right_companysetup_view,
                  right_companysetup_edit,
                  right_reffactorfile_view,
                  right_reffactorfile_edit
                  )
              VALUES
                  ($user_group_id,
                  $company_id,
                  1,1,1,1,1,1,1,1,1,1,
                  1,1,1,1,1,1,1,1,1,1,
                  1,1,1,1,1,1,1,1,1,1,
                  1,1,1,1,1,1,1,1,1,1,
                  1,1,1,1,1,1,1,1,1,1,
                  1,1,1,1,1,1,1,1,1,1,
                  1,1,1,1,1,1,1,1,1,1,
                  1,1,1,1,1,1,1,1)
        ";
        $this->db->query($sql);
    }

    function count_user_rights($company_id){
         $query = $this->db->query("SELECT * FROM user_rights WHERE company_id = $company_id");
         return $query->result();
    }
}
?>