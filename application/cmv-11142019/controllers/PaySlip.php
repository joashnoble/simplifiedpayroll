<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payslip extends CORE_Controller
{

    function __construct() {
        parent::__construct('');
        if($this->session->userdata('user_id') == FALSE) {
            redirect('../login');
        }
        if($this->session->userdata('right_payslip_view') == 0 || $this->session->userdata('right_payslip_view') == null) {
            redirect('../Dashboard');
        }
        else{

        }
        $this->validate_session();


        $this->load->model('RefBranch_model');
        $this->load->model('RefDepartment_model');
        $this->load->model('Payslip_model');
        $this->load->model('CompanyManagement_model');

    }

    public function index() {
        $data['_def_css_files'] = $this->load->view('template/assets/css_files', '', TRUE);
        $data['_def_css_custom'] = $this->load->view('template/assets/css_custom', '', TRUE);
        $data['_def_js_files'] = $this->load->view('template/assets/js_files', '', TRUE);
        $data['_switcher_settings'] = $this->load->view('template/elements/switcher', '', TRUE);
        $data['_side_bar_navigation'] = $this->load->view('template/elements/side_bar_navigation', '', TRUE);
        $data['_top_navigation'] = $this->load->view('template/elements/top_navigationforpayslip', '', TRUE);
        $data['_rights'] = $this->load->view('template/elements/rights', '', TRUE);
        $data['loader'] = $this->load->view('template/elements/loader', '', TRUE);
        $data['loaderscript'] = $this->load->view('template/elements/loaderscript', '', TRUE);
        $data['ref_branch']=$this->RefBranch_model->get_branch_list($this->session->company_id);
        $data['ref_department']=$this->RefDepartment_model->get_department_list($this->session->company_id);
        $data['title'] = 'JCORE - Pay Slip';
        $this->load->view('pay_slip_view', $data);
    }

    function transaction($txn = null) {
        switch ($txn) {
            case 'list':
                $pay_period_id = $this->input->post('pay_period_id', TRUE);
                $ref_branch_id = $this->input->post('ref_branch_id', TRUE);
                $ref_department_id = $this->input->post('ref_department_id', TRUE);
                $is_active = $this->input->post('emp_status', TRUE);

                $response['data']=$this->Payslip_model->get_payslip_list($this->session->company_id,$pay_period_id,$ref_branch_id,$ref_department_id,null,$is_active);
                echo json_encode($response);
            break;

            case 'delete':
                $pay_slip_id = $this->input->post('pay_slip_id', TRUE);
                $this->db->where('pay_slip_id', $pay_slip_id);
                $this->db->delete('pay_slip');
            break;
        }
    }


    function layout($layout=null,$filter_value=null,$filter_value2=null,$filter_value3=null,$type=null){

        switch($layout){
            //****************************************************
            case 'pay-slip': //
                        $getpayslip=$this->Payslip_model->get_payslip_list($this->session->company_id,null,'all','all',$filter_value,'all');
                        $getcompany=$this->CompanyManagement_model->get_list(
                            null,
                            'company_management.*'
                        );
                        $data['payslip']=$getpayslip[0];
                        $data['company']=$getcompany[0];
                        
                        //show only inside grid with menu button
                        if($type=='fullview'||$type==null){
                            echo $this->load->view('template/pay_slip_content_html',$data,TRUE);
                            //echo $this->load->view('template/dr_content_menus',$data,TRUE);
                        }
                        //show only inside grid without menu button
                        if($type=='contentview'){
                            echo $this->load->view('template/pay_slip_content',$data,TRUE);
                        }
                        //download pdf
                        if($type=='pdf'){
                            $pdfFilePath = $getpayslip[0]->full_name."-".$getpayslip[0]->pay_period_start."-".$getpayslip[0]->pay_period_end.".pdf"; //generate filename base on id
                            $pdf = $this->m_pdf->load(); //pass the instance of the mpdf class
                            $content=$this->load->view('template/pay_slip_content',$data,TRUE); //load the template
                            $pdf->setFooter('{PAGENO}');
                            $pdf->WriteHTML($content);
                            //download it.
                            $pdf->Output($pdfFilePath,"D");
                        }
                        //preview on browser
                        if($type=='preview'){
                            $pdfFilePath = $getpayslip[0]->full_name.".pdf"; //generate filename base on id
                            $pdf = $this->m_pdf->load(); //pass the instance of the mpdf class
                            $content=$this->load->view('template/pay_slip_content',$data,TRUE); //load the template
                            $pdf->setFooter('{PAGENO}');
                            $pdf->WriteHTML($content);
                            //download it.
                            $pdf->SetJS('this.print();');
                            $pdf->Output();
                        }
            break;

            case 'payroll-register-summary': //
                        //show only inside grid with menu button
                        if($filter_value=="all" AND $filter_value2=="all"){
                            $filter_array=null;
                        }
                        if($filter_value=="all" AND $filter_value2!="all"){
                            $filter_array=array('refpayperiod.month_id'=>$filter_value2);
                        }
                        if($filter_value!="all" AND $filter_value2=="all"){
                            $filter_array=array('ref_branch.ref_branch_id'=>$filter_value,'emp_rates_duties.active_rates_duties'=>TRUE);
                        }
                        if($filter_value!="all" AND $filter_value2!="all"){

                        }
                        $getpayrollregsummary=$this->Payslip_model->get_list(
                        $filter_array,
                        'pay_slip.*,SUM(reg_pay) as total_reg_pay,SUM(sun_pay+reg_hol_pay+spe_hol_pay+reg_ot_pay+sun_ot_pay) as total_hol_pay_sunday,
                        SUM(reg_nsd_pay+sun_nsd_pay) as total_nsd_amount,
                        SUM(pay_slip.minutes_late_amt) as total_minutes_late,ref_branch.branch',
                        array(
                             array('daily_time_record','daily_time_record.dtr_id=pay_slip.dtr_id','left'),
                             array('emp_rates_duties','emp_rates_duties.employee_id=daily_time_record.employee_id','left'),
                             array('ref_branch','ref_branch.ref_branch_id=emp_rates_duties.ref_branch_id','left'),
                             array('refpayperiod','refpayperiod.pay_period_id=daily_time_record.pay_period_id','left'),
                             )
                        );
                        /*echo $branch;*/
                        //GET SALARY ADJUSTMENTS
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
                        );

                       /*echo jso_encode($gettotalotherdeduction);*/
                        $data['payroll_register_summary']=$getpayrollregsummary[0];
                        $data['total_adjustment_amount']=$getadjustment[0];
                        $data['total_other_pay']=$getotherpay[0];
                        $data['total_sss_deduct']=$gettotalsssdeduction[0];
                        $data['total_philhealth_deduct']=$gettotalphilhealthdeduction[0];
                        $data['total_pagibig_deduct']=$gettotalpagibigdeduction[0];
                        $data['total_withholdingtax_deduct']=$gettotalwithholdingdeduction[0];
                        $data['total_sss_loan']=$gettotalsssloandeduction[0];
                        $data['total_pagibig_loan']=$gettotalpagibigloandeduction[0];
                        $data['total_coop_loan']=$gettotalcooploandeduction[0];
                        $data['total_coop_contribution']=$gettotalcoopcontributiondeduction[0];
                        $data['total_other_deduction']=$gettotalotherdeduction[0];
                        if($type=='fullview'||$type==null){
                            echo $this->load->view('template/payroll_register_summary_html',$data,TRUE);
                            //echo $this->load->view('template/dr_content_menus',$data,TRUE);
                        }
                        //show only inside grid without menu button
                        if($type=='contentview'){
                            echo $this->load->view('template/payroll_register_summary_html',$data,TRUE);
                        }
                        //download pdf
                        if($type=='pdf'){
                            $pdfFilePath = "PR-Summary-".$getpayrollregsummary[0]->branch.".pdf"; //generate filename base on id
                            $pdf = $this->m_pdf->load(); //pass the instance of the mpdf class
                            $content=$this->load->view('template/payroll_register_summary',$data,TRUE); //load the template
                            $pdf->setFooter('{PAGENO}');
                            $pdf->WriteHTML($content);
                            //download it.
                            $pdf->Output($pdfFilePath,"D");

                        }
                        //preview on browser
                        if($type=='preview'){
                            $pdfFilePath = "PR-Summary-".$getpayrollregsummary[0]->branch.".pdf"; //generate filename base on id
                            $pdf = $this->m_pdf->load(); //pass the instance of the mpdf class
                            $content=$this->load->view('template/payroll_register_summary',$data,TRUE); //load the template
                            $pdf->setFooter('{PAGENO}');
                            $pdf->WriteHTML($content);
                            //download it.
                            /*$pdf->SetJS('this.print();');*/
                            $pdf->Output();
                        }
              break;

              case 'pay-slip-print-all':
                    $data['payslips']=$this->Payslip_model->get_payslip_list($this->session->company_id,$filter_value,$filter_value2,$filter_value3,null,$type);
                    echo $this->load->view('template/pay_slip_content_printall_html',$data,TRUE);
              break;

        }
    }
}
