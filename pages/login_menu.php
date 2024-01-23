<head>
    <title>Welcome</title>
</head>

<div class="main_container">
    <div class="menu_container">
        <button onclick="redirectToStudentLogin()">Student</button> 
        <button onclick="redirectToFacultyLogin()">Faculty</button>
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
