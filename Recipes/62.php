    <!-- PAGE CONTENT -->
    <?php         $rc_id = '62';

        require "../Php/recipe-content.php";
        require('../Php/svg.php');

        topContent();
            getContent();
                //Get the content for PDF Print to calculate the height - pdf-content-load
                echo "<div class='pcl'>";
                    getContent();
                echo "</div>";
        bottomContent();
    ?>    <!-- /PAGE CONTENT --?
    