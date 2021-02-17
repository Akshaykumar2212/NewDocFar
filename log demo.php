<?php 
session_start();
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true){
  header("location: farmersearch.php");
}
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Login Page</title>
    <?php include('links.php');?>
  </head>
  <body>
    <section id="">
      <div class="row m-0">
        <div class="col-md-5 login-img">
          <div class="d-flex justify-content-center">
            <img src="images/loginbck.svg" class="img-fluid login-back">
          </div>
          <div class="text-center login-reg">
            <p class="text-white">NEW USER?</p>
            <a href="registration.php" class="btn btn-light">REGISTER HERE</a>
          </div>
        </div>
        <div class="col-md-7 login-background">
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
                  $sql = "SELECT id, username , email, password, user_type , images FROM login WHERE email = ?";
                  if($stmt = mysqli_prepare($con, $sql)){
                    mysqli_stmt_bind_param($stmt, "s", $param_doctoremail);
                    $param_doctoremail = $doctoremail;
                      if(mysqli_stmt_execute($stmt)){
                        mysqli_stmt_store_result($stmt);
                          if(mysqli_stmt_num_rows($stmt) == 1){
                            mysqli_stmt_bind_result($stmt, $id, $username, $doctoremail, $hashed_password, $user_type, $file);
                              if(mysqli_stmt_fetch($stmt)){
                                if(password_verify($doctorpasswprd, $hashed_password)){
                                  //session_start();
                                  $_SESSION['loggedin'] = true;
                                  $_SESSION['id'] = $id;
                                  $_SESSION['username'] = $username;
                                  $_SESSION['email'] = $doctoremail;
                                  $_SESSION['password'] = $hashed_password;
                                  $_SESSION['user_type'] = $user_type;
                                  $_SESSION['images'] = $file;
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
          <img src="images/doctor.svg" class="img-fluid d-block mx-auto login-image" height="150px" width="150px">
          <h2 class="text-center text-secondary mt-4"><b>DOCTOR LOGIN</b></h2>
          <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="mt-4">
            <div class="input-group form-group <?php echo (!empty($doctoremail_error)) ? 'has-error' : ''; ?>">
              <div class="input-group-prepend">
                <span class="input-group-text login-borders br-0"><i class="fa fa-envelope"></i></span>
              </div>
              <input type="email" name="email" id="email" value="<?php echo $doctoremail;?>" class="form-control login-border br-0" placeholder="MOBILE / EMAIL">
            </div>
            <span class="help-block"><?php echo $doctoremail_error; ?></span>
            <div class="input-group form-group mt-4 <?php echo (!empty($doctorpassword_error)) ? 'has-error' : ''; ?>">
              <div class="input-group-prepend">
                <span class="input-group-text login-borders br-0"><i class="fas fa-key"></i></span>
              </div>
              <input type="password" name="password" id="password" class="form-control login-border br-0" placeholder="PASSWORD">
              <div class="input-group-append">
                <span class="input-group-text login-borders br-0" id="show_hide" name="show_hide" >
                  <img src="images/eye.svg" id="eye" height="24px" width="24px">
                  <!-- <i class="fas fa-lock" id="eye"  aria-hidden="true"></i> -->
                </span>
              </div>
            </div>
            <span class="help-block"><?php echo $doctorpassword_error; ?></span>
            <div class="d-flex justify-content-center mt-5">
              <input type="submit" name="doctorlogin" id="login" value="LOGIN" class="btn btn-block btn-success br-0">
              <a href="index.php" class="btn btn-block btn-danger ml-4 br-0">CANCEL</a>
            </div>
          </form>
        </div>
      </div>
    </section>
  </body>
</html>