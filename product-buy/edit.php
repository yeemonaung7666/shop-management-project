<?php
    require "../init.php";
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
      <form action="">
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
          <input type="date" value="<?php echo date('Y-M-D');?>" class="form-control" name="buy_date">
        </div>
        <div class="form-group">
          <label>Enter Buy Time</label>
          <input type="time" value="<?php echo date("h:i:s:a");?>" class="form-control" name="buy_time">
        </div>
        <input type="submit" value="Create" class="btn btn-sm btn-warning">
      </form>
      </div>
    </div>
  </div>

<?php require "../include/footer.php";?>