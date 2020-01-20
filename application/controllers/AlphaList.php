<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AlphaList extends CORE_Controller
{

    function __construct() {
        parent::__construct('');
        $this->validate_session();
        if($this->session->userdata('right_alphalist_view') == 0 || $this->session->userdata('right_alphalist_view') == null) {
            redirect('../Dashboard');
        }
        $this->load->library('excel');
        $this->load->model('Employee_model');
        $this->load->model('RefPayPeriod_model');
        $this->load->model('RefBranch_model');
        $this->load->model('RefDepartment_model');
        $this->load->model('PayrollReports_model');
        $this->load->model('CompanyManagement_model');

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
        $data['title'] = 'JCORE - Alpha List of Employee';
        $this->load->view('alpha_list_view', $data);
    }


    function schedule($transaction=null,$filter_value=null,$filter_value2=null,$filter_value3=null,$filter_value4,$type=null){

        switch($transaction){

            case 'export-alphalist':
            $excel=$this->excel;

            $company_id = $this->session->company_id;
            $year = $filter_value;
            $branch_id = $filter_value2;
            $department_id = $filter_value3;
            $emp_status = $filter_value4;

            $excel->setActiveSheetIndex(0);
            $transaction=$this->PayrollReports_model->get_alpha_list($company_id,$year,$branch_id,$department_id,$emp_status);

            if($branch_id!="all"){
                $getbranch=$this->RefBranch_model->get_list(
                $branch_id,
                'ref_branch.branch'
                );
                $get_branch = $getbranch[0]->branch;
            }
            else{
                $get_branch = "All";
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
            
            $getcompany=$this->CompanyManagement_model->get_company_list($company_id);
            $company_name=$getcompany[0]->company_name;

            //name the worksheet
            $excel->getActiveSheet()->setTitle("Alpha List of Employee");

            $excel->getActiveSheet()->getStyle('A1:A7')->getFont()->setBold(TRUE);

            $excel->getActiveSheet()->mergeCells('A1:M1');
            $excel->getActiveSheet()->mergeCells('A2:M2');
            $excel->getActiveSheet()->mergeCells('A3:M3');
            $excel->getActiveSheet()->mergeCells('A4:M4');
            $excel->getActiveSheet()->mergeCells('A5:M5');
            $excel->getActiveSheet()->mergeCells('A6:M6');
            $excel->getActiveSheet()->mergeCells('A7:M7');
            $excel->getActiveSheet()->mergeCells('A8:M8');

            $excel->getActiveSheet()->setCellValue('A1',"Alpha List of Employee")
                  ->setCellValue('A2',$company_name)
                  ->setCellValue('A3',"Year : ".$year)
                  ->setCellValue('A4',"Branch : ".$get_branch)
                  ->setCellValue('A5',"Department : ".$get_department)
                  ->setCellValue('A6',"Exported By : ".$this->session->user_fullname)
                  ->setCellValue('A7',"Date Exported : ".date("Y-m-d h:i:s"));


            $excel->getActiveSheet()
                  ->getStyle('I9')
                  ->getAlignment()
                  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

            $excel->getActiveSheet()
                  ->getStyle('I10:K10')
                  ->getAlignment()
                  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

            $excel->getActiveSheet()
                  ->getStyle('F9:H9')
                  ->getAlignment()
                  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);      

            $excel->getActiveSheet()
                  ->getStyle('L9:M9')
                  ->getAlignment()
                  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);                  

            //create headers
            $excel->getActiveSheet()->getStyle('A9:M10')->getFont()->setBold(TRUE);
            $excel->getActiveSheet()->setCellValue('A9', '#')
                                    ->setCellValue('B9', 'Surname')
                                    ->setCellValue('C9', 'Firstname')
                                    ->setCellValue('D9', 'Middlename')
                                    ->setCellValue('E9', 'Tin #')
                                    ->setCellValue('F9', 'WTAX Whold (Jan - Nov)')
                                    ->setCellValue('G9', 'Accumulated(13th Month Pay)')
                                    ->setCellValue('H9', 'Gross Pay')
                                    ->setCellValue('I9', 'Deductions (Tax Shield)')
                                    ->mergeCells('I9:K9')
                                    ->setCellValue('I10','SSS')
                                    ->setCellValue('J10','PhilHealth')
                                    ->setCellValue('K10','Pag-Ibig')
                                    ->setCellValue('L9', 'Taxable Income')
                                    ->setCellValue('M9', 'Tax Due December');

            $excel->getActiveSheet()->getColumnDimension('A')->setWidth('5');
            $excel->getActiveSheet()->getColumnDimension('B')->setWidth('15');
            $excel->getActiveSheet()->getColumnDimension('C')->setWidth('15');
            $excel->getActiveSheet()->getColumnDimension('D')->setWidth('15');
            $excel->getActiveSheet()->getColumnDimension('E')->setWidth('20');
            $excel->getActiveSheet()->getColumnDimension('F')->setWidth('25');
            $excel->getActiveSheet()->getColumnDimension('G')->setWidth('30');
            $excel->getActiveSheet()->getColumnDimension('H')->setWidth('20');
            $excel->getActiveSheet()->getColumnDimension('I')->setWidth('20');
            $excel->getActiveSheet()->getColumnDimension('J')->setWidth('20');
            $excel->getActiveSheet()->getColumnDimension('K')->setWidth('20');
            $excel->getActiveSheet()->getColumnDimension('L')->setWidth('20');
            $excel->getActiveSheet()->getColumnDimension('M')->setWidth('20');

            $rows=array();
            $i=11;
            $a=1;
            foreach($transaction as $row){

                $excel->getActiveSheet()
                        ->getStyle('A'.$i)
                        ->getAlignment()
                        ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);

                $excel->getActiveSheet()
                        ->getStyle('F'.$i.':'.'M'.$i)
                        ->getAlignment()
                        ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

                $excel->getActiveSheet()->getStyle('F'.$i.':'.'M'.$i)->getNumberFormat()->setFormatCode('###,##0.00;(###,##0.00)'); 

                $excel->getActiveSheet()->setCellValue('A'.$i,$a);
                $excel->getActiveSheet()->setCellValue('B'.$i,$row->last_name);
                $excel->getActiveSheet()->setCellValue('C'.$i,$row->first_name);   
                $excel->getActiveSheet()->setCellValue('D'.$i,$row->middle_name);     
                $excel->getActiveSheet()->setCellValue('E'.$i,$row->tin); 
                $excel->getActiveSheet()->setCellValue('F'.$i,number_format($row->wtax,2)); 
                $excel->getActiveSheet()->setCellValue('G'.$i,number_format($row->acc_13thmonth_pay,2)); 
                $excel->getActiveSheet()->setCellValue('H'.$i,number_format($row->yearly_gross,2)); 
                $excel->getActiveSheet()->setCellValue('I'.$i,number_format($row->yearly_sss,2)); 
                $excel->getActiveSheet()->setCellValue('J'.$i,number_format($row->yearly_phil,2)); 
                $excel->getActiveSheet()->setCellValue('K'.$i,number_format($row->yearly_pagibig,2));  
                $excel->getActiveSheet()->setCellValue('L'.$i,number_format($row->taxable_income,2));       

                $i++;
                $a++;

            }

            ob_end_clean();
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename='."Alpha List of Employee ".$year.".xlsx".'');
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
