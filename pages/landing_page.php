<div class="main_container">
    <img alt="pup-logo" src="../pupclinic/assets/PUP-Logo.png">
    <h1>PUP CLINIC</h1>
    <button onclick="redirectToLocation()">Start</button>
</div>
    

<script>
  function redirectToLocation() {
    // Define the location URL
    var locationURL = "../pupclinic/index.php?page=menu";

    // Redirect to the specified location
    window.location.href = locationURL;
  }
</script>
