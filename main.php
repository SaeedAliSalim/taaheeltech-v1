<?php

$password="1";
$ency_password=sha1(md5($password));
echo $ency_password;
?>