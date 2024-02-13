<?php 
  include('../pupclinic/php/db_connect.php');
  $id = $_SESSION['id'];
  $query = "SELECT assessment_access FROM users WHERE id = $id AND assessment_access = 0;";
  $result = mysqli_query($conn, $query);
  if(mysqli_num_rows($result) > 0)
  {
    ?>
    <p>Please wait for admin approval</p>
    <?php
  }
  $query = "SELECT assessment_access FROM users WHERE id = $id AND assessment_access = 1;";
  $result = mysqli_query($conn, $query);
  if(mysqli_num_rows($result) > 0)
  {
    ?>
    <p>You have an access</p>
    <button id="proceed">Proceed</button>
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