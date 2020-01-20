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
			<b>13th Month Pay</b> <br />
			<b>Year :</b> <?php echo $year; ?><br />
			<b>Branch :</b> <?php echo $get_branch; ?><br />
			<b>Department :</b> <?php echo $get_department; ?>
			<hr><br />
	</div>
	<?php } ?>
	<table class="table" style="width:100%;">
		<thead class="thead-inverse">
			<tr>
				<th>#</th>
				<th>Employee Name</th>
				<th><center>Total Reg Pay</center></th>
				<th><center>Accumulated 13th Month Pay</center></th>
			</tr>
		</thead>
		<tbody>
			<?php
			$count=1;
			$total_reg = 0;
			$total_13thmonth = 0;

			if (count($get13thmonth_pay) > 0){
				foreach($get13thmonth_pay as $row){
					$total_reg += $row->total_reg;
					$total_13thmonth += $row->total_13thmonth;
				?>
			<tr>
				<td <?php if($type == "preview"){ echo 'class="tdpadding"'; }?>><?php echo $count; ?>.</td>
				<td <?php if($type == "preview"){ echo 'class="tdpadding"'; }?>><?php echo $row->fullname; ?></td>
				<td <?php if($type == "preview"){ echo 'class="tdpadding"'; }?> align="right"><?php echo number_format($row->total_reg,2);?></td>
				<td <?php if($type == "preview"){ echo 'class="tdpadding"'; }?> align="right"><?php echo number_format($row->total_13thmonth,2); ?></td>
			</tr>
			<?php
				$count++;
			}}else{
			?>

			<td colspan="4"><center>No Result</center></td>

			<?php }?>
			<tr>
				<td colspan="2" align="right"><b>Total : </b></td>
				<td  align="right"><b><?php echo number_format($total_reg,2); ?></b></td>
				<td  align="right"><b><?php echo number_format($total_13thmonth,2); ?></b></td>
			</tr>
		</tbody>
	</table>
	</div>