<?php include("../../attachment/session.php");
                    $product_id=$_POST['item_id'];
                    $product_name=$_POST['model'];
                    $product_quantity=$_POST['quantity'];
                    $string = trim($_POST['string']);
                    $type=$_POST['type'];
                    $orientation=$_POST['orientation'];
                    $size=$_POST['size'];
                    $print=$_POST['print'];
					$quantity=$_POST['quantity']; 
                  $qry="insert into barcode_new(product_id,product_name,product_quantity,barcode_string) values('$product_id','$product_name','$product_quantity','$string')";
                  $run = mysql_query($qry) or mysql_error();
                    if($string != '')
					{
                        echo '<h5>Generated Barcode</h5>';
						for($i=1;$i<=$quantity;$i++)
						{
						   $s = '<img class="barcode" alt="'.$string.'" src="barcode.php?text='.$string.'&codetype='.$type.'&orientation='.$orientation.'&size='.$size.'&print='.$print.'"/>';
                           echo $s;
						}
                    } 
					else
					{
                        echo 'Please enter a string!';
                    }
                ?>