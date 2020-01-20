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
				<b><?php 
					if ($month == "All"){
						echo "SSS Report for All Months";
					}else{
						echo "SSS Report for the Month of ".$month;
					}
				?></b>
				<br />
				<b>Year :</b> <?php echo $year; ?> <br />
				<b>Branch :</b> <?php echo $branch; ?> <br />
				<b>Department :</b> <?php echo $department; ?> <br />
			<hr>
			<br />
		</div>
	<?php } ?>
<table class="table" style="width:100%;">
		<thead class="thead-inverse">
			<tr>
				<th>#</th>
				<?php if ($month == "All"){?>
				<th style="text-align:left;">Month</th>
				<?php } ?>
				<th style="text-align:left;">Ecode</th>
				<th style="text-align:left;">Name</th>
				<th style="text-align:left;">SSS No.</th>
				<th style="text-align:right;">Employee</th>
				<th style="text-align:right;">Employer</th>
				<th style="text-align:right;">EC</th>
				<th style="text-align:right;">Total</th>
			</tr>
		</thead>
		<tbody>
			<?php
			$total_sss=0;
			$total_employer=0;
			$total_ec=0;
			$grand_total=0;
			$count=1;
			if(count($sss_report)!=0 || count($sss_report)!=null){
				foreach($sss_report as $row){
					if ($row->employee != 0){
				 ?>
					<tr>
					<td <?php if($type == "preview"){ echo 'class="tdpadding"'; }?>><?php echo $count; ?></td>
					<?php if ($month == "All"){?>
					<td <?php if($type == "preview"){ echo 'class="tdpadding"'; }?>><?php echo $row->periodmonth; ?></td>
					<?php } ?>
					<td <?php if($type == "preview"){ echo 'class="tdpadding"'; }?>><?php echo $row->ecode; ?></td>
					<td <?php if($type == "preview"){ echo 'class="tdpadding"'; }?>><?php echo $row->full_name; ?></td>
					<td <?php if($type == "preview"){ echo 'class="tdpadding"'; }?>><?php echo $row->sss; ?></td>
					<td <?php if($type == "preview"){ echo 'class="tdpadding"'; }?> style="text-align: right;"><?php echo number_format($row->employee,2); ?></td>
					<td <?php if($type == "preview"){ echo 'class="tdpadding"'; }?> style="text-align: right;"><?php echo number_format($row->employer,2); ?></td>
					<td <?php if($type == "preview"){ echo 'class="tdpadding"'; }?> style="text-align: right;"><?php echo number_format($row->employer_contribution,2); ?></td>
					<td <?php if($type == "preview"){ echo 'class="tdpadding"'; }?> style="text-align: right;"><?php echo number_format($row->total,2); ?></td>
				</tr>
	 		<?php
					$total_sss += $row->employee;
					$total_employer += $row->employer;
					$total_ec += $row->employer_contribution;
					$grand_total += $row->total;
	 				$count++;
	 			}}}
	 			else{ ?>
	 				<?php if ($month == "All"){?>
	 					<tr><td <?php if($type == "preview"){ echo 'class="tdpadding"'; }?> style="text-align:center;font-size:14pt;" colspan="9"><center>No Result</center></td></tr>
	 				<?php }else{?>
	 					<tr><td <?php if($type == "preview"){ echo 'class="tdpadding"'; }?> style="text-align:center;font-size:14pt;" colspan="8"><center>No Result</center></td></tr>
	 				<?php }?>
	 			<?php
	 			} ?>
	 			<tr>
	 				<?php if ($month == "All"){?>
	 					<td <?php if($type == "preview"){ echo 'class="tdpadding"'; }?> style="border-bottom: 1px solid #95a5a6 !important;" colspan="9"></td>
	 				<?php }else{?>
	 					<td <?php if($type == "preview"){ echo 'class="tdpadding"'; }?> style="border-bottom: 1px solid #95a5a6 !important;" colspan="8"></td>
	 				<?php }?>
	 			</tr>
	 			<tr>
	 				<?php if ($month == "All"){?>
	 					<td <?php if($type == "preview"){ echo 'class="tdpadding"'; }?> colspan="4"></td>
	 				<?php }else{?>
	 					<td <?php if($type == "preview"){ echo 'class="tdpadding"'; }?> colspan="3"></td>
	 				<?php }?>
	 				<td <?php if($type == "preview"){ echo 'class="tdpadding"'; }?> style="text-align:right;font-weight:bold!important;">Total:</td>
	 				<td <?php if($type == "preview"){ echo 'class="tdpadding"'; }?> style="font-weight:bold!important;color:#217345!important; text-align: right;"><?php echo number_format($total_sss,2);?></td>
	 				<td <?php if($type == "preview"){ echo 'class="tdpadding"'; }?> style="font-weight:bold!important;color:#217345!important; text-align: right;"><?php echo number_format($total_employer,2);?></td>
	 				<td <?php if($type == "preview"){ echo 'class="tdpadding"'; }?> style="font-weight:bold!important;color:#217345!important; text-align: right;"><?php echo number_format($total_ec,2);?></td>
					<td <?php if($type == "preview"){ echo 'class="tdpadding"'; }?> style="font-weight:bold!important;color:#217345!important; text-align: right;"><?php echo number_format($grand_total,2);?></td>
	 			</tr>
		</tbody>
</table>
</div>
