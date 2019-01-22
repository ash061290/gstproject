<?php
                    $string = trim($_POST['barcode_string']);
					$brand_name = $_POST['brand_name'];
					$category_name = $_POST['category_name'];
					$subcategory_name = $_POST['subcategory_name'];
					$model_no = $_POST['model_no'];
					$product_hsn_no = $_POST['product_hsn_no'];
				    $number = 10;
                    /*$type=$_POST['type']; 
                    $orientation=$_POST['orientation'];
                    $size=$_POST['size'];
                    $print=$_POST['print'];
					$number=$_POST['size_number'];
					*/
                  
                    if($string != '') 
					{
                       // echo '<h5>Generated Barcode</h5>';
						for($i=1;$i<=$number;$i++) 
						{
						   $s = '<img class="barcode" alt="'.$string.'" src="   barcode.php?text='.$string.'"/>';
                           echo $s;
						}
                    } 
					else
					{
                        echo 'Please enter a string!';
                    }
           
                ?>