<?php 
  include('../pupclinic/php/db_connect.php');
  $id = $_SESSION['id'];
  $query = "SELECT assessment_access FROM users WHERE id = $id AND assessment_access = 0;";
  $result = mysqli_query($conn, $query);
  if(mysqli_num_rows($result) > 0)
  {
    ?>
    <div class="assessment-container">
        <h3>Your assessment access is pending approval from the admin.</h3>
        <h3>Please wait for further instructions.</h3>
    </div>
    <?php
  }
  $query = "SELECT assessment_access FROM users WHERE id = $id AND assessment_access = 1;";
  $result = mysqli_query($conn, $query);
  if(mysqli_num_rows($result) > 0)
  {
    ?>

<div class="assessment-container">
    <h3>Your assessment access has been granted.</h3>
    <h3> You can proceed with the assessment now.</h3>
    <button id="proceed">Proceed to Assessment</button>
  </div>

    <?php
  }
?>
<script>
    $("#proceed").click(function(){
        $.ajax({
            url:'../pupclinic/php/ajax.php?action=assessment',
            method:'POST',
            success:function(response){
                console.log(response);
                if(response == 1){
                    location.href = '../pupclinic/dashboard.php?page=get_height';
                }
            }
        }); 
    });
</script>