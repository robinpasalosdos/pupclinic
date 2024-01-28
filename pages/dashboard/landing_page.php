<head>
    <title>Welcome</title>
</head>
<a href="../pupclinic/php/ajax.php?action=logout">logout</a>

<button onclick="redirectTo()">Initial Monitoring</button>


<script>
  function redirectTo() {
    window.location.href = "../pupclinic/dashboard.php?page=get_height";
  }
</script>
