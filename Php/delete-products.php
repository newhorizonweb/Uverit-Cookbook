<?php 
$con = mysqli_connect("localhost", "root", "", "cookbook");

    $password = $_POST["password"];
    $pswd_id = "1";
    $sql_pswd = "SELECT password FROM password WHERE
    id = '$pswd_id'";
    
    $res_pswd = mysqli_query($con, $sql_pswd);

    if(isset($_POST["id"])){
        
        while($row_pswd = mysqli_fetch_assoc($res_pswd)){
            $product_id = $_POST["id"];
            $pswd = $row_pswd['password'];
            
            if ($pswd == $password){
                $product_sql = "SELECT products.id, products.image FROM products WHERE id='$product_id'";
                $rcp_query = mysqli_query($con, $product_sql);
                
                echo "<script>$('.rc-button').addClass('delete-success');</script>";
                
                while($rcp_row = mysqli_fetch_assoc($rcp_query)){
                    $rcp_id = $rcp_row["id"];
                    $rcp_img = $rcp_row["image"];
                    
                    // Delete the product image (if it exists on the server and the DB data is not null / empty)
                    if (file_exists("../Product_img/".$rcp_img) && $rcp_img != ""){
                        unlink("../Product_img/".$rcp_img);
                    }
                    
                    // Delete the product data from the DB
                    $delete_sql = "
                        DELETE FROM products WHERE id='$rcp_id';
                    ";
                    $var = mysqli_multi_query($con, $delete_sql);
                    
                    // Show a message "The product has been deleted"
                    echo "<p class='deleted-success'>Produkt został usunięty</p>";
                    echo "<div class='delete-block'></div>";

                    // Delete "Enter Password" text
                    echo "<script>$('.delete-password-msg').css('display', 'none');</script>";
                }
                
            } else {
                echo "<script>$('.rc-button').addClass('delete-error');</script>";
                echo "<p class='deleted-error'>Niepoprawne hasło</p>";
            }
        }
        
    } else {
        echo "<script>$('.rc-button').addClass('delete-error');</script>";
        echo "<p class='deleted-error'>Wybierz produkt</p>";
    }

mysqli_close($con);
?>





