<?php 
session_start();
if(empty(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true)){
  header("location: index.php");
}
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Farmer Registration</title>
    <?php include('links.php');?>
  </head>
  <body>
    <?php
        require_once "dbcon.php";
        $farmer_name = $mobile =  $address = $paidbill = $duebill = "" ;
        $farmer_name_err = $mobile_err = $address_err = $paidbillerr = $duebill_err = "";
         
        // Processing form data when form is submitted
        if($_SERVER["REQUEST_METHOD"] == "POST"){
         
            // Validate username
            if(empty(trim($_POST["farmer_name"]))){
                $farmer_name_err = "<div class='alert alert-danger alert-dismissible animate__animated animate__rubberBand show' role='alert'><span>Please Enter Name.</span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
            } else{
                // Prepare a select statement
                $sql = "SELECT id FROM farmerreg WHERE farmer_name = ?";
                
                if($stmt = mysqli_prepare($con, $sql)){
                    // Bind variables to the prepared statement as parameters
                    mysqli_stmt_bind_param($stmt, "s", $param_farmer_name);
                    
                    // Set parameters
                    $param_farmer_name = trim($_POST["farmer_name"]);

                    // Attempt to execute the prepared statement
                    if(mysqli_stmt_execute($stmt)){
                        /* store result */
                        mysqli_stmt_store_result($stmt);

                            $farmer_name = trim($_POST["farmer_name"]);
                    } else{
                        echo "Oops! Something went wrong. Please try again later.";
                    }
                    
                    // Close statement
                    mysqli_stmt_close($stmt);
                }
            }

            if(empty(trim($_POST["mobile"]))){
                $mobile_err = "<div class='alert alert-danger alert-dismissible animate__animated animate__rubberBand show' role='alert'><span>Please Enter Mobile.</span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
            }elseif(strlen(trim($_POST["mobile"])) != 10){
                $mobile_err = "<div class='alert alert-danger alert-dismissible animate__animated animate__rubberBand show' role='alert'><span>Please Enter Mobile 10 Digit.</span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
            } else{
                // Prepare a select statement
                $sql = "SELECT id FROM farmerreg WHERE mobile = ?";
                
                if($stmt = mysqli_prepare($con, $sql)){
                    // Bind variables to the prepared statement as parameters
                    mysqli_stmt_bind_param($stmt, "s", $param_mobile);
                    
                    // Set parameters
                    $param_mobile = trim($_POST["mobile"]);

                    // Attempt to execute the prepared statement
                    if(mysqli_stmt_execute($stmt)){
                        /* store result */
                            $mobile = trim($_POST["mobile"]);
                    } else{
                        echo "Oops! Something went wrong. Please try again later.";
                    }
                    
                    // Close statement
                    mysqli_stmt_close($stmt);
                }
            }

            if(empty(trim($_POST["address"]))){
                $address_err = "<div class='alert alert-danger alert-dismissible animate__animated animate__rubberBand show' role='alert'><span>Please Enter Address.</span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
            } else{
                // Prepare a select statement
                $sql = "SELECT id FROM farmerreg WHERE address = ?";
                
                if($stmt = mysqli_prepare($con, $sql)){
                    // Bind variables to the prepared statement as parameters
                    mysqli_stmt_bind_param($stmt, "s", $param_address);
                    
                    // Set parameters
                    $param_address = trim($_POST["address"]);

                    // Attempt to execute the prepared statement
                    if(mysqli_stmt_execute($stmt)){
                        /* store result */
                            $address = trim($_POST["address"]);
                    } else{
                        echo "Oops! Something went wrong. Please try again later.";
                    }
                    
                    // Close statement
                    mysqli_stmt_close($stmt);
                }
            }

            if(empty(trim($_POST["paidbill"]))){
                $paidbill_err = "<div class='alert alert-danger alert-dismissible animate__animated animate__rubberBand show' role='alert'><span>Please Enter Paid Bill Amount.</span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
            } else{
                // Prepare a select statement
                $sql = "SELECT id FROM farmerreg WHERE paidbill = ?";
                
                if($stmt = mysqli_prepare($con, $sql)){
                    // Bind variables to the prepared statement as parameters
                    mysqli_stmt_bind_param($stmt, "s", $param_paidbill);
                    
                    // Set parameters
                    $param_paidbill = trim($_POST["paidbill"]);

                    // Attempt to execute the prepared statement
                    if(mysqli_stmt_execute($stmt)){
                        /* store result */
                            $paidbill = trim($_POST["paidbill"]);
                    } else{
                        echo "Oops! Something went wrong. Please try again later.";
                    }
                    
                    // Close statement
                    mysqli_stmt_close($stmt);
                }
            }

            if(empty(trim($_POST["duebill"]))){
                $duebill_err = "<div class='alert alert-danger alert-dismissible animate__animated animate__rubberBand show' role='alert'><span>Please Enter Deu Bill Amount.</span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
            } else{
                // Prepare a select statement
                $sql = "SELECT id FROM farmerreg WHERE duebill = ?";
                
                if($stmt = mysqli_prepare($con, $sql)){
                    // Bind variables to the prepared statement as parameters
                    mysqli_stmt_bind_param($stmt, "s", $param_duebill);
                    
                    // Set parameters
                    $param_duebill = trim($_POST["duebill"]);

                    // Attempt to execute the prepared statement
                    if(mysqli_stmt_execute($stmt)){
                        /* store result */
                            $duebill = trim($_POST["duebill"]);
                    } else{
                        echo "Oops! Something went wrong. Please try again later.";
                    }
                    
                    // Close statement
                    mysqli_stmt_close($stmt);
                }
            }
            
            // Check input errors before inserting in database
            if(empty($farmer_name_err) && empty($email_err) && empty($mobile_err) && empty($address_err) && empty($paidbill_err) && empty($duebill_err)){
                
                $session_name = $_SESSION['username'];

                // Prepare an insert statement
                $sql = "INSERT INTO farmerreg (doctor_name, farmer_name, mobile, address, paidbill, duebill) VALUES ('$session_name', ?, ?, ?, ?, ?)";
                 
                if($stmt = mysqli_prepare($con, $sql)){
                    // Bind variables to the prepared statement as parameters
                    mysqli_stmt_bind_param($stmt, "sssss", $param_farmer_name, $param_mobile, $param_address, $param_paidbill, $param_duebill);
                    
                    // Set parameters
                    $param_farmer_name = $farmer_name;
                    $param_mobile = $mobile;
                    $param_address = $address;
                    $param_paidbill = $paidbill;
                    $param_duebill = $duebill;
                    
                    // Attempt to execute the prepared statement
                    if(mysqli_stmt_execute($stmt)){
                        // Redirect to login page
                      ?>
                      <script type="text/javascript">
                        setTimeout(function() {
                          swal({
                          title: "",
                          text: "Farmer Registration Successfully!",
                          type: "success"
                          }, function() {
                          window.location = "farmerlist.php";
                          });
                        });
                      </script>
                      <?php
                    } else{
                        echo "Something went wrong. Please try again later1234.";
                    }
                    // Close statement
                    mysqli_stmt_close($stmt);
                }
            }
            // Close connection
            mysqli_close($con);
        }
    ?>
    <section id="farmerreg-bck">
      <?php include('navbar.php');?>
      <div class="d-flex justify-content-center">
        <div class="fregister-background mb-4">
          <h2 class="text-center text-secondary mt-4"><b>FARMER REGISTRATION</b></h2>
          <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post" class="mt-5">
            <div class="form-group <?php echo (!empty($farmer_name_err)) ? 'has-error' : ''; ?>">
              <input type="text" name="farmer_name" id="farmer_name" value="<?php echo $farmer_name;?>" class="form-control login-border br-0" placeholder="Enter Farmer Name">
            </div>
            <span class="help-block"><?php echo $farmer_name_err; ?></span>
            <div class="form-group <?php echo (!empty($mobile_err)) ? 'has-error' : ''; ?>">
              <input type="number" name="mobile" id="mobile" value="<?php echo $mobile;?>" class="form-control login-border br-0" placeholder="Enter Mobile Number" min="0" data-rule-required="true" aria-required="true" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');">
            </div>
            <span class="help-block"><?php echo $mobile_err; ?></span>
            <div class="form-group <?php echo (!empty($address_err)) ? 'has-error' : ''; ?>">
                <input type="text" value="<?php echo $address;?>" class="form-control login-border br-0" name="address" placeholder="Please Enter Village Name">
            </div>
            <span class="help-block"><?php echo $address_err; ?></span>
            <div class="row">
              <div class="col-sm-3 col-md-3 col-lg-3 pl-0 pt-2"><p>Paid Bill</p></div>
              <div class="col-sm-9 col-md-9 col-lg-9 pr-0">
                <div class="input-group form-group <?php echo (!empty($paidbill_err)) ? 'has-error' : ''; ?>">
                  <input type="number" name="paidbill" value="<?php echo $paidbill;?>" class="form-control login-border br-0" min="0">
                  <div class="input-group-append">
                    <span class="input-group-text login-border br-0">
                      <i class="fas fa-rupee-sign"></i>
                    </span>
                  </div>
                </div>
                <span class="help-block"><?php echo $paidbill_err; ?></span>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-3 col-md-3 col-lg-3 pl-0 pt-2"><p>Due Bill</p></div>
              <div class="col-sm-9 col-md-9 col-lg-9 pr-0">
                <div class="input-group form-group <?php echo (!empty($duebill_err)) ? 'has-error' : ''; ?>">
                  <input type="number" name="duebill" value="<?php echo $duebill;?>" class="form-control login-border br-0" min="0">
                  <div class="input-group-append">
                    <span class="input-group-text login-border br-0">
                      <i class="fas fa-rupee-sign"></i>
                    </span>
                  </div>
                </div>
                <span class="help-block"><?php echo $duebill_err; ?></span>
              </div>
            </div>
            <div class="d-flex justify-content-center mt-5">
              <input type="submit" name="submit" value="REGISTER" class="btn btn-block btn-warning br-0">
              <a href="farmersearch.php" class="btn btn-block btn-danger ml-4 br-0">CANCEL</a>
            </div>
          </form>
        </div>
      </div>
      <div class="footer footer-bg">
        <h6 class="text-center">© Copyright 2021, All Rights Reserved, <a href="" style="color: #ff922b">Compuro Technologies</a></h6>
      </div>
    </section>
  </body>
</html>