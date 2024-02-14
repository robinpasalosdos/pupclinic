<div class="main_container">
    <img alt="pup-logo" src="../pupclinic/assets/PUP-Logo.png">
    <h1>PUP CLINIC</h1>
    <button id="startButton">Start</button>
</div>   

<script>
  function redirectToLocation() {
    var locationURL = "../pupclinic/index.php?page=menu";
    window.location.href = locationURL;
  }

  document.getElementById('startButton').addEventListener('click', redirectToLocation);
</script>

