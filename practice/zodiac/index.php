<?php
    function printZodiac($startYear=1500, $endYear=2000) {
        $zodiac = array("rat","ox","tiger","rabbit","dragon","snake","horse","goat","monkey","rooster","dog","pig");
        $counter = 0;
        
        $sY = $_GET["startYear"];
        $eY = $_GET["endYear"];
    
        isset($sY) ? $startYear = $sY : $startYear = $startYear;
        isset($eY) ? $endYear = $eY : $endYear = $endYear;
        
        $sum = (($endYear - $startYear) + 1) * (($startYear/2) + ($endYear/2));
        for($i = $startYear; $i <= $endYear; $i++) {
            echo "<li>Year: $i" . ($i == 1776 ? "<strong style='color:red;'> USA INDEPENDENCE</strong>":"");
            if($i % 100 == 0) {
                echo " <strong>Happy New Century!</strong>";
            }
            if($i >= 1900) {
                echo "<br><img src='img/" .$zodiac[$counter%(count($zodiac))]. ".png'>";
                $counter++;
            }
        }
        return $sum;
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Practice: Chinese Zodiac</title>
        <meta charset="utf-8">
    </head>
    <body>
        <h1>Chinese Zodiac List</h1>
        <ul>
            <?php
                $x = printZodiac();
                echo "<h1>Year Sum: $x</h1>";
            ?>
        </ul>
    </body>
</html>