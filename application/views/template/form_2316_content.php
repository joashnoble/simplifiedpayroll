<style type="text/css">
    span{
        position: absolute;
        z-index: 200;
        font-size: 11pt;
    }
    @page {
	  size: A4;
	  margin: default;
	  scale: 100%;
	}
</style>
<?php 
$per_day_pay = "";
$monthly_based_salary = "";

// ## NON TAXABLE / EXEMPT COMPENSATION INCOME
$gross_pay = 0;
$holiday_pay = 0;
$overtime = 0;
$nsd_pay = 0;
$hazard_pay = 0;
$total_13thmonth = $info->total_13thmonth;
$de_minimins_benefits = $info->allowance_pay;
$total_contributions = $info->total_contributions;
$salaries_and_others = 0;
$total_non_taxable = 0;

if ($info->is_minimum_wage == 1){
    $gross_pay = $info->gross_pay;
    $holiday_pay = $info->holiday_pay;
    $overtime = $info->overtime;
    $per_day_pay = number_format($info->per_day_pay,2);
    $monthly_based_salary = number_format($info->monthly_based_salary,2);
}

$total_non_taxable = $gross_pay + $holiday_pay + $overtime + $nsd_pay + $hazard_pay + $total_13thmonth + $de_minimins_benefits + $total_contributions + $salaries_and_others;

// ## TAXABLE COMPENSATION INCOME REGULAR
$basic_salary = $info->gross_pay;
$representation = 0;
$transportation = 0;
$cost_of_living_allowance = 0;
$fixed_housing_allowance = 0;
$commission = $info->commission;
$profit_sharing = 0;
$directors_fee = 0;
$taxable_13month_benefits = 0;
$taxable_hazard_pay = 0;
$taxable_overtime_pay = 0;
$total_taxable_compensation_income = 0;

$total_taxable_compensation_income = $basic_salary + $representation + $transportation + $cost_of_living_allowance + $fixed_housing_allowance + $commission + $profit_sharing + $directors_fee + $taxable_13month_benefits + $taxable_hazard_pay + $taxable_overtime_pay;


// ## Part IV-A
$gross_compensation_income = $total_non_taxable + $total_taxable_compensation_income;
$taxable_income_previous_employer = 0;
$gross_taxable_compensation = $total_taxable_compensation_income + $taxable_income_previous_employer;
$total_exemptions = 0;
$premium_paid_health = 0;
$present_wtax_deduction = $info->wtax_deduction;
$previous_wtax_deduction = 0;
?>
<img src="<?php echo base_url("assets/img/bir_form/form_2316.png");?>" style="top: 0px; left: 0px; width: 100%;position: absolute;z-index: 100;">

<!-- 1 -->
<span style="top: 119px; left: 180px;letter-spacing: 8px;"><?php echo $year; ?></span> 

<!-- 2 -->
<span style="top: 119px; left: 550px;letter-spacing: 7px;"><?php echo $period->period_1; ?></span>
<span style="top: 119px; left: 702px;letter-spacing: 7px;"><?php echo $period->period_2; ?></span>

<!-- 3 -->
<span style="top: 160px; left: 182px;letter-spacing: 5px;"><?php echo $payor_tin_1;?></span>
<span style="top: 160px; left: 241px;letter-spacing: 5px;"><?php echo $payor_tin_2;?></span>
<span style="top: 160px; left: 301px;letter-spacing: 6px;"><?php echo $payor_tin_3;?></span>
<span style="top: 160px; left: 361px;letter-spacing: 5px;"><?php echo $payor_tin_4;?></span>

<!-- 4 -->
<span style="top: 196px; left: 70px;width: 265px;max-width: 265px;"><?php echo $info->employee_name;?></span>

<!-- 5 -->
<span style="top: 196px; left: 361px;letter-spacing: 10px;"><?php echo $info->rdo_no; ?></span>

<!-- 6 -->
<span style="top: 231px; left: 70px;width: 265px;max-width: 265px;"><?php echo $info->address;?></span>

<!-- 6A -->
<span style="top: 231px; left: 355px;letter-spacing: 8px;"><?php echo $info->zip_code; ?></span>

<!-- 7 -->
<span style="top: 337px; left: 72px;letter-spacing: 10px;"><?php echo $info->birthdate; ?></span>

<!-- 8 -->
<span style="top: 335.5px; left: 275px;width: 133px;max-width: 133px;"><?php echo $info->cell_number;?></span>

<!-- 12 -->
<span style="top: 494px; left: 280px;width: 130px;max-width: 130px;text-align: right;"><?php echo $per_day_pay;?></span>
<!-- 13 -->
<span style="top: 517px; left: 280px;width: 130px;max-width: 130px;text-align: right;"><?php echo $monthly_based_salary;?></span>

<!-- 15 -->
<span style="top: 577px; left: 182px;letter-spacing: 5px;"><?php echo $employer_tin_1;?></span>
<span style="top: 577px; left: 241px;letter-spacing: 5px;"><?php echo $employer_tin_2;?></span>
<span style="top: 577px; left: 301px;letter-spacing: 6px;"><?php echo $employer_tin_3;?></span>
<span style="top: 577px; left: 361px;letter-spacing: 5px;"><?php echo $employer_tin_4;?></span>

<!-- 16 -->
<span style="top: 613px; left: 70px;width: 340px;max-width: 340px;"><?php echo $company->registered_to;?></span>

<!-- 17 -->
<span style="top: 649px; left: 70px;width: 270px;max-width: 270px;font-size: 9pt;"><?php echo $company->registered_address;?></span>

<!-- 17A -->
<span style="top: 649px; left: 355px;letter-spacing: 8px;"><?php echo $company->zip_code;?></span>

<!-- 21 -->
<span style="top: 804px; left: 243px;width: 165px;max-width: 165px;text-align: right;"><?php echo number_format($gross_compensation_income,2);?></span>

<!-- 22 -->
<span style="top: 826px; left: 243px;width: 165px;max-width: 165px;text-align: right;"><?php echo number_format($total_non_taxable,2);?></span>

<!-- 23 -->
<span style="top: 847px; left: 243px;width: 165px;max-width: 165px;text-align: right;"><?php echo number_format($total_taxable_compensation_income,2);?></span>

<!-- 24 -->
<span style="top: 868px; left: 243px;width: 165px;max-width: 165px;text-align: right;"><?php echo number_format($taxable_income_previous_employer,2);?></span>

<!-- 25 -->
<span style="top: 889px; left: 243px;width: 165px;max-width: 165px;text-align: right;"><?php echo number_format($gross_taxable_compensation,2);?></span>

<!-- 26 -->
<span style="top: 910px; left: 243px;width: 165px;max-width: 165px;text-align: right;"><?php echo number_format($total_exemptions,2);?></span>

<!-- 27 -->
<span style="top: 931px; left: 243px;width: 165px;max-width: 165px;text-align: right;"><?php echo number_format($premium_paid_health,2);?></span>

<!-- 28 -->
<span style="top: 952px; left: 243px;width: 165px;max-width: 165px;text-align: right;"><?php echo number_format($gross_taxable_compensation,2);?></span>

<!-- 29 -->
<span style="top: 975px; left: 243px;width: 165px;max-width: 165px;text-align: right;"><?php echo number_format($present_wtax_deduction,2);?></span>

<!-- 30A -->
<span style="top: 1002px; left: 243px;width: 165px;max-width: 165px;text-align: right;"><?php echo number_format($present_wtax_deduction,2);?></span>

<!-- 30B -->
<span style="top: 1024px; left: 243px;width: 165px;max-width: 165px;text-align: right;"><?php echo number_format($previous_wtax_deduction,2);?></span>

<!-- 31 -->
<span style="top: 1046px; left: 243px;width: 165px;max-width: 165px;text-align: right;"><?php echo number_format($present_wtax_deduction,2);?></span>

<!-- 32 -->
<span style="top: 196px; left: 590px;width: 165px;max-width: 165px;text-align: right;"><?php echo number_format($gross_pay,2);?></span>
<!-- 33 -->
<span style="top: 239px; left: 590px;width: 165px;max-width: 165px;text-align: right;"><?php echo number_format($holiday_pay,2);?></span>
<!-- 34 -->
<span style="top: 268px; left: 590px;width: 165px;max-width: 165px;text-align: right;"><?php echo number_format($overtime,2);?></span>
<!-- 35 -->
<span style="top: 297px; left: 590px;width: 165px;max-width: 165px;text-align: right;"><?php echo number_format($nsd_pay,2);?></span>
<!-- 36 -->
<span style="top: 326px; left: 590px;width: 165px;max-width: 165px;text-align: right;"><?php echo number_format($hazard_pay,2);?></span>

<!-- 37 -->
<span style="top: 354px; left: 590px;width: 165px;max-width: 165px;text-align: right;"><?php echo number_format($total_13thmonth,2);?></span>

<!-- 38 -->
<span style="top: 387px; left: 590px;width: 165px;max-width: 165px;text-align: right;"><?php echo number_format($de_minimins_benefits,2);?></span>

<!-- 39 -->
<span style="top: 428px; left: 590px;width: 165px;max-width: 165px;text-align: right;"><?php echo number_format($total_contributions,2);?></span>

<!-- 40 -->
<span style="top: 478px; left: 590px;width: 165px;max-width: 165px;text-align: right;"><?php echo number_format($salaries_and_others,2);?></span>

<!-- 41 -->
<span style="top: 515px; left: 590px;width: 165px;max-width: 165px;text-align: right;"><?php echo number_format($total_non_taxable,2);?></span>

<!-- 42 -->
<span style="top: 586px; left: 590px;width: 165px;max-width: 165px;text-align: right;"><?php echo number_format($basic_salary,2);?></span>

<!-- 43 -->
<span style="top: 614px; left: 590px;width: 165px;max-width: 165px;text-align: right;"><?php echo number_format($representation,2);?></span>

<!-- 44 -->
<span style="top: 642px; left: 590px;width: 165px;max-width: 165px;text-align: right;"><?php echo number_format($transportation,2);?></span>

<!-- 45 -->
<span style="top: 670px; left: 590px;width: 165px;max-width: 165px;text-align: right;"><?php echo number_format($cost_of_living_allowance,2);?></span>

<!-- 46 -->
<span style="top: 698px; left: 590px;width: 165px;max-width: 165px;text-align: right;"><?php echo number_format($fixed_housing_allowance,2);?></span>

<!-- 48 -->
<span style="top: 795px; left: 590px;width: 165px;max-width: 165px;text-align: right;"><?php echo number_format($commission,2);?></span>

<!-- 49 -->
<span style="top: 825px; left: 590px;width: 165px;max-width: 165px;text-align: right;"><?php echo number_format($profit_sharing,2);?></span>

<!-- 50 -->
<span style="top: 857px; left: 590px;width: 165px;max-width: 165px;text-align: right;"><?php echo number_format($directors_fee,2);?></span>

<!-- 51 -->
<span style="top: 888px; left: 590px;width: 165px;max-width: 165px;text-align: right;"><?php echo number_format($taxable_13month_benefits,2);?></span>

<!-- 52 -->
<span style="top: 920px; left: 590px;width: 165px;max-width: 165px;text-align: right;"><?php echo number_format($taxable_hazard_pay,2);?></span>

<!-- 53 -->
<span style="top: 952px; left: 590px;width: 165px;max-width: 165px;text-align: right;"><?php echo number_format($taxable_overtime_pay,2);?></span>

<!-- 55 -->
<span style="top: 1043px; left: 590px;width: 165px;max-width: 165px;text-align: right;"><?php echo number_format($total_taxable_compensation_income,2);?></span>

<!-- Amount Paid -->
<!-- <span style="top: 1139px; left: 645px;width: 100px;max-width: 100px;text-align: right;font-size: 9pt;"><?php echo number_format(0.00,2);?></span> -->

<script type="text/javascript">
    window.print();
</script>
