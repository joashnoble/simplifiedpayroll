<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CompanySetup extends CORE_Controller
{

    function __construct() {
        parent::__construct('');
        if($this->session->userdata('user_id') == FALSE) {
            redirect('../login');
        } 
        if($this->session->userdata('right_companysetup_view') == 0 || $this->session->userdata('right_companysetup_view') == null) {
            redirect('../Dashboard');
        }
        else{
            
        }
        $this->validate_session();
        $this->load->model('CompanyManagement_model');
        $this->load->model('Minimum_wage_model');

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
        $data['title'] = 'JCORE - General Settings';
        $data['wages'] = $this->Minimum_wage_model->get_list();
        $data['company_setup']=$this->CompanyManagement_model->get_company_list($this->session->company_id);
        $this->load->view('companysetup_view', $data);
    }

    function transaction($txn = null) {
        switch ($txn) {
            case 'list':
            	$response['data']=$this->GeneralSettings_model->get_list(
                    array('company_setup.is_deleted'=>FALSE)
                    );
                echo json_encode($response);
                
            break;

            case 'update':
                $m_company_mngmnt=$this->CompanyManagement_model;

                $company_id=$this->session->company_id;

                // ## Company Information
                $m_company_mngmnt->company_name = $this->input->post('company_name', TRUE);
                $m_company_mngmnt->company_address = $this->input->post('company_address', TRUE);
                $m_company_mngmnt->company_number = $this->input->post('company_number', TRUE);
                $m_company_mngmnt->company_email = $this->input->post('company_email', TRUE);
                $m_company_mngmnt->company_image = $this->input->post('company_image', TRUE);
                $m_company_mngmnt->login_quote = $this->input->post('login_quote', TRUE);

                // ## BIR Information
                $m_company_mngmnt->registered_to = $this->input->post('registered_to', TRUE);
                $m_company_mngmnt->registered_address = $this->input->post('registered_address', TRUE);
                $m_company_mngmnt->wage_id = $this->input->post('wage_id', TRUE);
                $m_company_mngmnt->zip_code = $this->input->post('zip_code', TRUE);
                $m_company_mngmnt->telephone_no = $this->input->post('telephone_no', TRUE);
                $m_company_mngmnt->tin_no = $this->input->post('tin_no', TRUE);
                $m_company_mngmnt->rdo_no = $this->input->post('rdo_no', TRUE);
                $m_company_mngmnt->nature_of_business = $this->input->post('nature_of_business', TRUE);
                $m_company_mngmnt->industry_classification = $this->input->post('industry_classification', TRUE);

                // ## Company Login Settings
                $m_company_mngmnt->company_password = $this->input->post('company_password', TRUE);

                $m_company_mngmnt->modified_by = $this->session->user_id;
                $m_company_mngmnt->date_modified = date("Y-m-d H:i:s");
                $m_company_mngmnt->modify($company_id);

                $response['title']='Success';
                $response['stat']='success';
                $response['msg']='General Settings information successfully updated.';

                $response['row_updated'] = $this->CompanyManagement_model->get_company_list($company_id);
                echo json_encode($response);

                break;

            case 'upload':
                $allowed = array('png', 'jpg', 'jpeg','bmp');

                $data=array();
                $files=array();
                $directory='assets/img/company/';

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

        }
    }





}
