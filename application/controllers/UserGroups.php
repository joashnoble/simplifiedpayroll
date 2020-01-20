<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserGroups extends CORE_Controller
{

    function __construct() {
        parent::__construct('');
        if($this->session->userdata('user_id') == FALSE) {
            redirect('../login');
        }
        if($this->session->userdata('right_usergroup_view') == 0 || $this->session->userdata('right_usergroup_view') == null) {
            redirect('../Dashboard');
        }

        $this->validate_session();
        $this->load->model('Users_model');
        $this->load->model('User_groups_model');
        $this->load->model('User_rights_model');
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
        $data['title'] = 'JCORE - User Groups Management';
        $this->load->view('usergroups_view', $data);
    }

    function transaction($txn = null) {

        switch($txn){
            case 'list':
                $m_usergroups=$this->User_groups_model;
                $response['data']=$this->User_groups_model->get_userrights_list($this->session->company_id);
                echo json_encode($response);
            break;
            
            case 'create':
                $m_user_group=$this->User_groups_model;
                $m_user_group_rights=$this->User_rights_model;
                $m_user_group->user_group=$this->input->post('user_group',TRUE);
                $m_user_group->user_group_desc=$this->input->post('user_group_desc',TRUE);
                $m_user_group->date_created = date("Y-m-d H:i:s");
                $m_user_group->created_by = $this->session->user_id;
                $m_user_group->company_id = $this->session->company_id;
                $m_user_group->save();

                $user_group_id=$m_user_group->last_insert_id();
                foreach($_POST as $key => $val)
                {
                    if($key=="user_group" || $key=="user_group_desc"){
                        /*echo "patient";*/
                    }
                    else{
                        $m_user_group_rights->$key=$this->input->post($key);
                    }
                }

                $m_user_group_rights->user_group_id=$user_group_id;
                $m_user_group_rights->company_id = $this->session->company_id;
                $m_user_group_rights->save();


                $response['title']='Success!';
                $response['stat']='success';
                $response['msg']='User Rights successfully created.';
                $response['row_added']=$m_user_group->get_userrights_list(null,$user_group_id);
                echo json_encode($response);

                break;
            //****************************************************************************************************************
            case 'update' :
                $m_user_group=$this->User_groups_model;
                $m_user_group_rights=$this->User_rights_model;
                $user_group_id=$this->input->post('user_group_id',TRUE);
                $m_user_group->user_group=$this->input->post('user_group',TRUE);
                $m_user_group->user_group_desc=$this->input->post('user_group_desc',TRUE);
                $m_user_group->date_modified = date("Y-m-d H:i:s");
                $m_user_group->modified_by = $this->session->user_id;
                $m_user_group->company_id = $this->session->company_id;
                $m_user_group->modify($user_group_id);

                $m_user_group_rights->delete_via_fk($user_group_id);

                foreach($_POST as $key => $val)
                {
                    if($key=="user_group" || $key=="user_group_desc"){
                        /*echo "patient";*/
                    }
                    else{
                        $m_user_group_rights->$key=$this->input->post($key);
                    }
                }

                $m_user_group_rights->company_id = $this->session->company_id;
                $m_user_group_rights->save();


                $response['title']='Success!';
                $response['stat']='success';
                $response['msg']='User Rights successfully Updated.';
                $response['row_updated']=$m_user_group->get_userrights_list(null,$user_group_id);
                echo json_encode($response);

                break;
            //****************************************************************************************************************
            case 'delete':
                $m_user_group=$this->User_groups_model;
                $user_group_id=$this->input->post('user_group_id',TRUE);

                $m_user_group->is_deleted=1;
                $m_user_group->date_deleted = date("Y-m-d H:i:s");
                $m_user_group->deleted_by = $this->session->user_id;
                if($m_user_group->modify($user_group_id)){
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
