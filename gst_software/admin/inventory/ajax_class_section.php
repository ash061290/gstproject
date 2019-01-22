<?php
$s_no = $_GET['s_no'];

include("../../connection/connect.php");
$query="select * from item_master where s_no='$s_no'";
$result=mysql_query($query);
while($row=mysql_fetch_array($result)){
			$section = $row['section'];
                if($section=='1'){
				echo "<option value=Select Section>Select Section</option>";
				echo "<option value=A>A</option>";
				}elseif($section=='2'){
				echo "<option value=Select Section>Select Section</option>";
			    echo "<option value=A>A</option>";
			    echo "<option value=B>B</option>";
			    }elseif($section=='3'){
				echo "<option value=Select Section>Select Section</option>";
			    echo "<option value=A>A</option>";
			    echo "<option value=B>B</option>";
				echo "<option value=C>C</option>";
			    }elseif($section=='4'){
				echo "<option value=Select Section>Select Section</option>";
			    echo "<option value=A>A</option>";
			    echo "<option value=B>B</option>";
				echo "<option value=C>C</option>";
				echo "<option value=D>D</option>";
				}elseif($section=='5'){
				echo "<option value=Select Section>Select Section</option>";
			    echo "<option value=A>A</option>";
			    echo "<option value=B>B</option>";
				echo "<option value=C>C</option>";
				echo "<option value=D>D</option>";
				echo "<option value=E>E</option>";
			    }
			
			
			
			
			
			}
?>
