<?php 
include_once 'admin-class.php';
$admin = new itg_admin();
$admin->_authenticate();
?>
<!DOCTYPE html>
<html>

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Form With Labels On Top</title>

        <link rel="stylesheet" href="assets/demo.css">
        <link rel="stylesheet" href="assets/form-labels-on-top.css">

    </head>


    <header>
        <h1>Dashboard</h1>
          <h2><a href="logout.php"> logout</a></h2>
    </header>

    <ul>
        <li><a href="addData.php">Add Data</a></li>
    </ul>


    <div class="main-content">

        <!-- You only need this form and the form-labels-on-top.css -->



    </div>

</body>

</html>
