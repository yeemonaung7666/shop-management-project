<?php
require "../init.php";
if(!isset($_SESSION["users"])){
    setError("Please Login First");
    go("login.php");
  }
$category=getAll("select * from category");
if(isset($_GET['slug']) and !empty($_GET['slug'])){
  $slug=$_GET['slug'];
  $product=getOne("select * from product where slug='$slug'");
  
  if($_SERVER["REQUEST_METHOD"]=="POST"){
    $request=$_REQUEST;
    $name=$request['name'];
    $category_id=$request['category_id'];
    $sale_price=$request['sale_price'];
    $description=$request['description'];
    $image_name=$request['image'];
    if(isset($image_name) and !empty($image_name)){
      $imgedit=query("UPDATE product SET image=? WHERE category_id=?",
      [$image_name,$category_id]);
    }
    else{
      $image_name=$product->image;
      
    }
    $edit=query("UPDATE product SET category_id=?,name=?,image=?,description=?,sale_price=? WHERE category_id=?",
      [$category_id,$name,$image_name,$description,$sale_price,$category_id]);
    if($edit){
      setMsg("Product Update Success!");
      go("index.php");
      die();
    }
    else{
      setMError("Product Update Fail!");
      go("edit.php?slug=".$product->slug);
      die();
    }
  }

}else{
  setError("Wrong Slug");
  go('index.php');
  die();
}

require "../include/header.php";
?>
<!-- Breadcamp -->
<div class="container-fluid pr-5 pl-5">
    <div class="row mt-3">
      <div class="col-12">
        <span class="text-white">
          <h4 class="d-inline text-white">Product</h4>
          > Edit
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
        <div class="col-12">
            <h4 class="text-white">Product Info</h4>
            <div class="form-group">
                <label for="">Choose Category</label>
                <select name="category_id" id="" class="form-control">
                <?php foreach($category as $c){
                  $selected =$c->id==$product->category_id ? 'selected' : "";
                  echo "
                  <option value='{$c->id}' $selected > {$c->name}></option>
                  ";
                }
                  ?>
                </select>
            </div>
            <!--Name-->
            <div class="form-group">
                <label for="">Enter Name</label>
                <input type="text"  value="<?php echo $product->name;?>" name="name" class="form-control">
            </div>
            <!--Image-->
            <div class="form-group">
                <label for="">Choose Image</label>
                <input type="file"  name="image" class="form-control" >
                <p><?php echo $product->image; ?></p>
            </div>
            <!--Description-->
            <div class="form-group">
                <label for="">Description</label>
                <textarea name="description"  class="form-control"><?php echo $product->description; ?>
                </textarea>
            </div>
            <div class="form-group">
                <label for="">Sale Price</label>
                <input type="number" value="<?php echo $product->sale_price; ?>" name="sale_price" class="form-control">
            </div>
        </div>
        <!--Product Inventory-->
        
        <div class="col-12">
            <input type="submit" value="Create" class="btn btn-sm btn-warning">
        </div>
      </form>
        
      </div>
    </div>
  </div>
<?php require "../include/footer.php";?>