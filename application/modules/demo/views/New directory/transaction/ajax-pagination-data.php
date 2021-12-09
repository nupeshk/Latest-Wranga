<h3 class="box-title m-b-40 font-normal" id="page-info"><?php echo $pageInfo; ?></h3>
<table id="example1" class="table table">
<thead>
	<tr>
		<th align="left" style="text-align: left;">Vehicle Number</th>
		<th align="left" style="text-align: left;">Vehicle Type</th>
		<th align="left">Transaction Date</th>
		<th align="left">Bill Number</th>
		<th align="left">Quantity</th>
		<th align="left">Points</th>
		<th align="left">Transaction Type</th>
		<th align="left">Remarks</th>
		<!--<th align="left">Action</th>-->
	</tr>
	</tr>
</thead>
<tbody>
	<?php
	if (!empty($transArr)) {
		foreach ($transArr as $result) {
		   // printArr($result);
			$transaction = "";
			if($result["transactionType"] == "add" && $result["transactionStatus"] == "1"){
				$transaction = "Added";
			} else if($result["transactionType"] == "add" && $result["transactionStatus"] == "2"){
				$transaction = "Cancelled";
			} else if($result["transactionType"] == "redeem" && $result["transactionStatus"] == "1"){
				$transaction = "Redeemed";
			}
			?>
			<tr id="removeRow_<?php echo $result['transactionId']; ?>">
				<td align="left" class="txt-oflo"><?php echo $result['vehicleNumber']; ?></td>
				<td align="left" class="txt-oflo"><?php echo ucwords($result['vehicleType']); ?></td>                                   
				<td align="left" class="txt-oflo"><?php echo $result['transactionDate']; ?></td>
				<td align="left" class="txt-oflo"><?php echo $result['billNumber']; ?></td>
				<td align="left" class="txt-oflo"><?php echo $result['quantity']; ?></td>
				<td align="left" class="txt-oflo"><?php echo $result['points']; ?></td>                                    
				<td align="left" class="txt-oflo"><?php echo $transaction; ?></td>
				<td align="left" class="txt-oflo"><?php echo $result['remarks']; ?></td> 
				<!--<td align="center">
					<a href="#" class="btn-info btn btn-sm">View</a>  
					<button class="btn btn-danger" onClick="openModal(<?php //echo $result['userId']; ?>, 'bartender/delete')" id="<?php //echo $result['userId']; ?>"><i class="fa fa-trash"></i></button>                                    
				</td> -->
			</tr>
		<?php
	}
} else {
	?>
	<tr>
		<td width="200" align="center" class="txt-oflo" colspan="12">Data is not available.</td>
	</tr>
<?php } ?>
</tbody>
</table>
<?php echo $this->ajax_pagination->create_links(); ?>
<input type="hidden" id="page" name="page" value="<?php echo $page; ?>">
