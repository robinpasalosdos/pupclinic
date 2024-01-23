<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Funda Of Web IT</title>
</head>
<body>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card mt-4">
                    <div class="card-header">
                        <h4>Records</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-7">

                                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="GET">
									<div class="input-group mb-3">
										<input type="hidden" name="page" value="<?php if(isset($_GET['page'])){echo $_GET['page']; } ?>">
										<input type="text" name="search" required value="<?php if(isset($_GET['search'])){echo $_GET['search']; } ?>" class="form-control" placeholder="Search data">
										<button type="submit" class="btn btn-primary">Search</button>
									</div>
								</form>


                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="card mt-4">
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>UserType</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Height</th>
                                    <th>Heart Rate</th>
                                    <th>Oxygen</th>
                                    <th>Transaction no.</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    include('../pupclinic/php/db_connect.php');

                                    if(isset($_GET['search']))
                                    {
                                        $filtervalues = $_GET['search'];
                                        $query = "SELECT records.*, users.name, users.email
										FROM records
										LEFT JOIN users ON records.user_id = users.id
										WHERE CONCAT(records.user_type, records.height, records.heart_rate, records.oxygen, records.transaction_no, users.name, users.email) LIKE '%$filtervalues%';";

                                        
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
                                                    <td><?= $items['heart_rate']; ?></td>
                                                    <td><?= $items['oxygen']; ?></td>
                                                    <td><?= $items['transaction_no']; ?></td> 
                                                </tr>
                                                <?php
                                            }
                                        }
                                        else
                                        {
                                            ?>
                                                <tr>
                                                    <td colspan="4">No Record Found</td>
                                                </tr>
                                            <?php
                                        }
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
