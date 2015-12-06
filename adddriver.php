<?php session_start(); ?>
<?php if(!isset($_SESSION['username'])){
    header("location: login.php");
}
 ?>
<?php
include_once "db.php";

if(isset($_POST['add'])){
    $name = $_POST['name'];
    $nickname = $_POST['nickname'];
    $driverId = $_POST['driverId'];
    $driverIdImage = $_POST['driverIdImage'];
    $licence = $_POST['licence'];
    $licenceImage = $_POST['licenceImage'];
    $licenceExpiryDate = $_POST['licenceExpiryDate'];
    $mail = $_POST['mail'];
    $note = $_POST['note'];

       //upload photos
    $target_dir = "upload/";
    $target_file1 = $target_dir . basename($_FILES["driverIdImage"]["name"]);
    $target_file2 = $target_dir . basename($_FILES["licenceImage"]["name"]);
    move_uploaded_file($_FILES["driverIdImage"]["tmp_name"], $target_file1);
    move_uploaded_file($_FILES["licenceImage"]["tmp_name"], $target_file2);

       //excute query
    mysql_query("SET NAMES 'utf8'");
    $query = mysql_query("INSERT INTO `driver` VALUES  ('','$name','$nickname','$driverId','$target_file1','$licence','$target_file2','$licenceExpiryDate','$mail','$note')") or die("error in query");
        if(isset($query)){
            echo '<meta http-equiv="refresh" content="3; url=adddriver.php" /> ';
            die("<h1 align='center'>تمت الاضافة بنجاح</h1>");
        }else{
            die( "eroooooooooooooor");
        }



}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="rtl" lang="ar"><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta name="author" content="Paweł 'kilab' Balicki - kilab.pl">
<title>SimpleAdmin</title>
<link rel="stylesheet" type="text/css" href="inc/style.css" media="screen">
<link rel="stylesheet" type="text/css" href="inc/navi.css" media="screen">
<script type="text/javascript" src="inc/jquery-1.js"></script>
<script type="text/javascript">
$(function(){
	$(".box .h_title").not(this).next("ul").hide("normal");
	$(".box .h_title").not(this).next("#home").show("normal");
	$(".box").children(".h_title").click( function() { $(this).next("ul").slideToggle(); });
});
</script>
</head>
<body>
<div class="wrap">
	<div id="header">
		<div id="top">
			<div class="right">
				<p>مرحباً, <strong><?php echo $_SESSION['username'];?></strong> [ <a href="logout.php">تسجيل الخروج</a> ]</p>
			</div>
			<div class="left">
				<div class="align-right">
					<p>آخر دخول: <strong><?php echo $_SESSION['date']; ?></strong></p>
				</div>
			</div>
		</div>
		<div id="nav">
			<ul>
				<li class="upp"><a href="#">السيارات</a>
					<ul>
						<li>› <a href="addcar.php">اضافة سيارة</a></li>
						<li>› <a href="showcars.php">عرض جميع السيارات</a></li>
					</ul>
				</li>
				<li class="upp"><a href="#">السائقين</a>
					<ul>
						<li>› <a href="adddriver.php">اضافة سائق</a></li>
						<li>› <a href="showdrivers.php">عرض جميع السائقين</a></li>
					</ul>
				</li>
                <li class="upp"><a href="#">المديرين</a>
				<ul>
					<li ><a  href="addadmin.php">اضافة مدير</a></li>
					<li ><a  href="showadmin.php">عرض جميع المديرين</a></li>
				</ul>
			    </li>
				<li class="upp"><a href="#">الإعدادات</a>
					<ul>
						<li>› <a href="settings.php">اعدادات البرنامج</a></li>
					</ul>
				</li>
			</ul>
		</div>
	</div>

	<div id="content">
        <table style="width: 890px;" align="center" border="0" >
            <tr>
                <td style="width: 190px;" valign="top">
		<div id="sidebar">
			<div class="box">
				<div class="h_title">السيارات</div>
				<ul style="display: block;" id="home">
					<li class="b1"><a class="icon add_page" href="addcar.php">اضافة سيارة</a></li>
					<li class="b2"><a class="icon report" href="showcars.php">عرض جميع السيارات</a></li>
				</ul>
			</div>

			<div class="box">
				<div class="h_title">السائقين</div>
				<ul style="display: none;">
					<li class="b1"><a class="icon add_page" href="adddriver.php">اضافة سائق</a></li>
					<li class="b2"><a class="icon report" href="showdrivers.php">عرض جميع السائقين</a></li>
				</ul>
			</div>
            <div class="box">
				<div class="h_title">المديرين</div>
				<ul style="display: none;">
					<li class="b1"><a class="icon add_page" href="addadmin.php">اضافة مدير</a></li>
					<li class="b2"><a class="icon report" href="showadmin.php">عرض جميع المديرين</a></li>
				</ul>
			</div>
			<div class="box">
				<div class="h_title">الإعدادات</div>
				<ul style="display: none;">
					<li class="b1"><a class="icon config" href="settings.php">اعدادات البرنامج</a></li>
				</ul>
			</div>
		</div>
                </td>

                <td valign="top">
        <div id="main">
            <div class="full_w">
                <div class="h_title">اضافة سائق</div>
                <br />
                <table align="center" border="0">
                <form action="adddriver.php" method="post" enctype="multipart/form-data">
                    <tr>
                        <td>اسم السائق</td>
                        <td><input type="text" name="name" size="30" /></td>
                    </tr>
                    <tr>
                        <td>اسم العائلة</td>
                        <td><input type="text" name="nickname" size="30" /></td>
                    </tr>
                    <tr>
                        <td>رقم تحقيق الشخصية</td>
                        <td><input type="text" name="driverId" size="30" /></td>
                    </tr>
                    <tr>
                        <td>صورة تحقيق الشخصية</td>
                        <td><input type="file" name="driverIdImage" size="30" accept="image/*" /></td>
                    </tr>
                    <tr>
                        <td>رقم رخصة السائق</td>
                        <td><input type="text" name="licence" size="30" /></td>
                    </tr>
                    <tr>
                        <td>صورة رخصة السائق</td>
                        <td><input type="file" name="licenceImage" size="30" accept="image/*" /></td>
                    </tr>
                    <tr>
                        <td>تاريخ انتهاء الرخصة</td>
                        <td><input type="date" name="licenceExpiryDate" size="30" /></td>
                    </tr>
                    <tr>
                        <td>ايميل السائق</td>
                        <td><input type="email" name="mail" size="30"  /></td>
                    </tr>
                    <tr>
                        <td>ملاحظات</td>
                        <td><textarea name="note"  cols="30" rows="10"></textarea></td>
                    </tr>
                    <tr>
                        <td colspan="2" align="center">
                            <input type="submit" name="add" value="اضافة السائق"/>
                        </td>
                    </tr>
                    </form>
                </table>
            </div>
        </div>
                </td>

            </tr>





           </table>
	</div>




	<div id="footer">
		<div class="left">
			<p>تعديل وبرمجة احمد ماهر حليمة <a target="_blank" href="https://www.facebook.com/yousseifweroquia">Facebook</a></p>
		</div>
		<div class="right">
			<p></p>
		</div>
	</div>




</body></html>