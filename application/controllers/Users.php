<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CORE_Controller
{

    function __construct() {
        parent::__construct('');
        if($this->session->userdata('user_id') == FALSE) {
            redirect('../login');
        }
        if($this->session->userdata('right_useraccount_view') == 0 || $this->session->userdata('right_useraccount_view') == null) {
            redirect('../Dashboard');
        }
        else{

        }
        $this->validate_session();
        $this->load->model('Users_model');
        $this->load->model('User_groups_model');
    }

    public function index() {

        $data['_def_css_files'] = $this->load->view('template/assets/css_files', '', TRUE);
        $data['_def_css_custom'] = $this->load->view('template/assets/css_custom', '', TRUE);
        $data['_def_js_files'] = $this->load->view('template/assets/js_files', '', TRUE);
        $data['_switcher_settings'] = $this->load->view('template/elements/switcher', '', TRUE);
        $data['_side_bar_navigation'] = $this->load->view('template/elements/side_bar_navigation', '', TRUE);
        $data['_top_navigation'] = $this->load->view('template/elements/top_navigation', '', TRUE);
        $data['_rights'] = $this->load->view('template/elements/rights', '', TRUE); 
        $data['user_groups']=$this->User_groups_model->get_usergroup_list($this->session->company_id);
        $data['loader'] = $this->load->view('template/elements/loader', '', TRUE);
        $data['loaderscript'] = $this->load->view('template/elements/loaderscript', '', TRUE);
        $data['title'] = 'JCORE - User Account Management';
        $this->load->view('users_view', $data);
    }

    function transaction($txn = null) {

        switch($txn){
            case 'list':
                $m_users=$this->Users_model;
                $response['data']=$m_users->get_user_list($this->session->company_id);
                echo json_encode($response);
            break;
                
            case 'create':
                $user_name = $this->input->post('user_name',TRUE);
                $count_uname = $this->Users_model->count_uname($this->session->company_id,$user_name);

                if (count($count_uname) > 0){
                        $response['title'] = 'Warning!';
                        $response['stat'] = 'error';
                        $response['msg'] = 'Username is already taken.';
                }else{
                    $this->load->library('form_validation');
                    $this->load->helper('security');
                    $this->form_validation->set_rules('user_name', 'UserName', 'strip_tags|trim|xss_clean|required');

                    if ($this->form_validation->run() == TRUE)
                    {
                        $m_users=$this->Users_model;

                        $m_users->user_name=$user_name;
                        $m_users->user_pword=sha1($this->input->post('user_pword',TRUE));
                        $m_users->user_lname=$this->input->post('user_lname',TRUE);
                        $m_users->user_fname=$this->input->post('user_fname',TRUE);
                        $m_users->user_mname=$this->input->post('user_mname',TRUE);
                        $m_users->user_address=$this->input->post('user_address',TRUE);
                        $m_users->user_email=$this->input->post('user_email',TRUE);
                        $m_users->user_mobile=$this->input->post('user_mobile',TRUE);
                        $m_users->user_telephone=$this->input->post('user_telephone',TRUE);
                        $m_users->user_bdate=date('Y-m-d',strtotime($this->input->post('user_bdate',TRUE)));
                        $m_users->user_group_id=$this->input->post('user_group_id',TRUE);
                        $m_users->photo_path=$this->input->post('photo_path',TRUE);
                        $m_users->date_created = date("Y-m-d H:i:s");
                        $m_users->company_id = $this->session->company_id;
                        $m_users->created_by = $this->session->user_id;
                        $m_users->save();

                        $user_account_id=$m_users->last_insert_id();

                        $response['title']='Success!';
                        $response['stat']='success';
                        $response['msg']='User account information successfully created.';
                        $response['row_added']=$m_users->get_user_list($this->session->company_id,$user_account_id);
                    }
                    else
                    {
                        $response['title'] = 'Error!';
                        $response['stat'] = 'error';
                        $response['msg'] = validation_errors();
                    }
                }

                echo json_encode($response);

            break;
            //****************************************************************************************************************
            case 'update' :
                $user_account_id=$this->input->post('user_id',TRUE);
                $user_name = $this->input->post('user_name',TRUE);
                $count_uname = $this->Users_model->count_uname($this->session->company_id,$user_name,$user_account_id);

                if (count($count_uname) > 0){
                        $response['title'] = 'Warning!';
                        $response['stat'] = 'error';
                        $response['msg'] = 'Username already exists,please try another username.';
                }else{

                        $m_users=$this->Users_model;
                        $email_user_settings_id = $this->input->post('email_user_settings_id',TRUE);
                        $post_username = $this->input->post('user_name',TRUE);
                        $user_pword = $this->input->post('user_pword',TRUE);

                        $this->load->library('form_validation');
                        $this->load->helper('security');
                        $this->form_validation->set_rules('user_name', 'UserName', 'strip_tags|trim|xss_clean|required');

                        if ($this->form_validation->run() == TRUE){

                            if($user_pword !='nochanges'){ $m_users->user_pword=sha1($this->input->post('user_pword',TRUE));}

                            $m_users->user_name=$this->input->post('user_name',TRUE);
                            $m_users->user_lname=$this->input->post('user_lname',TRUE);
                            $m_users->user_fname=$this->input->post('user_fname',TRUE);
                            $m_users->user_mname=$this->input->post('user_mname',TRUE);
                            $m_users->user_address=$this->input->post('user_address',TRUE);
                            $m_users->user_email=$this->input->post('user_email',TRUE);
                            $m_users->user_email=$this->input->post('user_email',TRUE);
                            $m_users->user_mobile=$this->input->post('user_mobile',TRUE);
                            $m_users->user_telephone=$this->input->post('user_telephone',TRUE);
                            $userbdate = $this->input->post('user_bdate',TRUE);
                            if ($userbdate != ""){
                                $m_users->user_bdate=date('Y-m-d',strtotime($userbdate));
                            }else{
                                $m_users->user_bdate = "";
                            }
                            $m_users->user_group_id=$this->input->post('user_group_id',TRUE);
                            $m_users->photo_path=$this->input->post('photo_path',TRUE);
                            $m_users->date_modified = date("Y-m-d H:i:s");
                            $m_users->modified_by = $this->session->user_id;
                            $m_users->modify($user_account_id);
                            $response['title']='Success!';
                            $response['stat']='success';
                            $response['msg']='User account Information successfully updated.';
                            $response['row_updated']=$m_users->get_user_list($this->session->company_id,$user_account_id);
                        }
                        else{
                            $response['title']='Error!';
                            $response['stat']='error';
                            $response['msg']=validation_errors();
                        }
                }

                echo json_encode($response);

            break;
            //****************************************************************************************************************
            case 'delete':
                $m_users=$this->Users_model;
                $user_account_id=$this->input->post('user_id',TRUE);

                $m_users->is_deleted=1;
                $m_users->date_deleted = date("Y-m-d H:i:s");
                $m_users->deleted_by = $this->session->user_id;
                if($m_users->modify($user_account_id)){
                    $response['title']='Success!';
                    $response['stat']='success';
                    $response['msg']='User account information successfully deleted.';
                    echo json_encode($response);
                }
                break;

            case 'upload':
                $allowed = array('png', 'jpg', 'jpeg','bmp');

                $data=array();
                $files=array();

                $directory='assets/img/user/';

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
