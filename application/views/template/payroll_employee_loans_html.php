<div style="margin: 20px;">
	<div style="font-size: 11pt;">
	<?php include 'template_header.php';?>

		<span style="float: left;font-size: 9pt;">
				<b>Employee Ledger</b> <br />
				<b>Loan Type : </b><?php echo $get_type; ?> <br />
				<b>Employee : </b> <?php echo $full_name; ?> <br />
		</span>
		<?php 
			if (count($total_loan_amount) > 0){
				foreach ($total_loan_amount as $row) {

					echo "<span style='float: right;font-size: 9pt;'>";

					if ($row->loan_total_amount != "" || $row->loan_total_amount != 0.00 || $row->loan_total_amount != 0){
						echo "<b>Loan Amount :</b> ".number_format($row->loan_total_amount,2)."<br/>";
					}else{
						echo "<b>Loan Amount :</b> No Loan Found <br />";
					}
					echo "<b>Deduct Per Pay :</b> ".number_format($row->deduction_per_pay_amount,2)."<br />";
					echo "<b>Loan Balance :</b> ".number_format($row->deduction_total_amount,2)."<br/>";
					echo "</span>";
				}
			}
		?>
		<br />
		<br />
	<br />
	<hr>
		
	</div>
	<table class="table" style="width:100%;">
		<thead class="thead-inverse">
			<tr>
				<th style="width:20%;text-align:left">Due Date</th>
				<th style="width:15%;text-align:left">Debit</th>
				<th style="width:15%;text-align:left">Credit</th>
				<th style="width:20%;text-align:left">Balance</th>
			</tr>
		</thead>
		<tbody>
<?php
//total amount of loan
$loan_amount_total = $total_loan_amount[0]->loan_total_amount;
	
	if (count($loans) > 0){
		foreach ($total_loan_amount as $row) {
			echo "<tr>";
			echo "<td>".$row->date_posted."</td>";
			echo "<td>".number_format($row->loan_total_amount,2)."</td>";
			echo "<td></td>";
			echo "<td>".number_format($row->loan_total_amount,2)."</td>";
			echo "</tr>";
		}
	}else{
			echo "<tr>";
			echo "<td colspan='4'><center>No Result</center></td>";
			echo "</tr>";
	}

	foreach($loans as $result){
		echo "<tr>";
		echo "<td>".$result->pay_period_end."</td>";
		// echo "<td>".number_format($)."</td>";
		echo "<td></td>";
		echo "<td>".number_format($result->deduction_amount,2)."</td>";
		echo "<td>".number_format($loan_amount_total=$loan_amount_total-$result->deduction_amount,2)."</td></tr>";
	}

 	if(isset($deduction_regular_id)){
	 	//uses loan total amount because it is used as a var in computing
	 	$recompute = array(
	            'deduction_total_amount' => $loan_amount_total
	    );

	    $this->db->where('deduction_regular_id', $deduction_regular_id);
	    $this->db->update('new_deductions_regular', $recompute);
 	}

?>
</tbody>
</table>
</div>
