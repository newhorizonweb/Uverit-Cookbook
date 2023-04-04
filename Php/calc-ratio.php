<?php

        // Calculate the ratio

    // Make the ratio always come to 100 (more or less)
    $total_ratio = $fat_ratio + $carb_ratio + $fiber_ratio + $protein_ratio;
    $adj_ratio = 100 / $total_ratio;

    $fat_ratio = round($fat_ratio * $adj_ratio, 2);
    $carb_ratio = round($carb_ratio * $adj_ratio, 2);
    $fiber_ratio = round($fiber_ratio * $adj_ratio, 2);
    $protein_ratio = round($protein_ratio * $adj_ratio, 2);

    $total_ratio_adj = round($fat_ratio) + round($carb_ratio) + round($fiber_ratio) + round($protein_ratio);

    // If the total ratio (adjusted to around 100) is not equal to ex. 100
    if ($total_ratio_adj != 100){

        // Subtract everything but the desimals
        $fat_rest = substr($fat_ratio, -2);
        $carb_rest = substr($carb_ratio, -2);
        $fiber_rest = substr($fiber_ratio, -2);
        $protein_rest = substr($protein_ratio, -2);

        // If the total_adj is too big
        if ($total_ratio > 100){
            $rest_ratio = min($fat_rest, $carb_rest, $fiber_rest, $protein_rest);

            switch ($rest_ratio){
                case $fat_rest:
                    $fat_ratio -= 1;
                break;
                case $carb_rest:
                    $carb_ratio -= 1;
                break;
                case $fiber_rest:
                    $fiber_ratio -= 1;
                break;
                case $protein_rest:
                    $protein_ratio -= 1;
                break;
            }

        // If the total_adj is too small
        } else if ($total_ratio < 100){
            $rest_ratio = max($fat_rest, $carb_rest, $fiber_rest, $protein_rest);

            switch ($rest_ratio){
                case $fat_rest:
                    $fat_ratio += 1;
                break;
                case $carb_rest:
                    $carb_ratio += 1;
                break;
                case $fiber_rest:
                    $fiber_ratio += 1;
                break;
                case $protein_rest:
                    $protein_ratio += 1;
                break;
            }
        }

    }

    // Round everything to the whole numbers
    $fat_ratio = round($fat_ratio, 0);
    $carb_ratio = round($carb_ratio, 0);
    $fiber_ratio = round($fiber_ratio, 0);
    $protein_ratio = round($protein_ratio, 0);
?>