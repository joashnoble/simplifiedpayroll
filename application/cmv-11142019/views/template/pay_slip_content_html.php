<style>
    #tbl_payslip_content{
		border-collapse: collapse;
		width: 100%;
		max-width: 100%;
		border-spacing: 0;
		font-family: calibri;
		page-break-inside:avoid;
		font-size: 9pt;
  	}
  	#tbl_payslip_content tr:hover, #tbl_payslip_content td, #tbl_payslip_content td, #tbl_payslip_content tr:nth-child(even), #tbl_payslip_content tr:nth-child(odd){
  		background: none!important;
  	}

    #tbl_payslip_content td, #tbl_payslip_content th{
        cursor: context-menu!important;
    }

	.theader-right{
		vertical-align: baseline;
		font-size: 10pt;
	}
	.PaySlip{
		width:100%;
	}
	.tdpaddingleft{
		padding-left: 100px!important;
	}
	.tdpaddingright{
		padding-right: 100px!important;
	}	
	.tdheader{
		padding-left: 50px!important;
		padding-right: 70px!important;
	}
	hr{
		border-bottom: 1px solid gray!important;
		margin-top: 0px!important;
		margin-bottom: 0px!important;
	}
	.trborderleft{
		border-left: 1px solid gray;
	}
	.trborder{
		border-top: 1px solid gray;
		border-right: 1px solid gray;
		border-left: 1px solid gray;
	}
	.trborderleftbottom{
		border-bottom: 1px solid gray;
		border-left: 1px solid gray;
	}
	.trborderleftbottomtop{
		border-bottom: 1px solid gray;
		border-left: 1px solid gray;
		border-top: 1px solid gray;
	}
	.trborderleftbottomtopright{
		border-bottom: 1px solid gray;
		border-left: 1px dashed gray;
		border-top: 1px solid gray;
	}
	.paddingleft10{
		padding-left: 10px!important; 
	}
</style>
<div class="PaySlip">
	<?php 
		if ($payslip->adjustment_additional != 0.00 OR $payslip->adjustment_deduction != 0.00){ 
			if ($payslip->undertime_amt != 0.00 OR $payslip->late_amt != 0.00){
				$total_rowspan = 12;
			}else{
				$total_rowspan = 11;
			}
		}else{ 
			if ($payslip->undertime_amt != 0.00 OR $payslip->late_amt != 0.00){
				$total_rowspan = 9;
			}else{
				$total_rowspan = 8;
			}
		}
		if ($payslip->overtime != 0.00){ $total_rowspan = $total_rowspan + 1; }
		if ($payslip->holiday_pay != 0.00){ $total_rowspan = $total_rowspan + 1; }
		if ($payslip->allowance_pay != 0.00){ $total_rowspan = $total_rowspan + 1; }
		if ($payslip->adjustment_additional != 0.00){ $total_rowspan + 1; }
		if ($payslip->adjustment_deduction != 0.00){ $total_rowspan + 1; }
		if ($payslip->commission != 0.00){ $total_rowspan = $total_rowspan + 1; }
		if ($payslip->undertime_amt != 0.00){ $total_rowspan = $total_rowspan + 1; }
		if ($payslip->late_amt != 0.00){ $total_rowspan = $total_rowspan + 1; }
		if ($payslip->sss_deduction != 0.00){ $total_rowspan = $total_rowspan + 1; }
		if ($payslip->pagibig_deduction != 0.00){ $total_rowspan = $total_rowspan + 1; }
		if ($payslip->philhealth_deduction != 0.00){ $total_rowspan = $total_rowspan + 1; }
		if ($payslip->wtax_deduction != 0.00){ $total_rowspan = $total_rowspan + 1; }
		if ($payslip->sss_loan != 0.00){ $total_rowspan = $total_rowspan + 1; }
		if ($payslip->pagibig_loan != 0.00){ $total_rowspan = $total_rowspan + 1; }
		if ($payslip->cash_advance != 0.00){ $total_rowspan = $total_rowspan + 1; }
	?>
	<table id="tbl_payslip_content">
		<tr class="trborder">
			<td class="paddingleft10">Name: <?php echo $payslip->full_name; ?></td>
			<td colspan="2">Department : <?php echo $payslip->department; ?></td>
			<td rowspan="<?php echo $total_rowspan; ?>" style="width: 200px!important;" class="theader-right trborderleftbottomtopright">
				<div>
					<center>
					<br />
					<div>
						<b>Payslip # :</b> <br />
						<?php echo $payslip->payslip_no; ?>
					</div>
					<br />
					<div style="margin-top: 10px;">	
						<b>Name of Employee :</b> <br />
						<?php echo $payslip->full_name; ?>
					</div>
					<br />
					<center>
						<hr width="80%" style="border: 0.5px solid gray!important;">
					</center>
					<div style="margin-top: 20px;">
						<b>Department :</b> <br />
						<?php echo $payslip->department; ?>
					</div><br />
					<div style="margin-top: 10px;">
						<b>Period Covered :</b> <br />
						<?php echo $payslip->payperiod; ?>
					</div>
					<br />
					<div style="margin-top: 10px;">
						<center><hr width="80%" style="border: 0.5px solid gray!important;"></center>
						Signature
					</div>
				</center>
				</div>
			</td>
		</tr>
		<tr class="trborderleft">
			<td class="paddingleft10">Payslip # : <?php echo $payslip->payslip_no; ?></td>
			<td colspan="2" class="tdpaddingright">Period Covered : <?php echo $payslip->payperiod; ?></td>
		</tr>
		<tr class="trborderleftbottomtop" style="background: #ECEFF1!important;">
			<td colspan="2" class="tdheader"><strong>Earnings</strong></td>
		</tr>
		<tr class="trborderleft">
			<td class="tdpaddingleft">Basic Pay</td>
			<td align="right" class="tdpaddingright"><?php echo number_format($payslip->basic_pay_total,2); ?></td>
		</tr>
		<?php if($payslip->overtime != 0.00){ ?>
		<tr class="trborderleft">
			<td class="tdpaddingleft">Overtime</td>
			<td align="right" class="tdpaddingright"><?php echo number_format($payslip->overtime,2); ?></td>
		</tr class="trborderleft">
		<?php }?>
		<?php if ($payslip->holiday_pay != 0.00){ ?>
		<tr class="trborderleft">
			<td class="tdpaddingleft">Holiday Pay</td>
			<td align="right" class="tdpaddingright"><?php echo number_format($payslip->holiday_pay,2); ?></td>
		</tr>
		<?php }?>
		<?php if ($payslip->allowance_pay != 0.00){ ?>
		<tr class="trborderleft">
			<td class="tdpaddingleft">Allowance Pay</td>
			<td align="right" class="tdpaddingright"><?php echo number_format($payslip->allowance_pay,2); ?></td>
		</tr>
		<?php }?>
		<?php if ($payslip->commission != 0.00){ ?>
		<tr class="trborderleft">
			<td class="tdpaddingleft">Commission / Other Pay</td>
			<td align="right" class="tdpaddingright"><?php echo number_format($payslip->commission,2); ?></td>
		</tr>
		<?php }?>
		<?php if ($payslip->undertime_amt != 0.00 OR $payslip->late_amt != 0.00){?>
		<tr class="trborderleftbottomtop" style="background: #ECEFF1!important;">
			<td colspan="2" class="tdheader"><strong>Deduction (Undertime &amp; Late)</strong></td>
		</tr>
		<?php if ($payslip->undertime_amt != 0.00){ ?>
		<tr class="trborderleft">
			<td class="tdpaddingleft">Undertime Amount</td>
			<td align="right" class="tdpaddingright"><?php echo number_format($payslip->undertime_amt,2); ?></td>
		</tr>
		<?php }?>
		<?php if ($payslip->late_amt != 0.00){ ?>
		<tr class="trborderleft">
			<td class="tdpaddingleft">Late Amount</td>
			<td align="right" class="tdpaddingright"><?php echo number_format($payslip->late_amt,2); ?></td>
		</tr>
		<?php }?>
		<?php }?>
		<?php if ($payslip->adjustment_additional != 0.00 OR $payslip->adjustment_deduction != 0.00){?>
		<tr class="trborderleftbottomtop" style="background: #ECEFF1!important;">
			<td colspan="2" class="tdheader"><strong>Adjustment</strong></td>
		</tr>
		<?php if ($payslip->adjustment_additional != 0.00){ ?>
		<tr class="trborderleft">
			<td class="tdpaddingleft">Additional</td>
			<td align="right" class="tdpaddingright"><?php echo number_format($payslip->adjustment_additional,2); ?></td>
		</tr>
		<?php }?>
		<?php if ($payslip->adjustment_deduction != 0.00){ ?>
		<tr class="trborderleft">
			<td class="tdpaddingleft">Deduction</td>
			<td align="right" class="tdpaddingright"><?php echo number_format($payslip->adjustment_deduction,2); ?></td>
		</tr>
		<?php }?>
		<?php }?>
		<tr class="trborderleftbottomtop">
			<td colspan="2" align="right" class="tdpaddingright"><strong>Gross Total :</strong> <?php echo number_format($payslip->gross_total,2); ?></td>
		</tr>
		<tr class="trborderleftbottomtop" style="background: #ECEFF1!important;">
			<td colspan="2" class="tdheader"><strong>Deduction</strong></td>
		</tr>
		<?php if ($payslip->sss_deduction != 0.00){ ?>
		<tr class="trborderleft">
			<td class="tdpaddingleft">SSS</td>
			<td align="right" class="tdpaddingright"><?php echo number_format($payslip->sss_deduction,4); ?></td>
		</tr>
		<?php } ?>
		<?php if ($payslip->philhealth_deduction != 0.00){ ?>
		<tr class="trborderleft">
			<td class="tdpaddingleft">Philhealth</td>
			<td align="right" class="tdpaddingright"><?php echo number_format($payslip->philhealth_deduction,4); ?></td>
		</tr>
		<?php } ?>
		<?php if ($payslip->pagibig_deduction != 0.00){ ?>
		<tr class="trborderleft">
			<td class="tdpaddingleft">Pagibig</td>
			<td align="right" class="tdpaddingright"><?php echo number_format($payslip->pagibig_deduction,4); ?></td>
		</tr>
		<?php } ?>
		<?php if ($payslip->wtax_deduction != 0.00){ ?>
		<tr class="trborderleft">
			<td class="tdpaddingleft">WTAX</td>
			<td align="right" class="tdpaddingright"><?php echo number_format($payslip->wtax_deduction,4); ?></td>
		</tr>
		<?php } ?>
		<?php if ($payslip->sss_loan != 0.00){ ?>
		<tr class="trborderleft">
			<td class="tdpaddingleft">SSS Loan</td>
			<td align="right" class="tdpaddingright"><?php echo number_format($payslip->sss_loan,2); ?></td>
		</tr>
		<?php } ?>
		<?php if ($payslip->pagibig_loan != 0.00){ ?>
		<tr class="trborderleft">
			<td class="tdpaddingleft">Pagibig Loan</td>
			<td align="right" class="tdpaddingright"><?php echo number_format($payslip->pagibig_loan,2); ?></td>
		</tr>
		<?php } ?>
		<?php if ($payslip->cash_advance != 0.00){ ?>
		<tr class="trborderleft">
			<td class="tdpaddingleft">Cash Advance</td>
			<td align="right" class="tdpaddingright"><?php echo number_format($payslip->cash_advance,2); ?></td>
		</tr>
		<?php } ?>
		<tr class="trborderleftbottomtop">
			<td colspan="2" align="right" class="tdpaddingright"><strong>Total Deduction :</strong> <?php echo number_format($payslip->sss_deduction + $payslip->philhealth_deduction + $payslip->pagibig_deduction + $payslip->wtax_deduction + $payslip->sss_loan + $payslip->pagibig_loan + $payslip->cash_advance,4); ?></td>
		</tr>
		<tr class="trborderleftbottomtop">
			<td colspan="2" align="right" class="tdpaddingright" style="
		padding-bottom: 10px!important;padding-top: 10px!important;background: #ECEFF1!important;"><strong>Net Total :</strong> <?php echo number_format($payslip->net_total,2); ?></td>
		</tr>
	</table>
</div>
