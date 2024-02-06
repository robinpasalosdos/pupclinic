<?php if($_GET['user'] == 'student'): ?>
    <div class="login-form">
        <h1>Register as Student</h1>
        <form id="register">
            <label for="name">Name</label>
            <input type="text" id="name" name="name" required autocomplete="off"><br>
            <label for="birthday">Birthday</label>
            <input type="date" id="birthday" name="birthday" required autocomplete="off"><br>
            <label for="sex">Sex</label>
            <select name="sex" id="sex" required>
                <option value="" disabled selected></option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
            </select><br>
            <label for="student_no">Student Number</label>
            <input type="text" id="student_no" name="student_no" required autocomplete="off"><br>
            <label for="course">Course</label>
            <input type="text" id="course" name="course" required autocomplete="off"><br>
            <label for="year">Year</label>
            <select name="year" id="year" required>
                <option value="" disabled selected></option>   
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
            <label for="password2">Retype Password</label>
            <input type="password" id="password2" name="password2" required autocomplete="off"><br>
            <input type="text" id="user" name="user" value="<?php echo $_GET['user']; ?>" style="display: none;"><br>
            <button type="submit">Next</button>
        </form>
    </div>
<?php endif; ?>
<?php if($_GET['user'] == 'faculty'): ?>
    <div class="login-form">
        <h1>Register as Faculty</h1>
        <form id="register">   
            <label class="label" for="name">Name</label>
            <input class="reg_input" type="text" id="name" name="name" required autocomplete="off"><br>
            <label class="label" for="birthday">Birthday</label>
            <input class="reg_input" type="date" id="birthday" name="birthday" required autocomplete="off"><br>
            <label class="label" for="sex">Sex</label>
            <select class="reg_input" name="sex" id="sex" required>
                <option value="" disabled selected></option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
            </select><br>
            <label class="label" for="email">Email</label>
            <input class="reg_input" type="text" id="email" name="email" required autocomplete="off"><br>
            <label class="label" for="password">Password</label>
            <input class="reg_input" type="password" id="password" name="password" required autocomplete="off"><br>
            <label class="label" for="password2">Retype Password</label>
            <input class="reg_input" type="password" id="password2" name="password2" required autocomplete="off"><br>
            <input type="text" id="user" name="user" value="<?php echo $_GET['user']; ?>" style="display: none;"><br>
            <button type="submit">Next</button>
        </form>
    </div>
<?php endif; ?>
<script>
    var params = <?php echo json_encode($_GET)?>;
    $('#register').submit(function(e){
        e.preventDefault()
        $.ajax({
            url:'../pupclinic/php/ajax.php?action=send_otp',
            method:'POST',
            data:$(this).serialize(),
            error:function(err){
                console.log(err);
                alert("An error occured");
            },
            success:function(resp){
                console.log(resp);
                if(resp.slice(-1) == 1){
                    location.href = '../pupclinic/index.php?page=verify&user='+params['user'];
                }
                if(resp == 2){
                    alert("Email already exists!");
                }
                if(resp == 3){
                    alert("Password didn't match!");
                }
            }
        })
    })
    $("#getOTP").click(function(){
        var email = $("#email").val().trim();
        if( email != ""){
            var data = {
                randOtp: randOtp,
                email: email
            };
            $.ajax({
                url:'../pupclinic/php/ajax.php?action=send_otp',
                method:'POST',
                data:data,
                success:function(response){
                    console.log(response)

                }
            });
        }
    });
    
</script>
