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
		
			<b>Employee Deduction History</b><br />
			<b>Employee Name :</b> <?php echo $employeename[0]->full_name; ?><br />
			<b>Ecode :</b> <?php echo $employeename[0]->ecode; ?><br />
			<b>Year :</b> <?php echo $year; ?> <br />
			<hr><br />
	</div>
<?php }?>
		<table class="table" style="width:100%;">
			<thead class="thead-inverse">
				<tr>
					<th>#</th>
					<th>Month</th>
					<th style="text-align: right;">SSS</th>
					<th style="text-align: right;">Philhealth</th>
					<th style="text-align: right;">Pag-ibig</th>
					<th style="text-align: right;">W/TAX</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$count=1;
				$total_sss=0;
				$total_philhealth=0;
				$total_pagibig=0;
				$total_wtax=0;

					 foreach($employee_deduction as $row){

			 				$total_sss+=$row->sss;
			 				$total_philhealth+=$row->philhealth;
			 				$total_pagibig+=$row->pagibig;
			 				$total_wtax+=$row->wtax;

						 ?>
						 <tr>
							 <td <?php if($type == "preview"){ echo 'class="tdpadding"'; }?>><?php echo $count; ?>.</td>
							 <td <?php if($type == "preview"){ echo 'class="tdpadding"'; }?>><?php echo $row->month; ?></td>
							 <td <?php if($type == "preview"){ echo 'class="tdpadding"'; }?> align="right"><?php echo number_format($row->sss,2); ?></td>
							 <td <?php if($type == "preview"){ echo 'class="tdpadding"'; }?> align="right"><?php echo number_format($row->philhealth,2); ?></td>
							 <td <?php if($type == "preview"){ echo 'class="tdpadding"'; }?> align="right"><?php echo number_format($row->pagibig,2); ?></td>
							 <td <?php if($type == "preview"){ echo 'class="tdpadding"'; }?> align="right"><?php echo number_format($row->wtax,2); ?></td>
						 </tr>
						 <?php
						 $count++;
					 	}
						?>
						<tr>
							<td colspan="6" style="border-bottom: 1px solid #95a5a6 !important;"></td>
						</tr>
						<tr>
							<td <?php if($type == "preview"){ echo 'class="tdpadding"'; }?>></td>
							<td <?php if($type == "preview"){ echo 'class="tdpadding"'; }?>><b>Total :</b></td>
							<td <?php if($type == "preview"){ echo 'class="tdpadding"'; }?> align="right"><?php echo number_format($total_sss,2); ?></td>
							<td <?php if($type == "preview"){ echo 'class="tdpadding"'; }?> align="right"><?php echo number_format($total_philhealth,2); ?></td>
							<td <?php if($type == "preview"){ echo 'class="tdpadding"'; }?> align="right"><?php echo number_format($total_pagibig,2); ?></td>
							<td <?php if($type == "preview"){ echo 'class="tdpadding"'; }?> align="right"><?php echo number_format($total_wtax,2); ?></td>
						</tr>
			</tbody>
	</table>
