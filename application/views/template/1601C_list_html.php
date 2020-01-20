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
		<b>Schedule of taxes withheld (1601C)</b><br />
		<b><?php echo $month.' '.$year; ?></b> <br />
		<b>Branch : </b> <?php echo $get_branch; ?> <br />
		<b>Department : </b> <?php echo $get_department; ?> <br />
		<hr>
	</div>
	<?php }?>
	<table class="table" width="100%">
		<thead>
			<tr>
				<th>#</th>
				<th>ECode</th>
				<th>Sur Name</th>
				<th>Given Name</th>
				<th>Middle Name</th>
				<th>TIN No.</th>
				<th>+Holiday</th>
				<th>/day</th>
				<th>Gross Tax</th>
				<th>Gross Pay</th>
				<th>HDMFeR</th>
				<th>HDMFee</th>
				<th>SSSeR</th>
				<th>SSSeC</th>
				<th>SSSeE</th>
				<th>PHICeR</th>
				<th>PHICeE</th>
				<th>Salary</th>
				<th>Compensation</th>
				<th>Withheld</th>
			</tr>
		</thead>
		<tbody>
			<?php
				$i = 1;
				if (count($report1601C) > 0){
				foreach ($report1601C as $row) {?>
				<tr>
					<td <?php if($type == "preview"){ echo 'class="tdpadding"'; }?>><?php echo $i++.'.'; ?></td>
					<td <?php if($type == "preview"){ echo 'class="tdpadding"'; }?>><?php echo $row->ecode; ?></td>
					<td <?php if($type == "preview"){ echo 'class="tdpadding"'; }?>><?php echo $row->last_name; ?></td>
					<td <?php if($type == "preview"){ echo 'class="tdpadding"'; }?>><?php echo $row->first_name; ?></td>
					<td <?php if($type == "preview"){ echo 'class="tdpadding"'; }?>><?php echo $row->middle_name; ?></td>
					<td <?php if($type == "preview"){ echo 'class="tdpadding"'; }?>><?php echo $row->tin; ?></td>
					<td <?php if($type == "preview"){ echo 'class="tdpadding"'; }?> align="right"><?php echo number_format($row->holiday_pay,2); ?></td>
					<td <?php if($type == "preview"){ echo 'class="tdpadding"'; }?> align="right"><?php echo number_format($row->per_day_pay,2); ?></td>
					<td <?php if($type == "preview"){ echo 'class="tdpadding"'; }?> align="right"><?php echo number_format($row->reg_pay,2); ?></td>
					<td <?php if($type == "preview"){ echo 'class="tdpadding"'; }?> align="right"><?php echo number_format($row->gross_pay,2); ?></td>
					<td <?php if($type == "preview"){ echo 'class="tdpadding"'; }?> align="right"><?php echo number_format($row->HDMFeR,2); ?></td>
					<td <?php if($type == "preview"){ echo 'class="tdpadding"'; }?> align="right"><?php echo number_format($row->HDMFee,2); ?></td>
					<td <?php if($type == "preview"){ echo 'class="tdpadding"'; }?> align="right"><?php echo number_format($row->SSSeR,2); ?></td>
					<td <?php if($type == "preview"){ echo 'class="tdpadding"'; }?> align="right"><?php echo number_format($row->SSSeC,2); ?></td>
					<td <?php if($type == "preview"){ echo 'class="tdpadding"'; }?> align="right"><?php echo number_format($row->SSSeE,2); ?></td>
					<td <?php if($type == "preview"){ echo 'class="tdpadding"'; }?> align="right"><?php echo number_format($row->PHICeR,2); ?></td>
					<td <?php if($type == "preview"){ echo 'class="tdpadding"'; }?> align="right"><?php echo number_format($row->PHICeE,2); ?></td>
					<td <?php if($type == "preview"){ echo 'class="tdpadding"'; }?> align="right"><?php echo number_format(($row->SSSeE+$row->HDMFee+$row->PHICeE),2); ?></td>
					<td <?php if($type == "preview"){ echo 'class="tdpadding"'; }?> align="right"><?php echo number_format($row->compensation,2); ?></td>
					<td <?php if($type == "preview"){ echo 'class="tdpadding"'; }?> align="right"><?php echo number_format($row->wtax,2);?></td>
				</tr>
			<?php }}else{ ?>
					<td colspan="20">
						<center>
							<span style="font-size: 12pt;" <?php if($type == "preview"){ echo 'class="tdpadding"'; }?>>No Result</span>
						</center>
					</td>
			<?php }?>
		</tbody>
		</table>