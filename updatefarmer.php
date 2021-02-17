<?php 
session_start();
if(empty(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true)){
  header("location: index.php");
}
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Update Farmer</title>
    <?php include('links.php');?>
  </head>
  <body>
    <?php
        require_once "dbcon.php";
        $farmer_name = $mobile =  $address = $paidbill = $duebill = "" ;
        $farmer_name_err = $mobile_err = $address_err = $paidbill_err = $duebill_err = "";
        
        // Processing form data when form is submitted
        if(isset($_POST["id"]) && !empty($_POST["id"])){
            $id = $_POST['id'];
            // Validate username
            $input_farmer_name = trim($_POST["farmer_name"]);
            if(empty($input_farmer_name)){
                $farmer_name_err = "<div class='alert alert-danger alert-dismissible animate__animated animate__rubberBand show' role='alert'><span>Please Enter Farmer Name.</span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
            }else{
                $farmer_name = $input_farmer_name;
            }

            $input_mobile = trim($_POST["mobile"]);
            if(empty($input_mobile)){
                $mobile_err = "<div class='alert alert-danger alert-dismissible animate__animated animate__rubberBand show' role='alert'><span>Please Enter Mobile Number.</span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";     
            }elseif(strlen(trim($input_mobile)) != 10){
                $mobile_err = "<div class='alert alert-danger alert-dismissible animate__animated animate__rubberBand show' role='alert'><span>Please Enter Mobile 10 Digit.</span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
            } else{
                $mobile = $input_mobile;
            }

            $input_address = trim($_POST["address"]);
            if(empty($input_address)){
                $address_err = "<div class='alert alert-danger alert-dismissible animate__animated animate__rubberBand show' role='alert'><span>Please Enter Village.</span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";     
            } else{
                $address = $input_address;
            }

            $input_paidbill = trim($_POST["paidbill"]);
            if(empty($input_paidbill)){
                $paidbill_err = "<div class='alert alert-danger alert-dismissible animate__animated animate__rubberBand show' role='alert'><span>Please Enter Paid Bill Amount.</span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";     
            } else{
                $paidbill = $input_paidbill;
            }

            $input_duebill = trim($_POST["duebill"]);
            if(empty($input_duebill)){
                $duebill_err = "<div class='alert alert-danger alert-dismissible animate__animated animate__rubberBand show' role='alert'><span>Please Enter Due Bill Amount.</span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";     
            } else{
                $duebill = $input_duebill;
            }
            
            if(empty($farmer_name_err) && empty($email_err) && empty($mobile_err) && empty($address_err) && empty($paidbill_err) && empty($duebill_err)){
            // Prepare an update statement
            $sql = "UPDATE farmerreg SET farmer_name = ?, mobile = ?, address = ?, paidbill = ?, duebill = ? WHERE id = ?";
             
            if($stmt = mysqli_prepare($con, $sql)){
                // Bind variables to the prepared statement as parameters
                 mysqli_stmt_bind_param($stmt, "sssssi", $param_farmer_name, $param_mobile, $param_address, $param_paidbill, $param_duebill, $param_id);
            
                // Set parameters
                $param_farmer_name = $farmer_name;
                $param_mobile = $mobile;
                $param_address = $address;
                $param_paidbill = $paidbill;
                $param_duebill = $duebill;
                $param_id = $id;
                
                // Attempt to execute the prepared statement
                if(mysqli_stmt_execute($stmt)){
                    // Records updated successfully. Redirect to landing page
                    ?>
                      <script type="text/javascript">
                        setTimeout(function() {
                          swal({
                          title: "",
                          text: "Farmer Data Updated Successfully!",
                          type: "success"
                          }, function() {
                          window.location = "farmerlist.php";
                          });
                        });
                      </script>
                      <?php
                } else{
                    echo "Something went wrong. Please try again later.";
                }
            }
             
            // Close statement
            mysqli_stmt_close($stmt);
        }
        
        // Close connection
        mysqli_close($con);
    }else{
        // Check existence of id parameter before processing further
        if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
            // Get URL parameter
            $id =  trim($_GET["id"]);
            
            // Prepare a select statement
            $sql = "SELECT * FROM farmerreg WHERE id = ?";
            if($stmt = mysqli_prepare($con, $sql)){
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "i", $param_id);
                
                // Set parameters
                $param_id = $id;
                
                // Attempt to execute the prepared statement
                if(mysqli_stmt_execute($stmt)){
                    $result = mysqli_stmt_get_result($stmt);
        
                    if(mysqli_num_rows($result) == 1){
                        /* Fetch result row as an associative array. Since the result set contains only one row, we don't need to use while loop */
                        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                        
                        // Retrieve individual field value
                        $farmer_name = $row["farmer_name"];
                        $mobile = $row["mobile"];
                        $address = $row["address"];
                        $paidbill = $row["paidbill"];
                        $duebill = $row["duebill"];
                    } else{
                        // URL doesn't contain valid id. Redirect to error page
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
        }  else{
            // URL doesn't contain id parameter. Redirect to error page
            header("location: error.php");
            exit();
        }
    }
    ?>
    <section id="farmerreg-bck">
      <?php include('navbar.php');?>
      <div class="d-flex justify-content-center">
        <div class="fregister-background mb-4">
          <h2 class="text-center text-secondary mt-4"><b>FARMER UPDATE</b></h2>
          <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post" class="mt-5">
            <div class="form-group <?php echo (!empty($farmer_name_err)) ? 'has-error' : ''; ?>">
              <input type="text" name="farmer_name" id="farmer_name" value="<?php echo $farmer_name;?>" class="form-control login-border br-0" placeholder="Enter Farmer Name">
            </div>
            <span class="help-block"><?php echo $farmer_name_err; ?></span>
            <div class="form-group <?php echo (!empty($mobile_err)) ? 'has-error' : ''; ?>">
              <input type="number" name="mobile" id="mobile" value="<?php echo $mobile;?>" class="form-control login-border br-0" placeholder="Enter Mobile Number" min="0">
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
                <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                <input type="submit" name="submit" value="UPDATE" class="btn btn-block btn-secondary br-0">
                <a href="farmerlist.php" class="btn btn-block btn-danger ml-4 br-0">CANCEL</a>
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