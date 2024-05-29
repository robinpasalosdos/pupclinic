<head>
    <title>Forgot Password - PUPClinic</title>
</head>
<div class="login-form">
    <h1>Email:</h1>
    <form id="register">
        <label for="email">Email</label>
        <input type="text" id="email" name="email" required autocomplete="off"><br>
        <button type="submit">Submit</button>
    </form>
</div>
<script>
    $('#register').submit(function(e){
        e.preventDefault()
        $.ajax({
            url:'../pupclinic/php/ajax.php?action=forgot_password1',
            method:'POST',
            data:$(this).serialize(),
            error:function(err){
                console.log(err);
                alert("An error occured");
            },
            success:function(resp){
                console.log(resp);
                if(resp == 2){
                        alert("Email doesn't exist!");
                }else{
                    if(resp.slice(-1) == 1){
                        location.href = '../pupclinic/index.php?page=forgot_password2';
                    }else{
                        alert("503 Service Unavailable: The server is currently unable to handle the request.");
                    }
                }
                
            }
        })
    })
    
</script>
