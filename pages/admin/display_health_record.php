<head>
    <title>Health Examination Form - PUPClinic</title>
</head>
<h2>Health Examination Record</h2>
<?php
if (isset($_SESSION['id']) && $_SESSION['id'] != ""){
    $id = $_SESSION['id'];
?>
<form id="health-form">
    <input type="hidden" name="id" value="<?php echo $id; ?>">
    <p>
    <label for="name"><b>Name:</b>&nbsp;<?php echo $_SESSION['name']; ?></label><br>
    <label for="date"><b>Date:</b>&nbsp;<?php echo $_SESSION['date']; ?></label><br>
    <label for="sex"><b>Sex:</b>&nbsp;<?php echo $_SESSION['sex']; ?></label><br>
    <label for="address"><b>Address:</b>&nbsp;<?php echo $_SESSION['address']; ?></label><br>
    <label for="contact"><b>Contact:</b>&nbsp;<?php echo $_SESSION['contact']; ?></label><br>
    <label for="emergency"><b>Emergency:</b>&nbsp;<?php echo $_SESSION['emergency']; ?></label><br>
    <label for="age"><b>Age:</b>&nbsp;<?php echo $_SESSION['age']; ?></label><br>
    <label for="civil_status"><b>Civil Status:</b>&nbsp;<?php echo $_SESSION['civil_status']; ?></label><br>
    <label for="college_department"><b>College Department:</b>&nbsp;<?php echo $_SESSION['college_department']; ?></label><br>
    <label for="course_school_year"><b>Course/School Year:</b>&nbsp;<?php echo $_SESSION['course_school_year']; ?></label><br>
    <label for="contact_no"><b>Contact Number:</b>&nbsp;<?php echo $_SESSION['contact_no']; ?></label><br>
    <label for="childhood_illness"><b>Childhood Illness:</b>&nbsp;<?php echo $_SESSION['childhood_illness']; ?></label><br>
    <label for="previous_hospitalization"><b>Previous Hospitalization:</b>&nbsp;<?php echo $_SESSION['previous_hospitalization']; ?></label><br>
    <label for="operation_surgery"><b>Operation/Surgery:</b>&nbsp;<?php echo $_SESSION['operation_surgery']; ?></label><br>
    <label for="current_medications"><b>Current Medications:</b>&nbsp;<?php echo $_SESSION['current_medications']; ?></label><br>
    <label for="allergies"><b>Allergies:</b>&nbsp;<?php echo $_SESSION['allergies']; ?></label><br>
    <label for="family_history"><b>Family History:</b>&nbsp;<?php echo $_SESSION['family_history']; ?></label><br>
    <label for="cigarette_smoking"><b>Cigarette Smoking:</b>&nbsp;<?php echo $_SESSION['cigarette_smoking']; ?></label><br>
    <label for="alcohol_drinking"><b>Alcohol Drinking:</b>&nbsp;<?php echo $_SESSION['alcohol_drinking']; ?></label><br>
    <label for="traveled_abroad"><b>Traveled Abroad:</b>&nbsp;<?php echo $_SESSION['traveled_abroad']; ?></label><br>
    <label for="working_impression"><b>Working Impression:</b>&nbsp;<?php echo $_SESSION['working_impression']; ?></label><br>
    <label for="vital_signs"><b>Vital Signs:</b>&nbsp;<?php echo $_SESSION['vital_signs']; ?></label><br>
    <label for="height"><b>Height:</b>&nbsp;<?php echo $_SESSION['height']; ?></label><br>
    <label for="weight"><b>Weight:</b>&nbsp;<?php echo $_SESSION['weight']; ?></label><br>
    <label for="bmi"><b>BMI:</b>&nbsp;<?php echo $_SESSION['bmi']; ?></label><br>
    <label for="bp"><b>Blood Pressure:</b>&nbsp;<?php echo $_SESSION['bp']; ?></label><br>
    <label for="hr"><b>Heart Rate:</b>&nbsp;<?php echo $_SESSION['hr']; ?></label><br>
    <label for="rr"><b>Respiratory Rate:</b>&nbsp;<?php echo $_SESSION['rr']; ?></label><br>
    <label for="temp"><b>Temperature:</b>&nbsp;<?php echo $_SESSION['temp']; ?></label><br>
    <label for="head"><b>Head:</b>&nbsp;<?php echo $_SESSION['head']; ?></label><br>
    <label for="eyes"><b>Eyes:</b>&nbsp;<?php echo $_SESSION['eyes']; ?></label><br>
    <label for="ears"><b>Ears:</b>&nbsp;<?php echo $_SESSION['ears']; ?></label><br>
    <label for="throat"><b>Throat:</b>&nbsp;<?php echo $_SESSION['throat']; ?></label><br>
    <label for="chest_lungs"><b>Chest/Lungs:</b>&nbsp;<?php echo $_SESSION['chest_lungs']; ?></label><br>
    <label for="xray_result"><b>X-Ray Result:</b>&nbsp;<?php echo $_SESSION['xray_result']; ?></label><br>
    <label for="breast"><b>Breast:</b>&nbsp;<?php echo $_SESSION['breast']; ?></label><br>
    <label for="murmur"><b>Murmur:</b>&nbsp;<?php echo $_SESSION['murmur']; ?></label><br>
    <label for="rhythm"><b>Rhythm:</b>&nbsp;<?php echo $_SESSION['rhythm']; ?></label><br>
    <label for="abdomen"><b>Abdomen:</b>&nbsp;<?php echo $_SESSION['abdomen']; ?></label><br>
    <label for="genito_urinary"><b>Genito-Urinary:</b>&nbsp;<?php echo $_SESSION['genito_urinary']; ?></label><br>
    <label for="extremities"><b>Extremities:</b>&nbsp;<?php echo $_SESSION['extremities']; ?></label><br>
    <label for="vertebral_column"><b>Vertebral Column:</b>&nbsp;<?php echo $_SESSION['vertebral_column']; ?></label><br>
    <label for="skin"><b>Skin:</b>&nbsp;<?php echo $_SESSION['skin']; ?></label><br>
    <label for="scars"><b>Scars:</b>&nbsp;<?php echo $_SESSION['scars']; ?></label><br>
    <label for="referred_to"><b>Referred To:</b>&nbsp;<?php echo $_SESSION['referred_to']; ?></label><br>
    <label for="follow_up_on"><b>Follow-Up On:</b>&nbsp;<?php echo $_SESSION['follow_up_on']; ?></label><br>
    <label for="fit"><b>Fit:</b>&nbsp;<?php echo $_SESSION['fit']; ?></label><br>
    <label for="for_work_up"><b>For Work-Up:</b>&nbsp;<?php echo $_SESSION['for_work_up']; ?></label><br>
    <button id="retry">Back</button>
	<button id="save">Save and Exit</button>

    </p>
    
</form>
<?php }else{
    header("location:../pupclinic/admin.php?page=landing_page");
}?>
<script>
    $(document).ready(function(){
        $('#retry').click(function(e){
            e.preventDefault()
            window.history.back();
        });
        $('#save').click(function(e){
            e.preventDefault()
            $.ajax({
                url:'../pupclinic/php/ajax.php?action=save_health_record',
                type:'POST',
                error:function(err){
                    console.log(err);
                    alert("An error occured");
                },
                success:function(resp){
                    alert(resp);
                    window.location.href = "../pupclinic/admin.php?page=landing_page";
                }
            });
        });
    });
</script>

