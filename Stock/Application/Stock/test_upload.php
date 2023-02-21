<?php 
$filedir="../assets/images/products";
foreach($_FILES as $file_name=>$file_array)
{
$pic=$file_array['name']; 
echo $pic; 
}
