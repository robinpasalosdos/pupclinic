<head>
  <title>Welcome to PUPClinic</title>
</head>
<a id="invisible_button" style="position: fixed; bottom: 0; right: 0; opacity: 0; z-index: 100; font-size: 30px;">
    Admin
</a>
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

  function redirectToAdmin() {
    var locationURL = "../pupclinic/index.php?page=login&user=admin";
    window.location.href = locationURL;
  }

  document.getElementById('startButton').addEventListener('click', redirectToLocation);
  document.getElementById('invisible_button').addEventListener('click', redirectToAdmin);
</script>

