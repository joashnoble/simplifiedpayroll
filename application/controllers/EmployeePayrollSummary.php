<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class EmployeePayrollSummary extends CORE_Controller
{

    function __construct() {
        parent::__construct('');
        $this->validate_session();
        if($this->session->userdata('right_payrollsummary_view') == 0 || $this->session->userdata('right_payrollsummary_view') == null) {
            redirect('../Dashboard');
        }
        $this->load->model('Employee_model');
        $this->load->model('RefPayPeriod_model');
        $this->load->model('RefBranch_model');
        $this->load->model('RefDepartment_model');

    }
    public function index() {
        $data['_def_css_files'] = $this->load->view('template/assets/css_files', '', TRUE);
        $data['_def_css_custom'] = $this->load->view('template/assets/css_custom', '', TRUE);
        $data['_def_js_files'] = $this->load->view('template/assets/js_files', '', TRUE);
        $data['_switcher_settings'] = $this->load->view('template/elements/switcher', '', TRUE);
        $data['_side_bar_navigation'] = $this->load->view('template/elements/side_bar_navigation', '', TRUE);
        $data['_top_navigation'] = $this->load->view('template/elements/top_navigation', '', TRUE);
        $data['loader'] = $this->load->view('template/elements/loader', '', TRUE);
        $data['loaderscript'] = $this->load->view('template/elements/loaderscript', '', TRUE);
        $data['_rights'] = $this->load->view('template/elements/rights', '', TRUE);
        $data['branch'] = $this->RefBranch_model->get_branch_list($this->session->company_id);
        $data['department'] = $this->RefDepartment_model->get_department_list($this->session->company_id);
        $data['period'] = $this->RefPayPeriod_model->getpayperiod($this->session->company_id);
        $data['title'] = 'JCORE - Employee Payroll Summary';
        $this->load->view('employee_payroll_summary_view', $data);
    }
}
