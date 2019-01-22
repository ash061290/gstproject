<?php error_reporting(E_ALL ^ E_DEPRECATED);
mysql_connect("localhost","root","");
mysql_select_db("ashish_gst") or die('mysql connect failed');
date_default_timezone_set("Asia/Calcutta"); ?>
