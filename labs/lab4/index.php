<?php
    $backgroundImage = "img/sea.jpg";
    
    if(isset($_GET['keyword'])) {
        
        include 'api/pixabayAPI.php';
        
        $keyword = $_GET['keyword'];
        
        if(!empty($_GET['category'])) {
            $keyword = $_GET['category'];
        }
        
        if(isset($_GET['layout'])) {
            $imageURLs = getImageURLs($keyword, $_GET['layout']);
        } else {
            $imageURLs = getImageURLs($keyword);
        }
        
        if(empty($_GET['keyword']) && empty($_GET['category'])) {
            $backgroundImage = "img/sea.jpg";
        } else {
            $backgroundImage = $imageURLs[array_rand($imageURLs)];
        }
    }
    
    function checkIfSelected($option) {
        if ($option == $_GET['category']) {
            return "selected";
        }
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Lab 4: Carousel</title>
        <meta charset="utf-8">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <style>
            @import url("css/styles.css");
            
            body {
                background-image: url(<?=$backgroundImage?>);
            }
            
            #dropSelect {
                color: black;
            }
            
            input {
                font-size: 2em;
                color: black;
                border-radius:20px;
            }
    
            #layoutDiv {
                display:inline-block; 
                color:black; 
                text-align:left; 
                background-color:white; 
                padding:10px; 
                border-radius:10px;
            }
        </style>
    </head>
    <body>
        <br>
        
        <form method="GET">
            <input type="text" name="keyword" placeholder="key" value="<?=$_GET['keyword']?>"/>
            
            <div id="layoutDiv">
                <input type="radio" id="lhorizontal" name="layout" value="horizontal"/><label for="lhorizontal">Horizontal</label>
                
                <?php
                    if($_GET['layout']=="horizontal") {
                        echo "checked";
                    }
                ?>
                
                <input type="radio" id="lvertical" name="layout" value="vertical"/><label for="lvertical">Vertical</label>
                
                <?php
                    if($_GET['layout']=="vertical") {
                        echo "checked";
                    }
                ?>
            </div>
            
            <input type="submit" value="Search"/>
            <br>
            
            <select id="dropSelect" name="category">
                <option value="">- Select One -</option>
                <option <?=checkIfSelected('ocean')?> value="ocean" >Sea</option>    
                <option <?=checkIfSelected('forest')?> value="forest">Forest</option>    
                <option <?=checkIfSelected('mountain')?> value="mountain">Mountain</option>    
            </select>
        </form>
        
        <br/><br/>
        <?php
            if(!isset($imageURLs)) {
                echo "<h2>Type a keyword to display a slideshow with random images from Pixabay.com</h2>";
            } else if(empty($_GET['keyword']) && empty($_GET['category'])) {
                echo "<h2>You must type a keyword or select a category.</h2>";
            } else {
                // Carousel.
        ?>
        
        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                <?php
                    for($i = 0; $i < 5; $i++) {
                        echo "<li data-target='#carousel-example-generic' data-slide-to='$i'";
                        echo ($i == 0) ? "class='active'" : "";
                        echo "></li>";
                    }
                ?>
            </ol>
            
            <center>
                <div class="carousel-inner" role="listbox">
                    <?php
                        for($i = 0; $i < 5; $i++) {
                            do {
                                $randomIndex = rand(0, count($imageURLs));
                            } while(!isset($imageURLs[$randomIndex])); 
                            
                            echo '<div class="item ';
                            echo ($i == 0) ? "active" : "";
                            echo '">';
                            echo '<img src="' . $imageURLs[$randomIndex] . '">';
                            echo '</div>';
                            unset($imageURLs[$randomIndex]);
                        }
                    ?>
                </div>
            </center>
        
        <!-- Controls -->
        <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
        </div>
        <?php
            }
        ?>
    </body>
</html>