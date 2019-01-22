<?php session_start();
?>
<html>
<head>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Simption GST Software </title>
		<meta name="keywords" content="School Management Software, Hostel management Software, best Hostel Software, School Hostel Software, Hostel ERP Software, Hostel Student management Software, Hostel management"/>
	   <meta name="description" content="Simption Tech Pvt Ltd Provides a School management Software That Contains Student management, Hostel management Software,Fees Management,Staff Management,Examination Management ,Attendance Management ,Account Management,Enquiry Management,Reminder Management ,Homework Management,Time Table Management,Complaint Management,SMS Service,Gallery,Stock Management,Certificate Management,Govt. Requirements,Leave Management ,Holiday Management ,Paper Setter,Sports Management ,Event Management ,Downloads,Bus Management ,Session Management,Library Management ,Hostel Management,Backup Management,Offline Facility,Teacher Panel,Account Panel,Library Panel,Bus Panel,Hostel Panel,Management Panel,Student/Parent Android
Application,Teacher Android Application,Bus Driver Android Application."/>
    <link rel="shortcut icon" type="image/icon" href="../../school_assets/images/favicon.png"/>
	<meta property="article:publisher" content="https://www.facebook.com/simptiontechpvtltd/" />
	<meta name="msvalidate.01" content="C676B6D610F3665D3D6AFE5BFA86FAC5" />
<meta name="twitter:site" content="@simption_tech" />
<META NAME="ROBOTS" CONTENT="ALL">
<meta name="author" content="Simption Tech Pvt Ltd">
<meta name="designer" content="http://www.simption.com">
<meta name="robots" content="default, follow, all">
<meta name="rating" content="General">
<meta name="classification" content="Simption School Management Software"/>
<meta name="Language" content="us-en"/> 
<meta name="Audience" content="All"/> 
<meta name="distribution" content="Global"/> 
<meta name="googlebot" content="index, follow"/>
<meta name="Revisit-After" content="1 days"/> 
<meta name="google-site-verification" content="googleffc254dfcdc26a00" />
<meta name="SKYPE_TOOLBAR" content="SKYPE_TOOLBAR_PARSER_COMPATIBLE" />
<meta name="category" content="Simption School Management Software is a best software For School Management. Simption School Software Contains various panel like Student management, Hostel management Software,Fees Management,Staff Management,Examination Management ,Attendance Management ,Account Management,Enquiry Management,Reminder Management ,Homework Management,Time Table Management,Complaint Management,SMS Service,Gallery,Stock Management,Certificate Management,Govt. Requirements,Leave Management ,Holiday Management ,Paper Setter,Sports Management ,Event Management ,Downloads,Bus Management ,Session Management,Library Management ,Hostel Management,Backup Management,Offline Facility,Teacher Panel,Account Panel,Library Panel,Bus Panel,Hostel Panel,Management Panel,Student/Parent Android
Application,Teacher Android Application,Bus Driver Android Application." />
 <link rel="canonical" href="http://simptiontechpvtltd.blogspot.in/2017/07/new-latest-gst-software-updated-for.html"/>
  
<meta property="og:url"           content="http://www.school.simption.com" />
	<meta property="og:type"          content="website" />
	<meta property="og:title"         content="Simption School Management Software" />
	<meta property="og:description"   content="Simption School Management Software is a best software For School Management. Simption School Software Contains various panel like Student management, Hostel management Software,Fees Management,Staff Management,Examination Management ,Attendance Management ,Account Management,Enquiry Management,Reminder Management ,Homework Management,Time Table Management,Complaint Management,SMS Service,Gallery,Stock Management,Certificate Management,Govt. Requirements,Leave Management ,Holiday Management ,Paper Setter,Sports Management ,Event Management ,Downloads,Bus Management ,Session Management,Library Management ,Hostel Management,Backup Management,Offline Facility,Teacher Panel,Account Panel,Library Panel,Bus Panel,Hostel Panel,Management Panel,Student/Parent Android
Application,Teacher Android Application,Bus Driver Android Application." />
	<meta property="og:image"         content="https://lh3.googleusercontent.com/-bJcXHC79Mdo/WGzq4GKuqiI/AAAAAAAAAfQ/IzvLYf3eib0gTEPzMP5TayWQtE8RhicCwCJoC/w426-h298/simptionbanner.jpg" /> 
 <?php include("../gst_software/attachment/link_css.php"); ?>
<script>
var software_link="../gst_software/admin/";
var software_link2 ="../gst_software/";
function get_content(link){
	var url2=software_link+link+".php";
    $.get(url2, function(data, status){
	 
        $("#get_content").html(data);
		window.location.hash = "#"+link;
		 
    });
   
}
function post_content(link,content){
	$.ajax({
type: "POST",
url: software_link+link+".php?"+content,
cache: false,
success: function(data){
	
 $("#get_content").html(data);
		window.location.hash = "#"+link+"?"+content;
}
});	
}
</script>
<body class="hold-transition skin-green fixed">
 <?php 
     include("../gst_software/attachment/header.php");
     include("../gst_software/attachment/sidebar.php"); ?>
 <div class="content-wrapper" id="get_content">
 </div>
 <?php include("../gst_software/attachment/link_js.php"); 
       include("../gst_software/attachment/footer.php"); 
       include("../gst_software/attachment/sidebar_2.php"); ?>
</body>   
</html>
<script>
function url_control(){
var url=window.location.href;
var url1=url.split('#');
var hash_tag=url1.length;

if(hash_tag<2)
{
get_content('index');
}else{
var url2=url1[1].split('?');
var question_tag=url2.length;
if(question_tag<2){
	
get_content(url1[1]);
}else{
	
post_content(url2[0],url2[1]);	
}	
}
}
$(window).on('popstate', function (e) {
 url_control();
});
$( document ).ready(function() {
    url_control();
});

</script>
	
