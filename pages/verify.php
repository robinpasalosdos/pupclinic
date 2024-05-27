<div class="login-form">
    <h1>Code:</h1>
    <form id="register">
        <label for="code">Code</label>
        <input type="text" id="code" name="code" required autocomplete="off"><br>
        <button type="submit">Submit</button>
    </form>
</div>
<script>
    var params = <?php echo json_encode($_GET)?>;
    $('#register').submit(function(e){
        e.preventDefault()
        $.ajax({
            url:'../pupclinic/php/ajax.php?action='+params['user']+'_register',
            method:'POST',
            data:$(this).serialize(),
            error:function(err){
                console.log(err);
                alert("An error occured");
            },
            success:function(resp){
                console.log(resp);
                if(resp == 7){
                    alert("Invalid Code!");
                }else{
                    if(resp == 1){
                        location.href = '../pupclinic/index.php?page=login&user='+params['user'];
                    }
                }
            }
        })
    })
    
</script>
