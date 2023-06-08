<?php
    require "../init.php";
    $product_slug=$_GET['product_slug'];
    $product=getOne("select id,total_quantity from product where slug=?",[$product_slug]);
    if($_SERVER["REQUEST_METHOD"]=="POST"){
      $buy_price=$_REQUEST['buy_price'];
      $total_quantity=$_REQUEST['total_quantity'];
      $buy_date=$_REQUEST["buy_date"];
      $buy_time=$_REQUEST["buy_time"];

      query("insert into product_buy (product_id,buy_price,total_quantity,buy_date,buy_time) values (?,?,?,?,?)",[
        $product->id,$buy_price,$total_quantity,$buy_date,$buy_time
      ]);
      $total_qty=$product->total_quantity+$total_quantity;
      query("update product set total_quantity=$total_qty where slug='$product_slug'");
      setMsg("Product Buy Added");
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
      <form action="" method="POST">
        <div class="form-group">
          <label>Enter Buy Price</label>
          <input type="number" class="form-control" name="buy_price">
        </div>
        <div class="form-group">
          <label>Enter Total Quantity</label>
          <input type="number" class="form-control" name="total_quantity">
        </div>
        <div class="form-group">
          <label>Enter Buy Date</label>
          <input type="date" value="<?php echo date('D-M-Y');?>" class="form-control" name="buy_date">
        </div>
        <div class="form-group">
          <label>Enter Buy Time</label>
          <input type="time" value="<?php echo date("h:i:s:a");?>" class="form-control" name="buy_time">
        </div>
        
        <input type="submit"  value="Create" class="btn btn-sm btn-warning">
        
      </form>
      </div>
    </div>
  </div>

<?php require "../include/footer.php";?>