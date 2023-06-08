<?php
    require "init.php";

    $users=$_SESSION["users"];
    if(isset($_GET['email']) and !empty($_GET['email'])){
      if($_SERVER['REQUEST_METHOD']=="POST"){
        $newName=$_POST['newName'];
        $newSlug= slug($newName);
        $newEmail=$_POST['newEmail'];
        $newPassword=$_POST['newPassword'];
        $confirmPassword=$_POST['confirmPassword'];
        if($newPassword == $confirmPassword){
          $new_Password=password_hash($_POST['newPassword'],PASSWORD_BCRYPT);
          
          query("UPDATE users SET slug=?,name=?,email=?, password=? WHERE email=?",
        ["$newSlug","$newName","$newEmail","$new_Password","$users->email"]
        );
        setMsg("Success!");
        go('index.php');
        
        }
        else{
          setError("Different Password!Please Try Again");
        }
        
      }
        
    }
    
    require "include/header.php";
?>
<!-- Breadcamp -->
<div class="container-fluid pr-5 pl-5">
    <div class="row mt-3">
      <div class="col-12">
        <span class="text-white">
          <h4 class="d-inline text-white">Manage Account</h4>
          > create
        </span>
      </div>
    </div>
  </div>

  <!-- Content -->
  <div class="container-fluid pr-5 pl-5 mt-3">
    <div class="card">
      <div class="card-body">
      <?php
      showMsg();
      showError();
      ?>
      <form action="" method="POST">
      <div class="form-group">
          <label>Enter Name</label>
          <input type="text" value="" name="newName" class="form-control">
        </div>
        <div class="form-group">
          <label>Enter Email</label>
          <input type="text" value="<?php echo $users->email;?>" name="newEmail" class="form-control">
        </div>
        <div class="form-group">
          <label>Enter New Password</label>
          <input type="text" value="" class="form-control" name="newPassword">
        </div>
        <div class="form-group">
          <label>Confirm New Password</label>
          <input type="text" value="" class="form-control" name="confirmPassword">
        </div>
        <input type="submit"  value="Submit" class="btn btn-sm btn-warning">
        
      </form>
</div>
</div>
</div>
<?php 
    require "include/footer.php";
?>