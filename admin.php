<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../pupclinic/css/style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <?php
        include('php/db_connect.php');
        session_start();
        if(isset($_SESSION['user'])){
            if($_SESSION['user'] == 'student' || $_SESSION['user'] == 'faculty'){
                header("location:../pupclinic/dashboard.php?page=landing_page");
            }
        }else{
            header("location:../pupclinic/index.php?page=menu");
        }
    ?>
</head>
<body>
    <main>
        <?php $page = isset($_GET['page']) ? $_GET['page'] :'landing_page'; ?>
        <!-- wow babaero si robin -->
       <?php include 'pages/admin/'.$page.'.php' ?>
    </main>
</body>
</html>
