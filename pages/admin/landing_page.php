<head>
    <title>Admin - PUPClinic</title>
</head>

<div class="admin-container">
    <h1>Hello, Admin!</h1>
    <a href="../pupclinic/php/ajax.php?action=logout">logout</a>
    <div class="admin-menu">
        <button onclick="redirectToRecords()">Records</button>
        <button onclick="redirectToUsers()">Users</button>
        <button onclick="redirectToRTA()">Physical Examination</button>
        <button onclick="redirectToPA()">Health Examination</button>
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
    window.location.href = "../pupclinic/admin.php?page=post_assessment&search=";
  }
</script>
