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
<form id="health-record">
    <input type="hidden" name="id" value="<?php echo $id; ?>">
    <p class="full-width"><label for="name">Name:</label><span><?php echo $record['name']; ?></span></p>
    <p><label for="date">Date:</label><span><?php echo $record['date']; ?></span></p>
    <p><label for="college_department">College/Department:</label><span><?php echo $record['college_department']; ?></span></p>
    <p><label for="address">Address:</label><span><?php echo $record['address']; ?></span></p>
    <p><label for="contact">Contact No.:</label><span><?php echo $record['contact']; ?></span></p>
    <p><label for="emergency_contact">Emergency Contact:</label><span><?php echo $record['emergency_contact']; ?></span></p>
    <p><label for="sex">Sex:</label><span><?php echo $record['sex']; ?></span></p>
    <p><label for="civil_status">Civil Status:</label><span><?php echo $record['civil_status']; ?></span></p>
    <p><label for="course_school_year">Course/School Year:</label><span><?php echo $record['course_school_year']; ?></span></p>
    <p><label for="contact_no">Contact No.:</label><span><?php echo $record['contact_no']; ?></span></p>
    <p><label for="age">Age:</label><span><?php echo $record['age']; ?></span></p>

    <div class="section-title">Past Medical History</div>
    <p class="full-width"><label for="childhood_illness">Childhood Illness:</label><span><?php echo $record['childhood_illness']; ?></span></p>
    <p><label for="previous_hospitalization">Previous Hospitalization:</label><span><?php echo $record['previous_hospitalization']; ?></span></p>
    <p><label for="operation_surgery">Operation/Surgery:</label><span><?php echo $record['operation_surgery']; ?></span></p>
    <p class="full-width"><label for="current_medications">Current Medications:</label><span><?php echo $record['current_medications']; ?></span></p>
    <p class="full-width"><label for="allergies">Allergies:</label><span><?php echo $record['allergies']; ?></span></p>

    <div class="section-title">Family History</div>
    <p class="full-width"><label for="family_history">Family History:</label><span><?php echo $record['family_history']; ?></span></p>

    <div class="section-title">Personal History</div>
    <p><label for="cigarette_smoking">Cigarette Smoking:</label><span><?php echo $record['cigarette_smoking']; ?></span></p>
    <p><label for="alcohol_drinking">Alcohol Drinking:</label><span><?php echo $record['alcohol_drinking']; ?></span></p>
    <p><label for="traveled_abroad">Traveled Abroad:</label><span><?php echo $record['traveled_abroad']; ?></span></p>

    <div class="section-title">Physical Examination</div>
    <p><label for="vital_signs">Vital Signs:</label><span><?php echo $record['vital_signs']; ?></span></p>
    <p><label for="height">Height:</label><span><?php echo $record['height'] . " cm"; ?></span></p>
    <p><label for="weight">Weight:</label><span><?php echo $record['weight'] . " kg" ; ?></span></p>
    <p><label for="bmi">BMI:</label><span><?php echo $record['bmi'] . " kg/m²"; ?></span></p>
    <p><label for="bp">Blood Pressure:</label><span><?php echo $record['bp'] . " mmHg"; ?></span></p>
    <p><label for="hr">Heart Rate:</label><span><?php echo $record['hr'] . " bpm"; ?></span></p>
    <p><label for="rr">Respiratory Rate:</label><span><?php echo $record['rr'] . " %"; ?></span></p>
    <p><label for="temp">Temperature:</label><span><?php echo $record['temp'] . " °C"; ?></span></p>

    <div class="section-title"></div>
    <p><label for="head">Head:</label><span><?php echo $record['head']; ?></span></p>
    <p><label for="eyes">Eyes:</label><span><?php echo $record['eyes']; ?></span></p>
    <p><label for="ears">Ears:</label><span><?php echo $record['ears']; ?></span></p>
    <p><label for="throat">Throat:</label><span><?php echo $record['throat']; ?></span></p>
    <p><label for="chest_lungs">Chest/Lungs:</label><span><?php echo $record['chest_lungs']; ?></span></p>
    <p><label for="xray_result">X-Ray Result:</label><span><?php echo $record['xray_result']; ?></span></p>
    <p><label for="breast">Breast:</label><span><?php echo $record['breast']; ?></span></p>
    <p><label for="heart_murmur">Murmur:</label><span><?php echo $record['heart_murmur']; ?></span></p>
    <p><label for="heart_rhythm">Rhythm:</label><span><?php echo $record['heart_rhythm']; ?></span></p>
    <p><label for="abdomen">Abdomen:</label><span><?php echo $record['abdomen']; ?></span></p>
    <p><label for="genito_urinary">Genito-Urinary:</label><span><?php echo $record['genito_urinary']; ?></span></p>
    <p><label for="extremities">Extremities:</label><span><?php echo $record['extremities']; ?></span></p>
    <p><label for="vertebral_column">Vertebral Column:</label><span><?php echo $record['vertebral_column']; ?></span></p>
    <p><label for="skin">Skin:</label><span><?php echo $record['skin']; ?></span></p>
    <p><label for="scars">Scars:</label><span><?php echo $record['scars']; ?></span></p>

    <div class="section-title"></div>
    <p><label for="working_impression">Working Impression:</label><span><?php echo $record['working_impression']; ?></span></p>
    <p><label for="fit">Fit:</label><span><?php echo $record['fit']; ?></span></p>
    <p><label for="for_work_up">For Work-Up:</label><span><?php echo $record['for_work_up']; ?></span></p>
    <p><label for="referred_to">Referred To:</label><span><?php echo $record['referred_to']; ?></span></p>
    <p><label for="follow_up_on">Follow-Up On:</label><span><?php echo $record['follow_up_on']; ?></span></p>
</form>


<?php }else{ ?>
    <div class="waiting-container">
    No health record found
</div>
<?php } ?>
