<div class="menu_container">
    <button onclick="redirectToLoginMenu()">Login</button>
    <button onclick="redirectToRegister()">Register</button>
    <button onclick="redirectAsGuest()">Guest</button>
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
