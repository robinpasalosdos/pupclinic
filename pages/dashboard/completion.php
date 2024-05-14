<?php
	if($_SESSION['height'] == ""){
		header("location:../pupclinic/dashboard.php?page=landing_page");
	}
?>
<div class="metrics-container">
	
	<h2>Heart Rate:</h2>
	<h1 id="heart_rate">--</h1>
	<h2>Oxygen:</h2>
	<h1 id="oxygen"></h1>
	<h2>Blood Pressure:</h2>
	<h1 id="bp"></h1>
	<h2>Temperature:</h2>
	<h1 id="temp">--</h1>
	<h2>Height:</h2>
	<h1 id="height">--</h1>
	<h2>Weight:</h2>
	<h1 id="weight">--</h1>
	<h2>BMI:</h2>
	<h1 id="bmi">--</h1>
	<h2>Transaction Number:</h2>
	<h2 id="transaction_no"></h2>
	<button onclick="retry()">Retry</button>
	<form id="save_all_data">
	    <button id="save">Save and Exit</button>
	</form>
	
</div>
<script>
	function retry() {
		window.location.href = "../pupclinic/dashboard.php?page=get_heart_rate";
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
					$("#heart_rate").html(resp.data.heart_rate + " bpm")
					$("#oxygen").html(resp.data.oxygen + " %")
					$("#bp").html(resp.data.bp + " bp")
					$("#temp").html(resp.data.temp + " ℃")
					$("#height").html(resp.data.height + " cm")
					$("#weight").html(resp.data.weight + " kg")
					$("#bmi").html(resp.data.bmi + " kg/m²")
					$("#transaction_no").html(resp.data.transaction_no)
				}
			}
		})
	})
	$('#save_all_data').submit(function(e){
		e.preventDefault()
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
