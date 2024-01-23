<div class="container">
    <h2>Get Oxygen</h2>
    <p id="data2">-</p>
    
    <div class="button_container">
	<form id="get_height">
	    <button id="get_height_button">Get</button>
	</form>
	<form id="save_height">
	    <button id="next">Next</button>
	    <input style="display: none;" type="text" id="data" name="data"><br>
	</form>
	
    </div>
    
</div>

<script>
    var params = <?php echo json_encode($_GET)?>;
    $('#get_height').submit(function(e){
	$("#data2").text("Please Wait...");
	$("#get_height_button").hide();
	$("#next").hide();
	e.preventDefault()
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
		    $("#data").val(resp);
		    $("#data2").text(resp);
		    $("#get_height_button").show();
		    $("#get_height_button").text("Retry");
		    $("#next").show();
		    $('#save_height').submit(function(e){
			$.ajax({
			    url:'../pupclinic/php/ajax.php?action=save_height',
			    type:'POST',
			    data:$(this).serialize(),
			    error:function(err){
				console.log(err)
				alert("An error occured");
			    },
			    success:function(resp){
				location.href = '../pupclinic/dashboard.php?page=get_heart_rate';
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
