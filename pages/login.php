<head>
    <title>Login</title>
    <script src="jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
</head>
<h1>Login as <?php echo $_GET['user']; ?></h1>
<?php if($_GET['user'] == 'student' || $_GET['user'] == 'faculty' ): ?>
	<form id="login">
		<label>Email</label>
		<input type="text" id="email" name="email"><br>
		<label>Password</label>
		<input type="password" id="password" name="password"><br>
		<button>Login</button>
	</form>
<?php endif; ?>
<?php if($_GET['user'] == 'admin'): ?>
	<form id="login">
		<label>Password</label>
		<input type="password" id="password" name="password"><br>
		<button>Login</button>
	</form>
<?php endif; ?>

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
				alert(resp)
				if(resp == 1){
					location.href = 'dashboard.php?page=landing_page';
				}else{
					alert("Username or password is incorrect")
				}
			}
		})
	})
</script>
