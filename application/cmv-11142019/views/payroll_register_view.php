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
                        <div id="div_2316_list">
                            <div class="panel panel-default panel-padding">
                                <div class="panel-inside">
                                    <div class="panel-inside1">
                                    <div class="panel-heading emp-panel-header">
                                        <h2 style="font-weight:300;">Employee Payroll Register</h2>
                                        <span style="float: right;">
                                            <button type="button" class="btn btn-default btn-report padding5" id="print_emp_payroll" title="Print">
                                                <i class="fa fa-print"></i>
                                            </button>
                                            <button type="button" class="btn btn-default btn-report padding5" id="export_emp_payroll" title="Export">
                                                <i class="fa fa-file-excel-o"></i>
                                            </button>
                                        </span>
                                    </div>
                                    <div class="panel-body table-responsive" style="padding-top:10px; margin-top: 10px; background: #ECEFF1;">
                                        <div style="padding-left: 10px;padding-right: 10px;">
                                          <div class="row">
                                              <div class="col-md-6">
                                                  <label class="black" style="font-weight: 500;" for="inputEmail1">
                                                    <i class="fa fa-calendar"></i> Pay Period :
                                                  </label>
                                                  <select class="form-control" style="margin-left: 20px;" name="payperiod_filter" id="payperiod_filter" data-error-msg="Pay Period Filter is required" required>
                                                  <option value="0" selected>[ Select Pay Period ]</option>
                                                    <?php
                                                    foreach($payperiod as $payperiod)
                                                    {
                                                        echo '<option value="'.$payperiod->pay_period_id.'">'.$payperiod->pay_period_start." ~ ".$payperiod->pay_period_end.'</option>';
                                                    }
                                                    ?>
                                                  </select>
                                              </div>
                                              <div class="col-md-3"></div>
                                              <div class="col-md-3">
                                                  <label class="black" style="font-weight: 500;" for="inputEmail1">
                                                    <i class="fa fa-cog"></i> Payment Type:
                                                  </label>
                                                  <select class="form-control" name="payment_type_filter" id="payment_type_filter">
                                                    <option value="1">Cash Pay</option>
                                                    <option value="2">Check Pay</option>
                                                  </select>
                                              </div>
                                            </div>
                                            <div class="row" style="margin-top: 5px;">
                                               <div class="col-md-3">
                                                  <label class="black" style="font-weight: 500;" for="inputEmail1">
                                                    <i class="fa fa-building"></i> Branch :
                                                  </label>
                                                  <select class="form-control" name="branch_filter_list" id="branch_filter_list">
                                                    <option value="all">All</option>
                                                  <?php
                                                      foreach($branch as $branch){ ?>
                                                          <option value="<?php echo $branch->ref_branch_id; ?>">
                                                              <?php echo $branch->branch; ?>
                                                          </option>
                                                             <?php } ?>
                                                  </select>
                                              </div>
                                              <div class="col-md-3">
                                                  <label class="black" style="font-weight: 500;" for="inputEmail1">
                                                    <i class="fa fa-building"></i> Department :
                                                  </label>
                                                  <select class="form-control"  name="department_filter_list" id="department_filter_list">
                                                    <option value="all">All</option>
                                                  <?php
                                                      foreach($department as $department){ ?>
                                                          <option value="<?php echo $department->ref_department_id; ?>">
                                                              <?php echo $department->department; ?>
                                                          </option>
                                                             <?php } ?>
                                                  </select>
                                              </div>
                                              <div class="col-md-3"></div>
                                              <div class="col-md-3">
                                                  <label class="black" style="font-weight: 500;" for="inputEmail1">
                                                    <i class="fa fa-user"></i> Employee Status:
                                                  </label>
                                                  <select class="form-control" name="emp_status" id="emp_status">
                                                    <option value="all">All</option>
                                                    <option value="1" selected>Active</option>
                                                    <option value="0">Inactive</option>
                                                  </select>
                                              </div>
                                            </div>
                                        </div>
                                        <hr>
                                        </div>
                                            <div class="panel-footer" style="background: #FFF;">
                                                <div id="p_preview"></div>
                                                <div id="print_preview" style="display: none;">
                                        </div> <!--panel default -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- .container-fluid -->
                </div> <!-- #page-content -->
            </div><!--static content -->

        </div><!--content wrapper -->
    </div><!--static layout -->
</div> <!--wrapper -->

<?php echo $_rights; ?>
<script>

$(document).ready(function(){
    var _payperiod;
    var _department;
    var _branch;
    var _type; 
    var _empstatus;

    _type=$("#payment_type_filter").select2({
        placeholder: "Select Payment Type",
        allowClear: true
    });

    _type.select2('val', '');

    _empstatus=$("#emp_status").select2({
        placeholder: "Select Employee Status",
        allowClear: true
    });

    _empstatus.select2('val', '');

    _branch=$("#branch_filter_list").select2({
        placeholder: "Select Branch",
        allowClear: true
    });

    _branch.select2('val', ''); 

    _department=$("#department_filter_list").select2({
        placeholder: "Select Department",
        allowClear: true
    });

    _department.select2('val', '');

    _payperiod=$("#payperiod_filter").select2({
        placeholder: "Select Period",
        allowClear: true
    });

    _payperiod.select2('val', '');

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

    var process_preview_payroll_register = function(){
        filter_pay_period = $('#payperiod_filter').val();
        filter_branch = $('#branch_filter_list').val();
        filter_department = $('#department_filter_list').val();
        filter_type = $('#payment_type_filter').val();
        filter_empstatus = $('#emp_status').val();
     
          $.ajax({
              "dataType":"html",
              "type":"POST",
              "url":"PayrollHistory/layout/employeee-payroll-register/"+filter_pay_period+"/"+filter_branch+"/"+filter_department+"/"+filter_type+"/"+filter_empstatus+"/preview",
              beforeSend : function(){
                          $('#p_preview').html("<center><img src='assets/img/loader/preloaderimg.gif'><h3>Loading...</h3></center>");
                      },
                  }).done(function(response){
                      $('#p_preview').html(response);
                  });
    }

    var process_print_payroll_register = function(){
        filter_pay_period = $('#payperiod_filter').val();
        filter_branch = $('#branch_filter_list').val();
        filter_department = $('#department_filter_list').val();
        filter_type = $('#payment_type_filter').val();
        filter_empstatus = $('#emp_status').val();
     
          $.ajax({
              "dataType":"html",
              "type":"POST",
              "url":"PayrollHistory/layout/employeee-payroll-register/"+filter_pay_period+"/"+filter_branch+"/"+filter_department+"/"+filter_type+"/"+filter_empstatus+"/print",
              beforeSend : function(){
                          $('#print_preview').html("<center><img src='assets/img/loader/preloaderimg.gif'><h3>Loading...</h3></center>");
                      },
                  }).done(function(response){
                      $('#print_preview').html(response);
                  });
    }

    process_preview_payroll_register();
    process_print_payroll_register();

    $("#branch_filter_list").change(function(){
        process_preview_payroll_register();
        process_print_payroll_register();
    });

    $("#department_filter_list").change(function(){
        process_preview_payroll_register();
        process_print_payroll_register();
    });

    $("#payment_type_filter").change(function(){
        process_preview_payroll_register();
        process_print_payroll_register();
    });

    $("#payperiod_filter").change(function(){
        process_preview_payroll_register();
        process_print_payroll_register();
    });

    $("#emp_status").change(function(){
        process_preview_payroll_register();
        process_print_payroll_register();
    });

    $('#print_emp_payroll').click(function(event){
            showinitializeprint();
            var currentURL = window.location.href;
            var output = currentURL.match(/^(.*)\/[^/]*$/)[1];
            output = output+"/assets/css/css_special_files.css";
            $("#print_preview").printThis({
                debug: false,
                importCSS: true,
                importStyle: false,
                printContainer: false,
                printDelay: 1000,
                loadCSS: output,
                formValues:true
            });
            setTimeout(function() {
                 $.unblockUI();
            }, 1000);
    });

  $('#export_emp_payroll').on('click', function() {
        filter_pay_period = $('#payperiod_filter').val();
        filter_branch = $('#branch_filter_list').val();
        filter_department = $('#department_filter_list').val();
        filter_type = $('#payment_type_filter').val();
        filter_empstatus = $('#emp_status').val();

        window.open("PayrollHistory/layout/export-employeee-payroll-register/"+filter_pay_period+"/"+filter_branch+"/"+filter_department+"/"+filter_type+"/"+filter_empstatus+"","_self");
    });

    var showSpinningProgress2=function(e){
        $(e).toggleClass('disabled');
        $(e).find('span').toggleClass('glyphicon glyphicon-refresh spinning');
    };

    var showNotification=function(obj){
        PNotify.removeAll();
        new PNotify({
            title:  obj.title,
            text:  obj.msg,
            type:  obj.stat
        });
    };

    var clearFields=function(f){
        $('input,textarea',f).val('');
        $(f).find('input:first').focus();
        $("input:checkbox").prop('checked',false);
    };

    $('.date-picker').datepicker({
      format: "yyyy",
      startView: "year",
      minViewMode: "year",
      autoclose: true
    });

});

</script>
</body>

</html>
