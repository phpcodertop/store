<?php session_start(); ?>
<?php if(!isset($_SESSION['username'])){
    header("location: login.php");
}
 ?>
<?php include_once "db.php"; ?>
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
                <div class="h_title">عرض جميع السيارات</div>
                <br />
                <table style="width: 800px;">

						<tr style="height: 8px; background-color: rgb(0, 0, 0); color: rgb(255, 255, 255)">
							<td scope="col" style="color: rgb(255, 255, 255);" >#</td>
							<td scope="col" style="color: rgb(255, 255, 255);" >نوع السيارة</td>
							<td scope="col" style="color: rgb(255, 255, 255);">سنة صدور السيارة</td>
							<td scope="col" style="color: rgb(255, 255, 255);">رقم السيارة</td>
							<td scope="col" style="color: rgb(255, 255, 255);">صورة لرقم السيارة</td>
							<td scope="col" style="color: rgb(255, 255, 255);">سائق السيارة</td>
							<td scope="col" style="color: rgb(255, 255, 255);">صورة السائق</td>
							<td scope="col" style="color: rgb(255, 255, 255);">تاريخ الفحص الشهرى</td>
							<td scope="col" style="color: rgb(255, 255, 255);">تاريخ الفحص السنوى</td>
							<td scope="col" style="color: rgb(255, 255, 255);">تاريخ انتهاء التامين</td>
							<td scope="col" style="color: rgb(255, 255, 255);">ملاحظات</td>
							<td scope="col" style="width: 65px; color: rgb(255, 255, 255);" >تحرير</td>
						</tr>


					<tbody>
						<?php
                        /*<tr>
							<td class="align-center">2</td>
							<td>الرئيسية</td>
							<td>Paweł B.</td>
							<td>22-03-2012</td>
							<td>-</td>
							<td>-</td>
							<td>-</td>
							<td>-</td>
							<td>-</td>
							<td>-</td>
							<td>-</td>
							<td>
								<a href="#" class="table-icon edit" title="تحرير"></a>
								<a href="#" class="table-icon delete" title="حذف"></a>
							</td>
						</tr>

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
                        $num_rec_per_page=6;
                        if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };
                        $start_from = ($page-1) * $num_rec_per_page;
                        $sql = "SELECT * FROM car LIMIT $start_from, $num_rec_per_page";
                        $rs_result = mysql_query ($sql); //run the query

                        while ($row = mysql_fetch_assoc($rs_result)) {
                        ?>
                                    <tr>
                                    <td><?php echo $row['id']; ?></td>
                                    <td><?php echo $row['model']; ?></td>
                                    <td><?php echo $row['dateOfMade']; ?></td>
                                    <td><?php echo $row['carNum']; ?></td>
                                    <td><a target="_blank" href="showimage.php?src=<?php echo $row['carNumImage']; ?>" rel="<?php echo $row['carNumImage']; ?>"><img src="inc/1-Pictures-icon.png"/></a></td>
                                    <td><?php echo $row['driver']; ?></td>
                                    <td><a target="_blank" href="showimage.php?src=<?php echo $row['driverImage']; ?>" rel="<?php echo $row['driverImage']; ?>"><img src="inc/1-Pictures-icon.png"/></a></td>
                                    <td><?php echo $row['monthlyCheckDate']; ?></td>
                                    <td><?php echo $row['yearlyCheckDate']; ?></td>
                                    <td><?php echo $row['insuranceExpiryDate']; ?></td>
                                    <td><?php echo $row['note']; ?></td>
                                    <td>
                                        <a href="editcar.php?id=<?php echo $row['id']; ?>" class="table-icon edit" title="تحرير"></a>
								        <a onclick="if(confirm('هل حقا تريد الحذف')) return true; else return false;" href="deletecar.php?id=<?php echo $row['id']; ?>" class="table-icon delete" title="حذف"></a>
                                    </td>
                                    </tr>
                        <?php
                        };
                        ?>


					</tbody>
</table>

                    <?php
                    //pagination here
                    $sql = "SELECT * FROM car";
                    $rs_result = mysql_query($sql); //run the query
                    $total_records = mysql_num_rows($rs_result);  //count number of records
                    $total_pages = ceil($total_records / $num_rec_per_page);

                    echo "<a href='showcars.php?page=1'>".'|<'."</a> "; // Goto 1st page

                    for ($i=1; $i<=$total_pages; $i++) {
                                echo "<a href='showcars.php?page=".$i."'>".$i."</a> ";
                    };
                    echo "<a href='showcars.php?page=$total_pages'>".'>|'."</a> "; // Goto last page
                    ?>
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