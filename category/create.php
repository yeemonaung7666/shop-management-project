<?php
require "../init.php";
if(!isset($_SESSION["users"])){
  setError("Please Login First");
  go("login.php");
}

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $name=$_REQUEST["name"];
    if(empty($name)){
        setError("Please Enter Name");
    }
    if(!hasError()){
        $res=query("insert into category (slug,name) values (?,?)",[slug($name),$name]);
        if($res){
            setMsg("Category Create Success!");
        }
    }
}
require "../include/header.php";
?>
<!-- Breadcamp -->
<div class="container-fluid pr-5 pl-5">
    <div class="row mt-3">
      <div class="col-12">
        <span class="text-white">
          <h4 class="d-inline text-white">Category</h4>
          > All
        </span>
      </div>
    </div>
  </div>

  <!-- Content -->
  <div class="container-fluid pr-5 pl-5 mt-4">
    <div class="card">
      <div class="card-body">
      <a href="<?php echo $root;?>category/index.php" class="btn btn-sm btn-success">All</a>
      <?php
      showError();
      showMsg();
      ?>
      <form action="" class="mt-3" method="POST">
        <div class="form-group">
            <label for="">Enter Name</label>
            <input type="text" name="name" class="form-control">
        </div>
        <input type="submit"  value="Create" class="btn btn-sm btn-warning">
      </form>
        
      </div>
    </div>
  </div>
<?php require "../include/footer.php";?>