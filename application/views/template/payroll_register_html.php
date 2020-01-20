<style>
	td, th {
		padding: 7px;
	}
	.tablepaytotals{
	  border-bottom: .5px solid gray !important;
		padding-bottom: 5px !important;
		padding-top: 5px !important;
	}
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
	<div style="font-size: 9pt;margin-bottom: 10px;">
		<div class="temp_header">
			<?php include 'template_header.php';?>
					<b>Payroll Register</b> <br />
					<b>Pay Period :</b> <?php echo $pay_period; ?> <br />
					<b>Branch :</b> <?php echo $get_branch; ?> <br />
					<b>Department :</b> <?php echo $get_department; ?> <br />
					<b>Payment Type :</b> <?php if ($register_type == 1){ echo 'Cash'; }else{ echo 'Check'; }?>
					<br>
			</div>
		</div>
	</div>
	<?php }?>
	<table width="100%">
		<thead>
			<tr>
				<th style="border-bottom: 1px solid black;">#</th>
				<th style="border-bottom: 1px solid black;">Ecode</th>
				<th style="border-bottom: 1px solid black;">Employee Name</th>
				<?php if ($register_type == 2){?>
					<th style="text-align:center;border-bottom: 1px solid black;">Bank Account #</th>
				<?php }?>
				<th style="border-bottom: 1px solid black;text-align: right;">Net Pay</th>
			</tr>
		</thead>
		<tbody>
			<?php
				$grandtotal = 0;
				$count=1;
				if(count($payroll_register)!=0 || count($payroll_register)!=null){
				foreach($payroll_register as $row){
					$grandtotal += $row->net_total;
				?>
			<tr>
				<td <?php if($type == "preview"){ echo 'class="tdpadding"'; }?> width="1%"><?php echo $count;?></td>
				<td <?php if($type == "preview"){ echo 'class="tdpadding"'; }?> width="5%"><?php echo $row->ecode;?></td>
				<td <?php if($type == "preview"){ echo 'class="tdpadding"'; }?> width="15%"><?php echo $row->full_name;?></td>
				<?php if($register_type == 2){ ?>
					<td <?php if($type == "preview"){ echo 'class="tdpadding"'; }?> width="15%" style="text-align:center;"><?php echo $row->bank_account;?></td>
				<?php }?>
				<td width="5%" align="right"><?php echo number_format($row->net_total,2);?></td>
			</tr>
			<?php $count++;} ?>

				<tr>
					<td align="right" colspan="<?php if($register_type == 2){ echo 5; }else{ echo 4; } ?>"><hr></td>
				</tr>
				<tr>
					<td colspan="<?php if($register_type == 2){ echo 4; }else{ echo 3; } ?>" style="text-align: right; "><b>Grand Total:</b></td>
					<td align="right"><?php echo number_format($grandtotal,2); ?></td>
				</tr>


			<?php }else{?>
				<td <?php if($type == "preview"){ echo 'class="tdpadding"'; }?> colspan="<?php if($register_type == 2){ echo 5; }else{ echo 4; } ?>"><center>No Result</center></td>
			<?php }?>
		</tbody>
	</table>
</div>
