<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DailyTimeRecord extends CORE_Controller
{

    function __construct() {
        parent::__construct('');
        $this->validate_session();
        $this->load->model('Employee_model');
        $this->load->model('DailyTimeRecord_model');
        $this->load->model('Dtr_Deductions_model');
        $this->load->model('RefPayPeriod_model');   
        $this->load->model('Emp_overtime_list_model');
        $this->load->model('Emp_holiday_pay_list_model');
        $this->load->model('RefFactorFile_model');
        $this->load->model('Payslip_model');
        $this->load->model('PaySlip_deduction_model');
        $this->load->model('Loan_list_model');
    }

    public function index() {
        $data['_def_css_files'] = $this->load->view('template/assets/css_files', '', TRUE);
        $data['_def_js_files'] = $this->load->view('template/assets/js_files', '', TRUE);
        $data['_switcher_settings'] = $this->load->view('template/elements/switcher', '', TRUE);
        $data['_side_bar_navigation'] = $this->load->view('template/elements/side_bar_navigation', '', TRUE);
        $data['_top_navigation'] = $this->load->view('template/elements/top_navigationforemployee', '', TRUE);
        $data['title'] = 'JCORE - Daily Time Record';
        $this->load->view('', $data);
    }

    function transaction($txn = null) {
        switch ($txn) {

            case 'list':
                $year = $this->input->post('year', TRUE);
                $pay_period_id = $this->input->post('payperiod', TRUE);
                $ref_branch_id = $this->input->post('branch', TRUE);
                $ref_department_id = $this->input->post('department', TRUE);

                $factor_file = $this->RefFactorFile_model->get_list('company_id='.$this->session->company_id);
                $pagibig1 = $factor_file[0]->pagibig1;

                if ($pay_period_id == "" || $pay_period_id == null){
                    $response['data'] = null;
                }else{
                    $get_frequency = $this->RefPayPeriod_model->get_list($pay_period_id);
                    $frequency = $get_frequency[0]->frequency;
                    $month_id = $get_frequency[0]->month_id;  
                    $sequence = $get_frequency[0]->pay_period_sequence;

                    $get_weekly_payperiod = $this->RefPayPeriod_model->get_weekly_payperiod($this->session->company_id,$year,$month_id);
                    $count = $get_weekly_payperiod[0]->count;

                    $chck_dtr_status = $this->DailyTimeRecord_model->get_dtr_status($this->session->company_id,$pay_period_id,$ref_branch_id,$ref_department_id);
                
                    if (count($chck_dtr_status) > 0){
                        $response['data'] = $this->DailyTimeRecord_model->get_dtr_list($this->session->company_id,$pay_period_id,$ref_branch_id,$ref_department_id,$pagibig1);
                    }else{
                        $response['data'] = $this->Employee_model->get_emp_list($this->session->company_id,$count,$frequency,$ref_branch_id,$ref_department_id,$sequence,$pagibig1);
                    }
                }

                echo json_encode($response);
            break;

            case 'refresh_list':

                $year = $this->input->post('year', TRUE);
                $pay_period_id = $this->input->post('payperiod', TRUE);
                $ref_branch_id = $this->input->post('branch', TRUE);
                $ref_department_id = $this->input->post('department', TRUE);

                $get_frequency = $this->RefPayPeriod_model->get_list($pay_period_id);
                $frequency = $get_frequency[0]->frequency;
                $month_id = $get_frequency[0]->month_id;  
                $sequence = $get_frequency[0]->pay_period_sequence;

                $factor_file = $this->RefFactorFile_model->get_list('company_id='.$this->session->company_id);
                $pagibig1 = $factor_file[0]->pagibig1;

                $get_weekly_payperiod = $this->RefPayPeriod_model->get_weekly_payperiod($this->session->company_id,$year,$month_id);
                $count = $get_weekly_payperiod[0]->count;  

                $chck_dtr_status = $this->DailyTimeRecord_model->get_dtr_status($this->session->company_id,$pay_period_id,$ref_branch_id,$ref_department_id);
            
                if (count($chck_dtr_status) > 0){
                    $response['data'] = $this->DailyTimeRecord_model->get_refresh_dtr_list($this->session->company_id,$count,$frequency,$pay_period_id,$ref_branch_id,$ref_department_id,$sequence,$pagibig1);
                }else{
                    $response['data'] = $this->Employee_model->get_emp_list($this->session->company_id,$count,$frequency,$ref_branch_id,$ref_department_id,$sequence,$pagibig1);
                }
                echo json_encode($response);
            break;

            case 'ot_list':
                $year = $this->input->post('year', TRUE);
                $pay_period_id = $this->input->post('payperiod', TRUE);
                $ref_branch_id = $this->input->post('branch', TRUE);
                $ref_department_id = $this->input->post('department', TRUE);

                $get_frequency = $this->RefPayPeriod_model->get_list($pay_period_id);
                $frequency = $get_frequency[0]->frequency;
                $month_id = $get_frequency[0]->month_id;  
                $sequence = $get_frequency[0]->pay_period_sequence;

                $get_weekly_payperiod = $this->RefPayPeriod_model->get_weekly_payperiod($this->session->company_id,$year,$month_id);
                $count = $get_weekly_payperiod[0]->count;

                $chck_ot_status = $this->Emp_overtime_list_model->get_ot_status($this->session->company_id,$pay_period_id,$ref_branch_id,$ref_department_id);

                if (count($chck_ot_status) > 0){
                    $response['data'] = $this->Emp_overtime_list_model->get_ot_list($this->session->company_id,$pay_period_id,$ref_branch_id,$ref_department_id);
                }else{
                    $response['data'] = $this->Employee_model->get_emp_list($this->session->company_id,$count,$frequency,$ref_branch_id,$ref_department_id,$sequence);
                }

                echo json_encode($response);
            break;

            case 'holiday_pay_list':
                $year = $this->input->post('year', TRUE);
                $pay_period_id = $this->input->post('payperiod', TRUE);
                $ref_branch_id = $this->input->post('branch', TRUE);
                $ref_department_id = $this->input->post('department', TRUE);

                $get_frequency = $this->RefPayPeriod_model->get_list($pay_period_id);
                $frequency = $get_frequency[0]->frequency;
                $month_id = $get_frequency[0]->month_id;  
                $sequence = $get_frequency[0]->pay_period_sequence;

                $get_weekly_payperiod = $this->RefPayPeriod_model->get_weekly_payperiod($this->session->company_id,$year,$month_id);
                $count = $get_weekly_payperiod[0]->count;

                $chck_hol_status = $this->Emp_holiday_pay_list_model->get_hol_status($this->session->company_id,$pay_period_id,$ref_branch_id,$ref_department_id);

                if (count($chck_hol_status) > 0){
                    $response['data'] = $this->Emp_holiday_pay_list_model->get_hol_list($this->session->company_id,$pay_period_id,$ref_branch_id,$ref_department_id);
                }else{
                    $response['data'] = $this->Employee_model->get_emp_list($this->session->company_id,$count,$frequency,$ref_branch_id,$ref_department_id,$sequence);
                }

                echo json_encode($response);

            break;

            case 'getWTAXDeduction':
                $withholding_lookup = $this->input->post('withholding_lookup', TRUE);
                $ref_payfrequency_type_id = $this->input->post('ref_payfrequency_type_id', TRUE);
                $response['data'] = $this->DailyTimeRecord_model->Wtax_lookup($withholding_lookup,$ref_payfrequency_type_id);
                echo json_encode($response);
            break;

            case 'getdtrlist':
                $pay_period_id = $this->input->post('pay_period_id', TRUE);
                $ref_department_id = $this->input->post('ref_department_id', TRUE);
                $ref_branch_id = $this->input->post('ref_branch_id', TRUE);
                $space=" ";
                $test="";

                if($ref_department_id=="all" AND $ref_branch_id=="all"){
                $test=array('daily_time_record.pay_period_id'=>$pay_period_id,'daily_time_record.is_deleted'=>FALSE,'emp_rates_duties.active_rates_duties'=>TRUE,'employee_list.is_deleted'=>FALSE);
                }
                if($ref_department_id=="all" AND $ref_branch_id!="all"){
                $test=array('daily_time_record.pay_period_id'=>$pay_period_id,'daily_time_record.is_deleted'=>FALSE,'emp_rates_duties.active_rates_duties'=>TRUE,'emp_rates_duties.ref_branch_id'=>$ref_branch_id,'employee_list.is_deleted'=>FALSE);

                }
                if($ref_department_id!="all" AND $ref_branch_id=="all"){
                $test=array('daily_time_record.pay_period_id'=>$pay_period_id,'daily_time_record.is_deleted'=>FALSE,'emp_rates_duties.active_rates_duties'=>TRUE,'emp_rates_duties.ref_department_id'=>$ref_department_id,'employee_list.is_deleted'=>FALSE);

                }
                if($ref_department_id!="all" AND $ref_branch_id!="all"){
                $test=array('daily_time_record.pay_period_id'=>$pay_period_id,'daily_time_record.is_deleted'=>FALSE,'emp_rates_duties.active_rates_duties'=>TRUE,'emp_rates_duties.ref_department_id'=>$ref_department_id,'emp_rates_duties.ref_branch_id'=>$ref_branch_id,'employee_list.is_deleted'=>FALSE);

                }
                
                $response['data']=$this->DailyTimeRecord_model->get_list(
                    $test,
                    'daily_time_record.*,employee_list.*,CONCAT(employee_list.first_name," ",middle_name," ",employee_list.last_name) as full_name,ref_department.department',
                    array(
                         array('employee_list','employee_list.employee_id=daily_time_record.employee_id','left'),
                         array('emp_rates_duties','emp_rates_duties.emp_rates_duties_id=employee_list.emp_rates_duties_id','left'),
                         array('ref_department','ref_department.ref_department_id=emp_rates_duties.ref_department_id','left'),
                        ),
                        'full_name ASC'
                    );
                echo json_encode($response);
            break;

            case 'dtristoprocess':
                $pay_period_id = $this->input->post('pay_period_id', TRUE);
                $ref_department_id = $this->input->post('ref_department_id', TRUE);
                $ref_branch_id = $this->input->post('ref_branch_id', TRUE);
                $space=" ";
                $test="";
                if($ref_department_id=="all" AND $ref_branch_id=="all"){
                $test=array('daily_time_record.pay_period_id'=>$pay_period_id,'daily_time_record.is_deleted'=>FALSE,'emp_rates_duties.active_rates_duties'=>TRUE,'employee_list.is_deleted'=>FALSE);
                }
                if($ref_department_id=="all" AND $ref_branch_id!="all"){
                $test=array('daily_time_record.pay_period_id'=>$pay_period_id,'daily_time_record.is_deleted'=>FALSE,'emp_rates_duties.active_rates_duties'=>TRUE,'emp_rates_duties.ref_branch_id'=>$ref_branch_id,'employee_list.is_deleted'=>FALSE);

                }
                if($ref_department_id!="all" AND $ref_branch_id=="all"){
                $test=array('daily_time_record.pay_period_id'=>$pay_period_id,'daily_time_record.is_deleted'=>FALSE,'emp_rates_duties.active_rates_duties'=>TRUE,'emp_rates_duties.ref_department_id'=>$ref_department_id,'employee_list.is_deleted'=>FALSE);

                }
                if($ref_department_id!="all" AND $ref_branch_id!="all"){
                $test=array('daily_time_record.pay_period_id'=>$pay_period_id,'daily_time_record.is_deleted'=>FALSE,'emp_rates_duties.active_rates_duties'=>TRUE,'emp_rates_duties.ref_department_id'=>$ref_department_id,'emp_rates_duties.ref_branch_id'=>$ref_branch_id,'employee_list.is_deleted'=>FALSE);

                }
                $response['data']=$this->DailyTimeRecord_model->get_list(
                    $test,
                    'daily_time_record.*,employee_list.*,CONCAT(employee_list.first_name," ",middle_name," ",employee_list.last_name) as full_name,ref_department.department',
                    array(
                         array('employee_list','employee_list.employee_id=daily_time_record.employee_id','left'),
                         array('emp_rates_duties','emp_rates_duties.emp_rates_duties_id=employee_list.emp_rates_duties_id','left'),
                         array('ref_department','ref_department.ref_department_id=emp_rates_duties.ref_department_id','left'),
                         array('ref_branch','ref_branch.ref_branch_id=emp_rates_duties.ref_branch_id','left'),
                         //array('pay_slip','pay_slip.dtr_id=daily_time_record.dtr_id','left'),
                        )
                    );
                echo json_encode($response);
                break;

/*
            case 'dtristoprocess':
                $pay_period_id = $this->input->post('pay_period_id', TRUE);
                $ref_department_id = $this->input->post('ref_department_id', TRUE);
                $group_id = $this->input->post('group_id', TRUE);
                $space=" ";
                $test="";
                if($ref_department_id=="all" AND $group_id=="all"){
                $test=array('daily_time_record.pay_period_id'=>$pay_period_id,'daily_time_record.is_deleted'=>FALSE,'emp_rates_duties.active_rates_duties'=>TRUE,'employee_list.is_deleted'=>FALSE,'daily_time_record.is_to_process'=>1);
                }
                if($ref_department_id=="all" AND $group_id!="all"){
                $test=array('daily_time_record.pay_period_id'=>$pay_period_id,'daily_time_record.is_deleted'=>FALSE,'emp_rates_duties.active_rates_duties'=>TRUE,'emp_rates_duties.group_id'=>$group_id,'employee_list.is_deleted'=>FALSE,'daily_time_record.is_to_process'=>1);

                }
                if($ref_department_id!="all" AND $group_id=="all"){
                $test=array('daily_time_record.pay_period_id'=>$pay_period_id,'daily_time_record.is_deleted'=>FALSE,'emp_rates_duties.active_rates_duties'=>TRUE,'emp_rates_duties.ref_department_id'=>$ref_department_id,'employee_list.is_deleted'=>FALSE,'daily_time_record.is_to_process'=>1);

                }
                if($ref_department_id!="all" AND $group_id!="all"){
                $test=array('daily_time_record.pay_period_id'=>$pay_period_id,'daily_time_record.is_deleted'=>FALSE,'emp_rates_duties.active_rates_duties'=>TRUE,'emp_rates_duties.ref_department_id'=>$ref_department_id,'emp_rates_duties.group_id'=>$group_id,'employee_list.is_deleted'=>FALSE,'daily_time_record.is_to_process'=>1);

                }
                $response['data']=$this->DailyTimeRecord_model->get_list(
                    $test,
                    'daily_time_record.*,employee_list.*,CONCAT(employee_list.first_name," ",middle_name," ",employee_list.last_name) as full_name,ref_department.department',
                    array(
                         array('employee_list','employee_list.employee_id=daily_time_record.employee_id','left'),
                         array('emp_rates_duties','emp_rates_duties.emp_rates_duties_id=employee_list.emp_rates_duties_id','left'),
                         array('ref_department','ref_department.ref_department_id=emp_rates_duties.ref_department_id','left'),
                        )
                    );
                echo json_encode($response);
                break;
                */

            case 'getdtr':
                $m_daily_time_record = $this->DailyTimeRecord_model;
                $pay_period_id = $this->input->post('pay_period_id', TRUE);;
                $response['data'] = $m_daily_time_record->getwithoutdtr($pay_period_id);

                echo json_encode($response);
                break;



            case 'create':
                $m_daily_time_record = $this->DailyTimeRecord_model;
                $m_dtr_deductions = $this->Dtr_Deductions_model;
                $m_schedules = $this->SchedEmployee_model;

                $user_id=$this->session->user_id;  // get id of current login user
                $employee_id = $this->input->post('employee_id', TRUE);
                $pay_period_id = $this->input->post('pay_period_id', TRUE);

                $per_hour_pay = $m_daily_time_record->get_per_hour_pay($employee_id);
                $salary_reg_rates = $m_daily_time_record->get_salary_pay($employee_id);
                $chck_pay_type = $m_daily_time_record->get_pay_type($employee_id);

                $chck_reg_holiday = $m_schedules->get_reg_hol_sched($employee_id,$pay_period_id);

                if (count($chck_reg_holiday) > 0){

                $count_reg_hol = $chck_reg_holiday[0]->count_reg_hol;
                $date_reg_hol = $chck_reg_holiday[0]->date;

                $date_before = date('Y-m-d',(strtotime ( '-1 day' , strtotime ( $date_reg_hol) ) ));
                $chck_before_date = $m_schedules->get_before_date($employee_id,$pay_period_id,$date_before);

                $count_before_date = $chck_before_date[0]->count_before_date;
                }else{
                    $count_reg_hol = 0;
                    $count_before_date = 0;
                }

                $ref_payment_type_id = $chck_pay_type[0]->ref_payment_type_id;
                $salary_rates = $chck_pay_type[0]->salary_reg_rates;
                /*$semi_monthly_verify = $m_daily_time_record->get_semi_monthly_pay($employee_id);
                $semi_monthly_pay = $semi_monthly_verify[0]->salary_reg_rates;
                $semi_monthly_pay_type = $semi_monthly_verify[0]->ref_payment_type_id;*/
                // 1 (ONE) is SEMI MONTHLY
                /*echo $semi_monthly_pay;
                echo $semi_monthly_pay_type;*/
                $factor_file = $m_daily_time_record->get_factorfile();

                $reg = $this->input->post('reg', TRUE);
                $sun = $this->input->post('sun', TRUE);
                $day_off = $this->input->post('day_off', TRUE);
                $reg_hol = $this->input->post('reg_hol', TRUE);
                $spe_hol = $this->input->post('spe_hol', TRUE);
                $sun_reg_hol = $this->input->post('sun_reg_hol', TRUE);
                $sun_spe_hol = $this->input->post('sun_spe_hol', TRUE);
                $days_wout_pay = $this->input->post('days_wout_pay', TRUE);
                $days_with_pay = $this->input->post('days_with_pay', TRUE);
                $minutes_late = $this->input->post('minutes_late', TRUE);
                $ot_reg = $this->input->post('ot_reg', TRUE);
                $ot_reg_reg_hol = $this->input->post('ot_reg_reg_hol', TRUE);
                $ot_reg_spe_hol = $this->input->post('ot_reg_spe_hol', TRUE);
                $ot_sun = $this->input->post('ot_sun', TRUE);
                $ot_sun_reg_hol = $this->input->post('ot_sun_reg_hol', TRUE);
                $ot_sun_spe_hol = $this->input->post('ot_sun_spe_hol', TRUE);
                $nsd_reg = $this->input->post('nsd_reg', TRUE);
                $nsd_reg_reg_hol = $this->input->post('nsd_reg_reg_hol', TRUE);
                $nsd_reg_spe_hol = $this->input->post('nsd_reg_spe_hol', TRUE);
                $nsd_sun = $this->input->post('nsd_sun', TRUE);
                $nsd_sun_reg_hol = $this->input->post('nsd_sun_reg_hol', TRUE);
                $nsd_sun_spe_hol = $this->input->post('nsd_sun_spe_hol', TRUE);

                $m_daily_time_record->employee_id = $employee_id;
                $m_daily_time_record->pay_period_id = $pay_period_id;

                $m_daily_time_record->reg = $this->get_numeric_value($reg);
                $m_daily_time_record->sun = $this->get_numeric_value($sun);
                $m_daily_time_record->day_off = $this->get_numeric_value($day_off);
                $m_daily_time_record->reg_hol = $this->get_numeric_value($reg_hol);
                $m_daily_time_record->spe_hol = $this->get_numeric_value($spe_hol);
                $m_daily_time_record->sun_reg_hol = $this->get_numeric_value($sun_reg_hol);
                $m_daily_time_record->sun_spe_hol = $this->get_numeric_value($sun_spe_hol);
                $m_daily_time_record->days_wout_pay = $this->get_numeric_value($days_wout_pay);
                $m_daily_time_record->days_with_pay = $this->get_numeric_value($days_with_pay);
                $m_daily_time_record->minutes_late = $this->get_numeric_value($minutes_late);
                $m_daily_time_record->ot_reg = $this->get_numeric_value($ot_reg);
                $m_daily_time_record->ot_reg_reg_hol = $this->get_numeric_value($ot_reg_reg_hol);
                $m_daily_time_record->ot_reg_spe_hol = $this->get_numeric_value($ot_reg_spe_hol);
                $m_daily_time_record->ot_sun = $this->get_numeric_value($ot_sun);
                $m_daily_time_record->ot_sun_reg_hol = $this->get_numeric_value($ot_sun_reg_hol);
                $m_daily_time_record->ot_sun_spe_hol = $this->get_numeric_value($ot_sun_spe_hol);

                $m_daily_time_record->nsd_reg = $this->get_numeric_value($nsd_reg);
                $m_daily_time_record->nsd_reg_reg_hol = $this->get_numeric_value($nsd_reg_reg_hol);
                $m_daily_time_record->nsd_reg_spe_hol = $this->get_numeric_value($nsd_reg_spe_hol);
                $m_daily_time_record->nsd_sun = $this->get_numeric_value($nsd_sun);
                $m_daily_time_record->nsd_sun_reg_hol = $this->get_numeric_value($nsd_sun_reg_hol);
                $m_daily_time_record->nsd_sun_spe_hol = $this->get_numeric_value($nsd_sun_spe_hol);

                $m_daily_time_record->reg_amt = $this->get_numeric_value($reg)*$per_hour_pay;
                $m_daily_time_record->for_13th_month = $reg*$per_hour_pay;

                $m_daily_time_record->sun_amt = $this->get_numeric_value($sun)*$per_hour_pay*$factor_file[0]->sunday;
                $m_daily_time_record->day_off_amt = $this->get_numeric_value($day_off)*$per_hour_pay*$factor_file[0]->day_off;

                if ($count_reg_hol == 1 && $count_before_date == 1){
                    $m_daily_time_record->reg_hol_amt = ($this->get_numeric_value($reg_hol)*$per_hour_pay*$factor_file[0]->regular_holiday);
                }else if ($count_reg_hol == 1 && $count_before_date == 0){
                    $m_daily_time_record->reg_hol_amt = ($this->get_numeric_value($reg_hol)*$per_hour_pay*1);
                }else if ($count_reg_hol == 0 && $count_before_date == 1){
                    $m_daily_time_record->reg_hol_amt = ($this->get_numeric_value($reg_hol)*$per_hour_pay*1);
                }else{
                    $m_daily_time_record->reg_hol_amt = 0.00;
                }
                
                $m_daily_time_record->spe_hol_amt = ($this->get_numeric_value($spe_hol)*$per_hour_pay*$factor_file[0]->spe_holiday);
                $m_daily_time_record->sun_reg_hol_amt = $this->get_numeric_value($sun_reg_hol)*$per_hour_pay*$factor_file[0]->sun_regular_holiday;
                $m_daily_time_record->sun_spe_hol_amt = $this->get_numeric_value($sun_spe_hol)*$per_hour_pay*$factor_file[0]->sun_spe_holiday;
                //skipped days w.pay wopay
                if($days_wout_pay!=null && $days_wout_pay!=0 && $days_wout_pay!='0.00'){
					/*echo $days_wout_pay;*/
                    $m_daily_time_record->days_wout_pay_amt = ($salary_reg_rates/13)*$days_wout_pay;
                }
                else{
                    $m_daily_time_record->days_wout_pay_amt = 0;
                }
				if($days_with_pay!=null && $days_with_pay!=0 && $days_with_pay!='0.00'){
                    $m_daily_time_record->days_with_pay_amt = ($salary_reg_rates/13)*$days_with_pay;
                }
				else{
                    $m_daily_time_record->days_with_pay_amt = 0;
                }


                $m_daily_time_record->minutes_late_amt = ($per_hour_pay/60)*$this->get_numeric_value($minutes_late);
                $m_daily_time_record->ot_reg_amt = $this->get_numeric_value($ot_reg)*$per_hour_pay*$factor_file[0]->regular_ot;
                $m_daily_time_record->ot_reg_reg_hol_amt = $this->get_numeric_value($ot_reg_reg_hol)*$per_hour_pay*$factor_file[0]->regular_holiday_ot;
                $m_daily_time_record->ot_reg_spe_hol_amt = $this->get_numeric_value($ot_reg_spe_hol)*$per_hour_pay*$factor_file[0]->spe_holiday_ot;
                $m_daily_time_record->ot_sun_amt = $this->get_numeric_value($ot_sun)*$per_hour_pay*$factor_file[0]->sunday_ot;
                $m_daily_time_record->ot_sun_reg_hol_amt = $this->get_numeric_value($ot_sun_reg_hol)*$per_hour_pay*$factor_file[0]->sun_regular_holiday_ot;
                $m_daily_time_record->ot_sun_spe_hol_amt = $this->get_numeric_value($ot_sun_spe_hol)*$per_hour_pay*$factor_file[0]->sun_spe_holiday_ot;
                $m_daily_time_record->nsd_reg_amt = $this->get_numeric_value($nsd_reg)*$per_hour_pay*$factor_file[0]->night_shift;
                $m_daily_time_record->nsd_reg_reg_hol_amt = $this->get_numeric_value($nsd_reg_reg_hol)*$per_hour_pay*$factor_file[0]->night_shift_reg_holiday;
                $m_daily_time_record->nsd_reg_spe_hol_amt = $this->get_numeric_value($nsd_reg_spe_hol)*$per_hour_pay*$factor_file[0]->night_shift_spe_holiday;
                $m_daily_time_record->nsd_sun_amt = $this->get_numeric_value($nsd_sun)*$per_hour_pay*$factor_file[0]->sun_night_shift;
                $m_daily_time_record->nsd_sun_reg_hol_amt = $this->get_numeric_value($nsd_sun_reg_hol)*$per_hour_pay*$factor_file[0]->sun_night_shift_reg_holiday;
                $m_daily_time_record->nsd_sun_spe_hol_amt = $this->get_numeric_value($nsd_sun_spe_hol)*$per_hour_pay*$factor_file[0]->sun_night_shift_spe_holiday;

                $m_daily_time_record->is_to_process = 1;
                $m_daily_time_record->date_created = date("Y-m-d");
                $m_daily_time_record->created_by = $user_id;
                $m_daily_time_record->save();

                $m_dtr_id = $m_daily_time_record->last_insert_id();

                //$m_products->set('quantity','quantity-'.$pos_qty[$i]);
                //$m_products->modify($product_id[$i]);

                $deduction_id=$this->input->post('deduction_id', TRUE);
                $deduction_regular_id=$this->input->post('deduction_regular_id', TRUE);
                $is_deduct=$this->input->post('dtr_deduction_checkbox', TRUE);

                $i=0;
                foreach($deduction_id as $deduction)
                        {
                            $data[] =
                               array(
                                  'dtr_id' => $m_dtr_id,
                                  'deduction_id' => $deduction_id[$i],
                                  'deduction_regular_id' => $deduction_regular_id[$i]
                               );
                            $i++;
                        }

                $this->db->insert_batch('dtr_deductions', $data);
                /*
                $m_dtr_deductions_id = $m_dtr_deductions->last_insert_id();
                $m_dtr_deductions->set('is_deduct',1);
                $m_dtr_deductions->modify(168);*/

                $this->DailyTimeRecord_model->applyisdeduct($m_dtr_id,$is_deduct);

                $response['title'] = 'Success!';
                $response['stat'] = 'success';
                $response['msg'] = 'Daily Time Record successfully created.';

                $response['row_added'] = $this->DailyTimeRecord_model->get_list(
                   $m_dtr_id,
                    'daily_time_record.*,employee_list.*,CONCAT(employee_list.first_name," ",middle_name," ",employee_list.last_name) as full_name,ref_department.department',
                    array(
                         array('employee_list','employee_list.employee_id=daily_time_record.employee_id','left'),
                         array('emp_rates_duties','emp_rates_duties.emp_rates_duties_id=employee_list.emp_rates_duties_id','left'),
                         array('ref_department','ref_department.ref_department_id=emp_rates_duties.ref_department_id','left'),
                        )
                    );
                echo json_encode($response);
                break;

            case 'delete':

                $m_daily_time_record = $this->DailyTimeRecord_model;
                $m_emp_holiday_pay_list = $this->Emp_holiday_pay_list_model;
                $m_emp_overtime_list = $this->Emp_overtime_list_model; 

                $dtr_id = $this->input->post('dtr_id', TRUE);
                $pay_period_id = $this->input->post('pay_period_id', TRUE);
                $employee_id = $this->input->post('employee_id', TRUE);

                $m_daily_time_record->is_deleted = 1;
                $m_daily_time_record->is_processed = 0;
                $m_daily_time_record->date_deleted = date("Y-m-d h:i:s");
                $m_daily_time_record->deleted_by = $this->session->user_id;
                $m_daily_time_record->modify($dtr_id);

                $getOtID = $this->Emp_overtime_list_model->getOtID($this->session->company_id,$pay_period_id,$employee_id);
                $getHolidayID = $this->Emp_holiday_pay_list_model->getHolidayID($this->session->company_id,$pay_period_id,$employee_id);

                if (count($getOtID) > 0){
                    $emp_overtime_id = $getOtID[0]->emp_overtime_id;
                    $m_emp_overtime_list->is_deleted = 1;
                    $m_emp_overtime_list->date_deleted = date("Y-m-d h:i:s");
                    $m_emp_overtime_list->deleted_by = $this->session->user_id;
                    $m_emp_overtime_list->modify($emp_overtime_id);
                }

                if (count($getHolidayID) > 0){
                    $emp_holiday_pay_id = $getHolidayID[0]->emp_holiday_pay_id;
                    $m_emp_holiday_pay_list->is_deleted = 1;
                    $m_emp_holiday_pay_list->date_deleted = date("Y-m-d h:i:s");
                    $m_emp_holiday_pay_list->deleted_by = $this->session->user_id;
                    $m_emp_holiday_pay_list->modify($emp_holiday_pay_id);
                }

                $response['title'] = 'Success!';
                $response['stat'] = 'success';
                $response['msg'] = 'Daily Time Record successfully updated.';

                echo json_encode($response);
            break;

            case 'update':
                $m_daily_time_record = $this->DailyTimeRecord_model;
                $m_dtr_deductions = $this->Dtr_Deductions_model;
                $m_schedules = $this->SchedEmployee_model;
                $m_pay_period = $this->RefPayPeriod_model;

                $user_id=$this->session->user_id;  // get id of current login user
                $employee_id = $this->input->post('employee_id', TRUE);
                // $pay_period_id = $this->input->post('pay_period_id', TRUE);
                $dtr_id = $this->input->post('dtr_id', TRUE);
                $m_dtr_id=$dtr_id;
                $per_hour_pay = $m_daily_time_record->get_per_hour_pay($employee_id);
                $salary_reg_rates = $m_daily_time_record->get_salary_pay($employee_id);
                $chck_pay_type = $m_daily_time_record->get_pay_type($employee_id);

                $get_pay_period = $m_daily_time_record->getperiodid($dtr_id);
                $pay_period_id = $get_pay_period[0]->pay_period_id;

                $chck_reg_holiday = $m_schedules->get_reg_hol_sched($employee_id,$pay_period_id);

                if (count($chck_reg_holiday) > 0){
                    $count_reg_hol = $chck_reg_holiday[0]->count_reg_hol;
                    $date_reg_hol = $chck_reg_holiday[0]->date;

                    $date_before = date('Y-m-d',(strtotime ( '-1 day' , strtotime ( $date_reg_hol) ) ));

                    $chck_before_date = $m_schedules->get_before_date($employee_id,$pay_period_id,$date_before);

                    $count_before_date = $chck_before_date[0]->count_before_date;
                }else{
                    $count_reg_hol = 0;
                    $count_before_date = 0;
                }

                $ref_payment_type_id = $chck_pay_type[0]->ref_payment_type_id;
                $salary_rates = $chck_pay_type[0]->salary_reg_rates;

                /*$semi_monthly_verify = $m_daily_time_record->get_semi_monthly_pay($employee_id);
                $semi_monthly_pay = $semi_monthly_verify[0]->salary_reg_rates;
                $semi_monthly_pay_type = $semi_monthly_verify[0]->ref_payment_type_id;*/
                // 1 (ONE) is SEMI MONTHLY
                /*echo $semi_monthly_pay;
                echo $semi_monthly_pay_type;*/
                $factor_file = $m_daily_time_record->get_factorfile();

                $reg = $this->input->post('reg', TRUE);
                $sun = $this->input->post('sun', TRUE);
                $day_off = $this->input->post('day_off', TRUE);
                $reg_hol = $this->input->post('reg_hol', TRUE);
                $spe_hol = $this->input->post('spe_hol', TRUE);
                $sun_reg_hol = $this->input->post('sun_reg_hol', TRUE);
                $sun_spe_hol = $this->input->post('sun_spe_hol', TRUE);
                $days_wout_pay = $this->input->post('days_wout_pay', TRUE);
                $days_with_pay = $this->input->post('days_with_pay', TRUE);
                $minutes_late = $this->input->post('minutes_late', TRUE);
                $ot_reg = $this->input->post('ot_reg', TRUE);
                $ot_reg_reg_hol = $this->input->post('ot_reg_reg_hol', TRUE);
                $ot_reg_spe_hol = $this->input->post('ot_reg_spe_hol', TRUE);
                $ot_sun = $this->input->post('ot_sun', TRUE);
                $ot_sun_reg_hol = $this->input->post('ot_sun_reg_hol', TRUE);
                $ot_sun_spe_hol = $this->input->post('ot_sun_spe_hol', TRUE);
                $nsd_reg = $this->input->post('nsd_reg', TRUE);
                $nsd_reg_reg_hol = $this->input->post('nsd_reg_reg_hol', TRUE);
                $nsd_reg_spe_hol = $this->input->post('nsd_reg_spe_hol', TRUE);
                $nsd_sun = $this->input->post('nsd_sun', TRUE);
                $nsd_sun_reg_hol = $this->input->post('nsd_sun_reg_hol', TRUE);
                $nsd_sun_spe_hol = $this->input->post('nsd_sun_spe_hol', TRUE);

                //$m_daily_time_record->employee_id = $employee_id;
                //$m_daily_time_record->pay_period_id = $pay_period_id;

                /*$m_daily_time_record->reg = $this->get_numeric_value($reg);*/
                $m_daily_time_record->reg = $this->get_numeric_value($reg);
                $m_daily_time_record->sun = $this->get_numeric_value($sun);
                $m_daily_time_record->day_off = $this->get_numeric_value($day_off);
                $m_daily_time_record->reg_hol = $this->get_numeric_value($reg_hol);
                $m_daily_time_record->spe_hol = $this->get_numeric_value($spe_hol);
                $m_daily_time_record->sun_reg_hol = $this->get_numeric_value($sun_reg_hol);
                $m_daily_time_record->sun_spe_hol = $this->get_numeric_value($sun_spe_hol);
                $m_daily_time_record->days_wout_pay = $this->get_numeric_value($days_wout_pay);
                $m_daily_time_record->days_with_pay = $this->get_numeric_value($days_with_pay);
                $m_daily_time_record->minutes_late = $this->get_numeric_value($minutes_late);
                $m_daily_time_record->ot_reg = $this->get_numeric_value($ot_reg);
                $m_daily_time_record->ot_reg_reg_hol = $this->get_numeric_value($ot_reg_reg_hol);
                $m_daily_time_record->ot_reg_spe_hol = $this->get_numeric_value($ot_reg_spe_hol);
                $m_daily_time_record->ot_sun = $this->get_numeric_value($ot_sun);
                $m_daily_time_record->ot_sun_reg_hol = $this->get_numeric_value($ot_sun_reg_hol);
                $m_daily_time_record->ot_sun_spe_hol = $this->get_numeric_value($ot_sun_spe_hol);

                $m_daily_time_record->nsd_reg = $this->get_numeric_value($nsd_reg);
                $m_daily_time_record->nsd_reg_reg_hol = $this->get_numeric_value($nsd_reg_reg_hol);
                $m_daily_time_record->nsd_reg_spe_hol = $this->get_numeric_value($nsd_reg_spe_hol);
                $m_daily_time_record->nsd_sun = $this->get_numeric_value($nsd_sun);
                $m_daily_time_record->nsd_sun_reg_hol = $this->get_numeric_value($nsd_sun_reg_hol);
                $m_daily_time_record->nsd_sun_spe_hol = $this->get_numeric_value($nsd_sun_spe_hol);

                $m_daily_time_record->reg_amt = $this->get_numeric_value($reg)*$per_hour_pay;
                $m_daily_time_record->for_13th_month = $reg*$per_hour_pay;

                $m_daily_time_record->sun_amt = $this->get_numeric_value($sun)*$per_hour_pay*$factor_file[0]->sunday;
                $m_daily_time_record->day_off_amt = $this->get_numeric_value($day_off)*$per_hour_pay*$factor_file[0]->day_off;

                if ($count_reg_hol == 1 && $count_before_date == 1){
                    $m_daily_time_record->reg_hol_amt = ($this->get_numeric_value($reg_hol)*$per_hour_pay*$factor_file[0]->regular_holiday);
                }else if ($count_reg_hol == 1 && $count_before_date == 0){
                    $m_daily_time_record->reg_hol_amt = ($this->get_numeric_value($reg_hol)*$per_hour_pay*1);
                }else if ($count_reg_hol == 0 && $count_before_date == 1){
                    $m_daily_time_record->reg_hol_amt = ($this->get_numeric_value($reg_hol)*$per_hour_pay*1);
                }else{
                    $m_daily_time_record->reg_hol_amt = 0.00;
                }

                $m_daily_time_record->spe_hol_amt = ($this->get_numeric_value($spe_hol)*$per_hour_pay*$factor_file[0]->spe_holiday);
                $m_daily_time_record->sun_reg_hol_amt = $this->get_numeric_value($sun_reg_hol)*$per_hour_pay*$factor_file[0]->sun_regular_holiday;
                $m_daily_time_record->sun_spe_hol_amt = $this->get_numeric_value($sun_spe_hol)*$per_hour_pay*$factor_file[0]->sun_spe_holiday;
                //skipped days w.pay wopay
                if($days_wout_pay!=null && $days_wout_pay!=0 && $days_wout_pay!='0.00'){
					/*echo $days_wout_pay;*/
                    $m_daily_time_record->days_wout_pay_amt = ($salary_reg_rates/13)*$days_wout_pay;
                }
                else{
                    $m_daily_time_record->days_wout_pay_amt = 0;
                }
				        if($days_with_pay!=null && $days_with_pay!=0 && $days_with_pay!='0.00'){
                    $m_daily_time_record->days_with_pay_amt = ($salary_reg_rates/13)*$days_with_pay;
                }
        				else{
                    $m_daily_time_record->days_with_pay_amt = 0;
                }
                $m_daily_time_record->minutes_late_amt = ($per_hour_pay/60)*$this->get_numeric_value($minutes_late);
                $m_daily_time_record->ot_reg_amt = $this->get_numeric_value($ot_reg)*$per_hour_pay*$factor_file[0]->regular_ot;
                $m_daily_time_record->ot_reg_reg_hol_amt = $this->get_numeric_value($ot_reg_reg_hol)*$per_hour_pay*$factor_file[0]->regular_holiday_ot;
                $m_daily_time_record->ot_reg_spe_hol_amt = $this->get_numeric_value($ot_reg_spe_hol)*$per_hour_pay*$factor_file[0]->spe_holiday_ot;
                $m_daily_time_record->ot_sun_amt = $this->get_numeric_value($ot_sun)*$per_hour_pay*$factor_file[0]->sunday_ot;
                $m_daily_time_record->ot_sun_reg_hol_amt = $this->get_numeric_value($ot_sun_reg_hol)*$per_hour_pay*$factor_file[0]->sun_regular_holiday_ot;
                $m_daily_time_record->ot_sun_spe_hol_amt = $this->get_numeric_value($ot_sun_spe_hol)*$per_hour_pay*$factor_file[0]->sun_spe_holiday_ot;
                $m_daily_time_record->nsd_reg_amt = $this->get_numeric_value($nsd_reg)*$per_hour_pay*$factor_file[0]->night_shift;
                $m_daily_time_record->nsd_reg_reg_hol_amt = $this->get_numeric_value($nsd_reg_reg_hol)*$per_hour_pay*$factor_file[0]->night_shift_reg_holiday;
                $m_daily_time_record->nsd_reg_spe_hol_amt = $this->get_numeric_value($nsd_reg_spe_hol)*$per_hour_pay*$factor_file[0]->night_shift_spe_holiday;
                $m_daily_time_record->nsd_sun_amt = $this->get_numeric_value($nsd_sun)*$per_hour_pay*$factor_file[0]->sun_night_shift;
                $m_daily_time_record->nsd_sun_reg_hol_amt = $this->get_numeric_value($nsd_sun_reg_hol)*$per_hour_pay*$factor_file[0]->sun_night_shift_reg_holiday;
                $m_daily_time_record->nsd_sun_spe_hol_amt = $this->get_numeric_value($nsd_sun_spe_hol)*$per_hour_pay*$factor_file[0]->sun_night_shift_spe_holiday;

                $m_daily_time_record->is_to_process = 1;
                $m_daily_time_record->date_modified = date("Y-m-d");
                $m_daily_time_record->modified_by = $user_id;
                $m_daily_time_record->modify($dtr_id);

                /*echo "done";
*/
                $m_dtr_deductions=$this->Dtr_Deductions_model;

                $m_dtr_deductions->delete_via_fk($dtr_id); //delete previous items then insert those new

                $deduction_id=$this->input->post('deduction_id', TRUE);
                $deduction_regular_id=$this->input->post('deduction_regular_id', TRUE);
                $is_deduct=$this->input->post('dtr_deduction_checkbox', TRUE);

                $i=0;
                foreach($deduction_id as $deduction)
                        {
                            $data[] =
                               array(
                                  'dtr_id' => $dtr_id,
                                  'deduction_id' => $deduction_id[$i],
                                  'deduction_regular_id' => $deduction_regular_id[$i]
                               );
                            $i++;
                        }

                $this->db->insert_batch('dtr_deductions', $data);

                $this->DailyTimeRecord_model->applyisdeduct($m_dtr_id,$is_deduct);
                $response['title']='Success!';
                $response['stat']='success';
                $response['msg']='DTR successfully Updated.';
                $response['row_updated'] = $this->DailyTimeRecord_model->get_list(
                   $dtr_id,
                    'daily_time_record.*,employee_list.*,CONCAT(employee_list.first_name," ",middle_name," ",employee_list.last_name) as full_name,ref_department.department',
                    array(
                         array('employee_list','employee_list.employee_id=daily_time_record.employee_id','left'),
                         array('emp_rates_duties','emp_rates_duties.emp_rates_duties_id=employee_list.emp_rates_duties_id','left'),
                         array('ref_department','ref_department.ref_department_id=emp_rates_duties.ref_department_id','left'),
                        )
                    );
                echo json_encode($response);
                break;

            case 'chckstatus':
              $dtr = $this->DailyTimeRecord_model;
              $employee_id = $this->input->post('employee_id', TRUE);
              $chck_pay_type = $dtr->get_pay_type($employee_id);
              echo json_encode($chck_pay_type);
            break;

             case 'processPayroll':
                $m_daily_time_record=$this->DailyTimeRecord_model;
                $m_emp_overtime_list=$this->Emp_overtime_list_model;
                $m_emp_holiday_pay_list=$this->Emp_holiday_pay_list_model;
                $m_payslip=$this->Payslip_model;
                $m_employee=$this->Employee_model;

                //tbl_dtr
                $pay_period_id = $this->input->post('pay_period_id',TRUE);
                $dtr_employee_id = $this->input->post('dtr_employee_id',TRUE);
                $is_processed = $this->input->post('is_processed', TRUE);
                $no_of_hrs = $this->input->post('no_of_hrs',TRUE);
                $per_day_pay = $this->input->post('per_day_pay',TRUE);
                $salary_reg_rates = $this->input->post('salary_reg_rates',TRUE);
                $basic_pay_total = $this->input->post('basic_pay_total',TRUE);
                $overtime = $this->input->post('overtime',TRUE);
                $holiday_pay = $this->input->post('holiday_pay',TRUE);
                $allowance_pay = $this->input->post('allowance_pay',TRUE);
                $commission = $this->input->post('commission',TRUE);
                $undertime = $this->input->post('undertime',TRUE);
                $late = $this->input->post('late',TRUE);
                $undertime_amt = $this->input->post('undertime_amt',TRUE);
                $late_amt = $this->input->post('late_amt',TRUE);
                $adjustment_additional = $this->input->post('adjustment_additional',TRUE);
                $adjustment_deduction = $this->input->post('adjustment_deduction',TRUE);
                $gross_total = $this->input->post('gross_total',TRUE);
                $sss_deduction = $this->input->post('sss_deduction',TRUE);
                $sss_employer = $this->input->post('sss_employer',TRUE);
                $sss_employer_contribution = $this->input->post('sss_employer_contribution',TRUE);
                $philhealth_deduction = $this->input->post('philhealth_deduction',TRUE);
                $philhealth_employer = $this->input->post('philhealth_employer',TRUE);
                $pagibig_deduction = $this->input->post('pagibig_deduction',TRUE);
                $wtax_deduction = $this->input->post('wtax_deduction',TRUE);
                $sss_loan = $this->input->post('sss_loan',TRUE);
                $pagibig_loan = $this->input->post('pagibig_loan',TRUE);
                $cash_advance = $this->input->post('cash_advance',TRUE);
                $sss_loan_id = $this->input->post('sss_loan_id',TRUE);
                $pagibig_loan_id = $this->input->post('pagibig_loan_id',TRUE);
                $cash_advance_id = $this->input->post('cash_advance_id',TRUE);
                $net_total = $this->input->post('net_total',TRUE);

                //tbl_ot
                $ot_employee_id = $this->input->post('ot_employee_id',TRUE);
                $reg_ot = $this->input->post('reg_ot',TRUE);
                $sun_ot = $this->input->post('sun_ot',TRUE);
                $reg_hol_ot = $this->input->post('reg_hol_ot',TRUE);
                $sun_reg_hol_ot = $this->input->post('sun_reg_hol_ot',TRUE);
                $spe_hol_ot = $this->input->post('spe_hol_ot',TRUE);
                $sun_spe_hol_ot = $this->input->post('sun_spe_hol_ot',TRUE);
                $reg_ot_amt = $this->input->post('reg_ot_amt',TRUE);
                $sun_ot_amt = $this->input->post('sun_ot_amt',TRUE);
                $reg_hol_ot_amt = $this->input->post('reg_hol_ot_amt',TRUE);
                $sun_reg_hol_ot_amt = $this->input->post('sun_reg_hol_ot_amt',TRUE);
                $spe_hol_ot_amt = $this->input->post('spe_hol_ot_amt',TRUE);
                $sun_spe_hol_ot_amt = $this->input->post('sun_spe_hol_ot_amt',TRUE);

                $overtime_total = $this->input->post('overtime_total',TRUE);

                //tbl_holiday
                $hol_employee_id = $this->input->post('hol_employee_id',TRUE);
                $reg_hol = $this->input->post('reg_hol',TRUE);
                $sun_reg_hol = $this->input->post('sun_reg_hol',TRUE);
                $spe_hol = $this->input->post('spe_hol',TRUE);
                $sun_spe_hol = $this->input->post('sun_spe_hol',TRUE);
                $reg_hol_amt = $this->input->post('reg_hol_amt',TRUE);
                $sun_reg_hol_amt = $this->input->post('sun_reg_hol_amt',TRUE);
                $spe_hol_amt = $this->input->post('spe_hol_amt',TRUE);
                $sun_spe_hol_amt = $this->input->post('sun_spe_hol_amt',TRUE);
                $holiday_total = $this->input->post('holiday_total',TRUE);
                $is_active = 0;

                for($i=0;$i<count($dtr_employee_id);$i++){

                    $chck_dtr_emp = $this->DailyTimeRecord_model->chck_dtr_emp($dtr_employee_id[$i],$pay_period_id);

                    $chck_status = $this->Employee_model->chck_emp_status($dtr_employee_id[$i]);
                    $is_active = $chck_status[0]->is_active;

                    $m_daily_time_record->pay_period_id = $pay_period_id;
                    $m_daily_time_record->employee_id = $dtr_employee_id[$i];
                    $m_daily_time_record->is_processed = $is_processed[$i];
                    $m_daily_time_record->no_of_hrs=$this->get_numeric_value($no_of_hrs[$i]);
                    $m_daily_time_record->per_day_pay=$this->get_numeric_value($per_day_pay[$i]);
                    $m_daily_time_record->salary_reg_rates=$this->get_numeric_value($salary_reg_rates[$i]);
                    $m_daily_time_record->basic_pay_total=$this->get_numeric_value($basic_pay_total[$i]);
                    $m_daily_time_record->overtime=$this->get_numeric_value($overtime[$i]);
                    $m_daily_time_record->holiday_pay=$this->get_numeric_value($holiday_pay[$i]);
                    $m_daily_time_record->allowance_pay=$this->get_numeric_value($allowance_pay[$i]);
                    $m_daily_time_record->commission=$this->get_numeric_value($commission[$i]);
                    $m_daily_time_record->undertime=$this->get_numeric_value($undertime[$i]);
                    $m_daily_time_record->late=$this->get_numeric_value($late[$i]);
                    $m_daily_time_record->undertime_amt=$this->get_numeric_value($undertime_amt[$i]);
                    $m_daily_time_record->late_amt=$this->get_numeric_value($late_amt[$i]);
                    $m_daily_time_record->adjustment_additional=$this->get_numeric_value($adjustment_additional[$i]);
                    $m_daily_time_record->adjustment_deduction=$this->get_numeric_value($adjustment_deduction[$i]);
                    $m_daily_time_record->gross_total=$this->get_numeric_value($gross_total[$i]);
                    $m_daily_time_record->sss_deduction=$this->get_numeric_value($sss_deduction[$i]);
                    $m_daily_time_record->sss_employer=$this->get_numeric_value($sss_employer[$i]);
                    $m_daily_time_record->sss_employer_contribution=$this->get_numeric_value($sss_employer_contribution[$i]);
                    $m_daily_time_record->philhealth_deduction=$this->get_numeric_value($philhealth_deduction[$i]);
                    $m_daily_time_record->philhealth_employer=$this->get_numeric_value($philhealth_employer[$i]);
                    $m_daily_time_record->pagibig_deduction=$this->get_numeric_value($pagibig_deduction[$i]);
                    $m_daily_time_record->wtax_deduction=$this->get_numeric_value($wtax_deduction[$i]);
                    $m_daily_time_record->total_deduction=$this->get_numeric_value(($sss_deduction[$i]+$philhealth_deduction[$i]+$pagibig_deduction[$i]+$wtax_deduction[$i]+$sss_loan[$i]+$pagibig_loan[$i]+$cash_advance[$i]));
                    $m_daily_time_record->net_total=$this->get_numeric_value($net_total[$i]);
                    $m_daily_time_record->for_13thmonth=$this->get_numeric_value($basic_pay_total[$i]);
                    $m_daily_time_record->company_id = $this->session->company_id;
                    $payslip_id = "";
                    if ($is_active == 1){
                    
                        if (count($chck_dtr_emp) > 0){
                            $dtr_id = $chck_dtr_emp[0]->dtr_id;
                            $m_daily_time_record->modified_by = $this->session->user_id;
                            $m_daily_time_record->date_modified = date("Y-m-d H:i:s");
                            $m_daily_time_record->modify($dtr_id);

                            $get_id = $this->Payslip_model->get_dtr_id($dtr_id);
                            $m_payslip->date_processed = date('Y-m-d');
                            $m_payslip->processed_by = $this->session->user_id;

                            if (count($get_id) <= 0){
                                $m_payslip->payslip_no = date('Y').'0'.$dtr_id;
                                $m_payslip->dtr_id = $dtr_id;
                                $m_payslip->save();
                            }else{
                                $payslip_id = $get_id[0]->pay_slip_id;
                                $m_payslip->modify($payslip_id);
                            }

                        }else{
                            $m_daily_time_record->created_by = $this->session->user_id;
                            $m_daily_time_record->date_created = date("Y-m-d H:i:s");
                            $m_daily_time_record->save();
                            $dtr_id = $m_daily_time_record->last_insert_id();

                            // Create payslip
                            $m_payslip->payslip_no = date('Y').'0'.$dtr_id;
                            $m_payslip->dtr_id = $dtr_id;
                            $m_payslip->date_processed = date('Y-m-d');
                            $m_payslip->processed_by = $this->session->user_id;
                            $m_payslip->save();
                            $payslip_id = $m_payslip->last_insert_id();
                        }

                        $company_id = $this->session->company_id;
                        $m_loan_list = $this->Loan_list_model;
                        $m_pay_slip_deduction = $this->PaySlip_deduction_model;
                        $m_pay_slip_deduction->delete_via_fk($payslip_id);

                        if ($sss_loan_id[$i] > 0){

                            $m_pay_slip_deduction->deduction_id = $sss_loan_id[$i];
                            $m_pay_slip_deduction->pay_slip_id = $payslip_id;
                            $m_pay_slip_deduction->deduction_amount = $this->get_numeric_value($sss_loan[$i]);
                            $m_pay_slip_deduction->save();

                            $sl_amount = $this->Loan_list_model->get_loan_list($company_id,$sss_loan_id[$i]);
                            $sld_amount = $this->Loan_list_model->get_pay_slip_deduction($sss_loan_id[$i]);

                            if (count($sl_amount) > 0){
                                $sss_balance = $sl_amount[0]->balance;
                                $sss_loan_deduct = $sld_amount[0]->deduction_amount;
                                $sss_amount = $sss_balance - $sss_loan_deduct;
                                $m_loan_list->balance = $this->get_numeric_value($sss_amount);
                                $m_loan_list->modify($sss_loan_id[$i]);    
                            }
                        }

                        if ($pagibig_loan_id[$i] > 0){

                            $m_pay_slip_deduction->deduction_id = $pagibig_loan_id[$i];
                            $m_pay_slip_deduction->pay_slip_id = $payslip_id;
                            $m_pay_slip_deduction->deduction_amount = $this->get_numeric_value($pagibig_loan[$i]);
                            $m_pay_slip_deduction->save();

                            $pl_amount = $this->Loan_list_model->get_loan_list($company_id,$pagibig_loan_id[$i]);
                            $pld_amount = $this->Loan_list_model->get_pay_slip_deduction($pagibig_loan_id[$i]);

                            if (count($pl_amount) > 0){
                                $pagibig_balance = $pl_amount[0]->balance;
                                $pagibig_loan_deduct = $pld_amount[0]->deduction_amount;
                                $pagibig_amount = $pagibig_balance - $pagibig_loan_deduct;
                                $m_loan_list->balance = $this->get_numeric_value($pagibig_amount);
                                $m_loan_list->modify($pagibig_loan_id[$i]);
                            }
                        }

                        if ($cash_advance_id[$i] > 0){

                            $m_pay_slip_deduction->deduction_id = $cash_advance_id[$i];
                            $m_pay_slip_deduction->pay_slip_id = $payslip_id;
                            $m_pay_slip_deduction->deduction_amount = $this->get_numeric_value($cash_advance[$i]);
                            $m_pay_slip_deduction->save();

                            $cal_amount = $this->Loan_list_model->get_loan_list($company_id,$cash_advance_id[$i]);
                            $cald_amount = $this->Loan_list_model->get_pay_slip_deduction($cash_advance_id[$i]);

                            if (count($cal_amount) > 0){
                                $ca_balance = $cal_amount[0]->balance;
                                $ca_loan_deduct = $cald_amount[0]->deduction_amount;
                                $ca_amount = $ca_balance - $ca_loan_deduct;
                                $m_loan_list->balance = $this->get_numeric_value($ca_amount);
                                $m_loan_list->modify($cash_advance_id[$i]);
                            }
                        }
                    }
                }

                for ($a=0;$a<count($ot_employee_id);$a++){

                    $chck_ot_emp = $this->Emp_overtime_list_model->chck_ot_emp($this->session->company_id,$ot_employee_id[$a],$pay_period_id);
                    $dtr =  $this->Emp_overtime_list_model->get_dtr_id($this->session->company_id,$ot_employee_id[$a],$pay_period_id);

                    $m_emp_overtime_list->employee_id = $ot_employee_id[$a];
                    $m_emp_overtime_list->pay_period_id = $pay_period_id;
                    $m_emp_overtime_list->company_id = $this->session->company_id;

                    if (count($dtr)>0){
                        $m_emp_overtime_list->dtr_id = $dtr[0]->dtr_id;
                    }else{ 
                        $m_emp_overtime_list->dtr_id = 0;
                    }

                    $m_emp_overtime_list->reg_ot=$this->get_numeric_value($reg_ot[$a]);
                    $m_emp_overtime_list->reg_ot_amt=$this->get_numeric_value($reg_ot_amt[$a]);
                    $m_emp_overtime_list->sun_ot=$this->get_numeric_value($sun_ot[$a]);
                    $m_emp_overtime_list->sun_ot_amt=$this->get_numeric_value($sun_ot_amt[$a]);
                    $m_emp_overtime_list->reg_hol_ot=$this->get_numeric_value($reg_hol_ot[$a]);
                    $m_emp_overtime_list->reg_hol_ot_amt=$this->get_numeric_value($reg_hol_ot_amt[$a]);
                    $m_emp_overtime_list->sun_reg_hol_ot=$this->get_numeric_value($sun_reg_hol_ot[$a]);
                    $m_emp_overtime_list->sun_reg_hol_ot_amt=$this->get_numeric_value($sun_reg_hol_ot_amt[$a]);
                    $m_emp_overtime_list->spe_hol_ot=$this->get_numeric_value($spe_hol_ot[$a]);
                    $m_emp_overtime_list->spe_hol_ot_amt=$this->get_numeric_value($spe_hol_ot_amt[$a]);
                    $m_emp_overtime_list->sun_spe_hol_ot=$this->get_numeric_value($sun_spe_hol_ot[$a]);
                    $m_emp_overtime_list->sun_spe_hol_ot_amt=$this->get_numeric_value($sun_spe_hol_ot_amt[$a]);
                    $m_emp_overtime_list->overtime_total=$this->get_numeric_value($overtime_total[$a]);

                    if ($is_active == 1){
                        if (count($chck_ot_emp) > 0){
                            $emp_overtime_id = $chck_ot_emp[0]->emp_overtime_id;
                            $m_emp_overtime_list->modified_by = $this->session->user_id;
                            $m_emp_overtime_list->date_modified = date("Y-m-d H:i:s");
                            $m_emp_overtime_list->modify($emp_overtime_id);
                        }else{
                            $m_emp_overtime_list->created_by = $this->session->user_id;
                            $m_emp_overtime_list->date_created = date("Y-m-d H:i:s");
                            $m_emp_overtime_list->save();
                        }
                    }
                }

                for ($b=0;$b<count($hol_employee_id);$b++) { 
                    
                    $chck_hol_emp = $this->Emp_holiday_pay_list_model->chck_hol_emp($this->session->company_id,$hol_employee_id[$b],$pay_period_id);
                    $dtr =  $this->Emp_holiday_pay_list_model->get_dtr_id($this->session->company_id,$ot_employee_id[$b],$pay_period_id);

                    $m_emp_holiday_pay_list->employee_id = $hol_employee_id[$b];
                    $m_emp_holiday_pay_list->pay_period_id = $pay_period_id;
                    $m_emp_holiday_pay_list->company_id = $this->session->company_id;

                    if (count($dtr)>0){
                        $m_emp_holiday_pay_list->dtr_id = $dtr[0]->dtr_id;
                    }else{ 
                        $m_emp_holiday_pay_list->dtr_id = 0;
                    }

                    $m_emp_holiday_pay_list->reg_hol=$this->get_numeric_value($reg_hol[$b]);
                    $m_emp_holiday_pay_list->reg_hol_amt=$this->get_numeric_value($reg_hol_amt[$b]);
                    $m_emp_holiday_pay_list->sun_reg_hol=$this->get_numeric_value($sun_reg_hol[$b]);
                    $m_emp_holiday_pay_list->sun_reg_hol_amt=$this->get_numeric_value($sun_reg_hol_amt[$b]);
                    $m_emp_holiday_pay_list->spe_hol=$this->get_numeric_value($spe_hol[$b]);
                    $m_emp_holiday_pay_list->spe_hol_amt=$this->get_numeric_value($spe_hol_amt[$b]);
                    $m_emp_holiday_pay_list->sun_spe_hol=$this->get_numeric_value($sun_spe_hol[$b]);
                    $m_emp_holiday_pay_list->sun_spe_hol_amt=$this->get_numeric_value($sun_spe_hol_amt[$b]);
                    $m_emp_holiday_pay_list->holiday_total=$this->get_numeric_value($holiday_total[$b]);

                    if ($is_active == 1){
                        if (count($chck_hol_emp) > 0){
                            $emp_holiday_pay_id = $chck_hol_emp[0]->emp_holiday_pay_id;
                            $m_emp_holiday_pay_list->modified_by = $this->session->user_id;
                            $m_emp_holiday_pay_list->date_modified = date("Y-m-d H:i:s");
                            $m_emp_holiday_pay_list->modify($emp_holiday_pay_id);
                        }else{
                            $m_emp_holiday_pay_list->created_by = $this->session->user_id;
                            $m_emp_holiday_pay_list->date_created = date("Y-m-d H:i:s");
                            $m_emp_holiday_pay_list->save();
                        }
                    }
                }

                $response['title']='Success!';
                $response['stat']='success';
                $response['msg']='Payroll was successfully processed.';

                echo json_encode($response);
            break;

                case 'transfertodtr':
                    $m_daily_time_record = $this->DailyTimeRecord_model;
                    $m_schedules = $this->SchedEmployee_model;
                    $pay_period_id = $this->input->post('pay_period_id', TRUE);
                  
                    // Prepare for the foreach
                    $employee_id = $this->input->post('employee_id', TRUE);                  
                    $reg = $this->input->post('reg', TRUE);
                    $sun = $this->input->post('sun', TRUE);
                    $day_off = $this->input->post('day_off', TRUE);
                    $reg_hol = $this->input->post('reg_hol', TRUE);
                    $spe_hol = $this->input->post('spe_hol', TRUE);
                    $sun_reg_hol = $this->input->post('sun_reg_hol', TRUE);
                    $sun_spe_hol = $this->input->post('sun_spe_hol', TRUE);
                    $minutes_late = $this->input->post('minutes_late', TRUE);
                    $ot_reg = $this->input->post('ot_reg', TRUE);
                    $ot_reg_reg_hol = $this->input->post('ot_reg_reg_hol', TRUE);
                    $ot_reg_spe_hol = $this->input->post('ot_reg_spe_hol', TRUE);
                    $ot_sun = $this->input->post('ot_sun', TRUE);
                    $ot_sun_reg_hol = $this->input->post('ot_sun_reg_hol', TRUE);
                    $ot_sun_spe_hol = $this->input->post('ot_sun_spe_hol', TRUE);
                    $nsd_reg = $this->input->post('nsd_reg', TRUE);
                    $nsd_reg_reg_hol = $this->input->post('nsd_reg_reg_hol', TRUE);
                    $nsd_reg_spe_hol = $this->input->post('nsd_reg_spe_hol', TRUE);
                    $nsd_sun = $this->input->post('nsd_sun', TRUE);
                    $nsd_sun_reg_hol = $this->input->post('nsd_sun_reg_hol', TRUE);
                    $nsd_sun_spe_hol = $this->input->post('nsd_sun_spe_hol', TRUE);

                    for($i=0;$i<count($employee_id);$i++){

                        // Check Regular Holiday
                        $chck_reg_holiday = $m_schedules->get_reg_hol_sched($employee_id[$i],$pay_period_id);
                        $count_reg_hol = $chck_reg_holiday[0]->count_reg_hol;
                        $date_reg_hol = $chck_reg_holiday[0]->date;
                        $date_before = date('Y-m-d',(strtotime ( '-1 day' , strtotime ($date_reg_hol))));

                        $chck_before_date = $m_schedules->get_before_date($employee_id[$i],$pay_period_id,$date_before);
                        $count_before_date = $chck_before_date[0]->count_before_date;
                        // ## End

                        $per_hour_pay = $m_daily_time_record->get_per_hour_pay($employee_id[$i]);
                        $salary_reg_rates = $m_daily_time_record->get_salary_pay($employee_id[$i]);
                        $chck_pay_type = $m_daily_time_record->get_pay_type($employee_id[$i]);

                        $ref_payment_type_id = $chck_pay_type[0]->ref_payment_type_id;
                        $salary_rates = $chck_pay_type[0]->salary_reg_rates;
                        $factor_file = $m_daily_time_record->get_factorfile();

                        $m_daily_time_record->employee_id = $employee_id[$i];
                        $m_daily_time_record->pay_period_id = $pay_period_id;

                        $m_daily_time_record->reg = $this->get_numeric_value($reg[$i]);
                        $m_daily_time_record->sun = $this->get_numeric_value($sun[$i]);
                        $m_daily_time_record->day_off = $this->get_numeric_value($day_off[$i]);
                        $m_daily_time_record->reg_hol = $this->get_numeric_value($reg_hol[$i]);
                        $m_daily_time_record->spe_hol = $this->get_numeric_value($spe_hol[$i]);
                        $m_daily_time_record->sun_reg_hol = $this->get_numeric_value($sun_reg_hol[$i]);
                        $m_daily_time_record->sun_spe_hol = $this->get_numeric_value($sun_spe_hol[$i]);
                        $m_daily_time_record->minutes_late = $this->get_numeric_value($minutes_late[$i]);
                        $m_daily_time_record->ot_reg = $this->get_numeric_value($ot_reg[$i]);
                        $m_daily_time_record->ot_reg_reg_hol = $this->get_numeric_value($ot_reg_reg_hol[$i]);
                        $m_daily_time_record->ot_reg_spe_hol = $this->get_numeric_value($ot_reg_spe_hol[$i]);
                        $m_daily_time_record->ot_sun = $this->get_numeric_value($ot_sun[$i]);
                        $m_daily_time_record->ot_sun_reg_hol = $this->get_numeric_value($ot_sun_reg_hol[$i]);
                        $m_daily_time_record->ot_sun_spe_hol = $this->get_numeric_value($ot_sun_spe_hol[$i]);
                        $m_daily_time_record->nsd_reg = $this->get_numeric_value($nsd_reg[$i]);
                        $m_daily_time_record->nsd_reg_reg_hol = $this->get_numeric_value($nsd_reg_reg_hol[$i]);
                        $m_daily_time_record->nsd_reg_spe_hol = $this->get_numeric_value($nsd_reg_spe_hol[$i]);
                        $m_daily_time_record->nsd_sun = $this->get_numeric_value($nsd_sun[$i]);
                        $m_daily_time_record->nsd_sun_reg_hol = $this->get_numeric_value($nsd_sun_reg_hol[$i]);
                        $m_daily_time_record->nsd_sun_spe_hol = $this->get_numeric_value($nsd_sun_spe_hol[$i]);

                        $m_daily_time_record->reg_amt = $this->get_numeric_value($reg[$i])*$per_hour_pay;
                        $m_daily_time_record->for_13th_month = $reg*$per_hour_pay;

                        $m_daily_time_record->sun_amt = $this->get_numeric_value($sun[$i])*$per_hour_pay*$factor_file[0]->sunday;
                        $m_daily_time_record->day_off_amt = $this->get_numeric_value($day_off[$i])*$per_hour_pay*$factor_file[0]->day_off;

                        if ($count_reg_hol == '1' && $count_before_date == '1'){
                            $m_daily_time_record->reg_hol_amt = ($this->get_numeric_value($reg_hol[$i])*$per_hour_pay*$factor_file[0]->regular_holiday);
                        }else if ($count_reg_hol == '1' && $count_before_date == '0'){
                            $m_daily_time_record->reg_hol_amt = ($this->get_numeric_value($reg_hol[$i])*$per_hour_pay*1);
                        }else if ($count_reg_hol == '0' && $count_before_date == '1'){
                            $m_daily_time_record->reg_hol_amt = ($this->get_numeric_value($reg_hol[$i])*$per_hour_pay*1);
                        }else{
                            $m_daily_time_record->reg_hol_amt = 0.00;
                        }

                        $m_daily_time_record->spe_hol_amt = ($this->get_numeric_value($spe_hol[$i])*$per_hour_pay*$factor_file[0]->spe_holiday);

                        $m_daily_time_record->sun_reg_hol_amt = $this->get_numeric_value($sun_reg_hol[$i])*$per_hour_pay*$factor_file[0]->sun_regular_holiday;
                        $m_daily_time_record->sun_spe_hol_amt = $this->get_numeric_value($sun_spe_hol[$i])*$per_hour_pay*$factor_file[0]->sun_spe_holiday;
                        $m_daily_time_record->minutes_late_amt = ($per_hour_pay/60)*$this->get_numeric_value($minutes_late[$i]);
                        $m_daily_time_record->ot_reg_amt = $this->get_numeric_value($ot_reg[$i])*$per_hour_pay*$factor_file[0]->regular_ot;
                        $m_daily_time_record->ot_reg_reg_hol_amt = $this->get_numeric_value($ot_reg_reg_hol[$i])*$per_hour_pay*$factor_file[0]->regular_holiday_ot;
                        $m_daily_time_record->ot_reg_spe_hol_amt = $this->get_numeric_value($ot_reg_spe_hol[$i])*$per_hour_pay*$factor_file[0]->spe_holiday_ot;
                        $m_daily_time_record->ot_sun_amt = $this->get_numeric_value($ot_sun[$i])*$per_hour_pay*$factor_file[0]->sunday_ot;
                        $m_daily_time_record->ot_sun_reg_hol_amt = $this->get_numeric_value($ot_sun_reg_hol[$i])*$per_hour_pay*$factor_file[0]->sun_regular_holiday_ot;
                        $m_daily_time_record->ot_sun_spe_hol_amt = $this->get_numeric_value($ot_sun_spe_hol[$i])*$per_hour_pay*$factor_file[0]->sun_spe_holiday_ot;
                        $m_daily_time_record->nsd_reg_amt = $this->get_numeric_value($nsd_reg[$i])*$per_hour_pay*$factor_file[0]->night_shift;
                        $m_daily_time_record->nsd_reg_reg_hol_amt = $this->get_numeric_value($nsd_reg_reg_hol[$i])*$per_hour_pay*$factor_file[0]->night_shift_reg_holiday;
                        $m_daily_time_record->nsd_reg_spe_hol_amt = $this->get_numeric_value($nsd_reg_spe_hol[$i])*$per_hour_pay*$factor_file[0]->night_shift_spe_holiday;
                        $m_daily_time_record->nsd_sun_amt = $this->get_numeric_value($nsd_sun[$i])*$per_hour_pay*$factor_file[0]->sun_night_shift;
                        $m_daily_time_record->nsd_sun_reg_hol_amt = $this->get_numeric_value($nsd_sun_reg_hol[$i])*$per_hour_pay*$factor_file[0]->sun_night_shift_reg_holiday;
                        $m_daily_time_record->nsd_sun_spe_hol_amt = $this->get_numeric_value($nsd_sun_spe_hol[$i])*$per_hour_pay*$factor_file[0]->sun_night_shift_spe_holiday;

                        $m_daily_time_record->is_to_process = 1;
                        $m_daily_time_record->date_modified = date("Y-m-d");
                        $dtr = $m_daily_time_record->ifexistdtr($employee_id[$i],$pay_period_id);

                        if(count($m_daily_time_record->ifexistdtr($employee_id[$i],$pay_period_id))==0){
                            $m_daily_time_record->save($employee_id[$i]);
                        }
                        else{
                            $m_daily_time_record->modify($dtr[0]->dtr_id);

                        }
                    }
                    $response['title']='Success!';
                    $response['stat']='success';
                    $response['msg']='DTR summary successfully transferred.';
                    echo json_encode($response);
                break;



            case 'test':
            function replaceCharsInNumber($num, $chars) {
               return substr((string) $num, 0, -strlen($chars)) . $chars;
            }

            $format = "000000";
            $temp = replaceCharsInNumber($format, '200'); //5069xxx
            $ecode = $temp .'-'. $today = date("Y");
            echo $ecode;


                break;

                case 'test3':
               $sql = 'UPDATE dtr_deductions SET is_deduct=1 WHERE dtr_deduction_id=185 AND deduction_id=8';
                $this->db->query($sql);
                break;

                case 'test4':
                $m_daily_time_record = $this->DailyTimeRecord_model;
                $employee_id = 3;
                $reg = 8;
                $per_hour_pay = $m_daily_time_record->get_per_hour_pay($employee_id,$reg);
                //echo $per_hour_pay."<br>";

                $factor_file = $m_daily_time_record->get_factorfile();
                echo $factor_file[0]->regular_ot;
                echo "<br>";
                echo $factor_file[0]->sunday;
                echo "<br>";
                echo $factor_file[0]->sunday_ot;
                echo "<br>";
                echo $factor_file[0]->regular_holiday;
                echo "<br>";
                echo $factor_file[0]->regular_holiday_ot;
                echo "<br>";
                echo $factor_file[0]->sun_regular_holiday;
                echo "<br>";
                echo $factor_file[0]->sun_regular_holiday_ot;
                echo "<br>";
                echo $factor_file[0]->spe_holiday;
                echo "<br>";
                echo $factor_file[0]->spe_holiday_ot;
                echo "<br>";
                echo $factor_file[0]->sun_spe_holiday;
                echo "<br>";
                echo $factor_file[0]->sun_spe_holiday_ot;
                echo "<br>";
                echo $factor_file[0]->pagibig1;
                echo "<br>";
                echo $factor_file[0]->pagibig2;
                echo "<br>";
                echo $factor_file[0]->night_shift;
                echo "<br>";
                echo $factor_file[0]->sun_night_shift;
                echo "<br>";
                echo $factor_file[0]->night_shift_reg_holiday;
                echo "<br>";
                echo $factor_file[0]->night_shift_spe_holiday;
                echo "<br>";
                echo $factor_file[0]->sun_night_shift_spe_holiday;
                break;

                case 'test5':
                $m_daily_time_record = $this->DailyTimeRecord_model;
                $test = $m_daily_time_record->Wtax_lookup();
                echo json_encode($test);
                break;


        }
    }











}
