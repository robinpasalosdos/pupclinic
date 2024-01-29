<?php
    if($_SESSION['height'] == ""){
	header("location:../pupclinic/dashboard.php?page=landing_page");
    }
?>
<div class="metrics-container">
    <h2>Get Heart Rate</h2>
    <p id="data2">-</p>
    
    <div class="button_container">
	<form id="get_heart_rate">
	    <button id="get_heart_rate_button">Get</button>
	</form>
	<form id="save_heart_rate">
	    <button id="next">Finish</button>
	    <input style="display: none;" type="text" id="data" name="data"><br>
	</form>
	
    </div>
    
</div>

<script>
    var params = <?php echo json_encode($_GET)?>;
    $('#get_heart_rate').submit(function(e){
	$("#data2").text("Please Wait...");
	$("#get_heart_rate_button").hide();
	$("#next").hide();
	e.preventDefault()
	$.ajax({
	    url:'../pupclinic/php/ajax.php?action=get_heart_rate',
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
		    $("#get_heart_rate_button").show();
		    $("#get_heart_rate_button").text("Retry");
		    $("#next").show();
		    $('#save_heart_rate').submit(function(e){
			$.ajax({
			    url:'../pupclinic/php/ajax.php?action=save_heart_rate',
			    type:'POST',
			    data:$(this).serialize(),
			    error:function(err){
				console.log(err)
				alert("An error occured");
			    },
			    success:function(resp){
				if(resp == 1){
				    location.href = '../pupclinic/dashboard.php?page=completion';
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
