<div class="metrics-container">
    <h2>Get Oxygen</h2>
    <p id="data2">-</p>
    
    <div class="button_container">
	<form id="get_oxygen">
	    <button id="get_oxygen_button">Get</button>
	</form>
	<form id="save_oxygen">
	    <button style="display: none;" id="next">Next</button>
	    <input style="display: none;" type="text" id="data" name="data"><br>
	</form>
	
    </div>
    
</div>

<script>
    var params = <?php echo json_encode($_GET)?>;
    $('#get_oxygen').submit(function(e){
		e.preventDefault()
		$("#data2").text("Please Wait...");
		$("#get_oxygen_button").hide();
		$("#next").hide();
		$.ajax({
			url:'../pupclinic/php/ajax.php?action=get_oxygen',
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
				if(data > 0 && data < 101){
				$("#data").val(resp);
				$("#data2").text(resp + " %");
				$("#get_oxygen_button").show();
				$("#get_oxygen_button").text("Retry");
				$("#next").show();
				}else{
				$("#data2").text("Please try again.");
				$("#get_oxygen_button").show();
				$("#get_oxygen_button").text("Retry");
				}
				$('#save_oxygen').submit(function(e){
					e.preventDefault()
					$.ajax({
						url:'../pupclinic/php/ajax.php?action=save_oxygen',
						type:'POST',
						data:$(this).serialize(),
						error:function(err){
							console.log(err);
							alert("An error occured");
						},
						success:function(resp){
							console.log(resp);
							if(resp == 1){
								location.href = '../pupclinic/dashboard.php?page=completion';
							}else{
								alert(resp);
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
