<?php
function StoreString($string, $user, $userAdd)
{
    //echo "String ".$string."User ".$user." Address ".$userAdd;
    //This function stores a copy os the session created by a user during logon to the system
    global $conn;
    $sql = mysqli_query($conn, "UPDATE UsersTable SET Session_id='$string',UserIP='$userAdd',LoginStatus='1' WHERE UserId='$user'") or die(mysqli_error($conn));
}
