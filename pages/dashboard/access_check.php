<?php

echo "<div id='status' class='assessment-container'>";
display();
echo "</div>";

$conn->close();
function display(){
  global $conn;
  $id = $_SESSION['id'];
  $userType = $_SESSION['user'];
  
  $tableName = ($userType == "guest") ? "guest" : "users";
  
  $query = "SELECT assessment_access FROM $tableName WHERE id = $id AND assessment_access IN (0, 1)";
  $result = mysqli_query($conn, $query);
  
  if(mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $accessStatus = $row['assessment_access'];

    if($accessStatus == 0) {
      echo "<h3>Your physical examination access is pending admin approval.</h3>";
      echo "<h3>Please wait for further instructions.</h3>";
    } elseif ($accessStatus == 1) {
      echo "<h3>Access to your physical examination has been granted.</h3>";
      echo "<h3>You can proceed now.</h3>";
      echo "<button class='proceed'>Proceed</button>";
    }
  }
}

  
?>
<script>
  $(document).ready(function(){
    function refreshData() {
        $.ajax({
            url: '../pupclinic/dashboard.php?page=access_check',
            success: function(data) {
                $('#status').html($(data).find('#status').html());
            },
            complete: function() {
                setTimeout(refreshData, 5000);
            }
        });
    }
    refreshData();
    $(document).on('click', '.proceed', function(){
        $.ajax({
            url:'../pupclinic/php/ajax.php?action=assessment',
            method:'POST',
            success:function(response){
                console.log(response);
                if(response == 1){
                    location.href = '../pupclinic/dashboard.php?page=get_oxygen';
                }
            }
        }); 
    });
  });
    
</script>