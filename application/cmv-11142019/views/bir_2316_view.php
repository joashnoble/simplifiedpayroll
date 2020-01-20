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
        #tbl_2316_filter{
            display: none;
        }
        td.details-control-print {
            background: url('assets/img/icon/print.png') no-repeat center center;
            background-size: 20px 20px;
            cursor: pointer;
        }
        table td{
            padding: 5px!important;
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
                                         <h2 style="font-weight:300;"><b>
                                            <i class="fa fa-file"></i>
                                            BIR 2316</b> (Certificate of Compensation Payment / Tax Withheld) </h2>
                                         <span style="float: right;">
                                            <button type="button" class="btn btn-default btn-report padding5" id="print_1601C">
                                                <i class="fa fa-print"></i>
                                            </button>
                                            <button type="button" class="btn btn-default btn-report padding5" id="export_1601C">
                                                <i class="fa fa-file-excel-o"></i>
                                            </button>
                                         </span>
                                    </div>
                                    <div class="panel-body table-responsive" style="padding-top:10px; margin-top: 10px; background: #ECEFF1;">
                                        <div style="padding-left: 10px;padding-right: 10px;">
                                            <div class="row">
                                              <div class="col-md-4">
                                                  <label style="font-weight: bold;" for="inputEmail1">
                                                       <i class="fa fa-calendar"></i> Pay Period Year :
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
                                                  <label  style="font-weight: bold;" for="inputEmail1">
                                                       <i class="fa fa-building"></i> Branch :
                                                  </label>
                                                  <select class="form-control" name="branch_filter" id="branch_filter" data-error-msg="Branch Filter is required" required>
                                                    <option value="all">All</option>
                                                    <?php foreach($branch AS $row){?>
                                                        <option value="<?php echo $row->ref_branch_id; ?>">
                                                            <?php echo $row->branch; ?> 
                                                        </option>
                                                    <?php }?>
                                                  </select>
                                              </div>
                                              <div class="col-md-offset-1 col-md-3">
                                                  <label>
                                                      <b><i class="fa fa-search"></i> Search : </b>
                                                  </label>
                                                  <input type="text" class="form-control" name="searchbox_2316" id="searchbox_2316">
                                              </div>
                                            </div>
                                            <div class="row" style="margin-top: 5px;">
                                              <div class="col-md-4">
                                                  <label  style="font-weight: bold;" for="inputEmail1">
                                                       <i class="fa fa-user"></i> Employee Status :
                                                  </label>
                                                  <select class="form-control" name="emp_status" id="emp_status" data-error-msg="Branch Filter is required" required>
                                                    <option value="all">All</option>
                                                    <option value="1" selected>Active</option>
                                                    <option value="0">Inactive</option>
                                                  </select>
                                              </div>
                                              <div class="col-md-4">
                                                  <label  style="font-weight: bold;" for="inputEmail1">
                                                       <i class="fa fa-building"></i> Department :
                                                  </label>
                                                  <select class="form-control" name="department_filter" id="department_filter" data-error-msg="Department Filter is required" required>
                                                    <option value="all">All</option>
                                                    <?php foreach($department AS $row){?>
                                                        <option value="<?php echo $row->ref_department_id; ?>">
                                                            <?php echo $row->department; ?> 
                                                        </option>
                                                    <?php }?>
                                                  </select>
                                              </div>
                                            </div>
                                        <hr>
                                        </div>
                                    </div>
                                    <div class="panel-footer" style="background: #FFF;">
                                    <table id="tbl_2316" class="table table-striped table-bordered" cellspacing="0" cellpadding="5" width="100%">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>ECODE</th>
                                                <th>EMPLOYEE</th>
                                                <th>TIN NO</th>
                                                <th style="text-align: right;">GROSS PAY</th>
                                                <th style="text-align: right;">DEDUCTIONS</th>
                                                <th style="text-align: right;">NET PAY</th>
                                             </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div> <!--panel default -->
                            </div>
                        </div>
                    </div><!-- .container-fluid -->
                </div> <!-- #page-content -->
            </div><!--static content -->
        </div><!--content wrapper -->
    </div><!--static layout -->
</div> <!--wrapper -->
</div>

<?php echo $_rights;?>
<script>
$(document).ready(function(){
    var dt;
    var _year;
    var _month;
    var _branch;
    var _department;
    var _empstatus;

    var d = new Date();
    var n = d.getMonth();

    var initializeControls=function(){

        _year=$("#year_filter").select2({
            placeholder: "Select Period",
            allowClear: true
        });

        _year.select2('val', '');

        $('#year_filter').val(d.getFullYear()).trigger("change")

        _month=$("#month_filter").select2({
            placeholder: "Select Month",
            allowClear: true
        });

        _month.select2('val', '');

        _branch=$("#branch_filter").select2({
            placeholder: "Select Branch",
            allowClear: true
        });

        _branch.select2('val', '');

        _department=$("#department_filter").select2({
            placeholder: "Select Department",
            allowClear: true
        });

        _department.select2('val', '');

        _empstatus=$("#emp_status").select2({
            placeholder: "Select Employee Status",
            allowClear: true
        });

        _empstatus.select2('val', '');

         $('#month_filter').val(n+1).trigger("change")

        dt=$('#tbl_2316').DataTable({
            "bLengthChange":false,
            "order": [[ 2, "desc" ]],
            "ajax" : {
                "url" : "Bir_2316/layout/list",
                "bDestroy": true,            
                "data": function ( d ) {
                        return $.extend( {}, d, {
                            "pay_period_year":$('#year_filter').select2('val'),
                            "branch_id":$('#branch_filter').select2('val'),
                            "emp_status":$('#emp_status').select2('val'),
                            "department_id":$('#department_filter').select2('val')
                        });
                    }
            }, 
            "columns": [                      
                {
                    "targets": [0],
                    "class":          "details-control-print",
                    "orderable":      false,
                    "data":           null,
                    "defaultContent": ""
                },
                { targets:[1],data: "ecode" },
                { targets:[2],data: "employee_name" },
                { targets:[3],data: "tin" },
                {
                    className: "text-right",
                    targets:[4],data: "gross_pay",
                    render: function(data){
                        return accounting.formatNumber(data,2);
                    }
                },
                {
                    className: "text-right",
                    targets:[5],data: "deduction_pay",
                    render: function(data){
                        return accounting.formatNumber(data,2);
                    }
                },   
                {
                    className: "text-right",
                    targets:[6],data: "net_pay",
                    render: function(data){
                        return accounting.formatNumber(data,2);
                    }
                },       
            ],
        });
        $('.numeric').autoNumeric('init');
    }();
    

    var bindEventHandlers=(function(){
        var detailRows = [];
    
        $("#searchbox_2316").keyup(function(){         
            dt
                .search(this.value)
                .draw();
        });

        $('#tbl_2316 tbody').on( 'click', 'tr td.details-control-print', function () {
            var tr = $(this).closest('tr');
            var row = dt.row( tr );
            var idx = $.inArray( tr.attr('id'), detailRows );                
                var d=row.data();
                window.open("Payroll/transaction/print-form-2316/"+ d.employee_id+"?type=preview&pay_period_year="+_year.select2('val'));
        });

    })();

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

    var process_preview_1601C_report = function(){
        filter_year = $('#year_filter').val();
        filter_month = $('#month_filter').val();
        filter_branch = $('#branch_filter').val();
        filter_department = $('#department_filter').val();
        filter_empstatus = $('#emp_status').val();

        $.ajax({
        "dataType":"html",
        "type":"POST",
        "url":"PayrollReports/payrollreports/report1601C/"+filter_year+"/"+filter_month+"/"+filter_branch+"/"+filter_department+"/"+filter_empstatus+"/preview",
        beforeSend : function(){
                    $('#p_preview').html("<center><img src='assets/img/loader/preloaderimg.gif'><h3>Loading...</h3></center>");
                },
            }).done(function(response){
                $('#p_preview').html(response);
            });
    };

    var process_print_1601C_report = function(){
        filter_year = $('#year_filter').val();
        filter_month = $('#month_filter').val();
        filter_branch = $('#branch_filter').val();
        filter_department = $('#department_filter').val();
        filter_empstatus = $('#emp_status').val();

        $.ajax({
        "dataType":"html",
        "type":"POST",
        "url":"PayrollReports/payrollreports/report1601C/"+filter_year+"/"+filter_month+"/"+filter_branch+"/"+filter_department+"/"+filter_empstatus+"/print",
        beforeSend : function(){
                    $('#print_preview').html("<center><img src='assets/img/loader/preloaderimg.gif'><h3>Loading...</h3></center>");
                },
            }).done(function(response){
                $('#print_preview').html(response);
            });
    };

    // process_preview_1601C_report();
    // process_print_1601C_report();

    $("#year_filter").change(function(){
        // process_preview_1601C_report();
        // process_print_1601C_report();
        dt.ajax.reload( null, false );
    });

    $("#branch_filter").change(function(){
        // process_preview_1601C_report();
        // process_print_1601C_report();
        dt.ajax.reload( null, false );
    });

    $("#department_filter").change(function(){
        // process_preview_1601C_report();
        // process_print_1601C_report();
        dt.ajax.reload( null, false );
    });

    $("#emp_status").change(function(){
        // process_preview_1601C_report();
        // process_print_1601C_report();
        dt.ajax.reload( null, false );
    });

    $('#export_1601C').click(function(){

        filter_year = $('#year_filter').val();
        filter_month = $('#month_filter').val();
        filter_branch = $('#branch_filter').val();
        filter_department = $('#department_filter').val();
        filter_empstatus = $('#emp_status').val();

        window.open("Report1601C/layout/export_1601C/"+filter_year+"/"+filter_month+"/"+filter_branch+"/"+filter_department+"/"+filter_empstatus+"","_self");
    });

    $('#print_1601C').click(function(event){
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
