<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CORE_Controller extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }


    function validate_session(){
        $this->db->select('session_status');
        $this->db->where('user_id', $this->session->user_id);
        $query = $this->db->get('user_accounts');
        $queryget = $query->result();
        $queryget[0]->session_status;
        $session_status = $queryget[0]->session_status;


        if(!$this->session->user_id){
            redirect(base_url().'login');
        }else{
            
            if($session_status==0 || $session_status==null){
                session_destroy();
                redirect(base_url().'login');
            }
        }

    }

    function validate_admin_session(){
        $this->db->select('status');
        $this->db->where('admin_id', $this->session->admin_id);
        $query = $this->db->get('admin_user');
        $queryget = $query->result();
        $queryget[0]->status;
        $status = $queryget[0]->status;

        if($status==0 || $status==null){
            unset($_SESSION['admin_id']);
            redirect(base_url().'AdminLogin');
        }
        if(!$this->session->admin_id){
            redirect(base_url().'AdminLogin');
        }
    }

    function validate_company_session(){
        $this->db->select('session_status');
        $this->db->where('company_id', $this->session->company_id);
        $query = $this->db->get('company_management');
        $queryget = $query->result();
        $queryget[0]->session_status;
        $session_status = $queryget[0]->session_status;

        if($session_status==0 || $session_status==null){
            unset($_SESSION['company_id']);
            redirect(base_url().'CompanyLogin');
        }
        if(!$this->session->admin_id){
            redirect(base_url().'CompanyLogin');
        }
    }

    function end_session(){
        session_destroy();
        redirect(base_url().'login');
    }

    function end_admin_session(){
        $this->session->unset_userdata('admin_id');
        redirect(base_url().'AdminLogin');
    }

    function end_company_session(){
        session_destroy();
        redirect(base_url().'CompanyLogin');
    }

    function get_numeric_value($str){
        return (float)str_replace(',','',$str);
    }




}