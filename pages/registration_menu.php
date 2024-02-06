<div class="menu_container">
    <button onclick="redirectToStudentRegistration()">Register as Student</button> 
    <button onclick="redirectToFacultyRegistration()">Register as Faculty</button>
</div>

<script>
  function redirectToStudentRegistration() {
    window.location.href = "../pupclinic/index.php?page=data_privacy&user=student";
  }
  function redirectToFacultyRegistration() {
    window.location.href = "../pupclinic/index.php?page=data_privacy&user=faculty";
  }
</script>
