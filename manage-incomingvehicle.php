<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

// Set the time zone to match the server's time zone
date_default_timezone_set('Asia/Manila');

if (strlen($_SESSION['vpmsaid']) == 0) {
    header('location:logout.php');
} else {
    ?>
    <!doctype html>
    <html class="no-js" lang="">
    <head>
        <title>Manage Incoming Vehicle</title>
        <link rel="apple-touch-icon" href="https://i.imgur.com/QRAUqs9.png">
        <link rel="shortcut icon" href="https://i.imgur.com/QRAUqs9.png">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/normalize.css@8.0.0/normalize.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pixeden-stroke-7-icon@1.2.3/pe-icon-7-stroke/dist/pe-icon-7-stroke.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.2.0/css/flag-icon.min.css">
        <link rel="stylesheet" href="assets/css/cs-skin-elastic.css">
        <link rel="stylesheet" href="assets/css/style.css">
        <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
    </head>
    <body>
        <!-- Left Panel -->
        <?php include_once('includes/sidebar.php');?>
        <!-- Left Panel -->

        <!-- Right Panel -->
        <?php include_once('includes/header.php');?>
        <div class="breadcrumbs">
            <div class="breadcrumbs-inner">
                <div class="row m-0">
                    <div class="col-sm-4">
                        <div class="page-header float-left">
                            <div class="page-title">
                                <h1>Dashboard</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="page-header float-right">
                            <div class="page-title">
                                <ol class="breadcrumb text-right">
                                    <li><a href="dashboard.php">Dashboard</a></li>
                                    <li><a href="manage-incomingvehicle.php">Manage Vehicle</a></li>
                                    <li class="active">Manage Incoming Vehicle</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="content">
            <div class="animated fadeIn">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title">Manage Incoming Vehicle</strong>
                            </div>
                            <div class="card-body">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>S.NO</th>
                                            <th>Parking Number</th>
                                            <th>Owner Name</th>
                                            <th>Vehicle Category</th>
                                            <th>Total Minutes</th>
                                            <th class = "text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $queryFourWheels = mysqli_query($con, "SELECT * FROM tblfourwheels WHERE Status=''");
                                        $queryThreeWheels = mysqli_query($con, "SELECT * FROM tblthreewheels WHERE Status=''");
                                        $queryTwoWheels = mysqli_query($con, "SELECT * FROM tbltwowheels WHERE Status=''");
                                        
                                        function calculateTotalMinutes($inTime) {
                                            $timeIn = strtotime($inTime);
                                            $timeOut = time();
                                            return ($timeOut - $timeIn) / 60;
                                        }

                                        $cnt = 1;
                                        while ($row = mysqli_fetch_array($queryFourWheels)) {
                                            $totalMinutes = calculateTotalMinutes($row['InTime']);
                                            ?>
                                            <tr>
                                                <td><?php echo $cnt;?></td>
                                                <td><?php echo $row['ParkingNumber'];?></td>
                                                <td><?php echo $row['OwnerName'];?></td>
                                                <td>Four Wheeler</td>
                                                <td><?php echo floor($totalMinutes) . " Minutes";?></td>
                                                <td>
                                                    <a id='parkout' href="view-incomingvehicle-detail.php?viewid=<?php echo $row['ID'];?>">
                                                        <button type="button" class="btn btn-outline-danger">Park-Out</button>
                                                    </a>
                                                    <a href="print.php?vid=<?php echo $row['ID'];?>" style="cursor:pointer" target="_blank">
                                                        <button type="button" class="btn btn-outline-info">Print</button>
                                                    </a>
                                                </td>
                                            </tr>
                                            <?php 
                                            $cnt++;
                                        }

                                        // Display data from tblthreewheels
                                        while ($row = mysqli_fetch_array($queryThreeWheels)) {
                                            $totalMinutes = calculateTotalMinutes($row['InTime']);
                                            ?>
                                            <tr>
                                                <td><?php echo $cnt;?></td>
                                                <td><?php echo $row['ParkingNumber'];?></td>
                                                <td><?php echo $row['OwnerName'];?></td>
                                                <td>Three Wheeler</td>
                                                <td><?php echo floor($totalMinutes) . " Minutes";?></td>
                                                <td>
                                                    <a id='parkout' href="view-incomingvehicle-detail.php?viewid=<?php echo $row['ID'];?>">
                                                        <button type="button" class="btn btn-outline-danger">Park-Out</button>
                                                    </a>
                                                    <a href="print.php?vid=<?php echo $row['ID'];?>" style="cursor:pointer" target="_blank">
                                                        <button type="button" class="btn btn-outline-info">Print</button>
                                                    </a>
                                                </td>
                                            </tr>
                                            <?php 
                                            $cnt++;
                                        }

                                        // Display data from tbltwowheels
                                        while ($row = mysqli_fetch_array($queryTwoWheels)) {
                                            $totalMinutes = calculateTotalMinutes($row['InTime']);
                                            ?>
                                            <tr>
                                                <td><?php echo $cnt;?></td>
                                                <td><?php echo $row['ParkingNumber'];?></td>
                                                <td><?php echo $row['OwnerName'];?></td>
                                                <td>Two Wheeler</td>
                                                <td><?php echo floor($totalMinutes) . " Minutes";?></td>
                                                <td>
                                                    <a id='parkout' href="view-incomingvehicle-detail.php?viewid=<?php echo $row['ID'];?>">
                                                        <button type="button" class="btn btn-outline-danger">Park-Out</button>
                                                    </a>
                                                    <a href="print.php?vid=<?php echo $row['ID'];?>" style="cursor:pointer" target="_blank">
                                                        <button type="button" class="btn btn-outline-info">Print</button>
                                                    </a>
                                                </td>
                                            </tr>
                                            <?php 
                                            $cnt++;
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <?php include_once('includes/footer.php');?>
        <!-- /#right-panel -->
        <!-- Right Panel -->
        <!-- Scripts -->
        <script src="https://cdn.jsdelivr.net/npm/jquery@2.2.4/dist/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>
        <script src="assets/js/main.js"></script>
    </body>
    </html>
    <?php
}
?>