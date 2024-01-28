<head>
    <title>Welcome Admin</title>
</head>
<h1>
    Admin Landing Page
</h1>
<a href="../pupclinic/php/ajax.php?action=logout">logout</a>
<button onclick="redirectToRecords()">Records</button>
<button onclick="redirectToUsers()">Users</button>
<button onclick="redirectTo()">Real-Time Assessment</button>

<script>
  function redirectToRecords() {
    window.location.href = "../pupclinic/admin.php?page=records&search=";
  }
  function redirectToUsers() {
    window.location.href = "../pupclinic/admin.php?page=users&search=";
  }
  function redirectTo() {
    window.location.href = "../pupclinic/admin.php?page=real_time_assessment";
  }
</script>
