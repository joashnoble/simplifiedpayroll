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
        #tbl_loan td{
            font-weight: 600!important;
        }
        #tbl_loan td:nth-child(4), #tbl_loan td:nth-child(5), #tbl_loan td:nth-child(6){
            text-align: right;
            padding-right: 10px!important;
        }
        input[type=checkbox]{
            cursor: pointer;
        }
        .chckbx_lbl{
            margin-right: 10px; 
            cursor: pointer;
        }
        body{
              -webkit-user-select: none;  /* Chrome 49+ */
              -moz-user-select: none;     /* Firefox 43+ */
              -ms-user-select: none;      /* No support yet */
              user-select: none;          /* Likely future */ 
        }
    </style>
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
                        <div id="div_product_list">
                            <div class="panel panel-default panel-padding">
                                <div class="panel-inside">
                                    <div class="panel-inside1">
                                            <div class="panel-heading emp-panel-header">
                                                <span id="emp-tbl-title">Loan &amp; Deduction List</span>
                                                <button class="btn btn-default right_loandeduction_create" id="btn_new" style="float: right;margin-top: 8px;" title="Create New Loan" >
                                                    <i class="fa fa-plus"></i> New
                                                </button>
                                            </div>
                                            <div class="panel-body table-responsive" style="padding-top:8px;">
                                                <table id="tbl_loan" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                                    <thead>
                                                        <tr>
                                                            <th width="10%">Ecode</th>
                                                            <th width="25%">Employee</th>
                                                            <th width="15%">Loan Type</th>
                                                            <th width="10%">Total Loan</th>
                                                            <th width="20%">Amortization / Deduction Amt</th>
                                                            <th width="10%">Balance</th>
                                                            <th width="10%"><center>Action</center></th>
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
                        </div> <!--rates and duties list -->
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
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                <h4 class="modal-title"><span id="modal_mode"> </span><i class="fa fa-trash"></i> Confirm Deletion</h4>
            </div>
            <div class="modal-body">
                <center>
                    <p id="modal-body-message" style="font-size: 12pt!important;font-family: calibri;">
                            Remove <loandeduction id="loandeduction"></loandeduction>?
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
<div id="modal_create_loan" class="modal fade" role="dialog" data-backdrop="static"><!--modal-->
<div class="modal-dialog modal-md">
    <div class="modal-content" style="border: 1px solid #81C784;">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
            <h4 class="modal-title"><span id="modal_mode"> </span><i class="fa fa-home"></i> Loan &amp; Deduction : <transaction class="transaction_type"></transaction></h4>
        </div>
        <div class="modal-body">
            <form id="frm_loan">
            <div class="row">
              <div class="col-md-12">
                <div class="form-group" style="margin-bottom:0px;">
                    <label class="boldlabel"><span class="label-required">*</span> Loan Type:</label>
                    <select class="form-control" name="ref_loan_id" id="ref_loan_id" data-error-msg="Loan Type is Required!" required>
                        <option value="">[ Select Loan Type ]</option>
                        <?php foreach($ref_loan AS $row){?>
                            <option value="<?php echo $row->ref_loan_id; ?>">
                                <?php echo $row->loan_type; ?>
                            </option>
                        <?php }?>
                    </select>
                </div>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-md-12">
                <div class="col-md-6">
                    <div class="form-group" style="margin-bottom:0px;">
                        <label class="boldlabel"><span class="label-required">*</span> Employee:</label>
                        <select class="form-control" name="employee" id="employee" data-error-msg="Employee is Required!" required>
                            <option value="" data-payfrequency-id="" data-payfrequency-type="">[ Select Employee ]</option>
                            <?php foreach($employee AS $row){?>
                                <option value="<?php echo $row->employee_id; ?>" data-payfrequency-id="<?php echo $row->ref_payfrequency_type_id; ?>" data-payfrequency-type="<?php echo $row->pay_frequency_type; ?>">
                                    <?php echo $row->ecode.'&nbsp;&nbsp;&nbsp;&nbsp;'.$row->full_name; ?>
                                </option>
                            <?php }?>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                <div class="form-group" style="margin-bottom:0px;">
                    <label class="boldlabel"> Payment Type:</label>
                    <input type="text" id="emp_pay_frequency" class="form-control" placeholder="Payment Type" readonly>
                </div>
                </div>
              </div>
            </div>
            <hr>
            <div class="row" style="margin-top: 10px;">
              <div class="col-md-12" style="margin-bottom: -20px!important;">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="boldlabel"><span class="label-required">*</span> Total Loan : </label> 
                        <input type="text" name="total_loan" id="total_loan" class="numeric form-control" placeholder="Total Loan" data-error-msg="Loan is Required!" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="boldlabel"><span class="label-required">*</span> Deduction Amount : </label>
                        <input type="text" name="deduction_amt" id="deduction_amt" class="numeric form-control" placeholder="Deduction Amount" data-error-msg="Deduction Amount is Required!" required>
                    </div>
                </div>
              </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="boldlabel"> Balance : </label>
                            <input type="text" name="balance" id="balance" class="numeric form-control" placeholder="Balance" readonly>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="boldlabel"><span class="label-required">*</span> Frequency:</label>
                            <div>
                                <span id="f1_panel"><input type="checkbox" id="f1"> <label class="chckbx_lbl" id="f1_lbl">F1</label></span>
                                <span id="f2_panel"><input type="checkbox" id="f2"> <label class="chckbx_lbl" id="f2_lbl">F2</label></span>
                                <span id="f3_panel"><input type="checkbox" id="f3"> <label class="chckbx_lbl" id="f3_lbl">F3</label></span>
                                <span id="f4_panel"><input type="checkbox" id="f4"> <label class="chckbx_lbl" id="f4_lbl">F4</label></span>
                                <span id="f5_panel"><input type="checkbox" id="f5"> <label class="chckbx_lbl" id="f5_lbl">F5</label></span>
                                <span id="all_panel"><input type="checkbox" id="all"> <label class="chckbx_lbl" id="all_lbl">All</label></span>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            </form>
        </div>
        <div class="modal-footer">
            <button id="btn_create" type="button" class="btn btn-default btn-save"><i class="fa fa-check-circle"></i> Save</button>
            <button id="btn_cancel" type="button" class="btn btn-default btn-close" data-dismiss="modal"><i class="fa fa-times-circle"></i> Close</button>
        </div>
    </div><!---content-->
</div>
</div><!---modal-->
<?php echo $_rights; ?>
<script>
$(document).ready(function(){
    var dt; var _txnMode; var _selectedID; var _selectRowObj;
    var initializeControls=function(){
        dt=$('#tbl_loan').DataTable({
            "aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            "ajax" : "RefLoan/transaction/list",
            "columns": [
                { targets:[0],data: "ecode" },
                { targets:[1],data: "full_name" },
                { targets:[2],data: "loan_type" },
                { targets:[3],data: "total_loan",
                    render: $.fn.dataTable.render.number( ',', '.', 2, '&#8369; ' )
                },
                { targets:[4],data: "deduction_amt",
                    render: $.fn.dataTable.render.number( ',', '.', 2, '&#8369; ' )
                },
                { targets:[5],data: "balance",
                    render: $.fn.dataTable.render.number( ',', '.', 2, '&#8369; ' )
                },
                {
                    targets:[6],
                    render: function (data, type, full, meta){
                        return '<center>'+right_loandeduction_edit+right_loandeduction_delete+'</center>';
                    }
                }
            ],
            language: {
                         searchPlaceholder: "Search Deduction"
                     }
        });
        $('.numeric').autoNumeric('init');

    }();


    var bindEventHandlers=(function(){
        var detailRows = [];

        _employeefilter=$("#employee").select2({
            placeholder: "[ Select Employee ]",
            allowClear: true
        });

        _employeefilter.select2('val', '');

        _frequencyfilter=$("#frequency").select2({
            placeholder: "[ Select Frequency ]",
            allowClear: true
        });

        _frequencyfilter.select2('val', '');

        _loantypefilter=$("#ref_loan_id").select2({
            placeholder: "[ Select Loan Type ]",
            allowClear: true
        });

        _loantypefilter.select2('val', '');

        $('#employee').on('change', function(){
            
            var ref_payfrequency_type_id = $('#employee option:selected').attr('data-payfrequency-id');
            var pay_frequency_type = $('#employee option:selected').attr('data-payfrequency-type');
            $('#emp_pay_frequency').val(pay_frequency_type);

            if (_txnMode == "new"){
                $('#f1').prop('checked', false);
                $('#f2').prop('checked', false);
                $('#f3').prop('checked', false);
                $('#f4').prop('checked', false);
                $('#f5').prop('checked', false);
                $('#all').prop('checked', false);
            }

            if (ref_payfrequency_type_id == 1){ // Semi Monthly
                $('#f1_panel').show();
                $('#f2_panel').show();
                $('#f3_panel').hide();
                $('#f4_panel').hide();
                $('#f5_panel').hide();
                $('#all_panel').hide();
            }else if (ref_payfrequency_type_id == 2){ // Monthly
                $('#f1_panel').show();
                $('#f2_panel').hide();
                $('#f3_panel').hide();
                $('#f4_panel').hide();
                $('#f5_panel').hide();
                $('#all_panel').hide();
            }else{ // Daily OR Weekly OR Semi Monthly w/o Sat
                $('#f1_panel').show();
                $('#f2_panel').show();
                $('#f3_panel').show();
                $('#f4_panel').show();
                $('#f5_panel').show();
                $('#all_panel').show();
            }
        });

        var initializeAllCheckbox = function(){
            var statf1 = $('#f1').is(':checked');
            var statf2 = $('#f2').is(':checked');
            var statf3 = $('#f3').is(':checked');
            var statf4 = $('#f4').is(':checked');
            var statf5 = $('#f5').is(':checked');

            if (statf1 == true && statf2 == true && statf3 == true && statf4 == true && statf5 == true){
                $('#all').prop('checked', true);
            }else{
                $('#all').prop('checked', false);
            }
        }

        var initializef1chkbx = function(){
            var stat = $('#f1').is(':checked');

            if(stat == false){
                $('#f1').prop('checked', true);
            }else{
                $('#f1').prop('checked', false);
            }
        }

        var initializef2chkbx = function(){
            var stat = $('#f2').is(':checked');

            if(stat == false){
                $('#f2').prop('checked', true);
            }else{
                $('#f2').prop('checked', false);
            }
        }

        var initializef3chkbx = function(){
            var stat = $('#f3').is(':checked');

            if(stat == false){
                $('#f3').prop('checked', true);
            }else{
                $('#f3').prop('checked', false);
            }
        }

        var initializef4chkbx = function(){
            var stat = $('#f4').is(':checked');

            if(stat == false){
                $('#f4').prop('checked', true);
            }else{
                $('#f4').prop('checked', false);
            }
        }

        var initializef5chkbx = function(){
            var stat = $('#f5').is(':checked');

            if(stat == false){
                $('#f5').prop('checked', true);
            }else{
                $('#f5').prop('checked', false);
            }
        }

        var initializeallchkbx = function(){
            var stat = $('#all').is(':checked');
                if(stat == false){
                    $('#f1').prop('checked', true);
                    $('#f2').prop('checked', true);
                    $('#f3').prop('checked', true);
                    $('#f4').prop('checked', true);
                    $('#f5').prop('checked', true);
                    $('#all').prop('checked', true);
                }else{
                    $('#f1').prop('checked', false);
                    $('#f2').prop('checked', false);
                    $('#f3').prop('checked', false);
                    $('#f4').prop('checked', false);
                    $('#f5').prop('checked', false);                
                    $('#all').prop('checked', false);
                }
        }
        //Frequency Checkbox

        $('#f1_lbl').click(function(){
            initializef1chkbx();
            initializeAllCheckbox();
        });

        $('#f2_lbl').click(function(){
            initializef2chkbx();
            initializeAllCheckbox();
        });

        $('#f3_lbl').click(function(){
            initializef3chkbx();
            initializeAllCheckbox();
        });

        $('#f4_lbl').click(function(){
            initializef4chkbx();
            initializeAllCheckbox();
        });

        $('#f5_lbl').click(function(){
            initializef5chkbx();
            initializeAllCheckbox();
        });        

        $('#all_lbl').click(function(){
            initializeallchkbx();        
        });

        $('#f1').click(function(){
            initializeAllCheckbox();
        });

        $('#f2').click(function(){
            initializeAllCheckbox();
        });

        $('#f3').click(function(){
            initializeAllCheckbox();
        });

        $('#f4').click(function(){
            initializeAllCheckbox();
        });

        $('#f5').click(function(){
            initializeAllCheckbox();
        });

        $('#all').click(function(){
            var stat = $('#all').is(':checked');
                if(stat == true){
                    $('#f1').prop('checked', true);
                    $('#f2').prop('checked', true);
                    $('#f3').prop('checked', true);
                    $('#f4').prop('checked', true);
                    $('#f5').prop('checked', true);
                    $('#all').prop('checked', true);
                }else{
                    $('#f1').prop('checked', false);
                    $('#f2').prop('checked', false);
                    $('#f3').prop('checked', false);
                    $('#f4').prop('checked', false);
                    $('#f5').prop('checked', false);                
                    $('#all').prop('checked', false);
                }
        });

        $('#total_loan').on('keyup',function(){
            var total_loan = parseFloat(accounting.unformat($(this).val()));
            $('#balance').val(accounting.formatNumber(total_loan,2));
        });

        $('#tbl_loan tbody').on('click','button[name="edit_info"]',function(){
            _txnMode="edit";
            $('.transaction_type').text('Update');
            $('.transaction_type').css('color','#01579B');
            $('#modal_create_loan').modal('show');
            _selectRowObj=$(this).closest('tr');
            var data=dt.row(_selectRowObj).data();
            _selectedID=data.loan_id;

            $('#total_loan').val(data.total_loan);
            $('input,textarea,select').each(function(){
                var _elem=$(this);
                $.each(data,function(name,value){
                    if(_elem.attr('name')==name){
                        _elem.val(value);
                    }
                });
            });

            $('#employee').val(data.employee_id).trigger('change');
            $('#ref_loan_id').val(data.ref_loan_id).trigger('change');
            $('#frequency').val(data.frequency).trigger('change');

            if (data.f1 == 1){
                $('#f1').prop('checked', true);
            }
            if (data.f2 == 1){
                $('#f2').prop('checked', true);
            }
            if (data.f3 == 1){
                $('#f3').prop('checked', true);
            }
            if (data.f4 == 1){
                $('#f4').prop('checked', true);
            }
            if (data.f5 == 1){
                $('#f5').prop('checked', true);
            }
            if (data.all == 1){
                $('#all').prop('checked', true);
            }
        });

        $('#tbl_loan tbody').on('click','button[name="remove_info"]',function(){
            _selectRowObj=$(this).closest('tr');
            var data=dt.row(_selectRowObj).data();
            _selectedID=data.loan_id;
            var full_name = data.full_name;
            var loan_type = data.loan_type;

            $('#modal_confirmation').modal('show');
            $('#loandeduction').text(loan_type+' of '+full_name);
        });

        $('#btn_yes').click(function(){
            removeLoan().done(function(response){
                showNotification(response);
                if(response.false==0){
                }
                else{
                    dt.row(_selectRowObj).remove().draw();
                }
                $.unblockUI();
            });
        });

        $('#btn_new').click(function(){
            _txnMode="new";
            $('.transaction_type').text('New');
            $('.transaction_type').css('color','#1B5E20');
            $('#modal_create_loan').modal('show');
            $('#f1').prop('checked', false);
            $('#f2').prop('checked', false);
            $('#f3').prop('checked', false);
            $('#f4').prop('checked', false);
            $('#f5').prop('checked', false);
            $('#all').prop('checked', false);
            clearFields($('#frm_loan'));
        });

        $('#btn_create').click(function(){
            if(validateRequiredFields($('#frm_loan'))){
                if(_txnMode==="new"){
                    createLoan().done(function(response){
                        showNotification(response);
                         if(response.stat=="error"){
                            $.unblockUI();
                             }
                        dt.row.add(response.row_added[0]).draw();
                        clearFields($('#frm_loan'))
                    }).always(function(){
                        $('#modal_create_loan').modal('toggle');
                         $.unblockUI();
                    });
                    return;
                }
                if(_txnMode==="edit"){
                    updateLoan().done(function(response){
                        showNotification(response);
                         if(response.stat=="error"){
                            $('#modal_create_loan').modal('toggle');
                            $.unblockUI();
                            return;
                        }else{
                            dt.row(_selectRowObj).data(response.row_updated[0]).draw();
                            $('#modal_create_loan').modal('toggle');
                        }
                    }).always(function(){
                         $.unblockUI();
                    });
                    return;
                }
            }
        });
    })();

    var validateRequiredFields=function(f){
        var stat=true;
        $('div.form-group').removeClass('has-error');
        $('input[required],textarea[required],select[required]',f).each(function(){
            if($(this).val()==""){
                showNotification({title:"Error!",stat:"error",msg:$(this).data('error-msg')});
                $(this).closest('div.form-group').addClass('has-error');
                $(this).focus();
                stat=false;
                return false;
            }
        });
        return stat;
    };

    var createLoan=function(){
        var _data=$('#frm_loan').serializeArray();

        var f1_stat = $('#f1').is(':checked');
        var f2_stat = $('#f2').is(':checked');
        var f3_stat = $('#f3').is(':checked');
        var f4_stat = $('#f4').is(':checked');
        var f5_stat = $('#f5').is(':checked');
        var all_stat = $('#all').is(':checked');

        if (f1_stat == true){_data.push({name : "f1" ,value : 1});}else{_data.push({name : "f1" ,value : 0});}
        if (f2_stat == true){_data.push({name : "f2" ,value : 1});}else{_data.push({name : "f2" ,value : 0});}
        if (f3_stat == true){_data.push({name : "f3" ,value : 1});}else{_data.push({name : "f3" ,value : 0});}
        if (f4_stat == true){_data.push({name : "f4" ,value : 1});}else{_data.push({name : "f4" ,value : 0});}
        if (f5_stat == true){_data.push({name : "f5" ,value : 1});}else{_data.push({name : "f5" ,value : 0});}
        if (all_stat == true){_data.push({name : "all" ,value : 1});}else{_data.push({name : "all" ,value : 0});}

        return $.ajax({
            "dataType":"json",
            "type":"POST",
            "url":"RefLoan/transaction/create",
            "data":_data,
            "beforeSend": showSpinningProgress($('#btn_save'))
        });
    };

    var updateLoan=function(){
        var _data=$('#frm_loan').serializeArray();
        var f1_stat = $('#f1').is(':checked');
        var f2_stat = $('#f2').is(':checked');
        var f3_stat = $('#f3').is(':checked');
        var f4_stat = $('#f4').is(':checked');
        var f5_stat = $('#f5').is(':checked');
        var all_stat = $('#all').is(':checked');

        if (f1_stat == true){_data.push({name : "f1" ,value : 1});}else{_data.push({name : "f1" ,value : 0});}
        if (f2_stat == true){_data.push({name : "f2" ,value : 1});}else{_data.push({name : "f2" ,value : 0});}
        if (f3_stat == true){_data.push({name : "f3" ,value : 1});}else{_data.push({name : "f3" ,value : 0});}
        if (f4_stat == true){_data.push({name : "f4" ,value : 1});}else{_data.push({name : "f4" ,value : 0});}
        if (f5_stat == true){_data.push({name : "f5" ,value : 1});}else{_data.push({name : "f5" ,value : 0});}
        if (all_stat == true){_data.push({name : "all" ,value : 1});}else{_data.push({name : "all" ,value : 0});}

        _data.push({name : "loan_id" ,value : _selectedID});
        return $.ajax({
            "dataType":"json",
            "type":"POST",
            "url":"RefLoan/transaction/update",
            "data":_data,
            "beforeSend": showSpinningProgress($('#btn_save'))
        });
    };

    var removeLoan=function(){
        return $.ajax({
            "dataType":"json",
            "type":"POST",
            "url":"RefLoan/transaction/delete",
            "data":{loan_id : _selectedID}
        });
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
                $.blockUI({ message: '<img src="assets/img/loader/gears.svg"/><br><h4 style="color:#ecf0f1;">Saving Changes</h4>',
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
        $('input,textarea,select',f).val('');
        $(f).find('input:first').focus();
        $('#employee').val('').trigger('change');
        $('#ref_loan_id').val('').trigger('change');
        $('#frequency').val('').trigger('change');
        $('#f1_panel').show();
        $('#f2_panel').show();
        $('#f3_panel').show();
        $('#f4_panel').show();
        $('#f5_panel').show();
        $('#all_panel').show();
    };


    function format ( d ) {
        return '<div class="container-fluid">'+
        '<div class="col-md-12">'+
        '<center><h4 class="boldlabel">Nothing Follows</h4></center>'+
        '</div>'+
        '</div>';
    };

});

</script>
</body>

</html>
