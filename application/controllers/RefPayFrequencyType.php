<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RefPayFrequencyType extends CORE_Controller
{

    function __construct() {
        parent::__construct('');
        if($this->session->userdata('user_id') == FALSE) {
            redirect('../login');
        } 
        if($this->session->userdata('right_pay_frequency_view') == 0 || $this->session->userdata('right_pay_frequency_view') == null) {
            redirect('../Dashboard');
        }

        $this->validate_session();
        $this->load->model('RefPayFrequencyFactor_model');
        $this->load->model('RefPayFrequency_model');

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
        $data['title'] = 'JCORE - Pay Frequency Type Management';
        $this->load->view('ref_payfrequency_type_view', $data);
    }

    function transaction($txn = null) {
        switch ($txn) {
            case 'list':
                $response['data']=$this->RefPayFrequency_model->get_payfrequency_list($this->session->company_id);
                echo json_encode($response);
            break;

            case 'create':
                $m_payfrequency = $this->RefPayFrequency_model;
                //Backend FORM VALIDATION AND SECURITY HELPER
                $this->load->library('form_validation');
                $this->load->helper('security');
                $this->form_validation->set_rules('pay_frequency_type', 'Pay Frequency Type', 'strip_tags|xss_clean|required');       
                $this->form_validation->set_rules('pay_type_factor', 'Factor', 'strip_tags|xss_clean|required');   

                if ($this->form_validation->run() == TRUE) 
                {            
                    $m_payfrequency->pay_frequency_type = $this->input->post('pay_frequency_type', TRUE);
                    $m_payfrequency->description = $this->input->post('description', TRUE);
                    $m_payfrequency->pay_type_factor = $this->input->post('pay_type_factor', TRUE);
                    $m_payfrequency->date_created = date("Y-m-d H:i:s");
                    $m_payfrequency->created_by = $this->session->user_id;
                    $m_payfrequency->company_id = $this->session->company_id;
                    $m_payfrequency->save();

                    $ref_payfrequency_type_id = $m_payfrequency->last_insert_id();
                    $response['title'] = 'Success!';
                    $response['stat'] = 'success';
                    $response['msg'] = 'Pay Frequency Information successfully created.';
                    $response['row_added'] = $this->RefPayFrequency_model->get_list($ref_payfrequency_type_id);
                }
                else
                {
                    $response['title'] = 'Error!';
                    $response['stat'] = 'error';
                    $response['msg'] = validation_errors();
               
                }  
                echo json_encode($response);              

                break;

            case 'createdirect':
                $m_payfrequency = $this->RefPayFrequency_model;
               
                $m_payfrequency->pay_frequency_type = $this->input->post('postname', TRUE);
                $m_payfrequency->description = $this->input->post('postdescription', TRUE);
                $m_payfrequency->date_created = date("Y-m-d H:i:s");
                $m_payfrequency->created_by = $this->session->user_id;
                $m_payfrequency->company_id = $this->session->company_id;
                $m_payfrequency->save();

                $ref_payfrequency_type_id = $m_payfrequency->last_insert_id();


                $response['title'] = 'Success!';
                $response['stat'] = 'success';
                $response['msg'] = 'Pay Frequency Information successfully created.';

                $response['row_added'] = $this->RefPayFrequency_model->get_list($ref_payfrequency_type_id);
                echo json_encode($response);

                break;

            case 'delete':
                $m_payfrequency = $this->RefPayFrequency_model;

                $ref_payfrequency_type_id=$this->input->post('ref_payfrequency_type_id',TRUE);

                if($ref_payfrequency_type_id == 1 OR 2 OR 3 OR 4){
                    $response['false']=0;
                    $response['title']='Payment Type is in used!';
                    $response['stat']='error';
                    $response['msg']='Cannot delete default payment type!';
                    echo json_encode($response);
                }
                else{
                    $m_paymenttype->is_deleted=1;
                    $m_paymenttype->date_deleted = date("Y-m-d H:i:s");
                    $m_paymenttype->deleted_by = $this->session->user_id;
                    if($m_paymenttype->modify($ref_payfrequency_type_id)){
                    $response['title']='Success!';
                    $response['stat']='success';
                    $response['msg']='Payment Type Reference successfully Deleted.';

                    echo json_encode($response);
                    }
                }

            break;

            case 'update':
                $m_payfrequency = $this->RefPayFrequency_model;                
                $m_payfrequency_factor = $this->RefPayFrequencyFactor_model;

                $ref_payfrequency_factor_id=$this->input->post('ref_payfrequency_factor_id',TRUE);
                $this->load->library('form_validation');
                $this->load->helper('security');    
                $this->form_validation->set_rules('pay_type_factor', 'Factor', 'strip_tags|xss_clean|required');       

                if ($this->form_validation->run() == TRUE) 
                {            
            
                // $m_paymenttype->payment_type = $this->input->post('payment_type', TRUE);
                // $m_paymenttype->description = $this->input->post('description', TRUE);
                $m_payfrequency_factor->pay_type_factor = $this->input->post('pay_type_factor', TRUE);
                $m_payfrequency_factor->date_modified = date("Y-m-d H:i:s");
                $m_payfrequency_factor->modified_by = $this->session->user_id;
                $m_payfrequency_factor->modify($ref_payfrequency_factor_id);


                $response['title']='Success';
                $response['stat']='success';
                $response['msg']='Pay Frequency successfully updated.';
                $response['row_updated']=$this->RefPayFrequency_model->get_payfrequency_list($this->session->company_id,$ref_payfrequency_factor_id);
              
               }
                else
                {
                    $response['title'] = 'Error!';
                    $response['stat'] = 'error';
                    $response['msg'] = validation_errors();
               
                }  
 
                echo json_encode($response);

                break;

        }
    }
}
