<?php session_start(); ?> <?php include_once "db.php"; ?>
<?php if(!isset($_SESSION['username'])){
    header("location: login.php");
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
						<li>› <a href="searchcar.php">بحث عن سيارة</a></li>
					</ul>
				</li>
				<li class="upp"><a href="#">السائقين</a>
					<ul>
						<li>› <a href="adddriver.php">اضافة سائق</a></li>
						<li>› <a href="showdrivers.php">عرض جميع السائقين</a></li>
						<li>› <a href="searchdriver.php">بحث عن سائق</a></li>
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
                <div class="h_title">عرض جميع السائقين</div>
                <br />
                <table style="width: 800px; ">
						<tr style="height: 8px; background-color: rgb(0, 0, 0); color: rgb(255, 255, 255)">
							<td scope="col" style="color: rgb(255, 255, 255);">#</td>
							<td scope="col" style="color: rgb(255, 255, 255);">اسم السائق</td>
							<td scope="col" style="color: rgb(255, 255, 255);">اسم العائلة</td>
							<td scope="col" style="color: rgb(255, 255, 255);">رقم تحقيق الشخصية</td>
							<td scope="col" style="color: rgb(255, 255, 255);">صورة تحقيق الشخصية</td>
							<td scope="col" style="color: rgb(255, 255, 255);">رقم رخصة السائق</td>
							<td scope="col" style="color: rgb(255, 255, 255);">صورة رخصة السائق</td>
							<td scope="col" style="color: rgb(255, 255, 255);">تاريخ انتهاء الرخصة</td>
							<td scope="col" style="color: rgb(255, 255, 255);">ايميل السائق</td>
							<td scope="col" style="color: rgb(255, 255, 255);">ملاحظات</td>
							<td scope="col" style="width: 65px; color: rgb(255, 255, 255);">تحرير</td>
						</tr>

					<tbody>
                        <?php
                        //load content here
                        /*
id
name
nickname
driverId
driverIdImage
licence
licenceImage
licenceExpiryDate
mail
note
                        */
                        $num_rec_per_page=6;
                        if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };
                        $start_from = ($page-1) * $num_rec_per_page;
                        $sql = "SELECT * FROM driver LIMIT $start_from, $num_rec_per_page";
                        mysql_query("set names 'utf8'");
                        $rs_result = mysql_query ($sql); //run the query

                        while ($row = mysql_fetch_assoc($rs_result)) {
                        ?>
                                    <tr>
                                    <td><?php echo $row['id']; ?></td>
                                    <td><?php echo $row['name']; ?></td>
                                    <td><?php echo $row['nickname']; ?></td>
                                    <td><?php echo $row['driverId']; ?></td>
                                    <td><a target="_blank" href="showimage.php?src=<?php echo $row['driverIdImage']; ?>"  rel="<?php echo $row['driverIdImage']; ?>"><img src="inc/1-Pictures-icon.png"/></a></td>
                                    <td><?php echo $row['licence']; ?></td>
                                    <td><a target="_blank" href="showimage.php?src=<?php echo $row['licenceImage']; ?>"  rel="<?php echo $row['licenceImage']; ?>"><img src="inc/1-Pictures-icon.png"/></a></td>
                                    <td><?php echo $row['licenceExpiryDate']; ?></td>
                                    <td><?php echo $row['mail']; ?></td>
                                    <td><?php echo $row['note']; ?></td>
                                    <td>
                                        <a href="editdriver.php?id=<?php echo $row['id']; ?>" class="table-icon edit" title="تحرير"></a>
								        <a onclick="if(confirm('هل حقا تريد الحذف')) return true; else return false;" href="deletedriver.php?id=<?php echo $row['id']; ?>" class="table-icon delete" title="حذف"></a>
                                    </td>
                                    </tr>
                        <?php
                        };
                        ?>



					</tbody>
</table>

            </div>
                         <?php
                         //pagination here
                    $sql = "SELECT * FROM driver";
                    $rs_result = mysql_query($sql); //run the query
                    $total_records = mysql_num_rows($rs_result);  //count number of records
                    $total_pages = ceil($total_records / $num_rec_per_page);

                    echo "<a href='showdrivers.php?page=1'>".'|<'."</a> "; // Goto 1st page

                    for ($i=1; $i<=$total_pages; $i++) {
                                echo "<a href='showdrivers.php?page=".$i."'>".$i."</a> ";
                    };
                    echo "<a href='showdrivers.php?page=$total_pages'>".'>|'."</a> "; // Goto last page
                         ?>

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