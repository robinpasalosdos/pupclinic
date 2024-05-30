<head>
    <title>Health Record - PUPClinic</title>
</head>
<h1 class="record-header">Health Examination Record</h1>
<?php
    $tn = $_GET['tn'];
    $query = "SELECT * FROM health_record WHERE transaction_no = $tn";
    $query_run = mysqli_query($conn, $query);
    if(mysqli_num_rows($query_run) > 0)
    {
    $record = mysqli_fetch_assoc($query_run);
?>
<form id="health-form">
    <p>
    <label for="name"><b>Name:</b>&nbsp;<?php echo $record['name']; ?></label><br>
    <label for="date"><b>Date:</b>&nbsp;<?php echo $record['date']; ?></label><br>
    <label for="sex"><b>Sex:</b>&nbsp;<?php echo $record['sex']; ?></label><br>
    <label for="address"><b>Address:</b>&nbsp;<?php echo $record['address']; ?></label><br>
    <label for="contact"><b>Contact:</b>&nbsp;<?php echo $record['contact']; ?></label><br>
    <label for="emergency"><b>Emergency:</b>&nbsp;<?php echo $record['emergency_contact']; ?></label><br>
    <label for="age"><b>Age:</b>&nbsp;<?php echo $record['age']; ?></label><br>
    <label for="civil_status"><b>Civil Status:</b>&nbsp;<?php echo $record['civil_status']; ?></label><br>
    <label for="college_department"><b>College Department:</b>&nbsp;<?php echo $record['college_department']; ?></label><br>
    <label for="course_school_year"><b>Course/School Year:</b>&nbsp;<?php echo $record['course_school_year']; ?></label><br>
    <label for="contact_no"><b>Contact Number:</b>&nbsp;<?php echo $record['contact_no']; ?></label><br>
    <label for="childhood_illness"><b>Childhood Illness:</b>&nbsp;<?php echo $record['childhood_illness']; ?></label><br>
    <label for="previous_hospitalization"><b>Previous Hospitalization:</b>&nbsp;<?php echo $record['previous_hospitalization']; ?></label><br>
    <label for="operation_surgery"><b>Operation/Surgery:</b>&nbsp;<?php echo $record['operation_surgery']; ?></label><br>
    <label for="current_medications"><b>Current Medications:</b>&nbsp;<?php echo $record['current_medications']; ?></label><br>
    <label for="allergies"><b>Allergies:</b>&nbsp;<?php echo $record['allergies']; ?></label><br>
    <label for="family_history"><b>Family History:</b>&nbsp;<?php echo $record['family_history']; ?></label><br>
    <label for="cigarette_smoking"><b>Cigarette Smoking:</b>&nbsp;<?php echo $record['cigarette_smoking']; ?></label><br>
    <label for="alcohol_drinking"><b>Alcohol Drinking:</b>&nbsp;<?php echo $record['alcohol_drinking']; ?></label><br>
    <label for="traveled_abroad"><b>Traveled Abroad:</b>&nbsp;<?php echo $record['traveled_abroad']; ?></label><br>
    <label for="working_impression"><b>Working Impression:</b>&nbsp;<?php echo $record['working_impression']; ?></label><br>
    <label for="vital_signs"><b>Vital Signs:</b>&nbsp;<?php echo $record['vital_signs']; ?></label><br>
    <label for="height"><b>Height:</b>&nbsp;<?php echo $record['height']; ?></label><br>
    <label for="weight"><b>Weight:</b>&nbsp;<?php echo $record['weight']; ?></label><br>
    <label for="bmi"><b>BMI:</b>&nbsp;<?php echo $record['bmi']; ?></label><br>
    <label for="bp"><b>Blood Pressure:</b>&nbsp;<?php echo $record['bp']; ?></label><br>
    <label for="hr"><b>Heart Rate:</b>&nbsp;<?php echo $record['hr']; ?></label><br>
    <label for="rr"><b>Respiratory Rate:</b>&nbsp;<?php echo $record['rr']; ?></label><br>
    <label for="temp"><b>Temperature:</b>&nbsp;<?php echo $record['temp']; ?></label><br>
    <label for="head"><b>Head:</b>&nbsp;<?php echo $record['head']; ?></label><br>
    <label for="eyes"><b>Eyes:</b>&nbsp;<?php echo $record['eyes']; ?></label><br>
    <label for="ears"><b>Ears:</b>&nbsp;<?php echo $record['ears']; ?></label><br>
    <label for="throat"><b>Throat:</b>&nbsp;<?php echo $record['throat']; ?></label><br>
    <label for="chest_lungs"><b>Chest/Lungs:</b>&nbsp;<?php echo $record['chest_lungs']; ?></label><br>
    <label for="xray_result"><b>X-Ray Result:</b>&nbsp;<?php echo $record['xray_result']; ?></label><br>
    <label for="breast"><b>Breast:</b>&nbsp;<?php echo $record['breast']; ?></label><br>
    <label for="murmur"><b>Murmur:</b>&nbsp;<?php echo $record['heart_murmur']; ?></label><br>
    <label for="rhythm"><b>Rhythm:</b>&nbsp;<?php echo $record['heart_rhythm']; ?></label><br>
    <label for="abdomen"><b>Abdomen:</b>&nbsp;<?php echo $record['abdomen']; ?></label><br>
    <label for="genito_urinary"><b>Genito-Urinary:</b>&nbsp;<?php echo $record['genito_urinary']; ?></label><br>
    <label for="extremities"><b>Extremities:</b>&nbsp;<?php echo $record['extremities']; ?></label><br>
    <label for="vertebral_column"><b>Vertebral Column:</b>&nbsp;<?php echo $record['vertebral_column']; ?></label><br>
    <label for="skin"><b>Skin:</b>&nbsp;<?php echo $record['skin']; ?></label><br>
    <label for="scars"><b>Scars:</b>&nbsp;<?php echo $record['scars']; ?></label><br>
    <label for="referred_to"><b>Referred To:</b>&nbsp;<?php echo $record['referred_to']; ?></label><br>
    <label for="follow_up_on"><b>Follow-Up On:</b>&nbsp;<?php echo $record['follow_up_on']; ?></label><br>
    <label for="fit"><b>Fit:</b>&nbsp;<?php echo $record['fit']; ?></label><br>
    <label for="for_work_up"><b>For Work-Up:</b>&nbsp;<?php echo $record['for_work_up']; ?></label><br>
    </p>
    
</form>

<?php }else{ ?>
    <div class="waiting-container">
    No health record found
</div>
<?php } ?>
