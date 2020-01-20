<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminLogin extends CORE_Controller {

    function __construct()
    {
        parent::__construct('');
        if($this->session->admin_id != '') {
            echo '<script>
            window.location.href = "CompanyManagement";
            </script>';
        }


        $this->load->model('AdminUser_model');

    }


    public function index()
    {
        // $this->create_required_default_data();

        $data['_def_css_files']=$this->load->view('template/assets/css_files','',TRUE);
        $data['_def_js_files']=$this->load->view('template/assets/js_files','',TRUE);
        $data['title'] = 'JCORE - Admin Login';
        $this->load->view('admin_login_view',$data);

    }


    function create_required_default_data(){
        //create default admin user
        // $m_users=$this->Users_model;
        // $m_users->create_default_user();     
    }


    function transaction($txn=null){

        switch($txn){

                //****************************************************************************
                case 'validate_admin' :

                    $uname=$this->input->post('uname');
                    $pword=$this->input->post('pword');

                    $admin=$this->AdminUser_model;
                    $result=$admin->authenticate_admin_user($uname,$pword);

                    if($result->num_rows()>0){//valid username and pword

                        $admin_id = $result->row()->admin_id;
                        $admin->status = 1; //1 is equivalent to active or logged in
                        $admin->modify($admin_id);


                        $this->session->set_userdata(
                            array(
                                'admin_id'=>$result->row()->admin_id,
                            )
                        );
                        
                        $response['title'] = 'Success';
                        $response['stat']='success';
                        $response['msg']='Admin User successfully authenticated.';

                        echo json_encode($response);

                    }else{ //not valid
                        
                        $response['title'] = 'Cannot authenticate user!';
                        $response['stat']='error';
                        $response['msg']='Invalid username or password.';
                        echo json_encode($response);

                    }

                break;

                //****************************************************************************
                case 'logout' :
                    $m_admin=$this->AdminUser_model;
                    $admin_id = $this->session->admin_id;
                    $m_admin->status = 0; //0 is equivalent to inactive or logged out
                    $m_admin->modify($admin_id);
                    $this->end_admin_session();
                //****************************************************************************


                break;

                default:


        }
    }
}
