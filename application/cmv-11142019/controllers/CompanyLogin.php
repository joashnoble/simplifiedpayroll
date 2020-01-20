<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CompanyLogin extends CORE_Controller {

    function __construct()
    {
        parent::__construct('');
        if($this->session->company_id != '') {
            echo '<script>
            window.location.href = "'.base_url('Login').'";
            </script>';
        }
        $this->load->model('User_rights_model');
        $this->load->model('Users_model');
        $this->load->model('User_groups_model');
        $this->load->model('CompanyManagement_model');

    }


    public function index()
    {
        $data['_def_css_files']=$this->load->view('template/assets/css_files','',TRUE);
        $data['_def_js_files']=$this->load->view('template/assets/js_files','',TRUE);
        $data['title'] = 'JCORE - Company Login';
        $this->load->view('company_login_view',$data);

    }

    function transaction($txn=null){

        switch($txn){

                //****************************************************************************
                case 'validate_company' :

                    $ccode=$this->input->post('ccode');
                    $pword=$this->input->post('pword');

                    $company=$this->CompanyManagement_model;
                    $result=$company->authenticate_company($ccode,$pword);

                    if($result->num_rows()>0){//valid username and pword

                        $company_id = $result->row()->company_id;
                        $company->session_status = 1; //1 is equivalent to active or logged in
                        $company->modify($company_id);

                        $m_user_rights = $this->User_rights_model;
                        $m_users=$this->Users_model;
                        $m_user_groups=$this->User_groups_model;

                        $count_user = $m_users->count_user($company_id);
                        $count_user_group = $m_user_groups->count_user_group($company_id);
                        $count_user_rights = $m_user_rights->count_user_rights($company_id);

                        if (count($count_user_group) <= 0){
                            $m_user_groups->create_default_user_group($company_id);
                            $get_user_group = $m_user_groups->count_user_group($company_id);

                            $user_group_id = $get_user_group[0]->user_group_id;
                            $m_user_rights->create_default_user_rights($company_id,$user_group_id);
                            $m_users->create_default_user($company_id,$user_group_id);
                        }

                        $this->session->set_userdata(
                            array(
                                'company_id'=>$result->row()->company_id,
                                'company_name'=>$result->row()->company_name
                            )
                        );
                        
                        $response['title'] = 'Success';
                        $response['stat']='success';
                        $response['msg']='Company successfully authenticated.';

                        echo json_encode($response);

                    }else{ //not valid
                        
                        $response['title'] = 'Cannot authenticate Company!';
                        $response['stat']='error';
                        $response['msg']='Invalid Code or password.';
                        echo json_encode($response);

                    }

                break;

                //****************************************************************************
                case 'logout' :
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
