<div class="measurement-container">
    <h2>Weight</h2>
    <p id="data2">-</p>
    <div>
        <form id="get_weight">
            <button id="get_weight_button">Get</button>
        </form>
        <form id="save_weight">
            <button style="display: none;" id="next">Next</button>
            <input style="display: none;" type="text" id="data" name="data"><br>
        </form>
    </div>
	<p> Carefully stand on the weighing scale and observe for atleast 10 seconds. </p>
</div>

<script>
    var params = <?php echo json_encode($_GET)?>;
    $('#get_weight').submit(function(e){
		e.preventDefault()
		$("#data2").text("Please wait...");
		$("#get_weight_button").hide();
		$("#next").hide();
		$.ajax({
			url:'../pupclinic/php/ajax.php?action=get_weight',
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
				if(data > 0 && data < 201){
				$("#data").val(resp);
				$("#data2").text(resp + " cm");
				$("#get_weight_button").show();
				$("#get_weight_button").text("Retry");
				$("#next").show();
				}else{
				$("#data2").text("Please try again.");
				$("#get_weight_button").show();
				$("#get_weight_button").text("Retry");
				}
				
				$('#save_weight').submit(function(e){
					e.preventDefault()
					$.ajax({
						url:'../pupclinic/php/ajax.php?action=save_weight',
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
