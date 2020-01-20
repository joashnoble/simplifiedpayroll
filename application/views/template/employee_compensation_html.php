<style type="text/css">
	table th{
		background: #FFF!important;
		color: black;
		font-family: calibri;
	}

	.tdpadding{
		padding-top: 3px!important;
		padding-bottom: 3px!important;
		font-weight: 500!important;
		color: #263238!important;
		font-size: 11pt!important;
	}
</style>

<?php if($type == "print"){ ?>
<div style="font-size: 9pt;">
	<?php include 'template_header.php';?>
	<strong>Employee Compensation History<br>
		Employee Name : <?php echo $employeename[0]->full_name; ?><br>
		Ecode : <?php echo $employeename[0]->ecode; ?> <br />
		Year : <?php echo $year; ?> <br />
		<hr><br />
	</strong>
<div>
<?php } ?>

<table class="table" style="width:100%;">
	<thead class="thead-inverse">
		<tr>
			<th><center>#</center></th>
			<th>MONTH</th>
			<th style="text-align: right;">GROSS PAY</th>
			<th style="text-align: right;">NET PAY</th>
			<th style="text-align: right;">13TH MONTH PAY</th>
			<th style="text-align: right;">DEDUCTIONS</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$count=1;

			$sum_regpay = 0;
			$sum_netpay = 0;
			$sum_for_13thmonth = 0;
			$sum_total_deduction = 0;

			 foreach($employee_compensation as $row){

			 	$sum_regpay += $row->reg_pay;
			 	$sum_netpay += $row->net_pay;
			 	$sum_for_13thmonth += $row->for_13thmonth;
			 	$sum_total_deduction += $row->total_deduction;

				 ?>
				 <tr>
					 <td <?php if($type == "preview"){ echo 'class="tdpadding"'; }?>><center><?php echo $count; ?>.</center></td>
					 <td <?php if($type == "preview"){ echo 'class="tdpadding"'; }?>><?php echo $row->month; ?></td>
					 <td <?php if($type == "preview"){ echo 'class="tdpadding"'; }?> align="right"><?php echo number_format($row->reg_pay,2); ?></td>
					 <td <?php if($type == "preview"){ echo 'class="tdpadding"'; }?> align="right"><?php echo number_format($row->net_pay,2); ?></td>
					 <td <?php if($type == "preview"){ echo 'class="tdpadding"'; }?> align="right"><?php echo number_format($row->for_13thmonth,2); ?></td>
					 <td <?php if($type == "preview"){ echo 'class="tdpadding"'; }?> align="right"><?php echo number_format($row->total_deduction,2); ?></td>
				 </tr>
				 <?php
				 $count++;
				 }?>
				<tr>
					<td <?php if($type == "preview"){ echo 'class="tdpadding"'; }?> colspan="6" style="border-bottom: 1px solid #95a5a6 !important;"></td>
				</tr>
				<tr>
					<td <?php if($type == "preview"){ echo 'class="tdpadding"'; }?>></td>
					<td <?php if($type == "preview"){ echo 'class="tdpadding"'; }?>><b>Total :</b></td>
					<td <?php if($type == "preview"){ echo 'class="tdpadding"'; }?> align="right"><?php echo number_format($sum_regpay,2); ?></td>
					<td <?php if($type == "preview"){ echo 'class="tdpadding"'; }?> align="right"><?php echo number_format($sum_netpay,2); ?></td>
					<td <?php if($type == "preview"){ echo 'class="tdpadding"'; }?> align="right"><?php echo number_format($sum_for_13thmonth,2); ?></td>
					<td <?php if($type == "preview"){ echo 'class="tdpadding"'; }?> align="right"><?php echo number_format($sum_total_deduction,2); ?></td>
				</tr>
	</tbody>
</table>
