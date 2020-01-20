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
    <?php echo $_def_js_files; ?>
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
                                            <span id="emp-tbl-title">User Group List</span>
                                            <button class="btn btn-default right_usergroup_create"  id="btn_new" style="float: right;margin-top: 8px;" title="Create New User Group" >
                                                <i class="fa fa-file"></i> New User Group</button>
                                        </div>
                                        <div class="panel-body table-responsive" style="padding-top:8px;">
                                            <table id="tbl_user_groups" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th>User Group</th>
                                                        <th>Description</th>
                                                        <th><center>Action</center></th>
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
                <button type="button" class="close"   data-dismiss="modal" aria-hidden="true">X</button>
                <h4 class="modal-title"><span id="modal_mode"> </span>Confirm Deletion</h4>
            </div>

            <div class="modal-body">
                <p id="modal-body-message">Are you sure ?</p>
            </div>

            <div class="modal-footer">
                <button id="btn_yes" type="button" class="btn btn-danger" data-dismiss="modal">Yes</button>
                <button id="btn_close" type="button" class="btn btn-default" data-dismiss="modal">No</button>
            </div>
        </div>
    </div>
    </div>
</div><!---modal-->


            <div id="modal_create_rights" class="modal fade" tabindex="-1" role="dialog"><!--modal-->
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="modal-header" style="background-color:#ECEFF1;border-bottom: 5px solid #CFD8DC;">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
                            <h4 class="modal-title" style="color:black;"><span id="modal_mode"> </span>User Group : <transaction class="transaction_type"></transaction></h4>
                        </div>

                        <div class="modal-body">
                            <form id="frm_user_group">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group" id="usergroup">
                                            <label class="col-sm-4 inlinecustomlabel-sm" for="inputEmail1">User Group Name :</label>
                                            <div class="col-sm-8">
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-file-text"></i>
                                                    </span>
                                                    <input type="text" id="user_group" name="user_group" class="form-control" placeholder="User Group Name" data-error-msg="Password is required!" required>
                                                </div>
                                            </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group" id="description">
                                            <label class="col-sm-4 inlinecustomlabel-sm" for="inputEmail1">Description :</label>
                                            <div class="col-sm-8">
                                                    <textarea name="user_group_desc" class="form-control" data-error-msg="Description is required!"></textarea>

                                            </div>
                                    </div>
                                </div>

                            </div>
                            <hr>
                            <center><h3 class="box-title" style="font-weight:bold;">User Rights / Permissions</h3></center>

                                  <div class="form-group">
                                      <label class="col-sm-4 inlinecustomlabel-sm" for="inputEmail1">Allow :</label>
                                      <div class="col-sm-8" id="toggleevent">
                                        <input class="checkorno" type="checkbox" id="toggle-two" data-width="100%">

                                      </div>
                                  </div>

                            <div class="panel-group" id="accordion">

                                    <div class="panel panel-default" style="margin:0px;">
                                      <div class="panel-heading" style="background-color:white !important;padding:10px;border-bottom:3px solid #217345;">
                                        <h4 class="panel-title">
                                          <a data-toggle="collapse" style="color:#2c3e50;" data-parent="#subaccordion" href="#rightemployeeinformation"> Employee Information</a>
                                        </h4>
                                      </div>
                                      <div id="rightemployeeinformation" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <div class="form-group">
                                                <label class="col-sm-3" style="margin-top:8px;" for="inputEmail1">View :</label>
                                                <div class="col-sm-9">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i class="fa fa-cogs" aria-hidden="true"></i></span>
                                                            <select class="form-control" name="right_employee_view" >
                                                                <option value="0">Disable</option>
                                                                <option value="1">Enable</option>
                                                            </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-3" style="margin-top:8px;" for="inputEmail1">Create :</label>
                                                <div class="col-sm-9">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i class="fa fa-cogs" aria-hidden="true"></i></span>
                                                            <select class="form-control" name="right_employee_create" >
                                                                <option value="0">Disable</option>
                                                                <option value="1">Enable</option>
                                                            </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-3" style="margin-top:8px;" for="inputEmail1">Edit :</label>
                                                <div class="col-sm-9">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i class="fa fa-cogs" aria-hidden="true"></i></span>
                                                            <select class="form-control" name="right_employee_edit" >
                                                                <option value="0">Disable</option>
                                                                <option value="1">Enable</option>
                                                            </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-3" style="margin-top:8px;" for="inputEmail1">Delete :</label>
                                                <div class="col-sm-9">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i class="fa fa-cogs" aria-hidden="true"></i></span>
                                                            <select class="form-control" name="right_employee_delete" >
                                                                <option value="0">Disable</option>
                                                                <option value="1">Enable</option>
                                                            </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-3" style="margin-top:8px;" for="inputEmail1">Excel :</label>
                                                <div class="col-sm-9">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i class="fa fa-cogs" aria-hidden="true"></i></span>
                                                            <select class="form-control" name="right_employee_excel" >
                                                                <option value="0">Disable</option>
                                                                <option value="1">Enable</option>
                                                            </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                      </div>
                                </div>
                                <div class="panel panel-default" style="margin:0px;">
                                  <div class="panel-heading" style="background-color:white !important;padding:10px;border-bottom:3px solid #217345;">
                                    <h4 class="panel-title">
                                      <a data-toggle="collapse" style="color:#2c3e50;" data-parent="#accordion" href="#references">References</a>
                                    </h4>
                                  </div>
                                  <div id="references" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <div class="form-group">
                                            <label class="col-sm-3" style="margin-top:8px;" for="inputEmail1">View :</label>
                                            <div class="col-sm-9">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-cogs" aria-hidden="true"></i></span>
                                                        <select class="form-control" name="right_empreference_view" >
                                                            <option value="0">Disable</option>
                                                            <option value="1">Enable</option>
                                                        </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel panel-default" style="margin:0px;">
                                          <div class="panel-heading" style="background-color:white !important;padding:10px;border-bottom:3px solid #B0BEC5;">
                                            <h4 class="panel-title">
                                              <a data-toggle="collapse" style="color:#2c3e50;" data-parent="#subaccordion" href="#rightemploymenttype"> - Employment Type Management</a>
                                            </h4>
                                          </div>
                                          <div id="rightemploymenttype" class="panel-collapse collapse">
                                            <div class="panel-body">
                                                <div class="form-group">
                                                    <label class="col-sm-3" style="margin-top:8px;" for="inputEmail1">View :</label>
                                                    <div class="col-sm-9">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="fa fa-cogs" aria-hidden="true"></i></span>
                                                                <select class="form-control" name="right_emp_type_view" >
                                                                    <option value="0">Disable</option>
                                                                    <option value="1">Enable</option>
                                                                </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3" style="margin-top:8px;" for="inputEmail1">Create :</label>
                                                    <div class="col-sm-9">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="fa fa-cogs" aria-hidden="true"></i></span>
                                                                <select class="form-control" name="right_emp_type_create" >
                                                                    <option value="0">Disable</option>
                                                                    <option value="1">Enable</option>
                                                                </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3" style="margin-top:8px;" for="inputEmail1">Edit :</label>
                                                    <div class="col-sm-9">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="fa fa-cogs" aria-hidden="true"></i></span>
                                                                <select class="form-control" name="right_emp_type_edit" >
                                                                    <option value="0">Disable</option>
                                                                    <option value="1">Enable</option>
                                                                </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3" style="margin-top:8px;" for="inputEmail1">Delete :</label>
                                                    <div class="col-sm-9">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="fa fa-cogs" aria-hidden="true"></i></span>
                                                                <select class="form-control" name="right_emp_type_delete" >
                                                                    <option value="0">Disable</option>
                                                                    <option value="1">Enable</option>
                                                                </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                          </div>
                                        </div>
                                        <div class="panel panel-default" style="margin:0px;">
                                          <div class="panel-heading" style="background-color:white !important;padding:10px;border-bottom:3px solid #B0BEC5;">
                                            <h4 class="panel-title">
                                              <a data-toggle="collapse" style="color:#2c3e50;" data-parent="#subaccordion" href="#rightbranch"> - Branch Management</a>
                                            </h4>
                                          </div>
                                          <div id="rightbranch" class="panel-collapse collapse">
                                            <div class="panel-body">
                                                <div class="form-group">
                                                    <label class="col-sm-3" style="margin-top:8px;" for="inputEmail1">View :</label>
                                                    <div class="col-sm-9">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="fa fa-cogs" aria-hidden="true"></i></span>
                                                                <select class="form-control" name="right_branch_view" >
                                                                    <option value="0">Disable</option>
                                                                    <option value="1">Enable</option>
                                                                </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3" style="margin-top:8px;" for="inputEmail1">Create :</label>
                                                    <div class="col-sm-9">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="fa fa-cogs" aria-hidden="true"></i></span>
                                                                <select class="form-control" name="right_branch_create" >
                                                                    <option value="0">Disable</option>
                                                                    <option value="1">Enable</option>
                                                                </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3" style="margin-top:8px;" for="inputEmail1">Edit :</label>
                                                    <div class="col-sm-9">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="fa fa-cogs" aria-hidden="true"></i></span>
                                                                <select class="form-control" name="right_branch_edit" >
                                                                    <option value="0">Disable</option>
                                                                    <option value="1">Enable</option>
                                                                </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3" style="margin-top:8px;" for="inputEmail1">Delete :</label>
                                                    <div class="col-sm-9">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="fa fa-cogs" aria-hidden="true"></i></span>
                                                                <select class="form-control" name="right_branch_delete" >
                                                                    <option value="0">Disable</option>
                                                                    <option value="1">Enable</option>
                                                                </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                          </div>
                                        </div>
                                        <div class="panel panel-default" style="margin:0px;">
                                          <div class="panel-heading" style="background-color:white !important;padding:10px;border-bottom:3px solid #B0BEC5;">
                                            <h4 class="panel-title">
                                              <a data-toggle="collapse" style="color:#2c3e50;" data-parent="#subaccordion" href="#rightrefdepartment"> - Department Management</a>
                                            </h4>
                                          </div>
                                          <div id="rightrefdepartment" class="panel-collapse collapse">
                                            <div class="panel-body">
                                                <div class="form-group">
                                                    <label class="col-sm-3" style="margin-top:8px;" for="inputEmail1">View :</label>
                                                    <div class="col-sm-9">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="fa fa-cogs" aria-hidden="true"></i></span>
                                                                <select class="form-control" name="right_department_view" >
                                                                    <option value="0">Disable</option>
                                                                    <option value="1">Enable</option>
                                                                </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3" style="margin-top:8px;" for="inputEmail1">Create :</label>
                                                    <div class="col-sm-9">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="fa fa-cogs" aria-hidden="true"></i></span>
                                                                <select class="form-control" name="right_department_create" >
                                                                    <option value="0">Disable</option>
                                                                    <option value="1">Enable</option>
                                                                </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3" style="margin-top:8px;" for="inputEmail1">Edit :</label>
                                                    <div class="col-sm-9">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="fa fa-cogs" aria-hidden="true"></i></span>
                                                                <select class="form-control" name="right_department_edit" >
                                                                    <option value="0">Disable</option>
                                                                    <option value="1">Enable</option>
                                                                </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3" style="margin-top:8px;" for="inputEmail1">Delete :</label>
                                                    <div class="col-sm-9">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="fa fa-cogs" aria-hidden="true"></i></span>
                                                                <select class="form-control" name="right_department_delete" >
                                                                    <option value="0">Disable</option>
                                                                    <option value="1">Enable</option>
                                                                </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                          </div>
                                        </div>
                                        <div class="panel panel-default" style="margin:0px;">
                                          <div class="panel-heading" style="background-color:white !important;padding:10px;border-bottom:3px solid #B0BEC5;">
                                            <h4 class="panel-title">
                                              <a data-toggle="collapse" style="color:#2c3e50;" data-parent="#subaccordion" href="#rightposition"> - Position Management</a>
                                            </h4>
                                          </div>
                                          <div id="rightposition" class="panel-collapse collapse">
                                            <div class="panel-body">
                                                <div class="form-group">
                                                    <label class="col-sm-3" style="margin-top:8px;" for="inputEmail1">View :</label>
                                                    <div class="col-sm-9">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="fa fa-cogs" aria-hidden="true"></i></span>
                                                                <select class="form-control" name="right_position_view" >
                                                                    <option value="0">Disable</option>
                                                                    <option value="1">Enable</option>
                                                                </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3" style="margin-top:8px;" for="inputEmail1">Create :</label>
                                                    <div class="col-sm-9">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="fa fa-cogs" aria-hidden="true"></i></span>
                                                                <select class="form-control" name="right_position_create" >
                                                                    <option value="0">Disable</option>
                                                                    <option value="1">Enable</option>
                                                                </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3" style="margin-top:8px;" for="inputEmail1">Edit :</label>
                                                    <div class="col-sm-9">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="fa fa-cogs" aria-hidden="true"></i></span>
                                                                <select class="form-control" name="right_position_edit" >
                                                                    <option value="0">Disable</option>
                                                                    <option value="1">Enable</option>
                                                                </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3" style="margin-top:8px;" for="inputEmail1">Delete :</label>
                                                    <div class="col-sm-9">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="fa fa-cogs" aria-hidden="true"></i></span>
                                                                <select class="form-control" name="right_position_delete" >
                                                                    <option value="0">Disable</option>
                                                                    <option value="1">Enable</option>
                                                                </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                          </div>
                                        </div>
                                        <div class="panel panel-default" style="margin:0px;">
                                          <div class="panel-heading" style="background-color:white !important;padding:10px;border-bottom:3px solid #B0BEC5;">
                                            <h4 class="panel-title">
                                              <a data-toggle="collapse" style="color:#2c3e50;" data-parent="#subaccordion" href="#rightsection"> - Section Management</a>
                                            </h4>
                                          </div>
                                          <div id="rightsection" class="panel-collapse collapse">
                                            <div class="panel-body">
                                                <div class="form-group">
                                                    <label class="col-sm-3" style="margin-top:8px;" for="inputEmail1">View :</label>
                                                    <div class="col-sm-9">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="fa fa-cogs" aria-hidden="true"></i></span>
                                                                <select class="form-control" name="right_section_view" >
                                                                    <option value="0">Disable</option>
                                                                    <option value="1">Enable</option>
                                                                </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3" style="margin-top:8px;" for="inputEmail1">Create :</label>
                                                    <div class="col-sm-9">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="fa fa-cogs" aria-hidden="true"></i></span>
                                                                <select class="form-control" name="right_section_create" >
                                                                    <option value="0">Disable</option>
                                                                    <option value="1">Enable</option>
                                                                </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3" style="margin-top:8px;" for="inputEmail1">Edit :</label>
                                                    <div class="col-sm-9">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="fa fa-cogs" aria-hidden="true"></i></span>
                                                                <select class="form-control" name="right_section_edit" >
                                                                    <option value="0">Disable</option>
                                                                    <option value="1">Enable</option>
                                                                </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3" style="margin-top:8px;" for="inputEmail1">Delete :</label>
                                                    <div class="col-sm-9">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="fa fa-cogs" aria-hidden="true"></i></span>
                                                                <select class="form-control" name="right_section_delete" >
                                                                    <option value="0">Disable</option>
                                                                    <option value="1">Enable</option>
                                                                </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                          </div>
                                        </div>
                                        <div class="panel panel-default" style="margin:0px;">
                                          <div class="panel-heading" style="background-color:white !important;padding:10px;border-bottom:3px solid #B0BEC5;">
                                            <h4 class="panel-title">
                                              <a data-toggle="collapse" style="color:#2c3e50;" data-parent="#subaccordion" href="#rightpayfrequencytype"> - Pay Frequency Management</a>
                                            </h4>
                                          </div>
                                          <div id="rightpayfrequencytype" class="panel-collapse collapse">
                                            <div class="panel-body">
                                                <div class="form-group">
                                                    <label class="col-sm-3" style="margin-top:8px;" for="inputEmail1">View :</label>
                                                    <div class="col-sm-9">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="fa fa-cogs" aria-hidden="true"></i></span>
                                                                <select class="form-control" name="right_pay_frequency_view" >
                                                                    <option value="0">Disable</option>
                                                                    <option value="1">Enable</option>
                                                                </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3" style="margin-top:8px;" for="inputEmail1">Create :</label>
                                                    <div class="col-sm-9">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="fa fa-cogs" aria-hidden="true"></i></span>
                                                                <select class="form-control" name="right_pay_frequency_create" >
                                                                    <option value="0">Disable</option>
                                                                    <option value="1">Enable</option>
                                                                </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3" style="margin-top:8px;" for="inputEmail1">Edit :</label>
                                                    <div class="col-sm-9">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="fa fa-cogs" aria-hidden="true"></i></span>
                                                                <select class="form-control" name="right_pay_frequency_edit" >
                                                                    <option value="0">Disable</option>
                                                                    <option value="1">Enable</option>
                                                                </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3" style="margin-top:8px;" for="inputEmail1">Delete :</label>
                                                    <div class="col-sm-9">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="fa fa-cogs" aria-hidden="true"></i></span>
                                                                <select class="form-control" name="right_pay_frequency_delete" >
                                                                    <option value="0">Disable</option>
                                                                    <option value="1">Enable</option>
                                                                </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                          </div>
                                        </div>
                                        <div class="panel panel-default" style="margin:0px;">
                                          <div class="panel-heading" style="background-color:white !important;padding:10px;border-bottom:3px solid #B0BEC5;">
                                            <h4 class="panel-title">
                                              <a data-toggle="collapse" style="color:#2c3e50;" data-parent="#subaccordion" href="#rightpayperiod"> - Pay Period Management</a>
                                            </h4>
                                          </div>
                                          <div id="rightpayperiod" class="panel-collapse collapse">
                                            <div class="panel-body">
                                                <div class="form-group">
                                                    <label class="col-sm-3" style="margin-top:8px;" for="inputEmail1">View :</label>
                                                    <div class="col-sm-9">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="fa fa-cogs" aria-hidden="true"></i></span>
                                                                <select class="form-control" name="right_payperiod_view" >
                                                                    <option value="0">Disable</option>
                                                                    <option value="1">Enable</option>
                                                                </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3" style="margin-top:8px;" for="inputEmail1">Create :</label>
                                                    <div class="col-sm-9">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="fa fa-cogs" aria-hidden="true"></i></span>
                                                                <select class="form-control" name="right_payperiod_create" >
                                                                    <option value="0">Disable</option>
                                                                    <option value="1">Enable</option>
                                                                </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3" style="margin-top:8px;" for="inputEmail1">Edit :</label>
                                                    <div class="col-sm-9">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="fa fa-cogs" aria-hidden="true"></i></span>
                                                                <select class="form-control" name="right_payperiod_edit" >
                                                                    <option value="0">Disable</option>
                                                                    <option value="1">Enable</option>
                                                                </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3" style="margin-top:8px;" for="inputEmail1">Delete :</label>
                                                    <div class="col-sm-9">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="fa fa-cogs" aria-hidden="true"></i></span>
                                                                <select class="form-control" name="right_payperiod_delete" >
                                                                    <option value="0">Disable</option>
                                                                    <option value="1">Enable</option>
                                                                </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                          </div>
                                        </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="panel panel-default" style="margin:0px;">
                                  <div class="panel-heading" style="background-color:white !important;padding:10px;border-bottom:3px solid #217345;">
                                    <h4 class="panel-title">
                                      <a data-toggle="collapse" style="color:#2c3e50;" data-parent="#accordion" href="#contributionreferences">Contribution References</a>
                                    </h4>
                                  </div>
                                  <div id="contributionreferences" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <div class="form-group">
                                            <label class="col-sm-3" style="margin-top:8px;" for="inputEmail1">View :</label>
                                            <div class="col-sm-9">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-cogs" aria-hidden="true"></i></span>
                                                        <select class="form-control" name="right_contribution_view" >
                                                            <option value="0">Disable</option>
                                                            <option value="1">Enable</option>
                                                        </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel panel-default" style="margin:0px;">
                                          <div class="panel-heading" style="background-color:white !important;padding:10px;border-bottom:3px solid #B0BEC5;">
                                            <h4 class="panel-title">
                                              <a data-toggle="collapse" style="color:#2c3e50;" data-parent="#subaccordion" href="#rightsss"> - SSS Contribution</a>
                                            </h4>
                                          </div>
                                          <div id="rightsss" class="panel-collapse collapse">
                                            <div class="panel-body">
                                                <div class="form-group">
                                                    <label class="col-sm-3" style="margin-top:8px;" for="inputEmail1">View :</label>
                                                    <div class="col-sm-9">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="fa fa-cogs" aria-hidden="true"></i></span>
                                                                <select class="form-control" name="right_sss_view" >
                                                                    <option value="0">Disable</option>
                                                                    <option value="1">Enable</option>
                                                                </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3" style="margin-top:8px;" for="inputEmail1">Create :</label>
                                                    <div class="col-sm-9">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="fa fa-cogs" aria-hidden="true"></i></span>
                                                                <select class="form-control" name="right_sss_create" >
                                                                    <option value="0">Disable</option>
                                                                    <option value="1">Enable</option>
                                                                </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3" style="margin-top:8px;" for="inputEmail1">Edit :</label>
                                                    <div class="col-sm-9">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="fa fa-cogs" aria-hidden="true"></i></span>
                                                                <select class="form-control" name="right_sss_edit" >
                                                                    <option value="0">Disable</option>
                                                                    <option value="1">Enable</option>
                                                                </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3" style="margin-top:8px;" for="inputEmail1">Delete :</label>
                                                    <div class="col-sm-9">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="fa fa-cogs" aria-hidden="true"></i></span>
                                                                <select class="form-control" name="right_sss_delete" >
                                                                    <option value="0">Disable</option>
                                                                    <option value="1">Enable</option>
                                                                </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                          </div>
                                        </div>
                                        <div class="panel panel-default" style="margin:0px;">
                                          <div class="panel-heading" style="background-color:white !important;padding:10px;border-bottom:3px solid #B0BEC5;">
                                            <h4 class="panel-title">
                                              <a data-toggle="collapse" style="color:#2c3e50;" data-parent="#subaccordion" href="#rightphilhealthcontribution"> - Philhealth Contribution</a>
                                            </h4>
                                          </div>
                                          <div id="rightphilhealthcontribution" class="panel-collapse collapse">
                                            <div class="panel-body">
                                                <div class="form-group">
                                                    <label class="col-sm-3" style="margin-top:8px;" for="inputEmail1">View :</label>
                                                    <div class="col-sm-9">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="fa fa-cogs" aria-hidden="true"></i></span>
                                                                <select class="form-control" name="right_philhealth_view" >
                                                                    <option value="0">Disable</option>
                                                                    <option value="1">Enable</option>
                                                                </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3" style="margin-top:8px;" for="inputEmail1">Create :</label>
                                                    <div class="col-sm-9">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="fa fa-cogs" aria-hidden="true"></i></span>
                                                                <select class="form-control" name="right_philhealth_create" >
                                                                    <option value="0">Disable</option>
                                                                    <option value="1">Enable</option>
                                                                </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3" style="margin-top:8px;" for="inputEmail1">Edit :</label>
                                                    <div class="col-sm-9">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="fa fa-cogs" aria-hidden="true"></i></span>
                                                                <select class="form-control" name="right_philhealth_edit" >
                                                                    <option value="0">Disable</option>
                                                                    <option value="1">Enable</option>
                                                                </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3" style="margin-top:8px;" for="inputEmail1">Delete :</label>
                                                    <div class="col-sm-9">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="fa fa-cogs" aria-hidden="true"></i></span>
                                                                <select class="form-control" name="right_philhealth_delete" >
                                                                    <option value="0">Disable</option>
                                                                    <option value="1">Enable</option>
                                                                </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                          </div>
                                        </div>
                                        <div class="panel panel-default" style="margin:0px;">
                                          <div class="panel-heading" style="background-color:white !important;padding:10px;border-bottom:3px solid #B0BEC5;">
                                            <h4 class="panel-title">
                                              <a data-toggle="collapse" style="color:#2c3e50;" data-parent="#subaccordion" href="#righttaxfile"> - Tax File</a>
                                            </h4>
                                          </div>
                                          <div id="righttaxfile" class="panel-collapse collapse">
                                            <div class="panel-body">
                                                <div class="form-group">
                                                    <label class="col-sm-3" style="margin-top:8px;" for="inputEmail1">View :</label>
                                                    <div class="col-sm-9">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="fa fa-cogs" aria-hidden="true"></i></span>
                                                                <select class="form-control" name="right_taxtable_view" >
                                                                    <option value="0">Disable</option>
                                                                    <option value="1">Enable</option>
                                                                </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                          </div>
                                        </div>
                                        </div>
                                    </div>
                                </div>

                                    <div class="panel panel-default" style="margin:0px;">
                                      <div class="panel-heading" style="background-color:white !important;padding:10px;border-bottom:3px solid #217345;">
                                        <h4 class="panel-title">
                                          <a data-toggle="collapse" style="color:#2c3e50;" data-parent="#subaccordion" href="#rightloandeduction"> Loan &amp; Deduction Setup</a>
                                        </h4>
                                      </div>
                                      <div id="rightloandeduction" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <div class="form-group">
                                                <label class="col-sm-3" style="margin-top:8px;" for="inputEmail1">View :</label>
                                                <div class="col-sm-9">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i class="fa fa-cogs" aria-hidden="true"></i></span>
                                                            <select class="form-control" name="right_loandeduction_view" >
                                                                <option value="0">Disable</option>
                                                                <option value="1">Enable</option>
                                                            </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-3" style="margin-top:8px;" for="inputEmail1">Create :</label>
                                                <div class="col-sm-9">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i class="fa fa-cogs" aria-hidden="true"></i></span>
                                                            <select class="form-control" name="right_loandeduction_create" >
                                                                <option value="0">Disable</option>
                                                                <option value="1">Enable</option>
                                                            </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-3" style="margin-top:8px;" for="inputEmail1">Edit :</label>
                                                <div class="col-sm-9">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i class="fa fa-cogs" aria-hidden="true"></i></span>
                                                            <select class="form-control" name="right_loandeduction_edit" >
                                                                <option value="0">Disable</option>
                                                                <option value="1">Enable</option>
                                                            </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-3" style="margin-top:8px;" for="inputEmail1">Delete :</label>
                                                <div class="col-sm-9">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i class="fa fa-cogs" aria-hidden="true"></i></span>
                                                            <select class="form-control" name="right_loandeduction_delete" >
                                                                <option value="0">Disable</option>
                                                                <option value="1">Enable</option>
                                                            </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                      </div>
                                    </div>

                                <div class="panel panel-default" style="margin:0px;">
                                  <div class="panel-heading" style="background-color:white !important;padding:10px;border-bottom:3px solid #217345;">
                                    <h4 class="panel-title">
                                      <a data-toggle="collapse" style="color:#2c3e50;" data-parent="#accordion" href="#payroll">Payroll</a>
                                    </h4>
                                  </div>
                                  <div id="payroll" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <div class="form-group">
                                            <label class="col-sm-3" style="margin-top:8px;" for="inputEmail1">View :</label>
                                            <div class="col-sm-9">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-cogs" aria-hidden="true"></i></span>
                                                        <select class="form-control" name="right_payrollparent_view" >
                                                            <option value="0">Disable</option>
                                                            <option value="1">Enable</option>
                                                        </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel panel-default" style="margin:0px;">
                                          <div class="panel-heading" style="background-color:white !important;padding:10px;border-bottom:3px solid #B0BEC5;">
                                            <h4 class="panel-title">
                                              <a data-toggle="collapse" style="color:#2c3e50;" data-parent="#subaccordion" href="#dailytimerecord"> - Daily Time Record</a>
                                            </h4>
                                          </div>
                                          <div id="dailytimerecord" class="panel-collapse collapse">
                                            <div class="panel-body">
                                                <div class="form-group">
                                                    <label class="col-sm-3" style="margin-top:8px;" for="inputEmail1">View :</label>
                                                    <div class="col-sm-9">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="fa fa-cogs" aria-hidden="true"></i></span>
                                                                <select class="form-control" name="right_dtr_view" >
                                                                    <option value="0">Disable</option>
                                                                    <option value="1">Enable</option>
                                                                </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3" style="margin-top:8px;" for="inputEmail1">Process Payroll :</label>
                                                    <div class="col-sm-9">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="fa fa-cogs" aria-hidden="true"></i></span>
                                                                <select class="form-control" name="right_dtr_processpayroll" >
                                                                    <option value="0">Disable</option>
                                                                    <option value="1">Enable</option>
                                                                </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3" style="margin-top:8px;" for="inputEmail1">Update Payroll :</label>
                                                    <div class="col-sm-9">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="fa fa-cogs" aria-hidden="true"></i></span>
                                                                <select class="form-control" name="right_dtr_updatepayroll" >
                                                                    <option value="0">Disable</option>
                                                                    <option value="1">Enable</option>
                                                                </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                          </div>
                                        </div>
                                        <div class="panel panel-default" style="margin:0px;">
                                          <div class="panel-heading" style="background-color:white !important;padding:10px;border-bottom:3px solid #B0BEC5;">
                                            <h4 class="panel-title">
                                              <a data-toggle="collapse" style="color:#2c3e50;" data-parent="#subaccordion" href="#rightpayslip"> - Payslip</a>
                                            </h4>
                                          </div>
                                          <div id="rightpayslip" class="panel-collapse collapse">
                                            <div class="panel-body">
                                                <div class="form-group">
                                                    <label class="col-sm-3" style="margin-top:8px;" for="inputEmail1">View :</label>
                                                    <div class="col-sm-9">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="fa fa-cogs" aria-hidden="true"></i></span>
                                                                <select class="form-control" name="right_payslip_view" >
                                                                    <option value="0">Disable</option>
                                                                    <option value="1">Enable</option>
                                                                </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                          </div>
                                        </div>
                                        <div class="panel panel-default" style="margin:0px;">
                                          <div class="panel-heading" style="background-color:white !important;padding:10px;border-bottom:3px solid #B0BEC5;">
                                            <h4 class="panel-title">
                                              <a data-toggle="collapse" style="color:#2c3e50;" data-parent="#subaccordion" href="#rightdtrsummary"> - DTR Summary</a>
                                            </h4>
                                          </div>
                                          <div id="rightdtrsummary" class="panel-collapse collapse">
                                            <div class="panel-body">
                                                <div class="form-group">
                                                    <label class="col-sm-3" style="margin-top:8px;" for="inputEmail1">View :</label>
                                                    <div class="col-sm-9">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="fa fa-cogs" aria-hidden="true"></i></span>
                                                                <select class="form-control" name="right_dtrsummary_view" >
                                                                    <option value="0">Disable</option>
                                                                    <option value="1">Enable</option>
                                                                </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                          </div>
                                        </div>
                                        <div class="panel panel-default" style="margin:0px;">
                                          <div class="panel-heading" style="background-color:white !important;padding:10px;border-bottom:3px solid #B0BEC5;">
                                            <h4 class="panel-title">
                                              <a data-toggle="collapse" style="color:#2c3e50;" data-parent="#subaccordion" href="#rightpayrollregister"> - Payroll Register</a>
                                            </h4>
                                          </div>
                                          <div id="rightpayrollregister" class="panel-collapse collapse">
                                            <div class="panel-body">
                                                <div class="form-group">
                                                    <label class="col-sm-3" style="margin-top:8px;" for="inputEmail1">View :</label>
                                                    <div class="col-sm-9">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="fa fa-cogs" aria-hidden="true"></i></span>
                                                                <select class="form-control" name="right_payroll_register_view" >
                                                                    <option value="0">Disable</option>
                                                                    <option value="1">Enable</option>
                                                                </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                          </div>
                                        </div>
                                        <div class="panel panel-default" style="margin:0px;">
                                          <div class="panel-heading" style="background-color:white !important;padding:10px;border-bottom:3px solid #B0BEC5;">
                                            <h4 class="panel-title">
                                              <a data-toggle="collapse" style="color:#2c3e50;" data-parent="#subaccordion" href="#rightpayrollsummary"> - Payroll Summary</a>
                                            </h4>
                                          </div>
                                          <div id="rightpayrollsummary" class="panel-collapse collapse">
                                            <div class="panel-body">
                                                <div class="form-group">
                                                    <label class="col-sm-3" style="margin-top:8px;" for="inputEmail1">View :</label>
                                                    <div class="col-sm-9">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="fa fa-cogs" aria-hidden="true"></i></span>
                                                                <select class="form-control" name="right_payrollsummary_view" >
                                                                    <option value="0">Disable</option>
                                                                    <option value="1">Enable</option>
                                                                </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                          </div>
                                        </div>
                                        <div class="panel panel-default" style="margin:0px;">
                                          <div class="panel-heading" style="background-color:white !important;padding:10px;border-bottom:3px solid #B0BEC5;">
                                            <h4 class="panel-title">
                                              <a data-toggle="collapse" style="color:#2c3e50;" data-parent="#subaccordion" href="#right13thmonthpay"> - 13th Month Pay</a>
                                            </h4>
                                          </div>
                                          <div id="right13thmonthpay" class="panel-collapse collapse">
                                            <div class="panel-body">
                                                <div class="form-group">
                                                    <label class="col-sm-3" style="margin-top:8px;" for="inputEmail1">View :</label>
                                                    <div class="col-sm-9">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="fa fa-cogs" aria-hidden="true"></i></span>
                                                                <select class="form-control" name="right_13thmonthpay_view" >
                                                                    <option value="0">Disable</option>
                                                                    <option value="1">Enable</option>
                                                                </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                          </div>
                                        </div>
                                        <div class="panel panel-default" style="margin:0px;">
                                          <div class="panel-heading" style="background-color:white !important;padding:10px;border-bottom:3px solid #B0BEC5;">
                                            <h4 class="panel-title">
                                              <a data-toggle="collapse" style="color:#2c3e50;" data-parent="#subaccordion" href="#rightalphalist"> - Alpha List of Employee</a>
                                            </h4>
                                          </div>
                                          <div id="rightalphalist" class="panel-collapse collapse">
                                            <div class="panel-body">
                                                <div class="form-group">
                                                    <label class="col-sm-3" style="margin-top:8px;" for="inputEmail1">View :</label>
                                                    <div class="col-sm-9">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="fa fa-cogs" aria-hidden="true"></i></span>
                                                                <select class="form-control" name="right_alphalist_view" >
                                                                    <option value="0">Disable</option>
                                                                    <option value="1">Enable</option>
                                                                </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                          </div>
                                        </div>
                                        <div class="panel panel-default" style="margin:0px;">
                                          <div class="panel-heading" style="background-color:white !important;padding:10px;border-bottom:3px solid #B0BEC5;">
                                            <h4 class="panel-title">
                                              <a data-toggle="collapse" style="color:#2c3e50;" data-parent="#subaccordion" href="#right1601c"> - 1601C Report</a>
                                            </h4>
                                          </div>
                                          <div id="right1601c" class="panel-collapse collapse">
                                            <div class="panel-body">
                                                <div class="form-group">
                                                    <label class="col-sm-3" style="margin-top:8px;" for="inputEmail1">View :</label>
                                                    <div class="col-sm-9">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="fa fa-cogs" aria-hidden="true"></i></span>
                                                                <select class="form-control" name="right_1601C_view" >
                                                                    <option value="0">Disable</option>
                                                                    <option value="1">Enable</option>
                                                                </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                          </div>
                                        </div>

                                        <div class="panel panel-default" style="margin:0px;">
                                          <div class="panel-heading" style="background-color:white !important;padding:10px;border-bottom:3px solid #B0BEC5;">
                                            <h4 class="panel-title">
                                              <a data-toggle="collapse" style="color:#2c3e50;" data-parent="#subaccordion" href="#rightbir2316"> - BIR 2316</a>
                                            </h4>
                                          </div>
                                          <div id="rightbir2316" class="panel-collapse collapse">
                                            <div class="panel-body">
                                                <div class="form-group">
                                                    <label class="col-sm-3" style="margin-top:8px;" for="inputEmail1">View :</label>
                                                    <div class="col-sm-9">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="fa fa-cogs" aria-hidden="true"></i></span>
                                                                <select class="form-control" name="right_bir2316_view" >
                                                                    <option value="0">Disable</option>
                                                                    <option value="1">Enable</option>
                                                                </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                          </div>
                                        </div>
                                        <div class="panel panel-default" style="margin:0px;">
                                          <div class="panel-heading" style="background-color:white !important;padding:10px;border-bottom:3px solid #B0BEC5;">
                                            <h4 class="panel-title">
                                              <a data-toggle="collapse" style="color:#2c3e50;" data-parent="#subaccordion" href="#rightempcompensation"> - Employee Compensation</a>
                                            </h4>
                                          </div>
                                          <div id="rightempcompensation" class="panel-collapse collapse">
                                            <div class="panel-body">
                                                <div class="form-group">
                                                    <label class="col-sm-3" style="margin-top:8px;" for="inputEmail1">View :</label>
                                                    <div class="col-sm-9">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="fa fa-cogs" aria-hidden="true"></i></span>
                                                                <select class="form-control" name="right_employee_compensation_view" >
                                                                    <option value="0">Disable</option>
                                                                    <option value="1">Enable</option>
                                                                </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                          </div>
                                        </div>
                                        <div class="panel panel-default" style="margin:0px;">
                                          <div class="panel-heading" style="background-color:white !important;padding:10px;border-bottom:3px solid #B0BEC5;">
                                            <h4 class="panel-title">
                                              <a data-toggle="collapse" style="color:#2c3e50;" data-parent="#subaccordion" href="#rightdeductionhistory"> - Employee Deduct. History</a>
                                            </h4>
                                          </div>
                                          <div id="rightdeductionhistory" class="panel-collapse collapse">
                                            <div class="panel-body">
                                                <div class="form-group">
                                                    <label class="col-sm-3" style="margin-top:8px;" for="inputEmail1">View :</label>
                                                    <div class="col-sm-9">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="fa fa-cogs" aria-hidden="true"></i></span>
                                                                <select class="form-control" name="right_employee_deduction_view" >
                                                                    <option value="0">Disable</option>
                                                                    <option value="1">Enable</option>
                                                                </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                          </div>
                                        </div>
                                    </div>
                                  </div>
                                </div>
                                
                                <div class="panel panel-default" style="margin:0px;">
                                  <div class="panel-heading" style="background-color:white !important;padding:10px;border-bottom:3px solid #217345;">
                                    <h4 class="panel-title">
                                      <a data-toggle="collapse" style="color:#2c3e50;" data-parent="#accordion" href="#payrollreports">Payroll Reports</a>
                                    </h4>
                                  </div>
                                  <div id="payrollreports" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <div class="form-group">
                                            <label class="col-sm-3" style="margin-top:8px;" for="inputEmail1">View :</label>
                                            <div class="col-sm-9">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-cogs" aria-hidden="true"></i></span>
                                                        <select class="form-control" name="right_payrollreports_view" >
                                                            <option value="0">Disable</option>
                                                            <option value="1">Enable</option>
                                                        </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel panel-default" style="margin:0px;">
                                          <div class="panel-heading" style="background-color:white !important;padding:10px;border-bottom:3px solid #B0BEC5;">
                                            <h4 class="panel-title">
                                              <a data-toggle="collapse" style="color:#2c3e50;" data-parent="#subaccordion" href="#rightsssreport"> - SSS Report</a>
                                            </h4>
                                          </div>
                                          <div id="rightsssreport" class="panel-collapse collapse">
                                            <div class="panel-body">
                                                <div class="form-group">
                                                    <label class="col-sm-3" style="margin-top:8px;" for="inputEmail1">View :</label>
                                                    <div class="col-sm-9">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="fa fa-cogs" aria-hidden="true"></i></span>
                                                                <select class="form-control" name="right_sssreport_view" >
                                                                    <option value="0">Disable</option>
                                                                    <option value="1">Enable</option>
                                                                </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                          </div>
                                        </div>
                                        <div class="panel panel-default" style="margin:0px;">
                                          <div class="panel-heading" style="background-color:white !important;padding:10px;border-bottom:3px solid #B0BEC5;">
                                            <h4 class="panel-title">
                                              <a data-toggle="collapse" style="color:#2c3e50;" data-parent="#subaccordion" href="#rightphilhealthreport"> - Philhealth Report</a>
                                            </h4>
                                          </div>
                                          <div id="rightphilhealthreport" class="panel-collapse collapse">
                                            <div class="panel-body">
                                                <div class="form-group">
                                                    <label class="col-sm-3" style="margin-top:8px;" for="inputEmail1">View :</label>
                                                    <div class="col-sm-9">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="fa fa-cogs" aria-hidden="true"></i></span>
                                                                <select class="form-control" name="right_philhealthreport_view" >
                                                                    <option value="0">Disable</option>
                                                                    <option value="1">Enable</option>
                                                                </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                          </div>
                                        </div>
                                        <div class="panel panel-default" style="margin:0px;">
                                          <div class="panel-heading" style="background-color:white !important;padding:10px;border-bottom:3px solid #B0BEC5;">
                                            <h4 class="panel-title">
                                              <a data-toggle="collapse" style="color:#2c3e50;" data-parent="#subaccordion" href="#rightpagibigreport"> - Pagibig Report</a>
                                            </h4>
                                          </div>
                                          <div id="rightpagibigreport" class="panel-collapse collapse">
                                            <div class="panel-body">
                                                <div class="form-group">
                                                    <label class="col-sm-3" style="margin-top:8px;" for="inputEmail1">View :</label>
                                                    <div class="col-sm-9">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="fa fa-cogs" aria-hidden="true"></i></span>
                                                                <select class="form-control" name="right_pagibigreport_view" >
                                                                    <option value="0">Disable</option>
                                                                    <option value="1">Enable</option>
                                                                </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                          </div>
                                        </div>
                                        <div class="panel panel-default" style="margin:0px;">
                                          <div class="panel-heading" style="background-color:white !important;padding:10px;border-bottom:3px solid #B0BEC5;">
                                            <h4 class="panel-title">
                                              <a data-toggle="collapse" style="color:#2c3e50;" data-parent="#subaccordion" href="#rightwtax"> - WTAX Report</a>
                                            </h4>
                                          </div>
                                          <div id="rightwtax" class="panel-collapse collapse">
                                            <div class="panel-body">
                                                <div class="form-group">
                                                    <label class="col-sm-3" style="margin-top:8px;" for="inputEmail1">View :</label>
                                                    <div class="col-sm-9">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="fa fa-cogs" aria-hidden="true"></i></span>
                                                                <select class="form-control" name="right_wtaxreport_view" >
                                                                    <option value="0">Disable</option>
                                                                    <option value="1">Enable</option>
                                                                </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                          </div>
                                        </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="panel panel-default" style="margin:0px;">
                                  <div class="panel-heading" style="background-color:white !important;padding:10px;border-bottom:3px solid #217345;">
                                    <h4 class="panel-title">
                                      <a data-toggle="collapse" style="color:#2c3e50;" data-parent="#accordion" href="#rightadmin">Settings</a>
                                    </h4>
                                  </div>
                                  <div id="rightadmin" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <div class="form-group">
                                            <label class="col-sm-3" style="margin-top:8px;" for="inputEmail1">View :</label>
                                            <div class="col-sm-9">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-cogs" aria-hidden="true"></i></span>
                                                        <select class="form-control" name="right_adminparent_view" >
                                                            <option value="0">Disable</option>
                                                            <option value="1">Enable</option>
                                                        </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel panel-default" style="margin:0px;">
                                          <div class="panel-heading" style="background-color:white !important;padding:10px;border-bottom:3px solid #B0BEC5;">
                                            <h4 class="panel-title">
                                              <a data-toggle="collapse" style="color:#2c3e50;" data-parent="#subaccordion" href="#rightuseracc"> - User Account</a>
                                            </h4>
                                          </div>
                                          <div id="rightuseracc" class="panel-collapse collapse">
                                            <div class="panel-body">
                                                <div class="form-group">
                                                    <label class="col-sm-3" style="margin-top:8px;" for="inputEmail1">View :</label>
                                                    <div class="col-sm-9">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="fa fa-cogs" aria-hidden="true"></i></span>
                                                                <select class="form-control" name="right_useraccount_view" >
                                                                    <option value="0">Disable</option>
                                                                    <option value="1">Enable</option>
                                                                </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3" style="margin-top:8px;" for="inputEmail1">Create :</label>
                                                    <div class="col-sm-9">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="fa fa-cogs" aria-hidden="true"></i></span>
                                                                <select class="form-control" name="right_useraccount_create" >
                                                                    <option value="0">Disable</option>
                                                                    <option value="1">Enable</option>
                                                                </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3" style="margin-top:8px;" for="inputEmail1">Edit :</label>
                                                    <div class="col-sm-9">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="fa fa-cogs" aria-hidden="true"></i></span>
                                                                <select class="form-control" name="right_useraccount_edit" >
                                                                    <option value="0">Disable</option>
                                                                    <option value="1">Enable</option>
                                                                </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3" style="margin-top:8px;" for="inputEmail1">Delete :</label>
                                                    <div class="col-sm-9">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="fa fa-cogs" aria-hidden="true"></i></span>
                                                                <select class="form-control" name="right_useraccount_delete" >
                                                                    <option value="0">Disable</option>
                                                                    <option value="1">Enable</option>
                                                                </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                          </div>
                                        </div>
                                        <div class="panel panel-default" style="margin:0px;">
                                          <div class="panel-heading" style="background-color:white !important;padding:10px;border-bottom:3px solid #B0BEC5;">
                                            <h4 class="panel-title">
                                              <a data-toggle="collapse" style="color:#2c3e50;" data-parent="#subaccordion" href="#rightusergroup"> - User Group</a>
                                            </h4>
                                          </div>
                                          <div id="rightusergroup" class="panel-collapse collapse">
                                            <div class="panel-body">
                                                <div class="form-group">
                                                    <label class="col-sm-3" style="margin-top:8px;" for="inputEmail1">View :</label>
                                                    <div class="col-sm-9">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="fa fa-cogs" aria-hidden="true"></i></span>
                                                                <select class="form-control" name="right_usergroup_view" >
                                                                    <option value="0">Disable</option>
                                                                    <option value="1">Enable</option>
                                                                </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3" style="margin-top:8px;" for="inputEmail1">Create :</label>
                                                    <div class="col-sm-9">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="fa fa-cogs" aria-hidden="true"></i></span>
                                                                <select class="form-control" name="right_usergroup_create" >
                                                                    <option value="0">Disable</option>
                                                                    <option value="1">Enable</option>
                                                                </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3" style="margin-top:8px;" for="inputEmail1">Edit :</label>
                                                    <div class="col-sm-9">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="fa fa-cogs" aria-hidden="true"></i></span>
                                                                <select class="form-control" name="right_usergroup_edit" >
                                                                    <option value="0">Disable</option>
                                                                    <option value="1">Enable</option>
                                                                </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3" style="margin-top:8px;" for="inputEmail1">Delete :</label>
                                                    <div class="col-sm-9">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="fa fa-cogs" aria-hidden="true"></i></span>
                                                                <select class="form-control" name="right_usergroup_delete" >
                                                                    <option value="0">Disable</option>
                                                                    <option value="1">Enable</option>
                                                                </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                          </div>
                                        </div>
                                        <div class="panel panel-default" style="margin:0px;">
                                          <div class="panel-heading" style="background-color:white !important;padding:10px;border-bottom:3px solid #B0BEC5;">
                                            <h4 class="panel-title">
                                              <a data-toggle="collapse" style="color:#2c3e50;" data-parent="#subaccordion" href="#rightcompanysetup"> - Company Setup</a>
                                            </h4>
                                          </div>
                                          <div id="rightcompanysetup" class="panel-collapse collapse">
                                            <div class="panel-body">
                                                <div class="form-group">
                                                    <label class="col-sm-3" style="margin-top:8px;" for="inputEmail1">View :</label>
                                                    <div class="col-sm-9">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="fa fa-cogs" aria-hidden="true"></i></span>
                                                                <select class="form-control" name="right_companysetup_view" >
                                                                    <option value="0">Disable</option>
                                                                    <option value="1">Enable</option>
                                                                </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3" style="margin-top:8px;" for="inputEmail1">Edit :</label>
                                                    <div class="col-sm-9">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="fa fa-cogs" aria-hidden="true"></i></span>
                                                                <select class="form-control" name="right_companysetup_edit" >
                                                                    <option value="0">Disable</option>
                                                                    <option value="1">Enable</option>
                                                                </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                          </div>
                                        </div>
                                        <div class="panel panel-default" style="margin:0px;">
                                          <div class="panel-heading" style="background-color:white !important;padding:10px;border-bottom:3px solid #B0BEC5;">
                                            <h4 class="panel-title">
                                              <a data-toggle="collapse" style="color:#2c3e50;" data-parent="#subaccordion" href="#rightfactorfile"> - Factor File</a>
                                            </h4>
                                          </div>
                                          <div id="rightfactorfile" class="panel-collapse collapse">
                                            <div class="panel-body">
                                                <div class="form-group">
                                                    <label class="col-sm-3" style="margin-top:8px;" for="inputEmail1">View :</label>
                                                    <div class="col-sm-9">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="fa fa-cogs" aria-hidden="true"></i></span>
                                                                <select class="form-control" name="right_reffactorfile_view" >
                                                                    <option value="0">Disable</option>
                                                                    <option value="1">Enable</option>
                                                                </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3" style="margin-top:8px;" for="inputEmail1">Edit :</label>
                                                    <div class="col-sm-9">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="fa fa-cogs" aria-hidden="true"></i></span>
                                                                <select class="form-control" name="right_reffactorfile_edit" >
                                                                    <option value="0">Disable</option>
                                                                    <option value="1">Enable</option>
                                                                </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                          </div>
                                        </div>  
                                    </div>
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
             </div>
            </div><!---modal-->



<?php echo $_switcher_settings; ?>



<script type="text/javascript" src="assets/plugins/datatables/jquery.dataTables.js"></script>
<script type="text/javascript" src="assets/plugins/datatables/dataTables.bootstrap.js"></script>


<!-- Date range use moment.js same as full calendar plugin -->
<script src="assets/plugins/fullcalendar/moment.min.js"></script>
<!-- Data picker -->
<script src="assets/plugins/datapicker/bootstrap-datepicker.js"></script>

<!-- Select2 -->
<script src="assets/plugins/select2/select2.full.min.js"></script>

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
<link href="assets/plugins/bootstrap-toggle/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="assets/plugins/bootstrap-toggle/js/bootstrap-toggle.min.js"></script>

<?php echo $_rights; ?>

<script>

$(document).ready(function(){
    var dt; var _txnMode; var _selectedID; var _selectRowObj; var _ispayable=0; var _isforwardable=0;
    $('#toggle-two').bootstrapToggle({
      on: 'All',
      Disable: 'Specific'
    });
    $('#toggleevent').click(function(){
      if($('.checkorno').prop("checked") == false){
        // console.log(1);
        $('select').each(function() {
            $(this).val(1);
        });
      }else{
        $('select').each(function() {
            $(this).val(0);
        });
      }
    });
    var initializeControls=function(){
        dt=$('#tbl_user_groups').DataTable({
            "aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            "bStateSave": true,
            "fnStateSave": function (oSettings, oData) {
                localStorage.setItem('DataTables_' + window.location.pathname, JSON.stringify(oData));
            },
            "ajax" : "UserGroups/transaction/list",
            "columns": [
                { targets:[0],data: "user_group" },
                { targets:[1],data: "user_group_desc" },
                {
                    targets:[2], data: null,
                    render: function (data, type, full, meta){
                        if (data.user_group_id != 1){
                            return '<center>'+right_usergroup_edit+right_usergroup_delete+'</center>';
                        }else{
                            return '';
                        }
                    }
                }
            ],
            language: {
                         searchPlaceholder: "Search User Group"
                     },
            "rowCallback":function( row, data, index ){

                $(row).find('td').eq(10).attr({
                    "align": "right"
                });
            }
        });

        $('.numeric').autoNumeric('init');
    }();


    var bindEventHandlers=(function(){
        var detailRows = [];


        $('#tbl_user_groups tbody').on('click','button[name="edit_info"]',function(){
            _txnMode="edit";

            _selectRowObj=$(this).closest('tr');
            var data=dt.row(_selectRowObj).data();
            _selectedID=data.user_group_id;
            $('#user_group_id').val(data.user_group_id);
            $('.transaction_type').text('Edit');
            $('input,textarea').each(function(){
                var _elem=$(this);
                $.each(data,function(name,value){
                    if(_elem.attr('name')==name){
                        _elem.val(value);
                    }
                });
            });

            $('select').each(function(){
                var _elem=$(this);
                $.each(data,function(name,value){
                    if(_elem.attr('name')==name){
                        _elem.val(value==0 || value==null ? 0 : 1);
                    }
                });
            });

            $('#modal_create_rights').modal('toggle');

        });

        $('#tbl_user_groups tbody').on('click','button[name="remove_info"]',function(){
            _selectRowObj=$(this).closest('tr');
            var data=dt.row(_selectRowObj).data();
            _selectedID=data.user_group_id;

            $('#modal_confirmation').modal('show');
        });

        $('#btn_yes').click(function(){
            removeUserAccount().done(function(response){
                showNotification(response);
                dt.row(_selectRowObj).remove().draw();
                $.unblockUI();
            });
        });

        $('#btn_new').click(function(){
            _txnMode="new";
            $('.transaction_type').text('New');
            $('#modal_create_rights').modal('show');
            clearFields($('#frm_user_group'));
        });

        $('#btn_create').click(function(){
            if(validateRequiredFields($('#frm_user_group'))){
                if(_txnMode==="new"){
                    createUserAccount().done(function(response){
                        showNotification(response);
                        dt.row.add(response.row_added[0]).draw();
                        clearFields($('#frm_user_group'))
                    }).always(function(){
                        $('#modal_create_rights').modal('hide');
                        $.unblockUI();
                    });
                    return;
                }
                if(_txnMode==="edit"){
                    updateUserAccount().done(function(response){
                        showNotification(response);
                        dt.row(_selectRowObj).data(response.row_updated[0]).draw();
                    }).always(function(){
                        $('#modal_create_rights').modal('hide');
                        $.unblockUI();
                    });
                    return;
                }
            }
            else{}
        });

        $('#btn_save_rights').click(function(){
            if(validateRequiredFields($('#frm_rights'))){
                    saveUserRights().done(function(response){
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
        var pword=$('#user_pword').val();
        var cpword=$('#user_confirm_pword').val();
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
                    $('#password').addClass('has-error');
                    $('#confpassword').addClass('has-error');
                    $('#user_confirm_pword').focus();
                    stat=false;
                    return false;
                }




        });

        return stat;
    };

    var createUserAccount=function(){
            var _data=$('#frm_user_group').serializeArray();

            return $.ajax({
                "dataType":"json",
                "type":"POST",
                "url":"UserGroups/transaction/create",
                "data":_data,
                "beforeSend": showSpinningProgress($('#btn_save'))
            });
        };


    var updateUserAccount=function(){
            var _data=$('#frm_user_group').serializeArray();
            _data.push({name : "user_group_id" ,value : _selectedID});
            return $.ajax({
                "dataType":"json",
                "type":"POST",
                "url":"UserGroups/transaction/update",
                "data":_data,
                "beforeSend": showSpinningProgress($('#btn_save'))
            });
        };

    var removeUserAccount=function(){
            return $.ajax({
                "dataType":"json",
                "type":"POST",
                "url":"UserGroups/transaction/delete",
                "data":{user_group_id : _selectedID},
                "beforeSend": showSpinningProgress($('#'))
            });
        };

    var saveUserRights=function(){
            var _data=$('#frm_rights').serializeArray();
            _data.push({name : "user_group_id" ,value : _selectedID});
            return $.ajax({
                "dataType":"json",
                "type":"POST",
                "url":"UserGroups/transaction/saverights",
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
        $(f).find('input:first').focus();
    };



    function format ( d ) {
        return '<div class="container-fluid" style="margin:10px;">'+
        '<div class="col-md-12">'+
        '<h3 class="boldlabel"><span class="glyphicon glyphicon-user fa-lg"></span> ' + d.full_name+ '</h3>'+
        '<p>[ Username : '+d.user_name+' ] [ Account Type : '+d.user_group+' ]</p>'+
        '<hr style="height:1px;background-color:black;"></hr>'+
        '</div>'+ //First Row//
        '<div class="row">'+
        '<div class="col-md-3">'+
        '<center><img class="loadingimg" style="margin-top:4px;width:150px;height:150px;" src="'+d.photo_path+'"></img></center>'+
        '</div>'+
        '<div class="col-md-6"><p class="nomargin"><b>Gender</b> : '+d.user_email+'</p>'+
        '<p class="nomargin"><b>Birthdate</b> : '+d.user_mobile+'</p>'+
        '<p class="nomargin"><b>Civil Status</b> : '+d.user_telephone+'</p>'+
        '<p class="nomargin"><b>Blood Type</b> : '+d.user_bdate+'</p>'+
        '<p class="nomargin"><b>Blood Type</b> : '+d.user_address+'</p>'+

        '</div>'+
        '</div>'+
        '<hr style="height:1px;background-color:black;"></hr>'+
        '</div>';
    };

});

</script>

</body>
<?php echo $loaderscript; ?>
</html>
