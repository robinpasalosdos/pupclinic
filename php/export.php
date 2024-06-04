<?php  
include 'db_connect.php';
    
$date1 = date("Y-m-d",strtotime($_POST['date1']));
$date2 = date("Y-m-d",strtotime($_POST['date2']));
$i = 1;
$contents = "<table>
      <thead>
        <tr>
        <th>ID</th>
        <th>Transaction No</th>
        <th>Name</th>
        <th>Address</th>
        <th>Contact</th>
        <th>College Department</th>
        <th>Course School Year</th>
        <th>Emergency Contact</th>
        <th>Contact No</th>
        <th>Age</th>
        <th>Sex</th>
        <th>Civil Status</th>
        <th>Childhood Illness</th>
        <th>Previous Hospitalization</th>
        <th>Operation/Surgery</th>
        <th>Current Medications</th>
        <th>Allergies</th>
        <th>Family History</th>
        <th>Cigarette Smoking</th>
        <th>Alcohol Drinking</th>
        <th>Traveled Abroad</th>
        <th>Working Impression</th>
        <th>Vital Signs</th>
        <th>Height</th>
        <th>Weight</th>
        <th>BMI</th>
        <th>BP</th>
        <th>HR</th>
        <th>RR</th>
        <th>Temp</th>
        <th>Head</th>
        <th>Eyes</th>
        <th>Ears</th>
        <th>Throat</th>
        <th>Chest/Lungs</th>
        <th>X-ray Result</th>
        <th>Breast</th>
        <th>Heart Murmur</th>
        <th>Heart Rhythm</th>
        <th>Abdomen</th>
        <th>Genito-Urinary</th>
        <th>Extremities</th>
        <th>Vertebral Column</th>
        <th>Skin</th>
        <th>Scars</th>
        <th>Referred To</th>
        <th>Follow-up On</th>
        <th>Fit</th>
        <th>For Work-up</th>
        <th>Date</th>
        <th>Time</th>
        </tr>
      </thead>
      <tbody>";
$qry = $conn->query("SELECT * FROM health_record where date(date_created) BETWEEN '".$date1."' AND '".$date2."'");
while($row=mysqli_fetch_assoc($qry)){
    $contents .= "<tr>
    <td>".$i++."</td>
    <td>".$row['transaction_no']."</td>
    <td>".$row['name']."</td>
    <td>".$row['address']."</td>
    <td>".$row['contact']."</td>
    <td>".$row['college_department']."</td>
    <td>".$row['course_school_year']."</td>
    <td>".$row['emergency_contact']."</td>
    <td>".$row['contact_no']."</td>
    <td>".$row['age']."</td>
    <td>".$row['sex']."</td>
    <td>".$row['civil_status']."</td>
    <td>".$row['childhood_illness']."</td>
    <td>".$row['previous_hospitalization']."</td>
    <td>".$row['operation_surgery']."</td>
    <td>".$row['current_medications']."</td>
    <td>".$row['allergies']."</td>
    <td>".$row['family_history']."</td>
    <td>".$row['cigarette_smoking']."</td>
    <td>".$row['alcohol_drinking']."</td>
    <td>".$row['traveled_abroad']."</td>
    <td>".$row['working_impression']."</td>
    <td>".$row['vital_signs']."</td>
    <td>".$row['height']."</td>
    <td>".$row['weight']."</td>
    <td>".$row['bmi']."</td>
    <td>".$row['bp']."</td>
    <td>".$row['hr']."</td>
    <td>".$row['rr']."</td>
    <td>".$row['temp']."</td>
    <td>".$row['head']."</td>
    <td>".$row['eyes']."</td>
    <td>".$row['ears']."</td>
    <td>".$row['throat']."</td>
    <td>".$row['chest_lungs']."</td>
    <td>".$row['xray_result']."</td>
    <td>".$row['breast']."</td>
    <td>".$row['heart_murmur']."</td>
    <td>".$row['heart_rhythm']."</td>
    <td>".$row['abdomen']."</td>
    <td>".$row['genito_urinary']."</td>
    <td>".$row['extremities']."</td>
    <td>".$row['vertebral_column']."</td>
    <td>".$row['skin']."</td>
    <td>".$row['scars']."</td>
    <td>".$row['referred_to']."</td>
    <td>".$row['follow_up_on']."</td>
    <td>".$row['fit']."</td>
    <td>".$row['for_work_up']."</td>
    <td>".date("m/d/Y",strtotime($row['created_timestamp']))."</td>
    <td>".date("h:i a",strtotime($row['created_timestamp']))."</td>
  </tr>";
}
$contents .= "</tbody>
</table>";
header("Content-Type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=health_record.xls");      
echo $contents;
?>
