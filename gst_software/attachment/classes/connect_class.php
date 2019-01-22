<?php
include('session.php');
class connect extends session {
	function __construct(){
error_reporting(E_ALL ^ E_DEPRECATED);
mysql_connect("localhost","root","");
mysql_select_db("ashish_gst");
}

}
?>
