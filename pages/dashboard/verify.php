<div class="login-form">
    <h1>Code:</h1>
    <form id="register">
        <label for="email">Code</label>
        <input type="text" id="code" name="code" required autocomplete="off"><br>
        <button type="submit">Submit</button>
    </form>
</div>
<script>
    $('#register').submit(function(e){
        e.preventDefault()
        $.ajax({
            url:'../pupclinic/php/ajax.php?action=forgot_password2',
            method:'POST',
            data:$(this).serialize(),
            error:function(err){
                console.log(err);
                alert("An error occured");
            },
            success:function(resp){
                console.log(resp);
                if(resp == 2){
                        alert("Invalid code!");
                }else{
                    if(resp == 1){
                        location.href = '../pupclinic/dashboard.php?page=profile';
                    }else{
                        alert("503 Service Unavailable: The server is currently unable to handle the request.");
                    }
                }
                
            }
        })
    })
    
</script>
