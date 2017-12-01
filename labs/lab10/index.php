<?php

  //print_r($_FILES);
  //echo "File size " . $_FILES['myFile']['size'];
  $size = $_FILES["myFile"]["size"];
  
  if($size > 1000000) {
      echo "<h3>File Size must be less than 1Mb</h3>";
  } else {
      move_uploaded_file($_FILES["myFile"]["tmp_name"], "gallery" . $_FILES["myFile"]["name"] );
  }
  
  $files = scandir("gallery", 1);

 function displayImages() {
     global $files;
     
      for ($i = 0; $i < count($files) - 2; $i++) {
         echo "<img src='gallery/" .   $files[$i] . "' width='50' height='50'>";
      }
 }
?>

<!DOCTYPE html>
<html>
    <head>
        <title> Lab 10: Photo Gallery </title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script>
            $(document).ready( function () {
                  
                $("img").on("click", function() {
                    if($("#focus").length != 0) {
                        $("#focus").attr('id', '');
                    }
                    
                    $(this).attr('id', 'focus');
                }); 
            });
        </script>
        <style>
            body {
                text-align: center;
            }
            
            #focus {
                width: 400px;
                height: 400px;
            }
        </style>
    </head>
    <body>

    <h2> Photo Gallery </h2>
    <form method="POST" enctype="multipart/form-data"> 
        <input type="file" name="myFile"/> 
        
        <button type="submit" class="btn btn-outline-primary">Upload</button>

    </form>

    <?=displayImages()?>
    </body>
</html>