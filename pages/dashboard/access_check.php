<script>
    $(document).ready(function(){
		$.ajax({
			url:'../pupclinic/php/ajax.php?action=check_access',
			method:'POST',
			data:$(this).serialize(),
			error:err=>{
				console.log(err)
			},
			success:function(resp){
				resp = JSON.parse(resp)
				if(resp.status == 1){
					$("#height").html(resp.data.height + " cm")
					$("#temp").html(resp.data.temp + " ℃")
					$("#heart_rate").html(resp.data.heart_rate + " bpm")
					$("#oxygen").html(resp.data.oxygen + " %")
					$("#transaction_no").html(resp.data.transaction_no)
				}
			}
		})
	})
</script>