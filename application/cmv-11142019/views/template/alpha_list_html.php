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
			<span style="float: left;">
				<b>Alpha List of Employee</b><br>
				<b><?php echo $company->company_name ?> </b></br />
				<b>Tin #:</b> <?php echo $company->tin_no ?><br />
				<b>Year:</b> <?php echo $year; ?>
			</span>
			<span style="float: right;">
				<b>Branch : </b> <?php echo $get_branch; ?> <br />
				<b>Department : </b><?php echo $get_department;?>
			</span>
			<div style="margin-top: 10px;">
				<br /><br /><br /><br /><hr>
			</div>
			<br />
	</div>
	<?php }?>
	<table class="table" style="width:100%;">
		<thead>
			<tr>
				<th><center>#</center></th>
				<th align="left">Surname</th>
				<th align="left">Firstname</th>
				<th align="left">Middlename</th>
				<th align="left">Tin #</th>
				<th style="text-align: right;">WTAX Whold (Jan - Nov)</th>
				<th style="text-align: right;">13th Month Pay</th>
				<th style="text-align: right;">Gross Pay</th>
				<th colspan="3"><center>Deduction (Tax Shield)</center></th>
				<th style="text-align: right;">Taxable Income</th>
				<th style="text-align: right;">Tax Due December</th>
			</tr>
			<tr>
				<th colspan="8"></th>
				<th><center>SSS</center></th>
				<th><center>Pilhealth</center></th>
				<th><center>Pagibig</center></th>
				<th colspan="2"></th>
			</tr>
		</thead>
		<tbody>
			<?php
				$i = 1;
				if(count($alpha_list)!=0 || count($alpha_list)!=null){
					foreach ($alpha_list as $row) {?>
				<tr>
					<td <?php if($type == "preview"){ echo 'class="tdpadding"'; }?>><?php echo $i++.'.'; ?></td>
					<td <?php if($type == "preview"){ echo 'class="tdpadding"'; }?>><?php echo $row->last_name; ?></td>
					<td <?php if($type == "preview"){ echo 'class="tdpadding"'; }?>><?php echo $row->first_name; ?></td>
					<td <?php if($type == "preview"){ echo 'class="tdpadding"'; }?>><?php echo $row->middle_name; ?></td>
					<td <?php if($type == "preview"){ echo 'class="tdpadding"'; }?>><?php if ($row->tin != ""){echo $row->tin;}else{echo 'N/A';} ?></td>
					<td align="right" <?php if($type == "preview"){ echo 'class="tdpadding"'; }?>><?php echo number_format($row->wtax,2); ?></td>
					<td align="right" <?php if($type == "preview"){ echo 'class="tdpadding"'; }?>><?php echo number_format($row->acc_13thmonth_pay,2); ?></td>
					<td align="right" <?php if($type == "preview"){ echo 'class="tdpadding"'; }?>><?php echo number_format($row->yearly_gross,2); ?></td>
					<td align="right" <?php if($type == "preview"){ echo 'class="tdpadding"'; }?>><?php echo number_format($row->yearly_sss,2); ?></td>
					<td align="right" <?php if($type == "preview"){ echo 'class="tdpadding"'; }?>><?php echo number_format($row->yearly_phil,2); ?></td>
					<td align="right" <?php if($type == "preview"){ echo 'class="tdpadding"'; }?>><?php echo number_format($row->yearly_pagibig,2); ?></td>
					<td align="right" <?php if($type == "preview"){ echo 'class="tdpadding"'; }?>><?php echo number_format($row->taxable_income,2); ?></td>
					<td align="right" <?php if($type == "preview"){ echo 'class="tdpadding"'; }?>></td>
				</tr>
			<?php }}else{ ?>
				<tr>
					<td colspan="13">
						<center>
							No Result
						</center>
					</td>
				</tr>
			<?php }?>
		</tbody>
		</table>
	</div>
