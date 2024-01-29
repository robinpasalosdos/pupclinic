<?php 
	include('../pupclinic/php/db_connect.php');
	$query = "SELECT * FROM records ORDER BY created_timestamp DESC;";
	$query_run = mysqli_query($conn, $query);

	if(mysqli_num_rows($query_run) > 0)
	{
		foreach($query_run as $items)
		{
			?>
			<div class="card">
				<p><?= $items['name']; ?></p>
				<p><?= $items['user_type']; ?></p>
				<p><?= $items['height']; ?></p>
				<p><?= $items['heart_rate']; ?></p>
				<p><?= $items['oxygen']; ?></p>
				<p><?= $items['transaction_no']; ?></p>
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
	<button id="delete_ongoing">Delete</button>
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
					$("#no_user").show();
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
