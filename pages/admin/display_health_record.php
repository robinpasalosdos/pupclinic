<head>
    <title>Health Examination Form - PUPClinic</title>
</head>
<h1 class="record-header">Health Examination Record</h1>
<?php
if (isset($_SESSION['id']) && $_SESSION['id'] != ""){
    $id = $_SESSION['id'];
?>

<form id="health-record">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <p class="full-width"><label for="name">Name:</label><span><?php echo $_SESSION['name']; ?></span></p>
        <p><label for="date">Date:</label><span><?php echo $_SESSION['date']; ?></span></p>
        <p><label for="college_department">College/Department:</label><span><?php echo $_SESSION['college_department']; ?></span></p>
        <p><label for="address">Address:</label><span><?php echo $_SESSION['address']; ?></span></p>
        <p><label for="contact">Contact No.:</label><span><?php echo $_SESSION['contact']; ?></span></p>
        <p><label for="emergency">Emergency Contact:</label><span><?php echo $_SESSION['emergency']; ?></span></p>
        <p><label for="sex">Sex:</label><span><?php echo $_SESSION['sex']; ?></span></p>
        <p><label for="civil_status">Civil Status:</label><span><?php echo $_SESSION['civil_status']; ?></span></p>
        <p><label for="course_school_year">Course/School Year:</label><span><?php echo $_SESSION['course_school_year']; ?></span></p>
        <p><label for="contact_no">Contact No.:</label><span><?php echo $_SESSION['contact_no']; ?></span></p>
        <p><label for="age">Age:</label><span><?php echo $_SESSION['age']; ?></span></p>

        <div class="section-title">Past Medical History</div>
        <p class="full-width"><label for="childhood_illness">Childhood Illness:</label><span><?php echo $_SESSION['childhood_illness']; ?></span></p>
        <p><label for="previous_hospitalization">Previous Hospitalization:</label><span><?php echo $_SESSION['previous_hospitalization']; ?></span></p>
        <p><label for="operation_surgery">Operation/Surgery:</label><span><?php echo $_SESSION['operation_surgery']; ?></span></p>
        <p class="full-width"><label for="current_medications">Current Medications:</label><span><?php echo $_SESSION['current_medications']; ?></span></p>
        <p class="full-width"><label for="allergies">Allergies:</label><span><?php echo $_SESSION['allergies']; ?></span></p>

        <div class="section-title">Family History</div>
        <p class="full-width"><label for="family_history">Family History:</label><span><?php echo $_SESSION['family_history']; ?></span></p>

        <div class="section-title">Personal History</div>
        <p><label for="cigarette_smoking">Cigarette Smoking:</label><span><?php echo $_SESSION['cigarette_smoking']; ?></span></p>
        <p><label for="alcohol_drinking">Alcohol Drinking:</label><span><?php echo $_SESSION['alcohol_drinking']; ?></span></p>
        <p><label for="traveled_abroad">Traveled Abroad:</label><span><?php echo $_SESSION['traveled_abroad']; ?></span></p>

        <div class="section-title">Physical Examination</div>
        <p><label for="vital_signs">Vital Signs:</label><span><?php echo $_SESSION['vital_signs']; ?></span></p>
        <p><label for="height">Height:</label><span><?php echo $_SESSION['height']; ?></span></p>
        <p><label for="weight">Weight:</label><span><?php echo $_SESSION['weight']; ?></span></p>
        <p><label for="bmi">BMI:</label><span><?php echo $_SESSION['bmi']; ?></span></p>
        <p><label for="bp">Blood Pressure:</label><span><?php echo $_SESSION['bp']; ?></span></p>
        <p><label for="hr">Heart Rate:</label><span><?php echo $_SESSION['hr']; ?></span></p>
        <p><label for="rr">Respiratory Rate:</label><span><?php echo $_SESSION['rr']; ?></span></p>
        <p><label for="temp">Temperature:</label><span><?php echo $_SESSION['temp']; ?></span></p>

        <div class="section-title"></div>
        <p><label for="head">Head:</label><span><?php echo $_SESSION['head']; ?></span></p>
        <p><label for="eyes">Eyes:</label><span><?php echo $_SESSION['eyes']; ?></span></p>
        <p><label for="ears">Ears:</label><span><?php echo $_SESSION['ears']; ?></span></p>
        <p><label for="throat">Throat:</label><span><?php echo $_SESSION['throat']; ?></span></p>
        <p><label for="chest_lungs">Chest/Lungs:</label><span><?php echo $_SESSION['chest_lungs']; ?></span></p>
        <p><label for="xray_result">X-Ray Result:</label><span><?php echo $_SESSION['xray_result']; ?></span></p>
        <p><label for="breast">Breast:</label><span><?php echo $_SESSION['breast']; ?></span></p>
        <p><label for="murmur">Murmur:</label><span><?php echo $_SESSION['murmur']; ?></span></p>
        <p><label for="rhythm">Rhythm:</label><span><?php echo $_SESSION['rhythm']; ?></span></p>
        <p><label for="abdomen">Abdomen:</label><span><?php echo $_SESSION['abdomen']; ?></span></p>
        <p><label for="genito_urinary">Genito-Urinary:</label><span><?php echo $_SESSION['genito_urinary']; ?></span></p>
        <p><label for="extremities">Extremities:</label><span><?php echo $_SESSION['extremities']; ?></span></p>
        <p><label for="vertebral_column">Vertebral Column:</label><span><?php echo $_SESSION['vertebral_column']; ?></span></p>
        <p><label for="skin">Skin:</label><span><?php echo $_SESSION['skin']; ?></span></p>
        <p><label for="scars">Scars:</label><span><?php echo $_SESSION['scars']; ?></span></p>

        <div class="section-title"></div>
        <p><label for="working_impression">Working Impression:</label><span><?php echo $_SESSION['working_impression']; ?></span></p>
        <p><label for="fit">Fit:</label><span><?php echo $_SESSION['fit']; ?></span></p>
        <p><label for="for_work_up">For Work-Up:</label><span><?php echo $_SESSION['for_work_up']; ?></span></p>
        <p><label for="referred_to">Referred To:</label><span><?php echo $_SESSION['referred_to']; ?></span></p>
        <p><label for="follow_up_on">Follow-Up On:</label><span><?php echo $_SESSION['follow_up_on']; ?></span></p>
        <div>
            <button id="retry">Back</button>
            <button id="save">Save and Exit</button>
        </div>
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

