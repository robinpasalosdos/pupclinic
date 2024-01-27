<div class="main_container">
    <div class="container">
        <div class="index_lp_1">
            <img alt="pup-logo" src="../pupclinic/assets/pup-logo.png">
        </div>
        <div class="index_lp_2">
            <h1>PUP CLINIC</h1>
        </div>
    </div>
    <div class="button_container">
        <button onclick="redirectToLocation()">Start</button>
    </div>
</div>
    

<script>
  function redirectToLocation() {
    // Define the location URL
    var locationURL = "../pupclinic/index.php?page=menu";

    // Redirect to the specified location
    window.location.href = locationURL;
  }
</script>
