<head>   
</head>
<div class="records-table">
    <h1>Users</h1>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="GET">
        <input type="hidden" name="page" value="<?php if(isset($_GET['page'])){echo $_GET['page']; } ?>">
        <input type="text" name="search" value="<?php if(isset($_GET['search'])){echo $_GET['search']; } ?>" placeholder="Search data">
        <button type="submit">Search</button>
        <button onclick="show_dialog()">Add User</button>
    </form>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>UserType</th>
                <th>Name</th>
                <th>Email</th>
                <th>Student Number</th>
                <th>Course</th>
                <th>Year</th>
                <th>Section</th>
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
                                <td><?= $items['email']; ?></td>
                                <td><?= $items['student_no']; ?></td>
                                <td><?= $items['course']; ?></td>
                                <td><?= $items['year']; ?></td>
                                <td><?= $items['section']; ?></td>
                                
                                <td>
                                    <a class="update_user" href="javascript:void(0)" data-id="<?= $items['id'] ?>" 
                                    data_user_type="<? $items['user_type'] ?>" data_name="<? $items['name'] ?>" data_email="<? $items['email'] ?>" 
                                    data_student_no="<? $items['student_no'] ?>" data_course="<? $items['course'] ?>" data_year="<? $items['year'] ?>" 
                                    data_section="<? $items['section'] ?>">Update</a>
                                    <a class="delete_user" href="javascript:void(0)" data-id="<?= $items['id'] ?>">Delete</a>
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

<div id="create_student_account" class="floating-container">
    <div class="floating-register">
        <form id="register">
            <label for="student_no">Student Number</label><br>
            <input type="text" id="student_no" name="student_no"><br>
            <label for="name">Name</label><br>
            <input type="text" id="name" name="name"><br>
            <label for="course">Course</label><br>
            <input type="text" id="course" name="course"><br>
            <label for="year">Year</label>
            <select name="year" id="year" require>
                    
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
        
            </select><br>
            
            <label for="section">Section</label><br>
            <input type="text" id="section" name="section"><br>
            <label for="email">Email</label><br>
            <input type="text" id="email" name="email"><br>
            <label for="password">Password</label><br>
            <input type="password" id="password" name="password"><br>
            <button>Save</button>
        </form>
    </div>
</div>

<script>
    $('.delete_user').click(function(){
        delete_user($(this).attr('data-id'))
        location.reload()
    })
    
	$('#register').submit(function(e){
        e.preventDefault()
        $.ajax({
            url:'../pupclinic/php/ajax.php?action='+params['user']+'_register',
            method:'POST',
            data:$(this).serialize(),
            error:function(err){
                console.log(err)
                alert("An error occured");
            },
            success:function(resp){
                if(resp == 1){
                        alert("Registered Successfully!");
                        location.href ='index.php?page=login&user='+params['user'];
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
						alert("Data successfully deleted");
                        location.reload();
					}
				}
			})
		}
	}
	
	function show_dialog(){
		document.getElementById('overlay').style.display = "block";
		document.getElementById('create_student_account').style.display = "block";
	}
	function hide_dialog(){
		document.getElementById('overlay').style.display = "none";
		document.getElementById('create_student_account').style.display = "none";
	}
</script>
