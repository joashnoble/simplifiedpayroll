<?php
defined('BASEPATH') OR exit('No direct script access allowed');
    require 'application/third_party/Carbon.php';
    use Carbon\Carbon;
class Hris_Reports extends CORE_Controller
{

    function __construct() {
        parent::__construct('');
        $this->validate_session();
        $this->load->model('Employee_model');
        $this->load->model('RefBranch_model');
        $this->load->model('RefDepartment_model');
        $this->load->model('CompanyManagement_model');
        $this->load->model('DailyTimeRecord_model');
        $this->load->model('Users_model');
        $this->load->library('excel');

    }

    function reports($reports=null,$filter_value=null,$filter_value2=null,$filter_value3=null,$filter_value4=null,$filter_value5=null,$type=null){

        switch($reports){

            case 'sss-list':

                        $company_id = $this->session->company_id;
                        $year = $filter_value;
                        $month_filter = $filter_value2;
                        $branch_id = $filter_value3;
                        $department_id = $filter_value4;
                        $emp_status = $filter_value5;

                        if($month_filter==1){
                             $month="January";
                        }
                        else if($month_filter==2){
                             $month="February";
                        }
                        else if($month_filter==3){
                             $month="March";
                        }
                        else if($month_filter==4){
                            $month="April";
                        }
                        else if($month_filter==5){
                             $month="May";
                        }
                        else if($month_filter==6){
                             $month="June";
                        }
                        else if($month_filter==7){
                             $month="July";
                        }
                        else if($month_filter==8){
                             $month="August";
                        }
                        else if($month_filter==9){
                            $month="September";
                        }
                        else if($month_filter==10){
                             $month="October";
                        }
                        else if($month_filter==11){
                             $month="November";
                        }
                        else if($month_filter==12){
                             $month="December";
                        }
                        else{
                            $month="All";
                        }

                        if($branch_id=="all"){
                            $data['branch']="All";
                        }
                        else{
                            $getbranch=$this->RefBranch_model->get_list(
                            $branch_id,
                            'ref_branch.branch,'
                            );
                            $data['branch']=$getbranch[0]->branch;
                        }

                        if($department_id=="all"){
                            $data['department']="All";
                        }
                        else{
                            $getdepartment=$this->RefDepartment_model->get_list(
                            $department_id,
                            'ref_department.department,'
                            );
                            $data['department']=$getdepartment[0]->department;
                        }

                        $data['sss_report']=$this->DailyTimeRecord_model->get_sss_report($company_id,$year,$month_filter,$branch_id,$department_id,$emp_status);
                        $getcompany=$this->CompanyManagement_model->get_company_list($company_id);

                        $data['company']=$getcompany[0];
                        $data['type']=$type;
                        $data['month']=$month;
                        $data['year']=$year;
                        echo $this->load->view('template/sss_list_html',$data,TRUE);
                break;

                case 'export-sss-list':

                        $company_id = $this->session->company_id;
                        $year = $filter_value;
                        $month_filter = $filter_value2;
                        $branch_id = $filter_value3;
                        $department_id = $filter_value4;
                        $emp_status = $filter_value5;

                        $excel = $this->excel;
                        if($month_filter==1){
                             $month="January";
                        }
                        else if($month_filter==2){
                             $month="February";
                        }
                        else if($month_filter==3){
                             $month="March";
                        }
                        else if($month_filter==4){
                            $month="April";
                        }
                        else if($month_filter==5){
                             $month="May";
                        }
                        else if($month_filter==6){
                             $month="June";
                        }
                        else if($month_filter==7){
                             $month="July";
                        }
                        else if($month_filter==8){
                             $month="August";
                        }
                        else if($month_filter==9){
                            $month="September";
                        }
                        else if($month_filter==10){
                             $month="October";
                        }
                        else if($month_filter==11){
                             $month="November";
                        }
                        else if($month_filter==12){
                             $month="December";
                        }
                        else{
                            $month="All";
                        }

                        if($branch_id=="all"){
                            $branch="All Branch";
                        }
                        else{
                            $getbranch=$this->RefBranch_model->get_list(
                                $branch_id,
                                'ref_branch.branch,'
                            );
                            $branch=$getbranch[0]->branch;
                        }

                        if($department_id=="all"){
                            $department="All Department";
                        }
                        else{
                            $getdepartment=$this->RefDepartment_model->get_list(
                                $department_id,
                                'ref_department.department,'
                            );
                            $department=$getdepartment[0]->department;
                        }

                        $sss_report=$this->DailyTimeRecord_model->get_sss_report($company_id,$year,$month_filter,$branch_id,$department_id,$emp_status);
                        $getcompany=$this->CompanyManagement_model->get_company_list($company_id);

                        $company=$getcompany[0];
                        $month=$month;

                        $excel->setActiveSheetIndex(0);
                        //name the worksheet
                        $excel->getActiveSheet()->setTitle("SSS REPORT");

                        $end = "";
                        if ($month == "All"){
                            $end = 'I';
                        }else{
                            $end = 'H';
                        }

                        $excel->getActiveSheet()->getStyle('A1'.':'.'A4')->getFont()->setBold(TRUE);
                        $excel->getActiveSheet()->mergeCells('A1:'.$end.'1');
                        $excel->getActiveSheet()->mergeCells('A2:'.$end.'2');
                        $excel->getActiveSheet()->mergeCells('A3:'.$end.'3');
                        $excel->getActiveSheet()->mergeCells('A4:'.$end.'4');

                        $monthdescription = "";

                        if ($month == "All"){
                            $monthdescription = "SSS Report for All Months";
                        }else{
                            $monthdescription = "SSS Report for Month of ".$month;
                        }

                        $excel->getActiveSheet()->setCellValue('A1',$monthdescription)
                                                ->setCellValue('A2','Year : '.$year)
                                                ->setCellValue('A3','Branch : '.$branch)
                                                ->setCellValue('A4','Department : '.$department);

                        $excel->getActiveSheet()->mergeCells('A5:'.$end.'5');

                        $excel->getActiveSheet()->getStyle('A6'.':'.''.$end.'6')->getFont()->setBold(TRUE);

                        if ($month == "All"){
                            $excel->getActiveSheet()->getColumnDimension('A')->setWidth('5');
                            $excel->getActiveSheet()->getColumnDimension('B')->setWidth('20');
                            $excel->getActiveSheet()->getColumnDimension('C')->setWidth('10');
                            $excel->getActiveSheet()->getColumnDimension('D')->setWidth('30');
                            $excel->getActiveSheet()->getColumnDimension('E')->setWidth('20');
                            $excel->getActiveSheet()->getColumnDimension('F')->setWidth('15');
                            $excel->getActiveSheet()->getColumnDimension('G')->setWidth('15');
                            $excel->getActiveSheet()->getColumnDimension('H')->setWidth('15');
                            $excel->getActiveSheet()->getColumnDimension('I')->setWidth('15');
                        }else{
                            $excel->getActiveSheet()->getColumnDimension('A')->setWidth('15');
                            $excel->getActiveSheet()->getColumnDimension('B')->setWidth('10');
                            $excel->getActiveSheet()->getColumnDimension('C')->setWidth('30');
                            $excel->getActiveSheet()->getColumnDimension('D')->setWidth('20');
                            $excel->getActiveSheet()->getColumnDimension('E')->setWidth('15');
                            $excel->getActiveSheet()->getColumnDimension('F')->setWidth('15');
                            $excel->getActiveSheet()->getColumnDimension('G')->setWidth('15');
                            $excel->getActiveSheet()->getColumnDimension('H')->setWidth('15');
                        }

                        $excel->getActiveSheet()
                                ->getStyle('A6')
                                ->getAlignment()
                                ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);

                        $excel->getActiveSheet()
                                ->getStyle('F6:I6')
                                ->getAlignment()
                                ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

                        if ($month == "All"){
                            $excel->getActiveSheet()->setCellValue('A6','#');
                            $excel->getActiveSheet()->setCellValue('B6','Month');
                            $excel->getActiveSheet()->setCellValue('C6','Ecode');
                            $excel->getActiveSheet()->setCellValue('D6','Name');
                            $excel->getActiveSheet()->setCellValue('E6','SSS No.');
                            $excel->getActiveSheet()->setCellValue('F6','Employee');
                            $excel->getActiveSheet()->setCellValue('G6','Employer');
                            $excel->getActiveSheet()->setCellValue('H6','EC');
                            $excel->getActiveSheet()->setCellValue('I6','Total');
                        }else{
                            $excel->getActiveSheet()->setCellValue('A6','#');
                            $excel->getActiveSheet()->setCellValue('B6','Ecode');
                            $excel->getActiveSheet()->setCellValue('C6','Name');
                            $excel->getActiveSheet()->setCellValue('D6','SSS No.');
                            $excel->getActiveSheet()->setCellValue('E6','Employee');
                            $excel->getActiveSheet()->setCellValue('F6','Employer');
                            $excel->getActiveSheet()->setCellValue('G6','EC');
                            $excel->getActiveSheet()->setCellValue('H6','Total');
                        }

                        $i = 7;
                        $total_sss=0;
                        $total_employer=0;
                        $total_ec=0;
                        $grand_total = 0;
                        $row_total = 0;
                        $count=1;             
                        
                        if(count($sss_report)!=0 || count($sss_report)!=null){
                            foreach($sss_report as $row){
                                $total_sss+=$row->employee;
                                if ($row->employee != 0){

                                $row_total = $row->employee + $row->employer + $row->employer_contribution;
                               
                                $excel->getActiveSheet()
                                        ->getStyle('A'.$i.':E'.$i)
                                        ->getAlignment()
                                        ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);  

                                $excel->getActiveSheet()
                                        ->getStyle('F'.$i.':I'.$i)
                                        ->getAlignment()
                                        ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

                                $excel->getActiveSheet()->setCellValue('A'.$i,$count);

                                if ($month == "All"){
                                    $excel->getActiveSheet()->setCellValue('B'.$i,$row->periodmonth);
                                    $excel->getActiveSheet()->setCellValue('C'.$i,$row->ecode);
                                    $excel->getActiveSheet()->setCellValue('D'.$i,$row->full_name);
                                    $excel->getActiveSheet()->setCellValue('E'.$i,$row->sss);
                                    $excel->getActiveSheet()->getStyle('F'.$i.':'.'I'.$i)->getNumberFormat()->setFormatCode('###,##0.00;(###,##0.00)');                    
                                    $excel->getActiveSheet()->setCellValue('F'.$i,number_format($row->employee,2));
                                    $excel->getActiveSheet()->setCellValue('G'.$i,number_format($row->employer,2));
                                    $excel->getActiveSheet()->setCellValue('H'.$i,number_format($row->employer_contribution,2));
                                    $excel->getActiveSheet()->setCellValue('I'.$i,number_format($row_total,2));
                                }else{
                                    $excel->getActiveSheet()->setCellValue('B'.$i,$row->ecode);
                                    $excel->getActiveSheet()->setCellValue('C'.$i,$row->full_name);
                                    $excel->getActiveSheet()->setCellValue('D'.$i,$row->sss);
                                    $excel->getActiveSheet()->getStyle('E'.$i.':'.'H'.$i)->getNumberFormat()->setFormatCode('###,##0.00;(###,##0.00)');                    
                                    $excel->getActiveSheet()->setCellValue('E'.$i,number_format($row->employee,2));
                                    $excel->getActiveSheet()->setCellValue('F'.$i,number_format($row->employer,2));
                                    $excel->getActiveSheet()->setCellValue('G'.$i,number_format($row->employer_contribution,2));
                                    $excel->getActiveSheet()->setCellValue('H'.$i,number_format($row_total,2));
                                }
                                    
                                    
                                    $total_employer+=$row->employer;
                                    $total_ec+=$row->employer_contribution;
                                    $grand_total+=$row_total;
                                    $count++;
                                    $i++;
                            }}}
                            else{ 

                                    $excel->getActiveSheet()
                                            ->getStyle('A'.$i)
                                            ->getAlignment()
                                            ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  

                                    if ($month == "All"){
                                        $excel->getActiveSheet()->mergeCells('A'.$i.':'.'I'.$i);
                                        $excel->getActiveSheet()->setCellValue('A'.$i,'No Result');
                                    }else{
                                        $excel->getActiveSheet()->mergeCells('A'.$i.':'.'H'.$i);
                                        $excel->getActiveSheet()->setCellValue('A'.$i,'No Result');
                                    }

                                    $i++;
                            }

                                $excel->getActiveSheet()
                                        ->getStyle('A'.$i.':I'.$i)
                                        ->getAlignment()
                                        ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

                                if ($month == "All"){
                                    $excel->getActiveSheet()->mergeCells('A'.$i.':'.'E'.$i);
                                    $excel->getActiveSheet()->setCellValue('A'.$i,'Total:');
                                    
                                    $excel->getActiveSheet()->getStyle('F'.$i.':'.'I'.$i)->getNumberFormat()->setFormatCode('###,##0.00;(###,##0.00)');                    

                                    $excel->getActiveSheet()->getStyle('A'.$i.':'.'I'.$i)->getFont()->setBold(TRUE);

                                    $excel->getActiveSheet()->setCellValue('F'.$i,number_format($total_sss,2));
                                    $excel->getActiveSheet()->setCellValue('G'.$i,number_format($total_employer,2));
                                    $excel->getActiveSheet()->setCellValue('H'.$i,number_format($total_ec,2));
                                    $excel->getActiveSheet()->setCellValue('I'.$i,number_format($grand_total,2));
                                }else{
                                    $excel->getActiveSheet()->mergeCells('A'.$i.':'.'D'.$i);
                                    $excel->getActiveSheet()->setCellValue('A'.$i,'Total:');
                                    
                                    $excel->getActiveSheet()->getStyle('E'.$i.':'.'H'.$i)->getNumberFormat()->setFormatCode('###,##0.00;(###,##0.00)');                    

                                    $excel->getActiveSheet()->getStyle('A'.$i.':'.'H'.$i)->getFont()->setBold(TRUE);

                                    $excel->getActiveSheet()->setCellValue('E'.$i,number_format($total_sss,2));
                                    $excel->getActiveSheet()->setCellValue('F'.$i,number_format($total_employer,2));
                                    $excel->getActiveSheet()->setCellValue('G'.$i,number_format($total_ec,2));
                                    $excel->getActiveSheet()->setCellValue('H'.$i,number_format($grand_total,2));
                                }

                        if ($month == "All"){
                            $filename = "SSS REPORT - ".$year;
                        }else{
                            $filename = "SSS REPORT - ".$month.' '.$year;
                        }

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

            case 'email-sss-list':
                        $m_user = $this->Users_model;
                        $id = $this->session->user_id;
                        $email = $m_user->get_email($id);

                        $excel = $this->excel;
                        if($filter_value2==1){
                             $month="January";
                        }
                        else if($filter_value2==2){
                             $month="February";
                        }
                        else if($filter_value2==3){
                             $month="March";
                        }
                        else if($filter_value2==4){
                            $month="April";
                        }
                        else if($filter_value2==5){
                             $month="May";
                        }
                        else if($filter_value2==6){
                             $month="June";
                        }
                        else if($filter_value2==7){
                             $month="July";
                        }
                        else if($filter_value2==8){
                             $month="August";
                        }
                        else if($filter_value2==9){
                            $month="September";
                        }
                        else if($filter_value2==10){
                             $month="October";
                        }
                        else if($filter_value2==11){
                             $month="November";
                        }
                        else if($filter_value2==12){
                             $month="December";
                        }
                        else{
                            $month="All";
                        }

                        if($filter_value=="all"){
                            $department="All Department";
                        }
                        else{
                            $getdepartment=$this->RefDepartment_model->get_list(
                            $filter_value,
                            'ref_department.department,'
                            );
                            $department=$getdepartment[0]->department;
                        }

                        $sss_report=$this->DailyTimeRecord_model->get_sss_report($filter_value,$filter_value2,$filter_value3);

                        $getcompany=$this->CompanyManagement_model->get_list(
                            null,
                            'company_management.*'
                        );

                        $company=$getcompany[0];
                        $month=$month;
                        $year = $filter_value3;
                        ob_start();
                        $excel->setActiveSheetIndex(0);
                        //name the worksheet
                        $excel->getActiveSheet()->setTitle("SSS REPORT");

                        $end = "";
                        if ($month == "All"){
                            $end = 'I';
                        }else{
                            $end = 'H';
                        }

                        $excel->getActiveSheet()->mergeCells('A1:'.$end.'1');
                        $excel->getActiveSheet()->mergeCells('A2:'.$end.'2');
                        $excel->getActiveSheet()->mergeCells('A3:'.$end.'3');
                        $excel->getActiveSheet()->mergeCells('A4:'.$end.'4');

                        $excel->getActiveSheet()->setCellValue('A1',$company->company_name)
                                                ->setCellValue('A2',$company->address)
                                                ->setCellValue('A3',$company->contact_no)
                                                ->setCellValue('A4',$company->email_address);

                        $excel->getActiveSheet()->mergeCells('A5:'.$end.'5');

                        $excel->getActiveSheet()->getStyle('A6'.':'.'A8')->getFont()->setBold(TRUE);
                        $excel->getActiveSheet()->mergeCells('A6:'.$end.'6');
                        $excel->getActiveSheet()->mergeCells('A7:'.$end.'7');
                        $excel->getActiveSheet()->mergeCells('A8:'.$end.'8');

                        $monthdescription = "";

                        if ($month == "All"){
                            $monthdescription = "SSS Report for All Months";
                        }else{
                            $monthdescription = "SSS Report for Month of ".$month;
                        }

                        $excel->getActiveSheet()->setCellValue('A6',$monthdescription)
                                                ->setCellValue('A7','Year : '.$filter_value3)
                                                ->setCellValue('A8','Department : '.$department);
                        $excel->getActiveSheet()->mergeCells('A9:'.$end.'9');

                        $excel->getActiveSheet()->getStyle('A10'.':'.''.$end.'10')->getFont()->setBold(TRUE);

                        if ($month == "All"){
                            $excel->getActiveSheet()->getColumnDimension('A')->setWidth('15');
                            $excel->getActiveSheet()->getColumnDimension('B')->setWidth('20');
                            $excel->getActiveSheet()->getColumnDimension('C')->setWidth('10');
                            $excel->getActiveSheet()->getColumnDimension('D')->setWidth('30');
                            $excel->getActiveSheet()->getColumnDimension('E')->setWidth('20');
                            $excel->getActiveSheet()->getColumnDimension('F')->setWidth('15');
                            $excel->getActiveSheet()->getColumnDimension('G')->setWidth('15');
                            $excel->getActiveSheet()->getColumnDimension('H')->setWidth('15');
                            $excel->getActiveSheet()->getColumnDimension('I')->setWidth('15');
                        }else{
                            $excel->getActiveSheet()->getColumnDimension('A')->setWidth('15');
                            $excel->getActiveSheet()->getColumnDimension('B')->setWidth('10');
                            $excel->getActiveSheet()->getColumnDimension('C')->setWidth('30');
                            $excel->getActiveSheet()->getColumnDimension('D')->setWidth('20');
                            $excel->getActiveSheet()->getColumnDimension('E')->setWidth('15');
                            $excel->getActiveSheet()->getColumnDimension('F')->setWidth('15');
                            $excel->getActiveSheet()->getColumnDimension('G')->setWidth('15');
                            $excel->getActiveSheet()->getColumnDimension('H')->setWidth('15');
                        }

                        $excel->getActiveSheet()
                                ->getStyle('A10')
                                ->getAlignment()
                                ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

                        $excel->getActiveSheet()
                                ->getStyle('F10')
                                ->getAlignment()
                                ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
                        $excel->getActiveSheet()
                                ->getStyle('G10')
                                ->getAlignment()
                                ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
                        $excel->getActiveSheet()
                                ->getStyle('H10')
                                ->getAlignment()
                                ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
                        $excel->getActiveSheet()
                                ->getStyle('I10')
                                ->getAlignment()
                                ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

                        if ($month == "All"){
                            $excel->getActiveSheet()->setCellValue('A10','#');
                            $excel->getActiveSheet()->setCellValue('B10','Month');
                            $excel->getActiveSheet()->setCellValue('C10','Ecode');
                            $excel->getActiveSheet()->setCellValue('D10','Name');
                            $excel->getActiveSheet()->setCellValue('E10','SSS No.');
                            $excel->getActiveSheet()->setCellValue('F10','Employee');
                            $excel->getActiveSheet()->setCellValue('G10','Employer');
                            $excel->getActiveSheet()->setCellValue('H10','EC');
                            $excel->getActiveSheet()->setCellValue('I10','Total');
                        }else{
                            $excel->getActiveSheet()->setCellValue('A10','#');
                            $excel->getActiveSheet()->setCellValue('B10','Ecode');
                            $excel->getActiveSheet()->setCellValue('C10','Name');
                            $excel->getActiveSheet()->setCellValue('D10','SSS No.');
                            $excel->getActiveSheet()->setCellValue('E10','Employee');
                            $excel->getActiveSheet()->setCellValue('F10','Employer');
                            $excel->getActiveSheet()->setCellValue('G10','EC');
                            $excel->getActiveSheet()->setCellValue('H10','Total');
                        }

                        $i = 11;
                        $total_sss=0;
                        $total_employer=0;
                        $total_ec=0;
                        $grand_total = 0;
                        $row_total = 0;
                        $count=1;             
                        
                        if(count($sss_report)!=0 || count($sss_report)!=null){
                            foreach($sss_report as $row){
                                $total_sss+=$row->employee;
                                if ($row->employee != 0){

                                $row_total = $row->employee + $row->employer + $row->employer_contribution;
                               
                                $excel->getActiveSheet()
                                        ->getStyle('A'.$i)
                                        ->getAlignment()
                                        ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  

                                $excel->getActiveSheet()
                                        ->getStyle('C'.$i)
                                        ->getAlignment()
                                        ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);  

                                $excel->getActiveSheet()
                                        ->getStyle('F'.$i)
                                        ->getAlignment()
                                        ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

                                $excel->getActiveSheet()
                                        ->getStyle('G'.$i)
                                        ->getAlignment()
                                        ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

                                $excel->getActiveSheet()
                                        ->getStyle('H'.$i)
                                        ->getAlignment()
                                        ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

                                $excel->getActiveSheet()
                                        ->getStyle('I'.$i)
                                        ->getAlignment()
                                        ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

                                $excel->getActiveSheet()->setCellValue('A'.$i,$count);

                                if ($month == "All"){
                                    $excel->getActiveSheet()->setCellValue('B'.$i,$row->periodmonth);
                                    $excel->getActiveSheet()->setCellValue('C'.$i,$row->ecode);
                                    $excel->getActiveSheet()->setCellValue('D'.$i,$row->full_name);
                                    $excel->getActiveSheet()->setCellValue('E'.$i,$row->sss);
                                    $excel->getActiveSheet()->getStyle('F'.$i.':'.'I'.$i)->getNumberFormat()->setFormatCode('###,##0.00;(###,##0.00)');                    
                                    $excel->getActiveSheet()->setCellValue('F'.$i,number_format($row->employee,2));
                                    $excel->getActiveSheet()->setCellValue('G'.$i,number_format($row->employer,2));
                                    $excel->getActiveSheet()->setCellValue('H'.$i,number_format($row->employer_contribution,2));
                                    $excel->getActiveSheet()->setCellValue('I'.$i,number_format($row_total,2));
                                }else{
                                    $excel->getActiveSheet()->setCellValue('B'.$i,$row->ecode);
                                    $excel->getActiveSheet()->setCellValue('C'.$i,$row->full_name);
                                    $excel->getActiveSheet()->setCellValue('D'.$i,$row->sss);
                                    $excel->getActiveSheet()->getStyle('E'.$i.':'.'H'.$i)->getNumberFormat()->setFormatCode('###,##0.00;(###,##0.00)');                    
                                    $excel->getActiveSheet()->setCellValue('E'.$i,number_format($row->employee,2));
                                    $excel->getActiveSheet()->setCellValue('F'.$i,number_format($row->employer,2));
                                    $excel->getActiveSheet()->setCellValue('G'.$i,number_format($row->employer_contribution,2));
                                    $excel->getActiveSheet()->setCellValue('H'.$i,number_format($row_total,2));
                                }
                                    
                                    
                                    $total_employer+=$row->employer;
                                    $total_ec+=$row->employer_contribution;
                                    $grand_total+=$row_total;
                                    $count++;
                                    $i++;
                            }}}
                            else{ 

                                    $excel->getActiveSheet()
                                            ->getStyle('A'.$i)
                                            ->getAlignment()
                                            ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  

                                    if ($month == "All"){
                                        $excel->getActiveSheet()->mergeCells('A'.$i.':'.'I'.$i);
                                        $excel->getActiveSheet()->setCellValue('A'.$i,'No Result');
                                    }else{
                                        $excel->getActiveSheet()->mergeCells('A'.$i.':'.'H'.$i);
                                        $excel->getActiveSheet()->setCellValue('A'.$i,'No Result');
                                    }

                                    $i++;
                            }

                                $excel->getActiveSheet()
                                        ->getStyle('A'.$i)
                                        ->getAlignment()
                                        ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

                                $excel->getActiveSheet()
                                        ->getStyle('F'.$i)
                                        ->getAlignment()
                                        ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

                                $excel->getActiveSheet()
                                        ->getStyle('G'.$i)
                                        ->getAlignment()
                                        ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

                                $excel->getActiveSheet()
                                        ->getStyle('H'.$i)
                                        ->getAlignment()
                                        ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

                                $excel->getActiveSheet()
                                        ->getStyle('I'.$i)
                                        ->getAlignment()
                                        ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

                                if ($month == "All"){
                                    $excel->getActiveSheet()->mergeCells('A'.$i.':'.'E'.$i);
                                    $excel->getActiveSheet()->setCellValue('A'.$i,'Total:');
                                    
                                    $excel->getActiveSheet()->getStyle('F'.$i.':'.'I'.$i)->getNumberFormat()->setFormatCode('###,##0.00;(###,##0.00)');                    

                                    $excel->getActiveSheet()->getStyle('A'.$i.':'.'I'.$i)->getFont()->setBold(TRUE);

                                    $excel->getActiveSheet()->setCellValue('F'.$i,number_format($total_sss,2));
                                    $excel->getActiveSheet()->setCellValue('G'.$i,number_format($total_employer,2));
                                    $excel->getActiveSheet()->setCellValue('H'.$i,number_format($total_ec,2));
                                    $excel->getActiveSheet()->setCellValue('I'.$i,number_format($grand_total,2));
                                }else{
                                    $excel->getActiveSheet()->mergeCells('A'.$i.':'.'D'.$i);
                                    $excel->getActiveSheet()->setCellValue('A'.$i,'Total:');
                                    
                                    $excel->getActiveSheet()->getStyle('E'.$i.':'.'H'.$i)->getNumberFormat()->setFormatCode('###,##0.00;(###,##0.00)');                    

                                    $excel->getActiveSheet()->getStyle('A'.$i.':'.'H'.$i)->getFont()->setBold(TRUE);

                                    $excel->getActiveSheet()->setCellValue('E'.$i,number_format($total_sss,2));
                                    $excel->getActiveSheet()->setCellValue('F'.$i,number_format($total_employer,2));
                                    $excel->getActiveSheet()->setCellValue('G'.$i,number_format($total_ec,2));
                                    $excel->getActiveSheet()->setCellValue('H'.$i,number_format($grand_total,2));
                                }



                        if ($month == "All"){
                            $filename = "SSS REPORT - ".$year;
                        }else{
                            $filename = "SSS REPORT - ".$month.' '.$year;
                        }

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
                        $data = ob_get_clean();

                            $file_name='SSS Report '.date('Y-m-d h:i:A', now());
                            $excelFilePath = $file_name.".xlsx"; //generate filename base on id
                            //download it.
                            // Set SMTP Configuration
                            $emailConfig = array(
                                'protocol' => 'smtp', 
                                'smtp_host' => 'ssl://smtp.googlemail.com', 
                                'smtp_port' => 465, 
                                'smtp_user' => $getcompany[0]->email_address, 
                                'smtp_pass' => $getcompany[0]->email_password, 
                                'mailtype' => 'html', 
                                'charset' => 'iso-8859-1'
                            );

                            // Set your email information
                            
                            $from = array(
                                'email' => $getcompany[0]->email_address,
                                'name' => $getcompany[0]->company_name
                            );

                            $to = array($email[0]->user_email);
                            $subject = 'SSS Report';
                          //  $message = 'Type your gmail message here';
                            $message = '<p>To: ' .$email[0]->user_email. '</p></ br>' .$filename.'</ br><p>Sent By: '. '<b>'.$getcompany[0]->company_name.'</b>'. '</p></ br>' .date('Y-m-d h:i:A', now());

                            // Load CodeIgniter Email library
                            $this->load->library('email', $emailConfig);
                            // Sometimes you have to set the new line character for better result
                            $this->email->set_newline("\r\n");
                            // Set email preferences
                            $this->email->from($from['email'], $from['name']);
                            $this->email->to($to);
                            $this->email->subject($subject);
                            $this->email->message($message);
                            $this->email->attach($data, 'attachment', $excelFilePath , 'application/ms-excel');
                            $this->email->set_mailtype("html");
                            // Ready to send email and check whether the email was successfully sent
                            if (!$this->email->send()) {
                                // Raise error message
                            $response['title']='Try Again!';
                            $response['stat']='error';
                            $response['msg']='Please check the Email Address of your Account or your Internet Connection.';

                            echo json_encode($response);
                            } else {
                                // Show success notification or other things here
                            $response['title']='Success!';
                            $response['stat']='success';
                            $response['msg']='Email Sent successfully.';

                            echo json_encode($response);
                            }

                        break;

                case 'philhealth-list': //

                        $company_id = $this->session->company_id;
                        $year = $filter_value;
                        $month_filter = $filter_value2;
                        $branch_id = $filter_value3;
                        $department_id = $filter_value4;
                        $emp_status = $filter_value5;

                        if($month_filter==1){
                             $month="January";
                        }
                        else if($month_filter==2){
                             $month="February";
                        }
                        else if($month_filter==3){
                             $month="March";
                        }
                        else if($month_filter==4){
                            $month="April";
                        }
                        else if($month_filter==5){
                             $month="May";
                        }
                        else if($month_filter==6){
                             $month="June";
                        }
                        else if($month_filter==7){
                             $month="July";
                        }
                        else if($month_filter==8){
                             $month="August";
                        }
                        else if($month_filter==9){
                            $month="September";
                        }
                        else if($month_filter==10){
                             $month="October";
                        }
                        else if($month_filter==11){
                             $month="November";
                        }
                        else if($month_filter==12){
                             $month="December";
                        }
                        else{
                            $month="All";
                        }

                        if($branch_id=="all"){
                            $data['branch']="All";
                        }
                        else{
                            $getbranch=$this->RefBranch_model->get_list(
                            $branch_id,
                            'ref_branch.branch,'
                            );
                            $data['branch']=$getbranch[0]->branch;
                        }

                        if($department_id=="all"){
                            $data['department']="All";
                        }
                        else{
                            $getdepartment=$this->RefDepartment_model->get_list(
                            $department_id,
                            'ref_department.department,'
                            );
                            $data['department']=$getdepartment[0]->department;
                        }

                        $data['phil_health_report']=$this->DailyTimeRecord_model->get_philhealth_report($company_id,$year,$month_filter,$branch_id,$department_id,$emp_status);
                        $getcompany=$this->CompanyManagement_model->get_company_list($company_id);

                        $data['company']=$getcompany[0];
                        $data['month']=$month;
                        $data['type']=$type;
                        $data['year']=$year;

                        echo $this->load->view('template/philhealth_list_html',$data,TRUE);

                break;
                
                case 'export-philhealth-list':

                        $company_id = $this->session->company_id;
                        $year = $filter_value;
                        $month_filter = $filter_value2;
                        $branch_id = $filter_value3;
                        $department_id = $filter_value4;
                        $emp_status = $filter_value5;

                        $excel = $this->excel;

                        if($month_filter==1){
                             $month="January";
                        }
                        else if($month_filter==2){
                             $month="February";
                        }
                        else if($month_filter==3){
                             $month="March";
                        }
                        else if($month_filter==4){
                            $month="April";
                        }
                        else if($month_filter==5){
                             $month="May";
                        }
                        else if($month_filter==6){
                             $month="June";
                        }
                        else if($month_filter==7){
                             $month="July";
                        }
                        else if($month_filter==8){
                             $month="August";
                        }
                        else if($month_filter==9){
                            $month="September";
                        }
                        else if($month_filter==10){
                             $month="October";
                        }
                        else if($month_filter==11){
                             $month="November";
                        }
                        else if($month_filter==12){
                             $month="December";
                        }
                        else{
                            $month="All";
                        }

                        if($branch_id=="all"){
                            $branch="All";
                        }
                        else{
                            $getbranch=$this->RefBranch_model->get_list(
                            $branch_id,
                            'ref_branch.branch,'
                            );
                            $branch=$getbranch[0]->branch;
                        }

                        if($department_id=="all"){
                            $department="All";
                        }
                        else{
                            $getdepartment=$this->RefDepartment_model->get_list(
                            $department_id,
                            'ref_department.department,'
                            );
                            $department=$getdepartment[0]->department;
                        }

                        $phil_health_report=$this->DailyTimeRecord_model->get_philhealth_report($company_id,$year,$month_filter,$branch_id,$department_id,$emp_status);
                        $getcompany=$this->CompanyManagement_model->get_company_list($company_id);

                        $company=$getcompany[0];

                        $excel->setActiveSheetIndex(0);

                        //name the worksheet
                        $excel->getActiveSheet()->setTitle("Philhealth REPORT");

                        $end = "";
                        if ($month == "All"){$end="H";}else{$end="F";};

                        $excel->getActiveSheet()->getStyle('A1:A4')->getFont()->setBold(TRUE);
                        $excel->getActiveSheet()->mergeCells('A1:'.$end.'1');
                        $excel->getActiveSheet()->mergeCells('A2:'.$end.'2');
                        $excel->getActiveSheet()->mergeCells('A3:'.$end.'3');
                        $excel->getActiveSheet()->mergeCells('A4:'.$end.'4');
                        $excel->getActiveSheet()->mergeCells('A5:'.$end.'5');

                        $monthdescription = "";

                        if ($month == "All"){
                            $monthdescription = "Philhealth Report for All Months";
                        }
                        else{
                            $monthdescription = "Philhealth Report for Month of ".$month;
                        }

                        $excel->getActiveSheet()->setCellValue('A1',$monthdescription)
                                                ->setCellValue('A2','Year : '.$year)
                                                ->setCellValue('A3','Branch : '.$branch)
                                                ->setCellValue('A4','Department : '.$department);

                        $excel->getActiveSheet()->getStyle('A6'.':'.$end.'6')->getFont()->setBold(TRUE);

                        if ($month == "All"){
                            $excel->getActiveSheet()->getColumnDimension('A')->setWidth('5');
                            $excel->getActiveSheet()->getColumnDimension('B')->setWidth('15');
                            $excel->getActiveSheet()->getColumnDimension('C')->setWidth('15');
                            $excel->getActiveSheet()->getColumnDimension('D')->setWidth('30');
                            $excel->getActiveSheet()->getColumnDimension('E')->setWidth('15');
                            $excel->getActiveSheet()->getColumnDimension('F')->setWidth('15');
                            $excel->getActiveSheet()->getColumnDimension('G')->setWidth('15');
                            $excel->getActiveSheet()->getColumnDimension('H')->setWidth('15');
                        }else{     
                            $excel->getActiveSheet()->getColumnDimension('A')->setWidth('5');
                            $excel->getActiveSheet()->getColumnDimension('B')->setWidth('15');
                            $excel->getActiveSheet()->getColumnDimension('C')->setWidth('30');
                            $excel->getActiveSheet()->getColumnDimension('D')->setWidth('15');
                            $excel->getActiveSheet()->getColumnDimension('E')->setWidth('15');
                            $excel->getActiveSheet()->getColumnDimension('F')->setWidth('15');
                            $excel->getActiveSheet()->getColumnDimension('G')->setWidth('15');                            
                        }

                        $excel->getActiveSheet()
                                ->getStyle('A6')
                                ->getAlignment()
                                ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);

                        if ($month == "All"){

                            $excel->getActiveSheet()
                                    ->getStyle('C6')
                                    ->getAlignment()
                                    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);

                            $excel->getActiveSheet()
                                    ->getStyle('F6:H6')
                                    ->getAlignment()
                                    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

                        }else{

                            $excel->getActiveSheet()
                                    ->getStyle('B6')
                                    ->getAlignment()
                                    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);

                            $excel->getActiveSheet()
                                    ->getStyle('E6:G6')
                                    ->getAlignment()
                                    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

                        }

                        if ($month =="All"){
                            $excel->getActiveSheet()->setCellValue('A6','#');
                            $excel->getActiveSheet()->setCellValue('B6','Month');
                            $excel->getActiveSheet()->setCellValue('C6','Ecode');
                            $excel->getActiveSheet()->setCellValue('D6','Name');
                            $excel->getActiveSheet()->setCellValue('E6','PhilHealth No.');
                            $excel->getActiveSheet()->setCellValue('F6','Employee'); 
                            $excel->getActiveSheet()->setCellValue('G6','Employer');
                            $excel->getActiveSheet()->setCellValue('H6','Total');
                        }else{
                            $excel->getActiveSheet()->setCellValue('A6','#');
                            $excel->getActiveSheet()->setCellValue('B6','Ecode');
                            $excel->getActiveSheet()->setCellValue('C6','Name');
                            $excel->getActiveSheet()->setCellValue('D6','PhilHealth No.');
                            $excel->getActiveSheet()->setCellValue('E6','Employee');
                            $excel->getActiveSheet()->setCellValue('F6','Employer'); 
                            $excel->getActiveSheet()->setCellValue('G6','Total');
                        }    

                        $i = 7;

                        $total_philhealth = 0;
                        $total_employee = 0;
                        $total_employer = 0;
                        $count=1;

                        if(count($phil_health_report)!=0 || count($phil_health_report)!=null){
                            foreach($phil_health_report as $row){
                                $total_employee += $row->employee;
                                $total_employer += $row->employer;
                                $total_philhealth += $row->employee + $row->employer;

                                if ($row->employee != 0){

                                    $excel->getActiveSheet()
                                            ->getStyle('A'.$i)
                                            ->getAlignment()
                                            ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);


                                    if ($month == "All"){
                                        $excel->getActiveSheet()
                                                ->getStyle('C'.$i)
                                                ->getAlignment()
                                                ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);

                                    }else{
                                        $excel->getActiveSheet()
                                                ->getStyle('B'.$i)
                                                ->getAlignment()
                                                ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
                                    }


                                    $excel->getActiveSheet()
                                            ->getStyle($end.$i)
                                            ->getAlignment()
                                            ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

                                    if ($month == "All"){
                                        $excel->getActiveSheet()->setCellValue('A'.$i,$count);
                                        $excel->getActiveSheet()->setCellValue('B'.$i,$row->periodmonth);
                                        $excel->getActiveSheet()->setCellValue('C'.$i,$row->ecode);
                                        $excel->getActiveSheet()->setCellValue('D'.$i,$row->full_name);
                                        $excel->getActiveSheet()->setCellValue('E'.$i,$row->phil_health);
                                        $excel->getActiveSheet()->getStyle('F'.$i.':'.'H'.$i)->getNumberFormat()->setFormatCode('###,##0.00;(###,##0.00)');  
                                        $excel->getActiveSheet()->setCellValue('F'.$i,number_format($row->employee,2));
                                        $excel->getActiveSheet()->setCellValue('G'.$i,number_format($row->employer,2));
                                        $excel->getActiveSheet()->setCellValue('H'.$i,number_format($row->total,2));
                                    }else{
                                        $excel->getActiveSheet()->setCellValue('A'.$i,$count);
                                        $excel->getActiveSheet()->setCellValue('B'.$i,$row->ecode);
                                        $excel->getActiveSheet()->setCellValue('C'.$i,$row->full_name);
                                        $excel->getActiveSheet()->setCellValue('D'.$i,$row->phil_health);
                                        $excel->getActiveSheet()->getStyle('E'.$i.':'.'G'.$i)->getNumberFormat()->setFormatCode('###,##0.00;(###,##0.00)');  
                                        $excel->getActiveSheet()->setCellValue('E'.$i,number_format($row->employee,2));
                                        $excel->getActiveSheet()->setCellValue('F'.$i,number_format($row->employer,2));
                                        $excel->getActiveSheet()->setCellValue('G'.$i,number_format($row->total,2));
                                    }

                            $count++;
                            $i++;
                        } } }
                        else{
 
                            $excel->getActiveSheet()
                                    ->getStyle('A'.$i)
                                    ->getAlignment()
                                    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                            
                            $excel->getActiveSheet()->mergeCells('A'.$i.':'.$end.$i);
                            $excel->getActiveSheet()->setCellValue('A'.$i,'No result');
                            $i++;
                        }
 
                            $excel->getActiveSheet()
                                    ->getStyle('A'.$i)
                                    ->getAlignment()
                                    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);


                        if ($month == "All"){
                            $excel->getActiveSheet()->mergeCells('A'.$i.':'.'E'.$i);
                            $excel->getActiveSheet()->setCellValue('A'.$i,'Total:');
                            $excel->getActiveSheet()->getStyle('F'.$i.':'.'H'.$i)->getNumberFormat()->setFormatCode('###,##0.00;(###,##0.00)');  
                            $excel->getActiveSheet()->getStyle('A'.$i.':'.'H'.$i)->getFont()->setBold(TRUE);
                            $excel->getActiveSheet()->setCellValue('F'.$i,number_format($total_employee,2));
                            $excel->getActiveSheet()->setCellValue('G'.$i,number_format($total_employer,2));
                            $excel->getActiveSheet()->setCellValue('H'.$i,number_format($total_philhealth,2));

                            $excel->getActiveSheet()
                                    ->getStyle('F'.$i.':'.'H'.$i)
                                    ->getAlignment()
                                    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

                        }else{
                            $excel->getActiveSheet()->mergeCells('A'.$i.':'.'D'.$i);
                            $excel->getActiveSheet()->setCellValue('A'.$i,'Total:');
                            $excel->getActiveSheet()->getStyle('E'.$i.':'.'G'.$i)->getNumberFormat()->setFormatCode('###,##0.00;(###,##0.00)');  

                            $excel->getActiveSheet()->getStyle('A'.$i.':'.'G'.$i)->getFont()->setBold(TRUE);

                            $excel->getActiveSheet()->setCellValue('E'.$i,number_format($total_philhealth,2));
                            $excel->getActiveSheet()->setCellValue('F'.$i,number_format($total_employer,2));
                            $excel->getActiveSheet()->setCellValue('G'.$i,number_format($total_philhealth,2));

                            $excel->getActiveSheet()
                                    ->getStyle('E'.$i.':'.'G'.$i)
                                    ->getAlignment()
                                    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);                         
                        }

                        if ($month == "All"){
                            $filename = "Philhealth Report - ".$year;
                        }else{
                            $filename = "Philhealth Report - ".$month.' '.$year;
                        }

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


                case 'email-philhealth-list': //
                        $excel = $this->excel;
                        $m_user = $this->Users_model;
                        $id = $this->session->user_id;

                        $email = $m_user->get_email($id);

                        if($filter_value2==1){
                             $month="January";
                        }
                        else if($filter_value2==2){
                             $month="February";
                        }
                        else if($filter_value2==3){
                             $month="March";
                        }
                        else if($filter_value2==4){
                            $month="April";
                        }
                        else if($filter_value2==5){
                             $month="May";
                        }
                        else if($filter_value2==6){
                             $month="June";
                        }
                        else if($filter_value2==7){
                             $month="July";
                        }
                        else if($filter_value2==8){
                             $month="August";
                        }
                        else if($filter_value2==9){
                            $month="September";
                        }
                        else if($filter_value2==10){
                             $month="October";
                        }
                        else if($filter_value2==11){
                             $month="November";
                        }
                        else if($filter_value2==12){
                             $month="December";
                        }
                        else{
                            $month="All";
                        }

                        if($filter_value=="all"){
                            $branch="All Branch";
                        }
                        else{
                        $getbranch=$this->RefBranch_model->get_list(
                        $filter_value,
                        'ref_branch.branch,'
                        );
                        $branch=$getbranch[0]->branch;
                        }

                        if($filter_value=="all" AND $filter_value2=="all"){
                            $filter = 'emp_rates_duties.active_rates_duties=1 AND EXTRACT(YEAR FROM refpayperiod.pay_period_end) = '.$filter_value3;
                        }
                        if($filter_value!="all" AND $filter_value2=="all"){
                            $filter = 'ref_branch.ref_branch_id = '.$filter_value.' AND emp_rates_duties.active_rates_duties=1 AND EXTRACT(YEAR FROM refpayperiod.pay_period_end) = '.$filter_value3;
                        }
                        if($filter_value=="all" AND $filter_value2!="all"){
                            $filter = 'refpayperiod.month_id = '.$filter_value2.' AND emp_rates_duties.active_rates_duties=1 AND EXTRACT(YEAR FROM refpayperiod.pay_period_end) = '.$filter_value3;
                        }
                        if($filter_value!="all" AND $filter_value2!="all"){
                            $filter = 'refpayperiod.month_id = '.$filter_value2.' AND ref_branch.ref_branch_id ='.$filter_value.' AND emp_rates_duties.active_rates_duties=1 AND EXTRACT(YEAR FROM refpayperiod.pay_period_end) = '.$filter_value3;
                        }

                        $phil_health_report=$this->DailyTimeRecord_model->get_philhealth_report($filter);

                        $getcompany=$this->CompanyManagement_model->get_list(
                        null,
                        'company_management.*'
                        );

                        $company=$getcompany[0];
                        $month=$month;
                        $year = $filter_value3;

                        ob_start();

                        $excel->setActiveSheetIndex(0);

                        //name the worksheet
                        $excel->getActiveSheet()->setTitle("Philhealth REPORT");

                        $end = "";
                        if ($month == "All"){$end="F";}else{$end="E";};

                        $excel->getActiveSheet()->mergeCells('A1:'.$end.'1');
                        $excel->getActiveSheet()->mergeCells('A2:'.$end.'2');
                        $excel->getActiveSheet()->mergeCells('A3:'.$end.'3');
                        $excel->getActiveSheet()->mergeCells('A4:'.$end.'4');

                        $excel->getActiveSheet()->setCellValue('A1',$company->company_name)
                                                ->setCellValue('A2',$company->address)
                                                ->setCellValue('A3',$company->contact_no)
                                                ->setCellValue('A4',$company->email_address);

                        $excel->getActiveSheet()->mergeCells('A5:'.$end.'5');

                        $excel->getActiveSheet()->getStyle('A6'.':'.'A8')->getFont()->setBold(TRUE);
                        $excel->getActiveSheet()->mergeCells('A6:'.$end.'6');
                        $excel->getActiveSheet()->mergeCells('A7:'.$end.'7');
                        $excel->getActiveSheet()->mergeCells('A8:'.$end.'8');

                        $monthdescription = "";

                        if ($month == "All"){
                            $monthdescription = "Philhealth Report for All Months";
                        }
                        else{
                            $monthdescription = "Philhealth Report for Month of ".$month;
                        }

                        $excel->getActiveSheet()->setCellValue('A6',$monthdescription)
                                                ->setCellValue('A7','Year : '.$year)
                                                ->setCellValue('A8','Branch : '.$branch);
                        $excel->getActiveSheet()->mergeCells('A9:'.$end.'9');

                        $excel->getActiveSheet()->getStyle('A10'.':'.$end.'10')->getFont()->setBold(TRUE);

                        if ($month == "All"){
                            $excel->getActiveSheet()->getColumnDimension('A')->setWidth('15');
                            $excel->getActiveSheet()->getColumnDimension('B')->setWidth('20');
                            $excel->getActiveSheet()->getColumnDimension('C')->setWidth('20');
                            $excel->getActiveSheet()->getColumnDimension('D')->setWidth('30');
                            $excel->getActiveSheet()->getColumnDimension('E')->setWidth('25');
                            $excel->getActiveSheet()->getColumnDimension('F')->setWidth('25');
                        }else{     
                            $excel->getActiveSheet()->getColumnDimension('A')->setWidth('15');
                            $excel->getActiveSheet()->getColumnDimension('B')->setWidth('20');
                            $excel->getActiveSheet()->getColumnDimension('C')->setWidth('30');
                            $excel->getActiveSheet()->getColumnDimension('D')->setWidth('25');
                            $excel->getActiveSheet()->getColumnDimension('E')->setWidth('25');
                        }

                        $excel->getActiveSheet()
                                ->getStyle('A10')
                                ->getAlignment()
                                ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

                        if ($month == "All"){
                            $excel->getActiveSheet()
                                    ->getStyle('C10')
                                    ->getAlignment()
                                    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                        }else{
                            $excel->getActiveSheet()
                                    ->getStyle('B10')
                                    ->getAlignment()
                                    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                        }

                        $excel->getActiveSheet()
                                ->getStyle($end.'10')
                                ->getAlignment()
                                ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

                        if ($month =="All"){
                            $excel->getActiveSheet()->setCellValue('A10','#');
                            $excel->getActiveSheet()->setCellValue('B10','Month');
                            $excel->getActiveSheet()->setCellValue('C10','Ecode');
                            $excel->getActiveSheet()->setCellValue('D10','Name');
                            $excel->getActiveSheet()->setCellValue('E10','PhilHealth No.');
                            $excel->getActiveSheet()->setCellValue('F10','PhilHealth Contribution'); 
                        }else{
                            $excel->getActiveSheet()->setCellValue('A10','#');
                            $excel->getActiveSheet()->setCellValue('B10','Ecode');
                            $excel->getActiveSheet()->setCellValue('C10','Name');
                            $excel->getActiveSheet()->setCellValue('D10','PhilHealth No.');
                            $excel->getActiveSheet()->setCellValue('E10','PhilHealth Contribution'); 
                        }    

                        $i = 11;

                        $total_philhealth=0;
                        $count=1;
                        if(count($phil_health_report)!=0 || count($phil_health_report)!=null){
                            foreach($phil_health_report as $row){
                                $total_philhealth+=$row->employee;
                                if ($row->employee != 0){

                                    $excel->getActiveSheet()
                                            ->getStyle('A'.$i)
                                            ->getAlignment()
                                            ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);


                                    if ($month == "All"){
                                        $excel->getActiveSheet()
                                                ->getStyle('C'.$i)
                                                ->getAlignment()
                                                ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

                                    }else{
                                        $excel->getActiveSheet()
                                                ->getStyle('B'.$i)
                                                ->getAlignment()
                                                ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                                    }


                                    $excel->getActiveSheet()
                                            ->getStyle($end.$i)
                                            ->getAlignment()
                                            ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

                                    if ($month == "All"){
                                        $excel->getActiveSheet()->setCellValue('A'.$i,$count);
                                        $excel->getActiveSheet()->setCellValue('B'.$i,$row->periodmonth);
                                        $excel->getActiveSheet()->setCellValue('C'.$i,$row->ecode);
                                        $excel->getActiveSheet()->setCellValue('D'.$i,$row->full_name);
                                        $excel->getActiveSheet()->setCellValue('E'.$i,$row->phil_health);
                                        $excel->getActiveSheet()->getStyle('F'.$i)->getNumberFormat()->setFormatCode('###,##0.00;(###,##0.00)');
                                        $excel->getActiveSheet()->setCellValue('F'.$i,number_format($row->employee,2));
                                    }else{
                                        $excel->getActiveSheet()->setCellValue('A'.$i,$count);
                                        $excel->getActiveSheet()->setCellValue('B'.$i,$row->ecode);
                                        $excel->getActiveSheet()->setCellValue('C'.$i,$row->full_name);
                                        $excel->getActiveSheet()->setCellValue('D'.$i,$row->phil_health);
                                        $excel->getActiveSheet()->getStyle('E'.$i)->getNumberFormat()->setFormatCode('###,##0.00;(###,##0.00)');
                                        $excel->getActiveSheet()->setCellValue('E'.$i,number_format($row->employee,2));
                                    }


                            $count++;
                            $i++;
                        } } }
                        else{
 
                            $excel->getActiveSheet()
                                    ->getStyle('A'.$i)
                                    ->getAlignment()
                                    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                            
                            $excel->getActiveSheet()->mergeCells('A'.$i.':'.$end.$i);
                            $excel->getActiveSheet()->setCellValue('A'.$i,'No result');
                            $i++;
                        }
 
                            $excel->getActiveSheet()
                                    ->getStyle('A'.$i)
                                    ->getAlignment()
                                    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

                        if ($month == "All"){
                            $excel->getActiveSheet()->mergeCells('A'.$i.':'.'E'.$i);
                            $excel->getActiveSheet()->setCellValue('A'.$i,'Total:');
                            $excel->getActiveSheet()->getStyle('F'.$i)->getNumberFormat()->setFormatCode('###,##0.00;(###,##0.00)');

                            $excel->getActiveSheet()->getStyle('A'.$i.':'.'F'.$i)->getFont()->setBold(TRUE);

                            $excel->getActiveSheet()->setCellValue('F'.$i,number_format($total_philhealth,2));
                        }else{
                            $excel->getActiveSheet()->mergeCells('A'.$i.':'.'D'.$i);
                            $excel->getActiveSheet()->setCellValue('A'.$i,'Total:');
                            $excel->getActiveSheet()->getStyle('E'.$i)->getNumberFormat()->setFormatCode('###,##0.00;(###,##0.00)');

                            $excel->getActiveSheet()->getStyle('A'.$i.':'.'E'.$i)->getFont()->setBold(TRUE);

                            $excel->getActiveSheet()->setCellValue('E'.$i,number_format($total_philhealth,2));
                        }

                        if ($month == "All"){
                            $filename = "Philhealth Report - ".$year;
                        }else{
                            $filename = "Philhealth Report - ".$month.' '.$year;
                        }

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
                        $data = ob_get_clean();

                            $file_name='Philhealth Report '.date('Y-m-d h:i:A', now());
                            $excelFilePath = $file_name.".xlsx"; //generate filename base on id
                            //download it.
                            // Set SMTP Configuration
                            $emailConfig = array(
                                'protocol' => 'smtp', 
                                'smtp_host' => 'ssl://smtp.googlemail.com', 
                                'smtp_port' => 465, 
                                'smtp_user' => $getcompany[0]->email_address, 
                                'smtp_pass' => $getcompany[0]->email_password, 
                                'mailtype' => 'html', 
                                'charset' => 'iso-8859-1'
                            );

                            // Set your email information
                            
                            $from = array(
                                'email' => $getcompany[0]->email_address,
                                'name' => $getcompany[0]->company_name
                            );

                            $to = array($email[0]->user_email);
                            $subject = 'Philhealth Report';
                          //  $message = 'Type your gmail message here';
                            $message = '<p>To: ' .$email[0]->user_email. '</p></ br>' .$filename.'</ br><p>Sent By: '. '<b>'.$getcompany[0]->company_name.'</b>'. '</p></ br>' .date('Y-m-d h:i:A', now());

                            // Load CodeIgniter Email library
                            $this->load->library('email', $emailConfig);
                            // Sometimes you have to set the new line character for better result
                            $this->email->set_newline("\r\n");
                            // Set email preferences
                            $this->email->from($from['email'], $from['name']);
                            $this->email->to($to);
                            $this->email->subject($subject);
                            $this->email->message($message);
                            $this->email->attach($data, 'attachment', $excelFilePath , 'application/ms-excel');
                            $this->email->set_mailtype("html");
                            // Ready to send email and check whether the email was successfully sent
                            if (!$this->email->send()) {
                                // Raise error message
                            $response['title']='Try Again!';
                            $response['stat']='error';
                            $response['msg']='Please check the Email Address of your Account or your Internet Connection.';

                            echo json_encode($response);
                            } else {
                                // Show success notification or other things here
                            $response['title']='Success!';
                            $response['stat']='success';
                            $response['msg']='Email Sent successfully.';

                            echo json_encode($response);
                            }

                break;

                case 'pagibig-list': 

                        $company_id = $this->session->company_id;
                        $year = $filter_value;
                        $month_filter = $filter_value2;
                        $branch_id = $filter_value3;
                        $department_id = $filter_value4;
                        $emp_status = $filter_value5;

                        if($month_filter==1){
                             $month="January";
                        }
                        else if($month_filter==2){
                             $month="February";
                        }
                        else if($month_filter==3){
                             $month="March";
                        }
                        else if($month_filter==4){
                            $month="April";
                        }
                        else if($month_filter==5){
                             $month="May";
                        }
                        else if($month_filter==6){
                             $month="June";
                        }
                        else if($month_filter==7){
                             $month="July";
                        }
                        else if($month_filter==8){
                             $month="August";
                        }
                        else if($month_filter==9){
                            $month="September";
                        }
                        else if($month_filter==10){
                             $month="October";
                        }
                        else if($month_filter==11){
                             $month="November";
                        }
                        else if($month_filter==12){
                             $month="December";
                        }
                        else{
                            $month="All";
                        }

                        if($branch_id=="all"){
                            $data['branch']="All";
                        }
                        else{
                            $getbranch=$this->RefBranch_model->get_list(
                            $branch_id,
                            'ref_branch.branch,'
                            );
                            $data['branch']=$getbranch[0]->branch;
                        }

                        if($department_id=="all"){
                            $data['department']="All";
                        }
                        else{
                            $getdepartment=$this->RefDepartment_model->get_list(
                            $department_id,
                            'ref_department.department,'
                            );
                            $data['department']=$getdepartment[0]->department;
                        }


                        $data['pagibig_list']=$this->DailyTimeRecord_model->get_pagibig_report($company_id,$year,$month_filter,$branch_id,$department_id,$emp_status);
                        $getcompany=$this->CompanyManagement_model->get_company_list($company_id);

                        $data['company']=$getcompany[0];
                        $data['month']=$month;
                        $data['year']=$year;
                        $data['type']=$type;

                        echo $this->load->view('template/pagibig_list_html',$data,TRUE);
            break;

            case 'export-pagibig-list': 

                        $company_id = $this->session->company_id;
                        $year = $filter_value;
                        $month_filter = $filter_value2;
                        $branch_id = $filter_value3;
                        $department_id = $filter_value4;
                        $emp_status = $filter_value5;

                        $excel = $this->excel;

                        if($month_filter==1){
                             $month="January";
                        }
                        else if($month_filter==2){
                             $month="February";
                        }
                        else if($month_filter==3){
                             $month="March";
                        }
                        else if($month_filter==4){
                            $month="April";
                        }
                        else if($month_filter==5){
                             $month="May";
                        }
                        else if($month_filter==6){
                             $month="June";
                        }
                        else if($month_filter==7){
                             $month="July";
                        }
                        else if($month_filter==8){
                             $month="August";
                        }
                        else if($month_filter==9){
                            $month="September";
                        }
                        else if($month_filter==10){
                             $month="October";
                        }
                        else if($month_filter==11){
                             $month="November";
                        }
                        else if($month_filter==12){
                             $month="December";
                        }
                        else{
                            $month="All";
                        }

                        if($branch_id=="all"){
                            $branch="All";
                        }
                        else{
                            $getbranch=$this->RefBranch_model->get_list(
                                $branch_id,
                                'ref_branch.branch,'
                            );
                            $branch=$getbranch[0]->branch;
                        }

                        if($department_id=="all"){
                            $department="All";
                        }
                        else{
                            $getdepartment=$this->RefDepartment_model->get_list(
                                $department_id,
                                'ref_department.department,'
                            );
                            $department=$getdepartment[0]->department;
                        }

                        $pagibig_list=$this->DailyTimeRecord_model->get_pagibig_report($company_id,$year,$month_filter,$branch_id,$department_id,$emp_status);
                        $getcompany=$this->CompanyManagement_model->get_company_list($company_id);

                        $company=$getcompany[0];

                        //show only inside grid with menu button
                        $excel->setActiveSheetIndex(0);

                        $end ="";
                        if ($month == "All"){$end="F";}else{$end="E";}
                        //name the worksheet
                        $excel->getActiveSheet()->setTitle("Pag-Ibig REPORT");
                        $excel->getActiveSheet()->mergeCells('A1:'.$end.'1');
                        $excel->getActiveSheet()->mergeCells('A2:'.$end.'2');
                        $excel->getActiveSheet()->mergeCells('A3:'.$end.'3');
                        $excel->getActiveSheet()->mergeCells('A4:'.$end.'4');
                        $excel->getActiveSheet()->mergeCells('A5:'.$end.'5');

                        $excel->getActiveSheet()->getStyle('A1'.':'.'A4')->getFont()->setBold(TRUE);
                        $excel->getActiveSheet()->getStyle('A6'.':'.$end.'6')->getFont()->setBold(TRUE);                        

                        $monthdescription = "";

                        if ($month == "All"){
                            $monthdescription = "Pag-Ibig Report for All Months";
                        }else{
                            $monthdescription = "Pag-Ibig Report for Month of ".$month;
                        }

                        $excel->getActiveSheet()->setCellValue('A1',$monthdescription)
                                                ->setCellValue('A2','Year : '.$year)
                                                ->setCellValue('A3','Branch : '.$branch)
                                                ->setCellValue('A4','Department : '.$department);

                        if ($month == "All"){
                            $excel->getActiveSheet()->getColumnDimension('A')->setWidth('5');
                            $excel->getActiveSheet()->getColumnDimension('B')->setWidth('15');
                            $excel->getActiveSheet()->getColumnDimension('C')->setWidth('15');
                            $excel->getActiveSheet()->getColumnDimension('D')->setWidth('30');
                            $excel->getActiveSheet()->getColumnDimension('E')->setWidth('20');
                            $excel->getActiveSheet()->getColumnDimension('F')->setWidth('13');
                        }else{
                            $excel->getActiveSheet()->getColumnDimension('A')->setWidth('5');
                            $excel->getActiveSheet()->getColumnDimension('B')->setWidth('15');
                            $excel->getActiveSheet()->getColumnDimension('C')->setWidth('30');
                            $excel->getActiveSheet()->getColumnDimension('D')->setWidth('20');
                            $excel->getActiveSheet()->getColumnDimension('E')->setWidth('13');
                        }

                        $excel->getActiveSheet()
                                ->getStyle('A6')
                                ->getAlignment()
                                ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);

                        if ($month == "All"){
                            $excel->getActiveSheet()
                                    ->getStyle('C6')
                                    ->getAlignment()
                                    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
                        }else{
                            $excel->getActiveSheet()
                                    ->getStyle('B6')
                                    ->getAlignment()
                                    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
                        }

                        $excel->getActiveSheet()
                                ->getStyle($end.'6')
                                ->getAlignment()
                                ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

                        if ($month == "All"){
                            $excel->getActiveSheet()->setCellValue('A6','#');
                            $excel->getActiveSheet()->setCellValue('B6','Month');
                            $excel->getActiveSheet()->setCellValue('C6','Ecode');
                            $excel->getActiveSheet()->setCellValue('D6','Name');
                            $excel->getActiveSheet()->setCellValue('E6','Pag-Ibig No.');
                            $excel->getActiveSheet()->setCellValue('F6','Contribution'); 
                        }else{
                            $excel->getActiveSheet()->setCellValue('A6','#');
                            $excel->getActiveSheet()->setCellValue('B6','Ecode');
                            $excel->getActiveSheet()->setCellValue('C6','Name');
                            $excel->getActiveSheet()->setCellValue('D6','Pag-Ibig No.');
                            $excel->getActiveSheet()->setCellValue('E6','Contribution'); 
                        } 

                        $i = 7;
                        $total_pagibig=0;
                        $count=1;

                        if(count($pagibig_list)!=0 || count($pagibig_list)!=null){
                            foreach($pagibig_list as $row){
                                $total_pagibig+=$row->employee;
                                if ($row->employee != 0){
                                    $excel->getActiveSheet()
                                            ->getStyle('A'.$i)
                                            ->getAlignment()
                                            ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);

                                    if ($month == "All"){
                                        $excel->getActiveSheet()
                                                ->getStyle('C'.$i)
                                                ->getAlignment()
                                                ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
                                    }else{
                                        $excel->getActiveSheet()
                                                ->getStyle('B'.$i)
                                                ->getAlignment()
                                                ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
                                    }

                                    $excel->getActiveSheet()
                                            ->getStyle($end.$i)
                                            ->getAlignment()
                                            ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);



                                    if ($month == "All"){
                                        $excel->getActiveSheet()->setCellValue('A'.$i,$count);
                                        $excel->getActiveSheet()->setCellValue('B'.$i,$row->periodmonth);
                                        $excel->getActiveSheet()->setCellValue('C'.$i,$row->ecode);
                                        $excel->getActiveSheet()->setCellValue('D'.$i,$row->full_name);
                                        $excel->getActiveSheet()->setCellValue('E'.$i,$row->pag_ibig);
                                        $excel->getActiveSheet()->getStyle('F'.$i)->getNumberFormat()->setFormatCode('###,##0.00;(###,##0.00)');
                                        $excel->getActiveSheet()->setCellValue('F'.$i,number_format($row->employee,2));
                                    }else{
                                        $excel->getActiveSheet()->setCellValue('A'.$i,$count);
                                        $excel->getActiveSheet()->setCellValue('B'.$i,$row->ecode);
                                        $excel->getActiveSheet()->setCellValue('C'.$i,$row->full_name);
                                        $excel->getActiveSheet()->setCellValue('D'.$i,$row->pag_ibig);
                                        $excel->getActiveSheet()->getStyle('E'.$i)->getNumberFormat()->setFormatCode('###,##0.00;(###,##0.00)');
                                        $excel->getActiveSheet()->setCellValue('E'.$i,number_format($row->employee,2));
                                    }

                                    $count++;
                                    $i++;
                        } } }
                        else{
                            $excel->getActiveSheet()
                                    ->getStyle('A'.$i)
                                    ->getAlignment()
                                    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                            
                            $excel->getActiveSheet()->mergeCells('A'.$i.':'.$end.$i);
                            $excel->getActiveSheet()->setCellValue('A'.$i,'No Result');
                            $i++;
                        }
              
                        if ($month == "All"){
                            $excel->getActiveSheet()
                                    ->getStyle('A'.$i)
                                    ->getAlignment()
                                    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
                            $excel->getActiveSheet()->mergeCells('A'.$i.':E'.$i);
                            $excel->getActiveSheet()->setCellValue('A'.$i,'Total:');   
                        }else{
                        $excel->getActiveSheet()
                                    ->getStyle('A'.$i)
                                    ->getAlignment()
                                    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
                            $excel->getActiveSheet()->mergeCells('A'.$i.':D'.$i);
                            $excel->getActiveSheet()->setCellValue('A'.$i,'Total:');   
                        }       


                        $excel->getActiveSheet()
                                ->getStyle($end.$i)
                                ->getAlignment()
                                ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

                        $excel->getActiveSheet()->getStyle($end.$i)->getNumberFormat()->setFormatCode('###,##0.00;(###,##0.00)');
                        $excel->getActiveSheet()->getStyle('A'.$i.':'.$end.$i)->getFont()->setBold(TRUE);
                        $excel->getActiveSheet()->setCellValue($end.$i,number_format($total_pagibig,2));
                              
                        $filename = "";

                        if ($month == "All"){
                            $filename = "Pag-Ibig Report - ".$year;
                        }else{
                            $filename = "Pag-Ibig Report - ".$month.' '.$year;
                        }

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

                case 'email-pagibig-list': //
                        $excel = $this->excel;
                        $id = $this->session->user_id;
                        $m_user = $this->Users_model;
                        $email = $m_user->get_email($id);

                        if($filter_value2==1){
                             $month="January";
                        }
                        else if($filter_value2==2){
                             $month="February";
                        }
                        else if($filter_value2==3){
                             $month="March";
                        }
                        else if($filter_value2==4){
                            $month="April";
                        }
                        else if($filter_value2==5){
                             $month="May";
                        }
                        else if($filter_value2==6){
                             $month="June";
                        }
                        else if($filter_value2==7){
                             $month="July";
                        }
                        else if($filter_value2==8){
                             $month="August";
                        }
                        else if($filter_value2==9){
                            $month="September";
                        }
                        else if($filter_value2==10){
                             $month="October";
                        }
                        else if($filter_value2==11){
                             $month="November";
                        }
                        else if($filter_value2==12){
                             $month="December";
                        }
                        else{
                            $month="All";
                        }

                        if($filter_value=="all"){
                            $branch="All Branch";
                        }
                        else{
                        $getbranch=$this->RefBranch_model->get_list(
                        $filter_value,
                        'ref_branch.branch,'
                        );
                        $branch=$getbranch[0]->branch;
                        }

                        if($filter_value=="all" AND $filter_value2=="all"){
                            $filter = 'emp_rates_duties.active_rates_duties=1 AND EXTRACT(YEAR FROM refpayperiod.pay_period_end) = '.$filter_value3;
                        }
                        if($filter_value!="all" AND $filter_value2=="all"){
                            $filter = 'ref_branch.ref_branch_id = '.$filter_value.' AND emp_rates_duties.active_rates_duties=1 AND EXTRACT(YEAR FROM refpayperiod.pay_period_end) = '.$filter_value3;
                        }
                        if($filter_value=="all" AND $filter_value2!="all"){
                            $filter = 'refpayperiod.month_id = '.$filter_value2.' AND emp_rates_duties.active_rates_duties=1 AND EXTRACT(YEAR FROM refpayperiod.pay_period_end) = '.$filter_value3;
                        }
                        if($filter_value!="all" AND $filter_value2!="all"){
                            $filter = 'refpayperiod.month_id = '.$filter_value2.' AND ref_branch.ref_branch_id ='.$filter_value.' AND emp_rates_duties.active_rates_duties=1 AND EXTRACT(YEAR FROM refpayperiod.pay_period_end) = '.$filter_value3;
                        }

                        $pagibig_list=$this->DailyTimeRecord_model->get_pagibig_report($filter);

                        $getcompany=$this->CompanyManagement_model->get_list(
                        null,
                        'company_management.*'
                        );

                        $company=$getcompany[0];
                        $month=$month;
                        $year = $filter_value3;

                        ob_start();
                        $excel->setActiveSheetIndex(0);

                        $end ="";
                        if ($month == "All"){$end="F";}else{$end="E";}
                        //name the worksheet
                        $excel->getActiveSheet()->setTitle("Pag-Ibig REPORT");
                        $excel->getActiveSheet()->mergeCells('A1:'.$end.'1');
                        $excel->getActiveSheet()->mergeCells('A2:'.$end.'2');
                        $excel->getActiveSheet()->mergeCells('A3:'.$end.'3');
                        $excel->getActiveSheet()->mergeCells('A4:'.$end.'4');

                        $excel->getActiveSheet()->setCellValue('A1',$company->company_name)
                                                ->setCellValue('A2',$company->address)
                                                ->setCellValue('A3',$company->contact_no)
                                                ->setCellValue('A4',$company->email_address);

                        $excel->getActiveSheet()->mergeCells('A5:'.$end.'5');

                        $excel->getActiveSheet()->getStyle('A6'.':'.'A8')->getFont()->setBold(TRUE);
                        $excel->getActiveSheet()->mergeCells('A6:'.$end.'6');
                        $excel->getActiveSheet()->mergeCells('A7:'.$end.'7');
                        $excel->getActiveSheet()->mergeCells('A8:'.$end.'8');

                        $monthdescription = "";

                        if ($month == "All"){
                            $monthdescription = "Pag-Ibig Report for All Months";
                        }else{
                            $monthdescription = "Pag-Ibig Report for Month of ".$month;
                        }

                        $excel->getActiveSheet()->setCellValue('A6',$monthdescription)
                                                ->setCellValue('A7','Year : '.$year)
                                                ->setCellValue('A8','Branch : '.$branch);
                        $excel->getActiveSheet()->mergeCells('A9:'.$end.'9');

                        $excel->getActiveSheet()->getStyle('A10'.':'.$end.'10')->getFont()->setBold(TRUE);

                        if ($month == "All"){
                            $excel->getActiveSheet()->getColumnDimension('A')->setWidth('15');
                            $excel->getActiveSheet()->getColumnDimension('B')->setWidth('15');
                            $excel->getActiveSheet()->getColumnDimension('C')->setWidth('15');
                            $excel->getActiveSheet()->getColumnDimension('D')->setWidth('30');
                            $excel->getActiveSheet()->getColumnDimension('E')->setWidth('20');
                            $excel->getActiveSheet()->getColumnDimension('F')->setWidth('13');
                        }else{
                            $excel->getActiveSheet()->getColumnDimension('A')->setWidth('15');
                            $excel->getActiveSheet()->getColumnDimension('B')->setWidth('15');
                            $excel->getActiveSheet()->getColumnDimension('C')->setWidth('30');
                            $excel->getActiveSheet()->getColumnDimension('D')->setWidth('20');
                            $excel->getActiveSheet()->getColumnDimension('E')->setWidth('13');
                        }

                        $excel->getActiveSheet()
                                ->getStyle('A10')
                                ->getAlignment()
                                ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

                        if ($month == "All"){
                            $excel->getActiveSheet()
                                    ->getStyle('C10')
                                    ->getAlignment()
                                    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                        }else{
                            $excel->getActiveSheet()
                                    ->getStyle('B10')
                                    ->getAlignment()
                                    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                        }

                        $excel->getActiveSheet()
                                ->getStyle($end.'10')
                                ->getAlignment()
                                ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

                        if ($month == "All"){
                            $excel->getActiveSheet()->setCellValue('A10','#');
                            $excel->getActiveSheet()->setCellValue('B10','Month');
                            $excel->getActiveSheet()->setCellValue('C10','Ecode');
                            $excel->getActiveSheet()->setCellValue('D10','Name');
                            $excel->getActiveSheet()->setCellValue('E10','Pag-Ibig No.');
                            $excel->getActiveSheet()->setCellValue('F10','Contribution'); 
                        }else{
                            $excel->getActiveSheet()->setCellValue('A10','#');
                            $excel->getActiveSheet()->setCellValue('B10','Ecode');
                            $excel->getActiveSheet()->setCellValue('C10','Name');
                            $excel->getActiveSheet()->setCellValue('D10','Pag-Ibig No.');
                            $excel->getActiveSheet()->setCellValue('E10','Contribution'); 
                        } 

                        $i = 11;
                        $total_pagibig=0;
                        $count=1;

                        if(count($pagibig_list)!=0 || count($pagibig_list)!=null){
                            foreach($pagibig_list as $row){
                                $total_pagibig+=$row->employee;
                                if ($row->employee != 0){
                                    $excel->getActiveSheet()
                                            ->getStyle('A'.$i)
                                            ->getAlignment()
                                            ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

                                    if ($month == "All"){
                                        $excel->getActiveSheet()
                                                ->getStyle('C'.$i)
                                                ->getAlignment()
                                                ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                                    }else{
                                        $excel->getActiveSheet()
                                                ->getStyle('B'.$i)
                                                ->getAlignment()
                                                ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                                    }

                                    $excel->getActiveSheet()
                                            ->getStyle($end.$i)
                                            ->getAlignment()
                                            ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);



                                    if ($month == "All"){
                                        $excel->getActiveSheet()->setCellValue('A'.$i,$count);
                                        $excel->getActiveSheet()->setCellValue('B'.$i,$row->periodmonth);
                                        $excel->getActiveSheet()->setCellValue('C'.$i,$row->ecode);
                                        $excel->getActiveSheet()->setCellValue('D'.$i,$row->full_name);
                                        $excel->getActiveSheet()->setCellValue('E'.$i,$row->pag_ibig);
                                        $excel->getActiveSheet()->getStyle('F'.$i)->getNumberFormat()->setFormatCode('###,##0.00;(###,##0.00)');
                                        $excel->getActiveSheet()->setCellValue('F'.$i,number_format($row->employee,2));
                                    }else{
                                        $excel->getActiveSheet()->setCellValue('A'.$i,$count);
                                        $excel->getActiveSheet()->setCellValue('B'.$i,$row->ecode);
                                        $excel->getActiveSheet()->setCellValue('C'.$i,$row->full_name);
                                        $excel->getActiveSheet()->setCellValue('D'.$i,$row->pag_ibig);
                                        $excel->getActiveSheet()->getStyle('E'.$i)->getNumberFormat()->setFormatCode('###,##0.00;(###,##0.00)');
                                        $excel->getActiveSheet()->setCellValue('E'.$i,number_format($row->employee,2));
                                    }

                                    $count++;
                                    $i++;
                        } } }
                        else{
                            $excel->getActiveSheet()
                                    ->getStyle('A'.$i)
                                    ->getAlignment()
                                    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                            
                            $excel->getActiveSheet()->mergeCells('A'.$i.':'.$end.$i);
                            $excel->getActiveSheet()->setCellValue('A'.$i,'No Result');
                            $i++;
                        }
              
                        if ($month == "All"){
                            $excel->getActiveSheet()
                                    ->getStyle('A'.$i)
                                    ->getAlignment()
                                    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
                            $excel->getActiveSheet()->mergeCells('A'.$i.':E'.$i);
                            $excel->getActiveSheet()->setCellValue('A'.$i,'Total:');   
                        }else{
                        $excel->getActiveSheet()
                                    ->getStyle('A'.$i)
                                    ->getAlignment()
                                    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
                            $excel->getActiveSheet()->mergeCells('A'.$i.':D'.$i);
                            $excel->getActiveSheet()->setCellValue('A'.$i,'Total:');   
                        }       


                        $excel->getActiveSheet()
                                ->getStyle($end.$i)
                                ->getAlignment()
                                ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

                        $excel->getActiveSheet()->getStyle($end.$i)->getNumberFormat()->setFormatCode('###,##0.00;(###,##0.00)');
                        $excel->getActiveSheet()->getStyle('A'.$i.':'.$end.$i)->getFont()->setBold(TRUE);
                        $excel->getActiveSheet()->setCellValue($end.$i,number_format($total_pagibig,2));
                              
                        $filename = "";

                        if ($month == "All"){
                            $filename = "Pag-Ibig Report - ".$year;
                        }else{
                            $filename = "Pag-Ibig Report - ".$month.' '.$year;
                        }

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
                        $data = ob_get_clean();

                            $file_name='Pag-Ibig Report '.date('Y-m-d h:i:A', now());
                            $excelFilePath = $file_name.".xlsx"; //generate filename base on id
                            //download it.
                            // Set SMTP Configuration
                            $emailConfig = array(
                                'protocol' => 'smtp', 
                                'smtp_host' => 'ssl://smtp.googlemail.com', 
                                'smtp_port' => 465, 
                                'smtp_user' => $getcompany[0]->email_address, 
                                'smtp_pass' => $getcompany[0]->email_password, 
                                'mailtype' => 'html', 
                                'charset' => 'iso-8859-1'
                            );

                            // Set your email information
                            
                            $from = array(
                                'email' => $getcompany[0]->email_address,
                                'name' => $getcompany[0]->company_name
                            );

                            $to = array($email[0]->user_email);
                            $subject = 'Pag-Ibig Report';
                          //  $message = 'Type your gmail message here';
                            $message = '<p>To: ' .$email[0]->user_email. '</p></ br>' .$filename.'</ br><p>Sent By: '. '<b>'.$getcompany[0]->company_name.'</b>'. '</p></ br>' .date('Y-m-d h:i:A', now());

                            // Load CodeIgniter Email library
                            $this->load->library('email', $emailConfig);
                            // Sometimes you have to set the new line character for better result
                            $this->email->set_newline("\r\n");
                            // Set email preferences
                            $this->email->from($from['email'], $from['name']);
                            $this->email->to($to);
                            $this->email->subject($subject);
                            $this->email->message($message);
                            $this->email->attach($data, 'attachment', $excelFilePath , 'application/ms-excel');
                            $this->email->set_mailtype("html");
                            // Ready to send email and check whether the email was successfully sent
                            if (!$this->email->send()) {
                                // Raise error message
                            $response['title']='Try Again!';
                            $response['stat']='error';
                            $response['msg']='Please check the Email Address of your Account or your Internet Connection.';

                            echo json_encode($response);
                            } else {
                                // Show success notification or other things here
                            $response['title']='Success!';
                            $response['stat']='success';
                            $response['msg']='Email Sent successfully.';

                            echo json_encode($response);
                            }

            break;

                case 'wtax-list': 

                        $company_id = $this->session->company_id;
                        $year = $filter_value;
                        $month_filter = $filter_value2;
                        $branch_id = $filter_value3;
                        $department_id = $filter_value4;
                        $emp_status = $filter_value5;

                        if($month_filter==1){
                             $month="January";
                        }
                        else if($month_filter==2){
                             $month="February";
                        }
                        else if($month_filter==3){
                             $month="March";
                        }
                        else if($month_filter==4){
                            $month="April";
                        }
                        else if($month_filter==5){
                             $month="May";
                        }
                        else if($month_filter==6){
                             $month="June";
                        }
                        else if($month_filter==7){
                             $month="July";
                        }
                        else if($month_filter==8){
                             $month="August";
                        }
                        else if($month_filter==9){
                            $month="September";
                        }
                        else if($month_filter==10){
                             $month="October";
                        }
                        else if($month_filter==11){
                             $month="November";
                        }
                        else if($month_filter==12){
                             $month="December";
                        }
                        else{
                            $month="All";
                        }
                        
                        if($branch_id=="all"){
                            $data['branch']="All";
                        }
                        else{
                            $getbranch=$this->RefBranch_model->get_list(
                            $branch_id,
                            'ref_branch.branch,'
                            );
                            $data['branch']=$getbranch[0]->branch;
                        }

                        if($department_id=="all"){
                            $data['department']="All";
                        }
                        else{
                            $getdepartment=$this->RefDepartment_model->get_list(
                            $department_id,
                            'ref_department.department,'
                            );
                            $data['department']=$getdepartment[0]->department;
                        }

                        $data["wtax_report"]=$this->DailyTimeRecord_model->get_wtax_report($company_id,$year,$month_filter,$branch_id,$department_id,$emp_status);
                        $getcompany=$this->CompanyManagement_model->get_company_list($company_id);

                        $data['company']=$getcompany[0];
                        $data['month']=$month;
                        $data['year']=$year;
                        $data['type']=$type;

                        echo $this->load->view('template/wtax_list_html',$data,TRUE);

            break;

            case 'export-wtax-list':

                        $company_id = $this->session->company_id;
                        $year = $filter_value;
                        $month_filter = $filter_value2;
                        $branch_id = $filter_value3;
                        $department_id = $filter_value4;
                        $emp_status = $filter_value5;

                        $excel = $this->excel;

                        if($month_filter==1){
                             $month="January";
                        }
                        else if($month_filter==2){
                             $month="February";
                        }
                        else if($month_filter==3){
                             $month="March";
                        }
                        else if($month_filter==4){
                            $month="April";
                        }
                        else if($month_filter==5){
                             $month="May";
                        }
                        else if($month_filter==6){
                             $month="June";
                        }
                        else if($month_filter==7){
                             $month="July";
                        }
                        else if($month_filter==8){
                             $month="August";
                        }
                        else if($month_filter==9){
                            $month="September";
                        }
                        else if($month_filter==10){
                             $month="October";
                        }
                        else if($month_filter==11){
                             $month="November";
                        }
                        else if($month_filter==12){
                             $month="December";
                        }
                        else{
                            $month="All";
                        }

                        if($branch_id=="all"){
                            $branch="All";
                        }
                        else{
                            $getbranch=$this->RefBranch_model->get_list(
                            $branch_id,
                            'ref_branch.branch,'
                            );
                            $branch=$getbranch[0]->branch;
                        }

                        if($department_id=="all"){
                            $department="All";
                        }
                        else{
                            $getdepartment=$this->RefDepartment_model->get_list(
                            $department_id,
                            'ref_department.department,'
                            );
                            $department=$getdepartment[0]->department;
                        }

                        $wtax_report=$this->DailyTimeRecord_model->get_wtax_report($company_id,$year,$month_filter,$branch_id,$department_id,$emp_status);
                        $getcompany=$this->CompanyManagement_model->get_company_list($company_id);

                        $company=$getcompany[0];

                        //show only inside grid with menu button
                        $excel->setActiveSheetIndex(0);

                        //name the worksheet
                        $excel->getActiveSheet()->setTitle("WTAX REPORT");

                        $end = "";
                        if ($month == "All"){$end="G";}else{$end="F";}

                        $excel->getActiveSheet()->mergeCells('A1:'.$end.'1');
                        $excel->getActiveSheet()->mergeCells('A2:'.$end.'2');
                        $excel->getActiveSheet()->mergeCells('A3:'.$end.'3');
                        $excel->getActiveSheet()->mergeCells('A4:'.$end.'4');
                        $excel->getActiveSheet()->mergeCells('A5:'.$end.'5');
                        $excel->getActiveSheet()->getStyle('A1'.':'.'A4')->getFont()->setBold(TRUE);

                        $monthdescription = "";

                        if ($month == "All"){
                            $monthdescription = "WTAX Report for All Months";
                        }else{
                            $monthdescription = "WTAX Report for Month of ".$month;
                        }

                        $excel->getActiveSheet()->setCellValue('A1',$monthdescription)
                                                ->setCellValue('A2','Year : '.$year)
                                                ->setCellValue('A3','Branch : '.$branch)
                                                ->setCellValue('A4','Department : '.$department);

                        $excel->getActiveSheet()->getStyle('A6'.':'.$end.'6')->getFont()->setBold(TRUE);

                        if($month == "All"){
                            $excel->getActiveSheet()->getColumnDimension('A')->setWidth('5');
                            $excel->getActiveSheet()->getColumnDimension('B')->setWidth('15');
                            $excel->getActiveSheet()->getColumnDimension('C')->setWidth('10');
                            $excel->getActiveSheet()->getColumnDimension('D')->setWidth('30');
                            $excel->getActiveSheet()->getColumnDimension('E')->setWidth('15');
                            $excel->getActiveSheet()->getColumnDimension('F')->setWidth('20');
                            $excel->getActiveSheet()->getColumnDimension('G')->setWidth('20');
                        }else{
                            $excel->getActiveSheet()->getColumnDimension('A')->setWidth('5');
                            $excel->getActiveSheet()->getColumnDimension('B')->setWidth('10');
                            $excel->getActiveSheet()->getColumnDimension('C')->setWidth('30');
                            $excel->getActiveSheet()->getColumnDimension('D')->setWidth('15');
                            $excel->getActiveSheet()->getColumnDimension('E')->setWidth('20');
                            $excel->getActiveSheet()->getColumnDimension('F')->setWidth('20');
                        }

                        $excel->getActiveSheet()
                                ->getStyle('A6')
                                ->getAlignment()
                                ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);

                        if ($month == "All"){
                           $excel->getActiveSheet()
                                    ->getStyle('C6')
                                    ->getAlignment()
                                    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);

                            $excel->getActiveSheet()
                                    ->getStyle('F6:G6')
                                    ->getAlignment()
                                    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

                            $excel->getActiveSheet()->setCellValue('A6','#');
                            $excel->getActiveSheet()->setCellValue('B6','Month');
                            $excel->getActiveSheet()->setCellValue('C6','Ecode');
                            $excel->getActiveSheet()->setCellValue('D6','Name');
                            $excel->getActiveSheet()->setCellValue('E6','TIN #');
                            $excel->getActiveSheet()->setCellValue('F6','Taxable Amount');    
                            $excel->getActiveSheet()->setCellValue('G6','Deduction');   

                        }else{
                           $excel->getActiveSheet()
                                    ->getStyle('B6')
                                    ->getAlignment()
                                    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);

                            $excel->getActiveSheet()
                                    ->getStyle('E6:F6')
                                    ->getAlignment()
                                    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

                            $excel->getActiveSheet()->setCellValue('A6','#');
                            $excel->getActiveSheet()->setCellValue('B6','Ecode');
                            $excel->getActiveSheet()->setCellValue('C6','Name');
                            $excel->getActiveSheet()->setCellValue('D6','TIN #');
                            $excel->getActiveSheet()->setCellValue('E6','Taxable Amount');    
                            $excel->getActiveSheet()->setCellValue('F6','Deduction'); 
                        }

                        $i = 7;
                        $total_wtax=0;
                        $count=1;           
  
                        if(count($wtax_report)!=0 || count($wtax_report)!=null){
                            foreach($wtax_report as $row){

                                $excel->getActiveSheet()
                                        ->getStyle('A'.$i)
                                        ->getAlignment()
                                        ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);

                                if ($month == "All"){
                                    $excel->getActiveSheet()
                                            ->getStyle('C'.$i)
                                            ->getAlignment()
                                            ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);

                                    $excel->getActiveSheet()
                                            ->getStyle('F'.$i.':G'.$i)
                                            ->getAlignment()
                                            ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

                                }else{
                                    $excel->getActiveSheet()
                                            ->getStyle('B'.$i)
                                            ->getAlignment()
                                            ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);

                                    $excel->getActiveSheet()
                                            ->getStyle('E'.$i.':F'.$i)
                                            ->getAlignment()
                                            ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
                                }

                                $total_wtax+=$row->wtax_employee;
                                if ($row->wtax_employee != 0){                        

                                    if($month == "All")
                                    {
                                        $excel->getActiveSheet()->setCellValue('A'.$i,$count);
                                        $excel->getActiveSheet()->setCellValue('B'.$i,$row->periodmonth);
                                        $excel->getActiveSheet()->setCellValue('C'.$i,$row->ecode);
                                        $excel->getActiveSheet()->setCellValue('D'.$i,$row->full_name);
                                        $excel->getActiveSheet()->setCellValue('E'.$i,$row->tin);
                                        $excel->getActiveSheet()->getStyle('F'.$i.':'.'G'.$i)->getNumberFormat()->setFormatCode('###,##0.00;(###,##0.00)');
                                        $excel->getActiveSheet()->setCellValue('F'.$i,number_format($row->taxable_amount,2));
                                        $excel->getActiveSheet()->setCellValue('G'.$i,number_format($row->wtax_employee,2));
                                    }else{
                                        $excel->getActiveSheet()->setCellValue('A'.$i,$count);
                                        $excel->getActiveSheet()->setCellValue('B'.$i,$row->ecode);
                                        $excel->getActiveSheet()->setCellValue('C'.$i,$row->full_name);
                                        $excel->getActiveSheet()->setCellValue('D'.$i,$row->tin);
                                        $excel->getActiveSheet()->getStyle('E'.$i.':'.'F'.$i)->getNumberFormat()->setFormatCode('###,##0.00;(###,##0.00)');
                                        $excel->getActiveSheet()->setCellValue('E'.$i,number_format($row->taxable_amount,2));
                                        $excel->getActiveSheet()->setCellValue('F'.$i,number_format($row->wtax_employee,2));
                                    }


                                $count++;
                                $i++;
                                } } }
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
                                        ->getStyle('A'.$i)
                                        ->getAlignment()
                                        ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
                                $excel->getActiveSheet()
                                        ->getStyle($end.$i)
                                        ->getAlignment()
                                        ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);


                                if ($month == "All"){
                                    $excel->getActiveSheet()->mergeCells('A'.$i.':'.'F'.$i); 

                                    $excel->getActiveSheet()->setCellValue('A'.$i,'Total:');                                    
                                    $excel->getActiveSheet()->getStyle('G'.$i)->getNumberFormat()->setFormatCode('###,##0.00;(###,##0.00)');

                                    $excel->getActiveSheet()->getStyle('A'.$i.':'.'G'.$i)->getFont()->setBold(TRUE);
                                    $excel->getActiveSheet()->setCellValue('G'.$i,number_format($total_wtax,2));
                                }else{
                                    $excel->getActiveSheet()->mergeCells('A'.$i.':'.'E'.$i); 

                                    $excel->getActiveSheet()->setCellValue('A'.$i,'Total:');                                    
                                    $excel->getActiveSheet()->getStyle('F'.$i)->getNumberFormat()->setFormatCode('###,##0.00;(###,##0.00)');

                                    $excel->getActiveSheet()->getStyle('A'.$i.':'.'F'.$i)->getFont()->setBold(TRUE);
                                    $excel->getActiveSheet()->setCellValue('F'.$i,number_format($total_wtax,2));
                                }                                    

                        $filename = "";

                        if ($month == "All"){
                            $filename="WTAX REPORT - ".$year;
                        }else{
                            $filename="WTAX REPORT - ".$month.' '.$year;
                        }

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

                case 'email-wtax-list': //
                        $excel = $this->excel;
                        $id = $this->session->user_id;
                        $m_user = $this->Users_model;
                        $email = $m_user->get_email($id);

                        if($filter_value2==1){
                             $month="January";
                        }
                        else if($filter_value2==2){
                             $month="February";
                        }
                        else if($filter_value2==3){
                             $month="March";
                        }
                        else if($filter_value2==4){
                            $month="April";
                        }
                        else if($filter_value2==5){
                             $month="May";
                        }
                        else if($filter_value2==6){
                             $month="June";
                        }
                        else if($filter_value2==7){
                             $month="July";
                        }
                        else if($filter_value2==8){
                             $month="August";
                        }
                        else if($filter_value2==9){
                            $month="September";
                        }
                        else if($filter_value2==10){
                             $month="October";
                        }
                        else if($filter_value2==11){
                             $month="November";
                        }
                        else if($filter_value2==12){
                             $month="December";
                        }
                        else{
                            $month="All";
                        }

                        if($filter_value=="all"){
                            $branch="All Branch";
                        }
                        else{
                        $getbranch=$this->RefBranch_model->get_list(
                        $filter_value,
                        'ref_branch.branch,'
                        );
                        $branch=$getbranch[0]->branch;
                        }

                        if($filter_value=="all" AND $filter_value2=="all"){
                            $filter = 'emp_rates_duties.active_rates_duties=1 AND EXTRACT(YEAR FROM refpayperiod.pay_period_end) = '.$filter_value3;
                        }
                        if($filter_value!="all" AND $filter_value2=="all"){
                            $filter = 'ref_branch.ref_branch_id = '.$filter_value.' AND emp_rates_duties.active_rates_duties=1 AND EXTRACT(YEAR FROM refpayperiod.pay_period_end) = '.$filter_value3;
                        }
                        if($filter_value=="all" AND $filter_value2!="all"){
                            $filter = 'refpayperiod.month_id = '.$filter_value2.' AND emp_rates_duties.active_rates_duties=1 AND EXTRACT(YEAR FROM refpayperiod.pay_period_end) = '.$filter_value3;
                        }
                        if($filter_value!="all" AND $filter_value2!="all"){
                            $filter = 'refpayperiod.month_id = '.$filter_value2.' AND ref_branch.ref_branch_id ='.$filter_value.' AND emp_rates_duties.active_rates_duties=1 AND EXTRACT(YEAR FROM refpayperiod.pay_period_end) = '.$filter_value3;
                        }

                        $wtax_report=$this->DailyTimeRecord_model->get_wtax_report($filter);

                        $getcompany=$this->CompanyManagement_model->get_list(
                        null,
                        'company_management.*'
                        );

                        $company=$getcompany[0];
                        $month=$month;
                        $year = $filter_value3;
                        //echo json_encode($data);
                        //show only inside grid with menu button
                        ob_start();
                        $excel->setActiveSheetIndex(0);

                        //name the worksheet
                        $excel->getActiveSheet()->setTitle("WTAX REPORT");

                        $end = "";
                        if ($month == "All"){$end="G";}else{$end="F";}

                        $excel->getActiveSheet()->mergeCells('A1:'.$end.'1');
                        $excel->getActiveSheet()->mergeCells('A2:'.$end.'2');
                        $excel->getActiveSheet()->mergeCells('A3:'.$end.'3');
                        $excel->getActiveSheet()->mergeCells('A4:'.$end.'4');

                        $excel->getActiveSheet()->setCellValue('A1',$company->company_name)
                                                ->setCellValue('A2',$company->address)
                                                ->setCellValue('A3',$company->contact_no)
                                                ->setCellValue('A4',$company->email_address);

                        $excel->getActiveSheet()->mergeCells('A5:'.$end.'5');

                        $excel->getActiveSheet()->getStyle('A6'.':'.'A8')->getFont()->setBold(TRUE);
                        $excel->getActiveSheet()->mergeCells('A6:'.$end.'6');
                        $excel->getActiveSheet()->mergeCells('A7:'.$end.'7');
                        $excel->getActiveSheet()->mergeCells('A8:'.$end.'8');

                        $monthdescription = "";

                        if ($month == "All"){
                            $monthdescription = "WTAX Report for All Months";
                        }else{
                            $monthdescription = "WTAX Report for Month of ".$month;
                        }

                        $excel->getActiveSheet()->setCellValue('A6',$monthdescription)
                                                ->setCellValue('A7','Year : '.$year)
                                                ->setCellValue('A8','Branch : '.$branch);
                        $excel->getActiveSheet()->mergeCells('A9:'.$end.'9');

                        $excel->getActiveSheet()->getStyle('A10'.':'.$end.'10')->getFont()->setBold(TRUE);

                        if($month == "All"){
                            $excel->getActiveSheet()->getColumnDimension('A')->setWidth('5');
                            $excel->getActiveSheet()->getColumnDimension('B')->setWidth('15');
                            $excel->getActiveSheet()->getColumnDimension('C')->setWidth('10');
                            $excel->getActiveSheet()->getColumnDimension('D')->setWidth('30');
                            $excel->getActiveSheet()->getColumnDimension('E')->setWidth('15');
                            $excel->getActiveSheet()->getColumnDimension('F')->setWidth('20');
                            $excel->getActiveSheet()->getColumnDimension('G')->setWidth('20');
                        }else{
                            $excel->getActiveSheet()->getColumnDimension('A')->setWidth('5');
                            $excel->getActiveSheet()->getColumnDimension('B')->setWidth('10');
                            $excel->getActiveSheet()->getColumnDimension('C')->setWidth('30');
                            $excel->getActiveSheet()->getColumnDimension('D')->setWidth('15');
                            $excel->getActiveSheet()->getColumnDimension('E')->setWidth('20');
                            $excel->getActiveSheet()->getColumnDimension('F')->setWidth('20');
                        }

                        $excel->getActiveSheet()
                                ->getStyle('A10')
                                ->getAlignment()
                                ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

                        if ($month == "All"){
                           $excel->getActiveSheet()
                                    ->getStyle('C10')
                                    ->getAlignment()
                                    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

                            $excel->getActiveSheet()
                                    ->getStyle('F10')
                                    ->getAlignment()
                                    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

                            $excel->getActiveSheet()
                                    ->getStyle('G10')
                                    ->getAlignment()
                                ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

                            $excel->getActiveSheet()->setCellValue('A10','#');
                            $excel->getActiveSheet()->setCellValue('B10','Month');
                            $excel->getActiveSheet()->setCellValue('C10','Ecode');
                            $excel->getActiveSheet()->setCellValue('D10','Name');
                            $excel->getActiveSheet()->setCellValue('E10','TIN #.');
                            $excel->getActiveSheet()->setCellValue('F10','Taxable Amount');    
                            $excel->getActiveSheet()->setCellValue('G10','Deduction/Tax Shield');   

                        }else{
                           $excel->getActiveSheet()
                                    ->getStyle('B10')
                                    ->getAlignment()
                                    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

                            $excel->getActiveSheet()
                                    ->getStyle('E10')
                                    ->getAlignment()
                                    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

                            $excel->getActiveSheet()
                                    ->getStyle('F10')
                                    ->getAlignment()
                                    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

                            $excel->getActiveSheet()->setCellValue('A10','#');
                            $excel->getActiveSheet()->setCellValue('B10','Ecode');
                            $excel->getActiveSheet()->setCellValue('C10','Name');
                            $excel->getActiveSheet()->setCellValue('D10','TIN #.');
                            $excel->getActiveSheet()->setCellValue('E10','Taxable Amount');    
                            $excel->getActiveSheet()->setCellValue('F10','Deduction/Tax Shield'); 
                        }


                        $i = 11;
                        $total_wtax=0;
                        $count=1;           
  
                        if(count($wtax_report)!=0 || count($wtax_report)!=null){
                            foreach($wtax_report as $row){

                                $excel->getActiveSheet()
                                        ->getStyle('A'.$i)
                                        ->getAlignment()
                                        ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

                                if ($month == "All"){
                                    $excel->getActiveSheet()
                                            ->getStyle('C'.$i)
                                            ->getAlignment()
                                            ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

                                    $excel->getActiveSheet()
                                            ->getStyle('F'.$i)
                                            ->getAlignment()
                                            ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

                                    $excel->getActiveSheet()
                                            ->getStyle('G'.$i)
                                            ->getAlignment()
                                            ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
                                }else{
                                    $excel->getActiveSheet()
                                            ->getStyle('B'.$i)
                                            ->getAlignment()
                                            ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

                                    $excel->getActiveSheet()
                                            ->getStyle('E'.$i)
                                            ->getAlignment()
                                            ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

                                    $excel->getActiveSheet()
                                            ->getStyle('F'.$i)
                                            ->getAlignment()
                                            ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
                                }

                                $total_wtax+=$row->wtax_employee;
                                if ($row->wtax_employee != 0){                        

                                    if($month == "All")
                                    {
                                        $excel->getActiveSheet()->setCellValue('A'.$i,$count);
                                        $excel->getActiveSheet()->setCellValue('B'.$i,$row->periodmonth);
                                        $excel->getActiveSheet()->setCellValue('C'.$i,$row->ecode);
                                        $excel->getActiveSheet()->setCellValue('D'.$i,$row->full_name);
                                        $excel->getActiveSheet()->setCellValue('E'.$i,$row->tin);
                                        $excel->getActiveSheet()->getStyle('F'.$i.':'.'G'.$i)->getNumberFormat()->setFormatCode('###,##0.00;(###,##0.00)');
                                        $excel->getActiveSheet()->setCellValue('F'.$i,number_format($row->taxable_amount,2));
                                        $excel->getActiveSheet()->setCellValue('G'.$i,number_format($row->wtax_employee,2));
                                    }else{
                                        $excel->getActiveSheet()->setCellValue('A'.$i,$count);
                                        $excel->getActiveSheet()->setCellValue('B'.$i,$row->ecode);
                                        $excel->getActiveSheet()->setCellValue('C'.$i,$row->full_name);
                                        $excel->getActiveSheet()->setCellValue('D'.$i,$row->tin);
                                        $excel->getActiveSheet()->getStyle('E'.$i.':'.'F'.$i)->getNumberFormat()->setFormatCode('###,##0.00;(###,##0.00)');
                                        $excel->getActiveSheet()->setCellValue('E'.$i,number_format($row->taxable_amount,2));
                                        $excel->getActiveSheet()->setCellValue('F'.$i,number_format($row->wtax_employee,2));
                                    }


                                $count++;
                                $i++;
                                } } }
                                else{
                                    $excel->getActiveSheet()
                                            ->getStyle('A'.$i)
                                            ->getAlignment()
                                            ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                                    $excel->getActiveSheet()->mergeCells('A'.$i.':'.$end.$i);  
                                    $excel->getActiveSheet()->setCellValue('A'.$i,'No Result');                                    
                                }

                                $excel->getActiveSheet()
                                        ->getStyle('A'.$i)
                                        ->getAlignment()
                                        ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
                                $excel->getActiveSheet()
                                        ->getStyle($end.$i)
                                        ->getAlignment()
                                        ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);


                                if ($month == "All"){
                                    $excel->getActiveSheet()->mergeCells('A'.$i.':'.'F'.$i); 

                                    $excel->getActiveSheet()->setCellValue('A'.$i,'Total:');                                    
                                    $excel->getActiveSheet()->getStyle('G'.$i)->getNumberFormat()->setFormatCode('###,##0.00;(###,##0.00)');

                                    $excel->getActiveSheet()->getStyle('A'.$i.':'.'G'.$i)->getFont()->setBold(TRUE);
                                    $excel->getActiveSheet()->setCellValue('G'.$i,number_format($total_wtax,2));
                                }else{
                                    $excel->getActiveSheet()->mergeCells('A'.$i.':'.'E'.$i); 

                                    $excel->getActiveSheet()->setCellValue('A'.$i,'Total:');                                    
                                    $excel->getActiveSheet()->getStyle('F'.$i)->getNumberFormat()->setFormatCode('###,##0.00;(###,##0.00)');

                                    $excel->getActiveSheet()->getStyle('A'.$i.':'.'F'.$i)->getFont()->setBold(TRUE);
                                    $excel->getActiveSheet()->setCellValue('F'.$i,number_format($total_wtax,2));
                                }                                    

                        $filename = "";

                        if ($month == "All"){
                            $filename="WTAX REPORT - ".$year;
                        }else{
                            $filename="WTAX REPORT - ".$month.' '.$year;
                        }

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
                        $data = ob_get_clean();

                            $file_name='WTAX Report '.date('Y-m-d h:i:A', now());
                            $excelFilePath = $file_name.".xlsx"; //generate filename base on id
                            //download it.
                            // Set SMTP Configuration
                            $emailConfig = array(
                                'protocol' => 'smtp', 
                                'smtp_host' => 'ssl://smtp.googlemail.com', 
                                'smtp_port' => 465, 
                                'smtp_user' => $getcompany[0]->email_address, 
                                'smtp_pass' => $getcompany[0]->email_password, 
                                'mailtype' => 'html', 
                                'charset' => 'iso-8859-1'
                            );

                            // Set your email information
                            
                            $from = array(
                                'email' => $getcompany[0]->email_address,
                                'name' => $getcompany[0]->company_name
                            );

                            $to = array($email[0]->user_email);
                            $subject = 'WTAX Report';
                          //  $message = 'Type your gmail message here';
                            $message = '<p>To: ' .$email[0]->user_email. '</p></ br>' .$filename.'</ br><p>Sent By: '. '<b>'.$getcompany[0]->company_name.'</b>'. '</p></ br>' .date('Y-m-d h:i:A', now());

                            // Load CodeIgniter Email library
                            $this->load->library('email', $emailConfig);
                            // Sometimes you have to set the new line character for better result
                            $this->email->set_newline("\r\n");
                            // Set email preferences
                            $this->email->from($from['email'], $from['name']);
                            $this->email->to($to);
                            $this->email->subject($subject);
                            $this->email->message($message);
                            $this->email->attach($data, 'attachment', $excelFilePath , 'application/ms-excel');
                            $this->email->set_mailtype("html");
                            // Ready to send email and check whether the email was successfully sent
                            if (!$this->email->send()) {
                                // Raise error message
                            $response['title']='Try Again!';
                            $response['stat']='error';
                            $response['msg']='Please check the Email Address of your Account or your Internet Connection.';

                            echo json_encode($response);
                            } else {
                                // Show success notification or other things here
                            $response['title']='Success!';
                            $response['stat']='success';
                            $response['msg']='Email Sent successfully.';

                            echo json_encode($response);
                            }

                        break;
        }
    }
}
