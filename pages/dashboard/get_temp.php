<div class="measurement-container">
	<div>
		<h2>Measuring Temperature</h2>
		<h2 id="instruction">Place your forehead on the round opening at the top of the screen and press the button to take your temperature.</h2>
		<form id="get_temp">
			<button id="get_temp_button">Measure</button>
		</form>
    </div>
</div>

<script>
    var params = <?php echo json_encode($_GET)?>;
    $('#get_temp').submit(function(e){
		e.preventDefault()
		$("#get_temp_button").hide();
		$.ajax({
			url:'../pupclinic/php/ajax.php?action=get_temp',
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
				$("#instruction").text(resp + " C");
				var data = {
					resp: resp,
            	};
				$.ajax({
					url:'../pupclinic/php/ajax.php?action=save_temp',
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
								location.href = '../pupclinic/dashboard.php?page=get_height';
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
