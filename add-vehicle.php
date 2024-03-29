<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

    if (strlen($_SESSION['vpmsaid']) == 0) {
        header('location:logout.php');
    } 
    else {
        // !RETRIEVE THE LINKS
        $selectedCategory = $_GET['category'] ?? '';
        //  !RETRIEVE THE LINKS

        if (isset($_POST['submit'])) {
            $parkingnumber = mt_rand(100000, 999999);
            $catename = $_POST['catename'];
            $ownername = $_POST['ownername'];
            $enteringtime = $_POST['enteringtime'];
    
            // Check if a valid category is selected
            if ($catename != "0") {
                // Determine which table to insert into based on the category
                $tableName = '';
                switch ($catename) {
                    case 'Four Wheeler Vehicle':
                        $tableName = 'tblfourwheels';
                        break;
                    case 'Three Wheeler Vehicle':
                        $tableName = 'tblthreewheels';
                        break;
                    case 'Two Wheeler Vehicle':
                        $tableName = 'tbltwowheels';
                        break;
                    default:
                        // Handle invalid category
                        echo "<script>alert('Invalid vehicle category');</script>";
                        break;
                }
                if (!empty($tableName)) {
                    echo "<script>console.log('dito pumapasok pa');</script>";
                    // Insert data into the corresponding table
                    $query = mysqli_query($con, "INSERT INTO $tableName (ParkingNumber, VehicleCategory, OwnerName) VALUES ('$parkingnumber', '$catename', '$ownername')");
                    $query = mysqli_query($con, "INSERT INTO tblvehicle (ParkingNumber, VehicleCategory, OwnerName) VALUES ('$parkingnumber', '$catename', '$ownername')");

                    if ($query) {
                        
                        echo "<script>alert('Vehicle Entry Detail has been added');</script>";
                        echo "<script>window.location.href ='manage-incomingvehicle.php'</script>";
                    } else {
                        echo "<script>console.log('may mali gago');</script>";
                        echo "<script>alert('Something Went Wrong. Please try again. Error: " . mysqli_error($con) . "');</script>";
                    }
                    echo "<script>console.log('tingin nga');</script>";
                }
            } else {
                // Alert the user to select a category
                echo "<script>alert('Please select a category');</script>";
            }
        
        }

?>

<!doctype html>
<html class="no-js" lang="">
<head>
    
    <title>Add Vehicle</title>
   

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
    <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/html5shiv/3.7.3/html5shiv.min.js"></script> -->

</head>
<body>
   <?php include_once('includes/sidebar.php');?>
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
                                    <li><a href="add-vehicle.php">Vehicle</a></li>
                                    <li class="active">Add Vehicle</li>
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
                    <div class="col-lg-6">
                        <div class="card">
                            
                           
                        </div> <!-- .card -->

                    </div><!--/.col-->

              

                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <strong>Add </strong> Vehicle
                            </div>
                            <div class="card-body card-block">
                                <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                                    <p style="font-size:16px; color:red" align="center"> <?php if($msg){
    echo $msg;
  }  ?> </p>
                                   

                                    <div class="row form-group">
                                        <div class="col col-md-3"><label for="select" class=" form-control-label">Select</label></div>
                                        <div class="col-12 col-md-9">

                                            <!-- SELECT THE LINKS -->
                                            <select name="catename" id="catename" class="form-control">
                                                <option value="0">Select Category</option>
                                                <?php
                                                $query = mysqli_query($con, "select * from tblcategory");
                                                while ($row = mysqli_fetch_array($query)) {
                                                    $selected = ($row['VehicleCat'] == $selectedCategory) ? 'selected' : '';
                                                ?>    
                                                    <option value="<?php echo $row['VehicleCat']; ?>" <?php echo $selected; ?>><?php echo $row['VehicleCat']; ?></option>
                                                <?php } ?> 
                                            </select>
                                            <!-- /SELECT THE LINKS -->

                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-3"><label for="text-input" class=" form-control-label">Owner Name</label></div>
                                        <div class="col-12 col-md-9"><input type="text" id="ownername" name="ownername" class="form-control" placeholder="Owner Name" required="true"></div>
                                    </div>                             
                                    
                                   <p style="text-align: center;"> <button type="submit" class="btn btn-primary btn-sm" name="submit" >PARK IN</button></p>
                                </form>
                            </div>
                            
                        </div>
                        
                    </div>

                    <div class="col-lg-6">
                        
                  
                </div>

           

            </div>


        </div><!-- .animated -->
    </div><!-- .content -->

    <div class="clearfix"></div>

   <?php include_once('includes/footer.php');?>

</div><!-- /#right-panel -->

<!-- Right Panel -->

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/jquery@2.2.4/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>
<script src="assets/js/main.js"></script>


</body>
</html>
<?php }  ?>