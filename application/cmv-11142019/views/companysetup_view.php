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
    <?php echo $loaderscript; ?>
    <style type="text/css">
        .csrow{margin-top: -25px;}
        .control-label{
            font-size: 10pt;
        }
    </style>
</head>
<body class="animated-content">
<?php echo $loader; ?>
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
                                            <span id="emp-tbl-title">Company Setup</span>
                                        </div>
                                            <form id="frm_company_setup">
                                                <div class="container-fluid" style="padding-top:5px;background: #FFF;">
                                                    <?php foreach ($company_setup as $row){?>

                                                <div class="col-md-12" style="margin-top: 15px;"> 
                                                    <label class="control-label boldlabel" style="font-size: 15pt;"><span class="fa fa-cog"></span> Company Information</label>
                                                    <hr>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="col-md-10">
                                                        <div style="margin-top: 10px;">
                                                            <div class="col-md-3">
                                                                 <label class="control-label boldlabel">
                                                                    <i class="fa fa-list"></i> Company Name :
                                                                 </label>
                                                            </div>
                                                            <div class="form-group">
                                                                <div class="input-group">
                                                                    <span class="input-group-addon">
                                                                        <i class="fa fa-bank"></i>
                                                                     </span>
                                                                     <textarea id="company_name" name="company_name" class="form-control" placeholder="Company Name" data-error-msg="Company Name is required!" required><?php echo $row->company_name; ?></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="csrow">
                                                            <div class="col-md-3">
                                                                <label class="control-label boldlabel">
                                                                    <i class="fa fa-list"></i> Address :
                                                                </label>
                                                            </div>
                                                            <div class="form-group">
                                                                <div class="input-group">
                                                                    <span class="input-group-addon">
                                                                        <i class="fa fa-home"></i>
                                                                     </span>
                                                                     <textarea id="company_address" name="company_address" class="form-control" placeholder="Address" data-error-msg="Address is required!" required><?php echo $row->company_address; ?></textarea>
                                                                </div>
                                                            </div> 
                                                        </div>    
                                                        <div class="csrow">
                                                            <div class="col-md-3">
                                                                <label class="control-label boldlabel">
                                                                    <i class="fa fa-list"></i> Login Quote :
                                                                </label>
                                                            </div>
                                                            <div class="form-group">
                                                                <div class="input-group">
                                                                    <span class="input-group-addon">
                                                                        <i class="fa fa-home"></i>
                                                                     </span>
                                                                     <textarea id="login_quote" name="login_quote" class="form-control" placeholder="Login Quote" data-error-msg="Quote is required!" required><?php echo $row->login_quote; ?></textarea>
                                                                </div>
                                                            </div>   
                                                        </div>
                                                        <div class="csrow">
                                                            <div class="col-md-3">
                                                                <label class="control-label boldlabel">
                                                                    <i class="fa fa-mobile"></i> Contact No :
                                                                </label>
                                                            </div>
                                                            <div class="form-group">
                                                                <div class="input-group">
                                                                    <span class="input-group-addon">
                                                                        <i class="fa fa-mobile"></i>
                                                                     </span>
                                                                     <input type="text" id="company_number" name="company_number" value="<?php echo $row->company_number; ?>" class="form-control" placeholder="Contact No" data-error-msg="Contact No is required!" required style="width: 69%;">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="csrow">
                                                            <div class="col-md-3">
                                                                <label class="control-label boldlabel">
                                                                   <i class="fa fa-envelope"></i> Email Address :
                                                                </label>
                                                            </div>
                                                            <div class="form-group">
                                                                <div class="input-group">
                                                                    <span class="input-group-addon">
                                                                        <i class="fa fa-cloud"></i>
                                                                     </span>
                                                                     <input type="text" id="company_email" name="company_email" value="<?php echo $row->company_email; ?>" class="form-control" placeholder="Email Address" data-error-msg="TIN Number is required!" style="width: 69%;" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="csrow">
                                                            <div class="col-md-3">
                                                                 <label class="control-label boldlabel">Active Employee :</label>
                                                            </div>
                                                            <div class="form-group">
                                                                <div class="input-group">
                                                                    <span class="input-group-addon">
                                                                        <i class="fa fa-home"></i>
                                                                     </span>
                                                                     <input type="text" class="form-control" placeholder="No of Active Employee" name="no_of_employee" value="<?php echo $row->no_of_employee; ?>" readonly style="width: 69%;">
                                                                </div>
                                                            </div>   
                                                        </div>
                                                    </div>                                                        
                                                    <div class="col-md-2">
                                                            <div style="width:100%;height:300px;margin-top: 10px;">
                                                                <center>
                                                                <img name="company_image" src="<?php echo $row->company_image; ?>" height="130px;" width="130px;"></img>
                                                                </center>
                                                                <center>
                                                                     <button type="button" id="btn_browse" style="width:150px;margin-bottom:5px;" class="btn btn-primary">Browse Photo</button>
                                                                     <button type="button" id="btn_remove_photo" style="width:150px;" class="btn btn-danger">Remove</button>
                                                                     <input type="file" name="file_upload[]" class="hidden">
                                                                </center>
                                                            </div>
                                                    </div>

                                                    <div class="col-md-12" style="margin-top: -25px;"> 
                                                        <hr>
                                                        <label class="control-label boldlabel" style="font-size: 15pt;"><span class="fa fa-cog"></span> BIR Form Settings</label>
                                                        <hr>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="col-md-12">
                                                            <div class="">
                                                                <div class="col-md-4">
                                                                    <label class="control-label boldlabel" style="text-align:right;">
                                                                        Taxpayer's Name:
                                                                    </label>
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="input-group">
                                                                        <span class="input-group-addon">
                                                                            <i class="fa fa-user"></i>
                                                                         </span>
                                                                        <input type="text" id="registered_to" name="registered_to" value="<?php echo $row->registered_to; ?>" class="form-control" placeholder="Taxpayer">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="csrow">
                                                                 <div class="col-md-4">
                                                                    <label class="control-label boldlabel">
                                                                        Registered Address:
                                                                    </label>
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="input-group">
                                                                        <span class="input-group-addon">
                                                                            <i class="fa fa-code"></i>
                                                                         </span>
                                                                        <input type="text" id="registered_address" name="registered_address" value="<?php echo $row->registered_address; ?>" class="form-control" placeholder="Registered Address">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="csrow" style="width: 100%;">
                                                                <div class="col-md-4">
                                                                    <label class="control-label boldlabel">
                                                                       Region (Minimum Wage) :
                                                                    </label>
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="input-group">
                                                                        <span class="input-group-addon">
                                                                            <i class="fa fa-globe"></i>
                                                                         </span>
                                                                         <select class="form-control" name="wage_id" required data-error-msg="Region is required for BIR Settings." style="width: 100%!important;">
                                                                            <?php foreach($wages as $wage){?>
                                                                                <option value="<?php echo $wage->wage_id; ?>" <?php if($row->wage_id == $wage->wage_id){ echo 'selected'; }?>><?php echo $wage->region_wage; ?></option>
                                                                            <?php }?>
                                                                         </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="csrow">
                                                                <div class="col-md-4">
                                                                    <label class="control-label boldlabel">
                                                                        Zip Code:
                                                                    </label>
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="input-group">
                                                                        <span class="input-group-addon">
                                                                            <i class="fa fa-code"></i>
                                                                         </span>
                                                                        <input type="text" id="zip_code" value="<?php echo $row->zip_code; ?>" name="zip_code" class="form-control" placeholder="Zip Code">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="csrow">
                                                                <div class="col-md-4">
                                                                    <label class="control-label boldlabel">
                                                                        Telephone No:
                                                                    </label>
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="input-group">
                                                                        <span class="input-group-addon">
                                                                            <i class="fa fa-phone"></i>
                                                                         </span>
                                                                        <input type="text" id="telephone_no" value="<?php echo $row->telephone_no; ?>" name="telephone_no" class="form-control" placeholder="Telephone No">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="csrow">
                                                                <div class="col-md-4">
                                                                    <label class="control-label boldlabel">
                                                                        Tin No:
                                                                    </label>
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="input-group">
                                                                        <span class="input-group-addon">
                                                                            <i class="fa fa-code"></i>
                                                                         </span>
                                                                        <input type="text" id="tin_no" value="<?php echo $row->tin_no; ?>" name="tin_no" class="form-control" placeholder="TIN">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="csrow">
                                                                <div class="col-md-4">
                                                                    <label class="control-label boldlabel">
                                                                        RDO #:
                                                                    </label>
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="input-group">
                                                                        <span class="input-group-addon">
                                                                            <i class="fa fa-code"></i>
                                                                         </span>
                                                                        <input type="text" id="rdo_no" value="<?php echo $row->rdo_no; ?>" name="rdo_no" class="form-control" placeholder="RDO">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="csrow">
                                                                <div class="col-md-4">
                                                                    <label class="control-label boldlabel">
                                                                        Nature of Business:
                                                                    </label>
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="input-group">
                                                                        <span class="input-group-addon">
                                                                            <i class="fa fa-building"></i>
                                                                         </span>
                                                                        <input type="text" id="nature_of_business" value="<?php echo $row->nature_of_business; ?>" name="nature_of_business" class="form-control" placeholder="Nature of Business">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="csrow">
                                                                <div class="col-md-4">
                                                                    <label class="control-label boldlabel">
                                                                        Industry Classification:
                                                                    </label>
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="input-group">
                                                                        <span class="input-group-addon">
                                                                            <i class="fa fa-building"></i>
                                                                         </span>
                                                                        <input type="text" id="industry_classification" value="<?php echo $row->industry_classification; ?>" name="industry_classification" class="form-control" placeholder="Industry Classification ">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12" style="margin-top: -25px;"> 
                                                        <hr>
                                                        <label class="control-label boldlabel" style="font-size: 15pt;"><span class="fa fa-cog"></span> Company Login Settings</label>
                                                        <hr>
                                                    </div>
                                                </div>
                                                    <div class="col-md-8">
                                                        <div class="col-md-12">
                                                            <div class="">
                                                                <div class="col-md-4">
                                                                    <label class="control-label boldlabel" style="text-align:right;">
                                                                       <i class="fa fa-list"></i> Company Code :
                                                                    </label>
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="input-group">
                                                                        <span class="input-group-addon">
                                                                            <i class="fa fa-cloud"></i>
                                                                         </span>
                                                                        <input type="text" id="company_code" name="company_code" value="<?php echo $row->company_code; ?>" class="form-control" placeholder="Company Code" data-error-msg="Company Code is required!" readonly>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="csrow">
                                                                 <div class="col-md-4">
                                                                    <label class="control-label boldlabel">
                                                                       <i class="fa fa-lock"></i> Password :
                                                                    </label>
                                                                </div>
                                                                <div class="form-group" id="epassword">
                                                                    <div class="input-group">
                                                                        <span class="input-group-addon">
                                                                            <i class="fa fa-cloud"></i>
                                                                         </span>
                                                                        <input type="password" id="company_password" name="company_password" value="<?php echo $row->company_password; ?>" class="form-control" placeholder="Password" data-error-msg="Email Password is required!" required>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="csrow">
                                                                <div class="col-md-4">
                                                                    <label class="control-label boldlabel">
                                                                       <i class="fa fa-lock"></i> Confirm Password :
                                                                    </label>
                                                                </div>
                                                                <div class="form-group" id="cpassword">
                                                                    <div class="input-group">
                                                                        <span class="input-group-addon">
                                                                            <i class="fa fa-cloud"></i>
                                                                         </span>
                                                                        <input type="password" id="confirm_password" value="<?php echo $row->company_password; ?>" name="confirm_password" class="form-control" placeholder="Confirm Password" data-error-msg="Confirm Password is required!" required>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            </div>
                                                        </div>
                                                        <?php } ?>
                                                </div>
                                            </form>
                                            <div class="panel-footer">
                                                <div align="right">
                                                    <button id="btn_update" class="btn btn-default btn-save right_companysetup_edit" >
                                                        <span class="fa fa-check-circle"></span> Save Changes
                                                    </button>
                                                </div>
                                            </div>
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
<?php echo $_rights; ?>
<script>

$(document).ready(function(){
    var dt; var _txnMode; var _selectedID; var _selectRowObj;

    var validateRequiredFields=function(f){
    var stat=true;

    var pword = $('#company_password').val();
    var cpword = $('#confirm_password').val();

    $('div.form-group').removeClass('has-error');
    $('input[required],textarea[required],select[required]',f).each(function(){


            if($(this).val()==""){
                showNotification({title:"Error!",stat:"error",msg:$(this).data('error-msg')});
                $(this).closest('div.form-group').addClass('has-error');
                $(this).focus();
                stat=false;
                return false;
            }
            if(pword!=cpword){
                showNotification({title:"Error!",stat:"error",msg:"Pasword Doesnt Match"});
                $('#epassword').addClass('has-error');
                $('#cpassword').addClass('has-error');
                $('#confirm_password').focus();
                stat=false;
                return false;
            }

    });

    return stat;
    };


    //for select

    var month = $('#month_hidden').val();
    var year = $('#year_hidden').val();
    $('#applicable_month').val(month);
    $('#applicable_year').val(year);

    $('#btn_update').click(function(){
        if(validateRequiredFields($('#frm_company_setup'))){
                update_CompanySetup().done(function(response){
                showNotification(response);

                }).always(function(){
                    $.unblockUI();
                });
                return;
        }
        else{}
    });

    var create_CompanySetup=function(){
        var _data = $('#frm_company_setup').serializeArray();
        _data.push({name : "image_name" ,value : $('img[name="company_image"]').attr('src')});

        return $.ajax({
            "dataType":"json",
            "type":"POST",
            "url":"CompanySetup/transaction/create",
            "data":_data,
            "beforeSend": showSpinningProgress($('#btn_save'))
        });
    };

    var update_CompanySetup=function(){
        var _data=$('#frm_company_setup').serializeArray();
        _data.push({name : "company_image" ,value : $('img[name="company_image"]').attr('src')});

        return $.ajax({
            "dataType":"json",
            "type":"POST",
            "url":"CompanySetup/transaction/update",
            "data":_data,
            "beforeSend": showSpinningProgress($('#btn_save'))
        });
    };

    var remove_CompanySetup=function(){
        return $.ajax({
            "dataType":"json",
            "type":"POST",
            "url":"CompanySetup/transaction/delete",
            "data":{company_id : _selectedID},
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
        $('select',f).val(0);
        $(f).find('input:first').focus();
    };

    $('#btn_browse').click(function(event){
        event.preventDefault();
        $('input[name="file_upload[]"]').click();
    });

    $('input[name="file_upload[]"]').change(function(event){
        var _files=event.target.files;
        showSpinningProgressUpload();

        var data=new FormData();
        $.each(_files,function(key,value){
            data.append(key,value);
        });

        console.log(_files);

        $.ajax({
            url : 'CompanySetup/transaction/upload',
            type : "POST",
            data : data,
            cache : false,
            dataType : 'json',
            processData : false,
            contentType : false,
            success : function(response){
                        $.unblockUI();
                        $('img[name="company_image"]').attr('src',response.path);

                    }
        });
    });

    $('#btn_remove_photo').click(function(event){
        event.preventDefault();
        $('img[name="company_image"]').attr('src','assets/img/employee/anonymous-icon.png');
    });

});

</script>
</body>

</html>
