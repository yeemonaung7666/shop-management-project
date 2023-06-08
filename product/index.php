<?php
require "../init.php";
if(!isset($_SESSION["users"])){
  setError("Please Login First");
  go("login.php");
}
if(isset($_GET['sale']) and !empty($_GET['sale'])){
  $slug=$_GET['product_slug'];
  $product=getOne("select * from product where slug=?",[$slug]);
  date_default_timezone_set("Asia/Yangon");
  $date=date("Y-m-d");
  $time=date("h:i:s:a");
  $sale_price=$product->sale_price;
  $update_total_quantity=$product->total_quantity-1;

  query("update product set total_quantity=? where slug=?",[$update_total_quantity,$slug]);
  query("insert into product_sale (product_id,sale_price,date,time) values (?,?,?,?)",[$product->id,$sale_price,$date,$time]);
  setMsg("Product Sale Success!");
  go("index.php");
  die();

}

if(isset($_GET["page"])){
  paginateProduct(2);
  die();
  
}
if(isset($_GET['search'])){
  $search=$_GET['search'];
  $product=getAll("select * from product where name like '%$search%' order by id desc limit 2");

}else{
  $search="";
  $product=getAll("select * from product order by id desc limit 2");
}


require "../include/header.php";
?>
<!-- Breadcamp -->
<div class="container-fluid pr-5 pl-5">
    <div class="row mt-3">
      <div class="col-12">
        <span class="text-white">
          <h4 class="d-inline text-white">Product</h4>
          > All
        </span>
      </div>
    </div>
  </div>

  <!-- Content -->
  <div class="container-fluid pr-5 pl-5 mt-3">
    <div class="card">
      <div class="card-body">
      <a href="create.php" class="btn btn-sm btn-warning " >Create</a>
      <form action="" class="mt-2">
        <input type="text"  name="search" value="<?php echo $search;?>" class="btn btn-sm bg-white">
        <button type="submit" class="btn  btn-sm btn-primary">
        <span class="fa fa-search"></span>
        </button>
        <?php
        if(!empty($search)){
          echo '<a href="index.php" class="btn btn-sm btn-danger">Clear Search</a>';
        }
        ?>
        
      </form>
      <?php showError(); showMsg();?>
        <table class="table table-striped text-white mt-2" id="tblData">
          <thead>
            <tr>
              <th>name</th>
              <th>Quantity</th>
              <th>Sale Price</th>
              <th>options</th>
            </tr>
          </thead>
          <tbody>
          <?php foreach($product as $p):?>
            <tr>
              <td>
               <?php echo $p->name;?>
              </td>
              <td>
              <?php echo $p->total_quantity;?>
              </td>
              <td>
              <?php echo $p->sale_price;?>
              </td>
              <td>
              <!-- View-->
                <a href="detail.php?slug=<?php echo $p->slug;?>" class="btn btn-sm btn-success">
                <span class="fa fa-eye"></span>
                </a>
              <!-- edit-->
                <a href="edit.php?slug=<?php echo $p->slug;?>" class="btn btn-sm btn-primary">
                <span class="fa fa-edit"></span>
                </a>
                <!-- trash-->
                <a href="" class="btn btn-sm btn-primary">
                <span class="fa fa-trash"></span>
                </a>
                |
                <a href="<?php echo $root.'product-buy/index.php?product_slug='.$p->slug;?>" class="btn btn-sm btn-outline-danger">Buy</a>
                <a href="index.php?product_slug=<?php echo $p->slug;?>&sale=true" class="btn btn-sm btn-outline-success">Sale</a>
                <a href="sale-list.php?product_slug=<?php echo $p->slug;?>&sale=true" class="btn btn-sm btn-success">Sale-List</a>

              </td>
            </tr>
            <?php endforeach?>
          </tbody>
          
        </table>
        <div class="text-center">
            <button class="btn btn-sm btn-warning" id="btnFetch">
              <span class="fas fa-arrow-down"></span>
            </button>
        </div>
      </div>
    </div>
  </div>
<?php require "../include/footer.php";?>
<script>
  $(function(){
    var page=1;
    var tblData=$("#tblData");
    var btnFetch=$("#btnFetch");
    btnFetch.click(function(){
      page+=1;
      var search ="<?php echo $search;?>";
      var url=`index.php?page=${page}`
      if(search){
        url+=`&search=${search}`;
      }
  
      $.get(url).then(function(data){
        var htmlString="";
        
        const d=JSON.parse(data);
        if(!d.length){
          btnFetch.attr('disabled','disabled')
        }
        d.map(function(d){
          htmlString+=`
          <tr>
              <td>
                ${d.name}
              </td>
              <td>
              ${d.total_quantity}
              </td>
              <td>
              ${d.sale_price}
              </td>
              <td>
              <!-- View-->
                <a href="detail.php?slug=${d.slug}" class="btn btn-sm btn-success">
                <span class="fa fa-eye"></span>
                </a>
              <!-- edit-->
                <a href="edit.php?slug=${d.slug}" class="btn btn-sm btn-primary">
                <span class="fa fa-edit"></span>
                </a>
                <!-- trash-->
                <a href="" class="btn btn-sm btn-primary">
                <span class="fa fa-trash"></span>
                </a>
                |
                <a href="" class="btn btn-sm btn-outline-danger">Buy</a>
                <a href="" class="btn btn-sm btn-outline-success">Sale</a>

              </td>
            </tr>
          `
        })
        tblData.append(htmlString);
      });
      });
     
    });
  
</script>