<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CORE_Controller {

    function __construct()
    {
        parent::__construct('');
        if($this->session->company_id != '') {
            if ($this->session->user_id != ''){
                echo '<script>
                window.location.href = "Dashboard";
                </script>';
            }
        }else{
            echo '<script>
            window.location.href = "CompanyLogin";
            </script>';
        }
        $this->load->model('Employee_model');
        $this->load->model('Users_model');
        $this->load->model('User_groups_model');
        $this->load->model('CompanyManagement_model');
        $this->load->model('RefPayFrequency_model');
        $this->load->model('RefPayFrequencyFactor_model');
        $this->load->model('RefFactorFile_model');
    }


    public function index()
    {
        $this->create_required_default_data();

        $data['_def_css_files']=$this->load->view('template/assets/css_files','',TRUE);
        $data['_def_js_files']=$this->load->view('template/assets/js_files','',TRUE);
        $data['loader'] = $this->load->view('template/elements/loader', '', TRUE);
        $data['loaderscript'] = $this->load->view('template/elements/loaderscript', '', TRUE);
        $data['company_setup']=$this->CompanyManagement_model->get_company_list($this->session->company_id);
        $data['title'] = 'JCORE - Login';
        $this->load->view('login_view',$data);

    }


    function create_required_default_data(){
        //create default user group : the Super User
        $m_ref_payfrequency_type=$this->RefPayFrequency_model;
        $m_ref_payfrequency_type->create_default_payfrequency_type();        
    }


    function transaction($txn=null){

        switch($txn){

                //****************************************************************************
                case 'validate' :
                    $uname=$this->input->post('uname');
                    $pword=$this->input->post('pword');
                    $users=$this->Users_model;
                    $m_employee = $this->Employee_model;
                    $company_setup = $this->CompanyManagement_model;
                    $m_users=$this->Users_model;
                    $m_user_groups=$this->User_groups_model;

                    $company_id = $this->session->company_id;
                    $result=$users->authenticate_user($company_id,$uname,$pword);
                    $m_company = $company_setup->get_company_list($company_id);

                    if($result->num_rows()>0){//valid username and pword
                        $user_id = $result->row()->user_id;
                        $m_users=$this->Users_model;
                        $m_users->session_status = 1; //1 is equivalent to active or logged in
                        $m_users->modify($user_id);

                        $chck_ref_payfrequency_factor = $this->RefPayFrequencyFactor_model->chck_ref_payfrequency_factor($company_id);

                        if (count($chck_ref_payfrequency_factor) <= 0){
                            $m_ref_pay_frequency_factor=$this->RefPayFrequencyFactor_model;
                            $m_ref_pay_frequency_factor->create_default_pay_frequency_factor_monthly($company_id);  
                            $m_ref_pay_frequency_factor->create_default_pay_frequency_factor_semimonthly($company_id); 
                            $m_ref_pay_frequency_factor->create_default_pay_frequency_factor_weekly($company_id); 
                            $m_ref_pay_frequency_factor->create_default_pay_frequency_factor_salaried($company_id); 
                        }

                        $chck_ref_factor_file = $this->RefFactorFile_model->chck_ref_factor_file($company_id);

                        if (count($chck_ref_factor_file) <= 0){
                            $m_ref_factor_file=$this->RefFactorFile_model;
                            $m_ref_factor_file->create_default_ref_factor_file($company_id); 
                        }

                        //set session data here and response data
                        $this->session->set_userdata(
                            array(
                                'factor_id'=>$result->row()->factor_id,
                                //User Account
                                'user_id'=>$result->row()->user_id,
                                'user_group_id'=>$result->row()->user_group_id,
                                'user_fullname'=>$result->row()->user_fullname,
                                'user_email'=>$result->row()->user_email,
                                'user_photo'=>$result->row()->photo_path,
								'user_group_id'=>$result->row()->user_group_id,

                                //Employee
                                'right_employee_view'=>$result->row()->right_employee_view,
                                'right_employee_excel'=>$result->row()->right_employee_excel,
                                'right_employee_create'=>$result->row()->right_employee_create,
                                'right_employee_edit'=>$result->row()->right_employee_edit,
                                'right_employee_delete'=>$result->row()->right_employee_delete,

                                //References
                                'right_empreference_view'=>$result->row()->right_empreference_view,
                                'right_emp_type_view'=>$result->row()->right_emp_type_view,
                                'right_emp_type_create'=>$result->row()->right_emp_type_create,
                                'right_emp_type_edit'=>$result->row()->right_emp_type_edit,
                                'right_emp_type_delete'=>$result->row()->right_emp_type_delete,
                                'right_branch_view'=>$result->row()->right_branch_view,
                                'right_branch_create'=>$result->row()->right_branch_create,
                                'right_branch_edit'=>$result->row()->right_branch_edit,
                                'right_branch_delete'=>$result->row()->right_branch_delete,
                                'right_department_view'=>$result->row()->right_department_view,
                                'right_department_create'=>$result->row()->right_department_create,
                                'right_department_edit'=>$result->row()->right_department_edit,
                                'right_department_delete'=>$result->row()->right_department_delete,
                                'right_position_view'=>$result->row()->right_position_view,
                                'right_position_create'=>$result->row()->right_position_create,
                                'right_position_edit'=>$result->row()->right_position_edit,
                                'right_position_delete'=>$result->row()->right_position_delete,
                                'right_section_view'=>$result->row()->right_section_view,
                                'right_section_create'=>$result->row()->right_section_create,
                                'right_section_edit'=>$result->row()->right_section_edit,
                                'right_section_delete'=>$result->row()->right_section_delete,
                                'right_pay_frequency_view'=>$result->row()->right_pay_frequency_view,
                                'right_pay_frequency_create'=>$result->row()->right_pay_frequency_create,
                                'right_pay_frequency_edit'=>$result->row()->right_pay_frequency_edit,
                                'right_pay_frequency_delete'=>$result->row()->right_pay_frequency_delete,


                                'right_payperiod_view'=>$result->row()->right_payperiod_view,
                                'right_payperiod_create'=>$result->row()->right_payperiod_create,
                                'right_payperiod_edit'=>$result->row()->right_payperiod_edit,
                                'right_payperiod_delete'=>$result->row()->right_payperiod_delete,

                                //Contribution References
                                'right_contribution_view'=>$result->row()->right_contribution_view,
                                'right_sss_view'=>$result->row()->right_sss_view,
                                'right_sss_create'=>$result->row()->right_sss_create,
                                'right_sss_edit'=>$result->row()->right_sss_edit,
                                'right_sss_delete'=>$result->row()->right_sss_delete,
                                'right_philhealth_view'=>$result->row()->right_philhealth_view,
                                'right_philhealth_create'=>$result->row()->right_philhealth_create,
                                'right_philhealth_edit'=>$result->row()->right_philhealth_edit,
                                'right_philhealth_delete'=>$result->row()->right_philhealth_delete,
                                'right_taxtable_view'=>$result->row()->right_taxtable_view,

                                //Loan & Deduction Setup
                                'right_loandeduction_view'=>$result->row()->right_loandeduction_view,
                                'right_loandeduction_create'=>$result->row()->right_loandeduction_create,
                                'right_loandeduction_edit'=>$result->row()->right_loandeduction_edit,
                                'right_loandeduction_delete'=>$result->row()->right_loandeduction_delete,

                                //Payroll
                                'right_payrollparent_view'=>$result->row()->right_payrollparent_view,
                                'right_dtr_view'=>$result->row()->right_dtr_view,
                                'right_dtr_processpayroll'=>$result->row()->right_dtr_processpayroll,
                                'right_dtr_updatepayroll'=>$result->row()->right_dtr_updatepayroll,
                                'right_payslip_view'=>$result->row()->right_payslip_view,
                                'right_dtrsummary_view'=>$result->row()->right_dtrsummary_view,
                                'right_payroll_register_view'=>$result->row()->right_payroll_register_view,
                                'right_payrollsummary_view'=>$result->row()->right_payrollsummary_view,
                                'right_13thmonthpay_view'=>$result->row()->right_13thmonthpay_view,
                                'right_alphalist_view'=>$result->row()->right_alphalist_view,
                                'right_1601C_view'=>$result->row()->right_1601C_view, 
                                'right_bir2316_view'=>$result->row()->right_bir2316_view, 
                                'right_employee_compensation_view'=>$result->row()->right_employee_compensation_view,
                                'right_employee_deduction_view'=>$result->row()->right_employee_deduction_view,

                                //Payroll Reports
                                'right_payrollreports_view'=>$result->row()->right_payrollreports_view,
                                'right_sssreport_view'=>$result->row()->right_sssreport_view,
                                'right_philhealthreport_view'=>$result->row()->right_philhealthreport_view,
                                'right_pagibigreport_view'=>$result->row()->right_pagibigreport_view,
                                'right_wtaxreport_view'=>$result->row()->right_wtaxreport_view,

                                //Admin Setup
                                'right_adminparent_view'=>$result->row()->right_adminparent_view,
                                'right_useraccount_view'=>$result->row()->right_useraccount_view,
                                'right_useraccount_create'=>$result->row()->right_useraccount_create,
                                'right_useraccount_edit'=>$result->row()->right_useraccount_edit,
                                'right_useraccount_delete'=>$result->row()->right_useraccount_delete,
                                'right_usergroup_view'=>$result->row()->right_usergroup_view,
                                'right_usergroup_create'=>$result->row()->right_usergroup_create,
                                'right_usergroup_edit'=>$result->row()->right_usergroup_edit,
                                'right_usergroup_delete'=>$result->row()->right_usergroup_delete,
                                'right_companysetup_view'=>$result->row()->right_companysetup_view,
                                'right_companysetup_edit'=>$result->row()->right_companysetup_edit,
                                'right_reffactorfile_view'=>$result->row()->right_reffactorfile_view,
                                'right_reffactorfile_edit'=>$result->row()->right_reffactorfile_edit,
                            )
                        );
                        
                        $response['title'] = 'Success';
                        $response['stat']='success';
                        $response['msg']='User successfully authenticated.';

                        echo json_encode($response);

                    }else{ //not valid
                        
                        $response['title'] = 'Cannot authenticate user!';
                        $response['stat']='error';
                        $response['msg']='Invalid username or password.';
                        echo json_encode($response);

                    }

                    break;


                case 'validatevoid' :
                    $uname=$this->input->post('uname');
                    $pword=$this->input->post('pword');

                    $users=$this->Users_model;
                    $result=$users->authenticate_user($uname,$pword);

                    if($result->num_rows()>0){//valid username and pword
                        //set session data here and response data


                        $response['stat']='success';
                        $response['msg']='Successfully authenticated.';

                        echo json_encode($response);

                    }else{ //not valid

                        $response['stat']='error';
                        $response['msg']='Invalid username or password.';
                        echo json_encode($response);

                    }

                    break;
                //****************************************************************************
                case 'logout' :
                    $m_users=$this->Users_model;
                    $user_id = $this->session->user_id;
                    $company_id = $this->session->company_id;
                    $m_users->session_status = 0; //0 is equivalent to inactive or logged out
                    $m_users->modify($user_id);
                    $this->end_session();
                    $this->session->set_userdata(
                        array(
                            'company_id'=>$company_id,
                        )
                    );
                    echo $company_id;
                //****************************************************************************


                break;

                case 'company_logout' :
                    $m_company=$this->CompanyManagement_model;
                    $company_id = $this->session->company_id;
                    $m_company->status = 0; //0 is equivalent to inactive or logged out
                    $m_company->modify($company_id);
                    $this->end_company_session();
                //****************************************************************************

                break;


                default:


        }
    }
}
