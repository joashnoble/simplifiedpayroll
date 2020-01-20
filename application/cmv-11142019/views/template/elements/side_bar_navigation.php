<div class="static-sidebar-wrapper sidebar-black">
    <div class="static-sidebar">
        <div class="sidebar">
            <div class="widget">
                <div class="widget-body">
                    <div class="userinfo">
                        <div class="avatar">
                            <img src="<?php echo $this->session->user_photo; ?>" class="img-responsive img-circle" style="height:100%;">
                        </div>
                        <div class="info">
                            <span class="username sbn-user"><?php echo $this->session->user_fullname; ?></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="widget stay-on-collapse" id="widget-sidebar">
                <nav role="navigation" class="widget-body">
                    <ul class="acc-menu">
                        <li class="nav-separator"><span>EXPLORE</span></li>
                        <li><a href="Dashboard" class="main-category"><i class="ti ti-home"></i><span>Dashboard</span></a></li>
                        <li class="right_employee_view"><a href="Employee" class="main-category"><i class="fa fa-user"></i> Employee Information</a>
                        <li class="right_empreference_view"><a href="javascript:void();" class="main-category"><i class="fa fa-folder" aria-hidden="true"></i><span>References</span></a>
                            <ul class="acc-menu">
                                <li class="right_emp_type_view sub-category"><a href="RefEmploymentType" class="sub-category">Employment Type Management</a>
                                </li>
                                <li class="right_branch_view sub-category"><a href="RefBranch" class="sub-category">Branch Management</a>
                                </li>
                                <li class="right_department_view sub-category"><a href="RefDepartment" class="sub-category">Department Management</a>
                                </li>
                                <li class="right_position_view sub-category"><a href="RefPosition" class="sub-category">Position Management</a>
                                </li>
                                <li class="right_section_view sub-category"><a href="RefSection" class="sub-category">Section Management</a>
                                </li>
                                 <li class="right_pay_frequency_view sub-category"><a href="RefPayFrequencyType" class="sub-category">Pay Frequency Management</a>
                                </li>
                                <li class="right_payperiod_view sub-category"><a href="RefPayPeriodSetup" class="sub-category">Pay Period Management</a>
                                </li>
                            </ul>
                        </li>
                        <li class="right_contribution_view"><a href="javascript:void();" class="main-category"><i class="fa fa-file" aria-hidden="true"></i><span>Contribution References</span></a>
                            <ul class="acc-menu">
                                <li class="right_sss_view"><a href="RefSSS_Contribution" class="sub-category">SSS Contribution</a>
                                </li>
                                <li class="right_philhealth_view"><a href="RefPhilHealth_Contribution" class="sub-category">Philhealth Contribution</a>
                                </li>
                                <li class="right_taxtable_view"><a href="RefWTax" class="sub-category">Tax File</a>
                                </li>
                            </ul>
                        </li>
                        <li class="right_loandeduction_view"><a href="RefLoan" class="main-category"><i class="fa fa-cog"></i><span>Loan &amp; Deduction Setup</span></a></li>
                        <li class="right_payrollparent_view"><a href="javascript:void();" class="main-category"><i class="fa fa-pie-chart" aria-hidden="true"></i><span>Payroll</span></a>
                            <ul class="acc-menu">
                                <li class="right_dtr_view"><a href="Payroll" class="sub-category">Daily time Record</a>
                                </li>
                                <li class="right_payslip_view"><a href="PaySlip" class="sub-category">Pay Slip</a>
                                </li>
                                <li class="right_dtrsummary_view"><a href="EmployeeDTRSummary" class="sub-category">DTR Summary</a>
                                </li>
                                <li class="right_payroll_register_view"><a href="EmployeePayrollRegister" class="sub-category">Payroll Register</a>
                                </li>
                                <li class="right_payrollsummary_view"><a href="EmployeePayrollSummary" class="sub-category">Payroll Summary</a>
                                </li>
                                <li class="right_13thmonthpay_view"><a href="Employee13thMonthPay" class="sub-category">13th Month Pay</a>
                                </li>
                                <li class="right_alphalist_view"><a href="AlphaList" class="sub-category">Alpha List of Employee</a></li>
                                <li class="right_1601C_view"><a href="Report1601C" class="sub-category">1601C Report</a></li>
                                <li class="right_bir2316_view"><a href="Bir_2316" class="sub-category">BIR 2316</a></li>
                                <li class="right_employee_compensation_view"><a href="EmployeeCompensation" class="sub-category">Employee Compensation</a>
                                </li>
                                <li class="right_employee_deduction_view"><a href="EmployeeDeductionHistory" class="sub-category">Employee Deduct. History</a>
                                </li>
                                <!-- 
                                <li class="right_ledger_view"><a href="EmployeeLedgers" class="">Employee Ledgers</a>
                                </li>
                                <li class="right_payrollhistory_view"><a href="EmployeePayrollHistory" class="" id="employee_payroll_history">Employee Payroll History</a>
                                </li>
                                <li class="right_monthlypayroll_view"><a href="EmployeeMonthlyPayrollSalary" class="" id="employee_monthly_salary">Employee Monthly Salary</a>
                                </li>
                                <li class="right_yearlypayroll_view"><a href="EmployeeYearlyPayrollSalary" class="" id="employee_yearly_salary">Employee Yearly Salary</a>
                                </li>
                                 -->
                            </ul>
                        </li>
                        <li class="right_payrollreports_view"><a href="javascript:void();" class="main-category"><i class="fa fa-file-text" aria-hidden="true"></i><span>Payroll Reports</span></a>
                            <ul class="acc-menu">
                                <li class="right_sssreport_view"><a href="SSSReport" class="sub-category">SSS Report</a>
                                </li>
                                <li class="right_philhealthreport_view"><a href="PHILHEALTHReport" class="sub-category">Philhealth Report</a>
                                </li>
                                <li class="right_pagibigreport_view"><a href="PagIbigReports" class="sub-category">Pag-Ibig Report</a>
                                </li>
                                <li class="right_wtaxreport_view"><a href="WTaxReports" class="sub-category">WTAX Report</a>
                                </li>
                            </ul>
                        </li>
                        <li class="right_adminparent_view"><a href="javascript:void();" class="main-category"><i class="fa fa-cog" aria-hidden="true"></i><span>Settings</span></a>
                            <ul class="acc-menu">
                                <li class="right_useraccount_view"><a href="Users" class="sub-category">User Account</a>
                                </li>
                                <li class="right_usergroup_view"><a href="UserGroups" class="sub-category">User Group</a>
                                </li>
                                <li class="right_companysetup_view"><a href="CompanySetup" class="sub-category">Company Setup</a>
                                </li>
                                <li class="right_reffactorfile_view"><a href="RefFactorFile" class="sub-category">Factor File</a>
                                </li>
                            </ul>
                        </li> 
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>