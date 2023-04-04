<?php
    $con = mysqli_connect("localhost", "root", "", "cookbook");

    $product = $_POST["id"];
    $sql = "SELECT brand, name FROM products WHERE products.id = '$product'";
    
    $res = mysqli_query($con,$sql);

    while($row = mysqli_fetch_assoc($res)){
        $brand = $row['brand'];
        $name = $row['name'];

        echo $brand.", ".$name;
    }

    mysqli_close($con);
?>