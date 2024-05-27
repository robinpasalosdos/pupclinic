<head>   
</head>
<div class="records-table">
    <h1>Users</h1>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="GET">
        <input type="hidden" name="page" value="<?php if(isset($_GET['page'])){echo $_GET['page']; } ?>">
        <input type="text" name="search" value="<?php if(isset($_GET['search'])){echo $_GET['search']; } ?>" placeholder="Search data">
        <button type="submit">Search</button>
    </form>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>UserID</th>
                <th>UserType</th>
                <th>Name</th>
                <th>Email</th>
                <th>Height</th>
                <th>Weight</th>
                <th>Temp</th>
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
                    if($_GET['search'] == ""){
                        $query = "SELECT * FROM records WHERE assessment_status = 1";
                    }else{
                        $query = "SELECT * FROM records WHERE assessment_status = 1 AND CONCAT(user_id,user_type,name,email,height,temp,heart_rate,oxygen,transaction_no) LIKE '%$filtervalues%' ";
                    }
                    $query_run = mysqli_query($conn, $query);

                    if(mysqli_num_rows($query_run) > 0)
                    {
                        foreach($query_run as $items)
                        {
                            ?>
                            <tr>
                                <td><?= $items['id']; ?></td>
                                <td><?= $items['user_id']; ?></td>
                                <td><?= $items['user_type']; ?></td>
                                <td><?= $items['name']; ?></td>
                                <td><?= $items['email']; ?></td>
                                <td><?= $items['height']; ?></td>
                                <td><?= $items['weight']; ?></td>
                                <td><?= $items['temp']; ?></td>
                                <td><?= $items['heart_rate']; ?></td>
                                <td><?= $items['oxygen']; ?></td>
                                <td><?= $items['bp']; ?></td>
                                <td><?= $items['transaction_no']; ?></td>
                                <td><?= date('M d, Y', strtotime($items['date_created'])); ?></td>
                                <td><?= date('h:i A', strtotime($items['created_timestamp'])); ?></td>
                                <td>
                                    <a class="assess" href="javascript:void(0)" data-id="<?= $items['id'] ?>" data-name="<?= $items['name'] ?>" data-height="<?= $items['height'] ?>" data-weight="<?= $items['weight'] ?>" data-temp="<?= $items['temp'] ?>" data-heart_rate="<?= $items['heart_rate'] ?>" data-oxygen="<?= $items['oxygen'] ?>" data-bp="<?= $items['bp'] ?>">Assess</a>
                                </td>
                                
                                
                                
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
    $('.assess').click(function(){
        var id = $(this).data('id');
        var data = {
                id: id,
                name: $(this).data('name'),
                height: $(this).data('height'),
                weight: $(this).data('weight'),
                heart_rate: $(this).data('heart_rate'),
                oxygen: $(this).data('oxygen'),
                bp: $(this).data('bp'),
                temp: $(this).data('temp')
            };
        $.ajax({
				url:'../pupclinic/php/ajax.php?action=assess',
				method:'POST',
				data:data,
				success:function(resp){
					if(resp==1){
                        window.location.href = "../pupclinic/admin.php?page=form";
					}
				}
			})
    });

</script>
