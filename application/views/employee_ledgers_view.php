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
    <style type="text/css">
      input:read-only { 
          background-color: white!important;
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
                        <div id="div_2316_list">
                            <div class="panel panel-default panel-padding">
                                <div class="panel-inside">
                                    <div class="panel-inside1">
                                        <div class="panel-heading emp-panel-header">
                                             <h2 style="font-weight:300;">Employee Ledgers</h2>
                                             <span style="float: right;">
                                                <button type="button" class="btn btn-default btn-report padding5" id="print_employee_ledger" title="Print">
                                                    <i class="fa fa-print"></i>
                                                </button>
                                                <button type="button" class="btn btn-default btn-report padding5" id="export_13month_pay" title="Export">
                                                    <i class="fa fa-file-excel-o"></i>
                                                </button>
                                             </span>
                                        </div>
                                        <div class="panel-body table-responsive" style="padding-top:10px; margin-top: 10px; background: #ECEFF1;">
                                            <div style="padding-left: 10px;padding-right: 10px;">
                                              <div class="row">
                                                <div class="col-md-4">
                                                    <label class="black" style="font-weight: 500;" for="inputEmail1">
                                                      <i class="fa fa-user"></i> Employee :
                                                    </label>
                                                    <select class="form-control" name="employee_filter" id="employee_filter" data-error-msg="Employee is required" required>
                                                      <?php
                                                          foreach($employee as $employees){ ?>
                                                            <option value="<?php echo $employees->employee_id; ?>">
                                                              <?php echo $employees->full_name; ?>
                                                            </option>
                                                      <?php } ?>
                                                    </select>
                                                </div>
                                                <div class="col-md-2"></div>
                                                <div class="col-md-2">
                                                    <label class="black" style="font-weight: 500;" for="inputEmail1">
                                                        Loan Amount :
                                                    </label>
                                                    <input type="text" class="form-control" id="totalloanamount" readonly>
                                                </div>
                                                <div class="col-md-2">
                                                  <label class="black" style="font-weight: 500;" for="inputEmail1">
                                                        Deduct Per Pay :
                                                    </label>
                                                    <input type="text" class="form-control" id="deductperpay" readonly>
                                                </div>
                                                <div class="col-md-2">
                                                  <label class="black" style="font-weight: 500;" for="inputEmail1">
                                                        Loan Balance :
                                                    </label>
                                                    <input type="text" class="form-control" id="loanbalance" readonly>
                                                </div>
                                              </div>
                                              <div class="row" style="margin-top: 10px;">
                                                <div class="col-md-4">
                                                  <label class="black" style="font-weight: 500;" for="inputEmail1">
                                                        <i class="fa fa-list"></i> Loan :
                                                  </label>
                                                  <select class="form-control" name="loan_filter" id="loan_filter" data-error-msg="Loan is required" required>
                                                    <?php
                                                        foreach($ref_loan as $row){ ?>
                                                          <option value="<?php echo $row->ref_loan_id; ?>">
                                                            <?php echo $row->loan_type; ?>
                                                          </option>
                                                    <?php } ?>
                                                  </select>
                                                </div>
                                              </div>
                                          </div>
                                      <hr>
                                  </div>
                                  <div class="panel-footer" style="background: #FFF;">
                                      <div id="p_preview"></div>
                                      <div id="print_preview" style="display: none;"></div>
                                  </div>
                                  </div> <!--panel default -->
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
    var _employee;
    var _loan;

    _employee=$("#employee_filter").select2({
        placeholder: "Select Employee",
        allowClear: true
    });
    _employee.select2('val', '');

    _loan=$("#loan_filter").select2({
        placeholder: "Select Loan",
        allowClear: true
    });
    
    _loan.select2('val', '');

    var process_preview_empledger = function(){
      filter_employee_loan = $('#employee_filter').val();
      filter_loan_type = $('#loan_filter').val();

      //Load Page Loan Amount
      $.ajax({
          "dataType":"html",
          "type":"POST",
          "url":"PayrollReports/payrollreports/payroll-loan-amount-get/"+filter_employee_loan+"/"+filter_loan_type+"",
          beforeSend : function(){
                      $('#p_preview').html("<center><img src='assets/img/loader/preloaderimg.gif'><h3>Loading...</h3></center>");
                  },
              }).done(function(response){
                  var json = JSON.parse(response);
                  $('#totalloanamount').val(json.total_loan_amount);
                  $('#deductperpay').val(json.deduction_per_pay_amount);
                  $('#loanbalance').val(json.deduction_total_amount);
              });

      //Load Page Employee Ledger Table
      $.ajax({
          "dataType":"html",
          "type":"POST",
          "url":"PayrollReports/payrollreports/payroll-employee-ledger/"+filter_employee_loan+"/"+filter_loan_type+"/preview",
          beforeSend : function(){
                      $('#p_preview').html("<center><img src='assets/img/loader/preloaderimg.gif'><h3>Loading...</h3></center>");
                  },
              }).done(function(response){
                  $('#p_preview').html(response);
              });
    };

    var process_print_empledger = function(){
      filter_employee_loan = $('#employee_filter').val();
      filter_loan_type = $('#loan_filter').val();

      //Load Page Loan Amount
      $.ajax({
          "dataType":"html",
          "type":"POST",
          "url":"PayrollReports/payrollreports/payroll-loan-amount-get/"+filter_employee_loan+"/"+filter_loan_type+"",
          beforeSend : function(){
                      $('#p_preview').html("<center><img src='assets/img/loader/preloaderimg.gif'><h3>Loading...</h3></center>");
                  },
              }).done(function(response){
                  var json = JSON.parse(response);
                  $('#totalloanamount').val(json.total_loan_amount);
                  $('#deductperpay').val(json.deduction_per_pay_amount);
                  $('#loanbalance').val(json.deduction_total_amount);
              });

      //Load Page Employee Ledger Table
      $.ajax({
          "dataType":"html",
          "type":"POST",
          "url":"PayrollReports/payrollreports/payroll-employee-ledger/"+filter_employee_loan+"/"+filter_loan_type+"/print",
          beforeSend : function(){
                      $('#print_preview').html("<center><img src='assets/img/loader/preloaderimg.gif'><h3>Loading...</h3></center>");
                  },
              }).done(function(response){
                  $('#print_preview').html(response);
              });

    };

    process_preview_empledger();
    process_print_empledger();

    $("#employee_filter").change(function(){
      process_preview_empledger();
      process_print_empledger();
    });

    $("#loan_filter").change(function(){
      process_preview_empledger();
      process_print_empledger();
    });

    $('#print_employee_ledger').click(function(event){
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

    var showNotification=function(obj){
        PNotify.removeAll();
        new PNotify({
            title:  obj.title,
            text:  obj.msg,
            type:  obj.stat
        });
    };

    var showSpinningProgressLoading=function(e){
        $.blockUI({ message: '<img src="assets/img/gears.svg"/><br><h4 style="color:#ecf0f1;">Loading Data...</h4>',
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
