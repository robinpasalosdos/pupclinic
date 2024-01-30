<div class="records-table">
    <table class="queue_card"></table>
</div>
<div id="card" class="card">
    <div class="metrics-container">
        <p id="name">-</p>
        <p id="user_type">-</p>
        <p id="status_ongoing">Ongoing</p>
        <button id="delete_ongoing">Remove</button>
    </div>
</div>
<script>
	$(document).ready(function(){
		var renderServe = setInterval(function(){
			$.ajax({
				url:'../pupclinic/php/ajax.php?action=display_realtime_records',
				type:'POST',
				data:$(this).serialize(),
				error:function(err){
					console.log(err);
					alert("An error occured");
				},
				success:function(resp){
					resp = JSON.parse(resp)
					$(".queue_card").html(resp.contents);
				}
			})
			$.ajax({
				url:'../pupclinic/php/ajax.php?action=display_ongoing_check_up',
				type:'POST',
				data:$(this).serialize(),
				error:function(err){
					console.log(err);
					alert("An error");
				},
				success:function(resp){
					console.log(resp);
					resp = JSON.parse(resp)
					if (resp.status == 1) {
						$("#card").show();
						$("#name").html(resp.data.name);
						$("#user_type").html(resp.data.user_type);
					} else if (resp.status == 0) {
		
					} else {
						console.log("Unknown response status:", resp);
					}

				}
			})
		},1000)
	})

</script>
