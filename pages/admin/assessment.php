<?php 
	include('../pupclinic/php/db_connect.php');
	$query = "SELECT * FROM records WHERE assessment_status = 0;";
	$query_run = mysqli_query($conn, $query);

	if(mysqli_num_rows($query_run) > 0)
	{
		foreach($query_run as $items)
		{
			?>
			<div class="queue_card">
				<p>Name:&nbsp;<?= $items['name']; ?></p>
				<p>User Type:&nbsp;<?= $items['user_type']; ?></p>
				<p>Height:&nbsp;<?= $items['height']; ?>&nbsp;cm</p>
				<p>Heart Rate:&nbsp;<?= $items['heart_rate']; ?></p>
				<p>Oxygen:&nbsp;<?= $items['oxygen']; ?></p>
				<p>Transaction no.: PUP-<?= $items['transaction_no']; ?>-CLI</p>
				<button class="assess">Assess</button>
			</div>
			<?php
		}
	}
?>
<div class="card">
	<p id="name">-</p>
	<p id="user_type">-</p>
	<p>Ongoing</p>
	<button id="delete_ongoing">Remove</button>
</div>
<div id="no_user">
	<p>No User</p>
</div>	
	
<script>
	$(document).ready(function(){
		$.ajax({
			url:'../pupclinic/php/ajax.php?action=display_ongoing_check_up',
			type:'POST',
			data:$(this).serialize(),
			dataType: 'json',
			error:function(err){
				console.log(err);
				alert("An error");
			},
			success:function(resp){
				console.log(resp);
				if (resp.status == 1) {
					$(".card").show();
					$("#name").html(resp.data.name);
					$("#user_type").html(resp.data.user_type);
				} else if (resp.status == 0) {
					console.log(resp);
				} else {
					console.log("Unknown response status:", resp);
				}

			}
		})
	})
	$('#delete_ongoing').click(function(e){
		$.ajax({
			url:'../pupclinic/php/ajax.php?action=delete_ongoing',
			type:'POST',
			data:$(this).serialize(),
			error:function(err){
				console.log(err);
				alert("An error occured");
			},
			success:function(resp){
				if(resp == 1){
					console.log(resp);
				}
			}
		})
	})
</script>
