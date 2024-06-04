<div class="measurement-container">
	<h1>Measuring Height and Weight</h1>
    <div>
        <h3 id="instruction">Step onto the weighing scale and stand up straight when you hear the buzzer.</h3>
        <img src="assets/height.png">
    </div>
	<div>
		<h2>Height:</h2>
		<h2 id="height">-</h2>
	</div>
	<div>
		<h2>Weight:</h2>
		<h2 id="weight">-</h2>
	</div>
</div>

<script>
    var params = <?php echo json_encode($_GET)?>;
		$("#data2").text("Please wait...");
		$("#get_height_button").hide();
		$.ajax({
			url:'../pupclinic/php/ajax.php?action=get_height',
			method:'POST',
			data:$(this).serialize(),
			error:err=>{
			console.log(err)
			},
			success:function(resp){
				console.log(resp);
			$.ajax({
			url: '../pupclinic/hardware/data.txt?t=' + new Date().getTime(),
			type: 'GET',
			dataType: 'text',
			success: function(resp) {
				console.log(resp);
				var data = resp.split(" ");
				console.log(data);
				$("#height").text(data[0] + " cm");
				$("#weight").text(data[1] + " kg");
				var vitals = {
					height: data[0],
					weight: data[1]
            	};
				$.ajax({
					url:'../pupclinic/php/ajax.php?action=save_height',
					type:'POST',
					data:vitals,
					error:function(err){
					console.log(err);
					alert("An error occured");
					},
					success:function(resp){
						console.log(resp);
						if(resp == 1){
							setTimeout(function() {
								location.href = '../pupclinic/dashboard.php?page=completion';
							}, 1500);
							
						}else{
							alert(resp);
						}
					}
				})

			},
			error: function(error) {
				console.error('Error:', error);
			}
			});
			}
		})
</script>
