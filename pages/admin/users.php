<head>   
</head>
<div class="records-table">
    <h1>Users</h1>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="GET">
        <input type="hidden" name="page" value="<?php if(isset($_GET['page'])){echo $_GET['page']; } ?>">
        <input type="text" name="search" value="<?php if(isset($_GET['search'])){echo $_GET['search']; } ?>" placeholder="Search data">
        <button type="submit">Search</button>
        <button type="button" onclick="show_dialog()">Add User</button>
    </form>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>UserType</th>
                <th>Name</th>
                <th>Birthday</th>
                <th>Sex</th>
                <th>Email</th>
                <th>Student Number</th>
                <th>Course</th>
                <th>Year</th>
                <th>Section</th>
                <th>Date Created</th>
                <th>Action</th>

            </tr>
        </thead>
        <tbody>
            <?php 
                include('../pupclinic/php/db_connect.php');


                    $filtervalues = $_GET['search'];
                    if($_GET['search'] == ""){
                        $query = "SELECT * FROM users";
                    }else{
                        $query = "SELECT * FROM users WHERE CONCAT(user_type,name,email,student_no,course,year,section) LIKE '%$filtervalues%' ";
                    }
                    $query_run = mysqli_query($conn, $query);

                    if(mysqli_num_rows($query_run) > 0)
                    {
                        foreach($query_run as $items)
                        {
                            ?>
                            <tr>
                                <td><?= $items['id']; ?></td>
                                <td><?= $items['user_type']; ?></td>
                                <td><?= $items['name']; ?></td>
                                <td><?= $items['birthday']; ?></td>
                                <td><?= $items['sex']; ?></td>
                                <td><?= $items['email']; ?></td>
                                <td><?= $items['student_no']; ?></td>
                                <td><?= $items['course']; ?></td>
                                <td><?= $items['year']; ?></td>
                                <td><?= $items['section']; ?></td>
                                <td><?= date('M d, Y', strtotime($items['date_created'])); ?></td>
                                <td>
                                    <a class="update_user_button" href="javascript:void(0)" data_id="<?= $items['id'] ?>" 
                                    data_user_type="<?= $items['user_type'] ?>" data_name="<?= $items['name'] ?>" data_birthday="<?= $items['birthday'] ?>" 
                                    data_sex="<?= $items['sex'] ?>" data_email="<?= $items['email'] ?>" 
                                    data_student_no="<?= $items['student_no'] ?>" data_course="<?= $items['course'] ?>" data_year="<?= $items['year'] ?>" 
                                    data_section="<?= $items['section'] ?>" data_password="<?= $items['password'] ?>">Update</a>
                                    <a class="delete_user" href="javascript:void(0)" data-id="<?= $items['id'] ?>">Delete</a>
                                    <a class="view_profile" href="javascript:void(0)" data-id="<?= $items['id'] ?>">View Profile</a>
                                </td>
                                
                                
                                
                            </tr>
                            <?php
                        }
                    }
                    else
                    {
                        ?>
                            <tr>
                                <td>No Record Found</td>
                            </tr>
                        <?php
                    }
                
            ?>
        </tbody>
    </table>
</div>

<div id="overlay" onclick="hide_dialog()"></div>

<div id="add_user_container" class="floating-container">
    <div class="floating-register">
        <form id="register">
            <label for="user_type">User type</label>
            <select name="user_type" id="user_type" required>
                <option value="student">Student</option>
                <option value="faculty">Faculty</option>
            </select>
            <label for="name">Name</label>
            <input type="text" id="name" name="name" required autocomplete="off">
            <label class="label" for="birthday">Birthday</label>
            <input class="reg_input" type="date" id="birthday" name="birthday" required autocomplete="off">
            <label class="label" for="sex">Sex</label>
            <select class="reg_input" name="sex" id="sex" required>
                <option value="" disabled selected></option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
            </select>
            <label class="student_label" for="student_no">Student Number</label>
            <input type="text" id="student_no" name="student_no" required autocomplete="off">
            <label class="student_label" for="course">Course</label>
            <input type="text" id="course" name="course" required autocomplete="off">
            <label class="student_label" for="year">Year</label>
            <select name="year" id="year" require>
                    <option value=" " disabled selected></option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
        
            </select>
            
            <label class="student_label" for="section">Section</label>
            <input type="text" id="section" name="section" required autocomplete="off">
            <label for="email">Email</label>
            <input type="text" id="email" name="email" required autocomplete="off">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>
            <label for="password2">Retype Password</label>
            <input type="password" id="password2" name="password2" required>
            <button>Save</button>
        </form>
    </div>
</div>
<div id="update_user_container" class="floating-container">
    <div class="floating-register">
        <form id="update_user">
            <input type="number" id="u_id" name="u_id" style="display: none;">
            <input id="u_user_type" name="u_user_type" style="display: none;">
            <label for="u_name">Name</label>
            <input type="text" id="u_name" name="u_name" required autocomplete="off"><br>
            <label for="u_birthday">Birthday</label>
            <input type="date" id="u_birthday" name="u_birthday" required autocomplete="off">
            <label for="u_sex">Sex</label>
            <select name="u_sex" id="u_sex" required>
                <option value="" disabled selected></option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
            </select><br>
            <label class="u_student_label" for="u_student_no">Student Number</label>
            <input type="text" id="u_student_no" name="u_student_no" required autocomplete="off">
            <label class="u_student_label" for="u_course">Course</label>
            <input type="text" id="u_course" name="u_course" required autocomplete="off">
            <label class="u_student_label" for="u_year">Year</label>
            <select name="u_year" id="u_year" required>
                    <option value="" disabled selected></option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
        
            </select>
            <label class="u_student_label" for="u_section">Section</label>
            <input type="text" id="u_section" name="u_section" required autocomplete="off">
            <label for="u_email">Email</label>
            <input type="text" id="u_email" name="u_email">
            <label for="u_password">New Password</label>
            <input type="password" id="u_password" name="u_password">
            <label for="u_password2">Retype Password</label>
            <input type="password" id="u_password2" name="u_password2">
            <input type="password" id="u_password3" name="u_password3" style="display: none;">
            <button>Update</button>
        </form>
    </div>
</div>
<script>
    $('.delete_user').click(function(){
        delete_user($(this).attr('data-id'))
    })
    $('.view_profile').click(function(){
        location.href = "../pupclinic/admin.php?page=profile&user=" + $(this).attr('data-id');
    })

    $('.update_user_button').click(function(){
        $('#update_user_container').css('display', 'block');
		$('#overlay').css('display', 'block');
        if($(this).attr('data_user_type') == 'faculty'){
            $('#u_student_no').hide();
            $('#u_course').hide();
            $('#u_year').hide();
            $('#u_section').hide();
            $('#u_student_no').removeAttr('required');
            $('#u_course').removeAttr('required');
            $('#u_year').removeAttr('required');
            $('#u_section').removeAttr('required');
            $('.u_student_label').hide();
        }
		var cat = $('#update_user')
		cat.get(0).reset()
		cat.find("[name='u_id']").val($(this).attr('data_id'))
        cat.find("[name='u_user_type']").val($(this).attr('data_user_type'))
		cat.find("[name='u_name']").val($(this).attr('data_name'))
        cat.find("[name='u_birthday']").val($(this).attr('data_birthday'))
		cat.find("[name='u_sex']").val($(this).attr('data_sex'))
        cat.find("[name='u_email']").val($(this).attr('data_email'))
		cat.find("[name='u_student_no']").val($(this).attr('data_student_no'))
        cat.find("[name='u_course']").val($(this).attr('data_course'))
		cat.find("[name='u_year']").val($(this).attr('data_year'))
        cat.find("[name='u_section']").val($(this).attr('data_section'))
        cat.find("[name='u_password1']").val("")
        cat.find("[name='u_password2']").val("")
        cat.find("[name='u_password3']").val($(this).attr('data_password'))
        $('#update_user').submit(function(e){
        e.preventDefault()
        $.ajax({
            url:'../pupclinic/php/ajax.php?action=update_user',
            method:'POST',
            data:$(this).serialize(),
            error:function(err){
                console.log(err)
                alert("An error occured");
            },
            success:function(resp){
                console.log(resp);
                if(resp == 1){
                    alert('Updated!')
                    location.reload();
                }
                if(resp == 2){
                    alert("Password didn't match!");
                }
                if(resp == 0){
                    alert(resp);
                }
            }
        })
    })
	})
    
	$('#register').submit(function(e){
        e.preventDefault()
        $.ajax({
            url:'../pupclinic/php/ajax.php?action=add_user',
            method:'POST',
            data:$(this).serialize(),
            error:function(err){
                console.log(err)
                alert("An error occured");
            },
            success:function(resp){
                console.log(resp);
                if(resp == 1){
                    alert('Added!')
                    location.reload();
                }
                if(resp == 2){
                    alert("Email already exists!");
                }
                if(resp == 3){
                    alert("Password didn't match!");
                }
                if(resp == 4){
                    alert("Password must contain at least one uppercase letter, one digit, and be at least 8 characters long.");
                }
                if(resp == 5){
                    alert("Invalid email!");
                }
            }
        })
    })
    
	function delete_user($id){
		if (confirm("Do you want to delete?") == true) {
			$.ajax({
				url:'../pupclinic/php/ajax.php?action=delete_user',
				method:'POST',
				data:{id:$id},
				success:function(resp){
					if(resp==1){
                        location.reload();
					}
				}
			})
		}
	}
	$('#user_type').on('change', function() {
        if ($('#user_type').val() == 'student') {
            $('#student_no').show();
            $('#course').show();
            $('#year').show();
            $('#section').show();
            $('#student_no').prop('required', true);
            $('#course').prop('required', true);
            $('#year').prop('required', true);
            $('#section').prop('required', true);
            $('.student_label').show();
        } else {
            $('#student_no').hide();
            $('#course').hide();
            $('#year').hide();
            $('#section').hide();
            $('#student_no').removeAttr('required');
            $('#course').removeAttr('required');
            $('#year').removeAttr('required');
            $('#section').removeAttr('required');
            $('.student_label').hide();
        }
    });

    function show_dialog(){  
		$('#add_user_container').css('display', 'block');
		$('#overlay').css('display', 'block');
	}
	function hide_dialog(){
		$('#add_user_container').hide();
        $('#update_user_container').hide();
		$('#overlay').hide();
	}
</script>
