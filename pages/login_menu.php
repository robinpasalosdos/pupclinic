<head>
  <title>Student or Faculty - PUPClinic</title>
</head>
<div class="main-menu">
    <h2>User Login Options</h2>
    <p>Please select your user type and proceed with login:</p>
    <div class="menu_container">
        <button onclick="redirectToStudentLogin()">Log in as Student</button> 
        <button onclick="redirectToFacultyLogin()">Log in as Faculty</button>    
    </div>
</div>

<script>
  function redirectToStudentLogin() {
    window.location.href = "../pupclinic/index.php?page=login&user=student";
  }
  function redirectToFacultyLogin() {
    window.location.href = "../pupclinic/index.php?page=login&user=faculty";
  }
</script>
