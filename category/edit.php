<?php
require "../init.php";
if(!isset($_SESSION["users"])){
  setError("Please Login First");
  go("login.php");
}
//
if($_SERVER["REQUEST_METHOD"]=="POST"){
    $slug=$_GET["slug"];
    $name=$_REQUEST['name'];
    query("update category set name=?, slug=? where slug=?",[$name,slug($name),$slug]);
    go("index.php");
}
//check category 
if(isset($_GET["slug"])){
    $slug=$_GET["slug"];
    $category=getOne("select * from category where slug=?",[$slug]);
    if(!$category){
        setError("Category Not Found");
        go("index.php");
        die();
    }
    
}else{
    setError("Category Not Found");
    go("index.php");
    die();
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
  <div class="container-fluid pr-5 pl-5 mt-3">
    <div class="card">
      <div class="card-body">
      
        <a href="<?php echo $root;?>category/index.php" class="btn btn-sm btn-success">All</a>
      <?php
      showError();
      
      
      ?>
      <form action="" class="mt-3" method="POST">
        <div class="form-group">
            <label for="">Enter Name</label>
            <input type="text" value="<?php echo $category->name;?>"name="name" class="form-control">
        </div>
        <input type="submit" value="Update" class="btn btn-sm btn-warning">
      </form>
      </div>
    </div>
  </div>
<?php require "../include/footer.php";?>