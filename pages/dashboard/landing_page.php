<head>
    <title>Welcome</title>
</head>
<a href="../pupclinic/php/ajax.php?action=logout">logout</a>

<button onclick="redirectTo()">Initial Monitoring</button>
<button onclick="redirectToYourRecords()">View Your Records</button>


<script>
  function redirectTo() {
    window.location.href = "../pupclinic/dashboard.php?page=get_height";
  }
  function redirectToYourRecords() {
    window.location.href = "../pupclinic/dashboard.php?page=patient_records";
  }
</script>
