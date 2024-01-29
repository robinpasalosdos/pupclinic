<head>
    <title>Welcome Admin</title>
</head>

<div class="admin-container">
    <h1>Admin Landing Page</h1>
    <a href="../pupclinic/php/ajax.php?action=logout">logout</a>
    <div class="admin-menu">
        <button onclick="redirectToRecords()">Records</button>
        <button onclick="redirectToUsers()">Users</button>
        <button onclick="redirectTo()">Real-Time Assessment</button>
    </div>
</div>
<script>
  function redirectToRecords() {
    window.location.href = "../pupclinic/admin.php?page=records&search=";
  }
  function redirectToUsers() {
    window.location.href = "../pupclinic/admin.php?page=users&search=";
  }
  function redirectTo() {
    window.location.href = "../pupclinic/admin.php?page=assessment";
  }
</script>
