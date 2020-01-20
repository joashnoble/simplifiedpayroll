<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class EmployeeLedgers extends CORE_Controller
{

    function __construct() {
        parent::__construct('');
        $this->validate_session();
        // if($this->session->userdata('right_ledger_view') == 0 || $this->session->userdata('right_ledger_view') == null) {
        //     redirect('../Dashboard');
        // }
        $this->load->model('Employee_model');
        $this->load->model('RefLoan_model');

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
        $data['employee'] = $this->Employee_model->get_employee_list($this->session->company_id);
        $data['ref_loan'] = $this->RefLoan_model->get_ref_loan_list();
        $data['title'] = 'JCORE - Employee Ledgers';
        $this->load->view('employee_ledgers_view', $data);
    }
}
