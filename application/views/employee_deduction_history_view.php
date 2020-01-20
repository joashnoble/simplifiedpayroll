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
                                             <h2 style="font-weight:300;">Employee Deduction History</h2>
                                             <span style="float: right;">
                                                <button type="button" class="btn btn-default btn-report padding5" id="btn_print_emp_deduct_history" title="Print">
                                                    <i class="fa fa-print"></i>
                                                </button>
                                                <button type="button" class="btn btn-default btn-report padding5" id="btn_export_emp_deduct_history" title="Export">
                                                    <i class="fa fa-file-excel-o"></i>
                                                </button>
                                             </span>
                                        </div>
                                        <div class="panel-body table-responsive" style="padding-top:10px; margin-top: 10px; background: #ECEFF1;">
                                            <div style="padding-left: 10px;padding-right: 10px;">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <label class="black" style="font-weight: 500;" for="inputEmail1">
                                                            <i class="fa fa-calendar"></i> Year :
                                                        </label>
                                                        <select class="form-control" name="year_filter" id="year_filter" data-error-msg="Pay Period Filter is required" required>
                                                          <?php $minyear=2016; $maxyear=2050;
                                                            while($minyear!=$maxyear){
                                                                echo '<option value='.$minyear.'>'.$minyear.'</option>';
                                                                $minyear++;
                                                            }
                                                          ?>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label class="black" style="font-weight: 500;" for="inputEmail1">
                                                            <i class="fa fa-user"></i> Employee Filter :
                                                        </label>
                                                        <select class="form-control" name="employee_filter" id="employee_filter" data-error-msg="Pay Period Filter is required" required>
                                                            <option value="0">Select Employee</option>
                                                        <?php
                                                            foreach($employee as $employees)
                                                            {
                                                                echo '<option value="'.$employees->employee_id  .'">'.$employees->full_name.'</option>';
                                                            }
                                                        ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                        </div>
                                        <div class="panel-footer" style="background: #FFF;">
                                            <div id="preview_emp_deduct_history"></div>
                                            <div id="print_emp_deduct_history" style="display: none;"></div>
                                        </div>
                                    </div> <!--panel default -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- container-fluid -->
                </div> <!-- #page-content -->
            </div><!--static content -->
        </div><!--content wrapper -->
    </div><!--static layout -->
</div> <!--wrapper -->

<?php echo $_rights; ?>
<script>
$(document).ready(function(){
    var employee_filter;
    employee_filter=$("#employee_filter").select2({
        placeholder: "Select Employee",
        allowClear: true
    });

    employee_filter.select2('val', null);
    var d = new Date();
    _datefilter=$("#year_filter").select2({
        placeholder: "Select Date",
        allowClear: true
    });
    _datefilter.select2('val', '');
    $('#year_filter').val(d.getFullYear()).trigger("change")


    var process_preview_emp_deduct_history = function(){
    year_filter = $('#year_filter').val();
    employee_filter = $('#employee_filter').val();

    $.ajax({
        "dataType":"html",
        "type":"POST",
        "url":"PayrollHistory/layout/employee-deduction-history/"+year_filter+"/"+employee_filter+"/preview",
        beforeSend : function(){
                    $('#preview_emp_deduct_history').html("<center><img src='assets/img/loader/preloaderimg.gif'><h3>Loading...</h3></center>");
                },
            }).done(function(response){
                $('#preview_emp_deduct_history').html(response);
            });
    };

    var process_print_emp_deduct_history = function(){
    year_filter = $('#year_filter').val();
    employee_filter = $('#employee_filter').val();

    $.ajax({
        "dataType":"html",
        "type":"POST",
        "url":"PayrollHistory/layout/employee-deduction-history/"+year_filter+"/"+employee_filter+"/print",
        beforeSend : function(){
                    $('#print_emp_deduct_history').html("<center><img src='assets/img/loader/preloaderimg.gif'><h3>Loading...</h3></center>");
                },
            }).done(function(response){
                $('#print_emp_deduct_history').html(response);
            });
    };

    $('#btn_export_emp_deduct_history').on('click', function() {
        year_filter = $('#year_filter').val();
        employee_filter = $('#employee_filter').val();
        window.open("PayrollHistory/layout/export-employee-deduction-history/"+year_filter+"/"+employee_filter+"","_self");
    });

    process_preview_emp_deduct_history();
    process_print_emp_deduct_history();

    $("#year_filter").change(function(){
        process_preview_emp_deduct_history();
    });

    $("#employee_filter").change(function(){
        process_preview_emp_deduct_history();
    });

    $('#btn_print_emp_deduct_history').click(function(event){
            showinitializeprint();
            var currentURL = window.location.href;
            var output = currentURL.match(/^(.*)\/[^/]*$/)[1];
            output = output+"/assets/css/css_special_files.css";
            $("#print_emp_deduct_history").printThis({
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
