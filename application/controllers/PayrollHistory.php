<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PayrollHistory extends CORE_Controller
{

    function __construct() {
        parent::__construct('');
        $this->validate_session();
        $this->load->model('Employee_model');
        $this->load->model('RefDepartment_model');
        $this->load->model('RefPosition_model');
        $this->load->model('RefBranch_model');
        $this->load->model('Payslip_model');
        $this->load->model('PayrollReports_model');
        $this->load->model('RefPayPeriod_model');
        $this->load->model('CompanyManagement_model');
        $this->load->model('RefFactorFile_model');
        $this->load->library('excel');

    }
    public function index() {
        $data['_def_css_files'] = $this->load->view('template/assets/css_files', '', TRUE);
        $data['_def_js_files'] = $this->load->view('template/assets/js_files', '', TRUE);
        $data['_switcher_settings'] = $this->load->view('template/elements/switcher', '', TRUE);
        $data['_side_bar_navigation'] = $this->load->view('template/elements/side_bar_navigation', '', TRUE);
        $data['_top_navigation'] = $this->load->view('template/elements/top_navigation', '', TRUE);
        $data['loader'] = $this->load->view('template/elements/loader', '', TRUE);
        $data['loaderscript'] = $this->load->view('template/elements/loaderscript', '', TRUE);
        $data['ref_branch']=$this->RefBranch_model->get_list(array('ref_branch.is_deleted'=>FALSE));
        $data['ref_department']=$this->RefDepartment_model->get_list(array('ref_department.is_deleted'=>FALSE));
        $data['title'] = 'JCORE - Payroll History';
        $this->load->view('pay_slip_view', $data);
    }

    function transaction($txn = null) {
        switch ($txn) {
            case 'list':
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
                $response['data']=$this->Payslip_model->get_list(
                    $test,
                    'pay_slip.net_pay,pay_slip.pay_slip_id,employee_list.*,CONCAT(employee_list.first_name," ",middle_name," ",employee_list.last_name) as full_name',
                    array(
                        array('daily_time_record','daily_time_record.dtr_id=pay_slip.dtr_id','left'),
                         array('employee_list','employee_list.employee_id=daily_time_record.employee_id','left'),
                         array('emp_rates_duties','emp_rates_duties.emp_rates_duties_id=employee_list.emp_rates_duties_id','left'),
                         )
                    );
                echo json_encode($response);

                break;
        }
    }


    function layout($layout=null,$filter_value=null,$filter_value2=null,$filter_value3=null,$filter_value4=null,$filter_value5=null,$type=null){




        switch($layout){
            //****************************************************
            case 'employeee-payroll-history': //
                        //show only inside grid with menu button

                        $getpayrollregsummary=$this->PayrollReports_model->get_employee_history($filter_value,$filter_value2,$filter_value3);
                        // if($filter_value!="all" AND $filter_value2!="all"){
                        //     /*echo json_encode($getpayrollregsummary);*/
                        // }

                        // if($filter_value!="all" AND $filter_value2=="all"){
                        //     $getpayrollregsummary=$this->PayrollReports_model->get_employee_history_filter_employee($filter_value,$filter_value3);
                        // }
                        // if($filter_value=="all" AND $filter_value2=="all"){
                        //     $getpayrollregsummary=$this->PayrollReports_model->get_employee_history_wofilter($filter_value3);
                        // }

                        /*echo json_encode($getpayrollregsummary);*/
                        /*$getpayrollregsummary=$this->Payslip_model->get_list(
                        null,
                        'pay_slip.*,refpayperiod.pay_period_start,refpayperiod.pay_period_end',
                        array(
                             array('daily_time_record','daily_time_record.dtr_id=pay_slip.dtr_id','left'),
                             array('refpayperiod','refpayperiod.pay_period_id=daily_time_record.pay_period_id','left'),
                             )
                        );*/
                        /*//GET SALARY ADJUSTMENTS
                        $getadjustment=$this->Payslip_OtherEarning_model->get_list(
                        array('pay_slip_other_earnings.earnings_id'=>2),
                        'SUM(earnings_amount) as total_adjustment_amount'
                        );
                         //GET OTHER PAY/EARNING
                        $getotherpay=$this->Payslip_OtherEarning_model->get_list(
                        'pay_slip_other_earnings.earnings_id!=2',
                        'SUM(earnings_amount) as total_other_pay'
                        );
                         //TOTAL SSS DEDUCTION GET
                        $gettotalsssdeduction=$this->PaySlip_deduction_model->get_list(
                        'deduction_id=1 AND active_deduct=TRUE',
                        'SUM(deduction_amount) as total_sss_deduct'
                        );

                        //TOTAL PHILHEALTH GET
                        $gettotalphilhealthdeduction=$this->PaySlip_deduction_model->get_list(
                        'deduction_id=2 AND active_deduct=TRUE',
                        'SUM(deduction_amount) as total_philhealth_deduct'
                        );
                        //TOTAL PHILHEALTH GET
                        $gettotalpagibigdeduction=$this->PaySlip_deduction_model->get_list(
                        'deduction_id=3 AND active_deduct=TRUE',
                        'SUM(deduction_amount) as total_pagibig_deduct'
                        );

                        $gettotalwithholdingdeduction=$this->PaySlip_deduction_model->get_list(
                        'deduction_id=4 AND active_deduct=TRUE',
                        'SUM(deduction_amount) as total_withholdingtax_deduct'
                        );
                        //get total sss loan
                        $gettotalsssloandeduction=$this->PaySlip_deduction_model->get_list(
                        'deduction_id=5 AND active_deduct=TRUE',
                        'SUM(deduction_amount) as total_sss_loan'
                        );
                        //get total pagibig loan
                        $gettotalpagibigloandeduction=$this->PaySlip_deduction_model->get_list(
                        'deduction_id=6 AND active_deduct=TRUE',
                        'SUM(deduction_amount) as total_pagibig_loan'
                        );
                        //COOP LOAN DEDUCTION GET
                        $gettotalcooploandeduction=$this->PaySlip_deduction_model->get_list(
                        'deduction_id=8 AND active_deduct=TRUE',
                        'SUM(deduction_amount) as total_coop_loan'
                        );
                        //COOP CONTRIBUTION DEDUCTION GET
                        $gettotalcoopcontributiondeduction=$this->PaySlip_deduction_model->get_list(
                        'deduction_id=9 AND active_deduct=TRUE',
                        'SUM(deduction_amount) as total_coop_contribution'
                        );
                        //OTHER DEDUCTION GET
                        $gettotalotherdeduction=$this->PaySlip_deduction_model->get_list(
                        'deduction_id!=1  AND deduction_id!=2  AND deduction_id!=3  AND deduction_id!=4
                         AND deduction_id!=5  AND deduction_id!=6  AND deduction_id!=7  AND deduction_id!=8  AND deduction_id!=9 AND active_deduct=TRUE',
                        'SUM(deduction_amount) as total_other_deduction'
                        );*/

                       /*echo json_encode($gettotalotherdeduction);*/

                        /*echo json_encode($getpayrollregsummary);*/
                        if($filter_value3!="all"){
                            $getbranch=$this->RefBranch_model->get_list(
                            $filter_value3,
                            'ref_branch.branch'
                            );
                            $get_branch = $getbranch[0]->branch;
                        }
                        else{
                            $get_branch = "All";
                        }

                        $data['payroll_register_summary']=$getpayrollregsummary;
                        $data['get_branch']=$get_branch;

                        $getcompany=$this->CompanyManagement_model->get_company_list($this->session->company_id);
                        $data['company']=$getcompany[0];

                        /*$data['total_adjustment_amount']=$getadjustment[0];
                        $data['total_other_pay']=$getotherpay[0];
                        $data['total_sss_deduct']=$gettotalsssdeduction[0];
                        $data['total_philhealth_deduct']=$gettotalphilhealthdeduction[0];
                        $data['total_pagibig_deduct']=$gettotalpagibigdeduction[0];
                        $data['total_withholdingtax_deduct']=$gettotalwithholdingdeduction[0];
                        $data['total_sss_loan']=$gettotalsssloandeduction[0];
                        $data['total_pagibig_loan']=$gettotalpagibigloandeduction[0];
                        $data['total_coop_loan']=$gettotalcooploandeduction[0];
                        $data['total_coop_contribution']=$gettotalcoopcontributiondeduction[0];
                        $data['total_other_deduction']=$gettotalotherdeduction[0];*/
                            echo $this->load->view('template/employee_payroll_history_html',$data,TRUE);

            break;

            case 'employeee-payroll-register':

                $pay_period = $filter_value;
                $branch = $filter_value2;
                $department = $filter_value3;
                $register_type = $filter_value4;
                $emp_status = $filter_value5;

                $data['payroll_register']=$this->PayrollReports_model->get_payroll_register($pay_period,$branch,$department,$register_type,$emp_status);

                if($branch !="all"){
                    $getbranch=$this->RefBranch_model->get_list(
                    $branch,
                    'ref_branch.branch'
                    );
                    $data['get_branch'] = $getbranch[0]->branch;
                }
                else{
                    $data['get_branch'] = "All";
                }

                if($department !="all"){
                    $getdepartment=$this->RefDepartment_model->get_list(
                    $department,
                    'ref_department.department'
                    );
                    $data['get_department'] = $getdepartment[0]->department;
                }
                else{
                    $data['get_department'] = "All";
                }

                $m_period = $this->RefPayPeriod_model;
                $payperiod = $m_period->getpayperioddesc($pay_period);

                if (count($payperiod) > 0){
                    $data['pay_period']=$payperiod[0]->pay_period;
                }else{
                    $data['pay_period']= 'N/A';
                }

                $data['type']=$type;
                $data['register_type'] = $register_type;

                $getcompany=$this->CompanyManagement_model->get_company_list($this->session->company_id);
                $data['company']=$getcompany[0];
                echo $this->load->view('template/payroll_register_html',$data,TRUE);

            break;

            case 'export-employeee-payroll-register':
                $excel = $this->excel;

                $pay_period_filter = $filter_value;
                $branch = $filter_value2;
                $department = $filter_value3;
                $register_type = $filter_value4;
                $emp_status = $filter_value5;

                $getpayrollregister=$this->PayrollReports_model->get_payroll_register($pay_period_filter,$branch,$department,$register_type,$emp_status);

                if($branch !="all"){
                    $getbranch=$this->RefBranch_model->get_list(
                    $branch,
                    'ref_branch.branch'
                    );
                    $get_branch = $getbranch[0]->branch;
                }
                else{
                    $get_branch = "All";
                }

                if($department !="all"){
                    $getdepartment=$this->RefDepartment_model->get_list(
                    $department,
                    'ref_department.department'
                    );
                    $get_department = $getdepartment[0]->department;
                }
                else{
                    $get_department = "All";
                }

                $m_period = $this->RefPayPeriod_model;

                $payperiod = $m_period->getpayperioddesc($pay_period_filter);

                if (count($payperiod) > 0){
                    $pay_period=$payperiod[0]->pay_period;
                }else{
                    $pay_period='N/A';
                }

                $getcompany=$this->CompanyManagement_model->get_company_list($this->session->company_id);
                $company=$getcompany[0];

                $excel->setActiveSheetIndex(0);
                        //name the worksheet

                        $end = "";

                        if ($register_type == 2){
                            $excel->getActiveSheet()->setTitle("PAYROLL REGISTER REPORT");
                            $end = "D";
                        }else{
                            $excel->getActiveSheet()->setTitle("PAYROLL REGISTER CASH REPORT");
                            $end = "C";
                        }
    
                        $excel->getActiveSheet()->mergeCells('A1:'.$end.'1');
                        $excel->getActiveSheet()->mergeCells('A2:'.$end.'2');
                        $excel->getActiveSheet()->mergeCells('A3:'.$end.'3');
                        $excel->getActiveSheet()->mergeCells('A4:'.$end.'4');

                        $excel->getActiveSheet()->mergeCells('A5:'.$end.'5');

                        $excel->getActiveSheet()->getStyle('A1'.':'.'A4')->getFont()->setBold(TRUE);

                        if ($register_type == 2){
                            $regtype = "Check";
                        }else{
                            $regtype = "Cash";
                        }

                        $excel->getActiveSheet()->setCellValue('A1','Pay Period : '.$pay_period)
                                                ->setCellValue('A2','Branch : '.$get_branch)
                                                ->setCellValue('A3','Department : '.$get_department)
                                                ->setCellValue('A4','Payment Type : '.$regtype);


                        $excel->getActiveSheet()->getStyle('A6:'.$end.'6')->getFont()->setBold(TRUE);

                        if ($register_type == 2){
                            $excel->getActiveSheet()->getColumnDimension('A')->setWidth('5');
                            $excel->getActiveSheet()->getColumnDimension('B')->setWidth('35');
                            $excel->getActiveSheet()->getColumnDimension('C')->setWidth('20');
                            $excel->getActiveSheet()->getColumnDimension('D')->setWidth('10');
                        }else{
                            $excel->getActiveSheet()->getColumnDimension('A')->setWidth('5');
                            $excel->getActiveSheet()->getColumnDimension('B')->setWidth('35');
                            $excel->getActiveSheet()->getColumnDimension('C')->setWidth('15');
                        }
                        
                        $excel->getActiveSheet()
                                ->getStyle($end.'5'.':'.$end.'6')
                                ->getAlignment()
                                ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

                        if ($register_type == 2){
                            $excel->getActiveSheet()->setCellValue('A6','#');
                            $excel->getActiveSheet()->setCellValue('B6','Employee');
                            $excel->getActiveSheet()->setCellValue('C6','Bank Account #');
                            $excel->getActiveSheet()->setCellValue('D6','Net Pay');
                        }else{
                            $excel->getActiveSheet()->setCellValue('A6','#');
                            $excel->getActiveSheet()->setCellValue('B6','Employee');
                            $excel->getActiveSheet()->setCellValue('C6','Net Pay');
                        }

                        $i = 7;
                        $a = 1;
                        $grandtotal=0;

                        if(count($getpayrollregister)!=0 || count($getpayrollregister)!=null){

                            foreach($getpayrollregister as $row){

                                $net_pay = $row->net_total;
                                $grandtotal+=$net_pay;

                                $excel->getActiveSheet()
                                        ->getStyle($end.$i)
                                        ->getAlignment()
                                        ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

                                $excel->getActiveSheet()
                                        ->getStyle('A'.$i)
                                        ->getAlignment()
                                        ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
                                
                                $excel->getActiveSheet()->getStyle($end.$i)->getNumberFormat()->setFormatCode('###,##0.00;(###,##0.00)'); 

                                if ($register_type == 2){
                                    $excel->getActiveSheet()->setCellValue('A'.$i,$a);
                                    $excel->getActiveSheet()->setCellValue('B'.$i,$row->full_name);
                                    $excel->getActiveSheet()->setCellValue('C'.$i,$row->bank_account);
                                    $excel->getActiveSheet()->setCellValue('D'.$i,number_format($row->net_total,2));
                                }else{
                                    $excel->getActiveSheet()->setCellValue('A'.$i,$a);
                                    $excel->getActiveSheet()->setCellValue('B'.$i,$row->full_name);
                                    $excel->getActiveSheet()->setCellValue('C'.$i,number_format($row->net_total,2));
                                }
                                    $i++;
                                    $a++;
                            }}
                            else{ 

                                    $excel->getActiveSheet()
                                            ->getStyle('A'.$i)
                                            ->getAlignment()
                                            ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  

                                    $excel->getActiveSheet()->mergeCells('A'.$i.':'.$end.$i);
                                    $excel->getActiveSheet()->setCellValue('A'.$i,'No Result');
                                    $i++;
                            }

                            $excel->getActiveSheet()
                                    ->getStyle('A'.$i.':'.$end.$i)
                                    ->getAlignment()
                                    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

                            if ($regtype == "Check"){
                                $excel->getActiveSheet()->mergeCells('A'.$i.':'.'C'.$i);
                                $excel->getActiveSheet()->getStyle('A'.$i.':'.$end.$i)->getFont()->setBold(TRUE);
                            }else{
                                $excel->getActiveSheet()->mergeCells('A'.$i.':'.'B'.$i);
                                $excel->getActiveSheet()->getStyle('A'.$i.':'.$end.$i)->getFont()->setBold(TRUE);
                            }

                            $excel->getActiveSheet()->setCellValue('A'.$i,'Total: ');

                            $excel->getActiveSheet()->getStyle($end.$i)->getNumberFormat()->setFormatCode('###,##0.00;(###,##0.00)');                   
                            $excel->getActiveSheet()->setCellValue($end.$i,number_format($grandtotal,2));

                            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
                            header('Content-Disposition: attachment;filename='."Payroll Register (".$pay_period.").xlsx".'');
                            header('Cache-Control: max-age=0');
                            // If you're serving to IE 9, then the following may be needed
                            header('Cache-Control: max-age=1');
                            // If you're serving to IE over SSL, then the following may be needed
                            header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
                            header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
                            header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
                            header ('Pragma: public'); // HTTP/1.0

                            $objWriter = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
                            $objWriter->save('php://output');

            break;

            case 'export-employeee-payroll-summary':
                $excel = $this->excel;

                $pay_period_id = $filter_value;
                $branch_id = $filter_value2;
                $department_id = $filter_value3;
                $emp_status = $filter_value4;

                $getpayrollsummary=$this->PayrollReports_model->get_payroll_summary($pay_period_id,$branch_id,$department_id,$emp_status);

                if($branch_id !="all"){
                    $getbranch=$this->RefBranch_model->get_list(
                    $branch_id,
                    'ref_branch.branch'
                    );
                    $get_branch = $getbranch[0]->branch;
                }
                else{
                    $get_branch = "All";
                }

                if($department_id !="all"){
                    $getdepartment=$this->RefDepartment_model->get_list(
                    $department_id,
                    'ref_department.department'
                    );
                    $get_department = $getdepartment[0]->department;
                }
                else{
                    $get_department = "All";
                }

                $m_period = $this->RefPayPeriod_model;

                $payperiod = $m_period->getpayperioddesc($pay_period_id);

                if (count($payperiod) > 0){
                    $pay_period=$payperiod[0]->pay_period;
                }else{
                    $pay_period='N/A';
                }

                $getcompany=$this->CompanyManagement_model->get_company_list($this->session->company_id);
                $company=$getcompany[0];

                $excel->setActiveSheetIndex(0);
                        //name the worksheet

                        $excel->getActiveSheet()->setTitle("Employee Payroll Summary");

                        $excel->getActiveSheet()->getStyle('A1'.':'.'A3')->getFont()->setBold(TRUE);

                        $excel->getActiveSheet()->mergeCells('A1:U1');
                        $excel->getActiveSheet()->mergeCells('A2:U2');
                        $excel->getActiveSheet()->mergeCells('A3:U3');
                        $excel->getActiveSheet()->mergeCells('A4:U4');

                        $excel->getActiveSheet()->setCellValue('A1','Pay Period : '.$pay_period)
                                                ->setCellValue('A2','Branch : '.$get_branch)
                                                ->setCellValue('A3','Department : '.$get_department);

                        $excel->getActiveSheet()->getStyle('A5:U5')->getFont()->setBold(TRUE);

                        $excel->getActiveSheet()->getColumnDimension('A')->setWidth('5');
                        $excel->getActiveSheet()->getColumnDimension('B')->setWidth('35');
                        $excel->getActiveSheet()->getColumnDimension('C')->setWidth('15');
                        $excel->getActiveSheet()->getColumnDimension('D')->setWidth('15');
                        $excel->getActiveSheet()->getColumnDimension('E')->setWidth('15');
                        $excel->getActiveSheet()->getColumnDimension('F')->setWidth('15');
                        $excel->getActiveSheet()->getColumnDimension('G')->setWidth('15');
                        $excel->getActiveSheet()->getColumnDimension('H')->setWidth('15');
                        $excel->getActiveSheet()->getColumnDimension('I')->setWidth('15');
                        $excel->getActiveSheet()->getColumnDimension('J')->setWidth('15');
                        $excel->getActiveSheet()->getColumnDimension('K')->setWidth('15');
                        $excel->getActiveSheet()->getColumnDimension('L')->setWidth('15');
                        $excel->getActiveSheet()->getColumnDimension('M')->setWidth('15');
                        $excel->getActiveSheet()->getColumnDimension('N')->setWidth('15');
                        $excel->getActiveSheet()->getColumnDimension('O')->setWidth('15');
                        $excel->getActiveSheet()->getColumnDimension('P')->setWidth('15');
                        $excel->getActiveSheet()->getColumnDimension('Q')->setWidth('15');
                        $excel->getActiveSheet()->getColumnDimension('R')->setWidth('15');
                        $excel->getActiveSheet()->getColumnDimension('S')->setWidth('15');
                        $excel->getActiveSheet()->getColumnDimension('T')->setWidth('18');
                        $excel->getActiveSheet()->getColumnDimension('U')->setWidth('15');
                                
                        $excel->getActiveSheet()
                                ->getStyle('C5:U5')
                                ->getAlignment()
                                ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

                        $excel->getActiveSheet()->setCellValue('A5','#');
                        $excel->getActiveSheet()->setCellValue('B5','Employee');
                        $excel->getActiveSheet()->setCellValue('C5','Basic Pay');
                        $excel->getActiveSheet()->setCellValue('D5','Overtime');
                        $excel->getActiveSheet()->setCellValue('E5','Holiday Pay');
                        $excel->getActiveSheet()->setCellValue('F5','Allowance Pay');
                        $excel->getActiveSheet()->setCellValue('G5','Commission / Other Pay');
                        $excel->getActiveSheet()->setCellValue('H5','Undertime Deduction');
                        $excel->getActiveSheet()->setCellValue('I5','Late Deduction');
                        $excel->getActiveSheet()->setCellValue('J5','Adjustment Additional');
                        $excel->getActiveSheet()->setCellValue('K5','Adjustment Deduction');
                        $excel->getActiveSheet()->setCellValue('L5','Gross Total');
                        $excel->getActiveSheet()->setCellValue('M5','SSS');
                        $excel->getActiveSheet()->setCellValue('N5','Philhealth');
                        $excel->getActiveSheet()->setCellValue('O5','Pagibig');
                        $excel->getActiveSheet()->setCellValue('P5','W/Tax');
                        $excel->getActiveSheet()->setCellValue('Q5','SSS Loan');
                        $excel->getActiveSheet()->setCellValue('R5','Pagibig Loan');
                        $excel->getActiveSheet()->setCellValue('S5','Cash Advance');
                        $excel->getActiveSheet()->setCellValue('T5','Total Deduction');
                        $excel->getActiveSheet()->setCellValue('U5','Net Pay');

                        $i = 6;
                        $a = 1;

                        $basic_pay_total = 0;
                        $overtime = 0;
                        $holiday_pay = 0;
                        $allowance_pay = 0;
                        $commission = 0;
                        $undertime_amt = 0;
                        $late_amt = 0;
                        $adjustment_additional = 0;
                        $adjustment_deduction = 0;
                        $sss_deduction = 0;
                        $philhealth_deduction = 0;
                        $pagibig_deduction = 0;
                        $wtax_deduction = 0;
                        $sss_loan = 0;
                        $pagibig_loan = 0;
                        $cash_advance = 0;
                        $total_deduction = 0;
                        $gross_total = 0;
                        $net_total = 0;

                        if(count($getpayrollsummary)!=0 || count($getpayrollsummary)!=null){
                            foreach($getpayrollsummary as $row){
                                $basic_pay_total += $row->basic_pay_total;
                                $overtime += $row->overtime;
                                $holiday_pay += $row->holiday_pay;
                                $allowance_pay += $row->allowance_pay;
                                $commission += $row->commission;
                                $undertime_amt += $row->undertime_amt;
                                $late_amt += $row->late_amt;
                                $adjustment_additional += $row->adjustment_additional;
                                $adjustment_deduction += $row->adjustment_deduction;
                                $sss_deduction += $row->sss_deduction;
                                $philhealth_deduction += $row->philhealth_deduction;
                                $pagibig_deduction += $row->pagibig_deduction;
                                $wtax_deduction += $row->wtax_deduction;
                                $sss_loan += $row->sss_loan;
                                $pagibig_loan += $row->pagibig_loan;
                                $cash_advance += $row->cash_advance;
                                $total_deduction += $row->total_deduction;
                                $gross_total += $row->gross_total;
                                $net_total += $row->net_total;

                                $excel->getActiveSheet()
                                        ->getStyle('A'.$i)
                                        ->getAlignment()
                                        ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);

                                $excel->getActiveSheet()
                                        ->getStyle('C'.$i.':'.'U'.$i)
                                        ->getAlignment()
                                        ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

                                $excel->getActiveSheet()->getStyle('C'.$i.':'.'U'.$i)->getNumberFormat()->setFormatCode('###,##0.00;(###,##0.00)'); 

                                $excel->getActiveSheet()->setCellValue('A'.$i,$a);
                                $excel->getActiveSheet()->setCellValue('B'.$i,$row->full_name);
                                $excel->getActiveSheet()->setCellValue('C'.$i,number_format($row->basic_pay_total,2));   
                                $excel->getActiveSheet()->setCellValue('D'.$i,number_format($row->overtime,2));   
                                $excel->getActiveSheet()->setCellValue('E'.$i,number_format($row->holiday_pay,2));   
                                $excel->getActiveSheet()->setCellValue('F'.$i,number_format($row->allowance_pay,2)); 
                                $excel->getActiveSheet()->setCellValue('G'.$i,number_format($row->commission,2));  
                                $excel->getActiveSheet()->setCellValue('H'.$i,number_format($row->undertime_amt,2));  
                                $excel->getActiveSheet()->setCellValue('I'.$i,number_format($row->late_amt,2));  
                                $excel->getActiveSheet()->setCellValue('J'.$i,number_format($row->adjustment_additional,2));   
                                $excel->getActiveSheet()->setCellValue('K'.$i,number_format($row->adjustment_deduction,2));  
                                $excel->getActiveSheet()->setCellValue('L'.$i,number_format($row->gross_total,2));
                                $excel->getActiveSheet()->setCellValue('M'.$i,number_format($row->sss_deduction,2));
                                $excel->getActiveSheet()->setCellValue('N'.$i,number_format($row->philhealth_deduction,2));   
                                $excel->getActiveSheet()->setCellValue('O'.$i,number_format($row->pagibig_deduction,2));   
                                $excel->getActiveSheet()->setCellValue('P'.$i,number_format($row->wtax_deduction,2));  
                                $excel->getActiveSheet()->setCellValue('Q'.$i,number_format($row->sss_loan,2));   
                                $excel->getActiveSheet()->setCellValue('R'.$i,number_format($row->pagibig_loan,2));   
                                $excel->getActiveSheet()->setCellValue('S'.$i,number_format($row->cash_advance,2));
                                $excel->getActiveSheet()->setCellValue('T'.$i,number_format($row->total_deduction,2));   
                                $excel->getActiveSheet()->setCellValue('U'.$i,number_format($row->net_total,2));                                

                                $i++;
                                $a++;
                            }}
                            else{ 

                                    $excel->getActiveSheet()
                                            ->getStyle('A'.$i)
                                            ->getAlignment()
                                            ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  

                                    $excel->getActiveSheet()->mergeCells('A'.$i.':'.'U'.$i);
                                    $excel->getActiveSheet()->setCellValue('A'.$i,'No Result');
                                    $i++;
                            }

                            $i++;
                      
                            $excel->getActiveSheet()->mergeCells('N'.$i.':'.'O'.$i);
                            $excel->getActiveSheet()->mergeCells('Q'.$i.':'.'R'.$i);

                            $excel->getActiveSheet()->getStyle('N'.$i)->getFont()->setBold(TRUE);
                            $excel->getActiveSheet()->getStyle('Q'.$i)->getFont()->setBold(TRUE);
                            $excel->getActiveSheet()->getStyle('T'.$i)->getFont()->setBold(TRUE);

                            $excel->getActiveSheet()->setCellValue('N'.$i,'Basic Pay: ');
                            $excel->getActiveSheet()->setCellValue('Q'.$i,'Late Deduction: ');
                            $excel->getActiveSheet()->setCellValue('T'.$i,'W/Tax: ');

                            $excel->getActiveSheet()->setCellValue('P'.$i,number_format($basic_pay_total,2));
                            $excel->getActiveSheet()->setCellValue('S'.$i,number_format($late_amt,2));
                            $excel->getActiveSheet()->setCellValue('U'.$i,number_format($wtax_deduction,2));

                            $n1 = $i + 1;

                            $excel->getActiveSheet()->mergeCells('N'.$n1.':'.'O'.$n1);
                            $excel->getActiveSheet()->mergeCells('Q'.$n1.':'.'R'.$n1);

                            $excel->getActiveSheet()->getStyle('N'.$n1)->getFont()->setBold(TRUE);
                            $excel->getActiveSheet()->getStyle('Q'.$n1)->getFont()->setBold(TRUE);
                            $excel->getActiveSheet()->getStyle('T'.$n1)->getFont()->setBold(TRUE);

                            $excel->getActiveSheet()->setCellValue('N'.$n1,'Overtime: ');
                            $excel->getActiveSheet()->setCellValue('Q'.$n1,'Adjustment Additional: ');
                            $excel->getActiveSheet()->setCellValue('T'.$n1,'SSS Loan: ');

                            $excel->getActiveSheet()->setCellValue('P'.$n1,number_format($overtime,2));
                            $excel->getActiveSheet()->setCellValue('S'.$n1,number_format($adjustment_additional,2));
                            $excel->getActiveSheet()->setCellValue('U'.$n1,number_format($sss_loan,2));

                            $n2 = $i + 2;

                            $excel->getActiveSheet()->mergeCells('N'.$n2.':'.'O'.$n2);
                            $excel->getActiveSheet()->mergeCells('Q'.$n2.':'.'R'.$n2);

                            $excel->getActiveSheet()->getStyle('N'.$n2)->getFont()->setBold(TRUE);
                            $excel->getActiveSheet()->getStyle('Q'.$n2)->getFont()->setBold(TRUE);
                            $excel->getActiveSheet()->getStyle('T'.$n2)->getFont()->setBold(TRUE);

                            $excel->getActiveSheet()->setCellValue('N'.$n2,'Holiday Pay: ');
                            $excel->getActiveSheet()->setCellValue('Q'.$n2,'Adjustment Deduction: ');
                            $excel->getActiveSheet()->setCellValue('T'.$n2,'Pagibig Loan: ');

                            $excel->getActiveSheet()->setCellValue('P'.$n2,number_format($holiday_pay,2));
                            $excel->getActiveSheet()->setCellValue('S'.$n2,number_format($adjustment_deduction,2));
                            $excel->getActiveSheet()->setCellValue('U'.$n2,number_format($pagibig_loan,2));

                            $n3 = $i + 3;

                            $excel->getActiveSheet()->mergeCells('N'.$n3.':'.'O'.$n3);
                            $excel->getActiveSheet()->mergeCells('Q'.$n3.':'.'R'.$n3);

                            $excel->getActiveSheet()->getStyle('N'.$n3)->getFont()->setBold(TRUE);
                            $excel->getActiveSheet()->getStyle('Q'.$n3)->getFont()->setBold(TRUE);
                            $excel->getActiveSheet()->getStyle('T'.$n3)->getFont()->setBold(TRUE);

                            $excel->getActiveSheet()->setCellValue('N'.$n3,'Allowance Pay: ');
                            $excel->getActiveSheet()->setCellValue('Q'.$n3,'SSS: ');
                            $excel->getActiveSheet()->setCellValue('T'.$n3,'Cash Advance: ');

                            $excel->getActiveSheet()->setCellValue('P'.$n3,number_format($allowance_pay,2));
                            $excel->getActiveSheet()->setCellValue('S'.$n3,number_format($sss_deduction,2));
                            $excel->getActiveSheet()->setCellValue('U'.$n3,number_format($cash_advance,2));

                            $n4 = $i + 4;

                            $excel->getActiveSheet()->mergeCells('N'.$n4.':'.'O'.$n4);
                            $excel->getActiveSheet()->mergeCells('Q'.$n4.':'.'R'.$n4);

                            $excel->getActiveSheet()->getStyle('N'.$n4)->getFont()->setBold(TRUE);
                            $excel->getActiveSheet()->getStyle('Q'.$n4)->getFont()->setBold(TRUE);
                            $excel->getActiveSheet()->getStyle('T'.$n4)->getFont()->setBold(TRUE);

                            $excel->getActiveSheet()->setCellValue('N'.$n4,'Commission / Other Pay: ');
                            $excel->getActiveSheet()->setCellValue('Q'.$n4,'Philhealth: ');
                            $excel->getActiveSheet()->setCellValue('T'.$n4,'Total Deduction: ');

                            $excel->getActiveSheet()->setCellValue('P'.$n4,number_format($commission,2));
                            $excel->getActiveSheet()->setCellValue('S'.$n4,number_format($philhealth_deduction,2));
                            $excel->getActiveSheet()->setCellValue('U'.$n4,number_format($total_deduction,4));

                            $n5 = $i + 5;

                            $excel->getActiveSheet()->mergeCells('N'.$n5.':'.'O'.$n5);
                            $excel->getActiveSheet()->mergeCells('Q'.$n5.':'.'R'.$n5);

                            $excel->getActiveSheet()->getStyle('N'.$n5)->getFont()->setBold(TRUE);
                            $excel->getActiveSheet()->getStyle('Q'.$n5)->getFont()->setBold(TRUE);     
                            $excel->getActiveSheet()->getStyle('T'.$n5)->getFont()->setBold(TRUE);                       

                            $excel->getActiveSheet()->setCellValue('N'.$n5,'Undertime Deduction: ');
                            $excel->getActiveSheet()->setCellValue('Q'.$n5,'Pagibig: ');
                            $excel->getActiveSheet()->setCellValue('T'.$n5,'Total Gross: ');

                            $excel->getActiveSheet()->setCellValue('P'.$n5,number_format($undertime_amt,2));
                            $excel->getActiveSheet()->setCellValue('S'.$n5,number_format($pagibig_deduction,2));
                            $excel->getActiveSheet()->setCellValue('U'.$n5,number_format($gross_total,2));

                            $n6 = $i + 6;
    
                            $excel->getActiveSheet()->getStyle('T'.$n6)->getFont()->setBold(TRUE);
                            $excel->getActiveSheet()->setCellValue('T'.$n6,'Salaries & Wages: ');
                            $excel->getActiveSheet()->setCellValue('U'.$n6,number_format($net_total,2));


                            $excel->getActiveSheet()->getStyle('P'.$i)->getNumberFormat()->setFormatCode('###,##0.00;(###,##0.00)');
                            $excel->getActiveSheet()->getStyle('P'.$n1)->getNumberFormat()->setFormatCode('###,##0.00;(###,##0.00)');
                            $excel->getActiveSheet()->getStyle('P'.$n2)->getNumberFormat()->setFormatCode('###,##0.00;(###,##0.00)');
                            $excel->getActiveSheet()->getStyle('P'.$n3)->getNumberFormat()->setFormatCode('###,##0.00;(###,##0.00)');
                            $excel->getActiveSheet()->getStyle('P'.$n4)->getNumberFormat()->setFormatCode('###,##0.00;(###,##0.00)');
                            $excel->getActiveSheet()->getStyle('P'.$n5)->getNumberFormat()->setFormatCode('###,##0.00;(###,##0.00)');
                            $excel->getActiveSheet()->getStyle('S'.$i)->getNumberFormat()->setFormatCode('###,##0.00;(###,##0.00)');
                            $excel->getActiveSheet()->getStyle('S'.$n1)->getNumberFormat()->setFormatCode('###,##0.00;(###,##0.00)');
                            $excel->getActiveSheet()->getStyle('S'.$n2)->getNumberFormat()->setFormatCode('###,##0.00;(###,##0.00)');
                            $excel->getActiveSheet()->getStyle('S'.$n3)->getNumberFormat()->setFormatCode('###,##0.00;(###,##0.00)');
                            $excel->getActiveSheet()->getStyle('S'.$n4)->getNumberFormat()->setFormatCode('###,##0.00;(###,##0.00)');
                            $excel->getActiveSheet()->getStyle('S'.$n5)->getNumberFormat()->setFormatCode('###,##0.00;(###,##0.00)');
                            $excel->getActiveSheet()->getStyle('U'.$i)->getNumberFormat()->setFormatCode('###,##0.00;(###,##0.00)');
                            $excel->getActiveSheet()->getStyle('U'.$n1)->getNumberFormat()->setFormatCode('###,##0.00;(###,##0.00)');
                            $excel->getActiveSheet()->getStyle('U'.$n2)->getNumberFormat()->setFormatCode('###,##0.00;(###,##0.00)');
                            $excel->getActiveSheet()->getStyle('U'.$n3)->getNumberFormat()->setFormatCode('###,##0.00;(###,##0.00)');
                            $excel->getActiveSheet()->getStyle('U'.$n4)->getNumberFormat()->setFormatCode('###,##0.00;(###,##0.00)');
                            $excel->getActiveSheet()->getStyle('U'.$n6)->getNumberFormat()->setFormatCode('###,##0.00;(###,##0.00)');


                            $excel->getActiveSheet()
                                    ->getStyle('P'.$i)
                                    ->getAlignment()
                                    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
                            $excel->getActiveSheet()
                                    ->getStyle('P'.$n1)
                                    ->getAlignment()
                                    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
                            $excel->getActiveSheet()
                                    ->getStyle('P'.$n2)
                                    ->getAlignment()
                                    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
                            $excel->getActiveSheet()
                                    ->getStyle('P'.$n3)
                                    ->getAlignment()
                                    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
                            $excel->getActiveSheet()
                                    ->getStyle('P'.$n4)
                                    ->getAlignment()
                                    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
                            $excel->getActiveSheet()
                                    ->getStyle('P'.$n5)
                                    ->getAlignment()
                                    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

                            $excel->getActiveSheet()
                                    ->getStyle('S'.$i)
                                    ->getAlignment()
                                    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
                            $excel->getActiveSheet()
                                    ->getStyle('S'.$n1)
                                    ->getAlignment()
                                    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
                            $excel->getActiveSheet()
                                    ->getStyle('S'.$n2)
                                    ->getAlignment()
                                    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
                            $excel->getActiveSheet()
                                    ->getStyle('S'.$n3)
                                    ->getAlignment()
                                    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
                            $excel->getActiveSheet()
                                    ->getStyle('S'.$n4)
                                    ->getAlignment()
                                    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
                            $excel->getActiveSheet()
                                    ->getStyle('S'.$n5)
                                    ->getAlignment()
                                    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

                            $excel->getActiveSheet()
                                    ->getStyle('U'.$i)
                                    ->getAlignment()
                                    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
                            $excel->getActiveSheet()
                                    ->getStyle('U'.$n1)
                                    ->getAlignment()
                                    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
                            $excel->getActiveSheet()
                                    ->getStyle('U'.$n2)
                                    ->getAlignment()
                                    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
                            $excel->getActiveSheet()
                                    ->getStyle('U'.$n3)
                                    ->getAlignment()
                                    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
                            $excel->getActiveSheet()
                                    ->getStyle('U'.$n4)
                                    ->getAlignment()
                                    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
                            $excel->getActiveSheet()
                                    ->getStyle('U'.$n5)
                                    ->getAlignment()
                                    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);   
                            $excel->getActiveSheet()
                                    ->getStyle('U'.$n6)
                                    ->getAlignment()
                                    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);   

                            $excel->getActiveSheet()
                                    ->getStyle('N'.$i)
                                    ->getAlignment()
                                    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
                            $excel->getActiveSheet()
                                    ->getStyle('N'.$n1)
                                    ->getAlignment()
                                    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
                            $excel->getActiveSheet()
                                    ->getStyle('N'.$n2)
                                    ->getAlignment()
                                    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
                            $excel->getActiveSheet()
                                    ->getStyle('N'.$n3)
                                    ->getAlignment()
                                    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
                            $excel->getActiveSheet()
                                    ->getStyle('N'.$n4)
                                    ->getAlignment()
                                    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
                            $excel->getActiveSheet()
                                    ->getStyle('N'.$n5)
                                    ->getAlignment()
                                    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

                            $excel->getActiveSheet()
                                    ->getStyle('Q'.$i)
                                    ->getAlignment()
                                    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
                            $excel->getActiveSheet()
                                    ->getStyle('Q'.$n1)
                                    ->getAlignment()
                                    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
                            $excel->getActiveSheet()
                                    ->getStyle('Q'.$n2)
                                    ->getAlignment()
                                    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
                            $excel->getActiveSheet()
                                    ->getStyle('Q'.$n3)
                                    ->getAlignment()
                                    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
                            $excel->getActiveSheet()
                                    ->getStyle('Q'.$n4)
                                    ->getAlignment()
                                    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
                            $excel->getActiveSheet()
                                    ->getStyle('Q'.$n5)
                                    ->getAlignment()
                                    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

                            $excel->getActiveSheet()
                                    ->getStyle('T'.$i)
                                    ->getAlignment()
                                    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
                            $excel->getActiveSheet()
                                    ->getStyle('T'.$n1)
                                    ->getAlignment()
                                    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
                            $excel->getActiveSheet()
                                    ->getStyle('T'.$n2)
                                    ->getAlignment()
                                    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
                            $excel->getActiveSheet()
                                    ->getStyle('T'.$n3)
                                    ->getAlignment()
                                    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
                            $excel->getActiveSheet()
                                    ->getStyle('T'.$n4)
                                    ->getAlignment()
                                    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
                            $excel->getActiveSheet()
                                    ->getStyle('T'.$n5)
                                    ->getAlignment()
                                    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
                            $excel->getActiveSheet()
                                    ->getStyle('T'.$n6)
                                    ->getAlignment()
                                    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);


                            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
                            header('Content-Disposition: attachment;filename='."Payroll Summary (".$pay_period.").xlsx".'');
                            header('Cache-Control: max-age=0');
                            // If you're serving to IE 9, then the following may be needed
                            header('Cache-Control: max-age=1');
                            // If you're serving to IE over SSL, then the following may be needed
                            header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
                            header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
                            header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
                            header ('Pragma: public'); // HTTP/1.0

                            $objWriter = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
                            $objWriter->save('php://output');
            break;

            case 'employeee-monthly-salary': //

                        $filter2 = explode('~',$filter_value2);
                        $filter_value2 = $filter2[0];
                        $filter_year = $filter2[1];
                        //show only inside grid with menu button
                           
                        $getpayrollregsummary=$this->PayrollReports_model->get_monthly_salary_history($filter_value,$filter_value2,$filter_value3,$filter_year);

                        // if($filter_value!="all" AND $filter_value2!="all"){

                        //     /*echo json_encode($getpayrollregsummary);*/
                        // }



                        // if($filter_value!="all" AND $filter_value2=="all"){
                        //   echo 3;
                        //     $getpayrollregsummary=$this->PayrollReports_model->get_monthly_salary_filter_employee($filter_value,$filter_value3,$filter_year);
                        // }
                        // if($filter_value=="all" AND $filter_value2=="all"){
                        //   echo 4;
                        //     $getpayrollregsummary=$this->PayrollReports_model->get_monthly_salary_wofilter($filter_value3,$filter_year);
                        // }

                        /*echo json_encode($getpayrollregsummary);*/
                        /*$getpayrollregsummary=$this->Payslip_model->get_list(
                        null,
                        'pay_slip.*,refpayperiod.pay_period_start,refpayperiod.pay_period_end',
                        array(
                             array('daily_time_record','daily_time_record.dtr_id=pay_slip.dtr_id','left'),
                             array('refpayperiod','refpayperiod.pay_period_id=daily_time_record.pay_period_id','left'),
                             )
                        );*/
                        /*//GET SALARY ADJUSTMENTS
                        $getadjustment=$this->Payslip_OtherEarning_model->get_list(
                        array('pay_slip_other_earnings.earnings_id'=>2),
                        'SUM(earnings_amount) as total_adjustment_amount'
                        );
                         //GET OTHER PAY/EARNING
                        $getotherpay=$this->Payslip_OtherEarning_model->get_list(
                        'pay_slip_other_earnings.earnings_id!=2',
                        'SUM(earnings_amount) as total_other_pay'
                        );
                         //TOTAL SSS DEDUCTION GET
                        $gettotalsssdeduction=$this->PaySlip_deduction_model->get_list(
                        'deduction_id=1 AND active_deduct=TRUE',
                        'SUM(deduction_amount) as total_sss_deduct'
                        );

                        //TOTAL PHILHEALTH GET
                        $gettotalphilhealthdeduction=$this->PaySlip_deduction_model->get_list(
                        'deduction_id=2 AND active_deduct=TRUE',
                        'SUM(deduction_amount) as total_philhealth_deduct'
                        );
                        //TOTAL PHILHEALTH GET
                        $gettotalpagibigdeduction=$this->PaySlip_deduction_model->get_list(
                        'deduction_id=3 AND active_deduct=TRUE',
                        'SUM(deduction_amount) as total_pagibig_deduct'
                        );

                        $gettotalwithholdingdeduction=$this->PaySlip_deduction_model->get_list(
                        'deduction_id=4 AND active_deduct=TRUE',
                        'SUM(deduction_amount) as total_withholdingtax_deduct'
                        );
                        //get total sss loan
                        $gettotalsssloandeduction=$this->PaySlip_deduction_model->get_list(
                        'deduction_id=5 AND active_deduct=TRUE',
                        'SUM(deduction_amount) as total_sss_loan'
                        );
                        //get total pagibig loan
                        $gettotalpagibigloandeduction=$this->PaySlip_deduction_model->get_list(
                        'deduction_id=6 AND active_deduct=TRUE',
                        'SUM(deduction_amount) as total_pagibig_loan'
                        );
                        //COOP LOAN DEDUCTION GET
                        $gettotalcooploandeduction=$this->PaySlip_deduction_model->get_list(
                        'deduction_id=8 AND active_deduct=TRUE',
                        'SUM(deduction_amount) as total_coop_loan'
                        );
                        //COOP CONTRIBUTION DEDUCTION GET
                        $gettotalcoopcontributiondeduction=$this->PaySlip_deduction_model->get_list(
                        'deduction_id=9 AND active_deduct=TRUE',
                        'SUM(deduction_amount) as total_coop_contribution'
                        );
                        //OTHER DEDUCTION GET
                        $gettotalotherdeduction=$this->PaySlip_deduction_model->get_list(
                        'deduction_id!=1  AND deduction_id!=2  AND deduction_id!=3  AND deduction_id!=4
                         AND deduction_id!=5  AND deduction_id!=6  AND deduction_id!=7  AND deduction_id!=8  AND deduction_id!=9 AND active_deduct=TRUE',
                        'SUM(deduction_amount) as total_other_deduction'
                        );*/

                       /*echo json_encode($gettotalotherdeduction);*/

                        /*echo json_encode($getpayrollregsummary);*/
                        if($filter_value3!="all"){
                            $getbranch=$this->RefBranch_model->get_list(
                            $filter_value3,
                            'ref_branch.branch'
                            );
                            $get_branch = $getbranch[0]->branch;
                        }
                        else{
                            $get_branch = "All";
                        }

                        $data['payroll_register_summary']=$getpayrollregsummary;
                        $data['get_branch']=$get_branch;
                        $data['month']=$filter_value2;
                        $getcompany=$this->CompanyManagement_model->get_company_list($this->session->company_id);
                        $data['company']=$getcompany[0];



                        /*$data['total_adjustment_amount']=$getadjustment[0];
                        $data['total_other_pay']=$getotherpay[0];
                        $data['total_sss_deduct']=$gettotalsssdeduction[0];
                        $data['total_philhealth_deduct']=$gettotalphilhealthdeduction[0];
                        $data['total_pagibig_deduct']=$gettotalpagibigdeduction[0];
                        $data['total_withholdingtax_deduct']=$gettotalwithholdingdeduction[0];
                        $data['total_sss_loan']=$gettotalsssloandeduction[0];
                        $data['total_pagibig_loan']=$gettotalpagibigloandeduction[0];
                        $data['total_coop_loan']=$gettotalcooploandeduction[0];
                        $data['total_coop_contribution']=$gettotalcoopcontributiondeduction[0];
                        $data['total_other_deduction']=$gettotalotherdeduction[0];*/
                            echo $this->load->view('template/employee_monthly_salary_html',$data,TRUE);

                        break;

            case 'employee_dtr_summary': 

                $pay_period_id = $filter_value;
                $branch_id = $filter_value2;
                $department_id = $filter_value3;
                $is_filtered = $filter_value4;

                // Branch
                if($branch_id!=="all"){
                    $getbranch=$this->RefBranch_model->get_list(
                    $branch_id,
                    'ref_branch.branch'
                    );
                    $data['get_branch'] = $getbranch[0]->branch;
                }
                else{ $data['get_branch'] = "All"; }

                // Department
                if($department_id!=="all"){
                    $getdepartment=$this->RefDepartment_model->get_list($department_id);
                    $data['get_department'] = $getdepartment[0]->department;
                }
                else{ $data['get_department'] = "All"; }

                       
                $getcompany=$this->CompanyManagement_model->get_list($this->session->company_id);

                $data['dtr']=$this->PayrollReports_model->get_payroll_summary($pay_period_id,$branch_id,$department_id,'all',1);
                $data['period']=$this->RefPayPeriod_model->getperiod($pay_period_id);

                $data['transactions']=$this->RefPayPeriod_model->get_dtr_transaction($pay_period_id,$department_id);
                $data['departments'] = $this->RefDepartment_model->get_department_dtr($pay_period_id,$department_id);

                $data['factor']=$this->RefFactorFile_model->chck_ref_factor_file($this->session->company_id);

                $data['company']=$getcompany[0];
                $data['type']=$filter_value5;

                if($is_filtered == 1){
                    echo $this->load->view('template/employee_dtr_summary_filtered_html',$data,TRUE);
                }else{
                    echo $this->load->view('template/employee_dtr_summary_html',$data,TRUE);
                }

            break;


            case 'employee_payroll_summary': 

                $pay_period_id = $filter_value;
                $branch_id = $filter_value2;
                $department_id = $filter_value3;
                $emp_status = $filter_value4;

                $data['payroll_register_summary']=$this->PayrollReports_model->get_payroll_summary($pay_period_id,$branch_id,$department_id,$emp_status);

                if($branch_id!=="all"){
                    $getbranch=$this->RefBranch_model->get_list(
                    $branch_id,
                    'ref_branch.branch'
                    );
                    $data['get_branch'] = $getbranch[0]->branch;
                }
                else{
                    $data['get_branch'] = "All";
                }

                if($department_id!=="all"){
                    $getdepartment=$this->RefDepartment_model->get_list(
                    $department_id,
                    'ref_department.department'
                    );
                    $data['get_department'] = $getdepartment[0]->department;
                }
                else{
                    $data['get_department'] = "All";
                }

                if($pay_period_id!=0){
                    $period=$this->RefPayPeriod_model->getperiod($pay_period_id);
                    $data['get_period'] = $period[0]->period;
                }
                else{
                    $data['get_period'] = "";
                }
                       
                $getcompany=$this->CompanyManagement_model->get_list($this->session->company_id);

                $data['company']=$getcompany[0];
                $data['type']=$filter_value5;

                echo $this->load->view('template/employee_payroll_summary_html',$data,TRUE);

            break;

            case 'employeee-yearly-salary': //

                            $getpayrollregsummary=$this->PayrollReports_model->get_yearly_salary_history($filter_value,$filter_value2,$filter_value3);
                        //show only inside grid with menu button
                        // if($filter_value!="all" AND $filter_value2!="all"){
                        //     /*echo json_encode($getpayrollregsummary);*/
                        // }
                        // if($filter_value=="all" AND $filter_value2!="all"){
                        //     $getpayrollregsummary=$this->PayrollReports_model->get_yearly_salary_filter_year($filter_value2,$filter_value3);
                        // }
                        // if($filter_value!="all" AND $filter_value2=="all"){
                        //     $getpayrollregsummary=$this->PayrollReports_model->get_yearly_salary_filter_employee($filter_value,$filter_value3);
                        // }
                        // if($filter_value=="all" AND $filter_value2=="all"){
                        //     $getpayrollregsummary=$this->PayrollReports_model->get_yearly_salary_wofilter($filter_value3);
                        // }

                        /*echo json_encode($getpayrollregsummary);*/
                        /*$getpayrollregsummary=$this->Payslip_model->get_list(
                        null,
                        'pay_slip.*,refpayperiod.pay_period_start,refpayperiod.pay_period_end',
                        array(
                             array('daily_time_record','daily_time_record.dtr_id=pay_slip.dtr_id','left'),
                             array('refpayperiod','refpayperiod.pay_period_id=daily_time_record.pay_period_id','left'),
                             )
                        );*/
                        /*//GET SALARY ADJUSTMENTS
                        $getadjustment=$this->Payslip_OtherEarning_model->get_list(
                        array('pay_slip_other_earnings.earnings_id'=>2),
                        'SUM(earnings_amount) as total_adjustment_amount'
                        );
                         //GET OTHER PAY/EARNING
                        $getotherpay=$this->Payslip_OtherEarning_model->get_list(
                        'pay_slip_other_earnings.earnings_id!=2',
                        'SUM(earnings_amount) as total_other_pay'
                        );
                         //TOTAL SSS DEDUCTION GET
                        $gettotalsssdeduction=$this->PaySlip_deduction_model->get_list(
                        'deduction_id=1 AND active_deduct=TRUE',
                        'SUM(deduction_amount) as total_sss_deduct'
                        );

                        //TOTAL PHILHEALTH GET
                        $gettotalphilhealthdeduction=$this->PaySlip_deduction_model->get_list(
                        'deduction_id=2 AND active_deduct=TRUE',
                        'SUM(deduction_amount) as total_philhealth_deduct'
                        );
                        //TOTAL PHILHEALTH GET
                        $gettotalpagibigdeduction=$this->PaySlip_deduction_model->get_list(
                        'deduction_id=3 AND active_deduct=TRUE',
                        'SUM(deduction_amount) as total_pagibig_deduct'
                        );

                        $gettotalwithholdingdeduction=$this->PaySlip_deduction_model->get_list(
                        'deduction_id=4 AND active_deduct=TRUE',
                        'SUM(deduction_amount) as total_withholdingtax_deduct'
                        );
                        //get total sss loan
                        $gettotalsssloandeduction=$this->PaySlip_deduction_model->get_list(
                        'deduction_id=5 AND active_deduct=TRUE',
                        'SUM(deduction_amount) as total_sss_loan'
                        );
                        //get total pagibig loan
                        $gettotalpagibigloandeduction=$this->PaySlip_deduction_model->get_list(
                        'deduction_id=6 AND active_deduct=TRUE',
                        'SUM(deduction_amount) as total_pagibig_loan'
                        );
                        //COOP LOAN DEDUCTION GET
                        $gettotalcooploandeduction=$this->PaySlip_deduction_model->get_list(
                        'deduction_id=8 AND active_deduct=TRUE',
                        'SUM(deduction_amount) as total_coop_loan'
                        );
                        //COOP CONTRIBUTION DEDUCTION GET
                        $gettotalcoopcontributiondeduction=$this->PaySlip_deduction_model->get_list(
                        'deduction_id=9 AND active_deduct=TRUE',
                        'SUM(deduction_amount) as total_coop_contribution'
                        );
                        //OTHER DEDUCTION GET
                        $gettotalotherdeduction=$this->PaySlip_deduction_model->get_list(
                        'deduction_id!=1  AND deduction_id!=2  AND deduction_id!=3  AND deduction_id!=4
                         AND deduction_id!=5  AND deduction_id!=6  AND deduction_id!=7  AND deduction_id!=8  AND deduction_id!=9 AND active_deduct=TRUE',
                        'SUM(deduction_amount) as total_other_deduction'
                        );*/

                       /*echo json_encode($gettotalotherdeduction);*/

                        /*echo json_encode($getpayrollregsummary);*/
                        if($filter_value3!="all"){
                            $getbranch=$this->RefBranch_model->get_list(
                            $filter_value3,
                            'ref_branch.branch'
                            );
                            $get_branch = $getbranch[0]->branch;
                        }
                        else{
                            $get_branch = "All";
                        }

                        $data['payroll_register_summary']=$getpayrollregsummary;
                        $data['get_branch']=$get_branch;
                        $data['yearly']=$filter_value2;
                        $getcompany=$this->CompanyManagement_model->get_company_list($this->session->company_id);
                        $data['company']=$getcompany[0];



                        /*$data['total_adjustment_amount']=$getadjustment[0];
                        $data['total_other_pay']=$getotherpay[0];
                        $data['total_sss_deduct']=$gettotalsssdeduction[0];
                        $data['total_philhealth_deduct']=$gettotalphilhealthdeduction[0];
                        $data['total_pagibig_deduct']=$gettotalpagibigdeduction[0];
                        $data['total_withholdingtax_deduct']=$gettotalwithholdingdeduction[0];
                        $data['total_sss_loan']=$gettotalsssloandeduction[0];
                        $data['total_pagibig_loan']=$gettotalpagibigloandeduction[0];
                        $data['total_coop_loan']=$gettotalcooploandeduction[0];
                        $data['total_coop_contribution']=$gettotalcoopcontributiondeduction[0];
                        $data['total_other_deduction']=$gettotalotherdeduction[0];*/
                            echo $this->load->view('template/employee_yearly_salary_html',$data,TRUE);

                        break;

                     case 'employeee-13thmonth-pay':
                        
                        $company_id = $this->session->company_id;
                        $year = $filter_value;
                        $branch_id = $filter_value2;
                        $department_id = $filter_value3;
                        $employee_id = $filter_value4;
                        $emp_status = $filter_value5;

                        $get13thmonth_pay=$this->PayrollReports_model->get_13thmonthpay($year,$branch_id,$department_id,$employee_id,$emp_status,$company_id);

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

                        $data['get13thmonth_pay']=$get13thmonth_pay;
                        $data['year']=$filter_value;
                        $data['type']=$type;

                        $getcompany=$this->CompanyManagement_model->get_company_list($this->session->company_id);
                        $data['company']=$getcompany[0];

                        echo $this->load->view('template/employee_13thmonth_html',$data,TRUE);
                    break;

            case 'export-employeee-13thmonth-pay':
                $excel = $this->excel;

                $company_id = $this->session->company_id;
                $pay_period = $filter_value;
                $branch_id = $filter_value2;
                $department_id = $filter_value3;
                $employee_id = $filter_value4;
                $emp_status = $filter_value5;

                $get13thmonth_pay=$this->PayrollReports_model->get_13thmonthpay($pay_period,$branch_id,$department_id,$employee_id,$emp_status,$company_id);
                
                if($branch_id !="all"){
                    $getbranch=$this->RefBranch_model->get_list(
                    $branch_id,
                    'ref_branch.branch'
                    );
                    $get_branch = $getbranch[0]->branch;
                }
                else{
                    $get_branch = "All";
                }

                if($department_id !="all"){
                    $getdepartment=$this->RefDepartment_model->get_list(
                    $department_id,
                    'ref_department.department'
                    );
                    $get_department = $getdepartment[0]->department;
                }
                else{
                    $get_department = "All";
                }

                $getcompany=$this->CompanyManagement_model->get_company_list($this->session->company_id);
                $company=$getcompany[0];

                $excel->setActiveSheetIndex(0);
                        //name the worksheet

                        $excel->getActiveSheet()->setTitle("Employee 13th Month Pay");

                        $excel->getActiveSheet()->getStyle('A1'.':'.'A3')->getFont()->setBold(TRUE);

                        $excel->getActiveSheet()->mergeCells('A1:D1');
                        $excel->getActiveSheet()->mergeCells('A2:D2');
                        $excel->getActiveSheet()->mergeCells('A3:D3');

                        $excel->getActiveSheet()->setCellValue('A1','Year : '.$pay_period)
                                                ->setCellValue('A2','Branch : '.$get_branch)
                                                ->setCellValue('A3','Department : '.$get_department);

                        $excel->getActiveSheet()->getStyle('A5:D5')->getFont()->setBold(TRUE);

                        $excel->getActiveSheet()->getColumnDimension('A')->setWidth('5');
                        $excel->getActiveSheet()->getColumnDimension('B')->setWidth('35');
                        $excel->getActiveSheet()->getColumnDimension('C')->setWidth('20');
                        $excel->getActiveSheet()->getColumnDimension('D')->setWidth('30');
                                
                        $excel->getActiveSheet()
                                ->getStyle('C5:D5')
                                ->getAlignment()
                                ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

                        $excel->getActiveSheet()->setCellValue('A5','#');
                        $excel->getActiveSheet()->setCellValue('B5','Employee');
                        $excel->getActiveSheet()->setCellValue('C5','Total Reg Pay');
                        $excel->getActiveSheet()->setCellValue('D5','Accumulated 13th Month Pay');

                        $i = 6;
                        $a = 1;
                        $total_reg = 0;
                        $total_13thmonth = 0;

                        if(count($get13thmonth_pay)!=0 || count($get13thmonth_pay)!=null){
                            foreach($get13thmonth_pay as $row){

                                $total_reg += $row->total_reg;
                                $total_13thmonth += $row->total_13thmonth;

                                $excel->getActiveSheet()
                                        ->getStyle('A'.$i)
                                        ->getAlignment()
                                        ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);

                                $excel->getActiveSheet()
                                        ->getStyle('C'.$i.':'.'D'.$i)
                                        ->getAlignment()
                                        ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
                                
                                $excel->getActiveSheet()->getStyle('C'.$i.':'.'D'.$i)->getNumberFormat()->setFormatCode('###,##0.00;(###,##0.00)'); 

                                $excel->getActiveSheet()->setCellValue('A'.$i,$a);
                                $excel->getActiveSheet()->setCellValue('B'.$i,$row->fullname);
                                $excel->getActiveSheet()->setCellValue('C'.$i,number_format($row->total_reg,2));   
                                $excel->getActiveSheet()->setCellValue('D'.$i,number_format($row->total_13thmonth,2));                                  

                                $i++;
                                $a++;
                            }}
                            else{ 

                                    $excel->getActiveSheet()
                                            ->getStyle('A'.$i)
                                            ->getAlignment()
                                            ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  

                                    $excel->getActiveSheet()->mergeCells('A'.$i.':'.'D'.$i);
                                    $excel->getActiveSheet()->setCellValue('A'.$i,'No Result');
                                    $i++;
                            }


                            $excel->getActiveSheet()->mergeCells('A'.$i.':B'.$i);
                            $excel->getActiveSheet()->setCellValue('A'.$i,'Total: ');

                            $excel->getActiveSheet()->getStyle('C'.$i.':D'.$i)->getNumberFormat()->setFormatCode('###,##0.00;(###,##0.00)');   

                            $excel->getActiveSheet()
                                    ->getStyle('A'.$i.':D'.$i)
                                    ->getAlignment()
                                    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

                            $excel->getActiveSheet()->getStyle('A'.$i.':D'.$i)->getFont()->setBold(TRUE);

                            $excel->getActiveSheet()->setCellValue('C'.$i,number_format($total_reg,2));
                            $excel->getActiveSheet()->setCellValue('D'.$i,number_format($total_13thmonth,2));

                            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
                            header('Content-Disposition: attachment;filename='."Employee 13th Month Pay (".$pay_period.") .xlsx".'');
                            header('Cache-Control: max-age=0');
                            // If you're serving to IE 9, then the following may be needed
                            header('Cache-Control: max-age=1');
                            // If you're serving to IE over SSL, then the following may be needed
                            header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
                            header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
                            header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
                            header ('Pragma: public'); // HTTP/1.0

                            $objWriter = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
                            $objWriter->save('php://output');
                    break;

                    case 'employee-compensation':
                        $data['employee_compensation']=$this->PayrollReports_model->get_employee_compensation($filter_value,$filter_value2);

                        $data['employeename']=$this->Employee_model->get_list(
                        $filter_value2,
                        'CONCAT(employee_list.first_name," ",middle_name," ",employee_list.last_name) as full_name,ecode'
                        );

                        $data['year']=$filter_value;
                        $data['type']=$filter_value3;

                        $getcompany=$this->CompanyManagement_model->get_company_list($this->session->company_id);
                        $data['company']=$getcompany[0];

                        echo $this->load->view('template/employee_compensation_html',$data,TRUE);
                    break;

            case 'export-employee-compensation':
                $excel = $this->excel;

                $pay_period = $filter_value;
                $employee_id = $filter_value2;

                $getec=$this->PayrollReports_model->get_employee_compensation($filter_value,$filter_value2);

                $employee_name = $this->Employee_model->get_list(
                $filter_value2,
                'CONCAT(employee_list.first_name," ",middle_name," ",employee_list.last_name) as full_name,ecode'
                );

                $ename = $employee_name[0]->full_name;
                $ecode = $employee_name[0]->ecode;

                $getcompany=$this->CompanyManagement_model->get_company_list($this->session->company_id);
                $company=$getcompany[0];

                $excel->setActiveSheetIndex(0);
                        //name the worksheet

                        $excel->getActiveSheet()->setTitle("Employee Compensation History");
                        $excel->getActiveSheet()->getStyle('A1'.':'.'A2')->getFont()->setBold(TRUE);

                        $excel->getActiveSheet()->mergeCells('A1:F1');
                        $excel->getActiveSheet()->mergeCells('A2:F2');

                        $excel->getActiveSheet()->setCellValue('A1','Year : '.$pay_period)
                                                ->setCellValue('A2','Employee : '.$ecode.'    '.$ename);

                        $excel->getActiveSheet()->getStyle('A4:F4')->getFont()->setBold(TRUE);

                        $excel->getActiveSheet()->getColumnDimension('A')->setWidth('5');
                        $excel->getActiveSheet()->getColumnDimension('B')->setWidth('20');
                        $excel->getActiveSheet()->getColumnDimension('C')->setWidth('20');
                        $excel->getActiveSheet()->getColumnDimension('D')->setWidth('20');
                        $excel->getActiveSheet()->getColumnDimension('E')->setWidth('20');
                        $excel->getActiveSheet()->getColumnDimension('F')->setWidth('20');
                                
                        $excel->getActiveSheet()
                                ->getStyle('C4:F4')
                                ->getAlignment()
                                ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

                        $excel->getActiveSheet()->setCellValue('A4','#');
                        $excel->getActiveSheet()->setCellValue('B4','Month');
                        $excel->getActiveSheet()->setCellValue('C4','Gross Pay');
                        $excel->getActiveSheet()->setCellValue('D4','Net Pay');
                        $excel->getActiveSheet()->setCellValue('E4','13th Month Pay');
                        $excel->getActiveSheet()->setCellValue('F4','Deductions');

                        $i = 5;
                        $a = 1;

                        $total_gross = 0;
                        $total_net_pay = 0;
                        $total_13thmonth = 0;
                        $total_deduction = 0;

                        if(count($getec)!=0 || count($getec)!=null){
                            foreach($getec as $row){

                                $total_gross += $row->sum_regpay;
                                $total_net_pay += $row->sum_netpay;
                                $total_13thmonth += $row->sum_for_13thmonth;
                                $total_deduction += $row->sum_total_deduction;

                                $excel->getActiveSheet()
                                        ->getStyle('A'.$i)
                                        ->getAlignment()
                                        ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);

                                $excel->getActiveSheet()
                                        ->getStyle('C'.$i.':'.'F'.$i)
                                        ->getAlignment()
                                        ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
                                
                                $excel->getActiveSheet()->getStyle('C'.$i.':'.'F'.$i)->getNumberFormat()->setFormatCode('###,##0.00;(###,##0.00)'); 

                                $excel->getActiveSheet()->setCellValue('A'.$i,$a);
                                $excel->getActiveSheet()->setCellValue('B'.$i,$row->month);
                                $excel->getActiveSheet()->setCellValue('C'.$i,number_format($row->sum_regpay,2));   
                                $excel->getActiveSheet()->setCellValue('D'.$i,number_format($row->sum_netpay,2)); 
                                $excel->getActiveSheet()->setCellValue('E'.$i,number_format($row->sum_for_13thmonth,2));                                  
                                $excel->getActiveSheet()->setCellValue('F'.$i,number_format($row->sum_total_deduction,2));                                  
                                 

                                $i++;
                                $a++;
                            }}
                            else{ 

                                    $excel->getActiveSheet()
                                            ->getStyle('A'.$i)
                                            ->getAlignment()
                                            ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  

                                    $excel->getActiveSheet()->mergeCells('A'.$i.':'.'F'.$i);
                                    $excel->getActiveSheet()->setCellValue('A'.$i,'No Result');
                                    $i++;
                            }


                            $excel->getActiveSheet()->mergeCells('A'.$i.':B'.$i);
                            $excel->getActiveSheet()->setCellValue('A'.$i,'Total: ');

                            $excel->getActiveSheet()->getStyle('C'.$i.':F'.$i)->getNumberFormat()->setFormatCode('###,##0.00;(###,##0.00)');   

                            $excel->getActiveSheet()
                                    ->getStyle('A'.$i.':F'.$i)
                                    ->getAlignment()
                                    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

                            $excel->getActiveSheet()->getStyle('A'.$i.':F'.$i)->getFont()->setBold(TRUE);


                            $excel->getActiveSheet()->setCellValue('C'.$i,number_format($total_gross,2));
                            $excel->getActiveSheet()->setCellValue('D'.$i,number_format($total_net_pay,2));
                            $excel->getActiveSheet()->setCellValue('E'.$i,number_format($total_13thmonth,2));
                            $excel->getActiveSheet()->setCellValue('F'.$i,number_format($total_deduction,2));

                            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
                            header('Content-Disposition: attachment;filename='."Employee Compensation History (".$pay_period." - ".$ename.") .xlsx".'');
                            header('Cache-Control: max-age=0');
                            // If you're serving to IE 9, then the following may be needed
                            header('Cache-Control: max-age=1');
                            // If you're serving to IE over SSL, then the following may be needed
                            header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
                            header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
                            header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
                            header ('Pragma: public'); // HTTP/1.0

                            $objWriter = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
                            $objWriter->save('php://output');
                    break;

                    case 'employee-deduction-history':
                        $data['employee_deduction']=$this->PayrollReports_model->get_employee_deduction_history($filter_value,$filter_value2);
                        $data['employeename']=$this->Employee_model->get_list(
                        $filter_value2,
                        'CONCAT(employee_list.first_name," ",middle_name," ",employee_list.last_name) as full_name,ecode'
                        );
                        $data['year']=$filter_value;
                        $data['type']=$filter_value3;

                        $getcompany=$this->CompanyManagement_model->get_list($this->session->company_id);
                        $data['company']=$getcompany[0];
                        echo $this->load->view('template/employee_deduction_history_html',$data,TRUE);
                        // echo json_encode($data);
                    break;

                    case 'export-employee-deduction-history':
                        $excel = $this->excel;

                        $pay_period_year = $filter_value;
                        $employee_id = $filter_value2;

                        $employee_deduction=$this->PayrollReports_model->get_employee_deduction_history($pay_period_year,$employee_id);

                        $employee_name = $this->Employee_model->get_list(
                        $employee_id,
                        'CONCAT(employee_list.first_name," ",middle_name," ",employee_list.last_name) as full_name,ecode'
                        );

                        $ename = $employee_name[0]->full_name;
                        $ecode = $employee_name[0]->ecode;

                        $getcompany=$this->CompanyManagement_model->get_company_list($this->session->company_id);
                        $company=$getcompany[0];

                        $excel->setActiveSheetIndex(0);
                                //name the worksheet

                        $excel->getActiveSheet()->setTitle("Employee Deduction History");
                        $excel->getActiveSheet()->getStyle('A1'.':'.'A2')->getFont()->setBold(TRUE);

                        $excel->getActiveSheet()->mergeCells('A1:F1');
                        $excel->getActiveSheet()->mergeCells('A2:F2');

                        $excel->getActiveSheet()->setCellValue('A1','Year : '.$pay_period_year)
                                                ->setCellValue('A2','Employee : '.$ecode.'    '.$ename);

                        $excel->getActiveSheet()->getStyle('A4:F4')->getFont()->setBold(TRUE);

                        $excel->getActiveSheet()->getColumnDimension('A')->setWidth('5');
                        $excel->getActiveSheet()->getColumnDimension('B')->setWidth('20');
                        $excel->getActiveSheet()->getColumnDimension('C')->setWidth('20');
                        $excel->getActiveSheet()->getColumnDimension('D')->setWidth('20');
                        $excel->getActiveSheet()->getColumnDimension('E')->setWidth('20');
                        $excel->getActiveSheet()->getColumnDimension('F')->setWidth('20');
                                
                        $excel->getActiveSheet()
                                ->getStyle('C4:F4')
                                ->getAlignment()
                                ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

                        $excel->getActiveSheet()->setCellValue('A4','#');
                        $excel->getActiveSheet()->setCellValue('B4','Month');
                        $excel->getActiveSheet()->setCellValue('C4','SSS');
                        $excel->getActiveSheet()->setCellValue('D4','Philhealth');
                        $excel->getActiveSheet()->setCellValue('E4','Pagibig');
                        $excel->getActiveSheet()->setCellValue('F4','W/Tax');

                        $i = 5;
                        $a = 1;

                        $total_sss = 0;
                        $total_philhealth = 0;
                        $total_pagibig = 0;
                        $total_wtax = 0;

                        if(count($employee_deduction)!=0 || count($employee_deduction)!=null){
                            foreach($employee_deduction as $row){

                                $total_sss += $row->sss;
                                $total_philhealth += $row->philhealth;
                                $total_pagibig += $row->pagibig;
                                $total_wtax += $row->wtax;

                                $excel->getActiveSheet()
                                        ->getStyle('A'.$i)
                                        ->getAlignment()
                                        ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);

                                $excel->getActiveSheet()
                                        ->getStyle('C'.$i.':'.'F'.$i)
                                        ->getAlignment()
                                        ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
                                
                                $excel->getActiveSheet()->getStyle('C'.$i.':'.'F'.$i)->getNumberFormat()->setFormatCode('###,##0.00;(###,##0.00)'); 

                                $excel->getActiveSheet()->setCellValue('A'.$i,$a);
                                $excel->getActiveSheet()->setCellValue('B'.$i,$row->month);
                                $excel->getActiveSheet()->setCellValue('C'.$i,number_format($row->sss,2));   
                                $excel->getActiveSheet()->setCellValue('D'.$i,number_format($row->philhealth,2)); 
                                $excel->getActiveSheet()->setCellValue('E'.$i,number_format($row->pagibig,2));                                  
                                $excel->getActiveSheet()->setCellValue('F'.$i,number_format($row->wtax,2));                                  
                                 

                                $i++;
                                $a++;
                            }}
                            else{ 

                                    $excel->getActiveSheet()
                                            ->getStyle('A'.$i)
                                            ->getAlignment()
                                            ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  

                                    $excel->getActiveSheet()->mergeCells('A'.$i.':'.'F'.$i);
                                    $excel->getActiveSheet()->setCellValue('A'.$i,'No Result');
                                    $i++;
                            }


                            $excel->getActiveSheet()->mergeCells('A'.$i.':B'.$i);
                            $excel->getActiveSheet()->setCellValue('A'.$i,'Total: ');

                            $excel->getActiveSheet()->getStyle('C'.$i.':F'.$i)->getNumberFormat()->setFormatCode('###,##0.00;(###,##0.00)');   

                            $excel->getActiveSheet()
                                    ->getStyle('A'.$i.':F'.$i)
                                    ->getAlignment()
                                    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

                            $excel->getActiveSheet()->getStyle('A'.$i.':F'.$i)->getFont()->setBold(TRUE);


                            $excel->getActiveSheet()->setCellValue('C'.$i,number_format($total_sss,2));
                            $excel->getActiveSheet()->setCellValue('D'.$i,number_format($total_philhealth,2));
                            $excel->getActiveSheet()->setCellValue('E'.$i,number_format($total_pagibig,2));
                            $excel->getActiveSheet()->setCellValue('F'.$i,number_format($total_wtax,2));

                            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
                            header('Content-Disposition: attachment;filename='."Employee Deduction History (".$pay_period_year." - ".$ename.") .xlsx".'');
                            header('Cache-Control: max-age=0');
                            // If you're serving to IE 9, then the following may be needed
                            header('Cache-Control: max-age=1');
                            // If you're serving to IE over SSL, then the following may be needed
                            header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
                            header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
                            header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
                            header ('Pragma: public'); // HTTP/1.0

                            $objWriter = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
                            $objWriter->save('php://output');
                    break;


                    case 'date':
                        date_default_timezone_set("Asia/Taipei");
                        echo "The time is " .date("Y/m/d");
                    break;

        }
    }
}
