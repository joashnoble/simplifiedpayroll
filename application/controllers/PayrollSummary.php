<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PayrollSummary extends CORE_Controller
{

    function __construct() {
        parent::__construct('');
        $this->validate_session();
        $this->load->model('Employee_model');
        $this->load->model('RefBranch_model');
        $this->load->model('RefDepartment_model');
    }

    public function index() {
        $data['_def_css_files'] = $this->load->view('template/assets/css_files', '', TRUE);
        $data['_def_js_files'] = $this->load->view('template/assets/js_files', '', TRUE);
        $data['_switcher_settings'] = $this->load->view('template/elements/switcher', '', TRUE);
        $data['_side_bar_navigation'] = $this->load->view('template/elements/side_bar_navigation', '', TRUE);
        $data['_top_navigation'] = $this->load->view('template/elements/top_navigationforprocesspayroll', '', TRUE);
        $data['loader'] = $this->load->view('template/elements/loader', '', TRUE);
        $data['loaderscript'] = $this->load->view('template/elements/loaderscript', '', TRUE);
        $data['ref_branch']=$this->RefBranch_model->get_branch_list($this->session->company_id);
        $data['ref_department']=$this->RefDepartment_model->get_department_list($this->session->company_id);
        $data['title'] = 'JCORE - Payroll Register Summary';
        $this->load->view('payroll_register_summary_view', $data);
    }
}
