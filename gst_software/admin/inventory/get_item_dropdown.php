<div class="form-group" >
					    <label>Select Brand Name</label>
					   
						<select name="item_sub_group" onchange="for_list(this.value);" class="form-control" required>
						<option value="">Select</option>
						<?php
							$item_sub_group=$_GET['item_sub_group'];
							include("../../connection/connect.php");
							$query="select * from item_master where item_status='Active' and item_sub_group='$item_sub_group'";
							$res=mysql_query($query);
							while($row=mysql_fetch_array($res)){
							$s_no=$row['s_no'];
							$item_group=$row['item_group'];
							?>
							<option value="<?php echo $item_group; ?>"><?php echo $item_group; ?></option>
							<?php
							}
							?>		  
					    </select> 
						
						</div>