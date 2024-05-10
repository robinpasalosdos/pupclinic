<div class="measurement-container">
    <h2>Get Heart Rate</h2>
	<p> Gently press against the sensor and firmly hold your finger for atleast 30 seconds and wait for the readings to show up.</p>
    <p id="data2">-</p>
    
    <div class="button_container">
	<form id="get_heart_rate">
	    <button id="get_heart_rate_button">Get</button>
	</form>
	<form id="save_heart_rate">
	    <button style="display: none;" id="next">Next</button>
	    <input style="display: none;" type="text" id="data" name="data"><br>
	</form>
	
    </div>
    
</div>

<script>
    var params = <?php echo json_encode($_GET)?>;
    $('#get_heart_rate').submit(function(e){
		e.preventDefault()
		$("#data2").text("Please Wait...");
		$("#get_heart_rate_button").hide();
		$("#next").hide();
		$.ajax({
			url:'../pupclinic/php/ajax.php?action=get_heart_rate',
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
				if(data > 20 && data < 200){
				$("#data").val(resp);
				$("#data2").text(resp + " bpm");
				$("#get_heart_rate_button").show();
				$("#get_heart_rate_button").text("Retry");
				$("#next").show();
				}else{
				$("#data2").text("Please try again.");
				$("#get_heart_rate_button").show();
				$("#get_heart_rate_button").text("Retry");
				}
				$('#save_heart_rate').submit(function(e){
					e.preventDefault()
					$.ajax({
						url:'../pupclinic/php/ajax.php?action=save_heart_rate',
						type:'POST',
						data:$(this).serialize(),
						error:function(err){
							console.log(err)
							alert("An error occured");
						},
						success:function(resp){
							console.log(resp);
							if(resp == 1){
								location.href = '../pupclinic/dashboard.php?page=get_oxygen';
							}else{
								alert("An erro occured");
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
