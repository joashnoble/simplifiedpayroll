<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title><?php echo $title; ?></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="description" content="Avenxo Admin Theme">
    <meta name="author" content="">
    <?php echo $_def_css_files; ?>
    <?php echo $_def_css_custom; ?>
    <link rel="stylesheet" href="assets/plugins/spinner/dist/ladda-themeless.min.css">
    <link type="text/css" href="assets/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet">
    <link type="text/css" href="assets/plugins/iCheck/skins/minimal/blue.css" rel="stylesheet">              
    <link type="text/css" href="assets/plugins/iCheck/skins/minimal/_all.css" rel="stylesheet">                  
    <link href="assets/plugins/datapicker/datepicker3.css" rel="stylesheet">
    <link href="assets/plugins/select2/select2.min.css" rel="stylesheet">
    <link href="assets/css/plugins/datapicker/datepicker3.css" rel="stylesheet">
    <?php echo $_switcher_settings; ?>
    <?php echo $_def_js_files; ?>
    <script type="text/javascript" src="assets/plugins/datatables/jquery.dataTables.js"></script>
    <script type="text/javascript" src="assets/plugins/datatables/dataTables.bootstrap.js"></script>
    <script src="assets/plugins/fullcalendar/moment.min.js"></script>
    <script src="assets/plugins/datapicker/bootstrap-datepicker.js"></script>
    <script src="assets/plugins/select2/select2.full.min.js"></script>
    <script src="assets/js/plugins/fullcalendar/moment.min.js"></script>
    <script src="assets/js/plugins/datapicker/bootstrap-datepicker.js"></script>
    <script src="assets/plugins/twittertypehead/handlebars.js"></script>
    <script src="assets/plugins/twittertypehead/bloodhound.min.js"></script>
    <script src="assets/plugins/twittertypehead/typeahead.bundle.min.js"></script>
    <script src="assets/plugins/twittertypehead/typeahead.jquery.min.js"></script>
    <script type="text/javascript" src="assets/plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.js"></script>

    <script src="assets/plugins/formatter/autoNumeric.js" type="text/javascript"></script>
    <script src="assets/plugins/formatter/accounting.js" type="text/javascript"></script>
    <?php echo $loaderscript; ?>
    <style type="text/css">
        #tbl_dtr, #tbl_ot, #tbl_holiday{
            width: 100%!important;
        }
        #tbl_dtr td, #tbl_ot td, #tbl_holiday td{
            padding: 0px!important;
            margin: 0px!important;
            border: 1px solid #ECEFF1!important;
            background: #FFF!important;
        }
        input.right { 
            text-align: right; 
        }
        #tbl_dtr th, #tbl_ot th, #tbl_holiday th{
            font-size: 9pt;
            text-align: center;
        }
        #tbl_dtr th.thearnings{
            background: #81C784!important;
        }
        #tbl_dtr th.earnings{
            background: #2E7D32;color: #FFF;
        }
        #tbl_dtr th.adjustment{
            background: #546E7A;color: #FFF;
        }
        #tbl_dtr th.thadjustment{
            background: #B0BEC5!important;
        }
        #tbl_dtr th.deduction{
            background: #b71c1c;color: #FFF;
        }
        #tbl_dtr th.thdeduction{
            background: #ef5350!important;
        }
        #tbl_dtr th.total{
            background: #F57C00;
        }
        #tbl_dtr th.thtotal{
            background: #FFCC80!important;
        }
        #tbl_dtr input, #tbl_ot input, #tbl_holiday input{
            border: 0px solid #90A4AE!important;
        }
        #tbl_dtr input{
            width: 100px!important;
        }
        #tbl_dtr input.ename{
            width: 200px!important;
        }
       #tbl_dtr input.ecode{
            width: 50px!important;
        }
        #tbl_dtr input.process{
            width: 50px!important;
        }
        #tbl_dtr input:-moz-read-only, #tbl_ot input:-moz-read-only, #tbl_holiday input:-moz-read-only{ /* For Firefox */
            background-color: #FFF!important;
            border: 0px solid #90A4AE!important;
            cursor: pointer!important;
        }
        #tbl_dtr input:read-only, #tbl_ot input:read-only, #tbl_holiday input:read-only{
            background-color: #FFF!important;
            border: 0px solid #90A4AE!important;
            cursor: pointer!important;
        }
        #tbl_dtr td:nth-child(4), #tbl_ot td:nth-child(2), #tbl_ot td:nth-child(3), #tbl_holiday td:nth-child(2), #tbl_holiday td:nth-child(3){
            padding-left: 10px!important;
        }        
        #tbl_ot td:nth-child(1), #tbl_holiday td:nth-child(1), #tbl_dtr td:nth-child(2){
            text-align: center;
        }
        .thborder{
            border-top: 2px solid #ECEFF1!important;
        }
        #search_panel{
            float: right; margin-right: 15px; margin-top: 10px;width: 400px;
        }
        #search_panel i{
            cursor: pointer;float: right;
        }

        #search_payroll_text{
            margin-top: -6px;width: 100%;
        }
        main {
          width: 100%;
          margin: 0 auto;
          background: #fff;
          border: 1px solid #ddd;
        }

        section {
          display: none;
          padding: 20px 0 0;
          border-top: 1px solid #ddd;
        }

        input[name^="tabs"] {
          display: none;
        }

        .label {
          display: inline-block;
          margin: 0 0 -1px;
          padding: 10px 20px;
          font-weight: 600;
          text-align: center;
          color: #bbb;
          border: 1px solid transparent;
        }

        .label:before {
          font-family: fontawesome;
          font-weight: normal;
          margin-right: 10px;
        }

        .label:hover {
          color: #888;
          cursor: pointer;
        }

        input:checked + label {
          color: #555;
          border: 1px solid #ddd;
          border-top: 2px solid orange;
          border-bottom: 1px solid #fff;
        }

        #tab1:checked ~ #content1,
        #tab2:checked ~ #content2,
        #tab3:checked ~ #content3{
          display: block;
        }

        @media screen and (max-width: 650px) {
          .label {
            font-size: 0;
          }
          .label:before {
            margin: 0;
            font-size: 18px;
          }
        }

        @media screen and (max-width: 400px) {
          .label {
            padding: 15px;
          }
        }
        .factorfile{
            text-align: center;
        }
        .five{width: 5%!important;}
        .ten{width:5%!important;}
        .tbl_dtr_panel{
            width: 1500px!important;       
        }
    </style>
</head>
<body class="animated-content">
<?php echo $loader; ?>
<?php echo $_top_navigation; ?>
<div id="wrapper">
    <div id="layout-static">
        <?php echo $_side_bar_navigation;?>
        <div class="static-content-wrapper white-bg">
            <div class="static-content" >
                <div class="page-content">
                    <div class="container-fluid panel-padding">
                        <div id="div_employee_list">
                            <div class="panel panel-default panel-padding">
                                <div class="panel-inside">
                                    <div class="panel-inside1">
                                        <div class="panel-heading" style="background: #ECEFF1!important;">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="col-md-3">
                                                        <label class="control-label boldlabel" style="text-align:left;font-size: 10pt;color: black!important;margin-bottom: 0px;"><i class="fa fa-calendar"></i> Year :</label>
                                                            <select class="form-control" name="year" id="year" data-error-msg="Year is required!" required data-id="dadad">
                                                                <?php $minyear=1990; $maxyear = date('Y');
                                                                    while($minyear != $maxyear){
                                                                        $minyear++;
                                                                        echo '<option value="'.$minyear.'" '. ($year_today == $minyear ? ' selected' : '').'>'.$minyear.'</option>';
                                                                    }
                                                                ?>
                                                            </select>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label class="control-label boldlabel" style="text-align:left;font-size: 10pt;color: black!important;margin-bottom: 0px;"><i class="fa fa-calendar"></i> Pay Period :</label>
                                                                <select class="form-control" name="payperiod" id="payperiod" data-error-msg="Pay Period is required!" required>
                                                                    <?php foreach ($payperiod as $pay) { ?>
                                                                        <option value='<?php echo $pay->pay_period_id ?>'>
                                                                        <?php echo $pay->pay_period_start.' ~ '.$pay->pay_period_end; ?></option>
                                                                    <?php } ?>
                                                                    <option>
                                                                    </option>
                                                                </select>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label class="control-label boldlabel" style="text-align:left;font-size: 10pt;color: black!important;margin-bottom: 0px;"><i class="fa fa-building"></i> Branch :</label>
                                                                <select class="form-control" name="branch" id="branch" data-error-msg="Branch is required!" required>
                                                                    <option value="all">All Branch</option>
                                                                    <?php
                                                                        foreach($ref_branch as $row)
                                                                        {
                                                                            echo '<option value="'.$row->ref_branch_id  .'">'.$row->branch.'</option>';
                                                                        }
                                                                    ?> 
                                                                </select>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label class="control-label boldlabel" style="text-align:left;font-size: 10pt;color: black!important;margin-bottom: 0px;"><i class="fa fa-building"></i> Department :</label>
                                                                <select class="form-control" name="department" id="department" data-error-msg="Department is required!" required>
                                                                    <option value="all">All Department</option>
                                                                    <?php
                                                                        foreach($ref_department as $row)
                                                                        {
                                                                            echo '<option value="'.$row->ref_department_id  .'">'.$row->department.'</option>';
                                                                        }
                                                                    ?> 
                                                                </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel-footer" style="background: #FFF;">
                                            <div class="panel-body table-responsive" style="padding-top:8px;">
                                            <main id="main_panel">
                                                <input id="tab1" type="radio" name="tabs" checked>
                                                <label class="label" for="tab1">Payroll</label>
                                                <input id="tab2" type="radio" name="tabs">
                                                <label class="label" for="tab2">Overtime</label>
                                                <input id="tab3" type="radio" name="tabs">
                                                <label class="label" for="tab3">Holiday Pay</label>     

                                                <section id="content1" style="overflow-x: scroll;">
                                                    <div class="tbl_dtr_panel">
                                                         <form id="frm_tbl_dtr">
                                                            <table id="tbl_dtr">
                                                                <thead>
                                                                    <tr>
                                                                        <th colspan="4">
                                                                            <span>
                                                                                <button type="button" id="btn_check_all">
                                                                                    Check All <i class="fa fa-check"></i>
                                                                                </button>
                                                                                <button type="button" id="btn_uncheck_all">
                                                                                    Uncheck All <i class="fa fa-times"></i>
                                                                                </button>
                                                                            </span>
                                                                        </th>
                                                                        <th colspan="8" class="earnings"><center>Earnings</center></th>
                                                                        <th colspan="4" class="deduction"><center>Deduction (Undertime &amp; Late)</center></th>
                                                                        <th colspan="2" class="adjustment">Adjustment</th>
                                                                        <th class="total"></th>
                                                                        <th colspan="7" class="deduction"><center>Deduction</center></th>
                                                                        <th class="total"></th>
                                                                    </tr>
                                                                    <tr>
                                                                        <th class="thborder">Action</th>
                                                                        <th class="thborder">Process</th>
                                                                        <th class="thborder">Ecode</th>
                                                                        <th class="thborder" style="width: 250px!important;">Employee</th>
                                                                        <th class="thborder thearnings" style="width: 130px!important;">No of Hrs</th>

                                                                        <th class="thborder thearnings" style="width: 130px!important;">Daily Rate</th>

                                                                        <th class="thborder thearnings" style="width: 130px!important;">Salary Reg Rate</th>
                                                                        <th class="thborder thearnings" style="width: 130px!important;">Basic Pay Total</th>
                                                                        <th class="thborder thearnings" style="width: 130px!important;">OT</th>
                                                                        <th class="thborder thearnings" style="width: 130px!important;">Holiday Pay</th>
                                                                        <th class="thborder thearnings" style="width: 130px!important;">Allowance</th>
                                                                        <th class="thborder thearnings" style="width: 130px!important;">Commission / Other Pay</th>
                                                                        <th class="thborder thdeduction" style="width: 130px!important;">Undertime (minute)</th>
                                                                        <th class="thborder thdeduction" style="width: 130px!important;">Late (minute)</th>
                                                                        <th class="thborder thdeduction" style="width: 130px!important;">Undertime</th>
                                                                        <th class="thborder thdeduction" style="width: 130px!important;">Late</th>
                                                                        <th class="thborder thadjustment" style="width: 130px!important;">Additional</th>
                                                                        <th class="thborder thadjustment" style="width: 130px!important;">Deduction</th>
                                                                        <th class="thborder thtotal" style="width: 130px!important;">Gross Total</th>
                                                                        <th class="thborder thdeduction" style="width: 130px!important;">SSS</th>
                                                                        <th class="thborder thdeduction" style="width: 130px!important;">Philhealth</th>
                                                                        <th class="thborder thdeduction" style="width: 130px!important;">Pagibig</th>
                                                                        <th class="thborder thdeduction" style="width: 130px!important;">WTAX</th>
                                                                        <th class="thborder thdeduction" style="width: 130px!important;">SSS Loan</th>
                                                                        <th class="thborder thdeduction" style="width: 130px!important;">Pagibig Loan</th>
                                                                        <th class="thborder thdeduction" style="width: 130px!important;">CA</th>
                                                                        <th class="thborder thtotal" style="width: 130px!important;">Net Total</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                </tbody>
                                                            </table>
                                                        </form>
                                                    </div>
                                                    <div id="loader" style="width: 100%;padding: 20px;">
                                                        <center>
                                                            <img src="assets/img/loader/gears.svg"/> <br />
                                                            <span style="margin-top: 20px!important;">Gathering Data...</span>
                                                        </center>
                                                    </div>
                                                </section>
                                                <section id="content2">
                                                    <form id="frm_tbl_ot">
                                                        <table id="tbl_ot" class="table table-striped table-bordered">
                                                            <thead>
                                                                <?php foreach($ref_factor_file AS $row){?>
                                                                <tr>
                                                                    <th colspan="2"></th>
                                                                    <th><input type="text" id="fac-reg-ot" class="factorfile" value="<?php echo number_format($row->regular_ot,2); ?>" readonly></th>
                                                                    <th><input type="text" id="fac-sun-ot" class="factorfile" value="<?php echo number_format($row->sunday_ot,2); ?>" readonly></th>
                                                                    <th><input type="text" id="fac-reg-hol-ot" class="factorfile" value="<?php echo number_format($row->regular_holiday_ot,2); ?>" readonly></th>
                                                                    <th><input type="text" id="fac-sun-reg-hol-ot" class="factorfile" value="<?php echo number_format($row->sun_regular_holiday_ot,2); ?>" readonly></th>
                                                                    <th><input type="text" id="fac-spe-hol-ot" class="factorfile" value="<?php echo number_format($row->spe_holiday_ot,2); ?>" readonly></th>
                                                                    <th><input type="text" id="fac-sun-spe-hol-ot" class="factorfile" value="<?php echo number_format($row->sun_spe_holiday_ot,2); ?>" readonly></th>
                                                                    <th></th>
                                                                </tr>
                                                                <?php } ?>
                                                                <tr>
                                                                    <th width="5%">Ecode</th>
                                                                    <th style="width: 200px;">Employee</th>
                                                                    <th width="5%">Regular OT</th>
                                                                    <th width="5%">Sunday OT</th>
                                                                    <th width="5%">Regular Holiday OT</th>
                                                                    <th width="5%">Sunday Regular Holiday OT</th>
                                                                    <th width="5%">Special Holiday OT</th>
                                                                    <th width="5%">Sunday Special Holiday OT</th>
                                                                    <th width="5%">Total</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            </tbody>
                                                        </table>
                                                    </form>
                                                </section>
                                                <section id="content3">
                                                    <form id="frm_tbl_holiday">
                                                        <table id="tbl_holiday" class="table table-striped table-bordered">
                                                            <thead>
                                                                <?php foreach($ref_factor_file AS $row){?>
                                                                <tr>
                                                                    <th colspan="2"></th>
                                                                    <th><input type="text" id="fac-reg-hol" class="factorfile" value="<?php echo number_format($row->regular_holiday,2); ?>" readonly></th>
                                                                    <th><input type="text" id="fac-sun-reg-hol" class="factorfile" value="<?php echo number_format($row->sun_regular_holiday,2); ?>" readonly></th>
                                                                    <th><input type="text" id="fac-spe-hol" class="factorfile" value="<?php echo number_format($row->spe_holiday,2); ?>" readonly></th>
                                                                    <th><input type="text" id="fac-sun-spe-hol" class="factorfile" value="<?php echo number_format($row->sun_spe_holiday,2); ?>" readonly></th>
                                                                    <th></th>
                                                                </tr>
                                                                <?php } ?>
                                                                <tr>
                                                                    <th>Ecode</th>
                                                                    <th style="width: 200px;">Employee</th>
                                                                    <th>Regular Holiday</th>
                                                                    <th>Sunday Regular Holiday</th>
                                                                    <th>Special Holiday</th>
                                                                    <th>Sunday Special Holiday</th>
                                                                    <th>Total</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            </tbody>
                                                        </table>
                                                    </form>
                                                </section>
                                            </main>
                                            </div>
                                        </div>
                                        </div> <!--panel default -->
                                    </div> <!--emp list -->
                                </div>
                            </div>
                        </div>
                    </div><!-- .container-fluid -->
                </div> <!-- #page-content -->
            </div><!--static content -->
        </div><!--content wrapper -->
    </div><!--static layout -->
</div> <!--wrapper -->
<div id="modal_confirmation" class="modal fade" tabindex="-1" role="dialog"><!--modal-->
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close"   data-dismiss="modal" aria-hidden="true">x</button>
                <h4 class="modal-title"><span id="modal_mode"> </span><i class="fa fa-trash red"></i> Confirm Deletion</h4>
            </div>
            <div class="modal-body">
                <center>
                    <p id="modal-body-message" style="font-size: 12pt!important;font-family: calibri;">
                            Remove DTR of <employeename id="employeename"></employeename>?
                    </p>
                </center>
            </div>
            <div class="modal-footer">
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-6">
                            <button id="btn_yes" style="width: 100%;" type="button" class="btn btn-default btn-save" data-dismiss="modal">   <i class="fa fa-check-circle"></i> Yes
                            </button>
                        </div>
                        <div class="col-md-6">
                            <button id="btn_close" style="width: 100%;" type="button" class="btn btn-default btn-close" data-dismiss="modal">
                                <i class="fa fa-times-circle"></i> No
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="modal_refresh_confirmation" class="modal fade" tabindex="-1" role="dialog"><!--modal-->
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close"   data-dismiss="modal" aria-hidden="true">x</button>
                <h4 class="modal-title"><span id="modal_mode"> </span>
                    <center>
                        <i class="fa fa-refresh"></i> Confirm
                    </center>
                </h4>
            </div>
            <div class="modal-body">
                <center>
                    <p id="modal-body-message" style="font-size: 12pt!important;font-family: calibri;">
                            Refresh Daily Time Record Table?
                    </p>
                </center>
            </div>
            <div class="modal-footer">
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-6">
                            <button id="btn_refresh_yes" style="width: 100%;" type="button" class="btn btn-default btn-save" data-dismiss="modal">   <i class="fa fa-check-circle"></i> Yes
                            </button>
                        </div>
                        <div class="col-md-6">
                            <button id="btn_close" style="width: 100%;" type="button" class="btn btn-default btn-close" data-dismiss="modal">
                                <i class="fa fa-times-circle"></i> No
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="modal_process_payroll_confirmation" class="modal fade" tabindex="-1" role="dialog"><!--modal-->
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close"   data-dismiss="modal" aria-hidden="true">x</button>
                <h4 class="modal-title"><span id="modal_mode"> </span>
                    <center>
                        Confirm Process Payroll
                    </center>
                </h4>
            </div>
            <div class="modal-body">
                <center>
                    <p id="modal-body-message" style="font-size: 12pt!important;font-family: calibri;">
                            Are you sure to process payroll of <payperiod id="payperiodmodal"></payperiod> for 
                            <branchname id="branchname"></branchname> in 
                            <departmentname id="departmentname"></departmentname>?
                    </p>
                </center>
            </div>
            <div class="modal-footer">
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-6">
                            <button id="btn_process_payroll_yes" style="width: 100%;" type="button" class="btn btn-default btn-save" data-dismiss="modal">   <i class="fa fa-check-circle"></i> Yes
                            </button>
                        </div>
                        <div class="col-md-6">
                            <button id="btn_close" style="width: 100%;" type="button" class="btn btn-default btn-close" data-dismiss="modal">
                                <i class="fa fa-times-circle"></i> No
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php echo $_rights; ?>
<script>

$(document).ready(function(){
    var dt,
        _txnMode,
        _txnModeRate,
        _selectedID,
        _selectedDateCovered,
        _selectedYear,
        _periodstart,
        _periodend,
        _selectedIDDepartment="all",
        _selectedIDBranch="all",
        _selectedemprate,
        _selectedEmpget,
        _pusheddata,
        _selectRowObj,
        _selectRowObjdtr,
        _selectedIDdtr,
        _pay_period_sequence,
        _yearfilter,
        _payperiodfilter,
        _departmentfilter,
        _selectedpayperiod,
        _payperiod,
        _department,
        _dtr_id,
        _payperiodID,
        _employeeID,
        d = new Date();

  var wtax_deduction = 0;

  var oTableItems={
        no_of_hrs : 'td:eq(4)',
        per_day_pay : 'td:eq(5)',
        salary_reg_rates : 'td:eq(6)',
        basic_pay_total : 'td:eq(7)',
        overtime : 'td:eq(8)',
        holiday_pay : 'td:eq(9)',
        allowance_pay : 'td:eq(10)',
        commission : 'td:eq(11)',
        undertime : 'td:eq(12)',
        late : 'td:eq(13)',
        undertime_amt : 'td:eq(14)',
        late_amt : 'td:eq(15)',
        adjustment_additional : 'td:eq(16)',
        adjustment_deduction : 'td:eq(17)',
        gross_total : 'td:eq(18)',
        sss_deduction : 'td:eq(19)',
        philhealth_deduction : 'td:eq(20)',
        pagibig_deduction : 'td:eq(21)',
        wtax_deduction : 'td:eq(22)',
        sss_loan : 'td:eq(23)',
        pagibig_loan : 'td:eq(24)',
        cash_advance : 'td:eq(25)',
        net_total : 'td:eq(26)'
    };

    var oTableOT={
        reg_ot : 'td:eq(2)',
        sun_ot : 'td:eq(3)',
        reg_hol_ot : 'td:eq(4)',
        sun_reg_hol_ot : 'td:eq(5)',
        spe_hol_ot : 'td:eq(6)',
        sun_spe_hol_ot : 'td:eq(7)',
        overtime_total : 'td:eq(8)'
    };

    var oTableHol={
        reg_hol : 'td:eq(2)',
        sun_reg_hol : 'td:eq(3)',
        spe_hol : 'td:eq(4)',
        sun_spe_hol : 'td:eq(5)',
        holiday_total : 'td:eq(6)'
    };

    $('#loader').hide();

    _yearfilter=$("#year").select2({
        placeholder: "[ Select Year ]",
        allowClear: false
    });

    _payperiodfilter=$("#payperiod").select2({
        placeholder: "[ Select Pay Period ]",
        allowClear: false
    });

    _departmentfilter=$("#department").select2({
        placeholder: "[ Select Department ]",
        allowClear: false
    });

    _departmentfilter.select2('val', '');

    _branchfilter=$("#branch").select2({
        placeholder: "[ Select Branch ]",
        allowClear: false
    });

    _branchfilter.select2('val', '');

    var _payperiod = $('#payperiod').val()
    var _branch = $('#branch').val();
    var _department = $('#department').val();

    var getpayperiod=function(){
        var _data=$('#').serializeArray();
        _data.push({name : "year" ,value : _selectedYear});
        return $.ajax({
            "dataType":"json",
            "type":"POST",
            "url":"RefPayPeriodSetup/transaction/getpayperiod",
            "data":_data
        });
    };

    var getpayperiodfilters = function(){
         _selectedYear=$('#year').val();
        getpayperiod().done(function(response){
                    var show2select="";
                    if(response.data.length==0){
                        $('#payperiod').html("<option value='0'>No Result</option>");
                        return;
                    }
                    var jsoncount=response.data.length-1;
                     for(var i=0;parseInt(jsoncount)>=i;i++){
                        show2select+="<option value='"+response.data[i].pay_period_id+"'>"+response.data[i].pay_period_start+" ~ "+response.data[i].pay_period_end+"</option>";
                     }
                     $('#payperiod').html(show2select);
                }).always(function(){
                    $.unblockUI();
                });
    };

    var initializeTables=function(){

        var _year = $('#year').val();
        var _payperiod = $('#payperiod').val();
        var _branch = $('#branch').val();
        var _department = $('#department').val();

         dt=$('#tbl_dtr').DataTable({
            "dom": '<"toolbar">frtip', 
            "bPaginate": false,
            "bInfo" : false,            
            "bFilter" : false,
            "ajax": {
            "url": "DailyTimeRecord/transaction/list",
            "type": "POST",
            "data": function ( d ) {
                return $.extend( {}, d, {
                    "year": _year,
                    "payperiod": _payperiod,
                    "branch": _branch,
                    "department": _department
                    });
                }
            },
            "columns": [
                { targets:[0],data: null,
                    render: function (data, type, full, meta){
                        return '<center><i class="fa fa-trash btn_remove" style="color: red;"></i></center>';
                    }
                },
                { targets:[1],data: null,
                    render: function (data, type, full, meta){
                        if (data.process_type == 'dtr_process'){
                            if (data.is_processed == 1){
                                return '<input type="hidden" value='+data.employee_id+' name="dtr_employee_id[]"></input><center><input class="chckbx_processed process" type="checkbox" name="is_processed[]" id="is_processed" checked></center>';
                            }else{
                                return '<input type="hidden" value='+data.employee_id+' name="dtr_employee_id[]"></input><center><input class="chckbx_processed process" type="checkbox" name="is_processed[]" id="is_processed"></center>';
                            }
                        }else if (data.process_type == 'emp_process'){
                            return '<input type="hidden" value='+data.employee_id+' name="dtr_employee_id[]"></input><center><input class="chckbx_processed process" type="checkbox" name="is_processed[]" id="is_processed" checked></center>';
                        }
                    }
                },
                { targets:[2],data: "ecode" },
                { targets:[3],data: null,
                    render: function (data, type, full, meta){
                        return '<input type="text" class="ename" value="'+data.full_name+'" class="form-control" readonly>';
                    }
                },
                { targets:[4],data: "no_of_hrs",
                    render: function (data, type, full, meta){
                        if (data != 'null'){
                            return "<input type='text' name='no_of_hrs[]' id='no_of_hrs' class='numeric form-control' value='"+data+"'></input>";
                        }else{
                            return "<input type='text' name='no_of_hrs[]' id='no_of_hrs' class='numeric form-control'></input>";
                        }
                    }
                },
                { targets:[5],data: "per_day_pay",
                    render: function (data, type, full, meta){
                        if (data != 'null'){
                            return "<input type='text' name='per_day_pay[]' id='per_day_pay' class='right numeric form-control' value='"+data+"' readonly></input>";
                        }else{
                            return "<input type='text' name='per_day_pay[]' id='per_day_pay' class='right numeric form-control' readonly></input>";
                        }
                    }
                },                
                { targets:[6],data: "salary_reg_rates",
                    render: function (data, type, full, meta){
                        if (data != 'null'){
                            return "<input type='text' name='salary_reg_rates[]' id='salary_reg_rates' class='right numeric form-control' value='"+data+"' readonly></input>";
                        }else{
                            return "<input type='text' name='salary_reg_rates[]' id='salary_reg_rates' class='right numeric form-control' readonly></input>";
                        }
                    }
                },
                { targets:[7],data: "basic_pay_total",
                    render: function (data, type, full, meta){
                        if (data != 'null'){
                            return "<input type='text' name='basic_pay_total[]' id='basic_pay_total' class='right numeric form-control' value='"+data+"' readonly></input>";
                        }else{
                            return "<input type='text' name='basic_pay_total[]' id='basic_pay_total' class='right numeric form-control' readonly></input>";
                        }
                    }
                },
                { targets:[8],data: null,
                    render: function (data, type, full, meta){
                        if (data.overtime != 'null'){
                            return "<input type='text' name='overtime[]' id='overtime_"+data.employee_id+"' class='right numeric form-control' value='"+data.overtime+"'></input>";
                        }else{
                            return "<input type='text' name='overtime[]' id='overtime_"+data.employee_id+"' class='right numeric form-control'></input>";
                        }
                    }
                },
                { targets:[9],data: null,
                    render: function (data, type, full, meta){
                        if (data.holiday_pay != 'null'){
                            return "<input type='text' name='holiday_pay[]' id='holiday_pay_"+data.employee_id+"' class='right numeric form-control' value='"+data.holiday_pay+"'></input>";
                        }else{
                            return "<input type='text' name='holiday_pay[]' id='holiday_pay_"+data.employee_id+"' class='right numeric form-control'></input>";
                        }
                    }
                },
                { targets:[10],data: "allowance_pay",
                    render: function (data, type, full, meta){
                        if (data != 'null'){
                            return "<input type='text' name='allowance_pay[]' id='allowance_pay' class='right numeric form-control' value='"+data+"' readonly></input>";
                        }else{
                            return "<input type='text' name='allowance_pay[]' id='allowance_pay' class='right numeric form-control' readonly></input>";
                        }
                    }
                },
                { targets:[11],data: "commission",
                    render: function (data, type, full, meta){
                        if (data != 'null'){
                            return "<input type='text' name='commission[]' id='commission' class='right numeric form-control' value='"+data+"'></input>";
                        }else{
                            return "<input type='text' name='commission[]' id='commission' class='right numeric form-control'></input>";
                        }
                    }
                },
                { targets:[12],data: "undertime",
                    render: function (data, type, full, meta){
                        if (data != 'null'){
                            return "<input type='text' name='undertime[]' id='undertime' class='numeric form-control' value='"+data+"'></input>";
                        }else{
                            return "<input type='text' name='undertime[]' id='undertime' class='numeric form-control'></input>";
                        }
                    }
                },
                { targets:[13],data: "late",
                    render: function (data, type, full, meta){
                        if (data != 'null'){
                            return "<input type='text' name='late[]' id='late' class='numeric form-control' value='"+data+"'></input>";
                        }else{
                            return "<input type='text' name='late[]' id='late' class='numeric form-control'></input>";
                        }
                    }
                },
                { targets:[14],data: "undertime_amt",
                    render: function (data, type, full, meta){
                        if (data != 'null'){
                            return "<input type='text' name='undertime_amt[]' id='undertime_amt' class='right numeric form-control' value='"+data+"' readonly></input>";
                        }else{
                            return "<input type='text' name='undertime_amt[]' id='undertime_amt' class='right numeric form-control' readonly></input>";
                        }
                    }
                },
                { targets:[15],data: "late_amt",
                    render: function (data, type, full, meta){
                        if (data != 'null'){
                            return "<input type='text' name='late_amt[]' id='late_amt' class='right numeric form-control' value='"+data+"' readonly></input>";
                        }else{
                            return "<input type='text' name='late_amt[]' id='late_amt' class='right numeric form-control' readonly></input>";
                        }
                    }
                },
                { targets:[16],data: "adjustment_additional",
                    render: function (data, type, full, meta){
                        if (data != 'null'){
                            return "<input type='text' name='adjustment_additional[]' id='adjustment_additional' class='right numeric form-control' value='"+data+"'></input>";
                        }else{
                            return "<input type='text' name='adjustment_additional[]' id='adjustment_additional' class='right numeric form-control'></input>";
                        }
                    }
                },
                { targets:[17],data: "adjustment_deduction",
                    render: function (data, type, full, meta){
                        if (data != 'null'){
                            return "<input type='text' name='adjustment_deduction[]' id='adjustment_deduction' class='right numeric form-control' value='"+data+"'></input>";
                        }else{
                            return "<input type='text' name='adjustment_deduction[]' id='adjustment_deduction' class='right numeric form-control'></input>";
                        }
                    }
                },
                { targets:[18],data: "gross_total",
                    render: function (data, type, full, meta){
                        if (data != 'null'){
                            return "<input type='text' name='gross_total[]' id='gross_total' class='right numeric form-control' value='"+data+"' readonly></input>";
                        }else{
                            return "<input type='text' name='gross_total[]' id='gross_total' class='right numeric form-control' readonly></input>";
                        }
                    }
                },
                { targets:[19],data: null,
                    render: function (data, type, full, meta){
                        if (data != 'null'){
                            return "<input type='text' name='sss_deduction[]' id='sss_deduction' class='right deduction form-control' value='"+data.sss_deduction+"' readonly></input><input type='hidden' name='sss_employer[]' id='sss_employer' value='"+data.sss_employer+"'><input type='hidden' name='sss_employer_contribution[]' id='sss_employer_contribution' value='"+data.sss_employer_contribution+"'>";
                        }else{
                            return "<input type='text' name='sss_deduction[]' id='sss_deduction' class='right deduction form-control' readonly></input><input type='hidden' name='sss_employer[]' id='sss_employer'><input type='hidden' name='sss_employer_contribution[]' id='sss_employer_contribution'>";
                        }
                    }
                },
                { targets:[20],data: null, 
                    render: function (data, type, full, meta){
                        if (data != 'null'){
                            return "<input type='text' name='philhealth_deduction[]' id='philhealth_deduction' class='right deduction form-control' value='"+data.philhealth_deduction+"' readonly></input><input type='hidden' name='philhealth_employer[]' id='philhealth_employer' value='"+data.philhealth_deduction+"'>";
                        }else{
                            return "<input type='text' name='philhealth_deduction[]' id='philhealth_deduction' class='right deduction form-control' readonly></input><input type='hidden' name='philhealth_employer[]' id='philhealth_employer'>";
                        }
                    }
                },
                { targets:[21],data: "pagibig_deduction",
                    render: function (data, type, full, meta){
                        if (data != 'null'){
                            return "<input type='text' name='pagibig_deduction[]' id='pagibig_deduction' class='right deduction form-control' value='"+data+"' readonly></input>";
                        }else{
                            return "<input type='text' name='pagibig_deduction[]' id='pagibig_deduction' class='right deduction form-control' readonly></input>";
                        }
                    }
                },
                { targets:[22],data: "wtax_deduction", 
                    render: function (data, type, full, meta){
                        if (data != 'null'){
                            return "<input type='text' name='wtax_deduction[]' id='wtax_deduction' class='right deduction form-control' value='"+data+"' readonly></input>";
                        }else{
                            return "<input type='text' name='wtax_deduction[]' id='wtax_deduction' class='right deduction form-control' readonly></input>";
                        }
                    }
                },
                { targets:[23],data: null, 
                    render: function (data, type, full, meta){
                        if (data != 'null'){
                            return "<input type='text' name='sss_loan[]' id='sss_loan' class='right numeric form-control' value='"+data.sss_loan+"'></input><input type='hidden' name='sss_loan_id[]' id='sss_loan_id' value='"+data.sss_loan_id+"'>";
                        }else{
                            return "<input type='text' name='sss_loan[]' id='sss_loan' class='right numeric form-control'></input><input type='hidden' name='sss_loan_id[]' id='sss_loan_id'>";
                        }
                    }
                },
                { targets:[24],data: null, 
                    render: function (data, type, full, meta){
                        if (data != 'null'){
                            return "<input type='text' name='pagibig_loan[]' id='pagibig_loan' class='right numeric form-control' value='"+data.pagibig_loan+"'></input><input type='hidden' name='pagibig_loan_id[]' id='pagibig_loan_id' value='"+data.pagibig_loan_id+"'>";
                        }else{
                            return "<input type='text' name='pagibig_loan[]' id='pagibig_loan' class='right numeric form-control'></input><input type='hidden' name='pagibig_loan_id[]' id='pagibig_loan_id'>";
                        }
                    }
                },
                { targets:[25],data: null, 
                    render: function (data, type, full, meta){
                        if (data != 'null'){
                            return "<input type='text' name='cash_advance[]' id='cash_advance' class='right numeric form-control' value='"+data.cash_advance+"'></input><input type='hidden' name='cash_advance_id[]' id='cash_advance_id' value='"+data.cash_advance_id+"'>";
                        }else{
                            return "<input type='text' name='cash_advance[]' id='cash_advance' class='right numeric form-control'></input><input type='hidden' name='cash_advance_id[]' id='cash_advance_id'>";
                        }
                    }
                },
                { targets:[26],data: "net_total",
                    render: function (data, type, full, meta){
                        if (data != 'null'){
                            return "<input type='text' name='net_total[]' id='net_total' class='right numeric form-control' value='"+data+"' readonly></input>";
                        }else{
                            return "<input type='text' name='net_total[]' id='net_total' class='right numeric form-control' readonly></input>";
                        }
                    }
                },
            ],
            language: {
                         searchPlaceholder: "Search Daily Time Record"
                     },
            "rowCallback":function( row, data, index ){

            }
        });

        dt_overtime=$('#tbl_ot').DataTable({
            "dom": '<"toolbar">frtip', 
            "bPaginate": false,
            "bInfo" : false,            
            "bFilter": false,
            "ajax": {
            "url": "DailyTimeRecord/transaction/ot_list",
            "type": "POST",
            "data": function ( d ) {
                return $.extend( {}, d, {
                    "year": _year,
                    "payperiod": _payperiod,
                    "branch": _branch,
                    "department": _department
                    });
                }
            },
            "columns": [
                { targets:[0],data: null,
                    render: function (data, type, full, meta){
                        return data.ecode+' <input type="hidden" value='+data.employee_id+' name="ot_employee_id[]"></input>';
                    }
                },
                { targets:[1],data: "full_name" },
                { targets:[2],data: null,
                    render: function (data, type, full, meta){
                        if (data.reg_ot != 'null'){
                            return "<input type='text' name='reg_ot[]' id='reg_ot' class='numeric form-control' value='"+data.reg_ot+"'></input><input type='hidden' value="+data.reg_ot_amt+" name='reg_ot_amt[]' id='reg_ot_amt_"+data.employee_id+"'></input>";
                        }else{
                            return "<input type='text' name='reg_ot[]' id='reg_ot' class='numeric form-control'></input><input type='hidden' name='reg_ot_amt[]' id='reg_ot_amt_"+data.employee_id+"'></input>";
                        }
                    }
                },
                { targets:[3],data: null,
                    render: function (data, type, full, meta){
                        if (data.sun_ot != 'null'){
                            return "<input type='text' name='sun_ot[]' id='sun_ot' class='numeric form-control' value='"+data.sun_ot+"'></input><input type='hidden' value="+data.sun_ot_amt+" name='sun_ot_amt[]' id='sun_ot_amt_"+data.employee_id+"'></input>";
                        }else{
                            return "<input type='text' name='sun_ot[]' id='sun_ot' class='numeric form-control'></input><input type='hidden' name='sun_ot_amt[]' id='sun_ot_amt_"+data.employee_id+"'></input>";
                        }
                    }
                },
                { targets:[4],data: null,
                    render: function (data, type, full, meta){
                        if (data.reg_hol_ot != 'null'){
                            return "<input type='text' name='reg_hol_ot[]' id='reg_hol_ot' class='numeric form-control' value='"+data.reg_hol_ot+"'></input><input type='hidden' value="+data.reg_hol_ot_amt+" name='reg_hol_ot_amt[]' id='reg_hol_ot_amt_"+data.employee_id+"'></input>";
                        }else{
                            return "<input type='text' name='reg_hol_ot[]' id='reg_hol_ot' class='numeric form-control'></input><input type='hidden' name='reg_hol_ot_amt[]' id='reg_hol_ot_amt_"+data.employee_id+"'></input>";
                        }
                    }
                },
                { targets:[5],data: null,
                    render: function (data, type, full, meta){
                        if (data.sun_reg_hol_ot != 'null'){
                            return "<input type='text' name='sun_reg_hol_ot[]' id='sun_reg_hol_ot' class='numeric form-control' value='"+data.sun_reg_hol_ot+"'></input><input type='hidden' value="+data.sun_reg_hol_ot_amt+" name='sun_reg_hol_ot_amt[]' id='sun_reg_hol_ot_amt_"+data.employee_id+"'></input>";
                        }else{
                            return "<input type='text' name='sun_reg_hol_ot[]' id='sun_reg_hol_ot' class='numeric form-control'></input><input type='hidden' name='sun_reg_hol_ot_amt[]' id='sun_reg_hol_ot_amt_"+data.employee_id+"'></input>";
                        }
                    }
                },
                { targets:[6],data: null,
                    render: function (data, type, full, meta){
                        if (data.spe_hol_ot != 'null'){
                            return "<input type='text' name='spe_hol_ot[]' id='spe_hol_ot' class='numeric form-control' value='"+data.spe_hol_ot+"'></input><input type='hidden' name='spe_hol_ot_amt[]' value="+data.spe_hol_ot_amt+" id='spe_hol_ot_amt_"+data.employee_id+"'></input>";
                        }else{
                            return "<input type='text' name='spe_hol_ot[]' id='spe_hol_ot' class='numeric form-control'></input><input type='hidden' name='spe_hol_ot_amt[]' id='spe_hol_ot_amt_"+data.employee_id+"'></input>";
                        }
                    }
                },
                { targets:[7],data: null,
                    render: function (data, type, full, meta){
                        if (data.sun_spe_hol_ot != 'null'){
                            return "<input type='text' name='sun_spe_hol_ot[]' id='sun_spe_hol_ot' class='numeric form-control' value='"+data.sun_spe_hol_ot+"'></input><input type='hidden' value="+data.sun_spe_hol_ot_amt+" name='sun_spe_hol_ot_amt[]' id='sun_spe_hol_ot_amt_"+data.employee_id+"'></input>";
                        }else{
                            return "<input type='text' name='sun_spe_hol_ot[]' id='sun_spe_hol_ot' class='numeric form-control'></input><input type='hidden' name='sun_spe_hol_ot_amt[]' id='sun_spe_hol_ot_amt_"+data.employee_id+"'>";
                        }
                    }
                },
                { targets:[8],data: "overtime_total",
                    render: function (data, type, full, meta){
                        if (data != 'null'){
                            return "<input type='text' name='overtime_total[]' id='overtime_total' class='right numeric form-control' value='"+data+"' readonly></input>";
                        }else{
                            return "<input type='text' name='overtime_total[]' id='overtime_total' class='right numeric form-control' readonly></input>";
                        }
                    }
                },
            ],
            language: {
                         searchPlaceholder: "Search Employee"
                     },
            "rowCallback":function( row, data, index ){
            }
        });

        dt_holiday=$('#tbl_holiday').DataTable({
            "dom": '<"toolbar">frtip', 
            "bPaginate": false,
            "bInfo" : false,            
            "bFilter": false,
            "ajax": {
            "url": "DailyTimeRecord/transaction/holiday_pay_list",
            "type": "POST",
            "data": function ( d ) {
                return $.extend( {}, d, {
                    "year": _year,
                    "payperiod": _payperiod,
                    "branch": _branch,
                    "department": _department
                    });
                }
            },
            "columns": [
                { targets:[0],data: null,
                    render: function (data, type, full, meta){
                        return data.ecode+' <input type="hidden" value='+data.employee_id+' name="hol_employee_id[]"></input>';
                    }
                },
                { targets:[1],data: "full_name" },
                { targets:[2],data: null,
                    render: function (data, type, full, meta){
                        if (data.reg_hol != 'null'){
                            return "<input type='text' name='reg_hol[]' id='reg_hol' class='numeric form-control' value='"+data.reg_hol+"'></input><input type='hidden' name='reg_hol_amt[]' value="+data.reg_hol_amt+" id='reg_hol_amt_"+data.employee_id+"'></input>";
                        }else{
                            return "<input type='text' name='reg_hol[]' id='reg_hol' class='numeric form-control'></input><input type='hidden' name='reg_hol_amt[]' id='reg_hol_amt_"+data.employee_id+"'></input>";
                        }
                    }
                },
                { targets:[3],data: null,
                    render: function (data, type, full, meta){
                        if (data.sun_reg_hol != 'null'){
                            return "<input type='text' name='sun_reg_hol[]' id='sun_reg_hol' class='numeric form-control' value='"+data.sun_reg_hol+"'></input><input type='hidden' value="+data.sun_reg_hol_amt+" name='sun_reg_hol_amt[]' id='sun_reg_hol_amt_"+data.employee_id+"'></input>";
                        }else{
                            return "<input type='text' name='sun_reg_hol[]' id='sun_reg_hol' class='numeric form-control'></input><input type='hidden' name='sun_reg_hol_amt[]' id='sun_reg_hol_amt_"+data.employee_id+"'></input>";
                        }
                    }
                },
                { targets:[4],data: null,
                    render: function (data, type, full, meta){
                        if (data.spe_hol != 'null'){
                            return "<input type='text' name='spe_hol[]' id='spe_hol' class='numeric form-control' value='"+data.spe_hol+"'></input><input type='hidden' value="+data.spe_hol_amt+" name='spe_hol_amt[]' id='spe_hol_amt_"+data.employee_id+"'></input>";
                        }else{
                            return "<input type='text' name='spe_hol[]' id='spe_hol' class='numeric form-control'></input><input type='hidden' name='spe_hol_amt[]' id='spe_hol_amt'></input>";
                        }
                    }
                },
                { targets:[5],data: null,
                    render: function (data, type, full, meta){
                        if (data.sun_spe_hol != 'null'){
                            return "<input type='text' name='sun_spe_hol[]' id='sun_spe_hol' class='numeric form-control' value='"+data.sun_spe_hol+"'></input><input type='hidden' value="+data.sun_spe_hol_amt+" name='sun_spe_hol_amt[]' id='sun_spe_hol_amt_"+data.employee_id+"'></input>";
                        }else{
                            return "<input type='text' name='sun_spe_hol[]' id='sun_spe_hol' class='numeric form-control'></input><input type='hidden' name='sun_spe_hol_amt[]' id='sun_spe_hol_amt_"+data.employee_id+"'></input>";
                        }
                    }
                },
                { targets:[6],data: "holiday_total",
                    render: function (data, type, full, meta){
                        if (data != 'null'){
                            return "<input type='text' name='holiday_total[]' id='holiday_total' class='right numeric form-control' value='"+data+"' readonly>";
                        }else{
                            return "<input type='text' name='holiday_total[]' id='holiday_total' class='right numeric form-control' readonly></input>";
                        }
                    }
                },
            ],
            language: {
                         searchPlaceholder: "Search Employee"
                     },
            "rowCallback":function( row, data, index ){
            }
        });
    }


    var initializeEmpTables=function(_year,_payperiod,_department){

        dt_overtime=$('#tbl_ot').DataTable({
            "dom": '<"toolbar">frtip', 
            "bPaginate": false,
            "bInfo" : false,            
            "bFilter": false,
            "ajax": {
            "url": "DailyTimeRecord/transaction/ot_list",
            "type": "POST",
            "data": function ( d ) {
                return $.extend( {}, d, {
                    "year": _year,
                    "payperiod": _payperiod,
                    "branch": _branch,
                    "department": _department
                    });
                }
            },
            "columns": [
                { targets:[0],data: null,
                    render: function (data, type, full, meta){
                        return data.ecode+' <input type="hidden" value='+data.employee_id+' name="ot_employee_id[]"></input>';
                    }
                },
                { targets:[1],data: "full_name" },
                { targets:[2],data: null,
                    render: function (data, type, full, meta){
                        if (data.reg_ot != 'null'){
                            return "<input type='text' name='reg_ot[]' id='reg_ot' class='numeric form-control' value='"+data.reg_ot+"'></input><input type='hidden' value="+data.reg_ot_amt+" name='reg_ot_amt[]' id='reg_ot_amt_"+data.employee_id+"'></input>";
                        }else{
                            return "<input type='text' name='reg_ot[]' id='reg_ot' class='numeric form-control'></input><input type='hidden' name='reg_ot_amt[]' id='reg_ot_amt_"+data.employee_id+"'></input>";
                        }
                    }
                },
                { targets:[3],data: null,
                    render: function (data, type, full, meta){
                        if (data.sun_ot != 'null'){
                            return "<input type='text' name='sun_ot[]' id='sun_ot' class='numeric form-control' value='"+data.sun_ot+"'></input><input type='hidden' value="+data.sun_ot_amt+" name='sun_ot_amt[]' id='sun_ot_amt_"+data.employee_id+"'></input>";
                        }else{
                            return "<input type='text' name='sun_ot[]' id='sun_ot' class='numeric form-control'></input><input type='hidden' name='sun_ot_amt[]' id='sun_ot_amt_"+data.employee_id+"'></input>";
                        }
                    }
                },
                { targets:[4],data: null,
                    render: function (data, type, full, meta){
                        if (data.reg_hol_ot != 'null'){
                            return "<input type='text' name='reg_hol_ot[]' id='reg_hol_ot' class='numeric form-control' value='"+data.reg_hol_ot+"'></input><input type='hidden' value="+data.reg_hol_ot_amt+" name='reg_hol_ot_amt[]' id='reg_hol_ot_amt_"+data.employee_id+"'></input>";
                        }else{
                            return "<input type='text' name='reg_hol_ot[]' id='reg_hol_ot' class='numeric form-control'></input><input type='hidden' name='reg_hol_ot_amt[]' id='reg_hol_ot_amt_"+data.employee_id+"'></input>";
                        }
                    }
                },
                { targets:[5],data: null,
                    render: function (data, type, full, meta){
                        if (data.sun_reg_hol_ot != 'null'){
                            return "<input type='text' name='sun_reg_hol_ot[]' id='sun_reg_hol_ot' class='numeric form-control' value='"+data.sun_reg_hol_ot+"'></input><input type='hidden' value="+data.sun_reg_hol_ot_amt+" name='sun_reg_hol_ot_amt[]' id='sun_reg_hol_ot_amt_"+data.employee_id+"'></input>";
                        }else{
                            return "<input type='text' name='sun_reg_hol_ot[]' id='sun_reg_hol_ot' class='numeric form-control'></input><input type='hidden' name='sun_reg_hol_ot_amt[]' id='sun_reg_hol_ot_amt_"+data.employee_id+"'></input>";
                        }
                    }
                },
                { targets:[6],data: null,
                    render: function (data, type, full, meta){
                        if (data.spe_hol_ot != 'null'){
                            return "<input type='text' name='spe_hol_ot[]' id='spe_hol_ot' class='numeric form-control' value='"+data.spe_hol_ot+"'></input><input type='hidden' name='spe_hol_ot_amt[]' value="+data.spe_hol_ot_amt+" id='spe_hol_ot_amt_"+data.employee_id+"'></input>";
                        }else{
                            return "<input type='text' name='spe_hol_ot[]' id='spe_hol_ot' class='numeric form-control'></input><input type='hidden' name='spe_hol_ot_amt[]' id='spe_hol_ot_amt_"+data.employee_id+"'></input>";
                        }
                    }
                },
                { targets:[7],data: null,
                    render: function (data, type, full, meta){
                        if (data.sun_spe_hol_ot != 'null'){
                            return "<input type='text' name='sun_spe_hol_ot[]' id='sun_spe_hol_ot' class='numeric form-control' value='"+data.sun_spe_hol_ot+"'></input><input type='hidden' value="+data.sun_spe_hol_ot_amt+" name='sun_spe_hol_ot_amt[]' id='sun_spe_hol_ot_amt_"+data.employee_id+"'></input>";
                        }else{
                            return "<input type='text' name='sun_spe_hol_ot[]' id='sun_spe_hol_ot' class='numeric form-control'></input><input type='hidden' name='sun_spe_hol_ot_amt[]' id='sun_spe_hol_ot_amt_"+data.employee_id+"'>";
                        }
                    }
                },
                { targets:[8],data: "overtime_total",
                    render: function (data, type, full, meta){
                        if (data != 'null'){
                            return "<input type='text' name='overtime_total[]' id='overtime_total' class='right numeric form-control' value='"+data+"' readonly></input>";
                        }else{
                            return "<input type='text' name='overtime_total[]' id='overtime_total' class='right numeric form-control' readonly></input>";
                        }
                    }
                },
            ],
            language: {
                         searchPlaceholder: "Search Employee"
                     },
            "rowCallback":function( row, data, index ){
            }
        });

        dt_holiday=$('#tbl_holiday').DataTable({
            "dom": '<"toolbar">frtip', 
            "bPaginate": false,
            "bInfo" : false,            
            "bFilter": false,
            "ajax": {
            "url": "DailyTimeRecord/transaction/holiday_pay_list",
            "type": "POST",
            "data": function ( d ) {
                return $.extend( {}, d, {
                    "year": _year,
                    "payperiod": _payperiod,
                    "branch": _branch,
                    "department": _department
                    });
                }
            },
            "columns": [
                { targets:[0],data: null,
                    render: function (data, type, full, meta){
                        return data.ecode+' <input type="hidden" value='+data.employee_id+' name="hol_employee_id[]"></input>';
                    }
                },
                { targets:[1],data: "full_name" },
                { targets:[2],data: null,
                    render: function (data, type, full, meta){
                        if (data.reg_hol != 'null'){
                            return "<input type='text' name='reg_hol[]' id='reg_hol' class='numeric form-control' value='"+data.reg_hol+"'></input><input type='hidden' name='reg_hol_amt[]' value="+data.reg_hol_amt+" id='reg_hol_amt_"+data.employee_id+"'></input>";
                        }else{
                            return "<input type='text' name='reg_hol[]' id='reg_hol' class='numeric form-control'></input><input type='hidden' name='reg_hol_amt[]' id='reg_hol_amt_"+data.employee_id+"'></input>";
                        }
                    }
                },
                { targets:[3],data: null,
                    render: function (data, type, full, meta){
                        if (data.sun_reg_hol != 'null'){
                            return "<input type='text' name='sun_reg_hol[]' id='sun_reg_hol' class='numeric form-control' value='"+data.sun_reg_hol+"'></input><input type='hidden' value="+data.sun_reg_hol_amt+" name='sun_reg_hol_amt[]' id='sun_reg_hol_amt_"+data.employee_id+"'></input>";
                        }else{
                            return "<input type='text' name='sun_reg_hol[]' id='sun_reg_hol' class='numeric form-control'></input><input type='hidden' name='sun_reg_hol_amt[]' id='sun_reg_hol_amt_"+data.employee_id+"'></input>";
                        }
                    }
                },
                { targets:[4],data: null,
                    render: function (data, type, full, meta){
                        if (data.spe_hol != 'null'){
                            return "<input type='text' name='spe_hol[]' id='spe_hol' class='numeric form-control' value='"+data.spe_hol+"'></input><input type='hidden' value="+data.spe_hol_amt+" name='spe_hol_amt[]' id='spe_hol_amt_"+data.employee_id+"'></input>";
                        }else{
                            return "<input type='text' name='spe_hol[]' id='spe_hol' class='numeric form-control'></input><input type='hidden' name='spe_hol_amt[]' id='spe_hol_amt'></input>";
                        }
                    }
                },
                { targets:[5],data: null,
                    render: function (data, type, full, meta){
                        if (data.sun_spe_hol != 'null'){
                            return "<input type='text' name='sun_spe_hol[]' id='sun_spe_hol' class='numeric form-control' value='"+data.sun_spe_hol+"'></input><input type='hidden' value="+data.sun_spe_hol_amt+" name='sun_spe_hol_amt[]' id='sun_spe_hol_amt_"+data.employee_id+"'></input>";
                        }else{
                            return "<input type='text' name='sun_spe_hol[]' id='sun_spe_hol' class='numeric form-control'></input><input type='hidden' name='sun_spe_hol_amt[]' id='sun_spe_hol_amt_"+data.employee_id+"'></input>";
                        }
                    }
                },
                { targets:[6],data: "holiday_total",
                    render: function (data, type, full, meta){
                        if (data != 'null'){
                            return "<input type='text' name='holiday_total[]' id='holiday_total' class='right numeric form-control' value='"+data+"' readonly>";
                        }else{
                            return "<input type='text' name='holiday_total[]' id='holiday_total' class='right numeric form-control' readonly></input>";
                        }
                    }
                },
            ],
            language: {
                         searchPlaceholder: "Search Employee"
                     },
            "rowCallback":function( row, data, index ){
            }
        });
    }

    var initializeRefreshTables=function(_year,_payperiod,_branch,_department){

         dt=$('#tbl_dtr').DataTable({
            "initComplete": function(settings, json){

                    $('.tbl_dtr_panel').hide();
                    $('#loader').show();
                   
                    setTimeout(function(){

                        $('#tbl_dtr > tbody > tr').each(function(){
                            var row=$(this);
                            var data=dt.row(row).data();
                            var monthly_pay = 0;
                            var withholding_lookup = 0;
                            var wtax_deduction;

                            // ## Declaration
                            var no_of_hrs=parseFloat(accounting.unformat(row.find(oTableItems.no_of_hrs).find('input.numeric').val()));
                            var salary_reg_rates=parseFloat(accounting.unformat(row.find(oTableItems.salary_reg_rates).find('input.numeric').val()));
                            var per_hour_pay=parseFloat(accounting.unformat(data.per_hour_pay));
                            var allowance = parseFloat(accounting.unformat(data.allowance));
                            var ref_payfrequency_type_id=data.ref_payfrequency_type_id;
                            var sequence = data.sequence;
                            var count_week = data.count;
                            var monthly_based_salary = parseFloat(accounting.unformat(data.monthly_based_salary));
                            var overtime=parseFloat(accounting.unformat(row.find(oTableItems.overtime).find('input.numeric').val()));
                            var holiday_pay=parseFloat(accounting.unformat(row.find(oTableItems.holiday_pay).find('input.numeric').val()));
                            var commission=parseFloat(accounting.unformat(row.find(oTableItems.commission).find('input.numeric').val()));
                            var undertime = parseFloat(accounting.unformat(row.find(oTableItems.undertime).find('input.numeric').val()));
                            var late = parseFloat(accounting.unformat(row.find(oTableItems.late).find('input.numeric').val()));
                            var adjustment_additional=parseFloat(accounting.unformat(row.find(oTableItems.adjustment_additional).find('input.numeric').val()));
                            var adjustment_deduction=parseFloat(accounting.unformat(row.find(oTableItems.adjustment_deduction).find('input.numeric').val()));
                            var sss_deduction=parseFloat(accounting.unformat(row.find(oTableItems.sss_deduction).find('input.deduction').val()));
                            var philhealth_deduction=parseFloat(accounting.unformat(row.find(oTableItems.philhealth_deduction).find('input.deduction').val()));
                            var pagibig_deduction=parseFloat(accounting.unformat(row.find(oTableItems.pagibig_deduction).find('input.deduction').val()));
                            var sss_loan=parseFloat(accounting.unformat(row.find(oTableItems.sss_loan).find('input.numeric').val()));
                            var pagibig_loan=parseFloat(accounting.unformat(row.find(oTableItems.pagibig_loan).find('input.numeric').val()));
                            var cash_advance=parseFloat(accounting.unformat(row.find(oTableItems.cash_advance).find('input.numeric').val()));

                            // ## Computation
                            var basic_pay_total;

                            if (ref_payfrequency_type_id == 5){
                                if (sequence == 1 || 2 || 3 || 4 || 5){
                                    basic_pay_total = monthly_based_salary / count_week;
                                }else if (sequence == 6 || 7){
                                    basic_pay_total = monthly_based_salary / 2;
                                }else if (sequence == 8){
                                    basic_pay_total = monthly_based_salary;
                                }else{
                                    basic_pay_total = monthly_based_salary;
                                }

                            }else{
                                basic_pay_total = no_of_hrs*per_hour_pay;
                            }
                            var allowance_pay = no_of_hrs*allowance;
                            var undertime_amt = ((undertime/60)*per_hour_pay);
                            var late_amt = ((late/60)*per_hour_pay);

                            var total_undertime_late = 0;
                            total_undertime_late = undertime_amt + late_amt;

                            var gross_total = ((basic_pay_total+overtime+holiday_pay+allowance_pay+commission+adjustment_additional)  - total_undertime_late) - adjustment_deduction;
                            withholding_lookup=gross_total-(sss_deduction+philhealth_deduction+pagibig_deduction);

                            getWTAXDeduction(withholding_lookup,ref_payfrequency_type_id).done(function(response){
                                var rowwtax = response.data[0];
                                var rowlength = response.data.length;

                            if (rowlength > 0){
                                row.find(oTableItems.wtax_deduction).find('input.deduction').val(accounting.formatNumber(rowwtax.wtax_deduction,4));
                            }

                            var wtax_deduction = parseFloat(accounting.unformat(row.find(oTableItems.wtax_deduction).find('input.deduction').val()));
                            var deduction_total = parseFloat(sss_deduction)+parseFloat(philhealth_deduction)+parseFloat(pagibig_deduction)+parseFloat(wtax_deduction)+parseFloat(sss_loan)+parseFloat(pagibig_loan)+parseFloat(cash_advance);
                            var net_total;

                            if (gross_total > deduction_total){ net_total = gross_total-deduction_total; }else{ net_total = 0.00;}

                            // ## Result to Input
                            row.find(oTableItems.basic_pay_total).find('input.numeric').val(accounting.formatNumber(basic_pay_total,2));
                            row.find(oTableItems.allowance_pay).find('input.numeric').val(accounting.formatNumber(allowance_pay,2));    
                            row.find(oTableItems.undertime_amt).find('input.numeric').val(accounting.formatNumber(undertime_amt,2));    
                            row.find(oTableItems.late_amt).find('input.numeric').val(accounting.formatNumber(late_amt,2));    
                            row.find(oTableItems.gross_total).find('input.numeric').val(accounting.formatNumber(gross_total,2));
                            row.find(oTableItems.net_total).find('input.numeric').val(accounting.formatNumber(net_total,2));

                            }).always(function(){
                                $.unblockUI();
                            });
                        });

                    $('#loader').hide();
                    $('.tbl_dtr_panel').show();                        

                    },600);
            },
            "dom": '<"toolbar">frtip', 
            "bPaginate": false,
            "bInfo" : false,            
            "bFilter" : false,
            "ajax": {
            "url": "DailyTimeRecord/transaction/refresh_list",
            "type": "POST",
            "data": function ( d ) {
                return $.extend( {}, d, {
                    "year": _year,
                    "payperiod": _payperiod,
                    "branch": _branch,
                    "department": _department
                    });
                }
            },
            "columns": [
                { targets:[0],data: null,
                    render: function (data, type, full, meta){
                        return '<center><i class="fa fa-trash btn_remove" style="color: red;"></i></center>';
                    }
                },
                { targets:[1],data: null,
                    render: function (data, type, full, meta){
                        if (data.process_type == 'dtr_process'){
                            if (data.is_processed == 1){
                                return '<input type="hidden" value='+data.employee_id+' name="dtr_employee_id[]"></input><center><input class="chckbx_processed process" type="checkbox" name="is_processed[]" id="is_processed"  checked></center>';
                            }else{
                                return '<input type="hidden" value='+data.employee_id+' name="dtr_employee_id[]"></input><center><input class="chckbx_processed process" type="checkbox" name="is_processed[]" id="is_processed"></center>';
                            }
                        }else if (data.process_type == 'emp_process'){
                            return '<input type="hidden" value='+data.employee_id+' name="dtr_employee_id[]"></input><center><input class="chckbx_processed process" type="checkbox" name="is_processed[]" id="is_processed" checked></center>';
                        }
                    }
                },
                { targets:[2],data: "ecode" },
                { targets:[3],data: null,
                    render: function (data, type, full, meta){
                        return '<input type="text" class="ename" value="'+data.full_name+'" class="form-control" readonly>';
                    }
                },
                { targets:[4],data: "no_of_hrs",
                    render: function (data, type, full, meta){
                        if (data != 'null'){
                            return "<input type='text' name='no_of_hrs[]' id='no_of_hrs' class='numeric form-control' value='"+data+"'></input>";
                        }else{
                            return "<input type='text' name='no_of_hrs[]' id='no_of_hrs' class='numeric form-control'></input>";
                        }
                    }
                },
                { targets:[5],data: "per_day_pay",
                    render: function (data, type, full, meta){
                        if (data != 'null'){
                            return "<input type='text' name='per_day_pay[]' id='per_day_pay' class='right numeric form-control' value='"+data+"' readonly></input>";
                        }else{
                            return "<input type='text' name='per_day_pay[]' id='per_day_pay' class='right numeric form-control' readonly></input>";
                        }
                    }
                },                    
                { targets:[6],data: "salary_reg_rates",
                    render: function (data, type, full, meta){
                        if (data != 'null'){
                            return "<input type='text' name='salary_reg_rates[]' id='salary_reg_rates' class='right numeric form-control' value='"+data+"' readonly></input>";
                        }else{
                            return "<input type='text' name='salary_reg_rates[]' id='salary_reg_rates' class='right numeric form-control' readonly></input>";
                        }
                    }
                },
                { targets:[7],data: "basic_pay_total",
                    render: function (data, type, full, meta){
                        if (data != 'null'){
                            return "<input type='text' name='basic_pay_total[]' id='basic_pay_total' class='right numeric form-control' value='"+data+"' readonly></input>";
                        }else{
                            return "<input type='text' name='basic_pay_total[]' id='basic_pay_total' class='right numeric form-control' readonly></input>";
                        }
                    }
                },
                { targets:[8],data: null,
                    render: function (data, type, full, meta){
                        if (data.overtime != 'null'){
                            return "<input type='text' name='overtime[]' id='overtime_"+data.employee_id+"' class='right numeric form-control' value='"+data.overtime+"'></input>";
                        }else{
                            return "<input type='text' name='overtime[]' id='overtime_"+data.employee_id+"' class='right numeric form-control'></input>";
                        }
                    }
                },
                { targets:[9],data: null,
                    render: function (data, type, full, meta){
                        if (data.holiday_pay != 'null'){
                            return "<input type='text' name='holiday_pay[]' id='holiday_pay_"+data.employee_id+"' class='right numeric form-control' value='"+data.holiday_pay+"'></input>";
                        }else{
                            return "<input type='text' name='holiday_pay[]' id='holiday_pay_"+data.employee_id+"' class='right numeric form-control'></input>";
                        }
                    }
                },
                { targets:[10],data: "allowance_pay",
                    render: function (data, type, full, meta){
                        if (data != 'null'){
                            return "<input type='text' name='allowance_pay[]' id='allowance_pay' class='right numeric form-control' value='"+data+"' readonly></input>";
                        }else{
                            return "<input type='text' name='allowance_pay[]' id='allowance_pay' class='right numeric form-control' readonly></input>";
                        }
                    }
                },
                { targets:[11],data: "commission",
                    render: function (data, type, full, meta){
                        if (data != 'null'){
                            return "<input type='text' name='commission[]' id='commission' class='right numeric form-control' value='"+data+"'></input>";
                        }else{
                            return "<input type='text' name='commission[]' id='commission' class='right numeric form-control'></input>";
                        }
                    }
                },
                { targets:[12],data: "undertime",
                    render: function (data, type, full, meta){
                        if (data != 'null'){
                            return "<input type='text' name='undertime[]' id='undertime' class='numeric form-control' value='"+data+"'></input>";
                        }else{
                            return "<input type='text' name='undertime[]' id='undertime' class='numeric form-control'></input>";
                        }
                    }
                },
                { targets:[13],data: "late",
                    render: function (data, type, full, meta){
                        if (data != 'null'){
                            return "<input type='text' name='late[]' id='late' class='numeric form-control' value='"+data+"'></input>";
                        }else{
                            return "<input type='text' name='late[]' id='late' class='numeric form-control'></input>";
                        }
                    }
                },
                { targets:[14],data: "undertime_amt",
                    render: function (data, type, full, meta){
                        if (data != 'null'){
                            return "<input type='text' name='undertime_amt[]' id='undertime_amt' class='right numeric form-control' value='"+data+"' readonly></input>";
                        }else{
                            return "<input type='text' name='undertime_amt[]' id='undertime_amt' class='right numeric form-control' readonly></input>";
                        }
                    }
                },
                { targets:[15],data: "late_amt",
                    render: function (data, type, full, meta){
                        if (data != 'null'){
                            return "<input type='text' name='late_amt[]' id='late_amt' class='right numeric form-control' value='"+data+"' readonly></input>";
                        }else{
                            return "<input type='text' name='late_amt[]' id='late_amt' class='right numeric form-control' readonly></input>";
                        }
                    }
                },
                { targets:[16],data: "adjustment_additional",
                    render: function (data, type, full, meta){
                        if (data != 'null'){
                            return "<input type='text' name='adjustment_additional[]' id='adjustment_additional' class='right numeric form-control' value='"+data+"'></input>";
                        }else{
                            return "<input type='text' name='adjustment_additional[]' id='adjustment_additional' class='right numeric form-control'></input>";
                        }
                    }
                },
                { targets:[17],data: "adjustment_deduction",
                    render: function (data, type, full, meta){
                        if (data != 'null'){
                            return "<input type='text' name='adjustment_deduction[]' id='adjustment_deduction' class='right numeric form-control' value='"+data+"'></input>";
                        }else{
                            return "<input type='text' name='adjustment_deduction[]' id='adjustment_deduction' class='right numeric form-control'></input>";
                        }
                    }
                },
                { targets:[18],data: "gross_total",
                    render: function (data, type, full, meta){
                        if (data != 'null'){
                            return "<input type='text' name='gross_total[]' id='gross_total' class='right numeric form-control' value='"+data+"' readonly></input>";
                        }else{
                            return "<input type='text' name='gross_total[]' id='gross_total' class='right numeric form-control' readonly></input>";
                        }
                    }
                },
                { targets:[19],data: null,
                    render: function (data, type, full, meta){
                        if (data != 'null'){
                            return "<input type='text' name='sss_deduction[]' id='sss_deduction' class='right deduction form-control' value='"+data.sss_deduction+"' readonly></input><input type='hidden' name='sss_employer[]' id='sss_employer' value='"+data.sss_employer+"'><input type='hidden' name='sss_employer_contribution[]' id='sss_employer_contribution' value='"+data.sss_employer_contribution+"'>";
                        }else{
                            return "<input type='text' name='sss_deduction[]' id='sss_deduction' class='right deduction form-control' readonly></input><input type='hidden' name='sss_employer[]' id='sss_employer'><input type='hidden' name='sss_employer_contribution[]' id='sss_employer_contribution'>";
                        }
                    }
                },
                { targets:[20],data: null, 
                    render: function (data, type, full, meta){
                        if (data != 'null'){
                            return "<input type='text' name='philhealth_deduction[]' id='philhealth_deduction' class='right deduction form-control' value='"+data.philhealth_deduction+"' readonly></input><input type='hidden' name='philhealth_employer[]' id='philhealth_employer' value='"+data.philhealth_deduction+"'>";
                        }else{
                            return "<input type='text' name='philhealth_deduction[]' id='philhealth_deduction' class='right deduction form-control' readonly></input><input type='hidden' name='philhealth_employer[]' id='philhealth_employer'>";
                        }
                    }
                },
                { targets:[21],data: "pagibig_deduction",
                    render: function (data, type, full, meta){
                        if (data != 'null'){
                            return "<input type='text' name='pagibig_deduction[]' id='pagibig_deduction' class='right deduction form-control' value='"+data+"' readonly></input>";
                        }else{
                            return "<input type='text' name='pagibig_deduction[]' id='pagibig_deduction' class='right deduction form-control' readonly></input>";
                        }
                    }
                },
                { targets:[22],data: "wtax_deduction", 
                    render: function (data, type, full, meta){
                        if (data != 'null'){
                            return "<input type='text' name='wtax_deduction[]' id='wtax_deduction' class='right deduction form-control' value='"+data+"' readonly></input>";
                        }else{
                            return "<input type='text' name='wtax_deduction[]' id='wtax_deduction' class='right deduction form-control' readonly></input>";
                        }
                    }
                },
                { targets:[23],data: "sss_loan", 
                    render: function (data, type, full, meta){
                        if (data != 'null'){
                            return "<input type='text' name='sss_loan[]' id='sss_loan' class='right numeric form-control' value='"+data+"'></input>";
                        }else{
                            return "<input type='text' name='sss_loan[]' id='sss_loan' class='right numeric form-control'></input>";
                        }
                    }
                },
                { targets:[24],data: "pagibig_loan", 
                    render: function (data, type, full, meta){
                        if (data != 'null'){
                            return "<input type='text' name='pagibig_loan[]' id='pagibig_loan' class='right numeric form-control' value='"+data+"'></input>";
                        }else{
                            return "<input type='text' name='pagibig_loan[]' id='pagibig_loan' class='right numeric form-control'></input>";
                        }
                    }
                },
                { targets:[25],data: "cash_advance", 
                    render: function (data, type, full, meta){
                        if (data != 'null'){
                            return "<input type='text' name='cash_advance[]' id='cash_advance' class='right numeric form-control' value='"+data+"'></input>";
                        }else{
                            return "<input type='text' name='cash_advance[]' id='cash_advance' class='right numeric form-control'></input>";
                        }
                    }
                },
                { targets:[26],data: "net_total",
                    render: function (data, type, full, meta){
                        if (data != 'null'){
                            return "<input type='text' name='net_total[]' id='net_total' class='right numeric form-control' value='"+data+"' readonly></input>";
                        }else{
                            return "<input type='text' name='net_total[]' id='net_total' class='right numeric form-control' readonly></input>";
                        }
                    }
                },
            ],
            language: {
                         searchPlaceholder: "Search Daily Time Record"
                     },
            "rowCallback":function( row, data, index ){

            }
        });
    }

    var initializeControls=function(){
        initializeTables();
        setTimeout(function(){
            $('.numeric').autoNumeric('init');
            $('.deduction').autoNumeric('init', {mDec:4});
            $('.number').autoNumeric('init', {mDec:4});
        },600);
    }();

    var refresh_tables = function(){
        $('#tbl_dtr').DataTable().destroy();
        $('#tbl_ot').DataTable().destroy();
        $('#tbl_holiday').DataTable().destroy();
        get_payroll_list();
    }

    $('#btn_refresh_list').on('click',function(){
        $('#modal_refresh_confirmation').modal('show');
    });

    $('#btn_refresh_yes').on('click',function(){
        var _year = $('#year').val();
        var _payperiod = $('#payperiod').val();
        var _branch = $('#branch').val();
        var _department = $('#department').val();
        $('#tbl_dtr').DataTable().destroy();
        get_refresh_payroll_list(_year,_payperiod,_branch,_department);
    });

    $('#year').on('change',function(){
        refresh_tables();
    });

    $('#payperiod').on('change',function(){
        refresh_tables();
    });    

    $('#branch').on('change',function(){
        refresh_tables();
    });

    $('#department').on('change',function(){
        refresh_tables();
    });    

    var get_payroll_list = function(){
        initializeTables();
        setTimeout(function(){
            $('.numeric').autoNumeric('init');
            $('.deduction').autoNumeric('init', {mDec:4});
        },600);
    }

    var get_refresh_payroll_list = function(year,payperiod,branch,department){
        initializeRefreshTables(year,payperiod,branch,department);
        setTimeout(function(){
            $('.numeric').autoNumeric('init');
            $('.deduction').autoNumeric('init', {mDec:4});
        },600);
    }    

    $('#tbl_dtr tbody').on('click','.btn_remove',function(){

        _selectRowObj=$(this).closest('tr');
        var data=dt.row(_selectRowObj).data();

        var full_name = data.full_name;
        _dtr_id = data.dtr_id;
        _employeeID = data.employee_id;
        _payperiodID = data.pay_period_id;

        $('#employeename').text(full_name);
        $('#modal_confirmation').modal('show');
    });

    $('#tbl_dtr tbody').on('keyup','input.numeric',function(){
        var row=$(this).closest('tr');
        var data=dt.row(row).data();
        var monthly_pay = 0;
        var withholding_lookup = 0;
        var wtax_deduction;

        // ## Declaration
        var no_of_hrs=parseFloat(accounting.unformat(row.find(oTableItems.no_of_hrs).find('input.numeric').val()));
        var salary_reg_rates=parseFloat(accounting.unformat(row.find(oTableItems.salary_reg_rates).find('input.numeric').val()));
        var per_hour_pay=parseFloat(accounting.unformat(data.per_hour_pay));
        var allowance=parseFloat(accounting.unformat(data.allowance));
        var ref_payfrequency_type_id=data.ref_payfrequency_type_id;
        var basic_pay_total_temp = parseFloat(accounting.unformat(data.basic_pay_total));
        var overtime=parseFloat(accounting.unformat(row.find(oTableItems.overtime).find('input.numeric').val()));
        var holiday_pay=parseFloat(accounting.unformat(row.find(oTableItems.holiday_pay).find('input.numeric').val()));
        var commission=parseFloat(accounting.unformat(row.find(oTableItems.commission).find('input.numeric').val()));
        var undertime = parseFloat(accounting.unformat(row.find(oTableItems.undertime).find('input.numeric').val()));
        var late = parseFloat(accounting.unformat(row.find(oTableItems.late).find('input.numeric').val()));
        var adjustment_additional=parseFloat(accounting.unformat(row.find(oTableItems.adjustment_additional).find('input.numeric').val()));
        var adjustment_deduction=parseFloat(accounting.unformat(row.find(oTableItems.adjustment_deduction).find('input.numeric').val()));
        var sss_deduction=parseFloat(accounting.unformat(row.find(oTableItems.sss_deduction).find('input.deduction').val()));
        var philhealth_deduction=parseFloat(accounting.unformat(row.find(oTableItems.philhealth_deduction).find('input.deduction').val()));
        var pagibig_deduction=parseFloat(accounting.unformat(row.find(oTableItems.pagibig_deduction).find('input.deduction').val()));
        var sss_loan=parseFloat(accounting.unformat(row.find(oTableItems.sss_loan).find('input.numeric').val()));
        var pagibig_loan=parseFloat(accounting.unformat(row.find(oTableItems.pagibig_loan).find('input.numeric').val()));
        var cash_advance=parseFloat(accounting.unformat(row.find(oTableItems.cash_advance).find('input.numeric').val()));

        // ## Computation
        var basic_pay_total;

        if (ref_payfrequency_type_id == 5){
            basic_pay_total = basic_pay_total_temp;
        }else{
            basic_pay_total = no_of_hrs*per_hour_pay;
        }

        var allowance_pay = no_of_hrs*allowance;
        var undertime_amt = ((undertime/60)*per_hour_pay);
        var late_amt = ((late/60)*per_hour_pay);

        var total_undertime_late = 0;
        total_undertime_late = undertime_amt + late_amt;

        var gross_total = ((basic_pay_total+overtime+holiday_pay+allowance_pay+commission+adjustment_additional)  - total_undertime_late) - adjustment_deduction;
        withholding_lookup=gross_total-(sss_deduction+philhealth_deduction+pagibig_deduction);

        getWTAXDeduction(withholding_lookup,ref_payfrequency_type_id).done(function(response){
            var rowwtax = response.data[0];
            var rowlength = response.data.length;

            if (rowlength > 0){
                row.find(oTableItems.wtax_deduction).find('input.deduction').val(accounting.formatNumber(rowwtax.wtax_deduction,4));
            }

            var wtax_deduction = parseFloat(accounting.unformat(row.find(oTableItems.wtax_deduction).find('input.deduction').val()));
            var deduction_total = parseFloat(sss_deduction)+parseFloat(philhealth_deduction)+parseFloat(pagibig_deduction)+parseFloat(wtax_deduction)+parseFloat(sss_loan)+parseFloat(pagibig_loan)+parseFloat(cash_advance);
            var net_total;

            if (gross_total > deduction_total){ net_total = gross_total-deduction_total; }else{ net_total = 0.00;}

            // ## Result to Input

            row.find(oTableItems.basic_pay_total).find('input.numeric').val(accounting.formatNumber(basic_pay_total,2));
            row.find(oTableItems.allowance_pay).find('input.numeric').val(accounting.formatNumber(allowance_pay,2));    
            row.find(oTableItems.undertime_amt).find('input.numeric').val(accounting.formatNumber(undertime_amt,2));    
            row.find(oTableItems.late_amt).find('input.numeric').val(accounting.formatNumber(late_amt,2));    
            row.find(oTableItems.gross_total).find('input.numeric').val(accounting.formatNumber(gross_total,2));
            row.find(oTableItems.net_total).find('input.numeric').val(accounting.formatNumber(net_total,2));

        }).always(function(){
            $.unblockUI();
        });
    });

    $('#tbl_ot tbody').on('keyup','input.numeric',function(){
            var row=$(this).closest('tr');
            var data=dt_overtime.row(row).data();

            var reg_ot=parseFloat(accounting.unformat(row.find(oTableOT.reg_ot).find('input.numeric').val()));
            var sun_ot=parseFloat(accounting.unformat(row.find(oTableOT.sun_ot).find('input.numeric').val()));
            var reg_hol_ot=parseFloat(accounting.unformat(row.find(oTableOT.reg_hol_ot).find('input.numeric').val()));
            var sun_reg_hol_ot=parseFloat(accounting.unformat(row.find(oTableOT.sun_reg_hol_ot).find('input.numeric').val()));
            var spe_hol_ot=parseFloat(accounting.unformat(row.find(oTableOT.spe_hol_ot).find('input.numeric').val()));
            var sun_spe_hol_ot=parseFloat(accounting.unformat(row.find(oTableOT.sun_spe_hol_ot).find('input.numeric').val()));
            var overtime_total=parseFloat(accounting.unformat(row.find(oTableOT.overtime_total).find('input.numeric').val()));

            var per_hour_pay=parseFloat(accounting.unformat(data.per_hour_pay));

            var fac_reg_ot = $('#fac-reg-ot').val();
            var fac_sun_ot = $('#fac-sun-ot').val();
            var fac_reg_hol_ot = $('#fac-reg-hol-ot').val();    
            var fac_sun_reg_hol_ot = $('#fac-sun-reg-hol-ot').val();
            var fac_spe_hol_ot = $('#fac-spe-hol-ot').val();
            var fac_sun_spe_hol_ot = $('#fac-sun-spe-hol-ot').val();

            var reg_ot_amt = reg_ot*per_hour_pay*fac_reg_ot;
            var sun_ot_amt = sun_ot*per_hour_pay*fac_sun_ot;
            var reg_hol_ot_amt = reg_hol_ot*per_hour_pay*fac_reg_hol_ot;
            var sun_reg_hol_ot_amt = sun_reg_hol_ot*per_hour_pay*fac_sun_reg_hol_ot;
            var spe_hol_ot_amt = spe_hol_ot*per_hour_pay*fac_spe_hol_ot;
            var sun_spe_hol_ot_amt = sun_spe_hol_ot*per_hour_pay*fac_sun_spe_hol_ot;

            $('#reg_ot_amt').val(reg_ot_amt);
            $('#sun_ot_amt').val(sun_ot_amt);
            $('#reg_hol_ot_amt').val(reg_hol_ot_amt);
            $('#sun_reg_hol_ot_amt').val(sun_reg_hol_ot_amt);
            $('#spe_hol_ot_amt').val(spe_hol_ot_amt);
            $('#sun_spe_hol_ot_amt').val(sun_spe_hol_ot_amt);

            var overtime_total = reg_ot_amt+sun_ot_amt+reg_hol_ot_amt+sun_reg_hol_ot_amt+spe_hol_ot_amt+sun_spe_hol_ot_amt;
            row.find(oTableOT.overtime_total).find('input.numeric').val(accounting.formatNumber(overtime_total,2));

            if (overtime_total > 1){
                $('#overtime_'+data.employee_id).val(accounting.formatNumber(overtime_total,2));
                $('#overtime_'+data.employee_id).attr('readonly','readonly');
            }else{
                $('#overtime_'+data.employee_id).val(accounting.formatNumber(overtime_total,2));
                $('#overtime_'+data.employee_id).attr('readonly',false);
            }

            $('#overtime_'+data.employee_id).keyup();
    });

    $('#tbl_holiday tbody').on('keyup','input.numeric',function(){
            var row=$(this).closest('tr');
            var data=dt_holiday.row(row).data();

            var reg_hol=parseFloat(accounting.unformat(row.find(oTableHol.reg_hol).find('input.numeric').val()));
            var sun_reg_hol=parseFloat(accounting.unformat(row.find(oTableHol.sun_reg_hol).find('input.numeric').val()));
            var spe_hol=parseFloat(accounting.unformat(row.find(oTableHol.spe_hol).find('input.numeric').val()));
            var sun_spe_hol=parseFloat(accounting.unformat(row.find(oTableHol.sun_spe_hol).find('input.numeric').val()));

            var per_hour_pay=parseFloat(accounting.unformat(data.per_hour_pay));

            var fac_reg_hol = $('#fac-reg-hol').val();
            var fac_sun_reg_hol = $('#fac-sun-reg-hol').val();
            var fac_spe_hol = $('#fac-spe-hol').val();
            var fac_sun_spe_hol = $('#fac-sun-spe-hol').val();
            
            var reg_hol_amt = reg_hol*per_hour_pay*fac_reg_hol;
            var sun_reg_hol_amt = sun_reg_hol*per_hour_pay*fac_sun_reg_hol;
            var spe_hol_amt = spe_hol*per_hour_pay*fac_spe_hol;
            var sun_spe_hol_amt = sun_spe_hol*per_hour_pay*fac_sun_spe_hol;

            $('#reg_hol_amt').val(reg_hol_amt);
            $('#sun_reg_hol_amt').val(sun_reg_hol_amt);
            $('#spe_hol_amt').val(spe_hol_amt);
            $('#sun_spe_hol_amt').val(sun_spe_hol_amt);

            var holiday_total = reg_hol_amt+sun_reg_hol_amt+spe_hol_amt+sun_spe_hol_amt;
            row.find(oTableHol.holiday_total).find('input.numeric').val(accounting.formatNumber(holiday_total,2));

            if (holiday_total > 1){
                $('#holiday_pay_'+data.employee_id).val(accounting.formatNumber(holiday_total,2));
                $('#holiday_pay_'+data.employee_id).attr('readonly','readonly');
            }else{
                $('#holiday_pay_'+data.employee_id).val(accounting.formatNumber(holiday_total,2));
                $('#holiday_pay_'+data.employee_id).attr('readonly',false);
            }

            $('#holiday_pay_'+data.employee_id).keyup();
    });


    $('#process_payroll').click(function(){
        $('#modal_process_payroll_confirmation').modal('show');
        var payperiod = $('#payperiod option:selected').text();
        var branch = $('#branch option:selected').text();
        var department = $('#department option:selected').text();

        $('#payperiodmodal').text(payperiod);
        $('#branchname').text(branch);
        $('#departmentname').text(department);
    });

    $('#btn_process_payroll_yes').click(function(){
        processPayroll().done(function(response){
            showNotification(response);
        }).always(function(){
            $.unblockUI();
        });
    });

    var processPayroll = function(){

        $('input:checkbox[name^=is_processed]').each(function () {
            $(this).prop("checked") ? $(this).val('1') : $(this).html("<input type='hidden' name='is_processed[]' value='0' />");
        });

        var data = $('#frm_tbl_dtr, #frm_tbl_ot, #frm_tbl_holiday').serializeArray();
        data.push({name : "pay_period_id" ,value : $('#payperiod').val()});

        return $.ajax({
            "dataType":"json",
            "type":"POST",
            "url":"DailyTimeRecord/transaction/processPayroll",
            "data":data,
            beforeSend: showSpinningProgressLoading(),
        }).done(function(response){
            $.unblockUI();
        });
    };

    var bindEventHandlers=(function(){
        var detailRows = [];
         var detailRows1 = [];

        $('#btn_check_all').on('click', function(){
            $('.chckbx_processed').prop('checked', true);
        });

        $('#btn_uncheck_all').on('click', function(){
            $('.chckbx_processed').prop('checked', false);
        });

        $('#year').change(function() {
            getpayperiodfilters();
        });

        $('#payroll_search').click(function(){
            $('#payroll_search').hide();
            $('#search_panel').html('<input type="text" class="form-control" id="search_payroll_text"></input>');
        });

        $('#ref_department_id').change(function() {
            _selectedIDDepartment=$(this).val();
            });

        $('#ref_branch_id').change(function() {
            _selectedIDBranch=$(this).val();
            });

        $('#btn_new').click(function(){
            clearFields($('#frm_employee'))
            _txnMode="new";
            $('#emp_religion').val(1);
            $('#emp_civilstatus').val("Single");
            $('#emp_processaccount').val(0);
            $('#emp_exemptss').val(0);
            $('#emp_exemptphilhealth').val(1);
            $('#emp_exemptpagibig').val(0);
            $(".date-picker").val('<?php echo date("m/d/Y"); ?>');
            hideemployeeList();
            showemployeeFields();
        });

        $('#tbl_employee_list tbody').on('click','button[name="edit_info"]',function(){
            _txnMode="edit";
            _selectRowObj=$(this).closest('tr');
            var data=dt.row(_selectRowObj).data();
            _selectedID=data.employee_id;

            $('#emp_civilstatus').val(data.civil_status);
            $('#emp_religion').val(data.ref_religion_id);
            $('#emp_processaccount').val(data.bank_account_isprocess);
            $('#emp_exemptss').val(data.exmpt_sss);
            $('#emp_exemptphilhealth').val(data.exmpt_philhealth);
            $('#emp_exemptpagibig').val(data.exmpt_pagibig);
            if(data.image_name==""){
                 $('img[name="img_user"]').attr('src','assets/img/user/anonymous-icon.png');
            }
            else{
                $('img[name="img_user"]').attr('src',data.image_name);
            }

            $('input,textarea').each(function(){
                var _elem=$(this);
                $.each(data,function(name,value){
                    if(_elem.attr('name')==name){
                        _elem.val(value);
                    }
                });
            });

            hideemployeeList();
            showemployeeFields();

        });

        $('#tbl_employee_list tbody').on('click','button[name="remove_info"]',function(){
            _selectRowObj=$(this).closest('tr');
            var data=dt.row(_selectRowObj).data();
            _selectedID=data.employee_id;

            $('#modal_confirmation').modal('show');
        });


        $('#btn_yes').click(function(){
            removeDTR().done(function(response){
                showNotification(response);
                dt.row(_selectRowObj).remove().draw();

                $('#tbl_ot').DataTable().destroy();
                $('#tbl_holiday').DataTable().destroy();

                var year = $('#year').val();
                var payperiod = $('#payperiod').val();
                var department = $('#department').val();
                initializeEmpTables(year,payperiod,department);
                $.unblockUI();
            });
        });

        $('#btn_remove_photo').click(function(event){
                event.preventDefault();
                $('img[name="img_user"]').attr('src','assets/img/user/anonymous-icon.png');
            });

                //CREATE NEW EMPLOYEEE
        $('#btn_save').click(function(){
            if(validateRequiredFields($('#frm_employee'))){
                if(_txnMode=="new"){
                    createEmployee().done(function(response){
                        showNotification(response);
                        dt.row.add(response.row_added[0]).draw();
                        clearFields($('#frm_employee'))
                    }).always(function(){
                        $('img[name="img_user"]').attr('src','assets/img/user/anonymous-icon.png');
                        $.unblockUI();
                    });
                    return;
                }
                if(_txnMode=="edit"){
                    updateEmployee().done(function(response){
                        showNotification(response);
                        dt.row(_selectRowObj).data(response.row_updated[0]).draw();
                        clearFields($('#frm_employee'))
                        hideemployeeFields();
                        showemployeeList();
                    }).always(function(){
                        $('img[name="img_user"]').attr('src','assets/img/user/anonymous-icon.png');
                        $.unblockUI();
                    });
                    return;
                }
            }
        });

        $('#btn_select_dtr').click(function(){
            if(validateRequiredFields($('#frm_search_dtr'))){
            showSpinningProgressLoading();
            showdtr();
            getDtr();
            $('#modal_dtr').modal('toggle');

        }
        });

        $('#employee_wo_dtr').change(function() {
            var tempdept = $('#employee_wo_dtr option:selected').attr('id');
            $('#ref_dept_dtr').val(tempdept);
            //var tempwodtrval = $('#employee_wo_dtr').val();
            var tempwodtr = $('#employee_wo_dtr option:selected').text();
            var wodtr = tempwodtr.split(/ ~ /)
            //var wodtrval = tempwodtrval.split(/~/)
            var tempwodtrval = $('#employee_wo_dtr').val();
            var wodtrval = tempwodtrval.split(/~/)
            _selectedID=wodtrval[0];
            _selectedIDdtremployee = _selectedID;
    
            $('#tbl_dtr_deduction').dataTable().fnDestroy();
            getDtrDeduction();
            $('#ecode').val(wodtr[0]);
         
            });

        $('#btn_canceldtr').click(function(){
            hidedtr();


            $('#tbl_employee_dtr').dataTable().fnDestroy();
            $('#tbl_employee_dtr').fnClearTable();
        });

        $('#tbl_employee_dtr tbody').on('click','button[name="dtr_edit"]',function(){
            _txnMode="editdtr";
            $('#employee_wo_dtr').removeAttr('required');
            $('#tbl_dtr_deduction').dataTable().fnDestroy();
            _selectRowObjdtr=$(this).closest('tr');
            var data=dt_dtr.row(_selectRowObjdtr).data();
            _selectedIDdtr=data.dtr_id;
            $('#empname').text(data.full_name);
            _selectedIDdtremployee=data.employee_id;
            getDtrDeductionEdit();

            $('#modal_new_dtr').modal('toggle');
            $('#editmode').hide();

            $('input,textarea').each(function(){
                var _elem=$(this);
                $.each(data,function(name,value){
                    if(_elem.attr('name')==name){
                        _elem.val(value);
                    }
                });
            });
        });

        $('#btn_new_dtr_save').click(function(){
            if(validateRequiredFields($('#frm_dtr'))){
                if(_txnMode=="newdtr"){
                    createDtr().done(function(response){
                    showNotification(response);
                    dt_dtr.row.add(response.row_added[0]).draw();
                    }).always(function(){
                        $.unblockUI();
                        var selectwodtr = document.getElementById("employee_wo_dtr");
                        selectwodtr.remove(selectwodtr.selectedIndex);
                        $('#modal_new_dtr').modal('toggle');
                    });
                    return;
                }
                if(_txnMode=="editdtr"){
                    updateDtr().done(function(response){
                    showNotification(response);
                    dt_dtr.row(_selectRowObjdtr).data(response.row_updated[0]).draw();
                    }).always(function(){
                        $.unblockUI();
                        $('#modal_new_dtr').modal('toggle');
                    });
                    return;
                }
            }
        });

        $('input[name="file_upload[]"]').change(function(event){
            var _files=event.target.files;
            showSpinningProgressUpload();
            var data=new FormData();
            $.each(_files,function(key,value){
                data.append(key,value);
            });
            console.log(_files);
            $.ajax({
                url : 'Employee/transaction/upload',
                type : "POST",
                data : data,
                cache : false,
                dataType : 'json',
                processData : false,
                contentType : false,
                success : function(response){
                            $.unblockUI();
                            $('img[name="img_user"]').attr('src',response.path);

                        }
            });
        });
    })();

    $('#btn_browse').click(function(event){
            event.preventDefault();
            $('input[name="file_upload[]"]').click();
     });

    _employees=$("#employee_wo_dtr").select2({
        dropdownParent: $("#modal_new_dtr"),
        placeholder: "Select Employee",
        allowClear: true
    });

    var createEmployee=function(){
        var _data=$('#frm_employee').serializeArray();
        _data.push({name : "image_name" ,value : $('img[name="img_user"]').attr('src')});
        return $.ajax({
            "dataType":"json",
            "type":"POST",
            "url":"Employee/transaction/create",
            "data":_data,
            "beforeSend": showSpinningProgress($('#btn_save'))
        });
    };

    var chckstatus=function(){
        var _data=$('#').serializeArray();
        _data.push({name : "employee_id" ,value : _selectedIDdtremployee});
        return $.ajax({
            "dataType":"json",
            "type":"POST",
            "url":"DailyTimeRecord/transaction/chckstatus",
            "data":_data
        });
    };

    var updateEmployee=function(){
        var _data=$('#frm_employee').serializeArray();
        _data.push({name : "image_name" ,value : $('img[name="img_user"]').attr('src')});
        console.log(_data);
        _data.push({name : "employee_id" ,value : _selectedID});
        return $.ajax({
            "dataType":"json",
            "type":"POST",
            "url":"Employee/transaction/update",
            "data":_data,
            "beforeSend": showSpinningProgress($('#btn_save'))
        });
    };

    var getWTAXDeduction=function(withholding_lookup,ref_payfrequency_type_id){
        var _data=$('#').serializeArray();
        _data.push({name : "withholding_lookup" ,value : withholding_lookup});
        _data.push({name : "ref_payfrequency_type_id" ,value : ref_payfrequency_type_id});

        return $.ajax({
            "dataType":"json",
            "type":"POST",
            "url":"DailyTimeRecord/transaction/getWTAXDeduction",
            "data":_data,
        });
    };

    var removeEmployee=function(){
        return $.ajax({
            "dataType":"json",
            "type":"POST",
            "url":"Employee/transaction/delete",
            "data":{employee_id : _selectedID},
            "beforeSend": showSpinningProgress($('#'))
        });
    };

    var removeDTR=function(){

        var _data=$('#').serializeArray();
        _data.push({name : "dtr_id", value : _dtr_id});
        _data.push({name : "pay_period_id", value : _payperiodID});
        _data.push({name : "employee_id", value : _employeeID});

        return $.ajax({
            "dataType":"json",
            "type":"POST",
            "url":"DailyTimeRecord/transaction/delete",
            "data":_data,
            "beforeSend": showSpinningProgress($('#'))
        });
    };

    var getempwodtr=function(){
        var _data=$('#').serializeArray();
        _data.push({name : "pay_period_id" ,value : _selectedYear});
        return $.ajax({
            "dataType":"json",
            "type":"POST",
            "url":"DailyTimeRecord/transaction/getdtr",
            "data":_data,
            "beforeSend": showSpinningProgressLoading()
        });
    };

    var getempwodtrgetdept=function(){
        var _data=$('#').serializeArray();
        _data.push({name : "employee_id" ,value : _selectedID});
        return $.ajax({
            "dataType":"json",
            "type":"POST",
            "url":"Employee/transaction/getdept",
            "data":_data,
            "beforeSend": showSpinningProgressLoading()
        });
    };

    var getDeduct=function(){
        return $.ajax({
            "dataType":"json",
            "type":"POST",
            "url":"Employee/transaction/list",
            "data":data,
            "beforeSend": showSpinningProgressLoading()
        });
    };

    var createDtr=function(){
       var oTable = $('#tbl_dtr_deduction').dataTable();
        var data = $('input', oTable.fnGetNodes()).serialize();
       var _data=$('#frm_dtr').serialize()+'&'+$.param({'pay_period_id':_selectedYear,'employee_id':_selectedID}); 
       //trick to merge 2 serialize and add additional data
       console.log(data);
       var newdata = data + '&' + _data;
        return $.ajax({
            "dataType":"json",
            "type":"POST",
            "url":"DailyTimeRecord/transaction/create",
            "data":_data,
            "beforeSend": showSpinningProgressLoading()
        });
    };

    var updateDtr=function(){
       var _data=$('#frm_dtr').serialize()+'&'+$.param({'dtr_id':_selectedIDdtr,'employee_id':_selectedIDdtremployee}); //trick to merge 2 serialize and add additional data
      //var aww={name : "pay_period_id" ,value : _selectedYear};
       //_pusheddata.push({name : "employee_id" ,value : _selectedID  });

       var newdata = _pusheddata + '&' + _data;
        return $.ajax({
            "dataType":"json",
            "type":"POST",
            "url":"DailyTimeRecord/transaction/update",
            "data":newdata,
            "beforeSend": showSpinningProgressLoading()
        });
    };


    var showList=function(b){
        if(b){
            $('#div_employee_list').show();
            $('#div_employee_fields').hide();
        }else{
            $('#div_employee_list').hide();
            $('#div_employee_fields').show();
        }
    };

    var hideemployeeList=function(){
         $('#div_employee_list').hide();
    };

    var showemployeeList=function(){
        $('#div_employee_list').show();
        $('#icon_new_employee').show();
    };

    var hideemployeeFields=function(){
        $('#div_employee_fields').hide();
        $('#icon_new_employee').show();
    };

    var showemployeeFields=function(){
        $('#div_employee_fields').show();
        $('#icon_new_employee').hide();
    };

    var showdtr=function(){
        $('#div_dtr_entry').show();
        $('#div_employee_list').hide();
        $('#icon_new_employee').hide();
        $('#btn_dtr').hide();
    };

    var hidedtr=function(){
        $('#div_dtr_entry').hide();
        $('#btn_dtr').show();
        $('#icon_new_employee').show();
        $('#div_employee_list').show();
    };
    /*
    var getdeptfunction=function(){
        getempwodtrgetdept().done(function(response){
                        if(response.data[0]==null || response.data[0].department==null){
                        console.log('walang laman');
                        $('#ref_dept_dtr').val('Not Set');
                        }
                        else{
                            $('#ref_dept_dtr').val(response.data[0].department);
                        }
                        //$('#period_start').val(payperiod[0]);
                        //$('#period_end').val(payperiod[1]);
                        //_selectedYear=payperiod[2];
                        //$('.periodcoveredtext').text(temppayperiod);

                        /*alert(data.religion);
                        var arr = [];
                        for (var prop in data) {
                            arr.push(data[prop]);
                        }
                        //console.
                    });
    }*/

    var validateRequiredFields=function(f){
        var stat=true;

        $('div.form-group').removeClass('has-error');
        $('input[required],textarea[required],select[required]',f).each(function(){

                if($(this).is('select')){
                if($(this).val()==0 || $(this).val()==null){
                    showNotification({title:"Error!",stat:"error",msg:$(this).data('error-msg')});
                    $(this).closest('div.form-group').addClass('has-error');
                    $(this).focus();
                    stat=false;
                    return false;
                }

                }else{
                if($(this).val()==""){
                    showNotification({title:"Error!",stat:"error",msg:$(this).data('error-msg')});
                    $(this).closest('div.form-group').addClass('has-error');
                    $(this).focus();
                    stat=false;
                    return false;
                }
            }




        });

        return stat;
    };

    var showNotification=function(obj){
        PNotify.removeAll();
        new PNotify({
            title:  obj.title,
            text:  obj.msg,
            type:  obj.stat
        });
    };

        $('.date-picker').datepicker({
            todayBtn: "linked",
            keyboardNavigation: false,
            forceParse: false,
            calendarWeeks: true,
            autoclose: true

        });

    var showSpinningProgress=function(e){
        $.blockUI({ message: '<img src="assets/img/loader/gears.svg"/><br><h4 style="color:#ecf0f1;">Processing Payroll...</h4>',
            css: {
            border: 'none',
            padding: '15px',
            backgroundColor: 'none',
            opacity: 1,
            zIndex: 20000,
        } });
        $('.blockOverlay').attr('title','Click to unblock').click($.unblockUI);
    };

    var showSpinningProgressLoading=function(e){
        $.blockUI({ message: '<img src="assets/img/loader/gears.svg"/><br><h4 style="color:#ecf0f1;">Processing Payroll...</h4>',
            css: {
            border: 'none',
            padding: '15px',
            backgroundColor: 'none',
            opacity: 1,
            zIndex: 20000,
        } });
        $('.blockOverlay').attr('title','Click to unblock').click($.unblockUI);
    };

    var showSpinningProgressUpload=function(e){
        $.blockUI({ message: '<img src="assets/img/loader/gears.svg"/><br><h4 style="color:#ecf0f1;">Processing Payroll...</h4>',
            css: {
            border: 'none',
            padding: '15px',
            backgroundColor: 'none',
            opacity: 1,
            zIndex: 20000,
        } });
        $('.blockOverlay').attr('title','Click to unblock').click($.unblockUI);
    };

    var clearFields=function(f){
        $('input,textarea',f).val('');
        $(f).find('input:first').focus();
    };



    function format ( d ) {
        return '<div class="container-fluid">'+
        '<div class="col-md-12">'+
        '<h3 class="boldlabel"><span class="glyphicon glyphicon-user fa-lg"></span> ' + d.first_name +' ' + d.middle_name + ' ' +d.last_name + '</h3>'+
        '<p>[ ECODE : '+d.ecode+' ] [ ID : '+d.id_number+' ]</p>'+
        '<hr style="height:1px;background-color:black;"></hr>'+
        '</div>'+ //First Row//
        '<div class="row">'+
        '<div class="col-md-3">'+
        '<center><img class="loadingimg" src="'+d.image_name+'"></img></center>'+
        '</div>'+
        '<div class="col-md-4"><p class="nomargin"><b>Gender</b> : '+d.gender+'</p>'+
        '<p class="nomargin"><b>Birthdate</b> : '+d.birthdate+'</p>'+
        '<p class="nomargin"><b>Civil Status</b> : '+d.civil_status+'</p>'+
        '<p class="nomargin"><b>Blood Type</b> : '+d.blood_type+'</p>'+
        '<p class="nomargin"><b>Height</b> : '+d.height+'</p>'+
        '<p class="nomargin"><b>Weight</b> : '+d.weight+'</p>'+
        '<p class="nomargin"><b>Religion</b> : '+d.religion+'</p>'+
        '</div>'+
        '<div class="col-md-4">'+
        '<p class="nomargin"><b>SSS</b> : '+d.sss+'</p>'+
        '<p class="nomargin"><b>Phil Health</b> : '+d.phil_health+'</p>'+
        '<p class="nomargin"><b>Pag-Ibig :</b> '+d.pag_ibig+'</p>'+
        '<p class="nomargin"><b>TIN :</b> '+d.tin+'</p>'+
        '<p class="nomargin"><b>Account No.</b> : '+d.bank_account+'</p>'+
        '</div>'+
        '</div>'+
        '<div class="col-md-12">'+
        '<h3 class="boldlabel"><h4 class="boldlabel"><span class="glyphicon glyphicon-info-sign fa-lg"></span> Employee Information</h4><hr style="height:1px;background-color:black;"></hr></div>'+
        '<div class="row">'+ //Second Row//
        '<div class="col-md-3">'+
        '<center></center>'+
        '</div>'+
        '<div class="col-md-4"><p class="nomargin"><b>Employee Type</b> : '+d.employment_type+'</p>'+
        '<p class="nomargin"><b>Remarks</b> : '+d.status+'</p>'+
        '<p class="nomargin"><b>Department</b> : '+d.department+'</p>'+
        '<p class="nomargin"><b>Position</b> : '+d.position+'</p>'+
        '<p class="nomargin"><b>Branch</b> : '+d.branch+'</p>'+
        '</div>'+
        '<div class="col-md-4">'+
        '<p class="nomargin"><b>Section</b> : '+d.section+'</p>'+
        '<p class="nomargin"><b>Pay Type</b> : '+d.payment_type+'</p>'+
        '<p class="nomargin"><b>Employment Date</b> : '+d.employment_date+'</p>'+
        '<p class="nomargin"><b>Date Regular</b> : '+d.emp_philhealth+'</p>'+
        '</div>'+
        '</div>'+
        '<div class="col-md-12">'+
        '<h3 class="boldlabel"><h4 class="boldlabel"><span class="glyphicon glyphicon-info-sign fa-lg"></span> Contact Information</h4><hr style="height:1px;background-color:black;"></hr></div>'+
        '<div class="row">'+ //Third Row//
        '<div class="col-md-3">'+
        '<center></center>'+
        '</div>'+
        '<div class="col-md-4"><p class="nomargin"><b>Address 1</b> : '+d.address_one+'</p>'+
        '<p class="nomargin"><b>Address 2</b> : '+d.address_two+'</p>'+
        '<p class="nomargin"><b>Email Address</b> : '+d.email_address+'</p>'+
        '</div>'+
        '<div class="col-md-4"><p class="nomargin"><b>Mobile No.</b> : '+d.cell_number+'</p>'+
        '<p class="nomargin"><b> Phone No.</b> : '+d.telphone_number+'</p>'+
        '</div>'+
        '</div>'+
        '</div>';
    };

;



   /* $('.i-checks').iCheck({
        checkboxClass: 'icheckbox_square-green',
        radioClass: 'iradio_square-green',
    });*/


    // apply input changes, which were done outside the plugin
    //$('input:radio').iCheck('update');

});

</script>
</body>

</html>
