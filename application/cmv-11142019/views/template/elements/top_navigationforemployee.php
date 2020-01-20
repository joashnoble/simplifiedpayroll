<!--Header-->
<header id="topnav" class="navbar navbar-black navbar-fixed-top" role="banner">

    <div class="logo-area" style="width:35%;">
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

        <li class="toolbar-icon-bg hidden-xs right_employee_create" style="display:" id="icon_new_employee">
            <a href="#" class="btn_new"  title="New Employee"><span class="icon-bg"><i class="fa fa-user-plus"></i></span></i></a>
        </li>

        <li class="dropdown toolbar-icon-bg hidden-md hidden-lg hidden-sm">
            <a href="#" class="dropdown-toggle username" data-toggle="dropdown">
                <img  src="assets/img/Menu.svg" alt="" />
            </a>
            <ul class="dropdown-menu userinfo arrow">
                <li><a href="#" class="btn_new"  title="New Employee">Add Employee</i></a></li>
            </ul>
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
