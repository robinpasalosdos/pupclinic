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
                <form id="email_verification">
                    <div class="upload">
                        <?php
                            $name = $user["name"];
                            $image = $user["pic"];
                        ?>
                        <input type="hidden" name="email" value="<?=$user['email']?>">
                        <img src="../pupclinic/php/profile_pic/<?php echo $image; ?>" width = 125 height = 125 title="<?php echo $image; ?>">
                        <?php if ($user["verified"] == 0){ ?>
                            <input type="submit" value="Verify Email">
                        <?php }else{ ?>
                            <p>Verified</p>
                        <?php } ?>  
                    </div>
                </form>   
                <label>Name</label>
                <input type="text" value="<?=$user['name']?>" name="name" id="name" autocomplete="off" disabled required>
                <label>User Type</label>
                <input type="text" value="<?=$user['user_type']?>" name="name" id="name" autocomplete="off" disabled required>
                <label>Birthday</label>
                <input type="text" value="<?=$user['birthday']?>" name="birthday" id="birthday" autocomplete="off" disabled required> 
                <label>Sex</label>
                <input type="text" value="<?=$user['sex']?>" name="sex" id="sex" autocomplete="off" disabled required> 
                <label>Email</label>
                <input type="text" value="<?=$user['email']?>" name="email" id="email" autocomplete="off" disabled required>
                <?php
                if ($user['user_type'] == 'student') 
                {?>
                    <label>Student Number</label>
                    <input type="text" value="<?=$user['student_no']?>" name="student_no" id="student_no" autocomplete="off" disabled required>      
                    <label>Course</label>
                    <input type="text" value="<?=$user['course']?>" name="course" id="course" autocomplete="off" disabled required> 
                    <label>Year</label>
                    <input type="text" value="<?=$user['year']?>" name="year" id="year" autocomplete="off" disabled required>
                    <label>Section</label>
                    <input type="text" value="<?=$user['section']?>" name="section" id="section" autocomplete="off" disabled required>
                    <?php
                }?>
            </div>
    <?php }
            $res = mysqli_query($conn, "SELECT * FROM records WHERE user_id = $id ORDER BY created_timestamp DESC LIMIT 1");
            if (mysqli_num_rows($res) > 0) {
                $record = mysqli_fetch_assoc($res) ?>   
            <div>
                <label>Height</label>
                <input type="text" value="<?=$record['height']?>" name="height" id="height" autocomplete="off" disabled required>
                <label>Weight</label>
                <input type="text" value="<?=$record['weight']?>" name="weight" id="weight" autocomplete="off" disabled required>
                <label>BMI</label>
                <input type="text" value="<?=$record['bmi']?>" name="bmi" id="bmi" autocomplete="off" disabled required>
                <label>Temperature</label>
                <input type="text" value="<?=$record['temp']?>" name="temp" id="temp" autocomplete="off" disabled required> 
                <label>Heart Rate</label>
                <input type="text" value="<?=$record['heart_rate']?>" name="heart_rate" id="heart_rate" autocomplete="off" disabled required> 
                <label>Oxygen</label>
                <input type="text" value="<?=$record['heart_rate']?>" name="heart_rate" id="heart_rate" autocomplete="off" disabled required> 
                <label>Blood Pressure</label>
                <input type="text" value="<?=$record['bp']?>" name="bp" id="bp" autocomplete="off" disabled required>
                <a class="view_health_record" href="javascript:void(0)" data-tn="<?= $record['transaction_no'] ?>">See more</a>
            </div>            
    <?php }}?> 
</div>
</body>
<script>
    $('#email_verification').submit(function(e){
        e.preventDefault();
        $.ajax({
            url: "../pupclinic/php/ajax.php?action=profile_send_code",
            type: "POST",
            data: $(this).serialize(),
            success: function(response){
                console.log(response);
                location.href = "../pupclinic/dashboard.php?page=verify";
            },
            error: function(jqXHR, textStatus, errorThrown){
                console.error(textStatus, errorThrown);
                console.log(response);
            }
        });
    });
    $('.view_health_record').click(function(){
        location.href = "../pupclinic/admin.php?page=view_health_record&tn=" + $(this).attr('data-tn');
    })
</script>