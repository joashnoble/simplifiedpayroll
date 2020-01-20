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
                                                <span id="emp-tbl-title">Employment Type List</span>
                                                <button class="btn btn-default right_emp_type_create" id="btn_new" style="float: right;margin-top: 8px;" title="Create New Employment Type" >
                                                    <i class="fa fa-plus"></i> New
                                                </button>
                                            </div>
                                            <div class="panel-body table-responsive" style="padding-top:8px;">
                                                <table id="tbl_employment_type" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                                    <thead>
                                                        <tr>
                                                            <th>Employment Type</th>
                                                            <th>Description</th>
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
                <button type="button" class="close"   data-dismiss="modal" aria-hidden="true">x</button>
                <h4 class="modal-title"><span id="modal_mode"> </span><i class="fa fa-trash red"></i> Confirm Deletion</h4>
            </div>
            <div class="modal-body">
                <center>
                    <p id="modal-body-message" style="font-size: 12pt!important;font-family: calibri;">
                            Remove <employmenttype id="employmenttype"></employmenttype> Employment Type?
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
<div id="modal_create_employmenttype" class="modal fade" tabindex="-1" role="dialog" data-backdrop="static"><!--modal-->
<div class="modal-dialog modal-md">
    <div class="modal-content" style="border: 1px solid #81C784;">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
            <h4 class="modal-title"><span id="modal_mode"> </span><i class="fa fa-home"></i> Employment Type : <transaction class="transaction_type"></transaction></h4>
        </div>
        <div class="modal-body">
            <form id="frm_employment_type">
            <div class="row">
              <div class="col-md-12">
                <div class="form-group" style="margin-bottom:0px;">
                    <label class="boldlabel"><span class="label-required">*</span> Employment Type :</label>
                    <input type="text" class="form-control" id="employment_type" name="employment_type" placeholder="Employment Type" data-error-msg="Employment Type is Required!" required>
                </div>
              </div>
            </div><br>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group" style="margin-bottom:0px;">
                    <label class="boldlabel">Description :</label>
                    <textarea type="text" class="form-control" id="description" name="description" placeholder="Description"></textarea>
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
        dt=$('#tbl_employment_type').DataTable({
            "aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            "ajax" : "RefEmploymentType/transaction/list",
            "columns": [
                { targets:[0],data: "employment_type" },
                { targets:[1],data: "description" },
                {
                    targets:[2],
                    render: function (data, type, full, meta){
                        return '<center>'+right_emp_type_edit+right_emp_type_delete+'</center>';
                    }
                }
            ],
            language: {
                         searchPlaceholder: "Search Employment Type"
                     },
            "rowCallback":function( row, data, index ){
            }
        });
        $('.numeric').autoNumeric('init');
    }();


    var bindEventHandlers=(function(){
        var detailRows = [];

        $('#tbl_employment_type tbody').on('click','button[name="edit_info"]',function(){
            _txnMode="edit";
            $('.transaction_type').text('Update');
            $('.transaction_type').css('color','#01579B');
            $('#modal_create_employmenttype').modal('show');
            _selectRowObj=$(this).closest('tr');
            var data=dt.row(_selectRowObj).data();
            _selectedID=data.ref_employment_type_id;

            $('input,textarea').each(function(){
                var _elem=$(this);
                $.each(data,function(name,value){
                    if(_elem.attr('name')==name){
                        _elem.val(value);
                    }
                });
            });
        });

        $('#tbl_employment_type tbody').on('click','button[name="remove_info"]',function(){
            _selectRowObj=$(this).closest('tr');
            var data=dt.row(_selectRowObj).data();
            _selectedID=data.ref_employment_type_id;
            _employment_type = data.employment_type;
            $('#employmenttype').text(_employment_type);
            $('#modal_confirmation').modal('show');

        });

        $('#btn_yes').click(function(){
            removeEmploymentType().done(function(response){
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
            $('#modal_create_employmenttype').modal('show');
            clearFields($('#frm_employment_type'));
        });

        $('#btn_create').click(function(){
            if(validateRequiredFields($('#frm_employment_type'))){
                if(_txnMode==="new"){
                    createEmploymentType().done(function(response){
                        showNotification(response);
                         if(response.stat=="error"){
                            $.unblockUI();
                             }
                        dt.row.add(response.row_added[0]).draw();
                        clearFields($('#frm_employment_type'))
                    }).always(function(){
                        $('#modal_create_employmenttype').modal('toggle');
                         $.unblockUI();
                    });
                    return;
                }
                if(_txnMode==="edit"){
                    updateEmploymentType().done(function(response){
                        showNotification(response);
                         if(response.stat=="error"){
                            $.unblockUI();
                             }
                        dt.row(_selectRowObj).data(response.row_updated[0]).draw();
                    }).always(function(){
                        $('#modal_create_employmenttype').modal('toggle');
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

    var createEmploymentType=function(){
        var _data=$('#frm_employment_type').serializeArray();
        return $.ajax({
            "dataType":"json",
            "type":"POST",
            "url":"RefEmploymentType/transaction/create",
            "data":_data,
            "beforeSend": showSpinningProgress($('#btn_save'))
        });
    };

    var updateEmploymentType=function(){
        var _data=$('#frm_employment_type').serializeArray();
        console.log(_data);
        _data.push({name : "ref_employment_type_id" ,value : _selectedID});
        return $.ajax({
            "dataType":"json",
            "type":"POST",
            "url":"RefEmploymentType/transaction/update",
            "data":_data,
            "beforeSend": showSpinningProgress($('#btn_save'))
        });
    };

    var removeEmploymentType=function(){
        return $.ajax({
            "dataType":"json",
            "type":"POST",
            "url":"RefEmploymentType/transaction/delete",
            "data":{ref_employment_type_id : _selectedID}
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
