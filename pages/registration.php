<?php if($_GET['user'] == 'student'): ?>
    <form id="register">
        <label for="student_no">Student Number</label><br>
        <input type="text" id="student_no" name="student_no"><br>
        <label for="name">Name</label><br>
        <input type="text" id="name" name="name"><br>
        <label for="course">Course</label><br>
        <input type="text" id="course" name="course"><br>
        <label for="year">Year</label>
        <select name="year" id="year" require>
                
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
    
        </select><br>
        
        <label for="section">Section</label><br>
        <input type="text" id="section" name="section"><br>
        <label for="email">Email</label><br>
        <input type="text" id="email" name="email"><br>
        <label for="password">Password</label><br>
        <input type="password" id="password" name="password"><br>
        <button>Save</button>
    </form>
<?php endif; ?>
<?php if($_GET['user'] == 'faculty'): ?>
    <form id="register">   
        <label for="name">Name</label><br>
        <input type="text" id="name" name="name"><br>
        <label for="email">Email</label><br>
        <input type="text" id="email" name="email"><br>
        <label for="password">Password</label><br>
        <input type="password" id="password" name="password"><br>
        <button>Save</button>
    </form>
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
            }
        })
    })
</script>
