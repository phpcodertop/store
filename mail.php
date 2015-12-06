<?php
include_once "db.php";
/*
تاريخ انتهاء الرخصة مع ارسال امل وتظر في قاءمة الاشياء الي بتنتهي قبل ب 6 ايام
تاريخ الفحص الشهري وقبل ما ينتهي يرسل رسالة للاميل ووو يظهر في الرئيسية للاشياء الي رح تنتهي
تاريخ الفحص السنوي نفس الشيء برضو

تاريخ انتهاء التامين وصورة
*/
$qq = mysql_query("select * from settings") or die("Error in query");
$rr = mysql_fetch_assoc($qq);
$from = $rr['email'];


// licence expiration      driver
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
                ////////sendmail
                $to = $mail;
                $subject = "انتهاء الرخصة الخاصة بك";
                $txt = "
                    <h1 align='center'>رخصة القيادة خاصتك ستنتهى فى خلال 6 ايام</h1>
                                        <p>نرجو منك تجديد رخصة القيادة و شكرا</p>
                ";
                $headers = "From: $from". "\r\n" .'Reply-To: $from'.'X-Mailer: PHP/' . phpversion();
                mail($to,$subject,$txt,$headers);
                echo "mail sent successfuly <br />";
            }
        }

}


// monthly check date      car
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
                ////////sendmail
                $to = $mail;
                $subject = "تاريخ الفحص الشهرى لسيارتك";
                $txt = "
                    <h1 align='center'>موعد الفحص الشهرى لسيارتك سيكون فى خلال 6 ايام</h1>
                    <p>نرجو التاكد من فحص سيارتك .</p>
                ";
                $headers = "From: $from". "\r\n" .'Reply-To: $from'.'X-Mailer: PHP/' . phpversion();
                mail($to,$subject,$txt,$headers);
                echo "mail sent successfuly <br />";
            }
        }

}
// yearly check date       car
$q3 = mysql_query(" select * from car") or die ("error in query");
while($r3 = mysql_fetch_assoc($q3)){
        $licenceexpiry=  $r3['yearlyCheckDate'];
        $driver=  $r3['driver'];
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
                ////////sendmail
                $to = $mail;
                $subject = "تاريخ الفحص السنوى لسيارتك";
                $txt = "
                    <h1 align='center'>موعد الفحص السنوى لسيارتك سيكون فى خلال 6 ايام</h1>
                    <p>نرجو التاكد من فحص سيارتك .</p>
                ";
                $headers = "From: $from". "\r\n" .'Reply-To: $from'.'X-Mailer: PHP/' . phpversion();
                mail($to,$subject,$txt,$headers);
                echo "mail sent successfuly <br />";
            }
        }

}
// insurance check         car
$q4 = mysql_query(" select * from car") or die ("error in query");
while($r4 = mysql_fetch_assoc($q4)){
        $licenceexpiry=  $r4['insuranceExpiryDate'];
        $driver=  $r4['driver'];
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
                ////////sendmail
                $to = $mail;
                $subject = "انتهاء فترة الضمان خاصة السيارة";
                $txt = "
                    <h1 align='center'>موعد انتهاء الضمان سيكون فى خلال 6 ايام</h1>
                    <p>نرجو التاكد من  تجديد فترة الضمان .</p>
                ";
                $headers = "From: $from". "\r\n" .'Reply-To: $from'.'X-Mailer: PHP/' . phpversion();
                mail($to,$subject,$txt,$headers);
                echo "mail sent successfuly <br />";
            }
        }

}



?>