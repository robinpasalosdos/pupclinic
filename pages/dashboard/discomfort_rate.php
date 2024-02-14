<div class="main-menu">
    <h2>Discomfort Rate</h2>
    <p>Please select the level of discomfort you are experiencing based on the scale provided below.</p>
    <div class="discomfort-container">
        <form id="save_rate">
            <input type="radio" id="rate1" name="discomfort" value="1">
            <label for="rate1">1 - Minimal discomfort</label><br>

            <input type="radio" id="rate2" name="discomfort" value="2">
            <label for="rate2">2 - Slight discomfort</label><br>

            <input type="radio" id="rate3" name="discomfort" value="3">
            <label for="rate3">3 - Bearable discomfort</label><br>

            <input type="radio" id="rate4" name="discomfort" value="4">
            <label for="rate4">4 - Moderate discomfort</label><br>

            <input type="radio" id="rate5" name="discomfort" value="5">
            <label for="rate5">5 - Noticeable discomfort</label><br>

            <input type="radio" id="rate6" name="discomfort" value="6">
            <label for="rate6">6 - Uncomfortable</label><br>

            <input type="radio" id="rate7" name="discomfort" value="7">
            <label for="rate7">7 - Quite uncomfortable</label><br>

            <input type="radio" id="rate8" name="discomfort" value="8">
            <label for="rate8">8 - Very uncomfortable</label><br>

            <input type="radio" id="rate9" name="discomfort" value="9">
            <label for="rate9">9 - Extremely uncomfortable</label><br>

            <input type="radio" id="rate10" name="discomfort" value="10">
            <label for="rate10">10 - Intolerable discomfort</label><br><br>

            <input type="submit" value="Submit">
        </form>
    </div>  
</div>
<script>
	$('#save_rate').submit(function(e){
    e.preventDefault()
	var discomfort_rate = $("input[name='discomfort']:checked").val();
	var data = {discomfort_rate: discomfort_rate};
		$.ajax({
			url:'../pupclinic/php/ajax.php?action=save_discomfort_rate',
			type:'POST',
			data:data,
			error:function(err){
				console.log(err);
				alert("An error occured");
			},
			success:function(resp){
				console.log(resp);
				if(resp == 1 || resp == 0){
					location.href = '../pupclinic/dashboard.php?page=access_check';
				}
			}
		})
	})
</script>