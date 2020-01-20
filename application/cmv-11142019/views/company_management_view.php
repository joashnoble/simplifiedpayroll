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
    <style type="text/css">
        td.details-control {
            background: url('assets/img/icon/Folder_Closed.png') no-repeat center center;
            cursor: pointer;
        }
        tr.details td.details-control {
            background: url('assets/img/icon/Folder_Opened.png') no-repeat center center;
        }
        input.number{
            text-align: right!important;
        }
    </style>
</head>
<body class="animated-content">
<div id="wrapper">
    <div id="layout-static">
        <div class="static-content-wrapper white-bg">
            <div class="static-content" >
                <div class="page-content">
                    <div class="container-fluid panel-padding">
                        <div id="div_product_list">
                            <div class="panel panel-default panel-padding">
                                <div class="panel-inside">
                                    <div class="panel-inside1">
                                            <div class="panel-heading emp-panel-header">
                                                <span id="emp-tbl-title">Company Management List</span>
                                                <a href="AdminLogin/transaction/logout" type="button" class="btn btn-default" style="float: right;margin-top: 8px;border-radius: 50%;margin-left: 5px;" title="Logout">
                                                    <i class="fa fa-sign-out"></i>
                                                </a>
                                                <button class="btn btn-default" id="btn_new" style="float: right;margin-top: 8px;border-radius: 50%;" title="Create New Company" >
                                                    <i class="fa fa-plus"></i>
                                                </button>
                                            </div>
                                            <div class="panel-body table-responsive" style="padding-top:8px;">
                                                <table id="tbl_company" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                                    <thead>
                                                        <tr>
                                                            <th style="width: 5px;"></th> 
                                                            <th style="width: 100px!important;">Code</th>
                                                            <th style="width: 300px!important;">Company Name</th>
                                                            <th style="width: 100px;"># Employees</th>
                                                            <th style="width: 100px;">Date Enrolled</th>
                                                            <th style="width: 80px;">Status</th>
                                                            <th style="min-width: 100px!important; max-width: 100px!important;"><center>Action</center></th>
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
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                <h4 class="modal-title"><span id="modal_mode"> </span><i class="fa fa-trash red"></i> Confirm Deletion of Company</h4>
            </div>
            <div class="modal-body">
                <center>
                    <p id="modal-body-message" style="font-size: 12pt!important;font-family: calibri;">
                            Are you sure to remove <companyname id="companyname"></companyname>'s Information?
                            <div style="font-size: 9pt;margin-top: -10px;">
                                <b><span class="red">Note:</span> Company's Data will automatically be archived.</b>
                            </div>
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

<div id="modal_activation" class="modal fade" tabindex="-1" role="dialog"><!--modal-->
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                <h4 class="modal-title">
                    <i class="fa fa-check-circle"></i> <span id="activation_mode"></span>
                </h4>
            </div>
            <div class="modal-body">
                <center>
                    <p id="modal-body-message" style="font-size: 12pt!important;font-family: calibri;">
                            <lblactivation id="lblactivation"></lblactivation><br />
                            <b><note id="note" class="red" style="font-size: 10pt;"></note> <notelbl id="notelbl" style="font-size: 10pt;"></notelbl></b>
                    </p>
                </center>
            </div>
            <div class="modal-footer">
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-6">
                            <button id="btn_activation" style="width: 100%;" type="button" class="btn btn-default btn-save" data-dismiss="modal">   
                                <i class="fa fa-check-circle"></i> Yes
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

<div id="modal_company_info" class="modal fade" tabindex="-1" role="dialog"><!--modal-->
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                <h4 class="modal-title">
                    <i class="fa fa-list"></i> <span class="company_name_desc"></span>
                </h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <span><i class="fa fa-info-circle"></i> Company Basic Information</span>
                    </div>
                    <div class="col-md-6">
                        <span style="float: right;margin-right: 50px;"><i class="fa fa-info-circle"></i> Status : <span id="company_status"></span></span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12"><hr></div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-1"></div>
                        <div class="col-md-3">
                            <span style="font-size: 9pt;"><b>Company Code : </b></span>
                        </div>
                        <div class="col-md-8">
                            <span class="company_code_desc"></span>
                        </div>
                    </div>                
                    <div class="col-md-12">
                        <div class="col-md-1"></div>
                        <div class="col-md-3">
                            <span style="font-size: 9pt;"><b>Company Name : </b></span>
                        </div>
                        <div class="col-md-8">
                            <span class="company_name_desc"></span>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="col-md-1"></div>
                        <div class="col-md-3">
                            <span style="font-size: 9pt;"><b>Nature of Business : </b></span>
                        </div>
                        <div class="col-md-8">
                            <span class="nature_of_business_desc"></span>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="col-md-1"></div>
                        <div class="col-md-3">
                            <span style="font-size: 9pt;"><b>No of Employee : </b></span>
                        </div>
                        <div class="col-md-8">
                            <span class="no_of_employee_desc"></span> Employees
                        </div>
                    </div>                    
                </div>
                <div class="row" style="margin-top: 15px;">
                    <div class="col-md-12">
                        <span><i class="fa fa-info-circle"></i> Company Contact Information</span>
                        <hr>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-1"></div>
                        <div class="col-md-3">
                            <span style="font-size: 9pt;"><b>Company Address : </b></span>
                        </div>
                        <div class="col-md-8">
                            <span class="company_address_desc"></span>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="col-md-1"></div>
                        <div class="col-md-3">
                            <span style="font-size: 9pt;"><b>Company Email : </b></span>
                        </div>
                        <div class="col-md-8">
                            <span class="company_email_desc"></span>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="col-md-1"></div>
                        <div class="col-md-3">
                            <span style="font-size: 9pt;"><b>Company Number : </b></span>
                        </div>
                        <div class="col-md-8">
                            <span class="company_number_desc"></span>
                        </div>
                    </div>
                </div>    
                <div class="row" style="margin-top: 15px;">
                    <div class="col-md-12">
                        <span><i class="fa fa-info-circle"></i> Other Information</span>
                        <hr style="height: 1px;">
                    </div>
                </div> 
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-1"></div>
                        <div class="col-md-3">
                            <span style="font-size: 9pt;"><b>Tin # : </b></span>
                        </div>
                        <div class="col-md-8">
                            <span class="tin_no_desc"></span>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="col-md-1"></div>
                        <div class="col-md-3">
                            <span style="font-size: 9pt;"><b>Date Enrolled : </b></span>
                        </div>
                        <div class="col-md-8">
                            <span class="date_enrolled_desc"></span>
                        </div>
                    </div>
                </div>         
 
            </div>
            <div class="modal-footer">
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-3"></div>
                        <div class="col-md-3"></div>
                        <div class="col-md-3"></div>
                        <div class="col-md-3">
                            <button id="btn_close" style="width: 100%;" type="button" class="btn btn-default btn-close" data-dismiss="modal">
                                <i class="fa fa-times-circle"></i> Close
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="modal_company_details" class="modal fade" tabindex="-1" role="dialog" data-backdrop="static"><!--modal-->
<div class="modal-dialog modal-md">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
            <h4 class="modal-title"><span id="modal_mode"> </span><i class="fa fa-building"></i> Company Details : <transaction class="transaction_type"></transaction></h4>
        </div>
        <div class="modal-body">
            <form id="frm_company">
            <div class="row">
                    <div class="col-md-6">
                        <div class="form-group" style="margin-bottom:0px;">
                            <label class="boldlabel"><span class="label-required">*</span> Company Code :</label>
                            <input type="text" class="form-control" id="company_code" name="company_code" placeholder="Company Code" data-error-msg="Company Code is required." required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group" style="margin-bottom:0px;">
                            <label class="boldlabel">
                                <span class="label-required">*</span> No of Employee :
                            </label>
                            <input type="text" class="number form-control" id="no_of_employee" name="no_of_employee" placeholder="No of Employee Enrolled" data-error-msg="No of Employee is required." required>
                        </div>
                    </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group" style="margin-bottom:0px;">
                    <label class="boldlabel"><span class="label-required">*</span> Company Name :</label>
                    <textarea class="form-control" id="company_name" name="company_name" placeholder="Company Name" data-error-msg="Company Name is required." required ></textarea>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group" style="margin-bottom:0px;">
                    <label class="boldlabel">
                        <i class="fa fa-home"></i> Address :
                    </label>
                    <textarea type="text" class="form-control" id="company_address" name="company_address" placeholder="Company Address"></textarea>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group" style="margin-bottom:0px;">
                    <label class="boldlabel">
                        <i class="fa fa-list"></i> Nature of Business :
                    </label>
                    <textarea type="text" class="form-control" id="nature_of_business" name="nature_of_business" placeholder="Nature of Business"></textarea>
                </div>
              </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group" style="margin-bottom:0px;">
                        <label class="boldlabel">
                            Tin # :
                        </label>
                        <input type="text" class="form-control" id="tin_no" name="tin_no" placeholder="Tin #">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group" style="margin-bottom:0px;">
                        <label class="boldlabel">
                            Mobile Number :
                        </label>
                        <input type="text" class="form-control" id="company_number" name="company_number" placeholder="Company Number">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                     <div class="form-group" style="margin-bottom:0px;">
                        <label class="boldlabel">
                            <span class="label-required">*</span> <i class="fa fa-envelope"></i> Email Address
                        </label>
                        <input type="email" class="form-control" id="company_email" name="company_email" placeholder="Email Address" data-error-msg="Company Email Address is required." required>
                    </div>
                </div>
                <div class="col-md-6">
                     <div class="form-group" style="margin-bottom:0px;">
                        <label class="boldlabel">
                            <i class="fa fa-calendar"></i> Date Enrolled
                        </label>
                        <input type="email" class="date-picker form-control" id="date_enrolled" name="date_enrolled" placeholder="Date Enrolled" data-error-msg="Date Enrolled is required.">
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
<script>
$(document).ready(function(){
    var dt; var _txnMode; var _selectedID; var _selectRowObj;
    var initializeControls=function(){
        dt=$('#tbl_company').DataTable({
            "aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            "ajax" : "CompanyManagement/transaction/list",
            "columns": [
                {
                    "targets": [0],
                    "class":          "details-control",
                    "orderable":      false,
                    "data":           null,
                    "defaultContent": ""
                },
                { targets:[1],data: "company_code" },
                { targets:[2],data: "company_name" },
                { targets:[3],data: "no_of_employee" },
                { targets:[4],data: "date_enrolled" },
                { targets:[5],data: null,
                    render: function (data, type, full, meta){
                        if (data.status == "Pending"){
                            return "<center><div style='background-color: orange;color: white; width: 100%;padding: 2px2px1px;border-radius; 1em;'>"+data.status+"</div></center>";
                        }else if (data.status == "Active"){
                            return "<center><div style='background-color: green;color: white; width: 100%;padding: 2px2px1px;border-radius; 1em;'>"+data.status+"</div></center>";
                        }else{
                            return "<center><div style='background-color: red;color: white; width: 100%;padding: 2px2px1px;border-radius; 1em;'>"+data.status+"</div></center>";
                        }
                    }
                },
                {
                    targets:[6], data: null,
                    render: function (data, type, full, meta){
                    var disabled_remove = "";

                    var btn_archive = "";

                    if (data.status =="Pending"){
                        disabled_remove = "";
                    }else if (data.status =="Inactive"){
                        disabled_remove = "";
                    }else if (data.status =="Active"){
                        disabled_remove = "disabled";
                    }



                    if (data.status =="Inactive" || data.status =="Pending"){
                        btn_archive='<button class="btn btn-default btn-sm btnactivate" name="activate_company" data-toggle="tooltip" data-placement="top" title="Activate"><i class="fa fa-check-circle"></i></button>';
                    }else{
                        btn_archive='<button class="btn btn-default btn-sm btndeactivate" name="activate_company" data-toggle="tooltip" data-placement="top" title="Deactivate"><i class="fa fa-times-circle"></i></button>';
                    }

                    var btn_edit='<button class="btn btn-default btn-sm btnedit" name="edit_info" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil"></i> </button>';
                    var btn_delete='<button class="btn btn-default btn-sm btndelete" name="remove_info" data-toggle="tooltip" data-placement="top" title="Move to trash" '+disabled_remove+'><i class="fa fa-trash-o"></i> </button>';

                        return '<center>'+btn_edit+btn_delete+btn_archive+'</center>';
                    }
                }
            ],
            language: {
                         searchPlaceholder: "Search Company"
                     },
            "rowCallback":function( row, data, index ){

            }
        });
        $('.numeric').autoNumeric('init');
        $('.number').autoNumeric('init', {mDec : 0});
    }();


    var bindEventHandlers=(function(){
        var detailRows = [];

        $('#tbl_company tbody').on('click','button[name="edit_info"]',function(){
            _txnMode="edit";
            $('.transaction_type').text('Update');
            $('.transaction_type').css('color','#01579B');
            $('#modal_company_details').modal('show');
            _selectRowObj=$(this).closest('tr');
            var data=dt.row(_selectRowObj).data();
            _selectedID=data.company_id;
            _date_enrolled = data.date_enrolled;

            $('input,textarea').each(function(){
                var _elem=$(this);
                $.each(data,function(name,value){
                    if(_elem.attr('name')==name){
                        _elem.val(value);
                    }
                });
            });


            if (_date_enrolled == "N/A"){
                $('#date_enrolled').val('');
            }else{
                $('#date_enrolled').val(_date_enrolled);
            }

        });

        $('#tbl_company tbody').on('click','button[name="remove_info"]',function(){
            _selectRowObj=$(this).closest('tr');
            var data=dt.row(_selectRowObj).data();
            _selectedID=data.company_id;
            _company_name = data.company_name;
            $('#companyname').text(_company_name);
            $('#modal_confirmation').modal('show');

        });

        $('#tbl_company tbody').on('click','button[name="activate_company"]',function(){
            _selectRowObj=$(this).closest('tr');
            var data=dt.row(_selectRowObj).data();
            _selectedID=data.company_id;
            _company_name = data.company_name;
            _status = data.status;

            var activatelbl;
            var lblactivation;
            var note;
            var notelbl;

            if (_status == "Pending" || _status == "Inactive"){
                activatelbl = "Activate Company";
                lblactivation = "Are you sure to activate ";
                notelbl = "";
                note = "";
            }else{
                activatelbl = "Deactivate Company";
                lblactivation = "Are you sure to deactivate ";
                notelbl = "Company's Data will automatically be archived.";
                note = "Note:";
            }

            $('#activation_mode').text(activatelbl);
            $('#lblactivation').text(lblactivation+_company_name+"?");
            $('#note').text(note);
            $('#notelbl').text(notelbl);

            $('#modal_activation').modal('show');

        });

        $('#btn_activation').click(function(){
            ActivationCompany().done(function(response){
                showNotification(response);
                dt.row(_selectRowObj).data(response.row_updated[0]).draw();
                 $.unblockUI();
            });
        });

        $('#btn_yes').click(function(){
            removeCompany().done(function(response){
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
            $('#modal_company_details').modal('show');
            clearFields($('#frm_company'));
        });

        $('#tbl_company tbody').on( 'click', 'tr td.details-control', function () {
            _selectRowObj=$(this).closest('tr');
            var data=dt.row(_selectRowObj).data();
            var company_status = data.status;
            var nature_of_business,
                company_address,
                company_number,
                tin_no;

            if (data.nature_of_business == ""){nature_of_business = "N/A";}else{nature_of_business = data.nature_of_business;}
            if (data.company_address == ""){company_address = "N/A";}else{company_address = data.company_address;}
            if (data.company_number == ""){company_number = "N/A";}else{company_number = data.company_number;}
            if (data.tin_no == ""){tin_no = "N/A";}else{tin_no = data.tin_no;}

            company_name = data.company_name;
            company_email = data.company_email;
            no_of_employee = data.no_of_employee;
            company_code = data.company_code;
            date_enrolled = data.date_enrolled;

            $('.company_name_desc').text(company_name);
            $('.company_address_desc').text(company_address);
            $('.company_email_desc').text(company_email);
            $('.company_number_desc').text(company_number);
            $('.tin_no_desc').text(tin_no);
            $('.no_of_employee_desc').text(no_of_employee);
            $('.nature_of_business_desc').text(nature_of_business);
            $('.company_code_desc').text(company_code);
            $('.date_enrolled_desc').text(date_enrolled);
            $('#company_status').text(company_status);

            if (company_status == "Pending"){
                $('#company_status').css('color','orange');
            }else if (company_status == "Inactive"){
                $('#company_status').css('color','red');
            }else if (company_status == "Active"){
                $('#company_status').css('color','green');
            }

            $('#modal_company_info').modal('show');
        });

        $('#btn_create').click(function(){
            if(validateRequiredFields($('#frm_company'))){
                if(_txnMode==="new"){
                    createCompany().done(function(response){
                        showNotification(response);
                         if(response.stat=="error"){
                            $.unblockUI();
                             }
                        dt.row.add(response.row_added[0]).draw();
                        clearFields($('#frm_company'))
                    }).always(function(){
                        $('#modal_company_details').modal('toggle');
                         $.unblockUI();
                    });
                    return;
                }
                if(_txnMode==="edit"){
                    updateCompany().done(function(response){
                        showNotification(response);
                         if(response.stat=="error"){
                            $.unblockUI();
                             }
                        dt.row(_selectRowObj).data(response.row_updated[0]).draw();
                    }).always(function(){
                        $('#modal_company_details').modal('toggle');
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
            if ($('#no_of_employee').val() <= 0){
                showNotification({title:"Error!",stat:"error",msg:"The No of Employee field cannot be 0."});
                $('#no_of_employee').focus();
                stat=false;
                return false;
            }
        });

        return stat;
    };

    var createCompany=function(){
        var _data=$('#frm_company').serializeArray();
        return $.ajax({
            "dataType":"json",
            "type":"POST",
            "url":"CompanyManagement/transaction/create",
            "data":_data,
            "beforeSend": showSpinningProgress($('#btn_save'))
        });
    };

    var updateCompany=function(){
        var _data=$('#frm_company').serializeArray();
        console.log(_data);
        _data.push({name : "company_id" ,value : _selectedID});
        return $.ajax({
            "dataType":"json",
            "type":"POST",
            "url":"CompanyManagement/transaction/update",
            "data":_data,
            "beforeSend": showSpinningProgress($('#btn_save'))
        });
    };

    var removeCompany=function(){
        return $.ajax({
            "dataType":"json",
            "type":"POST",
            "url":"CompanyManagement/transaction/delete",
            "data":{company_id : _selectedID}
        });
    };
    
    var ActivationCompany=function(){
        var _data=$('#').serializeArray();
        _data.push({name : "company_id" ,value : _selectedID});
        _data.push({name : "status" ,value : _status});
        return $.ajax({
            "dataType":"json",
            "type":"POST",
            "url":"CompanyManagement/transaction/Activate",
            "data":_data,
            "beforeSend": showSpinningProgress($('#btn_save'))
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
        $('input,textarea',f).val('');
        $(f).find('input:first').focus();
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
