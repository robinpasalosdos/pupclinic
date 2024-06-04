<head>
    <title>Records - PUPClinic</title>   
</head>
<div class="records-table">
    <h1>Records</h1>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="GET">
        <input type="hidden" name="page" value="<?php if(isset($_GET['page'])){echo $_GET['page']; } ?>">
        <input type="text" name="search" value="<?php if(isset($_GET['search'])){echo $_GET['search']; } ?>" placeholder="Search data">
        <button type="submit">Search</button>
        <button type="button" onclick="show_dialog()">Export</button>
    </form>
    <div>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>UserType</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Height</th>
                    <th>Temperature</th>
                    <th>Heart Rate</th>
                    <th>Oxygen</th>
                    <th>BP</th>
                    <th>Transaction no.</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    include('../pupclinic/php/db_connect.php');


                        $filtervalues = $_GET['search'];
                        if($filtervalues == ""){
                            $query = "SELECT * FROM records";
                        }else{
                            $query = "SELECT * FROM records WHERE CONCAT(user_type,name,email,height,heart_rate,oxygen,transaction_no) LIKE '%$filtervalues%' ";
                        }
                        $query_run = mysqli_query($conn, $query);

                        if(mysqli_num_rows($query_run) > 0)
                        {
                            foreach($query_run as $items)
                            {
                                ?>
                                <tr>
                                    <td><?= $items['id']; ?></td>
                                    <td><?= $items['user_type']; ?></td>
                                    <td><?= $items['name']; ?></td>
                                    <td><?= $items['email']; ?></td>
                                    <td><?= $items['height']; ?></td>
                                    <td><?= $items['temp']; ?></td>
                                    <td><?= $items['heart_rate']; ?></td>
                                    <td><?= $items['oxygen']; ?></td>
                                    <td><?= $items['bp']; ?></td>
                                    <td><?= $items['transaction_no']; ?></td>
                                    <td><?= date('M d, Y', strtotime($items['date_created'])); ?></td>
                                    <td><?= date('h:i A', strtotime($items['created_timestamp'])); ?></td>
                                    <td><a class="view_health_record" href="javascript:void(0)" data-tn="<?= $items['transaction_no'] ?>">See more</a></td>
                                </tr>
                                <?php
                            }
                        }
                        else
                        {
                            ?>
                                <tr>
                                    <td>No Record Found</td>
                                </tr>
                            <?php
                        } 
                ?>
            </tbody>
        </table>
    </div>
</div>
<div id="overlay" onclick="hide_dialog()"></div>
<div id="export_dialog" class="floating-container">
    <div class="floating-register">
        <form id="register" method="post" action="php/export.php">
            <label for="date1">Start Date</label>
            <input type="date" placeholder="Start" id="date1" name="date1" required><br>
            <label for="date2">End Date</label>
            <input type="date" placeholder="End" id="date2" name="date2" disabled><br>
            <button>Export Data</button>
        </form>   
    </div>      
</div>
<script>
    var dtToday = new Date();
    var month = dtToday.getMonth() + 1;
    var day2 = dtToday.getDate();
    var day1 = dtToday.getDate() - 1;
    var year = dtToday.getFullYear();

    if(month < 10)
        month = '0' + month.toString();
    if(day2 < 10)
        day2 = '0' + day2.toString();
    if(day1 < 10)
        day1 = '0' + day1.toString();

    var maxDate2 = year + '-' + month + '-' + day2;
    var maxDate1 = year + '-' + month + '-' + day1;
    $('#date2').val(maxDate2);       
    $('#date2').attr('max', maxDate2);
    $('#date1').attr('max', maxDate1);
    
    $(document).ready(function() {
        $('#date1').change(function() {
            var date1Value = $('#date1').val();
            if (date1Value) {
                $("#date2").prop("disabled", false);
                $('#date2').attr('min', date1Value);
            } else {
                $("#date2").prop("disabled", true);
                $('#date2').removeAttr('min');
            }
        });
        $('.generate').click(function(e){
            e.preventDefault()
            var date1 = $("#date1").val().trim();
            var date2 = $("#date2").val().trim();
            var transaction_id = $("#transaction_id").val().trim();
            if(date1 == ""){
                alert("Insert start date")
            }else{
                $.ajax({
                    url:'ajax.php?action=display_queue',
                    data: {date1:date1,date2:date2,transaction_id:transaction_id},
                    method: 'POST',
                    success:function(resp){
                        $('#refresh').html(resp);
                    }
                })
            }
        });
    });

    $('.view_health_record').click(function(){
        location.href = "../pupclinic/admin.php?page=view_health_record&tn=" + $(this).attr('data-tn');
    }) 
    function show_dialog(){  
            $('#export_dialog').css('display', 'block');
            $('#overlay').css('display', 'block');
        }
    function hide_dialog(){
        $('#export_dialog').hide();
        $('#overlay').hide();
    }
</script>

