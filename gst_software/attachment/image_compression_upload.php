<?php
include("session.php");
function camera_code($size,$imagename,$upload_file,$data_id,$column_name2,$database_table,$data_match){
if(strlen($imagename))
{

if(($column_name2=='upload_file') && $size>(100*1024))
{
$widthArray = array(300);
$filename=compressImage($upload_file,$imagename,$widthArray);
}else if($size>(1024*1024)){
$widthArray = array(800);
$filename=compressImage($upload_file,$imagename,$widthArray);
}
else{
$filename=$upload_file;
}

 $imgData =base64_encode(file_get_contents($filename));

unlink($filename);

$query11="update $database_table set `$column_name2`='$imgData' where $data_match='$data_id'";
mysql_query($query11);

}
}


function getExtension($str)
{
$i = strrpos($str,".");
if (!$i)
{
return "";
}
$l = strlen($str) - $i;
$ext = substr($str,$i+1,$l);
return $ext;
}


function compressImage($upload_file,$imagename,$widthArray)
{
$path11 = "../my_image/";
$ext = strtolower(getExtension($imagename));
foreach($widthArray as $newwidth)
{
if($ext=="jpg" || $ext=="jpeg" )
{
$src = imagecreatefromjpeg($upload_file);
}
else if($ext=="png")
{
$src = imagecreatefrompng($upload_file);
}
else if($ext=="gif")
{
$src = imagecreatefromgif($upload_file);
}
else
{
$src = imagecreatefrombmp($upload_file);
}

list($width,$height)=getimagesize($upload_file);
$newheight=($height/$width)*$newwidth;
$tmp=imagecreatetruecolor($newwidth,$newheight);
imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight,$width,$height);
$filename = $path11.$newwidth.'_'.$imagename;
imagejpeg($tmp,$filename,100);
imagedestroy($tmp);
return $filename;
}
}
?>