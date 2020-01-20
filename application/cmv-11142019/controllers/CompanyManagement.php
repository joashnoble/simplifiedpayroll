<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CompanyManagement extends CORE_Controller
{

    function __construct() {
        parent::__construct('');
        
        $this->load->model('CompanyManagement_model');
        $this->load->model('AdminUser_model');
        $this->validate_admin_session();
    }

    public function index() {
        $data['_def_css_files'] = $this->load->view('template/assets/css_files', '', TRUE);
        $data['_def_css_custom'] = $this->load->view('template/assets/css_custom', '', TRUE);
        $data['_def_js_files'] = $this->load->view('template/assets/js_files', '', TRUE);
        $data['_switcher_settings'] = $this->load->view('template/elements/switcher', '', TRUE);
        $data['_rights'] = $this->load->view('template/elements/rights', '', TRUE);
        $data['loader'] = $this->load->view('template/elements/loader', '', TRUE);
        $data['loaderscript'] = $this->load->view('template/elements/loaderscript', '', TRUE);
        $data['title'] = 'JCORE - Company Management';
        $this->load->view('company_management_view', $data);
    }

    function transaction($txn = null) {
        switch ($txn) {
            case 'list':
                $response['data']=$this->CompanyManagement_model->get_company_list();
                echo json_encode($response);
            break;

            case 'create':
                $m_company = $this->CompanyManagement_model;

                //BACKEND FORM VALIDATION AND SECURITY HELPER
                $this->load->library('form_validation');
                $this->load->helper('security');

                $this->form_validation->set_rules('company_name', 'Company Name', 'strip_tags|trim|xss_clean|required');  
                $this->form_validation->set_rules('company_code', 'Company Code', 'strip_tags|trim|xss_clean|required');  
                $this->form_validation->set_rules('no_of_employee', 'No of Employee', 'strip_tags|trim|xss_clean|required');  
                $this->form_validation->set_rules('company_email', 'Company Email', 'strip_tags|trim|xss_clean|required');  
                $this->form_validation->set_rules('tin_no', 'TIN Number', 'strip_tags|min_length[9]|max_length[9]|trim|xss_clean|numeric');

                if ($this->form_validation->run() == TRUE) 
                {        

                    // Generate a random password
                    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
                    $pass = array(); //remember to declare $pass as an array
                    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
                    for ($i = 0; $i < 15; $i++) {
                        $n = rand(0, $alphaLength);
                        $pass[] = $alphabet[$n];
                    }

                    $password = implode($pass); //turn the array into a string
                    $dateenrolled = $this->input->post('date_enrolled', TRUE);
                    if ($dateenrolled == ""){ $date_enrolled=""; }else{ $date_enrolled = date("Y-m-d", strtotime($dateenrolled));} 

                    $m_company->company_code = $this->input->post('company_code', TRUE);
                    $m_company->company_name = $this->input->post('company_name', TRUE);
                    $m_company->company_address = $this->input->post('company_address', TRUE);
                    $m_company->nature_of_business = $this->input->post('nature_of_business', TRUE);
                    $m_company->tin_no = $this->input->post('tin_no', TRUE);
                    $m_company->no_of_employee = $this->input->post('no_of_employee', TRUE);
                    $m_company->company_email = $this->input->post('company_email', TRUE);
                    $m_company->company_number = $this->input->post('company_number', TRUE);
                    $m_company->company_image = 'assets/img/company/jdev-logo.png';
                    $m_company->login_quote = "Simplified Payroll";
                    $m_company->date_enrolled = $date_enrolled;
                    $m_company->company_password = $password;
                    $m_company->save();
                    $company_id = $m_company->last_insert_id();

                    $response['title'] = 'Success!';
                    $response['stat'] = 'success';
                    $response['msg'] = 'Company Information successfully created.';
                    $response['row_added'] = $this->CompanyManagement_model->get_company_list($company_id);
                }
                else
                {
                    $response['title'] = 'Error!';
                    $response['stat'] = 'error';
                    $response['msg'] = validation_errors();
                }  
                echo json_encode($response);

                break;

            case 'update':
                $m_company = $this->CompanyManagement_model;

                //BACKEND FORM VALIDATION AND SECURITY HELPER
                $this->load->library('form_validation');
                $this->load->helper('security');

                $this->form_validation->set_rules('company_name', 'Company Name', 'strip_tags|trim|xss_clean|required');  
                $this->form_validation->set_rules('company_code', 'Company Code', 'strip_tags|trim|xss_clean|required');  
                $this->form_validation->set_rules('no_of_employee', 'No of Employee', 'strip_tags|trim|xss_clean|required');  
                $this->form_validation->set_rules('company_email', 'Company Email', 'strip_tags|trim|xss_clean|required');  
                $this->form_validation->set_rules('tin_no', 'TIN Number', 'strip_tags|min_length[9]|max_length[9]|trim|xss_clean|numeric');

                if ($this->form_validation->run() == TRUE) 
                {        
                    $dateenrolled = $this->input->post('date_enrolled', TRUE);
                    if ($dateenrolled == ""){ $date_enrolled=""; }else{ $date_enrolled = date("Y-m-d", strtotime($dateenrolled));} 

                    $company_id = $this->input->post('company_id', TRUE);
                    $m_company->company_code = $this->input->post('company_code', TRUE);
                    $m_company->company_name = $this->input->post('company_name', TRUE);
                    $m_company->company_address = $this->input->post('company_address', TRUE);
                    $m_company->nature_of_business = $this->input->post('nature_of_business', TRUE);
                    $m_company->tin_no = $this->input->post('tin_no', TRUE);
                    $m_company->no_of_employee = $this->input->post('no_of_employee', TRUE);
                    $m_company->company_email = $this->input->post('company_email', TRUE);
                    $m_company->company_number = $this->input->post('company_number', TRUE);
                    $m_company->date_enrolled = $date_enrolled;
                    $m_company->modify($company_id);

                    $response['title'] = 'Success!';
                    $response['stat'] = 'success';
                    $response['msg'] = 'Company Information successfully udpated.';
                    $response['row_updated'] = $this->CompanyManagement_model->get_company_list($company_id);
                }else{
                    $response['title'] = 'Error!';
                    $response['stat'] = 'error';
                    $response['msg'] = validation_errors();
                }

                echo json_encode($response);

            break;


            case 'delete':
                $m_company = $this->CompanyManagement_model;
                $company_id=$this->input->post('company_id',TRUE);

                $m_company->is_deleted=1;
                $m_company->is_archive=2;
                $m_company->date_deleted = date("Y-m-d");

                if($m_company->modify($company_id)){
                    $response['title']='Success!';
                    $response['stat']='success';
                    $response['msg']='Company Information successfully deleted.';
                    $response['row_updated'] = $this->CompanyManagement_model->get_company_list($company_id);
                    echo json_encode($response);
                }

            break;

            case 'Activate':
                $m_company = $this->CompanyManagement_model;
                $company_id=$this->input->post('company_id',TRUE);
                $status=$this->input->post('status',TRUE);
                $lblactivate = "";

                $get_email_sent = $m_company->get_company_list($company_id);

                if ($status == "Pending" || $status == "Inactive"){
                    $m_company->is_deleted=0;
                    $m_company->is_archive=1;
                    $lblactivate = "Activated";

                    // if ($get_email_sent[0]->is_email_sent == 0){

                    // ## Send Password Generated 
                    // $email = $get_email_sent[0]->company_email;
                    // $subject = $get_email_sent[0]->company_name.' Login Details';
                    // $email_settings = $this->AdminUser_model->get_list(1);
                    // $company_email = $email_settings[0]->email_address;
                    // $email_password = $email_settings[0]->email_password;
                    // $company_name = $get_email_sent[0]->company_name;

                    // $date = date('m-d-Y');
                    // $year = date('Y');

                    // $message = '<div style="width:85%;background:#F5F5F5;padding: 50px;font-family: arial;">
                    //                 <div style="border: 1px solid #CFD8DC;">
                    //                     <div style="padding: 20px;background: #fff; font-weight: bold;font-size: 13pt;border-top: 5px solid #263238;">
                    //                         '.$company_name.'
                    //                     </div>
                    //                     <div style="background: #263238; color: #fff;padding: 10px;">
                    //                         '.$subject.'
                    //                     </div>
                    //                     <div style="background: #fff; padding: 15px;">
                    //                         <p>Greetings, <span style="text-align: right;float:right;">'.$date.'</span> </p>
                    //                         <p style="text-align: justify;">This email contains your generated Company Code and Password. You can update your company password once you login. 

                    //                         <br>
                    //                         <p>
                    //                         <strong>Generated Account Details</strong>
                    //                             <table style="border: 1px solid gray;font-size: 10pt;">
                    //                             <tr>
                    //                                 <td>Company Code:</td>
                    //                                 <td><strong>'.$get_email_sent[0]->company_code.'</strong></td>
                    //                                 <td>| Password:</td>
                    //                                 <td><strong>'.$get_email_sent[0]->company_password.'</strong></td>
                    //                             </tr>
                    //                         </table>
                    //                         <br />
                    //                         <strong>User Account Details</strong>
                    //                         <br /><br />
                    //                             <table style="border: 1px solid gray;font-size: 10pt;">
                    //                             <tr>
                    //                                 <td>User Name:</td>
                    //                                 <td><strong>admin</strong></td>
                    //                                 <td>| Password:</td>
                    //                                 <td><strong>admin</strong></td>
                    //                             </tr>
                    //                         </table>
                    //                     </div>
                    //                     <div style="background: #F5F5F5;">
                    //                         <center>
                    //                             <p style="font-size: 8pt;">Copyright &copy; '.$year.' JDEV Office Solution</p>
                    //                         </center>
                    //                     </div>
                    //                 </div>
                    //             </div>';
                    
                    // $m_company->send_mail($email,$message,$subject,$company_email,$email_password,$company_name);
                    // $m_company->is_email_sent=1;
                    // }
                    
                }else{
                    $m_company->is_archive=2;
                    $m_company->date_archived = date("Y-m-d");
                    $lblactivate = "Deactivated";
                }


                if($m_company->modify($company_id)){
                    $response['title']='Success!';
                    $response['stat']='success';
                    $response['msg']='Company successfully '.$lblactivate.'.';
                    $response['row_updated'] = $this->CompanyManagement_model->get_company_list($company_id);
                    echo json_encode($response);
                }

            break;
        }
    }
}
