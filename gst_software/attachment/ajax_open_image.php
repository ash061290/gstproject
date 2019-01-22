
<?php
session_start();
if(isset($_SESSION['emp_id']))
{
 $company_name = $_SESSION['firm_name'];
 $company_code = $_SESSION['firm_id'];
}
      include('../../noc73/con37.php');
  	  ?>

<?php
 
              $image_type=$_GET['image_type'];
                  $data=$_GET['data'];
                  $match_field=$_GET['match_field'];
                  $table_name=$_GET['table_name'];
			$que1="select * from $table_name where $match_field='$data'";
    $run1=mysql_query($que1);
    while($row1=mysql_fetch_array($run1)){
$image=$row1[$image_type];
	}
?>



<script>
$('#myModal').modal('show'); 
</script>



  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog" width="150%" style="margin-right:400px;">
    
      <!-- Modal content-->
      <div class="modal-content" >
	   <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"></h4>
        </div>
        <div class="modal-body">
 <img  src="<?php echo 'data:image;base64,'.$image; ?>"  height="400" width="100%" style="margin-top:10px;">
					
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
