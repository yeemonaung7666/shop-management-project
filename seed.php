<?php
require "init.php";

query("delete from category");

query("alter table category auto_increment=1");

$cat=["Hat","Shirt","Electronic", "Drink"];
foreach($cat as $c){
    query(
        "insert into category (slug, name) values (?,?)",
        [slug($c),$c]
    );
}
/*
$sql=query("delete from product");

$sql=query("alter table product auto_increment=1");

$product=[
    ["category_id"=>1,"name"=>"some","slug"=>slug("some"),"image"=>"image","description"=>"description","total_quantity"=>"2","sale_price"=>100],
    ["category_id"=>1,"name"=>"some","slug"=>slug("some"),"image"=>"image","description"=>"description","total_quantity"=>"2","sale_price"=>100],
    ["category_id"=>1,"name"=>"some","slug"=>slug("some"),"image"=>"image","description"=>"description","total_quantity"=>"2","sale_price"=>100],
    ["category_id"=>1,"name"=>"some","slug"=>slug("some"),"image"=>"image","description"=>"description","total_quantity"=>"2","sale_price"=>100],
    ["category_id"=>1,"name"=>"some","slug"=>slug("some"),"image"=>"image","description"=>"description","total_quantity"=>"2","sale_price"=>100]
];
foreach($product as $p){
    query(
        "insert into product (category_id,name,slug,image,description,total_quantity,sale_price) values(
            '{$p['category_id']}','{$p['name']}','{$p['slug']}','{$p['image']}','{$p['description']}','{$p['total_quantity']}','{$p['sale_price']}'
        )"
    );
}
echo  "delete product success";

*/
?>