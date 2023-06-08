<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="<?php echo $root;?>assets/css/bootstrap.css" />
  <link rel="stylesheet" href="<?php echo $root;?>assets/css/argon-design-system.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
  <link rel="preconnect" href="https://fonts.gstatic.com" />
  <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="<?php echo $root;?>assets/css/style.css">

  <title>Hello, world!</title>
</head>

<body>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg">
          <!-- Container wrapper -->
    <div class="container-fluid pr-4 pl-4">
      <!-- Toggle button -->
      <button class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#navbarButtonsExample"
        aria-controls="navbarButtonsExample" aria-expanded="false" aria-label="Toggle navigation">
        <i class="fas fa-bars"></i>
      </button>

      <!-- Collapsible wrapper -->
      <div class="collapse navbar-collapse" id="navbarButtonsExample">
        <div class="d-flex">
          <a type="button"href="<?php echo $root;?>" class="btn btn-warning me-3 text-white">
            <span class="fa fa-home"></span>
            <span class="ml-1">Home</span>
          </a>
          <a type="button" href="<?php echo $root;?>manage-shop/index.php" class="btn btn-warning me-3 text-white">
            <span class="fas fa-store-alt"></span>
            <span class="ml-1">Manage Shop</span>
          </a>
          <div class="dropdown">
            <button class="btn btn-warning dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown"
              aria-haspopup="true" aria-expanded="false">
              <i class="fa fa-shopping-bag" aria-hidden="true"></i>
              Manage Shop
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
              <a class="dropdown-item d-flex align-items-center" href="<?php echo $root;?>category/index.php">
                <i class="fas fa-list text-warning"> </i>
                <span class="">Category</span>
              </a>

              <a class="dropdown-item d-flex align-items-center" href="<?php echo $root;?>product/index.php">
                <i class="fa fa-shopping-bag text-warning"> </i>
                <span class="">Product</span>
              </a>
            </div>
          </div>
          <!-- Sale -->
          <a type="button" class="btn btn-warning me-3 text-white">
            <span class="fas fa-balance-scale-left"></span>
            <span class="ml-1">Sale</span>
          </a>
          <!-- Account -->
          <a type="button" href="<?php echo $root;?>manage_acc.php?email=<?php $user=$_SESSION['users'];
                                                            echo $user->email;  ?>" class="btn btn-warning me-3 text-white">
            <span class="fa fa-user"></span>
            <span class="ml-1">Manage Account</span>
          </a>
          <!-- Account -->
          <a type="button" href="<?php echo $root?>logout.php" class="btn btn-dark me-3 text-white">
            <span class="fa fa-user"></span>
            <span class="ml-1">Logout</span>
          </a>
        </div>
      </div>
      <!-- Collapsible wrapper -->
    </div>
    <!-- Container wrapper -->
  </nav>
  <!-- Navbar -->