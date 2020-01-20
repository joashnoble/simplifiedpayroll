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
                                            <span id="emp-tbl-title">Factor File</span>
                                        </div>
                                    	<div class="panel-body table-responsive">
                                        <form id="frm_factorfile">
		                            		<div class="row container" style="width:100%;">
				                              <div class="col-md-4">
				                                <div class="form-group" style="margin-bottom:0px;">
				                                    <label class="boldlabel">Regular OT :</label>
				                                    <?php
				                                    	foreach($reffactorfile as $row) {?>
				                                    		<input type="hidden" name="factor_id" id="factor_id" value="<?php echo $row->factor_id; ?>">
				                                    <?php } ?>
				                                    <?php
				                                    	foreach($reffactorfile as $row) {
				                                    		echo '<input type="text" class="form-control" id="regular_ot" name="regular_ot" value="'. $row->regular_ot .'" placeholder="Regular OT" data-error-msg="Regular OT is Required!" required>';
				                                		}
				                                	?>
				                                </div>
				                                <div class="form-group" style="margin-bottom:0px;">
				                                    <label class="boldlabel">Sunday :</label>

				                                    <?php
				                                    	foreach($reffactorfile as $row) {
				                                   			echo '<input type="text" class="form-control" id="sunday" name="sunday" value="'. $row->sunday .'" placeholder="Sunday" data-error-msg="Sunday is Required!" required>';
				                                		}
				                                	?>

				                                </div>
				                                <div class="form-group" style="margin-bottom:0px;">
				                                    <label class="boldlabel">Day Off :</label>

				                                    <?php
				                                    	foreach($reffactorfile as $row) {
				                                   			echo '<input type="text" class="form-control" id="day_off" name="day_off" value="'. $row->day_off .'" placeholder="Day Off" data-error-msg="Day Off is Required!" required>';
				                                		}
				                                	?>

				                                </div>
				                                <div class="form-group" style="margin-bottom:0px;">
				                                    <label class="boldlabel">Sunday OT :</label>

				                                    <?php
				                                    	foreach($reffactorfile as $row) {
				                                    		echo '<input type="text" class="form-control" id="sunday_ot" name="sunday_ot" value="'. $row->sunday_ot .'" placeholder="Sunday OT" data-error-msg="Sunday OT is Required!" required>';
				                                		}
				                                	?>

				                                </div>
				                                <div class="form-group" style="margin-bottom:0px;">
				                                    <label class="boldlabel">Regular Holiday :</label>

				                                    <?php
				                                    	foreach($reffactorfile as $row) {
				                                    		echo '<input type="text" class="form-control" id="regular_holiday" name="regular_holiday" value="'. $row->regular_holiday .'" placeholder="Regular Holiday" data-error-msg="Regular Holiday is Required!" required>';
				                                		}
				                                	?>

				                                </div>
				                                <div class="form-group" style="margin-bottom:0px;">
				                                    <label class="boldlabel">Regular Holiday OT :</label>

				                                    <?php
				                                    	foreach($reffactorfile as $row) {
				                                    		echo '<input type="text" class="form-control" id="regular_holiday_ot" name="regular_holiday_ot" value="'. $row->regular_holiday_ot .'" placeholder="Regular Holiday OT" data-error-msg="Regular Holiday OT is Required!" required>';
				                                    	}
				                                    ?>

				                                </div>
				                                <div class="form-group" style="margin-bottom:0px;">
				                                    <label class="boldlabel">Sunday Regular Holiday :</label>

				                                    <?php
				                                    	foreach($reffactorfile as $row) {
				                                    		echo '<input type="text" class="form-control" id="sun_regular_holiday" name="sun_regular_holiday" value="'. $row->sun_regular_holiday .'" placeholder="Sunday Regular Holiday" data-error-msg="Sunday Regular Holiday is Required!" required>';
				                                    	}
				                                    ?>

				                                </div>
				                              </div>


				                              <div class="col-md-4">
				                                <div class="form-group" style="margin-bottom:0px;">
				                                    <label class="boldlabel">Sunday Regular Holiday OT :</label>

				                                    <?php
				                                    	foreach($reffactorfile as $row) {
				                                    		echo '<input type="text" class="form-control" id="sun_regular_holiday_ot" name="sun_regular_holiday_ot" value="'. $row->sun_regular_holiday_ot .'" placeholder="Sunday Regular Holiday OT" data-error-msg="Sunday Regular Holiday OT is Required!" required>';
				                                    	}
				                                    ?>

				                                </div>
				                                <div class="form-group" style="margin-bottom:0px;">
				                                    <label class="boldlabel">Special Holiday :</label>

				                                    <?php
				                                    	foreach($reffactorfile as $row) {
				                                    		echo '<input type="text" class="form-control" id="spe_holiday" name="spe_holiday" value="'. $row->spe_holiday .'" placeholder="Sunday Special Holiday" data-error-msg="Sunday Special Holiday is Required!" required>';
				                                    	}
				                                    ?>

				                                </div>
				                                <div class="form-group" style="margin-bottom:0px;">
				                                    <label class="boldlabel">Special Holiday OT :</label>

				                                    <?php
				                                    	foreach($reffactorfile as $row) {
				                                    		echo '<input type="text" class="form-control" id="spe_holiday_ot" name="spe_holiday_ot" value="'. $row->spe_holiday_ot .'" placeholder="Sunday Special Holiday" data-error-msg="Sunday Special Holiday is Required!" required>';
				                                    	}
				                                    ?>

				                                </div>
				                                <div class="form-group" style="margin-bottom:0px;">
				                                    <label class="boldlabel">Sunday Special Holiday :</label>

				                                    <?php
				                                    	foreach($reffactorfile as $row) {
				                                    		echo '<input type="text" class="form-control" id="sun_spe_holiday" name="sun_spe_holiday" value="'. $row->sun_spe_holiday .'" placeholder="Sunday Special Holiday" data-error-msg="Sunday Special Holiday is Required!" required>';
				                                    	}
				                                    ?>

				                                </div>
				                                <div class="form-group" style="margin-bottom:0px;">
				                                    <label class="boldlabel">Sunday Special Holiday OT :</label>

				                                    <?php
				                                    	foreach($reffactorfile as $row) {
				                                    		echo '<input type="text" class="form-control" id="sun_spe_holiday_ot" name="sun_spe_holiday_ot" value="'. $row->sun_spe_holiday_ot .'" placeholder="Sunday Special Holiday OT" data-error-msg="Sunday Special Holiday OT is Required!" required>';
				                                    	}
				                                    ?>

				                                </div>
				                                <div class="form-group" style="margin-bottom:0px;">
				                                    <label class="boldlabel">Pag-ibig 1 :</label>

				                                    <?php
				                                    	foreach($reffactorfile as $row) {
				                                    		echo '<input type="text" class="form-control" id="pagibig1" name="pagibig1" value="'. $row->pagibig1 .'" placeholder="Pag-ibig 1" data-error-msg="Pag-ibig 1 is Required!" required>';
				                                    	}
				                                    ?>

				                                </div>
				                                <div class="form-group" style="margin-bottom:0px;">
				                                    <label class="boldlabel">Pag-ibig 2 :</label>

				                                    <?php
				                                    	foreach($reffactorfile as $row) {
				                                    		echo '<input type="text" class="form-control" id="pagibig2" name="pagibig2" value="'. $row->pagibig2 .'" placeholder="Pag-ibig 2" data-error-msg="Pag-ibig 2 is Required!" required>';
				                                    	}
				                                    ?>

				                                </div>
				                              </div>

				                            <div class="col-md-4">
				                                <div class="form-group" style="margin-bottom:0px;">
				                                    <label class="boldlabel">Night Shift :</label>

				                                    <?php
				                                    	foreach($reffactorfile as $row) {
				                                    		echo '<input type="text" class="form-control" id="night_shift" name="night_shift" value="'. $row->night_shift .'" placeholder="Night Shift" data-error-msg="Night Shift is Required!" required>';
				                                    	}
				                                    ?>

				                                </div>
				                                <div class="form-group" style="margin-bottom:0px;">
				                                    <label class="boldlabel">Sunday Night Shift :</label>

				                                    <?php
				                                    	foreach($reffactorfile as $row) {
				                                    		echo '<input type="text" class="form-control" id="sun_night_shift" name="sun_night_shift" value="'. $row->sun_night_shift .'" placeholder="Sunday Night Shift" data-error-msg="Sunday Night Shift is Required!" required>';
				                                    	}
				                                    ?>

				                                </div>
				                                <div class="form-group" style="margin-bottom:0px;">
				                                    <label class="boldlabel">Night Shift Regular Holiday :</label>

				                                    <?php
				                                    	foreach($reffactorfile as $row) {
				                                    		echo '<input type="text" class="form-control" id="night_shift_reg_holiday" name="night_shift_reg_holiday" value="'. $row->night_shift_reg_holiday .'" placeholder="Night Shift Regular Holiday" data-error-msg="Night Shift Regular Holiday is Required!" required>';
				                                    	}
				                                    ?>

				                                </div>
				                                <div class="form-group" style="margin-bottom:0px;">
				                                    <label class="boldlabel">Sunday Night Shift Regular Holiday :</label>

				                                    <?php
				                                    	foreach($reffactorfile as $row) {
				                                    		echo '<input type="text" class="form-control" id="sun_night_shift_reg_holiday" name="sun_night_shift_reg_holiday" value="'. $row->sun_night_shift_reg_holiday .'" placeholder="Sunday Night Shift Regular Holiday" data-error-msg="Sunday Night Shift Regular Holiday is Required!" required>';
				                                    	}
				                                    ?>

				                                </div>
				                                <div class="form-group" style="margin-bottom:0px;">
				                                    <label class="boldlabel">Night Shift Special Holiday :</label>

				                                    <?php
				                                    	foreach($reffactorfile as $row) {
				                                    		echo '<input type="text" class="form-control" id="night_shift_spe_holiday" name="night_shift_spe_holiday" value="'. $row->night_shift_spe_holiday .'" placeholder="Night Shift Special Holiday" data-error-msg="Night Shift Special Holiday is Required!" required>';
				                                    	}
				                                    ?>

				                                </div>
				                                <div class="form-group" style="margin-bottom:0px;">
				                                    <label class="boldlabel">Sunday Night Shift Special Holiday :</label>
				                                    <?php
				                                    	foreach($reffactorfile as $row) {
				                                    		echo '<input type="text" class="form-control" id="sun_night_shift_spe_holiday" name="sun_night_shift_spe_holiday" value="'. $row->sun_night_shift_spe_holiday .'" placeholder="Sunday Night Shift Special Holiday" data-error-msg="Sunday Night Shift Special Holiday is Required!" required>';
				                                    	}
				                                    ?>
	                            				</div>
				                              </div>
				                            </div>
		                            	</form>
		                                <div class="panel-footer">
		                                    <div align="right">
		                                        <button id="btn_create" class="btn btn-default btn-save right_reffactorfile_edit">
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

</body>
<?php echo $_rights; ?>
<script>

$(document).ready(function(){
    var dt; var _txnMode; var _selectedID; var _selectRowObj;

    var bindEventHandlers=(function(){
        var detailRows = [];

        $('#tbl_deduction_regular_list tbody').on( 'click', 'tr td.details-control', function () {
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

        $('#btn_yes').click(function(){
            remove_FactorFile().done(function(response){
                showNotification(response);
                dt.row(_selectRowObj).remove().draw();
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
            $('#modal_create_FactorFile').modal('show');
            clearFields($('#frm_factorfile'));
        });

var validateRequiredFields=function(f){
        var stat=true;
        $('div.form-group').removeClass('has-error');
        $('input[required],textarea[required],select[required]',f).each(function(){
                if($(this).is('select')){
                if($(this).val()==0){
                    showNotification({title:"Error!",stat:"error",msg:$(this).data('error-msg')});
                    $(this).closest('div.form-group').addClass('has-error');
                    $(this).focus();
                    stat=false;
                    return false;
                }

                }else{
                if($(this).val()==""){
                    showNotification({title:"Error!",stat:"error",msg:$(this).data('error-msg')});
                    $(this).closest('div.form-group').addClass('has-error');
                    $(this).focus();
                    stat=false;
                    return false;
                }
            }

        });
        return stat;
    };

        $('#btn_create').click(function(){
            if(validateRequiredFields($('#frm_factorfile'))){
                    update_FactorFile().done(function(response){
                    showNotification(response);
                    }).always(function(){
                        $.unblockUI();
                    });
                    return;
            }

            else{}
        });

    })();

    var validateRequiredFields=function(f){
        var stat=true;
        $('div.form-group').removeClass('has-error');
        $('input[required],textarea[required],select[required]',f).each(function(){
                if($(this).is('select')){
                if($(this).val()==0){
                    showNotification({title:"Error!",stat:"error",msg:$(this).data('error-msg')});
                    $(this).closest('div.form-group').addClass('has-error');
                    $(this).focus();
                    stat=false;
                    return false;
                }

                }else{
                if($(this).val()==""){
                    showNotification({title:"Error!",stat:"error",msg:$(this).data('error-msg')});
                    $(this).closest('div.form-group').addClass('has-error');
                    $(this).focus();
                    stat=false;
                    return false;
                }
            }

        });
        return stat;
    };

    var create_FactorFile=function(){
        var _data = $('#frm_factorfile').serializeArray();

        return $.ajax({
            "dataType":"json",
            "type":"POST",
            "url":"RefFactorFile/transaction/create",
            "data":_data,
            "beforeSend": showSpinningProgress($('#btn_save'))
        });
    };


    var update_FactorFile=function(){
        var _data=$('#frm_factorfile').serializeArray();
        return $.ajax({
            "dataType":"json",
            "type":"POST",
            "url":"RefFactorFile/transaction/update",
            "data":_data,
            "beforeSend": showSpinningProgress($('#btn_create'))
        });
    };

    var remove_FactorFile=function(){
        return $.ajax({
            "dataType":"json",
            "type":"POST",
            "url":"RefFactorFile/transaction/delete",
            "data":{factor_id : _selectedID}
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
        $('select',f).val(0);
        $(f).find('input:first').focus();
    };

});

</script>

</html>
