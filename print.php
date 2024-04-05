<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if (strlen($_SESSION['vpmsaid']) == 0) {
    header('location:logout.php');
} else {
?>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/normalize.css@8.0.0/normalize.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pixeden-stroke-7-icon@1.2.3/pe-icon-7-stroke/dist/pe-icon-7-stroke.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.2.0/css/flag-icon.min.css">
  <link rel="stylesheet" href="assets/css/cs-skin-elastic.css">
  <link rel="stylesheet" href="assets/css/style.css">

  <?php
  $cid = $_GET['vid'];
  $tables = ['tblthreewheels', 'tblfourwheels', 'tbltwowheels'];
  $row = null;

  foreach ($tables as $table) {
      $query = mysqli_query($con, "SELECT * FROM $table WHERE ID='$cid'");
      if ($query && mysqli_num_rows($query) > 0) {
          $row = mysqli_fetch_array($query);
          break;
      }
  }

  if ($row) {
      $timeIn = strtotime($row['InTime']);
      $timeOut = strtotime($row['OutTime']);

      // Check if both timeIn and timeOut are valid timestamps
      if ($timeIn !== false && $timeOut !== false) {
          // Calculate total minutes only if both timestamps are valid
          $totalMinutes = ($timeOut - $timeIn) / 60;
      } else {
          // Set total minutes to 0 or display an error message if timestamps are invalid
          $totalMinutes = 0;
          // You can also handle this case by displaying an error message to the user
      }
      ?>
      <div id="example">

          <table border="1" class="table table-bordered mg-b-0">
              <tr>
                  <th colspan="4" style="text-align: center; font-size:22px;"> Vehicle Parking receipt</th>
              </tr>
              <tr>
                  <th>Owner Name</th>
                  <td colspan="3"><?php echo $row['OwnerName']; ?></td>
              </tr>
              <tr>
                  <th>Parking Number</th>
                  <td><?php echo $row['ParkingNumber']; ?></td>
                  <th>Vehicle Category</th>
                  <td><?php echo $row['VehicleCategory']; ?></td>
              </tr>
              <tr>
                  <th>In Time</th>
                  <td><?php echo date("H:i:s", strtotime($row['InTime'])); ?></td>
                  <th>Status</th>
                  <td><?php echo ($row['Status'] == "") ? "Park In Vehicle" : "Park Out Vehicle"; ?></td>
              </tr>
              <?php if ($row['Status'] == "Out") { ?>
                  <tr>
                      <th>Out time</th>
                      <td><?php echo date("H:i:s", strtotime($row['OutTime'])); ?></td>
                      <th>Parking Charge</th>
                      <td><?php echo $row['ParkingCharge']; ?></td>
                  </tr>
              <?php } ?>
              <?php if ($timeOut != 0) { ?>
                  <tr>
                      <th>Total Minutes</th>
                      <td colspan="3"><?php echo floor($totalMinutes); ?> Minutes</td>
                  </tr>
                  <tr>
                      <th>Remark</th>
                      <td colspan="3"><?php echo $row['Remark']; ?></td>
                  </tr>
              <?php } ?>
              <!-- Print button -->
              <tr>
                  <td colspan="4" style="text-align:center; cursor:pointer"><i class="fa fa-print fa-2x" aria-hidden="true" OnClick="CallPrint()"></i></td>
              </tr>
          </table>
      </div>
  <?php } else {
      // If no data found
      echo "Vehicle details not found.";
  } ?>

      <script>
          function CallPrint() {
              var prtContent = document.getElementById("example");
              var WinPrint = window.open('', '', 'left=0,top=0,width=800,height=900,toolbar=0,scrollbars=0,status=0');
              WinPrint.document.write(prtContent.innerHTML);
              WinPrint.document.close();
              WinPrint.focus();
              WinPrint.print();
              WinPrint.close();
          }
      </script>
  <?php } ?>
