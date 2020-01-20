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
<div>
	<?php if($type == "print"){ ?>
	<div style="font-size: 9pt;">
	<?php include 'template_header.php';?>
			<b><?php 
				if ($month == "All"){
					echo "Philhealth Report for All Months";
				}else{
					echo "Philhealth Report for the Month of ".$month;
				}
			?></b>
			<br />
			<b>Year :</b> <?php echo $year; ?><br />
			<b>Branch :</b> <?php echo $branch; ?> <br />
			<b>Department :</b> <?php echo $department; ?>
		<hr>
		</br >
	</div>
	<?php } ?>
<table class="table" style="width:100%;">
		<thead class="thead-inverse">
			<tr>
				<th width="5%">#</th>
				<?php if ($month == "All"){?>
				<th width="10%">Month</th>
				<?php }?>
				<th width="10%">Ecode</th>
				<th width="20%">Name</th>
				<th width="15%">PhilHealth No.</th>
				<th width="15%">Employee</th>
				<th width="15%">Employer</th>
				<th width="15%">Total</th>
			</tr>
		</thead>
		<tbody>
			<?php
			$total_philhealth=0;
			$total_employee=0;
			$total_employer=0;
			$count=1;
			if(count($phil_health_report)!=0 || count($phil_health_report)!=null){
				foreach($phil_health_report as $row){
					$total_philhealth+=$row->employee+$row->employer;
					$total_employee+=$row->employee;
					$total_employer+=$row->employer;
					if ($row->employee != 0){
				 ?>
					<tr>
					<td <?php if($type == "preview"){ echo 'class="tdpadding"'; }?>><?php echo $count; ?></td>
					<?php if ($month == "All"){?>
					<td <?php if($type == "preview"){ echo 'class="tdpadding"'; }?>><?php echo $row->periodmonth; ?></td>
					<?php }?>
					<td <?php if($type == "preview"){ echo 'class="tdpadding"'; }?>><?php echo $row->ecode; ?></td>
					<td <?php if($type == "preview"){ echo 'class="tdpadding"'; }?> width="25%"><?php echo $row->full_name; ?></td>
					<td <?php if($type == "preview"){ echo 'class="tdpadding"'; }?> width="20%"><?php echo $row->phil_health; ?></td>
					<td <?php if($type == "preview"){ echo 'class="tdpadding"'; }?> align="right" width="10%" style="padding-right: 30px!important;"><?php echo number_format($row->employee,2); ?></td>
					<td <?php if($type == "preview"){ echo 'class="tdpadding"'; }?> align="right" width="10%" style="padding-right: 30px!important;"><?php echo number_format($row->employer,2); ?></td>
					<td <?php if($type == "preview"){ echo 'class="tdpadding"'; }?> align="right" width="15%" style="padding-right: 30px!important;"><?php echo number_format($row->employee+$row->employer,2); ?></td>
				</tr>
	 		<?php
	 			$count++;
			}}}
	 			else{ ?>

	 				<?php if ($month =="All"){
	 				echo '<tr><td style="font-size:14pt;" colspan="8"><center>No Result</center></td></tr>';
	 				}else{
	 				echo '<tr><td style="font-size:14pt;" colspan="7"><center>No Result</center></td></tr>';
	 				}} ?>
	 			<tr>
	 				<?php if ($month =="All"){?>
						<td <?php if($type == "preview"){ echo 'class="tdpadding"'; }?> style="border-bottom:2px solid #95a5a6; border-bottom: 1px solid #95a5a6 !important;" colspan="8" ></td>
					<?php }else{?>
						<td <?php if($type == "preview"){ echo 'class="tdpadding"'; }?> style="border-bottom:2px solid #95a5a6; border-bottom: 1px solid #95a5a6 !important;" colspan="7" ></td>
					<?php }?>	
	 			</tr>
	 			<tr>
	 				<?php if ($month =="All"){?>
	 					<td <?php if($type == "preview"){ echo 'class="tdpadding"'; }?> style="text-align:right;font-weight:bold;" colspan="5">Total:</td>
	 				<?php }else{?>
	 					<td <?php if($type == "preview"){ echo 'class="tdpadding"'; }?> style="text-align:right;font-weight:bold!important;" colspan="4">Total:</td>
	 				<?php }?>
	 				<td <?php if($type == "preview"){ echo 'class="tdpadding"'; }?> align="right" style="font-weight:bold!important;color:#217345!important;padding-right: 30px!important;"><?php echo number_format($total_employee,2);?></td>
	 				<td <?php if($type == "preview"){ echo 'class="tdpadding"'; }?> align="right" style="font-weight:bold!important;color:#217345!important;padding-right: 30px!important;"><?php echo number_format($total_employer,2);?></td>
	 				<td <?php if($type == "preview"){ echo 'class="tdpadding"'; }?> align="right" style="font-weight:bold!important;color:#217345!important;padding-right: 30px!important;"><?php echo number_format($total_philhealth,2);?></td>
	 			</tr>
		</tbody>
</table>
</div>
