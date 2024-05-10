<div class="measurement-container">
    <h2>Blood Pressure</h2>
    <p id="temp">-</p>
    <div>
        <form id="get_temp">
            <button id="get_temp_button">Get</button>
        </form>
    </div>
	<p> Please stand straight and hold your stance for atleast 10 seconds below the sensor </p>
</div>

<script>
    var params = <?php echo json_encode($_GET)?>;
    $('#get_temp').submit(function(e){
		e.preventDefault()
		$("#data2").text("Please wait...");
		$("#get_temp_button").hide();
		$.ajax({
			url:'../pupclinic/php/ajax.php?action=get_bp',
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
				$("#temp").text(resp + " C");
				var data = {
					resp: resp,
            	};
				$.ajax({
					url:'../pupclinic/php/ajax.php?action=save_bp',
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
