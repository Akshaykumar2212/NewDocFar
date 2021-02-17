<nav class="navbar navbar-expand-lg navbar-dark fixed-top navbar-bg">
  <a class="navbar-brand" href="farmersearch.php"><i class="fa fa-home" style="color: #ff922b;"></i> Home</a>
  <button id="ChangeToggle" class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon">
        <div id="navbar-hamburger">
          <i class="fas fa-bars" style="color:#fff; font-size:28px;"></i>
        </div>
        <div id="navbar-close" class="navbar-hidden">
          <i class="fas fa-times" style="color:#fff; font-size:28px;"></i>
        </div>
      </span>
      </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item active mr-2">
        <a class="nav-link" href="farmerreg.php"> <i class="fas fa-user-plus" style="color: #16c79a;"></i> New Farmer </a>
      </li>
      <!-- <li class="nav-item active mr-2">
        <a class="nav-link" href="farmersearch.php"> <i class="fas fa-user-plus" style="color: #16c79a;"></i> Search </a>
      </li> -->
      <li class="nav-item mr-2">
        <a class="nav-link text-white" href="billing.php"><i class="fas fa-file-invoice-dollar" style="color: #ff922b;"></i> Billing</a>
      </li>
      <li class="nav-item mr-2">
        <a class="nav-link text-white" href="billinglist.php"><i class="fas fa-th-list" style="color: #f9f871;"></i> Billing List</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white" href="farmerlist.php"><i class="fas fa-list-ul" style="color: #ff5e78;"></i> Farmar List</a>
      </li>
      <li class="nav-item nav-item-m">
        <img src="images/log.webp" height="40px" width="40px" style="border-radius: 50%;">
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <?php if(isset($_SESSION['username'])) {echo $_SESSION['username'];}?>
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">Profile</a>
          <a class="dropdown-item" href="logout.php">Log Out</a>
        </div>
      </li>
    </ul>
  </div>
</nav>