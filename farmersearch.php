<?php 
session_start();
if(empty(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true)){
  header("location: index.php");
}
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Search</title>
    <?php include('links.php');?>
  </head>
  <body>
    <section id="farmersearch-bck">
      <?php include('navbar.php');?>
      <div class="d-flex justify-content-center">
        <div class="fsearch-background mb-5">
          <h3 class="text-center text-secondary mt-1 text-uppercase"><b>WELCOME TO OUR SITE</b></h3>
          <form action="" method="post" class="mt-4">
            <div class="input-group form-group">
              <div class="input-group-prepend">
                <span class="input-group-text login-borders br-0"><i class="fa fa-search" aria-hidden="true"></i></span>
              </div>
              <input type="text" name="farmerdetails" id="farmerdetails" class="form-control form-control-lg login-border br-0" placeholder="Enter Farmer Details" required="">
            </div>
            <div class="d-flex justify-content-center mt-4 pb-4">
              <input type="submit" name="btn" value="SEARCH" class="btn btn-block btn-success br-0">
              <a href="index.php" class="btn btn-block btn-danger ml-4 br-0">CANCEL</a>
            </div>
            <h6 class="text-center mt-2">NEW FARMER?</h6>
            <a href="farmerreg.php" class="text-center btn btn-block btn-info br-0 mt-3">ADD NEW FARMER</a>
          </form>
          <br>
          <hr>
          <br>
          <?php
            // Include config file
            require_once "dbcon.php";
            // Attempt select query execution
             if(isset($_POST["btn"]))

             {
                 $sessionname = $_SESSION['username'];
                 $search = $_POST["farmerdetails"]; 
                 $sql = "SELECT * FROM farmerreg WHERE farmer_name like '$search%' && doctor_name = '$sessionname'"; 
                 $result = mysqli_query($con,$sql);
                 $rowcount = mysqli_num_rows($result);
                 if($rowcount==0){
                     ?>
                    <h5 class="text-center text-danger">Sorry ,No records found!</h5>
                     <?php 
                 }else
                 {
                    ?>
                    <div class="table-responsive-md">
                        <table class="table table-bordered table-hover mb-5 text-center">
                            <thead class="bg-dark text-white">
                                <tr>
                                    <th class="text-center">ID</th>
                                    <th>NAME</th>
                                    <th>MOBILE</th>
                                    <th>VILLAGE</th>
                                    <th>PAID BILL</th>
                                    <th>DUE BILL</th>
                                    <th>ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                              while($row=mysqli_fetch_assoc($result)){
                            ?>    
                                <tr>
                                    <td class="text-center"><?php echo $row['id'];?></td>
                                    <td><?php echo $row['farmer_name'];?></td>
                                    <td><?php echo $row['mobile'];?></td>
                                    <td><?php echo $row['address'];?></td>
                                    <td><?php echo $row['paidbill'];?></td>
                                    <td><?php echo $row['duebill'];?></td>
                                    <td>
                                        <div class="d-flex justify-content-center">
                                            <a href="updatefarmer.php?id=<?php echo $row['id'];?>"><i class="fas fa-pen-square" style="color: #ff6f00;font-size: 30px;"></i></a>
                                            <a href="deletefarmer.php?id=<?php echo $row['id'];?>" class="ml-3"><i class="fas fa-minus-square" style="color: #ff4646;font-size: 30px;"></i></a>
                                          </div>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                            </tbody>                          
                        </table>
                    </div>
                    <?php 
                  }
                }?>
        </div>
      </div>
      <div class="footer footer-bg">
        <h6 class="text-center">© Copyright 2021, All Rights Reserved, <a href="" style="color: #ff922b">Compuro Technologies</a></h6>
      </div>
    </section>
  </body>
</html>