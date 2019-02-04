<?php
class dbh{
                 private $servername;
                 private $username;
                 private $password;
                 private $dbname;
     protected function connect(){
                 $this->servername = "localhost";
                 $this->username = "root";
                 $this->password = "";
                 $this->dbname = "gst_new";
                 $conn = new mysqli($this->servername,$this->username,$this->password,$this->dbname);
                 return $conn;
            }
    }
    //login class
    class login extends dbh{
               public function admin_login($table,$data){
                 $new2[]="";
                 $i=0;
                  foreach($data as $key=>$row){
                     $new2[$i]= $key."=".$row;
                     $i++;
                 }
               $new2 = implode(" ",$new2);
                $qry = "select * from $table where $new2";
                  $result=$this->connect()->query($qry);
                  $numrows = $result->num_rows;
                   if($numrows>0){
                      $update_row =  $this->update_admin_row("admin_name",$table);
                      $update_main_row = $this->update_main_row("admin_name",$table,$data['admin_name']);
                      $data[]="";
                      if($row = $result->fetch_assoc()){
                      return  $result = $this->session_admin($row);
                   }
                  }
                }
              public function update_main_row($column_name,$table,$column_val){
                  $sql = "update $table set firm_session='1' where $column_name=$column_val";
                  $result = $this->connect()->query($sql);
              }
              public function update_admin_row($column_name,$table){
                  $sql = "select $column_name from $table where firm_session='1'";
                  $result = $this->connect()->query($sql);
                  $numrows = $result->num_rows;
                  if($numrows>0){
                    while($fetchrow = $result->fetch_assoc()){
                    $update = $this->update_table($fetchrow['admin_name'],$column_name,$table);
                    }
                  }
                }
              public function update_table($data,$column_name,$table){
                 $sql = "update $table set firm_session='0' where $column_name='$data'";
                  $result = $this->connect()->query($sql);
                }
                //session function
                  public function session_admin($data)
                {
                      return  $array = array("firm_id"=>$_SESSION['firm_id'] = $data['id'],
                        "firm_name"=>$_SESSION['firm_name'] = $data['firm_name'],
                        "admin_name"=>$_SESSION['admin_name']=$data['admin_name'],
                        "user_role"=>$_SESSION["user_role"]="Main_Admin","dashboard"=>$_SESSION['admin']="Dashboard",
                         "sales"=>$_SESSION['sales']="Sales","purchase"=>$_SESSION['purchase']="Purchase","expense"=>$_SESSION['expense']="Expense",
                         "inventory"=>$_SESSION['inventory']="Inventory","banking"=>$_SESSION['banking']="Banking","items_tracking"=>$_SESSION['items_tracking']="Items_Tracking",
                         "recycle"=>$_SESSION['recycle']="Recycle","contact"=>$_SESSION['Contact']="Contact","report"=>$_SESSION['Report']="Report",
                         "change_password"=>$_SESSION['change_password']="Change_Password","profile"=>$_SESSION['profile']="Profile");

                }  //session function end

               public function employee_login($table,$data){

               }
    }
    //login class object
     $login = new login();
      //end login class
class firm_detail extends dbh{
	    public function firm_insert($data,$table)
		{
		    $sql = "INSERT INTO `admin_firm_detail`(`firm_name`, `admin_name`, `firm_creation_date`, `firm_contact`, `firm_gst`, `firm_gst_type`, `firm_email`, `firm_inventory_date`, `firm_financial_year`, `firm_pass`, `firm_cpass`, `web_address`, `firm_logo`, `firm_type`, `firm_address`, `firm_status`) VALUES ('".$data['firm_name']."','".$data['admin_name']."','".$data['firm_creation_date']."','".$data['firm_contact']."','".$data['firm_gst']."','".$data['firm_gst_treatment']."','".$data['firm_email']."','".$data['firm_inventory_date']."','".$data['firm_financial_year']."','".$data['firm_pass']."','".$data['firm_cpass']."','".$data['firm_web_address']."','','".$data['firm_type']."','".$data['firm_address']."','".$data['firm_status']."')";
		     $insert = mysql_query($sql);
			 return $insert_id = mysql_insert_id();
			}
			public function fetch_company_warehouse($id,$company_code){
			    $sql = "select * from company_warehouse where id='$id' and company_code='$company_code'";
				$run = mysql_query($sql);
			    $fetchrow = mysql_fetch_array($run);
				if($fetchrow){
				    return $fetchrow;
				 } else{ return false; }
			}
			  public function firm_update($data,$table,$id)
		{
		    $sql = "update $table set firm_name='".$data['firm_name']."',admin_name='".$data['admin_name']."',firm_creation_date='".$data['firm_creation_date']."',firm_contact='".$data['firm_contact']."', firm_gst='".$data['firm_gst']."',firm_gst_type='".$data['firm_gst_treatment']."',firm_email='".$data['firm_email']."', firm_inventory_date='".$data['firm_inventory_date']."', firm_financial_year='".$data['firm_financial_year']."',firm_pass='".$data['firm_pass']."',firm_cpass='".$data['firm_cpass']."', web_address='".$data['firm_web_address']."',firm_logo='', firm_type='".$data['firm_type']."',firm_address='".$data['firm_address']."' where id='$id'";
		     $insert = mysql_query($sql);
			 if($insert){ return true; }
			}
       public function fetch_company($id)
	   {
		    $sql = "select * from admin_firm_detail where id='$id'";
			  $run = $this->connect()->query($sql);
			  $row = "";
			while($row = mysqli_fetch_array($run))
			{
				return $row;
			}
	   }
	    public function user_company($user_name)
	   {
		    $sql = "select * from admin_firm_detail where admin_name='$user_name'";
			$run = mysql_query($sql);
			 $row = "";
			return $row = mysql_num_rows($run);
	   }
	    public function email_company($user_email)
	   {
		    $sql = "select * from admin_firm_detail where firm_email='$user_email'";
			$run = mysql_query($sql);
			 $row = "";
			return $row = mysql_num_rows($run);
	   }
      public function update_firm_pass($new_pass,$cpass,$id)
      {
		  $sql = "update admin_firm_detail set firm_pass='".$new_pass."',firm_cpass='".$cpass."' where id='$id'";
		  $run = mysql_query($sql);
		  if($run){
		        return true;
		  }
		  else{
		      return false;
		  }
       }
     public function company_detail()
	 {
		 $sql = "select * from admin_firm_detail where firm_status='Active' or firm_status='Deactive'";
		 $run = mysql_query($sql);
		 $numrow = mysql_num_rows($run);
		  $row = "";
		 for($i=0;$i<$numrow;$i++)
		 {
			 $row[$i] = mysql_fetch_array($run);
		 }
		 return $row;
	 }
	 public function company_session_update($company_id)
	 {
		  $sql = "update admin_firm_detail set firm_session='0' where firm_session='1'";
		  $run = mysql_query($sql);
		  $sql2 = "update admin_firm_detail set firm_session='1' where id='".$company_id."'";
		  return $run2 = mysql_query($sql2);
	 }
	  public function active_company_detail()
	 {
		 $sql = "select * from admin_firm_detail where firm_status='Active'";
		 $run = mysql_query($sql);
		 $numrow = mysql_num_rows($run);
		  $row = "";
		 for($i=0;$i<$numrow;$i++)
		 {
			 $row[$i] = mysql_fetch_array($run);
		 }
		 return $row;

	 }
	  public function deactive_company_detail()
	 {
		 $sql = "select * from admin_firm_detail where firm_status='Active' and firm_session='0'";
		 $run = $this->connect()->query($sql);
		  if($run->num_rows>0){
        $i=0;
        while($row = $run->fetch_assoc()){
          echo $row;
        }
      }


	 }
	  public function company_user($company_id)
       {
		   $sql = "select * from user_detail where company_code='$company_id'";
		   $run = $this->connect()->query($sql);
		   $numrow = mysqli_num_rows($run);
		   $row = "";
		 for($i=0;$i<$numrow;$i++)
		 {
			 $row[$i] = mysqli_fetch_array($run);
		 }
		 return $row;
         }
  public function company_name($company_id)
       {
		   $sql = "select * from admin_firm_detail where id='$company_id'";
		   $run = $this->connect()->query($sql);
		   $row = mysqli_fetch_array($run);
		  return $company_name = $row['firm_name'];
         }
  public function company_satatus_update($company_id)
      {
		$select = "select * from admin_firm_detail where id='".$company_id."' and firm_session='0'";
         $run = $this->connect()->query($select);
         $row = mysqli_fetch_array($run);
         if($row['firm_status'] == 'Deactive')
		 {
			 $update = "update admin_firm_detail set firm_status='Active' where id='".$company_id."'";
		     return $run = $this->connect()->query($update);
		 }
        if($row['firm_status'] == 'Active')
		 {
			 $update = "update admin_firm_detail set firm_status='Deactive' where id='".$company_id."'";
			 return $run = $this->connect()->query($update);
		 }

        }
//invoice_no insert
     public function insert_invoice_no($data)
	 {
		  $sql = "INSERT INTO `invoice_no`(`admin_name`, `admin_contact`, `admin_id`, `admin_password`, `admin_place_of_supply`, `folder_id`, `recuring_no`, `sales_invoice_no`, `sales_invoice_draft_no`, `purchase_estimate_no`, `purchase_estimate_draft_no`, `sales_estimate_no`, `sales_estimate_draft_no`, `sales_order_no`, `sales_order_draft_no`, `delivery_challan_no`, `delivery_challan_draft_no`, `image`, `advance_invoice_no`, `purchase_invoice_no`, `purchase_invoice_draft_no`, `purchase_order_no`, `purchase_order_draft_no`, `purchase_delivery_challan_no`, `purchase_delivery_challan_draft_no`, `retainer_invoice_no`, `retainer_purchase_invoice_no`, `credit_no`, `package_invoice_no`, `shipping_invoice_no`, `expense_no`, `company_name`, `company_code`) VALUES ('".$data['firm_name']."','".$data['firm_contact']."','".$data['firm_email']."','".$data['firm_pass']."','".$data['firm_address']."','','".$data['recuring_no']."','".$data['sales_invoice_no']."','','".$data['purchase_estimate_no']."','','".$data['sales_estimate_no']."','','".$data['sales_order_no']."','','".$data['delivery_challan_no']."','','".$data['firm_logo']."','".$data['advance_invoice_no']."','".$data['purchase_invoice_no']."','','".$data['purchase_order_no']."','','".$data['purchase_delivery_challan_no']."','','".$data['retainer_invoice_no']."','".$data['retainer_purchase_invoice_no']."','".$data['credit_no']."','".$data['package_invoice_no']."','".$data['shipping_invoice_no']."','".$data['expense_no']."','".$data['firm_name']."','".$data['company_code']."')";
		  return $run = $this->connect()->query($sql);
	  }
public function check_user_mobile($data){
    $select  = "select user_mobile,user_mobile2 from user_detail where user_mobile='".$data['mobile1']."'";
	 $run = $this->connect()->query($select);
	 $numrow = mysqli_num_rows($run);
	 if($numrow>0){
	     return true;
	  }
	  else{ return false; }
}
public function check_user_email($data){
    $select  = "select user_email from user_detail where user_email='".$data['email']."'";
	 $run = $this->connect->query($select);
	 $numrow = mysqli_num_rows($run);
	 if($numrow>0){
	     return true;
	  }
	  else{ return false; }
}
	 //user area
 public function user_insert($data)
	   {
	   $login_id = rand(10,100);
	   $login_id = "CMPNY-".$login_id;
	  /* $password = uniqid();
	   $password_new = md5($password);
	   if($data['user_email'] !=''){
	$headers  = "From: Simption Tech < ashish.simption@gmail.com >\n";
    $headers .= "Cc:   Simption Gst< ashish.simption@gmail.com >\n";
    $headers .= "X-Sender: simption.com < ashish.simption@gmail.com >\n";
    $headers .= 'X-Mailer: PHP/' . phpversion();
    $headers .= "X-Priority: 1\n"; // Urgent message!
    $headers .= "Return-Path: ashish.simption@gmail.com\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=iso-8859-1\n";
	$message = "<center><h3>Welcome To Simption Tech Pvt Ltd..</h3></center>
	              <p style='font-size:15px;'>Dear User,<br/><br/>
				   Your Login id : <a href=''>".$login_id."</a><br/><br/>
				    Password : <a href=''>".$password."</a></p><br/><br/>
					url : <a href='http://simption.com/simptiongst/'>click Here </a>
					<p>This mail system generated don'nt reply this mail.</p>";
	  $subject = "User Authontication";
      $mail = $data['user_email'];
      $send = mail($mail,$subject,$message,$headers);
	    }
		*/
     $insert = "insert into user_detail(date,company_code,user_role,user_name,date_of_birth,user_father_name,user_email,upload_file,user_mobile,user_mobile2,user_adhar,user_login_id,user_password,user_permission,user_address,status) values('".$data['date']."','".$data['company_id']."','".$data['user_role']."','".$data['user_name']."','".$data['date_of_birth']."','".$data['user_father_name']."','".$data['user_email']."','','".$data['user_mobile']."','".$data['user_mobile2']."','".$data['user_adhar']."','".$login_id."','".$data['user_salary']."','".$data['user_password']."','".$data['user_permission']."','".$data['user_address']."','".$data['status']."')";
	  $run = mysql_query($insert);
	  if($run){
		   if(empty($data['tmp_name'])){
		      return true;
		    }
		   $last_id = mysql_insert_id();
		  return $result = $this->camera_code($data['size'],$data['filename'],$data['tmp_name'],$last_id,"upload_file","user_detail","user_id");
	  }
	   }

	    public function user_update($data,$id)
	   {
     $update = "update user_detail set date='".$data['date']."',company_code='".$data['company_id']."',user_role='".$data['user_role']."',user_name='".$data['user_name']."',user_mobile='".$data['user_mobile']."',user_adhar='".$data['user_adhar']."',user_email='".$data['user_email']."',user_password='".$data['user_password']."',description='".$data['description']."',status='".$data['status']."' where user_id='$id'";
	  $run = mysql_query($update);
	  if($run)
		  return true;
	   }
	   public function user_edit($user_id)
	   {
		   $sql = "select * from user_detail where user_id='$user_id'";
		   $run = mysql_query($sql);
		   return $row = mysql_fetch_array($run);
	   }
	     public function user_company_detail($user_id)
	   {
		   $sql = "select company_code from user_detail where user_id='$user_id'";
		   $run = mysql_query($sql);
		   $row = mysql_fetch_array($run);
		   $select_company = "select company_name,id from admin_firm_detail where id='".$row['company_id']."'";
		   $run2 = mysql_query($select_company);
		   return $row2 = mysql_fetch_array($run2);

	   }
	   public function warehouse_insert($data)
	   {
		   $sql = "insert into company_warehouse(warehouse_name,date2,state,city,zip_code,phone,address,status,company_code) values('".$data['warehouse_name']."','".$data['date2']."','".$data['state']."','".$data['city']."','".$data['zip_code']."','".$data['phone']."','".$data['address']."','".$data['status']."','".$data['company_code']."')";
		  return $run = mysql_query($sql);

	   }
	   public function company_warehouse_detail()
	   {
		   $sql = "select * from company_warehouse where status='Active' or status='Inactive'";
		    $run = mysql_query($sql);
			$numrow = mysql_num_rows($run);
			for($i=0;$i<$numrow;$i++)
			{
				$row[$i] = mysql_fetch_array($run);
			}
			if(!empty($row)){
			return $row;
			} else{ return false; }
	   }
	   public function login_admin($data,$table){
$query="select * from $table where admin_name='".$data['id']."' and firm_pass='".$data['pass']."'";
    $run=mysql_query($query) or die(mysql_error());
     $numrow1 = mysql_num_rows($run);
	 $fetchrow = mysql_fetch_array($run);
    if($numrow1>0){
		 $select = "select admin_name from $table where firm_session='1'";
		 $run = mysql_query($select);
		 while($fetchrow2 = mysql_fetch_array($run))
		 {
		  $update3 = "update $table set firm_session='0' where admin_name='".$fetchrow2['admin_name']."'";
		  mysql_query($update3);
		 }
	$update = "update $table set firm_session='1' where admin_name='".$data['id']."'";
		 mysql_query($update);
	$_SESSION['firm_name'] = $fetchrow['firm_name'];
	$_SESSION['firm_id'] = $fetchrow['id'];
    $_SESSION['emp_id']=$data['id'];
	$_SESSION['user_status'] = "Admin";
	$_SESSION['sales'] = "Sales";
	$_SESSION['purchase'] = "Purchase";
	$_SESSION['expense'] = "Expense";
	$_SESSION['package'] = "Packages";
	$_SESSION['inventory'] = "Inventory";
	$_SESSION['banking'] = "Banking";
	$_SESSION['stock'] = "Stock";
	$_SESSION['reminder'] = "Reminder";
	$_SESSION['contact'] = "Contact";
	$_SESSION['report'] = "Report";
	$_SESSION['outstanding'] = "Outstanding";
	return true;

    }
	else{ return false; }
	   }
	   public function user_login($data,$table){
	       $qry2 = "select company_code,user_role,user_permission,user_name from $table where user_login_id='".$data['id']."' and user_password='".$data['pass']."' and status='Active'";
		   $run2 = mysql_query($qry2) or die(mysql_error());
		   $numrow2 = mysql_num_rows($run2);
		   $fetchrow2 = mysql_fetch_array($run2);
		   if($numrow2>0)
		   {
			   $_SESSION['emp_id'] = $data['id'];
			   $_SESSION['firm_id'] = $fetchrow2['company_code'];
			   $_SESSION['user_role'] = $fetchrow2['user_role'];
			   $permission = $fetchrow2['user_permission'];
			   $permission = json_decode($permission);
			   if($fetchrow2['user_role'] == 'Admin'){
			      $_SESSION['permission'] == "All";
			   }
			   if($fetchrow2['user_role'] == 'Employee'){
				   if(in_array("Sales",$permission)){
				     $_SESSION['sales'] = "Sales";
				   }
				    if(in_array("Purchase",$permission)){
				     $_SESSION['purchase'] = "Purchase";
				   }
				    if(in_array("Inventory",$permission)){
				     $_SESSION['inventory'] = "Inventory";
				   }
				    if(in_array("Stock",$permission)){
				     $_SESSION['stock'] = "Stock";
				   }
				   if(in_array("Banking",$permission)){
				     $_SESSION['banking'] = "Banking";
				   }
				   if(in_array("Contact",$permission)){
				     $_SESSION['contact'] = "Contact";
				   }
				    $select_company = "select * from admin_firm_detail where id='".$fetchrow2['company_code']."'";
			   $run3 = mysql_query($select_company) or die(mysql_error());
			   $fetchrow3 = mysql_fetch_array($run3);
			   $_SESSION['firm_name']  = $fetchrow3['firm_name'];
			   }
				  return true;
		   }
		   else{ return false; }
	   }
	public function camera_code($size,$imagename,$upload_file,$data_id,$column_name2,$database_table,$data_match){
       if(strlen($imagename))
          {
           if(($column_name2=='upload_file') && $size>(100*1024))
           {
				$widthArray = array(300);
				$filename=$this->compressImage($upload_file,$imagename,$widthArray);
				}else if($size>(1024*1024)){
				$widthArray = array(800);
				$filename=$this->compressImage($upload_file,$imagename,$widthArray);
				}
				else{
				$filename=$upload_file;
				}
				 $imgData =base64_encode(file_get_contents($filename));
				unlink($filename);
				$query11="update $database_table set `$column_name2`='$imgData' where $data_match='$data_id'";
				mysql_query($query11);
				return true;
				}
				else{
				return false;
				}
				}
		public function getExtension($str)
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
	public function compressImage($upload_file,$imagename,$widthArray)
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
		}

		$new = new firm_detail();
?>
