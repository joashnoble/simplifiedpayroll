	<style>
		td, th {
			padding: 7px;
		}
		table th{
			background: #FFF!important;
			color: black;
			font-family: calibri;
			font-size: 9pt!important;
		}		
		.tablepayroll{
			font-size: 10pt!important;
			width: 100%!important;
		}
		.tablepaytotals{
			border-bottom: .5px solid gray !important;
			padding-bottom: 5px !important;
			padding-top: 5px !important;
			font-size: 9pt!important;
			color: black!important;
		}

		.tdpadding{
			padding-top: 3px!important;
			padding-bottom: 3px!important;
			font-weight: 500!important;
			color: #263238!important;
			font-size: 10pt!important;
		}

		.tablepay{
			font-size: 10pt !important;
		}
	</style>
	<?php if($type == "print"){ ?>
		<div style="font-size: 9pt; width: 100%;">
			<div class="temp_header">
			<?php include 'template_header.php';?>
				<b>Payroll Summary</b> <br />
				<b>Pay Period : </b> <?php  echo $get_period;?> </br >
				<b>Branch : </b> <?php echo $get_branch; ?> <br />
				<b>Department : </b> <?php echo $get_department; ?>
			</div>
			<hr>
		</div>
	<?php } ?>
		<table class="tablepayroll">
			<thead>
				<tr>
					<th>#</th>
					<th style="width: 200px!important;">Employee Name</th>
					<th style="width: 100px!important;" align="right">Basic Pay</th>
					<th style="width: 100px!important;" align="right">Overtime</th>
					<th style="width: 100px!important;" align="right">Holiday Pay</th>
					<th style="width: 100px!important;" align="right">Allowance Pay</th>
					<th style="width: 100px!important;" align="right">Commission / Other Pay</th>
					<th style="width: 100px!important;" align="right">Undertime Deduction</th>
					<th style="width: 100px!important;" align="right">Late Deduction</th>
					<th style="width: 100px!important;" align="right">Adjustment Additional</th>
					<th style="width: 100px!important;" align="right">Adjustment Deduction</th>
					<th style="width: 100px!important;" align="right">Gross Total</th>
					<th style="width: 100px!important;" align="right">SSS</th>
					<th style="width: 100px!important;" align="right">Philhealth</th>
					<th style="width: 100px!important;" align="right">Pagibig</th>
					<th style="width: 100px!important;" align="right">W/Tax</th>
					<th style="width: 100px!important;" align="right">SSS Loan</th>
					<th style="width: 100px!important;" align="right">Pagibig Loan</th>
					<th style="width: 100px!important;" align="right">Cash Advance</th>
					<th style="width: 100px!important;" align="right">Total Deduction</th>
					<th style="width: 100px!important;" align="right">Net Pay</th>
				</tr>
				</tr>
			</thead>
			<tbody>
				<?php
					$basic_pay=0;
					$overtime=0;
					$holiday_pay=0;
					$allowance_pay=0;
					$commission=0;
					$undertime_amt = 0;
					$late_amt = 0;
					$adjustment_additional=0;
					$adjustment_deduction=0;
					$gross_total=0;
					$sss=0;
					$philhealth=0;
					$pagibig=0;
					$wtax=0;
					$sss_loan=0;
					$pagibig_loan=0;
					$cash_advance=0;
					$total_deduction=0;
					$net_pay=0;

					$count=1;
					if (count($payroll_register_summary) != 0){
					foreach($payroll_register_summary as $row){
					?>
				<tr>
					<td <?php if($type == "preview"){ echo 'class="tdpadding"'; }?>><?php echo $count; ?>.</td>
					<td style="width: 200px!important;font-size: 9pt!important;" <?php if($type == "preview"){ echo 'class="tdpadding"'; }?>><?php echo $row->full_name; ?></td>
					<td style="width: 100px!important;font-size: 9pt!important;"  align="right" <?php if($type == "preview"){ echo 'class="tdpadding"'; }?>><?php echo number_format($row->basic_pay_total,2); ?></td>
					<td style="width: 100px!important;font-size: 9pt!important;"  align="right" <?php if($type == "preview"){ echo 'class="tdpadding"'; }?>><?php echo number_format($row->overtime,2); ?></td>
					<td style="width: 100px!important;font-size: 9pt!important;"  align="right" <?php if($type == "preview"){ echo 'class="tdpadding"'; }?>><?php echo number_format($row->holiday_pay,2); ?></td>
					<td style="width: 100px!important;font-size: 9pt!important;"  align="right" <?php if($type == "preview"){ echo 'class="tdpadding"'; }?>><?php echo number_format($row->allowance_pay,2); ?></td>
					<td style="width: 100px!important;font-size: 9pt!important;"  align="right" <?php if($type == "preview"){ echo 'class="tdpadding"'; }?>><?php echo number_format($row->commission,2); ?></td>
					<td style="width: 100px!important;font-size: 9pt!important;"  align="right" <?php if($type == "preview"){ echo 'class="tdpadding"'; }?>><?php echo number_format($row->undertime_amt,2); ?></td>
					<td style="width: 100px!important;font-size: 9pt!important;"  align="right" <?php if($type == "preview"){ echo 'class="tdpadding"'; }?>><?php echo number_format($row->late_amt,2); ?></td>
					<td style="width: 100px!important;font-size: 9pt!important;"  align="right" <?php if($type == "preview"){ echo 'class="tdpadding"'; }?>><?php echo number_format($row->adjustment_additional,2); ?></td>
					<td style="width: 100px!important;font-size: 9pt!important;"  align="right" <?php if($type == "preview"){ echo 'class="tdpadding"'; }?>><?php echo number_format($row->adjustment_deduction,2); ?></td>
					<td style="width: 100px!important;font-size: 9pt!important;"  align="right" <?php if($type == "preview"){ echo 'class="tdpadding"'; }?>><?php echo number_format($row->gross_total,2); ?></td>
					<td style="width: 100px!important;font-size: 9pt!important;"  align="right" <?php if($type == "preview"){ echo 'class="tdpadding"'; }?>><?php echo number_format($row->sss_deduction,4); ?></td>
					<td style="width: 100px!important;font-size: 9pt!important;"  align="right" <?php if($type == "preview"){ echo 'class="tdpadding"'; }?>><?php echo number_format($row->philhealth_deduction,4); ?></td>
					<td style="width: 100px!important;font-size: 9pt!important;"  align="right" <?php if($type == "preview"){ echo 'class="tdpadding"'; }?>><?php echo number_format($row->pagibig_deduction,4); ?></td>
					<td style="width: 100px!important;font-size: 9pt!important;"  align="right" <?php if($type == "preview"){ echo 'class="tdpadding"'; }?>><?php echo number_format($row->wtax_deduction,4); ?></td>
					<td style="width: 100px!important;font-size: 9pt!important;"  align="right" <?php if($type == "preview"){ echo 'class="tdpadding"'; }?>><?php echo number_format($row->sss_loan,2); ?></td>
					<td style="width: 100px!important;font-size: 9pt!important;"  align="right" <?php if($type == "preview"){ echo 'class="tdpadding"'; }?>><?php echo number_format($row->pagibig_loan,2); ?></td>
					<td style="width: 100px!important;font-size: 9pt!important;"  align="right" <?php if($type == "preview"){ echo 'class="tdpadding"'; }?>><?php echo number_format($row->cash_advance,2); ?></td>
					<td style="width: 100px!important;font-size: 9pt!important;"  align="right" <?php if($type == "preview"){ echo 'class="tdpadding"'; }?>><?php echo number_format($row->total_deduction,4); ?></td>
					<td style="width: 100px!important;font-size: 9pt!important;"  align="right" <?php if($type == "preview"){ echo 'class="tdpadding"'; }?>><?php echo number_format($row->net_total,2); ?></td>
				</tr>
				<?php

					$basic_pay += $row->basic_pay_total;
					$overtime += $row->overtime;
					$holiday_pay += $row->holiday_pay;
					$allowance_pay += $row->allowance_pay;
					$commission += $row->commission;
					$undertime_amt += $row->undertime_amt;
					$late_amt += $row->late_amt;
					$adjustment_additional += $row->adjustment_additional;
					$adjustment_deduction += $row->adjustment_deduction;
					$gross_total += $row->gross_total;
					$sss += $row->sss_deduction;
					$philhealth += $row->philhealth_deduction;
					$pagibig += $row->pagibig_deduction;
					$wtax += $row->wtax_deduction;
					$sss_loan += $row->sss_loan;
					$pagibig_loan += $row->pagibig_loan;
					$cash_advance += $row->cash_advance;
					$total_deduction += $row->total_deduction;
					$net_pay += $row->net_total;

					$count++;

				 }}else{ echo '<td colspan="21" style="padding: 10px; font-size: 12pt!important;"><center>No Result</center></td>'; } ?>

			</tbody>
		</table>
			<div style="font-size:12pt;margin-top: 20px;" class="summary">
				<table class="tablepay">
					<tr>
						<td class="tablepaytotals" style="font-weight:500;">Basic Pay :</td>
						<td class="tablepaytotals" style="text-align: right;"><?php echo number_format($basic_pay,2);?></td>
						<td style="word-wrap: break-word; max-width: 20px; width: 20px;"></td>
						<td class="tablepaytotals" style="font-weight:500;">Late Deduction:</td>
						<td class="tablepaytotals" style="text-align: right;"><?php echo number_format($late_amt,2); ?></td>
						<td style="word-wrap: break-word; max-width: 20px; width: 20px;"></td>
						<td class="tablepaytotals" style="font-weight:500;">W/Tax :</td>
						<td class="tablepaytotals" style="text-align: right;"><?php echo number_format($wtax,2); ?></td>
					</tr>
					<tr>
						<td class="tablepaytotals" style="font-weight:500;">Overtime :</td>
						<td class="tablepaytotals" style="text-align: right;"><?php echo number_format($overtime,2); ?></td>
						<td></td>
						<td class="tablepaytotals" style="font-weight:500;">Adjustment Additional :</td>
						<td class="tablepaytotals" style="text-align: right;"><?php echo number_format($adjustment_additional,2); ?></td>
						<td></td>
						<td class="tablepaytotals" style="font-weight:500;">SSS Loan :</td>
						<td class="tablepaytotals" style="text-align: right;"><?php echo number_format($sss_loan,2); ?></td>
					</tr>
					<tr>
						<td class="tablepaytotals" style="font-weight:500;">Holiday Pay:</td>
						<td class="tablepaytotals" style="text-align: right;"><?php echo number_format($holiday_pay,2); ?></td>
						<td></td>
						<td class="tablepaytotals" style="font-weight:500;">Adjustment Deduction :</td>
						<td class="tablepaytotals" style="text-align: right;"><?php echo number_format($adjustment_deduction,2); ?></td>	
						<td></td>
						<td class="tablepaytotals" style="font-weight:500;">Pagibig Loan :</td>
						<td class="tablepaytotals" style="text-align: right;"><?php echo number_format($pagibig_loan,2); ?></td>
					</tr>
					<tr>
						<td class="tablepaytotals" style="font-weight:500;">Allowance Pay :</td>
						<td class="tablepaytotals" style="text-align: right;"><?php echo number_format($allowance_pay,2); ?></td>
						<td></td>
						<td class="tablepaytotals" style="font-weight:500;">SSS :</td>
						<td class="tablepaytotals" style="text-align: right;"><?php echo number_format($sss,2); ?></td>
						<td></td>
						<td class="tablepaytotals" style="font-weight:500;">Cash Advance:</td>
						<td class="tablepaytotals" style="text-align: right;"><?php echo number_format($cash_advance,2); ?></td>
					</tr>
					<tr>
						<td class="tablepaytotals" style="font-weight:500;">Commission / Other Pay :</td>
						<td class="tablepaytotals" style="text-align: right;"><?php echo number_format($commission,2); ?></td>
						<td></td>
						<td class="tablepaytotals" style="font-weight:500;">Philhealth :</td>
						<td class="tablepaytotals" style="text-align: right;"><?php echo number_format($philhealth,2); ?></td>
						<td></td>
						<td class="tablepaytotals" style="font-weight:500;">Total Deduction :</td>
						<td class="tablepaytotals" style="text-align: right;"><?php echo number_format($total_deduction,2); ?></td>
					</tr>
					<tr>
						<td class="tablepaytotals" style="font-weight:500;">Undertime Deduction :</td>
						<td class="tablepaytotals" style="text-align: right;"><?php echo number_format($undertime_amt,2); ?></td>
						<td></td>
						<td class="tablepaytotals" style="font-weight:500;">Pagibig :</td>
						<td class="tablepaytotals" style="text-align: right;"><?php echo number_format($pagibig,2); ?></td>
						<td></td>
						<td class="tablepaytotals" style="font-weight:500;">Total Gross :</td>
						<td class="tablepaytotals" style="text-align: right;"><?php echo number_format($gross_total,2); ?></td>
					</tr>
					<tr>
						<td colspan="6"></td>
						<td class="tablepaytotals" style="font-weight:500;">Salaries &amp; Wages :</td>
						<td class="tablepaytotals" style="text-align: right;"><?php echo number_format($net_pay,2); ?></td>
					</tr>
				</table>
			</div>
	</div>
