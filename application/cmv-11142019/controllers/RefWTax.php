<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RefWtax extends CORE_Controller
{

    function __construct() {
        parent::__construct('');
        if($this->session->userdata('user_id') == FALSE) {
            redirect('../login');
        } 
        if($this->session->userdata('right_taxtable_view') == 0 || $this->session->userdata('right_taxtable_view') == null) {
            redirect('../Dashboard');
        }
        else{
            
        }
        $this->validate_session();
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
        $data['title'] = 'JCORE - Tax Contribution Table';
        $this->load->view('ref_wtax_view', $data);
    }

    function transaction($txn = null) {
        switch ($txn) {
            case 'list':
                $response['data']=$this->RefPayFrequency_model->get_list(array('ref_payfrequency_type.is_deleted'=>FALSE));

            	echo json_encode($response);

				break;

            case 'taxMonthly':
            	$response['data']=$this->RefPayFrequency_model->get_list(
            		array('ref_payfrequency_type.is_deleted'=>FALSE,'ref_payfrequency_type.ref_payfrequency_type_id'=>2),
            			'ref_payfrequency_type.*');
          		echo json_encode($response);
          			
          	break;

          	case 'taxSemiMonthly':
            	$response['data']=$this->RefPayFrequency_model->get_list(
            		array('ref_payfrequency_type.is_deleted'=>FALSE,'ref_payfrequency_type.ref_payfrequency_type_id'=>1),
            			'ref_payfrequency_type.*');
          		echo json_encode($response);
          			
          	break;

          	case 'taxWeekly':
            	$response['data']=$this->RefPayFrequency_model->get_list(
            		array('ref_payfrequency_type.is_deleted'=>FALSE,'ref_payfrequency_type.ref_payfrequency_type_id'=>4),
            			'ref_payfrequency_type.*');
          		echo json_encode($response);
          			
          	break;

          	case 'taxDaily':
            	$response['data']=$this->RefPayFrequency_model->get_list(
            		array('ref_payfrequency_type.is_deleted'=>FALSE,'ref_payfrequency_type.ref_payfrequency_type_id'=>3),
            			'ref_payfrequency_type.*');
          		echo json_encode($response);
          			
          	break;

            case 'test':
	
		  		$query = $this->db->query("SELECT * FROM employee_list");
		    	$response['data']=$query->result_array();

		    	echo json_encode($response);

                break;
        }
    }

}
