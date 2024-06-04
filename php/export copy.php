<?php  
include 'db_connect.php';
$date1 = date("Y-m-d", strtotime($_POST['date1']));
$date2 = date("Y-m-d", strtotime($_POST['date2']));
$i = 1;
$contents = "<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Transaction no.</th>
            <th>Name</th>
            <th>Date</th>
            <th>Time</th>
        </tr>
    </thead>
    <tbody>";

$qry = $conn->query("SELECT * FROM users WHERE date(date_created) BETWEEN '$date1' AND '$date2'");
while ($row = mysqli_fetch_assoc($qry)) {
    $contents .= "<tr>
        <td>".$i++."</td>
        <td>".$row['user_type']."</td>
        <td>".$row['name']."</td>
        <td>".date("m/d/Y", strtotime($row['created_timestamp']))."</td>
        <td>".date("h:i a", strtotime($row['created_timestamp']))."</td>
    </tr>";
}
$contents .= "</tbody></table>";
$file_path = 'record.xls';
if (file_put_contents($file_path, $contents) === false) {
    die('Error writing file');
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';
$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'pupclinic01@gmail.com'; 
    $mail->Password   = 'yrpb rdmp apec ymku';
    $mail->SMTPSecure = 'tls';
    $mail->Port       = 587;
    $mail->setFrom('pupclinic01@gmail.com', 'PUPClinic');
    $mail->addAddress('robinpasalosdos@gmail.com', 'You');
    $mail->addAttachment($file_path);
    $mail->isHTML(true);
    $mail->Subject = 'Your Data';
    $mail->Body    = 'Your Data';
    $mail->MsgHTML('Your Data');
    $mail->SMTPDebug = 2;
    if ($mail->send()) {
        echo 'Message has been sent';
    } else {
        echo 'Message could not be sent. Mailer Error: ' . $mail->ErrorInfo;
    }
    unlink($file_path);
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    unlink($file_path);
}

?>
