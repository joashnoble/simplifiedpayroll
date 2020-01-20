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
					echo "WTAX Report for All Months";
				}else{
					echo "WTAX Report for Month of ".$month;
				}
			?></b><br />
			<b>Year :</b> <?php echo $year; ?> <br />
			<b>Branch :</b> <?php echo $branch; ?> <br />
			<b>Department :</b> <?php echo $department; ?>
		<hr>
		</br/>
	</div>
	<?php }?>
	<table class="table" style="width:100%;">
			<thead class="thead-inverse">
				<tr>
					<th width="1%">#</th>
					<?php if ($month == "All"){?>
						<th width="10%">Month</th>
					<?php }?>
					<th width="10%">Ecode</th>
					<th width="20%">Name</th>
					<th width="10%">TIN #</th>
					<th width="10%">Taxable Amount</th>
					<th width="10%">Deduction</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$total_wtax=0;
				$count=1;
				if(count($wtax_report)!=0 || count($wtax_report)!=null){
					foreach($wtax_report as $row){
						$total_wtax+=$row->wtax_employee;
						if ($row->wtax_employee != 0){
					 ?>
						<tr>
						<td <?php if($type == "preview"){ echo 'class="tdpadding"'; }?>><?php echo $count; ?>.</td>
						<?php if ($month == "All"){?>
							<td <?php if($type == "preview"){ echo 'class="tdpadding"'; }?>><?php echo $row->periodmonth; ?></td>
						<?php }?>
						<td <?php if($type == "preview"){ echo 'class="tdpadding"'; }?> ><?php echo $row->ecode; ?></td>
						<td <?php if($type == "preview"){ echo 'class="tdpadding"'; }?> ><?php echo $row->full_name; ?></td>
						<td <?php if($type == "preview"){ echo 'class="tdpadding"'; }?> ><?php echo $row->tin; ?></td>
						<td  <?php if($type == "preview"){ echo 'class="tdpadding"'; }?> align="right"><?php echo number_format($row->taxable_amount,2); ?></td>
						<td <?php if($type == "preview"){ echo 'class="tdpadding"'; }?> align="right"><?php echo number_format($row->wtax_employee,2); ?></td>
					</tr>
		 		<?php
		 			$count++;
					} } }
		 			else{ 
		 				if ($month == "All"){
		 					echo '<tr><td style="text-align:center;font-size:14pt;" colspan="7"><center>No Result</center></td></tr>';
		 				}else{
		 					echo '<tr><td style="text-align:center;font-size:14pt;" colspan="6"><center>No Result</center></td></tr>';
		 				}} ?>
		 			<tr>
		 				<?php if($month == "All"){?>
							<td <?php if($type == "preview"){ echo 'class="tdpadding"'; }?> style="border-bottom: 1px solid #95a5a6 !important;" colspan="7"></td>
		 				<?php }else{?>
							<td <?php if($type == "preview"){ echo 'class="tdpadding"'; }?> style="border-bottom: 1px solid #95a5a6 !important;" colspan="6"></td>
		 				<?php }?>
		 			</tr>
		 			<tr>
						<?php if($month == "All"){?>
							<td <?php if($type == "preview"){ echo 'class="tdpadding"'; }?> style="text-align:right;font-weight:bold!important;" colspan="6">Total:</td>
						<?php }else{?>
							<td <?php if($type == "preview"){ echo 'class="tdpadding"'; }?> style="text-align:right;font-weight:bold!important;" colspan="5">Total:</td>
						<?php }?>
		 				<td <?php if($type == "preview"){ echo 'class="tdpadding"'; }?> align="right" style="font-weight:bold;color:#217345!important;"><?php echo number_format($total_wtax,2);?></td>
		 			</tr>
			</tbody>


	</table>
	</div>
</div>
