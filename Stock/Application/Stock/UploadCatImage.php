<?php 
$file_dir="CatImages/";

foreach($_FILES as $file_name=>$file_array)
{
if(is_uploaded_file($file_array['tmp_name']))
{
move_uploaded_file($file_array['tmp_name'],"$file_dir/$file_array[name]") or die("file not uploaded");
echo "File is uploaded successfully";
}
}
