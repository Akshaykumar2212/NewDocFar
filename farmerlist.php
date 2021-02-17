<?php 
session_start();
if(empty(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true)){
  header("location: index.php");
}
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Farmer List</title>
    <?php include('links.php');?>
  </head>
  <body>
    <section>
      <?php include('navbar.php');?>
      <div class="container farmerlist">
        <?php
            // Include config file
            require_once "dbcon.php";
            
            // Attempt select query execution
            $sessionname = $_SESSION['username'];
            $sql = "SELECT * FROM farmerreg WHERE doctor_name = '$sessionname'";
            if($result = mysqli_query($con, $sql)){
                if(mysqli_num_rows($result) > 0){
                    ?>
                    <div class="table-responsive-md">
                        <table id="myTable" class="table table-bordered table-hover mb-5 text-center">
                            <thead class="text-white thead-style">
                                <tr>
                                    <th>ID</th>
                                    <th>NAME</th>
                                    <th>MOBILE</th>
                                    <th>VILLAGE NAME</th>
                                    <th>PAID BILL</th>
                                    <th>DUE BILL</th>
                                    <th>ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            while($row = mysqli_fetch_array($result)){
                            ?>
                                <tr>
                                    <td class="text-center"><?php echo $row['id'];?></td>
                                    <td><?php echo $row['farmer_name'];?></td>
                                    <td><?php echo $row['mobile'];?></td>
                                    <td><?php echo $row['address'];?></td>
                                    <td class="text-center text-success"><?php echo $row['paidbill'];?></td>
                                    <td class="text-center text-warning"><?php echo $row['duebill'];?></td>
                                    <td>
                                        <?php 
                                            $fn = $row['farmer_name'];
                                            $vill = $row['address'];
                                            $sessionname1 = $_SESSION['username'];
                                            $displayquery1 = "SELECT * FROM billing WHERE doctor_name='$sessionname1' && village = '$vill'";
                                            $querydisplay1 = mysqli_query($con, $displayquery1);
                                            $result1 = mysqli_fetch_assoc($querydisplay1);
                                            if($result1['farmer_name'] == $fn){
                                            ?>
                                            <div class="d-flex justify-content-center">
                                                <a href="updatefarmer.php?id=<?php echo $row['id'];?>"><i class="fas fa-pen-square" style="color: #ff6f00;font-size: 30px;"></i></a>
                                                <a href="deletefarmer.php?id=<?php echo $row['id'];?>" class="ml-3"><i class="fas fa-minus-square" style="color: #ff4646;font-size: 30px;"></i></a>
                                              </div>
                                            <?php
                                            }else{
                                            ?>
                                            <a href="billing.php" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Make Bill</a>
                                      <?php }?>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                            </tbody>                          
                        </table>
                    </div>
                        <?php
                    // Free result set
                    mysqli_free_result($result);
                } else{
                    ?>
                    <div class="d-flex justify-content-center">
                        <h1 class="farmerlisttable"><em>No records were found.</em></h1>
                    </div>
                    <?php
                }
            } else{
                echo "ERROR: Could not able to execute $sql. " . mysqli_error($con);
            }

            // Close connection
            mysqli_close($con);
        ?>
      </div>
      <div class="footer footer-bg">
        <h6 class="text-center">© Copyright 2021, All Rights Reserved, <a href="" style="color: #ff922b">Compuro Technologies</a></h6>
      </div>
    </section>
  </body>
</html>