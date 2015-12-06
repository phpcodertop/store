<?php
$datetime1 = new DateTime('2009-10-7');
$datetime2 = new DateTime('2009-10-13');
$interval = date_diff($datetime1,$datetime2);
echo $interval->format('%a days');


echo date("Y-m-d");
echo md5("ahmed");
?>