<p id="name">-</p>
<p id="user_type">-</p>
<p id="user_type">Ongoing</p>
<form id="delete_ongoing">
	<button>Delete</button>
</form>
<p id="height"></p>
<p id="heart_rate"></p>
<p id="oxygen"></p>
<script>
	$(document).ready(function(){
		$.ajax({
			url:'../pupclinic/php/ajax.php?action=display_ongoing_check_up',
			type:'POST',
			data:$(this).serialize(),
			dataType: 'json',
			error:function(err){
				console.log(err);
				alert("An error occured");
			},
			success:function(resp){
				console.log(resp);
				if (resp.status == 1) {
					$("#name").html(resp.data.name);
					$("#user_type").html(resp.data.user_type);
				} else if (resp.status == 2) {
					console.log(resp);
				} else {
					console.log("Unknown response status:", resp);
				}

			}
		})
	})
	$('#delete_ongoing').submit(function(e){
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
					alert("Deleted!");
				}
			}
		})
	})
</script>
