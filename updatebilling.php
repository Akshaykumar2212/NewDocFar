<?php 
session_start();
if(empty(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true)){
  header("location: index.php");
}
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Update Bill</title>
    <?php include('links.php');?>
  </head>
  <body>
    <section id="billing-bck">
    <?php include('navbar.php');?>
      <?php
        require_once "dbcon.php";

        $sessionname = $_SESSION['username'];
        $villagesql = "SELECT address FROM farmerreg WHERE doctor_name = '$sessionname'";
        $villagedisp = mysqli_query($con, $villagesql);

        $farmernmsql = "SELECT * FROM farmerreg WHERE doctor_name = '$sessionname'";
        $farmernmdisp = mysqli_query($con, $farmernmsql);

        $select_village = $select_farmer_name = $treatment = $date =  $select_t1 = $input_t1 = $select_t2 = $input_t2 = $select_t3 = $input_t3 = $ttotal = $paidbill = $currentdues = $totaldues = $currentadvance = $totaladvance = "" ;
        $select_village_err = $select_farmer_name_err = $treatment_err = $date_err =  $select_t1_err = $input_t1_err = $select_t2_err = $input_t2_err = $select_t3_err = $input_t3_err = $ttotal_err = $paidbill_err = $currentdues_err = $totaldues_err = $currentadvance_err = $totaladvance_err = "" ;
        
        // Processing form data when form is submitted
        if(isset($_POST["id"]) && !empty($_POST["id"])){
            $id = $_POST['id'];
            // Validate username
            $input_select_village = trim($_POST["select_village"]);
            if(empty($input_select_village)){
                $select_village_err = "<div class='alert alert-danger alert-dismissible animate__animated animate__rubberBand show' role='alert'><span>Please Enter Village Name.</span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
            }else{
                $select_village = $input_select_village;
            }

            $input_select_farmer_name = trim($_POST["select_farmer_name"]);
            if(empty($input_select_farmer_name)){
                $select_farmer_name_err = "<div class='alert alert-danger alert-dismissible animate__animated animate__rubberBand show' role='alert'><span>Please Enter Farmer Name.</span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";     
            } else{
                $select_farmer_name = $input_select_farmer_name;
            }

            $input_treatment = trim($_POST["treatment"]);
            if(empty($input_treatment)){
                $treatment_err = "<div class='alert alert-danger alert-dismissible animate__animated animate__rubberBand show' role='alert'><span>Please Enter Village.</span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";     
            } else{
                $treatment = $input_treatment;
            }

            $input_date = trim($_POST["date"]);
            if(empty($input_date)){
                $date_err = "<div class='alert alert-danger alert-dismissible animate__animated animate__rubberBand show' role='alert'><span>Please Choose Date.</span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";     
            } else{
                $date = $input_date;
            }

            $input_select_t1 = trim($_POST["select_t1"]);
            if(empty($input_select_t1)){
                $select_t1_err = "<div class='alert alert-danger alert-dismissible animate__animated animate__rubberBand show' role='alert'><span>Please Treatement 1.</span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";     
            } else{
                $select_t1 = $input_select_t1;
            }

            $inputs_t1 = trim($_POST["input_t1"]);
            if(empty($inputs_t1)){
                $input_t1_err = "<div class='alert alert-danger alert-dismissible animate__animated animate__rubberBand show' role='alert'><span>Please Enter Amount.</span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";     
            } else{
                $input_t1 = $inputs_t1;
            }

            $input_select_t2 = trim($_POST["select_t2"]);
            if(empty($input_select_t2)){
                $select_t2_err = "<div class='alert alert-danger alert-dismissible animate__animated animate__rubberBand show' role='alert'><span>Please Select Treatement 2.</span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";     
            } else{
                $select_t2 = $input_select_t2;
            }

            $inputs_t2 = trim($_POST["input_t2"]);
            if(empty($inputs_t2)){
                $input_t2_err = "<div class='alert alert-danger alert-dismissible animate__animated animate__rubberBand show' role='alert'><span>Please Enter Amount.</span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";     
            } else{
                $input_t2 = $inputs_t2;
            }


            $input_select_t3 = trim($_POST["select_t3"]);
            if(empty($input_select_t3)){
                $select_t3_err = "<div class='alert alert-danger alert-dismissible animate__animated animate__rubberBand show' role='alert'><span>Please Select Treatement 3.</span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";     
            } else{
                $select_t3 = $input_select_t3;
            }

            $inputs_t3 = trim($_POST["input_t3"]);
            if(empty($inputs_t3)){
                $input_t3_err = "<div class='alert alert-danger alert-dismissible animate__animated animate__rubberBand show' role='alert'><span>Please Enter Amount.</span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";     
            } else{
                $input_t3 = $inputs_t3;
            }

            $input_ttotal = trim($_POST["ttotal"]);
            if(empty($input_ttotal)){
                $ttotal_err = "<div class='alert alert-danger alert-dismissible animate__animated animate__rubberBand show' role='alert'><span>Please Enter Treatement Total Amount.</span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";     
            } else{
                $ttotal = $input_ttotal;
            }

            $input_paidbill = trim($_POST["paidbill"]);
            if(empty($input_paidbill)){
                $paidbill_err = "<div class='alert alert-danger alert-dismissible animate__animated animate__rubberBand show' role='alert'><span>Please Enter Paid Bill Amount.</span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";     
            } else{
                $paidbill = $input_paidbill;
            }

            $input_currentdues = trim($_POST["currentdues"]);
            if(empty($input_currentdues)){
                $currentdues_err = "<div class='alert alert-danger alert-dismissible animate__animated animate__rubberBand show' role='alert'><span>Please Enter Total Amount.</span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";     
            } else{
                $currentdues = $input_currentdues;
            }

            $input_totaldues = trim($_POST["totaldues"]);
            if(empty($input_totaldues)){
                $totaldues_err = "<div class='alert alert-danger alert-dismissible animate__animated animate__rubberBand show' role='alert'><span>Please Enter Total Dues Amount.</span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";     
            } else{
                $totaldues = $input_totaldues;
            }

            $input_currentadvance = trim($_POST["currentadvance"]);
            if(empty($input_currentadvance)){
                $currentadvance_err = "<div class='alert alert-danger alert-dismissible animate__animated animate__rubberBand show' role='alert'><span>Please Enter Current Advance Amount.</span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";     
            } else{
                $currentadvance = $input_currentadvance;
            }

            $input_totaladvance = trim($_POST["totaladvance"]);
            if(empty($input_totaladvance)){
                $totaladvance_err = "<div class='alert alert-danger alert-dismissible animate__animated animate__rubberBand show' role='alert'><span>Please Enter Total Amount.</span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";     
            } else{
                $totaladvance = $input_totaladvance;
            }
            
            if(empty($select_village_err) && empty($select_farmer_name_err) && empty($treatment_err) && empty($date_err) && empty($select_t1_err) && empty($input_t1_err) && empty($select_t2_err) && empty($input_t2_err) && empty($select_t3_err) && empty($input_t3_err) && empty($ttotal_err) && empty($paidbill_err) && empty($currentdues_err) && empty($totaldues_err) && empty($currentadvance_err) && empty($totaladvance_err)){
            // Prepare an update statement
            $sql = "UPDATE billing SET village = ?, farmer_name = ?, treatment_type = ?, date1 = ?, select_t1 = ?, input_t1 = ?, select_t2 = ?, input_t2 = ?, select_t3 = ?, input_t3 = ?, treatmenttotal = ?, paidbill = ?, currentdues = ?, totaldues = ?, currentadvance = ?, totaladvance = ? WHERE id = ?";
             
            if($stmt = mysqli_prepare($con, $sql)){
                // Bind variables to the prepared statement as parameters
                 mysqli_stmt_bind_param($stmt, "ssssssssssssssssi", $param_select_village, $param_select_farmer_name, $param_treatment, $param_date, $param_select_t1, $param_input_t1, $param_select_t2, $param_input_t2, $param_select_t3, $param_input_t3, $param_ttotal, $param_paidbill, $param_currentdues, $param_totaldues, $param_currentadvance, $param_totaladvance, $param_id);
            
                // Set parameters
                $param_select_village = $select_village;
                $param_select_farmer_name = $select_farmer_name;
                $param_treatment = $treatment;
                $param_date = $date;
                $param_select_t1 = $select_t1;
                $param_input_t1 = $input_t1;
                $param_select_t2 = $select_t2;
                $param_input_t2 = $input_t2;
                $param_select_t3 = $select_t3;
                $param_input_t3 = $input_t3;
                $param_ttotal = $ttotal;
                $param_paidbill = $paidbill;
                $param_currentdues = $currentdues;
                $param_totaldues = $totaldues;
                $param_currentadvance = $currentadvance;
                $param_totaladvance = $totaladvance;
                $param_id = $id;
                
                // Attempt to execute the prepared statement
                if(mysqli_stmt_execute($stmt)){
                    // Records updated successfully. Redirect to landing page
                    ?>
                      <script type="text/javascript">
                        setTimeout(function() {
                          swal({
                          title: "",
                          text: "Billing Data Updated Successfully!",
                          type: "success"
                          }, function() {
                          window.location = "billinglist.php";
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
            $sql = "SELECT * FROM billing WHERE id = ?";
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
                        $select_village = $row["village"];
                        $select_farmer_name = $row["farmer_name"];
                        $treatment = $row["treatment_type"];
                        $date = $row["date1"];
                        $select_t1 = $row["select_t1"];
                        $input_t1 = $row["input_t1"];
                        $select_t2 = $row["select_t2"];
                        $input_t2 = $row["input_t2"];
                        $select_t3 = $row["select_t3"];
                        $input_t3 = $row["input_t3"];
                        $ttotal = $row["treatmenttotal"];
                        $paidbill = $row["paidbill"];
                        $currentdues = $row["currentdues"];
                        $totaldues = $row["totaldues"];
                        $currentadvance = $row["currentadvance"];
                        $totaladvance = $row["totaladvance"];
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
    <div class="d-flex justify-content-center">
        <div class="billing-background mb-5">
          <form action="<?php echo htmlentities($_SERVER['PHP_SELF']);?>" method="post">
            <div class="row mt-3">
                <div class="col-md-5">
                    <div class="form-group <?php echo (!empty($select_village_err)) ? 'has-error' : ''; ?>">
                          <select class="form-control br-0 login-border" name="select_village">
                            <option value="" >Select Village</option>
                            <?php
                                while($vdisp = mysqli_fetch_array($villagedisp)){
                            ?>
                            <option value="<?php echo $vdisp['address'];?>" <?php if($select_village == $vdisp['address']) { ?>selected="true" <?php }; ?>><?php echo $vdisp['address'];?></option>
                            <?php }?>
                          </select>
                        </div>
                    <span class="help-block"><?php echo $select_village_err; ?></span>
                </div>
                <div class="col-md-7">
                    <div class="form-group <?php echo (!empty($select_farmer_name_err)) ? 'has-error' : ''; ?>">
                          <select class="form-control br-0 login-border" name="select_farmer_name">
                            <option value="" >Choose Farmer</option>
                            <?php
                                while($fdisp = mysqli_fetch_array($farmernmdisp)){
                            ?>
                            <option value="<?php echo $fdisp['farmer_name'];?>" <?php if($select_farmer_name == $fdisp['farmer_name']) { ?>selected="true" <?php }; ?>><?php echo $fdisp['farmer_name'];?></option>
                            <?php }?>
                          </select>
                        </div>
                    <span class="help-block"><?php echo $select_farmer_name_err; ?></span>
                </div>
            </div>
            <hr class="mb-4">
            <div class="row">
                <div class="col-md-7">
                    <div class="row">
                      <div class="col-md-4"><h6 class="pt-2">Treatment</h6></div>
                      <div class="col-md-8">
                        <div class="form-group <?php echo (!empty($treatment_err)) ? 'has-error' : ''; ?>">
                          <select class="form-control br-0 login-border" name="treatment">
                            <option value="" >Select Treatments</option>
                            <option value="Pregancy" <?php if($treatment == 'Pregancy') { ?>selected="true" <?php }; ?>>Pregancy</option>
                            <option value="Mustadius" <?php if($treatment == 'Mustadius') { ?>selected="true" <?php }; ?>>Mustadius</option>
                            <option value="Lal" <?php if($treatment == 'Lal') { ?>selected="true" <?php }; ?>>Lal</option>
                            <option value="Other" <?php if($treatment == 'Other') { ?>selected="true" <?php }; ?>>Other</option>
                          </select>
                        </div>
                        <span class="help-block"><?php echo $treatment_err; ?></span>
                      </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="row">
                      <div class="col-md-4"><h6 class="pt-2">Date</h6></div>
                      <div class="col-md-8">
                        <div class="form-group <?php echo (!empty($date_err)) ? 'has-error' : ''; ?>">
                          <input type="date" name="date" value="<?php echo $date?>" class="form-control br-0 login-border">
                        </div>
                        <span class="help-block"><?php echo $date_err; ?></span>
                      </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-7">
                    <div class="row">
                      <div class="col-md-4"><h6 class="pt-2">Treatment 1</h6></div>
                      <div class="col-md-8">
                        <div class="form-group <?php echo (!empty($select_t1_err)) ? 'has-error' : ''; ?>">
                          <select class="form-control br-0 login-border" name="select_t1">
                            <option value="">Select</option>
                            <option value="Cow" <?php if($select_t1 == 'Cow') { ?>selected="true" <?php }; ?>>Cow</option>
                            <option value="Baffelow" <?php if($select_t1 == 'Baffelow') { ?>selected="true" <?php }; ?>>Baffelow</option>
                            <option value="Calf" <?php if($select_t1 == 'Calf') { ?>selected="true" <?php }; ?>>Calf</option>
                          </select>
                        </div>
                        <span class="help-block"><?php echo $select_t1_err; ?></span>
                      </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="row">
                      <div class="col-md-4"><h6 class="pt-2">Amount</h6></div>
                      <div class="col-md-8">
                        <div class="input-group form-group <?php echo (!empty($input_t1_err)) ? 'has-error' : ''; ?>">
                          <input type="number" name="input_t1" id="input_t1" value="<?php echo $input_t1?>" class="form-control br-0 login-border" min="0" data-rule-required="true" aria-required="true" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');">
                          <div class="input-group-append">
                            <span class="input-group-text login-border br-0">
                              <i class="fas fa-rupee-sign"></i>
                            </span>
                          </div>
                        </div>
                        <span class="help-block"><?php echo $input_t1_err; ?></span>
                      </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-7">
                    <div class="row">
                      <div class="col-md-4"><h6 class="pt-2">Treatment 2</h6></div>
                      <div class="col-md-8">
                        <div class="form-group <?php echo (!empty($select_t2_err)) ? 'has-error' : ''; ?>">
                          <select class="form-control br-0 login-border" name="select_t2">
                            <option value="">Select</option>
                            <option value="Cow" <?php if($select_t2 == 'Cow') { ?>selected="true" <?php }; ?>>Cow</option>
                            <option value="Baffelow" <?php if($select_t2 == 'Baffelow') { ?>selected="true" <?php }; ?>>Baffelow</option>
                            <option value="Calf" <?php if($select_t2 == 'Calf') { ?>selected="true" <?php }; ?>>Calf</option>
                          </select>
                        </div>
                        <span class="help-block"><?php echo $select_t2_err; ?></span>
                      </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="row">
                      <div class="col-md-4"><h6 class="pt-2">Amount</h6></div>
                      <div class="col-md-8">
                        <div class="input-group form-group <?php echo (!empty($input_t2_err)) ? 'has-error' : ''; ?>">
                          <input type="number" name="input_t2" id="input_t2" value="<?php echo $input_t2?>" class="form-control br-0 login-border" min="0" data-rule-required="true" aria-required="true" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');">
                          <div class="input-group-append">
                            <span class="input-group-text login-border br-0">
                              <i class="fas fa-rupee-sign"></i>
                            </span>
                          </div>
                        </div>
                        <span class="help-block"><?php echo $input_t2_err; ?></span>
                      </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-7">
                    <div class="row">
                      <div class="col-md-4"><h6 class="pt-2">Treatment 3</h6></div>
                      <div class="col-md-8">
                        <div class="form-group <?php echo (!empty($select_t3_err)) ? 'has-error' : ''; ?>">
                          <select class="form-group form-control br-0 login-border" name="select_t3">
                            <option value="">Select</option>
                            <option value="Cow" <?php if($select_t3 == 'Cow') { ?>selected="true" <?php }; ?>>Cow</option>
                            <option value="Baffelow" <?php if($select_t3 == 'Baffelow') { ?>selected="true" <?php }; ?>>Baffelow</option>
                            <option value="Calf" <?php if($select_t3 == 'Calf') { ?>selected="true" <?php }; ?>>Calf</option>
                          </select>
                        </div>
                        <span class="help-block"><?php echo $select_t3_err; ?></span>
                      </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="row">
                      <div class="col-md-4"><h6 class="pt-2">Amount</h6></div>
                      <div class="col-md-8">
                        <div class="input-group form-group <?php echo (!empty($input_t3_err)) ? 'has-error' : ''; ?>">
                          <input type="number" name="input_t3" value="<?php echo $input_t3?>" class="form-control br-0 login-border" id="input_t3" min="0" onkeyup="sum()" data-rule-required="true" aria-required="true" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');">
                          <div class="input-group-append">
                            <span class="input-group-text login-border br-0">
                              <i class="fas fa-rupee-sign"></i>
                            </span>
                          </div>
                        </div>
                        <span class="help-block"><?php echo $input_t3_err; ?></span>
                      </div>
                    </div>
                </div>
            </div>
            <hr class="mb-4">
            <div class="row">
              <div class="col-md-6"><h6 class="pt-2 text-center"><b>Treatments Total</b></h6></div>
              <div class="col-md-4">
                <div class="form-group <?php echo (!empty($ttotal_err)) ? 'has-error' : ''; ?>">
                  <input type="number" name="ttotal" id="ttotal" value="<?php echo $ttotal?>" class="form-control br-0 login-border" readonly="">
                </div>
                <span class="help-block"><?php echo $ttotal_err; ?></span>
              </div>
            </div>
            <div class="row">
              <div class="offset-md-4 col-md-4">
                <label>Paid Bill</label>
                <div class="form-group <?php echo (!empty($paidbill_err)) ? 'has-error' : ''; ?>">
                  <input type="number" name="paidbill" id="paidbill" onkeyup="sum1()" value="<?php echo $paidbill;?>" class="form-control br-0 login-border" min="0" data-rule-required="true" aria-required="true" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');">
                </div>
                <span class="help-block"><?php echo $paidbill_err; ?></span>
              </div>
            </div>
            <div class="row mt-4">
                <div class="offset-md-2 col-md-4">
                    <label>Current Dues</label>
                    <div class="form-group <?php echo (!empty($currentdues_err)) ? 'has-error' : ''; ?>">
                      <input type="number" name="currentdues" id="currentdues" onkeyup="sum1()" value="<?php echo $currentdues?>" class="form-control br-0 login-border" min="0" data-rule-required="true" aria-required="true" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" readonly="">
                    </div>
                    <span class="help-block"><?php echo $currentdues_err; ?></span>
                </div>
                <div class="col-md-4">
                    <label>Total Dues</label>
                    <div class="form-group <?php echo (!empty($totaldues_err)) ? 'has-error' : ''; ?>">
                      <input type="number" name="totaldues" id="totaldues" onkeyup="sum2()" value="<?php echo $totaldues?>" class="form-control br-0 login-border" min="0" data-rule-required="true" aria-required="true" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" readonly="">
                    </div>
                    <span class="help-block"><?php echo $totaldues_err; ?></span>
                </div>
            </div>
            <div class="row">
                <div class="offset-md-2 col-md-4">
                    <label>Current Advance</label>
                    <div class="form-group <?php echo (!empty($currentadvance_err)) ? 'has-error' : ''; ?>">
                      <input type="number" name="currentadvance" id="currentadvance" onkeyup="sum1()" value="<?php echo $currentadvance?>" class="form-control br-0 login-border" min="0" data-rule-required="true" aria-required="true" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');">
                    </div>
                    <span class="help-block"><?php echo $currentadvance_err; ?></span>
                </div>
                <div class="col-md-4">
                    <label>Total Advance</label>
                    <div class="form-group <?php echo (!empty($totaladvance_err)) ? 'has-error' : ''; ?>">
                      <input type="number" name="totaladvance" id="totaladvance" onkeyup="sum3()" value="<?php echo $totaladvance?>" class="form-control br-0 login-border" min="0" data-rule-required="true" aria-required="true" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" readonly="">
                    </div>
                    <span class="help-block"><?php echo $totaladvance_err; ?></span>
                </div>
            </div>
            <!-- <div class="row">
              <div class="col-md-6"><h6 class="pt-2 text-center">Wants To Pay Due/Advance?</h6></div>
              <div class="col-md-4">
                <div class="form-group <?php echo (!empty($advance_err)) ? 'has-error' : ''; ?>">
                  <input type="number" name="advance" id="advance" onkeyup="sum1()" value="<?php echo $advance?>" class="form-control br-0 login-border" min="0" data-rule-required="true" aria-required="true" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');">
                </div>
                <span class="help-block"><?php echo $advance_err; ?></span>
              </div>
            </div> -->
            <!-- <div class="row">
              <div class="col-md-6"><h6 class="pt-2 text-center"><b>Total</b></h6></div>
              <div class="col-md-4">
                <div class="form-group <?php echo (!empty($total_err)) ? 'has-error' : ''; ?>">
                  <input type="number" name="total" id="total" value="<?php echo $total?>" class="form-control br-0 login-border" readonly="">
                </div>
                <span class="help-block"><?php echo $total_err; ?></span>
              </div>
            </div> -->
            <div class="d-flex justify-content-center mt-5">
              <input type="hidden" name="id" value="<?php echo $id; ?>"/>
              <input type="submit" name="submit" value="UDATE BILL" class="btn btn-block btn-secondary br-0 ml-5">
              <a href="billinglist.php" class="btn btn-block btn-danger ml-5 br-0 mr-5">CANCEL</a>
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