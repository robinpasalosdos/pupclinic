<h1>height:</h1>
<h2 id="height">--</h2><br>
<h1>heart rate:</h1>
<h2 id="heart_rate">--</h2><br>
<h1>oxygen:</h1>
<h2 id="oxygen"></h2><br>
<h1>transaction number:</h1>
<h2 id="transaction_no"></h2>
<script>
    $(document).ready(function(){
		$.ajax({
			url:'../pupclinic/php/ajax.php?action=get_all_data',
			method:'POST',
			data:$(this).serialize(),
			error:err=>{
				console.log(err)
			},
			success:function(resp){
				resp = JSON.parse(resp)
				if(resp.status == 1){
					$("#height").html(resp.data.height)
					$("#heart_rate").html(resp.data.heart_rate)
					$("#transaction_no").html(resp.data.transaction_no)
				}
			}
		})
	})
</script>
