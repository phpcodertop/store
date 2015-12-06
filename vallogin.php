<?php
ob_start();
session_start();
include_once "db.php";
$username = addslashes(strip_tags($_POST['username']));
$password = md5(addslashes(strip_tags($_POST['password'])));
$time = date('l jS \of F Y h:i:s A');


if($username && $password ){
    $finduser = mysql_query("select * from user where username='".$username."' and password='".$password."' ") or die("mysql error");
    if(mysql_num_rows($finduser) != 0){
        while($row = mysql_fetch_assoc($finduser)){
            $uname = strip_tags($row['username']);
            $upass = strip_tags($row['password']);
        }
        if($username == $uname && $password == $upass){
            $_SESSION['username'] = $uname;
            $_SESSION['password'] = $upass;
            $_SESSION['date'] = $time;
            mysql_query("update user set lastLogin='".$time."' where username='$uname' ") or die("error in date inserting");
            echo "<h1 align='center'>تم تسجيل الدخول بنجاح</h1>";
            echo '<meta http-equiv="refresh" content="3; url=index.php">';
        }
    }else{
        echo '<meta http-equiv="refresh" content="3; url=login.php">';
        die("<h1 align='center'>خطأ فى الرقم السرى او الباسورد</h1>");
    }

}else{
    die("Not Found Page");
}

ob_end_flush();
?>