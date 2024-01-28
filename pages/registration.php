<?php if($_GET['user'] == 'student'): ?>
    <div class="login-form">
        <h1>Register as Student</h1>
        <form id="register">
            <label for="student_no">Student Number</label>
            <input type="text" id="student_no" name="student_no" required autocomplete="off"><br>
            <label for="name">Name</label>
            <input type="text" id="name" name="name" required autocomplete="off"><br>
            <label for="course">Course</label>
            <input type="text" id="course" name="course" required autocomplete="off"><br>
            <label for="year">Year</label>
            <select name="year" id="year" require>   
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
            </select><br>
            <label for="section">Section</label>
            <input type="text" id="section" name="section" required autocomplete="off"><br>
            <label for="email">Email</label>
            <input type="text" id="email" name="email" required autocomplete="off"><br>
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required autocomplete="off"><br>
            <button>Save</button>
        </form>
    </div>
<?php endif; ?>
<?php if($_GET['user'] == 'faculty'): ?>
    <div class="login-form">
        <h1>Register as Faculty</h1>
        <form id="register">   
            <label for="name">Name</label>
            <input type="text" id="name" name="name" required autocomplete="off"><br>
            <label for="email">Email</label>
            <input type="text" id="email" name="email" required autocomplete="off"><br>
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required autocomplete="off"><br>
            <button>Save</button>
        </form>
    </div>
<?php endif; ?>
<script>
    var params = <?php echo json_encode($_GET)?>;
    $('#register').submit(function(e){
        e.preventDefault()
        $.ajax({
            url:'../pupclinic/php/ajax.php?action='+params['user']+'_register',
            method:'POST',
            data:$(this).serialize(),
            error:function(err){
                console.log(err)
                alert("An error occured");
            },
            success:function(resp){
                if(resp == 1){
                        alert("Registered Successfully!");
                        location.href ='index.php?page=login&user='+params['user'];
                }
                if(resp == 2){
                        alert("Email already exists!");
                }
            }
        })
    })
</script>
