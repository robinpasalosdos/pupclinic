<div class="metrics-container">
    <h2>Get Temperature</h2>
    <p id="data2">-</p>
    
    <div class="button_container">
	<form id="get_temp">
	    <button id="get_temp_button">Get</button>
	</form>
	<form id="save_temp">
	    <button style="display: none;" id="next">Next</button>
	    <input style="display: none;" type="text" id="data" name="data"><br>
	</form>
	
    </div>
    
</div>

<script>
    var params = <?php echo json_encode($_GET)?>;
    $('#get_temp').submit(function(e){
		e.preventDefault()
		$("#data2").text("Please Wait...");
		$("#get_temp_button").hide();
		$("#next").hide();
		$.ajax({
			url:'../pupclinic/php/ajax.php?action=get_temp',
			method:'POST',
			data:$(this).serialize(),
			error:err=>{
			console.log(err)
			},
			success:function(resp){
			$.ajax({
			url: '../pupclinic/hardware/data.txt?t=' + new Date().getTime(),
			type: 'GET',
			dataType: 'text',
			success: function(resp) {
				console.log(resp);
				var data = parseInt(resp);
				if(data > 30 && data < 43){
				$("#data").val(resp);
				$("#data2").text(resp + " ℃");
				$("#get_temp_button").show();
				$("#get_temp_button").text("Retry");
				$("#next").show();
				}else{
				$("#data2").text("Please try again.");
				$("#get_temp_button").show();
				$("#get_temp_button").text("Retry");
				}
				$('#save_temp').submit(function(e){
					e.preventDefault()
					$.ajax({
						url:'../pupclinic/php/ajax.php?action=save_temp',
						type:'POST',
						data:$(this).serialize(),
						error:function(err){
						console.log(err)
						alert("An error occured");
						},
						success:function(resp){
						if(resp == 1){
							location.href = '../pupclinic/dashboard.php?page=get_heart_rate';
						}
						}
					})
				
				})
			},
			error: function(error) {
				console.error('Error:', error);
			}
			});
			}
		})
	
    })
    

</script>
