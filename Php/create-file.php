<?php
function createFile(){
    $con = mysqli_connect("localhost", "root", "", "cookbook");

    $name = $_POST["name"];
    $sql2 = "SELECT id, name FROM recipes WHERE name = '$name'";
    $res2 = mysqli_query($con,$sql2);

    while($row2 = mysqli_fetch_assoc($res2)) {
        $fileid = "../Recipes/".$row2["id"].".php";
        $id = $row2["id"];
    }

    $recipefile = fopen($fileid, "w") or die("Unable to open the file!");
    ob_start();
    ?>
    <!-- PAGE CONTENT -->
    <?php echo '<?php '; ?>
        $rc_id = <?php echo "'$id'"; ?>;

        require "../Php/recipe-content.php";
        require('../Php/svg.php');

        topContent();
            getContent();
                //Get the content for PDF Print to calculate the height - pdf-content-load
                echo "<div class='pcl'>";
                    getContent();
                echo "</div>";
        bottomContent();
    <?php echo '?>'; ?>
    <!-- /PAGE CONTENT --?
    <?php

    $pagecode = ob_get_clean();
    ob_flush();

    fwrite($recipefile, $pagecode);
    fclose($recipefile);

    mysqli_close($con);
}
?>

