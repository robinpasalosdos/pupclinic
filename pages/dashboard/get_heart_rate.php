<div class="measurement-container">
	<div>
		<h2>Measuring Blood Pressure and Heart Rate</h2>
		<h2 id="instruction">Get the blood pressure sensor, check its instructions, then press the power button to start readings.</h2>
    </div>
    <p id="bp">-</p>
    <p id="heart_rate">-</p>
</div>

<script>
    var params = <?php echo json_encode($_GET)?>;
		$.ajax({
			url:'../pupclinic/php/ajax.php?action=get_heart_rate',
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
				$("#heart_rate").text(data[1] + " bpm");
				$("#bp").text(data[0] + " mmHg");
				var vitals = {
					heart_rate: data[1],
					bp: data[0]
            	};
				$.ajax({
					url:'../pupclinic/php/ajax.php?action=save_heart_rate',
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
								location.href = '../pupclinic/dashboard.php?page=get_temp';
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
