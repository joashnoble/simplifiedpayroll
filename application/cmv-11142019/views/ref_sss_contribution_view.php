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
            text-align: right;
            width: 60%;
        }
        .sss_logo {
            width:60px;
            height:35px;
            padding-right:15px;
            margin-bottom:5px;
        }
        #div_product_list h2 {
            padding-top:15px;
        }
        .left {
            float:left;
        }
        .right {
            float:left;
            padding-left:70px !important;
        }
        #border-bottom {
            margin:0 !important;
        }
        #tbl_sss_contribution_list td{
            text-align: right;
            padding-right: 10px!important;
            padding: 5px!important;
        }
        #tbl_sss_contribution_list td:nth-child(9){
            text-align: center;
            padding-right: 0px!important;
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
                        <div id="div_product_list">
                            <div class="panel panel-default panel-padding">
                                <div class="panel-inside">
                                    <div class="panel-inside1">
                                            <div class="panel-heading emp-panel-header">
                                                <center><h2 style="color:white;"><img class="sss_logo" src="assets/img/logo/SSS.png"><b>SOCIAL SECURITY SYSTEM</b></h2></center>
                                                <button class="btn btn-default right_sss_create" id="btn_new" title="Create New SSS Contribution" style="float: right;margin-top: 18px;display: none;">
                                                    <i class="fa fa-file"></i> New SSS Contribution
                                                </button>
                                            </div>
                                            <div class="panel-body table-responsive" style="padding-top:8px;">
                                                <table id="tbl_sss_contribution_list" class="table table-striped table-bordered" cellspacing="0" width="100%" cellpadding="10">
                                                    <thead>
                                                        <tr>
                                                            <th colspan="2" style="background-color:#b71c1c;color:#FFF;padding: 0px!important;"><center>Range of Compensation</center></th>
                                                            <th style="padding: 0px!important;background: #B0BEC5;"></th>
                                                            <th colspan="3" style="background-color:#b71c1c;color:#FFF;padding: 0px!important;"><center>Social Security</center></th>
                                                            <th colspan="3" style="padding: 0px!important;background: #B0BEC5;"></th>
                                                        </tr>
                                                        <tr>
                                                            <th style="width: 120px;"><center>Salary Range From</center></th>
                                                            <th style="width: 100px;"><center>Salary Range To</center></th>
                                                            <th style="width: 150px;"><center>Monthly Salary Credit</center></th>
                                                            <th style="width: 100px;"><center>Employer</center></th>
                                                            <th style="width: 100px;"><center>Employee</center></th>
                                                            <th style="width: 100px;"><center>Sub Total</center></th>
                                                            <th style="width: 100px;"><center>EC</center></th>
                                                            <th style="width: 100px;"><center>Total</center></th>
                                                            <!-- <th width="10%"><center>Action</center></th> -->
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
                <h4 class="modal-title"><span id="modal_mode"></span><i class="fa fa-trash red"></i> Confirm Deletion</h4>
            </div>
            <div class="modal-body">
                <center>
                    <p id="modal-body-message" style="font-size: 12pt!important;font-family: calibri;">
                            Remove SSS Contribution?
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
            <div id="modal_create_sss_contribution" class="modal fade" tabindex="-1" role="dialog"><!--modal-->
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="modal-header" style="background-color:#ECEFF1;border-bottom: 5px solid #CFD8DC;">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
                            <h4 class="modal-title" style="color:black;"><span id="modal_mode"> </span>SSS Contribution : <transaction id="transaction"></transaction></h4>
                        </div>

                        <div class="modal-body">
                            <form id="frm_sss_contribution">
                                <div class="container" style="width:100% !important;">
                                    <div class="form-group">
                                        <label class="boldlabel">RANGE OF COMPENSATION</label><br>
                                        <label class="col-sm-5" for="inputEmail1">Salary Range From :</label>
                                        <div class="col-sm-7">
                                            <input class="form-control numeric" id="salary_range_from" name="salary_range_from" placeholder="Ex: 9,250.00" data-error-msg="This is Required!">
                                        </div>
                                    </div>
                                    <div class="form-group" style="padding-bottom:15px !important;">
                                      <label class="col-sm-5" for="inputPassword1">Salary Range To :</label>
                                        <div class="col-sm-7">
                                            <input class="form-control numeric" id="salary_range_to" name="salary_range_to" placeholder="Ex: 9,250.00" data-error-msg="This is Required!">
                                        </div>
                                    </div>
                                    <hr style="border-bottom:1px solid;">
                                    <div class="form-group" style="padding-bottom:15px !important;">
                                      <label class="col-sm-5" for="inputPassword1">Monthly Salary Credit :</label>
                                        <div class="col-sm-7">
                                            <input class="form-control numeric" id="monthly_salary_credit" name="monthly_salary_credit" placeholder="Ex: 9,250.00" data-error-msg="This is Required!">
                                        </div>
                                    </div>
                                    <hr style="border-bottom:1px solid;">
                                    <div class="form-group">
                                    <label class="boldlabel">SOCIAL SECURITY</label><br>
                                      <label class="col-sm-5" for="inputPassword1">Employer :</label>
                                        <div class="col-sm-7">
                                            <input class="form-control numeric" id="employer" name="employer" placeholder="Ex: 9,250.00" data-error-msg="This is Required!">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                      <label class="col-sm-5" for="inputPassword1">Employer's Contribution  :</label>
                                        <div class="col-sm-7">
                                            <input class="form-control numeric" id="employer_contribution" name="employer_contribution" placeholder="Ex: 9,250.00" data-error-msg="This is Required!">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                      <label class="col-sm-5" for="inputPassword1">Employee :</label>
                                        <div class="col-sm-7">
                                           <input class="form-control numeric" id="employee" name="employee" placeholder="Ex: 9,250.00" data-error-msg="This is Required!">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="modal-footer">
                            <button id="btn_create" type="button" class="btn btn-default btn-save">
                                <i class="fa fa-check-circle"></i> Save
                            </button>
                            <button id="btn_cancel" type="button" class="btn btn-default btn-close" data-dismiss="modal">
                                <i class="fa fa-times-circle"></i> Cancel
                            </button>
                        </div>
                    </div><!---content-->
                </div>
            </div><!---modal-->
<?php echo $_rights; ?>
<script>

$(document).ready(function(){
    var dt; var _txnMode; var _selectedID; var _selectRowObj;

    var initializeControls=function(){
        dt=$('#tbl_sss_contribution_list').DataTable({
            "aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            "ajax" : "RefSSS_Contribution/transaction/list",
            "columns": [

                { targets:[1],data: "salary_range_from",
                render: $.fn.dataTable.render.number( ',', '.', 2 )
                },
                { targets:[2],data: "salary_range_to",
                render: $.fn.dataTable.render.number( ',', '.', 2 )
                },
                { targets:[3],data: "monthly_salary_credit",
                render: $.fn.dataTable.render.number( ',', '.', 2 )
                },
                { targets:[4],data: "employer",
                render: $.fn.dataTable.render.number( ',', '.', 2 )
                },
                { targets:[5],data: "employee", 
                render: $.fn.dataTable.render.number( ',', '.', 2 )
                },
                { targets:[6],data: "sub_total",
                render: $.fn.dataTable.render.number( ',', '.', 2 )
                },
                { targets:[7],data: "employer_contribution",
                render: $.fn.dataTable.render.number( ',', '.', 2 )
                },
                { targets:[8],data: "total", 
                render: $.fn.dataTable.render.number( ',', '.', 2 )
                }
                // {
                //     targets:[9],
                //     render: function (data, type, full, meta){

                //         // return '<center>'+right_sss_edit+right_sss_delete+'</center>';
                //     }
                // }
            ],
            language: {
                         searchPlaceholder: "Search SSS Contribution"
                     },
            "rowCallback":function( row, data, index ){

                $(row).find('td').eq(5).attr({
                    "align": "left"
                });
            }
        });

        $('.numeric').autoNumeric('init');

    }();


    var bindEventHandlers=(function(){
        var detailRows = [];

        $('#tbl_sss_contribution_list tbody').on( 'click', 'tr td.details-control', function () {
            var tr = $(this).closest('tr');
            var row = dt.row( tr );
            var idx = $.inArray( tr.attr('id'), detailRows );

            if ( row.child.isShown() ) {
                tr.removeClass( 'details' );
                row.child.hide();

                detailRows.splice( idx, 1 );
            }
            else {
                tr.addClass( 'details' );

                row.child( format( row.data() ) ).show();

                if ( idx === -1 ) {
                    detailRows.push( tr.attr('id') );
                }
            }
        } );

        $('#tbl_sss_contribution_list tbody').on('click','button[name="edit_info"]',function(){
            _txnMode="edit";
            $('#modal_create_sss_contribution').modal('show');
            $('#transaction').text('Update');
            $('#transaction').css('color','#0277BD');
            _selectRowObj=$(this).closest('tr');
            var data=dt.row(_selectRowObj).data();
            _selectedID=data.ref_sss_contribution_id;

            $('input,textarea').each(function(){
                var _elem=$(this);
                $.each(data,function(name,value){
                    if(_elem.attr('name')==name){
                        _elem.val(value);
                    }
                });
            });

            hideRatesduties();
            hideemployeeList();
            showemployeeFields();
        });

        $('#tbl_sss_contribution_list tbody').on('click','button[name="remove_info"]',function(){
            _selectRowObj=$(this).closest('tr');
            var data=dt.row(_selectRowObj).data();
            _selectedID=data.ref_sss_contribution_id;

            $('#modal_confirmation').modal('show');
        });

        $('#btn_yes').click(function(){
            remove_SSS_Contribution().done(function(response){
                showNotification(response);
                dt.row(_selectRowObj).remove().draw();
                $.unblockUI();
            });
        });

        $('input[name="file_upload[]"]').change(function(event){
            var _files=event.target.files;

            $('#div_img_product').hide();
            $('#div_img_loader').show();

            var data=new FormData();
            $.each(_files,function(key,value){
                data.append(key,value);
            });

            console.log(_files);

            $.ajax({
                url : 'Products/transaction/upload',
                type : "POST",
                data : data,
                cache : false,
                dataType : 'json',
                processData : false,
                contentType : false,
                success : function(response){
                    $('#div_img_loader').hide();
                    $('#div_img_product').show();
                }
            });
        });

        $('#btn_new').click(function(){
            _txnMode="new";
            $('#modal_create_sss_contribution').modal('show');
            $('#transaction').text('New');
            $('#transaction').css('color','#558B2F');
            clearFields($('#frm_sss_contribution'));
        });

        $('#btn_create').click(function(){
            if(validateRequiredFields($('#frm_sss_contribution'))){
                if(_txnMode==="new"){
                    //alert("aw");
                    create_SSS_Contribution().done(function(response){
                        showNotification(response);
                        dt.row.add(response.row_added[0]).draw();
                        clearFields($('#frm_sss_contribution'))
                    }).always(function(){
                        $('#modal_create_sss_contribution').modal('toggle');
                        $.unblockUI();
                    });
                    return;
                }
                if(_txnMode==="edit"){
                    //alert("update");
                    update_SSS_Contribution().done(function(response){
                        showNotification(response);
                        dt.row(_selectRowObj).data(response.row_updated[0]).draw();
                    }).always(function(){
                        $('#modal_create_sss_contribution').modal('toggle');
                        $.unblockUI();
                    });
                    return;
                }
            }
            else{}
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

    var create_SSS_Contribution=function(){
        var _data=$('#frm_sss_contribution').serializeArray();

        return $.ajax({
            "dataType":"json",
            "type":"POST",
            "url":"RefSSS_Contribution/transaction/create",
            "data":_data,
            "beforeSend": showSpinningProgress($('#btn_save'))
        });
    };


    var update_SSS_Contribution=function(){
        var _data=$('#frm_sss_contribution').serializeArray();

        console.log(_data);
        _data.push({name : "ref_sss_contribution_id" ,value : _selectedID});
        //_data.push({name:"is_inventory",value: $('input[name="is_inventory"]').val()});

        //alert($('input[name="is_inventory"]').val());
        return $.ajax({
            "dataType":"json",
            "type":"POST",
            "url":"RefSSS_Contribution/transaction/update",
            "data":_data,
            "beforeSend": showSpinningProgress($('#btn_save'))
        });
    };

    var remove_SSS_Contribution=function(){
        return $.ajax({
            "dataType":"json",
            "type":"POST",
            "url":"RefSSS_Contribution/transaction/delete",
            "data":{ref_sss_contribution_id : _selectedID},
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

    var clearFields=function(f){
        $('input,textarea',f).val('');
        $(f).find('input:first').focus();
    };


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
