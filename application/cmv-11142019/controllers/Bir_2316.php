<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bir_2316 extends CORE_Controller
{

    function __construct() {
        parent::__construct('');
        $this->validate_session();
        if($this->session->userdata('right_bir2316_view') == 0 || $this->session->userdata('right_bir2316_view') == null) {
            redirect('../Dashboard');
        }
        $this->load->library('excel');
        $this->load->model('Employee_model');
        $this->load->model('RefPayPeriod_model');
        $this->load->model('RefBranch_model');
        $this->load->model('RefDepartment_model');
        $this->load->model('PayrollReports_model');
        $this->load->model('Payslip_model');

    }
    public function index() {
        $data['_def_css_files'] = $this->load->view('template/assets/css_files', '', TRUE);
        $data['_def_css_custom'] = $this->load->view('template/assets/css_custom', '', TRUE);
        $data['_def_js_files'] = $this->load->view('template/assets/js_files', '', TRUE);
        $data['_switcher_settings'] = $this->load->view('template/elements/switcher', '', TRUE);
        $data['_rights'] = $this->load->view('template/elements/rights', '', TRUE);
        $data['_side_bar_navigation'] = $this->load->view('template/elements/side_bar_navigation', '', TRUE);
        $data['_top_navigation'] = $this->load->view('template/elements/top_navigation', '', TRUE);
        $data['loader'] = $this->load->view('template/elements/loader', '', TRUE);
        $data['loaderscript'] = $this->load->view('template/elements/loaderscript', '', TRUE);
        $data['branch'] = $this->RefBranch_model->get_branch_list($this->session->company_id);
        $data['department'] = $this->RefDepartment_model->get_department_list($this->session->company_id);
        $data['title'] = 'JCORE - BIR 2316';
        $this->load->view('bir_2316_view', $data);
    }


    function layout($transaction=null,$filter_value=null,$filter_value2=null,$filter_value3=null,$filter_value4=null,$filter_value5=null,$type=null){

        switch($transaction){

            case 'list':
                $pay_period_year = $this->input->get('pay_period_year',TRUE);
                $branch_id = $this->input->get('branch_id',TRUE);
                $emp_status = $this->input->get('emp_status',TRUE);
                $department_id = $this->input->get('department_id',TRUE);
                $response['data'] = $this->Payslip_model->get_bir_2316($this->session->company_id,$pay_period_year,$emp_status,$branch_id,$department_id);
                echo json_encode($response);
                break;

            case 'export_1601C':

            $year = $filter_value;
            $month_filter = $filter_value2;
            $branch_id = $filter_value3;
            $department_id = $filter_value4;
            $emp_status = $filter_value5;

            $excel=$this->excel;

            $excel->setActiveSheetIndex(0);
            $transaction=$this->PayrollReports_model->get_1601C_list($this->session->company_id,$year,$month_filter,$branch_id,$department_id,$emp_status);

           if($branch_id!="all"){
                $getbranch=$this->RefBranch_model->get_list(
                $branch_id,
                'ref_branch.branch'
                );
                $get_branch=$getbranch[0]->branch;
            }
            else{
                $get_branch="All";
            }

            if($department_id!="all"){
                $getdepartment=$this->RefDepartment_model->get_list(
                $department_id,
                'ref_department.department'
                );
                $get_department=$getdepartment[0]->department;
            }
            else{
                $get_department="All";
            }

            $month = "";

            if ($month_filter == 1){
                $month='January';
            }else if ($month_filter == 2){
                $month='February'; 
            }else if ($month_filter == 3){
                $month='March';
            }else if ($month_filter == 4){
                $month='April';
            }else if ($month_filter == 5){
                $month='May';
            }else if ($month_filter == 6){
                $month='June';
            }else if ($month_filter == 7){
                $month='July';
            }else if ($month_filter == 8){
                $month='August';
            }else if ($month_filter == 9){
                $month='September';
            }else if ($month_filter == 10){
                $month='October';
            }else if ($month_filter == 11){
                $month='November';
            }else if ($month_filter == 12){
                $month='December';
            }

            //name the worksheet
            $excel->getActiveSheet()->setTitle("1601C");

            $excel->getActiveSheet()->getStyle('A1:A4')->getFont()->setBold(TRUE);
            $excel->getActiveSheet()->setCellValue('A1',"Schedule of taxes withheld (1601C)")
                                    ->setCellValue('A2',$month.' '.$year)
                                    ->setCellValue('A3','Branch : '.$get_branch)
                                    ->setCellValue('A4','Department : '.$get_department);

            $excel->getActiveSheet()->mergeCells('A1:T1');
            $excel->getActiveSheet()->mergeCells('A2:T2');
            $excel->getActiveSheet()->mergeCells('A3:T3');
            $excel->getActiveSheet()->mergeCells('A4:T4');
            $excel->getActiveSheet()->mergeCells('A5:T5');

            $excel->getActiveSheet()
                  ->getStyle('G6:T6')
                  ->getAlignment()
                  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

            $excel->getActiveSheet()->getColumnDimension('A')->setWidth('5');
            $excel->getActiveSheet()->getColumnDimension('B')->setWidth('10');
            $excel->getActiveSheet()->getColumnDimension('C')->setWidth('20');
            $excel->getActiveSheet()->getColumnDimension('D')->setWidth('20');
            $excel->getActiveSheet()->getColumnDimension('E')->setWidth('20');
            $excel->getActiveSheet()->getColumnDimension('F')->setWidth('20');
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
            $excel->getActiveSheet()->getColumnDimension('T')->setWidth('15');

            //create headers
            $excel->getActiveSheet()->getStyle('A6:T6')->getFont()->setBold(TRUE);
            $excel->getActiveSheet()->setCellValue('A6', '#')
                                    ->setCellValue('B6', 'Ecode')
                                    ->setCellValue('C6', 'Surname')
                                    ->setCellValue('D6', 'Given Name')
                                    ->setCellValue('E6', 'Middle Name')
                                    ->setCellValue('F6', 'TIN No.')
                                    ->setCellValue('G6', '+Holiday')
                                    ->setCellValue('H6', '/day')
                                    ->setCellValue('I6', 'Gross Tax')
                                    ->setCellValue('J6', 'Gross Pay')
                                    ->setCellValue('K6', 'HDMFeR')
                                    ->setCellValue('L6', 'HDMFee')
                                    ->setCellValue('M6', 'SSSeR')
                                    ->setCellValue('N6', 'SSSeC')
                                    ->setCellValue('O6', 'SSSeE')
                                    ->setCellValue('P6', 'PHICeR')
                                    ->setCellValue('Q6', 'PHICeE')
                                    ->setCellValue('R6', 'Salary')
                                    ->setCellValue('S6', 'Compensation')
                                    ->setCellValue('T6', 'Withheld');
            $rows=array();
            $i=7;
            $a=1;
            foreach($transaction as $x){

                $excel->getActiveSheet()->getStyle('G'.$i.':'.'T'.$i)->getNumberFormat()->setFormatCode('###,##0.00;(###,##0.00)');
                $excel->getActiveSheet()
                    ->getStyle('G'.$i.':'.'T'.$i)
                    ->getAlignment()
                    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

                $excel->getActiveSheet()
                      ->getStyle('A'.$i.':B'.$i)
                      ->getAlignment()
                      ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);

                $excel->getActiveSheet()->setCellValue('A'.$i,$a);
                $excel->getActiveSheet()->setCellValue('B'.$i,$x->ecode);
                $excel->getActiveSheet()->setCellValue('C'.$i,$x->last_name);
                $excel->getActiveSheet()->setCellValue('D'.$i,$x->first_name);
                $excel->getActiveSheet()->setCellValue('E'.$i,$x->middle_name);
                $excel->getActiveSheet()->setCellValue('F'.$i,$x->tin);
                $excel->getActiveSheet()->setCellValue('G'.$i,number_format($x->holiday_pay,2));
                $excel->getActiveSheet()->setCellValue('H'.$i,number_format($x->per_day_pay,2));
                $excel->getActiveSheet()->setCellValue('I'.$i,number_format($x->reg_pay,2));
                $excel->getActiveSheet()->setCellValue('J'.$i,number_format($x->gross_pay,2));
                $excel->getActiveSheet()->setCellValue('K'.$i,number_format($x->HDMFeR,2));
                $excel->getActiveSheet()->setCellValue('L'.$i,number_format($x->HDMFee,2));
                $excel->getActiveSheet()->setCellValue('M'.$i,number_format($x->SSSeR,2));
                $excel->getActiveSheet()->setCellValue('N'.$i,number_format($x->SSSeC,2));
                $excel->getActiveSheet()->setCellValue('O'.$i,number_format($x->SSSeE,2));
                $excel->getActiveSheet()->setCellValue('P'.$i,number_format($x->PHICeR,2));
                $excel->getActiveSheet()->setCellValue('Q'.$i,number_format($x->PHICeE,2));
                $excel->getActiveSheet()->setCellValue('R'.$i,number_format(($x->SSSeE+$x->PHICeE+$x->HDMFee),2));
                $excel->getActiveSheet()->setCellValue('S'.$i,number_format($x->compensation,2));
                $excel->getActiveSheet()->setCellValue('T'.$i,number_format($x->wtax,2));

                $i++;
                $a++;

            }

            $filename = "1601C ".$month.' '.$year;

            // Redirect output to a client’s web browser (Excel2007)
            ob_end_clean();
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename='."".$filename.".xlsx".'');
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

        }
    }
}
