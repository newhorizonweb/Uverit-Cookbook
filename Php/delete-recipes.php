<?php 
$con = mysqli_connect("localhost", "root", "", "cookbook");

    $password = $_POST["password"];
    $pswd_id = "1";
    $sql_pswd = "SELECT password FROM password WHERE
    id = '$pswd_id'";
    
    $res_pswd = mysqli_query($con, $sql_pswd);

    if(isset($_POST["id"])){
        
        while($row_pswd = mysqli_fetch_assoc($res_pswd)){
            $recipe_id = $_POST["id"];
            $pswd = $row_pswd['password'];
            
            if ($pswd == $password){
                $recipe_sql = "SELECT recipes.id, recipes.image FROM recipes WHERE id='$recipe_id'";
                $rcp_query = mysqli_query($con, $recipe_sql);
                
                echo "<script>$('.rc-button').addClass('delete-success');</script>";
                
                while($rcp_row = mysqli_fetch_assoc($rcp_query)){
                    $rcp_id = $rcp_row["id"];
                    $rcp_img = $rcp_row["image"];
                    
                    // Delete the recipe file (if it exists on the server)
                    if (file_exists("../Recipes/".$rcp_id.".php")){
                        unlink("../Recipes/".$rcp_id.".php");
                    }
                    
                    // Delete the recipe image (if it exists on the server and the DB data is not null / empty)
                    if (file_exists("../Recipe_img/".$rcp_img) && $rcp_img != ""){
                        unlink("../Recipe_img/".$rcp_img);
                    }
                    
                    // Delete the recipe data from the DB
                    $delete_sql = "
                        DELETE FROM recipes WHERE id='$rcp_id';
                        DELETE FROM ingredients WHERE id='$rcp_id';
                        DELETE FROM recipe_steps WHERE id='$rcp_id';
                        DELETE FROM calc WHERE id='$rcp_id';
                        DELETE FROM calc_sub WHERE id='$rcp_id';
                    ";
                    $var = mysqli_multi_query($con, $delete_sql);
                    
                    // Show a message "The recipe has been deleted"
                    echo "<p class='deleted-success'>Przepis został usunięty</p>";
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
        echo "<p class='deleted-error'>Wybierz przepis</p>";
    }

mysqli_close($con);
?>





