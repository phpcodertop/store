<?php
include_once "db.php";
$name = $_GET['username'];
$query = mysql_query("delete from user where username='$name'") or die("Error in query delete");
if(isset($query)){
    echo "<h1 align='center'>تم الحذف بنجاح<h1>";
    echo '<meta http-equiv="refresh" content="3; url=showadmin.php">';
}

?>