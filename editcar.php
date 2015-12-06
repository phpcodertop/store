<?php session_start(); ?>
<?php if(!isset($_SESSION['username'])){
    header("location: login.php");
}
 ?>
<?php
//show data
include_once "db.php";
$id = $_GET['id'];
mysql_query("set names 'utf8'");
$query1 = mysql_query("select * from car where id='".$id."'") or die("error in query get");
$row1 = mysql_fetch_assoc($query1);
//edit data
/*
id
model
dateOfMade
carNum
carNumImage
driver
driverImage
monthlyCheckDate
yearlyCheckDate
insuranceExpiryDate
note
*/
if(isset($_POST['add'])){
    $model = $_POST['model'];
    $dateOfMade = $_POST['dateOfMade'];
    $carNum = $_POST['carNum'];
    $carNumImage = $_POST['carNumImage'];
    $driver = $_POST['driver'];
    $driverImage = $_POST['driverImage'];
    $monthlyCheckDate = $_POST['monthlyCheckDate'];
    $yearlyCheckDate = $_POST['yearlyCheckDate'];
    $insuranceExpiryDate = $_POST['insuranceExpiryDate'];
    $note = $_POST['note'];
     //upload photos if changed
    if ($_FILES['carNumImage']['size'] > 0 && $_FILES['driverImage']['size'] > 0){
				$target_dir = "upload/";
                $target_file1 = $target_dir . basename($_FILES["carNumImage"]["name"]);
                $target_file2 = $target_dir . basename($_FILES["driverImage"]["name"]);
                move_uploaded_file($_FILES["carNumImage"]["tmp_name"], $target_file1);
                move_uploaded_file($_FILES["driverImage"]["tmp_name"], $target_file2);
                       //excute query
                mysql_query("SET NAMES 'utf8'");
                $query2 = mysql_query("update car set model='$model' ,dateOfMade = '$dateOfMade', carNum = '$carNum', carNumImage = '$target_file1' , driver = '$driver' , driverImage = '$target_file2'
                , monthlyCheckDate = '$monthlyCheckDate' , yearlyCheckDate = '$yearlyCheckDate' , insuranceExpiryDate = '$insuranceExpiryDate' , note = '$note'
                where id = '$id'
                ") or die("error in query insert with files");
                    if(isset($query2)){
                        echo '<meta http-equiv="refresh" content="3; url=showcars.php" /> ';
                        echo $target_file1 ." ----------  ". $target_file2;
                        die("<h1 align='center'>تمت التعديل بنجاح</h1>");
                    }else{
                        die( "eroooooooooooooor");
                    }

    }

    if(empty($carNumImage) || empty($driverImage)){
            mysql_query("SET NAMES 'utf8'");
            $query = mysql_query("
            update car set model='$model' ,dateOfMade = '$dateOfMade', carNum = '$carNum' , driver = '$driver'
            , monthlyCheckDate = '$monthlyCheckDate' , yearlyCheckDate = '$yearlyCheckDate' , insuranceExpiryDate = '$insuranceExpiryDate' , note = '$note'
            where id = '$id'
            ");
                if(isset($query)){
                    echo '<meta http-equiv="refresh" content="3; url=showcars.php" /> ';
                    die("<h1 align='center'>تم التعديل بنجاح</h1>");
                }else{
                    die( "eroooooooooooooor");
                }

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
						<li>› <a href="showcars.php">عرض جميع السيارات</a></li>s
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
                <div class="h_title">تعديل بيانات السيارة</div>
                <br />
                <table align="center" border="0">
                <form action="editcar.php?id=<?php echo $id; ?>" enctype="multipart/form-data" method="post">
                    <tr>
                        <td>نوع السيارة</td>
                        <td><input type="text" value="<?php echo $row1['model']; ?>" name="model" size="30" /></td>
                    </tr>
                    <tr>
                        <td>سنة صدور السيارة</td>
                        <td><input type="text" value="<?php echo $row1['dateOfMade']; ?>" name="dateOfMade" size="30" /></td>
                    </tr>
                    <tr>
                        <td>رقم السيارة</td>
                        <td><input type="text" value="<?php echo $row1['carNum']; ?>" name="carNum" size="30" /></td>
                    </tr>
                    <tr>
                        <td>صورة لرقم السيارة</td>
                        <td><input type="file"  name="carNumImage" size="30" accept="image/*" /></td>
                    </tr>
                    <tr>
                        <td>سائق السيارة</td>
                        <td><input type="text" value="<?php echo $row1['driver']; ?>" name="driver" size="30" /></td>
                    </tr>
                    <tr>
                        <td>صورة السائق</td>
                        <td><input type="file"  name="driverImage" size="30" accept="image/*" /></td>
                    </tr>
                    <tr>
                        <td>تاريخ الفحص الشهرى</td>
                        <td><input type="date" value="<?php echo $row1['monthlyCheckDate']; ?>" name="monthlyCheckDate" size="30" /></td>
                    </tr>
                    <tr>
                        <td>تاريخ الفحص السنوى</td>
                        <td><input type="date" value="<?php echo $row1['yearlyCheckDate']; ?>" name="yearlyCheckDate" size="30" /></td>
                    </tr>
                    <tr>
                        <td>تاريخ انتهاء التامين</td>
                        <td><input type="date" value="<?php echo $row1['insuranceExpiryDate']; ?>" name="insuranceExpiryDate" size="30" /></td>
                    </tr>
                    <tr>
                        <td>ملاحظات</td>
                        <td><textarea name="note"  cols="30" rows="10"><?php echo $row1['note']; ?></textarea></td>
                    </tr>
                    <tr>
                        <td colspan="2" align="center">
                            <input type="submit" name="add" value="تعديل البيانات"/>
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