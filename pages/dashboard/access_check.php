<?php

echo "<div id='status' class='assessment-container'>";
display();
echo "</div>";

$conn->close();
function display(){
  global $conn;
  $id = $_SESSION['id'];
  $query = "SELECT assessment_access FROM users WHERE id = $id AND assessment_access = 0;";
  $result = mysqli_query($conn, $query);
  if(mysqli_num_rows($result) > 0)
  {
    echo "<h3>Your assessment access is pending approval from the admin.</h3>";
    echo "<h3>Please wait for further instructions.</h3>";
  }

  $query = "SELECT assessment_access FROM users WHERE id = $id AND assessment_access = 1;";
  $result = mysqli_query($conn, $query);
  if(mysqli_num_rows($result) > 0)
  {

    echo "<h3>Your assessment access has been granted.</h3>";
    echo "<h3> You can proceed with the assessment now.</h3>";
    echo "<button class='proceed'>Proceed to Assessment</button>";

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
                    location.href = '../pupclinic/dashboard.php?page=get_height';
                }
            }
        }); 
    });
  });
    
</script>