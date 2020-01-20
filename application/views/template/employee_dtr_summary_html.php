	<style>
		td{
			font-size: 8pt!important;
			text-align: right;
			color: black;
		}
		table th{
			background: #FFF!important;
			color: black;
			font-family: calibri;
			font-size: 7pt!important;
			text-align: right;
		}		
		.border-bottom{
			border-bottom: 1px solid black;
		}

		.border-top{
			border-top: 1px solid black;
		}
	</style>
	<?php if($type == "print"){ ?>
		<div style="font-size: 9pt; width: 100%;">
			<div class="temp_header">
			<?php include 'template_header.php';?>
				<b>DTR Summary</b> <br />
				<b>Pay Period : </b> <?php  echo $period[0]->period;?> </br >
				<b>Branch : </b> <?php echo $get_branch; ?> <br />
				<b>Department : </b> <?php echo $get_department; ?>
			</div>
			<hr>
		</div>
	<?php } ?>

	<?php if(count($dtr) > 0){ ?>

	<table width="100%">
		<thead>
			<tr>
				<th></th>
				<th></th>
				<th>
					(<?php echo number_format($factor[0]->regular_holiday,2) ?>)
				</th>
				<th>
					(<?php echo number_format($factor[0]->sun_regular_holiday,2) ?>)
				</th>
				<th>
					(<?php echo number_format($factor[0]->spe_holiday,2) ?>)
				</th>
				<th>
					(<?php echo number_format($factor[0]->sun_spe_holiday,2) ?>)
				</th>
				<th>
					(<?php echo number_format($factor[0]->regular_ot,2) ?>)
				</th>
				<th>
					(<?php echo number_format($factor[0]->sunday_ot,2) ?>)
				</th>
				<th>
					(<?php echo number_format($factor[0]->regular_holiday_ot,2) ?>)
				</th>
				<th>
					(<?php echo number_format($factor[0]->sun_spe_holiday_ot,2) ?>)
				</th>
				<th>
					(<?php echo number_format($factor[0]->sun_regular_holiday_ot,2) ?>)
				</th>
				<th>
					(<?php echo number_format($factor[0]->spe_holiday_ot,2) ?>)
				</th>
				<th colspan="9"></th>				
			</tr>
			<tr>
				<th style="text-align: left;"><div style="width: 150px;">&nbsp;</div></th>
				<th>Reg Hrs</th>

				<th>Legal Hol</th>
				<th>Sun Reg Hol</th>
				<th>Spcl Hol</th>
				<th>Sun Spcl Hol</th>
				<th>Reg OT</th>
				<th>Sun OT</th>
				<th>Reg Hol OT</th>
				<th>Sun Spcl Hol OT</th>
				<th>Sun Reg Hol OT</th>
				<th>Spcl Hol OT</th>


				<th>Total Hol Pay</th>

				<th>Additional</th>
				<th>Deduction</th>

				<th><div style="width: 50px!important;">Grosspay</div></th>

				<th>SSS</th>
				<th>WTAX</th>
				<th>Cash Advance</th>
				<th style="width: 50px;">Netpay</th>
			</tr>
			<tr>
				<th></th>
				<th>Daily Rate</th>

				<th>Amt</th>
				<th>Amt</th>
				<th>Amt</th>
				<th>Amt</th>
				<th>Amt</th>
				<th>Amt</th>
				<th>Amt</th>
				<th>Amt</th>
				<th>Amt</th>
				<th>Amt</th>

				<th>Allowance</th>


				<th>Undertime (min)</th>
				<th>Undertime Pay</th>

				<th></th>
				<th>Philhealth</th>
				<th>SSS Loan</th>
				<th>Total Deduction</th>
			</tr>
			<tr>
				<th class="border-bottom" style="text-align: left;">Employee</th>
				<th class="border-bottom">Basic Pay</th>


				<th class="border-bottom" colspan="9"></th>

				<th class="border-bottom">Total OT Pay</th>

				<th class="border-bottom">Comm/Other Pay</th>
				<th class="border-bottom">Late (min)</th>
				<th class="border-bottom">Late Pay</th>
				<th class="border-bottom"></th>
				<th class="border-bottom">Pagibig</th>
				<th class="border-bottom">Pagibig Loan</th>
				<th class="border-bottom"></th>
				<th class="border-bottom"></th>
			</tr>
		</thead>
		<tbody>
			<?php $count = 1; 

			$grand_no_of_hrs=0;
			$grand_reg_hol=0;
			$grand_sun_reg_hol=0;
			$grand_spe_hol=0;
			$grand_sun_spe_hol=0;
			$grand_reg_ot=0;
			$grand_sun_ot=0;
			$grand_reg_hol_ot=0;
			$grand_sun_spe_hol_ot=0;
			$grand_sun_reg_hol_ot=0;
			$grand_spe_hol_ot=0;
			$grand_holiday_pay=0;
			$grand_adjustment_additional=0;
			$grand_adjustment_deduction=0;
			$grand_gross_total=0;
			$grand_sss_deduction=0;
			$grand_wtax_deduction=0;
			$grand_cash_advance=0;
			$grand_net_total=0;

			$grand_reg_hol_amt=0;
			$grand_sun_reg_hol_amt=0;
			$grand_spe_hol_amt=0;
			$grand_sun_spe_hol_amt=0;
			$grand_reg_ot_amt=0;
			$grand_sun_ot_amt=0;
			$grand_reg_hol_ot_amt=0;
			$grand_sun_spe_hol_ot_amt=0;
			$grand_sun_reg_hol_ot_amt=0;
			$grand_spe_hol_ot_amt=0;
			$grand_allowance_pay=0;
			$grand_undertime=0;
			$grand_undertime_amt=0;
			$grand_philhealth_deduction=0;
			$grand_sss_loan=0;
			$grand_total_deduction=0;

			$grand_basic_pay_total=0;
			$grand_overtime=0;
			$grand_commission=0;
			$grand_late=0;
			$grand_late_amt=0;
			$grand_pagibig_deduction=0;
			$grand_pagibig_loan=0;

			foreach($dtr as $row){

			$grand_no_of_hrs += $row->no_of_hrs;
			$grand_reg_hol += $row->reg_hol;
			$grand_sun_reg_hol += $row->sun_reg_hol;
			$grand_spe_hol += $row->spe_hol;
			$grand_sun_spe_hol += $row->sun_spe_hol;
			$grand_reg_ot += $row->reg_ot;
			$grand_sun_ot += $row->sun_ot;
			$grand_reg_hol_ot += $row->reg_hol_ot;
			$grand_sun_spe_hol_ot += $row->sun_spe_hol_ot;
			$grand_sun_reg_hol_ot += $row->sun_reg_hol_ot;
			$grand_spe_hol_ot += $row->spe_hol_ot;
			$grand_holiday_pay += $row->holiday_pay;
			$grand_adjustment_additional += $row->adjustment_additional;
			$grand_adjustment_deduction += $row->adjustment_deduction;
			$grand_gross_total += $row->gross_total;
			$grand_sss_deduction += $row->sss_deduction;
			$grand_wtax_deduction += $row->wtax_deduction;
			$grand_cash_advance += $row->cash_advance;
			$grand_net_total += $row->net_total;

			$grand_reg_hol_amt += $row->reg_hol_amt;
			$grand_sun_reg_hol_amt += $row->sun_reg_hol_amt;
			$grand_spe_hol_amt += $row->spe_hol_amt;
			$grand_sun_spe_hol_amt += $row->sun_spe_hol_amt;
			$grand_reg_ot_amt += $row->reg_ot_amt;
			$grand_sun_ot_amt += $row->sun_ot_amt;
			$grand_reg_hol_ot_amt += $row->reg_hol_ot_amt;
			$grand_sun_spe_hol_ot_amt += $row->sun_spe_hol_ot_amt;
			$grand_sun_reg_hol_ot_amt += $row->sun_reg_hol_ot_amt;
			$grand_spe_hol_ot_amt += $row->spe_hol_ot_amt;
			$grand_allowance_pay += $row->allowance_pay;
			$grand_undertime += $row->undertime;
			$grand_undertime_amt += $row->undertime_amt;
			$grand_philhealth_deduction += $row->philhealth_deduction;
			$grand_sss_loan += $row->sss_loan;
			$grand_total_deduction += $row->total_deduction;

			$grand_basic_pay_total += $row->basic_pay_total;
			$grand_overtime += $row->overtime;
			$grand_commission += $row->commission;
			$grand_late += $row->late;
			$grand_late_amt += $row->late_amt;
			$grand_pagibig_deduction += $row->pagibig_deduction;
			$grand_pagibig_loan += $row->pagibig_loan;

			?>

						<tr>
							<td style="text-align: left;font-size: 9pt!important;"><?php echo $count.'. '.$row->full_name; ?></td>
							<td style="padding: 5px!important;"><?php echo number_format($row->no_of_hrs,2); ?></td>

							<td><?php echo number_format($row->reg_hol,2); ?></td>
							<td><?php echo number_format($row->sun_reg_hol,2); ?></td>
							<td><?php echo number_format($row->spe_hol,2); ?></td>
							<td><?php echo number_format($row->sun_spe_hol,2); ?></td>
							<td><?php echo number_format($row->reg_ot,2); ?></td>
							<td><?php echo number_format($row->sun_ot,2); ?></td>
							<td><?php echo number_format($row->reg_hol_ot,2); ?></td>
							<td><?php echo number_format($row->sun_spe_hol_ot,2); ?></td>
							<td><?php echo number_format($row->sun_reg_hol_ot,2); ?></td>
							<td><?php echo number_format($row->spe_hol_ot,2); ?></td>

							<td><?php echo number_format($row->holiday_pay,2); ?></td>
							<td><?php echo number_format($row->adjustment_additional,2); ?></td>
							<td><?php echo number_format($row->adjustment_deduction,2); ?></td>
							<td><?php echo number_format($row->gross_total,2); ?></td>
							<td><?php echo number_format($row->sss_deduction,2); ?></td>
							<td><?php echo number_format($row->wtax_deduction,2); ?></td>
							<td><?php echo number_format($row->cash_advance,2); ?></td>
							<td><?php echo number_format($row->net_total,2); ?></td>

						</tr>
						<tr>
							<td></td>
							<td><?php echo number_format($row->per_day_pay,2); ?></td>

							<td><?php echo number_format($row->reg_hol_amt,2); ?></td>
							<td><?php echo number_format($row->sun_reg_hol_amt,2); ?></td>
							<td><?php echo number_format($row->spe_hol_amt,2); ?></td>
							<td><?php echo number_format($row->sun_spe_hol_amt,2); ?></td>
							<td><?php echo number_format($row->reg_ot_amt,2); ?></td>
							<td><?php echo number_format($row->sun_ot_amt,2); ?></td>
							<td><?php echo number_format($row->reg_hol_ot_amt,2); ?></td>
							<td><?php echo number_format($row->sun_spe_hol_ot_amt,2); ?></td>
							<td><?php echo number_format($row->sun_reg_hol_ot_amt,2); ?></td>
							<td><?php echo number_format($row->spe_hol_ot_amt,2); ?></td>

							<td><?php echo number_format($row->allowance_pay,2); ?></td>
							<td><?php echo number_format($row->undertime,2); ?></td>
							<td><?php echo number_format($row->undertime_amt,2); ?></td>
							<td></td>
							<td><?php echo number_format($row->philhealth_deduction,2); ?></td>
							<td><?php echo number_format($row->sss_loan,2); ?></td>
							<td><?php echo number_format($row->total_deduction,2); ?></td>
							<td></td>
						</tr>
						<tr>
							<td></td>
							<td><?php echo number_format($row->basic_pay_total,2); ?></td>
							<td colspan="9"></td>
							<td><?php echo number_format($row->overtime,2); ?></td>

							<td><?php echo number_format($row->commission,2); ?></td>

							<td><?php echo number_format($row->late,2); ?></td>
							<td><?php echo number_format($row->late_amt,2); ?></td>
							<td></td>
							<td><?php echo number_format($row->pagibig_deduction,2); ?></td>
							<td><?php echo number_format($row->pagibig_loan,2); ?></td>
							<td></td>
							<td></td>
						</tr>
			<?php $count++; }?>
						<tr>
							<td colspan="20" style="background: lightgray!important;">
								<center><b>GRAND TOTAL</b></center>
							</td>
						</tr>
						<tr>
							<td></td>
							<td style="padding: 5px!important;"><b><?php echo number_format($grand_no_of_hrs,2); ?></b></td>
							<td style="padding-right: 2px!important;font-size: 8pt!important;"><b><?php echo number_format($grand_reg_hol,2); ?></b></td>
							<td style="padding-right: 2px!important;font-size: 8pt!important;"><b><?php echo number_format($grand_sun_reg_hol,2); ?></b></td>
							<td style="padding-right: 2px!important;font-size: 8pt!important;"><b><?php echo number_format($grand_spe_hol,2); ?></b></td>
							<td style="padding-right: 2px!important;font-size: 8pt!important;"><b><?php echo number_format($grand_sun_spe_hol,2); ?></b></td>
							<td style="padding-right: 2px!important;font-size: 8pt!important;"><b><?php echo number_format($grand_reg_ot,2); ?></b></td>
							<td style="padding-right: 2px!important;font-size: 8pt!important;"><b><?php echo number_format($grand_sun_ot,2); ?></b></td>
							<td style="padding-right: 2px!important;font-size: 8pt!important;"><b><?php echo number_format($grand_reg_hol_ot,2); ?></b></td>
							<td style="padding-right: 2px!important;font-size: 8pt!important;"><b><?php echo number_format($grand_sun_spe_hol_ot,2); ?></b></td>
							<td style="padding-right: 2px!important;font-size: 8pt!important;"><b><?php echo number_format($grand_sun_reg_hol_ot,2); ?></b></td>
							<td style="padding-right: 2px!important;font-size: 8pt!important;"><b><?php echo number_format($grand_spe_hol_ot,2); ?></b></td>
							<td style="padding-right: 2px!important;font-size: 8pt!important;"><b><?php echo number_format($grand_holiday_pay,2); ?></b></td>
							<td style="padding-right: 2px!important;font-size: 8pt!important;"><b><?php echo number_format($grand_adjustment_additional,2); ?></b></td>
							<td style="padding-right: 2px!important;font-size: 8pt!important;"><b><?php echo number_format($grand_adjustment_deduction,2); ?></b></td>
							<td style="padding-right: 2px!important;font-size: 8pt!important;"><b><?php echo number_format($grand_gross_total,2); ?></b></td>
							<td style="padding-right: 2px!important;font-size: 8pt!important;"><b><?php echo number_format($grand_sss_deduction,2); ?></b></td>
							<td style="padding-right: 2px!important;font-size: 8pt!important;"><b><?php echo number_format($grand_wtax_deduction,2); ?></b></td>
							<td style="padding-right: 2px!important;font-size: 8pt!important;"><b><?php echo number_format($grand_cash_advance,2); ?></b></td>
							<td style="padding-right: 2px!important;font-size: 8pt!important;"><b><?php echo number_format($grand_net_total,2); ?></b></td>
						</tr>
						<tr>
							<td style="font-size: 8pt!important;"></td>
							<td style="font-size: 8pt!important;"><b><?php echo number_format(0,2); ?></b></td>
							<td style="font-size: 8pt!important;"><b><?php echo number_format($grand_reg_hol_amt,2); ?></b></td>
							<td style="font-size: 8pt!important;"><b><?php echo number_format($grand_sun_reg_hol_amt,2); ?></b></td>
							<td style="font-size: 8pt!important;"><b><?php echo number_format($grand_spe_hol_amt,2); ?></b></td>
							<td style="font-size: 8pt!important;"><b><?php echo number_format($grand_sun_spe_hol_amt,2); ?></b></td>
							<td style="font-size: 8pt!important;"><b><?php echo number_format($grand_reg_ot_amt,2); ?></b></td>
							<td style="font-size: 8pt!important;"><b><?php echo number_format($grand_sun_ot_amt,2); ?></b></td>
							<td style="font-size: 8pt!important;"><b><?php echo number_format($grand_reg_hol_ot_amt,2); ?></b></td>
							<td style="font-size: 8pt!important;"><b><?php echo number_format($grand_sun_spe_hol_ot_amt,2); ?></b></td>
							<td style="font-size: 8pt!important;"><b><?php echo number_format($grand_sun_reg_hol_ot_amt,2); ?></b></td>
							<td style="font-size: 8pt!important;"><b><?php echo number_format($grand_spe_hol_ot_amt,2); ?></b></td>
							<td style="font-size: 8pt!important;"><b><?php echo number_format($grand_allowance_pay,2); ?></b></td>
							<td style="font-size: 8pt!important;"><b><?php echo number_format($grand_undertime,2); ?></b></td>
							<td style="font-size: 8pt!important;"><b><?php echo number_format($grand_undertime_amt,2); ?></b></td>
							<td style="font-size: 8pt!important;"></td>
							<td style="font-size: 8pt!important;"><b><?php echo number_format($grand_philhealth_deduction,2); ?></b></td>
							<td style="font-size: 8pt!important;"><b><?php echo number_format($grand_sss_loan,2); ?></b></td>
							<td style="font-size: 8pt!important;"><b><?php echo number_format($grand_total_deduction,2); ?></b></td>
							<td style="font-size: 8pt!important;"></td>
						</tr>
						<tr>
							<td style="font-size: 8pt!important"></td>
							<td style="font-size: 8pt!important"><b><?php echo number_format($grand_basic_pay_total,2); ?></b></td>
							<td style="font-size: 8pt!important" colspan="9"></td>
							<td style="font-size: 8pt!important"><b><?php echo number_format($grand_overtime,2); ?></b></td>
							<td style="font-size: 8pt!important"><b><?php echo number_format($grand_commission,2); ?></b></td>
							<td style="font-size: 8pt!important"><b><?php echo number_format($grand_late,2); ?></b></td>
							<td style="font-size: 8pt!important"><b><?php echo number_format($grand_late_amt,2); ?></b></td>
							<td style="font-size: 8pt!important"></td>
							<td style="font-size: 8pt!important"><b><?php echo number_format($grand_pagibig_deduction,2); ?></b></td>
							<td style="font-size: 8pt!important"><b><?php echo number_format($grand_pagibig_loan,2); ?></b></td>
							<td style="font-size: 8pt!important"></td>
							<td style="font-size: 8pt!important"></td>
						</tr>
		</tbody>

	</table>

	<?php }else{ ?>
		<div style="padding: 100px;">	
			<center>
				No Result Found
			</center>
		</div>
	<?php  } ?>
	</div>
