<?php
include_once "db.php";
$qq = mysql_query("select * from settings") or die("Error in query");
$rr = mysql_fetch_assoc($qq);
$from = $rr['email'];

$mail = $_GET['mail'];
$purpose = $_GET['cos'];

switch ($purpose){

        case "licenceex":
                $subject = "انتهاء الرخصة الخاصة بك";
                $txt = "
                    <h1 align='center'>رخصة القيادة خاصتك ستنتهى فى خلال 6 ايام</h1>
                                        <p>نرجو منك تجديد رخصة القيادة و شكرا</p>
                ";
        break;

        case "moncheck":
                $subject = "تاريخ الفحص الشهرى لسيارتك";
                $txt = "
                    <h1 align='center'>موعد الفحص الشهرى لسيارتك سيكون فى خلال 6 ايام</h1>
                    <p>نرجو التاكد من فحص سيارتك .</p>
                ";
        break;

        case "yearcheck":
                $subject = "تاريخ الفحص السنوى لسيارتك";
                $txt = "
                    <h1 align='center'>موعد الفحص السنوى لسيارتك سيكون فى خلال 6 ايام</h1>
                    <p>نرجو التاكد من فحص سيارتك .</p>
                ";
        break;

        case "inscheck":
                $subject = "انتهاء فترة الضمان خاصة السيارة";
                $txt = "
                    <h1 align='center'>موعد انتهاء الضمان سيكون فى خلال 6 ايام</h1>
                    <p>نرجو التاكد من  تجديد فترة الضمان .</p>
                ";
        break;
}

                $to = $mail;
                $headers = "From: $from". "\r\n" .'Reply-To: $from'.'X-Mailer: PHP/' . phpversion();
                mail($to,$subject,$txt,$headers);
                echo "<h1 align='center'>تم ارسال الايميل بنجاح</h1>";
                echo '<meta http-equiv="refresh" content="3; url=index.php">';


?>