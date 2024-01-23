<form id="register">   
	<label for="name">Name</label><br>
	<input type="text" id="name" name="name"><br>
	<label for="email">Email</label><br>
	<input type="text" id="email" name="email"><br>
	<button>Save</button>
</form>
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
                        alert("Registered Successfully!");
                        location.href ='dashboard.php?page=landing_page';
                }
            }
        })
    })
</script>
