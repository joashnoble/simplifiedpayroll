-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 05, 2018 at 03:03 AM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `simplified_payroll`
--

-- --------------------------------------------------------

--
-- Table structure for table `announcement_post`
--

CREATE TABLE `announcement_post` (
  `announcement_post_id` int(11) NOT NULL,
  `announcement_title` varchar(255) NOT NULL,
  `announcement` varchar(255) NOT NULL,
  `branch_id` int(11) DEFAULT NULL,
  `department_id` int(11) DEFAULT NULL,
  `group_id` int(11) DEFAULT NULL,
  `date_created` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `date_modified` datetime NOT NULL,
  `modified_by` int(11) NOT NULL,
  `date_deleted` datetime NOT NULL,
  `deleted_by` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `is_deleted` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `announcement_read_status`
--

CREATE TABLE `announcement_read_status` (
  `read_status_id` int(11) NOT NULL,
  `announcement_post_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `backup`
--

CREATE TABLE `backup` (
  `backup_id` int(11) NOT NULL,
  `backup_name` varchar(250) DEFAULT NULL,
  `backup_date` varchar(45) DEFAULT NULL,
  `backup_path` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `bir_2316`
--

CREATE TABLE `bir_2316` (
  `bir_2316_id` int(11) NOT NULL,
  `for_year` varchar(20) DEFAULT NULL,
  `period_from` varchar(20) DEFAULT NULL,
  `period_to` varchar(20) DEFAULT NULL,
  `taxpayer_identification_no` varchar(100) DEFAULT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `rdo_code` varchar(100) DEFAULT NULL,
  `registered_address` varchar(500) DEFAULT NULL,
  `registered_zipcode` varchar(100) DEFAULT NULL,
  `localhome_address` varchar(500) DEFAULT NULL,
  `localhome_zipcode` varchar(100) DEFAULT NULL,
  `foreign_address` varchar(500) DEFAULT NULL,
  `foreign_zipcode` varchar(100) DEFAULT NULL,
  `birthdate` varchar(50) DEFAULT NULL,
  `telphone_number` varchar(20) DEFAULT NULL,
  `exemption_status` tinyint(1) NOT NULL DEFAULT '0',
  `wife_claiming` tinyint(1) NOT NULL,
  `stat_minimum_wage_per_month` decimal(11,2) DEFAULT NULL,
  `stat_minimum_wage_per_day` decimal(11,2) DEFAULT NULL,
  `present_employer_tin` varchar(50) DEFAULT NULL,
  `employer_name` varchar(200) DEFAULT NULL,
  `employer_regadress` varchar(200) DEFAULT NULL,
  `employer_zipcode` varchar(50) DEFAULT NULL,
  `gross_compensation_present_employer` decimal(11,2) DEFAULT NULL,
  `less_total_nontax_exempt` decimal(11,2) DEFAULT NULL,
  `taxable_compensation_income` decimal(11,2) DEFAULT NULL,
  `add_taxcompensation_previous_employer` decimal(11,2) DEFAULT NULL,
  `gross_taxable_compensation_income` decimal(11,2) DEFAULT NULL,
  `less_total_exemption` decimal(11,2) DEFAULT NULL,
  `less_premium_paid` decimal(11,2) DEFAULT NULL,
  `net_taxable_compensation_income` decimal(11,2) DEFAULT NULL,
  `tax_due` decimal(11,2) DEFAULT NULL,
  `tax_withheld_present_employer` decimal(11,2) DEFAULT NULL,
  `tax_withheld_previous_employer` decimal(11,2) DEFAULT NULL,
  `total_amount_taxes` decimal(11,2) DEFAULT NULL,
  `basic_salary_minimum` decimal(11,2) DEFAULT NULL,
  `holiday_pay` decimal(11,2) DEFAULT NULL,
  `overtime_pay_mwe` decimal(11,2) DEFAULT NULL,
  `night_shift_differential` decimal(11,2) DEFAULT NULL,
  `hazard_pay_mwe` decimal(11,2) DEFAULT NULL,
  `13th_month_pay` decimal(11,2) DEFAULT NULL,
  `de_minimis` decimal(11,2) DEFAULT NULL,
  `contributions_dues` decimal(11,2) DEFAULT NULL,
  `compensation_salariesforms` decimal(11,2) DEFAULT NULL,
  `total_nontax_compensation` decimal(11,2) DEFAULT NULL,
  `basic_salary` decimal(11,2) DEFAULT NULL,
  `representation` decimal(11,2) DEFAULT NULL,
  `transportation` decimal(11,2) DEFAULT NULL,
  `cost_of_living` decimal(11,2) DEFAULT NULL,
  `fixed_housing` decimal(11,2) DEFAULT NULL,
  `othersa` decimal(11,2) DEFAULT NULL,
  `othersaamount` decimal(11,2) DEFAULT NULL,
  `commision` decimal(11,2) DEFAULT NULL,
  `profit_sharing` decimal(11,2) DEFAULT NULL,
  `fees_director_fees` decimal(11,2) DEFAULT NULL,
  `taxable_13th_other_benefits` decimal(11,2) DEFAULT NULL,
  `hazard_pay` decimal(11,2) DEFAULT NULL,
  `overtime_pay` decimal(11,2) DEFAULT NULL,
  `total_taxable_compensation_income` decimal(11,2) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `deleted_by` int(11) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `date_modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `date_deleted` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `company_setup`
--

CREATE TABLE `company_setup` (
  `company_id` int(11) NOT NULL,
  `company_name` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `contact_no` varchar(85) DEFAULT NULL,
  `email_address` varchar(85) DEFAULT NULL,
  `email_password` varchar(255) NOT NULL,
  `main_directory` varchar(255) NOT NULL,
  `image_name` varchar(50) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `date_modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(11) NOT NULL,
  `rdo` varchar(100) DEFAULT NULL,
  `bir_reg_no` varchar(50) DEFAULT NULL,
  `applicable_year` varchar(20) DEFAULT NULL,
  `applicable_month` varchar(20) DEFAULT NULL,
  `tin_no` varchar(50) DEFAULT NULL,
  `quote` varchar(1000) DEFAULT 'Hello World'
) ENGINE=InnoDB AVG_ROW_LENGTH=16384 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `company_setup`
--

INSERT INTO `company_setup` (`company_id`, `company_name`, `address`, `contact_no`, `email_address`, `email_password`, `main_directory`, `image_name`, `created_by`, `date_created`, `date_modified`, `modified_by`, `rdo`, `bir_reg_no`, `applicable_year`, `applicable_month`, `tin_no`, `quote`) VALUES
(1, 'Simplified Payroll', 'Angeles City', ' ', ' ', ' ', 'SimplifiedPayroll', 'assets/img/company/5b03c87aeb436.png', 0, '0000-00-00 00:00:00', '2018-05-23 11:09:21', 1, NULL, NULL, NULL, NULL, '000000000', 'Simplified Payroll');

-- --------------------------------------------------------

--
-- Table structure for table `daily_time_record`
--

CREATE TABLE `daily_time_record` (
  `dtr_id` int(12) NOT NULL,
  `pay_period_id` int(12) NOT NULL DEFAULT '0',
  `employee_id` int(12) NOT NULL DEFAULT '0',
  `no_of_hrs` decimal(20,2) NOT NULL DEFAULT '0.00',
  `salary_reg_rates` decimal(20,2) NOT NULL DEFAULT '0.00',
  `basic_pay_total` decimal(20,2) NOT NULL DEFAULT '0.00',
  `overtime` decimal(20,2) NOT NULL DEFAULT '0.00',
  `holiday_pay` decimal(20,2) NOT NULL DEFAULT '0.00',
  `commission` decimal(20,2) NOT NULL DEFAULT '0.00',
  `gross_total` decimal(20,2) NOT NULL DEFAULT '0.00',
  `sss_deduction` decimal(20,2) NOT NULL DEFAULT '0.00',
  `sss_employer` decimal(20,2) DEFAULT '0.00',
  `sss_employer_contribution` decimal(20,2) DEFAULT '0.00',
  `philhealth_deduction` decimal(20,2) NOT NULL DEFAULT '0.00',
  `philhealth_employer` decimal(20,2) DEFAULT '0.00',
  `pagibig_deduction` decimal(20,2) NOT NULL DEFAULT '0.00',
  `wtax_deduction` decimal(20,2) NOT NULL DEFAULT '0.00',
  `sss_loan` decimal(20,2) DEFAULT '0.00',
  `pagibig_loan` decimal(20,2) DEFAULT '0.00',
  `cash_advance` decimal(20,2) NOT NULL DEFAULT '0.00',
  `total_deduction` decimal(20,2) DEFAULT '0.00',
  `net_total` decimal(20,2) NOT NULL DEFAULT '0.00',
  `for_13thmonth` decimal(20,2) DEFAULT '0.00',
  `sss_loan_id` int(12) DEFAULT '0',
  `pagibig_loan_id` int(12) DEFAULT '0',
  `cash_advance_id` int(12) DEFAULT '0',
  `is_processed` tinyint(1) DEFAULT '0',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `deleted_by` int(12) NOT NULL DEFAULT '0',
  `date_deleted` datetime NOT NULL,
  `modified_by` int(12) NOT NULL DEFAULT '0',
  `date_modified` datetime NOT NULL,
  `created_by` int(12) NOT NULL DEFAULT '0',
  `date_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `daily_time_record`
--

INSERT INTO `daily_time_record` (`dtr_id`, `pay_period_id`, `employee_id`, `no_of_hrs`, `salary_reg_rates`, `basic_pay_total`, `overtime`, `holiday_pay`, `commission`, `gross_total`, `sss_deduction`, `sss_employer`, `sss_employer_contribution`, `philhealth_deduction`, `philhealth_employer`, `pagibig_deduction`, `wtax_deduction`, `sss_loan`, `pagibig_loan`, `cash_advance`, `total_deduction`, `net_total`, `for_13thmonth`, `sss_loan_id`, `pagibig_loan_id`, `cash_advance_id`, `is_processed`, `is_deleted`, `deleted_by`, `date_deleted`, `modified_by`, `date_modified`, `created_by`, `date_created`) VALUES
(1, 1, 1, '104.00', '7500.00', '7500.48', '1500.00', '500.00', '500.00', '10000.48', '272.50', '552.50', '15.00', '103.13', '103.13', '50.00', '0.00', '0.00', '0.00', '0.00', '425.63', '9574.85', '7500.48', 0, 0, 0, 1, 0, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 1, '2018-06-04 15:21:30');

-- --------------------------------------------------------

--
-- Table structure for table `deductions_temporary`
--

CREATE TABLE `deductions_temporary` (
  `deduction_temporary_id` int(11) NOT NULL,
  `pay_period_id` int(11) DEFAULT '0',
  `employee_id` int(11) DEFAULT '0',
  `deduction_id` int(11) DEFAULT '0',
  `deduction_temporary_amount` decimal(19,5) DEFAULT '0.00000',
  `deduction_temporary_remarks` varchar(300) DEFAULT '',
  `created_by` int(11) DEFAULT NULL,
  `created_datetime` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` int(11) DEFAULT NULL,
  `modified_datetime` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_by` int(11) DEFAULT NULL,
  `deleted_datetime` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `is_deleted` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `dtr_deductions`
--

CREATE TABLE `dtr_deductions` (
  `dtr_deduction_id` int(11) NOT NULL,
  `dtr_id` int(11) DEFAULT NULL,
  `deduction_id` int(11) DEFAULT NULL,
  `deduction_regular_id` int(11) DEFAULT NULL,
  `is_deduct` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AVG_ROW_LENGTH=109 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `email_user_settings`
--

CREATE TABLE `email_user_settings` (
  `email_user_settings_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `email_address` varchar(255) NOT NULL,
  `email_password` varchar(255) NOT NULL,
  `date_modified` datetime NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `employee_account`
--

CREATE TABLE `employee_account` (
  `employee_account_id` int(11) NOT NULL,
  `employee_id` int(12) NOT NULL,
  `employee_ecode` varchar(255) NOT NULL,
  `employee_pwd` varchar(255) NOT NULL,
  `employee_status` tinyint(1) DEFAULT '1',
  `session_status` tinyint(1) DEFAULT '0',
  `is_deleted` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `employee_break`
--

CREATE TABLE `employee_break` (
  `employee_break_id` int(11) NOT NULL,
  `schedule_employee_id` int(11) NOT NULL,
  `break_time` time DEFAULT '00:00:00',
  `break_out` datetime DEFAULT '0000-00-00 00:00:00',
  `break_in` datetime DEFAULT '0000-00-00 00:00:00',
  `break_is_out` tinyint(1) NOT NULL DEFAULT '0',
  `break_is_in` tinyint(1) NOT NULL DEFAULT '0',
  `break_late` decimal(20,2) NOT NULL DEFAULT '0.00',
  `break_allowance` decimal(20,0) NOT NULL DEFAULT '0',
  `sort_key` int(11) NOT NULL,
  `total` int(11) NOT NULL DEFAULT '0',
  `date_created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `date_modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `date_deleted` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_by` int(11) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `employee_clearance`
--

CREATE TABLE `employee_clearance` (
  `employee_clearance_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `accumulated_13thmonth_pay` decimal(20,2) NOT NULL DEFAULT '0.00',
  `additional_pay` decimal(20,2) NOT NULL DEFAULT '0.00',
  `total_due_date` decimal(20,2) DEFAULT '0.00',
  `no_of_leave` decimal(20,2) NOT NULL DEFAULT '0.00',
  `leave_pay` decimal(20,2) NOT NULL DEFAULT '0.00',
  `total_leave` decimal(20,2) NOT NULL DEFAULT '0.00',
  `tax_refund` decimal(20,2) NOT NULL DEFAULT '0.00',
  `last_payroll` decimal(20,2) NOT NULL DEFAULT '0.00',
  `payslip_no` varchar(255) NOT NULL,
  `net_total` decimal(20,2) NOT NULL DEFAULT '0.00',
  `date_cleared` date NOT NULL DEFAULT '0000-00-00',
  `date_created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(11) NOT NULL DEFAULT '0',
  `clearance_reason_id` int(11) NOT NULL DEFAULT '0',
  `grand_total` decimal(20,2) NOT NULL DEFAULT '0.00',
  `date_deleted` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_by` int(11) NOT NULL DEFAULT '0',
  `is_deleted` tinyint(1) DEFAULT '0',
  `cleared_by` int(11) DEFAULT '0',
  `clearance_status` tinyint(1) NOT NULL DEFAULT '0',
  `include_last_pay` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `employee_clearance_deduction`
--

CREATE TABLE `employee_clearance_deduction` (
  `employee_clearance_deduction_id` int(11) NOT NULL,
  `employee_clearance_id` int(11) NOT NULL,
  `deduction_description` varchar(255) NOT NULL,
  `deduction_amount` decimal(20,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `employee_list`
--

CREATE TABLE `employee_list` (
  `employee_id` int(11) NOT NULL,
  `ecode` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) NOT NULL,
  `address_one` text,
  `address_two` text,
  `email_address` varchar(255) DEFAULT NULL,
  `cell_number` varchar(255) DEFAULT NULL,
  `birthdate` varchar(255) DEFAULT NULL,
  `civil_status` varchar(255) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `image_name` text,
  `sss` varchar(255) DEFAULT NULL,
  `phil_health` varchar(255) DEFAULT NULL,
  `pag_ibig` varchar(255) DEFAULT NULL,
  `tin` varchar(255) DEFAULT NULL,
  `bank_account` varchar(255) DEFAULT NULL,
  `bank_account_isprocess` tinyint(1) DEFAULT '0',
  `exmpt_sss` tinyint(1) DEFAULT '0',
  `exmpt_pagibig` tinyint(1) DEFAULT '0',
  `exmpt_philhealth` tinyint(1) DEFAULT '0',
  `employment_date` varchar(255) NOT NULL,
  `ref_employment_type_id` int(11) NOT NULL DEFAULT '0',
  `ref_department_id` int(11) DEFAULT '0',
  `ref_position_id` int(11) DEFAULT '0',
  `ref_section_id` int(11) DEFAULT '0',
  `ref_payment_type_id` int(11) NOT NULL DEFAULT '0',
  `hour_per_day` decimal(20,2) NOT NULL DEFAULT '0.00',
  `salary_reg_rates` decimal(20,2) NOT NULL DEFAULT '0.00',
  `monthly_based_salary` decimal(20,2) DEFAULT '0.00',
  `per_day_pay` decimal(20,2) NOT NULL DEFAULT '0.00',
  `per_hour_pay` decimal(20,2) NOT NULL DEFAULT '0.00',
  `is_retired` tinyint(1) DEFAULT '0',
  `date_retired` varchar(255) DEFAULT NULL,
  `date_end` varchar(255) DEFAULT NULL,
  `clearance_reason` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT '0',
  `date_created` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT '0',
  `date_modified` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT '0',
  `is_deleted` tinyint(1) DEFAULT '0',
  `deleted_by` int(11) DEFAULT '0',
  `date_deleted` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee_list`
--

INSERT INTO `employee_list` (`employee_id`, `ecode`, `first_name`, `middle_name`, `last_name`, `address_one`, `address_two`, `email_address`, `cell_number`, `birthdate`, `civil_status`, `gender`, `image_name`, `sss`, `phil_health`, `pag_ibig`, `tin`, `bank_account`, `bank_account_isprocess`, `exmpt_sss`, `exmpt_pagibig`, `exmpt_philhealth`, `employment_date`, `ref_employment_type_id`, `ref_department_id`, `ref_position_id`, `ref_section_id`, `ref_payment_type_id`, `hour_per_day`, `salary_reg_rates`, `monthly_based_salary`, `per_day_pay`, `per_hour_pay`, `is_retired`, `date_retired`, `date_end`, `clearance_reason`, `is_active`, `date_created`, `created_by`, `date_modified`, `modified_by`, `is_deleted`, `deleted_by`, `date_deleted`) VALUES
(1, '15712', 'Joash', '', 'Noble', '', '', '', '', '2018-06-04', '0', '0', 'assets/img/user/anonymous-icon.png', '', '', '', '', '', 0, 0, 0, 0, '2018-06-04', 0, 0, 0, 0, 1, '8.00', '7500.00', '15000.00', '576.92', '72.12', 0, '', '', NULL, 0, '2018-06-04 03:20:59', 1, NULL, 0, 0, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `emp_children_dependent`
--

CREATE TABLE `emp_children_dependent` (
  `emp_children_dependent_id` int(11) UNSIGNED NOT NULL,
  `employee_id` int(11) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `birthdate` date DEFAULT NULL,
  `ref_relationship_id` int(11) UNSIGNED NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `date_created` date NOT NULL DEFAULT '0000-00-00',
  `date_modified` date NOT NULL DEFAULT '0000-00-00',
  `is_deleted` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `deleted_by` int(11) NOT NULL,
  `date_deleted` date NOT NULL DEFAULT '0000-00-00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `emp_commendation`
--

CREATE TABLE `emp_commendation` (
  `emp_commendation_id` int(11) UNSIGNED NOT NULL,
  `employee_id` int(11) NOT NULL,
  `date_commendation` date NOT NULL,
  `memo_number` varchar(50) NOT NULL,
  `remarks` longtext,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `date_created` date NOT NULL DEFAULT '0000-00-00',
  `date_modified` date NOT NULL DEFAULT '0000-00-00',
  `is_deleted` tinyint(1) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `emp_confidential_status`
--

CREATE TABLE `emp_confidential_status` (
  `emp_confidential_status_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL DEFAULT '0',
  `effectivity_date` date NOT NULL,
  `confidential_reason` text NOT NULL,
  `block_active` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `emp_educational_attainment`
--

CREATE TABLE `emp_educational_attainment` (
  `emp_educational_attainment_id` int(11) UNSIGNED NOT NULL,
  `employee_id` int(11) UNSIGNED NOT NULL,
  `ref_course_degree_id` int(11) UNSIGNED NOT NULL,
  `year_graduate` date DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `is_deleted` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `deleted_by` int(11) NOT NULL,
  `date_deleted` date NOT NULL DEFAULT '0000-00-00'
) ENGINE=InnoDB AVG_ROW_LENGTH=8192 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `emp_emergency_contact_details`
--

CREATE TABLE `emp_emergency_contact_details` (
  `emp_emergency_contact_details_id` int(11) UNSIGNED NOT NULL,
  `employee_id` int(11) UNSIGNED NOT NULL,
  `name` varchar(300) DEFAULT NULL,
  `ref_relationship_id` int(11) UNSIGNED NOT NULL,
  `contact_number_one` varchar(500) NOT NULL,
  `contact_number_two` varchar(500) DEFAULT NULL,
  `address` varchar(500) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `date_created` date NOT NULL DEFAULT '0000-00-00',
  `date_modified` date NOT NULL DEFAULT '0000-00-00',
  `is_deleted` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `deleted_by` int(11) NOT NULL,
  `date_deleted` date DEFAULT '0000-00-00'
) ENGINE=InnoDB AVG_ROW_LENGTH=8192 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `emp_family_details`
--

CREATE TABLE `emp_family_details` (
  `emp_family_details_id` int(11) UNSIGNED NOT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `name` varchar(300) DEFAULT NULL,
  `ref_relationship_id` int(10) UNSIGNED NOT NULL,
  `birthdate` date NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `date_created` date NOT NULL DEFAULT '0000-00-00',
  `date_modified` date NOT NULL DEFAULT '0000-00-00',
  `is_deleted` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `deleted_by` int(11) NOT NULL,
  `date_deleted` date NOT NULL DEFAULT '0000-00-00'
) ENGINE=InnoDB AVG_ROW_LENGTH=8192 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `emp_holiday_pay_list`
--

CREATE TABLE `emp_holiday_pay_list` (
  `emp_holiday_pay_id` int(12) NOT NULL,
  `employee_id` int(12) DEFAULT NULL,
  `dtr_id` int(12) DEFAULT '0',
  `pay_period_id` int(12) DEFAULT NULL,
  `reg_hol` decimal(20,2) NOT NULL DEFAULT '0.00',
  `reg_hol_amt` decimal(20,2) DEFAULT '0.00',
  `sun_reg_hol` decimal(20,2) NOT NULL DEFAULT '0.00',
  `sun_reg_hol_amt` decimal(20,2) DEFAULT '0.00',
  `spe_hol` decimal(20,2) NOT NULL DEFAULT '0.00',
  `spe_hol_amt` decimal(20,2) DEFAULT '0.00',
  `sun_spe_hol` decimal(20,2) NOT NULL DEFAULT '0.00',
  `sun_spe_hol_amt` decimal(20,2) DEFAULT '0.00',
  `holiday_total` decimal(20,2) NOT NULL DEFAULT '0.00',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `deleted_by` int(12) NOT NULL DEFAULT '0',
  `modified_by` int(12) NOT NULL DEFAULT '0',
  `created_by` int(12) NOT NULL DEFAULT '0',
  `date_deleted` datetime NOT NULL,
  `date_modified` datetime NOT NULL,
  `date_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `emp_holiday_pay_list`
--

INSERT INTO `emp_holiday_pay_list` (`emp_holiday_pay_id`, `employee_id`, `dtr_id`, `pay_period_id`, `reg_hol`, `reg_hol_amt`, `sun_reg_hol`, `sun_reg_hol_amt`, `spe_hol`, `spe_hol_amt`, `sun_spe_hol`, `sun_spe_hol_amt`, `holiday_total`, `is_deleted`, `deleted_by`, `modified_by`, `created_by`, `date_deleted`, `date_modified`, `date_created`) VALUES
(1, 1, 1, 1, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2018-06-04 15:21:30');

-- --------------------------------------------------------

--
-- Table structure for table `emp_leaves_entitlement`
--

CREATE TABLE `emp_leaves_entitlement` (
  `emp_leaves_entitlement_id` int(11) UNSIGNED NOT NULL,
  `emp_leave_year_id` int(11) UNSIGNED NOT NULL,
  `employee_id` int(11) UNSIGNED NOT NULL,
  `ref_leave_type_id` int(11) DEFAULT NULL,
  `total_grant` decimal(18,1) UNSIGNED NOT NULL DEFAULT '0.0',
  `received_balance` decimal(18,1) DEFAULT '0.0',
  `current_balance` decimal(18,1) UNSIGNED NOT NULL DEFAULT '0.0',
  `remark` varchar(45) DEFAULT NULL,
  `is_payable` tinyint(1) NOT NULL DEFAULT '0',
  `is_forwardable` tinyint(1) NOT NULL DEFAULT '0',
  `is_forwarded` tinyint(1) NOT NULL DEFAULT '0',
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `date_modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `is_deleted` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `date_deleted` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_by` int(11) NOT NULL
) ENGINE=InnoDB AVG_ROW_LENGTH=4096 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `emp_leaves_filed`
--

CREATE TABLE `emp_leaves_filed` (
  `emp_leaves_filed_id` int(11) UNSIGNED NOT NULL,
  `emp_leave_year_id` int(11) UNSIGNED NOT NULL,
  `emp_leaves_entitlement_id` int(11) UNSIGNED NOT NULL,
  `ref_leave_type_id` int(11) NOT NULL,
  `employee_id` int(11) UNSIGNED NOT NULL,
  `date_filed` date DEFAULT NULL,
  `date_granted` date DEFAULT NULL,
  `purpose` longtext,
  `date_time_from` date DEFAULT NULL,
  `date_time_to` date DEFAULT NULL,
  `total` decimal(18,1) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `date_modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `is_deleted` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `date_deleted` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_by` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB AVG_ROW_LENGTH=2048 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `emp_leave_received_forwarded_history`
--

CREATE TABLE `emp_leave_received_forwarded_history` (
  `emp_leave_received_forwarded_history_id` int(11) UNSIGNED NOT NULL,
  `emp_leaves_entitlement_id` int(11) UNSIGNED NOT NULL,
  `created_by_user_id` int(11) UNSIGNED NOT NULL,
  `from_to_leave_year_id` int(11) DEFAULT NULL,
  `date` date NOT NULL,
  `type_process` varchar(45) DEFAULT '0.0',
  `balance` decimal(18,2) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `emp_leave_year`
--

CREATE TABLE `emp_leave_year` (
  `emp_leave_year_id` int(11) UNSIGNED NOT NULL,
  `year_type` varchar(45) DEFAULT NULL,
  `date_start` date DEFAULT NULL,
  `date_end` date DEFAULT NULL,
  `note` varchar(555) DEFAULT NULL,
  `active_year` tinyint(1) NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `date_modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `is_deleted` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `date_deleted` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_by` int(11) NOT NULL
) ENGINE=InnoDB AVG_ROW_LENGTH=8192 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `emp_leave_year`
--

INSERT INTO `emp_leave_year` (`emp_leave_year_id`, `year_type`, `date_start`, `date_end`, `note`, `active_year`, `created_by`, `modified_by`, `date_created`, `date_modified`, `is_deleted`, `date_deleted`, `deleted_by`) VALUES
(1, 'Calendar Year', '2017-01-01', '2018-01-01', 'January 2017 to January 2018', 0, 1, 1, '2017-06-28 15:36:52', '2017-12-05 13:52:23', 0, '0000-00-00 00:00:00', 0),
(2, 'Calendar Year', '2018-01-01', '2019-01-01', 'January 2018 to January 2019', 1, 1, 1, '2017-12-05 09:35:43', '2018-01-05 11:04:39', 0, '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `emp_memo`
--

CREATE TABLE `emp_memo` (
  `emp_memo_id` int(11) UNSIGNED NOT NULL,
  `employee_id` int(11) NOT NULL,
  `date_memo` date NOT NULL,
  `memo_number` varchar(50) NOT NULL,
  `ref_disciplinary_action_policy_id` int(11) UNSIGNED NOT NULL,
  `ref_action_taken_id` int(11) UNSIGNED NOT NULL,
  `date_granted` date DEFAULT NULL,
  `remarks` longtext,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `date_modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `is_deleted` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `deleted_by` int(11) NOT NULL,
  `date_deleted` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `emp_overtime_list`
--

CREATE TABLE `emp_overtime_list` (
  `emp_overtime_id` int(12) NOT NULL,
  `pay_period_id` int(12) NOT NULL,
  `dtr_id` int(12) DEFAULT '0',
  `employee_id` int(12) NOT NULL,
  `reg_ot` decimal(20,2) NOT NULL DEFAULT '0.00',
  `reg_ot_amt` decimal(20,2) DEFAULT '0.00',
  `sun_ot` decimal(20,2) NOT NULL DEFAULT '0.00',
  `sun_ot_amt` decimal(20,2) DEFAULT '0.00',
  `reg_hol_ot` decimal(20,2) NOT NULL DEFAULT '0.00',
  `reg_hol_ot_amt` decimal(20,2) DEFAULT '0.00',
  `sun_reg_hol_ot` decimal(20,2) NOT NULL DEFAULT '0.00',
  `sun_reg_hol_ot_amt` decimal(20,2) DEFAULT '0.00',
  `spe_hol_ot` decimal(20,2) NOT NULL DEFAULT '0.00',
  `spe_hol_ot_amt` decimal(20,2) DEFAULT '0.00',
  `sun_spe_hol_ot` decimal(20,2) NOT NULL DEFAULT '0.00',
  `sun_spe_hol_ot_amt` decimal(20,2) DEFAULT '0.00',
  `overtime_total` decimal(20,2) NOT NULL DEFAULT '0.00',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `deleted_by` int(12) NOT NULL DEFAULT '0',
  `date_deleted` datetime NOT NULL,
  `modified_by` int(12) NOT NULL DEFAULT '0',
  `date_modified` datetime NOT NULL,
  `created_by` int(12) NOT NULL DEFAULT '0',
  `date_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `emp_overtime_list`
--

INSERT INTO `emp_overtime_list` (`emp_overtime_id`, `pay_period_id`, `dtr_id`, `employee_id`, `reg_ot`, `reg_ot_amt`, `sun_ot`, `sun_ot_amt`, `reg_hol_ot`, `reg_hol_ot_amt`, `sun_reg_hol_ot`, `sun_reg_hol_ot_amt`, `spe_hol_ot`, `spe_hol_ot_amt`, `sun_spe_hol_ot`, `sun_spe_hol_ot_amt`, `overtime_total`, `is_deleted`, `deleted_by`, `date_deleted`, `modified_by`, `date_modified`, `created_by`, `date_created`) VALUES
(1, 1, 1, 1, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 1, '2018-06-04 15:21:30');

-- --------------------------------------------------------

--
-- Table structure for table `emp_rates_duties`
--

CREATE TABLE `emp_rates_duties` (
  `emp_rates_duties_id` int(11) UNSIGNED NOT NULL,
  `employee_id` int(11) UNSIGNED NOT NULL,
  `date_start` varchar(255) NOT NULL,
  `date_end` varchar(250) DEFAULT NULL,
  `duration_id` int(11) NOT NULL,
  `ref_position_id` int(11) UNSIGNED NOT NULL,
  `ref_employment_type_id` int(11) UNSIGNED NOT NULL,
  `ref_payment_type_id` int(11) DEFAULT NULL,
  `ref_department_id` int(11) UNSIGNED NOT NULL,
  `ref_branch_id` int(11) UNSIGNED NOT NULL,
  `ref_section_id` int(11) UNSIGNED NOT NULL,
  `ref_employment_status_id` int(11) UNSIGNED NOT NULL,
  `remarks` longtext,
  `hour_per_day` decimal(11,2) DEFAULT NULL,
  `salary_reg_rates` decimal(18,2) NOT NULL DEFAULT '0.00',
  `monthly_based_salary` decimal(20,2) DEFAULT '0.00',
  `per_day_pay` decimal(18,2) NOT NULL DEFAULT '0.00',
  `per_hour_pay` decimal(11,2) DEFAULT NULL,
  `sss_phic_salary_credit` decimal(18,2) DEFAULT '0.00',
  `philhealth_salary_credit` decimal(18,2) DEFAULT '0.00',
  `pagibig_salary_credit` decimal(18,2) DEFAULT '0.00',
  `tax_shield` decimal(18,2) DEFAULT '0.00',
  `active_rates_duties` tinyint(1) NOT NULL DEFAULT '0',
  `is_first_regularization` tinyint(1) NOT NULL DEFAULT '0',
  `is_sunday_premium` tinyint(1) NOT NULL DEFAULT '0',
  `group_id` int(11) DEFAULT NULL,
  `cola_per_hour` decimal(11,2) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(11) UNSIGNED DEFAULT NULL,
  `date_modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `is_deleted` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `date_deleted` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_by` int(11) NOT NULL
) ENGINE=InnoDB AVG_ROW_LENGTH=1260 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `emp_resignation_form`
--

CREATE TABLE `emp_resignation_form` (
  `emp_resignation_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL DEFAULT '0',
  `employee_clearance_id` int(11) NOT NULL DEFAULT '0',
  `reason_of_leave` text NOT NULL,
  `effectivity_date` varchar(255) NOT NULL,
  `approved_by` int(11) NOT NULL DEFAULT '0',
  `final_approve` text NOT NULL,
  `is_cleared` tinyint(1) NOT NULL DEFAULT '0',
  `resignation_note` text NOT NULL,
  `date_created` datetime NOT NULL,
  `date_modified` datetime NOT NULL,
  `date_deleted` datetime NOT NULL,
  `created_by` int(11) NOT NULL DEFAULT '0',
  `modified_by` int(11) NOT NULL DEFAULT '0',
  `deleted_by` int(11) NOT NULL DEFAULT '0',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `emp_seminar_training`
--

CREATE TABLE `emp_seminar_training` (
  `emp_seminar_training_id` int(11) UNSIGNED NOT NULL,
  `employee_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `seminar_title` varchar(300) NOT NULL,
  `given_by` varchar(300) NOT NULL,
  `date_from` date DEFAULT NULL,
  `date_to` date DEFAULT NULL,
  `venue` varchar(500) DEFAULT NULL,
  `ref_certificate_id` int(11) UNSIGNED NOT NULL,
  `remarks` longtext,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `date_modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `is_deleted` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `date_deleted` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `loan_list`
--

CREATE TABLE `loan_list` (
  `loan_id` int(12) NOT NULL,
  `loan_type` varchar(250) NOT NULL,
  `employee_id` int(12) NOT NULL DEFAULT '0',
  `total_loan` decimal(20,2) NOT NULL DEFAULT '0.00',
  `deduction_amt` decimal(20,2) NOT NULL DEFAULT '0.00',
  `balance` decimal(20,2) NOT NULL DEFAULT '0.00',
  `f1` tinyint(1) NOT NULL DEFAULT '0',
  `f2` tinyint(1) DEFAULT '0',
  `f3` tinyint(1) DEFAULT '0',
  `f4` tinyint(1) DEFAULT '0',
  `f5` tinyint(1) DEFAULT '0',
  `all` tinyint(1) DEFAULT '0',
  `date_created` datetime NOT NULL,
  `date_modified` datetime NOT NULL,
  `date_deleted` datetime NOT NULL,
  `created_by` int(12) NOT NULL,
  `modified_by` int(12) NOT NULL,
  `deleted_by` int(12) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `new_deductions_regular`
--

CREATE TABLE `new_deductions_regular` (
  `deduction_regular_id` int(11) NOT NULL,
  `employee_id` int(11) DEFAULT '0',
  `deduction_id` int(11) DEFAULT '0',
  `pay_period_id` int(11) DEFAULT '0',
  `deduction_total_amount` decimal(11,2) DEFAULT NULL,
  `deduction_per_pay_amount` decimal(11,2) DEFAULT NULL,
  `deduction_cycle` int(11) DEFAULT '0',
  `deduction_regular_remarks` varchar(300) DEFAULT '',
  `created_by` int(11) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(11) NOT NULL,
  `date_modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_by` int(11) NOT NULL,
  `date_deleted` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `is_deleted` tinyint(1) DEFAULT '0',
  `is_temporary` tinyint(1) DEFAULT '0',
  `deduction_total_amount_tempo` decimal(11,2) DEFAULT NULL,
  `loan_cashedout` tinyint(1) DEFAULT '0',
  `loan_total_amount` decimal(11,2) DEFAULT NULL
) ENGINE=InnoDB AVG_ROW_LENGTH=116 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `new_otherearnings_regular`
--

CREATE TABLE `new_otherearnings_regular` (
  `oe_regular_id` int(11) NOT NULL,
  `employee_id` int(11) DEFAULT '0',
  `earnings_id` int(11) DEFAULT '0',
  `pay_period_id` int(11) DEFAULT '0',
  `oe_regular_amount` decimal(11,2) DEFAULT NULL,
  `oe_cycle` int(11) DEFAULT '0',
  `pay_type_id` int(11) DEFAULT '0',
  `oe_regular_remarks` varchar(300) DEFAULT '',
  `created_by` int(11) NOT NULL,
  `date_created` datetime NOT NULL,
  `modified_by` int(11) NOT NULL,
  `date_modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_by` int(11) NOT NULL,
  `date_deleted` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `is_deleted` tinyint(1) DEFAULT '0',
  `is_temporary` tinyint(1) DEFAULT '0',
  `is_taxable` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB AVG_ROW_LENGTH=5461 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `nsdsetup`
--

CREATE TABLE `nsdsetup` (
  `nsdsetup_id` int(11) UNSIGNED NOT NULL,
  `nsd_start` time NOT NULL,
  `nsd_end` time DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) UNSIGNED DEFAULT NULL,
  `date_created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `date_modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `is_deleted` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `date_deleted` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_by` int(11) NOT NULL
) ENGINE=InnoDB AVG_ROW_LENGTH=8192 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `nsdsetup`
--

INSERT INTO `nsdsetup` (`nsdsetup_id`, `nsd_start`, `nsd_end`, `created_by`, `modified_by`, `date_created`, `date_modified`, `is_deleted`, `date_deleted`, `deleted_by`) VALUES
(1, '22:00:00', '06:00:00', 0, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `otherearnings_temporary`
--

CREATE TABLE `otherearnings_temporary` (
  `earnings_temporary_id` int(11) NOT NULL,
  `pay_period_id` int(11) DEFAULT '0',
  `employee_id` int(11) DEFAULT '0',
  `earnings_id` int(11) DEFAULT '0',
  `earnings_temporary_amount` decimal(19,5) DEFAULT '0.00000',
  `earnings_temporary_remarks` varchar(300) DEFAULT '',
  `created_by` int(11) DEFAULT NULL,
  `created_datetime` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` int(11) DEFAULT NULL,
  `modified_datetime` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_by` int(11) DEFAULT NULL,
  `deleted_datetime` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `is_deleted` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `pay_slip`
--

CREATE TABLE `pay_slip` (
  `pay_slip_id` int(11) NOT NULL,
  `payslip_no` varchar(255) DEFAULT NULL,
  `dtr_id` int(11) DEFAULT NULL,
  `date_processed` date NOT NULL DEFAULT '0000-00-00',
  `processed_by` int(11) NOT NULL
) ENGINE=InnoDB AVG_ROW_LENGTH=16384 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `pay_slip`
--

INSERT INTO `pay_slip` (`pay_slip_id`, `payslip_no`, `dtr_id`, `date_processed`, `processed_by`) VALUES
(1, '201801', 1, '2018-06-04', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pay_slip_deductions`
--

CREATE TABLE `pay_slip_deductions` (
  `pay_slip_deduction_id` int(11) NOT NULL,
  `pay_slip_id` int(11) DEFAULT NULL,
  `deduction_id` int(11) DEFAULT NULL,
  `deduction_amount` decimal(19,5) DEFAULT '0.00000',
  `deduction_regular_id` int(11) DEFAULT NULL,
  `sss_id` int(11) DEFAULT NULL,
  `sss_deduction_employee` decimal(20,2) NOT NULL DEFAULT '0.00',
  `sss_deduction_employer` decimal(20,2) NOT NULL DEFAULT '0.00',
  `sss_deduction_ec` decimal(20,2) NOT NULL DEFAULT '0.00',
  `philhealth_id` int(11) DEFAULT NULL,
  `wtax_id` int(11) DEFAULT NULL,
  `active_deduct` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB AVG_ROW_LENGTH=4915 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `pay_slip_earned`
--

CREATE TABLE `pay_slip_earned` (
  `pay_slip_earned_id` int(11) NOT NULL,
  `pay_slip_id` int(11) DEFAULT NULL,
  `deduction_id` int(11) DEFAULT NULL,
  `total_amount_earned` decimal(19,5) DEFAULT '0.00000',
  `deduction_regular_id` int(11) DEFAULT NULL
) ENGINE=InnoDB AVG_ROW_LENGTH=4915 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `pay_slip_loans_adjustments`
--

CREATE TABLE `pay_slip_loans_adjustments` (
  `loans_adjustments_id` int(11) NOT NULL,
  `particular` varchar(20) DEFAULT NULL,
  `debit_amount` decimal(11,2) DEFAULT NULL,
  `deduction_regular_id` int(11) DEFAULT NULL,
  `credit_amount` decimal(11,2) DEFAULT NULL,
  `reason` varchar(20) DEFAULT NULL,
  `is_deleted` tinyint(1) DEFAULT NULL,
  `date_created` date NOT NULL DEFAULT '0000-00-00',
  `created_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `pay_slip_other_earnings`
--

CREATE TABLE `pay_slip_other_earnings` (
  `pay_slip_other_earnings_id` int(11) NOT NULL,
  `pay_slip_id` int(11) DEFAULT NULL,
  `earnings_id` int(11) DEFAULT NULL,
  `earnings_amount` decimal(19,5) DEFAULT '0.00000',
  `oe_regular_id` int(11) DEFAULT NULL
) ENGINE=InnoDB AVG_ROW_LENGTH=4096 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `pay_slip_reset`
--

CREATE TABLE `pay_slip_reset` (
  `pay_slip_reset` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `refdeduction`
--

CREATE TABLE `refdeduction` (
  `deduction_id` int(11) NOT NULL,
  `deduction_desc` varchar(65) DEFAULT NULL,
  `deduction_type_id` int(11) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(11) NOT NULL,
  `date_modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_by` int(11) NOT NULL,
  `date_deleted` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `is_deleted` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB AVG_ROW_LENGTH=1820 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `refdeduction`
--

INSERT INTO `refdeduction` (`deduction_id`, `deduction_desc`, `deduction_type_id`, `created_by`, `date_created`, `modified_by`, `date_modified`, `deleted_by`, `date_deleted`, `is_deleted`) VALUES
(1, 'S.S.S.', 1, 0, '2016-04-20 22:29:37', 0, '2017-01-26 18:53:53', 0, '2017-01-26 18:53:53', 0),
(2, 'Philhealth', 1, 0, '2016-04-20 22:29:37', 0, '2017-01-26 18:53:53', 0, '2017-01-26 18:53:53', 0),
(3, 'Pagibig', 1, 0, '2016-04-20 22:29:37', 0, '2017-01-26 18:53:53', 0, '2017-01-26 18:53:53', 0),
(4, 'Withholding Tax', 1, 0, '2016-04-20 22:29:37', 0, '2017-01-26 18:53:53', 0, '2017-01-26 18:53:53', 0),
(5, 'S.S.S. Loan', 2, 0, '2016-04-05 21:50:42', 0, '2016-05-11 10:33:23', 0, '2017-01-26 18:53:53', 0),
(6, 'Pag-Ibig Loan', 1, 0, '2016-04-05 21:51:18', 1, '2017-12-05 12:14:50', 0, '2016-04-05 10:08:06', 0),
(7, 'Cash Advance', 4, 0, '2016-05-11 22:33:47', 1, '2017-05-30 14:00:45', 0, '2017-01-26 18:53:53', 0),
(8, 'COOP LOAN', 2, 0, '2016-11-30 07:53:07', 0, '2017-01-26 18:53:53', 0, '2017-01-26 18:53:53', 0),
(9, 'COOP CONTRIBUTION', 1, 0, '2016-11-30 07:53:21', 0, '2017-01-26 18:53:53', 0, '2017-01-26 18:53:53', 0),
(11, 'ATOE 3', 3, 0, '2017-01-26 19:53:18', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(12, 'Pag-Ibig Calamity Loan', 1, 0, '2017-02-22 08:03:16', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(13, 'Temporary Cash Advance', 5, 0, '2017-02-23 02:19:47', 1, '2017-03-28 17:44:30', 0, '0000-00-00 00:00:00', 0),
(14, 'ATOE1', 3, 0, '2017-02-23 10:02:06', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(15, 'Atoe 2', 3, 0, '2017-02-24 03:02:33', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(16, 'Excess of 13th Month', 6, 0, '2017-03-14 01:46:43', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(17, 'Charges', 7, 1, '2018-02-07 16:49:49', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `refdeductiontype`
--

CREATE TABLE `refdeductiontype` (
  `deduction_type_id` int(11) NOT NULL,
  `deduction_type_desc` varchar(65) DEFAULT '',
  `created_by` int(11) NOT NULL,
  `date_created` datetime DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(11) NOT NULL,
  `date_modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_by` int(11) NOT NULL,
  `date_deleted` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `is_deleted` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB AVG_ROW_LENGTH=3276 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `refdeductiontype`
--

INSERT INTO `refdeductiontype` (`deduction_type_id`, `deduction_type_desc`, `created_by`, `date_created`, `modified_by`, `date_modified`, `deleted_by`, `date_deleted`, `is_deleted`) VALUES
(1, 'Premium', 0, '2016-04-20 22:29:37', 0, '2017-01-26 18:53:53', 0, '2017-01-26 18:53:53', 0),
(2, 'Loans', 1, '2016-04-05 20:33:31', 0, '2017-01-26 18:53:53', 0, '2017-01-26 18:53:53', 0),
(3, 'Dues/Other Deductions', 1, '2016-04-05 20:33:31', 0, '2017-01-26 18:53:53', 0, '2017-01-26 18:53:53', 0),
(4, 'Advances', 0, '2016-05-22 17:35:43', 0, '2016-05-22 17:36:41', 0, '2016-05-22 17:36:00', 0),
(5, 'Temporary Cash advance', 0, '2016-12-01 05:42:13', 1, '2017-12-05 12:13:11', 0, '2017-01-26 18:53:53', 0),
(6, 'Overpayment of 13th month', 0, '2017-03-14 01:46:05', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(7, 'Charges', 3, '2018-02-07 16:26:40', 1, '2018-02-07 16:44:21', 0, '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `reffactorfile`
--

CREATE TABLE `reffactorfile` (
  `factor_id` int(11) NOT NULL,
  `regular_ot` decimal(19,5) DEFAULT '0.10000',
  `sunday` decimal(19,5) DEFAULT '0.10000',
  `day_off` decimal(19,5) NOT NULL DEFAULT '0.00000',
  `sunday_ot` decimal(19,5) DEFAULT '0.10000',
  `regular_holiday` decimal(19,5) DEFAULT '0.10000',
  `regular_holiday_ot` decimal(19,5) DEFAULT '0.10000',
  `sun_regular_holiday` decimal(19,5) DEFAULT '0.10000',
  `sun_regular_holiday_ot` decimal(19,5) DEFAULT '0.10000',
  `spe_holiday` decimal(19,5) DEFAULT '0.10000',
  `spe_holiday_ot` decimal(19,5) DEFAULT '0.10000',
  `sun_spe_holiday` decimal(19,5) DEFAULT '0.10000',
  `sun_spe_holiday_ot` decimal(19,5) DEFAULT '0.10000',
  `pagibig1` decimal(19,5) DEFAULT '0.10000',
  `pagibig2` decimal(19,5) DEFAULT '0.10000',
  `night_shift` decimal(19,5) DEFAULT '0.10000',
  `sun_night_shift` decimal(19,5) DEFAULT '0.10000',
  `night_shift_reg_holiday` decimal(19,5) DEFAULT '0.10000',
  `sun_night_shift_reg_holiday` decimal(19,5) DEFAULT '0.10000',
  `night_shift_spe_holiday` decimal(19,5) DEFAULT '0.10000',
  `sun_night_shift_spe_holiday` decimal(19,5) DEFAULT '0.10000',
  `is_deleted` tinyint(1) DEFAULT '0',
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `date_modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `date_deleted` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_by` int(11) NOT NULL
) ENGINE=InnoDB AVG_ROW_LENGTH=16384 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `reffactorfile`
--

INSERT INTO `reffactorfile` (`factor_id`, `regular_ot`, `sunday`, `day_off`, `sunday_ot`, `regular_holiday`, `regular_holiday_ot`, `sun_regular_holiday`, `sun_regular_holiday_ot`, `spe_holiday`, `spe_holiday_ot`, `sun_spe_holiday`, `sun_spe_holiday_ot`, `pagibig1`, `pagibig2`, `night_shift`, `sun_night_shift`, `night_shift_reg_holiday`, `sun_night_shift_reg_holiday`, `night_shift_spe_holiday`, `sun_night_shift_spe_holiday`, `is_deleted`, `created_by`, `modified_by`, `date_created`, `date_modified`, `date_deleted`, `deleted_by`) VALUES
(1, '1.25000', '1.30000', '1.25000', '1.69000', '2.00000', '2.30000', '2.60000', '2.90000', '1.30000', '1.69000', '1.50000', '1.69000', '100.00000', '0.02000', '0.10000', '0.10000', '0.10000', '0.10000', '0.10000', '0.10000', 0, 0, 1, '0000-00-00 00:00:00', '2018-05-23 11:16:03', '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `refgroup`
--

CREATE TABLE `refgroup` (
  `group_id` int(11) NOT NULL,
  `group_desc` varchar(65) DEFAULT '',
  `created_by` int(11) NOT NULL,
  `date_created` datetime NOT NULL,
  `modified_by` int(11) NOT NULL,
  `date_modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_by` int(11) NOT NULL,
  `date_deleted` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `is_deleted` tinyint(1) DEFAULT '0',
  `group_desc2` varchar(20) DEFAULT NULL
) ENGINE=InnoDB AVG_ROW_LENGTH=3276 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `refotherearnings`
--

CREATE TABLE `refotherearnings` (
  `earnings_id` int(11) NOT NULL,
  `earnings_desc` varchar(65) DEFAULT NULL,
  `earnings_type_id` int(11) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(11) NOT NULL,
  `date_modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_by` int(11) NOT NULL,
  `date_deleted` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `is_deleted` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB AVG_ROW_LENGTH=4096 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `refotherearnings`
--

INSERT INTO `refotherearnings` (`earnings_id`, `earnings_desc`, `earnings_type_id`, `created_by`, `date_created`, `modified_by`, `date_modified`, `deleted_by`, `date_deleted`, `is_deleted`) VALUES
(1, 'Allowance', 1, 3, '2018-02-12 17:17:43', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(2, 'Adjustment', 3, 3, '2018-02-12 17:17:43', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `refotherearningstype`
--

CREATE TABLE `refotherearningstype` (
  `earnings_type_id` int(11) NOT NULL,
  `earnings_type_desc` varchar(65) DEFAULT '',
  `created_by` int(11) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(11) NOT NULL,
  `modified_datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_by` int(11) NOT NULL,
  `date_deleted` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `is_deleted` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB AVG_ROW_LENGTH=4096 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `refotherearningstype`
--

INSERT INTO `refotherearningstype` (`earnings_type_id`, `earnings_type_desc`, `created_by`, `date_created`, `modified_by`, `modified_datetime`, `deleted_by`, `date_deleted`, `is_deleted`) VALUES
(1, 'Subsidiary', 0, '2017-01-27 14:56:46', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(2, 'Benefits(Other Income/Earnings)', 0, '2017-01-27 14:56:40', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(3, 'Adjustment', 3, '2018-02-12 17:16:54', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `refpayperiod`
--

CREATE TABLE `refpayperiod` (
  `pay_period_id` int(11) NOT NULL,
  `pay_period_start` date DEFAULT NULL,
  `pay_period_end` date DEFAULT NULL,
  `pay_period_sequence` int(11) DEFAULT NULL,
  `month_id` int(11) DEFAULT '0',
  `frequency` varchar(45) DEFAULT NULL,
  `pay_period_year` int(11) DEFAULT '0',
  `created_by` int(11) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(11) NOT NULL,
  `date_modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_by` int(11) NOT NULL,
  `date_deleted` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `is_deleted` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB AVG_ROW_LENGTH=3276 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `refpayperiod`
--

INSERT INTO `refpayperiod` (`pay_period_id`, `pay_period_start`, `pay_period_end`, `pay_period_sequence`, `month_id`, `frequency`, `pay_period_year`, `created_by`, `date_created`, `modified_by`, `date_modified`, `deleted_by`, `date_deleted`, `is_deleted`) VALUES
(1, '2018-06-01', '2018-06-15', 6, 6, 'f1', 0, 1, '2018-06-04 15:21:15', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `refsss`
--

CREATE TABLE `refsss` (
  `sss_id` int(11) NOT NULL,
  `salary_range_from` decimal(19,5) DEFAULT '0.00000',
  `salary_range_to` decimal(19,5) DEFAULT '0.00000',
  `monthly_salary_credit` decimal(19,5) DEFAULT '0.00000',
  `employee_cont` decimal(19,5) DEFAULT '0.00000',
  `employer_cont` decimal(19,5) DEFAULT '0.00000',
  `ec_cont` decimal(19,5) DEFAULT '0.00000',
  `created_by` int(11) DEFAULT NULL,
  `created_datetime` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` int(11) DEFAULT NULL,
  `modified_datetime` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_by` int(11) DEFAULT NULL,
  `deleted_datetime` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `is_deleted` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB AVG_ROW_LENGTH=264 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `refsss`
--

INSERT INTO `refsss` (`sss_id`, `salary_range_from`, `salary_range_to`, `monthly_salary_credit`, `employee_cont`, `employer_cont`, `ec_cont`, `created_by`, `created_datetime`, `modified_by`, `modified_datetime`, `deleted_by`, `deleted_datetime`, `is_deleted`) VALUES
(1, '1000.00000', '1249.99000', '1000.00000', '36.30000', '73.70000', '10.00000', 0, '2016-04-05 02:14:24', 0, '2016-04-27 16:38:00', NULL, '2017-01-26 10:53:53', 0),
(2, '1250.00000', '1749.99000', '1500.00000', '54.50000', '110.50000', '10.00000', 0, '2016-04-05 02:16:26', NULL, '2017-01-26 10:53:53', NULL, '2017-01-26 10:53:53', 0),
(3, '1750.00000', '2499.99000', '2000.00000', '72.70000', '147.30000', '10.00000', 0, '2016-04-05 02:44:58', 0, '2016-04-27 16:37:03', NULL, '2017-01-26 10:53:53', 0),
(4, '2250.00000', '2749.99000', '2500.00000', '90.80000', '184.20000', '10.00000', 0, '2016-04-05 04:22:29', NULL, '2017-01-26 10:53:53', 0, '2016-04-04 16:22:32', 0),
(5, '2750.00000', '3249.99000', '3000.00000', '109.00000', '221.00000', '10.00000', NULL, '2016-04-28 04:41:58', NULL, '2017-01-26 10:53:53', NULL, '2017-01-26 10:53:53', 0),
(6, '3250.00000', '3749.99000', '3500.00000', '127.20000', '257.80000', '10.00000', NULL, '2016-04-28 04:41:58', NULL, '2017-01-26 10:53:53', NULL, '2017-01-26 10:53:53', 0),
(7, '3750.00000', '4249.99000', '4000.00000', '145.30000', '294.70000', '10.00000', NULL, '2016-04-28 04:44:27', NULL, '2017-01-26 10:53:53', NULL, '2017-01-26 10:53:53', 0),
(8, '4250.00000', '4749.99000', '4500.00000', '163.50000', '331.50000', '10.00000', NULL, '2016-04-28 04:44:27', NULL, '2017-01-26 10:53:53', NULL, '2017-01-26 10:53:53', 0),
(9, '4750.00000', '5249.99000', '5000.00000', '181.70000', '368.30000', '10.00000', NULL, '2016-04-28 04:44:27', NULL, '2017-01-26 10:53:53', NULL, '2017-01-26 10:53:53', 0),
(10, '5250.00000', '5749.99000', '5500.00000', '199.80000', '405.20000', '10.00000', NULL, '2016-04-28 04:45:38', NULL, '2017-01-26 10:53:53', NULL, '2017-01-26 10:53:53', 0),
(11, '5750.00000', '6249.99000', '6000.00000', '218.00000', '442.00000', '10.00000', NULL, '2016-04-28 04:45:38', NULL, '2017-01-26 10:53:53', NULL, '2017-01-26 10:53:53', 0),
(12, '6250.00000', '6749.99000', '6500.00000', '236.20000', '478.80000', '10.00000', NULL, '2016-04-28 05:56:53', NULL, '2017-01-26 10:53:53', NULL, '2017-01-26 10:53:53', 0),
(13, '6750.00000', '7249.99000', '7000.00000', '254.30000', '515.70000', '10.00000', NULL, '2016-04-28 05:56:53', NULL, '2017-01-26 10:53:53', NULL, '2017-01-26 10:53:53', 0),
(14, '7250.00000', '7749.99000', '7500.00000', '272.50000', '552.50000', '10.00000', NULL, '2016-04-28 05:56:53', NULL, '2017-01-26 10:53:53', NULL, '2017-01-26 10:53:53', 0),
(15, '7750.00000', '8249.99000', '8000.00000', '290.70000', '589.30000', '10.00000', NULL, '2016-04-28 05:56:53', NULL, '2017-01-26 10:53:53', NULL, '2017-01-26 10:53:53', 0),
(16, '8250.00000', '8749.99000', '8500.00000', '308.80000', '626.20000', '10.00000', NULL, '2016-04-28 05:56:53', NULL, '2017-01-26 10:53:53', NULL, '2017-01-26 10:53:53', 0),
(17, '8750.00000', '9249.99000', '9000.00000', '327.00000', '663.90000', '10.00000', NULL, '2016-04-28 05:56:53', NULL, '2017-01-26 10:53:53', NULL, '2017-01-26 10:53:53', 0),
(18, '9250.00000', '9749.99000', '9500.00000', '345.20000', '699.80000', '10.00000', NULL, '2016-04-28 05:56:53', NULL, '2017-01-26 10:53:53', NULL, '2017-01-26 10:53:53', 0),
(19, '9750.00000', '10249.99000', '10000.00000', '363.30000', '736.70000', '10.00000', NULL, '2016-04-28 05:56:53', NULL, '2017-01-26 10:53:53', NULL, '2017-01-26 10:53:53', 0),
(20, '10250.00000', '10749.99000', '10500.00000', '381.50000', '773.50000', '10.00000', NULL, '2016-04-28 05:56:53', NULL, '2017-01-26 10:53:53', NULL, '2017-01-26 10:53:53', 0),
(21, '10750.00000', '11249.99000', '11000.00000', '399.70000', '810.30000', '10.00000', NULL, '2016-04-28 05:56:53', NULL, '2017-01-26 10:53:53', NULL, '2017-01-26 10:53:53', 0),
(22, '11250.00000', '11749.99000', '11500.00000', '417.80000', '847.20000', '10.00000', NULL, '2016-04-28 05:56:53', NULL, '2017-01-26 10:53:53', NULL, '2017-01-26 10:53:53', 0),
(23, '11750.00000', '12449.99000', '12000.00000', '436.00000', '884.00000', '10.00000', NULL, '2016-04-28 05:56:53', NULL, '2017-01-26 10:53:53', NULL, '2017-01-26 10:53:53', 0),
(24, '12250.00000', '12749.99000', '12500.00000', '454.20000', '920.80000', '10.00000', NULL, '2016-04-28 05:56:53', NULL, '2017-01-26 10:53:53', NULL, '2017-01-26 10:53:53', 0),
(25, '12750.00000', '13249.99000', '13000.00000', '472.30000', '957.70000', '10.00000', NULL, '2016-04-28 05:56:53', NULL, '2017-01-26 10:53:53', NULL, '2017-01-26 10:53:53', 0),
(26, '13250.00000', '13749.99000', '13500.00000', '490.50000', '994.50000', '10.00000', NULL, '2016-04-28 05:56:53', NULL, '2017-01-26 10:53:53', NULL, '2017-01-26 10:53:53', 0),
(27, '13750.00000', '14249.99000', '14000.00000', '508.70000', '1031.30000', '10.00000', NULL, '2016-04-28 05:56:53', NULL, '2017-01-26 10:53:53', NULL, '2017-01-26 10:53:53', 0),
(28, '14250.00000', '14749.99000', '14500.00000', '526.80000', '1068.20000', '10.00000', NULL, '2016-04-28 05:56:53', NULL, '2017-01-26 10:53:53', NULL, '2017-01-26 10:53:53', 0),
(29, '14750.00000', '15249.99000', '15000.00000', '545.00000', '1105.00000', '30.00000', NULL, '2016-04-28 05:56:53', NULL, '2017-01-26 10:53:53', NULL, '2017-01-26 10:53:53', 0),
(30, '15250.00000', '15749.99000', '15500.00000', '563.20000', '1141.80000', '30.00000', NULL, '2016-04-28 05:56:53', NULL, '2017-01-26 10:53:53', NULL, '2017-01-26 10:53:53', 0),
(31, '15750.00000', '100000.00000', '16000.00000', '581.30000', '1178.70000', '30.00000', NULL, '2016-04-28 05:56:53', NULL, '2017-01-26 10:53:53', NULL, '2017-01-26 10:53:53', 0);

-- --------------------------------------------------------

--
-- Table structure for table `reftaxcode`
--

CREATE TABLE `reftaxcode` (
  `tax_id` int(11) NOT NULL,
  `ref_payment_type_id` int(11) DEFAULT '0',
  `tax_code` varchar(65) DEFAULT '',
  `tax_desc` varchar(65) DEFAULT '',
  `col1` decimal(19,2) DEFAULT '0.00',
  `col2` decimal(19,2) DEFAULT '0.00',
  `col3` decimal(19,2) DEFAULT '0.00',
  `col4` decimal(19,2) DEFAULT '0.00',
  `col5` decimal(19,2) DEFAULT '0.00',
  `col6` decimal(19,2) DEFAULT '0.00',
  `col7` decimal(19,2) DEFAULT '0.00',
  `col8` decimal(19,2) DEFAULT '0.00',
  `is_deleted` binary(1) DEFAULT '0'
) ENGINE=InnoDB AVG_ROW_LENGTH=910 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `reftaxcode`
--

INSERT INTO `reftaxcode` (`tax_id`, `ref_payment_type_id`, `tax_code`, `tax_desc`, `col1`, `col2`, `col3`, `col4`, `col5`, `col6`, `col7`, `col8`, `is_deleted`) VALUES
(1, 1, 'Z', '', '1.00', '0.00', '417.00', '1250.00', '2917.00', '5833.00', '10417.00', '20833.00', 0x30),
(2, 1, 'S/ME', '', '1.00', '2083.00', '2500.00', '3333.00', '5000.00', '7917.00', '12500.00', '22917.00', 0x30),
(3, 1, 'ME1/S1', '', '1.00', '3125.00', '3542.00', '4375.00', '6042.00', '8958.00', '13542.00', '23958.00', 0x30),
(4, 1, 'ME2/S2', '', '1.00', '4167.00', '4583.00', '5417.00', '7083.00', '10000.00', '14583.00', '25000.00', 0x30),
(5, 1, 'ME3/S3', '', '1.00', '5208.00', '5625.00', '6458.00', '8125.00', '11042.00', '15625.00', '26042.00', 0x30),
(6, 1, 'ME4/S4', '', '1.00', '6250.00', '6667.00', '7500.00', '9167.00', '12083.00', '16667.00', '27083.00', 0x30),
(7, 2, 'Z', '', '1.00', '0.00', '833.00', '2500.00', '5833.00', '11667.00', '20833.00', '41667.00', 0x30),
(8, 2, 'S/ME', '', '1.00', '4167.00', '5000.00', '6667.00', '10000.00', '15833.00', '25000.00', '45833.00', 0x30),
(9, 2, 'ME1/S1', '', '1.00', '6250.00', '7083.00', '8750.00', '12083.00', '17917.00', '27083.00', '47917.00', 0x30),
(10, 2, 'ME2/S2', '', '1.00', '8333.00', '9167.00', '10833.00', '14167.00', '20000.00', '29167.00', '50000.00', 0x30),
(11, 2, 'ME3/S3', '', '1.00', '10417.00', '11250.00', '12917.00', '16250.00', '22083.00', '31250.00', '52083.00', 0x30),
(12, 2, 'ME4/S4', '', '1.00', '12500.00', '13333.00', '15000.00', '18333.00', '24167.00', '33333.00', '54167.00', 0x30),
(13, 3, 'Z', '', '1.00', '0.00', '33.00', '99.00', '231.00', '462.00', '825.00', '1650.00', 0x30),
(14, 3, 'S/ME', '', '1.00', '165.00', '198.00', '264.00', '396.00', '627.00', '990.00', '1815.00', 0x30),
(15, 3, 'ME1/S1', '', '1.00', '248.00', '281.00', '347.00', '479.00', '710.00', '1073.00', '1898.00', 0x30),
(16, 3, 'ME2/S2', '', '1.00', '330.00', '363.00', '429.00', '561.00', '792.00', '1155.00', '1980.00', 0x30),
(17, 3, 'ME3/S3', '', '1.00', '413.00', '446.00', '512.00', '644.00', '875.00', '1238.00', '2063.00', 0x30),
(18, 3, 'ME4/S4', '', '1.00', '495.00', '528.00', '594.00', '726.00', '957.00', '1320.00', '2145.00', 0x30),
(19, 4, 'Z', '', '1.00', '0.00', '192.00', '577.00', '1346.00', '2692.00', '4808.00', '9615.00', 0x30),
(20, 4, 'S/ME', '', '1.00', '962.00', '1154.00', '1538.00', '2308.00', '3654.00', '5769.00', '10577.00', 0x30),
(21, 4, 'ME1/S1', '', '1.00', '1442.00', '1635.00', '2019.00', '2788.00', '4135.00', '6250.00', '11058.00', 0x30),
(22, 4, 'ME2/S2', '', '1.00', '1923.00', '2115.00', '2500.00', '3269.00', '4615.00', '6731.00', '11538.00', 0x30),
(23, 4, 'ME3/S3', '', '1.00', '2404.00', '2596.00', '2981.00', '3750.00', '5096.00', '7212.00', '12019.00', 0x30),
(24, 4, 'ME4/S4', '', '1.00', '2885.00', '3077.00', '3462.00', '4231.00', '5577.00', '7692.00', '12500.00', 0x30);

-- --------------------------------------------------------

--
-- Table structure for table `ref_action_taken`
--

CREATE TABLE `ref_action_taken` (
  `ref_action_taken_id` int(11) UNSIGNED NOT NULL,
  `action_taken` varchar(50) NOT NULL,
  `description` varchar(500) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `date_modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `is_deleted` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `date_deleted` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `ref_branch`
--

CREATE TABLE `ref_branch` (
  `ref_branch_id` int(11) UNSIGNED NOT NULL,
  `branch` varchar(50) NOT NULL,
  `description` varchar(500) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) UNSIGNED DEFAULT NULL,
  `date_created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `date_modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `is_deleted` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `date_deleted` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_by` int(11) NOT NULL
) ENGINE=InnoDB AVG_ROW_LENGTH=8192 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `ref_certificate`
--

CREATE TABLE `ref_certificate` (
  `ref_certificate_id` int(11) UNSIGNED NOT NULL,
  `certificate` varchar(50) NOT NULL,
  `description` varchar(500) DEFAULT NULL,
  `created_by` int(11) UNSIGNED NOT NULL,
  `modified_by` int(11) UNSIGNED DEFAULT NULL,
  `date_created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `date_modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `is_deleted` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `deleted_by` int(11) NOT NULL,
  `date_deleted` datetime DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `ref_clearance_reason`
--

CREATE TABLE `ref_clearance_reason` (
  `clearance_reason_id` int(11) NOT NULL,
  `clearance_description` varchar(255) NOT NULL,
  `date_created` datetime NOT NULL,
  `created_by` int(11) NOT NULL DEFAULT '0',
  `date_deleted` datetime NOT NULL,
  `deleted_by` int(11) NOT NULL DEFAULT '0',
  `date_modified` datetime NOT NULL,
  `modified_by` int(11) NOT NULL DEFAULT '0',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ref_compensation_type`
--

CREATE TABLE `ref_compensation_type` (
  `ref_compensation_type_id` int(11) UNSIGNED NOT NULL,
  `compensation_type` varchar(50) NOT NULL,
  `description` varchar(500) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `date_modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `is_deleted` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `deleted_by` int(11) NOT NULL,
  `date_deleted` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `ref_course_degree`
--

CREATE TABLE `ref_course_degree` (
  `ref_course_degree_id` int(11) UNSIGNED NOT NULL,
  `course_degree` varchar(45) NOT NULL,
  `description` varchar(500) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `date_modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `is_deleted` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `date_deleted` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_by` int(11) NOT NULL
) ENGINE=InnoDB AVG_ROW_LENGTH=1820 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `ref_day_type`
--

CREATE TABLE `ref_day_type` (
  `ref_day_type_id` int(11) UNSIGNED NOT NULL,
  `daytype` varchar(50) NOT NULL,
  `description` varchar(500) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) UNSIGNED DEFAULT NULL,
  `date_created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `date_modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `is_deleted` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `date_deleted` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_by` int(11) NOT NULL
) ENGINE=InnoDB AVG_ROW_LENGTH=8192 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `ref_day_type`
--

INSERT INTO `ref_day_type` (`ref_day_type_id`, `daytype`, `description`, `created_by`, `modified_by`, `date_created`, `date_modified`, `is_deleted`, `date_deleted`, `deleted_by`) VALUES
(1, 'Regular Day', '', 0, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(2, 'Regular Sunday', NULL, 0, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(3, 'Regular Holiday', NULL, 0, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(4, 'Special Holiday', NULL, 0, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(5, 'Sunday Regular Holiday', NULL, 0, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(6, 'Sunday Special Holiday', NULL, 0, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `ref_department`
--

CREATE TABLE `ref_department` (
  `ref_department_id` int(11) UNSIGNED NOT NULL,
  `department` varchar(50) NOT NULL,
  `description` varchar(500) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `date_modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `is_deleted` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `date_deleted` datetime DEFAULT '0000-00-00 00:00:00',
  `deleted_by` int(11) NOT NULL
) ENGINE=InnoDB AVG_ROW_LENGTH=8192 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `ref_disciplinary_action_policy`
--

CREATE TABLE `ref_disciplinary_action_policy` (
  `ref_disciplinary_action_policy_id` int(11) UNSIGNED NOT NULL,
  `disciplinary_action_policy` varchar(50) NOT NULL,
  `description` varchar(500) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `date_modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `is_deleted` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `date_deleted` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `ref_duration`
--

CREATE TABLE `ref_duration` (
  `duration_id` int(11) NOT NULL,
  `duration_desc` varchar(255) NOT NULL,
  `no_of_duration` bigint(25) NOT NULL,
  `duration_type` int(11) NOT NULL,
  `date_created` datetime NOT NULL,
  `date_modified` datetime NOT NULL,
  `date_deleted` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `deleted_by` int(11) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ref_duration`
--

INSERT INTO `ref_duration` (`duration_id`, `duration_desc`, `no_of_duration`, `duration_type`, `date_created`, `date_modified`, `date_deleted`, `created_by`, `modified_by`, `deleted_by`, `is_deleted`) VALUES
(1, '1 Year', 1, 4, '2018-01-12 10:07:24', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `ref_employment_status`
--

CREATE TABLE `ref_employment_status` (
  `ref_employment_status_id` int(11) UNSIGNED NOT NULL,
  `employment_status` varchar(50) NOT NULL,
  `description` varchar(500) DEFAULT NULL,
  `created_by_user_id` int(11) UNSIGNED NOT NULL,
  `modified_by_user_id` int(11) UNSIGNED DEFAULT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `is_deleted` tinyint(1) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `ref_employment_type`
--

CREATE TABLE `ref_employment_type` (
  `ref_employment_type_id` int(10) UNSIGNED NOT NULL,
  `employment_type` varchar(50) NOT NULL,
  `description` varchar(500) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `date_modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `date_deleted` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_by` int(11) NOT NULL
) ENGINE=InnoDB AVG_ROW_LENGTH=3276 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `ref_employment_type`
--

INSERT INTO `ref_employment_type` (`ref_employment_type_id`, `employment_type`, `description`, `created_by`, `modified_by`, `date_created`, `date_modified`, `is_deleted`, `date_deleted`, `deleted_by`) VALUES
(1, 'Probationary', NULL, 1, 0, '2015-06-10 08:27:11', '2017-01-26 18:53:54', 0, '0000-00-00 00:00:00', 0),
(2, 'Regular', NULL, 1, 0, '2015-06-10 08:27:11', '2017-01-26 18:53:54', 0, '0000-00-00 00:00:00', 0),
(3, 'Trainee', NULL, 1, 0, '2015-06-10 08:27:11', '2017-01-26 18:53:54', 0, '0000-00-00 00:00:00', 0),
(4, 'Casual', NULL, 1, 0, '2015-06-10 08:27:11', '2017-01-26 18:53:54', 0, '0000-00-00 00:00:00', 0),
(5, 'Consultant/Contractual', NULL, 1, 0, '2015-06-10 08:27:11', '2017-01-26 18:53:54', 0, '0000-00-00 00:00:00', 0),
(6, 'RESIGNED', NULL, 0, 0, '2017-03-14 07:35:41', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `ref_leave_type`
--

CREATE TABLE `ref_leave_type` (
  `ref_leave_type_id` int(11) UNSIGNED NOT NULL,
  `leave_type` varchar(100) NOT NULL,
  `leave_type_short_name` varchar(100) DEFAULT NULL,
  `is_forwardable` tinyint(2) NOT NULL DEFAULT '1',
  `is_payable` tinyint(2) NOT NULL DEFAULT '1',
  `total_grant` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `description` varchar(500) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `date_modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `deleted_by` int(11) NOT NULL,
  `date_deleted` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AVG_ROW_LENGTH=5461 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `ref_month`
--

CREATE TABLE `ref_month` (
  `ref_month_id` int(11) NOT NULL,
  `month_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ref_month`
--

INSERT INTO `ref_month` (`ref_month_id`, `month_name`) VALUES
(1, 'January'),
(2, 'February'),
(3, 'March'),
(4, 'April'),
(5, 'May'),
(6, 'June'),
(7, 'July'),
(8, 'August'),
(9, 'September'),
(10, 'October'),
(11, 'November'),
(12, 'December');

-- --------------------------------------------------------

--
-- Table structure for table `ref_payment_type`
--

CREATE TABLE `ref_payment_type` (
  `ref_payment_type_id` int(11) UNSIGNED NOT NULL,
  `payment_type` varchar(50) NOT NULL,
  `description` varchar(500) DEFAULT NULL,
  `col1_percent` decimal(19,2) DEFAULT '0.00',
  `col1_amount` decimal(19,2) DEFAULT '0.00',
  `col1_cl` decimal(20,2) DEFAULT '0.00',
  `col2_percent` decimal(19,2) DEFAULT '0.00',
  `col2_amount` decimal(19,2) DEFAULT '0.00',
  `col2_cl` decimal(20,2) DEFAULT '0.00',
  `col3_percent` decimal(19,2) DEFAULT '0.00',
  `col3_amount` decimal(19,2) DEFAULT '0.00',
  `col3_cl` decimal(20,2) DEFAULT '0.00',
  `col4_percent` decimal(19,2) DEFAULT '0.00',
  `col4_amount` decimal(19,2) DEFAULT '0.00',
  `col4_cl` decimal(20,2) DEFAULT '0.00',
  `col5_percent` decimal(19,2) DEFAULT '0.00',
  `col5_amount` decimal(19,2) DEFAULT '0.00',
  `col5_cl` decimal(20,2) DEFAULT '0.00',
  `col6_percent` decimal(19,2) DEFAULT '0.00',
  `col6_amount` decimal(19,2) DEFAULT '0.00',
  `col6_cl` decimal(20,2) DEFAULT '0.00',
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `date_modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `is_deleted` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `pay_type_factor` decimal(11,2) NOT NULL,
  `date_deleted` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_by` int(11) NOT NULL
) ENGINE=InnoDB AVG_ROW_LENGTH=5461 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `ref_payment_type`
--

INSERT INTO `ref_payment_type` (`ref_payment_type_id`, `payment_type`, `description`, `col1_percent`, `col1_amount`, `col1_cl`, `col2_percent`, `col2_amount`, `col2_cl`, `col3_percent`, `col3_amount`, `col3_cl`, `col4_percent`, `col4_amount`, `col4_cl`, `col5_percent`, `col5_amount`, `col5_cl`, `col6_percent`, `col6_amount`, `col6_cl`, `created_by`, `modified_by`, `date_created`, `date_modified`, `is_deleted`, `pay_type_factor`, `date_deleted`, `deleted_by`) VALUES
(1, 'Semi Monthly', 'Semi Monthly', '0.00', '0.00', '10417.00', '0.20', '0.00', '10417.00', '0.25', '1250.00', '16667.00', '0.30', '5416.67', '33333.00', '0.32', '20416.67', '83333.00', '0.35', '100416.67', '333333.00', 0, 1, '0000-00-00 00:00:00', '2018-05-29 17:05:16', 0, '13.00', '0000-00-00 00:00:00', 0),
(2, 'Monthly', 'Monthly', '0.00', '0.00', '20833.00', '0.20', '0.00', '20833.00', '0.25', '2500.00', '33333.00', '0.30', '10833.33', '66667.00', '0.32', '40833.33', '166667.00', '0.35', '200833.33', '666667.00', 0, 1, '0000-00-00 00:00:00', '2018-05-29 17:04:43', 0, '26.00', '0000-00-00 00:00:00', 0),
(3, 'Daily', 'Daily', '0.00', '0.00', '685.00', '0.20', '0.00', '685.00', '0.25', '82.19', '1096.00', '0.30', '356.16', '2192.00', '0.32', '1342.47', '5479.00', '0.35', '6602.74', '21918.00', 0, 1, '0000-00-00 00:00:00', '2018-05-29 17:04:45', 0, '1.00', '0000-00-00 00:00:00', 0),
(4, 'Weekly', 'Weekly', '0.00', '0.00', '4808.00', '0.20', '0.00', '4808.00', '0.25', '576.92', '7692.00', '0.30', '2500.00', '15385.00', '0.32', '9423.08', '38462.00', '0.35', '46346.15', '153846.00', 0, 1, '0000-00-00 00:00:00', '2018-05-29 17:04:47', 0, '1.00', '0000-00-00 00:00:00', 0),
(5, 'Semi Monthly (No Sat.)', 'Semi Monthly (No Sat.)', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 1, 1, '2017-07-17 14:09:09', '2018-05-29 17:04:55', 0, '10.09', '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `ref_philhealth_contribution`
--

CREATE TABLE `ref_philhealth_contribution` (
  `ref_philhealth_contribution_id` int(11) NOT NULL,
  `salary_range_from` decimal(19,2) NOT NULL,
  `salary_range_to` decimal(19,2) NOT NULL,
  `employee` varchar(255) NOT NULL,
  `employer` varchar(255) NOT NULL,
  `total` varchar(255) NOT NULL,
  `percentage` decimal(20,5) NOT NULL DEFAULT '0.00000',
  `is_deleted` tinyint(1) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `date_modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `date_deleted` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `deleted_by` int(11) NOT NULL
) ENGINE=InnoDB AVG_ROW_LENGTH=585 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `ref_philhealth_contribution`
--

INSERT INTO `ref_philhealth_contribution` (`ref_philhealth_contribution_id`, `salary_range_from`, `salary_range_to`, `employee`, `employer`, `total`, `percentage`, `is_deleted`, `status`, `date_created`, `date_modified`, `date_deleted`, `created_by`, `modified_by`, `deleted_by`) VALUES
(1, '0.00', '10000.00', '137.5', '137.5', '275', '0.02750', 0, 0, '0000-00-00 00:00:00', '2018-05-04 14:11:42', '0000-00-00 00:00:00', 0, 1, 0),
(2, '10001.00', '39999.99', '137.51 to 549.99', '137.51 to 549.99', '275.02 to 1,099.99', '0.02750', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(3, '40000.00', '999999.99', '550.00', '550.00', '1,100.00', '0.02750', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `ref_position`
--

CREATE TABLE `ref_position` (
  `ref_position_id` int(11) UNSIGNED NOT NULL,
  `position` varchar(50) DEFAULT NULL,
  `description` varchar(500) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `date_modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `is_deleted` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `deleted_by` int(11) NOT NULL,
  `date_deleted` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AVG_ROW_LENGTH=712 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `ref_position`
--

INSERT INTO `ref_position` (`ref_position_id`, `position`, `description`, `created_by`, `modified_by`, `date_created`, `date_modified`, `is_deleted`, `deleted_by`, `date_deleted`) VALUES
(1, 'Bartender', '', 1, 1, '2018-01-08 15:20:46', '2018-04-03 15:17:00', 0, 0, '0000-00-00 00:00:00'),
(2, 'Waiter', NULL, 1, 0, '2018-01-08 15:20:58', '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00'),
(3, 'Waitress', NULL, 1, 0, '2018-01-08 15:21:44', '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00'),
(4, 'F & B Supervisor', NULL, 1, 0, '2018-01-08 15:22:10', '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00'),
(5, 'Commis', NULL, 1, 0, '2018-01-08 15:22:25', '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00'),
(6, 'Utility', NULL, 1, 0, '2018-01-08 15:22:40', '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00'),
(7, 'Chef De Partie', NULL, 1, 0, '2018-01-08 15:22:58', '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00'),
(8, 'Security', NULL, 1, 0, '2018-01-08 15:23:19', '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00'),
(9, 'Purchasing Manager', NULL, 1, 0, '2018-01-08 15:23:45', '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00'),
(10, 'Steward', NULL, 1, 0, '2018-01-08 15:24:01', '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00'),
(11, 'Butcher', NULL, 1, 0, '2018-01-08 15:24:26', '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00'),
(12, 'Purchasing Assistant', NULL, 1, 0, '2018-01-08 15:24:47', '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00'),
(13, 'Marketing Executive', NULL, 1, 0, '2018-01-08 15:25:17', '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00'),
(14, 'Accounting Assistant', '', 1, 1, '2018-01-08 15:25:45', '2018-05-04 11:05:52', 0, 0, '0000-00-00 00:00:00'),
(15, 'Accounting Manager', NULL, 1, 0, '2018-01-08 15:25:57', '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00'),
(16, 'Graphic Artist', NULL, 1, 0, '2018-01-08 15:26:20', '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00'),
(17, 'Head Chef', NULL, 1, 0, '2018-01-08 15:26:32', '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00'),
(18, 'HR Manager', NULL, 1, 0, '2018-01-08 15:26:54', '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00'),
(19, 'HR Assistant', NULL, 1, 0, '2018-01-08 15:27:14', '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00'),
(20, 'Sound Tech', NULL, 1, 0, '2018-01-08 15:27:34', '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00'),
(21, 'Pastry Chef', NULL, 3, 0, '2018-01-19 14:08:03', '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00'),
(22, 'Foreign Manager', NULL, 3, 0, '2018-01-26 16:49:07', '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00'),
(23, 'General Manager', NULL, 3, 0, '2018-02-08 16:24:04', '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00'),
(24, 'Manager', NULL, 1, 0, '2018-05-22 16:40:18', '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `ref_relationship`
--

CREATE TABLE `ref_relationship` (
  `ref_relationship_id` int(11) UNSIGNED NOT NULL,
  `relationship` varchar(100) NOT NULL,
  `description` varchar(500) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `date_modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `deleted_by` int(11) NOT NULL,
  `date_deleted` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AVG_ROW_LENGTH=1820 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `ref_religion`
--

CREATE TABLE `ref_religion` (
  `ref_religion_id` int(11) UNSIGNED NOT NULL,
  `religion` varchar(50) NOT NULL,
  `description` varchar(500) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `date_modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `is_deleted` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `deleted_by` int(11) NOT NULL,
  `date_deleted` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AVG_ROW_LENGTH=2730 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `ref_religion`
--

INSERT INTO `ref_religion` (`ref_religion_id`, `religion`, `description`, `created_by`, `modified_by`, `date_created`, `date_modified`, `is_deleted`, `deleted_by`, `date_deleted`) VALUES
(1, 'Roman Catholic', 'Roman Catholic', 1, 1, '2018-01-08 13:06:19', '2018-01-09 14:27:33', 0, 0, '0000-00-00 00:00:00'),
(2, 'Baptist', 'Baptist', 1, 1, '2018-01-08 13:06:42', '2018-01-09 14:26:58', 0, 0, '0000-00-00 00:00:00'),
(3, 'Protestant', 'Protestant', 1, 1, '2018-01-09 14:25:29', '2018-01-09 14:27:29', 0, 0, '0000-00-00 00:00:00'),
(4, 'INC', 'INC', 1, 1, '2018-01-09 14:25:36', '2018-01-09 14:27:17', 0, 0, '0000-00-00 00:00:00'),
(5, 'Born-Again', 'Born-Again', 1, 1, '2018-01-09 14:25:47', '2018-01-09 14:27:03', 0, 0, '0000-00-00 00:00:00'),
(6, 'Jehovah''s Witness', 'Jehovah''s Witness', 1, 1, '2018-01-09 14:26:04', '2018-01-09 14:27:23', 0, 0, '0000-00-00 00:00:00'),
(7, 'Evangelic Christian', 'Evangelic Christian', 1, 1, '2018-01-09 14:26:13', '2018-01-09 14:27:13', 0, 0, '0000-00-00 00:00:00'),
(8, 'Christian', 'Christian', 1, 1, '2018-01-09 14:26:20', '2018-01-09 14:27:07', 0, 0, '0000-00-00 00:00:00'),
(9, 'Sabadista', 'Sabadista', 1, 1, '2018-01-09 14:26:27', '2018-01-09 14:27:37', 0, 0, '0000-00-00 00:00:00'),
(10, 'None', '', 1, 0, '2018-01-16 09:36:07', '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `ref_section`
--

CREATE TABLE `ref_section` (
  `ref_section_id` int(11) UNSIGNED NOT NULL,
  `section` varchar(50) NOT NULL,
  `description` varchar(500) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `date_modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `date_deleted` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_by` int(11) NOT NULL
) ENGINE=InnoDB AVG_ROW_LENGTH=1092 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `ref_sss_contribution`
--

CREATE TABLE `ref_sss_contribution` (
  `ref_sss_contribution_id` int(11) NOT NULL,
  `salary_range_from` decimal(19,2) NOT NULL,
  `salary_range_to` decimal(19,2) NOT NULL,
  `monthly_salary_credit` decimal(19,2) NOT NULL,
  `employee` decimal(19,2) NOT NULL,
  `employer` decimal(19,2) NOT NULL,
  `employer_contribution` decimal(19,2) NOT NULL,
  `sub_total` decimal(19,2) NOT NULL,
  `total` decimal(19,2) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `deleted_by` int(11) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `date_modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `date_deleted` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AVG_ROW_LENGTH=528 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `ref_sss_contribution`
--

INSERT INTO `ref_sss_contribution` (`ref_sss_contribution_id`, `salary_range_from`, `salary_range_to`, `monthly_salary_credit`, `employee`, `employer`, `employer_contribution`, `sub_total`, `total`, `is_deleted`, `status`, `created_by`, `modified_by`, `deleted_by`, `date_created`, `date_modified`, `date_deleted`) VALUES
(3, '1750.00', '2249.99', '2000.00', '72.70', '147.30', '10.00', '220.00', '230.00', 0, 0, 0, 1, 0, '0000-00-00 00:00:00', '2018-02-06 14:29:11', '0000-00-00 00:00:00'),
(4, '2250.00', '2749.99', '2500.00', '90.80', '184.20', '10.00', '275.00', '285.00', 0, 0, 0, 1, 0, '0000-00-00 00:00:00', '2018-02-06 14:29:31', '0000-00-00 00:00:00'),
(5, '2750.00', '3249.99', '3000.00', '109.00', '221.00', '10.00', '330.00', '340.00', 0, 0, 0, 1, 0, '0000-00-00 00:00:00', '2018-02-06 14:29:45', '0000-00-00 00:00:00'),
(6, '3250.00', '3749.99', '3500.00', '127.20', '257.80', '10.00', '385.00', '395.00', 0, 0, 0, 1, 0, '0000-00-00 00:00:00', '2018-02-06 14:35:24', '0000-00-00 00:00:00'),
(7, '3750.00', '4249.99', '4000.00', '145.30', '294.70', '10.00', '440.00', '450.00', 0, 0, 0, 1, 0, '0000-00-00 00:00:00', '2018-02-06 14:31:09', '0000-00-00 00:00:00'),
(8, '4250.00', '4749.99', '4500.00', '163.50', '331.50', '10.00', '495.00', '505.00', 0, 0, 0, 1, 0, '0000-00-00 00:00:00', '2018-02-06 14:31:22', '0000-00-00 00:00:00'),
(9, '4750.00', '5249.99', '5000.00', '181.70', '368.30', '10.00', '550.00', '560.00', 0, 0, 0, 1, 0, '0000-00-00 00:00:00', '2018-02-06 14:31:36', '0000-00-00 00:00:00'),
(10, '5250.00', '5749.99', '5500.00', '199.80', '405.20', '10.00', '605.00', '615.00', 0, 0, 0, 1, 0, '0000-00-00 00:00:00', '2018-02-06 14:31:48', '0000-00-00 00:00:00'),
(11, '5750.00', '6249.99', '6000.00', '218.00', '442.00', '10.00', '660.00', '670.00', 0, 0, 0, 1, 0, '0000-00-00 00:00:00', '2018-02-06 14:32:08', '0000-00-00 00:00:00'),
(12, '6250.00', '6749.99', '6500.00', '236.20', '478.80', '10.00', '715.00', '725.00', 0, 0, 0, 1, 0, '0000-00-00 00:00:00', '2018-02-06 14:32:24', '0000-00-00 00:00:00'),
(13, '6750.00', '7249.99', '7000.00', '254.30', '515.70', '10.00', '770.00', '780.00', 0, 0, 0, 1, 0, '0000-00-00 00:00:00', '2018-02-06 14:35:34', '0000-00-00 00:00:00'),
(14, '7250.00', '7749.99', '7500.00', '272.50', '552.50', '10.00', '825.00', '835.00', 0, 0, 0, 1, 0, '0000-00-00 00:00:00', '2018-02-06 14:35:38', '0000-00-00 00:00:00'),
(15, '7750.00', '8249.99', '8000.00', '290.70', '589.30', '10.00', '880.00', '890.00', 0, 0, 0, 1, 0, '0000-00-00 00:00:00', '2018-02-06 14:35:41', '0000-00-00 00:00:00'),
(16, '8250.00', '8749.99', '8500.00', '308.80', '626.20', '10.00', '935.00', '945.00', 0, 0, 0, 1, 0, '0000-00-00 00:00:00', '2018-02-06 14:35:44', '0000-00-00 00:00:00'),
(17, '8750.00', '9249.99', '9000.00', '327.00', '663.00', '10.00', '990.00', '1000.00', 0, 0, 0, 1, 0, '0000-00-00 00:00:00', '2018-02-06 14:35:46', '0000-00-00 00:00:00'),
(18, '9250.00', '9749.99', '9500.00', '345.20', '699.80', '10.00', '1045.00', '1055.00', 0, 0, 0, 1, 0, '0000-00-00 00:00:00', '2018-02-06 14:35:49', '0000-00-00 00:00:00'),
(19, '9750.00', '10249.99', '10000.00', '363.30', '736.70', '10.00', '1100.00', '1110.00', 0, 0, 0, 1, 0, '0000-00-00 00:00:00', '2018-02-06 14:35:51', '0000-00-00 00:00:00'),
(20, '10250.00', '10749.99', '10500.00', '381.50', '773.50', '10.00', '1155.00', '1165.00', 0, 0, 0, 1, 0, '0000-00-00 00:00:00', '2018-02-06 14:35:53', '0000-00-00 00:00:00'),
(21, '10750.00', '11249.99', '11000.00', '399.70', '810.30', '10.00', '1210.00', '1220.00', 0, 0, 0, 1, 0, '0000-00-00 00:00:00', '2018-02-06 14:35:55', '0000-00-00 00:00:00'),
(22, '11250.00', '11749.99', '11500.00', '417.80', '847.20', '10.00', '1265.00', '1275.00', 0, 0, 0, 1, 0, '0000-00-00 00:00:00', '2018-02-06 14:35:58', '0000-00-00 00:00:00'),
(23, '11750.00', '12249.99', '12000.00', '436.00', '884.00', '10.00', '1320.00', '1330.00', 0, 0, 0, 1, 0, '0000-00-00 00:00:00', '2018-02-06 14:36:00', '0000-00-00 00:00:00'),
(24, '12250.00', '12749.99', '12500.00', '454.20', '920.80', '10.00', '1375.00', '1385.00', 0, 0, 0, 1, 0, '0000-00-00 00:00:00', '2018-02-06 14:36:04', '0000-00-00 00:00:00'),
(25, '12750.00', '13249.99', '13000.00', '472.30', '957.70', '10.00', '1430.00', '1440.00', 0, 0, 0, 1, 0, '0000-00-00 00:00:00', '2018-02-06 14:36:08', '0000-00-00 00:00:00'),
(26, '13250.00', '13749.99', '13500.00', '490.50', '994.50', '10.00', '1485.00', '1495.00', 0, 0, 0, 1, 0, '0000-00-00 00:00:00', '2018-02-06 14:36:10', '0000-00-00 00:00:00'),
(27, '13750.00', '14249.99', '14000.00', '508.70', '1031.30', '10.00', '1540.00', '1550.00', 0, 0, 0, 1, 0, '0000-00-00 00:00:00', '2018-02-06 14:36:12', '0000-00-00 00:00:00'),
(28, '14250.00', '14749.99', '14500.00', '526.80', '1068.20', '10.00', '1595.00', '1605.00', 0, 0, 0, 1, 0, '0000-00-00 00:00:00', '2018-02-06 14:36:14', '0000-00-00 00:00:00'),
(29, '14750.00', '15249.99', '15000.00', '545.00', '1105.00', '30.00', '1650.00', '1680.00', 0, 0, 0, 1, 0, '0000-00-00 00:00:00', '2018-02-06 14:36:17', '0000-00-00 00:00:00'),
(30, '15250.00', '15749.99', '15500.00', '563.20', '1141.80', '30.00', '1705.00', '1735.00', 0, 0, 0, 1, 0, '0000-00-00 00:00:00', '2018-02-06 14:36:19', '0000-00-00 00:00:00'),
(31, '15750.00', '9999999.00', '16000.00', '581.30', '1178.70', '30.00', '1760.00', '1790.00', 0, 0, 0, 1, 0, '0000-00-00 00:00:00', '2018-02-06 14:36:21', '2017-03-29 10:08:45'),
(32, '222222.00', '22222.00', '22222.00', '2222.00', '22222.00', '2222.00', '24444.00', '26666.00', 1, 0, 1, 0, 1, '2017-12-05 09:46:23', '0000-00-00 00:00:00', '2017-12-06 14:17:07'),
(33, '1250.00', '1749.99', '1500.00', '54.50', '110.50', '10.00', '165.00', '175.00', 0, 0, 1, 1, 0, '2017-12-06 14:08:51', '2018-02-06 14:28:34', '0000-00-00 00:00:00'),
(34, '1000.00', '1249.99', '1000.00', '36.30', '73.70', '10.00', '110.00', '120.00', 0, 0, 1, 1, 0, '2017-12-06 14:10:58', '2018-05-04 11:08:10', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `ref_work_experience`
--

CREATE TABLE `ref_work_experience` (
  `ref_work_experience_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `company` varchar(255) NOT NULL,
  `job_title` varchar(255) NOT NULL,
  `job_description` varchar(255) NOT NULL,
  `from_date` date NOT NULL,
  `to_date` date NOT NULL,
  `date_created` date NOT NULL,
  `date_modified` date NOT NULL,
  `date_deleted` date NOT NULL,
  `created_by` int(11) NOT NULL DEFAULT '0',
  `modified_by` int(11) NOT NULL DEFAULT '0',
  `deleted_by` int(11) NOT NULL DEFAULT '0',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `reg_deduction_cycle`
--

CREATE TABLE `reg_deduction_cycle` (
  `reg_deduction_cycle_id` int(12) NOT NULL,
  `deduction_regular_id` int(12) NOT NULL DEFAULT '0',
  `pay_period_id` int(12) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `schedule_employee`
--

CREATE TABLE `schedule_employee` (
  `schedule_employee_id` int(11) NOT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `pay_period_id` int(11) DEFAULT NULL,
  `sched_refshift_id` int(11) DEFAULT NULL,
  `sched_refpay_id` int(11) DEFAULT NULL,
  `day` varchar(20) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `advance_in_out` int(11) NOT NULL DEFAULT '0',
  `time_in` datetime DEFAULT NULL,
  `time_out` datetime DEFAULT NULL,
  `total` time DEFAULT NULL,
  `date_created` datetime DEFAULT '0000-00-00 00:00:00',
  `date_modified` datetime DEFAULT '0000-00-00 00:00:00',
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `deleted_by` int(11) DEFAULT NULL,
  `is_in` tinyint(1) DEFAULT '0',
  `is_out` tinyint(1) DEFAULT '0',
  `clock_in` datetime DEFAULT NULL,
  `clock_out` datetime DEFAULT NULL,
  `stat_completion` decimal(11,0) NOT NULL DEFAULT '0',
  `date_deleted` datetime DEFAULT '0000-00-00 00:00:00',
  `break_time` time NOT NULL DEFAULT '00:00:00',
  `late` decimal(11,0) NOT NULL,
  `allow_ot` tinyint(1) DEFAULT '0',
  `ot_in` tinyint(1) DEFAULT '0',
  `ot_out` datetime DEFAULT '0000-00-00 00:00:00',
  `ref_day_type_id` int(11) NOT NULL DEFAULT '0',
  `is_day_off` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `sched_holiday_setup`
--

CREATE TABLE `sched_holiday_setup` (
  `sched_holiday_setup_id` int(11) UNSIGNED NOT NULL,
  `ref_day_type_id` int(11) DEFAULT NULL,
  `description` varchar(500) DEFAULT NULL,
  `date` date NOT NULL DEFAULT '0000-00-00',
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) UNSIGNED DEFAULT NULL,
  `date_created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `date_modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `is_deleted` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `date_deleted` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_by` int(11) NOT NULL
) ENGINE=InnoDB AVG_ROW_LENGTH=8192 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `sched_refpay`
--

CREATE TABLE `sched_refpay` (
  `sched_refpay_id` int(11) UNSIGNED NOT NULL,
  `schedpay` varchar(50) NOT NULL,
  `description` varchar(500) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) UNSIGNED DEFAULT NULL,
  `date_created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `date_modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `is_deleted` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `date_deleted` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_by` int(11) NOT NULL
) ENGINE=InnoDB AVG_ROW_LENGTH=8192 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `sched_refpay`
--

INSERT INTO `sched_refpay` (`sched_refpay_id`, `schedpay`, `description`, `created_by`, `modified_by`, `date_created`, `date_modified`, `is_deleted`, `date_deleted`, `deleted_by`) VALUES
(1, 'Regular Pay', 'Regular Pay', 1, NULL, '2017-04-26 09:24:13', '2017-05-02 11:18:05', 0, '2017-04-26 09:28:48', 1),
(2, 'Holiday Pay', 'Holiday Pay', 1, NULL, '2017-05-02 11:16:24', '2017-05-02 11:18:20', 0, '0000-00-00 00:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sched_refshift`
--

CREATE TABLE `sched_refshift` (
  `sched_refshift_id` int(11) NOT NULL,
  `schedule_template_advance_in_out` int(11) NOT NULL,
  `schedule_template_timein` time DEFAULT NULL,
  `schedule_template_timeout` time DEFAULT NULL,
  `schedule_template_break_time` time DEFAULT NULL,
  `is_deleted` tinyint(1) DEFAULT '0',
  `date_deleted` varchar(45) DEFAULT NULL,
  `deleted_by` varchar(45) DEFAULT NULL,
  `shift` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `sched_shift_break`
--

CREATE TABLE `sched_shift_break` (
  `sched_shift_break_id` int(11) NOT NULL,
  `sched_refshift_id` int(11) NOT NULL,
  `break_time` time NOT NULL,
  `break_allowance` decimal(20,2) NOT NULL,
  `sort_key` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sched_weekly_stats`
--

CREATE TABLE `sched_weekly_stats` (
  `sched_weekly_stats_id` int(11) NOT NULL,
  `schedule_employee_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `system_settings_default_deductions`
--

CREATE TABLE `system_settings_default_deductions` (
  `default_id` int(11) NOT NULL,
  `deduction_id` int(11) DEFAULT '0',
  `deduction_cycle` varchar(45) DEFAULT '0',
  `check1` tinyint(1) DEFAULT '0',
  `check2` tinyint(1) DEFAULT '0',
  `check3` tinyint(1) DEFAULT '0',
  `check4` tinyint(1) DEFAULT '0',
  `check5` tinyint(1) NOT NULL DEFAULT '0',
  `modified_by` int(11) DEFAULT NULL,
  `date_modified` date NOT NULL DEFAULT '0000-00-00'
) ENGINE=InnoDB AVG_ROW_LENGTH=4096 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `system_settings_default_deductions`
--

INSERT INTO `system_settings_default_deductions` (`default_id`, `deduction_id`, `deduction_cycle`, `check1`, `check2`, `check3`, `check4`, `check5`, `modified_by`, `date_modified`) VALUES
(1, 1, '0,2,0,0', 1, 2, 3, 4, 5, 1, '2017-12-18'),
(2, 2, '0,2,0,0', 1, 2, 3, 4, 5, 1, '2017-12-18'),
(3, 3, '0,0,3,0', 1, 2, 3, 4, 5, 1, '2017-12-18'),
(4, 4, '0,0,3,0', 1, 2, 3, 4, 5, 1, '2017-12-18');

-- --------------------------------------------------------

--
-- Table structure for table `tax_code_name`
--

CREATE TABLE `tax_code_name` (
  `tax_code_name_id` int(11) NOT NULL,
  `tax_name` varchar(20) DEFAULT NULL
) ENGINE=InnoDB AVG_ROW_LENGTH=3276 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `tax_code_name`
--

INSERT INTO `tax_code_name` (`tax_code_name_id`, `tax_name`) VALUES
(1, 'Z'),
(2, 'S/ME'),
(3, 'ME1/S1'),
(4, 'ME2/S2'),
(5, 'ME3/S3'),
(6, 'ME4/S4');

-- --------------------------------------------------------

--
-- Table structure for table `user_accounts`
--

CREATE TABLE `user_accounts` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(100) DEFAULT '',
  `user_pword` varchar(500) DEFAULT '',
  `user_lname` varchar(100) DEFAULT '',
  `user_fname` varchar(100) DEFAULT '',
  `user_mname` varchar(100) DEFAULT '',
  `user_address` varchar(155) DEFAULT '',
  `user_email` varchar(100) DEFAULT '',
  `user_mobile` varchar(100) DEFAULT '',
  `user_telephone` varchar(100) DEFAULT '',
  `user_bdate` varchar(255) DEFAULT NULL,
  `user_group_id` int(11) DEFAULT '0',
  `photo_path` varchar(255) DEFAULT '',
  `is_active` tinyint(1) DEFAULT '1',
  `is_deleted` tinyint(1) DEFAULT '0',
  `date_created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `date_modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `date_deleted` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `deleted_by` int(11) NOT NULL,
  `session_status` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AVG_ROW_LENGTH=4096 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `user_accounts`
--

INSERT INTO `user_accounts` (`user_id`, `user_name`, `user_pword`, `user_lname`, `user_fname`, `user_mname`, `user_address`, `user_email`, `user_mobile`, `user_telephone`, `user_bdate`, `user_group_id`, `photo_path`, `is_active`, `is_deleted`, `date_created`, `date_modified`, `date_deleted`, `created_by`, `modified_by`, `deleted_by`, `session_status`) VALUES
(1, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'Account', 'Demo', '', '', 'demo@gmail.com', '', '', '', 1, 'assets/img/user/anonymous-icon.png', 1, 0, '0000-00-00 00:00:00', '2017-10-19 10:37:58', '0000-00-00 00:00:00', 0, 1, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_groups`
--

CREATE TABLE `user_groups` (
  `user_group_id` int(11) NOT NULL,
  `user_group` varchar(135) DEFAULT '',
  `user_group_desc` varchar(500) DEFAULT '',
  `is_active` tinyint(1) DEFAULT '1',
  `is_deleted` tinyint(1) DEFAULT '0',
  `date_created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `date_modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `deleted_by` int(11) NOT NULL,
  `date_deleted` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AVG_ROW_LENGTH=5461 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `user_groups`
--

INSERT INTO `user_groups` (`user_group_id`, `user_group`, `user_group_desc`, `is_active`, `is_deleted`, `date_created`, `date_modified`, `created_by`, `modified_by`, `deleted_by`, `date_deleted`) VALUES
(1, 'Super User', 'Can access all features.', 1, 0, '0000-00-00 00:00:00', '2018-01-09 21:21:36', 0, 1, 0, '0000-00-00 00:00:00'),
(2, 'Attendance', 'User that can only access the employee time in / out', 1, 0, '2018-01-09 13:38:18', '2018-05-30 11:23:16', 1, 1, 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `user_rights`
--

CREATE TABLE `user_rights` (
  `user_rights_id` int(11) NOT NULL,
  `user_group_id` int(11) DEFAULT NULL,
  `right_employee_view` tinyint(1) NOT NULL DEFAULT '0',
  `right_employee_excel` tinyint(1) DEFAULT '0',
  `right_employee_create` tinyint(1) NOT NULL DEFAULT '0',
  `right_employee_edit` tinyint(1) NOT NULL DEFAULT '0',
  `right_employee_delete` tinyint(1) NOT NULL DEFAULT '0',
  `right_empreference_view` tinyint(1) NOT NULL DEFAULT '0',
  `right_department_view` tinyint(1) NOT NULL DEFAULT '0',
  `right_department_create` tinyint(1) NOT NULL DEFAULT '0',
  `right_department_edit` tinyint(1) NOT NULL DEFAULT '0',
  `right_department_delete` tinyint(1) NOT NULL DEFAULT '0',
  `right_position_view` tinyint(1) NOT NULL DEFAULT '0',
  `right_position_create` tinyint(1) NOT NULL DEFAULT '0',
  `right_position_edit` tinyint(1) NOT NULL DEFAULT '0',
  `right_position_delete` tinyint(1) NOT NULL DEFAULT '0',
  `right_section_view` tinyint(1) NOT NULL DEFAULT '0',
  `right_section_create` tinyint(1) NOT NULL DEFAULT '0',
  `right_section_edit` tinyint(1) NOT NULL DEFAULT '0',
  `right_section_delete` tinyint(1) NOT NULL DEFAULT '0',
  `right_paymenttype_view` tinyint(1) NOT NULL DEFAULT '0',
  `right_paymenttype_create` tinyint(1) NOT NULL DEFAULT '0',
  `right_paymenttype_edit` tinyint(1) NOT NULL DEFAULT '0',
  `right_paymenttype_delete` tinyint(1) NOT NULL DEFAULT '0',
  `right_payperiod_view` tinyint(1) NOT NULL DEFAULT '0',
  `right_payperiod_create` tinyint(1) NOT NULL DEFAULT '0',
  `right_payperiod_edit` tinyint(1) NOT NULL DEFAULT '0',
  `right_payperiod_delete` tinyint(1) NOT NULL DEFAULT '0',
  `right_contribution_view` tinyint(1) NOT NULL DEFAULT '0',
  `right_sss_view` tinyint(1) NOT NULL DEFAULT '0',
  `right_sss_create` tinyint(1) NOT NULL DEFAULT '0',
  `right_sss_edit` tinyint(1) NOT NULL DEFAULT '0',
  `right_sss_delete` tinyint(1) NOT NULL DEFAULT '0',
  `right_philhealth_view` tinyint(1) NOT NULL DEFAULT '0',
  `right_philhealth_create` tinyint(1) NOT NULL DEFAULT '0',
  `right_philhealth_edit` tinyint(1) NOT NULL DEFAULT '0',
  `right_philhealth_delete` tinyint(1) NOT NULL DEFAULT '0',
  `right_taxtable_view` tinyint(1) NOT NULL DEFAULT '0',
  `right_loandeduction_view` tinyint(1) NOT NULL DEFAULT '0',
  `right_loandeduction_create` tinyint(1) NOT NULL DEFAULT '0',
  `right_loandeduction_edit` tinyint(1) NOT NULL DEFAULT '0',
  `right_loandeduction_delete` tinyint(1) NOT NULL DEFAULT '0',
  `right_payrollparent_view` tinyint(1) NOT NULL DEFAULT '0',
  `right_dtr_view` tinyint(1) NOT NULL DEFAULT '0',
  `right_dtr_processpayroll` tinyint(1) NOT NULL DEFAULT '0',
  `right_dtr_updatepayroll` tinyint(1) NOT NULL DEFAULT '0',
  `right_payslip_view` tinyint(1) NOT NULL DEFAULT '0',
  `right_payroll_register_view` tinyint(1) NOT NULL DEFAULT '0',
  `right_payrollsummary_view` tinyint(1) NOT NULL DEFAULT '0',
  `right_13thmonthpay_view` tinyint(1) NOT NULL DEFAULT '0',
  `right_alphalist_view` tinyint(1) DEFAULT '0',
  `right_1601C_view` tinyint(1) DEFAULT '0',
  `right_payrollreports_view` tinyint(1) NOT NULL DEFAULT '0',
  `right_sssreport_view` tinyint(1) NOT NULL DEFAULT '0',
  `right_philhealthreport_view` tinyint(1) NOT NULL DEFAULT '0',
  `right_pagibigreport_view` tinyint(1) NOT NULL DEFAULT '0',
  `right_wtaxreport_view` tinyint(1) NOT NULL DEFAULT '0',
  `right_adminparent_view` tinyint(1) NOT NULL DEFAULT '0',
  `right_useracccount_view` tinyint(1) NOT NULL DEFAULT '0',
  `right_useracccount_create` tinyint(1) NOT NULL DEFAULT '0',
  `right_useracccount_edit` tinyint(1) NOT NULL DEFAULT '0',
  `right_useracccount_delete` tinyint(1) NOT NULL DEFAULT '0',
  `right_usergroup_view` tinyint(1) NOT NULL DEFAULT '0',
  `right_usergroup_create` tinyint(1) NOT NULL DEFAULT '0',
  `right_usergroup_edit` tinyint(1) NOT NULL DEFAULT '0',
  `right_usergroup_delete` tinyint(1) NOT NULL DEFAULT '0',
  `right_companysetup_view` tinyint(1) NOT NULL DEFAULT '0',
  `right_companysetup_edit` tinyint(1) NOT NULL DEFAULT '0',
  `right_reffactorfile_view` tinyint(1) NOT NULL DEFAULT '0',
  `right_reffactorfile_edit` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_rights`
--

INSERT INTO `user_rights` (`user_rights_id`, `user_group_id`, `right_employee_view`, `right_employee_excel`, `right_employee_create`, `right_employee_edit`, `right_employee_delete`, `right_empreference_view`, `right_department_view`, `right_department_create`, `right_department_edit`, `right_department_delete`, `right_position_view`, `right_position_create`, `right_position_edit`, `right_position_delete`, `right_section_view`, `right_section_create`, `right_section_edit`, `right_section_delete`, `right_paymenttype_view`, `right_paymenttype_create`, `right_paymenttype_edit`, `right_paymenttype_delete`, `right_payperiod_view`, `right_payperiod_create`, `right_payperiod_edit`, `right_payperiod_delete`, `right_contribution_view`, `right_sss_view`, `right_sss_create`, `right_sss_edit`, `right_sss_delete`, `right_philhealth_view`, `right_philhealth_create`, `right_philhealth_edit`, `right_philhealth_delete`, `right_taxtable_view`, `right_loandeduction_view`, `right_loandeduction_create`, `right_loandeduction_edit`, `right_loandeduction_delete`, `right_payrollparent_view`, `right_dtr_view`, `right_dtr_processpayroll`, `right_dtr_updatepayroll`, `right_payslip_view`, `right_payroll_register_view`, `right_payrollsummary_view`, `right_13thmonthpay_view`, `right_alphalist_view`, `right_1601C_view`, `right_payrollreports_view`, `right_sssreport_view`, `right_philhealthreport_view`, `right_pagibigreport_view`, `right_wtaxreport_view`, `right_adminparent_view`, `right_useracccount_view`, `right_useracccount_create`, `right_useracccount_edit`, `right_useracccount_delete`, `right_usergroup_view`, `right_usergroup_create`, `right_usergroup_edit`, `right_usergroup_delete`, `right_companysetup_view`, `right_companysetup_edit`, `right_reffactorfile_view`, `right_reffactorfile_edit`) VALUES
(1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
(5, 2, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `wall_post`
--

CREATE TABLE `wall_post` (
  `wall_post_id` int(11) NOT NULL,
  `post_content` varchar(1000) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `date_created` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `announcement_post`
--
ALTER TABLE `announcement_post`
  ADD PRIMARY KEY (`announcement_post_id`);

--
-- Indexes for table `announcement_read_status`
--
ALTER TABLE `announcement_read_status`
  ADD PRIMARY KEY (`read_status_id`);

--
-- Indexes for table `backup`
--
ALTER TABLE `backup`
  ADD PRIMARY KEY (`backup_id`) USING BTREE;

--
-- Indexes for table `bir_2316`
--
ALTER TABLE `bir_2316`
  ADD PRIMARY KEY (`bir_2316_id`) USING BTREE,
  ADD UNIQUE KEY `bir_2316_id` (`bir_2316_id`) USING BTREE;

--
-- Indexes for table `company_setup`
--
ALTER TABLE `company_setup`
  ADD PRIMARY KEY (`company_id`) USING BTREE;

--
-- Indexes for table `daily_time_record`
--
ALTER TABLE `daily_time_record`
  ADD PRIMARY KEY (`dtr_id`);

--
-- Indexes for table `deductions_temporary`
--
ALTER TABLE `deductions_temporary`
  ADD PRIMARY KEY (`deduction_temporary_id`) USING BTREE;

--
-- Indexes for table `dtr_deductions`
--
ALTER TABLE `dtr_deductions`
  ADD PRIMARY KEY (`dtr_deduction_id`) USING BTREE;

--
-- Indexes for table `email_user_settings`
--
ALTER TABLE `email_user_settings`
  ADD PRIMARY KEY (`email_user_settings_id`);

--
-- Indexes for table `employee_account`
--
ALTER TABLE `employee_account`
  ADD PRIMARY KEY (`employee_account_id`);

--
-- Indexes for table `employee_break`
--
ALTER TABLE `employee_break`
  ADD PRIMARY KEY (`employee_break_id`);

--
-- Indexes for table `employee_clearance`
--
ALTER TABLE `employee_clearance`
  ADD PRIMARY KEY (`employee_clearance_id`);

--
-- Indexes for table `employee_clearance_deduction`
--
ALTER TABLE `employee_clearance_deduction`
  ADD PRIMARY KEY (`employee_clearance_deduction_id`);

--
-- Indexes for table `employee_list`
--
ALTER TABLE `employee_list`
  ADD PRIMARY KEY (`employee_id`);

--
-- Indexes for table `emp_children_dependent`
--
ALTER TABLE `emp_children_dependent`
  ADD PRIMARY KEY (`emp_children_dependent_id`) USING BTREE;

--
-- Indexes for table `emp_commendation`
--
ALTER TABLE `emp_commendation`
  ADD PRIMARY KEY (`emp_commendation_id`) USING BTREE;

--
-- Indexes for table `emp_confidential_status`
--
ALTER TABLE `emp_confidential_status`
  ADD PRIMARY KEY (`emp_confidential_status_id`);

--
-- Indexes for table `emp_educational_attainment`
--
ALTER TABLE `emp_educational_attainment`
  ADD PRIMARY KEY (`emp_educational_attainment_id`) USING BTREE;

--
-- Indexes for table `emp_emergency_contact_details`
--
ALTER TABLE `emp_emergency_contact_details`
  ADD PRIMARY KEY (`emp_emergency_contact_details_id`) USING BTREE;

--
-- Indexes for table `emp_family_details`
--
ALTER TABLE `emp_family_details`
  ADD PRIMARY KEY (`emp_family_details_id`) USING BTREE;

--
-- Indexes for table `emp_holiday_pay_list`
--
ALTER TABLE `emp_holiday_pay_list`
  ADD PRIMARY KEY (`emp_holiday_pay_id`);

--
-- Indexes for table `emp_leaves_entitlement`
--
ALTER TABLE `emp_leaves_entitlement`
  ADD PRIMARY KEY (`emp_leaves_entitlement_id`) USING BTREE;

--
-- Indexes for table `emp_leaves_filed`
--
ALTER TABLE `emp_leaves_filed`
  ADD PRIMARY KEY (`emp_leaves_filed_id`) USING BTREE;

--
-- Indexes for table `emp_leave_received_forwarded_history`
--
ALTER TABLE `emp_leave_received_forwarded_history`
  ADD PRIMARY KEY (`emp_leave_received_forwarded_history_id`) USING BTREE;

--
-- Indexes for table `emp_leave_year`
--
ALTER TABLE `emp_leave_year`
  ADD PRIMARY KEY (`emp_leave_year_id`) USING BTREE;

--
-- Indexes for table `emp_memo`
--
ALTER TABLE `emp_memo`
  ADD PRIMARY KEY (`emp_memo_id`) USING BTREE;

--
-- Indexes for table `emp_overtime_list`
--
ALTER TABLE `emp_overtime_list`
  ADD PRIMARY KEY (`emp_overtime_id`);

--
-- Indexes for table `emp_rates_duties`
--
ALTER TABLE `emp_rates_duties`
  ADD PRIMARY KEY (`emp_rates_duties_id`) USING BTREE;

--
-- Indexes for table `emp_resignation_form`
--
ALTER TABLE `emp_resignation_form`
  ADD PRIMARY KEY (`emp_resignation_id`);

--
-- Indexes for table `emp_seminar_training`
--
ALTER TABLE `emp_seminar_training`
  ADD PRIMARY KEY (`emp_seminar_training_id`) USING BTREE;

--
-- Indexes for table `loan_list`
--
ALTER TABLE `loan_list`
  ADD PRIMARY KEY (`loan_id`);

--
-- Indexes for table `new_deductions_regular`
--
ALTER TABLE `new_deductions_regular`
  ADD PRIMARY KEY (`deduction_regular_id`) USING BTREE;

--
-- Indexes for table `new_otherearnings_regular`
--
ALTER TABLE `new_otherearnings_regular`
  ADD PRIMARY KEY (`oe_regular_id`) USING BTREE;

--
-- Indexes for table `nsdsetup`
--
ALTER TABLE `nsdsetup`
  ADD PRIMARY KEY (`nsdsetup_id`) USING BTREE;

--
-- Indexes for table `otherearnings_temporary`
--
ALTER TABLE `otherearnings_temporary`
  ADD PRIMARY KEY (`earnings_temporary_id`) USING BTREE;

--
-- Indexes for table `pay_slip`
--
ALTER TABLE `pay_slip`
  ADD PRIMARY KEY (`pay_slip_id`) USING BTREE;

--
-- Indexes for table `pay_slip_deductions`
--
ALTER TABLE `pay_slip_deductions`
  ADD PRIMARY KEY (`pay_slip_deduction_id`) USING BTREE;

--
-- Indexes for table `pay_slip_earned`
--
ALTER TABLE `pay_slip_earned`
  ADD PRIMARY KEY (`pay_slip_earned_id`) USING BTREE;

--
-- Indexes for table `pay_slip_loans_adjustments`
--
ALTER TABLE `pay_slip_loans_adjustments`
  ADD PRIMARY KEY (`loans_adjustments_id`) USING BTREE;

--
-- Indexes for table `pay_slip_other_earnings`
--
ALTER TABLE `pay_slip_other_earnings`
  ADD PRIMARY KEY (`pay_slip_other_earnings_id`) USING BTREE;

--
-- Indexes for table `pay_slip_reset`
--
ALTER TABLE `pay_slip_reset`
  ADD PRIMARY KEY (`pay_slip_reset`) USING BTREE;

--
-- Indexes for table `refdeduction`
--
ALTER TABLE `refdeduction`
  ADD PRIMARY KEY (`deduction_id`) USING BTREE;

--
-- Indexes for table `refdeductiontype`
--
ALTER TABLE `refdeductiontype`
  ADD PRIMARY KEY (`deduction_type_id`) USING BTREE;

--
-- Indexes for table `reffactorfile`
--
ALTER TABLE `reffactorfile`
  ADD PRIMARY KEY (`factor_id`) USING BTREE;

--
-- Indexes for table `refgroup`
--
ALTER TABLE `refgroup`
  ADD PRIMARY KEY (`group_id`) USING BTREE;

--
-- Indexes for table `refotherearnings`
--
ALTER TABLE `refotherearnings`
  ADD PRIMARY KEY (`earnings_id`) USING BTREE;

--
-- Indexes for table `refotherearningstype`
--
ALTER TABLE `refotherearningstype`
  ADD PRIMARY KEY (`earnings_type_id`) USING BTREE;

--
-- Indexes for table `refpayperiod`
--
ALTER TABLE `refpayperiod`
  ADD PRIMARY KEY (`pay_period_id`) USING BTREE;

--
-- Indexes for table `reftaxcode`
--
ALTER TABLE `reftaxcode`
  ADD PRIMARY KEY (`tax_id`);

--
-- Indexes for table `ref_action_taken`
--
ALTER TABLE `ref_action_taken`
  ADD PRIMARY KEY (`ref_action_taken_id`) USING BTREE;

--
-- Indexes for table `ref_branch`
--
ALTER TABLE `ref_branch`
  ADD PRIMARY KEY (`ref_branch_id`) USING BTREE;

--
-- Indexes for table `ref_certificate`
--
ALTER TABLE `ref_certificate`
  ADD PRIMARY KEY (`ref_certificate_id`) USING BTREE;

--
-- Indexes for table `ref_clearance_reason`
--
ALTER TABLE `ref_clearance_reason`
  ADD PRIMARY KEY (`clearance_reason_id`);

--
-- Indexes for table `ref_compensation_type`
--
ALTER TABLE `ref_compensation_type`
  ADD PRIMARY KEY (`ref_compensation_type_id`) USING BTREE;

--
-- Indexes for table `ref_course_degree`
--
ALTER TABLE `ref_course_degree`
  ADD PRIMARY KEY (`ref_course_degree_id`) USING BTREE;

--
-- Indexes for table `ref_day_type`
--
ALTER TABLE `ref_day_type`
  ADD PRIMARY KEY (`ref_day_type_id`) USING BTREE;

--
-- Indexes for table `ref_department`
--
ALTER TABLE `ref_department`
  ADD PRIMARY KEY (`ref_department_id`) USING BTREE;

--
-- Indexes for table `ref_disciplinary_action_policy`
--
ALTER TABLE `ref_disciplinary_action_policy`
  ADD PRIMARY KEY (`ref_disciplinary_action_policy_id`) USING BTREE;

--
-- Indexes for table `ref_duration`
--
ALTER TABLE `ref_duration`
  ADD PRIMARY KEY (`duration_id`);

--
-- Indexes for table `ref_employment_status`
--
ALTER TABLE `ref_employment_status`
  ADD PRIMARY KEY (`ref_employment_status_id`) USING BTREE;

--
-- Indexes for table `ref_employment_type`
--
ALTER TABLE `ref_employment_type`
  ADD PRIMARY KEY (`ref_employment_type_id`) USING BTREE;

--
-- Indexes for table `ref_leave_type`
--
ALTER TABLE `ref_leave_type`
  ADD PRIMARY KEY (`ref_leave_type_id`) USING BTREE;

--
-- Indexes for table `ref_payment_type`
--
ALTER TABLE `ref_payment_type`
  ADD PRIMARY KEY (`ref_payment_type_id`) USING BTREE;

--
-- Indexes for table `ref_philhealth_contribution`
--
ALTER TABLE `ref_philhealth_contribution`
  ADD PRIMARY KEY (`ref_philhealth_contribution_id`);

--
-- Indexes for table `ref_position`
--
ALTER TABLE `ref_position`
  ADD PRIMARY KEY (`ref_position_id`) USING BTREE;

--
-- Indexes for table `ref_relationship`
--
ALTER TABLE `ref_relationship`
  ADD PRIMARY KEY (`ref_relationship_id`) USING BTREE;

--
-- Indexes for table `ref_religion`
--
ALTER TABLE `ref_religion`
  ADD PRIMARY KEY (`ref_religion_id`) USING BTREE;

--
-- Indexes for table `ref_section`
--
ALTER TABLE `ref_section`
  ADD PRIMARY KEY (`ref_section_id`) USING BTREE;

--
-- Indexes for table `ref_sss_contribution`
--
ALTER TABLE `ref_sss_contribution`
  ADD PRIMARY KEY (`ref_sss_contribution_id`) USING BTREE;

--
-- Indexes for table `ref_work_experience`
--
ALTER TABLE `ref_work_experience`
  ADD PRIMARY KEY (`ref_work_experience_id`);

--
-- Indexes for table `reg_deduction_cycle`
--
ALTER TABLE `reg_deduction_cycle`
  ADD PRIMARY KEY (`reg_deduction_cycle_id`);

--
-- Indexes for table `schedule_employee`
--
ALTER TABLE `schedule_employee`
  ADD PRIMARY KEY (`schedule_employee_id`) USING BTREE;

--
-- Indexes for table `sched_holiday_setup`
--
ALTER TABLE `sched_holiday_setup`
  ADD PRIMARY KEY (`sched_holiday_setup_id`) USING BTREE;

--
-- Indexes for table `sched_refpay`
--
ALTER TABLE `sched_refpay`
  ADD PRIMARY KEY (`sched_refpay_id`) USING BTREE;

--
-- Indexes for table `sched_refshift`
--
ALTER TABLE `sched_refshift`
  ADD PRIMARY KEY (`sched_refshift_id`) USING BTREE;

--
-- Indexes for table `sched_shift_break`
--
ALTER TABLE `sched_shift_break`
  ADD PRIMARY KEY (`sched_shift_break_id`);

--
-- Indexes for table `sched_weekly_stats`
--
ALTER TABLE `sched_weekly_stats`
  ADD PRIMARY KEY (`sched_weekly_stats_id`) USING BTREE;

--
-- Indexes for table `system_settings_default_deductions`
--
ALTER TABLE `system_settings_default_deductions`
  ADD PRIMARY KEY (`default_id`) USING BTREE;

--
-- Indexes for table `tax_code_name`
--
ALTER TABLE `tax_code_name`
  ADD PRIMARY KEY (`tax_code_name_id`) USING BTREE;

--
-- Indexes for table `user_accounts`
--
ALTER TABLE `user_accounts`
  ADD PRIMARY KEY (`user_id`) USING BTREE;

--
-- Indexes for table `user_groups`
--
ALTER TABLE `user_groups`
  ADD PRIMARY KEY (`user_group_id`) USING BTREE;

--
-- Indexes for table `user_rights`
--
ALTER TABLE `user_rights`
  ADD PRIMARY KEY (`user_rights_id`);

--
-- Indexes for table `wall_post`
--
ALTER TABLE `wall_post`
  ADD PRIMARY KEY (`wall_post_id`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `announcement_post`
--
ALTER TABLE `announcement_post`
  MODIFY `announcement_post_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `announcement_read_status`
--
ALTER TABLE `announcement_read_status`
  MODIFY `read_status_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `backup`
--
ALTER TABLE `backup`
  MODIFY `backup_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `bir_2316`
--
ALTER TABLE `bir_2316`
  MODIFY `bir_2316_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `company_setup`
--
ALTER TABLE `company_setup`
  MODIFY `company_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `daily_time_record`
--
ALTER TABLE `daily_time_record`
  MODIFY `dtr_id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `deductions_temporary`
--
ALTER TABLE `deductions_temporary`
  MODIFY `deduction_temporary_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `dtr_deductions`
--
ALTER TABLE `dtr_deductions`
  MODIFY `dtr_deduction_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `email_user_settings`
--
ALTER TABLE `email_user_settings`
  MODIFY `email_user_settings_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `employee_account`
--
ALTER TABLE `employee_account`
  MODIFY `employee_account_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `employee_break`
--
ALTER TABLE `employee_break`
  MODIFY `employee_break_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `employee_clearance`
--
ALTER TABLE `employee_clearance`
  MODIFY `employee_clearance_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `employee_clearance_deduction`
--
ALTER TABLE `employee_clearance_deduction`
  MODIFY `employee_clearance_deduction_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `employee_list`
--
ALTER TABLE `employee_list`
  MODIFY `employee_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `emp_children_dependent`
--
ALTER TABLE `emp_children_dependent`
  MODIFY `emp_children_dependent_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `emp_commendation`
--
ALTER TABLE `emp_commendation`
  MODIFY `emp_commendation_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `emp_confidential_status`
--
ALTER TABLE `emp_confidential_status`
  MODIFY `emp_confidential_status_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `emp_educational_attainment`
--
ALTER TABLE `emp_educational_attainment`
  MODIFY `emp_educational_attainment_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `emp_emergency_contact_details`
--
ALTER TABLE `emp_emergency_contact_details`
  MODIFY `emp_emergency_contact_details_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `emp_family_details`
--
ALTER TABLE `emp_family_details`
  MODIFY `emp_family_details_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `emp_holiday_pay_list`
--
ALTER TABLE `emp_holiday_pay_list`
  MODIFY `emp_holiday_pay_id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `emp_leaves_entitlement`
--
ALTER TABLE `emp_leaves_entitlement`
  MODIFY `emp_leaves_entitlement_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `emp_leaves_filed`
--
ALTER TABLE `emp_leaves_filed`
  MODIFY `emp_leaves_filed_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `emp_leave_received_forwarded_history`
--
ALTER TABLE `emp_leave_received_forwarded_history`
  MODIFY `emp_leave_received_forwarded_history_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `emp_leave_year`
--
ALTER TABLE `emp_leave_year`
  MODIFY `emp_leave_year_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `emp_memo`
--
ALTER TABLE `emp_memo`
  MODIFY `emp_memo_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `emp_overtime_list`
--
ALTER TABLE `emp_overtime_list`
  MODIFY `emp_overtime_id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `emp_rates_duties`
--
ALTER TABLE `emp_rates_duties`
  MODIFY `emp_rates_duties_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `emp_resignation_form`
--
ALTER TABLE `emp_resignation_form`
  MODIFY `emp_resignation_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `emp_seminar_training`
--
ALTER TABLE `emp_seminar_training`
  MODIFY `emp_seminar_training_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `loan_list`
--
ALTER TABLE `loan_list`
  MODIFY `loan_id` int(12) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `new_deductions_regular`
--
ALTER TABLE `new_deductions_regular`
  MODIFY `deduction_regular_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `new_otherearnings_regular`
--
ALTER TABLE `new_otherearnings_regular`
  MODIFY `oe_regular_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `otherearnings_temporary`
--
ALTER TABLE `otherearnings_temporary`
  MODIFY `earnings_temporary_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pay_slip`
--
ALTER TABLE `pay_slip`
  MODIFY `pay_slip_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `pay_slip_deductions`
--
ALTER TABLE `pay_slip_deductions`
  MODIFY `pay_slip_deduction_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pay_slip_earned`
--
ALTER TABLE `pay_slip_earned`
  MODIFY `pay_slip_earned_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pay_slip_loans_adjustments`
--
ALTER TABLE `pay_slip_loans_adjustments`
  MODIFY `loans_adjustments_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pay_slip_other_earnings`
--
ALTER TABLE `pay_slip_other_earnings`
  MODIFY `pay_slip_other_earnings_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pay_slip_reset`
--
ALTER TABLE `pay_slip_reset`
  MODIFY `pay_slip_reset` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `refdeduction`
--
ALTER TABLE `refdeduction`
  MODIFY `deduction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `refdeductiontype`
--
ALTER TABLE `refdeductiontype`
  MODIFY `deduction_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `reffactorfile`
--
ALTER TABLE `reffactorfile`
  MODIFY `factor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `refgroup`
--
ALTER TABLE `refgroup`
  MODIFY `group_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `refotherearnings`
--
ALTER TABLE `refotherearnings`
  MODIFY `earnings_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `refotherearningstype`
--
ALTER TABLE `refotherearningstype`
  MODIFY `earnings_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `refpayperiod`
--
ALTER TABLE `refpayperiod`
  MODIFY `pay_period_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `reftaxcode`
--
ALTER TABLE `reftaxcode`
  MODIFY `tax_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `ref_action_taken`
--
ALTER TABLE `ref_action_taken`
  MODIFY `ref_action_taken_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ref_branch`
--
ALTER TABLE `ref_branch`
  MODIFY `ref_branch_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ref_certificate`
--
ALTER TABLE `ref_certificate`
  MODIFY `ref_certificate_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ref_clearance_reason`
--
ALTER TABLE `ref_clearance_reason`
  MODIFY `clearance_reason_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ref_compensation_type`
--
ALTER TABLE `ref_compensation_type`
  MODIFY `ref_compensation_type_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ref_course_degree`
--
ALTER TABLE `ref_course_degree`
  MODIFY `ref_course_degree_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ref_day_type`
--
ALTER TABLE `ref_day_type`
  MODIFY `ref_day_type_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `ref_department`
--
ALTER TABLE `ref_department`
  MODIFY `ref_department_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ref_disciplinary_action_policy`
--
ALTER TABLE `ref_disciplinary_action_policy`
  MODIFY `ref_disciplinary_action_policy_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ref_duration`
--
ALTER TABLE `ref_duration`
  MODIFY `duration_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `ref_employment_status`
--
ALTER TABLE `ref_employment_status`
  MODIFY `ref_employment_status_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ref_employment_type`
--
ALTER TABLE `ref_employment_type`
  MODIFY `ref_employment_type_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `ref_leave_type`
--
ALTER TABLE `ref_leave_type`
  MODIFY `ref_leave_type_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ref_payment_type`
--
ALTER TABLE `ref_payment_type`
  MODIFY `ref_payment_type_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `ref_philhealth_contribution`
--
ALTER TABLE `ref_philhealth_contribution`
  MODIFY `ref_philhealth_contribution_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `ref_position`
--
ALTER TABLE `ref_position`
  MODIFY `ref_position_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `ref_relationship`
--
ALTER TABLE `ref_relationship`
  MODIFY `ref_relationship_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ref_religion`
--
ALTER TABLE `ref_religion`
  MODIFY `ref_religion_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `ref_section`
--
ALTER TABLE `ref_section`
  MODIFY `ref_section_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ref_sss_contribution`
--
ALTER TABLE `ref_sss_contribution`
  MODIFY `ref_sss_contribution_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT for table `ref_work_experience`
--
ALTER TABLE `ref_work_experience`
  MODIFY `ref_work_experience_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `reg_deduction_cycle`
--
ALTER TABLE `reg_deduction_cycle`
  MODIFY `reg_deduction_cycle_id` int(12) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `schedule_employee`
--
ALTER TABLE `schedule_employee`
  MODIFY `schedule_employee_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sched_holiday_setup`
--
ALTER TABLE `sched_holiday_setup`
  MODIFY `sched_holiday_setup_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sched_refpay`
--
ALTER TABLE `sched_refpay`
  MODIFY `sched_refpay_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `sched_refshift`
--
ALTER TABLE `sched_refshift`
  MODIFY `sched_refshift_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sched_shift_break`
--
ALTER TABLE `sched_shift_break`
  MODIFY `sched_shift_break_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sched_weekly_stats`
--
ALTER TABLE `sched_weekly_stats`
  MODIFY `sched_weekly_stats_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `system_settings_default_deductions`
--
ALTER TABLE `system_settings_default_deductions`
  MODIFY `default_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tax_code_name`
--
ALTER TABLE `tax_code_name`
  MODIFY `tax_code_name_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `user_accounts`
--
ALTER TABLE `user_accounts`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `user_groups`
--
ALTER TABLE `user_groups`
  MODIFY `user_group_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `user_rights`
--
ALTER TABLE `user_rights`
  MODIFY `user_rights_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `wall_post`
--
ALTER TABLE `wall_post`
  MODIFY `wall_post_id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
