<div class="measurement-container">
	<h2>Blood Pressure</h2>
    <p id="bp">-</p>
    <h2>Heart Rate</h2>
    <p id="heart_rate">-</p>
    <div>
        <form id="get_heart_rate">
            <button id="get_heart_rate_button">Get</button>
        </form>
    </div>
	<p> Please stand straight and hold your stance for atleast 10 seconds below the sensor </p>
</div>

<script>
    var params = <?php echo json_encode($_GET)?>;
    $('#get_heart_rate').submit(function(e){
		e.preventDefault()
		$("#data2").text("Please wait...");
		$("#get_heart_rate_button").hide();
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
	
    })
</script>
