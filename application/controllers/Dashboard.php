<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);
class Dashboard extends CORE_Controller {

    function __construct()
    {
        parent::__construct('');
        $this->load->model('Employee_model');
        $this->load->model('Users_model');
        $this->load->model('Wall_post_model');
        $this->validate_session();

    }

    public function index()
    {
        $data['_def_css_files']=$this->load->view('template/assets/css_files','',TRUE);
        $data['_def_js_files']=$this->load->view('template/assets/js_files','',TRUE);
        $data['_switcher_settings']=$this->load->view('template/elements/switcher','',TRUE);
        $data['_side_bar_navigation']=$this->load->view('template/elements/side_bar_navigation','',TRUE);
        $data['_top_navigation']=$this->load->view('template/elements/top_navigationfor_dash','',TRUE);
        $data['_rights'] = $this->load->view('template/elements/rights', '', TRUE);
        $data['loader'] = $this->load->view('template/elements/loader', '', TRUE);
        $data['loaderscript'] = $this->load->view('template/elements/loaderscript', '', TRUE);
        /*getting retired employees*/
        $getretired=$this->Employee_model->get_retired_list($this->session->company_id);
        /*getting ALL employees*/
        $gettotalemployee=$this->Employee_model->getcountemployee($this->session->company_id);
        /*computing percentage*/
       /* echo $gettotalemployee[0]->total_employee;*/
        $data['active_count']=abs($gettotalemployee[0]->total_employee-$getretired[0]->retired_employees);
        $data['retired_count']=$getretired[0]->retired_employees;
        $data['retired_percentage']=round(($getretired[0]->retired_employees/$gettotalemployee[0]->total_employee)*100,2);
        $data['active_percentage']=abs($data['retired_percentage']-100);
        //get online users
        $getonlineusers=$this->Users_model->get_onlineuser_list($this->session->company_id,1);
        //get all users
        $getalleusers=$this->Users_model->get_alluser_list($this->session->company_id);
        $data['percent_online_users']=round(($getonlineusers[0]->online_users/$getalleusers[0]->all_users)*100,2);
        $data['percent_offline_users']=abs($data['percent_online_users']-100);
        $data['online_users']=$getonlineusers[0]->online_users;
        $data['offline_users']=abs($getalleusers[0]->all_users-$getonlineusers[0]->online_users);
        //box users
        $data['online_users_box']=$getonlineusers=$this->Users_model->get_onlineuser_list($this->session->company_id,1);
        $data['offline_users_box']=$this->Users_model->get_onlineuser_list($this->session->company_id,0);
        //wall post
        $data['wall_post']=$this->Wall_post_model->get_wall_post($this->session->company_id);
        $data['count']=$this->Wall_post_model->get_wallpost_list($this->session->company_id);
        $data['empperdept']=$this->Employee_model->empcountperdept($this->session->company_id);
        $data['monthlygross']=$this->Employee_model->dashmonthlygross($this->session->company_id);
        $data['compensationdept']=$this->Employee_model->dashcompensationdept($this->session->company_id);
        $data['empperbranch']=$this->Employee_model->empcountperbranch($this->session->company_id);
        $data['user_id']=$this->session->user_id;
        $data['title'] = 'JCORE - Dashboard';
        $this->load->view('dashboard_view',$data);
    }

    function transaction($txn = null) {
        switch ($txn) {
            
            case 'getExpiringPersonnel':
                $type = $this->input->post('type', TRUE);
                $response['data']=$this->Employee_model->getExpiringPersonnel($type,1,0,0);
                echo json_encode($response);
            break; 

            case 'getstats':
                $this->validate_session();
                $getretired=$this->Employee_model->get_retired_list($this->session->company_id);
                /*getting ALL employees*/
                $gettotalemployee=$this->Employee_model->getcountemployee($this->session->company_id);
                /*computing percentage*/
               /* echo $gettotalemployee[0]->total_employee;*/
                $response['active_count']=abs($gettotalemployee[0]->total_employee-$getretired[0]->retired_employees);
                $response['retired_count']=$getretired[0]->retired_employees;
                $response['retired_percentage']=round(($getretired[0]->retired_employees/$gettotalemployee[0]->total_employee)*100,2);
                $response['active_percentage']=abs($response['retired_percentage']-100);
                //get online users
                $getonlineusers=$this->Users_model->get_onlineuser_list($this->session->company_id,1);
                //get all users
                $getalleusers=$this->Users_model->get_alluser_list($this->session->company_id);
                $response['percent_online_users']=round(($getonlineusers[0]->online_users/$getalleusers[0]->all_users)*100,2);
                $response['percent_offline_users']=abs($response['percent_online_users']-100);
                $response['online_users']=$getonlineusers[0]->online_users;
                $response['offline_users']=abs($getalleusers[0]->all_users-$getonlineusers[0]->online_users);
                //box users online
                $response['online_users_box']=$this->Users_model->get_onlineuser_list($this->session->company_id,1);
                //box users offline
                $response['offline_users_box']=$this->Users_model->get_onlineuser_list($this->session->company_id,0);
                //wall post
                $chatamount = $this->input->post('chatamount', TRUE);
                $response['wall_post']=$this->Wall_post_model->wall_post($chatamount,$this->session->company_id);
                $response['count']=$this->Wall_post_model->get_wallpost_list($this->session->company_id);   

                echo json_encode($response);
            break;

            case 'create':
                $m_wallpost=$this->Wall_post_model;
                $m_wallpost->post_content=$this->input->post('post_content',TRUE);
                $m_wallpost->user_id = $this->session->user_id;
                $m_wallpost->date_created = date("Y-m-d H:i:s");
                $m_wallpost->company_id = $this->session->company_id;
                $m_wallpost->save();

                $response['title']='Success!';
                $response['stat']='success';
                $response['msg']='Post Successfull.';
                echo json_encode($response);

            break;
        }
    }
}
