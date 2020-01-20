	<script>
		/*employee info*/
		var right_employee_edit='<button class="btn btn-default btn-sm btnedit" name="edit_info" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil fa-lg"></i> </button>';
        var right_employee_delete='<button class="btn btn-default btn-sm btndelete" name="remove_info" data-toggle="tooltip" data-placement="top" title="Move to trash"><i class="fa fa-trash-o fa-lg"></i> </button>';
        /*Employement Type*/
        var right_emp_type_edit='<button class="btn btn-default btn-sm btnedit" name="edit_info" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil"></i> </button>';
        var right_emp_type_delete='<button class="btn btn-default btn-sm btndelete" name="remove_info"  data-toggle="tooltip" data-placement="top" title="Move to trash"><i class="fa fa-trash-o"></i> </button>'; 
        /*Branch*/
        var right_branch_edit='<button class="btn btn-default btn-sm btnedit" name="edit_info" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil"></i> </button>';
        var right_branch_delete='<button class="btn btn-default btn-sm btndelete" name="remove_info"  data-toggle="tooltip" data-placement="top" title="Move to trash"><i class="fa fa-trash-o"></i> </button>';
        /*department*/
        var right_department_edit='<button class="btn btn-default btn-sm btnedit" name="edit_info"   data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil"></i> </button>';
        var right_department_delete='<button class="btn btn-default btn-sm btndelete" name="remove_info"  data-toggle="tooltip" data-placement="top" title="Move to trash"><i class="fa fa-trash-o"></i> </button>';
        /*position*/
        var right_position_edit='<button class="btn btn-default btn-sm btnedit" name="edit_info"   data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil"></i> </button>';
        var right_position_delete='<button class="btn btn-default btn-sm btndelete" name="remove_info"  data-toggle="tooltip" data-placement="top" title="Move to trash"><i class="fa fa-trash-o"></i> </button>';
        /*section*/
        var right_section_edit='<button class="btn btn-default btn-sm btnedit" name="edit_info"   data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil"></i> </button>';
        var right_section_delete='<button class="btn btn-default btn-sm btndelete" name="remove_info"  data-toggle="tooltip" data-placement="top" title="Move to trash"><i class="fa fa-trash-o"></i> </button>';
        /*paymenttype*/
     	var right_pay_frequency_edit='<button class="btn btn-default btn-sm btnedit" name="edit_info"   data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil"></i> </button>';
        var right_pay_frequency_delete='<button class="btn btn-default btn-sm btndelete" name="remove_info"  data-toggle="tooltip" data-placement="top" title="Move to trash"><i class="fa fa-trash-o"></i> </button>';
        /*payperiod*/
        var right_payperiod_edit='<button class="btn btn-default btn-sm btnedit" name="edit_info" searchPlaceholder  data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil"></i> </button>';
        var right_payperiod_delete='<button class="btn btn-default btn-sm btndelete" name="remove_info"  data-toggle="tooltip" data-placement="top" title="Move to trash"><i class="fa fa-trash-o"></i> </button>';
        /*sss*/
        var right_sss_edit='<button class="btn btn-default btn-sm btnedit" name="edit_info"   data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil"></i> </button>';
        var right_sss_delete='<button class="btn btn-default btn-sm btndelete" name="remove_info"  data-toggle="tooltip" data-placement="top" title="Move to trash"><i class="fa fa-trash-o"></i> </button>';
        /*philhealth*/
        var right_philhealth_edit='<button class="btn btn-default btn-sm btnedit" name="edit_info"   data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil"></i> </button>';
        var right_philhealth_delete='<button class="btn btn-default btn-sm btndelete" name="remove_info"  data-toggle="tooltip" data-placement="top" title="Move to trash"><i class="fa fa-trash-o"></i> </button>';
        /*Loan and deduction*/
        var right_loandeduction_edit='<button class="btn btn-default btn-sm btnedit" name="edit_info" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil"></i> </button>';
        var right_loandeduction_delete='<button class="btn btn-default btn-sm btndelete" name="remove_info" data-toggle="tooltip" data-placement="top" title="Move to trash"><i class="fa fa-trash-o"></i> </button>';
        /*users*/
        var right_useraccount_edit='<button class="btn btn-default btn-sm btnedit" name="edit_info"   data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil"></i> </button>';
        var right_useraccount_delete='<button class="btn btn-default btn-sm btndelete" name="remove_info"  data-toggle="tooltip" data-placement="top" title="Move to trash"><i class="fa fa-trash-o"></i> </button>';
        /*usergroups*/
        var right_usergroup_edit='<button class="btn btn-default btn-sm btnedit" name="edit_info"   data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil"></i> </button>';
        var right_usergroup_delete='<button class="btn btn-default btn-sm btndelete" name="remove_info"  data-toggle="tooltip" data-placement="top" title="Move to trash"><i class="fa fa-trash-o"></i> </button>';

	</script>

	<!-- rights start -->
<?php
	echo ($this->session->right_employee_view==0 || NULL ? '<script> $(".right_employee_view").remove(); </script>' : '');
	echo ($this->session->right_employee_create==0 || NULL ? '<script> $(".right_employee_create").remove(); </script>' : '');
    echo ($this->session->right_employee_excel==0 || NULL ? '<script> $(".right_employee_excel").remove(); </script>' : '');
	echo ($this->session->right_employee_edit==0 || NULL ? '<script> var right_employee_edit=" "; </script>' : '');
 	echo ($this->session->right_employee_delete==0 || NULL ? '<script> var right_employee_delete=" "; </script>' : '');

 	echo ($this->session->right_empreference_view==0 || NULL ? '<script> $(".right_empreference_view").remove(); </script>' : '');

    echo ($this->session->right_emp_type_view==0 || NULL ? '<script> $(".right_emp_type_view").remove(); </script>' : '');
    echo ($this->session->right_emp_type_create==0 || NULL ? '<script> $(".right_emp_type_create").remove(); </script>' : '');
    echo ($this->session->right_emp_type_edit==0 || NULL ? '<script> var right_emp_type_edit=" "; </script>' : '');
    echo ($this->session->right_emp_type_delete==0 || NULL ? '<script> var right_emp_type_delete=" "; </script>' : '');

 	echo ($this->session->right_branch_view==0 || NULL ? '<script> $(".right_branch_view").remove(); </script>' : '');
 	echo ($this->session->right_branch_create==0 || NULL ? '<script> $(".right_branch_create").remove(); </script>' : '');
 	echo ($this->session->right_branch_edit==0 || NULL ? '<script> var right_branch_edit=" "; </script>' : '');
 	echo ($this->session->right_branch_delete==0 || NULL ? '<script> var right_branch_delete=" "; </script>' : '');

    echo ($this->session->right_department_view==0 || NULL ? '<script> $(".right_department_view").remove(); </script>' : '');
    echo ($this->session->right_department_create==0 || NULL ? '<script> $(".right_department_create").remove(); </script>' : '');
    echo ($this->session->right_department_edit==0 || NULL ? '<script> var right_department_edit=" "; </script>' : '');
    echo ($this->session->right_department_delete==0 || NULL ? '<script> var right_department_delete=" "; </script>' : '');

 	echo ($this->session->right_position_view==0 || NULL ? '<script> $(".right_position_view").remove(); </script>' : '');
 	echo ($this->session->right_position_create==0 || NULL ? '<script> $(".right_position_create").remove(); </script>' : '');
 	echo ($this->session->right_position_edit==0 || NULL ? '<script> var right_position_edit=" "; </script>' : '');
 	echo ($this->session->right_position_delete==0 || NULL ? '<script> var right_position_delete=" "; </script>' : '');

 	echo ($this->session->right_section_view==0 || NULL ? '<script> $(".right_section_view").remove(); </script>' : '');
 	echo ($this->session->right_section_create==0 || NULL ? '<script> $(".right_section_create").remove(); </script>' : '');
 	echo ($this->session->right_section_edit==0 || NULL ? '<script> var right_section_edit=" "; </script>' : '');
 	echo ($this->session->right_section_delete==0 || NULL ? '<script> var right_section_delete=" "; </script>' : '');

    echo ($this->session->right_pay_frequency_view==0 || NULL ? '<script> $(".right_pay_frequency_view").remove(); </script>' : '');
    echo ($this->session->right_pay_frequency_create==0 || NULL ? '<script> $(".right_pay_frequency_create").remove(); </script>' : '');
    echo ($this->session->right_pay_frequency_edit==0 || NULL ? '<script> var right_pay_frequency_edit=" "; </script>' : '');
    echo ($this->session->right_pay_frequency_delete==0 || NULL ? '<script> var right_pay_frequency_delete=" "; </script>' : '');

    echo ($this->session->right_payperiod_view==0 || NULL ? '<script> $(".right_payperiod_view").remove(); </script>' : '');
    echo ($this->session->right_payperiod_create==0 || NULL ? '<script> $(".right_payperiod_create").remove(); </script>' : '');
    echo ($this->session->right_payperiod_edit==0 || NULL ? '<script> var right_payperiod_edit=" "; </script>' : '');
    echo ($this->session->right_payperiod_delete==0 || NULL ? '<script> var right_payperiod_delete=" "; </script>' : '');

 	echo ($this->session->right_contribution_view==0 || NULL ? '<script> $(".right_contribution_view").remove(); </script>' : '');
 	echo ($this->session->right_sss_view==0 || NULL ? '<script> $(".right_sss_view").remove(); </script>' : '');
 	echo ($this->session->right_sss_create==0 || NULL ? '<script> $(".right_sss_create").remove(); </script>' : '');
 	echo ($this->session->right_sss_edit==0 || NULL ? '<script> var right_sss_edit=" "; </script>' : '');
 	echo ($this->session->right_sss_delete==0 || NULL ? '<script> var right_sss_delete=" "; </script>' : '');

 	echo ($this->session->right_philhealth_view==0 || NULL ? '<script> $(".right_philhealth_view").remove(); </script>' : '');
 	echo ($this->session->right_philhealth_create==0 || NULL ? '<script> $(".right_philhealth_create").remove(); </script>' : '');
 	echo ($this->session->right_philhealth_edit==0 || NULL ? '<script> var right_philhealth_edit=" "; </script>' : '');
 	echo ($this->session->right_philhealth_delete==0 || NULL ? '<script> var right_philhealth_delete=" "; </script>' : '');
    echo ($this->session->right_taxtable_view==0 || NULL ? '<script> $(".right_taxtable_view").remove(); </script>' : '');

    echo ($this->session->right_loandeduction_view==0 || NULL ? '<script> $(".right_loandeduction_view").remove(); </script>' : '');
    echo ($this->session->right_loandeduction_create==0 || NULL ? '<script> $(".right_loandeduction_create").remove(); </script>' : '');
    echo ($this->session->right_loandeduction_edit==0 || NULL ? '<script> var right_loandeduction_edit=" "; </script>' : '');
    echo ($this->session->right_loandeduction_delete==0 || NULL ? '<script> var right_loandeduction_delete=" "; </script>' : '');

 	echo ($this->session->right_payrollparent_view==0 || NULL ? '<script> $(".right_payrollparent_view").remove(); </script>' : '');
 	echo ($this->session->right_dtr_view==0 || NULL ? '<script> $(".right_dtr_view").remove(); </script>' : '');
 	echo ($this->session->right_dtr_processpayroll==0 || NULL ? '<script> $(".right_dtr_processpayroll").remove(); </script>' : '');
    echo ($this->session->right_dtr_updatepayroll==0 || NULL ? '<script> $(".right_dtr_updatepayroll").remove(); </script>' : '');
 	echo ($this->session->right_payslip_view==0 || NULL ? '<script> $(".right_payslip_view").remove(); </script>' : '');
    echo ($this->session->right_dtrsummary_view==0 || NULL ? '<script> $(".right_dtrsummary_view").remove(); </script>' : '');
    echo ($this->session->right_payroll_register_view==0 || NULL ? '<script> $(".right_payroll_register_view").remove(); </script>' : '');
    echo ($this->session->right_payrollsummary_view==0 || NULL ? '<script> $(".right_payrollsummary_view").remove(); </script>' : ''); 
    echo ($this->session->right_13thmonthpay_view==0 || NULL ? '<script> $(".right_13thmonthpay_view").remove(); </script>' : '');
    echo ($this->session->right_alphalist_view==0 || NULL ? '<script> $(".right_alphalist_view").remove(); </script>' : '');
    echo ($this->session->right_1601C_view==0 || NULL ? '<script> $(".right_1601C_view").remove(); </script>' : '');
    echo ($this->session->right_bir2316_view==0 || NULL ? '<script> $(".right_bir2316_view").remove(); </script>' : '');
    echo ($this->session->right_employee_compensation_view==0 || NULL ? '<script> $(".right_employee_compensation_view").remove(); </script>' : '');
    echo ($this->session->right_employee_deduction_view==0 || NULL ? '<script> $(".right_employee_deduction_view").remove(); </script>' : '');

    echo ($this->session->right_payrollreports_view==0 || NULL ? '<script> $(".right_payrollreports_view").remove(); </script>' : '');
    echo ($this->session->right_sssreport_view==0 || NULL ? '<script> $(".right_sssreport_view").remove(); </script>' : '');
    echo ($this->session->right_philhealthreport_view==0 || NULL ? '<script> $(".right_philhealthreport_view").remove(); </script>' : '');
    echo ($this->session->right_pagibigreport_view==0 || NULL ? '<script> $(".right_pagibigreport_view").remove(); </script>' : '');
    echo ($this->session->right_wtaxreport_view==0 || NULL ? '<script> $(".right_wtaxreport_view").remove(); </script>' : '');
    
 	echo ($this->session->right_adminparent_view==0 || NULL ? '<script> $(".right_adminparent_view").remove(); </script>' : '');
 	echo ($this->session->right_useraccount_view==0 || NULL ? '<script> $(".right_useraccount_view").remove(); </script>' : '');
 	echo ($this->session->right_useraccount_create==0 || NULL ? '<script> $(".right_useraccount_create").remove(); </script>' : '');
 	echo ($this->session->right_useraccount_edit==0 || NULL ? '<script> var right_useraccount_edit=" "; </script>' : '');
 	echo ($this->session->right_useraccount_delete==0 || NULL ? '<script> var right_useraccount_delete=" "; </script>' : '');
 	echo ($this->session->right_usergroup_view==0 || NULL ? '<script> $(".right_usergroup_view").remove(); </script>' : '');
 	echo ($this->session->right_usergroup_create==0 || NULL ? '<script> $(".right_usergroup_create").remove(); </script>' : '');
 	echo ($this->session->right_usergroup_edit==0 || NULL ? '<script> var right_usergroup_edit=" "; </script>' : '');
 	echo ($this->session->right_usergroup_delete==0 || NULL ? '<script> var right_usergroup_delete=" "; </script>' : '');
 	echo ($this->session->right_companysetup_view==0 || NULL ? '<script> $(".right_companysetup_view").remove(); </script>' : '');
 	echo ($this->session->right_companysetup_edit==0 || NULL ? '<script> $(".right_companysetup_edit").remove(); </script>' : '');
 	echo ($this->session->right_reffactorfile_view==0 || NULL ? '<script> $(".right_reffactorfile_view").remove(); </script>' : '');
 	echo ($this->session->right_reffactorfile_edit==0 || NULL ? '<script> $(".right_reffactorfile_edit").remove(); </script>' : '');

?>
