<head>
  <title>Physical Examination - PUPClinic</title>
</head>
<?php
echo "<div id='priority'>";
displayPrioritySection();
echo "</div>";

echo "<div id='queue'>";
displayQueueSection();
echo "</div>";

$conn->close();

function displayPrioritySection() {
    global $conn;
    $sql1 = "SELECT * FROM queue WHERE assessment_access = 1 OR assessment_access = 2";
    $prio = $conn->query($sql1);
    if ($prio->num_rows > 0) {
        while($row = $prio->fetch_assoc()) {
            echo "<div class='card'>";
            echo "<div class='card-body'>";
            echo "<h2 class='card-title'>Name: " . $row['name'] . "</h2>";
            echo "<p class='card-text'>UserType: " . $row['user_type'] . "</p>";
            $sql2 = "SELECT * FROM queue WHERE assessment_access = 2";
            $prio2 = $conn->query($sql2);
            if ($prio2->num_rows > 0) {
                if ($row['heart_rate'] == ""){
                    echo "<p class='card-text'>Getting Heart Rate and Oxygen...</p>";
                } else {
                    echo "<p class='card-text'>Heart Rate: " . $row['heart_rate'] . "</p>";
                    echo "<p class='card-text'>Oxygen: " . $row['oxygen'] . "</p>";
                    if ($row['bp'] == ""){
                        echo "<p class='card-text'>Getting Blood Pressure...</p>";
                    } else {
                        echo "<p class='card-text'>Blood Pressure: " . $row['bp'] . "</p>";
                        if ($row['temp'] == ""){
                            echo "<p class='card-text'>Getting Temperature...</p>";
                        } else {
                            echo "<p class='card-text'>Temp: " . $row['temp'] . "</p>";
                            if ($row['height'] == ""){
                                echo "<p class='card-text'>Getting Height and Weight...</p>";
                            } else {
                                echo "<p class='card-text'>Height: " . $row['height'] . "</p>";
                                echo "<p class='card-text'>Weight: " . $row['weight'] . "</p>";
                            }
                        }
                    }
                }
            }
            echo "</div>";
            echo "<button class='btn btn-primary removeButton' data-id='" . $row['id'] . "' data-user_id='" . $row['user_id'] . "' data-user_type='" . $row['user_type'] . "'>Remove</button>";
            echo "</div>";
        }
    } else {
        echo "<div class='center-p'><p>No one has been examined yet. You must give permission for a physical examination first. You can see the list of people requesting permission below.</p></div>";
    }
}

function displayQueueSection() {
    global $conn;
    $sql0 = "SELECT * FROM queue WHERE assessment_access = 0 ORDER BY discomfort_rate DESC";
    $queue = $conn->query($sql0);
    if ($queue->num_rows > 0) {
        $noPriorityRows = checkIfNoPriorityRows();
        while($row = $queue->fetch_assoc()) {
            echo "<div class='card'>";
                echo "<div class='card-body'>";
                    echo "<h5 class='card-text'>Name: " . $row['name'] . "</h5>";
                    echo "<p class='card-text'>User Type: " . $row['user_type'] . "</p>";
                    echo "<p class='card-text'>Discomfort Rate: " . $row['discomfort_rate'] . "</p>";

                    $disableButton = checkIfNoPriorityRows() ? '' : 'disabled';

                    echo "<button class='btn btn-primary accessButton' data-id='" . $row['id'] . "' data-user_id='" . $row['user_id'] . "' data-user_type='" . $row['user_type'] . "' $disableButton>Give Access</button>";
                    echo "<button class='btn btn-primary removeButton' data-id='" . $row['id'] . "' data-user_id='" . $row['user_id'] . "' data-user_type='" . $row['user_type'] . "'>Remove</button>";
                echo "</div>";
            echo "</div>";
        }
    } else {
        echo "<div class='center-p'><p>No one is in line</p></div>";
    }
}



function checkIfNoPriorityRows() {
    global $conn;
    $sql1 = "SELECT COUNT(*) as count FROM queue WHERE assessment_access = 1";
    $result = $conn->query($sql1);
    $row = $result->fetch_assoc();
    return $row['count'] == 0;
}

function updateFirstRowToPriority() {
    global $conn;
    $sqlUpdate = "UPDATE queue SET assessment_access = 1 WHERE assessment_access = 0 LIMIT 1";
    $conn->query($sqlUpdate);
}
?>

<script>
$(document).ready(function(){
    function refreshData() {
        $.ajax({
            url: '../pupclinic/admin.php?page=assessment',
            success: function(data) {
                $('#priority').html($(data).find('#priority').html());
                $('#queue').html($(data).find('#queue').html());
            },
            complete: function() {
                setTimeout(refreshData, 5000);
            }
        });
    }

    refreshData();

    $(document).on('click', '.accessButton', function(){
        var id = $(this).data('id');
        var user_id = $(this).data('user_id');
        var user_type = $(this).data('user_type');
        var data = {
            id: id,
            user_id: user_id,
            user_type: user_type
        };
        $.ajax({
            url: '../pupclinic/php/ajax.php?action=give_access',
            type: 'post',
            data: data,
            success:function(response){
                console.log(response);
            }
        });
    });

    function remove_queue($id, $user_id, $user_type) {
        if (confirm("Do you want to delete?")) {
            var data = {
                id: $id,
                user_id: $user_id,
                user_type: $user_type
            };
            $.ajax({
                url: '../pupclinic/php/ajax.php?action=remove_queue',
                method: 'POST',
                data: data,
                success: function(resp) {
                    console.log(resp);
                }
            });
        }
    }

    $(document).on('click', '.removeButton', function() {
        remove_queue($(this).attr('data-id'), $(this).attr('data-user_id'), $(this).attr('data-user_type'));
    });

});
</script>
