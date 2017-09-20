<?php
    function displaySymbol($imgName) {
        echo "<img src='../labs/lab2/777/img/$imgName.png' width=70 />";
    }
    
    $symbols = array("cherry", "orange", "lemon", "bar", "seven", "grapes");
    
    /* Method 1
    for($i = 0; $i < count($symbols); $i++) {
        displaySymbol($symbols[$i]);
        echo $symbols[$i];
        echo "<br>";
    }
    */
    
    // Method 2
    foreach($symbols as $s) {
        displaySymbol($s);
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <title>PHP Array Practice</title>
        <style type="text/css">
            body {
                padding-top: 550px;
                text-align: center;
                -webkit-animation: rainbow 12s infinite; 
            
                -ms-animation: rainbow 12s infinite;
                
                animation: rainbow 12s infinite;
                }
    
            /* Chrome, Safari, Opera */
            @-webkit-keyframes rainbow{
            	17%{background-color: red;}
            	34%{background-color: orange;}	
            	51%{background-color: yellow;}
            	68%{background-color: green;}
            	85%{background-color: blue;}
            	100%{background-color: purple;}
            }
            
            /* Internet Explorer */
            @-ms-keyframes rainbow{
            	17%{background-color: red;}
            	34%{background-color: orange;}	
            	51%{background-color: yellow;}
            	68%{background-color: green;}
            	85%{background-color: blue;}
            	100%{background-color: purple;}
            }
        
            /* Standard Syntax */
            @keyframes rainbow{
            	17%{background-color: red;}
            	34%{background-color: orange;}	
            	51%{background-color: yellow;}
            	68%{background-color: green;}
            	85%{background-color: blue;}
            	100%{background-color: purple;}
            }
        </style>
    </head>
    <body>
        <h2>Yo, here's some symbols.</h2>
    </body>
</html>