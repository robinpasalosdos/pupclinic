<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../pupclinic/css/style.css">
    <link rel="stylesheet" href="../pupclinic/css/admin.css">
    <script src="jquery-3.6.0.min.js"></script>
    <?php
        include('php/db_connect.php');
        session_start();
        if(isset($_SESSION['user'])){
            if($_SESSION['user'] == 'admin'){
                header("location:../pupclinic/admin.php?page=landing_page");
            }
            else {
                header("location:../pupclinic/dashboard.php?page=landing_page");
            }
        }
    ?>
</head>
<body>
    <main>
        <?php $page = isset($_GET['page']) ? $_GET['page'] :'landing_page'; ?>
        <?php include 'pages/'.$page.'.php' ?>
    </main>
</body>
</html>
