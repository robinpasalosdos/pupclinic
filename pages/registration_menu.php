<div class="main-menu">
    <h2>User Registration Options</h2>
    <p>Please select your user type and proceed with registration:</p>
    <div class="menu_container">
        <button onclick="redirectToStudentRegistration()">Register as Student</button> 
        <button onclick="redirectToFacultyRegistration()">Register as Faculty</button>
    </div>
</div>

<script>
  function redirectToStudentRegistration() {
    window.location.href = "../pupclinic/index.php?page=policy&user=student";
  }
  function redirectToFacultyRegistration() {
    window.location.href = "../pupclinic/index.php?page=policy&user=faculty";
  }
</script>

