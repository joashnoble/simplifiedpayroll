<!DOCTYPE html>
<html lang="en" class="coming-soon">
<head>
    <meta charset="utf-8">
    <title><?php echo $title; ?></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <link rel="shortcut icon" href="<?php echo base_url("assets/img/logo/jdev-logo.png"); ?>">

    <meta name="author" content="">
    <link type="text/css" href="assets/css/bootstrap.css" rel="stylesheet">
    <link type="text/css" href="assets/css/animate.css" rel="stylesheet">
    <link href="assets/css/ample-login/animate.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="assets/css/ample-login/style.css" rel="stylesheet">
    <!-- color CSS -->
    <link href="assets/css/ample-login/colors/default.css" id="theme"  rel="stylesheet">
    <link type="text/css" href="assets/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link type="text/css" href="assets/fonts/font-awesome/css/font-awesome.min.css" rel="stylesheet">        
    <!-- Font Awesome -->
    <link type="text/css" href="assets/fonts/themify-icons/themify-icons.css" rel="stylesheet">              
    <!-- Themify Icons -->
    <link type="text/css" href="assets/plugins/codeprettifier/prettify.css" rel="stylesheet">                
    <!-- Code Prettifier -->
    <link type="text/css" href="assets/plugins/iCheck/skins/minimal/blue.css" rel="stylesheet">              
    <!-- iCheck -->
    <link href="assets/plugins/notify/pnotify.core.css" rel="stylesheet"> <!-- notification -->
    <!-- <link href="assets/css/pace.css" rel="stylesheet"> pace -->
    <link rel="stylesheet" href="assets/plugins/spinner/dist/ladda-themeless.min.css">
    <link rel="stylesheet" href="assets/css/fonts.css">
    <style>
      .ui-pnotify-title {
        color: white !important;
      }
      body {
        font-family: arial;
      }
      hr {
        border-top: 1px solid #eaeaea;
      }
      /* enable absolute positioning */
      .inner-addon { 
          position: relative; 
          margin-bottom: 20px;
      }

      /* style icon */
      .inner-addon .glyphicon {
        position: absolute;
        padding: 10px;
        pointer-events: none;
      }
      .new-login-register .lg-info-panel .lg-content {
        margin-top: 40%;
      }
      .new-login-register .lg-info-panel .inner-panel {
          background: rgba(0, 0, 0, 0.7);
      }
      .new-login-register .lg-info-panel {
        background: url('assets/img/background/payroll-bg.jpg') no-repeat center center / cover !important;
        width: 450px;
      }
      /* align icon */
      .left-addon .glyphicon  { left:  0px;}
      .right-addon .glyphicon { right: 0px;}

      /* add padding  */
      .left-addon input  { padding-left:  30px; }
      .right-addon input { padding-right: 30px; }  
      .logo-img{
          display: none;
      }

      .login-box{
        left: 20%;
      }
      .new-login-box{
        -webkit-box-shadow: 0px 0px 80px 1px rgba(212,212,212,1);
        -moz-box-shadow: 0px 0px 80px 1px rgba(212,212,212,1);
        box-shadow: 0px 0px 80px 1px rgba(212,212,212,1);border: 1px solid #CFD8DC;
      }
    </style>
    </head>
<body class="focused-form animated-content login-background">
<section id="wrapper" class="new-login-register">

      <div class="lg-info-panel">
          <div class="inner-panel" style="width: 450px;">
              <div class="lg-content">
                  <img style="min-height: 100px; min-width: 100px;max-height: 100px;" src="assets/img/company/jdev-logo.png">
                  <h1 style="font-family: sans-serif!important; color: #FFF;font-size: 20pt;"><b><i class="fa fa-lock"></i> COMPANY LOGIN</b></h1>
                  <hr>
                  <h2 style="font-family: sans-serif!important; color: #FFF; ">Simplified Payroll</h2>
                  <!-- <hr><h1 style="font-family: sans-serif!important; color: white;"><b>Simplified Payroll</b></h1><hr> -->
                  <!-- <h3 style="color: #03a9f4;">JDEV Office Solution Inc.</h3> -->
                  <span style="position: absolute; bottom: -3%; right: 1%;"><p style="color: #FFF;">powered by 
                  <img src="assets/img/company/jdev-logo.png" height="30" width="60"></p></span>
              </div>
          </div>
      </div>

      <div class="new-login-box">
          <div class="white-box">
            <center>
              <h3 class="box-title m-b-0">Company Login</h3>
              <small>Please Enter your details below</small>
            </center>
            <form action="#" class="form-horizontal" id="validate-form" style="margin-top: 5%;">
              <div class="inner-addon left-addon" id="userdiv">
                  <i class="glyphicon glyphicon-user"></i>
                  <input name="ccode" id="user" type="text" class="form-control " style="border-radius: 0;" placeholder="Company Code" required>
              </div>
              <div class="inner-addon left-addon" id="passdiv">
                  <i class="glyphicon glyphicon-lock"></i>
                  <input name="pword" id="pass" type="password" class="form-control" style="border-radius: 0;" id="exampleInputPassword1" placeholder="Password">
              </div>
              <div class="row">             
                <div class="col-xs-12 col-sm-12">                
                  <button id="btn_login" class="btn btn-primary btn-block btn-custom-jk" data-style="expand-left" data-spinner-color="white" data-size="s" style="margin-bottom: 0px;background: #01579B;padding: 5px;">
                  <span class=""></span> Login
                  </button>
                </div>
              </div>
          </form>
        </div>
    </div>            

</section>
<?php echo $_def_js_files; ?>
<script src="assets/plugins/spinner/dist/spin.min.js"></script>
<script src="assets/plugins/spinner/dist/ladda.min.js"></script>
    <script>
        $(document).ready(function(){
            $('#user').focus()
            var bindEventHandlers=(function(){
                $('#btn_login').click(function(){
                    var l = Ladda.create(this);
                    l.start();
                    validateCompany().done(function(response){
                        showNotification(response);
                        if(response.stat=="success"){
                            setTimeout(function(){
                                window.location.href = "login";
                            },600);
                        }
                    }).always(function(){
                        l.stop();
                    });
                });
                $('input').keypress(function(evt){
                    if(evt.keyCode==13){
                      evt.preventDefault();
                      $('#btn_login').click();
                    }
                });
            })();
            var validateCompany=function(){
                var _data={ccode : $('input[name="ccode"]').val() , pword : $('input[name="pword"]').val()};
                return $.ajax({
                    "dataType":"json",
                    "type":"POST",
                    "url":"CompanyLogin/transaction/validate_company",
                    "data" : _data,
                    "beforeSend": function(){
                    }
                });
            };
            var showNotification=function(obj){
                PNotify.removeAll(); //remove all notifications
                new PNotify({
                    title:  obj.title,
                    text:  obj.msg,
                    type:  obj.stat
                });
            };
        });
    </script>

</body>
</html>
