<script type="text/javascript">
     
     $("#watch").click(function(){
     	console.log($(this).prop('checked'))
     	if($(this).prop('checked')===true ){
     		$("#walletname,#total").prop("disabled",true)
     		$("#walletname,#total").val('')
     		
     		$(this).val('watch')
     	}
     	if($(this).prop('checked')==false){
			$("#walletname,#total").prop("disabled",false)
			$("#walletname,#total").val('')
     		$(this).val('')
     	}
     })

     $("#savecoin").click(function(event) {
     	event.preventDefault()
     	if($("#coinlist").val()==""){
     		console.log('no coin')
     		alert('No coin selected.')
     		return false;
     	}
    	if($("#watch").val()=='watch'){
     		$("#walletname").val('watch')
     		$("#total").val(0)
     		
     	}
     	
     	if(isNaN($("#total").val()) || $("#total").val()==''  ){
			alert('Enter total coins.')
			return false
     	
     	}else{
     		 $("#walletname,#total").prop("disabled",false)
     		// var str = $("#editcoin").serialize();
     		 $("#editcoin").submit()
     	}


     });

</script>
<div class='coinform'>
 <form action="editcoin.php" method="get" id="editcoin">
<fieldset>
	<legend>Add Coin</legend>
	<label>Symbol</label>
	<select id='coinlist' name="symbol" placeholder="Select Coin">
		<option></option>
		<?php

		function cmp($a, $b)
		{
		    return strcmp($a["FullName"], $b["FullName"]);
		}

		$coinlist = file_get_contents("lib/data/coinlist.json");
	    $json = json_decode($coinlist, true);
	    print_r($json);
	    usort($json['Data'], "cmp");
		foreach ($json['Data'] as $key => $jsons) { // This will search in the 2 jsons
		    echo "<option value='".$jsons['Symbol']."'>".$jsons['FullName'] ."</option>";	
		}
	 
		?>	

	</select>
	<label>Total</label>
	<input type='text' value='' name='total' placeholder='0.01' id="total" />
	

	<label>Wallet Name</label>
	<input placeholder='Wallet Name' type='text' name='walletname' id="walletname"  />
	<label><input type="checkbox" id="watch" /> Watch only</label>
	<input type='button' value='Add' id='savecoin' /><input type='button' value='Cancel' class="cancel" /><input type='button' value='Settings' id="apiform" />
	<input type="hidden" name='action' value='addcoin'>
</fieldset>
</form>
</div>
<div class='apiform'>
<form action="editapi.php" method="get">
<fieldset>
	<legend>Settings</legend>
	<label>Amount
		<input type="text" name="investment" placeholder="1000.00">
	</label>

<h1>BitTrex API</h1>
	<label>API</label>
	<input type="text" name="bittrexapi">
	<label>Secret</label>
	<input type="text" name="bittrexsecret">
<h1>Binance API</h1>
	<label>API</label>
	<input type="text" name="binanceapi">
	<label>Secret</label>
	<input type="text" name="binancesecret">
<h1>Kraken API</h1>
	<label>API</label>
	<input type="text" name="krakenapi">
	<label>Secret</label>
	<input type="text" name="krakensecret">
<h1>Poloniex API</h1>
	<label>API</label>
	<input type="text" name="poloniexapi">
	<label>Secret</label>
	<input type="text" name="poloniexsecret"><br/>
<input type='submit' value='Save' /><input type='button' value='Cancel' class="cancel" /><input type='button' value='Add Coin' id="manualform" />
<input type="hidden" name="action" value="save">
</fieldset>
</form>
</div>
<script>
	
	
		$("#coinlist").selectize({});

</script>