<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RefPhilHealth_Contribution extends CORE_Controller
{

    function __construct() {
        parent::__construct('');
        if($this->session->userdata('user_id') == FALSE) {
            redirect('../login');
        } 
        if($this->session->userdata('right_philhealth_view') == 0 || $this->session->userdata('right_philhealth_view') == null) {
            redirect('../Dashboard');
        }
        else{
            
        }
        $this->validate_session();
        $this->load->model('RefPhilHealth_Contribution_model');

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
        $data['title'] = 'JCORE - PhilHealth Contribution Table';
        $this->load->view('ref_philhealth_contribution_view', $data);
    }

    function transaction($txn = null) {
        switch ($txn) {
            case 'list':
                $response['data']=$this->RefPhilHealth_Contribution_model->get_list(
                    array('ref_philhealth_contribution.is_deleted'=>FALSE)
                    );
                echo json_encode($response);
                break;

            case 'create':
                $m_philhealth_contribution = $this->RefPhilHealth_Contribution_model;

                $salaryrangefromtemp = $this->input->post('salary_range_from', TRUE);
                $salary_range_from = $this->get_numeric_value($salaryrangefromtemp);

                $salaryrangetotemp = $this->input->post('salary_range_to', TRUE);
                $salary_range_to = $this->get_numeric_value($salaryrangetotemp);

                $employeetemp = $this->input->post('employee', TRUE);
                $employee = $this->get_numeric_value($employeetemp);

                $employertemp = $this->input->post('employer', TRUE);
                $employer = $this->get_numeric_value($employertemp);

                $total = $employee + $employer;

                $m_philhealth_contribution->salary_range_from = $salary_range_from;
                $m_philhealth_contribution->salary_range_to = $salary_range_to;
                $m_philhealth_contribution->employee = $employee;
              	$m_philhealth_contribution->employer = $employer ;
                $m_philhealth_contribution->total = $total;
                $m_philhealth_contribution->date_created = date("Y-m-d H:i:s");
                $m_philhealth_contribution->created_by = $this->session->user_id;
                $m_philhealth_contribution->save();

                $ref_philhealth_contribution_id = $m_philhealth_contribution->last_insert_id();


                $response['title'] = 'Success!';
                $response['stat'] = 'success';
                $response['msg'] = 'PhilHealth Contribution information successfully created.';

                $response['row_added'] = $this->RefPhilHealth_Contribution_model->get_list($ref_philhealth_contribution_id);
                echo json_encode($response);

                break;

            case 'delete':
                $m_philhealth_contribution=$this->RefPhilHealth_Contribution_model;

                $ref_philhealth_contribution_id=$this->input->post('ref_philhealth_contribution_id',TRUE);

                $m_philhealth_contribution->is_deleted=1;
                $m_philhealth_contribution->date_deleted = date("Y-m-d H:i:s");
                $m_philhealth_contribution->deleted_by = $this->session->user_id;
                if($m_philhealth_contribution->modify($ref_philhealth_contribution_id)){
                    $response['title']='Success!';
                    $response['stat']='success';
                    $response['msg']='PhilHealth Contribution information successfully deleted.';

                    echo json_encode($response);
                }

                break;

            case 'update':
                $m_philhealth_contribution = $this->RefPhilHealth_Contribution_model;

               	$ref_philhealth_contribution_id=$this->input->post('ref_philhealth_contribution_id',TRUE);

                $salaryrangefromtemp = $this->input->post('salary_range_from', TRUE);
                $salary_range_from = $this->get_numeric_value($salaryrangefromtemp);

                $salaryrangetotemp = $this->input->post('salary_range_to', TRUE);
                $salary_range_to = $this->get_numeric_value($salaryrangetotemp);

                $employeetemp = $this->input->post('employee', TRUE);
                $employee = $this->get_numeric_value($employeetemp);

                $employertemp = $this->input->post('employer', TRUE);
                $employer = $this->get_numeric_value($employertemp);

                $total = $employee + $employer;

                $m_philhealth_contribution->salary_range_from = $salary_range_from;
                $m_philhealth_contribution->salary_range_to = $salary_range_to;
                $m_philhealth_contribution->employee = $employee;
                $m_philhealth_contribution->employer = $employer ;
                $m_philhealth_contribution->total = $total;
                $m_philhealth_contribution->date_modified = date("Y-m-d H:i:s");
                $m_philhealth_contribution->modified_by = $this->session->user_id;
                $m_philhealth_contribution->modify($ref_philhealth_contribution_id);

                $response['title']='Success';
                $response['stat']='success';
                $response['msg']='PhilHealth Contribution information successfully updated.';
                $response['row_updated']=$this->RefPhilHealth_Contribution_model->get_list($ref_philhealth_contribution_id);
                echo json_encode($response);

                break;

            case 'test':
            	
            	break;

        }
    }











}
