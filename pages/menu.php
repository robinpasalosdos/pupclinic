<head>
  <title>User Portal - PUPClinic</title>
</head>
<div class="main-menu">
    <h2>User Options</h2>
    <p>Please select one of the following options:</p>
    <div class="menu_container">
        <button onclick="redirectToLoginMenu()">Login</button>
        <button onclick="redirectToRegister()">Register</button>
        <button onclick="redirectAsGuest()">Guest</button>
    </div>
</div>

<script>
  function redirectToLoginMenu() {
    window.location.href = "../pupclinic/index.php?page=login_menu";
  }
  function redirectToRegister() {
    window.location.href = "../pupclinic/index.php?page=registration_menu";
  }
  function redirectAsGuest() {
    window.location.href = "../pupclinic/index.php?page=guest_registration";
  }
</script>
