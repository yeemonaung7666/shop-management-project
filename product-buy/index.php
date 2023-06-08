<?php
    require "../init.php";
    $product_slug=$_GET['product_slug'];
    $product= getOne("select * from product where slug='$product_slug'");
    $buy=getAll("select * from product_buy where product_id=?",[$product->id]);
    if(isset($_GET['action'])){
      $id=$_GET['id'];
      $product_slug=$_GET['product_slug'];
      $product_buy_data=getOne("select * from product_buy where id=?",[$id]);
      $product_data=getOne("select * from product where slug=?",[$product_slug]);
      $total_quantity=$product_data->total_quantity - $product_buy_data->total_quantity;
      query("delete from product_buy where id=?",[$id]);
      query("update product set total_quantity=? where slug=?",[$total_quantity,$product_slug]);
      setMsg("Product Buy Deleted");
      go("index.php?product_slug=".$product_slug);
      die();
    }

    require "../include/header.php";
?>
<!-- Breadcamp -->
<div class="container-fluid pr-5 pl-5">
    <div class="row mt-3">
      <div class="col-12">
        <span class="text-white">
          <h4 class="d-inline text-white">Product buy</h4>
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
      ?>
      <a href="create.php?product_slug=<?php echo $product_slug;?>" class="btn btn-sm btn-warning ">Create</a>
      <table class="table table-stripped mt-2">
        <tr>
            <td>Buy Price</td>
            <td>Buy Quantity</td>
            <td>Buy Date</td>
            <td>Buy Time</td>
            <td>Option</td>
        </tr>
        <?php foreach($buy as $b):?>
          <tr class="text-white">
            <td><?php echo $b->buy_price;?></td>
            <td><?php echo $b->total_quantity;?></td>
            <td><?php echo $b->buy_date;?></td>
            <td><?php echo $b->buy_time;?></td>
            <td>
              <a href="index.php?action=delete&product_slug=<?php echo $product_slug;?>&id=<?php echo $b->id?>" class="btn btn-sm btn-danger" onclick="Confirm('Sure delete?')">
                <span class="fa fa-trash" ></span>
              </a>
            </td>
          </tr>
        <?php endforeach?>
        
      </table>
      </div>
    </div>
  </div>

<?php require "../include/footer.php";?>