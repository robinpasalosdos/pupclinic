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
    $sql1 = "SELECT * FROM queue WHERE assessment_access = 1";
    $prio = $conn->query($sql1);
    if ($prio->num_rows > 0) {
        while($row = $prio->fetch_assoc()) {
            echo "<div class='card'>";
            echo "<div class='card-body'>";
            echo "<h5 class='card-title'>Name: " . $row['name'] . "</h5>";
            echo "<p class='card-text'>UserType: " . $row['user_type'] . "</p>";
            if ($row['height'] == ""){
                echo "<p class='card-text'>Getting Height...</p>";
            } else {
                echo "<p class='card-text'>Height: " . $row['height'] . "</p>";
                if ($row['temp'] == ""){
                    echo "<p class='card-text'>Getting Temperature...</p>";
                } else {
                    echo "<p class='card-text'>Temp: " . $row['temp'] . "</p>";
                    if ($row['heart_rate'] == ""){
                        echo "<p class='card-text'>Getting Heart Rate...</p>";
                    } else {
                        echo "<p class='card-text'>Heart Rate: " . $row['heart_rate'] . "</p>";
                        if ($row['oxygen'] == ""){
                            echo "<p class='card-text'>Getting Oxygen Rate...</p>";
                        } else {
                            echo "<p class='card-text'>Oxygen Rate: " . $row['oxygen'] . "</p>";
                        }
                    }
                }
            }
            echo "</div>";
            echo "<button class='btn btn-primary removeButton' data-id='" . $row['id'] . "'>Remove</button>";
            echo "</div>";
        }
    } else {
        echo "<p>No one used the machine. Choose one from below if there's someone queued to be given access to using the machine.</p>";
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
            echo "<h5 class='card-title'>ID: " . $row['id'] . "</h5>";
            echo "<p class='card-text'>Name: " . $row['name'] . "</p>";
            echo "<p class='card-text'>User Type: " . $row['user_type'] . "</p>";

            $disableButton = checkIfNoPriorityRows() ? '' : 'disabled';

            echo "<button class='btn btn-primary accessButton' data-id='" . $row['id'] . "' data-user_id='" . $row['user_id'] . "' $disableButton>Give Access</button>";
            echo "<button class='btn btn-primary removeButton' data-id='" . $row['id'] . "'>Remove</button>";
            echo "</div>";
            echo "</div>";
        }
    } else {
        echo "<p>No one is in line</p>";
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
        var data = {
            id: id,
            user_id: user_id
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

    function remove_queue($id){
		if (confirm("Do you want to delete?") == true) {
			$.ajax({
				url:'../pupclinic/php/ajax.php?action=remove_queue',
				method:'POST',
				data:{id:$id},
				success:function(resp){
                    console.log(resp);
				}
			})
		}
	}

    $(document).on('click', '.removeButton', function(){
        remove_queue($(this).attr('data-id'))
    })
});
</script>
