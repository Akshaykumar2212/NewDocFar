<?php 
session_start();
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true){
  header("location: index.php");
}
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Registration Page</title>
    <?php include('links.php');?>
  </head>
  <body>
    <?php
        require_once "dbcon.php";
        $username = $email = $mobile =  $password = $confirm_password = "";
        $username_err = $email_err = $mobile_err = $password_err = $confirm_password_err = "";
        // Processing form data when form is submitted
        if($_SERVER["REQUEST_METHOD"] == "POST"){
         
            // Validate username
            if(empty(trim($_POST["username"]))){
                $username_err = "<div class='alert alert-danger alert-dismissible animate__animated animate__rubberBand show' role='alert'><span>Please Enter Name.</span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
            } else{
                // Prepare a select statement
                $sql = "SELECT id FROM login WHERE username = ?";
                
                if($stmt = mysqli_prepare($con, $sql)){
                    // Bind variables to the prepared statement as parameters
                    mysqli_stmt_bind_param($stmt, "s", $param_username);
                    
                    // Set parameters
                    $param_username = trim($_POST["username"]);
                  
                    // Attempt to execute the prepared statement
                    if(mysqli_stmt_execute($stmt)){
                        /* store result */
                        mysqli_stmt_store_result($stmt);
                        
                        if(mysqli_stmt_num_rows($stmt) == 1){
                            $username_err = "<div class='alert alert-warning alert-dismissible animate__animated animate__rubberBand show' role='alert'><span>This Username Is Already Taken.</span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
                        } else{
                            $username = trim($_POST["username"]);
                        }
                    } else{
                        echo "Oops! Something went wrong. Please try again later98766.";
                    }

                    // Close statement
                    mysqli_stmt_close($stmt);
                }
            }

            if(empty(trim($_POST["email"]))){
                $email_err = "<div class='alert alert-danger alert-dismissible animate__animated animate__rubberBand show' role='alert'><span>Please Enter Email.</span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
            } else{
                // Prepare a select statement
                $sql = "SELECT id FROM login WHERE email = ?";
                
                if($stmt = mysqli_prepare($con, $sql)){
                    // Bind variables to the prepared statement as parameters
                    mysqli_stmt_bind_param($stmt, "s", $param_email);
                    
                    // Set parameters
                    $param_email = trim($_POST["email"]);
                    
                    // Attempt to execute the prepared statement
                    if(mysqli_stmt_execute($stmt)){
                        /* store result */
                        mysqli_stmt_store_result($stmt);
                        
                        if(mysqli_stmt_num_rows($stmt) == 1){
                            $email_err = "<div class='alert alert-warning alert-dismissible animate__animated animate__rubberBand show' role='alert'><span>This Email Is Already Taken.</span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
                        } else{
                            $email = trim($_POST["email"]);
                        }
                    } else{
                        echo "Oops! Something went wrong. Please try again later98766.";
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
                $sql = "SELECT id FROM login WHERE mobile = ?";
                
                if($stmt = mysqli_prepare($con, $sql)){
                    // Bind variables to the prepared statement as parameters
                    mysqli_stmt_bind_param($stmt, "s", $param_mobile);
                    
                    // Set parameters
                    $param_mobile = trim($_POST["mobile"]);
                    
                    // Attempt to execute the prepared statement
                    if(mysqli_stmt_execute($stmt)){
                        /* store result */
                        mysqli_stmt_store_result($stmt);
                        
                        if(mysqli_stmt_num_rows($stmt) == 1){
                            $mobile_err = "<div class='alert alert-warning alert-dismissible animate__animated animate__rubberBand show' role='alert'><span>This Mobile Number Is Already Taken.</span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
                        } else{
                            $mobile = trim($_POST["mobile"]);
                        }
                    } else{
                        echo "Oops! Something went wrong. Please try again later98766.";
                    }

                    // Close statement
                    mysqli_stmt_close($stmt);
                }
            }
            
            // Validate password
            if(empty(trim($_POST["password"]))){
                $password_err = "<div class='alert alert-danger alert-dismissible animate__animated animate__rubberBand show' role='alert'><span>Please Enter Password.</span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";     
            } elseif(strlen(trim($_POST["password"])) < 8){
                $password_err = "<div class='alert alert-danger alert-dismissible animate__animated animate__rubberBand show' role='alert'><span>Password Must Have Atleast 8 Characters.</span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
            }elseif(strlen(trim($_POST["password"])) > 15){
                $password_err = "<div class='alert alert-danger alert-dismissible animate__animated animate__rubberBand show' role='alert'><span>Password Too Long.</span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
            }elseif(!preg_match("#[0-9]+#",trim($_POST["password"]))){
                $password_err = "<div class='alert alert-danger alert-dismissible animate__animated animate__rubberBand show' role='alert'><span>Password Must Have Atleast 1 Number.</span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
            }elseif(!preg_match("#[a-z]+#",trim($_POST["password"]))){
                $password_err = "<div class='alert alert-danger alert-dismissible animate__animated animate__rubberBand show' role='alert'><span>Password Must Have Lower Case Characters.</span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
            }elseif(!preg_match("#[A-Z]+#",trim($_POST["password"]))){
                $password_err = "<div class='alert alert-danger alert-dismissible animate__animated animate__rubberBand show' role='alert'><span>Password Must Have Upper Case Characters.</span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
            }elseif(!preg_match("#\W+#",trim($_POST["password"]))){
                $password_err = "<div class='alert alert-danger alert-dismissible animate__animated animate__rubberBand show' role='alert'><span>Password Must Have Special Characters.</span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
            } else{
                $password = trim($_POST["password"]);
            }
            
            // Validate confirm password
            if(empty(trim($_POST["confirm_password"]))){
                $confirm_password_err = "<div class='alert alert-danger alert-dismissible animate__animated animate__rubberBand show' role='alert'><span>Please Enter Confirm Password.</span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";     
            } else{
                $confirm_password = trim($_POST["confirm_password"]);
                if(empty($password_err) && ($password != $confirm_password)){
                    $confirm_password_err = "<div class='alert alert-danger alert-dismissible animate__animated animate__rubberBand show' role='alert'><span>Password Did Not Match.</span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
                }
            }
            
            // Check input errors before inserting in database
            if(empty($username_err) && empty($email_err) && empty($mobile_err) && empty($password_err) && empty($confirm_password_err)){
                
                // Prepare an insert statement
                $sql = "INSERT INTO login (username, email, mobile, password) VALUES (?, ?, ?, ?)";
                 
                if($stmt = mysqli_prepare($con, $sql)){
                    // Bind variables to the prepared statement as parameters
                    mysqli_stmt_bind_param($stmt, "ssss", $param_username, $param_email, $param_mobile, $param_password);
                    
                    // Set parameters
                    $param_username = $username;
                    $param_email = $email;
                    $param_mobile = $mobile;
                    $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
                    
                    // Attempt to execute the prepared statement
                    if(mysqli_stmt_execute($stmt)){
                        // Redirect to login page
                      ?>
                      <script type="text/javascript">
                        setTimeout(function() {
                          swal({
                          title: "",
                          text: "Registration Successfully! Please Login",
                          type: "success"
                          }, function() {
                          window.location = "index.php";
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
    <section id="">
      <div class="row m-0">
          <div class="col-md-7 signup-background">
              <h2 class="text-center text-secondary"><b>DOCTOR REGISTRATION</b></h2>
              <div class="mt-3">
                <img src="images/doctoradd.svg" class="img-fluid d-block mx-auto signup-image">
              </div>
              <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data" class="mt-3">
                <div class="input-group form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                  <div class="input-group-prepend">
                    <span class="input-group-text login-borders br-0" style="padding-right: 14px;"><i class="fa fa-user"></i></span>
                  </div>
                  <input type="text" name="username" id="username" value="<?php echo $username;?>" class="form-control login-border br-0" placeholder="NAME">
                </div>
                <span class="help-block"><?php echo $username_err; ?></span>
                <div class="input-group form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                  <div class="input-group-prepend">
                    <span class="input-group-text login-borders br-0"><i class="fa fa-envelope"></i></span>
                  </div>
                  <input type="email" name="email" id="email" value="<?php echo $email;?>" class="form-control login-border br-0" placeholder="EMAIL">
                </div>
                <span class="help-block"><?php echo $email_err; ?></span>
                <div class="input-group form-group mt-3 <?php echo (!empty($mobile_err)) ? 'has-error' : ''; ?>">
                  <div class="input-group-prepend">
                    <span class="input-group-text login-borders br-0" style="padding-right: 18px;"><i class="fa fa-mobile"></i></span>
                  </div>
                  <input type="number" name="mobile" id="mobile" value="<?php echo $mobile;?>" class="form-control login-border br-0" placeholder="MOBILE NUMBER" data-rule-required="true" aria-required="true" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');">
                </div>
                <span class="help-block"><?php echo $mobile_err; ?></span>
                <div class="input-group form-group mt-3 <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                  <div class="input-group-prepend">
                    <span class="input-group-text login-borders br-0"><i class="fas fa-key"></i></span>
                  </div>
                  <input type="password" name="password" id="password" value="<?php echo $password;?>" class="form-control login-border br-0" placeholder="PASSWORD">
                  <div class="input-group-append">
                    <span class="input-group-text login-borders br-0" id="show_hide_r1" name="show_hide_r1" >
                      <img src="images/eye.svg" id="eyer1" height="24px" width="24px">
                    </span>
                  </div>
                </div>
                <span class="help-block"><?php echo $password_err; ?></span>
                <div class="input-group form-group mt-3 <?php echo (!empty($cpassword_err)) ? 'has-error' : ''; ?>">
                  <div class="input-group-prepend">
                    <span class="input-group-text login-borders br-0"><i class="fas fa-key"></i></span>
                  </div>
                  <input type="password" name="confirm_password" id="confirm_password" value="<?php echo $confirm_password;?>" class="form-control login-border br-0" placeholder="CONFIRM PASSWORD">
                  <div class="input-group-append">
                    <span class="input-group-text login-borders br-0" id="show_hide_r2" name="show_hide_r2" >
                      <img src="images/eye.svg" id="eyer2" height="24px" width="24px">
                    </span>
                  </div>
                </div>
                <span class="help-block"><?php echo $confirm_password_err; ?></span>
                <div class="d-flex justify-content-center mt-5">
                  <input type="submit" name="submit" value="REGISTER" class="btn btn-block btn-warning br-0">
                  <a href="index.php" class="btn btn-block btn-danger ml-4 br-0">CANCEL</a>
                </div>
              </form>
          </div>
          <div class="col-md-5 signup-img">
              <div class="d-flex justify-content-center">
                <img src="images/signupbck.svg" class="img-fluid signup-back">
              </div>
              <div class="text-center signup-reg">
                <a href="index.php" class="btn btn-light signup-login-btn">LOGIN HERE</a>
                <h6 class="text-white">ALREADY USER?</h6>
              </div>
          </div>
      </div>
    </section>
  </body>
</html>