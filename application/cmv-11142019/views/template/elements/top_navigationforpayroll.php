<!--Header-->
<header id="topnav" class="navbar navbar-black navbar-fixed-top" role="banner">

    <div class="logo-area">
                <span id="trigger-sidebar" class="toolbar-trigger toolbar-icon-bg">
                    <a data-toggle="tooltips" data-placement="right" title="Toggle Sidebar">
                        <span class="icon-bg">
                            <i class="ti ti-menu"></i>
                        </span>
                    </a>
                </span>


                <span style="color: #90EE90;font-size: 13pt;margin-top: 15px;text-transform: uppercase;font-weight: normal!important;">
                    <?php echo $this->session->company_name; ?>
                </span>



    </div><!-- logo-area -->

    <ul class="nav navbar-nav toolbar pull-right">
        <li class="dropdown toolbar-icon-bg">
            <button type="button" class="btn btn-default right_dtr_processpayroll" id="process_payroll" style="margin-top: 10px;">
                <i class="fa fa-check-circle"></i> Process Payroll
            </button>
        </li>
        <li class="dropdown toolbar-icon-bg">
            <button type="button" class="btn btn-default right_dtr_updatepayroll" id="btn_refresh_list" style="margin-top: 10px;">
                <i class="fa fa-refresh"></i>
            </button>
        </li>

        <li class="dropdown toolbar-icon-bg">
            <a href="#" class="dropdown-toggle username" data-toggle="dropdown">
                <img class="img-circle" src="<?php echo $this->session->user_photo; ?>" alt="" />
            </a>
            <ul class="dropdown-menu userinfo arrow">
                <li><a href="login/transaction/logout"><i class="ti ti-shift-right"></i><span>Sign Out</span></a></li>
            </ul>
        </li>

    </ul>

</header><!--Header-->
