<?php
    session_start();
    if(empty(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true)){
      header("location: index.php");
    }

    if(empty($_GET['id'])){
        header("location:billinglist.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Record</title>
    <?php include('links.php');?>
</head>
<body>
    <?php
        // Process delete operation after confirmation
        if(isset($_POST["id"]) && !empty($_POST["id"])){
            // Include config file
            require_once "dbcon.php";
            
            // Prepare a delete statement
            $sql = "DELETE FROM billing WHERE id = ?";
            
            if($stmt = mysqli_prepare($con, $sql)){
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "i", $param_id);
                
                // Set parameters
                $param_id = trim($_POST["id"]);
                
                // Attempt to execute the prepared statement
                if(mysqli_stmt_execute($stmt)){
                     // Records deleted successfully. Redirect to landing page
                    ?>
                    <script type="text/javascript">
                        setTimeout(function() {
                            swal({
                                title: "",
                                text: "Bill Deleted Successfully!",
                                type: "success"
                                }, function() {
                                    window.location = "billinglist.php";
                                });
                            });
                    </script>
                    <?php
                    exit();
                } else{
                    echo "Oops! Something went wrong. Please try again later.";
                }
            }
             
            // Close statement
            mysqli_stmt_close($stmt);
            
            // Close connection
            mysqli_close($con);
        } else{
            // Check existence of id parameter
            if(empty(trim($_GET["id"]))){
                // URL doesn't contain id parameter. Redirect to error page
                //header("location: error.php");
                exit();
            }
        }
        ?>
    <div class="container" style="margin-top: 200px;">
        <div class="row">
            <div class="offset-md-2 col-md-8">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="alert alert-danger text-center">
                        <input type="hidden" name="id" value="<?php echo trim($_GET["id"]); ?>"/>
                        <h4 class="mt-5">Are you sure you want to delete this record?</h4><br>
                        <p class="mt-3 mb-5">
                            <input type="submit" value="Yes" class="btn btn-lg btn-danger">
                            <a href="billinglist.php" class="btn btn-lg btn-secondary ml-3">No</a>
                        </p>
                    </div>
                </form>
            </div>
        </div>        
    </div>
</body>
</html>