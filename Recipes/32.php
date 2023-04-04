
<?php $con = mysqli_connect("localhost", "root", "", "cookbook");

$sql = "SELECT * FROM recipes
    LEFT JOIN ingredients ON recipes.id = ingredients.id
    LEFT JOIN recipe_steps ON ingredients.id = recipe_steps.id
    LEFT JOIN calc_sub ON recipe_steps.id = calc_sub.id
    WHERE recipes.id = '32' ";

$res = mysqli_query($con,$sql);
while($row = mysqli_fetch_assoc($res)) {
    $id = $row['id'];
    $name = $row['name'];
    $description = $row['description'];
    $type = $row['type'];
    $difficulty = $row['difficulty'];
    $image = $row['image'];
    $date = $row['date'];
    $mod_date = $row['last_mod_date'];

    $fat = $row['fat'];
    $kcal = $row['kcal'];
    $carbohydrates = $row['carbohydrates'];
    $fiber = $row['fiber'];
    $protein = $row['protein'];
    $weight = $row['weight'];
    $portion = $row['portion'];
    $shelf_life = $row['shelf_life'];
    $active_time = $row['active_time'];
    $passive_time = $row['passive_time'];
    $info = $row['info'];
    $tags = $row['tags'];

    for ($x = 1; $x <= 24; $x++) {
        $ing_weight["ing_weight".$x] = $row["ing_weight".$x];
        $ingredient["ingredient".$x] = $row["ingredient".$x];
        $recipe["recipe".$x] = $row["recipe".$x];
    }
    extract($ing_weight);
    extract($ingredient);
    extract($recipe);

    for ($x = 1; $x <= 6; $x++) {
        $weight_calc_sub["weight_calc_sub".$x] = $row["weight-calc-sub".$x];
        $name_calc_sub["name_calc_sub".$x] = $row["name-calc-sub".$x];
    }
    extract($weight_calc_sub);
    extract($name_calc_sub);

    $cp = $carbohydrates / 10; // Carbohydrate portion = 10g
    $wpts = ($fat * 9 + $protein * 4) / 100; // Warsaw Pump Therapy School = (fat kcal + protein kcal) / 100
}

    require "../Php/recipe-content.php";
    require('../Php/svg.php');

        topContent();
            getContent();
                //Get the content for PDF Print to calculate the height - pdf-content-load
                echo "<div class='pcl'>";
                    getContent();
                echo "</div>";
        bottomContent();

    mysqli_close($con);
?>
