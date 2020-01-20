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
					echo "Pag-Ibig Report for All Months";
				}else{
					echo "Pag-Ibig Report for Month of ".$month;
				}
			?></b>
			<br />
			<b>Year :</b> <?php echo $year; ?> <br />
			<b>Branch :</b> <?php echo $branch; ?><br />
			<b>Department :</b> <?php echo $department; ?>
		<hr>
		<br />
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
				<th width="30%">Name</th>
				<th width="25%">Pag-Ibig No.</th>
				<th width="5%">Contribution</th>
			</tr>
		</thead>
		<tbody>
			<?php
			$total_pagibig=0;
			$count=1;
			if(count($pagibig_list)!=0 || count($pagibig_list)!=null){
				foreach($pagibig_list as $row){
					$total_pagibig+=$row->employee;
					if ($row->employee != 0){
				 ?>
					<tr>
					<td <?php if($type == "preview"){ echo 'class="tdpadding"'; }?>><?php echo $count; ?></td>
					<?php if ($month == "All"){?>
						<td <?php if($type == "preview"){ echo 'class="tdpadding"'; }?>><?php echo $row->periodmonth; ?></td>
					<?php }?>
					<td <?php if($type == "preview"){ echo 'class="tdpadding"'; }?>><?php echo $row->ecode; ?></td>
					<td <?php if($type == "preview"){ echo 'class="tdpadding"'; }?>><?php echo $row->full_name; ?></td>
					<td <?php if($type == "preview"){ echo 'class="tdpadding"'; }?>><?php echo $row->pag_ibig; ?></td>
					<td <?php if($type == "preview"){ echo 'class="tdpadding"'; }?> align="right"><?php echo number_format($row->employee,2); ?></td>
				</tr>
	 		<?php
	 			$count++;
				}}}
	 			else{ 
	 				if ($month == "All"){
	 					echo '<tr><td colspan="6" style="font-size:14pt;"><center>No Result</center></td></tr>';
	 				}else{
	 					echo '<tr><td colspan="5" style="font-size:14pt;"><center>No Result</center></td></tr>';
	 				}
	 			} ?>

	 			<?php if ($month == "All"){?>
		 			<tr>
						<td <?php if($type == "preview"){ echo 'class="tdpadding"'; }?> style="border-bottom: 1px solid #95a5a6 !important;" colspan="6"></td>
		 			</tr>
	 			<?php }else{?>
		 			<tr>
						<td <?php if($type == "preview"){ echo 'class="tdpadding"'; }?> style="border-bottom: 1px solid #95a5a6 !important;" colspan="5"></td>
		 			</tr>
	 			<?php }?>
	 			<tr>
	 				<?php if ($month == "All"){?>
						<td <?php if($type == "preview"){ echo 'class="tdpadding"'; }?> style="text-align:right;font-weight:bold!important;" colspan="5">Total:</td>
					<?php }else{?>
						<td <?php if($type == "preview"){ echo 'class="tdpadding"'; }?> style="text-align:right;font-weight:bold!important;" colspan="4">Total:</td>
					<?php }?>
	 				<td <?php if($type == "preview"){ echo 'class="tdpadding"'; }?> align="right" style="font-weight:bold!important;color:#217345!important;"><?php echo number_format($total_pagibig,2);?></td>
	 			</tr>
		</tbody>
</table>
</div>
