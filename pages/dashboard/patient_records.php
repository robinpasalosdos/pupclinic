<head>   
</head>
<div class="records-table">
    <h1>Records</h1>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="GET">
        <input type="hidden" name="page" value="<?php if(isset($_GET['page'])){echo $_GET['page']; } ?>">
        <input type="text" name="search" value="<?php if(isset($_GET['search'])){echo $_GET['search']; } ?>" placeholder="Search data">
        <button type="submit">Search</button>
    </form>
<table>
    <thead>
        <tr>
            <th>Date</th>
            <th>Height (cm)</th>
            <th>Weight (kg)</th>
            <th>BMI (kg/m²)</th>
            <th>Temperature (℃)</th>
            <th>Heart Rate (bpm)</th>
            <th>Oxygen (%)</th>
            <th>Transaction no.</th>
            <th>Action</th>

        </tr>
    </thead>
    <tbody>
        <?php 
            include('../pupclinic/php/db_connect.php');


                $filtervalues = $_GET['search'];
                $id = $_SESSION['id'];
                if($_GET['search'] == ""){
                    $query = "SELECT * FROM records WHERE user_id=$id";
                }else{
                    $query = "SELECT * FROM records WHERE user_id = $id AND CONCAT(height, temp, heart_rate, oxygen, transaction_no, date_created) LIKE '%$filtervalues%'";
                }
                $query_run = mysqli_query($conn, $query);

                if(mysqli_num_rows($query_run) > 0)
                {
                    foreach($query_run as $items)
                    {
                        ?>
                        <tr>
                            <td><?= $items['date_created']; ?></td>
                            <td><?= $items['height']; ?></td>
                            <td><?= $items['weight']; ?></td>
                            <td><?= $items['bmi']; ?></td>
                            <td><?= $items['temp']; ?></td>
                            <td><?= $items['heart_rate']; ?></td>
                            <td><?= $items['oxygen']; ?></td>
                            <td><?= $items['transaction_no']; ?></td>
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

<script>
$('.view_health_record').click(function(){
    location.href = "../pupclinic/dashboard.php?page=view_health_record&tn=" + $(this).attr('data-tn');
});
</script>
