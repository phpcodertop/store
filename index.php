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
                <div class="h_title">رخص تنتهي خلال 6 ايام</div>
                <br />
                <table >

						<tr style="height: 8px; background-color: rgb(0, 0, 0); color: rgb(255, 255, 255)">
							<td scope="col" style="color: rgb(255, 255, 255);" >اسم السائق</td>
							<td scope="col" style="color: rgb(255, 255, 255);" >ايميل السائق</td>
							<td scope="col" style="width: 100px; color: rgb(255, 255, 255);" >ارسال رسالة تنبيه</td>
						</tr>


					<tbody>
						<?php
// licence expiration      driver
    mysql_query("SET NAMES 'utf8'");
$q1 = mysql_query(" select * from driver") or die ("error in query");
while($r1 = mysql_fetch_assoc($q1)){
        $licenceexpiry=  $r1['licenceExpiryDate'];
        $mail =  $r1['mail'];
        $date2 = $licenceexpiry;
        $date1 = date("Y-m-d");
        $diff = abs(strtotime($date2) - strtotime($date1));
        $years = floor($diff / (365*60*60*24));
        $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
        $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
        if($years == 0 && $months == 0){
            if($days == 6){
                echo "<tr>";
                echo "<td>".$r1['name']."</td>";
                echo "<td>".$r1['mail']."</td>";
                echo "<td><a href='mailnotic.php?mail=$mail&cos=licenceex'><img src='inc/Email-Forward-icon.png' /></a></td>";
                echo "</tr>";
            }
            if($days != 6){
                echo "لا توجد نتائج";
            }
        }


}
                        ?>


					</tbody>
</table>

            </div>

            <div class="full_w">
                <div class="h_title">سيارة سيتم فحصها خلال 6 أيام</div>
                <br />
                <table >

						<tr style="height: 8px; background-color: rgb(0, 0, 0); color: rgb(255, 255, 255)">
							<td scope="col" style="color: rgb(255, 255, 255);" >نوع السيارة</td>
							<td scope="col" style="color: rgb(255, 255, 255);" >اسم السائق</td>
							<td scope="col" style="color: rgb(255, 255, 255);" >ايميل السائق</td>
							<td scope="col" style="width: 100px; color: rgb(255, 255, 255);" >ارسال رسالة تنبيه</td>
						</tr>


					<tbody>
                        <?php
                            mysql_query("SET NAMES 'utf8'");
$q2 = mysql_query(" select * from car") or die ("error in query");
while($r2 = mysql_fetch_assoc($q2)){
        $licenceexpiry=  $r2['monthlyCheckDate'];
        $driver=  $r2['driver'];
        $date2 = $licenceexpiry;
        $date1 = date("Y-m-d");
        $diff = abs(strtotime($date2) - strtotime($date1));
        $years = floor($diff / (365*60*60*24));
        $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
        $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
        if($years == 0 && $months == 0){
            if($days == 6){
                //get driver mail
                $a = mysql_query("select * from driver where name='$driver' ") or die("error in getting driver name");
                $b = mysql_fetch_assoc($a);
                $mail = $b['mail'];
                $name = $b['name'];

                echo "<tr>";
                echo "<td>".$r2['model']."</td>";
                echo "<td>".$name."</td>";
                echo "<td>".$mail."</td>";
                echo "<td><a href='mailnotic.php?mail=$mail&cos=moncheck'><img src='inc/Email-Forward-icon.png' /></a></td>";
                echo "</tr>";
            }
            if($days != 6){
                echo "لا توجد نتائج";
            }
        }

}
                        ?>
                    </tbody>
                </table>
            </div>

            <div class="full_w">
                <div class="h_title">سيارة سيتم فحصها بعد 6 ايام سنووي</div>
                <br />
                <table >

						<tr style="height: 8px; background-color: rgb(0, 0, 0); color: rgb(255, 255, 255)">
							<td scope="col" style="color: rgb(255, 255, 255);" >نوع السيارة</td>
							<td scope="col" style="color: rgb(255, 255, 255);" >اسم السائق</td>
							<td scope="col" style="color: rgb(255, 255, 255);" >ايميل السائق</td>
							<td scope="col" style="width: 100px; color: rgb(255, 255, 255);" >ارسال رسالة تنبيه</td>
						</tr>


					<tbody>
                        <?php
                            mysql_query("SET NAMES 'utf8'");
$q2 = mysql_query(" select * from car") or die ("error in query");
while($r2 = mysql_fetch_assoc($q2)){
        $licenceexpiry=  $r2['yearlyCheckDate'];
        $driver=  $r2['driver'];
        $date2 = $licenceexpiry;
        $date1 = date("Y-m-d");
        $diff = abs(strtotime($date2) - strtotime($date1));
        $years = floor($diff / (365*60*60*24));
        $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
        $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
        if($years == 0 && $months == 0){
            if($days == 6){
                //get driver mail
                $a = mysql_query("select * from driver where name='$driver' ") or die("error in getting driver name");
                $b = mysql_fetch_assoc($a);
                $mail = $b['mail'];
                $name = $b['name'];

                echo "<tr>";
                echo "<td>".$r2['model']."</td>";
                echo "<td>".$name."</td>";
                echo "<td>".$mail."</td>";
                echo "<td><a href='mailnotic.php?mail=$mail&cos=yearcheck'><img src='inc/Email-Forward-icon.png' /></a></td>";
                echo "</tr>";
            }
            if($days != 6){
                echo "لا توجد نتائج";
            }
        }

}
                        ?>
                    </tbody>
                </table>
            </div>

            <div class="full_w">
                <div class="h_title">سيارات سينتهي تامينها خلال 6 ايام</div>
                <br />
                <table >

						<tr style="height: 8px; background-color: rgb(0, 0, 0); color: rgb(255, 255, 255)">
							<td scope="col" style="color: rgb(255, 255, 255);" >نوع السيارة</td>
							<td scope="col" style="color: rgb(255, 255, 255);" >اسم السائق</td>
							<td scope="col" style="color: rgb(255, 255, 255);" >ايميل السائق</td>
							<td scope="col" style="width: 100px; color: rgb(255, 255, 255);" >ارسال رسالة تنبيه</td>
						</tr>


					<tbody>
                        <?php
                            mysql_query("SET NAMES 'utf8'");
$q2 = mysql_query(" select * from car") or die ("error in query");
while($r2 = mysql_fetch_assoc($q2)){
        $licenceexpiry=  $r2['insuranceExpiryDate'];
        $driver=  $r2['driver'];
        $date2 = $licenceexpiry;
        $date1 = date("Y-m-d");
        $diff = abs(strtotime($date2) - strtotime($date1));
        $years = floor($diff / (365*60*60*24));
        $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
        $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
        if($years == 0 && $months == 0){
            if($days == 6){
                //get driver mail
                $a = mysql_query("select * from driver where name='$driver' ") or die("error in getting driver name");
                $b = mysql_fetch_assoc($a);
                $mail = $b['mail'];
                $name = $b['name'];

                echo "<tr>";
                echo "<td>".$r2['model']."</td>";
                echo "<td>".$name."</td>";
                echo "<td>".$mail."</td>";
                echo "<td><a href='mailnotic.php?mail=$mail&cos=inscheck'><img src='inc/Email-Forward-icon.png' /></a></td>";
                echo "</tr>";
            }
            if($days != 6){
                echo "لا توجد نتائج";
            }
        }

}
                        ?>
                    </tbody>
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