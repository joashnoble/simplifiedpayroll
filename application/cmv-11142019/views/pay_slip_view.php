<!DOCTYPE html>
<html lang="en">
<?php echo $loader; ?>
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
    <!-- iCheck -->
    <link type="text/css" href="assets/plugins/iCheck/skins/minimal/_all.css" rel="stylesheet">                   
    <!-- Custom Checkboxes / iCheck -->
    <link href="assets/plugins/datapicker/datepicker3.css" rel="stylesheet">
    <link href="assets/plugins/select2/select2.min.css" rel="stylesheet">
    <link href="assets/css/plugins/datapicker/datepicker3.css" rel="stylesheet">
    <?php echo $_switcher_settings; ?>
    <?php echo $_def_js_files; ?>
    <script type="text/javascript" src="assets/plugins/datatables/jquery.dataTables.js"></script>
    <script type="text/javascript" src="assets/plugins/datatables/dataTables.bootstrap.js"></script>
    <!-- Date range use moment.js same as full calendar plugin -->
    <script src="assets/plugins/fullcalendar/moment.min.js"></script>
    <!-- Data picker -->
    <script src="assets/plugins/datapicker/bootstrap-datepicker.js"></script>
    <!-- Select2 -->
    <script src="assets/plugins/select2/select2.full.min.js"></script>
    <!-- Date range use moment.js same as full calendar plugin -->
    <script src="assets/js/plugins/fullcalendar/moment.min.js"></script>
    <!-- Data picker -->
    <script src="assets/js/plugins/datapicker/bootstrap-datepicker.js"></script>
    <!-- twitter typehead -->
    <script src="assets/plugins/twittertypehead/handlebars.js"></script>
    <script src="assets/plugins/twittertypehead/bloodhound.min.js"></script>
    <script src="assets/plugins/twittertypehead/typeahead.bundle.min.js"></script>
    <script src="assets/plugins/twittertypehead/typeahead.jquery.min.js"></script>
    <!-- touchspin -->
    <script type="text/javascript" src="assets/plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.js"></script>
    <!-- numeric formatter -->
    <script src="assets/plugins/formatter/autoNumeric.js" type="text/javascript"></script>
    <script src="assets/plugins/formatter/accounting.js" type="text/javascript"></script>
    <style>
        .toolbar{
            float: left;
        }

        td.details-control {
            background: url('assets/img/icon/Folder_Closed.png') no-repeat center center;
            cursor: pointer;
        }
        tr.details td.details-control {
            background: url('assets/img/icon/Folder_Opened.png') no-repeat center center;
        }
        td.pay_slip_show {
            background: url('assets/img/icon/show.png') no-repeat center center !important;
            cursor: pointer;
        }
        td.details-control1 {
            background: url('assets/img/icon/Folder_Closed.png') no-repeat center center !important;
            cursor: pointer;
        }
        tr.details1 td.details-control1 {
            background: url('assets/img/icon/Folder_Opened.png') no-repeat center center;
        }

        td.details-control2 {
            background: url('assets/img/icon/Folder_Closed.png') no-repeat center center !important;
            cursor: pointer;
        }
        tr.details2 td.details-control2 {
            background: url('assets/img/icon/Folder_Opened.png') no-repeat center center;
        }

        .child_table{
            padding: 5px;
            border: 1px #ff0000 solid;
        }

        .glyphicon.spinning {
            animation: spin 1s infinite linear;
            -webkit-animation: spin2 1s infinite linear;
        }
        .select2-container{
            min-width: 100%;
        }
        @keyframes spin {
            from { transform: scale(1) rotate(0deg); }
            to { transform: scale(1) rotate(360deg); }
        }

        @-webkit-keyframes spin2 {
            from { -webkit-transform: rotate(0deg); }
            to { -webkit-transform: rotate(360deg); }
        }

        .numeric{
            text-align: left;
            width: 100%;
        }
        .numeric{
            text-align: left;
            width: 100%;
        }

        .odd{
            background-color: #eeeeee !important;
        }
        .boldlabel1{
            font-weight:bold;
            font-size: 12px;
        }
        #tbl_process td:nth-child(5){
            text-align: right;
            padding-right: 10px!important;
        }
    </style>
    <?php echo $loaderscript; ?>
</head>
<body class="animated-content">
<?php echo $_top_navigation; ?>
<div id="wrapper">
    <div id="layout-static">
        <?php echo $_side_bar_navigation;?>
        <div class="static-content-wrapper white-bg">
            <div class="static-content" >
                <div class="page-content">
                    <div class="container-fluid panel-padding">
                    <div id="div_dtr_entry" style="display:none;">
                            <div class="panel panel-default panel-padding">
                                <div class="panel-inside">
                                    <div class="panel-inside1">
                                        <div class="panel-heading emp-panel-header">
                                    <div style="float: right;">
                                        <button class="btn delete btn-default" style="color: black;" id="btn_canceldtr" title="back" >
                                        <span class="glyphicon glyphicon-arrow-left"></span></button>
                                        <button class="btn btn-success"  id="print_all" title="Print All" >
                                        <span class="glyphicon glyphicon-print"></span></button>
                                    </div>
                                        <h2 style="color:white;font-weight:300;"> PaySlip (<period id="" class="periodcoveredtext"></period>)</h2> 
                                    </div>
                                    <div class="panel-body table-responsive" style="padding-top:5px;">
                                        <table id="tbl_process" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th></th>
                                                    <th style="width: 150px;">Payslip No</th>
                                                    <th>E-CODE</th>
                                                    <th>Fullname</th>
                                                    <th><center>Net Pay</center></th>
                                                    <th width="5%"><center>Action</center></th>
                                                 </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                <div class="panel-footer"></div>
                            </div> <!--panel default -->
                        </div>
                    </div>
                        </div> <!--list -->
                    </div>
                    </div><!-- .container-fluid -->
                </div> <!-- #page-content -->
            </div><!--static content -->
        </div><!--content wrapper -->
    </div><!--static layout -->
</div> <!--wrapper -->

            <div id="modal_filter" class="modal fade" role="dialog"><!--modal-->
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="modal-header" style="background-color:#ECEFF1;border-bottom: 5px solid #CFD8DC;">
                            <button type="button" style="color:white;" class="close"  data-dismiss="modal" aria-hidden="true">X</button>
                            <h4 class="modal-title" style="color:black;"><span id="modal_mode"> Select Pay Period (PaySlip) </h4>
                        </div>

                        <div class="modal-body">
                            <form id="frm_search_dtr">
                            <div class="row">
                              <div class="col-md-4">
                                <div class="form-group" style="margin-bottom:0px;">
                                    <label class="boldlabel">Year : </label>
                                    <select class="form-control" id="year" data-error-msg="This Field is Required!" required>
                                    <?php $minyear=1990; $maxyear=2500;
                                            while($minyear!=$maxyear){
                                                echo '<option value='.$minyear.'>'.$minyear.'</option>';
                                                $minyear++;
                                            }
                                    ?>
                                    </select>
                                </div>
                              </div>
                              <div class="col-md-8">
                                <div class="form-group" style="margin-bottom:0px;">
                                    <label class="boldlabel">Pay Period : </label>
                                    <select id='pay_period' class='form-control' name='emp_leaves_entitlement_id'>

                                </select>
                                </div>
                              </div>
                            </div><br>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group" style="margin-bottom:0px;">
                                        <label class="boldlabel">Period Start:</label>
                                        <input type="text" class="form-control" id="period_start" name="pay_period_start" placeholder="" data-error-msg="This Field is Required!" disabled >
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group" style="margin-bottom:0px;">
                                        <label class="boldlabel">Period End:</label>
                                        <input type="text" class="form-control" id="period_end" name="pay_period_end" placeholder="" data-error-msg="This Field is Required!" disabled >
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group" style="margin-bottom:0px;">
                                              <label class="boldlabel">Employee Status:</label>
                                              <select class="form-control" id="emp_status" name="emp_status">
                                                <option value="all">All</option>
                                                <option value="1" selected>Active</option>
                                                <option value="0">Inactive</option>
                                              </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group" style="margin-bottom:0px;">
                                              <label class="boldlabel">Branch:</label>
                                              <select class="form-control" id="ref_branch_id" name="ref_branch_id" id="sel1">
                                                <option value="all">All Branch</option>
                                               <?php
                                                    foreach($ref_branch as $row)
                                                    {
                                                        echo '<option value="'.$row->ref_branch_id  .'">'.$row->branch.'</option>';
                                                    }
                                                ?>
                                              </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group" style="margin-bottom:0px;">
                                              <label class="boldlabel">Department:</label>
                                              <select class="form-control" id="ref_department_id" name="ref_department_id" id="sel1">
                                                <option value="all">All Departments</option>
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
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button id="btn_select_payslip" type="button" class="btn btn-default btn-save">
                                <i class="fa fa-check-circle"></i> Select
                            </button>
                            <button id="btn_close_payslip" type="button" class="btn btn-default btn-close" data-dismiss="modal">    <i class="fa fa-times-circle"></i> Cancel
                            </button>
                        </div>
                    </div>
                </div>
                </div>
              <!-- Modal -->
              <div class="modal fade" id="modal_show_payslip" role="dialog">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div class="modal-header" style="background-color:#ECEFF1;border-bottom: 5px solid #CFD8DC;">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title" style="color:black;">Payslip of <payslipname id="payslipof"></payslipname></h4>
                    </div>
                    <div class="modal-body">
                      <div class="container-fluid" id="pay_slip_preview" style="overflow:scroll;width:100%;">
                      </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="print_pay_slip" class="btn btn-default btn-save">
                            <i class="fa fa-print"></i> Print
                        </button>
                        <!-- <button type="button" id="download_pay_slip" class="btn btn-default btn-save"><i class=""></i> PDF</button> -->
                        <button type="button" class="btn btn-default btn-close" data-dismiss="modal">
                            <i class="fa fa-times-circle"></i> Close
                        </button>
                    </div>
                  </div>
                </div>
              </div>
            <div id="modal_confirmation" class="modal fade" tabindex="-1" role="dialog"><!--modal-->
                <div class="modal-dialog modal-md" style="margin-top: 13%!important;">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                            <h4 class="modal-title"><span id="modal_mode"> </span><i class="fa fa-trash" style="color: red;"></i> Confirm Deletion</h4>
                        </div>
                        <div class="modal-body">
                            <center>
                                <p id="modal-body-message" style="font-size: 12pt!important;font-family: calibri;">
                                        Remove payslip of <employeename id="employeename"></employeename> for period (<period id="employeeperiod"></period>) ?
                                </p>
                            </center>
                        </div>
                        <div class="modal-footer">
                            <div class="row">
                                <div class="col-md-12">
                                        <button id="btn_yes" type="button" class="btn btn-default btn-save" data-dismiss="modal">   
                                            <i class="fa fa-check-circle"></i> Yes
                                        </button>
                                        <button id="btn_close" type="button" class="btn btn-default btn-close" data-dismiss="modal">
                                            <i class="fa fa-times-circle"></i> No
                                        </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

<?php echo $_rights; ?>
<script>

$(document).ready(function(){

    var dt;var _txnMode;var _txnModeRate;var _selectedDateCovered;var _selectedYear;var _selectedPayperiod; var _periodstart;var _periodend;var _selectedIDDepartment="all";var _selectedIDBranch="all";var _selectedemprate;var _selectedEmpget;var _pusheddata;var _selectRowObjtempdeduct;var _selectedIDtempdeduct;var _selectRowObjProcess;var _selectedID;var _selectRowObj;var _selectedStatus="all";

    var getPayslip=function(){
        dt_payslip=$('#tbl_process').DataTable({
            "fnInitComplete": function (oSettings, json) {
                $.unblockUI();
                },
            "aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            "order": [[ 2, "asc" ]],
            "ajax": {
            "url": "PaySlip/transaction/list",
            "type": "POST",
            "bDestroy": true,
            "data": function ( d ) {
                return $.extend( {}, d, {
                    "pay_period_id": _selectedPayperiod,
                    "ref_branch_id": _selectedIDBranch,
                    "ref_department_id": _selectedIDDepartment,
                    "emp_status": _selectedStatus
                    } );
                }
            },
            "columns": [
                {
                    "targets": [0],
                    "class":          "pay_slip_show",
                    "orderable":      false,
                    "data":           null,
                    "defaultContent": ""
                },
                { targets:[1],data: "payslip_no", },
                { targets:[2],data: "ecode", },
                { targets:[3],data: "full_name" },
                { targets:[4],data: "net_total",
                render: $.fn.dataTable.render.number( ',', '.', 2 )
                },
                {
                    targets:[5],
                    render: function (data, type, full, meta){
                        var right_payslip_delete='<button class="btn btn-default btn-sm btndelete" name="remove_payslip" data-toggle="tooltip" data-placement="top" title="Delete PaySlip"><i class="fa fa-trash"></i> </button>';
                        return '<center>'+right_payslip_delete+'</center>';
                    }
                }
            ],
            language: {
                         searchPlaceholder: "Search Employee Payslip"
                     },
            "rowCallback":function( row, data, index ){
            }
        });
    }

    var bindEventHandlers=(function(){
        var detailRows = [];

        _yearfilter=$("#year").select2({
            placeholder: "Select Year",
            allowClear: true
        });

        _yearfilter.select2('val', '');        

        _payperiodfilter=$("#pay_period").select2({
            placeholder: "Select Pay Period",
            allowClear: true
        });

        _payperiodfilter.select2('val', '');  
    
        _statusfilter=$("#emp_status").select2({
            placeholder: "Select Employee Status",
            allowClear: true
        });

        _statusfilter.select2('val', '');


        _departmentfilter=$("#ref_department_id").select2({
            placeholder: "Select Department",
            allowClear: true
        });

        _departmentfilter.select2('val', '');

        _branchfilter=$("#ref_branch_id").select2({
            placeholder: "Select Branch",
            allowClear: true
        });

        _branchfilter.select2('val', '');

        $('#year').change(function() {
            _selectedYear=$(this).val();
            getpayperiod().done(function(response){
                        var show2select="";
                        if(response.data.length==0){
                            $('#pay_period').html("<option>No Result</option>");
                            $('#period_start').val("");
                            $('#period_end').val("");
                            return;
                        }
                        var jsoncount=response.data.length-1;
                         for(var i=0;parseInt(jsoncount)>=i;i++){
                            show2select+='<option value='+response.data[i].pay_period_start+'~'+response.data[i].pay_period_end+'~'+response.data[i].pay_period_id+'>'+response.data[i].pay_period_start+' ~ '+response.data[i].pay_period_end+'</option>';
                         }
                         $('#pay_period').html(show2select);
                         var temppayperiod = $('#pay_period').val();
                        var payperiod = temppayperiod.split(/~/)
                        $('#period_start').val(payperiod[0]);
                        $('#period_end').val(payperiod[1]);
                        _selectedPayperiod=payperiod[2];
                        $('.periodcoveredtext').text('Period Covered : '+payperiod[0]+' ~ '+payperiod[1]);

                    }).always(function(){
                        $.unblockUI();
                        $('.modal_file_leave').modal('show');
                    });
            });

        $('#pay_period').change(function() {
            _payperiod=$(this).val();
            var payperiod = _payperiod.split(/~/)
            $('#period_start').val(payperiod[0]);
            $('#period_end').val(payperiod[1]);
            _selectedPayperiod=payperiod[2];
            $('.periodcoveredtext').text('Period Covered : '+payperiod[0]+' ~ '+payperiod[1]);
        });

        $('#ref_department_id').change(function() {
            _selectedIDDepartment=$(this).val();
        });

        $('#ref_branch_id').change(function() {
            _selectedIDBranch=$(this).val();
        });

        $('#emp_status').change(function() {
            _selectedStatus=$(this).val();
        });

        //CREATE NEW EMPLOYEEE
        $('#btn_dtr').click(function(){
            var d = new Date();
            var n = d.getFullYear();
             $('#year').val(n).trigger('change');
            getpayperiod().done(function(response){
                        var show2select="";
                        if(response.data.length==0){
                            $('#pay_period').html("<option>No Result</option>");
                            $('#period_start').val("");
                            $('#period_end').val("");
                            return;
                        }
                        var jsoncount=response.data.length-1;
                        for(var i=0;parseInt(jsoncount)>=i;i++){
                            show2select+='<option value='+response.data[i].pay_period_start+'~'+response.data[i].pay_period_end+'~'+response.data[i].pay_period_id+'>'+response.data[i].pay_period_start+' ~ '+response.data[i].pay_period_end+'</option>';
                        }
                        $('#pay_period').html(show2select);
                        var temppayperiod = $('#pay_period').val();
                        var payperiod = temppayperiod.split(/~/)
                        $('#period_start').val(payperiod[0]);
                        $('#period_end').val(payperiod[1]);
                        _selectedPayperiod=payperiod[2];
                        $('.periodcoveredtext').text('Period Covered : '+payperiod[0]+' ~ '+payperiod[1]);
                    }).always(function(){
                        $.unblockUI();
                        $('.modal_file_leave').modal('show');
                    });
            $('#modal_filter').modal('toggle');
        });

        $('#btn_select_payslip').click(function(){
            if(validateRequiredFields($('#frm_search_dtr'))){
                $('#tbl_process').DataTable().destroy();
                showSpinningProgressLoading();
                showPayslip();
                getPayslip();
                $('#modal_filter').modal('toggle');
            }
        });

        $('#btn_canceldtr').click(function(){
            hidePayslip();
            $('#tbl_process').dataTable().fnDestroy();
        });

    })();

    $('#tbl_process tbody').on( 'click', 'tr td.pay_slip_show', function () {
            _selectRowObj=$(this).closest('tr');
            var data=dt_payslip.row(_selectRowObj).data();
            _selectedID=data.pay_slip_id;
            $('#payslipof').text(data.full_name);
            $.ajax({
                    "dataType":"html",
                    "type":"POST",
                    "url":"PaySlip/layout/pay-slip/"+ _selectedID+"/0/fullview",
                    beforeSend : function(){
                    $('#pay_slip_preview').html("<center><img src='assets/img/loader/preloaderimg.gif'><h3>Loading...</h3></center>");
                },
            }).done(function(response){
                $('#pay_slip_preview').html(response);
            });
            $('#modal_show_payslip').modal('toggle');
    });

    $("#download_pay_slip").click(function(){
            window.location = "PaySlip/layout/pay-slip/"+ _selectedID+"/0/pdf";
    });

    $("#print_all").click(function(){
            window.open('PaySlip/layout/pay-slip-print-all/'+_selectedPayperiod+'/'+_selectedIDBranch+'/'+_selectedIDDepartment+'/'+_selectedStatus+'/','_blank');
    });

    $('#print_pay_slip').click(function(event){
            showinitializeprint();
            var currentURL = window.location.href;
            var output = currentURL.match(/^(.*)\/[^/]*$/)[1];
            output = output+"/assets/css/css_special_files.css";
            $("#pay_slip_preview").printThis({
                debug: false,
                importCSS: true,
                importStyle: false,
                printContainer: false,
                formValues:false,
                printDelay: 1000,
            });
            setTimeout(function() {
                 $.unblockUI();
            }, 1000);
    });

    $('#tbl_process tbody').on('click','button[name="remove_payslip"]',function(){
        _selectRowObj=$(this).closest('tr');
        var data=dt_payslip.row(_selectRowObj).data();
        _selectedID=data.pay_slip_id;
        emp_full_name = data.full_name; 
        emp_period = data.payperiod;

        $('#modal_confirmation').modal('show');
        $('#employeename').text(emp_full_name);
        $('#employeeperiod').text(emp_period);

    });

    $('#btn_yes').on('click', function(){
          removePayslip().done(function(response){}).always(function(){
            dt_payslip.row(_selectRowObj).remove().draw();
            $.unblockUI();
          });
    });

    var removePayslip=function(){
        return $.ajax({
            "dataType":"json",
            "type":"POST",
            "url":"PaySlip/transaction/delete",
            "data":{pay_slip_id : _selectedID},
            "beforeSend": showSpinningProgress($('#'))
        });
    };

    var processPayroll=function(){
        var _data = dt_process_payroll.$('input, select').serialize();
        return $.ajax({
            "dataType":"json",
            "type":"POST",
            "url":"DailyTimeRecord/transaction/processpayroll",
            "data":_data,
            "beforeSend": showSpinningProgress($('#btn_save_temp_deduction'))
        });
    };

    var getpayperiod=function(){

        var _data=$('#').serializeArray();
        _data.push({name : "year" ,value : _selectedYear});

        return $.ajax({
            "dataType":"json",
            "type":"POST",
            "url":"RefPayPeriodSetup/transaction/getpayperiod",
            "data":_data,
            "beforeSend": showSpinningProgressLoading()
        });
    };

    var showPayslip=function(){
        $('#div_dtr_entry').show();
    };

    var hidePayslip=function(){
        $('#div_dtr_entry').hide();
        $('#modal_filter').modal('toggle');
    };

    var validateRequiredFields=function(f){
        var stat=true;

        $('div.form-group').removeClass('has-error');
        $('input[required],textarea[required],select[required]',f).each(function(){

                if($(this).is('select')){
                if($(this).val()==0){
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
        $.blockUI({ message: '<img src="assets/img/loader/gears.svg"/><br><h4 style="color:#ecf0f1;">Saving Changes...</h4>',
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
        $.blockUI({ message: '<img src="assets/img/loader/gears.svg"/><br><h4 style="color:#ecf0f1;">Loading Data...</h4>',
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
        $.blockUI({ message: '<img src="assets/img/loader/gears.svg"/><br><h4 style="color:#ecf0f1;">Uploading Image...</h4>',
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

var d = new Date();
var n = d.getFullYear();
$('#year').val(n).trigger('change');
_selectedYear=n;

getpayperiod().done(function(response){
        var show2select="";
        if(response.data.length==0){
            $('#pay_period').html("<option>No Result</option>");
            $('#period_start').val("");
            $('#period_end').val("");
            return;
        }
        var jsoncount=response.data.length-1;
        for(var i=0;parseInt(jsoncount)>=i;i++){
            show2select+='<option value='+response.data[i].pay_period_start+'~'+response.data[i].pay_period_end+'~'+response.data[i].pay_period_id+'>'+response.data[i].pay_period_start+' ~ '+response.data[i].pay_period_end+'</option>';
        }
        $('#pay_period').html(show2select);
        var temppayperiod = $('#pay_period').val();
        var payperiod = temppayperiod.split(/~/)
        $('#period_start').val(payperiod[0]);
        $('#period_end').val(payperiod[1]);
        _selectedPayperiod=payperiod[2];
        $('.periodcoveredtext').text('Period Covered : '+payperiod[0]+' ~ '+payperiod[1]);
    }).always(function(){
        $.unblockUI();
        $('#modal_filter').modal('toggle');
    });
});
</script>
</body>
</html>
