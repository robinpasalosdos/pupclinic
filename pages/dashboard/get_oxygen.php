<div class="measurement-container">
    <div>
		<h2>Measuring Oxygen Saturation Level</h2>
		<h2 id="instruction"> Please place your index finger on the pulse oximeter then press the button for a reading,.</h2>
		<h2 id="oxygen_label" style="display: none;">Oxygen</h2>
    	<p style="display: none;" id="oxygen">-</p>
		<form id="get_oxygen">
			<button id="get_oxygen_button">Measure</button>
		</form>
    </div>
</div>

<script>
    var params = <?php echo json_encode($_GET)?>;
    $('#get_oxygen').submit(function(e){
		e.preventDefault()
		$("#oxygen_label").show();
		$("#oxygen").show();
		$("#oxygen").text("Measuring...");
		$("#get_oxygen_button").hide();
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
