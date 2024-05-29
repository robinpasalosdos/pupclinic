<head>
    <title>Guest - PUPClinic</title>
</head>
<div class="login-form">
    <h1>Guest Registration Form</h1>
    <p>Please fill in the following details to register as a guest:</p>
    <form id="register">   
        <label for="name">Name</label>
        <input type="text" id="name" name="name" placeholder="Enter your name"><br>
        <label for="birthday">Birthday</label>
        <input type="date" id="birthday" name="birthday" required autocomplete="off"><br>
        <label for="sex">Sex</label>
        <select name="sex" id="sex" required>
            <option value="" disabled selected>Select your gender</option>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
        </select><br>
        <label for="email">Email</label>
        <input type="text" id="email" name="email" placeholder="Enter your email"><br>
        <button>Save</button>
    </form>
</div>
<script>
    $('#register').submit(function(e){
        e.preventDefault()
        $.ajax({
            url:'../pupclinic/php/ajax.php?action=guest_register',
            method:'POST',
            data:$(this).serialize(),
            error:function(err){
                console.log(err)
                alert("An error occured");
            },
            success:function(resp){
                if(resp == 1){
		    location.href ='dashboard.php?page=landing_page';
                }
            }
        })
    })
</script>
