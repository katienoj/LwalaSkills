<?php
session_start();
$ModuleId=$_REQUEST['ModuleId'];
$_SESSION("system_session");
$_SESSION['Module']=$ModuleId;
echo "1";
