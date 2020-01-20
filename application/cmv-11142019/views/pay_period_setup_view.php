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
                                            <span id="emp-tbl-title">Pay Period Setup</span>
                                            <button class="btn btn-default right_payperiod_create"  id="btn_new" style="float: right;margin-top: 8px;" title="Create New Position">
                                                <i class="fa fa-plus"></i> New
                                            </button>
                                        </div>
                                        <div class="panel-body table-responsive" style="padding-top:8px;">
                                            <table id="tbl_payperiod_list" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th>Period Start</th>
                                                        <th>Period End</th>
                                                        <th>Period</th>
                                                        <th>Applicable Month</th>
                                                        <th>Applicable Year</th>
                                                        <th width="10%"><center>Action</center></th>
                                                     </tr>
                                                </thead>
                                                <tbody>

                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="panel-footer">
                                        </div>
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
                            Remove pay period <payperioddescription id="payperioddescription"></payperioddescription>?
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
<div id="modal_create_payperiod" class="modal fade" tabindex="-1" role="dialog" data-backdrop="static"><!--modal-->
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                <h4 class="modal-title"><span id="modal_mode"> </span><i class="fa fa-cog"></i> Pay Period Setup</h4>
            </div>
            <div class="modal-body">
                <form id="frm_payperiod">
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group" style="margin-bottom:0px;">
                        <label class="boldlabel">Period Start :</label>
                        <input type="text" name="pay_period_start" class="date-picker form-control" value="" placeholder="Period Start" data-error-msg="Date Start is required!" required>
                    </div>
                  </div>
                </div><br>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group" style="margin-bottom:0px;">
                        <label class="boldlabel">Period End :</label>
                        <input type="text" name="pay_period_end" class="date-picker form-control" value="" placeholder="Period End" data-error-msg="Date End is required!" required>
                    </div>
                  </div>
                </div><br>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group" style="margin-bottom:0px;">
                        <label class="boldlabel">Period :</label>
                        <select class="form-control" id="pay_period_sequence" name="pay_period_sequence" data-error-msg="Pay Period is Required!" required>
                            <option value="">Select Deduction Cycle</option>
                            <option value="1">1st Week</option>
                            <option value="2">2nd Week</option>
                            <option value="3">3rd Week</option>
                            <option value="4">4th Week</option>
                            <option value="5">5th Week</option>
                            <option value="6">1st Period</option>
                            <option value="7">2nd Period</option>
                            <option value="8">Whole Month</option>
                        </select>
                    </div>
                  </div>
                </div><br>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group" style="margin-bottom:0px;">
                        <label class="boldlabel">Applicable Month :</label>
                        <select class="form-control" id="month_id" name="month_id" data-error-msg="Applicable Month is required!" required>
                              <option value="">Select Month</option>
                              <?php foreach($months as $month){?>
                                    <option value="<?php echo $month->month_id; ?>">
                                        <?php echo $month->month_name; ?>
                                    </option>
                              <?php }?>
                        </select>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group" style="margin-bottom:0px;">
                        <label class="boldlabel">Applicable Year :</label>
                        <select class="form-control" id="year" name="year" data-error-msg="Applicable Year is required!" required>
                              <option value="">Select Year</option>
                              <?php
                                $startingYear = date('Y') - 5;
                                $endingYear = date('Y') + 5;
                                for ($i = $startingYear;$i <= $endingYear;$i++) { ?> 
                                <option value="<?php echo $i; ?>"><?php echo $i; ?></option><?php } ?>
                        </select>
                    </div>
                  </div>
                </div>
                </form>
            </div>
            <div class="modal-footer">
                <button id="btn_create" type="button" class="btn btn-default btn-save"><i class="fa fa-check-circle"></i> Save</button>
                <button id="btn_cancel" type="button" class="btn btn-default btn-close" data-dismiss="modal"><i class="fa fa-times-circle"></i> Cancel</button>
            </div>
        </div><!---content-->
    </div>
</div><!---modal-->
<?php echo $_rights; ?>
<script>
$(document).ready(function(){
    var dt; var _txnMode; var _selectedID; var _selectRowObj; var _isactive=0;
    var _payperiod_sequence; var _month; var _year;
    var initializeControls=function(){
        dt=$('#tbl_payperiod_list').DataTable({
            "aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            "bStateSave": true,
            "fnStateSave": function (oSettings, oData) {
                localStorage.setItem('DataTables_' + window.location.pathname, JSON.stringify(oData));
            },
            "fnStateLoad": function (oSettings) {
                var data = localStorage.getItem('DataTables_' + window.location.pathname);
                return JSON.parse(data);
            },
            "ajax" : "RefPayPeriodSetup/transaction/list",
            aaSorting: [[0, 'desc']],
            "columns": [
                { targets:[1],data: "pay_period_start" },
                { targets:[2],data: "pay_period_end" },
                { targets:[3],data: "pay_period_sequence",
                render: function (data, type, full, meta){
                        if(data == 1){
                            return "<span> 1st Week </span>";
                        }
                        if(data == 2){
                            return "<span> 2nd Week </span>";
                        }
                        if(data == 3){
                            return "<span> 3rd Week </span>";
                        }
                        if(data == 4){
                            return "<span> 4th Week </span>";
                        }
                        if(data == 5){
                            return "<span> 5th Week </span>";
                        }
                        if(data == 6){
                            return "<span> 1st Period </span>";
                        }
                        if(data == 7){
                            return "<span> 2nd Period </span>";
                        }
                        if(data == 8){
                            return "<span> WHOLE MONTH </span>";
                        }

                        else{
                            return "Not Set";
                        }
                    }
                },
                { targets:[4],data: "month_name" },
                { targets:[5],data: "pay_period_year" },
                {
                    targets:[6],
                    render: function (data, type, full, meta){

                        return '<center>'+right_payperiod_edit+right_payperiod_delete+'</center>';
                    }
                }

            ],
            language: {
                         searchPlaceholder: "Search Pay Period"
                     },
            "rowCallback":function( row, data, index ){
            }
        });

        $('.numeric').autoNumeric('init');

        _payperiod_sequence=$("#pay_period_sequence").select2({
            dropdownParent: $("#modal_create_payperiod"),
            placeholder: "Select Pay Period Sequence",
            allowClear: true
        });

        _payperiod_sequence.select2('val', null);

        _month=$("#month_id").select2({
            dropdownParent: $("#modal_create_payperiod"),
            placeholder: "Select Month",
            allowClear: true
        });

        _month.select2('val', null);

        _year=$("#year").select2({
            dropdownParent: $("#modal_create_payperiod"),
            placeholder: "Select Applicable Year",
            allowClear: true
        });

        _year.val(null).trigger("change");

    }();


    var bindEventHandlers=(function(){
        var detailRows = [];

        $('#tbl_payperiod_list tbody').on( 'click', 'tr td.details-control', function () {
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


        $('#tbl_payperiod_list tbody').on('click','button[name="edit_info"]',function(){
            _txnMode="edit";
            $('#modal_create_payperiod').modal('show');
            _selectRowObj=$(this).closest('tr');
            var data=dt.row(_selectRowObj).data();
            _selectedID=data.pay_period_id;
            $('.transaction_type').text('Edit');

            $('date,input,textarea,checkbox').each(function(){
                var _elem=$(this);
                $.each(data,function(name,value){
                    if(_elem.attr('name')==name){
                        _elem.val(value);
                    }
                });
            });

            _payperiod_sequence.select2('val',data.pay_period_sequence);
            _month.select2('val',data.month_id);
            _year.val(data.pay_period_year).trigger("change");
        });

        $('#tbl_payperiod_list tbody').on('click','button[name="remove_info"]',function(){
            _selectRowObj=$(this).closest('tr');
            var data=dt.row(_selectRowObj).data();
            _selectedID=data.pay_period_id;

            _pay_period_start=data.pay_period_start;
            _pay_period_end = data.pay_period_end;
            _pay_period_sequence = data.pay_period_sequence;
            _month_id = data.month_id;

            var sequence, month;

            if(_pay_period_sequence == 1){
               sequence = "1st Week";
            }
            else if(_pay_period_sequence == 2){
                sequence = "2nd Week";
            }
            else if(_pay_period_sequence == 3){
                sequence = "3rd Week";
            }
            else if(_pay_period_sequence == 4){
                sequence ="4th Week";
            }
            else if(_pay_period_sequence == 5){
                sequence = "5th Week";
            }
            else if(_pay_period_sequence == 6){
                sequence = "1st Period";
            }
            else if(_pay_period_sequence == 7){
                sequence ="2nd Period";
            }
            else if(_pay_period_sequence == 8){
                sequence ="Month";
            }


            if(_month_id == 1){
                month = "January";
            }
            else if(_month_id == 2){
                month = "February";
            }
            else if(_month_id == 3){
                month = "March";
            }
            else if(_month_id == 4){
                month = "April";
            }
            else if(_month_id == 5){
                month = "May";
            }
            else if(_month_id == 6){
                month = "June";
            }
            else if(_month_id == 7){
                month = "July";
            }
            else if(_month_id == 8){
                month = "August";
            }
            else if(_month_id == 9){
                month = "September";
            }
            else if(_month_id == 10){
                month = "October";
            }
            else if(_month_id == 11){
                month = "November";
            }
            else if(_month_id == 12){
                month = "December";
            }

            $('#payperioddescription').text('('+_pay_period_start+' to '+_pay_period_end+'), '+sequence+' of '+month);
            $('#modal_confirmation').modal('show');
        });

        $('#btn_yes').click(function(){
            removePayPeriod().done(function(response){
                showNotification(response);
                if(response.false==0){
                }
                else{
                    dt.row(_selectRowObj).remove().draw();
                }
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

        $('#frm_payperiod').on('click','input[id="active_year"]',function(){
            //$('.single-checkbox').attr('checked', false);
            if(_isactive==0){
                this.checked = true;
                _isactive = 1;
                //alert(_isactive);
            }

            else{
                this.checked = false;
                _isactive = 0;
                //alert(_isactive);
            }

        });

        $('#btn_new').click(function(){
            _txnMode="new";
            $('.transaction_type').text('New');
            $('#modal_create_payperiod').modal('show');
            clearFields($('#frm_payperiod'));
            $('#active_year').attr('checked', false);
        });

        $('#btn_create').click(function(){
            if(validateRequiredFields($('#frm_payperiod'))){
                if(_txnMode==="new"){
                    //alert("aw");
                    createPayPeriod().done(function(response){
                        showNotification(response);
                        dt.row.add(response.row_added[0]).draw();
                        clearFields($('#frm_payperiod'))
                    }).always(function(){
                        $('#modal_create_payperiod').modal('toggle');
                        $.unblockUI();
                    });

                    return;
                }
                if(_txnMode==="edit"){
                    //alert("update");
                    updatePayPeriod().done(function(response){
                        showNotification(response);
                        dt.row(_selectRowObj).data(response.row_updated[0]).draw();
                    }).always(function(){
                        $('#modal_create_payperiod').modal('toggle');
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

    var createPayPeriod=function(){
        var _data=$('#frm_payperiod').serializeArray();
        _data.push({name : "active_year" ,value : _isactive});

        return $.ajax({
            "dataType":"json",
            "type":"POST",
            "url":"RefPayPeriodSetup/transaction/create",
            "data":_data,
            "beforeSend": showSpinningProgress($('#btn_save'))
        });
    };


    var updatePayPeriod=function(){
        var _data=$('#frm_payperiod').serializeArray();
        _data.push({name : "active_year" ,value : _isactive});

        console.log(_data);
        _data.push({name : "pay_period_id" ,value : _selectedID});
        //_data.push({name:"is_inventory",value: $('input[name="is_inventory"]').val()});

        //alert($('input[name="is_inventory"]').val());
        return $.ajax({
            "dataType":"json",
            "type":"POST",
            "url":"RefPayPeriodSetup/transaction/update",
            "data":_data,
            "beforeSend": showSpinningProgress($('#btn_save'))
        });
    };

    var removePayPeriod=function(){
        return $.ajax({
            "dataType":"json",
            "type":"POST",
            "url":"RefPayPeriodSetup/transaction/delete",
            "data":{pay_period_id : _selectedID},
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
