<?php
	if($_SESSION['height'] == ""){
		header("location:../pupclinic/dashboard.php?page=landing_page");
	}
?>
<div class="metrics-container">
	<h2>height:</h2>
	<h1 id="height">--</h1>
	<h2>heart rate:</h2>
	<h1 id="heart_rate">--</h1>
	<h2>oxygen:</h2>
	<h1 id="oxygen"></h1>
	<h2>transaction number:</h2>
	<h2 id="transaction_no"></h2>
	<form id="save_all_data">
	    <button id="save">Save and Exit</button>
	</form>
	<button onclick="retry()">Retry</button>
</div>
<script>
	function retry() {
		window.location.href = "../pupclinic/dashboard.php?page=get_height";
	}
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
	$('#save_all_data').submit(function(e){
		$.ajax({
			url:'../pupclinic/php/ajax.php?action=save_all_data',
			type:'POST',
			data:$(this).serialize(),
			error:function(err){
				console.log(err);
				alert("An error occured");
			},
			success:function(resp){
				if(resp == 1){
					location.href = '../pupclinic/dashboard.php?page=landing_page';
				}
			}
		})
	})
</script>
