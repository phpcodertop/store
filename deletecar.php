<?php
include_once "db.php";
$id = $_GET['id'];
$query = mysql_query("delete from car where id='$id'") or die("Error in query delete");
if(isset($query)){
    echo "<h1 align='center'>تم الحذف بنجاح<h1>";
    echo '<meta http-equiv="refresh" content="3; url=showcars.php">';
}

?>