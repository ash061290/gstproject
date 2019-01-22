<?php
class Session{
          protected $emp_id;
		  public $company_name;
		  public $company_code;
		  public $image_path;
		  public function __construct(){
			  parent::__construct();
			  if(!($this->emp_id)){ header('location:index.php'); }
			  $this->company_name = $_SESSION['company_name'];
			  $this->company_code = $_SESSION['company_code'];
			  $this->image_path = "../gst_software/images/";
		  }
		  public function access_auth(){
		     $company_code = $_SESSION['company_code'];
			 $company_name = $_SESSION['company_name'];
			 $icon_img = "../gst_software/images/";
			 $company = array("company_code"=>$company_code,"company_name"=>$company_name,"image_path"=>$icon_img);
		  }
		 
		 
}
?>