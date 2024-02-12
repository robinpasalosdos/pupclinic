<head>
    <title>Welcome Admin</title>
</head>

<div class="admin-container">
    <h1>Hello, Admin!</h1>
    <a href="../pupclinic/php/ajax.php?action=logout">logout</a>
    <div class="admin-menu">
        <button onclick="redirectToRecords()">Records</button>
        <button onclick="redirectToUsers()">Users</button>
        <button onclick="redirectToRTA()">Real-Time Assessment</button>
        <button onclick="redirectToPA()">Post-Assessment</button>
    </div>
</div>
<script>
  function redirectToRecords() {
    window.location.href = "../pupclinic/admin.php?page=records&search=";
  }
  function redirectToUsers() {
    window.location.href = "../pupclinic/admin.php?page=users&search=";
  }
  function redirectToRTA() {
    window.location.href = "../pupclinic/admin.php?page=assessment";
  }
  function redirectToPA() {
    window.location.href = "../pupclinic/admin.php?page=post_assessment";
  }
</script>
