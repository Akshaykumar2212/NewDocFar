<?php 
session_start();
if(empty(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true)){
  header("location: index.php");
}
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Print Bill</title>
    <?php include('links.php');?>
  </head>
  <body>
    <section id="farmersearch-bck">
      <?php include('navbar.php');?>
      <?php
          // Check existence of id parameter before processing further
          if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
              // Include config file
              require_once "dbcon.php";
              
              // Prepare a select statement
              $sql = "SELECT * FROM billing WHERE id = ?";
              
              if($stmt = mysqli_prepare($con, $sql)){
                  // Bind variables to the prepared statement as parameters
                  mysqli_stmt_bind_param($stmt, "i", $param_id);
                  
                  // Set parameters
                  $param_id = trim($_GET["id"]);
                  
                  // Attempt to execute the prepared statement
                  if(mysqli_stmt_execute($stmt)){
                      $result = mysqli_stmt_get_result($stmt);
              
                      if(mysqli_num_rows($result) == 1){
                          /* Fetch result row as an associative array. Since the result set contains only one row, we don't need to use while loop */
                          $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                          
                          // Retrieve individual field value
                          $doctor_name = $row["doctor_name"];
                          $village = $row["village"];
                          $farmer_name = $row["farmer_name"];
                          $treatment_type = $row["treatment_type"];
                          $date1 = $row["date1"];
                          $select_t1 = $row["select_t1"];
                          $input_t1 = $row["input_t1"];
                          $select_t2 = $row["select_t2"];
                          $input_t2 = $row["input_t2"];
                          $select_t3 = $row["select_t3"];
                          $input_t3 = $row["input_t3"];
                          $treatmenttotal = $row["treatmenttotal"];
                          $paidbill = $row["paidbill"];
                          $currentdues = $row["currentdues"];
                          $totaldues = $row["totaldues"];
                          $currentadvance = $row["currentadvance"];
                          $totaladvance = $row["totaladvance"];
                      } else{
                          // URL doesn't contain valid id parameter. Redirect to error page
                          header("location: error.php");
                          exit();
                      }
                      
                  } else{
                      echo "Oops! Something went wrong. Please try again later.";
                  }
              }
               
              // Close statement
              mysqli_stmt_close($stmt);
              
              // Close connection
              mysqli_close($con);
          } else{
              // URL doesn't contain id parameter. Redirect to error page
              header("location: error.php");
              exit();
          }
      ?>
      <div class="d-flex justify-content-center">
        <div class="fbill-background mb-5">
          <div class="table-responsive">
            <table id="example" class="text-center table table-bordered" style="font-size: 15px;">
                <thead class="bg-white text-dark" id="selector" style="display: none;">
                    <tr>
                        <th>DETAILS</th>
                        <th>DETAILS</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                      <td>
                        <div class="form-group">
                            <p class="form-control-static">Treatment Date</p>
                        </div>
                      </td>
                      <td>
                        <div class="form-group">
                            <p class="form-control-static"><?php echo $date1;?></p>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="form-group">
                            <p class="form-control-static">Farmer Name</p>
                        </div>
                      </td>
                      <td>
                        <div class="form-group">
                            <p class="form-control-static"><?php echo $farmer_name;?></p>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="form-group">
                            <p class="form-control-static">Village Name</p>
                        </div>
                      </td>
                      <td>
                        <div class="form-group">
                            <p class="form-control-static"><?php echo $village;?></p>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="form-group">
                            <p class="form-control-static">Treatment By Doctor</p>
                        </div>
                      </td>
                      <td>
                        <div class="form-group">
                            <p class="form-control-static"><?php echo $doctor_name;?></p>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="form-group">
                            <p class="form-control-static">Treatment Type</p>
                        </div>
                      </td>
                      <td>
                        <div class="form-group">
                            <p class="form-control-static"><?php echo $treatment_type;?></p>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="form-group">
                            <p class="form-control-static">Type 1</p>
                        </div>
                      </td>
                      <td>
                        <div class="form-group">
                            <p class="form-control-static"><?php echo $select_t1;?>&nbsp; Rs. <?php echo $input_t1;?></p>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="form-group">
                            <p class="form-control-static">Type 2</p>
                        </div>
                      </td>
                      <td>
                        <div class="form-group">
                            <p class="form-control-static"><?php echo $select_t2;?>&nbsp; Rs. <?php echo $input_t2;?></p>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="form-group">
                            <p class="form-control-static">Type 3</p>
                        </div>
                      </td>
                      <td>
                        <div class="form-group">
                            <p class="form-control-static"><?php echo $select_t3;?>&nbsp; Rs. <?php echo $input_t3;?></p>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="form-group">
                            <p class="form-control-static text-primary">Treatment Total</p>
                        </div>
                      </td>
                      <td>
                        <div class="form-group">
                            <p class="form-control-static text-primary">Rs. <?php echo $treatmenttotal;?></p>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="form-group">
                            <p class="form-control-static text-success">Paid Bill</p>
                        </div>
                      </td>
                      <td>
                        <div class="form-group">
                            <p class="form-control-static text-success">Rs. <?php echo $paidbill;?></p>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="form-group">
                            <p class="form-control-static text-danger">Current Dues</p>
                        </div>
                      </td>
                      <td>
                        <div class="form-group">
                            <p class="form-control-static text-danger">Rs. <?php echo $currentdues;?></p>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="form-group">
                            <p class="form-control-static text-danger">Total Dues</p>
                        </div>
                      </td>
                      <td>
                        <div class="form-group">
                            <p class="form-control-static text-danger">Rs. <?php echo $totaldues;?></p>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="form-group">
                            <p class="form-control-static text-danger">Current Advance</p>
                        </div>
                      </td>
                      <td>
                        <div class="form-group">
                            <p class="form-control-static text-danger">Rs. <?php echo $currentadvance;?></p>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="form-group">
                            <p class="form-control-static text-danger">Total Advance</p>
                        </div>
                      </td>
                      <td>
                        <div class="form-group">
                            <p class="form-control-static text-danger">Rs. <?php echo $totaladvance;?></p>
                        </div>
                      </td>
                    </tr>
                </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="footer footer-bg">
        <h6 class="text-center">© Copyright 2021, All Rights Reserved, <a href="" style="color: #ff922b">Compuro Technologies</a></h6>
      </div>
    </section>
  </body>
</html>