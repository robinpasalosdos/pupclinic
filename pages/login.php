<head>
    <title>Login</title>
</head>
<div class="login-form">
	<h1>Login as <?php echo $_GET['user']; ?></h1>
	<?php if($_GET['user'] == 'student' || $_GET['user'] == 'faculty' ): ?>
    <form id="login">
        <label>Email</label>
        <input type="text" id="email" name="email" placeholder="Enter your email address"><br>
        <label>Password</label>
        <input type="password" id="password" name="password" placeholder="Enter your password"><br>
        <button>Login</button>
        <button id="forgot_password">Forgot Password?</button>
    </form>
	<?php endif; ?>
	<?php if($_GET['user'] == 'admin'): ?>
	    <form id="login">
		<label>Password</label>
		<input type="password" id="password" name="password"><br>
		<button>Login</button>
	    </form>
	<?php endif; ?>
</div>
<script>
	var params = <?php echo json_encode($_GET)?>;
	$('#login').submit(function(e){
		e.preventDefault()
		$.ajax({
			url:'../pupclinic/php/ajax.php?action='+params['user']+'_login',
			method:'POST',
			data:$(this).serialize(),
			error:err=>{
				console.log(err)
			},
			success:function(resp){
				if (resp == 1) {
					location.href = 'dashboard.php?page=landing_page';
				}
                
                else {
					if(resp == 2){
						alert("Password is incorrect!")
					}else{
						alert("Username or password is incorrect!")
					}	
				}
			}
		})
	})
	$('#forgot_password').click(function(e){
		window.location.href = "../pupclinic/index.php?page=forgot_password1";
	})
</script>


