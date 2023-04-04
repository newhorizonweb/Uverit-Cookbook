<?php

function searchResults(){
    $con = mysqli_connect("localhost", "root", "", "cookbook");

    $search = $_POST["search-bar"];
    $data = explode(' ',$search);
    
    $sqlloop = "";
    
    $i = 1;
    while ($i < 100){
        if(!empty($data[$i])){
            $sqlloop .= " AND concat(name, description, tags) LIKE '%".$data[$i]."%' ";
        }
            
        $i++;
    }

    $sql = "
    SELECT * FROM recipes WHERE
    concat(name, description, tags) 
    LIKE '%$data[0]%'".$sqlloop."
    ORDER BY name;
    ";

    $res = mysqli_query($con,$sql);

    echo "<ul class='search-list appear'>";

    while($row = mysqli_fetch_assoc($res)){
        $id = $row['id'];
        $name = $row['name'];
        $description = $row['description'];
        
        // If the image doesn't exist in the folder, replace it with a placeholder
        $image = $row['image'];
        if (!file_exists("../Recipe_img/".$image) || $image == ""){
            $image = "Images/no-img.svg";
        } else {
            $image = "Recipe_img/".$row['image'];
        }
        
        echo "<li class='recipe' id='".$id."'>";
        echo "<div class='result-left'>";
        echo "<p>".$name."</p>";
        echo "<p>".$description."</p>";
        echo "</div>";
        echo "<img src='".$image."' class='result-img' alt='Recipe Image'>";
        echo "</li>";
    }
    
    echo "</ul>";

mysqli_close($con);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST'){ 
    searchResults(); 
}

?>