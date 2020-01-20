<link rel="shortcut icon" href="<?php echo base_url("assets/img/logo/jdev-logo.png"); ?>">
<style type="text/css">

        .numeric, .numeric_4{
            text-align: right;
        }

        table{
            border-collapse: collapse;
        }

        table td, table th{
            cursor: pointer;
        }
        table tr:nth-child(even) {background: #FFF!important;}
        table tr:nth-child(odd) {background: #F5F5F5!important;}
        
        table td{
            padding: 1px!important;
            padding-left: 10px!important;
            vertical-align: middle!important;
        }

        table tr:hover { 
            background-color:#FFFDE7!important; 
        }
        .dataTables_info{
            padding-left: 20px;
            margin-top: -10px;
            color: black;
        }        
        .pagination > li > a, .pagination > li > span{background-color:white; color: black!important;}
        .pagination > li.active > a, .pagination > li.active > span{background-color:#217345; outline: none;border: 1px solid gray;color: white!important;}
        .pagination > li.active > a:hover, .pagination > li.active > span:hover{background-color:#217345;cursor: pointer;border: 1px solid gray;}
        .pagination > li { margin-right: 2px; }
        .pagination { margin-top: -50px!important; }
        .dataTables_wrapper .dataTables_paginate {
            margin-top: -10px;margin-bottom: 10px;
        }

        td.details-control {
            background: url('assets/img/icon/Folder_Closed.png') no-repeat center center;
            cursor: pointer;
        }
        tr.details td.details-control {
            background: url('assets/img/icon/Folder_Opened.png') no-repeat center center;
        }

        fieldset{
            margin-top: 10px;
        }

        #btn_save, #btn_cancelempfields{
            border: 1px solid #B0BEC5!important;
        }

        #btn_save:hover{
            background-color: #2E7D32!important;
            color: #FFF;
        }

        #btn_cancelempfields:hover{
            background-color: #b71c1c!important;
            color: #FFF;
        }

        .red{
            color: red;
        }
        
/*
        .toolbar{
            float: left;
        }

        td.details-control {
            background: url('assets/img/Folder_Closed.png') no-repeat center center;
            cursor: pointer;
        }
        tr.details td.details-control {
            background: url('assets/img/Folder_Opened.png') no-repeat center center;
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
        .odd{
            background-color: #eeeeee !important;
        }*/


</style>