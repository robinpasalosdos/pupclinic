<div class="measurement-container">
	<h1>Measuring Oxygen Saturation Level</h1>
	<h3 id="instruction">Please place your middle finger on the pulse oximeter, then press the button to get a reading.</h3>
	<form id="get_oxygen">
		<button id="get_oxygen_button">Measure</button>
	</form>
	<div id="oxygen_con" style="display: none;">
		<h2>Oxygen Saturation Level:</h2>
		<h2 id="oxygen">-</h2>
	</div>
</div>
<script>
    var params = <?php echo json_encode($_GET)?>;
    $('#get_oxygen').submit(function(e){
		e.preventDefault()
		$("#oxygen_con").show();
		$("#oxygen").text("Measuring...");
		$("#get_oxygen").hide();
		$.ajax({
			url:'../pupclinic/php/ajax.php?action=get_oxygen',
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
				$("#oxygen").text(resp + " %");
				var data = {
					resp: resp,
            	};
				$.ajax({
					url:'../pupclinic/php/ajax.php?action=save_oxygen',
					type:'POST',
					data:data,
					error:function(err){
					console.log(err);
					alert("An error occured");
					},
					success:function(resp){
						console.log(resp);
						if(resp == 1){
							setTimeout(function() {
								location.href = '../pupclinic/dashboard.php?page=get_heart_rate';
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
