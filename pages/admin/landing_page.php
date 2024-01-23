<head>
    <title>Welcome Admin</title>
</head>
<h1>
    Admin Landing Page
</h1>
<a href="../pupclinic/php/ajax.php?action=logout">logout</a>
<button onclick="redirectTo()">Records</button>


<script>
  function redirectTo() {
    window.location.href = "../pupclinic/admin.php?page=records";
  }
</script>
