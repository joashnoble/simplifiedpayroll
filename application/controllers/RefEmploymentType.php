<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RefEmploymentType extends CORE_Controller
{

    function __construct() {

        parent::__construct('');
        if($this->session->userdata('user_id') == FALSE) {
            redirect('../login');
        } 
        if($this->session->userdata('right_emp_type_view') == 0 || $this->session->userdata('right_emp_type_view') == null) {
            redirect('../Dashboard');
        }

        $this->validate_session();
        $this->load->model('RefEmploymentType_model');

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
        $data['title'] = 'JCORE - Employment Type Management';
        $this->load->view('ref_employmenttype_view', $data);
    }

    function transaction($txn = null) {
        switch ($txn) {
            case 'list':
                $response['data']=$this->RefEmploymentType_model->get_employmenttype_list($this->session->company_id);
                echo json_encode($response);
            break;

            case 'create':
                $m_employmenttype = $this->RefEmploymentType_model;
                              
                $this->load->library('form_validation');
                $this->load->helper('security');
                $this->form_validation->set_rules('employment_type', 'Employment Type', 'strip_tags|xss_clean|required');  

                if ($this->form_validation->run() == TRUE) 
                {      
                    $m_employmenttype->employment_type = $this->input->post('employment_type', TRUE);
                    $m_employmenttype->description = $this->input->post('description', TRUE);
                    $m_employmenttype->date_created = date("Y-m-d H:i:s");
                    $m_employmenttype->created_by = $this->session->user_id;
                    $m_employmenttype->company_id = $this->session->company_id;
                    $m_employmenttype->save();
                    $ref_employmenttype_id = $m_employmenttype->last_insert_id();
                    $response['title'] = 'Success!';
                    $response['stat'] = 'success';
                    $response['msg'] = 'Employment Type information successfully created.';
                    $response['row_added'] = $this->RefEmploymentType_model->get_list($ref_employmenttype_id);
                }else{
                    $response['title'] = 'Error!';
                    $response['stat'] = 'error';
                    $response['msg'] = validation_errors();
                }
                echo json_encode($response);
            break;

            case 'createdirect':
                    $m_employmenttype = $this->RefEmploymentType_model;
                    $m_employmenttype->employment_type = $this->input->post('postname', TRUE);
                    $m_employmenttype->description = $this->input->post('postdescription', TRUE);
                    $m_employmenttype->date_created = date("Y-m-d H:i:s");
                    $m_employmenttype->created_by = $this->session->user_id;
                    $m_employmenttype->company_id = $this->session->company_id;
                    $m_employmenttype->save();

                    $ref_employmenttype_id = $m_employmenttype->last_insert_id();

                    $response['title'] = 'Success!';
                    $response['stat'] = 'success';
                    $response['msg'] = 'Employment Type information successfully created.';
                    $response['row_added'] = $this->RefEmploymentType_model->get_list($ref_employmenttype_id);

                echo json_encode($response);

            break;

            case 'delete':
                $m_employmenttype=$this->RefEmploymentType_model;

                $ref_employment_type_id=$this->input->post('ref_employment_type_id',TRUE);

                $response['data']=$this->RefEmploymentType_model->checkifused($ref_employment_type_id);
                $checkcount = count($response['data']);

                if($checkcount>0){
                    $response['false']=0;
                    $response['title']='Cannot be Deleted!';
                    $response['stat']='error';
                    $response['msg']='Reference is in used!';

                    echo json_encode($response);
                }
                else{
                    $m_employmenttype->is_deleted=1;
                    $m_employmenttype->date_deleted = date("Y-m-d H:i:s");
                    $m_employmenttype->deleted_by = $this->session->user_id;
                    if($m_employmenttype->modify($ref_employment_type_id)){

                    $response['title']='Success!';
                    $response['stat']='success';
                    $response['msg']='Employment Type Reference successfully Deleted.';

                    echo json_encode($response);
                    }
                }

            break;

            case 'update':

                $m_employmenttype=$this->RefEmploymentType_model;

                $this->load->library('form_validation');
                $this->load->helper('security');
                $this->form_validation->set_rules('employment_type', 'Employment Type', 'strip_tags|xss_clean|required');  

                if ($this->form_validation->run() == TRUE) 
                {            
                    $ref_employment_type_id=$this->input->post('ref_employment_type_id',TRUE);
                    $m_employmenttype->employment_type = $this->input->post('employment_type', TRUE);
                    $m_employmenttype->description = $this->input->post('description', TRUE);
                    $m_employmenttype->date_modified = date("Y-m-d H:i:s");
                    $m_employmenttype->modified_by = $this->session->user_id;
                    $m_employmenttype->modify($ref_employment_type_id);
                    $response['title']='Success';
                    $response['stat']='success';
                    $response['msg']='Employment Type Information successfully updated.';
                    $response['row_updated']=$this->RefEmploymentType_model->get_list($ref_employment_type_id);
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
