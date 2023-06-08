<?php
require "../init.php";
if(!isset($_SESSION["users"])){
    setError("Please Login First");
    go("login.php");
  }

$category=getAll("select * from category");
if($_SERVER["REQUEST_METHOD"]=="POST"){
    $category_id=$_REQUEST["category_id"];
    $slug=slug($_REQUEST["name"]);
    $name=$_REQUEST["name"];
    $total_quantity=$_REQUEST["total_quantity"];
    $description=$_REQUEST["description"];
    $sale_price=$_REQUEST["sale_price"];
    $buy_price=$_REQUEST["buy_price"];
    $buy_date=$_REQUEST["buy_date"];
    $buy_time=$_REQUEST["buy_time"];

    
    $image_name = $_POST['image'];
   
      
    if(empty($image_name)){
        setError("Please Enter Image");
    }
    query("insert into product (category_id,slug,name,image,description,total_quantity,sale_price) values (?,?,?,?,?,?,?)",
    [$category_id,$slug,$name,$image_name,$description,$total_quantity,$sale_price]);

    $product_id=$conn->lastInsertId();
    //product_buy
    query("insert into product_buy (product_id,buy_price,total_quantity,buy_date,buy_time) values (?,?,?,?,?)",
    [$product_id,$buy_price,$total_quantity,$buy_date,$buy_time]);
    setMsg("Product Created Success...");
    go("index.php");
}
require "../include/header.php";
?>
<!-- Breadcamp -->
<div class="container-fluid pr-5 pl-5">
    <div class="row mt-3">
      <div class="col-12">
        <span class="text-white">
          <h4 class="d-inline text-white">Product</h4>
          > create
        </span>
      </div>
    </div>
  </div>

  <!-- Content -->
  <div class="container-fluid pr-5 pl-5 mt-4">
    <div class="card">
      <div class="card-body">
      <a href="index.php" class="btn btn-sm btn-success">All</a>
      <?php showError();
        showMsg();
        ?>
      <form action="" class="mt-3 row" method="POST" enctype="multipart/from-data">
        <div class="col-6">
            <h4 class="text-white">Product Info</h4>
            <div class="form-group">
                <label for="">Choose Category</label>
                <select name="category_id" id="" class="form-control">
                <?php foreach($category as $c):?>
                    <option value="<?php echo $c->id;?>"><?php echo $c->name?></option>
                <?php endforeach?>
                </select>
            </div>
            <!--Name-->
            <div class="form-group">
                <label for="">Enter Name</label>
                <input type="text"  name="name" class="form-control">
            </div>
            <!--Image-->
            <div class="form-group">
                <label for="">Choose Image</label>
                <input type="file"  name="image" class="form-control" >
            </div>
            <!--Description-->
            <div class="form-group">
                <label for="">Description</label>
                <textarea name="description" class="form-control"></textarea>
            </div>
        </div>
        <!--Product Inventory-->
        <div class="col-6">
            <h4 class="text-white">Inventory</h4>
            <span class="text-primary">
                <span class="fas fa-info-circle text-primary" ></span>
                For Sale Info
            </span>
            <!--Sale-->
            <div class="form-group">
                <label for="">Sale Price</label>
                <input type="number"  name="sale_price" class="form-control">
            </div>
            <span class="text-primary">
                <span class="fas fa-info-circle text-primary" ></span>
                For Buy Info
            </span>
            <!--Total Quantity-->
            <div class="form-group">
                <label for="">Enter Total Quantity</label>
                <input type="number"  name="total_quantity" class="form-control">
            </div>
            <!--Buy Price-->
            <div class="form-group">
                <label for="">Enter Buy Price</label>
                <input type="number"  name="buy_price" class="form-control">
            </div>
            <!--date-->
            <div class="form-group">
                <label for="">Buy Date</label>
                <input type="date"  name="buy_date" class="form-control" <?php echo $date=date("D-M-Y"); ?>>
            </div>
            <!--time-->
            <div class="form-group">
                <label for="">Buy Time</label>
                <input type="time"  name="buy_time" class="form-control" <?php echo $time=date("h:i:s:a"); ?>>
            </div>
        </div>
        <div class="col-12">
            <input type="submit" value="Create" class="btn btn-sm btn-warning">
        </div>
      </form>
        
      </div>
    </div>
  </div>
<?php require "../include/footer.php";?>