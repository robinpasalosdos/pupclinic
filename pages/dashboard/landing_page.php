<head>
    <title>Welcome</title>
</head>
<?php 
  include('../pupclinic/php/db_connect.php');
  $id = $_SESSION['id'];
  $query = "SELECT assessment_status FROM records WHERE user_id = $id AND assessment_status = 0;";
  $result = mysqli_query($conn, $query);
  
  if(mysqli_num_rows($result) > 0)
  {
    ?>
    <a class ="logout-button-a" href="../pupclinic/php/ajax.php?action=logout">logout</a>
    <div class="menu_container">
	<p>Waiting</p>
    </div>
    <?php
  }else{
    ?>
    <a class ="logout-button-a" href="../pupclinic/php/ajax.php?action=logout">logout</a>
    <div class="menu_container">
      <form id="check_up">
	  <button >Initial Monitoring</button>
      </form>
    <button onclick="redirectToYourRecords()">View Your Records</button>
    </div>
    <?php
  }
?>
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
				    alert("Error");
				}
			}
		})
	})
</script>
