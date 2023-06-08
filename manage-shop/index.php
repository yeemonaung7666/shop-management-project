<?php 
    require "../init.php";
    $shop=getAll("select * from shop");
    if(isset($_GET['delete']) and !empty($_GET['delete'])){
      $slug=$_GET['slug'];
      query("delete from shop where slug='$slug'");
      setMsg("Shop Delete Success!");
      go('index.php?slug='.$slug);
    }
    require "../include/header.php";
?>
    <div class="container-fluid pr-5 pl-5">
    <div class="row mt-3">
      <div class="col-12">
        <span class="text-white">
          <h4 class="d-inline text-white">Manage_Shop</h4>
          > Shop
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
      <a href="create.php" class="btn btn-sm btn-warning">create</a>
      <table class="table table-stripped mt-3">
      <tr>
        <td>Shop Name</td>
        <td>Phone Number</td>
        <td>Location</td>
        <td>Option</td>
      </tr>
      <?php foreach($shop as $s):?>
        <tr class="text-white">
        <td><?php echo $s->name;?></td>
        <td><?php echo $s->number;?></td>
        <td><?php echo $s->location;?></td>
        <td><a href="<?php echo $root."manage-shop/index.php?delete=true&slug=".$s->slug;?>" class="btn btn-sm btn-danger" onclick="return confirm('Sure For Delete?')">
          <span class="fa fa-trash"></span>
        </a></td>
      </tr>
      <?php endforeach?>
      
      </table>
      </div>
    </div>
    </div>
<?php
    require "../include/footer.php";
?>