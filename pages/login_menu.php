<head>
    <title>Welcome</title>
</head>

<div class="menu_container">
    <button onclick="redirectToStudentLogin()">Log in as Student</button> 
    <button onclick="redirectToFacultyLogin()">Log in as Faculty</button>
</div>

<script>
  function redirectToStudentLogin() {
    window.location.href = "../pupclinic/index.php?page=login&user=student";
  }
  function redirectToFacultyLogin() {
    window.location.href = "../pupclinic/index.php?page=login&user=faculty";
  }
</script>
