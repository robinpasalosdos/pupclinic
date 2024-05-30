<head>
    <title>Health Examination Form - PUPClinic</title>
</head>
<h1 class="form-header">Health Examination Form</h1>
<?php
if (isset($_SESSION['id']) && $_SESSION['id'] != ""){
    $id = $_SESSION['id'];
    $user_type = $_SESSION['user_type'];
    if($user_type == "guest"){
        $res = mysqli_query($conn, "SELECT guest.id, guest.sex, guest.birthday, records.email, records.bmi FROM guest INNER JOIN records ON guest.id = records.user_id WHERE records.id = $id;");
    }else{
        $res = mysqli_query($conn, "SELECT users.id, users.sex, users.birthday, records.email, records.bmi FROM users INNER JOIN records ON users.id = records.user_id WHERE records.id = $id;");
    }
    if (mysqli_num_rows($res) > 0) {
        $record = mysqli_fetch_assoc($res);
        $name = $_SESSION["name"];
        $tn = $_SESSION["tn"];
        $sex = $record["sex"];
        $_SESSION["sex"] = $sex; 
        $email = $record["email"];
        $birthday = $record["birthday"];
        $birthDate = new DateTime($birthday);
        $currentDate = new DateTime();
        $ageDifference = $currentDate->diff($birthDate);
        $age = $ageDifference->y;
        $_SESSION['age'] = $age;
        $heart_rate = $_SESSION["heart_rate"];
        $oxygen = $_SESSION["oxygen"];
        $bp = $_SESSION["bp"];
        $temp = $_SESSION["temp"];
        $height = $_SESSION["height"];
        $weight = $_SESSION["weight"];
        $bmi = $record["bmi"];
        $_SESSION['bmi'] = $bmi;
                ?>
<form id="health-form">
    <input type="hidden" name="id" value="<?php echo $id; ?>">
    <input type="hidden" name="tn" value="<?php echo $tn; ?>">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="<?php echo $name; ?>">

        <label for="date">Date:</label>
        <input type="date" id="date" name="date" required autocomplete="off" value="<?php echo $_SESSION['date']; ?>">

        <label for="sex">Sex:</label>
        <input type="text" id="sex" name="sex" value="<?php echo $sex; ?>">

        <label for="address">Address:</label>
        <input type="text" id="address" name="address" required autocomplete="off" value="<?php echo $_SESSION['address']; ?>">

        <label for="contact">Contact No.:</label>
        <input type="text" id="contact" name="contact" required autocomplete="off" value="<?php echo $_SESSION['contact']; ?>">

        <label for="emergency">Contact Person In Case of Emergency:</label>
        <input type="text" id="emergency" name="emergency" required autocomplete="off" value="<?php echo $_SESSION['emergency']; ?>">

        <label for="age">Age:</label>
        <input type="text" id="age" name="age" value="<?php echo $age; ?>">

        <label for="civil-status">Civil Status:</label>
        <input type="text" id="civil-status" name="civil_status" required autocomplete="off" value="<?php echo $_SESSION['civil_status']; ?>">

        <label for="college-department">College / Department:</label>
        <input type="text" id="college-department" name="college_department" required autocomplete="off" value="<?php echo $_SESSION['college_department']; ?>">

        <label for="course-school-year">Course / School Year:</label>
        <input type="text" id="course-school-year" name="course_school_year" required autocomplete="off" value="<?php echo $_SESSION['course_school_year']; ?>">

        <label for="contact-no">Contact No.:</label>
        <input type="text" id="contact-no" name="contact_no" required autocomplete="off" value="<?php echo $_SESSION['contact_no']; ?>">

    <h3>I. Past Medical History</h3>
    <div>
        <label>Childhood Illness:</label><br>
        <input type="hidden" id="no_childhood_illness" name="childhood_illness[]" value="none">
        <input type="checkbox" id="asthma" name="childhood_illness[]" value="asthma">
        <label for="asthma">Asthma</label><br>
        <input type="checkbox" id="chickenpox" name="childhood_illness[]" value="chickenpox">
        <label for="chickenpox">Chicken Pox</label><br>
        <input type="checkbox" id="heartdisease" name="childhood_illness[]" value="heartdisease">
        <label for="heartdisease">Heart Disease</label><br>
        <input type="checkbox" id="measles" name="childhood_illness[]" value="measles">
        <label for="measles">Measles</label><br>
        <input type="checkbox" id="seizure" name="childhood_illness[]" value="seizure">
        <label for="seizure">Seizure Disorder</label><br>
        <input type="checkbox" id="hyperventilation" name="childhood_illness[]" value="hyperventilation">
        <label for="hyperventilation">Hyperventilation</label><br>
        <input type="checkbox" id="others-childhood-illness">
        <label for="others">Other/s(please specify):</label>
        <input type="text" id="childhood_illness_others">
    </div>
    <div>
        <label for="previous-hospitalization">Previous Hospitalization:</label><br>
        <input type="radio" id="hospitalization-no" name="previous_hospitalization" value="no" required>
        <label for="hospitalization-no">No</label><br>
        <input type="radio" id="hospitalization-yes" name="previous_hospitalization" value="yes">
        <label for="hospitalization-yes">Yes</label>
    </div>
    <div>
        <label for="operation-surgery">Operation/Surgery:</label><br>
        <input type="radio" id="operation-no" name="operation_surgery" value="no" required>
        <label for="operation-no">No</label><br>
        <input type="radio" id="operation-yes" name="operation_surgery" value="yes">
        <label for="operation-yes">Yes</label>
    </div>
    <div>
        <label for="current-medications">Current Medications:</label>
        <input type="text" id="current-medications" name="current_medications" autocomplete="off" value="<?php echo $_SESSION['current_medications']; ?>">
    </div>
    <div>
        <label for="allergies">Allergies:</label>
        <input type="text" id="allergies" name="allergies" autocomplete="off" value="<?php echo $_SESSION['allergies']; ?>">
    </div>
    <h3>II. Family History</h3>
    <div>
        <input type="hidden" id="no_family_history" name="family_history[]" value="none">
        <input type="checkbox" id="diabetes" name="family_history[]" value="diabetes">
        <label for="diabetes">Diabetes</label><br>
        <input type="checkbox" id="ptb" name="family_history[]" value="ptb">
        <label for="ptb">PTB</label><br>
        <input type="checkbox" id="hypertension" name="family_history[]" value="hypertension">
        <label for="hypertension">Hypertension</label><br>
        <input type="checkbox" id="cancer" name="family_history[]" value="cancer">
        <label for="cancer">Cancer</label><br>
        <input type="checkbox" id="others-family">
        <label for="others-family">Other/s(please specify):</label>
        <input type="text" id="family_history_others" name="family_history[]">

    </div>
    <h3>III. Personal History</h3>
    <div>
        <label for="cigarette-smoking">Cigarette Smoking:</label><br>
        <input type="radio" id="smoking-no" name="cigarette_smoking" value="no" required>
        <label for="smoking-no">No</label><br>
        <input type="radio" id="smoking-yes" name="cigarette_smoking" value="yes">
        <label for="smoking-yes">Yes</label>
    </div>
    <div>
        <label for="alcohol-drinking">Alcohol Drinking:</label><br>
        <input type="radio" id="drinking-no" name="alcohol_drinking" value="no" required>
        <label for="drinking-no">No</label><br>
        <input type="radio" id="drinking-yes" name="alcohol_drinking" value="yes">
        <label for="drinking-yes">Yes</label>
    </div>
    <div>
        <label for="traveled-abroad">Traveled Abroad:</label><br>
        <input type="radio" id="abroad-no" name="traveled_abroad" value="no" required>
        <label for="abroad-no">No</label><br>
        <input type="radio" id="abroad-yes" name="traveled_abroad" value="yes">
        <label for="abroad-yes">Yes</label>
    </div>

    <h3>IV. Physical Examination</h3>
    <div>
        <label>Vital Signs:</label><br>
        <input type="radio" id="not-in-distress" name="vital_signs" value="not-in-distress" required>
        <label for="not-in-distress">Not in Distress</label><br>
        <input type="radio" id="in-distress" name="vital_signs" value="in-distress">
        <label for="in-distress">In Distress</label>
    </div>
    <div>
        <div>    
            <label for="height">Ht.:</label>
            <input type="text" id="height" name="height" value="<?php echo $height; ?>"><br>
        </div>
        <div>
            <label for="weight">Wt.:</label>
            <input type="text" id="weight" name="weight" value="<?php echo $weight; ?>"><br>
        </div>
        <div>
            <label for="bmi">BMI:</label>
            <input type="text" id="bmi" name="bmi" value="<?php echo $bmi; ?>">
        </div>
    </div>
    <div>
        <div>
            <label for="bp">BP:</label>
            <input type="text" id="bp" name="bp" value="<?php echo $bp; ?>"><br>
        </div>

        <div>
            <label for="hr">HR:</label>
            <input type="text" id="hr" name="hr" value="<?php echo $heart_rate; ?>">
        </div>
    </div>
    <div>
        <div>
            <label for="rr">RR:</label>
            <input type="text" id="rr" name="rr" value="<?php echo $oxygen; ?>"><br>
        </div>
        
        <div>
            <label for="temp">Temp.:</label>
            <input type="text" id="temp" name="temp" value="<?php echo $temp; ?>">
        </div>
    </div>

    <div>
        <h4>Head:</h4>
    <input type="hidden" name="head[]" value="none">
    <input type="checkbox" id="wound" name="head[]" value="wound">
    <label for="wound">Wound</label>
    <input type="checkbox" id="mass" name="head[]" value="mass">
    <label for="mass">Mass</label>
    <input type="checkbox" id="alopecia" name="head[]" value="alopecia">
    <label for="alopecia">Alopecia</label>
    </div>
    <div>
        <h4>Eyes:</h4>
        <input type="hidden" name="eyes[]" value="none">
        <input type="checkbox" id="without-glasses" name="eyes[]" value="without-glasses">
        <label for="without-glasses">w/o Glasses</label>
        <input type="checkbox" id="with-glasses" name="eyes[]" value="with-glasses">
        <label for="with-glasses">w/ Glasses</label>
        <input type="checkbox" id="anicteric-sclera" name="eyes[]" value="anicteric-sclera">
        <label for="anicteric-sclera">Anicteric Sclera</label>
        <input type="checkbox" id="pink-palpebral-conjunctiva" name="eyes[]" value="pink-palpebral-conjunctiva">
        <label for="pink-palpebral-conjunctiva">Pink Palpebral Conjunctiva</label>
    </div>

    <div>
        <h4>Ears:</h4>
        <input type="hidden" name="ears[]" value="none">
        <input type="checkbox" id="no-gross-deformity" name="ears[]" value="no-gross-deformity">
        <label for="no-gross-deformity">No Gross Deformity</label>
        <input type="checkbox" id="no-discharge" name="ears[]" value="no-discharge">
        <label for="no-discharge">No Discharge</label>
    </div>
    <div>
        <h4>Throat:</h4>
        <input type="hidden" name="throat[]" value="none">
        <input type="checkbox" id="no-tpc" name="throat[]" value="no-tpc">
        <label for="no-tpc">No TPC</label>
        <input type="checkbox" id="no-mass-throat" name="throat[]" value="no-mass-throat">
        <label for="no-mass-throat">No Mass</label>
        <input type="checkbox" id="no-lymphadenopathy" name="throat[]" value="no-lymphadenopathy">
        <label for="no-lymphadenopathy">No Lymphadenopathy</label>
    </div>
    <div>
        <h4>Chest/Lungs:</h4>
        <input type="hidden" name="chest_lungs[]" value="none">
        <input type="checkbox" id="normal" name="chest_lungs[]" value="normal">
        <label for="normal">Normal</label>
        <input type="checkbox" id="wheeze" name="chest_lungs[]" value="wheeze">
        <label for="wheeze">Wheeze</label>
        <input type="checkbox" id="rales" name="chest_lungs[]" value="rales">
        <label for="rales">Rales</label>
    </div>
    <div>
        <h4>Chest X-Ray Result:</h4>
        <input type="radio" id="xray-normal" name="xray_result" value="normal" required>
        <label for="xray-normal">Normal</label>
        <input type="radio" id="xray-findings" name="xray_result" value="with findings">
        <label for="xray-findings">With findings</label>
        <input type="text" id="xray-findings-details">
    </div>
    <div>
        <h4>Breast:</h4>
        <input type="hidden" name="breast" value="none">
        <input type="checkbox" id="breast-normal" name="breast" value="normal">
        <label for="breast-normal">Normal</label>
    </div>

    <div>
        <h4>Heart:</h4>
        <label>Murmur:</label>
        <input type="radio" id="murmur-present" name="murmur" value="present" required>
        <label for="murmur-present">Present</label>
        <input type="radio" id="murmur-absent" name="murmur" value="absent">
        <label for="murmur-absent">Absent</label>
        <br>
        <label>Rhythm:</label>
        <input type="radio" id="rhythm-regular" name="rhythm" value="regular" required>
        <label for="rhythm-regular">Regular</label>
        <input type="radio" id="rhythm-irregular" name="rhythm" value="irregular">
        <label for="rhythm-irregular">Irregular</label>
    </div>

    <div>
        <h4>Abdomen:</h4>
        <input type="hidden" name="abdomen" value="none">
        <input type="checkbox" id="abdomen-normal" name="abdomen" value="normal">
        <label for="abdomen-normal">Normal</label>
    </div>

    <div>
        <h4>Genito-Urinary:</h4>
        <label for="genito-urinary">1<sup>st</sup> day of last Menstruation:</label>
        <input type="text" id="genito-urinary" name="genito_urinary" autocomplete="off" value="<?php echo $_SESSION['genito_urinary']; ?>">
    </div>

    <div>
        <h4>Extremities:</h4>
        <input type="hidden" name="extremities" value="none">
        <input type="checkbox" id="no-deformities" name="extremities" value="no-deformities">
        <label for="no-deformities">No Deformities</label>
    </div>

    <div>
        <h4>Vertebral Column:</h4>
        <input type="radio" id="vertebral-normal" name="vertebral_column" value="normal" required>
        <label for="vertebral-normal">Normal</label>
        <input type="radio" id="vertebral-deformity" name="vertebral_column" value="deformity">
        <label for="vertebral-deformity">With Deformity</label>
        <input type="text" id="vertebral-deformity-details" name="vertebral_column">
    </div>

    <div>
        <h4>Skin:</h4>
        <input type="hidden" name="skin[]" value="none">
        <input type="checkbox" id="pallor" name="skin[]" value="pallor">
        <label for="pallor">Pallor</label>
        <input type="checkbox" id="rashes" name="skin[]" value="rashes">
        <label for="rashes">Rashes</label>
        <input type="checkbox" id="lesions" name="skin[]" value="lesions">
        <label for="lesions">Lesions</label>
        <br>
        <label>Scars:</label>
        <input type="radio" id="scars-absent" name="scars" value="absent" required>
        <label for="scars-absent">Absent</label>
        <input type="radio" id="scars-present" name="scars" value="present">
        <label for="scars-present">Present</label>
    </div>

    <div>
    <h4>Working Impression:</h4>
    <input type="text" id="working-impression" name="working_impression" autocomplete="off" value="<?php echo $_SESSION['working_impression']; ?>">
    </div>

    <div>
        <h4>Fit:</h4>
        <input type="text" id="fit" name="fit" autocomplete="off" value="<?php echo $_SESSION['fit']; ?>">
    </div>

    <div>
        <h4>For Work-Up:</h4>
        <input type="text" id="for-work-up" name="for_work_up" autocomplete="off" value="<?php echo $_SESSION['for_work_up']; ?>">
    </div>

    <div>
        <h4>Referred to:</h4>
        <input type="hidden" name="referred_to[]" value="none">
        <input type="checkbox" id="cardio" name="referred_to[]" value="cardio">
        <label for="cardio">Cardio</label>
        <input type="checkbox" id="pulmo" name="referred_to[]" value="pulmo">
        <label for="pulmo">Pulmo</label>
        <br>
        <input type="checkbox" id="derma" name="referred_to[]" value="derma">
        <label for="derma">Derma</label>
        <input type="checkbox" id="ent" name="referred_to[]" value="ent">
        <label for="ent">ENT</label>
        <input type="checkbox" id="optha" name="referred_to[]" value="optha">
        <label for="optha">Optha</label>
        <input type="checkbox" id="others-referred" name="referred_to[]" value="others">
        <label for="others-referred">Others</label>
    </div>
    <div>
        <h4>Follow up on:</h4>
        <input type="text" id="follow-up-on" name="follow_up_on" autocomplete="off" value="<?php echo $_SESSION['follow_up_on']; ?>">
        <input type="submit" value="Submit">
    </div>
</form>
<?php }}else{
    header("location:../pupclinic/admin.php?page=landing_page");
}
    ?> 
<script>
    $(document).ready(function(){
        $('#childhood_illness_others').hide();
        $('#family_history_others').hide();
        $('#xray-findings-details').hide();
        $('#vertebral-deformity-details').hide();
        $('#others-childhood-illness').change(function(){
            if($(this).is(':checked')) {
                $('#childhood_illness_others').attr('name', 'childhood_illness[]').show();
            } else {
                $('#childhood_illness_others').val("").removeAttr('name').hide();
            }
        });
        $('#others-family').change(function(){
            if($(this).is(':checked')) {
                $('#family_history_others').attr('name', 'family_history[]').show();
            } else {
                $('#family_history_others').val("").removeAttr('name').hide();
            }
        });
        $('#xray-findings').change(function(){
            $('#xray-findings-details').attr('name', 'xray_result').show();
        });
        $('#xray-normal').change(function(){
            $('#xray-findings-details').val("").removeAttr('name').hide();
        });
        $('#vertebral-deformity').change(function(){
            $('#vertebral-deformity-details').attr('name', 'vertebral_column').show();
        });
        $('#vertebral-normal').change(function(){
            $('#vertebral-deformity-details').val("").removeAttr('name').hide();
        });
        $('#health-form').on('submit', function(e){
            e.preventDefault();
            $.ajax({
                url: "../pupclinic/php/ajax.php?action=hold_health_record",
                type: "POST",
                data: $(this).serialize(),
                success: function(response){
                    console.log(response)
                    window.location.href = "../pupclinic/admin.php?page=display_health_record";
                },
                error: function(jqXHR, textStatus, errorThrown){
                    console.error(textStatus, errorThrown);
                    console.log(response);
                }
            });
        });
    });
</script>
</div>

