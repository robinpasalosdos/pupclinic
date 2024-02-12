<div class="login-form">
    <h1>Change Your Password:</h1>
    <form id="register">
        <label for="password">Code</label>
        <input type="password" id="password" name="password" required autocomplete="off"><br>
        <label for="password2">Code</label>
        <input type="password" id="password2" name="password2" required autocomplete="off"><br>
        <button type="submit">Submit</button>
    </form>
</div>
<script>
    $('#register').submit(function(e){
        e.preventDefault()
        $.ajax({
            url:'../pupclinic/php/ajax.php?action=forgot_password3',
            method:'POST',
            data:$(this).serialize(),
            error:function(err){
                console.log(err);
                alert("An error occured");
            },
            success:function(resp){
                console.log(resp);
                if(resp == 2){
                        alert("Password didn't match!");
                }else{
                    if(resp){
                        location.href = '../pupclinic/index.php?page=login&user='+resp;
                    }else{
                        alert("503 Service Unavailable: The server is currently unable to handle the request.");   
                    }
                }
                
            }
        })
    })
    
</script>
