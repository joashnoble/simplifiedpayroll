	<style>
		td{
			font-size:  9pt!important;
			text-align: right;
			padding: 100px;
			color: black;
		}
		table th{
			background: #FFF!important;
			color: black;
			font-family: calibri;
			font-size: 10pt!important;
			text-align: right;
			width: 100px!important;
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


	<?php 			

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

			$col_no_of_hrs=0;
			$col_reg_hol=0;
			$col_sun_reg_hol=0;
			$col_spe_hol=0;
			$col_sun_spe_hol=0;
			$col_reg_ot=0;
			$col_sun_ot=0;
			$col_reg_hol_ot=0;
			$col_sun_spe_hol_ot=0;
			$col_sun_reg_hol_ot=0;
			$col_spe_hol_ot=0;
			$col_holiday_pay=0;
			$col_adjustment_additional=0;
			$col_adjustment_deduction=0;
			$col_gross_total=0;
			$col_sss_deduction=0;
			$col_wtax_deduction=0;
			$col_cash_advance=0;
			$col_net_total=0;
			$col_reg_hol_amt=0;
			$col_sun_reg_hol_amt=0;
			$col_spe_hol_amt=0;
			$col_sun_spe_hol_amt=0;
			$col_reg_ot_amt=0;
			$col_sun_ot_amt=0;
			$col_reg_hol_ot_amt=0;
			$col_sun_spe_hol_ot_amt=0;
			$col_sun_reg_hol_ot_amt=0;
			$col_spe_hol_ot_amt=0;
			$col_allowance_pay=0;
			$col_undertime=0;
			$col_undertime_amt=0;
			$col_philhealth_deduction=0;
			$col_sss_loan=0;
			$col_total_deduction=0;
			$col_basic_pay_total=0;
			$col_overtime=0;
			$col_commission=0;
			$col_late=0;
			$col_late_amt=0;
			$col_pagibig_deduction=0;
			$col_pagibig_loan=0;			

			$colspan = 0;
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


			if ($grand_no_of_hrs > 0){  $col_no_of_hrs=1; }
			if ($grand_reg_hol > 0){ $col_reg_hol=1; }
			if ($grand_sun_reg_hol > 0){ $col_sun_reg_hol=1; }
			if ($grand_spe_hol > 0){ $col_spe_hol=1; }
			if ($grand_sun_spe_hol > 0){ $col_sun_spe_hol=1; }
			if ($grand_reg_ot > 0){ $col_reg_ot=1; }
			if ($grand_sun_ot > 0){ $col_sun_ot=1; }
			if ($grand_reg_hol_ot > 0){ $col_reg_hol_ot=1; }
			if ($grand_sun_spe_hol_ot > 0){ $col_sun_spe_hol_ot=1; }
			if ($grand_sun_reg_hol_ot > 0){ $col_sun_reg_hol_ot=1; }
			if ($grand_spe_hol_ot > 0){ $col_spe_hol_ot=1; }
			if ($grand_holiday_pay > 0){ $col_holiday_pay=1; }
			if ($grand_adjustment_additional > 0){ $col_adjustment_additional=1; }
			if ($grand_adjustment_deduction > 0){ $col_adjustment_deduction=1; }
			if ($grand_gross_total > 0){ $col_gross_total=1; }
			if ($grand_sss_deduction > 0){ $col_sss_deduction=1; }
			if ($grand_wtax_deduction > 0){ $col_wtax_deduction=1; }
			if ($grand_cash_advance > 0){ $col_cash_advance=1; }
			if ($grand_net_total > 0){ $col_net_total=1; }
			if ($grand_reg_hol_amt > 0){ $col_reg_hol_amt=1; }
			if ($grand_sun_reg_hol_amt > 0){ $col_sun_reg_hol_amt=1; }
			if ($grand_spe_hol_amt > 0){ $col_spe_hol_amt=1; }
			if ($grand_sun_spe_hol_amt > 0){ $col_sun_spe_hol_amt=1; }
			if ($grand_reg_ot_amt > 0){ $col_reg_ot_amt=1; }
			if ($grand_sun_ot_amt > 0){ $col_sun_ot_amt=1; }
			if ($grand_reg_hol_ot_amt > 0){ $col_reg_hol_ot_amt=1; }
			if ($grand_sun_spe_hol_ot_amt > 0){ $col_sun_spe_hol_ot_amt=1; }
			if ($grand_sun_reg_hol_ot_amt > 0){ $col_sun_reg_hol_ot_amt=1; }
			if ($grand_spe_hol_ot_amt > 0){ $col_spe_hol_ot_amt=1; }
			if ($grand_allowance_pay > 0){ $col_allowance_pay=1; }
			if ($grand_undertime > 0){ $col_undertime=1; }
			if ($grand_undertime_amt > 0){ $col_undertime_amt=1; }
			if ($grand_philhealth_deduction > 0){ $col_philhealth_deduction=1; }
			if ($grand_sss_loan > 0){ $col_sss_loan=1; }
			if ($grand_total_deduction > 0){ $col_total_deduction=1; }
			if ($grand_basic_pay_total > 0){ $col_basic_pay_total=1; }
			if ($grand_overtime > 0){ $col_overtime=1; }
			if ($grand_commission > 0){ $col_commission=1; }
			if ($grand_late > 0){ $col_late=1; }
			if ($grand_late_amt > 0){ $col_late_amt=1; }
			if ($grand_pagibig_deduction > 0){ $col_pagibig_deduction=1; }
			if ($grand_pagibig_loan > 0){ $col_pagibig_loan=1; }			

			$colspan = 2+$col_no_of_hrs+$col_reg_hol+$col_sun_reg_hol+$col_spe_hol+$col_sun_spe_hol+$col_reg_ot+$col_sun_ot+$col_reg_hol_ot+$col_sun_spe_hol_ot+$col_sun_reg_hol_ot+$col_spe_hol_ot+$col_holiday_pay+$col_adjustment_additional+$col_adjustment_deduction+$col_gross_total+$col_sss_deduction+$col_wtax_deduction+$col_cash_advance+$col_net_total+$col_reg_hol_amt+$col_sun_reg_hol_amt+$col_spe_hol_amt+$col_sun_spe_hol_amt+$col_reg_ot_amt+$col_sun_ot_amt+$col_reg_hol_ot_amt+$col_sun_spe_hol_ot_amt+$col_sun_reg_hol_ot_amt+$col_spe_hol_ot_amt+$col_allowance_pay+$col_undertime+$col_undertime_amt+$col_philhealth_deduction+$col_sss_loan+$col_total_deduction+$col_basic_pay_total+$col_overtime+$col_commission+$col_late+$col_late_amt+$col_pagibig_deduction+$col_pagibig_loan;

			}
			?>



	<table class="tbl_payroll" width="100%">
		<thead>
			<tr>
				<th class="border-bottom" style="text-align: left;"><div style="width: 200px;">Employee</div></th>
				<th class="border-bottom">Daily Rate</th>

				<?php if($grand_no_of_hrs > 0){ ?><th class="border-bottom">Reg Hrs</th> <?php } ?>
				<?php if($grand_basic_pay_total > 0){ ?><th class="border-bottom">Basic Pay</th> <?php } ?>
				<?php if($grand_reg_hol > 0){ ?><th class="border-bottom">Legal Hol (<?php echo number_format($factor[0]->regular_holiday,2) ?>)</th> <?php } ?>
				<?php if($grand_reg_hol_amt > 0){ ?><th class="border-bottom">Legal Hol Pay</th> <?php } ?>
				<?php if($grand_sun_reg_hol > 0){ ?><th class="border-bottom">Sun Reg Hol (<?php echo number_format($factor[0]->sun_regular_holiday,2) ?>)</th> <?php } ?>
				<?php if($grand_sun_reg_hol_amt > 0){ ?><th class="border-bottom">Sun Reg Hol</th> <?php } ?>
				<?php if($grand_spe_hol > 0){ ?><th class="border-bottom">Spcl Hol (<?php echo number_format($factor[0]->spe_holiday,2) ?>)</th> <?php } ?>
				<?php if($grand_spe_hol_amt > 0){ ?><th class="border-bottom">Spcl Hol Pay</th> <?php } ?>
				<?php if($grand_sun_spe_hol > 0){ ?><th class="border-bottom">Sun Spcl Hol (<?php echo number_format($factor[0]->sun_spe_holiday,2) ?>)</th> <?php } ?>
				<?php if($grand_sun_spe_hol_amt > 0){ ?><th class="border-bottom">Sun Spcl Hol Pay</th> <?php } ?>
				<?php if($grand_holiday_pay > 0){ ?><th class="border-bottom">Total Hol Pay</th> <?php } ?>
				<?php if($grand_reg_ot > 0){ ?><th class="border-bottom">Reg OT (<?php echo number_format($factor[0]->regular_ot,2) ?>)</th> <?php } ?>
				<?php if($grand_reg_ot_amt > 0){ ?><th class="border-bottom">Reg OT Pay</th> <?php } ?>
				<?php if($grand_sun_ot > 0){ ?><th class="border-bottom">Sun OT (<?php echo number_format($factor[0]->sunday_ot,2) ?>)</th> <?php } ?>
				<?php if($grand_sun_ot_amt > 0){ ?><th class="border-bottom">Sun OT Pay</th> <?php } ?>
				<?php if($grand_reg_hol_ot > 0){ ?><th class="border-bottom">Reg Hol OT (<?php echo number_format($factor[0]->regular_holiday_ot,2) ?>)</th> <?php } ?>
				<?php if($grand_reg_hol_ot_amt > 0){ ?><th class="border-bottom">Reg Hol OT Pay</th> <?php } ?>
				<?php if($grand_sun_spe_hol_ot > 0){ ?><th class="border-bottom">Sun Spcl Hol OT (<?php echo number_format($factor[0]->sun_spe_holiday_ot,2) ?>)</th> <?php } ?>
				<?php if($grand_sun_spe_hol_ot_amt > 0){ ?><th class="border-bottom">Sun Spcl Hol OT Pay</th> <?php } ?>
				<?php if($grand_sun_reg_hol_ot > 0){ ?><th class="border-bottom">Sun Reg Hol OT (<?php echo number_format($factor[0]->sun_regular_holiday_ot,2) ?>)</th> <?php } ?>
				<?php if($grand_sun_reg_hol_ot_amt > 0){ ?><th class="border-bottom">Sun Reg Hol OT Pay</th> <?php } ?>
				<?php if($grand_spe_hol_ot > 0){ ?><th class="border-bottom">Spcl Hol OT (<?php echo number_format($factor[0]->spe_holiday_ot,2) ?>)</th> <?php } ?>
				<?php if($grand_spe_hol_ot_amt > 0){ ?><th class="border-bottom">Spcl Hol OT Pay</th> <?php } ?>
				<?php if($grand_overtime > 0){ ?><th class="border-bottom">Total OT Pay</th> <?php } ?>
				<?php if($grand_allowance_pay > 0){ ?><th class="border-bottom">Allowance</th> <?php } ?>
				<?php if($grand_undertime > 0){ ?><th class="border-bottom">Undertime (min)</th> <?php } ?>
				<?php if($grand_undertime_amt > 0){ ?><th class="border-bottom">Undertime Pay</th> <?php } ?>
				<?php if($grand_late > 0){ ?><th class="border-bottom">Late (min)</th> <?php } ?>
				<?php if($grand_late_amt > 0){ ?><th class="border-bottom">Late Pay</th> <?php } ?>
				<?php if($grand_commission > 0){ ?><th class="border-bottom">Comm/Other Pay</th> <?php } ?>
				<?php if($grand_adjustment_additional > 0){ ?><th class="border-bottom">Additional</th> <?php } ?>
				<?php if($grand_adjustment_deduction > 0){ ?><th class="border-bottom">Deduction</th> <?php } ?>
				<?php if($grand_gross_total > 0){ ?><th class="border-bottom">Grosspay</th> <?php } ?>
				<?php if($grand_sss_deduction > 0){ ?><th class="border-bottom">SSS</th> <?php } ?>
				<?php if($grand_philhealth_deduction > 0){ ?><th class="border-bottom">Philhealth</th> <?php } ?>
				<?php if($grand_pagibig_deduction > 0){ ?><th class="border-bottom">Pagibig</th> <?php } ?>
				<?php if($grand_wtax_deduction > 0){ ?><th class="border-bottom">WTAX</th> <?php } ?>
				<?php if($grand_sss_loan > 0){ ?><th class="border-bottom">SSS Loan</th> <?php } ?>
				<?php if($grand_pagibig_loan > 0){ ?><th class="border-bottom">Pagibig Loan</th> <?php } ?>
				<?php if($grand_cash_advance > 0){ ?><th class="border-bottom">Cash Advance</th> <?php } ?>
				<?php if($grand_total_deduction > 0){ ?><th class="border-bottom">Total Deduction</th> <?php } ?>
				<?php if($grand_net_total > 0){ ?><th class="border-bottom">Netpay</th> <?php } ?>

			</tr>
		</thead>
		<tbody>
			<?php $count = 1; 

			foreach($dtr as $row){

			?>
						<tr>
							<td style="text-align: left;"><?php echo $count.'. '.$row->full_name; ?></td>
							<td><?php echo number_format($row->per_day_pay,2); ?></td>

							<?php if($grand_no_of_hrs > 0){ ?> <td style="padding: 10px!important;"><?php echo number_format($row->no_of_hrs,2); ?></td> <?php } ?>
							<?php if($grand_basic_pay_total > 0){ ?> <td><?php echo number_format($row->basic_pay_total,2); ?></td> <?php } ?>
							<?php if($grand_reg_hol > 0){ ?> <td><?php echo number_format($row->reg_hol,2); ?></td> <?php } ?>
							<?php if($grand_reg_hol_amt > 0){ ?> <td><?php echo number_format($row->reg_hol_amt,2); ?></td> <?php } ?>
							<?php if($grand_sun_reg_hol > 0){ ?> <td><?php echo number_format($row->sun_reg_hol,2); ?></td> <?php } ?>
							<?php if($grand_sun_reg_hol_amt > 0){ ?> <td><?php echo number_format($row->sun_reg_hol_amt,2); ?></td> <?php } ?>
							<?php if($grand_spe_hol > 0){ ?> <td><?php echo number_format($row->spe_hol,2); ?></td> <?php } ?>
							<?php if($grand_spe_hol_amt > 0){ ?> <td><?php echo number_format($row->spe_hol_amt,2); ?></td> <?php } ?>
							<?php if($grand_sun_spe_hol > 0){ ?> <td><?php echo number_format($row->sun_spe_hol,2); ?></td> <?php } ?>
							<?php if($grand_sun_spe_hol_amt > 0){ ?> <td><?php echo number_format($row->sun_spe_hol_amt,2); ?></td> <?php } ?>
							<?php if($grand_holiday_pay > 0){ ?> <td><?php echo number_format($row->holiday_pay,2); ?></td> <?php } ?>
							<?php if($grand_reg_ot > 0){ ?> <td><?php echo number_format($row->reg_ot,2); ?></td> <?php } ?>
							<?php if($grand_reg_ot_amt > 0){ ?> <td><?php echo number_format($row->reg_ot_amt,2); ?></td> <?php } ?>
							<?php if($grand_sun_ot > 0){ ?> <td><?php echo number_format($row->sun_ot,2); ?></td> <?php } ?>
							<?php if($grand_sun_ot_amt > 0){ ?> <td><?php echo number_format($row->sun_ot_amt,2); ?></td> <?php } ?>
							<?php if($grand_reg_hol_ot > 0){ ?> <td><?php echo number_format($row->reg_hol_ot,2); ?></td> <?php } ?>
							<?php if($grand_reg_hol_ot_amt > 0){ ?> <td><?php echo number_format($row->reg_hol_ot_amt,2); ?></td> <?php } ?>
							<?php if($grand_sun_spe_hol_ot > 0){ ?> <td><?php echo number_format($row->sun_spe_hol_ot,2); ?></td> <?php } ?>
							<?php if($grand_sun_spe_hol_ot_amt > 0){ ?> <td><?php echo number_format($row->sun_spe_hol_ot_amt,2); ?></td> <?php } ?>
							<?php if($grand_sun_reg_hol_ot > 0){ ?> <td><?php echo number_format($row->sun_reg_hol_ot,2); ?></td> <?php } ?>
							<?php if($grand_sun_reg_hol_ot_amt > 0){ ?> <td><?php echo number_format($row->sun_reg_hol_ot_amt,2); ?></td> <?php } ?>
							<?php if($grand_spe_hol_ot > 0){ ?> <td><?php echo number_format($row->spe_hol_ot,2); ?></td> <?php } ?>
							<?php if($grand_spe_hol_ot_amt > 0){ ?> <td><?php echo number_format($row->spe_hol_ot_amt,2); ?></td> <?php } ?>
							<?php if($grand_overtime > 0){ ?> <td><?php echo number_format($row->overtime,2); ?></td> <?php } ?>
							<?php if($grand_allowance_pay > 0){ ?> <td><?php echo number_format($row->allowance_pay,2); ?></td> <?php } ?>
							<?php if($grand_undertime > 0){ ?> <td><?php echo number_format($row->undertime,2); ?></td> <?php } ?>
							<?php if($grand_undertime_amt > 0){ ?> <td><?php echo number_format($row->undertime_amt,2); ?></td> <?php } ?>
							<?php if($grand_late > 0){ ?> <td><?php echo number_format($row->late,2); ?></td> <?php } ?>
							<?php if($grand_late_amt > 0){ ?> <td><?php echo number_format($row->late_amt,2); ?></td> <?php } ?>
							<?php if($grand_commission > 0){ ?> <td><?php echo number_format($row->commission,2); ?></td> <?php } ?>
							<?php if($grand_adjustment_additional > 0){ ?> <td><?php echo number_format($row->adjustment_additional,2); ?></td> <?php } ?>
							<?php if($grand_adjustment_deduction > 0){ ?> <td><?php echo number_format($row->adjustment_deduction,2); ?></td> <?php } ?>
							<?php if($grand_gross_total > 0){ ?> <td><b><?php echo number_format($row->gross_total,2); ?></b></td> <?php } ?>
							<?php if($grand_sss_deduction > 0){ ?> <td><?php echo number_format($row->sss_deduction,2); ?></td> <?php } ?>
							<?php if($grand_philhealth_deduction > 0){ ?> <td><?php echo number_format($row->philhealth_deduction,2); ?></td> <?php } ?>
							<?php if($grand_pagibig_deduction > 0){ ?> <td><?php echo number_format($row->pagibig_deduction,2); ?></td> <?php } ?>
							<?php if($grand_wtax_deduction > 0){ ?> <td><?php echo number_format($row->wtax_deduction,2); ?></td> <?php } ?>
							<?php if($grand_sss_loan > 0){ ?> <td><?php echo number_format($row->sss_loan,2); ?></td> <?php } ?>
							<?php if($grand_pagibig_loan > 0){ ?> <td><?php echo number_format($row->pagibig_loan,2); ?></td> <?php } ?>
							<?php if($grand_cash_advance > 0){ ?> <td><?php echo number_format($row->cash_advance,2); ?></td> <?php } ?>
							<?php if($grand_total_deduction > 0){ ?> <td><?php echo number_format($row->total_deduction,2); ?></td> <?php } ?>
							<?php if($grand_net_total > 0){ ?> <td><b><?php echo number_format($row->net_total,2); ?></b></td> <?php } ?>
						</tr>
			<?php $count++; }?>
						<tr>
							<td colspan="<?php echo $colspan; ?>" style="background: lightgray!important;">
								<center><b>GRAND TOTAL</b></center>
							</td>
						</tr>
							<td style="padding: 20px;"></td>
							<td></td>
							<?php if($grand_no_of_hrs > 0){ ?> <td style="padding: 10px!important;"><b><?php echo number_format($grand_no_of_hrs,2); ?></b></td> <?php } ?>
							<?php if($grand_basic_pay_total > 0){ ?> <td><b><?php echo number_format($grand_basic_pay_total,2); ?></b></td> <?php } ?>
							<?php if($grand_reg_hol > 0){ ?> <td><b><?php echo number_format($grand_reg_hol,2); ?></b></td> <?php } ?>
							<?php if($grand_reg_hol_amt > 0){ ?> <td><b><?php echo number_format($grand_reg_hol_amt,2); ?></b></td> <?php } ?>
							<?php if($grand_sun_reg_hol > 0){ ?> <td><b><?php echo number_format($grand_sun_reg_hol,2); ?></b></td> <?php } ?>
							<?php if($grand_sun_reg_hol_amt > 0){ ?> <td><b><?php echo number_format($grand_sun_reg_hol_amt,2); ?></b></td> <?php } ?>
							<?php if($grand_spe_hol > 0){ ?> <td><b><?php echo number_format($grand_spe_hol,2); ?></b></td> <?php } ?>
							<?php if($grand_spe_hol_amt > 0){ ?> <td><b><?php echo number_format($grand_spe_hol_amt,2); ?></b></td> <?php } ?>
							<?php if($grand_sun_spe_hol > 0){ ?> <td><b><?php echo number_format($grand_sun_spe_hol,2); ?></b></td> <?php } ?>
							<?php if($grand_sun_spe_hol_amt > 0){ ?> <td><b><?php echo number_format($grand_sun_spe_hol_amt,2); ?></b></td> <?php } ?>
							<?php if($grand_holiday_pay > 0){ ?> <td><b><?php echo number_format($grand_holiday_pay,2); ?></b></td> <?php } ?>
							<?php if($grand_reg_ot > 0){ ?> <td><b><?php echo number_format($grand_reg_ot,2); ?></b></td> <?php } ?>
							<?php if($grand_reg_ot_amt > 0){ ?> <td><b><?php echo number_format($grand_reg_ot_amt,2); ?></b></td> <?php } ?>
							<?php if($grand_sun_ot > 0){ ?> <td><b><?php echo number_format($grand_sun_ot,2); ?></b></td> <?php } ?>
							<?php if($grand_sun_ot_amt > 0){ ?> <td><b><?php echo number_format($grand_sun_ot_amt,2); ?></b></td> <?php } ?>
							<?php if($grand_reg_hol_ot > 0){ ?> <td><b><?php echo number_format($grand_reg_hol_ot,2); ?></b></td> <?php } ?>
							<?php if($grand_reg_hol_ot_amt > 0){ ?> <td><b><?php echo number_format($grand_reg_hol_ot_amt,2); ?></b></td> <?php } ?>
							<?php if($grand_sun_spe_hol_ot > 0){ ?> <td><b><?php echo number_format($grand_sun_spe_hol_ot,2); ?></b></td> <?php } ?>
							<?php if($grand_sun_spe_hol_ot_amt > 0){ ?> <td><b><?php echo number_format($grand_sun_spe_hol_ot_amt,2); ?></b></td> <?php } ?>
							<?php if($grand_sun_reg_hol_ot > 0){ ?> <td><b><?php echo number_format($grand_sun_reg_hol_ot,2); ?></b></td> <?php } ?>
							<?php if($grand_sun_reg_hol_ot_amt > 0){ ?> <td><b><?php echo number_format($grand_sun_reg_hol_ot_amt,2); ?></b></td> <?php } ?>
							<?php if($grand_spe_hol_ot > 0){ ?> <td><b><?php echo number_format($grand_spe_hol_ot,2); ?></b></td> <?php } ?>
							<?php if($grand_spe_hol_ot_amt > 0){ ?> <td><b><?php echo number_format($grand_spe_hol_ot_amt,2); ?></b></td> <?php } ?>
							<?php if($grand_overtime > 0){ ?> <td><b><?php echo number_format($grand_overtime,2); ?></b></td> <?php } ?>
							<?php if($grand_allowance_pay > 0){ ?> <td><b><?php echo number_format($grand_allowance_pay,2); ?></b></td> <?php } ?>
							<?php if($grand_undertime > 0){ ?> <td><b><?php echo number_format($grand_undertime,2); ?></b></td> <?php } ?>
							<?php if($grand_undertime_amt > 0){ ?> <td><b><?php echo number_format($grand_undertime_amt,2); ?></b></td> <?php } ?>
							<?php if($grand_late > 0){ ?> <td><b><?php echo number_format($grand_late,2); ?></b></td> <?php } ?>
							<?php if($grand_late_amt > 0){ ?> <td><b><?php echo number_format($grand_late_amt,2); ?></b></td> <?php } ?>
							<?php if($grand_commission > 0){ ?> <td><b><?php echo number_format($grand_commission,2); ?></b></td> <?php } ?>
							<?php if($grand_adjustment_additional > 0){ ?> <td><b><?php echo number_format($grand_adjustment_additional,2); ?></b></td> <?php } ?>
							<?php if($grand_adjustment_deduction > 0){ ?> <td><b><?php echo number_format($grand_adjustment_deduction,2); ?></b></td> <?php } ?>
							<?php if($grand_gross_total > 0){ ?> <td><b><?php echo number_format($grand_gross_total,2); ?></b></td> <?php } ?>
							<?php if($grand_sss_deduction > 0){ ?> <td><b><?php echo number_format($grand_sss_deduction,2); ?></b></td> <?php } ?>
							<?php if($grand_philhealth_deduction > 0){ ?> <td><b><?php echo number_format($grand_philhealth_deduction,2); ?></b></td> <?php } ?>
							<?php if($grand_pagibig_deduction > 0){ ?> <td><b><?php echo number_format($grand_pagibig_deduction,2); ?></b></td> <?php } ?>
							<?php if($grand_wtax_deduction > 0){ ?> <td><b><?php echo number_format($grand_wtax_deduction,2); ?></b></td> <?php } ?>
							<?php if($grand_sss_loan > 0){ ?> <td><b><?php echo number_format($grand_sss_loan,2); ?></b></td> <?php } ?>
							<?php if($grand_pagibig_loan > 0){ ?> <td><b><?php echo number_format($grand_pagibig_loan,2); ?></b></td> <?php } ?>
							<?php if($grand_cash_advance > 0){ ?> <td><b><?php echo number_format($grand_cash_advance,2); ?></b></td> <?php } ?>
							<?php if($grand_total_deduction > 0){ ?> <td><b><?php echo number_format($grand_total_deduction,2); ?></b></td> <?php } ?>
							<?php if($grand_net_total > 0){ ?> <td><b><?php echo number_format($grand_net_total,2); ?></b></td> <?php } ?>
		</tbody>

	</table>

	<?php }else{ ?>
		<div style="padding: 100px;">	
			<center>
				No Result Found
			</center>
	<?php  } ?>
	</div>
