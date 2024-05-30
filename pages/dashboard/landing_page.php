<head>
    <title>Welcome</title>
</head>
<?php 
  include('../pupclinic/php/db_connect.php');
  $id = $_SESSION['id'];
  $query = "SELECT assessment_status FROM records WHERE user_id = $id AND assessment_status = 1;";
  $result = mysqli_query($conn, $query);
  
  if(mysqli_num_rows($result) > 0){ ?>
    <a class ="logout-button-a" href="../pupclinic/php/ajax.php?action=logout">logout</a>
    <div class="waiting-container">
	    <p>The physical examination is complete. Please proceed to the clinic staff for health interview. You can now log-out.</p>
    </div>
    <?php }else{ ?>
      <a class ="logout-button-a" href="../pupclinic/php/ajax.php?action=logout">logout</a>
      <div class="main-menu">
          <h2>Welcome to PupClinic Dashboard</h2>
          <p>Manage your health and records efficiently.</p>
          <div class="menu_container">
          <?php if($_SESSION['user'] == "guest"){?>
            <button onclick="redirectToAssessment()">Physical Examination</button>
          <?php }else{ ?>
            <button onclick="redirectToAssessment()">Physical Examination</button>
            <button onclick="redirectToYourRecords()">Check Your Health Record</button>
            <button onclick="redirectToYourProfile()">Your Profile</button>
          <?php } ?>
          </div>
      </div>
    <?php } ?>
<script>
  function redirectToYourRecords() {
    window.location.href = "../pupclinic/dashboard.php?page=patient_records&search=";
  }
  function redirectToYourProfile() {
    window.location.href = "../pupclinic/dashboard.php?page=profile";
  }
  function redirectToAssessment() {
    window.location.href = "../pupclinic/dashboard.php?page=discomfort_rate";
  }
</script>
