<head>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="electronic-health-record">   
    <?php
        if (isset($_SESSION['user'])){
            $id = $_SESSION['id'];
            $res = mysqli_query($conn, "SELECT * FROM users WHERE id = $id");
            if (mysqli_num_rows($res) > 0) {
                $user = mysqli_fetch_assoc($res) ?>
            <div>
                <form class="form" id = "form" action="" enctype="multipart/form-data" method="post">
                    <div class="upload">
                        <?php
                            $name = $user["name"];
                            $image = $user["pic"];
                        ?>
                        <img src="../pupclinic/php/profile_pic/<?php echo $image; ?>" width = 125 height = 125 title="<?php echo $image; ?>">
                        <div class="round">
                            <input type="hidden" name="email" id="profileEmail" value="<?php echo $user['email']; ?>">
                            <input type="hidden" name="name" id="profileName" value="<?php echo $name; ?>">
                            <input type="file" name="image" id = "image" accept=".jpg, .jpeg, .png">
                        <i class = "fa fa-camera" style = "color: #fff;"></i>
                        </div>
                    </div>
                </form>   
                <label>Name</label>
                <input type="text" value="<?=$user['name']?>" name="name" id="name" autocomplete="off" disabled required>
                <label>Birthday</label>
                <input type="text" value="<?=$user['birthday']?>" name="birthday" id="birthday" autocomplete="off" disabled required> 
                <label>Sex</label>
                <input type="text" value="<?=$user['sex']?>" name="sex" id="sex" autocomplete="off" disabled required> 
                <label>Email</label>
                <input type="text" value="<?=$user['email']?>" name="email" id="email" autocomplete="off" disabled required>
                <label>Student Number</label>
                <input type="text" value="<?=$user['student_no']?>" name="student_no" id="student_no" autocomplete="off" disabled required>      
                <label>Course</label>
                <input type="text" value="<?=$user['course']?>" name="course" id="course" autocomplete="off" disabled required> 
                <label>Year</label>
                <input type="text" value="<?=$user['year']?>" name="year" id="year" autocomplete="off" disabled required>
                <label>Section</label>
                <input type="text" value="<?=$user['section']?>" name="section" id="section" autocomplete="off" disabled required>
            </div>
    <?php }
            $res = mysqli_query($conn, "SELECT * FROM records WHERE user_id = $id ORDER BY created_timestamp DESC LIMIT 1");
            if (mysqli_num_rows($res) > 0) {
                $record = mysqli_fetch_assoc($res) ?>   
            <div>
                <label>Height</label>
                <input type="text" value="<?=$record['height']?>" name="height" id="height" autocomplete="off" disabled required>
                <label>Temperature</label>
                <input type="text" value="<?=$record['temp']?>" name="temp" id="temp" autocomplete="off" disabled required> 
                <label>Heart Rate</label>
                <input type="text" value="<?=$record['heart_rate']?>" name="heart_rate" id="heart_rate" autocomplete="off" disabled required> 
                <label>Oxygen</label>
                <input type="text" value="<?=$record['oxygen']?>" name="oxygen" id="oxygen" autocomplete="off" disabled required>
            </div>            
    <?php }}?> 
</div>
</body>
<script>
    document.getElementById("image").onchange = function(){
        let form_data = new FormData();
            var image = $('#image')[0].files;
            var profileName = $("#profileName").val().trim();
            var profileEmail = $("#profileEmail").val().trim();
       
            form_data.append('profileName',profileName);
            form_data.append('profileEmail',profileEmail);
            form_data.append('image',image[0]);
            $.ajax({
                url:'../pupclinic/php/ajax.php?action=upload_profile_pic',
                type:'post',
                data:form_data,
                contentType: false,
                processData: false,
                success:function(response){
                    console.log(response);
                    if(response == 0){
                        location.reload();
                        alert('Successfully Updated!');
                    }else if(response == 'max'){
                        alert('Sorry, your file is too large.');
                    }else if(response == 'diff'){
                        alert('Invalid Image Extension');
                    }
                }
            });
    };
    
</script>
