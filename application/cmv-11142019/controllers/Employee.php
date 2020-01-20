<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employee extends CORE_Controller
{

    function __construct() {
        parent::__construct('');

        $this->validate_session();
        if($this->session->userdata('right_employee_view') == 0 || $this->session->userdata('right_employee_view') == null) {
            redirect('../Dashboard');
        }

        $this->load->library('excel');
        $this->load->model('Employee_model');
        $this->load->model('RefEmploymentType_model');
        $this->load->model('RefDepartment_model');
        $this->load->model('RefPosition_model');
        $this->load->model('RefBranch_model');
        $this->load->model('RefSection_model');
        $this->load->model('RefPayFrequency_model');       
        $this->load->model('RefGroup_model');  
        $this->load->model('Users_model');
        $this->load->model('CompanyManagement_model');
    }

    public function index() {
        $data['_def_css_files'] = $this->load->view('template/assets/css_files', '', TRUE);
        $data['_def_css_custom'] = $this->load->view('template/assets/css_custom', '', TRUE);
        $data['_def_js_files'] = $this->load->view('template/assets/js_files', '', TRUE);
        $data['_switcher_settings'] = $this->load->view('template/elements/switcher', '', TRUE);        
        $data['_side_bar_navigation'] = $this->load->view('template/elements/side_bar_navigation', '', TRUE);
        $data['_top_navigation'] = $this->load->view('template/elements/top_navigation', '', TRUE);
        $data['_rights'] = $this->load->view('template/elements/rights', '', TRUE);
        $data['loader'] = $this->load->view('template/elements/loader', '', TRUE);
        $data['loaderscript'] = $this->load->view('template/elements/loaderscript', '', TRUE);
        $data['ref_emptype']=$this->RefEmploymentType_model->get_employmenttype_list($this->session->company_id);
        $data['ref_department']=$this->RefDepartment_model->get_department_list($this->session->company_id);
        $data['ref_position']=$this->RefPosition_model->get_position_list($this->session->company_id);
        $data['ref_branch']=$this->RefBranch_model->get_branch_list($this->session->company_id);
        $data['ref_section']=$this->RefSection_model->get_section_list($this->session->company_id);
        $data['ref_payfrequency']=$this->RefPayFrequency_model->get_payfrequency_list($this->session->company_id);
        $data['title'] = 'JCORE - Employee Management';
        $this->load->view('employee_view', $data);
    }

    function transaction($txn = null) {
        switch ($txn) {

            case 'list':
                    $response['data']=$this->Employee_model->get_employee_list($this->session->company_id);
                    echo json_encode($response);
            break;

            case 'create':

                function replaceCharsInNumber($num, $chars) {
                     return substr((string) $num, 0, -strlen($chars)) . $chars;
                }

                $m_employee = $this->Employee_model;
                $m_company_mngmnt = $this->CompanyManagement_model;

                $comp_info = $this->CompanyManagement_model->get_company_list($this->session->company_id);
                $no_of_employee = $comp_info[0]->no_of_employee;

                $count_act_emp = $this->Employee_model->count_active_employees($this->session->company_id);
                $no_of_active = count($count_act_emp);

                $is_active = $this->input->post('is_active', TRUE);

                if ($is_active == 0){
                    //BACKEND FORM VALIDATION AND SECURITY HELPER
                    $this->load->library('form_validation');
                    $this->load->helper('security');
                    $this->load->helper(array('form', 'url'));
                    $this->form_validation->set_rules('first_name', 'First Name', 'strip_tags|trim|xss_clean|callback_alpha_dash_space|required');
                    $this->form_validation->set_rules('last_name', 'Last Name', 'strip_tags|trim|xss_clean|callback_alpha_dash_space|required');
                    $this->form_validation->set_rules('employment_date', 'Employment Date', 'strip_tags|trim|xss_clean|required');

                    $this->form_validation->set_rules('ref_payfrequency_type_id', 'Pay Frequency Type', 'strip_tags|trim|xss_clean|required');

                    $this->form_validation->set_rules('hour_per_day', 'Hours Per Day', 'strip_tags|trim|xss_clean|required');
                    $this->form_validation->set_rules('salary_reg_rates', 'Salary Reg Rates', 'strip_tags|trim|xss_clean|required');
                    $this->form_validation->set_rules('sss', 'SSS Number', 'strip_tags|min_length[10]|max_length[10]|trim|xss_clean');
                    $this->form_validation->set_rules('phil_health', 'PhilHealth Number', 'strip_tags|min_length[12]|max_length[12]|trim|xss_clean|numeric');
                    $this->form_validation->set_rules('pag_ibig', 'Pag-Ibig Number', 'strip_tags|min_length[12]|max_length[12]|trim|xss_clean|numeric');
                    $this->form_validation->set_rules('tin', 'TIN Number', 'strip_tags|min_length[9]|max_length[9]|trim|xss_clean|numeric');

                    if ($this->form_validation->run() == TRUE)
                    {

                    $post_birthdate = $this->input->post('birthdate', TRUE);
                    $post_employment_date = $this->input->post('employment_date', TRUE);
                    $post_date_retired = $this->input->post('date_retired', TRUE);
                    $post_date_end = $this->input->post('date_end', TRUE);

                    if ($post_birthdate == ""){ $birthdate=""; }else{ $birthdate = date("Y-m-d", strtotime($post_birthdate)); }
                    if ($post_employment_date == ""){ $employment_date=""; }else{ $employment_date = date("Y-m-d", strtotime($post_employment_date)); }
                    if ($post_date_retired == ""){ $date_retired =""; }else{ $date_retired = date("Y-m-d", strtotime($post_date_retired)); }
                    if ($post_date_end == ""){ $date_end=""; }else{ $date_end = date("Y-m-d", strtotime($post_date_end)); }

                    $ref_payfrequency_type_id = $this->input->post('ref_payfrequency_type_id', TRUE);

                    $m_employee->image_name = $this->input->post('image_name', TRUE);
                    $m_employee->first_name = $this->input->post('first_name', TRUE);
                    $m_employee->middle_name = $this->input->post('middle_name', TRUE);
                    $m_employee->last_name = $this->input->post('last_name', TRUE);
                    $m_employee->address_one = $this->input->post('address_one', TRUE);
                    $m_employee->address_two = $this->input->post('address_two', TRUE);
                    $m_employee->zip_code = $this->input->post('zip_code', TRUE);
                    $m_employee->rdo_no = $this->input->post('rdo_no', TRUE);
                    $m_employee->email_address = $this->input->post('email_address', TRUE);
                    $m_employee->cell_number = $this->input->post('cell_number', TRUE);
                    $m_employee->birthdate = $birthdate;
                    $m_employee->civil_status = $this->input->post('civil_status', TRUE);
                    $m_employee->gender = $this->input->post('gender', TRUE);
                    $m_employee->sss = $this->input->post('sss', TRUE);
                    $m_employee->phil_health = $this->input->post('phil_health', TRUE);
                    $m_employee->pag_ibig = $this->input->post('pag_ibig', TRUE);
                    $m_employee->tin = $this->input->post('tin', TRUE);
                    $m_employee->bank_account = $this->input->post('bank_account', TRUE);
                    $m_employee->bank_account_isprocess = $this->input->post('bank_account_isprocess', TRUE);
                    $m_employee->exmpt_sss = $this->input->post('exmpt_sss', TRUE);
                    $m_employee->exmpt_pagibig = $this->input->post('exmpt_pagibig', TRUE);
                    $m_employee->exmpt_philhealth = $this->input->post('exmpt_philhealth', TRUE);
                    $m_employee->employment_date = $employment_date;
                    $m_employee->ref_employment_type_id = $this->input->post('ref_employment_type_id', TRUE);
                    $m_employee->ref_branch_id = $this->input->post('ref_branch_id', TRUE);
                    $m_employee->company_id = $this->session->company_id;
                    $m_employee->ref_department_id = $this->input->post('ref_department_id', TRUE);
                    $m_employee->ref_position_id = $this->input->post('ref_position_id', TRUE);
                    $m_employee->ref_section_id = $this->input->post('ref_section_id', TRUE);
                    $m_employee->ref_payfrequency_type_id = $ref_payfrequency_type_id;
                    $m_employee->hour_per_day = $this->get_numeric_value($this->input->post('hour_per_day', TRUE));
                    $m_employee->salary_reg_rates = $this->get_numeric_value($this->input->post('salary_reg_rates', TRUE));

                    $salaried_regular_salary = $this->get_numeric_value($this->input->post('salary_reg_rates', TRUE));
                    $salaried_monthly_salary =  $salaried_regular_salary * 2;
                        
                    if ($ref_payfrequency_type_id == 2){
                        $m_employee->monthly_based_salary = $this->get_numeric_value($this->input->post('salary_reg_rates', TRUE));
                    }
                    else if ($ref_payfrequency_type_id == 5){
                        $m_employee->monthly_based_salary = $this->get_numeric_value($salaried_monthly_salary);
                    }
                    else{
                        $m_employee->monthly_based_salary = $this->get_numeric_value($this->input->post('monthly_based_salary', TRUE));
                    }

                    $m_employee->per_day_pay = $this->get_numeric_value($this->input->post('per_day_pay', TRUE));
                    $m_employee->per_hour_pay = $this->get_numeric_value($this->input->post('per_hour_pay', TRUE));
                    $m_employee->allowance = $this->get_numeric_value($this->input->post('allowance', TRUE));
                    $m_employee->date_retired = $date_retired;
                    $m_employee->date_end = $date_end;
                    $m_employee->clearance_reason = $this->input->post('clearance_reason', TRUE);
                    $m_employee->is_active = $this->input->post('is_active', TRUE);
                    $m_employee->is_retired = $this->input->post('is_retired', TRUE);
                    $m_employee->date_created = date("Y-m-d h:i:s");
                    $m_employee->created_by = $this->session->user_id;
                    $m_employee->save();

                    $employee_id = $m_employee->last_insert_id();
                    $ecode = $employee_id.mt_rand(1000,9999);
                    $m_employee->ecode = $ecode;
                    $m_employee->modify($employee_id);

                    $response['title'] = 'Success!';
                    $response['stat'] = 'success';
                    $response['msg'] = 'Employee information successfully created.';

                    $response['row_added'] = $this->Employee_model->get_employee_list($this->session->company_id,$employee_id);
                    }
                    else
                    {
                        $response['title'] = 'Error!';
                        $response['stat'] = 'error';
                        $response['msg'] = validation_errors();
                    }
                }else{
                    if ($no_of_employee > $no_of_active){
                        //BACKEND FORM VALIDATION AND SECURITY HELPER
                        $this->load->library('form_validation');
                        $this->load->helper('security');
                        $this->load->helper(array('form', 'url'));
                        $this->form_validation->set_rules('first_name', 'First Name', 'strip_tags|trim|xss_clean|callback_alpha_dash_space|required');
                        $this->form_validation->set_rules('last_name', 'Last Name', 'strip_tags|trim|xss_clean|callback_alpha_dash_space|required');
                        $this->form_validation->set_rules('employment_date', 'Employment Date', 'strip_tags|trim|xss_clean|required');
                        $this->form_validation->set_rules('ref_payfrequency_type_id', 'Pay Frequency Type', 'strip_tags|trim|xss_clean|required');
                        $this->form_validation->set_rules('hour_per_day', 'Hours Per Day', 'strip_tags|trim|xss_clean|required');
                        $this->form_validation->set_rules('salary_reg_rates', 'Salary Reg Rates', 'strip_tags|trim|xss_clean|required');
                        $this->form_validation->set_rules('sss', 'SSS Number', 'strip_tags|min_length[10]|max_length[10]|trim|xss_clean');
                        $this->form_validation->set_rules('phil_health', 'PhilHealth Number', 'strip_tags|min_length[12]|max_length[12]|trim|xss_clean|numeric');
                        $this->form_validation->set_rules('pag_ibig', 'Pag-Ibig Number', 'strip_tags|min_length[12]|max_length[12]|trim|xss_clean|numeric');
                        $this->form_validation->set_rules('tin', 'TIN Number', 'strip_tags|min_length[9]|max_length[9]|trim|xss_clean|numeric');

                        if ($this->form_validation->run() == TRUE)
                        {

                        $post_birthdate = $this->input->post('birthdate', TRUE);
                        $post_employment_date = $this->input->post('employment_date', TRUE);
                        $post_date_retired = $this->input->post('date_retired', TRUE);
                        $post_date_end = $this->input->post('date_end', TRUE);

                        if ($post_birthdate == ""){ $birthdate=""; }else{ $birthdate = date("Y-m-d", strtotime($post_birthdate)); }
                        if ($post_employment_date == ""){ $employment_date=""; }else{ $employment_date = date("Y-m-d", strtotime($post_employment_date)); }
                        if ($post_date_retired == ""){ $date_retired =""; }else{ $date_retired = date("Y-m-d", strtotime($post_date_retired)); }
                        if ($post_date_end == ""){ $date_end=""; }else{ $date_end = date("Y-m-d", strtotime($post_date_end)); }

                        $ref_payfrequency_type_id = $this->input->post('ref_payfrequency_type_id', TRUE);

                        $m_employee->image_name = $this->input->post('image_name', TRUE);
                        $m_employee->first_name = $this->input->post('first_name', TRUE);
                        $m_employee->middle_name = $this->input->post('middle_name', TRUE);
                        $m_employee->last_name = $this->input->post('last_name', TRUE);
                        $m_employee->address_one = $this->input->post('address_one', TRUE);
                        $m_employee->address_two = $this->input->post('address_two', TRUE);
                        $m_employee->zip_code = $this->input->post('zip_code', TRUE);
                        $m_employee->rdo_no = $this->input->post('rdo_no', TRUE);
                        $m_employee->email_address = $this->input->post('email_address', TRUE);
                        $m_employee->cell_number = $this->input->post('cell_number', TRUE);
                        $m_employee->birthdate = $birthdate;
                        $m_employee->civil_status = $this->input->post('civil_status', TRUE);
                        $m_employee->gender = $this->input->post('gender', TRUE);
                        $m_employee->sss = $this->input->post('sss', TRUE);
                        $m_employee->phil_health = $this->input->post('phil_health', TRUE);
                        $m_employee->pag_ibig = $this->input->post('pag_ibig', TRUE);
                        $m_employee->tin = $this->input->post('tin', TRUE);
                        $m_employee->bank_account = $this->input->post('bank_account', TRUE);
                        $m_employee->bank_account_isprocess = $this->input->post('bank_account_isprocess', TRUE);
                        $m_employee->exmpt_sss = $this->input->post('exmpt_sss', TRUE);
                        $m_employee->exmpt_pagibig = $this->input->post('exmpt_pagibig', TRUE);
                        $m_employee->exmpt_philhealth = $this->input->post('exmpt_philhealth', TRUE);
                        $m_employee->employment_date = $employment_date;
                        $m_employee->ref_employment_type_id = $this->input->post('ref_employment_type_id', TRUE);
                        $m_employee->ref_branch_id = $this->input->post('ref_branch_id', TRUE);
                        $m_employee->company_id = $this->session->company_id;
                        $m_employee->ref_department_id = $this->input->post('ref_department_id', TRUE);
                        $m_employee->ref_position_id = $this->input->post('ref_position_id', TRUE);
                        $m_employee->ref_section_id = $this->input->post('ref_section_id', TRUE);
                        $m_employee->ref_payfrequency_type_id = $ref_payfrequency_type_id;
                        $m_employee->hour_per_day = $this->get_numeric_value($this->input->post('hour_per_day', TRUE));
                        $m_employee->salary_reg_rates = $this->get_numeric_value($this->input->post('salary_reg_rates', TRUE));
                        $salaried_regular_salary = $this->get_numeric_value($this->input->post('salary_reg_rates', TRUE));
                        $salaried_monthly_salary =  $salaried_regular_salary * 2;
                        if ($ref_payfrequency_type_id == 2){
                            $m_employee->monthly_based_salary = $this->get_numeric_value($this->input->post('salary_reg_rates', TRUE));
                        }
                        else if ($ref_payfrequency_type_id == 5){
                            $m_employee->monthly_based_salary = $this->get_numeric_value($salaried_monthly_salary);
                        }
                        else{
                            $m_employee->monthly_based_salary = $this->get_numeric_value($this->input->post('monthly_based_salary', TRUE));
                        }

                        $m_employee->per_day_pay = $this->get_numeric_value($this->input->post('per_day_pay', TRUE));
                        $m_employee->per_hour_pay = $this->get_numeric_value($this->input->post('per_hour_pay', TRUE));
                        $m_employee->allowance = $this->get_numeric_value($this->input->post('allowance', TRUE));
                        $m_employee->date_retired = $date_retired;
                        $m_employee->date_end = $date_end;
                        $m_employee->clearance_reason = $this->input->post('clearance_reason', TRUE);
                        $m_employee->is_active = $this->input->post('is_active', TRUE);
                        $m_employee->is_retired = $this->input->post('is_retired', TRUE);
                        $m_employee->date_created = date("Y-m-d h:i:s");
                        $m_employee->created_by = $this->session->user_id;
                        $m_employee->save();

                        $employee_id = $m_employee->last_insert_id();
                        $ecode = $employee_id.mt_rand(1000,9999);
                        $m_employee->ecode = $ecode;
                        $m_employee->modify($employee_id);

                        $response['title'] = 'Success!';
                        $response['stat'] = 'success';
                        $response['msg'] = 'Employee information successfully created.';

                        $response['row_added'] = $this->Employee_model->get_employee_list($this->session->company_id,$employee_id);
                        }
                        else
                        {
                            $response['title'] = 'Error!';
                            $response['stat'] = 'error';
                            $response['msg'] = validation_errors();
                        }

                    }else{ 
                            $response['title'] = 'Error!';
                            $response['stat'] = 'error';
                            $response['msg'] = 'Company have the maximum no of active Employees.';
                    }
                }

                echo json_encode($response);

            break;

            case 'delete':
                $m_employee=$this->Employee_model;

                $employee_id=$this->input->post('employee_id',TRUE);

                $m_employee->is_deleted=1;
                $m_employee->date_deleted = date("Y-m-d");
                $m_employee->deleted_by = $this->session->user_id;
                if($m_employee->modify($employee_id)){
                    $response['title']='Success!';
                    $response['stat']='success';
                    $response['msg']='Employee information successfully deleted.';

                    echo json_encode($response);
                }

            break;

            case 'update':
                $m_employee=$this->Employee_model;
                $m_company_mngmnt = $this->CompanyManagement_model;
                $employee_id=$this->input->post('employee_id',TRUE);

                $comp_info = $this->CompanyManagement_model->get_company_list($this->session->company_id);
                $no_of_employee = $comp_info[0]->no_of_employee;

                $count_act_emp = $this->Employee_model->count_active_employees($this->session->company_id,$employee_id);
                $no_of_active = count($count_act_emp);

                $is_active = $this->input->post('is_active', TRUE);

                if ($is_active == 0){
                    //BACKEND FORM VALIDATION AND SECURITY HELPER
                    $this->load->library('form_validation');
                    $this->load->helper('security');
                    $this->form_validation->set_rules('first_name', 'First Name', 'strip_tags|trim|xss_clean|callback_alpha_dash_space|required');
                    $this->form_validation->set_rules('last_name', 'Last Name', 'strip_tags|trim|xss_clean|callback_alpha_dash_space|required');
                    $this->form_validation->set_rules('employment_date', 'Employment Date', 'strip_tags|trim|xss_clean|required');
                    $this->form_validation->set_rules('ref_payfrequency_type_id', 'Pay Frequency Type', 'strip_tags|trim|xss_clean|required');
                    $this->form_validation->set_rules('hour_per_day', 'Hours Per Day', 'strip_tags|trim|xss_clean|required');
                    $this->form_validation->set_rules('salary_reg_rates', 'Salary Reg Rates', 'strip_tags|trim|xss_clean|required');

                    $this->form_validation->set_rules('sss', 'SSS Number', 'strip_tags|min_length[10]|max_length[10]|trim|xss_clean');
                    $this->form_validation->set_rules('phil_health', 'PhilHealth Number', 'strip_tags|min_length[12]|max_length[12]|trim|xss_clean|numeric');
                    $this->form_validation->set_rules('pag_ibig', 'Pag-Ibig Number', 'strip_tags|min_length[12]|max_length[12]|trim|xss_clean|numeric');
                    $this->form_validation->set_rules('tin', 'TIN Number', 'strip_tags|min_length[9]|max_length[9]|trim|xss_clean|numeric');

                    if ($this->form_validation->run() == TRUE)
                    {

                    $post_birthdate = $this->input->post('birthdate', TRUE);
                    $post_employment_date = $this->input->post('employment_date', TRUE);
                    $post_date_retired = $this->input->post('date_retired', TRUE);
                    $post_date_end = $this->input->post('date_end', TRUE);

                    if ($post_birthdate == ""){ $birthdate=""; }else{ $birthdate = date("Y-m-d", strtotime($post_birthdate)); }
                    if ($post_employment_date == ""){ $employment_date=""; }else{ $employment_date = date("Y-m-d", strtotime($post_employment_date)); }
                    if ($post_date_retired == ""){ $date_retired =""; }else{ $date_retired = date("Y-m-d", strtotime($post_date_retired)); }
                    if ($post_date_end == ""){ $date_end=""; }else{ $date_end = date("Y-m-d", strtotime($post_date_end)); }

                    $ref_payfrequency_type_id =  $this->input->post('ref_payfrequency_type_id', TRUE);

                    $m_employee->image_name = $this->input->post('image_name', TRUE);
                    $m_employee->first_name = $this->input->post('first_name', TRUE);
                    $m_employee->middle_name = $this->input->post('middle_name', TRUE);
                    $m_employee->last_name = $this->input->post('last_name', TRUE);
                    $m_employee->address_one = $this->input->post('address_one', TRUE);
                    $m_employee->address_two = $this->input->post('address_two', TRUE);
                    $m_employee->zip_code = $this->input->post('zip_code', TRUE);
                    $m_employee->rdo_no = $this->input->post('rdo_no', TRUE);
                    $m_employee->email_address = $this->input->post('email_address', TRUE);
                    $m_employee->cell_number = $this->input->post('cell_number', TRUE);
                    $m_employee->birthdate = $birthdate;
                    $m_employee->civil_status = $this->input->post('civil_status', TRUE);
                    $m_employee->gender = $this->input->post('gender', TRUE);
                    $m_employee->sss = $this->input->post('sss', TRUE);
                    $m_employee->phil_health = $this->input->post('phil_health', TRUE);
                    $m_employee->pag_ibig = $this->input->post('pag_ibig', TRUE);
                    $m_employee->tin = $this->input->post('tin', TRUE);
                    $m_employee->bank_account = $this->input->post('bank_account', TRUE);
                    $m_employee->bank_account_isprocess = $this->input->post('bank_account_isprocess', TRUE);
                    $m_employee->exmpt_sss = $this->input->post('exmpt_sss', TRUE);
                    $m_employee->exmpt_pagibig = $this->input->post('exmpt_pagibig', TRUE);
                    $m_employee->exmpt_philhealth = $this->input->post('exmpt_philhealth', TRUE);
                    $m_employee->employment_date = $employment_date;
                    $m_employee->ref_employment_type_id = $this->input->post('ref_employment_type_id', TRUE);
                    $m_employee->ref_branch_id = $this->input->post('ref_branch_id', TRUE);
                    $m_employee->ref_department_id = $this->input->post('ref_department_id', TRUE);
                    $m_employee->ref_position_id = $this->input->post('ref_position_id', TRUE);
                    $m_employee->ref_section_id = $this->input->post('ref_section_id', TRUE);
                    $m_employee->ref_payfrequency_type_id = $ref_payfrequency_type_id;
                    $m_employee->hour_per_day = $this->get_numeric_value($this->input->post('hour_per_day', TRUE));
                    $m_employee->salary_reg_rates = $this->get_numeric_value($this->input->post('salary_reg_rates', TRUE));

                    $salaried_regular_salary = $this->get_numeric_value($this->input->post('salary_reg_rates', TRUE));
                    $salaried_monthly_salary =  $salaried_regular_salary * 2;

                    if ($ref_payfrequency_type_id == 2){
                        $m_employee->monthly_based_salary = $this->get_numeric_value($this->input->post('salary_reg_rates', TRUE));
                    }
                    else if ($ref_payfrequency_type_id == 5){
                        $m_employee->monthly_based_salary = $this->get_numeric_value($salaried_monthly_salary);
                    }
                    else{
                        $m_employee->monthly_based_salary = $this->get_numeric_value($this->input->post('monthly_based_salary', TRUE));
                    }

                    $m_employee->per_day_pay = $this->get_numeric_value($this->input->post('per_day_pay', TRUE));
                    $m_employee->per_hour_pay = $this->get_numeric_value($this->input->post('per_hour_pay', TRUE));
                    $m_employee->allowance = $this->get_numeric_value($this->input->post('allowance', TRUE));
                    $m_employee->date_retired = $date_retired;
                    $m_employee->date_end = $date_end;
                    $m_employee->clearance_reason = $this->input->post('clearance_reason', TRUE);
                    $m_employee->is_active = $this->input->post('is_active', TRUE);
                    $m_employee->is_retired = $this->input->post('is_retired', TRUE);
                    $m_employee->date_modified = date("Y-m-d h:i:s");
                    $m_employee->modified_by = $this->session->user_id;
                    $m_employee->modify($employee_id);

                    $response['title']='Success';
                    $response['stat']='success';
                    $response['msg']='Employee information successfully updated.';
                    $response['row_updated']=$this->Employee_model->get_employee_list($this->session->company_id,$employee_id);

                    }
                    else
                    {
                        $response['title'] = 'Error!';
                        $response['stat'] = 'error';
                        $response['msg'] = validation_errors();
                    }
                }else{
                    if ($no_of_employee > $no_of_active){

                        //BACKEND FORM VALIDATION AND SECURITY HELPER
                        $this->load->library('form_validation');
                        $this->load->helper('security');
                        $this->form_validation->set_rules('first_name', 'First Name', 'strip_tags|trim|xss_clean|callback_alpha_dash_space|required');
                        $this->form_validation->set_rules('last_name', 'Last Name', 'strip_tags|trim|xss_clean|callback_alpha_dash_space|required');
                        $this->form_validation->set_rules('employment_date', 'Employment Date', 'strip_tags|trim|xss_clean|required');
                        $this->form_validation->set_rules('ref_payfrequency_type_id', 'Pay Frequency Type', 'strip_tags|trim|xss_clean|required');
                        $this->form_validation->set_rules('hour_per_day', 'Hours Per Day', 'strip_tags|trim|xss_clean|required');
                        $this->form_validation->set_rules('salary_reg_rates', 'Salary Reg Rates', 'strip_tags|trim|xss_clean|required');

                        $this->form_validation->set_rules('sss', 'SSS Number', 'strip_tags|min_length[10]|max_length[10]|trim|xss_clean');
                        $this->form_validation->set_rules('phil_health', 'PhilHealth Number', 'strip_tags|min_length[12]|max_length[12]|trim|xss_clean|numeric');
                        $this->form_validation->set_rules('pag_ibig', 'Pag-Ibig Number', 'strip_tags|min_length[12]|max_length[12]|trim|xss_clean|numeric');
                        $this->form_validation->set_rules('tin', 'TIN Number', 'strip_tags|min_length[9]|max_length[9]|trim|xss_clean|numeric');

                        if ($this->form_validation->run() == TRUE)
                        {
                        $employee_id=$this->input->post('employee_id',TRUE);

                        $post_birthdate = $this->input->post('birthdate', TRUE);
                        $post_employment_date = $this->input->post('employment_date', TRUE);
                        $post_date_retired = $this->input->post('date_retired', TRUE);
                        $post_date_end = $this->input->post('date_end', TRUE);

                        if ($post_birthdate == ""){ $birthdate=""; }else{ $birthdate = date("Y-m-d", strtotime($post_birthdate)); }
                        if ($post_employment_date == ""){ $employment_date=""; }else{ $employment_date = date("Y-m-d", strtotime($post_employment_date)); }
                        if ($post_date_retired == ""){ $date_retired =""; }else{ $date_retired = date("Y-m-d", strtotime($post_date_retired)); }
                        if ($post_date_end == ""){ $date_end=""; }else{ $date_end = date("Y-m-d", strtotime($post_date_end)); }

                        $ref_payfrequency_type_id =  $this->input->post('ref_payfrequency_type_id', TRUE);

                        $m_employee->image_name = $this->input->post('image_name', TRUE);
                        $m_employee->first_name = $this->input->post('first_name', TRUE);
                        $m_employee->middle_name = $this->input->post('middle_name', TRUE);
                        $m_employee->last_name = $this->input->post('last_name', TRUE);
                        $m_employee->address_one = $this->input->post('address_one', TRUE);
                        $m_employee->address_two = $this->input->post('address_two', TRUE);
                        $m_employee->zip_code = $this->input->post('zip_code', TRUE);
                        $m_employee->rdo_no = $this->input->post('rdo_no', TRUE);
                        $m_employee->email_address = $this->input->post('email_address', TRUE);
                        $m_employee->cell_number = $this->input->post('cell_number', TRUE);
                        $m_employee->birthdate = $birthdate;
                        $m_employee->civil_status = $this->input->post('civil_status', TRUE);
                        $m_employee->gender = $this->input->post('gender', TRUE);
                        $m_employee->sss = $this->input->post('sss', TRUE);
                        $m_employee->phil_health = $this->input->post('phil_health', TRUE);
                        $m_employee->pag_ibig = $this->input->post('pag_ibig', TRUE);
                        $m_employee->tin = $this->input->post('tin', TRUE);
                        $m_employee->bank_account = $this->input->post('bank_account', TRUE);
                        $m_employee->bank_account_isprocess = $this->input->post('bank_account_isprocess', TRUE);
                        $m_employee->exmpt_sss = $this->input->post('exmpt_sss', TRUE);
                        $m_employee->exmpt_pagibig = $this->input->post('exmpt_pagibig', TRUE);
                        $m_employee->exmpt_philhealth = $this->input->post('exmpt_philhealth', TRUE);
                        $m_employee->employment_date = $employment_date;
                        $m_employee->ref_employment_type_id = $this->input->post('ref_employment_type_id', TRUE);
                        $m_employee->ref_branch_id = $this->input->post('ref_branch_id', TRUE);
                        $m_employee->ref_department_id = $this->input->post('ref_department_id', TRUE);
                        $m_employee->ref_position_id = $this->input->post('ref_position_id', TRUE);
                        $m_employee->ref_section_id = $this->input->post('ref_section_id', TRUE);
                        $m_employee->ref_payfrequency_type_id = $ref_payfrequency_type_id;
                        $m_employee->hour_per_day = $this->get_numeric_value($this->input->post('hour_per_day', TRUE));
                        $m_employee->salary_reg_rates = $this->get_numeric_value($this->input->post('salary_reg_rates', TRUE));

                        $salaried_regular_salary = $this->get_numeric_value($this->input->post('salary_reg_rates', TRUE));
                        $salaried_monthly_salary =  $salaried_regular_salary * 2;


                        if ($ref_payfrequency_type_id == 2){
                            $m_employee->monthly_based_salary = $this->get_numeric_value($this->input->post('salary_reg_rates', TRUE));
                        }
                        else if ($ref_payfrequency_type_id == 5){
                            $m_employee->monthly_based_salary = $this->get_numeric_value($salaried_monthly_salary);
                        }
                        else{
                            $m_employee->monthly_based_salary = $this->get_numeric_value($this->input->post('monthly_based_salary', TRUE));
                        }

                        $m_employee->per_day_pay = $this->get_numeric_value($this->input->post('per_day_pay', TRUE));
                        $m_employee->per_hour_pay = $this->get_numeric_value($this->input->post('per_hour_pay', TRUE));
                        $m_employee->allowance = $this->get_numeric_value($this->input->post('allowance', TRUE));
                        $m_employee->date_retired = $date_retired;
                        $m_employee->date_end = $date_end;
                        $m_employee->clearance_reason = $this->input->post('clearance_reason', TRUE);
                        $m_employee->is_active = $this->input->post('is_active', TRUE);
                        $m_employee->is_retired = $this->input->post('is_retired', TRUE);
                        $m_employee->date_modified = date("Y-m-d h:i:s");
                        $m_employee->modified_by = $this->session->user_id;
                        $m_employee->modify($employee_id);

                        $response['title']='Success';
                        $response['stat']='success';
                        $response['msg']='Employee information successfully updated.';
                        $response['row_updated']=$this->Employee_model->get_employee_list($this->session->company_id,$employee_id);

                        }
                        else
                        {
                            $response['title'] = 'Error!';
                            $response['stat'] = 'error';
                            $response['msg'] = validation_errors();
                        }
                    }else{ 
                            $response['title'] = 'Error!';
                            $response['stat'] = 'error';
                            $response['msg'] = 'Company have the maximum no of active Employees.';
                    }
                }

                echo json_encode($response);
            break;

            case 'upload':
                $allowed = array('png', 'jpg', 'jpeg','bmp');

                $data=array();
                $files=array();
                $directory='assets/img/employee/';

                foreach($_FILES as $file){

                    $server_file_name=uniqid('');
                    $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
                    $file_path=$directory.$server_file_name.'.'.$extension;
                    $orig_file_name=$file['name'];

                    if(!in_array(strtolower($extension), $allowed)){
                        $response['title']='Invalid!';
                        $response['stat']='error';
                        $response['msg']='Image is invalid. Please select a valid photo!';
                        die(json_encode($response));
                    }

                    if(move_uploaded_file($file['tmp_name'],$file_path)){
                        $response['title']='Success!';
                        $response['stat']='success';
                        $response['msg']='Image successfully uploaded.';
                        $response['path']=$file_path;
                        echo json_encode($response);
                    }
                }
                break;

                case 'export-employee-masterlist':
                $excel=$this->excel;
                $m_employee=$this->Employee_model;



                $excel->setActiveSheetIndex(0);


                //name the worksheet
                $excel->getActiveSheet()->setTitle("Employee Masterlist");

                $excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE);
                $excel->getActiveSheet()->setCellValue('A1',"Employee Masterlist")
                    ->setCellValue('A2',"Exported By : ".$this->session->user_fullname)
                    ->setCellValue('A3',"Date Exported : ".date("Y-m-d h:i:s"));


                //create headers
                $excel->getActiveSheet()->getStyle('A4:U4')->getFont()->setBold(TRUE);
                $excel->getActiveSheet()->setCellValue('A4', 'Fullname')
                                        ->setCellValue('B4', 'Ecode')
                                        ->setCellValue('C4', 'Birthdate')
                                        ->setCellValue('D4', 'Civil Status')
                                        ->setCellValue('E4', 'Gender')
                                        ->setCellValue('F4', 'SSS')
                                        ->setCellValue('G4', 'Philhealth')
                                        ->setCellValue('H4', 'Pag-Ibig')
                                        ->setCellValue('I4', 'TIN')
                                        ->setCellValue('J4', 'Bank Account #')
                                        ->setCellValue('K4', 'Employee Type')
                                        ->setCellValue('L4', 'Department')
                                        ->setCellValue('M4', 'Position')
                                        ->setCellValue('N4', 'Section')
                                        ->setCellValue('O4', 'Pay Frequency Type')
                                        ->setCellValue('P4', 'Employment Date')
                                        ->setCellValue('Q4', 'Address1')
                                        ->setCellValue('R4', 'Address2')
                                        ->setCellValue('S4', 'Email Address')
                                        ->setCellValue('T4', 'Phone No')
                                        ->setCellValue('U4', 'Retired?');

                $transaction=$employee_info=$m_employee->get_list(
                        array('employee_list.is_deleted'=>FALSE),
                        ' employee_list.*,CONCAT(employee_list.first_name," ",middle_name," ",employee_list.last_name) AS full_name,ref_employment_type.employment_type,ref_department.department,ref_position.position,ref_section.section,ref_payfrequency_type.pay_frequency_type,(CASE employee_list.is_retired WHEN 1 THEN "YES" ELSE "NO" END) AS retired',
                        array(
                                array('ref_employment_type','ref_employment_type.ref_employment_type_id = employee_list.ref_employment_type_id','left'),
                                array('ref_department','ref_department.ref_department_id = employee_list.ref_department_id','left'),
                                array('ref_position','ref_position.ref_position_id = employee_list.ref_position_id','left'),
                                array('ref_section','ref_section.ref_section_id = employee_list.ref_section_id','left'),
                                array('ref_payfrequency_type','ref_payfrequency_type.ref_payfrequency_type_id = employee_list.ref_payfrequency_type_id','left'),

                                ),
                                'employee_list.last_name ASC'
                        );
                $rows=array();
                foreach($transaction as $x){
                    $rows[]=array(
                        $x->full_name,
                        $x->ecode,
                        $x->birthdate,
                        $x->civil_status,
                        $x->gender,
                        $x->sss,
                        $x->phil_health,
                        $x->pag_ibig,
                        $x->tin,
                        $x->bank_account,
                        $x->employment_type,
                        $x->department,
                        $x->position,
                        $x->section,
                        $x->pay_frequency_type,
                        $x->employment_date,
                        $x->address_one,
                        $x->address_two,
                        $x->email_address,
                        $x->cell_number,
                        $x->retired
                    );
                }


                $excel->getActiveSheet()->getStyle('A4:U4')->getFill()
                    ->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('27ae60');

                $styleArray = array(
                    'font'  => array(
                        'bold'  => true,
                        'color' => array('rgb' => 'FFFFF'),
                        'size'  => 10,
                        'name'  => 'Tahoma'
                    ));

                $excel->getActiveSheet()->getStyle('A4:U4')->applyFromArray($styleArray);

                $excel->getActiveSheet()->fromArray($rows,NULL,'A5');
                //autofit column
                foreach(range('A','U') as $columnID)
                {
                    $excel->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(TRUE);
                }

                $excel->getActiveSheet()->getColumnDimension('A')->setAutoSize(TRUE);

                // Redirect output to a client’s web browser (Excel2007)
                ob_end_clean();
                header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
                header('Content-Disposition: attachment;filename='."Employee Masterlist.xlsx".'');
                header('Cache-Control: max-age=0');
                // If you're serving to IE 9, then the following may be needed
                header('Cache-Control: max-age=1');

                // If you're serving to IE over SSL, then the following may be needed
                header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
                header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
                header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
                header ('Pragma: public'); // HTTP/1.0

                $objWriter = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
                $objWriter->save('php://output');

                break;

        }
    }

function alpha_dash_space($first_name){
if (! preg_match('/^[a-zA-Z\s]+$/', $first_name)) {
$this->form_validation->set_message('alpha_dash_space', 'The %s field may only contains alpha characters & White spaces Only!');
return FALSE;
} else {
return TRUE;
}
}
function email_check($email_address)
{

    if (valid_email('@gmail.com') !== false) return true;
    if (valid_email('@yahoo.com') !== false) return true;

        $this->form_validation->set_message('email_address', 'Please provide an acceptable email address.');
        return FALSE;

}

function numeric_wcomma ($str)
{
    return preg_match('/^[0-9,]+$/', $str);
}

}
