<?php 
session_start();
if(empty(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true)){
  header("location: index.php");
}

$month = date('m');
$day = date('d');
$year = date('Y');

$today = $year . '-' . $month . '-' . $day;

?>
<!DOCTYPE html>
<html>
  <head>
    <title>Billing</title>
    <?php include('links.php');?>
  </head>
  <body>
    <section id="billing-bck">
      <?php include('navbar.php');?>
      <div class="d-flex justify-content-center">
        <div class="billing-background mb-5">
          <?php
            // Include config file
            require_once "dbcon.php";
            // Attempt select query execution
            $sessionname = $_SESSION['username'];
            $villagesql = "SELECT * FROM farmerreg WHERE doctor_name = '$sessionname'";
            $villagedisp = mysqli_query($con, $villagesql);

            $farmernmsql = "SELECT * FROM farmerreg WHERE doctor_name = '$sessionname'";
            $farmernmdisp = mysqli_query($con, $farmernmsql);

            $select_village = $select_farmer_name = $treatment = $date =  $select_t1 = $input_t1 = $select_t2 = $input_t2 = $select_t3 = $input_t3 = $ttotal = $paidbill = $currentdues = $totaldues = $currentadvance = $totaladvance = "" ;
            $select_village_err = $select_farmer_name_err = $treatment_err = $date_err =  $select_t1_err = $input_t1_err = $select_t2_err = $input_t2_err = $select_t3_err = $input_t3_err = $ttotal_err = $paidbill_err = $currentdues_err = $totaldues_err = $currentadvance_err = $totaladvance_err = "" ;
             
            // Processing form data when form is submitted
            if($_SERVER["REQUEST_METHOD"] == "POST"){
                // Validate username

                if(empty(trim($_POST["select_village"]))){
                    $select_village_err = "<div class='alert alert-danger alert-dismissible animate__animated animate__rubberBand show' role='alert'><span>Please Select Village.</span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
                } else{
                    // Prepare a select statement
                    $sql = "SELECT id FROM billing WHERE village = ?";
                    
                    if($stmt = mysqli_prepare($con, $sql)){
                        // Bind variables to the prepared statement as parameters
                        mysqli_stmt_bind_param($stmt, "s", $param_treatment);
                        
                        // Set parameters
                        $param_treatment = trim($_POST["select_village"]);

                        // Attempt to execute the prepared statement
                        if(mysqli_stmt_execute($stmt)){
                            /* store result */
                            $select_village = trim($_POST["select_village"]); 
                        } else{
                            echo "Oops! Something went wrong. Please try again later.";
                        }
                        
                        // Close statement
                        mysqli_stmt_close($stmt);
                    }
                }

                if(empty(trim($_POST["select_farmer_name"]))){
                    $select_farmer_name_err = "<div class='alert alert-danger alert-dismissible animate__animated animate__rubberBand show' role='alert'><span>Select Select Farmer Name.</span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
                } else{
                    // Prepare a select statement
                    $sql = "SELECT id FROM billing WHERE farmer_name = ?";
                    
                    if($stmt = mysqli_prepare($con, $sql)){
                        // Bind variables to the prepared statement as parameters
                        mysqli_stmt_bind_param($stmt, "s", $param_select_farmer_name);
                        
                        // Set parameters
                        $param_select_farmer_name = trim($_POST["select_farmer_name"]);

                        // Attempt to execute the prepared statement
                        if(mysqli_stmt_execute($stmt)){
                            /* store result */
                            $select_farmer_name = trim($_POST["select_farmer_name"]); 
                        } else{
                            echo "Oops! Something went wrong. Please try again later.";
                        }
                        
                        // Close statement
                        mysqli_stmt_close($stmt);
                    }
                }

                if(empty(trim($_POST["treatment"]))){
                    $treatment_err = "<div class='alert alert-danger alert-dismissible animate__animated animate__rubberBand show' role='alert'><span>Please Select Treatment Type.</span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
                } else{
                    // Prepare a select statement
                    $sql = "SELECT id FROM billing WHERE treatment_type = ?";
                    
                    if($stmt = mysqli_prepare($con, $sql)){
                        // Bind variables to the prepared statement as parameters
                        mysqli_stmt_bind_param($stmt, "s", $param_treatment);
                        
                        // Set parameters
                        $param_treatment = trim($_POST["treatment"]);

                        // Attempt to execute the prepared statement
                        if(mysqli_stmt_execute($stmt)){
                            /* store result */
                            $treatment = trim($_POST["treatment"]); 
                        } else{
                            echo "Oops! Something went wrong. Please try again later.";
                        }
                        
                        // Close statement
                        mysqli_stmt_close($stmt);
                    }
                }

                if(empty(trim($_POST["date"]))){
                    $date_err = "<div class='alert alert-danger alert-dismissible animate__animated animate__rubberBand show' role='alert'><span>Choose Date.</span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
                } else{
                    // Prepare a select statement
                    $sql = "SELECT id FROM billing WHERE date1 = ?";
                    
                    if($stmt = mysqli_prepare($con, $sql)){
                        // Bind variables to the prepared statement as parameters
                        mysqli_stmt_bind_param($stmt, "s", $param_date);
                        
                        // Set parameters
                        $param_date = trim($_POST["date"]);

                        // Attempt to execute the prepared statement
                        if(mysqli_stmt_execute($stmt)){
                            /* store result */
                            $date = trim($_POST["date"]);
                        } else{
                            echo "Oops! Something went wrong. Please try again later.";
                        }
                        
                        // Close statement
                        mysqli_stmt_close($stmt);
                    }
                }

                if(empty(trim($_POST["select_t1"]))){
                    $select_t1_err = "<div class='alert alert-danger alert-dismissible animate__animated animate__rubberBand show' role='alert'><span>Please Select Treatment 1.</span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
                } else{
                    // Prepare a select statement
                    $sql = "SELECT id FROM billing WHERE select_t1 = ?";
                    
                    if($stmt = mysqli_prepare($con, $sql)){
                        // Bind variables to the prepared statement as parameters
                        mysqli_stmt_bind_param($stmt, "s", $param_select_t1);
                        
                        // Set parameters
                        $param_select_t1 = trim($_POST["select_t1"]);

                        // Attempt to execute the prepared statement
                        if(mysqli_stmt_execute($stmt)){
                            /* store result */
                              $select_t1 = trim($_POST["select_t1"]);
                        } else{
                            echo "Oops! Something went wrong. Please try again later.";
                        }
                        
                        // Close statement
                        mysqli_stmt_close($stmt);
                    }
                }

                if(empty(trim($_POST["input_t1"]))){
                    $input_t1_err = "<div class='alert alert-danger alert-dismissible animate__animated animate__rubberBand show' role='alert'><span>Enter Amount.</span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
                } else{
                    // Prepare a select statement
                    $sql = "SELECT id FROM billing WHERE input_t1 = ?";
                    
                    if($stmt = mysqli_prepare($con, $sql)){
                        // Bind variables to the prepared statement as parameters
                        mysqli_stmt_bind_param($stmt, "s", $param_input_t1);
                        
                        // Set parameters
                        $param_input_t1 = trim($_POST["input_t1"]);

                        // Attempt to execute the prepared statement
                        if(mysqli_stmt_execute($stmt)){
                            /* store result */
                                $input_t1 = trim($_POST["input_t1"]);
                        } else{
                            echo "Oops! Something went wrong. Please try again later.";
                        }
                        
                        // Close statement
                        mysqli_stmt_close($stmt);
                    }
                }

                if(empty(trim($_POST["select_t2"]))){
                    $select_t2_err = "<div class='alert alert-danger alert-dismissible animate__animated animate__rubberBand show' role='alert'><span>Please Select Treatment 2.</span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
                } else{
                    // Prepare a select statement
                    $sql = "SELECT id FROM billing WHERE select_t2 = ?";
                    
                    if($stmt = mysqli_prepare($con, $sql)){
                        // Bind variables to the prepared statement as parameters
                        mysqli_stmt_bind_param($stmt, "s", $param_select_t2);
                        
                        // Set parameters
                        $param_select_t2 = trim($_POST["select_t2"]);

                        // Attempt to execute the prepared statement
                        if(mysqli_stmt_execute($stmt)){
                            /* store result */
                                $select_t2 = trim($_POST["select_t2"]);
                        } else{
                            echo "Oops! Something went wrong. Please try again later.";
                        }
                        
                        // Close statement
                        mysqli_stmt_close($stmt);
                    }
                }

                if(empty(trim($_POST["input_t2"]))){
                    $input_t2_err = "<div class='alert alert-danger alert-dismissible animate__animated animate__rubberBand show' role='alert'><span>Enter Amount.</span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
                } else{
                    // Prepare a select statement
                    $sql = "SELECT id FROM billing WHERE input_t2 = ?";
                    
                    if($stmt = mysqli_prepare($con, $sql)){
                        // Bind variables to the prepared statement as parameters
                        mysqli_stmt_bind_param($stmt, "s", $param_input_t2);
                        
                        // Set parameters
                        $param_input_t2 = trim($_POST["input_t2"]);

                        // Attempt to execute the prepared statement
                        if(mysqli_stmt_execute($stmt)){
                            /* store result */
                                $input_t2 = trim($_POST["input_t2"]);
                        } else{
                            echo "Oops! Something went wrong. Please try again later.";
                        }
                        
                        // Close statement
                        mysqli_stmt_close($stmt);
                    }
                }

                if(empty(trim($_POST["select_t3"]))){
                    $select_t3_err = "<div class='alert alert-danger alert-dismissible animate__animated animate__rubberBand show' role='alert'><span>Please Select Treatment 3.</span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
                } else{
                    // Prepare a select statement
                    $sql = "SELECT id FROM billing WHERE select_t3 = ?";
                    
                    if($stmt = mysqli_prepare($con, $sql)){
                        // Bind variables to the prepared statement as parameters
                        mysqli_stmt_bind_param($stmt, "s", $param_select_t3);
                        
                        // Set parameters
                        $param_select_t3 = trim($_POST["select_t3"]);

                        // Attempt to execute the prepared statement
                        if(mysqli_stmt_execute($stmt)){
                            /* store result */
                                $select_t3 = trim($_POST["select_t3"]);
                        } else{
                            echo "Oops! Something went wrong. Please try again later.";
                        }
                        
                        // Close statement
                        mysqli_stmt_close($stmt);
                    }
                }

                if(empty(trim($_POST["input_t3"]))){
                    $input_t3_err = "<div class='alert alert-danger alert-dismissible animate__animated animate__rubberBand show' role='alert'><span>Enter Amount.</span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
                } else{
                    // Prepare a select statement
                    $sql = "SELECT id FROM billing WHERE input_t3 = ?";
                    
                    if($stmt = mysqli_prepare($con, $sql)){
                        // Bind variables to the prepared statement as parameters
                        mysqli_stmt_bind_param($stmt, "s", $param_input_t3);
                        
                        // Set parameters
                        $param_input_t3 = trim($_POST["input_t3"]);

                        // Attempt to execute the prepared statement
                        if(mysqli_stmt_execute($stmt)){
                            /* store result */
                                $input_t3 = trim($_POST["input_t3"]);
                        } else{
                            echo "Oops! Something went wrong. Please try again later.";
                        }
                        
                        // Close statement
                        mysqli_stmt_close($stmt);
                    }
                }

                if(empty(trim($_POST["ttotal"]))){
                    $ttotal_err = "<div class='alert alert-danger alert-dismissible animate__animated animate__rubberBand show' role='alert'><span>Enter Treatment Total.</span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
                } else{
                    // Prepare a select statement
                    $sql = "SELECT id FROM billing WHERE treatmenttotal = ?";
                    
                    if($stmt = mysqli_prepare($con, $sql)){
                        // Bind variables to the prepared statement as parameters
                        mysqli_stmt_bind_param($stmt, "s", $param_ttotal);
                        
                        // Set parameters
                        $param_ttotal = trim($_POST["ttotal"]);

                        // Attempt to execute the prepared statement
                        if(mysqli_stmt_execute($stmt)){
                            /* store result */
                                $ttotal = trim($_POST["ttotal"]);
                        } else{
                            echo "Oops! Something went wrong. Please try again later.";
                        }
                        
                        // Close statement
                        mysqli_stmt_close($stmt);
                    }
                }

                if(empty(trim($_POST["paidbill"]))){
                    $paidbill_err = "<div class='alert alert-danger alert-dismissible animate__animated animate__rubberBand show' role='alert'><span>Enter Paid Bill.</span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
                } else{
                    // Prepare a select statement
                    $sql = "SELECT id FROM billing WHERE paidbill = ?";
                    
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

                if(empty(trim($_POST["currentdues"]))){
                    $currentdues_err = "<div class='alert alert-danger alert-dismissible animate__animated animate__rubberBand show' role='alert'><span>Enter Current Dues.</span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
                } else{
                    // Prepare a select statement
                    $sql = "SELECT id FROM billing WHERE currentdues = ?";
                    
                    if($stmt = mysqli_prepare($con, $sql)){
                        // Bind variables to the prepared statement as parameters
                        mysqli_stmt_bind_param($stmt, "s", $param_currentdues);
                        
                        // Set parameters
                        $param_currentdues = trim($_POST["currentdues"]);

                        // Attempt to execute the prepared statement
                        if(mysqli_stmt_execute($stmt)){
                            /* store result */
                                $currentdues = trim($_POST["currentdues"]);
                        } else{
                            echo "Oops! Something went wrong. Please try again later.";
                        }
                        
                        // Close statement
                        mysqli_stmt_close($stmt);
                    }
                }

                if(empty(trim($_POST["totaldues"]))){
                    $totaldues_err = "<div class='alert alert-danger alert-dismissible animate__animated animate__rubberBand show' role='alert'><span>Enter Total Dues.</span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
                } else{
                    // Prepare a select statement
                    $sql = "SELECT id FROM billing WHERE totaldues = ?";
                    
                    if($stmt = mysqli_prepare($con, $sql)){
                        // Bind variables to the prepared statement as parameters
                        mysqli_stmt_bind_param($stmt, "s", $param_totaldues);
                        
                        // Set parameters
                        $param_totaldues = trim($_POST["totaldues"]);

                        // Attempt to execute the prepared statement
                        if(mysqli_stmt_execute($stmt)){
                            /* store result */
                                $totaldues = trim($_POST["totaldues"]);
                        } else{
                            echo "Oops! Something went wrong. Please try again later.";
                        }
                        
                        // Close statement
                        mysqli_stmt_close($stmt);
                    }
                }

                if(empty(trim($_POST["currentadvance"]))){
                    $currentadvance_err = "<div class='alert alert-danger alert-dismissible animate__animated animate__rubberBand show' role='alert'><span>Enter Current Advance.</span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
                } else{
                    // Prepare a select statement
                    $sql = "SELECT id FROM billing WHERE currentadvance = ?";
                    
                    if($stmt = mysqli_prepare($con, $sql)){
                        // Bind variables to the prepared statement as parameters
                        mysqli_stmt_bind_param($stmt, "s", $param_currentadvance);
                        
                        // Set parameters
                        $param_currentadvance = trim($_POST["currentadvance"]);

                        // Attempt to execute the prepared statement
                        if(mysqli_stmt_execute($stmt)){
                            /* store result */
                                $currentadvance = trim($_POST["currentadvance"]);
                        } else{
                            echo "Oops! Something went wrong. Please try again later.";
                        }
                        
                        // Close statement
                        mysqli_stmt_close($stmt);
                    }
                }

                if(empty(trim($_POST["totaladvance"]))){
                    $totaladvance_err = "<div class='alert alert-danger alert-dismissible animate__animated animate__rubberBand show' role='alert'><span>Enter Total Advance.</span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
                } else{
                    // Prepare a select statement
                    $sql = "SELECT id FROM billing WHERE totaladvance = ?";
                    
                    if($stmt = mysqli_prepare($con, $sql)){
                        // Bind variables to the prepared statement as parameters
                        mysqli_stmt_bind_param($stmt, "s", $param_totaladvance);
                        
                        // Set parameters
                        $param_totaladvance = trim($_POST["totaladvance"]);

                        // Attempt to execute the prepared statement
                        if(mysqli_stmt_execute($stmt)){
                            /* store result */
                                $totaladvance = trim($_POST["totaladvance"]);
                        } else{
                            echo "Oops! Something went wrong. Please try again later.";
                        }
                        
                        // Close statement
                        mysqli_stmt_close($stmt);
                    }
                }

                // Check input errors before inserting in database
                if(empty($select_village_err) && empty($select_farmer_name_err) && empty($treatment_err) && empty($date_err) && empty($select_t1_err) && empty($input_t1_err) && empty($select_t2_err) && empty($input_t2_err) && empty($select_t3_err) && empty($input_t3_err) && empty($ttotal_err) && empty($paidbill_err) && empty($currentdues_err) && empty($totaldues_err) && empty($currentadvance_err) && empty($totaladvance_err)){
                    
                    // Prepare an insert statement
                    $sql = "INSERT INTO billing (doctor_name, village, farmer_name, treatment_type, date1, select_t1, input_t1, select_t2, input_t2, select_t3, input_t3, treatmenttotal, paidbill, currentdues, totaldues, currentadvance, totaladvance) VALUES ( '$sessionname', ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                     
                    if($stmt = mysqli_prepare($con, $sql)){
                        // Bind variables to the prepared statement as parameters
                        mysqli_stmt_bind_param($stmt, "ssssssssssssssss", $param_select_village , $param_select_farmer_name, $param_treatment, $param_date, $param_select_t1, $param_input_t1, $param_select_t2, $param_input_t2, $param_select_t3, $param_input_t3, $param_ttotal, $param_paidbill, $param_currentdues, $param_totaldues, $param_currentadvance, $param_totaladvance);
                        
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
                        
                            // Attempt to execute the prepared statement
                            if(mysqli_stmt_execute($stmt)){
                                // Redirect to login page
                              ?>
                              <script type="text/javascript">
                                setTimeout(function() {
                                  swal({
                                  title: "",
                                  text: "Bill Paid Successfully!",
                                  type: "success"
                                  }, function() {
                                    window.location = "billinglist.php";
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
          <form action="<?php echo htmlentities(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
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
                <div class="col-md-6">
                    <div class="form-group <?php echo (!empty($treatment_err)) ? 'has-error' : ''; ?>">
                          <label>Treatment Type</label>
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
                <div class="offset-md-1 col-md-5">
                    <div class="form-group <?php echo (!empty($date_err)) ? 'has-error' : ''; ?>">
                        <label>Date</label>
                        <input type="date" name="date" id="date" value="<?php echo $today?>" class="form-control br-0 login-border">
                    </div>
                    <span class="help-block"><?php echo $date_err; ?></span>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group <?php echo (!empty($select_t1_err)) ? 'has-error' : ''; ?>">
                        <label>Treatment 1</label>
                        <select class="form-control br-0 login-border" name="select_t1">
                            <option value="">Select</option>
                            <option value="Cow" <?php if($select_t1 == 'Cow') { ?>selected="true" <?php }; ?>>Cow</option>
                            <option value="Baffelow" <?php if($select_t1 == 'Baffelow') { ?>selected="true" <?php }; ?>>Baffelow</option>
                            <option value="Calf" <?php if($select_t1 == 'Calf') { ?>selected="true" <?php }; ?>>Calf</option>
                        </select>
                    </div>
                    <span class="help-block"><?php echo $select_t1_err; ?></span>
                </div>
                <div class="offset-md-1 col-md-5">
                    <label>Amount</label>
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
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group <?php echo (!empty($select_t2_err)) ? 'has-error' : ''; ?>">
                        <label>Treatment 2</label>
                        <select class="form-control br-0 login-border" name="select_t2">
                            <option value="">Select</option>
                            <option value="Cow" <?php if($select_t2 == 'Cow') { ?>selected="true" <?php }; ?>>Cow</option>
                            <option value="Baffelow" <?php if($select_t2 == 'Baffelow') { ?>selected="true" <?php }; ?>>Baffelow</option>
                            <option value="Calf" <?php if($select_t2 == 'Calf') { ?>selected="true" <?php }; ?>>Calf</option>
                        </select>
                    </div>
                    <span class="help-block"><?php echo $select_t2_err; ?></span>
                </div>
                <div class="offset-md-1 col-md-5">
                    <label>Amount</label>
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
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group <?php echo (!empty($select_t3_err)) ? 'has-error' : ''; ?>">
                        <label>Treatment 3</label>
                        <select class="form-group form-control br-0 login-border" name="select_t3">
                            <option value="">Select</option>
                            <option value="Cow" <?php if($select_t3 == 'Cow') { ?>selected="true" <?php }; ?>>Cow</option>
                            <option value="Baffelow" <?php if($select_t3 == 'Baffelow') { ?>selected="true" <?php }; ?>>Baffelow</option>
                            <option value="Calf" <?php if($select_t3 == 'Calf') { ?>selected="true" <?php }; ?>>Calf</option>
                        </select>
                    </div>
                    <span class="help-block"><?php echo $select_t3_err; ?></span>
                </div>
                <div class="offset-md-1 col-md-5">
                    <label>Amount</label>
                    <div class="input-group form-group <?php echo (!empty($input_t3_err)) ? 'has-error' : ''; ?>">
                        <input type="number" name="input_t3" id="input_t3" onkeyup="sum()" value="<?php echo $input_t3?>" class="form-control br-0 login-border" min="0" data-rule-required="true" aria-required="true" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');">
                        <div class="input-group-append">
                            <span class="input-group-text login-border br-0">
                                <i class="fas fa-rupee-sign"></i>
                            </span>
                        </div>
                    </div>
                    <span class="help-block"><?php echo $input_t3_err; ?></span>
                </div>
            </div>
            <hr class="mb-4">
            <div class="row">
              <div class="offset-md-4 col-md-4">
                <label><b>Treatments Total</b></label>
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
                      <input type="text" name="totaladvance" id="totaladvance" onkeyup="sum3()" value="<?php echo $totaladvance?>" class="form-control br-0 login-border" readonly="">
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
              <input type="submit" name="submit" value="PAID" class="btn btn-block btn-warning br-0 ml-5">
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