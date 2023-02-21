<?php

include "../php_functions/db_connect.php";

$photo = $_REQUEST['photoz'];

$thumb = $_REQUEST['photos'];

$cat_name = $_REQUEST['cat_name'];
$cat_code = $_REQUEST['cat_code'];
$desc = $_REQUEST['desc'];

$sql = "SELECT cat_name FROM tbl_category WHERE prdct_name='$cat_name'";

$res = mysqli_query($conn, $sql, $conn) or die(mysqli_error($conn));

$rows = mysqli_num_rows($res);

if ($rows > 0) {
    echo "$names already exists in the system";
} else {
    $filedir = "assets/images/productpics/";
    foreach ($_FILES as $file_name => $file_array) {
        $pic_name = $file_array['name'][0];

        $thumbname = $file_array['name'][1];
        if (is_uploaded_file($file_array['tmp_name'])) {
            move_uploaded_file($file_array['tmp_name'], "$filedir/$file_array[name]") or die("Picture has NOT been uploaded. due to some errors. Please try again Later");
        }
    }
    $sql = "INSERT INTO tbl_category(cat_id,cat_code,cat_name,cat_description,cat_image) VALUES('','$cat_code','$cat_name','$desc','$pic_name')";
    $res = mysqli_query($conn, $sql, $conn) or die(mysqli_error($conn));
    if ($res == 1) {
        echo $res;
    } else {
        echo "0";
    }
}
