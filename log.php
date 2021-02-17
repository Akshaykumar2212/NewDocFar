<?php session_start();?>
<!DOCTYPE html>
<html>
  <head>
    <title>Login Page</title>
    <?php include('links.php');?>
  </head>
  <body>
    <section id="myDiv">
      <div class="d-flex justify-content-center">
        <div class="login-background mb-5">
          <ul class="nav nav-pills nav-justified" role="tablist" style="border: 1px solid #929aab;">
            <li class="nav-item">
              <a class="nav-link active br-0" data-toggle="pill" href="#doctor">I'M DOCTOR</a>
            </li>
            <li class="nav-item">
              <a class="nav-link br-0" data-toggle="pill" href="#farmer">I'M FARMER</a>
            </li>
          </ul>
          <div class="tab-content">
            <div id="doctor" class="container tab-pane active"><br>
              <?php
                require_once "dbcon.php";
                $doctoremail = $doctorpasswprd = "";
                $doctoremail_error = $doctorpassword_error = "";
                  if(isset($_POST['doctorlogin'])){
                    if(empty(trim($_POST["email"]))){
                      $doctoremail_error = "<div class='alert alert-danger alert-dismissible animate__animated animate__rubberBand show' role='alert'><span>Please Enter Your Email.</span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
                    } else{
                      $doctoremail = trim($_POST["email"]);
                    }
                    if(empty(trim($_POST["password"]))){
                      $doctorpassword_error = "<div class='alert alert-danger alert-dismissible animate__animated animate__rubberBand show' role='alert'><span>Please Enter Your Password.</span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
                    } else{
                      $doctorpasswprd = trim($_POST["password"]);
                    }
                    if(empty($doctoremail_error) && empty($doctorpassword_error)){
                      $sql = "SELECT id, username , email, password, user_type FROM login WHERE email = ? && user_type=('Doctor')";
                      if($stmt = mysqli_prepare($con, $sql)){
                        mysqli_stmt_bind_param($stmt, "s", $param_doctoremail);
                        $param_doctoremail = $doctoremail;
                          if(mysqli_stmt_execute($stmt)){
                            mysqli_stmt_store_result($stmt);
                              if(mysqli_stmt_num_rows($stmt) == 1){
                                mysqli_stmt_bind_result($stmt, $id, $username, $doctoremail, $hashed_password, $user_type);
                                  if(mysqli_stmt_fetch($stmt)){
                                    if(password_verify($doctorpasswprd, $hashed_password)){
                                      //session_start();
                                      $_SESSION["loggedin"] = true;
                                      $_SESSION["id"] = $id;
                                      $_SESSION["username"] = $username;
                                      $_SESSION["email"] = $doctoremail;
                                      $_SESSION["password"] = $hashed_password;
                                      $_SESSION["user_type"] = $user_type;
                                      ?>
                                        <script type="text/javascript">
                                        setTimeout(function() {
                                        swal({
                                        title: "",
                                        text: "Doctor Login Successfully!",
                                        type: "success"
                                        }, function() {
                                        window.location = "farmersearch.php";
                                        });
                                        });
                                        </script>
                                      <?php
                                    } else{
                                      $doctorpassword_error = "<div class='alert alert-danger alert-dismissible animate__animated animate__rubberBand show' role='alert'><span>Your Entered Password Was Not Valid.</span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
                                    }
                                }
                              } else{
                                $doctoremail_error = "<div class='alert alert-danger alert-dismissible animate__animated animate__headShake show' role='alert'><span>No Account Found With That E-Mail ID.</span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
                              }
                          } else{
                          ?>
                            <script type="text/javascript">
                            setTimeout(function() {
                            swal({
                            title: "",
                            text: "Oops ! Something Went Wrong. Please Try Again Later.",
                            type: "error",
                            }, function() {
                            window.location = "welcome.php";
                            });
                            });
                            </script>
                          <?php
                          }
                          mysqli_stmt_close($stmt);
                      }
                  }
                  mysqli_close($con);
                }
              ?>
              <img src="images/doctor.png" class="img-fluid d-block mx-auto login-image" height="150px" width="150px">
              <h2 class="text-center text-secondary mt-4"><b>DOCTOR LOGIN</b></h2>
              <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="mt-4">
                <div class="input-group form-group <?php echo (!empty($doctoremail_error)) ? 'has-error' : ''; ?>">
                  <div class="input-group-prepend">
                    <span class="input-group-text login-borders br-0"><i class="fa fa-envelope"></i></span>
                  </div>
                  <input type="text" name="email" id="email" value="<?php echo $doctoremail;?>" class="form-control login-border br-0" placeholder="MOBILE / EMAIL">
                </div>
                <span class="help-block"><?php echo $doctoremail_error; ?></span>
                <div class="input-group form-group mt-4 <?php echo (!empty($doctorpassword_error)) ? 'has-error' : ''; ?>">
                  <div class="input-group-prepend">
                    <span class="input-group-text login-borders br-0"><i class="fas fa-key"></i></span>
                  </div>
                  <input type="password" name="password" id="password" class="form-control login-border br-0" placeholder="PASSWORD">
                  <div class="input-group-append">
                    <span class="input-group-text login-borders br-0" id="show_hide" name="show_hide" >
                      <i class="fa fa-eye" id="eye"  aria-hidden="true"></i>
                    </span>
                  </div>
                </div>
                <span class="help-block"><?php echo $doctorpassword_error; ?></span>
                <div class="d-flex justify-content-center mt-5">
                  <input type="submit" name="doctorlogin" id="login" value="LOGIN" class="btn btn-block btn-success br-0">
                  <a href="index.php" class="btn btn-block btn-danger ml-4 br-0">CANCEL</a>
                </div>
                <h6 class="text-center mt-5">NEW USER? <a href="registration.php">REGISTER HERE</a></h6>
              </form>
            </div>
            <div id="farmer" class="container tab-pane fade"><br>
              <?php
                require_once "dbcon.php";
                $farmaremail = $farmerpassword = "";
                $farmarlogin_error = $farmerpassword_error = "";
                  if(isset($_POST['farmerlogin'])){
                    if(empty(trim($_POST["email"]))){
                      $farmarlogin_error = "<div class='alert alert-danger alert-dismissible animate__animated animate__rubberBand show' role='alert'><span>Please Enter Your Email.</span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
                    } else{
                      $farmaremail = trim($_POST["email"]);
                    }
                    if(empty(trim($_POST["password"]))){
                      $farmerpassword_error = "<div class='alert alert-danger alert-dismissible animate__animated animate__rubberBand show' role='alert'><span>Please Enter Your Password.</span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
                    } else{
                      $farmerpassword = trim($_POST["password"]);
                    }
                    if(empty($farmarlogin_error) && empty($farmerpassword_error)){
                      $sql = "SELECT id, username, email , password, user_type FROM login WHERE email = ? && user_type=('Farmer')";
                      if($stmt = mysqli_prepare($con, $sql)){
                        mysqli_stmt_bind_param($stmt, "s", $param_farmeremail);
                        $param_farmeremail = $farmaremail;
                          if(mysqli_stmt_execute($stmt)){
                            mysqli_stmt_store_result($stmt);
                              if(mysqli_stmt_num_rows($stmt) == 1){
                                mysqli_stmt_bind_result($stmt, $id, $username, $farmaremail, $hashed_password, $user_type);
                                  if(mysqli_stmt_fetch($stmt)){
                                    if(password_verify($farmerpassword, $hashed_password)){
                                      $_SESSION["loggedin"] = true;
                                      $_SESSION["id"] = $id;
                                      $_SESSION["username"] = $username;
                                      $_SESSION["email"] = $farmaremail;
                                      $_SESSION["password"] = $hashed_password;
                                      $_SESSION["user_type"] = $user_type;
                                      ?>
                                        <script type="text/javascript">
                                        setTimeout(function() {
                                        swal({
                                        title: "",
                                        text: "Farmer Login Successfully!",
                                        type: "success"
                                        }, function() {
                                        window.location = "farmersearch.php";
                                        });
                                        });
                                        </script>
                                      <?php
                                    } else{
                                      $farmerpassword_error = "<div class='alert alert-danger alert-dismissible animate__animated animate__rubberBand show' role='alert'><span>Your Entered Password Was Not Valid.</span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
                                    }
                                }
                              } else{
                                $farmarlogin_error = "<div class='alert alert-danger alert-dismissible animate__animated animate__headShake show' role='alert'><span>No Account Found With That E-Mail ID.</span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
                              }
                          } else{
                          ?>
                            <script type="text/javascript">
                            setTimeout(function() {
                            swal({
                            title: "",
                            text: "Oops ! Something Went Wrong. Please Try Again Later.",
                            type: "error",
                            }, function() {
                            window.location = "welcome.php";
                            });
                            });
                            </script>
                          <?php
                          }
                          mysqli_stmt_close($stmt);
                      }
                  }
                  mysqli_close($con);
                }
              ?>
              <img src="images/famer.png" class="img-fluid d-block mx-auto login-image" height="150px" width="150px">
              <h2 class="text-center text-secondary mt-4"><b>FARMER LOGIN</b></h2>
              <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="mt-4">
                <div class="input-group form-group <?php echo (!empty($farmarlogin_error)) ? 'has-error' : ''; ?>">
                  <div class="input-group-prepend">
                    <span class="input-group-text login-borders br-0"><i class="fa fa-envelope"></i></span>
                  </div>
                  <input type="text" name="email" id="email" value="<?php echo $farmaremail;?>" class="form-control login-border br-0" placeholder="MOBILE / EMAIL">
                </div>
                <span class="help-block"><?php echo $farmarlogin_error; ?></span>
                <div class="input-group form-group mt-4 <?php echo (!empty($farmerpassword_error)) ? 'has-error' : ''; ?>">
                  <div class="input-group-prepend">
                    <span class="input-group-text login-borders br-0"><i class="fas fa-key"></i></span>
                  </div>
                  <input type="password" name="password" id="password" class="form-control login-border br-0" placeholder="PASSWORD">
                  <div class="input-group-append">
                    <span class="input-group-text login-borders br-0" id="show_hide" name="show_hide" >
                      <i class="fa fa-eye" id="eye"  aria-hidden="true"></i>
                    </span>
                  </div>
                </div>
                <span class="help-block"><?php echo $farmerpassword_error; ?></span>
                <div class="d-flex justify-content-center mt-5">
                  <input type="submit" name="farmerlogin" id="farmerlogin" value="LOGIN" class="btn btn-block btn-success br-0">
                  <a href="index.php" class="btn btn-block btn-danger ml-4 br-0">CANCEL</a>
                </div>
                <h6 class="text-center mt-5">NEW USER? <a href="registration.php">REGISTER HERE</a></h6>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
  </body>
</html>