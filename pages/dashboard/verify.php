<?php
    if($_SESSION['code'] == "")
    {
        header("location:../pupclinic/dashboard.php?page=landing_page");
    }
	
?>
<div class="login-form">
    <h1>Code:</h1>
    <form id="register">
        <label for="code">Code</label>
        <input type="text" id="code" name="code" required autocomplete="off"><br>
        <button type="submit">Submit</button>
    </form>
</div>
<script>
    $('#register').submit(function(e){
        e.preventDefault()
        $.ajax({
            url:'../pupclinic/php/ajax.php?action=verify_email',
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
                    location.href = '../pupclinic/dashboard.php?page=profile';
                }
                
            }
        })
    })
    
</script>
