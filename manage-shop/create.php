<?php
require "../init.php";
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        $name=$_POST['name'];
        $slug=slug($name);
        $number=$_POST['number'];
        $location=$_POST['location'];
        query("insert into shop (name,slug,number,location) values (?,?,?,?)",["$name","$slug","$number","$location"]);
        setMsg("Shop Create Success");
        go("index.php?slug=".$slug);
    }
    

require "../include/header.php";
?>
<div class="container-fluid pr-5 pl-5">
    <div class="row mt-3">
      <div class="col-12">
        <span class="text-white">
          <h4 class="d-inline text-white">Manage_Shop</h4>
          > Create
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
            <input type="text" class="form-control" name="name">
        </div>
        <div class="form_group">
            <label>Enter Phone Number</label>
            <input type="text" class="form-control" name="number">
        </div>
        <div class="form_group">
            <label>Enter Location</label>
            <input type="text" class="form-control" name="location">
        </div>
        <input type="submit" value="Create" class="btn btn-sm btn-warning mt-2">
      </form>
      </div>
    </div>
</div>

<?php
require "../include/footer.php";
?>