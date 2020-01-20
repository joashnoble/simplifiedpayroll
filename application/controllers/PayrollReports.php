<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PayrollReports extends CORE_Controller
{

    function __construct() {
        parent::__construct('');
        $this->validate_session();
        $this->load->model('Employee_model');
        $this->load->model('RefBranch_model');
        $this->load->model('RefDepartment_model');
        $this->load->model('Payslip_model');
        $this->load->model('CompanyManagement_model');
        $this->load->model('PayrollReports_model');
        $this->load->model('RefPayPeriod_model');
    }
    public function index() {
        $data['_def_css_files'] = $this->load->view('template/assets/css_files', '', TRUE);
        $data['_def_js_files'] = $this->load->view('template/assets/js_files', '', TRUE);
        $data['_switcher_settings'] = $this->load->view('template/elements/switcher', '', TRUE);
        $data['_side_bar_navigation'] = $this->load->view('template/elements/side_bar_navigation', '', TRUE);
        $data['_top_navigation'] = $this->load->view('template/elements/top_navigation', '', TRUE);
        $data['loader'] = $this->load->view('template/elements/loader', '', TRUE);
        $data['loaderscript'] = $this->load->view('template/elements/loaderscript', '', TRUE);
        $data['ref_group']=$this->RefGroup_model->get_list(array('refgroup.is_deleted'=>FALSE));
        $data['ref_department']=$this->RefDepartment_model->get_list(array('ref_department.is_deleted'=>FALSE));
    }


    function payrollreports($payrollreports=null,$filter_value=null,$filter_value2=null,$filter_value3=null,$filter_value4=null,$filter_value5=null,$type=null){

        switch($payrollreports){

            case 'report1601C':

                $company_id = $this->session->company_id;
                $year = $filter_value;        
                $month = $filter_value2;
                $branch_id = $filter_value3;
                $department_id = $filter_value4;
                $emp_status = $filter_value5;

                $getcompany=$this->CompanyManagement_model->get_company_list($company_id);
                $data['company']=$getcompany[0];
                $data['report1601C']=$this->PayrollReports_model->get_1601C_list($company_id,$year,$month,$branch_id,$department_id,$emp_status);
                $data['year']=$year;
                $data['type']=$type;

               if($branch_id!="all"){
                    $getbranch=$this->RefBranch_model->get_list(
                    $branch_id,
                    'ref_branch.branch'
                    );
                    $data['get_branch'] = $getbranch[0]->branch;
                }
                else{
                    $data['get_branch'] = "All";
                }

                if($department_id!="all"){
                    $getdepartment=$this->RefDepartment_model->get_list(
                    $department_id,
                    'ref_department.department'
                    );
                    $data['get_department'] = $getdepartment[0]->department;
                }
                else{
                    $data['get_department'] = "All";
                }

                if ($month == 1){
                    $data['month']='January';
                }else if ($month == 2){
                    $data['month']='February'; 
                }else if ($month == 3){
                    $data['month']='March';
                }else if ($month == 4){
                    $data['month']='April';
                }else if ($month == 5){
                    $data['month']='May';
                }else if ($month == 6){
                    $data['month']='June';
                }else if ($month == 7){
                    $data['month']='July';
                }else if ($month == 8){
                    $data['month']='August';
                }else if ($month == 9){
                    $data['month']='September';
                }else if ($month == 10){
                    $data['month']='October';
                }else if ($month == 11){
                    $data['month']='November';
                }else if ($month == 12){
                    $data['month']='December';
                }

                echo $this->load->view('template/1601C_list_html',$data,TRUE);
            break;

            case 'payroll-employee-ledger': //

                        $company_id = $this->session->company_id;
                        $employee = $filter_value;
                        $ref_loan_id = $filter_value2;
                        $type = $filter_value3;

                        $data['loans']=$this->PayrollReports_model->getloan($company_id,$employee,$ref_loan_id);

                        $loans = $data['loans'];
                        $getcompany=$this->CompanyManagement_model->get_list(
                        null,
                        'company_management.*'
                        );
                         $data['company']=$getcompany[0];

                        if(isset($loans[0]->deduction_regular_id)){
                            $deduction_regular_id = $loans[0]->deduction_regular_id;
                            $data['loanadjustments']=$this->PayrollReports_model->getloanadjustments($deduction_regular_id);
                        }

                            $typeofloan=$this->RefDeductionSetup_model->get_list(
                            $filter_value2,
                            'refdeduction.deduction_desc'
                            );
                            $get_type = $typeofloan[0]->deduction_desc;

                        $data['get_type']=$get_type;
                        /*$data['loanadjustments']=$this->PayrollReports_model->getloan($filter_value,$filter_value2);*/
                        $data['total_loan_amount']=$this->PayrollReports_model->getloanamount($filter_value,$filter_value2);
                        /*echo json_encode($data);*/
                            echo $this->load->view('template/payroll_employee_loans_html',$data,TRUE);

                        break;

            case 'payroll-loan-amount-get': //
                    $loan_total_amount=$this->PayrollReports_model->getloanamount($filter_value,$filter_value2);
                    if($loan_total_amount[0]->count==0 || $loan_total_amount[0]->count==null){
                        $response['deduction_regular_id']=$loan_total_amount[0]->deduction_regular_id;
                        $response['total_loan_amount']="No Loan Found";
                        $response['deduction_per_pay_amount']=0;
                        $response['deduction_total_amount']=0;
                        echo json_encode($response);
                    }
                    else{
                        /*$response['test'] = $loan_total_amount[0]->psdamount;*/
                        $totalbalance = $loan_total_amount[0]->deduction_total_amount;
                        $response['deduction_regular_id']=$loan_total_amount[0]->deduction_regular_id;
                        $response['total_loan_amount']=$loan_total_amount[0]->loan_total_amount;
                        $response['deduction_per_pay_amount']=$loan_total_amount[0]->deduction_per_pay_amount;
                        $response['deduction_total_amount']=$totalbalance;

                        echo json_encode($response);
                    }
            break;

            case 'alpha_list':

                $company_id = $this->session->company_id;
                $year = $filter_value;
                $branch_id = $filter_value2;
                $department_id = $filter_value3;
                $emp_status  = $filter_value4;

                $getcompany=$this->CompanyManagement_model->get_company_list($company_id);

                if($branch_id!="all"){
                    $getbranch=$this->RefBranch_model->get_list(
                    $branch_id,
                    'ref_branch.branch'
                    );
                    $data['get_branch'] = $getbranch[0]->branch;
                }
                else{
                    $data['get_branch'] = "All";
                }

                if($department_id!="all"){
                    $getdepartment=$this->RefDepartment_model->get_list(
                    $department_id,
                    'ref_department.department'
                    );
                    $data['get_department'] = $getdepartment[0]->department;
                }
                else{
                    $data['get_department'] = "All";
                }

                $data['alpha_list']=$this->PayrollReports_model->get_alpha_list($this->session->company_id,$year,$branch_id,$department_id,$emp_status);
                $data['year']=$year;
                $data['type']=$filter_value5;
                $data['company']=$getcompany[0];

                echo $this->load->view('template/alpha_list_html',$data,TRUE);
            break;

        }
    }
}
