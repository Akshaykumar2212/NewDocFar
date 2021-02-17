<?php 
session_start();
if(empty(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true)){
  header("location: index.php");
}
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Billing List</title>
    <?php include('links.php');?>
  </head>
  <body>
    <section>
      <?php include('navbar.php');?>
      <div class="billinglist">
        <?php
            // Include config file
            require_once "dbcon.php";
            // Attempt select query execution
            $sessionname = $_SESSION['username'];
            $sql = "SELECT * FROM billing WHERE doctor_name = '$sessionname'";
            if($result = mysqli_query($con, $sql)){
                if(mysqli_num_rows($result) > 0){
                    ?>
                    <div class="table-responsive">
                        <p class="text-danger billinglist-note">Note: (Treatment Word Consider As T Only)</p>
                        <table>
                            
                        </table>
                        <table id="myTable" class="table table-bordered table-hover mb-5 text-center">
                            <thead class="text-white thead-style">
                                <tr>
                                    <th>ID</th>
                                    <th>VILLAGE</th>
                                    <th>NAME</th>
                                    <th>T-TYPE</th>
                                    <th>DATE</th>
                                    <th>T-1</th>
                                    <th>AMT</th>
                                    <th>T-2</th>
                                    <th>AMT</th>
                                    <th>T-3</th>
                                    <th>AMT</th>
                                    <th>T-TOTAL</th>
                                    <th>PAID BILL</th>
                                    <th>CURRENT DUES</th>
                                    <th>TOTAL DUES</th>
                                    <th>CURRENT ADVANCE</th>
                                    <th>TOTAL ADVANCE</th>
                                    <!-- <th>TOTAL</th> -->
                                    <!-- <th>STATUS</th> -->
                                    <th>REPORT</th>
                                    <th>ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            while($row = mysqli_fetch_array($result)){
                            ?>
                                <tr>
                                    <td class="text-center"><?php echo $row['id'];?></td>
                                    <td><?php echo $row['village'];?></td>
                                    <td><?php echo $row['farmer_name'];?></td>
                                    <td><?php echo $row['treatment_type'];?></td>
                                    <td><?php echo $row['date1'];?></td>
                                    <td><?php echo $row['select_t1'];?></td>
                                    <td><?php echo $row['input_t1'];?></td>
                                    <td><?php echo $row['select_t2'];?></td>
                                    <td><?php echo $row['input_t2'];?></td>
                                    <td><?php echo $row['select_t3'];?></td>
                                    <td><?php echo $row['input_t3'];?></td>
                                    <td><?php echo $row['treatmenttotal'];?></td>
                                    <td><?php echo $row['paidbill'];?></td>
                                    <td><?php echo $row['currentdues'];?></td>
                                    <td><?php echo $row['totaldues'];?></td>
                                    <td><?php echo $row['currentadvance'];?></td>
                                    <td>
                                        <?php
                                            if($row['totaladvance'] < 0){
                                                ?>
                                                <p class="text-success"><?php echo(abs($row['totaladvance']));?></p>
                                                <?php
                                            }else{
                                                ?>
                                                <p class="text-danger"><?php echo(abs($row['totaladvance']));?></p>
                                                <?php
                                            } 
                                        ?>    
                                    </td>
                                    <!-- <td><?php echo $row['total'];?></td> -->
                                    <!-- <td>
                                        <?php
                                            if($row['total'] == 1){
                                                ?>
                                                <p class="text-success">Full Paid</p>
                                                <?php
                                            }else{
                                                ?>
                                                <p class="text-danger">Rs. <?php echo $row['total'];?> Pending</p>
                                                <?php
                                            }
                                        ?> 
                                        </td> -->
                                    <td>
                                        <a href="viewrecord.php?id=<?php echo $row['id'];?>" class="btn btn-primary btn-sm">View</a>
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-center">
                                            <a href="updatebilling.php?id=<?php echo $row['id'];?>"><i class="fas fa-pen-square" style="color: #ff6f00;font-size: 30px;"></i></a>
                                            <a href="deletebill.php?id=<?php echo $row['id'];?>" class="ml-3"><i class="fas fa-minus-square" style="color: #ff4646;font-size: 30px;"></i></a>
                                          </div>
                                    </td>
                                </tr>
                                <?php
                                }
                                ?>  
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th></th>
                                    <th><div>VILLAGE</div></th>
                                    <th><div>NAME</div></th>
                                    <th><div>T-TYPE</div></th>
                                    <th><div>DATE</div></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th><b>TOTAL</b></th>
                                    <th style="font-weight: bold;"></th>
                                    <th style="font-weight: bold;"></th>
                                    <th style="font-weight: bold;"></th>
                                    <th style="font-weight: bold;"></th>
                                    <th style="font-weight: bold;"></th>
                                    <th style="font-weight: bold;"></th>
                                    <!-- <th>TOTAL</th> -->
                                    <!-- <th>STATUS</th> -->
                                    <th></th>
                                    <th></th>
                                </tr>
                            </tfoot>
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