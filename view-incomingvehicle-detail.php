<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if (strlen($_SESSION['vpmsaid']) == 0) {
    header('location:logout.php');
} else {
    if(isset($_POST['submit'])) {
        $cid = $_GET['viewid'];
        $remark = $_POST['remark'];
        $status = $_POST['status'];
        $parkingcharge = $_POST['parkingcharge'];

        $tables = ['tblthreewheels', 'tblfourwheels', 'tbltwowheels'];
        $success = false;

        foreach ($tables as $table) {
            $query = mysqli_query($con, "UPDATE $table SET Remark='$remark', Status='$status', ParkingCharge='$parkingcharge' WHERE ID='$cid'");
            if ($query) {
                $success = true;
            }
        }

        if ($success) {
            $msg = "All remarks have been updated.";
            $btn = "<button type='submit' class='btn btn-info btn-sm' name='submit'>PRINT</button>";
        } else {
            $msg = "Something Went Wrong. Please try again.";
            $btn = "";
        }
    }

    $cid = $_GET['viewid'];
    $tables = ['tblthreewheels', 'tblfourwheels', 'tbltwowheels'];
    $row = null;

    foreach ($tables as $table) {
        $query = mysqli_query($con, "SELECT * FROM $table WHERE ID='$cid'");
        if ($query && mysqli_num_rows($query) > 0) {
            $row = mysqli_fetch_array($query);
            break;
        }
    }


if (!$row) {
    echo "Vehicle details not found.";
} else {
?>

<!doctype html>
<html class="no-js" lang="">

<head>
    <title>View Vehicle Detail</title>
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
    <!-- Left Panel --> <?php include_once('includes/sidebar.php');?>
    <!-- Left Panel -->
    <!-- Right Panel --> <?php include_once('includes/header.php');?> <div class="breadcrumbs">
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
                                <li><a href="manage-incomingvehicle.php">View Vehicle</a></li>
                                <li class="active">Incoming Vehicle</li>
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
                            <strong class="card-title">View Incoming Vehicle</strong>
                        </div>
                        <div class="card-body"> 
                        <?php
                            if ($row) {
                                ?>
                                 <table border="1" class="table table-bordered mg-b-0">
                                    <tr>
                                        <th>Parking Number</th>
                                        <td><?php  echo $row['ParkingNumber'];?></td>
                                    </tr>
                                    <tr>
                                        <th>Vehicle Category</th>
                                        <td><?php  echo $row['VehicleCategory'];?></td>
                                    </tr>
                                    <tr>
                                        <th>Owner Name</th>
                                        <td><?php  echo $row['OwnerName'];?></td>
                                    </tr>
                                    <tr>
                                        <th>In Time</th>
                                        <td><?php  echo $row['InTime'];?></td>
                                    </tr>
                                    <tr>
                                        <th>Status</th>
                                        <td><?php echo ($row['Status'] == "") ? "Vehicle In" : "Vehicle out"; ?></td>
                                    </tr>
                                </table>
                                <?php
                                if ($row['Status'] == "") {
                                ?>
                                    <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                                        <p style="font-size:16px; color:red" align="center"><?php echo isset($msg) ? $msg : ''; ?></p>
                                        <table class="table mb-0">
                                            <tr>
                                                <th>Remark :</th>
                                                <td><textarea name="remark" placeholder="" rows="2" cols="4" class="form-control"></textarea></td>
                                            </tr>
                                            <tr>
                                                <th>Parking Charge: </th>
                                                <td>
                                                    <select name="parkingcharge" class="form-control" required="true">
                                                        <option value="PHP 20.00">PHP 20.00</option>
                                                        <option value="PHP 30.00">PHP 30.00</option>
                                                        <option value="PHP 50.00">PHP 50.00</option>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Status :</th>
                                                <td>
                                                    <select name="status" class="form-control" required="true">
                                                        <option value="Out">Outgoing Vehicle</option>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" style="text-align: center;">
                                                    <button type="submit" class="btn btn-danger btn-sm" name="submit">PARK OUT</button>
                                                </td>
                                            </tr>
                                        </table>
                                    </form>
                                <?php
                                } else {
                                ?>
                                    <table border="1" class="table table-bordered mg-b-0">
                                        <tr>
                                            <th>Remark</th>
                                            <td><?php echo $row['Remark']; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Parking Fee</th>
                                            <td><?php echo $row['ParkingCharge']; ?></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" style="text-align: center;">
                                                <a href="print.php?vid=<?php echo $row['ID']; ?>"><button type="submit" class="btn btn-info btn-sm" name="submit">PRINT</button></a>
                                            </td>
                                        </tr>
                                    </table>
                                    
                                <?php
                                 echo "<p>". print_r($_GET['viewid']) . "</p>";

                                }
                            }
                        }
                        ?>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- .animated -->
    </div><!-- .content -->
    <div class="clearfix"></div>
    <?php include_once('includes/footer.php'); ?>
    
</body>

<script src="https://cdn.jsdelivr.net/npm/jquery@2.2.4/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>
    <script src="assets/js/main.js"></script>
</html>
<?php } ?>