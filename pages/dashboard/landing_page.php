<head>
    <title>Welcome</title>
</head>
<a href="../pupclinic/php/ajax.php?action=logout">logout</a>
<form id="check_up">
  <button>Initial Monitoring</button>
</form>

<button onclick="redirectToYourRecords()">View Your Records</button>


<script>
  function redirectToYourRecords() {
    window.location.href = "../pupclinic/dashboard.php?page=patient_records&search=";
  }
  $('#check_up').submit(function(e){
		$.ajax({
			url:'../pupclinic/php/ajax.php?action=create_initial_record',
			type:'POST',
			data:$(this).serialize(),
			error:function(err){
				console.log(err);
				alert("An error occured");
			},
			success:function(resp){
				console.log(resp);
				if(resp == 1){
					location.href = '../pupclinic/dashboard.php?page=get_height';
				}else{
				    alert("Someone Using");
				}
			}
		})
	})
</script>
