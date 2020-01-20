<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class RefLoan extends CORE_Controller
{
    function __construct() {
        parent::__construct('');
        if($this->session->userdata('user_id') == FALSE) {
            redirect('../login');
        } 
        if($this->session->userdata('right_loandeduction_view') == 0 || $this->session->userdata('right_loandeduction_view') == null) {
            redirect('../Dashboard');
        }

        $this->validate_session();
        $this->load->model('Employee_model');
        $this->load->model('Loan_list_model');
        $this->load->model('RefLoan_model');

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
        $data['employee'] = $this->Employee_model->get_emp_loan_list($this->session->company_id);
        $data['ref_loan'] = $this->RefLoan_model->get_list(array('is_deleted'=>FALSE));
        $data['title'] = 'JCORE - Loan list';
        $this->load->view('ref_loan_view', $data);
    }

    function transaction($txn = null) {
        switch ($txn) {
            case 'list':
                $response['data']=$this->Loan_list_model->get_loan_list($this->session->company_id);
                echo json_encode($response);
            break;

            case 'create':
                $m_loan_list = $this->Loan_list_model;

                $company_id = $this->session->company_id;
                $ref_loan_id = $this->input->post('ref_loan_id', TRUE);
                $employee_id = $this->input->post('employee', TRUE);

                $chck_loan = $m_loan_list->chck_loan($company_id,$ref_loan_id,$employee_id);
                $count_loan = count($chck_loan);

                if ($count_loan <= 0){

                    $this->load->library('form_validation');
                    $this->load->helper('security');

                    $this->form_validation->set_rules('employee', 'Employee', 'strip_tags|xss_clean|required');  
                    $this->form_validation->set_rules('ref_loan_id', 'Loan Type', 'strip_tags|xss_clean|required');
                    $this->form_validation->set_rules('total_loan', 'Total Loan', 'strip_tags|xss_clean|required');  
                    $this->form_validation->set_rules('deduction_amt', 'Deduction Amount', 'strip_tags|xss_clean|required');       

                    if ($this->form_validation->run() == TRUE) 
                    {            
                        $m_loan_list->ref_loan_id = $ref_loan_id;
                        $m_loan_list->employee_id = $employee_id;
                        $m_loan_list->total_loan = $this->get_numeric_value($this->input->post('total_loan', TRUE));
                        $m_loan_list->deduction_amt = $this->get_numeric_value($this->input->post('deduction_amt', TRUE));
                        $m_loan_list->balance = $this->get_numeric_value($this->input->post('balance', TRUE));
                        $m_loan_list->f1 = $this->input->post('f1', TRUE);
                        $m_loan_list->f2 = $this->input->post('f2', TRUE);
                        $m_loan_list->f3 = $this->input->post('f3', TRUE);
                        $m_loan_list->f4 = $this->input->post('f4', TRUE);
                        $m_loan_list->f5 = $this->input->post('f5', TRUE);
                        $m_loan_list->all = $this->input->post('all', TRUE);
                        $m_loan_list->date_created = date("Y-m-d H:i:s");
                        $m_loan_list->created_by = $this->session->user_id;
                        $m_loan_list->company_id = $this->session->company_id;
                        $m_loan_list->save();
                        $loan_id = $m_loan_list->last_insert_id();
                        $response['title'] = 'Success!';
                        $response['stat'] = 'success';
                        $response['msg'] = 'Deduction successfully created.';
                        $response['row_added'] = $this->Loan_list_model->get_loan_list($this->session->company_id,$loan_id);
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
                        $response['msg'] = 'Loan/Deduction already Exist.';
                }
               
                echo json_encode($response);
            break;

            case 'update':
                $m_loan_list = $this->Loan_list_model;

                $company_id = $this->session->company_id;
                $ref_loan_id = $this->input->post('ref_loan_id', TRUE);
                $loan_id = $this->input->post('loan_id', TRUE);

                $chck_dtr_loan = $this->Loan_list_model->chck_dtr_loan($company_id,$loan_id);

                if (count($chck_dtr_loan) <= 0){

                    $this->load->library('form_validation');
                    $this->load->helper('security');

                    $this->form_validation->set_rules('employee', 'Employee', 'strip_tags|xss_clean|required');  
                    $this->form_validation->set_rules('ref_loan_id', 'Loan Type', 'strip_tags|xss_clean|required');
                    $this->form_validation->set_rules('total_loan', 'Total Loan', 'strip_tags|xss_clean|required');  
                    $this->form_validation->set_rules('deduction_amt', 'Deduction Amount', 'strip_tags|xss_clean|required');  

                    if ($this->form_validation->run() == TRUE) 
                    {            
                        $m_loan_list->ref_loan_id = $ref_loan_id;
                        $m_loan_list->employee_id = $this->input->post('employee', TRUE);
                        $m_loan_list->total_loan = $this->get_numeric_value($this->input->post('total_loan', TRUE));
                        $m_loan_list->deduction_amt = $this->get_numeric_value($this->input->post('deduction_amt', TRUE));
                        $m_loan_list->balance = $this->get_numeric_value($this->input->post('balance', TRUE));
                        $m_loan_list->f1 = $this->input->post('f1', TRUE);
                        $m_loan_list->f2 = $this->input->post('f2', TRUE);
                        $m_loan_list->f3 = $this->input->post('f3', TRUE);
                        $m_loan_list->f4 = $this->input->post('f4', TRUE);
                        $m_loan_list->f5 = $this->input->post('f5', TRUE);
                        $m_loan_list->all = $this->input->post('all', TRUE);
                        $m_loan_list->date_modified = date("Y-m-d H:i:s");
                        $m_loan_list->modified_by = $this->session->user_id;
                        $m_loan_list->modify($loan_id);

                        $response['title'] = 'Success!';
                        $response['stat'] = 'success';
                        $response['msg'] = 'Deduction successfully updated.';
                        $response['row_updated'] = $this->Loan_list_model->get_loan_list($this->session->company_id,$loan_id);
                    }
                    else
                    {
                        $response['title'] = 'Error!';
                        $response['stat'] = 'error';
                        $response['msg'] = validation_errors();
                    }  

                }else{
                        $response['title'] = 'Cannot be Updated!';
                        $response['stat'] = 'error';
                        $response['msg'] = 'Deduction is already used in Daily Time Record!';
                }
               
                echo json_encode($response);
            break;

            case 'delete':
                $m_loan_list=$this->Loan_list_model;

                $company_id = $this->session->company_id;
                $loan_id=$this->input->post('loan_id',TRUE);

                $chck_dtr_loan =$this->Loan_list_model->chck_dtr_loan($company_id,$loan_id);
                $count_loan = count($chck_dtr_loan);

                if($count_loan > 0){
                    $response['false']=0;
                    $response['title']='Cannot be Deleted!';
                    $response['stat']='error';
                    $response['msg'] = 'Deduction is already used in Daily Time Record!';
                }
                else{
                    $m_loan_list->is_deleted=1;
                    $m_loan_list->date_deleted = date("Y-m-d H:i:s");
                    $m_loan_list->deleted_by = $this->session->user_id;

                    if($m_loan_list->modify($loan_id)){
                    $response['title']='Success!';
                    $response['stat']='success';
                    $response['msg']='SSS Loan successfully Deleted.';

                    }
                }

                    echo json_encode($response);
            break;
        }
    }
}
