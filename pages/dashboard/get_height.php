<div class="measurement-container">
    <h2>Height</h2>
    <p id="data2">-</p>
    <div>
        <form id="get_height">
            <button id="get_height_button">Get</button>
        </form>
    </div>
	<p> Please stand straight and hold your stance for atleast 10 seconds below the sensor </p>
</div>

<script>
    var params = <?php echo json_encode($_GET)?>;
    $('#get_height').submit(function(e){
		e.preventDefault()
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
			$.ajax({
			url: '../pupclinic/hardware/data.txt?t=' + new Date().getTime(),
			type: 'GET',
			dataType: 'text',
			success: function(resp) {
				console.log(resp);
				$("#data2").text(resp + " cm");
				var data = {
					resp: resp,
            	};
				$.ajax({
					url:'../pupclinic/php/ajax.php?action=save_height',
					type:'POST',
					data:data,
					error:function(err){
					console.log(err);
					alert("An error occured");
					},
					success:function(resp){
						console.log(resp);
						if(resp == 1){
							location.href = '../pupclinic/dashboard.php?page=get_weight';
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
